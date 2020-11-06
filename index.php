<?php
    session_start();
    
    error_reporting(E_ALL);
    
    if(isset($_SESSION['usuario']) and $_SESSION['estado'] == 'Autorizado'){
        include 'layouts/fullview.php';
        die();
    
    }else{
        include('layouts/login.php');
        die();
    }
    
?>