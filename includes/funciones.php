<?php

require 'app.php';

function incluirTemplate(string $nombre, bool $inicio = false)
{
    include TEMPLATES_URL . "/${nombre}.php";
}

function isAuth(): bool
{
    session_start();
    $resultado = false;
    $auth = $_SESSION["login"];
    if ($auth) {
        $resultado = true;
    }
    return $resultado;
    
}
