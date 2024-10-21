<?php

##########################
#@autor: Raúl Olmedo
#@date: 20-03-20
#@file: aigua.php
#@function: This script contain Class Aigua.
###########################

include '../config/core.php';
include '../config/globals.php';
include '../Classes/preu.php';


class Aigua{
    
    private $connection;
    private $table_name = "consumsaigua";
    
    //Propierties
    public $mes;
    public $temporada;
    public $consumTram1;
    public $consumTram2;
    public $consumTram3;
    public $totalFactura;    

    //Constructor
    public function __construct($db){
        $this->connection = $db;
    }
    
    public function lastInsertDT(){
    	$data = array();
    	$sql = "
                    SELECT id,temporada,mes,consum_tram1,consum_tram2,consum_tram3,totalf
	                FROM pspv_schema.".$this->table_name."
				    ORDER BY id desc
				    LIMIT 10
				";
    	
    	$result = pg_query($sql);
    	while ($row = pg_fetch_assoc($result)) {
    		$arrayEdifici = array(
    				"Id" => $row['id'],
    				"Temporada" => $row['temporada'],
    				"Mes" => $row['mes'],
    				"Tram1" => $row['consum_tram1'],
    				"Tram2" => $row['consum_tram2'],
    				"Tram3" => $row['consum_tram3'],    				
    				"TotalFactura" => $row['totalf'],
    		);
    		array_push($data,$arrayEdifici);
    	}
    	
    	$arrayGas["Aigua"] = "";
    	$arrayGas["Aigua"] = $data;
    	echo json_encode($arrayGas,JSON_PRETTY_PRINT);
    	
    }
    

    public function last_insert(){
        $sql = "	
                    SELECT id,temporada,mes,consum_tram1,consum_tram2,consum_tram3,totalf
	                FROM pspv_schema.".$this->table_name."
				    ORDER BY id desc
				    LIMIT 10
				";
        
        $result = pg_query($sql);
        
        print "<div class=\"col-md-6\">\n";
        print "<h4>Aigua / Ultimes insercions</h4><br>";
        print "<table class=\"table table-bordered table-striped\">\n";
        // Obtenemos los nombres de los campos
        
        print "<tr>\n";
        
        print "<th>Id</th>\n";
        print "<th>Any</th>\n";
        print "<th>Mes</th>\n";
        print "<th>Tram 1</th>\n";
        print "<th>Tram 2</th>\n";
        print "<th>Tram 3</th>";
        print "<th>Total Factura</th>\n";
        
        print "</tr>\n\n";
        // Obtenemos de datos en forma de array asociativo
        
        while ($row = pg_fetch_assoc($result)){
            print "<tr>\n";
            // Examinamos cada campo
            foreach ($row as $col => $val) {
                print "<td> $val </td>\n";
            } // fin foreach
            print "</tr>\n\n";
        } // fin while
        
        print "</table>\n";
        print "</div>";
    }
    
    public function showTableConsumAny($temporadas){
        
        $sql = "SELECT temporada,SUM(consum_tram1+consum_tram2+consum_tram3)
                FROM pspv_schema.consumsaigua
				WHERE temporada IN ";
        $sql = createIncludeTemporadas($sql, $temporadas);
        $sql .= " GROUP BY 1 ORDER BY 1;";
        try{
            $result = pg_query($sql);
        } catch (Exception $e){
            $msg = "[ERR] Error en función consumXAnysAigua. MSG: ".pg_last_error($this->connection)."\n";
            errorLog($msg);
        }
        
        print "<h4>Consum de l´Aigua en m³</h4>";
        print "<table class=\"table table-bordered\">\n";
        
        // Obtenemos los nombres de los campos
        print "<tr>\n";
        print "<th>Temporada Aigua</th>\n";
        print "<th>Total m³</th>\n";
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
        
    }
    
    public function showTableCostAny($temporadas){
        
        $sql = "SELECT temporada,SUM(totalf)/SUM(consum_tram1+consum_tram2+consum_tram3)
                FROM pspv_schema.consumsaigua
				WHERE temporada IN ";
        $sql = createIncludeTemporadas($sql, $temporadas);
        $sql .= " GROUP BY 1 ORDER BY 1;";
        
        try{
            $result = pg_query($sql);
        } catch (Exception $e){
            $msg = "[ERR] Error en función costXAnysAigua. MSG: ".pg_last_error($this->connection)."\n";
            errorLog($msg);
        }
        print "<h4>Preu mig ponderat de l´aigua</h4>";
        print "<table class=\"table table-bordered\">\n";
        // Obtenemos los nombres de los campos
        print "<tr>\n";
        print "<th>Temporada</th>\n";
        print "<th>Preu mig ponderat €</th>\n";
        print "</tr>\n";
        
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
    }

    public function dataConsumToArrayGraph($temporada,$consumo){
        
    	error_reporting(0);
        
        $pre_sql = "";
        $pre_group = "";
        $pre_where = "";
        
        $pre_sql = "SELECT temporada,mes,SUM(consum_tram1+consum_tram2+consum_tram3)
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
    
    public function dataCostToArrayGraph($temporada,$consumo){
        error_reporting(0);
        $pre_sql = "";
        $pre_group = "";
        $pre_where = "";
        
        $pre_sql = "SELECT temporada,mes,SUM(totalf)/SUM(consum_tram1+consum_tram2+consum_tram3)
                            FROM pspv_schema.";
        $pre_group =  " GROUP BY 1,2
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
            try{
            	$fichero = fopen($pathfile,"w");
            }catch (ErrorException $a){
            	$msg = "[ERR] Fallo al abrir el fichero Agua con los datos actuales:  ".$a->getMessage();
            	errorLog($msg);
            }            
            
        }catch(Exception $e){
            $msg = "[ERR] Fallo al crear el fichero Agua con los datos actuales:  ".$e->getMessage();
            errorLog($msg);
        }
        
        echo '<h6>Processant informació: '.$tipo.'</h6>';
        //Rellenando fichero con los datos actuales
        $cabecera = "Temporada,Mes,Consum_Tram1,Consum_Tram2,Consum_Tram3,Total Factura"."\n";
        fwrite($fichero,$cabecera);
        
        while($row = pg_fetch_assoc($result)){
            $string = 	$row['temporada'].",".$row['mes'].",".$row['consum_tram1'].",".	$row['consum_tram2'].",".$row['consum_tram3'].",".$row['totalf']."\n";
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
        
        try{
        	$salida = system($cmd,$retval);
        }catch(ErrorException $e){
        	$msg = "[ERR] Fallo al crear el backup de la tabla: ".$this->table_name." Fecha: " .$GLOBALS['date']."\n";
        	errorLog($msg);
        	die($msg);
        }
        
        
//         if ($retval != 0){
//             $msg = "[ERR] Fallo al crear el backup de la tabla: ".$this->table_name." Fecha: " .$GLOBALS['date']."\n";
//             errorLog($msg);
//             die($msg);
//         }
        
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
            $consum_1   = floatval($val['Consum_Tram1']);
            $consum_2   = floatval($val['Consum_Tram2']);
            $consum_3   = floatval($val['Consum_Tram3']);
            $totalf     = floatval($val['Total Factura']);
            
            $cmd = 'INSERT INTO pspv_schema.'.$this->table_name.'(mes,temporada,consum_tram1,consum_tram2,consum_tram3,totalf) ';
            $cmd .= 'VALUES (\''.$mes.'\','.$temporada.','.$consum_1.','.$consum_2.','.$consum_3.','.$totalf.');';            
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
    
    public function showUpdateForm($id, $mes, $any, $p1, $p2, $p3, $totalf){
    	echo '    			
			<script type="txt/javascript">    			   		
				$(document).ready(function (){    			
 					$("#btnAigua").on("click",function(){
 						var mes = $("#selmes").val();
  						var any = $("#selany").val();
 						var p1 = $("#p1").val();
  						var p2 = $("#p2").val();
  						var p3 = $("#p3").val();
 						var totalf = $("#totalf").val();
 						var tipo = "Aigua";
						var id = '.$id.';	
    			
 						$.ajax({
								   type: "POST",
								   data: {id:id,mes:mes,temporada:any,p1:p1,p2:p2,p3:p3,totalf:totalf,tipo:tipo},
      						       url: "../Ajax_Reception_PHP/updateData.php",
      						       success: function(msg){
      						           $("#responseInsert").html(msg);
      						       }
      					});
 					});
 				});
    			
			</script>
		<div class="col-md-12" id="contenedorAigua">
			<h3 id="cabecera-formulario">Actulització de dades en el formulari Aigua</h3>
				<form role="form" action="./insercion/ins_agua.php" method="POST">
					<div class="col-md-12 col">
						<div class="form-group">
							<div class="col-md-8 col">
								<div class="col-md-4 col">
									<h4>Mes</h4>
				   						<input class="form-control" id="selmes" type="text" name="MEs" value="'.$mes.'" required="required">

								</div>
								<div class="col-md-4 col">
									<h4>Any</h4>
										<input class="form-control" type="number" id="selany" name="anya" min="2022" max="2030" value="'.$any.'" required="required">
								</div>
							</div>
							<div class="col-md-9 col">
								<div class="col-md-3 col">
									<h4>Tram 1</h4>
										<input class="form-control" id="p1" type="float" name="p1" value="'.$p1.'">
								</div>
								<div class="col-md-3 col">
										<h4>Tram 2</h4>
										<input class="form-control" id="p2" type="float" name="p2" value="'.$p2.'">
								</div>
								<div class="col-md-3 col">
									<h4>Tram 3</h4>
										<input  class="form-control" id="p3" type="float" name="p3" value="'.$p3.'">
								</div>
							</div>
							<div class="col-md-8 col">
								<h4>Total Factura</h4>
									<input class="form-control type="float" id="totalf" name="totalf" value="'.$totalf.'">
							</div>
							<div class="col-md-9 col">
								<h4>Enviar a la Base de Dades</h4>
									<input class="form-control btn btn-primary" id="btnAigua" name="submit" value="Enviar dades">
							</div>
							<br>
							<br>
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

 					$("#btnAigua").on("click",function(){
 						var mes = $("#selmes").val();
  						var any = $("#selany").val();
 						var p1 = $("#p1").val();
  						var p2 = $("#p2").val();
  						var p3 = $("#p3").val();  						
 						var totalf = $("#totalf").val();
 						var tipo = "Aigua";

 						$.ajax({
								   type: "POST",
								   data: {mes:mes,any:any,p1:p1,p2:p2,p3:p3,totalf:totalf,tipo:tipo},
      						       url: "../Ajax_Reception_PHP/insertData.php",								      						      
      						       success: function(msg){
      						           $("#responseInsert").html(msg);
      						       }
      					});
 					});
 				});
          							 
			</script>
		<div class="col-md-12" id="contenedorAigua">
			<h3 id="cabecera-formulario">Inserció de dades en el formulari Aigua</h3>
				<form role="form" action="./insercion/ins_agua.php" method="POST">
					<div class="col-md-12 col">
						<div class="form-group">
							<div class="col-md-8 col">
								<div class="col-md-4 col">
									<h4>Mes</h4>
					   					<select class="form-control" id="selmes" name="mesosa" required="required" >
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
										<input class="form-control" type="number" id="selany" name="anya" min="2022" max="2030" required="required">
								</div>
							</div>
							<div class="col-md-9 col">
								<div class="col-md-3 col">
									<h4>Tram 1</h4>
										<input class="form-control id="p1" type="float" name="tram1" value="0">
								</div>
								<div class="col-md-3 col">
										<h4>Tram 2</h4>
										<input class="form-control id="p2" type="float" name="tram2" value="0">
								</div>
								<div class="col-md-3 col">
									<h4>Tram 3</h4>
										<input  class="form-control" id="p3" type="float" name="tram3" value="0">
								</div>
							</div>
							<div class="col-md-8 col">							
								<h4>Total Factura</h4>
									<input class="form-control type="float" id="totalf" name="totalf">
							</div>
							<div class="col-md-9 col">
								<h4>Enviar a la Base de Dades</h4>
									<input class="form-control btn btn-primary" id="btnAigua" name="submit" value="Enviar dades">	
							</div>
							<br>
							<br>
						</div>
					</div>
				</form>
			</div>
			<div class="col-md-8 col" id="responseInsert"></div>
		';
    	$this->last_insert();
//     	$preu = new Preu($db);
//     	$preu->showLastPreus();
    }
    
    public function insertOneData($mes,$any,$p1,$p2,$p3,$totalf){
    	$temporada  = $any;
    	$consum_1   = floatval($p1);
    	$consum_2   = floatval($p2);
    	$consum_3   = floatval($p3);
    	$totalf     = floatval($totalf);
    	
    	$cmd = 'INSERT INTO pspv_schema.'.$this->table_name.'(mes,temporada,consum_tram1,consum_tram2,consum_tram3,totalf) ';
    	$cmd .= 'VALUES (\''.$mes.'\','.$temporada.','.$consum_1.','.$consum_2.','.$consum_3.','.$totalf.');';
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
    		echo "<h6>Dades Aigua insertades correctament</h6>";
    	}
    	
    }
    
    public function updateData($id,$mes,$any,$p1,$p2,$p3,$totalf){
    	$temporada  = $any;
    	$consum_1   = floatval($p1);
    	$consum_2   = floatval($p2);
    	$consum_3   = floatval($p3);
    	$totalf     = floatval($totalf);

    	$cmd = 'UPDATE pspv_schema.'.$this->table_name.' SET 	mes = \''.$mes.'\', temporada = \''.$temporada.'\',
																consum_tram1 = \''.$consum_1.'\', consum_tram2 = \''.$consum_2.'\',
																consum_tram3 = \''.$consum_3.'\', totalf = \''.$totalf.'\'
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
    		echo "<h6>Dades Aigua insertades correctament</h6>";
    	}
    	
    }
    
    
    
    
}