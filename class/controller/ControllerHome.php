<?php

/**
*
*/
class ControllerHome extends Controller {
	public function home() {
		$view = new View("home");
		$view->pushToComponents(new Component($view->index, "header", "header", 1));
		$view->pushToComponents(new Component($view->index, "footer", "footer"));
		$view->pushToComponents(new Component($view->index, "navbar", "navbar"));
		$view->pushToComponents(new Component($view->index, "sidebar", "sidebar"));
		$view->renderUsingTemplate();
	}
	
	public function colors() {
		$view = new View("colors");
		$view->pushToComponents(new Component($view->index, "header", "header", 1));
		$view->pushToComponents(new Component($view->index, "footer", "footer"));
		$view->pushToComponents(new Component($view->index, "navbar", "navbar"));
		$view->renderUsingTemplate();
	}

	public function columns() {
		$view = new View("columns");
		$view->pushToComponents(new Component($view->index, "header", "header", 1));
		$view->pushToComponents(new Component($view->index, "footer", "footer"));
		$view->pushToComponents(new Component($view->index, "navbar", "navbar"));
		$view->renderUsingTemplate();
	}

	public function router() {
		$view = new View("router");
		$view->pushToComponents(new Component($view->index, "header", "header", 1));
		$view->pushToComponents(new Component($view->index, "footer", "footer"));
		$view->pushToComponents(new Component($view->index, "navbar", "navbar"));
		$view->pushToComponents(new Component($view->index, "sidebar", "sidebar"));
		$view->renderUsingTemplate();
	}

	public function testRoom() {
	Utilities::verbalize("Global test room:");
	Utilities::printTag("div",
		Utilities::makeTag("a", "HOME", array("href" => "home")).
		Utilities::makeTag("br", true).
		Utilities::makeTag("a", "COLORS", array("href" => "demo/colors")).
		Utilities::makeTag("br", true).
		Utilities::makeTag("a", "COLUMNS", array("href" => "demo/columns")).
		Utilities::makeTag("br", true).
		Utilities::makeTag("a", "TEST ROOM", array("href" => "test")).
		Utilities::makeTag("br", true),
	array("style" => "border: 3px solid purple; margin-bottom: 10px;"), true);

	echo "<table style='border: 1px solid black; width: 100%;'>";
	foreach ($GLOBALS as $name => $global) {
		if ($name === "GLOBALS") {
			break;
		}
		Utilities::printTag("tr",
			Utilities::makeTag("td", $name, array("style" => "border: 2px solid green", "colspan" => "2")),
		NULL, true);
		if (empty($global)) {
			Utilities::printTag("tr",
				Utilities::makeTag("td", "no value found", array("style" => "border: 1px solid red", "colspan" => "2")),
			NULL, true);
		} else {
			foreach ($global as $key => $value) {
				Utilities::printTag("tr",
					Utilities::makeTag("td", $key, array("style" => "border: 1px solid black")).
					Utilities::makeTag("td", $value, array("style" => "border: 1px solid black")),
				NULL, true);
			}
		}
	}
	echo "</table>";
}
}

?>