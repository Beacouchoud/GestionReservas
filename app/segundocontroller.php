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

}