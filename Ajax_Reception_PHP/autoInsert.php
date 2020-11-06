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

	require ('../config/core.php');
	require ('../config/database.php');
	require ('../config/globals.php');
	require ('../Classes/electricitat.php');
	require ('../Classes/aigua.php');
	require ('../Classes/oxigenAmpolla.php');
	require ('../Classes/oxigenTank.php');
	require ('../Classes/gasnatural.php');
	
	$tipo       =  $_REQUEST["tipoconsumo"];

	//Obteniendo datos actuales en la Bd. según consumo
	echo '<div class="alert alert-info col col-md-6">'."\n";
    echo '<span class="label label-primary">Descarrega del Fitxer de Dades</span>'."\n";
	echo '<h6> Obtenint informació necesaria</h6>'."\n";
	$database = new Database();
	$db = $database->getConnection();
	
	//Generamos fichero.csv con su contenido DB	
	if($tipo == "Electricitat"){
	    $electricitat  = new Electricitat($db);
	    $pathfile      = $electricitat->generateCSVFile($tipo);
	    
	}elseif ($tipo == "Aigua"){
	    $aigua = new Aigua($db);
	    $pathfile = $aigua->generateCSVFile($tipo);
	    
	}elseif ($tipo == "Gas Natural"){
	    $gasnatural    = new GasNatural($db);
	    $pathfile      = $gasnatural->generateCSVFile($tipo);
	    
	}elseif ($tipo == "Oxigen"){
	    $oxigenTank    = new OxigenTank($db);
	    $pathfile      = $oxigenTank->generateCSVFile($tipo);
	    
	}elseif ($tipo == "Oxigen Ampolles"){
	    $oxigenAmpolla = new OxigenAmpolles($db);
	    $pathfile      = $oxigenAmpolla->generateCSVFile($tipo);
	}
	
	// check if file exist in server
	if(file_exists($pathfile)) {
	    //Generamos el menú para poder descargarse el fichero con los datos según consumo.
	    generateMenuDownloadFile($tipo);
	    echo '</div>'."\n";
	    
	    //Generamos el menú para poder subir el nuevo fichero y hacer la actualización de datos.
	    echo '<div class="alert alert-info col col-md-6">'."\n";	    
	    generateMenuUploadFile($tipo);
	    echo '</div>'."\n";

	}else{
		$msg = "[ERR] Algo fue mal al generar el fichero, ya que no existe."."\n";
		errorLog($msg);
	}

