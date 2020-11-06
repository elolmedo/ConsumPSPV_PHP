<?php
	
	//Reanudamos la sesión y controlamos que todo este bien
	session_start();
	if(!isset($_SESSION['usuario']) and $_SESSION['estado'] != 'Autorizado'){
		echo 'Mal inicio de sesión;';
		header('Location: ../index.php');
	}else{
		
		$usernick = $_SESSION['usuario'];
		$userpass = $_SESSION['password'];
		
		require ('/var/www/ConsumsPSPV/config/sesiones.php');
		
	}
    
	require '../config/core.php';
	require '../config/globals.php';
	require '../config/database.php';
	require '../Classes/preu.php';
		
	$tipo       =  $_REQUEST["tipoconsumo"];

	
    
    $database = new Database();
    $db = $database->getConnection();
    
    if ($tipo == "Gas Natural" || $tipo == "Oxigen Ampolles" || $tipo == "Oxigen"){
        //Obteniendo datos actuales en la Bd. según consumo
        echo '<div class="alert alert-info col col-md-8">'."\n";
        echo '<span class="label label-info">Informació Conversió Preus</span>'."\n";
        echo '<h6> Obtenint informació necesaria per la conversió de Preus:  '.$tipo.'</h6>'."\n";
        
        $preu = new Preu($db);
        $preu->showLastPreus();
        
    }else{
        
        echo '<div class="alert alert-info col col-md-8">'."\n";
        echo '<span class="label label-primary">Informació Conversió Preus</span>'."\n";
        echo '<h6> Aquest tipus de consumo no necesita de conversió de preus: '.$tipo.'</h6>'."\n";
    }
    
    
    
   
    
    
    
    	

