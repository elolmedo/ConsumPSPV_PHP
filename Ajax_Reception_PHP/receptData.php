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
	    
	    //Procedemos con la inserción de los nuevos datos
	    require '/var/www/ConsumsPSPV/vendor/autoload.php';
	    use League\Csv\Reader;
	   
	    
	    $tipo           = $_REQUEST["tipo"];
	    $target_name    = basename($_FILES["fileToUpload"]["name"]);
	    $target_dir     = "/var/www/ConsumsPSPV/CSV/newData/";
	    $uploadOk       = 0;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">
        <head>
            <title>Consums Parc Sanitari Pere Virgili</title>
            <link rel="stylesheet" type="text/css" href="../css/principal.css" />
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"></link>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
            <script type="text/javascript" src="../js_functions/functions.js"></script>
            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>            
     		<script type="text/javascript">
      	      google.charts.load('current', {'packages':['corechart','controls']});
              google.charts.load('current', {'packages':['table']});
              google.charts.load("current", {'packages': ['bar']});
              google.charts.load('current', {'packages': ['corechart'], 'callback': LineChart});
              google.charts.load('current', {'packages': ['corechart'], 'language': 'es'});
      		</script>
            <script>
        		$(document).ready(function(){
            		$(".dropdown-toggle").dropdown();            		                 
        		});
        	
    		</script>
        </head>
    	<body>
        	<div class="container col-md-12">
        		<!-- Cabecera dd-->
        		 <div class="panel panel-primary">
    		         <div class="sidebar-nav">
                        <nav class="navbar navbar-inverse  navbar-fixed nav-justified navbar-fixed-top">
                            <div class="navbar-header">
                                <img class="navbar-brand" src="../images/png/pspv.png" href="../index.php">
                            </div>
                            <ul id="listaOpciones" class="nav navbar-nav">
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle"  id="totals" type="button" data-toggle="dropdown" >Creació de Grafiques<span class="caret"></span></a>
                
                                  <ul class="dropdown-menu" role="menu" aria-labelledby="totals">
                                        <li id="list" role="presentation"><a role="menuitem" tabindex="-1" href="../index.php?namemenu=creacioGraph">Electricitat - Oxigen - Aigua</li>
                                        <li id="list" role="presentation"><a role="menuitem" tabindex="-1" href="../index.php?namemenu=creacioGraphEdificis">Gas Natural - Oxiflow</a></li>
                                  </ul>
                                </li>
                                <li id="list" role="presentation"><a href="../index.php?namemenu=insercio">Inserció Automàtica</a></li>
                                <li id="list" role="presentation"><a href="../index.php?namemenu=lastinsert">Últimes insercions</a></li>
<!--                                 <li id="list" role="presentation"><a href="../index.php?namemenu=predict">Predicció</a></li> -->
                                <li id="list" role="presentation"><a href="../index.php?namemenu=tutorial">Com Funciona</a> </li>
				<li id="list" role="presentation"><a href="../index.php?namemenu=contact">Contacte</a></li>
				<li id="list" role="presentation"><a href="../index.php?namemenu=exit">Tancar Sessió</a></li>
                            </ul>
                        </div>
                
                	</nav>
        		</div>
        	</div>

<div id="cuerpo" class="col col-md-12">
	<div id="Tipus_de_Consum">
		<h3>Procés d'inserció del consum: <?php echo $tipo ?></h3>
		<hr>
	</div>
	
	<?php 
	    
	    
	    //Eliminamos ficheros antiguos
	    $cmd = "rm -f ".$target_dir."*.csv";
	    try{
	        shell_exec($cmd);
	    }catch (Exception $e){
	        $msg = "[ERR] Fallo al borramos ficheros antiguos: ".$e->getMessage();
	        errorLog($msg);
	        die($msg);
	    }
	    
	    // Iniciamos creación fichero
	    $target_file = $target_dir . $target_name;    
	    $target_format  = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	    
	    // Comprobamos si el fichero existe ya, ese quiere decir que algo ha ido mal.
	    // El fichero no debe existir puesto que es nuevo y al final de las operaciones borramos dicho fichero
	    // de esta carpeta.
	    if(file_exists($target_file)){
	        $msg = "[ERR] El fichero con los nuevos datos de '.$tipo.' ya existe."."\n";
	        errorLog($msg);
	        $uploadOk = 1;
	    }
	    
	    // Comprobamos tamaño del fichero, si es más grande de 5 MB rechazamos.
	    if ($_FILES["fileToUpload"]["size"] > 500000){
	        $msg = "[ERR] El fichero es demasiado grande";
	        echo '<p id="Error">'.$msg.'</p>'."\n";
	        $uploadOk = 1;
	        errorLog($msg);
	    }
	    // Comprobamos formato, si no es CSV rechazamos;
	    if ($target_format != "csv"){
	        $msg = "[ERR] El fichero no tiene el formato apropiado";
	        echo '<p id="Error">'.$msg.'</p>'."\n";
	        $uploadOk = 1;
	        errorLog($msg);
	    }
	    
	    // Comprobamos que el nombre del fichero y el consumo coinciden.
	    $arrayTipo = array();
	    $arrayNombres = array();
	    
	    $arrayNombres   = [ "file_consumoxiflow_ampolla.csv",
	                        "file_consumoxiflow_tank.csv",
	                        "file_consumsaigua.csv",
	                        "file_consumselectricitat.csv",
	                        "file_consumsgasnatural.csv"];
	    
	    $arrayTipo      = ["Oxigen Ampolla","Oxigen","Aigua","Electricitat","Gas Natural"];
	    
	    // Comprobamos que el fichero corresponda al Consumo en el que queremos insertar los Datos
	    $isCorrectFile = comprobateFile($tipo,$target_name);
	    
	    if ($isCorrectFile == 0){
	        $msg = '[ERR] El fichero no coincide con el consumo seleccionado. Detenemos Ejecucción'."\n";   
	        errorLog($msg);
	        die($msg);
	    }
	    if ($_FILES["file"]["error"] > 0) {
	        echo "[ERR]: ". $_FILES["file"]["error"] . "<br />";
	        $uploadOk = 1;
	        
	    }
	          
	    // Procedemos a la subida del fichero
	    if ($uploadOk == 1) {
	        echo '<p id="Eroor">Ups alguna cosa no h\'acabat d\'anar bé. Poseu-vos en contacte amb l\'administrador de l\' aplicació.</p>'."\n";
	        echo '<p id="Error">info@romsolutions.es</p>'."\n";
	        die();
	        // if everything is ok, try to upload file
	    } else {
	        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
	            echo '<p id="OK">El fitxer ha sigut puxat amb éxit '. basename( $_FILES["fileToUpload"]["name"]).'</p>'."\n";
	        } else {
	            echo '<p id="Error">Problemas de conexió, torni-ho a intentar el fitxer no ha acabar de puxar correctament.!!</p>'."\n";
	        }
	    }
	    
	    $database = new Database();
	    $db = $database->getConnection();
	    
	    if($tipo == "Electricitat"){
	        
	        $electricitat = new Electricitat($db);
	        $electricitat->comprobateLengthData($target_file);        
	        $electricitat->createBackupTable();
	        $electricitat->truncateTable();
	        $csv = Reader::createFromPath($target_file);
	        //Objeto Reader, le quitamos la cabecera que no se ha de insertar
	        $csv->setHeaderOffset(0);
	        $electricitat->insertData($csv);
	        
	    }elseif ($tipo == "Aigua"){
	        $aigua = new Aigua($db);
	        $aigua->comprobateLengthData($target_file);
	        $aigua->createBackupTable();
	        $aigua->truncateTable();        
	        $csv = Reader::createFromPath($target_file);
	        //Objeto Reader, le quitamos la cabecera que no se ha de insertar
	        $csv->setHeaderOffset(0);
	        $aigua->insertData($csv);
	
	    }elseif ($tipo == "Gas Natural"){
	        $gasnatural = new GasNatural($db);
	        $gasnatural->comprobateLengthData($target_file);
	        $gasnatural->createBackupTable();
	        $gasnatural->truncateTable();
	        $csv = Reader::createFromPath($target_file);
	        //Objeto Reader, le quitamos la cabecera que no se ha de insertar        
	        $csv->setHeaderOffset(0);        
	        $gasnatural->insertData($csv);
	
	    }elseif ($tipo == "Oxigen"){
	        $oxigenTank = new OxigenTank($db);
	        $oxigenTank->comprobateLengthData($target_file);
	        $oxigenTank->createBackupTable();
	        $oxigenTank->truncateTable();
	        $csv = Reader::createFromPath($target_file);
	        //Objeto Reader, le quitamos la cabecera que no se ha de insertar        
	        $csv->setHeaderOffset(0);        
	        $oxigenTank->insertData($csv);
	
	    }elseif ($tipo == "Oxigen Ampolles"){
	        $oxigenAmpolla = new OxigenAmpolles($db);
	        //$oxigenAmpolla->comprobateLengthData($target_file);
	        $oxigenAmpolla->createBackupTable();
	        $oxigenAmpolla->truncateTable();
	        $csv = Reader::createFromPath($target_file);
	        //Objeto Reader, le quitamos la cabecera que no se ha de insertar        
	        $csv->setHeaderOffset(0);        
	        $oxigenAmpolla->insertData($csv);
	
	    }
	    
	
	    
	?>
</div>

















