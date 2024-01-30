<?php
require_once __DIR__.'/Aplicacion.php';
require_once __DIR__.'/Respuesta.php';

class Musica extends Respuesta {
/* hay q cambiar la tabla de respuestas para q haya otra columna y cambiar todas las queries en las q aparezca esta tabla*/
    private function __construct($id, $usuario, $texto, $fecha, $id_tema){
        parent::__construct($id, $usuario, $texto, $fecha, $id_tema);
    }

    public static function addRespuesta($id, $usuario, $texto, $fecha, $id_tema){
        $url = self::insertarApi($texto); // en verdad sería un iframe, no un url. $url => pasa a ser $texto más adelante
        $res = new Musica($id, $usuario, $url, $fecha, $id_tema); 
        return self::guarda($res);
    }

    public static function guarda($res){
        if($res->id != null){
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

    public static function insertarApi($u) {
        $aux = parse_url($u);
        $urlRet = "";

        if($aux['host'] == "www.youtube.com") { 
            parse_str($aux['query'], $array);
            $urlRet = self::displayYouTube($array['v']); //v=id, sólo queremos el id  
        }
        else if ($aux['host'] == "open.spotify.com") {
            $urlSP = substr_replace($u, 'embed/', 25, 0);
            $urlRet = self::displaySpotify($urlSP); 
        }
        else {
            echo '<script language="javascript">alert("El link introducido es erróneo");</script>';
        }
        return $urlRet;
    }

    public static function displayYoutube($url){
        $urlYT = "https://www.youtube.com/embed/".$url."/";
        $cancionYoutube = <<<EOS
            <iframe src=$urlYT title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        EOS;
        return $cancionYoutube;
        // TODO: CUANDO MUESTRA EL VIDEO QUEDA ALGO SIN CERRAR PQ NO SE GENERA MAS HTML. Se corta exactamente en frameborder="
    }
    
    // TODO hacer que funcionen el resto de las apis
    public static function displaySpotify($url){
        $urlSpotify = $url . "utm_source=generator";
        $cancionSpotify = <<<EOS
            <iframe class="spotifySong" src=$urlSpotify  frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture"></iframe>
        EOS;
        // también corta el código, y se queda con una forma rara
        return $cancionSpotify;
    }
}
?>