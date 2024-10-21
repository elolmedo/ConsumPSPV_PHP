<?php

##########################
#@autor: Raúl Olmedo
#@date: 07-03-20
#@file: core.php
#@function: This script contain principal functions for log Errors, access to DB, and control dates with the format numeric epoch
###########################

include 'globals.php';

if(!function_exists("errorLog")){
    function errorLog($msg){
        
        $file  = $GLOBALS['log_file'];
        fwrite($file,$msg);
        fclose($file);
    }
}

if(!function_exists("controlLog")){
    function controlLog($msg){
        
        $file  = $GLOBALS['log_db'];
        fwrite($file,$msg);
        fclose($file);
    }
}

if(!function_exists("passToEpoch")){
    function passToEpoch($date){
        
        $epoch_date = strtotime($date);
        return $epoch_date;
        
    }
    
}

if (!function_exists("passEpochToDate")){
    function passEpochToDate($epochNumber){
        
         $date = date("Y-m-d H:i:s", substr($epochNumber, 0, 10));
         
         return $date;
        
    }
}

if (!function_exists("returnArrayEdificis")){
    
    function returnArrayEdificis($consumo){
        $arrayEdificis = array();
        
        if($consumo == "Gas Natural"){
            $arrayEdificis = ["GRE","TRA","XAL","PUI","SUP"];
        }elseif($consumo == "Oxigen Ampolles"){
            $arrayEdificis = ["GRE","XAL","LLE"];
        }
        return $arrayEdificis;
    }
}

## Function to create menú of selected years
if(!function_exists("createYears")){
    function createYears(){
        $years = [2012,2013,2014,2015,2016,2017];
        $years_2 = [2018,2019,2020,2021,2022,2023,2024];
        $contador = 0;
             
        
        print '<div class="form-check form-check-inline" style="text-align:center">';
        foreach ($years as $year){        		        	
           
            print '<input class="form-check-input" type="checkbox" name="'.$year.'" id="'.$year.'" value="'.$year.'">';
            print '<label class="form-check-label" for="'.$year.'" style="margin-right: 5px;">'.$year.'</label>';
            
        }
        print '</div>';
        print '<div class="form-check form-check-inline" style="text-align:center">';
        foreach ($years_2 as $year){
        	
        	print '<input class="form-check-input" type="checkbox" name="'.$year.'" id="'.$year.'" value="'.$year.'">';
        	print '<label class="form-check-label" for="'.$year.'" style="margin-right: 5px;">'.$year.'</label>';
        	
        }

        print '</div>';
        
    }
}

##Creación de string para los includes de postgres, creamos la consulta SQL instertando los años
##Para query SQL acabadas en IN. Luego la finalizamos
if (!function_exists("createIncludeTemporadas")){
    function createIncludeTemporadas($sql,$temporadas){
        
        $arrayTemporadas = explode(" ", $temporadas);
        $seleccioAnys = "(";
        foreach ($arrayTemporadas as $temp){
            
            $seleccioAnys .= $temp.",";
            
        }
        //Quitamos el último carácter que es una coma ','
        $seleccioAnys = mb_substr($seleccioAnys, 0, -1);
        $seleccioAnys .= ")";
        //Formamos consulta SQL
        $sql .= $seleccioAnys;
        
        return $sql;
    }
}

// Traductor de Edificios a nomenclatura
if (!function_exists("traductorEdificis")){
    function traductorEdificis($edifici){
        
        $arraynomComplets   = array();
        $arraynomenclatura    = array();
        $arraynomComplets   = ["Gregal","Tramuntana","Xaloc","Puigmal","Suport","Llevant"];
        $arraynomenclatura    = ["GRE","TRA","XAL","PUI","SUP","LLE"];
        
        $nomenclatura = "";
        
        $max_array = count($arraynomComplets);
        for ($x=0; $x<$max_array;$x++){
            if($edifici == $arraynomComplets[$x]){
                $nomenclatura = $arraynomenclatura[$x];
            }
        }
        return $nomenclatura;
    }
}

// Function to create json structura with data recivied.
if (!function_exists("createDataGraphs")){
    function createDataGraphs($arrayTemporadas, $arrayGraph, $meses, $jsondata){
        $maxTemporadas = count($arrayTemporadas);
        if ($maxTemporadas < 2){            
            $index = 0;
            foreach($arrayTemporadas  as $temp){
                if ($temp != ""){
                    $year = intval($temp);
                    for ($j = 0; $j<=11; $j++){
                        $jsondata["rows"][$j] = array(
                            "c"=>array(
                                ["v"=>$meses[$j]],
                                ["v"=>$arrayGraph[$index][$year][$j]],
                                
                            ));
                    }
                    break;
                }
            }
            
        }elseif ($maxTemporadas == 2){
            
            $index = 0;
            $indice = 1;
            
            foreach($arrayTemporadas  as $temp){
                if ($temp != ""){
                    $year = intval($temp);
                    for ($j = 0; $j<=11; $j++){
                        $jsondata["rows"][$j] = array(
                            "c"=>array(
                                ["v"=>$meses[$j]],
                                ["v"=>$arrayGraph[$index][$year][$j]],
                                ["v"=>$arrayGraph[$indice][$year+1][$j]],
                            ));
                    }
                    break;
                }
            }
        }elseif ($maxTemporadas > 2){
            $index = 0;
            $indice = 1;
            $ind = 2;
            
            
            foreach($arrayTemporadas  as $temp){
                if ($temp != ""){
                    $year = intval($temp);
                    for ($j = 0; $j<=11; $j++){
                        $jsondata["rows"][$j] = array(
                            "c"=>array(
                                ["v"=>$meses[$j]],
                                ["v"=>$arrayGraph[$index][$year][$j]],
                                ["v"=>$arrayGraph[$indice][$year+1][$j]],
                                ["v"=>$arrayGraph[$ind][$year+2][$j]],
                                
                            ));
                    }
                    break;
                }
                
            }
        }
        return $jsondata;
    }
}

if (!function_exists("createTotalDataGraph")){
    function createTotalDataGraph($temporadas, $arrayEdificis,$totals, $jsondata){
        
        $arrayTemporadas = explode(" ", $temporadas);        
        $maxEdifici = count($arrayEdificis);
        $indice = 0;
        
        if ($maxEdifici < 5 ){
            foreach($arrayTemporadas as $temp){
                
                $temporada = intval($temp);
                $jsondata["rows"][$indice] = array("c"=>array(  ["v"=>$temporada],
                    ["v"=>$totals[$temporada]["GRE"]],
                    ["v"=>$totals[$temporada]["XAL"]],
                    ["v"=>$totals[$temporada]["LLE"]],
                ));
                $indice++;
                
                
            }
            
            return $jsondata;
        }else{
            foreach($arrayTemporadas as $temp){
                
                $temporada = intval($temp);
                $jsondata["rows"][$indice] = array("c"=>array(  ["v"=>$temporada],
                    ["v"=>$totals[$temporada]["GRE"]],
                    ["v"=>$totals[$temporada]["TRA"]],
                    ["v"=>$totals[$temporada]["XAL"]],
                    ["v"=>$totals[$temporada]["PUI"]],
                    ["v"=>$totals[$temporada]["SUP"]],
                ));
                $indice++;
                
                
            }
            
            return $jsondata;
        }
    }
}

if (!function_exists("arrayTotalsConsumGasNatural")){
    function arrayTotalsConsumGasNatural($temp,$edifici){
        
        $error_db = $GLOBALS['log_db'];
        
        $db = connectDb();
        
        $sql = "SELECT temporada,mes,SUM(lectura_actual-lectura_anterior)
                    FROM pspv_schema.consumsgasnatural
                    WHERE temporada = ". $temp ."
                    AND id_edifici LIKE '$edifici'
                    GROUP BY 1,2
                    ORDER BY mes='Gener',mes='Febrer',mes='Març',mes='Abril',mes='Maig',mes='Juny',mes='Juliol',mes='Agost',mes='Septembre',mes='Octubre',mes='Novembre',mes='Decembre';";
        
        try{
            $result = pg_query($db,$sql);
        } catch (Exception $e){
            $msg = "[ERR] Error en función totalsConsumXEdificis. MSG: ".pg_last_error($db)."\n";
            errorLog($msg);
        }
        
        if (!$result) {
            $msg =  "Error en la consulta del 2013.\n";
            errorLog($msg);
            exit;
        }
        
        // Asignación de los PMP del Aigua del 2014
        $decembre = pg_fetch_result($result, 1, 2);
        $novembre = pg_fetch_result($result, 2, 2);
        $octubre = pg_fetch_result($result, 3, 2);
        $septembre = pg_fetch_result($result, 0, 2);
        $agost = pg_fetch_result($result, 4, 2);
        $juliol = pg_fetch_result($result, 5, 2);
        $juny = pg_fetch_result($result, 6, 2);
        $maig = pg_fetch_result($result, 7, 2);
        $abril = pg_fetch_result($result, 8, 2);
        $marzo = pg_fetch_result($result, 9, 2);
        $febrer = pg_fetch_result($result, 10, 2);
        $gener = pg_fetch_result($result, 11, 2);
        
        $arr = array($gener, $febrer, $marzo, $abril, $maig, $juny, $juliol, $agost, $septembre, $octubre, $novembre, $decembre);
        return $arr;
    }
}

if (!function_exists("arrayTotalsPMPGasNatural")){
    function arrayTotalsPMPGasNatural($temp,$edifici){
        
        $error_db = $GLOBALS['log_db'];
        
        $db = connectDb();
        
        $sql = "SELECT g.mes,(g.lectura_actual-g.lectura_anterior)*p.cantitat*g.conversio
                    FROM pspv_schema.consumsgasnatural g, pspv_schema.conversio_preus p
                    WHERE g.id_preu = p.id
                    AND temporada = ".$temp."
                    AND id_edifici LIKE '$edifici'
                    ORDER BY mes='Decembre', mes='Novembre',mes='Octubre', mes='Septembre', mes='Agost', mes='Juliol', mes='Juny',mes='Maig',mes='Abril',mes='Març',mes='Febrer',mes='Gener';";
        
        
        try{
            $result = pg_query($db,$sql);
        } catch (Exception $e){
            $msg = "[ERR] Error en función arrayTotalsConsumGasNatural. MSG: ".pg_last_error($db)."\n";
            errorLog($msg);
        }
        
        if (!$result) {
            echo "Error en la consulta del 2015.\n";
            exit;
        }
        
        // Asignación de los PMP del Aigua del 2014
        $gener = pg_fetch_result($result, 0, 1);
        $febrer = pg_fetch_result($result, 1, 1);
        $marzo = pg_fetch_result($result, 2, 1);
        $abril = pg_fetch_result($result, 3, 1);
        $maig = pg_fetch_result($result, 4, 1);
        $juny = pg_fetch_result($result, 5, 1);
        $juliol = pg_fetch_result($result, 6, 1);
        $agost = pg_fetch_result($result, 7, 1);
        $septembre = pg_fetch_result($result, 8, 1);
        $octubre = pg_fetch_result($result, 9, 1);
        $novembre = pg_fetch_result($result, 10, 1);
        $decembre = pg_fetch_result($result, 11, 1);
        
        $arr = array($gener, $febrer, $marzo, $abril, $maig, $juny, $juliol, $agost, $septembre, $octubre, $novembre, $decembre);
        return $arr;
    }
}

if (!function_exists("arrayTotalsConsumoOxigenAmpolles")){
    function arrayTotalsConsumoOxigenAmpolles($temp,$edifici){
        $error_db = $GLOBALS['log_db'];
        
        $db = connectDb();
        
        $sql = "    SELECT temporada,mes,SUM(num_botellas)
                        FROM pspv_schema.consumoxiflow_ampolla
                        WHERE temporada = ". $temp ."
                        AND id_edifici LIKE '$edifici'
                        GROUP BY 1,2
                        ORDER BY mes='Gener',mes='Febrer',mes='Març',mes='Abril',mes='Maig',mes='Juny',mes='Juliol',mes='Agost',mes='Septembre',mes='Octubre',mes='Novembre',mes='Decembre';";
        
        
        try{
            $result = pg_query($db,$sql);
        } catch (Exception $e){
            $msg = "[ERR] Error en función totalsConsumXEdificis. MSG: ".$e."\n";
            errorLog($msg);
        }
        
        if (!$result) {
            echo "Error en la consulta.\n";
            exit;
        }
        
        // Asignación de datos del 2013
        $decembre 	= pg_fetch_result($result,0,2);
        $novembre 	= pg_fetch_result($result,1,2);
        $octubre 		= pg_fetch_result($result,2,2);
        $septembre	= pg_fetch_result($result,3,2);
        $agost			= pg_fetch_result($result,4,2);
        $juliol			= pg_fetch_result($result,5,2);
        $juny			= pg_fetch_result($result,6,2);
        $maig			= pg_fetch_result($result,7,2);
        $abril			= pg_fetch_result($result,8,2);
        $marzo		= pg_fetch_result($result,9,2);
        $febrer		= pg_fetch_result($result,10,2);
        $gener			= pg_fetch_result($result,11,2);
        
        $arr = array($gener,$febrer,$marzo,$abril,$maig,$juny,$juliol,$agost,$septembre,$octubre,$novembre,$decembre);
        return $arr;
        
    }
}
if (!function_exists("arrayTotalsPMPOxigenAmpolles")){
    function arrayTotalsPMPOxigenAmpolles($temp,$edifici){
        $error_db = $GLOBALS['log_db'];
        
        $db = connectDb();
        
        $sql = "    SELECT mes,SUM(num_botellas)*p.cantitat
                    FROM pspv_schema.consumoxiflow_ampolla o, pspv_schema.conversio_preus p
                    WHERE  o.id_preu = p.id
                    AND temporada = ".$temp."
                    AND id_edifici LIKE '$edifici'
                    GROUP BY temporada,mes,p.cantitat
                    ORDER BY mes='Decembre', mes='Novembre',mes='Octubre', mes='Septembre', mes='Agost', mes='Juliol', mes='Juny',mes='Maig',mes='Abril',mes='Març',mes='Febrer',mes='Gener';";
        
        
        try{
            $result = pg_query($db,$sql);
        } catch (Exception $e){
            $msg = "[ERR] Error en función arrayTotalsConsumoOxigenAmpolles. MSG: ".pg_last_error($db)."\n";
            errorLog($msg);
        }
        
        if (!$result) {
            echo "Error en la consulta de.\n";
            exit;
        }
        
        // Asignación de los PMP del Aigua del 2014
        $gener 		= pg_fetch_result($result,0,1);
        $febrer 		= pg_fetch_result($result,1,1);
        $marzo 		= pg_fetch_result($result,2,1);
        $abril			= pg_fetch_result($result,3,1);
        $maig			= pg_fetch_result($result,4,1);
        $juny			= pg_fetch_result($result,5,1);
        $juliol			= pg_fetch_result($result,6,1);
        $agost			= pg_fetch_result($result,7,1);
        $septembre	= pg_fetch_result($result,8,1);
        $octubre		= pg_fetch_result($result,9,1);
        $novembre	= pg_fetch_result($result,10,1);
        $decembre	= pg_fetch_result($result,11,1);
        
        $arr = array($gener,$febrer,$marzo,$abril,$maig,$juny,$juliol,$agost,$septembre,$octubre,$novembre,$decembre);
        return $arr;
        
    }
}

if (!function_exists("arrayGraphsTotalsConsumos2")){
    
    function arrayGraphsTotalsConsumos2($tipo,$consumo,$temp,$edifici){
        
        if ($tipo == "Consum"){
            if ($consumo == "Gas Natural"){
                
                $Data = arrayTotalsConsumGasNatural($temp,$edifici);
                
            }else if ($consumo == "Oxigen Ampolles"){
                
                $Data = arrayTotalsConsumoOxigenAmpolles($temp,$edifici);
                
            }
        }else if($tipo == "PMP"){
            if ($consumo == "Gas Natural"){
                
                $Data =  arrayTotalsPMPGasNatural($temp,$edifici);
                
            }else if ($consumo == "Oxigen Ampolles"){
                
                $Data = arrayTotalsPMPOxigenAmpolles($temp,$edifici);
                
            }
        }
        return $Data;
        
        
        
        
    }
}

if (!function_exists("createCSVConsum")){
	function createCSVConsum($tipo){
        
		$indice = traductorConsumos_DB($tipo);
        echo '<h6>Creant fitxer file_'.$indice.'.csv</h6>';
        $fichero = "/var/www/ConsumsPSPV/CSV/file_".$indice.".csv";
        return $fichero;
    }
}

//Traductor $consumo -> tabla_basedatos
if (!function_exists("traductorConsumos_DB")){
    function traductorConsumos_DB($consumo){
        
        $arrayConsumo       = array();
        $arrayConsumo_DB    = array();
        
        $arrayConsumo       = ["Electricitat","Aigua","Oxigen","Gas Natural","Oxigen Ampolles"];
        $arrayConsumo_DB    = ["consumselectricitat","consumsaigua","consumoxiflow_tank","consumsgasnatural","consumoxiflow_ampolla"];
        $max_array = count($arrayConsumo);        
        $tabla_db = "";        
        for ($x=0; $x<$max_array;$x++){
            if($consumo == $arrayConsumo[$x]){
                $tabla_db = $arrayConsumo_DB[$x];
            }            
        }        
        return $tabla_db;        
    }
}

if (!function_exists("generateMenuDownloadFile")){
    function generateMenuDownloadFile($tipo){
        $indice = traductorConsumos_DB($tipo);
        
        $url = 'CSV/file_'.$indice.'.csv';
        
        echo '<div class="col col-md-6" id="downloadDiv">'."\n";
        echo '<h6>Descarrega Fitxer</h6>'."\n";
        echo '<span id="tagConsum" class="label label-success">'.$tipo.'</span>'."\n";
        echo '<br>'."\n";
        echo '<a href="'.$url.'" class="btn btn-info btn-sm alert-link">Click para la Descarga de '.$tipo.'</a>'."\n";
        echo '</div>'."\n";
        
    }
}

if (!function_exists("generateMenuUploadFile")){
    function generateMenuUploadFile($tipo){
        
        echo '<div class="col col-md-6" id="divUploadFile">'."\n";
        echo '<span class="label label-danger">PUJADA DE DADES AL SERVIDOR!</span>'."\n";
        echo '<form action="../Ajax_Reception_PHP/receptData.php?tipo='.$tipo.'" method="post" enctype="multipart/form-data">' ."\n";
        echo '<h5>Selecció fitxer per Actualitzar les Dades Consum:</h5>'."\n";
        echo '<span class="label label-success">'.$tipo.'</span>'."\n";
        echo '<select name="sel_tipo" id="sel_tipo" style="display:none;">'."\n";
        echo '<option>'.$tipo.'</option>'."\n";
        echo '</select>'."\n";
        
        echo '<input style="margin-top: 2%;"type="file" name="fileToUpload" id="fileToUpload">'."\n";
        echo '<input class="btn btn-danger"type="submit" value="Pujar Fitxer" name="submit">'."\n";
        echo '</form>';
        echo '</div>'."\n";
        
    }
}

if(!function_exists("comprobateFile")){
    function comprobateFile($tipo,$target_name){
        
        $file = 1;        
        if($tipo == "Gas Natural"){
            if($target_name != "file_consumsgasnatural.csv"){
                $file = 0;
            }
        }elseif($tipo == "Oxigen Ampolles"){
            if($target_name != "file_consumoxiflow_ampolla.csv"){
                $file = 0;
            }
        }elseif ($tipo == "Aigua"){
            if($target_name != "file_consumsaigua.csv"){
                $file = 0;
            }
        }elseif ($tipo == "Electricitat"){
            if($target_name != "file_consumselectricitat.csv"){
                $file = 0;
            }
        }elseif ($tipo == "Oxigen"){
            if($target_name != "file_consumoxiflow_tank.csv"){
                $file = 0;
            }
        }else{
            $file = 0;
        }        
        return $file;              
    }
}

if (!function_exists("randomChars")){
	//Función para encryptar un password
	function randomChars(){
		//Lectura recomendada: https://mimentevuela.wordpress.com/2015/10/08/establecer-blowfish-como-salt-en-crypt-2/
		//TODO investigar función rand y revisar la web de arriba
		$chars = "abcdefghijklmnopqrstuvwxyz1234567890";
		$new_pass = '';	
		for($i = 5; $i<30; $i++){
			$new_pass .= $chars[rand(5,30)];
		}
		return $new_pass;
	}
}
if(!function_exists("sumaarrays")){
	function sumaarrays($array){
		
		$arraylength = count($array);
		$suma = 0;
		
		for ($x = 0; $x < $arraylength; $x++){
			
			$number = (int)$array[$x];
			$suma += $number;
		}
		return $suma;
	}
}
