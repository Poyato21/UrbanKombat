<?php
require_once 'includes/config.php';
require_once __DIR__.'/includes/Artista.php';
require_once __DIR__.'/includes/Usuario.php';
$conn = $app->conexionBD();
$titulo='Artistas';
$css="vota.css";
$contenido = "";



if (! isset($_POST['vota']) ) {
	header('Location: artistas.php');
	exit();
}

$conn = $app->conexionBD();
$contenido=<<<EOS
    <h2> Haz click en tu artista favorito </h2>
EOS;

if (isset($_POST['artistas'])) {
    if (Usuario::getVotoArtista($_SESSION['nombreUsuario'])) {
        $contenido .= <<<EOS
        <p class="noRegMsg"> No puedes votar porque ya has votado </p>
        EOS; 
    }
    else {
        $votado = $_POST['artistas'];
        $contenido.=Artista::registraVoto($votado);    
        Usuario::setVotoArtista($_SESSION['nombreUsuario']);
    }
} 

//$sql = "SELECT nombre, id FROM Artistas";
//$result = $conn->query($sql);

$result=Artista::cargarArtistas();

if(!$result)
  echo 'No se han podido cargar los artistas';

else {
    $contenido.=<<<EOS
        <form action="procesarArtistas.php" method="POST">
        <fieldset>
        
            <select class="selector" name ="artistas">
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
        <img src="img/artista_ganador.jpg" alt="artista ganador" />
        <p> Cecilio G UNO DE LOS PRIMEROS QUE HIZO TRAP EN ESPAÑA Y CON UNA CARRERA ARTÍSTICA NOTABLE. </p>
        </div>
    EOS;
    $result->free();
}

require 'includes/plantillas/plantilla.php';
?> 