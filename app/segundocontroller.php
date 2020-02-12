<?php
// include ('libs/utils.php');

class SegundoController
{
    public function cogerReservasDia()
    {
        try {
            $model = new Model();
            $validation = new Validacion();

            $regla = array(
                array(
                    'name' => 'fecha',
                    'regla' => 'no-empty,date',
                ),
                array(
                    'name' => 'aula',
                    'regla' => 'no-empty,name',
                ),
            );
            $isValid = $validation->rules($regla, $_POST);

            if ($isValid) {
                $fecha = recoge('fecha');
                $id_aula = recoge('aula');
                $a = $model->reservas($fecha, $id_aula);
                echo json_encode($a);
            } else {
                throw new Exception(); //Para que devuelva error en el AJAX
            }

        } catch (Exception $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logExceptio.txt");
            echo json_encode(["error" => true]);
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logError.txt");
            echo json_encode(["error" => true]);
        }
    }

    public function hacerReserva()
    {
        try {
            $model = new Model();
            $validation = new Validacion();

            $regla = array(
                array(
                    'name' => 'fecha',
                    'regla' => 'no-empty,date',
                ),
                array(
                    'name' => 'aula',
                    'regla' => 'no-empty,name',
                ),
                array(
                    'name' => 'hora',
                    'regla' => 'no-empty,horas',
                ),
            );
            $isValid = $validation->rules($regla, $_POST);

            if ($isValid) {
                $fecha = recoge('fecha');
                $id_aula = recoge('aula');
                $hora = recoge('hora');
                $a = $model->hacerReserva($fecha, $id_aula, $hora);
                echo json_encode($a);
            } else {
                throw new Exception(); //Para que devuelva error en el AJAX
            }

        } catch (Exception $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logExceptio.txt");
            echo json_encode(["error" => true]);
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logError.txt");
            echo json_encode(["error" => true]);
        }
    }

    public function borrarrReserva()
    {
        try {
            $model = new Model();
            $validation = new Validacion();

            $regla = array(
                array(
                    'name' => 'fecha',
                    'regla' => 'no-empty,date',
                ),
                array(
                    'name' => 'aula',
                    'regla' => 'no-empty,name',
                ),
                array(
                    'name' => 'hora',
                    'regla' => 'no-empty,horas',
                ),
            );
            $isValid = $validation->rules($regla, $_POST);

            if ($isValid) {
                $fecha = recoge('fecha');
                $id_aula = recoge('aula');
                $hora = recoge('hora');
                $a = $model->borrarReserva($fecha, $id_aula, $hora);
                echo json_encode($a);
            } else {
                throw new Exception(); //Para que devuelva error en el AJAX
            }

        } catch (Exception $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logExceptio.txt");
            echo json_encode(["error" => true]);
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logError.txt");
            echo json_encode(["error" => true]);
        }
    }

    public function crearAula()
    {
        try {
            $model = new Model();
            $validation = new Validacion();

            $regla = array(
                array(
                    'name' => 'id_aula',
                    'regla' => 'no-empty,numeric',
                ),
                array(
                    'name' => 'num_aula',
                    'regla' => 'no-empty,numeric',
                ),
                array(
                    'name' => 'habilitado',
                    'regla' => 'no-empty,bool',
                ),
                array(
                    'name' => 'descripcion_aula',
                    'regla' => 'no-empty,name',
                ),
            );
            $isValid = $validation->rules($regla, $_POST);

            if ($isValid) {
                $id_aula = recoge('id_aula');
                $num_aula = recoge('num_aula');
                $habilitado = recoge('habilitado');
                $descripcion_aula = recoge('descripcion_aula');
                $a = $model->crearAula($id_aula, $num_aula, $habilitado, $descripcion_aula);
                echo json_encode($a);
            } else {
                throw new Exception(); //Para que devuelva error en el AJAX
            }

        } catch (Exception $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logExceptio.txt");
            echo json_encode(["error" => true]);
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logError.txt");
            echo json_encode(["error" => true]);
        }
    }

    public function modificarAula()
    {
        try {
            $model = new Model();
            $validation = new Validacion();

            $regla = array(
                array(
                    'name' => 'id_aula',
                    'regla' => 'no-empty,numeric',
                ),
                array(
                    'name' => 'num_aula',
                    'regla' => 'no-empty,numeric',
                ),
                array(
                    'name' => 'habilitado',
                    'regla' => 'no-empty,bool',
                ),
                array(
                    'name' => 'descripcion_aula',
                    'regla' => 'no-empty,name',
                ),
            );
            $isValid = $validation->rules($regla, $_POST);

            if ($isValid) {
                $id_aula = recoge('id_aula');
                $num_aula = recoge('num_aula');
                $habilitado = recoge('habilitado');
                $descripcion_aula = recoge('descripcion_aula');
                $a = $model->modificarAula($id_aula, $num_aula, $habilitado, $descripcion_aula);
                echo json_encode($a);
            } else {
                throw new Exception(); //Para que devuelva error en el AJAX
            }

        } catch (Exception $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logExceptio.txt");
            echo json_encode(["error" => true]);
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logError.txt");
            echo json_encode(["error" => true]);
        }
    }

    public function habilitarAula()
    {
        try {
            $model = new Model();
            $validation = new Validacion();

            $regla = array(
                array(
                    'name' => 'id_aula',
                    'regla' => 'no-empty,numeric',
                ),
                array(
                    'name' => 'habilitar',
                    'regla' => 'no-empty,bool',
                ),
            );
            $isValid = $validation->rules($regla, $_POST);

            if ($isValid) {
                $id_aula = recoge('id_aula');
                $habilitar = recoge('habilitar');
                $a = $model->habilitarAula($id_aula, $habilitar);
                echo json_encode($a);
            } else {
                throw new Exception(); //Para que devuelva error en el AJAX
            }

        } catch (Exception $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logExceptio.txt");
            echo json_encode(["error" => true]);
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logError.txt");
            echo json_encode(["error" => true]);
        }
    }

    public function borrarAula()
    {
        try {
            $model = new Model();
            $validation = new Validacion();

            $regla = array(
                array(
                    'name' => 'id_aula',
                    'regla' => 'no-empty,numeric',
                ),
            );
            $isValid = $validation->rules($regla, $_POST);

            if ($isValid) {
                $id_aula = recoge('id_aula');
                $a = $model->borrarAula($id_aula);
                echo json_encode($a);
            } else {
                throw new Exception(); //Para que devuelva error en el AJAX
            }

        } catch (Exception $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logExceptio.txt");
            echo json_encode(["error" => true]);
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logError.txt");
            echo json_encode(["error" => true]);
        }
    }

    public function crearProfesor()
    {
        try {
            $model = new Model();
            $validation = new Validacion();

            $imagen = validateFile("imagen", "./img_usuarios/");

            $regla = array(
                array(
                    'name' => 'id_usuario',
                    'regla' => 'no-empty,numeric',
                ),
                array(
                    'name' => 'nombre',
                    'regla' => 'no-empty,name',
                ),
                array(
                    'name' => 'apellido',
                    'regla' => 'no-empty,name',
                ),
                array(
                    'name' => 'email',
                    'regla' => 'no-empty,email',
                ),
                array(
                    'name' => 'password',
                    'regla' => 'no-empty,password',
                ),
            );
            $isValid = $validation->rules($regla, $_POST);

            if ($isValid && $imagen !== false) {
                $id_usuario = recoge('id_usuario');
                $nombre = recoge('nombre');
                $apellido = recoge('apellido');
                $email = recoge('email');
                $password = recoge('password');
                $a = $model->crearProfesor($id_usuario, $nombre, $apellido, $email, $password, $imagen);
                echo json_encode($a);
            } else {
                throw new Exception(); //Para que devuelva error en el AJAX
            }

        } catch (Exception $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logExceptio.txt");
            echo json_encode(["error" => true]);
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logError.txt");
            echo json_encode(["error" => true]);
        }
    }

    public function modificarProfesor()
    {
        try {
            $model = new Model();
            $validation = new Validacion();

            $imagen = validateFile("imagen", "./img_usuarios/");

            $regla = array(
                array(
                    'name' => 'id_usuario',
                    'regla' => 'no-empty,numeric',
                ),
                array(
                    'name' => 'nombre',
                    'regla' => 'no-empty,name',
                ),
                array(
                    'name' => 'apellido',
                    'regla' => 'no-empty,name',
                ),
                array(
                    'name' => 'email',
                    'regla' => 'no-empty,email',
                ),
                array(
                    'name' => 'password',
                    'regla' => 'no-empty,password',
                ),
            );
            $isValid = $validation->rules($regla, $_POST);

            if ($isValid && $imagen !== false) {
                $id_usuario = recoge('id_usuario');
                $nombre = recoge('nombre');
                $apellido = recoge('apellido');
                $email = recoge('email');
                $password = recoge('password');
                $a = $model->modificarProfesor($id_usuario, $nombre, $apellido, $email, $password, $imagen);
                echo json_encode($a);
            } else {
                throw new Exception(); //Para que devuelva error en el AJAX
            }

        } catch (Exception $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logExceptio.txt");
            echo json_encode(["error" => true]);
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logError.txt");
            echo json_encode(["error" => true]);
        }
    }

    public function habilitarProfesor()
    {
        try {
            $model = new Model();
            $validation = new Validacion();

            $regla = array(
                array(
                    'name' => 'id_usuario',
                    'regla' => 'no-empty,numeric',
                ),
                array(
                    'name' => 'habilitar',
                    'regla' => 'no-empty,bool',
                ),
            );
            $isValid = $validation->rules($regla, $_POST);

            if ($isValid) {
                $id_usuario = recoge('id_usuario');
                $habilitar = recoge('habilitar');
                $a = $model->habilitarProfesor($id_usuario, $habilitar);
                echo json_encode($a);
            } else {
                throw new Exception(); //Para que devuelva error en el AJAX
            }

        } catch (Exception $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logExceptio.txt");
            echo json_encode(["error" => true]);
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logError.txt");
            echo json_encode(["error" => true]);
        }
    }

    public function borrarProfesor()
    {
        try {
            $model = new Model();
            $validation = new Validacion();

            $regla = array(
                array(
                    'name' => 'id_usuario',
                    'regla' => 'no-empty,numeric',
                ),
            );
            $isValid = $validation->rules($regla, $_POST);

            if ($isValid) {
                $id_usuario = recoge('id_usuario');
                $a = $model->borrarProfesor($id_usuario);
                echo json_encode($a);
            } else {
                throw new Exception(); //Para que devuelva error en el AJAX
            }

        } catch (Exception $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logExceptio.txt");
            echo json_encode(["error" => true]);
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logError.txt");
            echo json_encode(["error" => true]);
        }
    }

    public function darDeAlta()
    {
        try {
            $model = new Model();
            $validation = new Validacion();

            $regla = array(
                array(
                    'name' => 'id_usuario',
                    'regla' => 'no-empty,numeric',
                ),
            );
            $isValid = $validation->rules($regla, $_POST);

            if ($isValid) {
                $id_usuario = recoge('id_usuario');
                $a = $model->darDeAltaProfesor($id_usuario);
                echo json_encode($a);
            } else {
                throw new Exception(); //Para que devuelva error en el AJAX
            }

        } catch (Exception $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logExceptio.txt");
            echo json_encode(["error" => true]);
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logError.txt");
            echo json_encode(["error" => true]);
        }
    }

}