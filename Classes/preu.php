<?php

##########################
#@autor: Raúl Olmedo
#@date: 24-03-20
#@file: preu.php
#@function: This script contain Class Preu. Per fer les diferents conversións necessàries i ja planificades amb anterioritat.
###########################

include '../config/core.php';
include '../config/globals.php';

class Preu{
    
    private $connection;
    private $table_name = "conversio_preus";
    
    //Propierties
    public $id;
    public $tipus;
    public $consum;
    public $cantitat;
    public $descripcio;
    
    //Constructor
    public function __construct($db){
        $this->connection = $db;
    }
    
    public function createCSVFile($result){
        
        try {
            $pathfile = "/var/www/ConsumsPSPV/CSV/file_conversio_preus.csv";
            $file = fopen($pathfile,"w");
            
        }catch(Exception $e){
            $msg = "[ERR] Fallo al crear el fichero de consumo";
            errorLog($msg);
        }
        
        echo '<h6>Creació del fitxer de conversió de preus</h6>';
        $cabecera = "Id,Tipus,Consum,Cantitat,Descripció";
        fwrite($file, $cabecera);
        
        while($row = pg_fetch_assoc($result)){
            $string = $row['id'].",".$row['tipus'].",".$row['consum'].",".$row['cantitat'].",".$row['descripcio'];
            fwrite($file, $string);
        }
        
        print '<a href="CSV/file_conversio_preus.csv" class="btn btn-primary" role="button"><h4>Descarrega Fitxer Preus</h4></a>';
        fclose($file);
    }
    
    public function showLastPreus(){
        
        $sql = "SELECT * FROM pspv_schema.";
        $sql .= $this->table_name;
        
        $result = pg_query($sql);
        
        print "<table class=\"table table-bordered table-striped\">\n";
        // Obtenemos los nombres de los campos
        
        print "<tr>\n";
        
        print "<th>Id</th>\n";
        print "<th>Tipo</th>\n";
        print "<th>Nom</th>\n";
        print "<th>Preu</th>\n";
        print "<th>Descripció</th>";
        
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
        $this->createCSVFile($result);
        
    }       
}