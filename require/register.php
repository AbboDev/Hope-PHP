<?php

spl_autoload_register(function($class_name) {
	if (file_exists(PATH_TO_CLASSES.$class_name.'.php')) {
		require_once(PATH_TO_CLASSES.$class_name.'.php');
	} else {
		if (file_exists(PATH_TO_USER_CLASS.$class_name.'.php')) {
			require_once(PATH_TO_USER_CLASS.$class_name.'.php');
		} elseif (file_exists(PATH_TO_CONTROLLER.$class_name.'.php')) {
			require_once(PATH_TO_CONTROLLER.$class_name.'.php');
		} elseif (file_exists(PATH_TO_MODEL.$class_name.'.php')) {
			require_once(PATH_TO_MODEL.$class_name.'.php');
		} elseif (file_exists(PATH_TO_FACTORY.$class_name.'.php')) {
			require_once(PATH_TO_FACTORY.$class_name.'.php');
		}
	}
});

register_shutdown_function(function() {
	$error = error_get_last();
	switch ($error['type']) {
		case E_ERROR: // 1 //
			$error['message'] = 'E_ERROR';
			break;
		case E_WARNING: // 2 //
			$error['message'] = 'E_WARNING';
			break;
		case E_PARSE: // 4 //
			$error['message'] = 'E_PARSE';
			break;
		case E_NOTICE: // 8 //
			$error['message'] = 'E_NOTICE';
			break;
		case E_CORE_ERROR: // 16 //
			$error['message'] = 'E_CORE_ERROR';
			break;
		case E_CORE_WARNING: // 32 //
			$error['message'] = 'E_CORE_WARNING';
			break;
		case E_COMPILE_ERROR: // 64 //
			$error['message'] = 'E_COMPILE_ERROR';
			break;
		case E_CORE_WARNING: // 128 //
			$error['message'] = 'E_COMPILE_WARNING';
			break;
		case E_USER_ERROR: // 256 //
			$error['message'] = 'E_USER_ERROR';
			break;
		case E_USER_WARNING: // 512 //
			$error['message'] = 'E_USER_WARNING';
			break;
		case E_USER_NOTICE: // 1024 //
			$error['message'] = 'E_USER_NOTICE';
			break;
		case E_STRICT: // 2048 //
			$error['message'] = 'E_STRICT';
			break;
		case E_RECOVERABLE_ERROR: // 4096 //
			$error['message'] = 'E_RECOVERABLE_ERROR';
			break;
		case E_DEPRECATED: // 8192 //
			$error['message'] = 'E_DEPRECATED';
			break;
		case E_USER_DEPRECATED: // 16384 //
			$error['message'] = 'E_USER_DEPRECATED';
			break;
	}
	if (isset($error['type'])) {
		Router::infoHTTPStatus(500);
	}
});

?>