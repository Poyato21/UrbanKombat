<?php
    require_once("includes/config.php");
    $titulo='Inicio';
    $css="index.css";
    $contenido=<<<EOS
            <div class="contenido">
                <p> <i> UrbanKombat </i> es una aplicación web para compartir tus gustos musicales, 
                dar apoyo a tus artistas favoritos, descubrir música nueva y ponerte al día 
                de las novedades y artistas emergentes. A parte, nuestro mayor objetivo es 
                la difusión de música de artistas emergentes, a base de proporcionar un servicio
                en el que el cliente apoye a un artista y se comparta su música para crecer en 
                la industria musical.
                </p>
            </div>
    EOS;
    if (isset($_SESSION["login"]) && ($_SESSION["login"]===true)){
        if(!isset($_SESSION["esAdmin"])||$_SESSION["esAdmin"] ===false){
            $contenido.=<<<EOS
            <div class="contenido">
                <p>Participa en nuestro sorteo de una tarjeta de Spotify aquí!!!</p>
                <h1><a href="procesarParticipar.php"> <button type="submit" name="sorteo">PARTICIPAR</button> </a></h1>
            </div>
EOS;
        }
    }else{
          $contenido.=<<<EOS
                <div class="contenido">
                    <p>Participa en nuestro sorteo de una tarjeta de Spotify aquí!!!</p>
                    <h1><a href="procesarParticipar.php"> <button type="submit" name="sorteo">PARTICIPAR</button> </a></h1>
                </div>
            EOS;
    }
        
    
    $contenido.=<<<EOS
        <img src="img/logo.jpeg" alt="logotipo UrbanKombat"/>
    EOS;

        

    require 'includes/plantillas/plantilla.php';
?>
