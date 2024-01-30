<?php

require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/Usuario.php';

if (! isset($_POST['registro']) ) {
	header('Location: registro.php');
	exit();
}

$titulo = 'Registro';
$css='index.css';
$contenido = '';

$erroresFormulario = array();

//  Se validan en validar.js
$nombreUsuario = isset($_POST['nombreUsuario']) ? $_POST['nombreUsuario'] : null;
$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : null;
$password = isset($_POST['password']) ? $_POST['password'] : null;
$password2 = isset($_POST['password2']) ? $_POST['password2'] : null;


if (count($erroresFormulario) === 0) {
	$user = Usuario::crea($nombreUsuario, $nombre, $password, 'user');	
	if (!$user){
		$erroresFormulario[] = "El usuario ya existe";
	} else {
		$_SESSION['login'] = true;
		$_SESSION['nombre'] = $nombre;
		$_SESSION['nombreUsuario']=$nombreUsuario;
		header('Location: index.php');
		exit();
	}
}
$contenido .= <<<EOF
		<h1>Registro de usuario</h1>
		<form action="procesarRegistro.php" method="POST">	
EOF;
if (count($erroresFormulario) > 0) {
	$contenido .= '<ul class="errores">';
}
foreach($erroresFormulario as $error) {
	$contenido .= "<li>$error</li>";
}
if (count($erroresFormulario) > 0) {
	$contenido .= '</ul>';
}
$contenido .= <<<EOF
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
EOF;

include __DIR__.'/includes/plantillas/plantilla.php';