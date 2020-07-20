<?php

/**
* 
*/
class ControllerError extends Controller {

	public function error() {
		$error = $this->getError();

		$view = new View("error");
		$view->pushToStorage($error, "error");
		$view->renderUsingTemplate();
	}

	public function core() {
		HTTPResponse::infoHTTPStatus(403);

		Utilities::verbalize("&#9760; You cannot access the core directly &#9760;");

		DB::closeConnection();

		Session::stopSession();
		
		die();
	}

/*************************************************************************/

	private function getError() {
		$error = false;
		switch(HTTPResponse::infoHTTPStatus()) {
			case 400:
				$error = array(
					"code" => "400 Bad Request",
					"status" => "danger",
					"desc" => "The request can not be processed due to bad syntax"
				);
			break;

			case 401:
				$error = array(
					"code" => "401 Unauthorized",
					"status" => "danger",
					"desc" => "The request has failed authentication"
				);
			break;

			case 403:
				$error = array(
					"code" => "403 Forbidden",
					"status" => "danger",
					"desc" => "The server refuses to response to the request"
				);
			break;

			case 404:
				$error = array(
					"code" => "404 Not Found",
					"status" => "danger",
					"desc" => "The resource requested can not be found."
				);
			break;

			case 418:
				$error = array(
					"code" => "418 I'm a teapot",
					"status" => "warning",
					"desc" => "You cannot told to a teapot to make you a coffee, fool."
				);
			break;

			case 500:
				$error = array(
					"code" => "500 Internal Server Error",
					"status" => "confuse",
					"desc" => "There was an error which doesn't fit any other error message"
				);
			break;

			case 502:
				$error = array(
					"code" => "502 Bad Gateway",
					"status" => "confuse",
					"desc" => "The server was acting as a proxy and received a bad request."
				);
			break;

			case 504:
				$error = array(
					"code" => "504 Gateway Timeout",
					"status" => "confuse",
					"desc" => "The server was acting as a proxy and the request timed out."
				);
			break;
		}
		return $error;
	}
}

?>