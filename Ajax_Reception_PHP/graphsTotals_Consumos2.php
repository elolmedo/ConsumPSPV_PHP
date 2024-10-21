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
    require ('../config/globals.php');
    require ('../config/database.php');
    require ('../Classes/gasnatural.php');
    require ('../Classes/oxigenAmpolla.php');
    
    $tipo       = $_REQUEST["tipo"];
    $consumo    = $_REQUEST["consumo"];
    $temporadas = $_REQUEST["temporadas"];
    $edifici    = $_REQUEST["edifici"];
    
    $database = new Database();
    $db = $database->getConnection();
        
    // selected years
    $arrayTemporadas = array();
    // array with query(result) for season and edifici
    $arrayGraph = array();
    // array to export data to graph
    $jsondata= array();
    // array to sort data for graph
    $meses = array();
    
    $arrayTemporadas = explode(" ", $temporadas);
     
    $meses = array("Gener","Febrer","Març","Abril","Maig","Juny","Juliol","Agost","Septembre","Octubre", "Novembre", "Decembre");
    
    //Iniciamos json
    $jsondata["cols"][0] = ["id"=>"","label"=>"Consums ".$consumo." ".$edifici,"type"=>"string"];
    
    //Se inicia $i en 1 para continuar con el jsondata['cols'], dependiendo de los años que se hayan seleccinado
    $i = 1;
    //Etiquetamos según la posición de la array
    $x = 0;
    
    foreach($arrayTemporadas  as $temporada){           
            if($tipo == "Consum"){
                if($consumo == "Gas Natural"){
                    $gasnatural = new GasNatural($db);
                    $arrayGraphtemporada = $gasnatural->dataConsumToArrayGraph($edifici, $temporada, $consumo);
                    array_push($arrayGraph,$arrayGraphtemporada);
                    
                }else if($consumo == "Oxigem Ampolles"){
                    // No funciona
                    $oxigenAmpolles = new OxigenAmpolles($db);
                    $arrayGraphtemporada = $oxigenAmpolles->dataConsumToArrayGraph($edifici, $temporada, $consumo);
                    var_dump($arrayGraph);
                    array_push($arrayGraph,$arrayGraphtemporada);

                }
            }else if ($tipo == "PMP"){
                if($consumo == "Gas Natural"){
                    $gasnatural = new GasNatural($db);
                    $arrayGraphtemporada = $gasnatural->dataCostToArrayGraph($edifici, $temporada, $consumo);
                    array_push($arrayGraph,$arrayGraphtemporada);
                    
                }else if ($consumo == "Oxigen Ampolles"){
                    $oxigenAmpolles = new OxigenAmpolles($db);
                    $arrayGraphtemporada = $oxigenAmpolles->dataCostToArrayGraph($edifici, $temporada, $consumo);
                    array_push($arrayGraph,$arrayGraphtemporada);
                }
            }
            $jsondata["cols"][$i] = ["id"=>"","label"=>$arrayTemporadas[$x]." ".$edifici, "type"=>"number"];
            $i++;
            $x++;
        
    }
    
    $db = null;
    
    $jsondata = createDataGraphs($arrayTemporadas,$arrayGraph,$meses,$jsondata);
    
    echo json_encode($jsondata,JSON_PRETTY_PRINT);
    
    
   
    
    
    

?>