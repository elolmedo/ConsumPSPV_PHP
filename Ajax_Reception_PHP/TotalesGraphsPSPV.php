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
    
    // selected years
    $arrayTemporadas = array();

    // array to export data to graph
    $jsondata= array();

    $arrayTemporadas = explode(" ", $temporadas);
    //Controlamos si la consulta solicitada es del tipo totales
    
    $database = new Database();
    $db = $database->getConnection();
    
    if ($edifici == "Totals"){
        
        $arrayEdificis      = returnArrayEdificis($consumo);
        $resultEdificiAny   = array();
        $totalEdificiAny    = array();
        $totals             = array();
        
        foreach($arrayTemporadas as $temp){
            foreach($arrayEdificis as $edifici){
                
                if ($tipo == "Consum"){
                    if ($consumo == "Gas Natural"){
                        $gasnatural = new GasNatural($db);
                        $resultEdificiAny[$temp][$edifici] = $gasnatural->arrayTotalsConsum($temp, $edifici);
                        $totalEdificiAny = sumaarrays($resultEdificiAny[$temp][$edifici]);                        
                        $totals[$temp][$edifici] = $totalEdificiAny;
                        
                    }else if ($consumo == "Oxigen Ampolles"){
                        $oxigenAmpolla = new OxigenAmpolles($db);                        
                        $resultEdificiAny[$temp][$edifici] = $oxigenAmpolla->arrayTotalsConsum($temp, $edifici);
                        $totalEdificiAny = sumaarrays($resultEdificiAny[$temp][$edifici]);
                        $totals[$temp][$edifici] = $totalEdificiAny;
                    }
                }else if($tipo == "PMP"){
                    if ($consumo == "Gas Natural"){
                        $gasnatural = new GasNatural($db);
                        $resultEdificiAny[$temp][$edifici] = $gasnatural->arrayTotalsPMP($temp, $edifici);
                        $totalEdificiAny = sumaarrays($resultEdificiAny[$temp][$edifici]);
                        $totals[$temp][$edifici] = $totalEdificiAny;
                        
                    }else if ($consumo == "Oxigen Ampolles"){
                        $oxigenAmpolla = new OxigenAmpolles($db);
                        $resultEdificiAny[$temp][$edifici] = $oxigenAmpolla->arrayTotalsPMP($temp, $edifici);
                        $totalEdificiAny = sumaarrays($resultEdificiAny[$temp][$edifici]);
                        $totals[$temp][$edifici] = $totalEdificiAny;
                    }
                }
            }
        }    
                
        if($tipo == "Consum"){
            if ($consumo == "Gas Natural"){

                $jsondata["cols"][0] = ["id"=>"Titulo","label"=>"Consums Anuals en kw","type"=>"string"];
                $jsondata["cols"][1] = ["id"=>"Edi","label"=>"Gregal", "type"=>"number"];
                $jsondata["cols"][2] = ["id"=>"Edi","label"=>"Tramuntana", "type"=>"number"];
                $jsondata["cols"][3] = ["id"=>"Edi","label"=>"Xaloc", "type"=>"number"];
                $jsondata["cols"][4] = ["id"=>"Edi","label"=>"Puigmal", "type"=>"number"];
                $jsondata["cols"][5] = ["id"=>"Edi","label"=>"Suport", "type"=>"number"];
                
            }else if ($consumo == "Oxigen Ampolles"){
                $jsondata["cols"][0] = ["id"=>"","label"=>"Consums Anuals en Oxigen Ampolles","type"=>"string"];
                $jsondata["cols"][1] = ["id"=>"","label"=>"Gregal", "type"=>"number"];
                $jsondata["cols"][2] = ["id"=>"","label"=>"Xaloc", "type"=>"number"];
                $jsondata["cols"][3] = ["id"=>"","label"=>"Llevant", "type"=>"number"];
                
            }
        }elseif($tipo == "PMP"){
            if ($consumo == "Gas Natural"){
                $jsondata["cols"][0] = ["id"=>"Titulo","label"=>"PMP Gas Natural Anuals en €","type"=>"string"];
                $jsondata["cols"][1] = ["id"=>"Edi","label"=>"Gregal", "type"=>"number"];
                $jsondata["cols"][2] = ["id"=>"Edi","label"=>"Tramuntana", "type"=>"number"];
                $jsondata["cols"][3] = ["id"=>"Edi","label"=>"Xaloc", "type"=>"number"];
                $jsondata["cols"][4] = ["id"=>"Edi","label"=>"Puigmal", "type"=>"number"];
                $jsondata["cols"][5] = ["id"=>"Edi","label"=>"Suport", "type"=>"number"];
                
            }else if ($consumo == "Oxigen Ampolles"){
                $jsondata["cols"][0] = ["id"=>"","label"=>"Cost Anuals Oxigen Ampolles en €","type"=>"string"];
                $jsondata["cols"][1] = ["id"=>"","label"=>"Gregal", "type"=>"number"];
                $jsondata["cols"][2] = ["id"=>"","label"=>"Xaloc", "type"=>"number"];
                $jsondata["cols"][3] = ["id"=>"","label"=>"Llevant", "type"=>"number"];
                
            }
        }
        
        $jsondata = createTotalDataGraph($temporadas, $arrayEdificis,$totals, $jsondata);
        
        
        $jsonTable = json_encode($jsondata);
        
        echo $jsonTable;
        
        
        
                
    
    
}