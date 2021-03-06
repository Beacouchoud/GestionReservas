<?php

/**
 * Clase para realizar validaciones en el modelo
 * Es utilizada para realizar validaciones en el modelo de nuestras clases.
 *
 * @author Carlos Belisario
 */
class Validacion
{
    protected $_atributos;
    protected $_error;
    public $mensaje;

    /**
     * Metodo para indicar la regla de validacion
     * El método retorna un valor verdadero si la validación es correcta, de lo contrario retorna el objeto
     * actual, permitiendo acceder al atributo Validacion::$mensaje ya que es publico
     */
    public function rules($rule = array(), &$data,$sanitizar=false)
    {
        //Sanitiza si es true
        if($sanitizar == true){
            foreach($data as $key => $value){
                $data[$key] = Validacion::sanitiza($key);
            }
        }   
        
        if (!is_array($rule)) {
            $this->mensaje = "las reglas deben de estar en formato de arreglo";
            return $this;
        }

        $respuesta = true;
        foreach ($rule as $key => $rules) {
            $reglas = explode(',', $rules['regla']);
            if (array_key_exists($rules['name'], $data)) {
                foreach ($data as $indice => $valor) {
                    if ($indice === $rules['name']) {
                        foreach ($reglas as $valores) {
                            $validator = $this->_getInflectedName($valores);
                            if (!is_callable(array($this, $validator))) {
                                throw new BadMethodCallException("No se encontro el metodo actual $valores");
                            }

                            $comprueba = $this->$validator($rules['name'], $valor);

                            if(!$comprueba)
                                $respuesta = $comprueba; //Si hay algún campo que no tenga un valor correcto, esta variable se le asignará false. De la otra forma, machacabas el valor constantemente 
                        }
                        break;
                    }
                }
            } else {
                $this->mensaje[$rules['name']] = "el campo" . $rules["name"] . "no esta dentro de la regla de validación o en el formulario";
            }
        }
        if (!$respuesta) {
            return $this;
        } else {
            return true;
        }
    }

    public static function sanitiza($var)
    {
        if (isset($_REQUEST[$var])){
            $tmp = strip_tags(sinEspacios($_REQUEST[$var]));
        }
        else
            $tmp = "";

        return $tmp;
    }

    /**
     * Metodo inflector de la clase
     * por medio de este metodo llamamos a las reglas de validacion que se generen
     */
    private function _getInflectedName($text)
    {
        $validator = "";
        $_validator = preg_replace('/[^A-Za-z0-9]+/', ' ', $text);
        $arrayValidator = explode(' ', $_validator);
        if (count($arrayValidator) > 1) {
            foreach ($arrayValidator as $key => $value) {
                if ($key == 0) {
                    $validator .= "_" . $value;
                } else {
                    $validator .= ucwords($value);
                }
            }
        } else {
            $validator = "_" . $_validator;
        }
        return $validator;
    }

    /**
     * Metodo de verificacion de que el dato no este vacio o NULL
     * El metodo retorna un valor verdadero si la validacion es correcta de lo contrario retorna un valor falso
     * y llena el atributo validacion::$mensaje con un arreglo indicando el campo que mostrara el mensaje y el
     * mensaje que visualizara el usuario
     */
    protected function _noEmpty($campo, $valor)
    {
        if (isset($valor) && !empty($valor)) {
            return true;
        } else {
            $this->mensaje[$campo][] = "el campo $campo debe de estar lleno";
            return false;
        }
    }
    /**
     * Metodo de verificacion de tipo numerico
     * El metodo retorna un valor verdadero si la validacion es correcta de lo contrario retorna un valor falso
     * y llena el atributo validacion::$mensaje con un arreglo indicando el campo que mostrara el mensaje y el
     * mensaje que visualizara el usuario
     */
    protected function _numeric($campo, $valor)
    {
        if (is_numeric($valor)) {
            return true;
        } else {
            $this->mensaje[$campo] = "el campo $campo debe de ser numerico";
            return false;
        }
    }


    protected function _usuario($campo, $valor){
        if (! preg_match("/^[A-Za-z0-9]{7,15}$/", $valor)){
            $this->mensaje[$campo] = "el campo $campo debe de contener letras y numeros, y tener entre 7 y 15 caracteres";
            return false;
        }
        else
            return true;
    }

    protected function _texto($campo, $valor){
        if (! preg_match("/^[A-Za-z]{7,15}$/", $valor)){
            $this->mensaje[$campo] = "el campo $campo debe de contener letras y tener entre 7 y 15 caracteres";
            return false;
        }
        else
            return true;
    }

    /**
     * Metodo de verificacion de tipo email
     * El metodo retorna un valor verdadero si la validacion es correcta de lo contrario retorna un valor falso
     * y llena el atributo validacion::$mensaje con un arreglo indicando el campo que mostrara el mensaje y el
     * mensaje que visualizara el usuario
     */
    protected function _email($campo, $valor)
    {
        if (preg_match("/^[a-z]+([\.]?[a-z0-9_-]+)*@[a-z]+([\.-]+[a-z0-9]+)*\.[a-z]{2,}$/", $valor)) {
            return true;
        } else {
            $this->mensaje[$campo] = "El email ha de estar en el formato de email usuario@servidor.com";
            return false;
        }
    }
}

/*
sdfsdfs
$_POST['campo1'] = "v";
$_POST['campo2'] = "usuario@hotmail.com";

$datos = $_POST;

$validacion =  new Validacion();

$regla = array(
    array('name' => 'campo1', 'regla' => 'noempty,numeric'),
    array('name' => 'campo2', 'regla' => 'no-empty,email')
);

try {
    $validaciones = $validacion->rules($regla, $datos);

    if(isset($validaciones->mensaje)){
        foreach($validaciones->mensaje as $campo => $texto){
            echo "<p>$texto</p>";
        }
    }
} catch (BadMethodCallException $e) {
    echo $e->getMessage();
}
*/