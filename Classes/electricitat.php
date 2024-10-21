<?php

##########################
#@autor: Raúl Olmedo
#@date: 20-03-20
#@file: electricitat.php
#@function: This script contain Class Electricitat.
###########################

include '../config/core.php';
include '../config/globals.php';

class Electricitat{
    
    private $connection;
    private $table_name = "consumselectricitat";
    
    //Propierties
    public $mes;
    public $temporada;
    public $consumP1;
    public $consumP2;
    public $consumP3;
    public $consumP4;
    public $consumP5;
    public $consumP6;
    public $totalFactura;
    
    
    
    //Constructor
    public function __construct($db){
        $this->connection = $db;            
    }
    
    public function lastInsertDT(){
    		$data = array();
    		$sql3 = "       SELECT id, temporada, mes, consum_p1,consum_p2,consum_p3,consum_p4,consum_p5,consum_p6,totalf
                        FROM pspv_schema.consumselectricitat
                        ORDER BY 1 DESC
                        LIMIT 10
                        ";
    		
    		$result = pg_query($sql3);    		    	
    		while ($row = pg_fetch_assoc($result)) {
    			$arrayEdifici = array(
    				"Id" => $row['id'],
    				"Temporada" => $row['temporada'],
    				"Mes" => $row['mes'],
    				"ConsumP1" => $row['consum_p1'],
    				"ConsumP2" => $row['consum_p2'],
    				"ConsumP3" => $row['consum_p3'],
    				"ConsumP4" => $row['consum_p4'],
    				"ConsumP5" => $row['consum_p5'],
    				"ConsumP6" => $row['consum_p6'],
    				"TotalFactura" => $row['totalf'],
    			);
    			array_push($data,$arrayEdifici);    			
    		}
    	
    	$arrayGas["Electricitat"] = "";
    	$arrayGas["Electricitat"] = $data;
    	echo json_encode($arrayGas,JSON_PRETTY_PRINT);
    }
    
    //Show Table 4 last Inserts
    public function last_insert(){
        $sql3 = "       SELECT id, temporada, mes, consum_p1,consum_p2,consum_p3,consum_p4,consum_p5,consum_p6,totalf
                        FROM pspv_schema.consumselectricitat
                        ORDER BY 1 DESC
                        LIMIT 10
            
                        ";
        
        $result = pg_query($sql3);
        print "<div class=\"col-md-6\">\n";
        print "<h4>Electrictitat Ultimes insercions</h4><br>";
        print "<table class=\"table table-bordered table-striped\">\n";
        // Obtenemos los nombres de los campos
        
        print "<tr>\n";
        
        print "<th>Id</th>\n";
        print "<th>Any</th>\n";
        print "<th>Mes</th>\n";
        print "<th>Consum P1</th>\n";
        print "<th>Consum P2</th>\n";
        print "<th>Consum P3</th>\n";
        print "<th>Consum P4</th>\n";
        print "<th>Consum P5</th>\n";
        print "<th>Consum P6</th>\n";
        print "<th>Total Factura</th>";
        
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
        print"</div>\n";
    }
    
    //Show data for temporada selected
    public function showTableConsumAny($temporadas){
        $sql = "";
        $sql .= "SELECT temporada, SUM(consum_p1+consum_p2+consum_p3+consum_p4+consum_p5+consum_p6)
                FROM pspv_schema.";
        $sql .= $this->table_name;
        $sql .= " WHERE temporada IN ";
        $sql = createIncludeTemporadas($sql,$temporadas);
        $sql .= " GROUP BY 1 ORDER BY 1;";
        
        try{
            $result = pg_query($sql);
        } catch (Exception $e){
            $msg = "[ERR] Error en función consumXAnyElectricitat. MSG: ". pg_last_error($this->connection)."\n";
            errorLog($msg);
        }
        print "<h4>Consum de l´electricitat en Kw</h4>";
        print "<table class=\"table table-bordered\">\n";
        
        // Obtenemos los nombres de los campos
        print "<tr>\n";
        print "<th>Temporada Electricitat</th>\n";
        print "<th>Total Kw</th>\n";
        print "</tr>\n\n";
        // Obtenemos de datos en forma de array asociativo
        while ($row = pg_fetch_assoc($result)){
            print "<tr>\n";
            // Examinamos cada campo
            foreach ($row as $col => $val) {
                if ($col == "temporada"){
                    print "<td> $val </td>\n";
                }else{
                    $val = number_format($val,2,',','.');
                    print "<td> $val </td>\n";
                }
                
            } // fin foreach
            print "</tr>\n\n";
        } // fin while
        print "</table>\n";
        print "</div>\n";
        
        
    }
    
    public function showTableCostAny($temporadas){
        $sql = "";
        
        $sql .= "SELECT temporada, SUM(totalf)/SUM(consum_p1+consum_p2+consum_p3+consum_p4+consum_p5+consum_p6)
                FROM pspv_schema.";
        $sql .= $this->table_name;
        $sql .= " WHERE temporada IN ";
        $sql = createIncludeTemporadas($sql, $temporadas);
        $sql .= " GROUP BY 1 ORDER BY 1;";
        
        try{
            $result = pg_query($sql);
        } catch (Exception $e){
            $msg = "[ERR] Error en función costXAnyElectricitat. MSG: ".pg_last_error($this->connection)."\n";
            errorLog($msg);
        }
        print "<h4>Preu mig ponderat de l´electricitat</h4>";
        print "<table class=\"table table-bordered\">\n";
        
        // Obtenemos los nombres de los campos
        print "<tr>\n";
        print '<th>Temporada</th>';
        print '<th>Preu mig Ponderat  €</th>';
        print "</tr>\n\n";
        
        // Obtenemos de datos en forma de array asociativo
        while ($row = pg_fetch_assoc($result)){
            print "<tr>\n";
            // Examinamos cada campo
            foreach ($row as $col => $val) {
                if ($col == "temporada"){
                    print "<td> $val </td>\n";
                }else{
                    $val = number_format($val,2,',','.');
                    print "<td> $val </td>\n";
                }
            } // fin foreach
            print "</tr>\n\n";
        } // fin while
    }

    public function dataConsumToArrayGraph($temporada,$consumo){
        
        error_reporting(0);
    	$pre_sql = "";
        $pre_group = "";
        $pre_where = "";
        
        $pre_sql = "SELECT temporada,mes,SUM(consum_p1+consum_p2+consum_p3+consum_p4+consum_p5+consum_p6)
                            FROM pspv_schema.";
        $pre_group = "  GROUP BY 1,2
        				        ORDER BY mes='Decembre', mes='Novembre',mes='Octubre', mes='Septembre', mes='Agost', mes='Juliol', mes='Juny',mes='Maig',mes='Abril',mes='Març',mes='Febrer',mes='Gener';";
        $pre_where = " WHERE temporada = ";
        
        $sql = "";
        $sql .= $pre_sql;
        $sql .= $this->table_name;
        $sql .= $pre_where;
        $sql .= $temporada;
        $sql .= $pre_group;
        
        try{
            $result = pg_query($sql);
        } catch (Exception $e){
            $msg = "[ERR] Error en función arrayGraphsConsumos_1. MSG: ".pg_last_error($this->connection)." Fecha:".$GLOBALS['fecha']."\n";
            errorLog($msg);
        }
        
        
        if (!$result) {
            echo "Error en la consulta del ".$temporada." ".$consumo.".\n";
            exit;
        }               
        
        
//         !pg_fetch_result($result,0,2) ? $decembre = 0 : $decembre = pg_fetch_result($result,0,2);
//         !pg_fetch_result($result,1,2) ? $novembre = 0 : $novembre = pg_fetch_result($result,1,2);
//         !pg_fetch_result($result,2,2) ? $octubre = 0 : $octubre = pg_fetch_result($result,2,2);
//         !pg_fetch_result($result,3,2) ? $septembre = 0 : $septembre = pg_fetch_result($result,3,2);
//         !pg_fetch_result($result,4,2) ? $agost = 0 : $agost = pg_fetch_result($result,4,2);
//         !pg_fetch_result($result,5,2) ? $juliol = 0 : $juliol = pg_fetch_result($result,5,2);
//         !pg_fetch_result($result,6,2) ? $juny = 0 : $juny = pg_fetch_result($result,6,2);
//         !pg_fetch_result($result,7,2) ? $maig = 0 : $maig = pg_fetch_result($result,7,2);
//         !pg_fetch_result($result,8,2) ? $abril = 0 : $abril = pg_fetch_result($result,8,2);
//         !pg_fetch_result($result,9,2) ? $marzo = 0 : $marzo = pg_fetch_result($result,9,2);
//         !pg_fetch_result($result,10,2) ? $febrer = 0 : $febrer = pg_fetch_result($result,10,2);
//         !pg_fetch_result($result,11,2) ? $gener = 0 : $gener = pg_fetch_result($result,11,2);
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

    public function dataCostToArrayGraph($temporada,$consumo){
        error_reporting(0);
        $pre_sql = "";
        $pre_group = "";
        $pre_where = "";
        
        $pre_sql = "SELECT temporada,mes,totalf/SUM(consum_p1+consum_p2+consum_p3+consum_p4+consum_p5+consum_p6)
				            FROM pspv_schema.";
        $pre_group = "  GROUP BY 1,2
        				        ORDER BY mes='Decembre', mes='Novembre',mes='Octubre', mes='Septembre', mes='Agost', mes='Juliol', mes='Juny',mes='Maig',mes='Abril',mes='Març',mes='Febrer',mes='Gener';";
        $pre_where = " WHERE temporada = ";
        
        $sql = "";
        $sql .= $pre_sql;
        $sql .= $this->table_name;
        $sql .= $pre_where;
        $sql .= $temporada;
        $sql .= $pre_group;
        
        try{
            $result = pg_query($sql);
        } catch (Exception $e){
            $msg = "[ERR] Error en función arrayGraphsConsumos_1. MSG: ".pg_last_error($this->connection)." Fecha:".$GLOBALS['fecha']."\n";
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
        $cabecera = "Temporada,Mes,Consum_P1,Consum_P2,Consum_P3,Consum_P4,Consum_P5,Consum_P6,Total Factura"."\n";
        fwrite($fichero,$cabecera);
        
        while($row = pg_fetch_assoc($result)){
            $string = 	$row['temporada'].",".$row['mes'].",".$row['consum_p1'].",".$row['consum_p2'].",".$row['consum_p3'].",".$row['consum_p4'].",".$row['consum_p5'].",".$row['consum_p6'].",".$row['totalf']."\n";
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
            
            $temporada  = intval($val['Temporada']);
            $mes        = $val['Mes'];
            $consum_p1   = floatval($val['Consum_P1']);
            $consum_p2   = floatval($val['Consum_P2']);
            $consum_p3   = floatval($val['Consum_P3']);
            $consum_p4   = floatval($val['Consum_P4']);
            $consum_p5   = floatval($val['Consum_P5']);
            $consum_p6   = floatval($val['Consum_P6']);
            $totalf     = floatval($val['Total Factura']);
            
            $cmd = 'INSERT INTO pspv_schema.'.$this->table_name.'(mes,temporada,consum_p1,consum_p2,consum_p3,consum_p4,consum_p5,consum_p6,totalf) ';
            $cmd .= 'VALUES (\''.$mes.'\','.$temporada.','.$consum_p1.','.$consum_p2.','.$consum_p3.','.$consum_p4.','.$consum_p5.','.$consum_p6.','.$totalf.');';
            
            $res = pg_query($cmd);
            
            if(!$res){
                $msg = "[ERR] Fallo: los datos de no fueron insertados: ". pg_last_error($this->connection)." Fecha: ".$GLOBALS['fecha']."\n";                
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
    
    public function insertOneData($mes,$any,$p1,$p2,$p3,$p4,$p5,$p6,$totalf){
    	$temporada  = $any;
    	$consum_p1   = floatval($p1);
    	$consum_p2   = floatval($p2);
    	$consum_p3   = floatval($p3);
    	$consum_p4   = floatval($p4);
    	$consum_p5   = floatval($p5);
    	$consum_p6   = floatval($p6);
    	$totalf     = floatval($totalf);
    	
    	$cmd = 'INSERT INTO pspv_schema.'.$this->table_name.'(mes,temporada,consum_p1,consum_p2,consum_p3,consum_p4,consum_p5,consum_p6,totalf) ';
    	$cmd .= 'VALUES (\''.$mes.'\','.$temporada.','.$consum_p1.','.$consum_p2.','.$consum_p3.','.$consum_p4.','.$consum_p5.','.$consum_p6.','.$totalf.');';
    	
    	$res = pg_query($cmd);
    	
    	if(!$res){
    		$msg = "[ERR] Fallo: los datos de no fueron insertados: ". pg_last_error($this->connection)." Fecha: ".$GLOBALS['fecha']."\n";
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
    
    public function updatedData($id,$temporada,$mes,$p1,$p2,$p3,$p4,$p5,$p6,$totalf){
    	$temporada  = $temporada;
    	$consum_p1   = floatval($p1);
    	$consum_p2   = floatval($p2);
    	$consum_p3   = floatval($p3);
    	$consum_p4   = floatval($p4);
    	$consum_p5   = floatval($p5);
    	$consum_p6   = floatval($p6);
    	$totalf     = floatval($totalf);
    	
    	$cmd = 'UPDATE pspv_schema.'.$this->table_name.' SET 	mes = \''.$mes.'\', temporada = \''.$temporada.'\',
																consum_p1 = \''.$consum_p1.'\',consum_p2 = \''.$consum_p2.'\',
																consum_p3 = \''.$consum_p3.'\',consum_p4 = \''.$consum_p4.'\',
																consum_p5 = \''.$consum_p5.'\',consum_p6 = \''.$consum_p6.'\',
																totalf = \''.$totalf.'\'
				WHERE id = \''.$id.'\';'; 
																
																	
			

    	
    	$res = pg_query($cmd);
    	
    	if(!$res){
    		$msg = "[ERR] Fallo: los datos de no fueron insertados: ". pg_last_error($this->connection)." Fecha: ".$GLOBALS['fecha']."\n";
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
    public function showFormUpdate($id,$temporada,$mes,$p1,$p2,$p3,$p4,$p5,$p6,$totalf){
    	
    		echo '
			<script type="txt/javascript">
    				
				$(document).ready(function (){
    				
 					$("#btnElectricitat").on("click",function(){
 						var mes = $("#selmes").val();
  						var any = $("#selany").val();
 						var p1 = $("#p1").val();
  						var p2 = $("#p2").val();
  						var p3 = $("#p3").val();
  						var p4 = $("#p4").val();
  						var p5 = $("#p5").val();
  						var p6 = $("#p6").val();
 						var totalf = $("#totalf").val();
 						var tipo = "Electricitat";
						var id = '.$id.';					
    				
 						$.ajax({
								   type: "POST",
								   data: {id:id,mes:mes,temporada:any,p1:p1,p2:p2,p3:p3,p4:p4,p5:p5,p6:p6,totalf:totalf,tipo:tipo},
      						       url: "../Ajax_Reception_PHP/updateData.php",
      						       success: function(msg){
      						           $("#responseInsert").html(msg);
      						       }
       					});
 					});
 				});
    				
			</script>
    				
			<div  class="col-md-8 col container" id="contenedorElectricitat">
				<h3 id="cabecera-formulario">Actualització de dades Subministrament Electric</h3>
					<form role="form"  name="form-electr">
					    <div class="col-md-12 col">
					        <div class="form-group">
								<div class="col-md-8 col" id="any_mes">
									<div class="col-md-4 col" id="divmes">
										<h4>Mes</h4>
				   						<input class="form-control" id="selmes" type="text" name="MEs" value="'.$mes.'" required="required">

									</div>
									<div class="col-md-4 col" id="divany">
										<h4>Any</h4>
											<input class="form-control" type="number" id="selany" name="any" min="2022" max="2030" value="'.$temporada.'" required="required">
									</div>
								</div>
								<div class="col-md-9 col" id="divperiodes">
									<h4>Factura Consums</h4>
									<div class="col-md-3 col" id="divp1">
						   				<h4>Periode 1</h4>
											<input class="form-control" type="float" id="p1" name="p1" value="'.$p1.'"><br>
									</div>
									<div class="col-md-3 col" id="divp2">
										<h4>Periode 2</h4>
											<input class="form-control"type="float" id="p2" name="p2" value="'.$p2.'"><br>
									</div>
									<div class="col-md-3 col" id="divp3">
										<h4>Periode 3</h4>
							     			<input class="form-control" type="float" id="p3" name="p3" value="'.$p3.'"><br>
									</div>
									<div class="col-md-3 col" id="divp4">
										<h4>Periode 4</h4>
											<input class="form-control" type="float" id="p4" name="p4" value="'.$p4.'"><br>
									</div>
									<div class="col-md-3 col" id="divp5">
										<h4>Periode 5</h4>
											<input class="form-control" type="float" id="p5" name="p5" value="'.$p5.'"><br>
									</div>
									<div class="col-md-3 col" id="divp6">
										<h4>Periode 6</h4>
											<input class="form-control" type="float" id="p6" name="p6" value="'.$p6.'"><br>
									</div>
								</div>
    				
								<div class="col-md-8 col" id="divtotalf">
									<h4 id="TotalF">Total Factura en euros</h4>
										<input class="form-control" type="float" id="totalf" name="totalf" value="'.$totalf.'" required="required">
								</div>
								<br>
								<div class="col-md-8 col" id="divbtn" style="margin: 2px;">
										<input 	class="form-control btn btn-primary" id="btnElectricitat"
										name="submit" value="Enviar dades">
    				
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

 					$("#btnElectricitat").on("click",function(){
 						var mes = $("#selmes").val();
  						var any = $("#selany").val();
 						var p1 = $("#p1").val();
  						var p2 = $("#p2").val();
  						var p3 = $("#p3").val();
  						var p4 = $("#p4").val();
  						var p5 = $("#p5").val();
  						var p6 = $("#p6").val();
 						var totalf = $("#totalf").val();
 						var tipo = "Electricitat";

 						$.ajax({
								   type: "POST",
								   data: {mes:mes,any:any,p1:p1,p2:p2,p3:p3,p4:p4,p5:p5,p6:p6,totalf:totalf,tipo:tipo},
      						       url: "../Ajax_Reception_PHP/insertData.php",								      						      
      						       success: function(msg){
      						           $("#responseInsert").html(msg);
      						       }
      					});
 					});
 				});
          							 
			</script>

			<div  class="col-md-12 col container" id="contenedorElectricitat">
				<h3 id="cabecera-formulario">Inserció de dades Subministrament Electric</h3>
					<form role="form"  name="form-electr">
					    <div class="col-md-12 col">
					        <div class="form-group">
								<div class="col-md-8 col" id="any_mes">
									<div class="col-md-4 col" id="divmes">
										<h4>Mes</h4>
						   					<select class="form-control" id="selmes" name="mesos" required="required" >
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
									<div class="col-md-4 col" id="divany">
										<h4>Any</h4>
											<input class="form-control" type="number" id="selany" name="any" min="2022" max="2030" required="required">
									</div>
								</div>
								<div class="col-md-9 col" id="divperiodes">
									<h4>Factura Consums</h4>
									<div class="col-md-3 col" id="divp1">					   			
						   				<h4>Periode 1</h4>
											<input class="form-control" type="float" id="p1" name="p1" value="0"><br>
									</div>
									<div class="col-md-3 col" id="divp2">
										<h4>Periode 2</h4>
											<input class="form-control"type="float" id="p2" name="p2" value="0"><br>
									</div>
									<div class="col-md-3 col" id="divp3">
										<h4>Periode 3</h4>
							     			<input class="form-control" type="float" id="p3" name="p3" value="0"><br>
									</div>
									<div class="col-md-3 col" id="divp4">
										<h4>Periode 4</h4>
											<input class="form-control" type="float" id="p4" name="p4" value="0"><br>
									</div>
									<div class="col-md-3 col" id="divp5">
										<h4>Periode 5</h4>
											<input class="form-control" type="float" id="p5" name="p5" value="0"><br>
									</div>
									<div class="col-md-3 col" id="divp6">
										<h4>Periode 6</h4>
											<input class="form-control" type="float" id="p6" name="p6" value="0"><br>
									</div>
								</div>
								
								<div class="col-md-8 col" id="divtotalf">
									<h4 id="TotalF">Total Factura en euros</h4>
										<input class="form-control" type="float" id="totalf" name="totalf" required="required">
								</div>
								<br>
								<div class="col-md-8 col" id="divbtn" style="margin: 2px;">
										<input 	class="form-control btn btn-primary" id="btnElectricitat"
										name="submit" value="Enviar dades">
										
								</div>
							</div>							
						</div>
				</form>
    		</div>
			<div class="col-md-8 col" id="responseInsert"></div>';
    		$this->last_insert();
    	
    }
}

