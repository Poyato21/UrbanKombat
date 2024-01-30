<?php

//Inicio del procesamiento
require_once("includes/config.php");
require_once __DIR__.'/includes/Tema.php';
$css="admin.css";
$conn = $app->conexionBD();
$titulo='Administrar Foro';
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

  $result = Tema::cargarTema();

  if(!$result)
    echo 'No se han podido cargar los temaws';

  else if($result->num_rows > 0){
    // Mostramos la tabla de temas
    $contenido.=<<<EOS
    
      <table class="tablaAdmin">
      <tr>
        <th>ID</th>
        <th>Titulo</th>
        <th>Fecha</th>     
        <th>Creador</th>   
        <th>Comentario</th>  
        <th>Respuestas</th>  
      </tr>
    
    EOS;  //<th>Last topic</th>

    
    // Si hay, mostramos los temas
    while($row= $result->fetch_assoc()) { 

      $id = $row['id'];
      $titulo= $row['titulo'];
      $fecha= $row['fecha'];
      $creador= $row['creador'];
      $comentario = $row['comentario'];
      $respuestas= $row['respuestas'];
      $contenido.=<<<EOS
        <tr>
          <td>
                <p>$id</p> 
                
            </td>
            <td>
                <p>$titulo</p> 
                
            </td>
            <td >
                <p>$fecha</p> 
                
            </td>
            <td >
                <p>$creador</p> 
                
            </td>
            <td >
                <p>$comentario</p> 
                
            </td>
            <td >
                <p>$respuestas</p> 
                
            </td>
            <td >
            <form method="post" action="verTema.php?id=$id">
              <input type="submit" name='verForo' value = "Ver tema"/></form>
            <form method="post" action="editar.php?idF=$id">
              <input type="submit" name='editarForo' value = "Editar"/></form>
            <form method="post" action="eliminar.php?idF=$id">
              <input type="submit" name='eliminarForo' value = "Eliminar"/></form>
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
  <form method="post" action="aniadir.php">
  <input type="submit" name='añadirTema' value = "Añadir"/></form>
  <p><a class="volver" href="admin.php">Volver</a></p>
EOS;

require __DIR__.'/includes/plantillas/plantilla.php';






