<?php
require_once __DIR__.'/Aplicacion.php';
class Artista{
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
        $query=sprintf("UPDATE Artistas SET votos = votos + 1 where id ='%d'"
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

    public static function addArtista($nombre, $comentario){
        $artist=self::buscaArtista($nombre);
        if($artist){
            return false;
        }
        $artist = new Artista($nombre, 0, $comentario);
        return self::guarda($artist);
    }

    public static function guarda($artista)
    {
        if ($artista->id !== null) {
            return self::actualiza($artista);
        }
        return self::inserta($artista);
    }

    public static function buscaArtista($nombre){
        $app=Aplicacion::getInstancia();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT * FROM Artistas A WHERE A.nombre = '%s'", $conn->real_escape_string($nombre));
        $rs = $conn->query($query);
        $result = false;
        if ($rs) {
            if ( $rs->num_rows == 1) {
                $fila = $rs->fetch_assoc();
                $artist = new Artista($fila['nombre'], $fila['votos'], $fila['esGanador'], $fila['comentario']);
                $artist->id = $fila['id'];
                $result = $artist;
            }
            $rs->free();
        } else {
            echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $result;
    }

    private static function inserta($artista){
        $app = Aplicacion::getInstancia();
        $conn = $app->conexionBd();
        $query=sprintf("INSERT INTO Artistas (nombre, votos, esGanador, comentario) VALUES('%s', '%d', '%d', '%s')"
            , $conn->real_escape_string($artista->nombre)
            , $conn->real_escape_string($artista->votos)
            , $conn->real_escape_string($artista->esGanador)
            , $conn->real_escape_string($artista->comentario));
        if ( $conn->query($query) ) {
            $artista->id = $conn->insert_id;
        } else {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $artista;
    }


    private static function actualiza($artista){
        $result = false;
        $app = Aplicacion::getInstancia();
        $conn = $app->conexionBd();
        $query=sprintf("UPDATE Artistas U SET nombre = '%s', votos ='%d', esGanador='%d', comentario='%s'WHERE U.id=%d"
            , $conn->real_escape_string($artista->nombre)
            , $conn->real_escape_string($artista->votos)
            , $conn->real_escape_string($artista->esGanador)
            , $conn->real_escape_string($artista->comentario)
            , $artista->id);
        if ( $conn->query($query) ) {
            if ( $conn->affected_rows != 1) {
                echo "No se ha podido actualizar el artista: " . $artista->id;
            }
            else{
                $result = $artista;
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

    public static function cargarArtistas(){
        $app = Aplicacion::getInstancia();
        $conn = $app->conexionBd();
        $sql = "SELECT * FROM Artistas";
        $result = $conn->query($sql);

        return $result;
    }

    public static function borrarArtista($nombre){
        $artista=self::buscaArtista($nombre);
        $result= false;
        if(!$artista){
            return $result;
        }else{
            $app = Aplicacion::getInstancia();
            $conn = $app->conexionBd();
            $query=sprintf("DELETE FROM Artistas WHERE nombre='%s'"
            ,$conn->real_escape_string($nombre));
            if ( $conn->query($query) ) {
                if ( $conn->affected_rows != 1) {
                    echo "No se ha podido borrar el artista: " . $artista->id;
                }
                else{
                    $result = true;
                }
            } else {
                echo "Error al borrar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            }
            
            return $result;
        }

    }
}