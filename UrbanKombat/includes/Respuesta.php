
<?php 
require_once __DIR__.'/Aplicacion.php';

class Respuesta{
    public $id;
    public $usuario;
    public $texto;
    public $fecha;
    public $id_tema;
    public function __construct($id, $usuario, $texto, $fecha, $id_tema){
         $this->id=$id;
         $this->usuario=$usuario;
         $this->texto=$texto;
         $this->fecha=$fecha;
         $this->id_tema=$id_tema;
     }

     public static function addRespuesta($id, $usuario, $texto, $fecha, $id_tema){
        $res=new Respuesta($id, $usuario, $texto, $fecha, $id_tema); 
        return self::guarda($res);
    }

    public static function guarda($res){
        if($res->id!=null){
            return self::actualiza($res);
        }
        return self::inserta($res);
    }

    public static function inserta($res){
        $app=Aplicacion::getInstancia();
        $conn=$app->conexionBD();
        $query=sprintf("INSERT INTO respuestas(usuario, texto, fecha, id_tema) VALUES ('%s', '%s', '%s', '%d')"
        ,$conn->real_escape_string($res->usuario)
        ,$conn->real_escape_string($res->texto)
        ,$conn->real_escape_string($res->fecha)
        ,$conn->real_escape_string($res->id_tema));
        if ( $conn->query($query) ) {
            $res->id = $conn->insert_id;
        } else {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $res;
    }

    public static function buscaRespuesta($id){
        $app=Aplicacion::getInstancia();
        $conn=$app->conexionBD();
        $query=sprintf("SELECT * FROM respuestas WHERE id='%d'"
        ,$conn->real_escape_string($id));
        $rs=$conn->query($query);
        $result=false;
        if($rs){
            if($rs->num_rows==1){
                $fila=$rs->fetch_assoc();
                $res=new Respuesta($fila['id'], $fila['usuario'], $fila['texto'], $fila['fecha'], $fila['id_tema']);
                $result=$res;
            }
            $rs->free();
        }else{
            echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $result;
    }

    public static function actualiza($res){
        $result = false;
        $app = Aplicacion::getInstancia();
        $conn = $app->conexionBd();
        $query=sprintf("UPDATE respuestas U SET id = '%d', usuario='%s', texto='%s', fecha='%s', id_tema='%d' WHERE U.id=%d"
            , $conn->real_escape_string($res->id)
            , $conn->real_escape_string($res->usuario)
            , $conn->real_escape_string($res->texto)
            , $conn->real_escape_string($res->fecha)
            , $conn->real_escape_string($res->id_tema)
            , $res->id);
        if ( $conn->query($query) ) {
            if ( $conn->affected_rows != 1) {
                echo "No se ha podido actualizar la respuesta: " . $res->id;
            }
            else{
                $result = $res;
            }
        } else {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
        }
        
        return $result;
    }
    public static function cargarRespuesta($id){
        $app = Aplicacion::getInstancia();
        $conn = $app->conexionBd();
        $sql = sprintf("SELECT * FROM respuestas WHERE id_tema='%s'"
        , $conn->real_escape_string($id));
        $result = $conn->query($sql);

        return $result;
    }

    

    public static function borrarRespuesta($id){
        $res=self::buscaRespuesta($id);
        $result=false;
        if(!$res){
            return $result;
        }else{
            $app = Aplicacion::getInstancia();
            $conn = $app->conexionBd();
            $query=sprintf("DELETE FROM respuestas WHERE id='%s'"
            ,$conn->real_escape_string($id));
            if ( $conn->query($query) ) {
                if ( $conn->affected_rows != 1) {
                    echo "No se ha podido borrar el producto: " . $res->id;
                }
                else{
                    $result =true;
                }
            } else {
                echo "Error al borrar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            }
            
            return $result;
        }
    }

    public function getId(){
        return $this->id;
    }

    public function getUsuario(){
        return $this->usuario;
    }

    public function getFecha(){
        return $this->fecha;
    }

    public function getTexto(){
        return $this->texto;
    }

    public function getId_tema(){
        return $this->id_tema;
    }

    public function setUsuario($usuario){
        $this->usuario=$usuario;
        self::guarda($this);
    }

    public function setFecha($fecha){
        $this->fecha=$fecha;
        self::guarda($this);
    }

    public function setTexto($texto){
        $this->texto=$texto;
        self::guarda($this);
    }

    public function setId_Tema($id_tema){
        $this->id_tema=$id_tema;
        self::guarda($this);
    }
}