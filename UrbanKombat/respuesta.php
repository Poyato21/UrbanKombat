<?php
  //require_once("includes/config.php");
  require_once __DIR__.'/includes/config.php';
  require_once __DIR__.'/includes/Respuesta.php';
  require_once __DIR__.'/includes/Tema.php';

  $conn = $app->conexionBD();
  $titulo='Respuesta';
  $contenido ='';

    $erroresFormulario = array();

    $conn = $GLOBALS['conn'];
    $texto = isset($_POST['texto_respuesta']) ? $_POST['texto_respuesta'] : null;
    $tema= isset($GET['nombre']);
    if ( empty($texto) ) {
        $erroresFormulario[] = "El comentario no puede estar vacío";
    }

    $id = $_GET['id'];
    $usuario = $_SESSION['nombreUsuario'];
    $fecha=date('Y-m-d h-i-s', time());

    if (isset($_SESSION["login"]) && ($_SESSION["login"]===true)) {
      $respuesta=Respuesta::addRespuesta(null,$usuario,$texto,$fecha,$id);
      if($respuesta){
        $GLOBALS["contenido"] .= <<<EOS
        <p class="regMsg"> Has respondido </br> <a href= "verTema.php? id=$id"> Volver al tema</a></p>
        EOS;
        $numerorespuestas=Tema::modificarNumeroRespuestas($id, 1);
      }
    } else {
      $contenido.=<<<EOS
          <p class="noRegMsg"> No puedes responder porque no estás registrado<br>
          Usuario desconocido. <a href='login.php'>Inicie sesión</a> o
        <a href='registro.php'>registrese</a> para continuar. </p>
      EOS;
    }
 
    require 'includes/plantillas/plantilla.php';
?>
