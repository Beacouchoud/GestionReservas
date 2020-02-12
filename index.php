<?php
// web/index.php
// carga del modelo y los controladores
require_once __DIR__ . '/app/config/Config.php';
require_once __DIR__ . '/app/config/utils.php';
require_once __DIR__ . '/app/Model.php';
require_once __DIR__ . '/app/Controller.php';
require_once __DIR__ . '/app/SegundoController.php';

// enrutamiento
$map = array(
    'aulas' => array('controller' => 'Controller', 'action' => 'aulas'), //aulas disponibles
    'formlogin' => array('controller' => 'Controller', 'action' => 'formlogin'),
    'formregistro' => array('controller' => 'Controller', 'action' => 'formregistro'),
    'calendario' => array('controller' => 'Controller', 'action' => 'calendario'),
    'reservas' => array('controller' => 'Controller', 'action' => 'reservas'),
    'error' => array('controller' => 'Controller', 'action' => 'error'),
    //Operaciones AJAX
    'hacerReserva' => array('controller' => 'SegundoController', 'action' => 'hacerReserva'),

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
    call_user_func(array(new $controlador['controller'],
        $controlador['action']));
} else {
    header('Status: 404 Not Found');
    echo '<html><body><h1>Error 404: The controller <i>' .
        $controlador['controller'] .
        '->' .
        $controlador['action'] .
        '</i> does not exist.</h1></body></html>';
}