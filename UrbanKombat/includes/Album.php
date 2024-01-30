<?php
require_once __DIR__.'/Aplicacion.php';

class Album{
    private $id;
    private $nombre;
    private $votos;
    private $esGanador;
    private $comentario;


    private function __construct($nombre, $votos, $comentario){
        $this->nombre=$nombre;
        $this->votos=$votos;
        $this->esGanadora=false;
        $this->comentario=$comentario;
    }

    public static function registraVoto($id){
        $app=Aplicacion::getInstancia();
        $conn = $app->conexionBd();
        $query=sprintf("UPDATE Albumes SET votos = votos + 1 where id = '%d'"
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

    public static function addAlbum($nombre, $comentario){
        $album=self::buscaAlbum($nombre);
        if($album){
            return false;
        }
        $album = new Album($nombre,0,$comentario);
        return self::guarda($album);
    }

    public static function guarda($album)
    {
        if ($album->id !== null) {
            return self::actualiza($album);
        }
        return self::inserta($album);
    }


    public static function buscaAlbum($nombre){
        $app=Aplicacion::getInstancia();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT * FROM Albumes A WHERE A.nombre = '%s'", $conn->real_escape_string($nombre));
        $rs = $conn->query($query);
        $result = false;
        if ($rs) {
            if ( $rs->num_rows == 1) {
                $fila = $rs->fetch_assoc();
                $album = new Album($fila['nombre'], $fila['votos'], $fila['esGanador'], $fila['comentario']);
                $album->id = $fila['id'];
                $result = $album;
            }
            $rs->free();
        } else {
            echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $result;
    }

    private static function inserta($album){
        $app = Aplicacion::getInstancia();
        $conn = $app->conexionBd();
        $query=sprintf("INSERT INTO Albumes (nombre, votos, esGanador, comentario) VALUES('%s', '%d', '%d', '%s')"
            , $conn->real_escape_string($album->nombre)
            , $conn->real_escape_string($album->votos)
            , $conn->real_escape_string($album->esGanador)
            , $conn->real_escape_string($album->comentario));
        if ( $conn->query($query) ) {
            $album->id = $conn->insert_id;
        } else {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $album;
    }

    private static function actualiza($album){
        $result = false;
        $app = Aplicacion::getInstancia();
        $conn = $app->conexionBd();
        $query=sprintf("UPDATE Albumes U SET nombre = '%s', votos ='%d', esGanador='%d', comentario='%s'WHERE id=%d"
            , $conn->real_escape_string($album->nombre)
            , $conn->real_escape_string($album->votos)
            , $conn->real_escape_string($album->esGanador)
            , $conn->real_escape_string($album->comentario)
            , $album->id);
        if ( $conn->query($query) ) {
            if ( $conn->affected_rows != 1) {
                echo "No se ha podido actualizar el album: " . $album->id;
            }
            else{
                $result = $album;
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

    public function getVotos(){
        return $this->votos;
    }

    public function getEsGanador(){
        return $this->esGanador;
    }

    public function getComentario(){
        return $this->comentario;
    }

    public function setNombre($nombre){
        $this->nombre=$nombre;
        self::guarda($this);
    }

    public function setVotos($votos){
        $this->votos=$votos;
        self::guarda($this);
    }

    public function setEsGanador(){
        if($this->esGanador){
            $this->esGanador=false;
        }else{
            $this->esGanador=true;
        }
        self::guarda($this);
    }

    public function setComentario($comentario){
        $this->comentario=$comentario;
        self::guarda($this);
    }
    
    public static function cargarAlbumes(){
        $app = Aplicacion::getInstancia();
        $conn = $app->conexionBd();
        $sql = "SELECT * FROM Albumes";
        $result = $conn->query($sql);

        return $result;
    }

    public static function borrarAlbum($nombre){
        $album=self::buscaAlbum($nombre);
        $result=false;
        if(!$album){
            return $result;
        }else{
            $app = Aplicacion::getInstancia();
            $conn = $app->conexionBd();
            $query=sprintf("DELETE FROM Albumes WHERE nombre='%s'"
            ,$conn->real_escape_string($nombre));
            if ( $conn->query($query) ) {
                if ( $conn->affected_rows != 1) {
                    echo "No se ha podido borrar el album: " . $album->id;
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