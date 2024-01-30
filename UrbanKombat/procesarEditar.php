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

    /*  GUARDAR CAMBIOS ALBUM   */

if (isset($_POST['editarAlbum'])){
    $nombreO = $_GET['nombreOriginal'];
    $nombre = isset($_POST['nombreAlbum']) ? $_POST['nombreAlbum'] : null;
    $votos = isset($_POST['votosAlbum']) ? $_POST['votosAlbum'] : null;
    $comentario = isset($_POST['comentarioAlbum']) ? $_POST['comentarioAlbum'] : null;
    $album = Album::buscaAlbum($nombreO);
         
    if(!empty($nombre) && $album->getNombre() != $nombre)
        $album->setNombre($nombre);  

    if($album->getVotos() != $votos)
        $album->setVotos($votos);  

    if($album->getComentario() != $comentario)
        $album->setComentario($comentario); 

    header("Location: adminAlbumes.php");
}

    /*  GUARDAR CAMBIOS CANCION   */

else if (isset($_POST['editarCancion'])){
    $nombreO = $_GET['nombreOriginal'];
    $nombre = isset($_POST['nombreCancion']) ? $_POST['nombreCancion'] : null;
    $artista = isset($_POST['nombreCancion_artista']) ? $_POST['nombreCancion_artista'] : null;
    $duracion = isset($_POST['duracion']) ? $_POST['duracion'] : null;
    $votos = isset($_POST['votosCancion']) ? $_POST['votosCancion'] : null;
    $comentario = isset($_POST['comentarioCancion']) ? $_POST['comentarioCancion'] : null;
    $cancion = Cancion::buscaCancion($nombreO);

    if(!empty($nombre) && $cancion->getNombre() != $nombre)
       $cancion->setNombre($nombre);
    
    if(!empty($artista)&& $cancion->getArtista() != $artista)
       $cancion->setArtista($artista);
    
    if($cancion->getDuracion() != $duracion)
       $cancion->setDuracion($duracion);

    if($cancion->getVotos() != $votos)
        $cancion->setVotos($votos);  

    if($cancion->getComentario() != $comentario)
        $cancion->setComentario($comentario);

    header("Location: adminCanciones.php");
}    

    /*  GUARDAR CAMBIOS ARTISTA   */

else if (isset($_POST['editarArtista'])){

    $nombreO = $_GET['nombreOriginal'];
    $nombre = isset($_POST['nombreArtista']) ? $_POST['nombreArtista'] : null;
    $votos = isset($_POST['votosArtista']) ? $_POST['votosArtista'] : null;
    $comentario = isset($_POST['comentarioArtista']) ? $_POST['comentarioArtista'] : null;
    $artista = Artista::buscaArtista($nombreO);
         
    if(!empty($nombre) && $artista->getNombre() != $nombre)
        $artista->setNombre($nombre);  
    
    if($artista->getVotos() != $votos)
        $artista->setVotos($votos);  

    if($artista->getComentario() != $comentario)
        $artista->setComentario($comentario); 

    header("Location: adminArtistas.php");
}

    /*  GUARDAR CAMBIOS USUARIO   */

else if (isset($_POST['editarUsuario'])){
    $nombreO = $_GET['nombreOriginal'];
    $nombre = isset($_POST['nombreUsuario']) ? $_POST['nombreUsuario'] : null;
    $nombreC = isset($_POST['nCompletoUsuario']) ? $_POST['nCompletoUsuario'] : null;
    $password = isset($_POST['passwordUsuario']) ? $_POST['passwordUsuario'] : null;
    $rol = isset($_POST['rol']) ? $_POST['passwordUsuario'] : null;
    $user = Usuario::buscaUsuario($nombreO);

    if($user->getId() != 1){        // Nos aseguramos de que no cambiamos los datos del administrador

        if(!empty($nombre) && $user->getNombreUsuario() != $nombre)
            $user->setNombreUsuario($nombre);

        if(!empty($nombreC) && $user->getNombre() != $nombreC)
            $user->setNombre($nombreC);
            
        if(!empty($password) && !$user->compruebaPassword($password))
            $user->cambiaPassword($password);

        if(!empty($rol) && $user->getRol() != $rol)
            $user->setRol($rol);
        
    }
    header("Location: adminUsuarios.php");
    
}
/*  GUARDAR CAMBIOS FORO   */
else if (isset($_POST['editarForo'])){
    $id = $_GET['idF'];
    $titulo=isset($_POST['ntitulo']) ? $_POST['ntitulo'] : null;
    $fecha=isset($_POST['fecha']) ? $_POST['fecha'] : null;
    $creador=isset($_POST['creador']) ? $_POST['creador'] : null;
    $texto = isset($_POST['textoRespuesta']) ? $_POST['textoRespuesta'] : null;
    
    $tema = Tema::buscaTema($id);

    if(!empty($titulo) && $tema->getTitulo() != $titulo)
        $tema->setTitulo($titulo);
    if(!empty($fecha) && $tema->getFecha() != $fecha)
        $tema->setFecha($fecha);
    if(!empty($creador) && $tema->getCreador() != $creador)
        $tema->setCreador($creador);
    if(!empty($texto) && $tema->getComentario() != $texto)
        $tema->setComentario($texto);

        header("Location: adminForo.php");
    //}
}

else if (isset($_POST['editarRespuesta'])){
    $idRespuesta = $_GET['idR'];
    $texto = isset($_POST['textoRespuesta']) ? $_POST['textoRespuesta'] : null;
    //$nombreC = isset($_POST['nCompletoUsuario']) ? $_POST['nCompletoUsuario'] : null;
    //$password = isset($_POST['passwordUsuario']) ? $_POST['passwordUsuario'] : null;
    //$rol = isset($_POST['rol']) ? $_POST['passwordUsuario'] : null;
    $respuesta = Respuesta::buscaRespuesta($idRespuesta);

    if(!empty($texto) && $respuesta->getTexto() != $texto)
        $respuesta->setTexto($texto);

    // if(isset($_POST['editarRespuesta']))
    //     header("Location: adminUsuarios.php");
    // else{
        $idTema = $respuesta->getId_tema();
        header("Location: verTema.php?id=$idTema");
    //}
}
require __DIR__.'/includes/plantillas/plantilla.php';
?>
