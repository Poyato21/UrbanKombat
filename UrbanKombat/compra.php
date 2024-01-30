<?php
  require_once("includes/config.php");
  require_once __DIR__.'/includes/Producto.php';
  $titulo='Compra';
  $css='compra.css';
  $contenido=<<<EOS
    <p> COMPRA SUSBCRIPCIONES A TUS PLATAFORMAS FAVORITAS </p>
    EOS;

    $result = Producto::cargarProductos();

    if(!$result)
      echo 'No se han podido cargar los productos';

    else {
        $contenido.=<<<EOS
            <div id = "compra">
            <form action="procesaCompra.php" method="POST">
            <div>
            <table style="width:100%">
        EOS;

        if($result->num_rows > 0){
            // Si hay, mostramos las categorias
            while($row= $result->fetch_assoc()) {  
              $name = $row['nombre'];
              $img = $row['imagen'];
              $contenido.=<<<EOS
              <tr>
              <th>
                <img src="img/$img" class="tarjetaSub" alt="tarjeta subscripcion"/><br/>
                <button type="submit" name='Tarjetas' value='$name'>$name</button>  
                
              </th>
              </tr>
              EOS;
            }
        }

        $contenido.=<<<EOS
            </table>
            </div>
            </form>
            </div>

        EOS;
        $result->free();
    }
    require 'includes/plantillas/plantilla.php';
?>
