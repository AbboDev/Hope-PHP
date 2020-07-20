<?php

Router::registerRoute(
	(new Route('home', ['GET'], 'home'))->setController('ControllerHome')
);
Router::registerRoute(
	new Route('index', ['GET'], function() {
		require_once("index.php");
	})
);
Router::registerRoute(
	(new Route('error', ['GET'], 'error'))->setController('ControllerError')
);
Router::registerRoute(
	(new Route('demo', ['GET'], 'testRoom', [
		new Route('colors', ['GET'], 'colors'),
		new Route('columns', ['GET'], 'columns'),
		new Route('router', ['GET'], 'router')
	]))->setController('ControllerHome')
);
Router::registerRoute(
	(new Route('test', ['GET'], 'testRoom'))->setController('ControllerHome')
);
Router::registerRoute(
	new Route('teapot', ['GET'], function() {
		header("HTTP/1.1 418 I'm a teapot");

		Utilities::verbalize("I'm a pretty teapot");
		Utilities::verbalize("&#9746;");
	})
);
Router::registerRoute(
	(new Route('post', ['POST'], function() {
		echo "zzzzzzzzzzzzzzzz";
	}, [
		new Route('nice', ['GET'], function() {
			echo "::::::";
		}),
		new Route('freeze', ['GET'], function() {
			echo "......";
		})
	]))->setController('c')
);
Router::registerRoute(
	(new Route('core', ['GET'], 'core'))->setController('ControllerError')
);

Router::registerDefaultRoute(
	(new Route('', ['ALL'], 'home'))->setController('ControllerHome')
);
Router::registerErrorRoute(
	(new Route('error', ['GET'], 'error'))->setController('ControllerError')
);

// $redirect_route = array(
// 	'prova' => 'test',
// 	'demo/prova' => 'demo',
// 	'demo/test' => 'demo'
// );

?>