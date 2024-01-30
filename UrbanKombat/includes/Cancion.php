<?php 
require_once __DIR__.'/Aplicacion.php';
class Cancion{

    private $id;
    private $nombre;
    private $artista;
    private $votos;
    private $duracion;
    private $esGanadora;
    private $comentario;

    private function __construct($nombre, $artista, $votos, $duracion, $comentario){
        $this->nombre=$nombre;
        $this->artista=$artista;
        $this->votos=$votos;
        $this->duracion=$duracion;
        $this->esGanadora=false;
        $this->comentario=$comentario;
    }

    public static function registraVoto($id){
        $app=Aplicacion::getInstancia();
        $conn = $app->conexionBd();
        $query=sprintf("UPDATE Canciones SET votos = votos + 1 where id ='%d'"
        , $conn->real_escape_string($id));

        if ($conn->query($query) === TRUE){
            $mensajeVotacion = <<<EOS
                <p> ¡Gracias por votar! </p>
            EOS;
        } else {
            $mensajeVotacion = <<<EOS
                "Error en : " . $query . "<br>" . $conn->error
            EOS;
        }
        return $mensajeVotacion;

    }

    public static function addCancion($nombre,$artista, $duracion, $comentario){
        $song=self::buscaCancion($nombre);
        if($song){
            return false;
        }
        $song = new Cancion($nombre, $artista, 0, $duracion,$comentario);
        return self::guarda($song);
    }

    public static function guarda($cancion)
    {
        if ($cancion->id !== null) {
            return self::actualiza($cancion);
        }
        return self::inserta($cancion);
    }


    public static function buscaCancion($nombre){
        $app=Aplicacion::getInstancia();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT * FROM Canciones C WHERE C.nombre = '%s'", $conn->real_escape_string($nombre));
        $rs = $conn->query($query);
        $result = false;
        if ($rs) {
            if ( $rs->num_rows == 1) {
                $fila = $rs->fetch_assoc();
                $song = new Cancion($fila['nombre'], $fila['artista'], $fila['votos'], $fila['duracion'], $fila['esGanadora'], $fila['comentario']);
                $song->id = $fila['id'];
                $result = $song;
            }
            $rs->free();
        } else {
            echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $result;
    }

    private static function inserta($cancion){
        $app = Aplicacion::getInstancia();
        $conn = $app->conexionBd();
        $query=sprintf("INSERT INTO Canciones(nombre, artista, votos, duracion, esGanadora, comentario) VALUES('%s','%s', '%d', '%d', '%d', '%s')"
            , $conn->real_escape_string($cancion->nombre)
            , $conn->real_escape_string($cancion->artista)
            , $conn->real_escape_string($cancion->votos)
            , $conn->real_escape_string($cancion->duracion)
            , $conn->real_escape_string($cancion->esGanadora)
            , $conn->real_escape_string($cancion->comentario));
        if ( $conn->query($query) ) {
            $cancion->id = $conn->insert_id;
        } else {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $cancion;
    }

    //ACTUALIZAR A CANCION
    private static function actualiza($cancion){
        $result = false;
        $app = Aplicacion::getInstancia();
        $conn = $app->conexionBd();
        $query=sprintf("UPDATE Canciones U SET nombre = '%s', artista='%s', votos='%d', duracion='%d', esGanadora='%d', comentario='%s' WHERE U.id=%d"
            , $conn->real_escape_string($cancion->nombre)
            , $conn->real_escape_string($cancion->artista)
            , $conn->real_escape_string($cancion->votos)
            , $conn->real_escape_string($cancion->duracion)
            , $conn->real_escape_string($cancion->esGanadora)
            , $conn->real_escape_string($cancion->comentario)
            , $cancion->id);
        if ( $conn->query($query) ) {
            if ( $conn->affected_rows !== 1) {
                
                echo "No se ha podido actualizar la cancion: " . $cancion->id;
            }
            else{
                $result = $cancion;
            }
        } else {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
        }
        
        return $result;
    }

    public function getId(){
        return $this->id;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function getArtista(){
        return $this->artista;
    }

    public function getVotos(){
        return $this->votos;
    }

    public function getDuracion(){
        return $this->duracion;
    }

    public function getEsGanadora(){
        return $this->esGanadora;
    }

    public function getComentario(){
        return $this->comentario;
    }

    public function setNombre($nombre){
        $this->nombre=$nombre;
        self::guarda($this);
    }

    public function setArtista($artista){
        $this->artista=$artista;
        self::guarda($this);
    }

    public function setDuracion($duracion){
        $this->duracion=$duracion;
        self::guarda($this);
    }

    public function setVotos($votos){
        $this->votos=$votos;
        self::guarda($this);
    }

    public function setComentario($comentario){
        $this->comentario=$comentario;
        self::guarda($this);
    }

    public function setEsGanadora(){
        if($this->esGanadora){
            $this->esGanadora=false;
        }else{
            $this->esGanadora=true;
        }
        self::guarda($this);
    }

    public static function cargarCanciones(){
        $app = Aplicacion::getInstancia();
        $conn = $app->conexionBd();
        $sql = "SELECT * FROM Canciones";
        $result = $conn->query($sql);

        return $result;
    }

    public static function borrarCancion($nombre){
        $song=self::buscaCancion($nombre);
        $result=false;
        if(!$song){
            return $result;
        }else{
            $app = Aplicacion::getInstancia();
            $conn = $app->conexionBd();
            $query=sprintf("DELETE FROM Canciones WHERE nombre='%s'"
            ,$conn->real_escape_string($nombre));
            if ( $conn->query($query) ) {
                if ( $conn->affected_rows != 1) {
                    echo "No se ha podido borrar la cancion: " . $song->id;
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