<?php

##########################
#@autor: Raúl Olmedo
#@date: 20-03-20
#@file: gasNatural.php
#@function: This script contain Class GasNatural.
###########################

include '../config/core.php';
include '../config/globals.php';

class GasNatural{
    
    private $connection;
    private $table_name = "consumsgasnatural";
    
    //Propierties
    public $mes;
    public $temporada;
    public $id_edifici;
    public $conversio;
    public $id_preu;
    public $lectura_anterior;
    public $lectura_actual;
    
    //Constructor
    public function __construct($db){
        $this->connection = $db;
    }
    
    public function printHeaderTable(){
    	echo ' 
		<div class="col-md-12 col container" style="border: 1px solid #920000">
        	<table id="tabla_ord" class="stripe display cell-border compact order-column" style="width:60%">
        		<thead>
        			<tr>
        				<th>Id</th>
        				<th>Temporada</th>
        				<th>Mes</th>
        				<th>Edifici</th>
        				<th>Lectura Anterior</th>
        				<th>Lectura Actual</th>        				
        			</tr>
        		</thead>        		
        	</table>
        </div>';    
    }
    
    public function lastInsertDT_TRA(){
    	$data = array();    	
    	$sql = " SELECT id, temporada, mes, id_edifici, lectura_anterior, lectura_actual
                                    FROM pspv_schema.".$this->table_name."
                                    WHERE id_edifici = 'TRA'
                                    GROUP BY 1,2,3,4,5,6
                                    ORDER BY 1 DESC
                                    LIMIT 6
                    ";
    	
    	$result = pg_query($sql);
    	while ($row = pg_fetch_assoc($result)) {
    		$arrayEdifici = array(
    	    	"Id" => $row['id'],
    	    	"Temporada" => $row['temporada'],
    	    	"Mes" => $row['mes'],
    	    	"Edifici" => $row['id_edifici'],
    	    	"LecturaAnterior" => $row['lectura_anterior'],
    	    	"LecturaActual" => $row['lectura_actual']
    		);
    		array_push($data,$arrayEdifici);
    	}
    	$arrayGas["GasNatural_TRA"] = "";
    	$arrayGas["GasNatural_TRA"] = $data;
		echo json_encode($arrayGas,JSON_PRETTY_PRINT);
    	
    	
    }
    public function lastInsertDT_GRE(){
    	$data = array();
    	$sql = " SELECT id, temporada, mes, id_edifici, lectura_anterior, lectura_actual
                                    FROM pspv_schema.".$this->table_name."
                                    WHERE id_edifici = 'GRE'
                                    GROUP BY 1,2,3,4,5,6
                                    ORDER BY 1 DESC
                                    LIMIT 6
                    ";
    	
    	$result = pg_query($sql);
    	while ($row = pg_fetch_assoc($result)) {
    		$arrayEdifici = array(
    				"Id" => $row['id'],
    				"Temporada" => $row['temporada'],
    				"Mes" => $row['mes'],
    				"Edifici" => $row['id_edifici'],
    				"LecturaAnterior" => $row['lectura_anterior'],
    				"LecturaActual" => $row['lectura_actual']
    		);
    		array_push($data,$arrayEdifici);
    	}
    	$arrayGas["GasNatural_GRE"] = "";
    	$arrayGas["GasNatural_GRE"] = $data;
    	echo json_encode($arrayGas,JSON_PRETTY_PRINT);
    	
    	
    }
    public function lastInsertDT_XAL(){
    	$data = array();
    	$sql = " SELECT id, temporada, mes, id_edifici, lectura_anterior, lectura_actual
                                    FROM pspv_schema.".$this->table_name."
                                    WHERE id_edifici = 'XAL'
                                    GROUP BY 1,2,3,4,5,6
                                    ORDER BY 1 DESC
                                    LIMIT 6
                    ";
    	
    	$result = pg_query($sql);
    	while ($row = pg_fetch_assoc($result)) {
    		$arrayEdifici = array(
    				"Id" => $row['id'],
    				"Temporada" => $row['temporada'],
    				"Mes" => $row['mes'],
    				"Edifici" => $row['id_edifici'],
    				"LecturaAnterior" => $row['lectura_anterior'],
    				"LecturaActual" => $row['lectura_actual']
    		);
    		array_push($data,$arrayEdifici);
    	}
    	$arrayGas["GasNatural_XAL"] = "";
    	$arrayGas["GasNatural_XAL"] = $data;
    	echo json_encode($arrayGas,JSON_PRETTY_PRINT);    	   
    }
    public function lastInsertDT_PUI(){
    	$data = array();
    	$sql = " SELECT id, temporada, mes, id_edifici, lectura_anterior, lectura_actual
                                    FROM pspv_schema.".$this->table_name."
                                    WHERE id_edifici = 'PUI'
                                    GROUP BY 1,2,3,4,5,6
                                    ORDER BY 1 DESC
                                    LIMIT 6
                    ";
    	
    	$result = pg_query($sql);
    	while ($row = pg_fetch_assoc($result)) {
    		$arrayEdifici = array(
    				"Id" => $row['id'],
    				"Temporada" => $row['temporada'],
    				"Mes" => $row['mes'],
    				"Edifici" => $row['id_edifici'],
    				"LecturaAnterior" => $row['lectura_anterior'],
    				"LecturaActual" => $row['lectura_actual']
    		);
    		array_push($data,$arrayEdifici);
    	}
    	$arrayGas["GasNatural_PUI"] = "";
    	$arrayGas["GasNatural_PUI"] = $data;
    	echo json_encode($arrayGas,JSON_PRETTY_PRINT);    	    
    }
    public function lastInsertDT_SUP(){
    	$data = array();
    	$sql = " SELECT id, temporada, mes, id_edifici, lectura_anterior, lectura_actual
                                    FROM pspv_schema.".$this->table_name."
                                    WHERE id_edifici = 'SUP'
                                    GROUP BY 1,2,3,4,5,6
                                    ORDER BY 1 DESC
                                    LIMIT 6
                    ";
    	
    	$result = pg_query($sql);
    	while ($row = pg_fetch_assoc($result)) {
    		$arrayEdifici = array(
    				"Id" => $row['id'],
    				"Temporada" => $row['temporada'],
    				"Mes" => $row['mes'],
    				"Edifici" => $row['id_edifici'],
    				"LecturaAnterior" => $row['lectura_anterior'],
    				"LecturaActual" => $row['lectura_actual']
    		);
    		array_push($data,$arrayEdifici);
    	}
    	$arrayGas["GasNatural_SUP"] = "";
    	$arrayGas["GasNatural_SUP"] = $data;
    	echo json_encode($arrayGas,JSON_PRETTY_PRINT);    	   
    }
    
    //Obtain de last three inserts and prepare data for Datatables.
    public function lastInsertDT(){
    	$consumo = "Gas Natural";
    	$arrayEdificis = returnArrayEdificis($consumo);
    	$data = array();
    	foreach ($arrayEdificis as $edifici) {
    		$sql = " SELECT id, temporada, mes, id_edifici, lectura_anterior, lectura_actual
                                    FROM pspv_schema.".$this->table_name."
                                    WHERE id_edifici = '$edifici'
                                    GROUP BY 1,2,3,4,5,6
                                    ORDER BY 1 DESC
                                    LIMIT 6
                    ";
    		
    		$result = pg_query($sql);    		    	
//     		while ($row = pg_fetch_assoc($result)) {    			
//     			$arrayEdifici = array(
//     				"Id" => $row['id'], 
//     				"Temporada" => $row['temporada'],
//     				"Mes" => $row['mes'],
//     				"Edifici" => $row['id_edifici'],
//     				"Lectura Anterior" => $row['lectura_anterior'],
//     				"Lectura Actual" => $row['lectura_actual']    					
//     			);    			
//     		} // fin while
//     		//$arrayData[$edifici] = $arrayEdifici;
    		while ($row = pg_fetch_assoc($result)) {
    			$arrayEdifici = array(
    					 $row['id'],
    					 $row['temporada'],
    					 $row['mes'],
    					 $row['id_edifici'],
    					 $row['lectura_anterior'],
    					 $row['lectura_actual']
    			);
    		} // fin while
    		array_push($data,$arrayEdifici);
    		
    	}
    	 		
    	
    	
     		$arrayGas["GasNatural"] = "";
     		$arrayGas["GasNatural"] = $data;
    	
    		echo json_encode($arrayGas,JSON_PRETTY_PRINT);
    	
    }
    
    //Obtain the last 3 inserts
    public function lastinsert(){
        $consumo = "Gas Natural";
        $arrayEdificis = returnArrayEdificis($consumo);
        foreach ($arrayEdificis as $edifici) {
            $sql = " SELECT id, temporada, mes, id_edifici, lectura_anterior, lectura_actual
                                    FROM pspv_schema.".$this->table_name."
                                    WHERE id_edifici = '$edifici'
                                    GROUP BY 1,2,3,4,5,6
                                    ORDER BY 1 DESC
                                    LIMIT 3
                    ";
            
            $result = pg_query($sql);
            print "<div class=\"col-md-8\">\n";
            print "<h4>Cosum  Gas Natural ".$edifici." / Ultimes insercions</h4><br>";
            print "<table class=\"table table-bordered table-striped\">\n";
            // Obtenemos los nombres de los campos
            
            print "<tr>\n";
            
            print "<th>Id</th>\n";
            print "<th>Temporada</th>\n";
            print "<th>mes</th>\n";
            print "<th>Edifici</th>\n";
            print "<th>Lectura Anterior</th>\n";
            print "<th>Lectura Actual</th>\n";
            
            print "</tr>\n\n";
            
            // Obtenemos de datos en forma de array asociativo
            
            while ($row = pg_fetch_assoc($result)) {
                print "<tr>\n";
                // Examinamos cada campo
                
                foreach ($row as $col => $val) {
                    $valor = gettype($val);
                    if ($valor != "integer") {
                        print "<td> $val </td>\n";
                    } else {
                        $val = round($val, 3);
                        print "<td> $val </td>\n";
                    }
                } // fin foreach
                print "</tr>\n\n";
            } // fin while
            print "</table>\n";
            print "</div>\n";
        
        }
    }
    
    public function showTableConsumAnyEdifici($temporadas,$edifici,$consumo){
        
        $nomenclatura = traductorEdificis($edifici);
        
        $arrayTemporadas = array();
        $arrayTemporadas = explode(" ", $temporadas);
        
        $arrayConsumosEdificio = Array();
        $arrayTotalesEdificio = Array();
        
        $medida = "Kw";
        
        $presql = "SELECT temporada,mes,SUM(lectura_actual-lectura_anterior) FROM pspv_schema.";
        $presql .= $this->table_name;
        $pregroup = " GROUP BY 1,2 ORDER BY mes='Gener',mes='Febrer',mes='Març',mes='Abril',mes='Maig',mes='Juny',mes='Juliol',mes='Agost',mes='Septembre',mes='Octubre',mes='Novembre',mes='Decembre';";
        
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
        
        print "<h4>Consum $consumo $edifici</h4>";
        print "<table class=\"table table-bordered table-striped table-responsive\">\n";
        print "<tr>\n";
        print "<th>Temporarada</th>";
        foreach($arrayTemporadas as $temp){
            print '<td>'.$temp.'</td>';
        }
        
        print "</tr>";
        
        // Obtenemos de datos en forma de array asociativo
        
        print '<tr>';
        print '<th>Totals en '.$medida.'</th>';
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
        
        $pre_sql = "SELECT g.temporada,g.mes,(g.lectura_actual-g.lectura_anterior)*p.cantitat*g.conversio
                        FROM pspv_schema.";
        $pre_relation = " g, pspv_schema.conversio_preus p";
        $pre_group = "";
        $pre_where = " WHERE g.id_preu = p.id ";
        
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
    
    public function showTableTotalsConsumXanys($temporadas,$consumo){
        
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
        
        $pre_sql = "SELECT temporada,mes,SUM(lectura_actual-lectura_anterior)
                                FROM pspv_schema.";
        $medida = "Kw";
        $pre_group = " GROUP BY 1,2 ORDER BY mes='Gener',mes='Febrer',mes='Març',mes='Abril',mes='Maig',mes='Juny',mes='Juliol',mes='Agost',mes='Septembre',mes='Octubre',mes='Novembre',mes='Decembre';";
        $arraynomenclatura      = ["GRE","TRA","XAL","PUI","SUP"];
        
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
        
        $pre_sql = "SELECT g.temporada,g.mes,(g.lectura_actual-g.lectura_anterior)*p.cantitat*g.conversio
                            FROM pspv_schema.";
        $pre_relation = " g, pspv_schema.conversio_preus p";
        $medida = "€";
        $pre_group = "";
        $pre_where = " WHERE g.id_preu = p.id";
        $arraynomenclatura      = ["GRE","TRA","XAL","PUI","SUP"];
        
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
        $pre_sql = "SELECT temporada,mes,SUM(lectura_actual-lectura_anterior)
                        FROM pspv_schema.";
        $pre_where = " WHERE temporada = ";
        $post_where = " AND id_edifici LIKE ";
        $pre_group = "  GROUP BY 1,2
                        ORDER BY mes='Decembre', mes='Novembre',mes='Octubre', mes='Septembre', mes='Agost', mes='Juliol', mes='Juny',mes='Maig',mes='Abril',mes='Març',mes='Febrer',mes='Gener' asc;";
        
        $sql = "";
        $sql .= $pre_sql;
        $sql .= $this->table_name;
        $sql .= $pre_where;
        $sql .= $temporada;
        $sql .= $post_where;
        $sql .= "'$edi_table'";
        $sql .= $pre_group;
        
        try{
            $result = pg_query($sql);
        } catch (Exception $e){
            $msg = "[ERR] Error en función arrayGraphsConsumos_2. MSG: ". pg_last_error($this->connection)." Fecha: ".$GLOBALS['fecha']."\n";
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
        $pre_sql = "SELECT g.temporada,g.mes,(g.lectura_actual-g.lectura_anterior)*p.cantitat*g.conversio
                            FROM pspv_schema.";
        $tabla_db = $this->table_name;
        $pre_relation = " g, pspv_schema.conversio_preus p ";
        $pre_where = " WHERE g.id_preu = p.id";
        $post_where1 = " AND temporada = ";
        $post_where2 = " AND id_edifici LIKE ";
        $pre_group = "  GROUP BY 1,2,3
                                ORDER BY mes='Decembre', mes='Novembre',mes='Octubre', mes='Septembre', mes='Agost', mes='Juliol', mes='Juny',mes='Maig',mes='Abril',mes='Març',mes='Febrer',mes='Gener' asc;";
        $sql = "";
        $sql .= $pre_sql;
        $sql .= $tabla_db;
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
            $msg = "[ERR] Error en función arrayGraphsConsumos_2. MSG: ". pg_last_error($this->connection)." Fecha: ".$GLOBALS['fecha']."\n";
            errorLog($msg);
        }
        
        if (!$result) {
            echo "Error en la consulta del ".$temporada." ".$consumo.".\n";
            exit;
        }
        
        // Asignación de los PMP del Aigua del 2014
//         $decembre 	= pg_fetch_result($result,0,2);
//         $novembre 	= pg_fetch_result($result,1,2);
//         $octubre 		= pg_fetch_result($result,2,2);
//         $septembre	= pg_fetch_result($result,3,2);
//         $agost			= pg_fetch_result($result,4,2);
//         $juliol			= pg_fetch_result($result,5,2);
//         $juny			= pg_fetch_result($result,6,2);
//         $maig			= pg_fetch_result($result,7,2);
//         $abril			= pg_fetch_result($result,8,2);
//         $marzo		= pg_fetch_result($result,9,2);
//         $febrer		= pg_fetch_result($result,10,2);
//         $gener			= pg_fetch_result($result,11,2);
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
        $cabecera = "Temporada,Mes,id_edifici,id_preu,Conversio,Lectura_Anterior,Lectura_Actual"."\n";
        fwrite($fichero,$cabecera);
        
        while($row = pg_fetch_assoc($result)){
            $string = 	$row['temporada'].",".$row['mes'].",".$row['id_edifici'].",".$row['id_preu'].",".$row['conversio'].",".$row['lectura_anterior'].",".$row['lectura_actual']."\n";
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
            
            $temporada          = intval($val['Temporada']);
            $mes                = $val['Mes'];
            $id_edifici         = $val['id_edifici'];
            $id_preu            = intval($val['id_preu']);
            $conversio          = floatval($val['Conversio']);
            $lectura_anterior   = intval($val['Lectura_Anterior']);
            $lectura_actual     = intval($val['Lectura_Actual']);
            
            $cmd = 'INSERT INTO pspv_schema.'.$this->table_name.'(mes,temporada,id_edifici,id_preu,conversio,lectura_anterior,lectura_actual) ';
            $cmd .= 'VALUES(\''.$mes.'\','.$temporada.',\''.$id_edifici.'\','.$id_preu.','.$conversio.','.$lectura_anterior.','.$lectura_actual.');';
            
            $res = pg_query($cmd);
            
            if(!$res){
                $msg = "[ERR] Fallo: los datos de no fueron insertados: ". pg_last_error($this->connection)." Fecha: ".$GLOBALS['date']."\n";
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
        
        $table_name = $this->table_name;
        $sql = "SELECT temporada,mes,SUM(lectura_actual-lectura_anterior)
                    FROM pspv_schema.".$table_name."
                    WHERE temporada = ". $temp ."
                    AND id_edifici LIKE '$edifici'
                    GROUP BY 1,2
                    ORDER BY mes='Gener',mes='Febrer',mes='Març',mes='Abril',mes='Maig',mes='Juny',mes='Juliol',mes='Agost',mes='Septembre',mes='Octubre',mes='Novembre',mes='Decembre';";
        
        try{
            $result = pg_query($sql);
        } catch (Exception $e){
            $msg = "[ERR] Error en función totalsConsumXEdificis. MSG: ".pg_last_error($this->connection)."\n";
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
    
    public function arrayTotalsPMP($temp,$edifici){
        $sql = "SELECT g.mes,(g.lectura_actual-g.lectura_anterior)*p.cantitat*g.conversio
                    FROM pspv_schema.".$this->table_name." g, pspv_schema.conversio_preus p
                    WHERE g.id_preu = p.id
                    AND temporada = ".$temp."
                    AND id_edifici LIKE '$edifici'
                    ORDER BY mes='Decembre', mes='Novembre',mes='Octubre', mes='Septembre', mes='Agost', mes='Juliol', mes='Juny',mes='Maig',mes='Abril',mes='Març',mes='Febrer',mes='Gener';";
        
        
        try{
            $result = pg_query($sql);
        } catch (Exception $e){
            $msg = "[ERR] Error en función arrayTotalsConsumGasNatural. MSG: ".pg_last_error($this->connection)."\n";
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
    
    public function updateShowForm($id,$mes,$any,$edifici,$anterior,$actual){
    	
    	
    	echo '
			<script type="txt/javascript">
				$(document).ready(function (){
 					$("#btnGas").on("click",function(){
 						var mes = $("#selmes").val();
  						var any = $("#selany").val();
 						var edifici = $("#edifici").val();
  						var anterior = $("#anterior").val();
						var actual = $("#actual").val();
 						var tipo = "Gas Natural";
						var id = '.$id.';
								
								
 						$.ajax({
								   type: "POST",
								   data: {id:id,mes:mes,any:any,edifici:edifici,anterior:anterior,actual:actual,tipo:tipo},
      						       url: "../Ajax_Reception_PHP/updateData.php",
      						       success: function(msg){
      						           $("#responseInsert").html(msg);
      						       }
      					});
 					});
  				});
								
			</script>
			<div  class="col-md-12" id="contenedorGas">
				<h3 id="cabecera-formulario">Actualització de dades en el Gas Natural '.$edifici.'</h3>
				<form role="form" action="./insercion/ins_gas.php" method="POST">
					 <div class="form-group">
						<div class="col-md-12 col">
							<div class="col-md-8 col">
								<div class="col-md-4 col">
									<h4>Mes</h4>
				   						<input class="form-control" id="selmes" type="text" name="MEs" value="'.$mes.'" required="required">
								</div>
								<div class="col-md-4 col">
									<h4>Any</h4>
										<input class="form-control" id="selany"type="number" name="anyG" min="2022" max="2030" value="'.$any.'" required="required">
								</div>
							</div>
							<div class="col-md-12 col">
								<div class="col-md-2 col">
									<h4>Edifici</h4>
										<input class="form-control" id="edifici" type="text" name="Edifici" value="'.$edifici.'" required="required">
								</div>
								<div class="col-md-5 col">
									<h4>Lectura Anterior</h4>
									<input class="form-control" id="anterior" type="float" name="LecturaAnterior" value="'.$anterior.'" required="required">
								</div>
								<div class="col-md-5 col">
									<h4>Lectura Actual</h4>
									<input  class="form-control" id="actual" type="float" name="LecturaActual" value="'.$actual.'" required="required">
								</div>
							</div>
							<div class="col-md-6 col">
								<input  class="form-control btn btn-primary" id="btnGas" name="submit" value="Enviar dades" style="margin:2%">
							</div>
						</div>
					</div>
					</form>
				</div>
				<div class="col-md-8 col" id="responseInsert"></div>
		';
    }
    
    public function showForm(){
    
    	echo '
			<script type="txt/javascript">
				$(document).ready(function (){
 					$("#btnGas").on("click",function(){
 						var mes = $("#selmes").val();
  						var any = $("#selany").val();
 						var edifici = $("#edifici").val();
  						var anterior = $("#anterior").val();
						var actual = $("#actual").val();
 						var tipo = "Gas Natural";
					


 						$.ajax({
								   type: "POST",
								   data: {mes:mes,any:any,edifici:edifici,anterior:anterior,actual:actual,tipo:tipo},
      						       url: "../Ajax_Reception_PHP/insertData.php",								      						      
      						       success: function(msg){
      						           $("#responseInsert").html(msg);
      						       }
      					});
 					});
 				});
          							 
			</script>
			<div  class="col-md-12" id="contenedorGas">
				<h3 id="cabecera-formulario">Inserció de dades en el formulari Gas Natural</h3>
				<form role="form" action="./insercion/ins_gas.php" method="POST">
					 <div class="form-group">
						<div class="col-md-12 col">
							<div class="col-md-8 col">
								<div class="col-md-4 col">
									<h4>Mes</h4>
				   					<select class="form-control" id="selmes" name="mesosG" required="required" >
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
										<input class="form-control" id="selany"type="number" name="anyG" min="2022" max="2030" value="'.$any.'" required="required">
								</div>
							</div>
							<div class="col-md-9 col">
								<div class="col-md-3 col">
									<h4>Selecció d´ edifici</h4>
								  	<select class="form-control" id="edifici" name="edifici" required="required" >
								    	<option>Tramuntana</option>
								    	<option>Xaloc</option>
								    	<option>Gregal</option>
								    	<option>Suport</option>
								    	<option>Puigmal</option>
								  	</select>
								</div>
								<div class="col-md-3 col">
									<h4>Lectura Anterior</h4>
									<input class="form-control" id="anterior" type="float" name="LecturaAnterior" required="required">
								</div>
								<div class="col-md-3 col">											
									<h4>Lectura Actual</h4><br>
									<input  class="form-control" id="actual" type="float" name="LecturaActual" required="required">
								</div>
							</div>
							<div class="col-md-6 col">
								<input  class="form-control btn btn-primary" id="btnGas" name="submit" value="Enviar dades" style="margin:2%">
							</div>
						</div>
					</div>
					</form>
				</div>
				<div class="col-md-8 col" id="responseInsert"></div>
		';
	    $this->lastinsert();	
    }
    
    public function updateData($id,$mes,$any,$edifici,$anterior,$actual){
    	
    	$temporada          = intval($any);
    	$id_edifici         = $edifici;
    	$id_preu            = 2;
    	$conversio          = floatval(11.5);
    	$lectura_anterior   = intval($anterior);
    	$lectura_actual     = intval($actual);
  
    	$cmd = 'UPDATE pspv_schema.'.$this->table_name.' SET 	mes = \''.$mes.'\', temporada = '.$temporada.',
																id_edifici = \''.$id_edifici.'\', id_preu = '.$id_preu.',
																conversio = '.$conversio.', lectura_anterior = '.$lectura_anterior.',
																lectura_actual = '.$lectura_actual.'
		WHERE id = \''.$id.'\';'; 
																
  
    	
    	$res = pg_query($cmd);
    	
    	if(!$res){
    		$msg = "[ERR] Fallo: los datos de no fueron insertados: ". pg_last_error($this->connection)." Fecha: ".$GLOBALS['date']."\n";
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
    
    
    public function insertOneData($mes,$any,$edifici,$anterior,$actual){
    	$temporada          = intval($any);
    	$id_edifici         = traductorEdificis($edifici);
    	$id_preu            = 2;
    	$conversio          = floatval(11.5);
    	$lectura_anterior   = intval($anterior);
    	$lectura_actual     = intval($actual);
    	
    	$cmd = 'INSERT INTO pspv_schema.'.$this->table_name.'(mes,temporada,id_edifici,id_preu,conversio,lectura_anterior,lectura_actual) ';
    	$cmd .= 'VALUES(\''.$mes.'\','.$temporada.',\''.$id_edifici.'\','.$id_preu.','.$conversio.','.$lectura_anterior.','.$lectura_actual.');';
    	
    	$res = pg_query($cmd);
    	
    	if(!$res){
    		$msg = "[ERR] Fallo: los datos de no fueron insertados: ". pg_last_error($this->connection)." Fecha: ".$GLOBALS['date']."\n";
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
}
  
