<?php

//Inicio del procesamiento
require_once("includes/config.php");
require_once __DIR__.'/includes/Album.php';
require_once __DIR__.'/includes/Cancion.php';
require_once __DIR__.'/includes/Artista.php';
require_once __DIR__.'/includes/Usuario.php';



$conn = $app->conexionBD();
//$css = 'admin.css';
$titulo='Añadir';
$contenido='';

    /*  INSERTA ALBUM   */
if (isset($_POST['insertarAlbum'])){

    $nombre = isset($_POST['nombreAlbum']) ? $_POST['nombreAlbum'] : null;
    $comentario = isset($_POST['comentarioAlbum']) ? $_POST['comentarioAlbum'] : null;

    if(!empty($nombre))
        $album = Album::addAlbum($nombre, $comentario);  

    header("Location: adminAlbumes.php");
}
    /*  INSERTA CANCION   */
else if (isset($_POST['insertarCancion'])){
    $nombre = isset($_POST['nombreCancion']) ? $_POST['nombreCancion'] : null;
    $artista = isset($_POST['nombreCancion_artista']) ? $_POST['nombreCancion_artista'] : null;
    $duracion = isset($_POST['duracion']) ? $_POST['duracion'] : null;
    $comentario = isset($_POST['comentarioCancion']) ? $_POST['comentarioCancion'] : null;
    
    if(!empty($nombre) && !empty($artista) && !empty($duracion))
        $cancion = Cancion::addCancion($nombre, $artista, $duracion, $comentario);
    header("Location: adminCanciones.php");
}    
    /*  INSERTA ARTISTA   */
else if (isset($_POST['insertarArtista'])){
    $nombre = isset($_POST['nombreArtista']) ? $_POST['nombreArtista'] : null;
    $comentario = isset($_POST['comentarioArtista']) ? $_POST['comentarioArtista'] : null;

    if(!empty($nombre))
        $album = Artista::addArtista($nombre, $comentario);

    header("Location: adminArtistas.php");
}
    /*  INSERTA USUARIO   */
else if (isset($_POST['insertarUsuario'])){
    $nombre = isset($_POST['nombreUsuario']) ? $_POST['nombreUsuario'] : null;
    $nombreC = isset($_POST['nCompletoUsuario']) ? $_POST['nCompletoUsuario'] : null;
    $password = isset($_POST['passwordUsuario']) ? $_POST['passwordUsuario'] : null;
    $rol = $_POST['userType'];
    if($rol=="Administrador") $rol = "admin";
    if(!empty($nombre) && !empty($nombreC) && !empty($password)){
        $user = Usuario::crea($nombre, $nombreC, $password, $rol);
        header("Location: adminUsuarios.php");
    }

}


require __DIR__.'/includes/plantillas/plantilla.php';




