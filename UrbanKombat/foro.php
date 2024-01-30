<?php
  require_once __DIR__.'/includes/config.php';
  require_once __DIR__.'/includes/Tema.php';

  $conn = $app->conexionBD();
  $titulo='Foro';
  $css='foro.css';
  $contenido ='';

  $contenido.=<<<EOS
    <h1 style="text-align:center"> NOVEDADES EN LA MÚSICA URBANA </h1>
    EOS;

  $result=Tema::cargarTema();

  if(!$result)
    echo 'No se han podido cargar los temas';

  else if($result->num_rows > 0){
    // Mostramos la tabla de temas
    $contenido.=<<<EOS
    
      <table id="tablaForo">
      <tr>
        <th id="borrar"></th>
        <th>TÌTULO</th>
        <th>CREADOR</th>
        <th> RESPUESTAS </th>
        <th>FECHA</th>
        
      </tr>
    
    EOS;  

    
    // Si hay, mostramos los temas
    while($row= $result->fetch_assoc()) { 
      $id = $row['id'];
      $title= $row['titulo'];
      $fecha= $row['fecha'];
      $creador = $row['creador'];
      $respuestas = $row['respuestas'];
      $contenido.=<<<EOS
        <tr>
          <td class="linksForo">
                <p><a href='verTema.php?id=$id'>Ver</a></p> 
                
            </td>
            <td>
                <p>$title </p> 
                
            </td>
            <td >
                <p>$creador</p> 
                
            </td>
            <td>
            <p>$respuestas</p> 
            
          </td>
            <td>
                <p>$fecha</p>
            </td>
            
        </tr>
      EOS;
    }
    
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
      <form method="post" action="crearTema.php">
      <p> Titulo: <input type="text" name="titulo_tema" /> </p>
      <p> Comentario: <input type="text" name="comentario" /> </p>
      <p><input type="submit" name="nuevoTema" value="Publicar"/> </p>
      </form>
  EOS;

  $result->free();     // Liberamos recursos
        
    require 'includes/plantillas/plantilla.php';
?>
