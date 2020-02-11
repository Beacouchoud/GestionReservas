<?php
// include ('libs/utils.php');

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
            $username = $_REQUEST['username'];
            $password = $_REQUEST['password'];
            $user = $m->logIn($username, $password);
            if ($user) {
                // echo '<script> saveLocalStorage(' . $user . ')</script>';
                header('Location: index.php?ctl=aulas');
            }
        }
        require __DIR__ . '/templates/formlogin.php';
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
      

                $nombre = $_REQUEST['name'];
                $apellido = $_REQUEST['lastname'];
                $email = $_REQUEST['email'];
                $password = $_REQUEST['password'];

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
                'aulas' => $model->dameaulas()
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

    public function reservas() {
        try {
            $model = new Model();
           // $fecha = $_GET["fecha"];
            $fecha = $_GET['fecha'];
            $id_aula = $_GET['aula'];
            $params = array(
                'reservas' => $model->reservas($fecha, $id_aula)
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

?>
