<?php

/*************************************************************************/

define('CORE_KEY',				'7daea84b04afc952e849c649e09b51570ef076c9');

/*************************************************************************/

define('DB_TYPE',				'mysql');
define('DB_HOST',				'localhost');
define('DB_NAME',				'');
define('DB_USER',				'root');
define('DB_PWD',				'');

/*************************************************************************/

/*************************************************************************/

define('PATH_TO_REQUIRE',		'require/');
define('PATH_TO_CLASSES',		PATH_TO_REQUIRE.'classes/');

/*************************************************************************/

/*************************************************************************/

define('PATH_TO_USER_CLASS',	getcwd().'/class/');
define('PATH_TO_CONTROLLER',	PATH_TO_USER_CLASS.'controller/');
define('PATH_TO_MODEL',			PATH_TO_USER_CLASS.'model/');
define('PATH_TO_FACTORY',		PATH_TO_MODEL.'factory/');

define('PATH_TO_VIEWS',			'views/');
define('PATH_TO_COMPONENTS',	PATH_TO_VIEWS.'components/');

define('PATH_TO_IMAGES',		'src/images');
define('PATH_TO_CSS',			'src/css');
define('PATH_TO_JS',			'src/js');

define('PATH_TO_FAVICON',		PATH_TO_VIEWS.PATH_TO_IMAGES.'/favicon/');

/*************************************************************************/

/*************************************************************************/

define('HTTPS',					(isset($_SERVER['HTTPS'])) ? 'HTTPS://' : 'HTTP://');
define('HTTP_VERSION',			'HTTP/1.1');
define('ROUTER_PROPS_MATCH',	'%');
define('SEPARATOR',				' - ');
define('SITE_NAME',				'HopePHP');
define('AUTHOR_NAME',			'Thomas Abbondi');
define('SITE_DESCRIPTION',		'');
define('KEYWORDS',				'');

define('BASE_PATH',				$_SERVER['SERVER_NAME']);
define('SERVER_NAME',			$_SERVER['HTTP_HOST'].'/hope-php/');

/*************************************************************************/

/*************************************************************************/

define('DEFAULT_STYLES',		'reset;fonts;style;responsive');
define('HEAD_OF_PAGE',			PATH_TO_REQUIRE.'head.php');
define('DEFAULT_TEMPLATE',		PATH_TO_REQUIRE.'skeleton.php');
define('HOME_PAGE',				'home');

/*************************************************************************/

/*************************************************************************/

/**
*	IF TRUE PRINT ALL STATUS MESSAGES OF THE CORE (debug friendly)
*/
define('VERBOSE',				false);

/**
*	 You can also disable certain messages
*/
define('VERBOSE_CORE',			true);
// define('VERBOSE_ROUTE',			true);
define('VERBOSE_ROUTER',		true);
define('VERBOSE_DB'		,		true);
define('VERBOSE_VIEWS',			true);
define('VERBOSE_COMPONENTS',	true);
define('VERBOSE_SESSION',		true);
define('VERBOSE_COOKIE',		true);

define('VERBOSE_TAG',			false);
/**
*	IF TRUE ADD THE FOLLOWING RULE:
*		call HTML5Shiv CDN
*		add type to <script> and <link>;
*		final back slash to all void tag (img, hr, link, meta...);
*	THE RIGHT WAY IS TO ALWAYS SET THIS TRUE
*/
define('RETRO_COMPATIBILY',		true);
define('PREFERRED_HASH',		'md5');

/*************************************************************************/

?>