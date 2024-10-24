<?php

##########################
#@autor: Raúl Olmedo
#@date: 20-03-20
#@file: oxigenAmpolles.php
#@function: This script contain Class Oxigen Ampolles.
###########################

include '../config/core.php';
include '../config/globals.php';

class OxigenAmpolles{
    
    private $connection;
    private $table_name = "consumoxiflow_ampolla";
    
    //Propierties
    public $mes;
    public $temporada;
    public $id_edifici;
    public $planta_edifici;
    public $id_preu;
    public $num_botellas;
    
    //Constructor
    public function __construct($db){
        $this->connection = $db;
    }
    //Last Inserts with Datatable.
    public function lastInsertDT_GRE(){
    	$data = array();
    	$sql = "       SELECT id,temporada,id_edifici, planta_edifici,mes,SUM(num_botellas) as total
                                    FROM pspv_schema.".$this->table_name."
                                    WHERE id_edifici = 'GRE' 
                                    GROUP BY 1,2,3,4,5
                                    ORDER BY 1 desc
                                    LIMIT 10";
    	$result = pg_query($sql);
    	while ($row = pg_fetch_assoc($result)) {
    		$arrayEdifici = array(
    				"id" => $row["id"],
    				"Temporada" => $row['temporada'],
    				"Edifici" => $row['id_edifici'],    				
    				"Mes" => $row['mes'],
    				"Planta" => $row['planta_edifici'],
    				"Ampolles" => $row['total'],
    		);
    		array_push($data,$arrayEdifici);
    	}
    	$arrayGas["Oxiflow_GRE"] = "";
    	$arrayGas["Oxiflow_GRE"] = $data;
    	echo json_encode($arrayGas,JSON_PRETTY_PRINT);
    	
    	
    	
                      
    }
    public function lastInsertDT_XAL(){
    	$data = array();
    	$sql = "       SELECT id, temporada,id_edifici, planta_edifici,mes,SUM(num_botellas) as total
                                    FROM pspv_schema.".$this->table_name."
                                    WHERE id_edifici = 'XAL' and temporada = 2023
                                    GROUP BY 1,2,3,4,5
                                    ORDER BY 1 DESC 
                                    LIMIT 10";
    	$result = pg_query($sql);
    	while ($row = pg_fetch_assoc($result)) {
    		$arrayEdifici = array(
    				"id" => $row["id"],    				
    				"Temporada" => $row['temporada'],
    				"Edifici" => $row['id_edifici'],
    				"Mes" => $row['mes'],
    				"Planta" => $row['planta_edifici'],
    				"Ampolles" => $row['total'],
    		);
    		array_push($data,$arrayEdifici);
    	}
    	$arrayGas["Oxiflow_XAL"] = "";
    	$arrayGas["Oxiflow_XAL"] = $data;
    	echo json_encode($arrayGas,JSON_PRETTY_PRINT);
    	
    }
    
    public function lastInsertDT_LLE(){
    	$data = array();
    	$sql = "       SELECT id,temporada,id_edifici, planta_edifici,mes,SUM(num_botellas) as total
                                    FROM pspv_schema.".$this->table_name."
                                    WHERE id_edifici = 'LLE'  and temporada = 2023
                                    GROUP BY 1,2,3,4,5
                                    ORDER BY 1 DESC
                                    LIMIT 10";
    	$result = pg_query($sql);
    	while ($row = pg_fetch_assoc($result)) {
    		$arrayEdifici = array(
    				"id" => $row["id"],    				
    				"Temporada" => $row['temporada'],
    				"Edifici" => $row['id_edifici'],
    				"Mes" => $row['mes'],
    				"Planta" => $row['planta_edifici'],
    				"Ampolles" => $row['total'],
    		);
    		array_push($data,$arrayEdifici);
    	}
    	$arrayGas["Oxiflow_LLE"] = "";
    	$arrayGas["Oxiflow_LLE"] = $data;
    	echo json_encode($arrayGas,JSON_PRETTY_PRINT);
    }
    
    
    public function last_insert(){
    	$consumo = "Oxigen Ampolles";
        $arrayEdificis = returnArrayEdificis($consumo);
        print "<div class=\"col-md-12\">\n";
        foreach ($arrayEdificis as $edifici){
            
            $sql3 = "       SELECT id,temporada,id_edifici, planta_edifici,mes,SUM(num_botellas)
                                    FROM pspv_schema.".$this->table_name."
                                    WHERE id_edifici = '$edifici' and temporada = 2023 or temporada = 2024
                                    GROUP BY 1,2,3,4,5
                                    ORDER BY 1 DESC
                                    LIMIT 10
                                    
                                    
                    ";
            $result = pg_query($sql3);
            print "<div class=\"col-md-5\">\n";
            print "<h4>Cosum ampolles Oxiflow ".$edifici." / Ultimes insercions</h4><br>";
            print "<table class=\"table table-bordered table-striped\">\n";
            // Obtenemos los nombres de los campos
            
            print "<tr>\n";
            print "<th>Id</th>";
            print "<th>Temp</th>";
            print "<th>Edi</th>";
            print "<th>Plt</th>";
            print "<th>Mes</th>";
            print "<th>ampolles</th>";
            
            
            print "</tr>\n\n";
            
            // Obtenemos de datos en forma de array asociativo
            
            while ($row = pg_fetch_assoc($result)){
                print "<tr>\n";
                // Examinamos cada campo
                
                foreach ($row as $col => $val) {
                    $valor = gettype($val);
                    if($valor != "integer"){
                        print "<td> $val </td>\n";
                    }else{
                        $val = round($val,3);
                        print "<td> $val </td>\n";
                    }
                } // fin foreach
                print "</tr>\n\n";
            } // fin while
            print "</table>\n";
            print "</div>\n";
        }
        print "</div>\n";
        
    }
    
    public function showTableConsumEdificiAny($temporadas,$edifici,$consum){
        $nomenclatura = traductorEdificis($edifici);
        
        $arrayTemporadas = array();
        $arrayTemporadas = explode(" ", $temporadas);
        
        $arrayConsumosEdificio = Array();
        $arrayTotalesEdificio = Array();
        
        $presql = "SELECT temporada,SUM(num_botellas)
                        FROM pspv_schema.";
        $presql .= $this->table_name;
        $pregroup  = " GROUP BY 1;";
        
        // Obtenemos todos consumos de los años seleccinados por meses
        foreach ($arrayTemporadas as $temp){
            
            $index = 1;
            $sql = "";
            $sql."".$index = $presql;
            $sql."".$index.= " WHERE temporada = ";
            $sql."".$index .= $temp;
            $sql."".$index .= " AND id_edifici LIKE ";
            $sql."".$index .= "'$nomenclatura'";
            $sql."".$index .= $pregroup;
            
            try{
                $result = pg_query($sql."".$index);
            }catch(Exception $e){
                $msg = "[ERR] Error en la funcion consumXEdificis, dentro del 1er bucle. MSG Posgtres: ".$e." Fecha: ".$GLOBALS['fecha']."\n";
                errorLog($msg);
            }
            
            $arrayConsumosEdificio[] = $result;
            $index++;
        }
        
        //Creamos array con los resultados de una temporada, luego los sumamos y añidimos al array total
        //Función principal de index $arrayTemporadas
        $index = 0;
        foreach ($arrayConsumosEdificio as $ConsumosEdidificios){
            $sumasEdificios= array();
            while($row = pg_fetch_assoc($ConsumosEdidificios)){
                foreach ($row as $col => $val) {
                    if($col == "temporada" and $val == $arrayTemporadas[$index]){
                        array_push($sumasEdificios,$row['sum']);
                        ## Si no funciona, echo de $row['num']
                    }
                }
                $totalEdificio = array_sum($sumasEdificios);
            }
            array_push($arrayTotalesEdificio,$totalEdificio);
            $index++;
        }
        
        print "<h4>Consum $consum $edifici</h4>";
        print "<table class=\"table table-bordered table-striped table-responsive\">\n";
        print "<tr>\n";
        print "<th>Temporarada</th>";
        foreach($arrayTemporadas as $temp){
            print '<td>'.$temp.'</td>';
        }
        
        print "</tr>";
        
        // Obtenemos de datos en forma de array asociativo
        
        print '<tr>';
        print '<th>Totals m³</th>';
        foreach ($arrayTotalesEdificio as $val) {
            
            $val = number_format($val,0,',','.');
            print "<td> $val </td>\n";
        }
        print '</tr>';
        print "</table>\n";
        
    }

    public function showTableCostEdificiAny($temporadas,$edifici,$consumo){
        $nomenclatura = traductorEdificis($edifici);
        
        $arrayTemporadas = array();
        $arrayTemporadas = explode(" ", $temporadas);
        
        $arrayConsumosEdificio = Array();
        $arrayTotalesEdificio = Array();
        
        //Variables para formar la sentencia sql
        $pre_sql = "";
        $pre_group = "";
        $pre_where = "";
        
        //Según el consumo la consulta obtendrá distintos campos, esta variable nos ayuda a controlarlo en el if.
        $pre_value_row = "";
        
        $medida  = "€";
        
        $pre_sql = "SELECT temporada,mes,SUM(num_botellas)*p.cantitat
                        FROM pspv_schema.";
        $pre_group  = " GROUP BY temporada,mes,p.cantitat
                            ORDER BY mes='Decembre', mes='Novembre',mes='Octubre', mes='Septembre', mes='Agost', mes='Juliol', mes='Juny',mes='Maig',mes='Abril',mes='Març',mes='Febrer',mes='Gener';";
        $pre_relation = " o, pspv_schema.conversio_preus p";
        $pre_where = " WHERE  o.id_preu = p.id";
        $pre_value_row = "?column?";
        
        // Obtenemos todos consumos de los años seleccinados por meses
        foreach ($arrayTemporadas as $temp){
            
            $index = 1;
            $sql = "";            
            $sql."".$index = $pre_sql;
            $sql."".$index .= $this->table_name;
            $sql."".$index .= $pre_relation;
            $sql."".$index .= $pre_where;
            $sql."".$index .= " AND temporada = ";
            $sql."".$index .= $temp;
            $sql."".$index .= " AND id_edifici LIKE ";
            $sql."".$index .= "'$nomenclatura'";
            $sql."".$index .= $pre_group;
            
            $result = pg_query($sql."".$index);
            
            $arrayConsumosEdificio[] = $result;
            
            $index++;
            
        }
        
        //Creamos array con los resultados de una temporada, luego los sumamos y añidimos al array total
        //Función principal de index $arrayTemporadas
        $index = 0;
        foreach ($arrayConsumosEdificio as $ConsumosEdidifcios){
            
            $sumasEdificios= array();
            while($row = pg_fetch_assoc($ConsumosEdidifcios)){
                foreach ($row as $col => $val) {
                    if($col == "temporada" and $val == $arrayTemporadas[$index]){
                        array_push($sumasEdificios,$row[$pre_value_row]);
                    }
                }
                $totalEdificio = array_sum($sumasEdificios);
            }
            
            array_push($arrayTotalesEdificio,$totalEdificio);
            $index++;
        }
        
        print "<h4>PMP $consumo $edifici</h4>";
        print "<table class=\"table table-bordered table-striped table-responsive\">\n";
        print "<tr>\n";
        print "<th>Temporada</th>";
        foreach($arrayTemporadas as $temp){
            print '<td>'.$temp.'</td>';
        }
        
        print "</tr>";
        
        // Obtenemos de datos en forma de array asociativo
        
        print '<tr>';
        print '<th>Totals en '.$medida.'</th>';
        foreach ($arrayTotalesEdificio as $val) {
            
            $val = number_format($val,2,',','.');
            print "<td> $val </td>\n";
        }
        print '</tr>';
        print "</table>\n";
    }
    
    public function showTableTotalsAnys($temporadas,$consumo){
     
        $arrayTemporadas = array();
        $arrayTemporadas = explode(" ", $temporadas);
        //             echo "Array temporadas"."\n";
        //             var_dump($arrayTemporadas);
        
        $arrayConsumosEdificio  = Array();
        $arraynomenclatura      = Array();
        $sumaTotales            = Array();
        $arrayTotales           = Array();        
        $pre_sql = "";
        $pre_group = "";        
        $medida  = "";
        
        $pre_sql = "SELECT temporada,SUM(num_botellas)
                        FROM pspv_schema.";
        $pre_group  = " GROUP BY 1;";
        $arraynomenclatura      = ["GRE","XAL","LLE"];
        $medida = "ampolles";
        // Obtenemos todos consumos de los años seleccinados por meses
        foreach ($arrayTemporadas as $temp){
            //                 echo "Temporadas dentro de bucle\n";
            //                 echo $temp."\n";
            foreach ($arraynomenclatura as $nomenclatura){
                //                     echo $nomenclatura;
                $index = 1;
                $sql = "";                
                $sql."".$index = $pre_sql;
                $sql."".$index .= $this->table_name;
                $sql."".$index.= " WHERE temporada = ";
                $sql."".$index .= $temp;
                $sql."".$index .= " AND id_edifici LIKE ";
                $sql."".$index .= "'$nomenclatura'";
                $sql."".$index .= $pre_group;
                //                  Mostrar $arrayTotalesEdificioConsulta
                //                     echo "\n";
                //                     echo $sql."".$index."\n";
                //                     echo "\n";
                try{
                    $result = pg_query($sql."".$index);
                    
                } catch (Exception $e){
                    $msg = "[ERR] Error en función totalsConsumXEdificis. MSG: ".pg_last_error($this->connection)." Fecha: ".$GLOBALS['fecha']."\n";
                    errorLog($msg);
                }
                
                $arrayConsumosEdificio[] = $result;
                
                $index++;
            }
            
            foreach ($arrayConsumosEdificio as $ConsumosEdidifcios){
                while($row = pg_fetch_assoc($ConsumosEdidifcios)){
                    if ($temp == $row['temporada']) {
                        $sumaTotales[$temp] += intval($row['sum']);
                    }
                }
                
            }
            array_push($arrayTotales, $sumaTotales[$temp]);
        }
        
        
        
        print "<h4>Consum $consumo Totales</h4>";
        print "<table class=\"table table-bordered table-striped table-responsive\">\n";
        print "<tr>\n";
        print "<th>Temporada</th>";
        foreach($arrayTemporadas as $temp){
            print '<td>'.$temp.'</td>';
        }
        
        print "</tr>";
        
        // Obtenemos de datos en forma de array asociativo
        
        print '<tr>';
        print '<th>'.$medida.'</th>';
        foreach ($arrayTotales as $val) {
            
            $val = number_format($val,2,',','.');
            print "<td> $val </td>\n";
            
        }
        print '</tr>';
        print "</table>\n";
        
    }
    
    public function showTableTotalsCostxanys($temporadas,$consumo){
        $arrayTemporadas = array();
        $arrayTemporadas = explode(" ", $temporadas);
        //             echo "Array temporadas"."\n";
        //             var_dump($arrayTemporadas);        
        $arrayConsumosEdificio  = Array();
        $arraynomenclatura      = Array();
        $sumaTotales            = Array();
        $arrayTotales           = Array();        
        $pre_sql = "";
        $pre_group = "";        
        $medida  = "";
        
        $pre_sql = "SELECT temporada,mes,SUM(num_botellas)*p.cantitat
                        FROM pspv_schema.";
        $pre_relation = " o, pspv_schema.conversio_preus p";
        $pre_where = " WHERE o.id_preu = p.id";
        $pre_group = "  GROUP BY temporada,mes,p.cantitat
                            ORDER BY mes='Decembre', mes='Novembre',mes='Octubre', mes='Septembre', mes='Agost', mes='Juliol', mes='Juny',mes='Maig',mes='Abril',mes='Març',mes='Febrer',mes='Gener';";
        $arraynomenclatura      = ["GRE","XAL","LLE"];
        $medida = "€";
        
        // Obtenemos todos consumos de los años seleccinados por meses
        foreach ($arrayTemporadas as $temp){
            //                 echo "Temporadas dentro de bucle\n";
            //                 echo $temp."\n";
            foreach ($arraynomenclatura as $nomenclatura){
                //                     echo $nomenclatura;
                $index = 1;
                $sql = "";                
                $sql."".$index = $pre_sql;
                $sql."".$index .= $this->table_name;
                $sql."".$index .= $pre_relation;
                $sql."".$index .= $pre_where;
                $sql."".$index .= " AND temporada = ";
                $sql."".$index .= $temp;
                $sql."".$index .= " AND id_edifici LIKE ";
                $sql."".$index .= "'$nomenclatura'";
                $sql."".$index .= $pre_group;
                //                  Mostrar $arrayTotalesEdificioConsulta
                //                     echo "\n";
                //                     echo $sql."".$index."\n";
                //                     echo "\n";
                
                try{
                    $result = pg_query($sql."".$index);
                    
                } catch (Exception $e){
                    $msg = "[ERR] Error en función totalsConsumXEdificis. MSG: ".pg_last_error($this->connection)." Fecha: ".$GLOBALS['fecha']."\n";
                    errorLog($msg);
                    
                }
                
                $arrayConsumosEdificio[] = $result;
                
                $index++;
            }
            
            foreach ($arrayConsumosEdificio as $ConsumosEdidifcios){
                while($row = pg_fetch_assoc($ConsumosEdidifcios)){
                    if ($temp == $row['temporada']) {
                        $sumaTotales[$temp] += $row['?column?'];
                    }
                }
                
            }
            array_push($arrayTotales, $sumaTotales[$temp]);
        }
        
        
        
        print "<h4>Cost $consumo Totals</h4>";
        print "<table class=\"table table-bordered table-striped table-responsive\">\n";
        print "<tr>\n";
        print "<th>Temporada</th>";
        foreach($arrayTemporadas as $temp){
            print '<td>'.$temp.'</td>';
        }
        
        print "</tr>";
        
        // Obtenemos de datos en forma de array asociativo
        
        print '<tr>';
        print '<th>Cost Anual</th>';
        foreach ($arrayTotales as $val) {
            
            
            $val = number_format($val,2,',','.');
            print "<td> $val </td>\n";
            
        }
        print '</tr>';
        print "</table>\n";
    }

    public function dataConsumToArrayGraph($edifici,$temporada,$consumo){
        
     	error_reporting(0);
    	
        $pre_sql = "";
        $pre_group = "";
        $pre_where = "";
        
        $edi_table = traductorEdificis($edifici);
        $pre_sql = "SELECT temporada,mes,SUM(num_botellas)
                    FROM pspv_schema.";
        $pre_where = " WHERE ";
        $post_where1 = " temporada = ";
        $post_where2 = " AND id_edifici LIKE ";
        $pre_group = "  GROUP BY 1,2,3
                        ORDER BY mes='Decembre', mes='Novembre',mes='Octubre', mes='Setembre', mes='Agost', mes='Juliol', mes='Juny',mes='Maig',mes='Abril',mes='Març',mes='Febrer',mes='Gener';";
        
        $sql = "";
        $sql .= $pre_sql;
        $sql .= $this->table_name;
        $sql .= $pre_where;
        $sql .= $post_where1;
        $sql .= $temporada;
        $sql .= $post_where2;
        $sql .= "'$edi_table'";
	    $sql .= $pre_group;


                
        try{
            $result = pg_query($sql);
        } catch (Exception $e){
            $msg = "[ERR] Error en función arrayGraphsConsumos_2. MSG: ". pg_last_error($this->connection)." Fecha: ".$GLOBALS['date']."\n";
            errorLog($msg);
        }
        
        if (!$result) {
            echo "Error en la consulta del ".$temporada." ".$consumo.".\n";
            exit;
        }
        
        empty(pg_fetch_result($result,11,2)) ? $decembre = 0 : $decembre = pg_fetch_result($result,11,2);
        empty(pg_fetch_result($result,10,2)) ? $novembre = 0 : $novembre = pg_fetch_result($result,10,2);
        empty(pg_fetch_result($result,9,2)) ? $octubre = 0 : $octubre = pg_fetch_result($result,9,2);
        empty(pg_fetch_result($result,8,2)) ? $septembre = 0 : $septembre = pg_fetch_result($result,8,2);
        empty(pg_fetch_result($result,7,2)) ? $agost = 0 : $agost = pg_fetch_result($result,7,2);
        empty(pg_fetch_result($result,6,2)) ? $juliol = 0 : $juliol = pg_fetch_result($result,6,2);
        empty(pg_fetch_result($result,5,2)) ? $juny = 0 : $juny = pg_fetch_result($result,5,2);
        empty(pg_fetch_result($result,4,2)) ? $maig = 0 : $maig = pg_fetch_result($result,4,2);
        empty(pg_fetch_result($result,3,2)) ? $abril = 0 : $abril = pg_fetch_result($result,3,2);
        empty(pg_fetch_result($result,2,2)) ? $marzo = 0 : $marzo = pg_fetch_result($result,2,2);
        empty(pg_fetch_result($result,1,2)) ? $febrer = 0 : $febrer = pg_fetch_result($result,1,2);
        empty(pg_fetch_result($result,0,2)) ? $gener = 0 : $gener = pg_fetch_result($result,0,2);

        $arr[$temporada] = array($gener,$febrer,$marzo,$abril,$maig,$juny,$juliol,$agost,$septembre,$octubre,$novembre,$decembre);
        return $arr;
        
    }

    public function dataCostToArrayGraph($edifici,$temporada,$consumo){
            	
    	error_reporting(0);
        $pre_sql = "";
        $pre_group = "";
        $pre_where = "";
        
        $edi_table = traductorEdificis($edifici);
        $pre_sql = "SELECT temporada,mes,SUM(num_botellas)*p.cantitat
                    FROM pspv_schema.";
        $pre_relation = " o, pspv_schema.conversio_preus p ";
        $pre_where = " WHERE  o.id_preu = p.id";
        $post_where1 = " AND temporada = ";
        $post_where2 = " AND id_edifici LIKE ";
        $pre_group = "  GROUP BY temporada,mes,p.cantitat
                        ORDER BY mes='Decembre', mes='Novembre',mes='Octubre', mes='Septembre', mes='Agost', mes='Juliol', mes='Juny',mes='Maig',mes='Abril',mes='Març',mes='Febrer',mes='Gener';";
        
        $sql = "";
        $sql .= $pre_sql;
        $sql .= $this->table_name;
        $sql .= $pre_relation;
        $sql .= $pre_where;
        $sql .= $post_where1;
        $sql .= $temporada;
        $sql .= $post_where2;
        $sql .= "'$edi_table'";
        $sql .= $pre_group;
        
        try{
            $result = pg_query($sql);
        } catch (Exception $e){
            $msg = "[ERR] Error en función arrayGraphsConsumos_2. MSG: ". pg_last_error($this->connection)." Fecha: ".$GLOBALS['date']."\n";
            errorLog($msg);
        }
        
        if (!$result) {
            echo "Error en la consulta del ".$temporada." ".$consumo.".\n";
            exit;
        }
        
        // Asignación de los PMP del Aigua del 2014
        empty(pg_fetch_result($result,11,2)) ? $decembre = 0 : $decembre = pg_fetch_result($result,11,2);
        empty(pg_fetch_result($result,10,2)) ? $novembre = 0 : $novembre = pg_fetch_result($result,10,2);
        empty(pg_fetch_result($result,9,2)) ? $octubre = 0 : $octubre = pg_fetch_result($result,9,2);
        empty(pg_fetch_result($result,8,2)) ? $septembre = 0 : $septembre = pg_fetch_result($result,8,2);
        empty(pg_fetch_result($result,7,2)) ? $agost = 0 : $agost = pg_fetch_result($result,7,2);
        empty(pg_fetch_result($result,6,2)) ? $juliol = 0 : $juliol = pg_fetch_result($result,6,2);
        empty(pg_fetch_result($result,5,2)) ? $juny = 0 : $juny = pg_fetch_result($result,5,2);
        empty(pg_fetch_result($result,4,2)) ? $maig = 0 : $maig = pg_fetch_result($result,4,2);
        empty(pg_fetch_result($result,3,2)) ? $abril = 0 : $abril = pg_fetch_result($result,3,2);
        empty(pg_fetch_result($result,2,2)) ? $marzo = 0 : $marzo = pg_fetch_result($result,2,2);
        empty(pg_fetch_result($result,1,2)) ? $febrer = 0 : $febrer = pg_fetch_result($result,1,2);
        empty(pg_fetch_result($result,0,2)) ? $gener = 0 : $gener = pg_fetch_result($result,0,2);
        
        
        
        $arr[$temporada] = array($gener,$febrer,$marzo,$abril,$maig,$juny,$juliol,$agost,$septembre,$octubre,$novembre,$decembre);
        return $arr;
    }
    
    public function generateCSVFile($tipo){
        
        $sql = "SELECT * FROM pspv_schema.".$this->table_name.";";
        
        $result = pg_query($sql);
        if(empty($result)){
            die('Error con la conexión DB: '.pg_last_error($this->connection));
        }
        //Iniciando fichero
        try{
            //Creamos Path hacia el fichero a crear según el tipo de consumo
            $pathfile = createCSVConsum($tipo);
            $fichero = fopen($pathfile,"w");
            
        }catch(Exception $e){
            $msg = "[ERR] Fallo al crear el fichero con los datos actuales:  ".$e;
            errorLog($msg);
        }
        echo '<h6>Processant informació: '.$tipo.'</h6>';
        //Rellenando fichero con los datos actuales
        $cabecera = "Mes,Temporada,id_edifici,planta_edifici,id_preu,num_botellas"."\n";
        fwrite($fichero,$cabecera);
        
        while($row = pg_fetch_assoc($result)){
            $string = 	$row['mes'].",".$row['temporada'].",".$row['id_edifici'].",".$row['planta_edifici'].",".$row['id_preu'].",".$row['num_botellas']."\n";
            fwrite($fichero,$string);
        }
        
        echo '<h6>Fitxer Terminat: '.$tipo.'</h6>';
        fclose($fichero);
        return $pathfile;
    }
    
    public function comprobateLengthData($newfile){
        
        echo '<h6>Cromprobant contigut del fitxer: file_'.$this->table_name.'.csv</h6>';
        $oldpath    = "/var/www/ConsumsPSPV/CSV/file_".$this->table_name.".csv";
        
        $oldcmd     = 'wc -l '.$oldpath.' | awk -F" " {\'print $1\'}';
        $newcmd     = 'wc -l '.$newfile.' | awk -F" " {\'print $1\'}';
        
        $oldLines   = shell_exec($oldcmd);
        $newLines   = shell_exec($newcmd);
        
        $oldnumber  = intval($oldLines);
        $newnumber  = intval($newLines);
        
        if ($oldnumber == $newnumber){
            $msg = "[ERR] Error el fichero subido contiene la misma cantidad de datos!! Fecha: ".$GLOBALS['fecha']."\n";
            errorLog($msg);
            die($msg);
        }elseif ($oldnumber > $newnumber){
            $msg = "[ERR] Error el fichero subido contiene menos datos que los que hay guardados en la BD Fecha: ".$GLOBALS['fecha']."\n";
            errorLog($msg);
            die($msg);
        }
    }
    
    public function createBackupTable(){
        echo '<p>Procedemos a la copia de la Tabla: '.$this->table_name.'</p>'."\n";
        $cmd = 'PGPASSWORD="R458V90Rcxa3389563" pg_dump --host localhost --port 5432 --username rom_pspv --data-only --format plain --verbose --file /var/www/ConsumsPSPV/CSV/oldData/copia_'.$this->table_name.'.sql --table pspv_schema.'.$this->table_name.' pspv_db 2>&1';
        
        $salida = system($cmd,$retval);
        
        if ($retval != 0){
            $msg = "[ERR] Fallo al crear el backup de la tabla: ".$this->table_name." Fecha: " .$GLOBALS['date']."\n";
            errorLog($msg);
            die($msg);
        }
        
        //truncate system variable PGPASSWORD for security.
        $cmd = 'PGPASSWORD=""';
        system($cmd);
    }
    
    public function truncateTable(){
        $tabla = 'pspv_schema.'.$this->table_name;
        $query = "TRUNCATE TABLE ".$tabla.";";
        $res = pg_query($query);
        if(!$res){
            $msg = "[ERR] Fallo al borrar los datos: ".pg_last_error($this->connection).". Fecha: ".$GLOBALS['date']."\n";
            errorLog($msg);
            echo '<p id="Error">'.$msg.'</p>'."\n";
            echo '<p id="Error">Error al borrar les dades antigues. Avisa al administrador de l\' aplicació</p>'."\n";
            echo '<p id="Error">info@romsolutions.es</p>'."\n";
        }
    }
    
    public function recoveryOldData(){
        $cmd = 'PGPASSWORD="R458V90Rcxa3389563" psql --host localhost --port 5432 --username rom_pspv pspv_db pspv_schema.'.$this->table_name.' < /var/www/ConsumsPSPV/CSV/oldData/copia_'.$this->table_name.'.sql';
        $salida = system($cmd,$retval);
        if ($retval != 0){
            $msg = "[ERR] Fallo al recuperar los datos antiguos: ".$this->table_name." Fecha: ".$GLOBALS['date']."\n";
            errorLog($msg);
            echo '<p id="Error">'.$msg.'</p>'."\n";
            echo '<p id="Error">Error en la inserció de dades. Avisa al administrador de l\' aplicació</p>'."\n";
            echo '<p id="Error">info@romsolutions.es</p>'."\n";
            die($msg);
            
        }
    }
    
    public function insertData($csv){
        foreach ($csv as $key => $val){
            
            $temporada      = intval($val['Temporada']);
            $mes            = $val['Mes'];
            $id_edifici     = $val['id_edifici'];
            $planta_edifici = intval($val['planta_edifici']);
            $id_preu        = intval($val['id_preu']);
            $num_ampolles   = intval($val['num_botellas']);
            
            $cmd = 'INSERT INTO pspv_schema.'.$this->table_name.'(mes,temporada,id_edifici,planta_edifici,id_preu,num_botellas) ';
            $cmd .= 'VALUES (\''.$mes.'\','.$temporada.',\''.$id_edifici.'\','.$planta_edifici.','.$id_preu.','.$num_ampolles.');';
            
            $res = pg_query($cmd);
            
            if(!$res){
                $msg = "[ERR] Fallo: los datos de  no fueron insertados: ". pg_last_error($this->connection)." Fecha: ".$GLOBALS['date']."\n";
                errorLog($msg);
                
                echo '<p id="Error">Ha habido un error en la súbida de datos</p>'."\n";
                echo '<p id="Error">'.$msg.'</p>'."\n";
                echo '<p id="Error">Procedemos a la recuperación de datos antiguos</p>'."\n";
                //En Caso de que falle la inserción introducimos los datos antiguos.
                //Si todo va bien, los datos nuevos pasan a ser los antiguos.
                $this->recoveryOldData();
                die($msg);
                
                
            }
        }
        echo '<p id="OK">Dades insertades correctament'."\n";
        pg_close($this->connection);
        
    }
    
    public function arrayTotalsConsum($temp,$edifici){
        $sql = "    SELECT temporada,mes,SUM(num_botellas)
                        FROM pspv_schema.".$this->table_name."
                        WHERE temporada = ". $temp ."
                        AND id_edifici LIKE '$edifici'
                        GROUP BY 1,2
                        ORDER BY mes='Gener',mes='Febrer',mes='Març',mes='Abril',mes='Maig',mes='Juny',mes='Juliol',mes='Agost',mes='Septembre',mes='Octubre',mes='Novembre',mes='Decembre';";
        
        
        try{
            $result = pg_query($sql);
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
 
    public function arrayTotalsPMP($temp,$edifici){
        
        $sql = "    SELECT mes,SUM(num_botellas)*p.cantitat
                    FROM pspv_schema.".$this->table_name." o, pspv_schema.conversio_preus p
                    WHERE  o.id_preu = p.id
                    AND temporada = ".$temp."
                    AND id_edifici LIKE '$edifici'
                    GROUP BY temporada,mes,p.cantitat
                    ORDER BY mes='Decembre', mes='Novembre',mes='Octubre', mes='Septembre', mes='Agost', mes='Juliol', mes='Juny',mes='Maig',mes='Abril',mes='Març',mes='Febrer',mes='Gener';";
        
        
        try{
            $result = pg_query($sql);
        } catch (Exception $e){
            $msg = "[ERR] Error en función arrayTotalsConsumoOxigenAmpolles. MSG: ".pg_last_error($this->connection)."\n";
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
    
    public function insertOneData($mes,$any,$edifici,$planta,$ampolles){
    	$temporada      = intval($any);
    	$id_edifici 	= traductorEdificis($edifici);
    	$planta_edifici = intval($planta);
    	$id_preu        = 4;
    	$num_ampolles   = intval($ampolles);
    	
    	// $cmd = 'INSERT INTO pspv_schema.'.$this->table_name.'(mes,temporada,id_edifici,planta_edifici,id_preu,num_botellas) ';
    	// $cmd .= 'VALUES (\''.$mes.'\','.$temporada.',\''.$id_edifici.'\','.$planta.','.$id_preu.','.$num_ampolles.');';
    	
    	// $res = pg_query($cmd);
        $cmd = 'INSERT INTO pspv_schema.'.$this->table_name.'(mes,temporada,id_edifici,planta_edifici,id_preu,num_botellas) ';
        $cmd .= 'VALUES ($1, $2, $3, $4, $5, $6)';
        $res = pg_query_params($this->connection, $cmd, array($mes, $temporada, $id_edifici, $planta, $id_preu, $num_ampolles));




    	
    	if(!$res){
            
    		$msg = "[ERR] Fallo: los datos de  no fueron insertados: ". pg_last_error($this->connection)." Fecha: ".$GLOBALS['date']."\n";
    		errorLog($msg);
    		
    		echo '<p id="Error">Ha habido un error en la súbida de datos</p>'."\n";
    		echo '<p id="Error">'.$msg.'</p>'."\n";
    		echo '<p id="Error">Procedemos a la recuperación de datos antiguos</p>'."\n";
    		//En Caso de que falle la inserción introducimos los datos antiguos.
    		//Si todo va bien, los datos nuevos pasan a ser los antiguos.
    		$this->recoveryOldData();
    		die($msg);
    		
    		
    	}else{
    		echo '<h5>Datos insertados correctamente</h5>';
    	}
    }
    
    public function updateData($id,$mes,$any,$edifici,$planta,$ampolles){
    	$temporada      = intval($any);
    	$id_edifici 	= $edifici;
    	$planta_edifici = intval($planta);
    	$id_preu        = 4;
    	$num_ampolles   = intval($ampolles);
    	
    	$cmd = 'UPDATE pspv_schema.'.$this->table_name.' SET 	mes = \''.$mes.'\', temporada = '.$temporada.',
																id_edifici = \''.$id_edifici.'\', planta_edifici = '.$planta_edifici.',
																id_preu = '.$id_preu.', num_botellas = '.$num_ampolles.'
				WHERE id = \''.$id.'\';';
    	$res = pg_query($cmd);
    	
    	if(!$res){
    		$msg = "[ERR] Fallo: los datos de  no fueron insertados: ". pg_last_error($this->connection)." Fecha: ".$GLOBALS['date']."\n";
    		errorLog($msg);
    		
    		echo '<p id="Error">Ha habido un error en la súbida de datos</p>'."\n";
    		echo '<p id="Error">'.$msg.'</p>'."\n";
    		echo '<p id="Error">Procedemos a la recuperación de datos antiguos</p>'."\n";
    		//En Caso de que falle la inserción introducimos los datos antiguos.
    		//Si todo va bien, los datos nuevos pasan a ser los antiguos.
    		//$this->recoveryOldData();
    		die($msg);
    		
    		
    	}else{
    		echo '<h5>Datos insertados correctamente</h5>';
    	}
    }
    
    public function updateShowForms($id,$mes,$any,$edifici,$planta,$ampolles){
    	echo '
			<script type="txt/javascript">
				$(document).ready(function (){
 					$("#btnOxiflow").on("click",function(){
 						var mes = $("#selmes").val();
  						var any = $("#selany").val();
 						var edifici = $("#edifici").val();
  						var ampolles = $("#ampolles").val();
						var planta = $("#planta").val();
 						var tipo = "Oxigen Ampolles";
						var id = '.$id.';

    			
 						$.ajax({
								   type: "POST",
								   data: {id:id,mes:mes,any:any,edifici:edifici,ampolles:ampolles,planta:planta,tipo:tipo},
      						       url: "../Ajax_Reception_PHP/updateData.php",
      						       success: function(msg){
      						           $("#responseInsert").html(msg);
      						       }
      					});
 					});
 				});
    			
			</script>
    			
			<div  class="col-md-12" id="contenedorOxiflow">
				<h3 id="cabecera-formulario">Actualització Oxiflow Ampolles '.$edifici.'</h3>
					<form role="form"  name="form-oxiflw" method="POST">
					    <div class="col-md-12 col">
					        <div class="form-group">
								<div class="col-md-8 col">
									<div class="col-md-4 col">
										<h4>Mes</h4>
				   						<input class="form-control" id="selmes" type="text" name="MEs" value="'.$mes.'" required="required">

									</div>
									<div class="col-md-4 col">
										<h4>Any</h4>
											<input class="form-control" id="selany" type="number" name="anyo" min="2022" max="2030" value="'.$any.'" required="required">
									</div>
								</div>
								<div class="col-md-10 col">
									<div class="col-md-5 col">
					   					<h4>Edifici</h4>
				   						<input class="form-control" id="edifici" type="text" name="Edifici" value="'.$edifici.'" required="required">
									</div>
									<div class="col-md-5 col">
				   						<h4>Planta</h4>
				   							<input class="form-control" id="planta" type="number" name="plantao" min="1" max="5" value="'.$planta.'">
									</div>
								</div>
								<div class="col-md-10 col">
									<div class="col-md-5 col">
				   						<h4>Ampolles</h4>
				   						<input class="form-control" id="ampolles" type="number" name="consumo" required="required" value="'.$ampolles.'">
									</div>
									<br>
									<br>
									<br>
									<div class="col-md-5 col">
										<input  class="form-control btn btn-primary" id="btnOxiflow" name="submit" value="Enviar dades" style="margin:2%;">
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
    			
			<div class="col-md-8 col" id="responseInsert"></div>';
    }
    
    public function showForm(){
    	echo '
			<script type="txt/javascript">
				$(document).ready(function (){
 					$("#btnOxiflow").on("click",function(){
 						var mes = $("#selmes").val();
  						var any = $("#selany").val();
 						var edifici = $("#edifici").val();
  						var ampolles = $("#ampolles").val();
						var planta = $("#planta").val();
 						var tipo = "Oxiflow";

 						$.ajax({
								   type: "POST",
								   data: {mes:mes,any:any,edifici:edifici,ampolles:ampolles,planta:planta,tipo:tipo},
      						       url: "../Ajax_Reception_PHP/insertData.php",								      						      
      						       success: function(msg){
      						           $("#responseInsert").html(msg);
      						       }
      					});
 					});
 				});
          							 
			</script>

			<div  class="col-md-12" id="contenedorOxiflow">
				<h3 id="cabecera-formulario">Inserció de dades en el formulario Oxiflow Ampolles</h3>
					<form role="form"  name="form-oxiflw" method="POST">			
					    <div class="col-md-12 col">
					        <div class="form-group">
								<div class="col-md-8 col">
									<div class="col-md-4 col">
										<h4>Mes</h4>
						   					<select class="form-control" id="selmes" name="mesoso" required="required" >
											    <option>Gener</option>
											    <option>Febrer</option>
											    <option>Març</option>
											    <option>Abril</option>
											    <option>Maig</option>
											    <option>Juny</option>
											    <option>Juliol</option>
											    <option>Agost</option>
											    <option>Septembre</option>
											    <option>Octubre</option>
											    <option>Novembre</option>
											    <option>Decembre</option>
										  	</select>
									</div>
									<div class="col-md-4 col">
										<h4>Any</h4>
											<input class="form-control" id="selany" type="number" name="anyo" min="2022" max="2030" required="required">
									</div>
								</div>
								<div class="col-md-10 col">
									<div class="col-md-5 col">
					   					<h4>Selecció d´ edifici</h4>
					   						<select class="form-control" id="edifici" name="edificio" required="required">
					   							<option>Gregal</option>
					   							<option>Xaloc</option>
					   							<option>Llevant</option>
					   						</select>
									</div>
									<div class="col-md-5 col">
				   						<h4>Selecció de planta</h4>
				   							<input class="form-control" id="planta" type="number" name="plantao" min="1" max="5">
									</div>
								</div>
								<div class="col-md-10 col">
									<div class="col-md-5 col">
				   						<h4>Nombre d´ ampolles consumides</h4>
				   							<input class="form-control" id="ampolles" type="number" name="consumo" required="required">
									</div>
									<br>
									<br>
									<br>
									<div class="col-md-5 col">
										<input  class="form-control btn btn-primary" id="btnOxiflow" name="submit" value="Enviar dades" style="margin:2%;">
									</div>										
								</div>
							</div>														
						</div>
					</form>
				</div>
		
			<div class="col-md-8 col" id="responseInsert"></div>';
    	$this->last_insert();
    }
}

?>