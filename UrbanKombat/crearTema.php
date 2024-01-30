<?php
//Parametros de acceso de la base de datos

  require_once("includes/config.php");
  require_once __DIR__.'/includes/Tema.php';
  $conn= $app->conexionBD();
  $titulo='Tema';
  $contenido = "";

    //funcion que actualiza las ventas
    $erroresFormulario = array();

    $conn = $GLOBALS['conn'];
    $titulo = isset($_POST['titulo_tema']) ? $_POST['titulo_tema'] : null;
    $comentario = isset($_POST['comentario']) ? $_POST['comentario'] : null;
    $fecha=date('Y-m-d h-i-s', time());

    if (empty($titulo)||empty($comentario)) {
        //$erroresFormulario[] = "El titulo y el comentario no pueden estar vacíos";
        $GLOBALS["contenido"].= <<<EOS
        <p class="noRegMsg">El titulo y el comentario no pueden estar vacíos</p>
        EOS;
    }
    else{
        $user = $_SESSION['nombreUsuario'];
    }

    //$rs->free();

    if (isset($_SESSION["login"]) && ($_SESSION["login"]===true&& isset($_SESSION["esAdmin"]) && $_SESSION["esAdmin"])) {
        $tema=Tema::addTema(null,$titulo, $fecha, $user, $comentario, 0);
         if ($tema){
             $GLOBALS["contenido"] .= <<<EOS
                 <p class="regMsg"> Tema creado </br> 
                 <a href= "adminForo.php">Admin Foro</a> </br>
                 <a href= "foro.php"> Ver Temas</a> </p>
             EOS;
         }
    }
    else if (isset($_SESSION["login"]) && ($_SESSION["login"]===true)) {
       $tema=Tema::addTema(null,$titulo, $fecha, $user, $comentario, 0);
        if ($tema){
            $GLOBALS["contenido"] .= <<<EOS
                <p class="regMsg"> Tema creado </br> <a href= "foro.php"> Volver al listado de temas</a> </p>
            EOS;
        }
    
    } else {
        $contenido.=<<<EOS
            <p class="noRegMsg"> No puedes crear un tema porque no estás registrado<br/>
            Usuario desconocido. <a href='login.php'>Inicie sesión</a> o
            <a href='registro.php'>registrese</a> para continuar. </p>
        EOS;
    }
  
    require 'includes/plantillas/plantilla.php';
?>


