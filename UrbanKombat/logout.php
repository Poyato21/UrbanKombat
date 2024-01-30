<?php
//Inicio del procesamiento
require_once("includes/config.php");

//Doble seguridad: unset + destroy
unset($_SESSION["login"]);
unset($_SESSION["esAdmin"]);
unset($_SESSION["nombre"]);


session_destroy();

$titulo='Logout';
$css = 'index.css';
$contenido=<<<EOS
		<div class="saludo">
		<h1>Hasta pronto!</h1>
		</div>
EOS;
require("includes/plantillas/plantilla.php");