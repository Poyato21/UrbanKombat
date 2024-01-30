<?php
require_once 'includes/config.php';
require_once __DIR__.'/includes/Usuario.php';
$contenido = "";
$titulo='Sorteo';
$css="vota.css";

if (isset($_SESSION["login"]) && ($_SESSION["login"]===true)) {
    if(Usuario::getConcurso($_SESSION['nombreUsuario'])){
        $contenido .= <<<EOS
        <p class="noRegMsg"> Ya estás dentro del concurso </p>
        EOS; 
    }else{
        Usuario::setConcurso($_SESSION['nombreUsuario']);
        $contenido.=<<<EOS
        <h2> Gracias por participar y buena suerte</h2>
        EOS;
       
      
    }

}else{
    $contenido.=<<<EOS
        <p class="noRegMsg"> No puedes participar porque no estás registrado<br>
        Usuario desconocido. <a href='login.php'>Inicie sesión</a> o
        <a href='registro.php'>registrese</a> para participar en el sorteo. </p>
    EOS;
}





require 'includes/plantillas/plantilla.php';
?> 