<?php
// include ('libs/utils.php');
 include_once ('./app/model.php');

class Controller
{

    public function formlogin()
    {
        // $params = array(
        //     'mensaje' => 'Bienvenido al repositorio de alimentos',
        //     'fecha' => date('d-m-yyy')
        // );
        if (isset($_POST['login'])) {
            $m = new Model();
            $username = recoge('username');
            $password = recoge('password');
            $user = $m->logIn($username, $password);
            if ($user !== false) {
                // echo '<script> saveLocalStorage(' . $user . ')</script>';
                header('Location: index.php?ctl=aulas');
                //var_dump($user);
                anyadirSesion("user", $user[0]["id_usuario"]);
                anyadirSesion("acceso", $user[0]["id_roles"]);
            }
        }

        require __DIR__ . './templates/formlogin.php';
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        session_abort();

        header("Location: index.php");
    }

    public function formregistro()
    {
        // try {
        $params = array(
            'id_usuario' => '',
            'nombre' => '',
            'apellido' => '',
            'email' => '',
            'password' => '',
            'id_roles' => '',
            'habilitado' => '',
            'imagen' => '',
        );

        if (isset($_POST['singup'])) {

            $nombre = recoge('name');
            $apellido = recoge('lastname');
            $email = recoge('email');
            $password = recoge('password');

            // $datos = $_REQUEST;

            // $validacion =  new Validacion();
            // $regla = array(
            //     array('name' => 'campo1', 'regla' => 'noempty,numeric'),
            //     array('name' => 'campo2', 'regla' => 'no-empty,email')
            // );

            // try {
            //     $validaciones = $validacion->rules($regla, $datos);

            //     if(isset($validaciones->mensaje)){
            //         foreach($validaciones->mensaje as $campo => $texto){
            //             echo "<p>$texto</p>";
            //         }
            //     }
            // } catch (BadMethodCallException $e) {
            //     echo $e->getMessage();
            // }

            // $imagen = $_REQUEST['imagen'];
            // comprobar campos formulario
            // if (validarDatos($nombre, $energia, $proteina, $hc, $fibra, $grasa)) {

            // Si no ha habido problema creo modelo y hago inserción
            $m = new Model();
            if ($m->insertarUsuario($nombre, $apellido, $email, $password)) {
                header('Location: index.php?ctl=formlogin');
            }
            // else {
            //         $params = array(
            //             'nombre' => $nombre,
            //             'apellido' => $apellido,
            //             'email' => $email,
            //             'password' => $password,
            //             'imagen' => $imagen
            //         );
            //         $params['mensaje'] = 'No se ha podido registrar el usuario.Revisa el formulario';
            //     }
            // } else {
            //     $params = array(
            //         'nombre' => $nombre,
            //         'apellido' => $apellido,
            //         'email' => $email,
            //         'password' => $password,
            //         'imagen' => $imagen
            //     );
            //     $params['mensaje'] = 'Hay datos que no son correctos. Revisa el formulario';
            // }
        }
        // } catch (Exception $e) {
        //     error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logExceptio.txt");
        //     header('Location: index.php?ctl=error');
        // } catch (Error $e) {
        //     error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logError.txt");
        //     header('Location: index.php?ctl=error');
        // }

        require __DIR__ . '/templates/formregistro.php';
    }

    // public function error()
    // {
    //     require __DIR__ . '/templates/error.php';
    // }

    public function aulas()
    {
        try {
            $model = new Model();
            $params = array(
                'aulas' => $model->dameaulas(),
            );
            // Recogemos los dos tipos de excepciones que se pueden producir
        } catch (Exception $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logExceptio.txt");
            header('Location: index.php?ctl=error');
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logError.txt");
            header('Location: index.php?ctl=error');
        }

        require __DIR__ . '/templates/aulas.php';
    }

    public function calendario()
    {

        require __DIR__ . '/templates/calendario.php';
    }

    public function reservas()
    {
        try {
            $model = new Model();
            // $fecha = $_GET["fecha"];
            $fecha = recoge('fecha');
            $id_aula = recoge('aula');
            $params = array(
                'reservas' => $model->reservas($fecha, $id_aula),
            );
            $a = $model->reservas($fecha, $id_aula);
            echo json_encode($a);
            // Recogemos los dos tipos de excepciones que se pueden producir
        } catch (Exception $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logExceptio.txt");
            header('Location: index.php?ctl=error');
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logError.txt");
            header('Location: index.php?ctl=error');
        }
    }

}