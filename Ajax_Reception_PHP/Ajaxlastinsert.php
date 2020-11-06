<?php

    require '../Classes/gasnatural.php';
    require '../Classes/oxigenAmpolla.php';
    require '../Classes/oxigenTank.php';
    require '../Classes/electricitat.php';
    require '../Classes/aigua.php';
    
    
    require '../config/database.php';
    require '../config/core.php';
    
    
    $consumo = $_GET["lastinserts"];
    
    $database = new Database();
    $db = $database->getConnection();
    
    if ($consumo ==  "Gas Natural"){
        
        print "<div radio radio-inline class=\"col-md-12\">";        
            $gasNatural = new GasNatural($db);
            $gasNatural->lastinsert($consumo);       
        print "</div>";
        
    } elseif ($consumo == "Oxigen Ampolles") {
        
        print "<div radio radio-inline class=\"col-md-12\">";
            $oxigenAmpolla = new OxigenAmpolles($db);
            $oxigenAmpolla->last_insert($consumo);    
        print "</div>";
        
    } elseif ($consumo == "Oxigen") {
        
        $oxigenTank = new OxigenTank($db);
        $oxigenTank->last_insert($consumo);
        
    } elseif ($consumo == "Electricitat") {
        
        $electricitat = new Electricitat($db);
        $electricitat->last_insert();
        
    } elseif ($consumo == "Aigua"){
        
        $aigua = new Aigua($db);
        $aigua->last_insert();
        
    } else {
        
        print "<h4 id=\"pepito\"> Has de triar un tipus de Consum</h4>";
    }
    
    $db = null;
    
 ?>