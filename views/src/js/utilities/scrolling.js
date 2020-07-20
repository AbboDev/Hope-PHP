(function() {
	"use strict";

	var sharp = "#";

	var links = document.getElementsByTagName('a');

	for (var i = links.length - 1; i >= 0; i--) {
		var hrefId = links[i].getAttribute('href').split(sharp)[1];

		if (hrefId !== undefined) {
			links[i].addEventListener('click', function(evt) {
				evt.preventDefault();

				var id = this.getAttribute('href').split(sharp)[1];
				var posY = document.getElementById(id).offsetTop;
				var space = posY / 100;

				var doc = document.documentElement;
				var top = (window.pageYOffset || doc.scrollTop) - (doc.clientTop || 0);

				if (top > posY) {
					space = -space;
				}

				scrollTo(posY, space);
			});
		}
	}

	function scrollTo(posY, speed) {
		var doc = document.documentElement;

		window.scrollBy(0, speed);

		var top = (window.pageYOffset || doc.scrollTop) - (doc.clientTop || 0);

		if ((speed < 0 && (top + speed) < posY) || (speed > 0 && (top + speed) > posY)) {
			return;
		}

		if (top <= 0 || top >= (doc.offsetHeight - window.innerHeight)) {
			return;
		}

		setTimeout(function() {
			scrollTo(posY, speed);
		}, 10);
	}
})();