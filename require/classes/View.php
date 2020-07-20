<?php
/**
* 
*/
class View {
	private static $secondary = VERBOSE_VIEWS;

	public $view;
	public $index = 0;
	private $storage;
	private $components;

	public function __construct($view, $components = array(), $storage = array()) {
		$this->view = PATH_TO_VIEWS.$view;
		if (strpos($this->view, ".php") === false) {
			$this->view .= ".php";
		}
		$this->components = $components;
		$this->storage = $storage;
	}

	public function pushToStorage($element, $name = "") {
		if ($name === "") {
			array_push($this->storage, $element);
		} else {
			$this->storage[$name] = $element;
		}
	}

	public function askToStorage($name) {
		if (array_key_exists($name, $this->storage)) {
			return $this->storage[$name];
		}
		return false;
	}

	public function pushToComponents($component) {
		array_push($this->components, $component);
	}

	// public function askToComponents($id) {
	// 	if (array_key_exists($name, $this->storage)) {
	// 		return $this->storage[$name];
	// 	}
	// 	return false;
	// }

	public function renderUsingTemplate() {
		require_once(DEFAULT_TEMPLATE);
	}

	public function render() {
		require($this->view);
	}
	
	public function requireComponentsSources($type) {
		foreach ($this->components as $id => $component) {
			switch (strtolower($type)) {
				case 'css':
					self::getCSSPath("");
					break;
				case 'js':
					self::getJSPath("");
					break;
			}
		}
	}

	public function requireComponentsCSS() {
		return $this->requireComponentsSources("css");
	}

	public function requireComponentsJS() {
		return $this->requireComponentsSources("js");
	}

	public function stampComponentsByISA($isa) {
		foreach ($this->components as $id => $component) {
			if ($component->isa === $isa) {
				$component->render();
			}
		}
	}

	public function stampComponentById($id) {
		if (array_key_exists($id, $this->components)) {
			$component = $this->components[$id];
			$component->render();
		}
	}

	public function getHead() {
		if (HEAD_OF_PAGE !== null) {
			require(HEAD_OF_PAGE);
			return true;
		}
		return false;
	}

	public function stampSrcByPriority($priority) {
		foreach ($this->components as $key => $component) {
			if ($priority === 1) {
				self::printCSS($component->path);
			}
			if ($component->priority === $priority) {
				self::printJS($component->path);
			}
		}
	}

/***********************************************************************/

	public static function printCSS($href) {
		echo "<link rel=\"stylesheet\"";
		if (RETRO_COMPATIBILY) {
			echo " type=\"text/css\"";
		}
		echo " href=\"".$href."\">";
	}

	public static function getCSSPath($css) {
		self::printCSS(PATH_TO_VIEWS.PATH_TO_CSS."/".$css.".css");
	}

	public static function getIconsStylesheet($icons = "") {
		$href = "";
		switch (strtolower($icons)) {
			case 'glyphicon':
				$href = "https://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css";
				break;
			case 'material-design-icons':
				$href = "https://fonts.googleapis.com/icon?family=Material+Icons";
				break;
			default: //case 'font-awesome':
				$href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css";
				break;
		}
		self::printCSS($href);
	}
	
/***********************************************************************/

	public static function printJS($src) {
		echo "<script ";
		if (RETRO_COMPATIBILY) {
			echo " type=\"text/javascript\"";
		}
		echo " src=\"".$src."\">";
		echo "</script>";
	}

	public static function getJSPath($js) {
		self::printJS(PATH_TO_VIEWS.PATH_TO_JS."/".$js.".js");
	}
}

?>