<?php

//Inicio del procesamiento
require_once("includes/config.php");
require_once __DIR__.'/includes/Album.php';
require_once __DIR__.'/includes/Cancion.php';
require_once __DIR__.'/includes/Artista.php';
require_once __DIR__.'/includes/Usuario.php';
require_once __DIR__.'/includes/Respuesta.php';
require_once __DIR__.'/includes/Tema.php';



$conn = $app->conexionBD();
$css = 'admin.css';
$titulo='Eliminar';
$contenido='';

if (isset($_SESSION["esAdmin"]) && $_SESSION["esAdmin"]) {
	$contenido.=<<<EOS
	<h1>Consola de administración</h1>
	EOS;

    /*  ELIMINAR ALBUM   */

  if (isset($_POST['eliminarAlbum'])){
    $nombre = $_GET['nombre'];
    Album::borrarAlbum($nombre);
    header("Location: adminAlbumes.php");
  }

      /*  ELIMINAR CANCION   */

  else if (isset($_POST['eliminarCancion'])){
    $nombre = $_GET['nombre'];
    Cancion::borrarCancion($nombre);
    header("Location: adminCanciones.php");
  }

      /*  ELIMINAR ARTISTA   */

  else if (isset($_POST['eliminarArtista'])){
    $nombre = $_GET['nombre'];
    Artista::borrarArtista($nombre);
    header("Location: adminArtistas.php");
  }

    /*  ELIMINAR TEMA FORO   */

  else if (isset($_POST['eliminarForo'])){
    $idF = $_GET['idF'];
    Tema::borrarTema($idF);
    header("Location: adminForo.php");
  }

    /*  ELIMINAR USUARIO   */

  else if (isset($_POST['eliminarUsuario'])){
    $idU = $_GET['idU'];
    $thisId = Usuario::buscaUsuario($_SESSION['nombreUsuario']);
    // Nos aseguramos de que no borramos nuestro usuario
    if($idU != $thisId->getId())
      Usuario::borraPorId($idU);
    
    header("Location: adminUsuarios.php");
  }

  
}

     /*  ELIMINAR RESPUESTA   */

     else if (isset($_POST['eliminarRespuesta'])){
      $idRespuesta = $_GET['idR'];
      $respuesta = Respuesta::buscaRespuesta($idRespuesta);
      $idTema = $respuesta->getId_tema();
      Respuesta::borrarRespuesta($idRespuesta);
      Tema::modificarNumeroRespuestas($idTema, -1);
   
        header("Location: verTema.php?id=$idTema");
    }
  
 else {
	$contenido.=<<<EOS
	<div class="noRegMsg">
	<h1>Acceso denegado!</h1>
	<p>No tienes permisos suficientes para administrar la web.</p>
	</div>
	EOS;
}


require __DIR__.'/includes/plantillas/plantilla.php';





