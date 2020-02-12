<?php
// web/index.php
// carga del modelo y los controladores
require_once __DIR__ . '/app/config/Config.php';
require_once __DIR__ . '/app/config/utils.php';
require_once __DIR__ . '/app/config/Validacion.php';
require_once __DIR__ . '/app/config/Sesiones.php';
require_once __DIR__ . '/app/Model.php';
require_once __DIR__ . '/app/Controller.php';
require_once __DIR__ . '/app/SegundoController.php';

/*guia de reservas
0 - sin registrar
1 - registrado/profesor
2 - admin
 */

// enrutamiento
$map = array(
    'aulas' => array('controller' => 'Controller', 'action' => 'aulas', 'acceso' => 1), //aulas disponibles
    'formlogin' => array('controller' => 'Controller', 'action' => 'formlogin', 'acceso' => 0),
    'formregistro' => array('controller' => 'Controller', 'action' => 'formregistro', 'acceso' => 0),
    'calendario' => array('controller' => 'Controller', 'action' => 'calendario', 'acceso' => 1),
    'reservas' => array('controller' => 'Controller', 'action' => 'reservas', 'acceso' => 1),
    'error' => array('controller' => 'Controller', 'action' => 'error', 'acceso' => 0),
    //Operaciones AJAX
    'hacerReserva' => array('controller' => 'SegundoController', 'action' => 'hacerReserva', 'acceso' => 1),
    'borrarReserva' => array('controller' => 'SegundoController', 'action' => 'borrarReserva', 'acceso' => 1),
    'cogerReservasDia' => array('controller' => 'SegundoController', 'action' => 'cogerReservasDia', 'acceso' => 1),

);
// parseo de la ruta
//  if (isset($_SESSION["user"])) {
if (isset($_GET['ctl'])) {
    if (isset($map[$_GET['ctl']])) {
        if ($_GET['ctl'] != 'formlogin') {
            $ruta = $_GET['ctl'];
        } else {
            $ruta = 'formlogin';
        }

    } else {
        $ruta = 'error';
    }
} else {
    $ruta = 'formlogin';
}

// } else {
//     $ruta = 'formlogin';
// }
$controlador = $map[$ruta];
// Ejecución del controlador asociado a la ruta
if (method_exists($controlador['controller'], $controlador['action'])) {
    if (recogerSesion("acceso") >= $controlador['acceso']) {
        call_user_func(array(new $controlador['controller'],
            $controlador['action']));
    } else {
        echo '<html><body><h1>No tienes acceso a esta pantalla </h1></body></html>';
    }
} else {
    header('Status: 404 Not Found');
    echo '<html><body><h1>Error 404: The controller <i>' .
        $controlador['controller'] .
        '->' .
        $controlador['action'] .
        '</i> does not exist.</h1></body></html>';
}