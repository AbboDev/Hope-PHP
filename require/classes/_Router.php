<?php

/**
* 
*/
class Router {
	private static $secondary = VERBOSE_ROUTER;

	public $routes;
	public $errors_route;
	public $default_route;
	public $redirect_route;

	private $call_match = "call";
	private $name_match = "name";
	private $method_match = "method";
	private $action_match = "action";
	private $controller_match = "controller";
	private $middleware_match = "middleware";

	public function __construct(array $routes, $errors_route = null, $default_route = null, $redirect_route = null) {
		Utilities::verbalize("Starting routing", self::$secondary);
		$this->routes = $routes;
		$this->errors_route = $errors_route;
		$this->default_route = $default_route;
		$this->redirect_route = $redirect_route;

		$this->call_match = ROUTER_PROPS_MATCH.$this->call_match;
		$this->name_match = ROUTER_PROPS_MATCH.$this->name_match;
		$this->method_match = ROUTER_PROPS_MATCH.$this->method_match;
		$this->action_match = ROUTER_PROPS_MATCH.$this->action_match;
		$this->controller_match = ROUTER_PROPS_MATCH.$this->controller_match;
		$this->middleware_match = ROUTER_PROPS_MATCH.$this->middleware_match;
	}

	public function resolve() {
		$curr_path = explode('/', self::getCurrentUri());
		array_shift($curr_path);

		if ($curr_path[0] === "" && sizeof($curr_path) == 1 && isset($this->default_route)) {
			Utilities::verbalize("Default route found", self::$secondary);
			$this->exeRouteAction($this->default_route);
		} else {
			if (isset($this->redirect_route)) {
				Utilities::verbalize("There can be redirects", self::$secondary);
				foreach ($this->redirect_route as $path => $redirect) {
					if (("/".$path) === self::getCurrentUri()) {
						Utilities::verbalize("Redirect found", self::$secondary);
						Utilities::verbalize("Current path change from ".self::getCurrentUri()." to ".$redirect, self::$secondary);
						self::infoHTTPStatus(301);
						self::setHeader("Location", HTTPS.SERVER_NAME.$redirect);
						$curr_path = explode('/', $redirect);
						break;
					}
				}
			}
			$index = 0;
			$res_route = $this->routes;
			$root_route = null;
			do {
				$res_route = $this->iterateRoute($res_route, $curr_path[$index]);
				if (is_bool($res_route)) {
					Utilities::verbalize("No route found", self::$secondary);
					break;
				}
				if (is_null($root_route)) {
					$root_route = $res_route;
				}
				++$index;
			} while ($index < sizeof($curr_path));

			if (is_bool($res_route)) {
				self::infoHTTPStatus(404);
				if (isset($this->errors_route)) {
					if ($this->isRoute($this->errors_route)) {
						Utilities::verbalize("Redirect to errors handler route.", self::$secondary);
						$this->exeRouteAction($this->errors_route);
					}
				}
			} else {
				if ($this->isRoute($res_route)) {
					Utilities::verbalize("Route found", self::$secondary);
					$this->exeRouteAction($res_route, $root_route);
				} else {
					if (array_key_exists('', $res_route)) {
						Utilities::verbalize("Default route action found", self::$secondary);
						$this->exeRouteAction($res_route[''], $root_route);
					} else {
						Utilities::verbalize("No default route action found", self::$secondary);
					}
				}
			}
		}
	}

/****************************************************************/

	private function iterateRouteByName($routes, $route_name) {
		foreach ($routes as $path => $route) {
			Utilities::verbalize($path, self::$secondary);
			if (!$this->isRoute($route)) {
				$plural = "";
				if (sizeof($route) > 1) {
					$plural .= "s";
				}
				Utilities::verbalize("Route contains route".$plural, self::$secondary);
				$this->iterateRoute($route, $curr_path);
			} else {
				if ($this->name_match === $route_name) {
					return $route;
				}
			}
		}
		return false;
	}

	private function iterateRoute(array $routes, $curr_path) {
		if (array_key_exists($curr_path, $routes)) {
			if (!$this->isRoute($routes[$curr_path])) {
				$plural = "";
				if (sizeof($routes[$curr_path]) > 1) {
					$plural .= "s";
				}
				Utilities::verbalize("Route".$plural." inside route", self::$secondary);
			}
			return $routes[$curr_path];
		}
		return false;
	}

/****************************************************************/

	public function exeRouteAction($route, $root_route = null) {
		Utilities::verbalize("Current HTTP method: ".$_SERVER['REQUEST_METHOD'], self::$secondary);
		if (strtoupper($route[$this->method_match]) == $_SERVER['REQUEST_METHOD'] || strtoupper($route[$this->method_match]) == 'ALL') {
			Utilities::verbalize("Method allowed", self::$secondary);
			$action = $route[$this->action_match];
			if (Utilities::isFunction($action)) {
				Utilities::verbalize("Action -> Function()", self::$secondary);
				Utilities::printTag("hr", true);
				$action();
			} elseif (gettype($action) === "string") {
				Utilities::verbalize("Action -> File: ".$action, self::$secondary);
				Utilities::printTag("hr", true);
				(new View($action))->render();
			} elseif (array_key_exists($this->call_match, $action)) {
				Utilities::verbalize("Action -> Controller", self::$secondary);
				if (array_key_exists($this->controller_match, $action)) {
					Utilities::verbalize("Route controller found", self::$secondary);
					Utilities::printTag("hr", true);
					$action[$this->controller_match]->{$action[$this->call_match]}();
				} elseif (!is_null($root_route)) {
					if (array_key_exists($this->controller_match, $root_route)) {
						Utilities::verbalize("Root route controller found", self::$secondary);
						Utilities::printTag("hr", true);
						$root_route[$this->controller_match]->{$action[$this->call_match]}();
					}
				} 
			}
		} else {
			Utilities::verbalize("Method not allowed", self::$secondary);
			Utilities::verbalize("Method requested: ".strtoupper($route[$this->method_match]), self::$secondary);
			self::infoHTTPStatus(405);
		}
		Utilities::printTag("hr", true);
	}

	private function isRoute(array $route) {
		return (array_key_exists($this->name_match, $route)
			&& array_key_exists($this->method_match, $route)
			&& array_key_exists($this->action_match, $route)
		);
	}

/****************************************************************/

	public static function getCurrentUri($first_slash = true) {
		$basepath = implode('/', array_slice(explode('/', $_SERVER['SCRIPT_NAME']), 0, -1)).'/';
		$uri = substr($_SERVER['REQUEST_URI'], strlen($basepath));
		$uri = self::printURIWhitoutQuery($uri);
		$uri = trim($uri, '/');
		if ($first_slash) {
			$uri = '/'.$uri;
		}
		return $uri;
	}

	public static function printSelf($first_slash = true) {
		echo self::getCurrentUri($first_slash);
	}

	public static function infoHTTPStatus($code = "") {
		if ($code !== "") {
			http_response_code($code);
		}
		Utilities::verbalize("Current HTTP status: ".http_response_code(), self::$secondary);
		return http_response_code();
	}

	public static function setHeader($name, $value) {
		$header = $name.": ".$value;
		header($header);
	}

	public static function printURIWhitoutQuery($uri = null) {
		if ($uri === null) {
			$uri = self::getCurrentUri();
		}
		if (strstr($uri, '?')) {
			$uri = substr($uri, 0, strpos($uri, '?'));
		}
		return $uri;
	}
}

?>