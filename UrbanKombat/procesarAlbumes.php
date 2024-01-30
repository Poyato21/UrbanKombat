<?php
require_once 'includes/config.php';
require_once __DIR__.'/includes/Album.php';
require_once __DIR__.'/includes/Usuario.php';

$conn = $app->conexionBD();
$titulo='Albumes';
$css="vota.css";
$name = "";


$contenido=<<<EOS
   <h2> Haz click en tu álbum favorito </h2>
EOS;

if (isset($_POST['albumes'])) {
    if (Usuario::getVotoAlbum($_SESSION['nombreUsuario'])) {
        $contenido .= <<<EOS
        <p class="noRegMsg"> No puedes votar porque ya has votado </p>
        EOS; 
    }
    else {
        $votado = $_POST['albumes'];
        $contenido.=Album::registraVoto($votado);    
        Usuario::setVotoAlbum($_SESSION['nombreUsuario']);
    }
} 

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
       <br/>
       
           <button type="submit" name="vota" value="Vota"> Vota </button>  
       </fieldset>
       </form>

       <div class="ultimoGanador">
       <h2> ¿Quién ganó el mes pasado? </h2>
       <img src="img/album_ganador.jpg" alt="album ganador" width="15%" height="15%"/>
       <p> El Madrileño es el segundo álbum de estudio del rapero, cantante y compositor español C. Tangana </p>
       </div>
   EOS;
   $result->free();
}

if (! isset($_POST['vota']) ) {
	header('Location: albumes.php');
	exit();
}
require 'includes/plantillas/plantilla.php';
?> 