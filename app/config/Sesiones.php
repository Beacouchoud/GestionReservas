<?php

function sesionConf($user, $level)
{
    $_SESSION["user"] = $user;
    $_SESSION["acceso"] = 0;
}

function iniciaSesion()
{
    session_start();
}

function anyadirSesion($nombre, $valor)
{
    $_SESSION[$nombre] = $valor;
}

function existeSesion($nombre)
{
    return isset($_SESSION[$nombre]);
}

function recogerSesion($nombre)
{
    if (existeSesion($nombre)) {
        return $_SESSION[$nombre];
    }

    return "";
}

function cierraSesion()
{
    session_unset();
    session_destroy();
}