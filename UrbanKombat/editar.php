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
//$css = 'admin.css';
$titulo='Editar';
$contenido='';
// if (isset($_SESSION["esAdmin"]) && $_SESSION["esAdmin"]) {
// 	$contenido.=<<<EOS
// 	<h1>Consola de administración</h1>
// 	EOS;
// } else {
// 	$contenido.=<<<EOS
// 	<div class="noRegMsg">
// 	<h1>Acceso denegado!</h1>
// 	<p>No tienes permisos suficientes para administrar la web.</p>
// 	</div>
// 	EOS;
// }

    /*  EDITAR ALBUM   */
  if (isset($_POST['editarAlbum'])){
    $nombreAlbum =  $_GET['nombre'];
    $album = Album::buscaAlbum($nombreAlbum);
    if(!empty($album)){
      if(empty($comentario = $album->getComentario())) $comentario="";
      formularioEditarAlbum($nombreAlbum, $album->getVotos(), $comentario);
    }
    
  }

      /*  EDITAR CANCION   */

  else if (isset($_POST['editarCancion'])){

    $nombreCancion =  $_GET['nombre'];
    $cancion = Cancion::buscaCancion($nombreCancion);
    if(!empty($cancion)){
      if(empty($comentario = $cancion->getComentario())) $comentario="";
      formularioEditarCancion($nombreCancion, $cancion->getArtista(), $cancion->getDuracion(), $cancion->getVotos(), $comentario);
    }
  }

      /*  EDITAR ARTISTA   */

  else if (isset($_POST['editarArtista'])){
    $nombreArtista =  $_GET['nombre'];
    $artista = Artista::buscaArtista($nombreArtista);
    if(!empty($artista)){
      if(empty($comentario = $artista->getComentario())) $comentario="";
      formularioEditarArtista($nombreArtista, $artista->getVotos(), $comentario);
    }

  }

      /*  EDITAR USUARIO   */

  else if (isset($_POST['editarUsuario'])){
    $nombreUsuario =  $_GET['nombre'];
    $usuario = Usuario::buscaUsuario($nombreUsuario);
    if($usuario->getRol() != "admin"){
      if(!empty($usuario)){
        formularioEditarUsuario($nombreUsuario, $usuario->getNombre(), $usuario->getRol());
      }
    }
    else{
      $contenido.=<<<EOS
	      <p>No puedes cambiar los datos del administrador.</p>
        <p><a class="volver" href="adminUsuarios.php">Volver</a></p>
EOS;
    }
  }
     /*  EDITAR FORO   */
  else if (isset($_POST['editarForo'])){
    $id =  $_GET['idF'];
    $tema = Tema::buscaTema($id);
      if(!empty($tema)){
        formularioEditarTema($id, $tema->getTitulo(),$tema->getFecha(),$tema->getCreador(),$tema->getComentario());
      }
  }
    /*  EDITAR RESPUESTA   */
  else if (isset($_POST['editarRespuesta'])){
    $id =  $_GET['idR'];
    $respuesta = Respuesta::buscaRespuesta($id);
      if(!empty($respuesta)){
        formularioEditarRespuesta($id, $respuesta->getTexto());
      }
  }
  
  function formularioEditarAlbum($nombre, $votos, $comentario){
    $GLOBALS['contenido'].=<<<EOS
    <h3>Editar album</h3>
    <form action="procesarEditar.php?nombreOriginal=$nombre" method="POST">
	<fieldset>
        <legend>Datos album</legend>
           
                <label>Nombre del album:</label> <input type="text" name="nombreAlbum" value ="$nombre"/>
            <br/>
            <label>Votos:</label> <input type="text" name="votosAlbum" value = "$votos"/>
            <br/>
                <label>Comentario:</label> <input type="text" name="comentarioAlbum" value = "$comentario"/>
            <br/><button type="submit" name="editarAlbum">Guardar</button>
		</fieldset>
		</form>
EOS;
  }

  function formularioEditarCancion($nombre, $nombreArtista, $duracion, $votos, $comentario){
    $GLOBALS['contenido'].=<<<EOS
    <h3>Editar canción</h3>
    <form action="procesarEditar.php?nombreOriginal=$nombre" method="POST">
	<fieldset>
        <legend>Datos canción</legend>
           
            <label>Nombre de la canción:</label> <input type="text" name="nombreCancion" value ="$nombre"/>
            <br/>
            <label>Nombre del artista:</label> <input type="text" name="nombreCancion_artista" value ="$nombreArtista"/>
            <br/>
            <label>Duración:</label> <input type="text" name="duracion" value ="$duracion"/>
            <br/>
            <label>Votos:</label> <input type="text" name="votosCancion" value = "$votos"/>
            <br/>
            <label>Comentario:</label> <input type="text" name="comentarioCancion" value = "$comentario"/>
            <br/><button type="submit" name="editarCancion">Guardar</button>
		</fieldset>
		</form>
EOS;
  
  }
  function formularioEditarArtista($nombre, $votos,$comentario){
    $GLOBALS['contenido'].=<<<EOS
    <h3>Editar artista</h3>
    <form action="procesarEditar.php?nombreOriginal=$nombre" method="POST">
	<fieldset>
        <legend>Datos artista</legend>
           
            <label>Nombre del artista:</label> <input type="text" name="nombreArtista" value ="$nombre"/>
            <br/>
            <label>Votos:</label> <input type="text" name="votosArtista" value = "$votos"/>
            <br/>
            <label>Comentario:</label> <input type="text" name="comentarioArtista" value = "$comentario"/>
            <br/><button type="submit" name="editarArtista">Guardar</button>
		</fieldset>
		</form>
EOS;
  }
  function formularioEditarUsuario($nombre, $nombreC, $rol){
    $GLOBALS['contenido'].=<<<EOS
    <h3>Editar usuario</h3>
    <form action="procesarEditar.php?nombreOriginal=$nombre" method="POST">
	<fieldset>
        <legend>Datos usuri@</legend>
           
            <label>Nombre usuario:</label> <input type="text" name="nombreUsuario" value ="$nombre"/>
            <br/>
            <label>Nombre completo:</label> <input type="text" name="nCompletoUsuario"value ="$nombreC" />
            <br/>
            <label>Contraseña:</label> <input type="password" name="passwordUsuario" />
            <br/>
            <label>Rol:</label> <input type="text" name="rol" value="Usuario"value ="$rol"/>
            
            <br/><button type="submit" name="editarUsuario">Guardar</button>
		</fieldset>
		</form>
EOS;
  }

  function formularioEditarTema($id,$titulo,$fecha,$creador,$comentario){
    $GLOBALS['contenido'].=<<<EOS
    <h3>Editar tema</h3>
    <form action="procesarEditar.php?idF=$id" method="POST">
	<fieldset>
        <legend>Datos respuesta</legend>
            <label>Titulo:</label> <input type="text" name="ntitulo" value ="$titulo"/>
            <br/>
            <label>Fecha:</label> <input type="text" name="fecha" value ="$fecha"/>
            <br/>
            <label>Creador:</label> <input type="text" name="creador" value ="$creador"/>
            <br/>
            <label>Comentario:</label> <input type="text" name="textoRespuesta" value ="$comentario"/>
            <br/>
            <br/><button type="submit" name="editarForo">Guardar</button>
		</fieldset>
		</form>
EOS;
  }

  function formularioEditarRespuesta($idRespuesta, $texto){
    $GLOBALS['contenido'].=<<<EOS
    <h3>Editar respuesta</h3>
    <form action="procesarEditar.php?idR=$idRespuesta" method="POST">
	<fieldset>
        <legend>Datos respuesta</legend>
           
            <label>Comentario:</label> <input type="text" name="textoRespuesta" value ="$texto"/>
            <br/>
            <br/><button type="submit" name="editarRespuesta">Guardar</button>
		</fieldset>
		</form>
EOS;
  }

require __DIR__.'/includes/plantillas/plantilla.php';

?>
