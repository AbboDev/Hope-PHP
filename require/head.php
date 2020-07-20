<?php if (RETRO_COMPATIBILY) { ?>
<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<![endif]-->
<?php } ?>

<?php /*if (RETRO_COMPATIBILY) { ?>
<meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-1"<?php Utilities::printFinalSlash(); ?>> 
<?php } else {*/ ?>
<meta charset="utf-8"<?php Utilities::printFinalSlash(); ?>>
<?php //} ?>
<meta name="viewport" content="width=device-width, initial-scale=1.0"<?php Utilities::printFinalSlash(); ?>>
<meta name="generator" content="HopePHP Framework">
<base href="http://<?php echo SERVER_NAME; ?>"<?php Utilities::printFinalSlash(); ?>>

<!-- SEO { -->
<?php Utilities::printCurrentPageTitle(); ?>
<?php Utilities::printFavicon('favicon', 'png', '256x256'); ?>
<meta name="application-name" content="<?php echo SITE_NAME; ?>"<?php Utilities::printFinalSlash(); ?>>
<meta name="description" content="<?php echo SITE_DESCRIPTION; ?>"<?php Utilities::printFinalSlash(); ?>>
<meta name="keywords" content="<?php echo KEYWORDS; ?>"<?php Utilities::printFinalSlash(); ?>>
<meta name="author" content="<?php echo AUTHOR_NAME; ?>"<?php Utilities::printFinalSlash(); ?>>
<!-- } SEO -->

<!-- STYLESHEET { -->
<?php
$styles = explode(";", DEFAULT_STYLES);
foreach ($styles as $style) {
	View::getCSSPath($style);
}
View::getIconsStylesheet();
$this->stampSrcByPriority(1);
?>
<!-- } STYLESHEET -->