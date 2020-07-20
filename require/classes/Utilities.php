<?php

/**
* 
*/
class Utilities {

	public static function verbalize($string, $secondary = true) {
		if (VERBOSE && $secondary) {
			$br = "<br";
			if (RETRO_COMPATIBILY) {
				$br .= " /";
			}
			echo $string.$br.">";
		}
	}

	public static function verbalizeAll($string = "", $secondary = true) {
		if (VERBOSE && $secondary) {
			echo "<pre>";
			print_r($string);
			echo "</pre>";
		}
	}

	public static function printTag($tag_name, $text = false, $attr = null, $verbose = VERBOSE_TAG) {
		if ($verbose) {
			echo self::makeTag($tag_name, $text, $attr);
		}
	}

	public static function makeTag($tag_name, $text = false, $attr = null) {
		$tag = "<".$tag_name;
		if ($attr !== null && is_array($attr)) {
			foreach ($attr as $name => $value) {
				$tag .= " ".$name."='".$value."'";
			}
		}
		if (gettype($text) === "string") {
			$tag .= ">".$text;
			$tag .= "</".$tag_name;
		} elseif ($text === true) {
			self::printFinalSlash($tag);
		}
		$tag .= ">";
		return $tag;
	}



	public static function printFinalSlash(&$text = "") {
		if (RETRO_COMPATIBILY) {
			if (isset($text)) {
				$text .= " /";
			} else {
				echo " /";
			}
		}
	}

	public static function printCurrentPageTitle($title_page = "") {
		$output = "<title>";
		if ($title_page != "") {
			$output .= $title_page.SEPARATOR;
		}
		$output .= SITE_NAME."</title>";
		echo $output;
	}

	public static function printFavicon($img_name, $ext = "png", $format = "") {
		$output = "<link rel='icon' type='image/".$ext."' href='".PATH_TO_FAVICON.$img_name;
		if ($format != "") {
			$output .= "-".$format;
		}
		$output .= ".".$ext.self::printFinalSlash()."'>";
		echo $output;
	}

	public static function isAssoc($array) {
		return array_keys($array) !== range(0, count($array) - 1);
	}

	public static function isFunction($f) {
		return (is_string($f) && function_exists($f)) || (is_object($f) && ($f instanceof Closure));
	}

	public static function printExtension($file, $ext = "php") {
		if (strpos($ext, (".")) === false) {
			$ext = ".".$ext;
		}
		if (strpos($file, ($ext)) === false) {
			$file .= $ext;
		}
		return $file;
	}

	public static function isThisClass($self, $class) {
		return (get_class($self) === $class);
	}
}

?>