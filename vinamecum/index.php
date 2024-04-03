<!DOCTYPE html>
<meta charset="UTF-8">
<link rel="manifest" href="manifest.json">
<meta name="theme-color" content="#4287f5"/>
<link rel="apple-touch-icon" sizes="192x192" href="img/app-icon-192.png">
<link rel="icon" type="image/png" href="img/app-icon-192.png">


<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">


</style>
<title>Viñamecum</title>

<?php include "menu.php"; ?>

<div 
style="background-color:#FFFFE0;" 
class="w3-container">

<h1>¿Qué es Viñamecum?</h1>
<p>Viñamecum es una aplicación diseñada para teléfonos móviles y tablets, que contiene las nociones o informaciones fundamentales de las plagas y enfermedades de la vid, surge con la necesidad de disponer de un soporte técnico de trabajo en campo. </p>

<p>El usuario recibe un diagnóstico fiable sobre los daños y síntomas en la vid, con la información sobre las plagas y enfermedades más representativas en España, además de recomendaciones de medidas que pueden llevarse a cabo para su control y erradicación. 
A través de un sencillo método interactivo el propio usuario puede reconocer las plagas o enfermedades en su viña.</p>

<p>El método seguido es la Lucha Integrada, en la que se recomienda emplear prácticas culturales, enemigos naturales y/o productos químicos con el fin de llevar un control racional y eficaz en el viñedo.</p>

<p>Las prácticas culturales son de un gran peso en el manejo sanitario del viñedo. Se detallan consejos como podas en verde, manejo del suelo, etc.</p>

<p>La mayoría de las plagas tiene varios enemigos naturales, para cada una se detallan tanto parásitos entomófagos, como depredadores o patógenos específicos.</p>

<p>Los productos químicos fitosanitarios son los recomendados por el Ministerio de Agricultura y Pesca, Alimentación y Medio Ambiente. En cada apartado se dispone de un enlace a una base de datos que se actualiza periódicamente, todos ellos autorizados e inscritos en el Registro.</p>

<p>Hanael Maciá</p>

<img src="portada.jpg" class="w3-image">

<p>

</div>


<!-- Save  to: https://www.w3schools.com/code/tryit.asp?filename=FRMMLCI0INUG -->

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-140730271-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-140730271-1');
</script>

<script>
if("serviceWorker" in navigator){
    navigator.serviceWorker.register("serviceworkerVinamecum.js")
        .then(function(registration){
            console.log("Service Worker registrered with scope:",registration.scope);
        }).catch(function(err){
            console.log("Service worker registration failed",err);
        });
}


////////////////////////
// Instalación de pwa //
////////////////////////
// variable donde guardamos la pregunta para instalar la pwa
var deferredPrompt=null;
// función para instalar pwa
function installApp() {
    deferredPrompt.prompt();
    deferredPrompt.userChoice
        .then((choiceResult) => {
            if (choiceResult.outcome === 'accepted') {
                console.log('PWA setup accepted');
                document.getElementById('idOpcionInstalar').style.display = "none";
            } else {
                console.log('PWA setup rejected');
            }
            deferredPrompt = null;
        });
}
// comprobación de que la aplicación está instalada
// si no lo está, guarda la ventana de la pregunta en deferredPrompt
console.log("añadiendo listener beforeinstallprompt");
window.addEventListener('beforeinstallprompt', (e) => {
    console.log("aplicación no instalada");
    e.preventDefault();
    deferredPrompt = e;
    console.log("deferredPrompt ya no es null, "+deferredPrompt);
});
console.log("añadiendo listener aappinstalled");
window.addEventListener('appinstalled', (evt) => {
    console.log("app ya instalada fired", evt);
    document.getElementById('idOpcionInstalar').style.display = "none";
});
////////////////////////
</script>
