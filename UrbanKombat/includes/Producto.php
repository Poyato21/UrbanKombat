<?php
require_once __DIR__.'/Aplicacion.php';

class Producto{
    private $id;
    private $nombre;
    private $precio;
    private $existencias;
    private $imagen;

    private function __construct($id,$nombre,$precio,$existencias,$imagen){
        $this->id=$id;
        $this->nombre=$nombre;
        $this->precio=$precio;
        $this->existencias=$existencias;
        $this->imagen=$imagen;
    }

    public static function registraCompra($id){
        $app=Aplicacion::getInstancia();
        $conn = $app->conexionBd();

        $query=sprintf("UPDATE Productos SET existencias = existencias - 1 where (nombre ='%s') AND (existencias>0) "
        , $conn->real_escape_string($id));

        if ($conn->query($query) === TRUE){
            $mensajeVotacion = <<<EOS
                <p> ¡Gracias por Comprar! </p>
            EOS;
        } else {
            $mensajeVotacion = <<<EOS
                "Error en : " . $query . "<br>" . $conn->error
            EOS;
        }
        return $mensajeVotacion;
    }

    public static function addProducto($nombre, $precio, $existencias, $imagen){
        $producto=new Producto($nombre, $precio, $existencias, $imagen); 
        return self::guarda($producto);
    }

    public static function guarda($producto){
        if($producto->id!=null){
            return self::actualiza($producto);
        }
        return self::inserta($producto);
    }

    public static function buscaProducto($nombre){
        $app=Aplicacion::getInstancia();
        $conn=$app->conexionBD();
        $query=sprintf("SELECT * FROM Productos WHERE nombre='%s'"
        ,$conn->real_escape_string($nombre));
        $rs=$conn->query($query);
        $result=false;
        if($rs){
            if($rs->num_rows==1){
                $fila=$rs->fetch_assoc();
                $producto=new Producto($fila['id'], $fila['nombre'], $fila['precio'], $fila['existencias'], $fila['imagen']);
                $result=$producto;
            }
            $rs->free();
        }else{
            echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $result;
    }

    public static function inserta($producto){
        $app=Aplicacion::getInstancia();
        $conn=$app->conexionBD();
        $query=sprintf("INSERT INTO Productos(nombre, precio, existencias, imagen) VALUES ('%s', '%s', '%s', '%s')"
        ,$conn->real_escape_string($producto->nombre)
        ,$conn->real_escape_string($producto->precio)
        ,$conn->real_escape_string($producto->existencias)
        ,$conn->real_escape_string($producto->imagen));
        if ( $conn->query($query) ) {
            $producto->id = $conn->insert_id;
        } else {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $producto;
    }

    public static function actualiza($producto){
        $result = false;
        $app = Aplicacion::getInstancia();
        $conn = $app->conexionBd();
        $query=sprintf("UPDATE Productos U SET nombre = '%s', precio='%s', existencias='%s', imagen='%s' WHERE U.id=%s"
            , $conn->real_escape_string($producto->nombre)
            , $conn->real_escape_string($producto->precio)
            , $conn->real_escape_string($producto->existencias)
            , $conn->real_escape_string($producto->imagen)
            , $producto->id);
        if ( $conn->query($query) ) {
            if ( $conn->affected_rows != 1) {
                echo "No se ha podido actualizar el producto: " . $cancion->id;
            }
            else{
                $result = $producto;
            }
        } else {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
        }
        
        return $result;
    }

    public function getId(){
        return $this->id;
    }

    public function getnombre(){
        return $this->nombre;
    }

    public function getPrecio(){
        return $this->precio;
    }

    public function getExistencias(){
        return $this->existencias;
    }

    public function getImagen(){
        return $this->imagen;
    }

    public function setVotos($votos){
        $this->votos=$votos;
        self::guarda($this);
    }

    public function setPrecio($precio){
        $this->precio=$precio;
        self::guarda($this);
    }

    public function setExistencias($existencias){
        $this->existencias=$existencias;
        self::guarda($this);
    }

    public function setImagen($imagen){
        $this->imagen=$imagen;
        self::guarda($this);
    }

    public static function cargarProductos(){
        $app = Aplicacion::getInstancia();
        $conn = $app->conexionBd();
        $sql = "SELECT nombre, imagen FROM Productos";
        $result = $conn->query($sql);

        return $result;
    }

    public static function borrarProducto($nombre){
        $producto=self::buscaProducto($nombre);
        $result=false;
        if(!$producto){
            return $result;
        }else{
            $app = Aplicacion::getInstancia();
            $conn = $app->conexionBd();
            $query=sprintf("DELETE FROM Productos WHERE nombre='%s'"
            ,$conn->real_escape_string($nombre));
            if ( $conn->query($query) ) {
                if ( $conn->affected_rows != 1) {
                    echo "No se ha podido borrar el producto: " . $producto->id;
                }
                else{
                    $result =true;;
                }
            } else {
                echo "Error al borrar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            }
            
            return $result;
        }

    }




}