<?php
require_once __DIR__.'/Aplicacion.php';

/**
 * Configuracion del soporte UTF-8, localizacion (idioma y pais)
 */
ini_set('default_charset', 'UTF-8');
setLocale(LC_ALL, 'es_ES.UTF.8');

date_default_timezone_set('Europe/Madrid');

/** Parámetros de configuración utilizados para generar las URLs y las rutas a ficheros en la aplicación */
define('RAIZ_APP', __DIR__);
define('RUTA_APP', '');
define('RUTA_CSS', RUTA_APP.'/css');
define('RUTA_IMGS', RUTA_APP.'/img');
define('RUTA_JS', RUTA_APP.'/js');

/**
 * Parámetros de conexión a la BD
 */
define('BD_HOST', 'localhost');
define('BD_NAME', 'UrbanKombat');
define('BD_USER', 'UrbanKombat');
define('BD_PASS', 'UrbanKombat');

// Inicializa la aplicacion
$app = Aplicacion::getInstancia();
$app->init(array('host'=>BD_HOST, 'bd'=>BD_NAME, 'user'=>BD_USER, 'pass'=>BD_PASS));

/**
 * @see http://php.net/manual/en/function.register-shutdown-function.php
 * @see http://php.net/manual/en/language.types.callable.php
 */
register_shutdown_function(array($app, 'shutdown'));