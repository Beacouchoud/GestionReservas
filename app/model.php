<?php
include_once ('config/Config.php');

class Model extends PDO
{

    protected $conexion;

    public function __construct()
    {    
        $this->conexion = new PDO('mysql:host=' . Config::$mvc_bd_hostname . ';dbname=' . Config::$mvc_bd_nombre . '', Config::$mvc_bd_usuario, Config::$mvc_bd_clave);
        // Realiza el enlace con la BD en utf-8
        $this->conexion->exec("set names utf8");
        $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);     
    }

   

    public function dameaulas()
    {
        $consulta = "select * from aulas ";
        $result = $this->conexion->query($consulta);
        return $result->fetchAll();
    }
    
    public function reservas($f, $a) {        
        $consulta = "select id_reserva, id_usuario, fecha, hora from reservas rs, aulas au where au.id_aula = rs.id_aula and rs.fecha = :fecha and au.num_aula = :id_aula";
        
        $result = $this->conexion->prepare($consulta);
        $result->bindParam(':fecha', $f);
        $result->bindParam(':id_aula', $a);
        $result->execute(); 
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertarUsuario($n, $a, $e, $p)
    {    
        $consulta = "INSERT into usuarios(nombre, apellido, email, password, id_roles, habilitado, imagen) values (:nombre, :apellido, :email, :password, :id_roles, :habilitado, :imagen)";

        $result = $this->conexion->prepare($consulta);
        $img="dfasdf";
        $habilitado=0;
        $id_roles=0;
        $result->bindParam(':nombre', $n);
        $result->bindParam(':apellido', $a);
        $result->bindParam(':email', $e);
        $result->bindParam(':password', $p);
        $result->bindParam('id_roles', $id_roles);
        $result->bindParam('habilitado', $habilitado);
        $result->bindParam('imagen', $img);
        $result->execute();
     
        return $result;
    }

    // public function dameUsuario($nombre_usuario)
    // {
        
    //         $consulta = "select * from usuarios where nombre_usuario=:nombre_usuario";
            
    //         $result = $this->conexion->prepare($consulta);
    //         $result->bindParam(':nombre_usuario', $nombre_usuario);
    //         $result->execute();
    //         return $result->fetch();
            
        
    // }

    function logIn($email, $pwd) {

        // $email = $email + '@algo';
        $consulta = "SELECT * from usuarios where email = :email and password = :pwd";

        $result = $this->conexion->prepare($consulta);
        $result->bindParam(':email', $email);
        $result->bindParam(':pwd', $pwd);
        $result->execute();
        $user = $result->fetch(PDO::FETCH_ASSOC);
        if ($user != null) {
            return JSON_encode($user);
        } else  {
            return null;
        }
    }



}
?>
