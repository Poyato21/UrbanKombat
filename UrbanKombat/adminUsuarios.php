<?php

//Inicio del procesamiento
require_once("includes/config.php");
require_once __DIR__.'/includes/Usuario.php';
$css="admin.css";
$conn = $app->conexionBD();
$titulo='Administrar Usuarios';
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




  $result = Usuario::cargarUsuario();

  if(!$result)
    echo 'No se han podido cargar los usuarios';

  else if($result->num_rows > 0){
    // Mostramos la tabla de temas
    $contenido.=<<<EOS
    
      <table class="tablaAdmin">
      <tr>
        <th>ID</th>
        <th>Nombre de Usuario</th>
        <th>Nombre Completo</th>        
      </tr>
    
    EOS;  //<th>Last topic</th>

    
    // Si hay, mostramos los temas
    while($row= $result->fetch_assoc()) { 

      $id = $row['id'];
      $nombreUsuario= $row['nombreUsuario'];
      $nombre= $row['nombre'];
      $contenido.=<<<EOS
        <tr>
          <td>
                <p>$id</p> 
                
            </td>
            <td>
                <p>$nombreUsuario</p> 
                
            </td>
            <td >
                <p>$nombre</p> 
                
            </td>
            <td>
              <form method="post" action="editar.php?nombre=$nombreUsuario">
              <input type="submit" name='editarUsuario' value = "Editar"/></form>
              <form method="post" action="eliminar.php?idU=$id">
              <input type="submit" name='eliminarUsuario' value = "Eliminar"/></form>
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
      <p>Todavia no hay usuarios</p>
    EOS;
  }
  $contenido.=<<<EOS
  <form method="post" action="aniadir.php">
  <input type="submit" name='añadirUsuario' value = "Añadir"/></form>
  <p><a class="volver" href="admin.php">Volver</a></p>
EOS;

require __DIR__.'/includes/plantillas/plantilla.php';




