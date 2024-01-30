<?php

//Inicio del procesamiento
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/Usuario.php';

$erroresFormulario = array();

$nombreUsuario = isset($_POST['nombreUsuario']) ? $_POST['nombreUsuario'] : null;
if ( empty($nombreUsuario) ) {
	$erroresFormulario[] = "El nombre de usuario no puede estar vacío";
}

$password = isset($_POST['password']) ? $_POST['password'] : null;
if ( empty($password) ) {
	$erroresFormulario[] = "El password no puede estar vacío.";
}


if (count($erroresFormulario) === 0) {
	$usuario = Usuario::login ($nombreUsuario, $password);
	if ( !$usuario) {		
		// No se da pistas a un posible atacante
		$erroresFormulario[] = "El usuario o el password no coinciden";
	} else {
			$_SESSION['login'] = true;
			$_SESSION['nombreUsuario'] = $usuario->getNombreUsuario();
			$_SESSION['nombre'] = $usuario->getNombre(); //Capturamos el nombre real del usuario
			$_SESSION['esAdmin'] = strcmp($usuario->getRol(), 'admin') == 0 ? true : false;				
	}
}
$titulo= 'Login';
$css='index.css';
$contenido = '';
if (isset($_SESSION["login"])) {
	$contenido .= <<<EOF
	<div class="saludo">
	<h1>Bienvenid@ {$_SESSION['nombre']}</h1>
	<p>Usa el menú de arriba para navegar.</p>
	</div>
EOF;
} else {
		 $contenido.= '<h1>ERROR</h1>';
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
		<form action="procesarLogin.php" method="POST">
		<fieldset>
            <legend>Usuario y contraseña</legend>
            
                <label>Nombre de usuario:</label> 
                <input type="text" name="nombreUsuario" value="$nombreUsuario" id="campoUserLogin"/>
				<span id="userLoginOK"></span> 
            	<br/>
                <label>Password:</label> 
                <input type="password" name="password" value="$password" id="campoPassLogin"/>
            	<span id="passLoginOK"></span> 
				<br/>
			<button type="submit" name="login">Entrar</button>
		</fieldset>
		</form>
EOF;
		}

include __DIR__.'/includes/plantillas/plantilla.php';