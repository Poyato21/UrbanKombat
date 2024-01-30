<?php

//Inicio del procesamiento
require_once("includes/config.php");
$css="admin.css";
$titulo='Administrar';
$contenido='';
if (isset($_SESSION["esAdmin"]) && $_SESSION["esAdmin"]) {
	$contenido.=<<<EOS
	<head>
	<h1>Consola de administración</h1></head>
	EOS;
} else {
	$contenido.=<<<EOS
	<div class="noRegMsg">
	<h1>Acceso denegado!</h1>
	<p>No tienes permisos suficientes para administrar la web.</p>
	</div>
	EOS;
}

$contenido.=<<<EOS
<h3>Elige qué quieres gestionar</h3>
<br>
<table class="tablaAdmin2">
      <tr>
        <th><form method="post" action="adminUsuarios.php">
			<input type="submit" name='adminUsuario' value="Usuarios"/>
			</form></th>

        <th><form method="post" action="adminAlbumes.php">
			<input type="submit" name='adminAlbumes' value="Albumes">
			</form></th>

        <th><form method="post" action="adminArtistas.php">
			<input type="submit" name='adminArtistas' value="Artistas">
			</form></th>

        <th><form method="post" action="adminCanciones.php">
			<input type="submit" name='adminCanciones' value="Canciones">
			</form></th>

        <th><form method="post" action="adminForo.php">
			<input type="submit" name='adminForo' value="Foro">
			</form></th>

		<th><form method="post" action="procesarSorteo.php">
			<input type="submit" name='sortear' value="Iniciar Sorteo">
		</form></th>

        
      </tr>
  </table>
EOS;

require __DIR__.'/includes/plantillas/plantilla.php';
?>