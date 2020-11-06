<?php


error_reporting(E_ALL);

$hora = $_SERVER["REQUEST_TIME"];

$duracion = 1500;

//Si el tiempo de la petición* es mayor al tiempo permitido de la duración,
//destruye la sesión y crea una nueva
if (isset($_SESSION['ultima_actividad']) && ($hora - $_SESSION['ultima_actividad']) > $duracion) {
    session_unset();
    session_destroy();
    session_start();
};

$_SESSION['ultima_actividad'] = $hora;
?>