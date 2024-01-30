<?php
  require_once __DIR__.'/includes/config.php';
  require_once __DIR__.'/includes/Tema.php';
  require_once __DIR__.'/includes/Respuesta.php';

  $conn = $app->conexionBD();
  $css = 'foro.css';
  $titulo='Comentarios';
  $contenido ='';

  $contenido.=<<<EOS
    <h1> NOVEDADES EN LA MÚSICA URBANA </h1>
    EOS;
  $id = $_GET['id'];
  $result=Tema::buscaTema($id);

  
  if($result){      //En caso de existir solo debe haber 1 tema con el =titulo
    // Mostramos la tabla de temas
    $title=$result->getTitulo();
    $creador=$result->getCreador();
    $fecha=$result->getFecha();
    $comentario=$result->getComentario();
    
    $contenido.=<<<EOS
    <h2> $title </h2>  <br>  
      <table id="tema">
      <tr>
        <td id="creador"><p>Creado por $creador - $fecha</p></td>
      </tr>
      <tr>
        <td class="msg"><p>$comentario</p></td>
      </tr>
    
    EOS;

    $respuestas=Respuesta::cargarRespuesta($id);
    while($row= $respuestas->fetch_assoc()){
      $idRespuesta= $row['id'];
      $usuario= $row['usuario'];
      $texto= $row['texto'];
      $fechaR= $row['fecha'];
      $contenido.=<<<EOS
        <tr>
          <td class="resp"><p>Re: $usuario - $fechaR</p></td>
        </tr>
      EOS;
      if($usuario ==$_SESSION['nombreUsuario']|| (isset($_SESSION['esAdmin'])&&$_SESSION['esAdmin'])){
        $contenido.=<<<EOS
          <tr>
            <td class="msg">$texto</td>
          
            <td class="button">
            <form class="botones" action = "editar.php?idR=$idRespuesta" method="post">
            <input type="submit" name='editarRespuesta' value = "Editar"/>
            </form>  
            <form class="botones" action = "eliminar.php?idR=$idRespuesta" method="post">
            <input type="submit" name='eliminarRespuesta' value = "Eliminar"/>
            </form>
            </td>
          </tr>
        EOS; 
      }
      else{
        $contenido.=<<<EOS
          <tr>
            <td class="msg"><p>$texto</p></td>
          </tr>
        EOS; 
      }
    }
    $respuestas->free();

    $contenido.=<<<EOS
      </table>
    EOS;
  }
  else {
    $contenido.=<<<EOS
      <p>Todavia no hay temas</p>
    EOS;
  }
  
  $contenido.=<<<EOS
    <form action = "respuesta.php?id=$id" method="post">
    Escribe aqui tu respuesta: <input type="text" name="texto_respuesta" />
    <input type="submit" name='Respuesta' value = "Responder"/>
    </form>
    <form action = "musica.php?id=$id" method="post">
    Escribe aqui el link a la canción: <input type="text" name="texto_respuesta" />
    <input type="submit" name='Musica' value = "Responder"/>
    </form>
  EOS;  
  require 'includes/plantillas/plantilla.php';
?>