<?php

require_once "./app/config/utils.php";
require_once "./app/config/config.php";

$conexion = new PDO(
    'mysql:host=' . Config::$mvc_bd_hostname .
    ';dbname=' . Config::$mvc_bd_nombre . '',
    Config::$mvc_bd_usuario,
    Config::$mvc_bd_clave
);

// Realiza el enlace con la BD en utf-8
$conexion->exec("set names utf8");
$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

/*$test = $conexion->query("SELECT * FROM usuarios");
var_dump($test->fetchAll());*/

$insert = $conexion->prepare("UPDATE FROM usuarios SET id_roles='2' WHERE id_usuario='5'");
$insert->execute();


echo "<br>";

var_dump(blowfishCrypt("asdasd") == '$2a$09$sileesestoesdemasiadoeUosEvkk5OBlBvIgXqigeJjSdeEs9.GC');