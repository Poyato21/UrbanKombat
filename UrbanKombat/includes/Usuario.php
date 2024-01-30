<?php
require_once __DIR__.'/Aplicacion.php';

class Usuario
{
    private $id;

    private $nombreUsuario;

    private $nombre;

    private $password;

    private $rol;

    private $votoAlbum;     //bool

    private $votoArtista;   //bool

    private $votoCancion;   //bool

    private $tarjetaYT;
    
    private $tarjetaSpoti;

    private $tarjetaApple;

    private $concurso;

    private function __construct($nombreUsuario, $nombre, $password, $rol, $votoAlbum, $votoArtista,
                                $votoCancion, $tarjetaYT, $tarjetaSpoti, $tarjetaApple, $concurso)
    {
        $this->nombreUsuario= $nombreUsuario;
        $this->nombre = $nombre;
        $this->password = $password;
        $this->rol = $rol;
        $this->votoAlbum=$votoAlbum;
        $this->votoArtista=$votoArtista;
        $this->votoCancion=$votoCancion;
        $this->tarjetaYT=$tarjetaYT;
        $this->tarjetaSpoti=$tarjetaSpoti;
        $this->tarjetaApple=$tarjetaApple;
        $this->concurso=$concurso;
    }

    public static function login($nombreUsuario, $password)
    {
        $usuario = self::buscaUsuario($nombreUsuario);
        if ($usuario && $usuario->compruebaPassword($password)) {
            return $usuario;
        }
        return false;
    }

    public static function buscaUsuario($nombreUsuario)
    {
        $app = Aplicacion::getInstancia();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT * FROM usuarios U WHERE U.nombreUsuario = '%s'", $conn->real_escape_string($nombreUsuario));
        $rs = $conn->query($query);
        $result = false;
        if ($rs) {
            if ( $rs->num_rows == 1) {
                $fila = $rs->fetch_assoc();
                $user = new Usuario($fila['nombreUsuario'], $fila['nombre'], $fila['password'], $fila['rol']
                ,$fila['votoAlbum'], $fila['votoArtista'], $fila['votoCancion'], $fila['tarjetaYT'], $fila['tarjetaSpoti'], $fila['tarjetaApple'],
                $fila['concurso']);
                $user->id = $fila['id'];
                $result = $user;
            }
            $rs->free();
        } else {
            echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $result;
    }
    public static function buscaUsuarioPorId($id)
    {
        $app = Aplicacion::getInstancia();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT * FROM usuarios U WHERE U.id = '%s'", $conn->real_escape_string($id));
        $rs = $conn->query($query);
        $result = false;
        if ($rs) {
            if ( $rs->num_rows == 1) {
                $fila = $rs->fetch_assoc();
                $user = new Usuario($fila['nombreUsuario'], $fila['nombre'], $fila['password'], $fila['rol']
                ,$fila['votoAlbum'], $fila['votoArtista'], $fila['votoCancion'], $fila['tarjetaYT'], $fila['tarjetaSpoti'], $fila['tarjetaApple'],
                $fila['concurso']);
                $user->id = $fila['id'];
                $result = $user;
            }
            $rs->free();
        } else {
            echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $result;
    }

    public static function crea($nombreUsuario, $nombre, $password, $rol)
    {
        $user = self::buscaUsuario($nombreUsuario);
        if ($user) {
            return false;
        } 
        $user = new Usuario($nombreUsuario, $nombre, self::hashPassword($password), $rol, 0, 0, 0, '', '','', 0);
        return self::guarda($user);
    }
    
    private static function hashPassword($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public static function guarda($usuario)
    {
        if ($usuario->id !== null) {
            return self::actualiza($usuario);
        }
        return self::inserta($usuario);
    }

    private static function inserta($usuario)
    {
        $app = Aplicacion::getInstancia();
        $conn = $app->conexionBd();
        $query=sprintf("INSERT INTO usuarios(nombreUsuario, nombre, password, rol, votoAlbum, votoArtista, votoCancion, 
        tarjetaYT, tarjetaSpoti,tarjetaApple, concurso) VALUES('%s', '%s', '%s', '%s','%d','%d','%d','%d','%d','%d', '%d')"
            , $conn->real_escape_string($usuario->nombreUsuario)
            , $conn->real_escape_string($usuario->nombre)
            , $conn->real_escape_string($usuario->password)
            , $conn->real_escape_string($usuario->rol)
            ,$conn->real_escape_string($usuario->votoAlbum)
            ,$conn->real_escape_string($usuario->votoArtista)
            ,$conn->real_escape_string($usuario->votoCancion)
            ,$conn->real_escape_string($usuario->tarjetaYT)
            ,$conn->real_escape_string($usuario->tarjetaSpoti)
            ,$conn->real_escape_string($usuario->tarjetaApple)
            ,$conn->real_escape_string($usuario->concurso));
        if ( $conn->query($query) ) {
            $usuario->id = $conn->insert_id;
        } else {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $usuario;
    }
    
    private static function actualiza($usuario)
    {
        $result = false;
        $app = Aplicacion::getInstancia();
        $conn = $app->conexionBd();
        $query=sprintf("UPDATE usuarios U SET nombreUsuario = '%s', nombre='%s', password='%s', rol='%s'
        ,votoAlbum='%d', votoArtista='%d', votoCancion='%d', tarjetaYT='%d', tarjetaSpoti='%d', tarjetaApple='%d', concurso='%d'
        WHERE U.id=%d"
            , $conn->real_escape_string($usuario->nombreUsuario)
            , $conn->real_escape_string($usuario->nombre)
            , $conn->real_escape_string($usuario->password)
            , $conn->real_escape_string($usuario->rol)
            ,$conn->real_escape_string($usuario->votoAlbum)
            ,$conn->real_escape_string($usuario->votoArtista)
            ,$conn->real_escape_string($usuario->votoCancion)
            ,$conn->real_escape_string($usuario->tarjetaYT)
            ,$conn->real_escape_string($usuario->tarjetaSpoti)
            ,$conn->real_escape_string($usuario->tarjetaApple)
            ,$conn->real_escape_string($usuario->concurso)
            , $usuario->id);

        if ( $conn->query($query) ) {
            if ( $conn->affected_rows != 1) {
                echo "No se ha podido actualizar el usuario: " . $usuario->id;
            }
            else{
                $result = $usuario;
            }
        } else {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
        }
        
        return $result;
    }
   
    public static function borra($usuario)
    {
        return self::borraPorId($usuario->id);
    }
    
    public static function borraPorId($idUsuario)
    {
        if (!$idUsuario) {
            return false;
        } 
        
        $app = Aplicacion::getInstancia();
        $conn = $app->conexionBd();
        $query = sprintf("DELETE FROM usuarios WHERE id = %d"
        ,$conn->real_escape_string($idUsuario));
        if ( ! $conn->query($query) ) {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
            return false;
        }
        return true;
    }

    public function getId(){
        return $this->id;
    }

    public function getNombreUsuario()
    {
        return $this->nombreUsuario;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getRol()
    {
        return $this->rol;
    }

    public function setNombreUsuario($nombreUsuario)
    {
        $this->nombreUsuario=$nombreUsuario;
        self::guarda($this);
    }

    public function setNombre($nombre)
    {
        $this->nombre=$nombre;
        self::guarda($this);
    }

    public function setRol($rol)
    {
        $this->rol=$rol;
        self::guarda($this);
    }


    public function compruebaPassword($password)
    {
        return password_verify($password, $this->password);
    }

    public function cambiaPassword($nuevoPassword)
    {
        $this->password = self::hashPassword($nuevoPassword);
    }
    
    public function borrate()
    {
        if ($this->id !== null) {
            return self::borra($this);
        }
        return false;
    }
    public static function setConcursantes(){
        $app=Aplicacion::getInstancia();
        $conn = $app->conexionBd();
        $query=sprintf("UPDATE usuarios SET concurso = 0 WHERE concurso=1");
        if ( $conn->query($query) ) {
            if ( $conn->affected_rows < 1) {
                echo "No se ha podido actualizar el usuario ";
            }
        } else {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
        }
    }

    public static function setVotoCancion($i){
        $app=Aplicacion::getInstancia();
        $conn = $app->conexionBd();
        $query=sprintf("UPDATE usuarios SET votoCancion = 1 where nombreUsuario ='%s'"
        , $conn->real_escape_string($i));
        if ( $conn->query($query) ) {
            if ( $conn->affected_rows != 1) {
                echo "No se ha podido actualizar el usuario ";
            }
        } else {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
        }
    }

    public static function getVotoCancion($i){
        $app=Aplicacion::getInstancia();
        $conn = $app->conexionBd();
        $query=sprintf("SELECT votoCancion FROM usuarios where nombreUsuario ='%s'"
        , $conn->real_escape_string($i));
        $result=$conn->query($query);

        $row=$result->fetch_assoc();
        return $row['votoCancion'];
        
    }

    public static function setVotoAlbum($i){
        $app=Aplicacion::getInstancia();
        $conn = $app->conexionBd();
        $query=sprintf("UPDATE usuarios SET votoAlbum = 1 where nombreUsuario ='%s'"
        , $conn->real_escape_string($i));
        if ( $conn->query($query) ) {
            if ( $conn->affected_rows != 1) {
                echo "No se ha podido actualizar el usuario";
            }
        } else {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
        }
    
    }

    public static function getVotoAlbum($i){
        $app=Aplicacion::getInstancia();
        $conn = $app->conexionBd();
        $query=sprintf("SELECT votoAlbum FROM usuarios where nombreUsuario ='%s'"
        , $conn->real_escape_string($i));
        $result=$conn->query($query);

        $row=$result->fetch_assoc();
        return $row['votoAlbum'];
    }

    public static function setVotoArtista($i){
        $app=Aplicacion::getInstancia();
        $conn = $app->conexionBd();
        $query=sprintf("UPDATE usuarios SET votoArtista = 1 where nombreUsuario ='%s'"
        , $conn->real_escape_string($i));
        if ( $conn->query($query) ) {
            if ( $conn->affected_rows != 1) {
                echo "No se ha podido actualizar el usuario";
            }
        } else {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
        }
    }

    public static function getVotoArtista($i){
        $app=Aplicacion::getInstancia();
        $conn = $app->conexionBd();
        $query=sprintf("SELECT votoArtista FROM usuarios where nombreUsuario ='%s'"
        , $conn->real_escape_string($i));
        $result=$conn->query($query);

        $row=$result->fetch_assoc();
        return $row['votoArtista'];
    }


    public static function getTarjetaYT($i){
        $app=Aplicacion::getInstancia();
        $conn = $app->conexionBd();
        $query=sprintf("SELECT tarjetaYT FROM usuarios where nombreUsuario ='%s'"
        , $conn->real_escape_string($i));
        $result=$conn->query($query);

        $row=$result->fetch_assoc();
        return $row['tarjetaYT'];
    }

    public static function setTarjetaYT($i, $codigo){
        $app=Aplicacion::getInstancia();
        $conn = $app->conexionBd();
        $query=sprintf("UPDATE usuarios SET tarjetaYT = '%s' where nombreUsuario ='%s'"
        ,$conn->real_escape_string($codigo)
        , $conn->real_escape_string($i));
        if ( $conn->query($query) ) {
            if ( $conn->affected_rows != 1) {
                echo "No se ha podido actualizar el usuario";
            }
        } else {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
        }
    }

    public static function getTarjetaSpoti($i){
        $app=Aplicacion::getInstancia();
        $conn = $app->conexionBd();
        $query=sprintf("SELECT tarjetaSpoti FROM usuarios where nombreUsuario ='%s'"
        , $conn->real_escape_string($i));
        $result=$conn->query($query);

        $row=$result->fetch_assoc();
        return $row['tarjetaSpoti'];
    }

    public static function setTarjetaSpoti($i, $codigo){
        $app=Aplicacion::getInstancia();
        $conn = $app->conexionBd();
        $query=sprintf("UPDATE usuarios SET tarjetaSpoti = '%s' where nombreUsuario ='%s'"
        ,$conn->real_escape_string($codigo)
        ,$conn->real_escape_string($i));
        if ( $conn->query($query) ) {
            if ( $conn->affected_rows != 1) {
                echo "No se ha podido actualizar el usuario";
            }
        } else {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
        }
    }

    public static function getTarjetaApple($i){
        $app=Aplicacion::getInstancia();
        $conn = $app->conexionBd();
        $query=sprintf("SELECT tarjetaApple FROM usuarios where nombreUsuario ='%s'"
        , $conn->real_escape_string($i));
        $result=$conn->query($query);

        $row=$result->fetch_assoc();
        return $row['tarjetaApple'];
    }

    public static function setTarjetaApple($i, $codigo){
        $app=Aplicacion::getInstancia();
        $conn = $app->conexionBd();
        $query=sprintf("UPDATE usuarios SET tarjetaApple = '%s' where nombreUsuario ='%s'"
        ,$conn->real_escape_string($codigo)
        ,$conn->real_escape_string($i));
        if ( $conn->query($query) ) {
            if ( $conn->affected_rows != 1) {
                echo "No se ha podido actualizar el usuario";
            }
        } else {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
        }
    }


    public static function cargarUsuario(){
        $app = Aplicacion::getInstancia();
        $conn = $app->conexionBd();
        $sql = "SELECT * FROM usuarios";
        $result = $conn->query($sql);

        return $result;
    }

    public static function getConcurso($i){
        $app=Aplicacion::getInstancia();
        $conn = $app->conexionBd();
        $query=sprintf("SELECT concurso FROM usuarios where nombreUsuario ='%s'"
        , $conn->real_escape_string($i));
        $result=$conn->query($query);

        $row=$result->fetch_assoc();
        return $row['concurso'];
    }

    public static function getGanador(){
        $app=Aplicacion::getInstancia();
        $conn = $app->conexionBd();
        $query=sprintf("SELECT * FROM usuarios WHERE concurso=1 ORDER BY rand() LIMIT 1
        ");
        $rs=$conn->query($query);
        $result=false;
        if($rs){
            if($rs->num_rows==1){
                $fila=$rs->fetch_assoc();
                $result = $fila["nombreUsuario"];
            }
            $rs->free();
        }
        else{
            $result=false;
        }
        return $result;
    }

    public static function setConcurso($i){
        $app=Aplicacion::getInstancia();
        $conn = $app->conexionBd();
        $query=sprintf("UPDATE usuarios SET concurso = 1 where nombreUsuario ='%s'"
        , $conn->real_escape_string($i));
        if ( $conn->query($query) ) {
            if ( $conn->affected_rows != 1) {
                echo "No se ha podido actualizar el usuario";
            }
        } else {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
        }
    }

  
}