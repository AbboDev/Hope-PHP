<nav id="navbar-primary" class="navbar">
	<div class="container container--light-gray container--full container--flat">
		<ul class="menu menu--light-gray">
			<li class="menu__item">
				<a class="menu__item__link<?php if (Router::getCurrentUri(false) === "home" || Router::getCurrentUri(false) === "") { ?> menu__item__link--active<?php } ?>" href="home">
					HOME
				</a>
			</li>
			<li class="menu__item">
				<a class="menu__item__link<?php if (Router::getCurrentUri(false) === "demo/colors") { ?> menu__item__link--active<?php } ?>" href="demo/colors">
					COLORS
				</a>
			</li>
			<li class="menu__item">
				<a class="menu__item__link<?php if (Router::getCurrentUri(false) === "demo/columns") { ?> menu__item__link--active<?php } ?>" href="demo/columns">
					COLUMNS
				</a>
			</li>
			<li class="menu__item">
				<a class="menu__item__link<?php if (Router::getCurrentUri(false) === "test") { ?> menu__item__link--active<?php } ?>" href="test">
					TEST&nbsp;ROOM
				</a>
			</li>
		</ul>
	</div>
</nav>