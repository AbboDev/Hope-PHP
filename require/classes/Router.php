<?php

/**
* 
*/
class Router {
	private static $secondary = VERBOSE_ROUTER;

	/**
	*
	*/
	private static $routes = array();

	/**
	*
	*/
	private static $error_route;

	/**
	*
	*/
	private static $default_route;

	/**
	*
	*/
	private static $redirect_routes = array();

	/**
	*
	*/
	private static $api_route = array();

/*************************************************************************/

	/**
	*
	*/
	public static function registerRoutes($routes) {
		array_map('registerRoute', $routes);
	}
	/**
	*
	*/
	public static function registerRoute($route, $type = "") {
		switch ($type) {
			case "redirect":
				self::$redirect_routes[implode("/", $route->path)] = $route;
				break;
			case "api":
				self::$api_routes[implode("/", $route->path)] = $route;
				break;
			default:
				self::$routes[implode("/", $route->path)] = $route;
				break;
		}
		Utilities::verbalize("New Route add to Router");
	}

	/**
	*
	*/
	public static function registerDefaultRoute($route) {
		self::$default_route = $route;
	}

	/**
	*
	*/
	public static function registerErrorRoute($route) {
		self::$error_route = $route;
	}

	/**
	*
	*/
	public static function registerRedirectRoute($route) {
		self::registerRoute($route, "redirect");
	}

	/**
	*
	*/
	public static function registerAPIRoute($route) {
		self::registerRoute($route, "api");
	}

/*************************************************************************/

	public static function resolve() {
		$curr_path = explode('/', self::getCurrentUri(false));

		if ($curr_path[0] === "" && sizeof($curr_path) == 1) {
			if (isset(self::$default_route)) {
				Utilities::verbalize("Default route found", self::$secondary);
				self::exeRouteAction(self::$default_route);
			} else {
				Utilities::verbalize("No default route found", self::$secondary);
			}
		} else {
			if (isset(self::$redirect_routes) && !empty(self::$redirect_routes)) {
				Utilities::verbalize("There can be redirects", self::$secondary);
				foreach (self::$redirect_routes as $path => $redirect) {
					if ($path === self::getCurrentUri(false)) {
						Utilities::verbalize("Redirect found", self::$secondary);
						Utilities::verbalize("Current path change from ".self::getCurrentUri(false)." to ".$redirect, self::$secondary);
						HTTPResponse::infoHTTPStatus(301);
						HTTPResponse::setHeader("Location", HTTPS.SERVER_NAME.$redirect);
						$curr_path = explode('/', $redirect);
						break;
					}
				}
			} else {
				Utilities::verbalize("There are no redirect to do", self::$secondary);
			}

			$index = 0;
			$res_route = self::$routes;
			$root_route = null;
			do {
				if (self::hasRoutes($res_route)) {
					$res_route = self::iterateRoute($res_route->next_routes, $curr_path[$index]);
				} else {
					$res_route = self::iterateRoute($res_route, $curr_path[$index]);
				}

				if (is_bool($res_route)) {
					Utilities::verbalize("No route found", self::$secondary);
					break;
				}

				if (is_null($root_route)) {
					$root_route = $res_route;
				}
				++$index;
				
				if (self::hasRoutes($res_route) && $index < sizeof($curr_path)) {
					$plural = "";
					if (sizeof($res_route) > 1) {
						$plural .= "s";
					}
					Utilities::verbalize("Route".$plural." inside route", self::$secondary);
				}
			} while ($index < sizeof($curr_path));

			if (is_bool($res_route)) {
				HTTPResponse::infoHTTPStatus(404);
				if (isset(self::$error_route)) {
					Utilities::verbalize("Redirect to errors handler route.", self::$secondary);
					self::exeRouteAction(self::$error_route);
				} else {
					Utilities::verbalize("No error route found", self::$secondary);
				}
			} else {
				Utilities::verbalize("Route found", self::$secondary);
				self::exeRouteAction($res_route, $root_route);
			}
		}
	}

/*************************************************************************/

	/**
	*
	*/
	private static function iterateRoute(array $routes, $curr_path) {
		if (array_key_exists($curr_path, $routes)) {
			return $routes[$curr_path];
		}
		return false;
	}

	/**
	*
	*/
	private static function iterateRouteByName($routes, $route_name) {
		foreach ($routes as $path => $route) {
			Utilities::verbalize($path, self::$secondary);
			if (!$this->hasRoutes($route)) {
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

/*************************************************************************/

	public static function exeRouteAction($route, $root_route = null) {
		Utilities::verbalize("Current HTTP method: ".$_SERVER['REQUEST_METHOD'], self::$secondary);
		if (in_array("ALL", $route->methods) || in_array($_SERVER['REQUEST_METHOD'], $route->methods)) {
			Utilities::verbalize("Method allowed", self::$secondary);
			$action = $route->callback;
			if (Utilities::isFunction($action)) {
				Utilities::verbalize("Action -> Function()", self::$secondary);
				Utilities::printTag("hr", true);
				$action();
			} elseif (isset($route->controller)) {
				Utilities::verbalize("Action -> Controller", self::$secondary);
				$class_name = $route->controller;
				$controller = new $class_name();
				if (method_exists($controller, $action)) {
					Utilities::verbalize("Route controller found", self::$secondary);
					Utilities::printTag("hr", true);
					$controller->$action();
				}
			} elseif (!is_null($root_route) && isset($root_route->controller)) {
				$class_name = $root_route->controller;
				$controller = new $class_name();
				if (method_exists($controller, $action)) {
					Utilities::verbalize("Root route controller found", self::$secondary);
					Utilities::printTag("hr", true);
					$controller->$action();
				}
			} elseif (gettype($action) === "string") {
				Utilities::verbalize("Action -> File: ".$action, self::$secondary);
				Utilities::printTag("hr", true);
				(new View($action))->render();
			}
		} else {
			$plural = (count($route->methods) > 1) ? "s" : "";
			if (count($route->methods) > 1) {
				foreach ($route->methods as $index => $method) {
					$req_method .= strtoupper($method);
					if ($index < count($route->methods)-1) {
						$req_method .= "/";
					}
				}
			} else {
				$req_method = strtoupper($route->methods[0]);
			}
			Utilities::verbalize("Method not allowed", self::$secondary);
			Utilities::verbalize("Method".$plural." allowed: ".$req_method, self::$secondary);
			HTTPResponse::infoHTTPStatus(405);
		}
		Utilities::printTag("hr", true);
	}

/*************************************************************************/

	private static function hasRoutes($route) {
		return (is_object($route) && get_class($route) === "Route" && !empty($route->next_routes));
	}

/*************************************************************************/

	public static function getCurrentUri($first_slash = true) {
		$basepath = implode('/', array_slice(explode('/', $_SERVER['SCRIPT_NAME']), 0, -1)).'/';
		$uri = substr($_SERVER['REQUEST_URI'], strlen($basepath));
		$uri = self::getURIWhitoutQuery($uri);
		$uri = trim($uri, '/');
		if ($first_slash) {
			$uri = '/'.$uri;
		}
		return $uri;
	}

	public static function printSelf($first_slash = true) {
		echo self::getCurrentUri($first_slash);
	}

	public static function getURIWhitoutQuery($uri = null) {
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