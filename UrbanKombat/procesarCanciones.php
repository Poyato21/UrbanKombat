<?php
require_once 'includes/config.php';
require_once __DIR__.'/includes/Cancion.php';
require_once __DIR__.'/includes/Usuario.php';
$contenido = "";
$titulo='Canciones';
$css="vota.css";


if (! isset($_POST['vota']) ) {
	header('Location: canciones.php');
	exit();
}



$contenido=<<<EOS
    <h2> Elige tu canción favorita </h2>
EOS;

if (isset($_POST['canciones'])) {
    if (Usuario::getVotoCancion($_SESSION['nombreUsuario'])) {
        $contenido .= <<<EOS
        <p class="noRegMsg"> No puedes votar porque ya has votado </p>
        EOS; 
    }
    else {
        $votado = $_POST['canciones'];
        $contenido.=Cancion::registraVoto($votado);    
        Usuario::setVotoCancion($_SESSION['nombreUsuario']);
    }
} 


//$sql = "SELECT nombre, id FROM Canciones";
//$result = $conn->query($sql);

$result=Cancion::cargarCanciones();

if(!$result)
  echo 'No se han podido cargar las canciones.';

else {
    $contenido.=<<<EOS
        <form action="procesarCanciones.php" method="POST">
        <fieldset>
            <select class="selector" name ="canciones">
    EOS;

    if($result->num_rows > 0){
        // Si hay, mostramos las categorias
        while($row= $result->fetch_assoc()) {  
          $name = $row['nombre'];
          $id = $row['id'];
          $contenido.=<<<EOS
            <option value=$id selected>  $name </option>
          EOS;
        }
    }

    $contenido.=<<<EOS
        </select>
        <br/>
        <button type="submit" name="vota" value="Vota"> Vota </button>  
        </fieldset>
        </form>

        <div class="ultimoGanador">
        <h2> ¿Quién ganó el mes pasado? </h2>
        <img src="img/cancion_ganador.jpg" alt="cancion ganador"/>
        <p> Videojuego de Albany es una canción muy chula que salió en 2022. </p>
        </div>
    EOS;
    $result->free();
}



require 'includes/plantillas/plantilla.php';
?> 