const BASE_URL = "http://localhost/hris-bptik/";

var STATIC_CACHE = "hris-bptik";
var DYNAMIC_CACHE = "dynamic_hris-bptik";
var DATA_CACHE = "data_hris-bptik";
var STATIC_CACHE_URL = [
	BASE_URL + "ErrorHandler/offline",
	BASE_URL + "ErrorHandler/error404",
	BASE_URL + "ErrorHandler/nojs",
	BASE_URL + "ErrorHandler/dev_tools",
	BASE_URL + "plugins/fontawesome-free/css/all.min.css",
	BASE_URL + "dist/css/ionicons.min.css",
	BASE_URL + "plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css",
	BASE_URL + "plugins/icheck-bootstrap/icheck-bootstrap.min.css",
	BASE_URL + "plugins/jqvmap/jqvmap.min.css",
	BASE_URL + "dist/css/adminlte.min.css",
	BASE_URL + "plugins/overlayScrollbars/css/OverlayScrollbars.min.css",
	BASE_URL + "plugins/daterangepicker/daterangepicker.css",
	BASE_URL + "plugins/summernote/summernote-bs4.css",
	BASE_URL + "assets/css/global.css",
	BASE_URL + "plugins/jquery/jquery.min.js",
	BASE_URL + "plugins/bootstrap/js/bootstrap.bundle.min.js",
	BASE_URL + "dist/js/adminlte.js",
	BASE_URL + "assets/js/global.js",
	BASE_URL + "assets/img/loading.svg",
	BASE_URL + "assets/img/user.svg",
	BASE_URL + "assets/img/logo.png",
	"https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700"
];

//install service worker
self.addEventListener("install", event => {
	event.waitUntil(
		caches.open(STATIC_CACHE).then(cache => {
			cache.addAll(STATIC_CACHE_URL);
		})
	);
});

//activate event
self.addEventListener('activate', event => {
	event.waitUntil(
		caches.keys().then(keys => {
			return Promise.all(keys
				.filter(key => key !== STATIC_CACHE && key !== DYNAMIC_CACHE && key !== DATA_CACHE)
				.map(key => caches.delete(key))
			);
		})
	);
});

self.addEventListener('fetch', event => {
	var requestUrl = new URL(event.request.url);

	if (requestUrl.protocol.includes('http')) {
		if (requestUrl.href.includes(BASE_URL + 'Ajax')) {
			console.log(requestUrl.href);
			event.respondWith(
				fetch(event.request).then(fetchRes => {
					return caches.open(DATA_CACHE).then(cache => {
						cache.put(event.request, fetchRes.clone());
						return fetchRes;
					})
				}).catch(() => {
					return caches.match(event.request);
				})
			);
		} else {
			event.respondWith(
				caches.match(event.request).then(cacheRes => {
					return cacheRes || fetch(event.request).then(fetchRes => {
						return caches.open(DYNAMIC_CACHE).then(cache => {
							cache.put(event.request, fetchRes.clone());
							return fetchRes;
						})
					}).catch(() => {
						return caches.match(BASE_URL + 'ErrorHandler/offline')
					});
				})
			);
		}
	}
});
