<?php

/**
* 
*/
class Session {
	private static $secondary = VERBOSE_SESSION;

	public static function startSession() {
		Utilities::verbalize("Starting session", self::$secondary);
		session_start();
	}

	public static function stopSession() {
		Utilities::verbalize("Stop session", self::$secondary);
		session_destroy();
	}

	public static function addSessionVariable($key, $value = "") {
		$_SESSION[$key] = $value;
	}

	public static function getSessionVariable($key) {
		if (isset($_SESSION[$key])) {
			return $_SESSION[$key];
		}
		return false;
	}

	public static function emptySessionVariables() {
		session_unset();
	}
}

?>