<?php

//Inicio del procesamiento
require_once("includes/config.php");
require_once __DIR__.'/includes/Album.php';

$conn = $app->conexionBD();
$css = 'admin.css';
$titulo='Administrar Albumes';
$contenido='';
$datosFormulario = array();
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

  
  $result = Album::cargarAlbumes();

  if(!$result)
    echo 'No se han podido cargar los albumes';

  else if($result->num_rows > 0){
    // Mostramos la tabla de temas
    $contenido.=<<<EOS
    
      <table class="tablaAdmin">
      <tr>
        <th>ID</th>
        <th>Nombre del Album</th>
        <th>Votos</th>     
        <th>Comentario</th>   
      </tr>
    
    EOS;  //<th>Last topic</th>

    
    // Si hay, mostramos los temas
    while($row= $result->fetch_assoc()) { 

      $id = $row['id'];
      $nombre= $row['nombre'];
      $votos= $row['votos'];
      $comentario = $row['comentario'];
      $contenido.=<<<EOS
        <tr>
          <td>
                <p>$id</p> 
                
            </td>
            <td>
                <p>$nombre</p> 
                
            </td>
            <td>
                <p>$votos</p> 
                
            </td>
            <td>
                <p>$comentario</p> 
                
            </td>
            <td>
            <form method="post" action="editar.php?nombre=$nombre">
              <input type="submit" name='editarAlbum' value = "Editar"/></form>
            <form method="post" action="eliminar.php?nombre=$nombre">
              <input type="submit" name='eliminarAlbum' value = "Eliminar"/></form>
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
      <p>Todavia no hay albumes</p>
    EOS;
  }


$contenido.=<<<EOS
  <form method="post" action="aniadir.php">
  <input type="submit" name='añadirAlbum' value = "Añadir"/></form>
  <p><a class="volver" href="admin.php">Volver</a></p>
EOS;

require __DIR__.'/includes/plantillas/plantilla.php';




