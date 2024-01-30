<?php
  require_once("includes/config.php");
  require_once __DIR__.'/includes/Producto.php';
  require_once __DIR__.'/includes/Usuario.php';

  $conn = $app->conexionBD();
  $titulo='Carrito';
  $mensajeCompra = "";                  
  $contenido = "";
  $codigo="";
  
  $vacio='';
  $css='compra.css';

// Generamos codigo aleatorio
function generarCodigo() {
    $maximoCaracteres=16;
    $caracteres="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $max=strlen($caracteres);
    for($i=0;$i < $maximoCaracteres;$i++)
    {
         $random_character=$caracteres[rand(0,$max-1)];
         $GLOBALS["codigo"].=$random_character;
    }
    $GLOBALS["contenido"].=<<<EOS
        <div id="codigo">
        <p>Código aleatorio :</p>
    EOS;
    $GLOBALS["contenido"].= $GLOBALS["codigo"]; 
    $GLOBALS["contenido"].=<<<EOS
        </div>
    EOS;
    return $GLOBALS["codigo"];
}    

if (isset($_SESSION["login"]) && ($_SESSION["login"]===true)) {
    if (isset($_POST['Tarjetas'])) {
        $seleccioncompra=$_POST['Tarjetas'];
        //ActualizarInventario($seleccioncompra);
        $producto=Producto::buscaProducto($seleccioncompra);
        if($producto->getExistencias()==0){
            $GLOBALS["contenido"].=<<<EOS
            <p> No quedan tarjetas </p>
            EOS;
        }
        else{
            switch($producto->getNombre()){
                case 'Tarjeta Spotify':{
                    $user=$_SESSION['nombreUsuario'];
                    if(Usuario::getTarjetaSpoti($user)==''){
                        $img = $producto->getImagen();
                        $GLOBALS["contenido"].=<<<EOS
                        <div class="saludo">
                            <img class="tarjetaSub" src="img/$img"/>
                            <h3>$seleccioncompra</h3>
                            <p>Suscripcion a la plataforma durante tres meses</p>
                            <h3> ¡Gracias por comprar! </h3>
                            <img class="carrito" src="img/carrito_compra.png" />
                        </div>
                        EOS;
                        $codigo=generarCodigo();
                        Producto::registraCompra($seleccioncompra);
                        Usuario::setTarjetaSpoti($user,$codigo);
                    }else{
                        $GLOBALS["contenido"].=<<<EOS
                            <p class="noRegMsg"> No puedes comprar más tarjetas de este tipo, ya tienes una </p>
                        EOS;
                    }
                    break;
                }
                case 'Tarjeta Apple Music':{
                    $user=$_SESSION['nombreUsuario'];
                    if(Usuario::getTarjetaApple($user)==''){
                        $img = $producto->getImagen();
                        $GLOBALS["contenido"].=<<<EOS
                            <div class="saludo">
                                <img class="tarjetaSub" src="img/$img"/>
                                <h3>$seleccioncompra</h3>
                                <p>Suscripcion a la plataforma durante tres meses</p>
                                <h3> ¡Gracias por comprar! </h3>
                                <img class="carrito" src="img/carrito_compra.png"/>
                            </div>
                        EOS;
                        $codigo=generarCodigo();
                        Producto::registraCompra($seleccioncompra);
                        Usuario::setTarjetaApple($user, $codigo);
                    }else{
                        $GLOBALS["contenido"].=<<<EOS
                            <p class="noRegMsg"> No puedes comprar más tarjetas de este tipo, ya tienes una  </p>
                        EOS;
                    }
                    break;
                }
                case 'Tarjeta YouTube':{
                    $user=$_SESSION['nombreUsuario'];
                    if(Usuario::getTarjetaYT($user)==''){
                        $img = $producto->getImagen();
                        $GLOBALS["contenido"].=<<<EOS
                        <div class="saludo">
                            <img class="tarjetaSub" src="img/$img" />
                            <h3>$seleccioncompra</h3>
                            <p>Suscripcion a la plataforma durante tres meses</p>
                            <h3> ¡Gracias por comprar! </h3>
                            <img class="carrito" src="img/carrito_compra.png"/>
                        </div>
                        EOS;
                        $codigo=generarCodigo();
                        Producto::registraCompra($seleccioncompra);
                        Usuario::setTarjetaYT($user, $codigo);
                    }else{
                        $GLOBALS["contenido"].=<<<EOS
                            <p class="noRegMsg">No puedes comprar más tarjetas de este tipo, ya tienes una </p>
                        EOS;
                    }
                    break;
                }
            }
        }
    }
       
} else {
    $contenido.=<<<EOS
        <p class="noRegMsg"> No puedes comprar porque no estás registrado<br>
        Usuario desconocido. <a href='login.php'>Inicie sesión</a> o
        <a href='registro.php'>registrese</a> para continuar con la compra. </p>
    EOS;
}

require 'includes/plantillas/plantilla.php';
?>
