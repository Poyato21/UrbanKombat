<?php
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/Usuario.php';


	if(isset($_REQUEST["user"])){
		$user = $_REQUEST["user"];
		$buscar =  Usuario::buscaUsuario($user);
		if($buscar){ $data = "existe";}
		else { $data = "disponible";}
		echo $data;
	} 
?>