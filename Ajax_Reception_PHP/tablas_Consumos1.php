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
    
    require '../config/globals.php';
    require '../config/core.php';
    require '../config/database.php';
    require '../Classes/aigua.php';
    require '../Classes/electricitat.php';
    require '../Classes/oxigenTank.php';
    
    
    $tipo       =  $_REQUEST["tipoconsulta"];
    $consumo    = $_REQUEST["tipoconsumo"];
    $temporadas = $_REQUEST["temporadas"];
    
    $database = new Database();
    $db = $database->getConnection();
    
    //Tablas Consumo
    if ($tipo == 'Consum'){    
        if ($consumo == "Electricitat") {
            $electricitat = new Electricitat($db);
            $electricitat->showTableConsumAny($temporadas);
        }elseif ($consumo == "Aigua"){
            $aigua = new Aigua($db);
            $aigua->showTableConsumAny($temporadas);
        }elseif ($consumo == "Oxigen"){
            $oxigenTank = new OxigenTank($db);
            $oxigenTank->showTableConsumAny($temporadas);
        }else{
            $msg = "La variable consumo ha llegado vacía o incomprensible: " . $consumo;
            $file_error = $GLOBALS['log_file'];        
            fwrite($file_error, $msg);
            fclose($file_error);
        }
        
    //Tablas Costes    
    }elseif ($tipo == 'PMP'){        
        if ($consumo == "Electricitat") {
            $electricitat = new Electricitat($db);
            $electricitat->showTableCostAny($temporadas);
        }elseif ($consumo == "Aigua"){
            $aigua = new Aigua($db);
            $aigua->showTableCostAny($temporadas);
        }elseif ($consumo == "Oxigen"){
            $oxigenTank = new OxigenTank($db);
            $oxigenTank->showTableCostAny($temporadas);           
                    
        }else{
            $msg = "La variable consumo ha llegado vacía o incomprensible: " . $consumo;
            $file_error = $GLOBALS['log_file'];
            fwrite($file_error, $msg);
            fclose($file_error);
        }
        
    }else{
        $msg = "La variable tipo ha llegado vacía o incomprensible: " . $tipo;
        $file_error = $GLOBALS['log_file'];
        fwrite($file_error, $msg);
        fclose($file_error);
    }
    
    $db = null;

?>