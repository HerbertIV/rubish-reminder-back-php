const CACHE_NAME = 'static-cache11112';
const dynamicCacheName = 'dynamicCacheName11112';

let urlsToCache = [
    '/index-offline.html',
    '/offline-scissors.svg',
    'serviceworker.js'
];

self.addEventListener('install', event => {
    event.waitUntil(
        caches.open(CACHE_NAME).then(cache => {
            cache.addAll(urlsToCache);
        })
    );
});

self.addEventListener('activate', event => {
    event.waitUntil(
        caches.keys().then(keys => {
            return Promise.all(keys
                .filter(key => key !== CACHE_NAME)
                .map(key => caches.delete(key))
            );
        })
    );
});

self.addEventListener('fetch', evt => {
    if(evt.request.url.indexOf("generate-hash")  > -1 || evt.request.url.indexOf("api/get-video") > -1 ){
        return true;
    }else{
        evt.respondWith(
            caches.match(evt.request).then(function (resp) {
                return resp || fetch(evt.request).then(function (response) {
                    return caches.open(dynamicCacheName).then(function (cache) {
                        if (response.ok == true) {
                        }
                        return response;
                    });
                });
            }).catch(function () {
                if( evt.request.headers.get("accept").includes("text/html") ) {
                    return caches.match('/index-offline.html');
                }
            })
        );
    }


});
