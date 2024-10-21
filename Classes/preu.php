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
    public $tipus;
    public $consum;
    public $cantitat;
    public $descripcio;
    
    //Constructor
    public function __construct($db){
        $this->connection = $db;
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
       // print "<a href=\"Ajax_Reception_PHP/form_preu.php\" class='btn btn-primary' role='button'><h4>Insertar nou preu</h4></a>";
    }       
}
