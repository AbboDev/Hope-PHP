<?php

$colors_name = array(
	'black','white','primary','secondary','element','dark-gray','gray','light-gray','danger','warning','info','success','confuse','red','yellow','blue','green','purple','cyan','fuchsia','orange','magenta','techno-cyano','deep-purple','electric-blue','neon-green','fluo-purple','cyber-orange','cheddar','wine','beer','dirt','beige','rss','facebook','twitter','instagram','linkedin','telegram','youtube','askfm','github','gitlab','android','php','js'
);
$first = true;

?>
<div class="main main--full">
	<?php foreach ($colors_name as $key) { ?>
	<section id="<?php echo $key; ?>" style="height: 100vh; overflow-y: scroll; <?php if (!$first) { ?>display: none;<?php } else { $first = false; } ?>">
		<div class="container <?php if ($key == "white") echo "container--black"; ?>" style="">
			<span><?php echo strtoupper($key); ?></span>
			<div class="box box--<?php echo $key; ?>">
				<span>TEST BOX <?php echo strtoupper($key); ?></span>
			</div>
			<hr class="hr--<?php echo $key; ?>" />
			<div class="box box--<?php echo $key; ?> box--rounded">
				<span>TEST ROUNDED BOX <?php echo strtoupper($key); ?></span>
			</div>
			<div class="box box--<?php echo $key; ?> box--bordered">
				<span>TEST BORDERED BOX <?php echo strtoupper($key); ?></span>
			</div>
			<div class="box box--<?php echo $key; ?> box--information">
				<span>TEXT INFORMATION <?php echo strtoupper($key); ?></span>
			</div>
			<div class="box box--<?php echo $key; ?> box--message">
				<span>TEXT MESSAGE BOX <?php echo strtoupper($key); ?></span>
			</div>
			<hr class="hr--<?php echo $key; ?>" />
			<div class="box box--<?php echo $key; ?> box--bordered box--rounded">
				<span>TEST BORDERED&ROUNDED BOX <?php echo strtoupper($key); ?></span>
			</div>
			<div class="box box--<?php echo $key; ?> box--information box--rounded">
				<span>TEXT INFORMATION&ROUNDED <?php echo strtoupper($key); ?></span>
			</div>
			<div class="box box--<?php echo $key; ?> box--message box--rounded">
				<span>TEXT MESSAGE&ROUNDED BOX <?php echo strtoupper($key); ?></span>
			</div>
			<hr class="hr--<?php echo $key; ?>" />
			<div class="box box--<?php echo $key; ?> box--rounded box--bordered">
				<span>TEST ROUNDED&BORDERED BOX <?php echo strtoupper($key); ?></span>
			</div>
			<div class="box box--<?php echo $key; ?> box--information box--bordered">
				<span>TEXT INFORMATION&BORDERED <?php echo strtoupper($key); ?></span>
			</div>
			<div class="box box--<?php echo $key; ?> box--message box--bordered">
				<span>TEXT MESSAGE&BORDERED BOX <?php echo strtoupper($key); ?></span>
			</div>
			<hr class="hr--<?php echo $key; ?>" />
			<div class="box box--<?php echo $key; ?> box--rounded box--information">
				<span>TEST ROUNDED&INFORMATION BOX <?php echo strtoupper($key); ?></span>
			</div>
			<div class="box box--<?php echo $key; ?> box--bordered box--information">
				<span>TEXT BORDERED&INFORMATION <?php echo strtoupper($key); ?></span>
			</div>
			<div class="box box--<?php echo $key; ?> box--message box--information">
				<span>TEXT MESSAGE&INFORMATION BOX <?php echo strtoupper($key); ?></span>
			</div>
			<hr class="hr--<?php echo $key; ?>" />
			<div class="box box--<?php echo $key; ?> box--rounded box--message">
				<span>TEST ROUNDED&MESSAGE BOX <?php echo strtoupper($key); ?></span>
			</div>
			<div class="box box--<?php echo $key; ?> box--bordered box--message">
				<span>TEXT BORDERED&MESSAGE <?php echo strtoupper($key); ?></span>
			</div>
			<div class="box box--<?php echo $key; ?> box--information box--message">
				<span>TEXT INFORMATION&MESSAGE BOX <?php echo strtoupper($key); ?></span>
			</div>
			<hr class="hr--<?php echo $key; ?>" />
			<button class="button button--<?php echo $key; ?>">
				TEST BUTTON <?php echo strtoupper($key); ?>
			</button>
			<br />
			<br />
			<a href="<?php Router::printSelf(); ?>#<?php echo $key; ?>" class="button button--<?php echo $key; ?> button--bordered">
				TEST BORDERED LINK <?php echo strtoupper($key); ?>
			</a>
			<br />
			<br />
			<input type="button" class="button button--<?php echo $key; ?> button--bordered button--rounded" value="TEST BORDERED&ROUNDED INPUT <?php echo strtoupper($key); ?>" />
			<br />
			<br />
			<input type="submit" class="button button--<?php echo $key; ?> button--bordered button--empty" value="TEST EMPTY INPUT <?php echo strtoupper($key); ?>" />
			<br />
			<br />
			<span class="text--<?php echo $key; ?>">
				TEXT EXAMPLE OF <?php echo strtoupper($key); ?>
			</span>
			<br />
			<br />
			<div class="container container--<?php echo $key; ?>">
				<span>
					TEST CONTAINER <?php echo strtoupper($key); ?>
				</span>
			</div>
			<br />
			<br />
			<ul class="menu menu--<?php echo $key; ?>">
				<li class="menu__item">
					<a class="menu__item__link menu__item__link--active" href="<?php Router::printSelf(); ?>#<?php echo $key; ?>">1</a>
				</li><?php
				?><li class="menu__item">
					<a class="menu__item__link" href="<?php Router::printSelf(); ?>#<?php echo $key; ?>">2</a>
				</li><?php
				?><li class="menu__item">
					<a class="menu__item__link" href="<?php Router::printSelf(); ?>#<?php echo $key; ?>">3</a>
				</li>
			</ul>
			<br />
			<br />
			<ul class="menu menu--<?php echo $key; ?> menu--vertical">
				<li class="menu__item">
					<a class="menu__item__link menu__item__link--active" href="<?php Router::printSelf(); ?>#<?php echo $key; ?>">1</a>
				</li><?php
				?><li class="menu__item">
					<a class="menu__item__link" href="<?php Router::printSelf(); ?>#<?php echo $key; ?>">2</a>
				</li><?php
				?><li class="menu__item">
					<a class="menu__item__link" href="<?php Router::printSelf(); ?>#<?php echo $key; ?>">3</a>
				</li>
			</ul>
		</div>
	</section>
	<?php } ?>
	<button id="btn-left" class="button" style="position: absolute; top: 50%; transform: translateY(-50%); left: 0;">
		&#8592;
	</button>
	<button id="btn-right" class="button" style="position: absolute; top: 50%; transform: translateY(-50%); right: 0;">
		&#8594;
	</button>
</div>
<script type="text/javascript">
	(function() {
		"use strict";

		//Var
		var index = 0;

		//ID
		var btnLeft = document.getElementById('btn-left');
		var btnRight = document.getElementById('btn-right');

		//TAG
		var sections = document.getElementsByTagName('section');

		btnLeft.addEventListener('click', function() {
			if (index > 0) {
				sections[index].style.display = "none";
				--index;
				sections[index].style.display = "block";
			}
		});
		btnRight.addEventListener('click', function() {
			if (index < sections.length-1) {
				sections[index].style.display = "none";
				++index;
				sections[index].style.display = "block";
			}
		});

		function changeSection() {

		}
	})();
</script>