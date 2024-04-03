var responseContent=
    "  <meta charset='UTF-8'>"+
    "<html>"+
    "<style>"+
    "body {text-align: center; backgroun-color: #333; color: #eee;}"+
    "</style>"+
    "<h1>Viñamecum</h1>"+
    "<p>Problemas con la conexión</p>"+
    "</html>";
    

self.addEventListener("fetch",
    function(event){
        //console.log("Fetch request for:", event.request.url);
        event.respondWith(
            fetch(event.request).catch(
                function(){
                    return new Response(
                        responseContent,
                        {headers: {"Content-Type": "text/html"}}
                    );
                }
            )
        );
    }
);