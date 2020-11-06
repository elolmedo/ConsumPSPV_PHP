<?php

##########################
#@autor: Raúl Olmedo
#@date: 20-03-20
#@file: oxigenTank.php
#@function: This script contain Class Oxigen Tank.
###########################

include '../config/core.php';
include '../config/globals.php';

class OxigenTank{
    
    private $connection;
    private $table_name = "consumoxiflow_tank";
    
    //Propierties
    public $mes;
    public $temporada;
    public $consumTank;
    public $idpreu;
    
    //Constructor
    public function __construct($db){
        $this->connection = $db;
    }
    
    public function last_insert($consumo){
        $sql = "	SELECT id,temporada,mes,consum_tank,id_preu FROM pspv_schema.".$this->table_name."
				    ORDER BY id DESC
				    LIMIT 3";
        
        $result = pg_query($sql);
        
        print "<div class=\"col-md-6\">\n";
        print "<h4>Oxigen Tank / Ultimes insercions</h4>";
        print "<table class=\"table table-bordered table-striped\">";
        // Obtenemos los nombres de los campos
        print "<tr>\n";
        print "<th>Id</th>\n";
        print "<th>Any</th>\n";
        print "<th>Mes</th>\n";
        print "<th>Consum tank</th>\n";
        print "<th>Id Preu</th>\n";
        
        print "</tr>\n";
        
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
        print "</div>"."\n";
    }
    
    public function showTableConsumAny($temporadas){
        $sql = "SELECT temporada, SUM(consum_tank)
                FROM pspv_schema.consumoxiflow_tank
				WHERE temporada IN ";
        $sql = createIncludeTemporadas($sql, $temporadas);
        $sql .= " GROUP BY 1 ORDER BY 1;";
        
        try{
            $result = pg_query($sql);
            
        } catch (Exception $e){
            $msg = "[ERR] Error en función consumXAnysOxigenTank. MSG: ".pg_last_error($this->connection)."\n";
            errorLog($msg);
        }
        print "<h4>Consum de Oxigen Tank m³</h4>";
        print "<table class=\"table table-bordered\">\n";
        
        // Obtenemos los nombres de los campos
        print "<tr>\n";
        print "<th>Temporada Oxigen Tank</th>\n";
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
        $sql = "SELECT temporada, (SUM(t.consum_tank)*p.cantitat)/1000
                FROM pspv_schema.consumoxiflow_tank t, pspv_schema.conversio_preus p
				WHERE t.id_preu = p.id
				AND temporada IN ";
        $sql = createIncludeTemporadas($sql, $temporadas);
        $sql .= "GROUP BY t.temporada, p.cantitat
				 ORDER BY 1;";
        
        try{
            $result = pg_query($sql);
        } catch (Exception $e){
            $msg = "[ERR] Error en función costXAnyOxigenTank. MSG: ".pg_last_error($this->connection)."\n";
            errorLog($msg);
        }
        print "<h4>Cost de Oxigen Tank €</h4>";
        print "<table class=\"table table-bordered\">\n";
        
        // Obtenemos los nombres de los campos
        print "<tr>\n";
        print "<th>Temporada Oxigen Tank</th>\n";
        print "<th>Total €</th>\n";
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
    
    public function dataConsumToArrayGraph($temporada,$consumo){
        
        $pre_sql = "";
        $pre_group = "";
        $pre_where = "";
        
        $pre_sql = "SELECT temporada,mes,consum_tank
                            FROM pspv_schema.";
        $pre_group = " ORDER BY mes='Decembre', mes='Novembre',mes='Octubre', mes='Septembre', mes='Agost', mes='Juliol', mes='Juny',mes='Maig',mes='Abril',mes='Març',mes='Febrer',mes='Gener' asc;";
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
        
        $arr[$temporada] = array($gener,$febrer,$marzo,$abril,$maig,$juny,$juliol,$agost,$septembre,$octubre,$novembre,$decembre);
        return $arr;
      
        
    }

    public function dataCostToArrayGraph($temporada,$consumo){
        
        $pre_sql = "";
        $pre_group = "";
        $pre_where = "";
        $pre_relation = "";
        $post_where = "";
        
        $pre_sql = "SELECT temporada,mes,(consum_tank*p.cantitat)/1000
                            FROM pspv_schema.";
        $pre_relation = ", pspv_schema.conversio_preus p";
        $pre_group = "  GROUP BY 1,2,3
        				        ORDER BY mes='Gener',mes='Febrer',mes='Març',mes='Abril',mes='Maig',mes='Juny',mes='Juliol',mes='Agost',mes='Septembre',mes='Octubre',mes='Novembre',mes='Decembre';";
        $pre_where = " WHERE id_preu = p.id";
        $post_where = " AND temporada = ";
        
        $sql = "";
        $sql .= $pre_sql;
        $sql .= $this->table_name;
        $sql .= $pre_relation;
        $sql .= $pre_where;
        $sql .= $post_where;
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
        $cabecera = "Temporada,Mes,Consum_Tank,id_preu"."\n";
        fwrite($fichero,$cabecera);
        
        while($row = pg_fetch_assoc($result)){
            $consumo = floatval($row['consum_tank']);
            $string = 	$row['temporada'].",".$row['mes'].",".$consumo.",".$row['id_preu']."\n";
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
        $cmd = 'PGPASSWORD="R458V90Rcxa3389563" pg_dump --host localhost --port 5432 --username rom_pspv --data-only --format plain --verbose --file /var/www/ConsumsPSPV/CSV/oldData/copia_'.$tabla_consumo.'.sql --table pspv_schema.'.$tabla_consumo.' pspv_db 2>&1';
        
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
            $consum_tank    = floatval($val['Consum_Tank']);
            $id_preu        = intval($val['id_preu']);
            
            $cmd = 'INSERT INTO pspv_schema.'.$this->table_name.'(mes,temporada,consum_tank,id_preu) ';
            $cmd .= 'VALUES (\''.$mes.'\','.$temporada.','.$consum_tank.','.$id_preu.');';
            
            $res = pg_query($db,$cmd);
            
            if(!$res){
                $msg = "[ERR] Fallo: los datos no fueron insertados: ". pg_last_error($this->connection)." Fecha :".$GLOBALS['fecha']."\n";
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
}