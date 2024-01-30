<?php
require_once 'includes/config.php';
require_once __DIR__.'/includes/Usuario.php';
$contenido = "";
$titulo='Sorteo';
$css="vota.css";

//ya esta
$sql=Usuario::getGanador();
if(!$sql){
    $contenido = $contenido.=<<<EOS
    <h2>NO HAY CONCURSANTES</h2>
    EOS;
}
else{
    $contenido = $contenido.=<<<EOS
    <h2> El ganador ha sido el usuario:</h2>
    <p>$sql</p>
    EOS;
    Usuario::setConcursantes();
}



require 'includes/plantillas/plantilla.php';
?>
