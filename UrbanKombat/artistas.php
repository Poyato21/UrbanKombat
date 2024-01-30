<?php
require_once("includes/config.php");
require_once __DIR__.'/includes/Artista.php';
$titulo='Artistas';
$css="vota.css";
$conn = $app->conexionBD();
$contenido=<<<EOS
    <h2> Elige a tu artista favorito </h2>
EOS;
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
            <button type="submit" name="vota" value="Vota"> Vota </button>
        </fieldset>
        </form>

        <div class="ultimoGanador">
        <h2> ¿Quién ganó el mes pasado? </h2>
        <img src="img/artista_ganador.jpg" alt="artista ganador"/>
        <p> Cecilio G UNO DE LOS PRIMEROS QUE HIZO TRAP EN ESPAÑA Y CON UNA CARRERA ARTÍSTICA NOTABLE. </p>
        </div>
    EOS;
    $result->free();
}
require 'includes/plantillas/plantilla.php';
?>
