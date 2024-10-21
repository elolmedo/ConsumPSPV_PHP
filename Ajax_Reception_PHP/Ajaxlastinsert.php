<?php

    require '../Classes/gasnatural.php';
    require '../Classes/oxigenAmpolla.php';
    require '../Classes/oxigenTank.php';
    require '../Classes/electricitat.php';
    require '../Classes/aigua.php';
    
    
    require '../config/database.php';
    require '../config/core.php';
        
    $consumo = $_REQUEST["lastinserts"];
    $edifici = $_REQUEST["edifici"];
    
    
    $database = new Database();
    $db = $database->getConnection();
    
    if ($consumo ==  "Gas Natural"){
    	$gasNatural = new GasNatural($db);
    	if($edifici == "TRA"){    		
    		$gasNatural->lastInsertDT_TRA();
    	}elseif($edifici == "GRE"){
    		$gasNatural->lastInsertDT_GRE();
    	}elseif($edifici == "XAL"){
    		$gasNatural->lastInsertDT_XAL();
    	}elseif($edifici == "PUI"){
    		$gasNatural->lastInsertDT_PUI();
    	}elseif($edifici == "SUP"){
    		$gasNatural->lastInsertDT_SUP();
    	}
              
    } elseif ($consumo == "Oxigen Ampolles") {
    	$oxigenAmpolla = new OxigenAmpolles($db);    	
    	if($edifici == "GRE"){
    		$oxigenAmpolla->lastInsertDT_GRE();
    	}elseif ($edifici == "XAL"){
    		$oxigenAmpolla->lastInsertDT_XAL();    		    		
    	}elseif ($edifici == "LLE"){
    		$oxigenAmpolla->lastInsertDT_LLE();    		
    	}
        
    } elseif ($consumo == "Oxigen") {
    	$oxigenTank = new OxigenTank($db);
        $oxigenTank->lastInsertDT();       
    } elseif ($consumo == "Electricitat") {        
        $electricitat = new Electricitat($db);
		$electricitat->lastInsertDT();
        
    } elseif ($consumo == "Aigua"){        
        $aigua = new Aigua($db);
        $aigua->lastInsertDT();        
        
    } else {
        
        print "<h4 id=\"pepito\"> Has de triar un tipus de Consum</h4>";
    }
    
    $db = null;
    
 ?>