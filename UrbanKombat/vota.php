<?php
    require_once 'includes/config.php';
    $titulo="Votacion";
    $css="vota.css";
    $contenido=<<<EOS
    <div id="vota">
        <p> Elige a tu artista, canción o album favorito </p>
        <a id="artista" href="artistas.php"> ARTISTA </a> 
        <a id="cancion" href="canciones.php"> CANCIÓN </a> 
        <a id="album" href="albumes.php"> ALBUM </a> 
    </div>
EOS;
require 'includes/plantillas/plantilla.php';
?>