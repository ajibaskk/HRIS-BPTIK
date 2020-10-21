if ('serviceWorker' in navigator) {
	navigator.serviceWorker.register(base_url + 'service-worker.js').then(() => {
		if (window.location.href === base_url + 'authentication/login') {
			const STATIC_CACHE = "hris-bptik";
			caches.keys().then(keys => {
				return Promise.all(keys
					.filter(key => key !== STATIC_CACHE)
					.map(key => caches.delete(key))
				);
			})
		}
	})
}

var isMobile = {
	Android: function () {
		return navigator.userAgent.match(/Android/i);
	},
	BlackBerry: function () {
		return navigator.userAgent.match(/BlackBerry/i);
	},
	iOS: function () {
		return navigator.userAgent.match(/iPhone|iPad|iPod/i);
	},
	Opera: function () {
		return navigator.userAgent.match(/Opera Mini/i);
	},
	Windows: function () {
		return navigator.userAgent.match(/IEMobile/i) || navigator.userAgent.match(/WPDesktop/i);
	},
	any: function () {
		return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
	}
};

$(document).ready(function () {
	if (!isMobile.any()) {
		$.getScript(
			base_url + "plugins/devtools-detect/devtools-detect.js",
			function () {
				window.addEventListener("devtoolschange", event => {
					if (event.detail.isOpen) {
						window.location.href = base_url + "ErrorHandler/DevTools";
					}
				});
			}
		);
	}

	document.oncontextmenu = function () {
		return false;
	};
	document.onkeydown = function (e) {
		if (event.keyCode === 123) {
			return false;
		}
		if (e.ctrlKey && e.shiftKey && e.keyCode == "I".charCodeAt(0)) {
			return false;
		}
		if (e.ctrlKey && e.shiftKey && e.keyCode == "C".charCodeAt(0)) {
			return false;
		}
		if (e.ctrlKey && e.shiftKey && e.keyCode == "J".charCodeAt(0)) {
			return false;
		}
		if (e.ctrlKey && e.keyCode == "S".charCodeAt(0)) {
			return false;
		}
		if (e.ctrlKey && e.keyCode == "U".charCodeAt(0)) {
			return false;
		}
	};
});

function wait(delay) {
	var start = new Date().getTime();
	while (new Date().getTime() < start + delay);
}

$(window).on("beforeunload", function () {
	if (screen.width <= 768) {
		$(document.body).removeClass("sidebar-open");
		$(document.body).addClass("sidebar-collapse");
		wait(200);
	}
	$("#loading").show();
});

$(window).on("load", function () {
	$("#loading").hide();
});
