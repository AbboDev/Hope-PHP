<?php

/*************************************************************************/
require_once(getcwd().'/require/constant.php');
/*************************************************************************/


/*************************************************************************/
require_once(PATH_TO_REQUIRE.'register.php');
/*************************************************************************/


Utilities::verbalize("<b>Initialize the CORE &#9883;</b>", VERBOSE_CORE);
Utilities::printTag("br", true);

Session::startSession();
Cookie::addDailyCookie("Core", CORE_KEY);
Session::addSessionVariable("Core", CORE_KEY);


/*************************************************************************/
require_once(PATH_TO_REQUIRE.'routes.php');
/*************************************************************************/


HTTPResponse::infoHTTPStatus();
Router::resolve();
// $router = new Router(array_merge($routes, $private_routes), $errors_route, $default_route, $redirect_route);
// $router->resolve();

DB::closeConnection();

Session::stopSession();

?>