<?php

//Inicio del procesamiento
require_once("includes/config.php");

$titulo='Registro';
$contenido=<<<EOS
		<h1>Registro de usuario</h1>

		<form action="procesarRegistro.php" method="POST">
		<fieldset>
			<div class="grupo-control" >
				<label>Nombre de usuario:</label> <input class="control" type="text" name="nombreUsuario" id="campoUser"/>
				<span id="userOK"></span> 
			</div>
			<div class="grupo-control" >
				<label>Nombre completo:</label> <input class="control" type="text" name="nombre" id="campoName"/>
				<span id="nameOK"></span> 
			</div>
			<div class="grupo-control" >
				<label>Password:</label> 
				<input class="control" type="password" name="password" id="campoPass1"/>
				<span id="pass1OK"></span> 
			</div>
			<div class="grupo-control">
				<label>Vuelve a introducir el Password:</label> 
				<input class="control" type="password" name="password2"  id="campoPass2"/>
				<span id="pass2OK"></span> 
			</div>
			<div class="grupo-control"><button type="submit" name="registro">Registrar</button></div>
		</fieldset>
		</form>
EOS;
require("includes/plantillas/plantilla.php");