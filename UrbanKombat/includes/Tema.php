<?php 
require_once __DIR__.'/Aplicacion.php';

class Tema{
    private $id;
    private $titulo;
    private $fecha;
    private $creador;
    private $comentario;
    private $respuestas;
     private function __construct($id,$titulo, $fecha, $creador, $comentario, $respuestas){
         $this->id=$id;
         $this->titulo=$titulo;
         $this->fecha=$fecha;
         $this->creador=$creador;
         $this->comentario=$comentario;
         $this->respuestas=$respuestas;
     }

     public static function addTema($id,$titulo, $fecha, $creador, $comentario, $respuestas){
        $tema=new Tema($id,$titulo, $fecha, $creador, $comentario, $respuestas); 
        return self::guarda($tema);
    }

    public static function guarda($tema){
        if($tema->id!=null){
            return self::actualiza($tema);
        }
        return self::inserta($tema);
    }

    public static function inserta($tema){
        $app=Aplicacion::getInstancia();
        $conn=$app->conexionBD();
        $query=sprintf("INSERT INTO temas(titulo, fecha, creador, comentario, respuestas) VALUES ('%s', '%s', '%s', '%s', '%d')"
        ,$conn->real_escape_string($tema->titulo)
        ,$conn->real_escape_string($tema->fecha)
        ,$conn->real_escape_string($tema->creador)
        ,$conn->real_escape_string($tema->comentario)
        ,$conn->real_escape_string($tema->respuestas));
        if ( $conn->query($query) ) {
            $tema->id = $conn->insert_id;
        } else {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $tema;
    }

    public static function buscaTema($id){
        $app=Aplicacion::getInstancia();
        $conn=$app->conexionBD();
        $query=sprintf("SELECT * FROM temas WHERE id='%s'"
        ,$conn->real_escape_string($id));
        $rs=$conn->query($query);
        $result=false;
        if($rs){
            if($rs->num_rows==1){
                $fila=$rs->fetch_assoc();
                $tema=new Tema($fila['id'],$fila['titulo'], $fila['fecha'], $fila['creador'], $fila['comentario'], $fila['respuestas']);
                $result=$tema;
            }else{
                echo 'No se han podido cargar los temas';
            }
            $rs->free();
        }else{
            echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $result;
    }

    public static function actualiza($tema){
        $result = false;
        $app = Aplicacion::getInstancia();
        $conn = $app->conexionBd();
        $query=sprintf("UPDATE temas U SET id = '%d', titulo='%s', fecha='%s', creador='%s', comentario='%s', respuestas='%d' WHERE U.id=%d"
            , $conn->real_escape_string($tema->id)
            , $conn->real_escape_string($tema->titulo)
            , $conn->real_escape_string($tema->fecha)
            , $conn->real_escape_string($tema->creador)
            , $conn->real_escape_string($tema->comentario)
            , $conn->real_escape_string($tema->respuestas)
            , $tema->id);
        if ( $conn->query($query) ) {
            if ( $conn->affected_rows != 1) {
                echo "No se ha podido actualizar el tema: " . $tema->id;
            }
            else{
                $result = $tema;
            }
        } else {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
        }
        
        return $result;
    }
    public static function cargarTema(){
        $app = Aplicacion::getInstancia();
        $conn = $app->conexionBd();
        $sql = "SELECT * FROM temas";
        $result = $conn->query($sql);

        return $result;
    }

    public static function borrarTema($id){
        $tema=self::buscaTema($id);
        $result=false;
        if(!$tema){
            return $result;
        }else{
            $app = Aplicacion::getInstancia();
            $conn = $app->conexionBd();
            $query=sprintf("DELETE FROM temas WHERE id='%d'"
            ,$conn->real_escape_string($id));
            if ( $conn->query($query) ) {
                if ( $conn->affected_rows != 1) {
                    echo "No se ha podido borrar el producto: " . $tema->id;
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

    public static function modificarNumeroRespuestas($id, $r) {
        $tema=self::buscaTema($id);
        $result=false;
        if(!$tema){
            return $result;
        }else{
            $app=Aplicacion::getInstancia();
            $conn = $app->conexionBd();
            $query=sprintf("UPDATE temas SET respuestas = respuestas + $r where id ='%d'"
            , $conn->real_escape_string($id));
    
            if ($conn->query($query) === TRUE){
             
                   echo" <p>Respuesta guardada con éxito </p>";
            } else {
                    echo"Error en : " . $query . "<br>" . $conn->error;
                    exit();
            }
            return true;
        }
    }
    
    public function getId(){
        return $this->id;
    }

    public function getTitulo(){
        return $this->titulo;
    }

    public function getFecha(){
        return $this->fecha;
    }

    public function getCreador(){
        return $this->creador;
    }

    public function getComentario(){
        return $this->comentario;
    }

    public function getRespuestas(){
        return $this->respuestas;
    }

    public function setTitulo($titulo){
        $this->titulo=$titulo;
        self::guarda($this);
    }

    public function setFecha($fecha){
        $this->fecha=$fecha;
        self::guarda($this);
    }

    public function setCreador($creador){
        $this->creador=$creador;
        self::guarda($this);
    }

    public function setComentario($comentario){
        $this->comentario=$comentario;
        self::guarda($this);
    }

    public function setRespuestas($respuestas){
        $this->respuestas=$respuestas;
        self::guarda($this);
    }
}
