<?php
/**
 * User: badrom
 * Date: 25/05/19
 * Function: Finish de actual sessión in php
 */
require ('../config/sesiones.php');

session_start();

//Desactivamos todas las conexiones
unset($_SESSION);

//Destruimos la sesiones
session_destroy();

//Redireccionamos a index
header('Location: ../index.php');
die();

?>
