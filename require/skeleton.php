<?php

/**
* The default structure required by View
*/
Utilities::verbalize("This page require a template", self::$secondary);
$js_utilities = array("scrolling");

?>

<!DOCTYPE html>
<html>
	<head>
	<?php $this->getHead(); ?>
	</head>
	<body>
		<?php $this->stampComponentsByISA("header"); ?>
		<?php $this->stampComponentsByISA("navbar"); ?>

		<main id="wrapper" class="wrapper">
			<?php $this->stampComponentsByISA("sidebar"); ?>
			<?php $this->render(); ?>
		</main>
		<?php $this->stampComponentsByISA("footer"); ?>
		
		<?php $this->stampComponentsByISA("sticky"); ?>
		<?php $this->stampComponentsByISA("modal"); ?>
		<!-- dGhpcyB0ZW1wbGF0ZSBpcyB0b28gc3Bva3k= -->
		<?php foreach ($js_utilities as $key => $name) {
			View::getJSPath("utilities/".$name);
		} ?>
	</body>
</html>
