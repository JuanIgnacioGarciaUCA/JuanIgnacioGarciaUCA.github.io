var CACHE_NAME="vm-cache-v9";
var CACHED_URLS=["index-offline.php","portada.jpg",
    "Akinator/datos.xlsx", "Akinator/index.php",
    "Akinator/funciones.js"];

var responseContent=
    "<meta charset='UTF-8'>"+
    "<html>"+
    "<style>"+
    "body {text-align: center; backgroun-color: #333; color: #eee;}"+
    "</style>"+
    "<h1>Viñamecum</h1>"+
    "<p>Problemas con la conexión</p>"+
    "</html>";

self.addEventListener("fetch",
    function(event){
        event.respondWith(
            fetch(event.request).catch(
                function(){
                    return caches.match(event.request).then(
                        function(response){
                            if(response){
                                return response;
                            }else if(event.request.headers.get("accept").includes("text/html")){
                                return caches.match("index-offline.php");
                            }
                        });
                })
        );

    }
);

self.addEventListener("install",
    function(event){
        event.waitUntil(
            caches.open(CACHE_NAME).then(
                function(cache){
                    //return cache.add("index-offline.html");
                    return cache.addAll(CACHED_URLS);
                }
            )
        );
        
    }
);

self.addEventListener("activate",
    function(event){
        event.waitUntil(
            caches.keys().then(
                function(cacheNames){
                    return Promise.all(
                        cacheNames.map(
                            function(cacheName){
                                if(CACHE_NAME!==cacheName && 
                                cacheName.startsWith("vm-cache")){
                                    return caches.delete(cacheName);
                                }
                            }
                        )
                    );
                }
            )
        );
    }
);

self.addEventListener("push",
    function(){
        event.waitUntil(
            fetch("/update").then(
                function(response){
                    return self.registration.showNotification(response.text());
                }
            )
        );
    }
);
