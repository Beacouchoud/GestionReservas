<?php
include_once 'config/Config.php';

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

    public function reservas($f, $a)
    {
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
        $img = "dfasdf";
        $habilitado = 0;
        $id_roles = 0;
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

    public function logIn($email, $pwd)
    {

        // $email = $email + '@algo';
        $consulta = "SELECT * from usuarios where email = :email and password = :pwd";

        $result = $this->conexion->prepare($consulta);
        $result->bindParam(':email', $email);
        $result->bindParam(':pwd', $pwd);
        $result->execute();
        $user = $result->fetch(PDO::FETCH_ASSOC);
        if ($user != null) {
            anyadirSesion("user", $user[0]["id_usuario"]);
            anyadirSesion("acceso", $user[0]["id_roles"]);
            return JSON_encode($user);
        } else {
            return null;
        }
    }

    public function hacerReserva($f, $a, $h)
    {
        $consulta = "insert into reservas(id_usuario, id_aula, fecha, hora) values(:id_usuario, :id_aula, :fecha, :hora)";

        $result = $this->conexion->prepare($consulta);
        $result->bindValue(':id_usuario', $_SESSION["user"], PDO::PARAM_STR);
        $result->bindValue(':id_aula', $a, PDO::PARAM_STR);
        $result->bindValue(':fecha', $f, PDO::PARAM_STR);
        $result->bindValue(':hora', $h, PDO::PARAM_STR);
        return $result->execute();
    }

    public function borrarReserva($f, $a, $h)
    {
        $consulta = "DELETE FROM aulas WHERE id_aula = :id_aula";

        $result = $this->conexion->prepare($consulta);
        $result->bindValue(':id_aula', $a, PDO::PARAM_STR);
        return $result->execute();
    }

    public function crearAula($id_aula, $num_aula, $habilitado, $descripcion_aula)
    {
        $consulta = "INSERT INTO aulas(id_aula, num_aula, habilitado, descripcion_aula) VALUES (:id_aula, :num_aula, 0, :descripcion_aula)";

        $result = $this->conexion->prepare($consulta);
        $result->bindValue(':id_aula', $id_aula, PDO::PARAM_STR);
        $result->bindValue(':num_aula', $num_aula, PDO::PARAM_STR);
        $result->bindValue(':descripcion_aula', $descripcion_aula, PDO::PARAM_STR);
        return $result->execute();
    }

    public function modificarAula($id_aula, $num_aula, $habilitado, $descripcion_aula)
    {
        $consulta = "UPDATE FROM aulas SET num_aula=:num_aula, descripcion_aula=:descripcion_aula, WHERE id_aula = :id_aula";

        $result = $this->conexion->prepare($consulta);
        $result->bindValue(':id_aula', $id_aula, PDO::PARAM_STR);
        $result->bindValue(':num_aula', $num_aula, PDO::PARAM_STR);
        $result->bindValue(':descripcion_aula', $descripcion_aula, PDO::PARAM_STR);
        return $result->execute();
    }

    public function habilitarAula($id_aula, $habilitar)
    {
        $consulta = "UPDATE FROM aulas SET habilitado=:habilitar WHERE id_aula = :id_aula";

        $result = $this->conexion->prepare($consulta);
        $result->bindValue(':id_aula', $id_aula, PDO::PARAM_STR);
        $result->bindValue(':habilitar', $habilitar, PDO::PARAM_STR);
        return $result->execute();
    }

    public function borrarAula($id_aula)
    {
        $consulta = "DELETE FROM aulas WHERE id_aula = :id_aula";

        $result = $this->conexion->prepare($consulta);
        $result->bindValue(':id_aula', $id_aula, PDO::PARAM_STR);
        return $result->execute();
    }

    public function crearProfesor($id_usuario, $nombre, $apellido, $email, $password, $imagen)
    {
        $consulta = "INSERT INTO usuarios(nombre, apellido, email, password, imagen, id_usuario, id_roles) VALUES (:nombre, :apellido, :email, :password, :imagen, :id_usuario, 1)";

        $result = $this->conexion->prepare($consulta);
        $result->bindValue(':id_usuario', $id_usuario, PDO::PARAM_STR);
        $result->bindValue(':nombre', $nombre, PDO::PARAM_STR);
        $result->bindValue(':apellido', $apellido, PDO::PARAM_STR);
        $result->bindValue(':email', $email, PDO::PARAM_STR);
        $result->bindValue(':password', $password, PDO::PARAM_STR);
        $result->bindValue(':imagen', $imagen, PDO::PARAM_STR);
        return $result->execute();
    }

    public function modificarProfesor($id_usuario, $nombre, $apellido, $email, $password, $imagen)
    {
        $consulta = "UPDATE FROM usuarios SET nombre=:nombre, apellido=:apellido, email=:email, password=:password, imagen=:imagen, WHERE id_usuario = :id_usuario and id_roles=1";

        $result = $this->conexion->prepare($consulta);
        $result->bindValue(':id_usuario', $id_usuario, PDO::PARAM_STR);
        $result->bindValue(':nombre', $nombre, PDO::PARAM_STR);
        $result->bindValue(':apellido', $apellido, PDO::PARAM_STR);
        $result->bindValue(':email', $email, PDO::PARAM_STR);
        $result->bindValue(':password', $password, PDO::PARAM_STR);
        $result->bindValue(':imagen', $imagen, PDO::PARAM_STR);
        return $result->execute();
    }

    public function habilitarProfesor($id_usuario, $habilitar)
    {
        $consulta = "UPDATE FROM usuarios SET habilitado=:habilitar WHERE id_usuario = :id_usuario and id_roles = 1";

        $result = $this->conexion->prepare($consulta);
        $result->bindValue(':id_usuario', $id_usuario, PDO::PARAM_STR);
        $result->bindValue(':habilitar', $habilitar, PDO::PARAM_STR);
        return $result->execute();
    }

    public function borrarProfesor($id_usuario)
    {
        $consulta = "DELETE FROM usuarios WHERE id_usuario = :id_usuario and id_roles = 1";

        $result = $this->conexion->prepare($consulta);
        $result->bindValue(':id_usuario', $id_aula, PDO::PARAM_STR);
        return $result->execute();
    }

}