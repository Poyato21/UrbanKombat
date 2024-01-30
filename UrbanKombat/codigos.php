<?php 
require_once("includes/config.php");
require_once __DIR__.'/includes/Usuario.php';
$titulo='MIS CÓDIGOS COMPRADOS';
$css='codigos.css';
$codYT=Usuario::getTarjetaYT($_SESSION['nombreUsuario']);
$codSpoti=Usuario::getTarjetaSpoti($_SESSION['nombreUsuario']);
$codApple=Usuario::getTarjetaApple($_SESSION['nombreUsuario']);
$contenido=<<<EOF
    <h2> CÓDIGOS COMPRADOS Y ACTIVOS </h2>
    <div class="codes" id="spoti"> <p> Spotify</p> <p>$codSpoti</p> </div>
    <div class="codes" id="apple"> <p> Apple Music</p> <p>$codApple</p> </div>
    <div class="codes" id="yt"> <p>Youtube</p> <p>$codYT</p> </div>
EOF;
require 'includes/plantillas/plantilla.php';
?>