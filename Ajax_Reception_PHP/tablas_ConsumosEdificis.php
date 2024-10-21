<?php

//     //Reanudamos la sesión
//     session_start();
//     if(!isset($_SESSION['usuario']) and $_SESSION['estado'] != 'Autorizado'){
//         echo 'Mal inicio de sesión;';
//         header('Location: ../index.php');
//     }else{
        
//         $usernick = $_SESSION['usuario'];
//         $userpass = $_SESSION['password'];
        
//         require ('../config/sesiones.php');
        
//     }
    
    require '../config/core.php';
    require '../config/database.php';
    require '../Classes/oxigenAmpolla.php';
    require '../Classes/gasnatural.php';
    
    $tipo       = $_REQUEST["tipo"];
    $consumo    = $_REQUEST["consumo"];
    $temporadas = $_REQUEST["temporadas"];
    $edifici    = $_REQUEST["edificio"];
    
    $database = new Database();
    $db = $database->getConnection();
    
    if ($tipo == "Consum"){
        
        if ($edifici == "Totals"){
            if($consumo == "Gas Natural"){
                $gasnatural = new GasNatural($db);
                $gasnatural->showTableTotalsConsumXanys($temporadas, $consumo);
                
            }elseif($consumo == "Oxigen Ampolles"){
                $oxigenAmpolla = new OxigenAmpolles($db);
                $oxigenAmpolla->showTableTotalsAnys($temporadas, $consumo);
                
            }            
        }else{
            if($consumo == "Gas Natural"){
                $gasnatural = new GasNatural($db);
                $gasnatural->showTableConsumAnyEdifici($temporadas, $edifici, $consumo);
                
            }elseif($consumo == "Oxigen Ampolles"){
                $oxigenAmpolla = new OxigenAmpolles($db);
                $oxigenAmpolla->showTableConsumEdificiAny($temporadas, $edifici, $consumo);
                
            }
        }
         
    }elseif ($tipo == "PMP"){
        if ($edifici == "Totals"){
            if($consumo == "Gas Natural"){
                $gasnatural = new GasNatural($db);
                $gasnatural->showTableTotalsCostxanys($temporadas, $consumo);
                
            }elseif($consumo == "Oxigen Ampolles"){
                $oxigenAmpolla = new OxigenAmpolles($db);
                $oxigenAmpolla->showTableTotalsCostxanys($temporadas, $consumo);
                
            }
        }else{
            if($consumo == "Gas Natural"){
                $gasnatural = new GasNatural($db);
                $gasnatural->showTableCostEdificiAny($temporadas, $edifici, $consumo);
                
            }elseif($consumo == "Oxigen Ampolles"){
                $oxigenAmpolla = new OxigenAmpolles($db);
                $oxigenAmpolla->showTableCostEdificiAny($temporadas, $edifici, $consumo);
            }
        }
    }else{
        //ERROR
    }
        
    $db = null;