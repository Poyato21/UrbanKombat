<?php

//Inicio del procesamiento
require_once("includes/config.php");
require_once __DIR__.'/includes/Album.php';
require_once __DIR__.'/includes/Cancion.php';
require_once __DIR__.'/includes/Artista.php';
require_once __DIR__.'/includes/Usuario.php';
require_once __DIR__.'/includes/Tema.php';



$conn = $app->conexionBD();
//$css = 'admin.css';
$titulo='Añadir';
$contenido='';
if (isset($_SESSION["esAdmin"]) && $_SESSION["esAdmin"]) {
	$contenido.=<<<EOS
	<h1>Consola de administración</h1>
	EOS;
} else {
	$contenido.=<<<EOS
	<div class="noRegMsg">
	<h1>Acceso denegado!</h1>
	<p>No tienes permisos suficientes para administrar la web.</p>
	</div>
	EOS;
}


  if (isset($_POST['añadirAlbum'])){
    formularioAñadirAlbum();
  }
  else if (isset($_POST['añadirCancion'])){
    formularioAñadirCancion();
  }
  else if (isset($_POST['añadirArtista'])){
    formularioAñadirArtista();

  }
  else if (isset($_POST['añadirUsuario'])){
    formularioAñadirUsuario();
  }
  else if (isset($_POST['añadirTema'])){
    formularioAñadirTema();
  }
  
  function formularioAñadirAlbum(){
    //nombre, votos, esGanador, comentarios
    $GLOBALS['contenido'].=<<<EOS
    <h3>Añadir album</h3>
    <form action="procesarAniadir.php" method="POST">
	<fieldset>
        <legend>Datos nuevo album</legend>
           
                <label>Nombre del album:</label> <input type="text" name="nombreAlbum" />
            <br/>
                <label>Comentario:</label> <input type="text" name="comentarioAlbum" />
            <br/><button type="submit" name="insertarAlbum">Añadir</button>
		</fieldset>
		</form>
EOS;
  }

  function formularioAñadirCancion(){
    //nombre, votos, esGanador, comentarios
    $GLOBALS['contenido'].=<<<EOS
    <h3>Añadir canción</h3>
    <form action="procesarAniadir.php" method="POST">
	<fieldset>
        <legend>Datos nueva canción</legend>
           
            <label>Nombre de la canción:</label> <input type="text" name="nombreCancion" />
            <br/>
            <label>Nombre del artista:</label> <input type="text" name="nombreCancion_artista" />
            <br/>
            <label>Duración:</label> <input type="text" name="duracion" />
            <br/>
            <label>Comentario:</label> <input type="text" name="comentarioCancion" />
            <br/><button type="submit" name="insertarCancion">Añadir</button>
		</fieldset>
		</form>
EOS;
  
  }
  function formularioAñadirArtista(){
    //nombre, votos, esGanador, comentarios
    $GLOBALS['contenido'].=<<<EOS
    <h3>Añadir artista</h3>
    <form action="procesarAniadir.php" method="POST">
	<fieldset>
        <legend>Datos nuev@ artista</legend>
           
            <label>Nombre del artista:</label> <input type="text" name="nombreArtista" />
            <br/>
            <label>Comentario:</label> <input type="text" name="comentarioArtista" />
            <br/><button type="submit" name="insertarArtista">Añadir</button>
		</fieldset>
		</form>
EOS;
  }
  function formularioAñadirUsuario(){
    //nombre, votos, esGanador, comentarios
    $GLOBALS['contenido'].=<<<EOS
    <h3>Añadir usuario</h3>
    <form action="procesarAniadir.php" method="POST">
	<fieldset>
        <legend>Datos nuev@ usuri@</legend>
           
            <label>Nombre usuario:</label> <input type="text" name="nombreUsuario" />
            <br/>
            <label>Nombre completo:</label> <input type="text" name="nCompletoUsuario" />
            <br/>
            <label>Contraseña:</label> <input type="password" name="passwordUsuario" />
            <br/>
            <label>Rol:</label> 
            <br/><input type="radio" name="userType" id="CommonUser" value="Usuario" checked/>
            <label for="CommonUser">Usuario</label>
            <input type="radio" name="userType" id="adminUser" value="Administrador" />
            <label for="adminUser">Administrador</label>
            <br/><button type="submit" name="insertarUsuario">Añadir</button>
		</fieldset>
		</form>
EOS;
  }
 function formularioAñadirTema(){
    //titulo, comentario
    $GLOBALS['contenido'].=<<<EOS
    <form method="post" action="crearTema.php">
    <p> Titulo: <input type="text" name="titulo_tema" /> </p>
    <p> Comentario: <input type="text" name="comentario" /> </p>
    <p><input type="submit" name="nuevoTema" value="Publicar"/> </p>
    </form>
EOS;
 }

require __DIR__.'/includes/plantillas/plantilla.php';

?>
