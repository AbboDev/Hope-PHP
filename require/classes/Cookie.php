<?php

/**
* 
*/
class Cookie {
	private static $secondary = VERBOSE_COOKIE;

	public static $seconds_for_day = 86400;
	
	public static function addCookie($name, $value = "", $expire = 0, $path = "/", $domain = "", $secure = "", $httponly = "") {
		setcookie($name, $value, time() + $expire, $path, $domain, $secure, $httponly);
	}

	public static function addDailyCookie($name, $value = "", $days = 1, $path = "/", $domain = "", $secure = "", $httponly = "") {
		self::addCookie($name, $value, time() + (self::$seconds_for_day * $days), $path, $domain, $secure, $httponly);
	}

	public static function getCookie($name) {
		if (isset($_COOKIE[$name])) {
			return $_COOKIE[$name];
		}
		return false;
	}

	public static function removeCookie($name) {
		setcookie($name, "", time() - 1);
	}
}

?>