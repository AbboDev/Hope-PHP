<?php

/**
* 
*/
class Component {
	private static $secondary = VERBOSE_COMPONENTS;

	/**
	*	The unique id
	*/
	private $id;

	/**
	*	The path of the component (the part next components/)
	*/
	public $path;

	/**
	*	The file name, without the file extension
	*/
	public $name;

	/**
	*	Determine which role occupied this component
	* 	Default: header, navbar, sidebar, footer, sticky, modal
	*/
	public $isa;

	/**
	*	If its src need to be included in head(1), at the end of the body(2), just after the component(3) or if there is no src(0)
	*/
	public $priority;

	/**
	*	Define the order of the current element if there are another elements with the same isa
	*	if two or more components have the same order they will be rendered respect the order they were inserted in the array
	*/
	public $order;
	
	public function __construct(&$id, $name, $isa = "", $priority = 0, $order = 0, $path = "") {
		$this->id = $id;
		$this->name = $name;
		$this->isa = $isa;
		$this->priority = $priority;
		$this->order = $order;
		$this->path = $path;
		$this->setPath();
		$id++;
	}

	public function getID() {
		return $this->id;
	}

	public function render() {
		if (file_exists($this->path) && !is_dir($this->path)) {
			Utilities::verbalize("Call component: ".$this->name, VERBOSE_VIEWS);
			require($this->path);
		}
	}

	public function setPath() {
		$path_to_comp = PATH_TO_COMPONENTS;
		$file_from_name = Utilities::printExtension($this->name, ".php");
		if ($this->path !== "") {
			if (file_exists($path_to_comp.$this->path.$file_from_name)) {
				Utilities::verbalize("Found file using path", self::$secondary);
				$path_to_comp .= $this->path.$file_from_name;
			}
		} else {
			Utilities::verbalize("No specific path specified", self::$secondary);
			if ($this->isa !== "") {
				$file_from_isa = Utilities::printExtension($this->isa, ".php");
				if (file_exists($path_to_comp.$file_from_isa)) {
					Utilities::verbalize("Found file using ISA", self::$secondary);
					$path_to_comp .= $file_from_isa;
				} elseif (file_exists($path_to_comp.$this->isa) && is_dir($path_to_comp.$this->isa)) {
					Utilities::verbalize("Found directory using ISA", self::$secondary);
					$path_to_comp .= $this->isa."/";
					if (file_exists($path_to_comp.$file_from_name)) {
						Utilities::verbalize("Found file using Name", self::$secondary);
						$path_to_comp .= $file_from_name;
					} elseif (file_exists($path_to_comp.$file_from_isa)) {
						Utilities::verbalize("Found file reusing ISA", self::$secondary);
						$path_to_comp .= $file_from_isa;
					}
				}
			} else {
				Utilities::verbalize("No ISA specified (bad)", self::$secondary);
				if (file_exists($path_to_comp.$file_from_name)) {
					Utilities::verbalize("Found file using NAME", self::$secondary);
					$path_to_comp .= $file_from_name;
				}/* elseif (file_exists($path_to_comp.$this->name)) {
					Utilities::verbalize("Found directory using NAME");
					$path_to_comp .= $this->isa;
				}*/
			}
		}
		Utilities::verbalize("Component path: ".$path_to_comp, self::$secondary);
		$this->path = $path_to_comp;
	}
}

?>