<?php
require_once("includes/config.php");
$titulo='Login';
$nombreUsuario='';
$password = '';
$contenido=<<<EOS
	<h1>Acceso al sistema</h1>

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
EOS;
require('includes/plantillas/plantilla.php');