<?php

    //Reanudamos la sesión
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
    require ('../Classes/electricitat.php');
    require ('../Classes/aigua.php');
    require ('../Classes/oxigenTank.php');
    
    $tipo       = $_REQUEST["tipo"];
    $consumo    = $_REQUEST["consumo"];
    $temporadas = $_REQUEST["temporadas"];
    
    // selected years
    $arrayTemporadas = array();
    // array with query(result) for season
    $arrayGraph = array();
    // array to export data to graph
    $jsondata= array();
    // array to sort data for graph
    $meses = array();
    
    $arrayTemporadas = explode(" ", $temporadas);         
    $meses = array("Gener","Febrer","Març","Abril","Maig","Juny","Juliol","Agost","Septembre","Octubre", "Novembre", "Decembre");    
    
    //Iniciamos json    
    $jsondata["cols"][0] = ["id"=>"","label"=>"Consums ".$consumo,"type"=>"string"];
    
    //Se inicia $i en 1 para continuar con el jsondata['cols'], dependiendo de los años que se hayan seleccinado
    $i = 1;
    //Etiquetamos según la posición de la array
    $x = 0;
    
    $database = new Database();
    $db = $database->getConnection();
    
    
    foreach($arrayTemporadas  as $temporada){
        if($tipo == "Consum"){
            if ($consumo == "Electricitat"){
                $electricitat = new Electricitat($db);
                $arrayGraphtemporada = $electricitat->dataConsumToArrayGraph($temporada, $consumo);
                array_push($arrayGraph,$arrayGraphtemporada);
                
                
            }elseif($consumo == "Oxigen"){
                $tank = new OxigenTank($db);
                $arrayGraphtemporada = $tank->dataConsumToArrayGraph($temporada,$consumo);
                array_push($arrayGraph,$arrayGraphtemporada);
                
            }elseif($consumo == "Aigua"){
                $aigua = new Aigua($db);
                $arrayGraphtemporada = $aigua->dataConsumToArrayGraph($temporada, $consumo);
                array_push($arrayGraph,$arrayGraphtemporada);
                
            }
            
        }elseif($tipo == "PMP"){
            if ($consumo == "Electricitat"){
                $electricitat = new Electricitat($db);
                $arrayGraphtemporada = $electricitat->dataCostToArrayGraph($temporada, $consumo);
                array_push($arrayGraph,$arrayGraphtemporada);
                

            }elseif($consumo == "Oxigen"){
                $tank = new OxigenTank($db);
                $arrayGraphtemporada = $tank->dataCostToArrayGraph($temporada, $consumo);
                array_push($arrayGraph,$arrayGraphtemporada);
                
                
            }elseif($consumo == "Aigua"){
                $aigua = new Aigua($db);
                $arrayGraphtemporada = $aigua->dataCostToArrayGraph($temporada, $consumo);
                array_push($arrayGraph,$arrayGraphtemporada);
                
            }
        }
        
        $jsondata["cols"][$i] = ["id"=>"","label"=>$arrayTemporadas[$x], "type"=>"number"];
        $i++;
        $x++;        
                
    }
    $db = null;
    $jsondata = createDataGraphs($arrayTemporadas,$arrayGraph,$meses,$jsondata);    
    echo json_encode($jsondata,JSON_PRETTY_PRINT);
    
    
    
    
    
 ?>