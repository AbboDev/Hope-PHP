<?php

/**
* 
*/
class Route {
	// private static $secondary = VERBOSE_ROUTER;
	
	/**
	*	It can be passed either as an array or as a string,
	*	but in the second case it will converted into an array
	*/
	public $path;

	/**
	*	The HTTP method or methods this route support
	*	ALL make the route support all methods
	*/
	public $methods;

	/**
	*
	*/
	public $callback;

	/**
	*
	*/
	public $controller;

	/**
	*	A series of options call before the route will be executed
	*/
	public $middleware;

	/**
	*	A name that can make use to call more quickly the route
	*	This should be unique, otherwise the router will call the first that it finds
	*/
	public $name;

	/**
	*
	*/
	public $next_routes;

/*************************************************************************/

	public function __construct($path, array $methods, $callback, $next_routes = array()) {
		if (gettype($path) === "string") {
			$path = explode("/", $path);
		}
		$this->path = $path;
		$this->methods = array_map("strtoupper", $methods);
		$this->callback = $callback;
		foreach ($next_routes as $index => $next_route) {
			$this->next_routes[$next_route->path[0]] = $next_route;
		}
	}

/*************************************************************************/

	/**
	*	Set current route controller
	*	Return current route
	*/
	public function setController($controller) {
		$this->controller = $controller;
		return $this;
	}

	/**
	*	Set current route middleware
	*	Return current route
	*/
	public function setMiddleware($middleware) {
		$this->middleware = $middleware;
		return $this;
	}

	/**
	*	Set current route name
	*	Return current route
	*/
	public function setName($name) {
		$this->name = $name;
		return $this;
	}
}

?>