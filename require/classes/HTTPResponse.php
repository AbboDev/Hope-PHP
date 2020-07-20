<?php

/**
* 
*/
class HTTPResponse {
	private static $secondary = VERBOSE_ROUTER;

/*************************************************************************/

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
}

?>