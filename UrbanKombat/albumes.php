<?php
require_once("includes/config.php");
require_once __DIR__.'/includes/Album.php';
$titulo='Albumes';
$css="vota.css";
$conn = $app->conexionBD();

function votar($query) {
    if ($conn->query($query) === TRUE){
        $mensajeVotacion = <<<EOS
            <p> ¡Gracias por votar! </p>
        EOS;
    } else {
        $mensajeVotacion = <<<EOS
            "Error en : " . $query . "<br>" . $conn->error
        EOS;
    }
};

$contenido=<<<EOS
    <h2> Haz click en tu álbum favorito </h2>
EOS;

//$sql = "SELECT nombre, id FROM Albumes";
//$result = $conn->query($sql);


$result=Album::cargarAlbumes();

if(!$result)
  echo 'No se han podido cargar los albumes';

else {
    $contenido.=<<<EOS
        <form action="procesarAlbumes.php" method="POST">
        <fieldset>
            <select class="selector" name ="albumes">
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
        
            <button type="submit" name="vota" value="Vota"> Vota </button> 
        </fieldset>
        </form>

        <div class="ultimoGanador">
        <h2> ¿Quién ganó el mes pasado? </h2>
        <img src="img/album_ganador.jpg" alt="album ganador" >
        <p> El Madrileño es el segundo álbum de estudio del rapero, cantante y compositor español C. Tangana </p>
        </div>
    EOS;
    $result->free();
}
require 'includes/plantillas/plantilla.php';
?> 