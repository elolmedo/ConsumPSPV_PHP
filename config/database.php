<?php
###########################
##
#@autor: Raúl Olmedo
#@date: 20-30-20
##function: Class that contain differents method to connect database.
####
################################

include '../config/globals.php';
include '../config/core.php';

class Database{
    //Credentials for connection
    private $host = "localhost";
    private $db_name = "";
    private $db_port = "5432";
    private $db_user = "";
    private $db_pass = "";
    private $connection = "";
    public $conn;
    
    //get the database connection
    public function getConnection(){
        $this->conn = null;
        
        $this->connection = "host=".$this->host." ";
        $this->connection .= "port=".$this->db_port." ";
        $this->connection .= "dbname=".$this->db_name." ";
        $this->connection .= "user=".$this->db_user." ";
        $this->connection .= "dbname=".$this->db_name." ";
        $this->connection .= "password=".$this->db_pass."";
        
        try{
            $this->conn = pg_connect($this->connection) or die('Fail to connect');
            
        }catch (Exception $e){
            echo $e->getTraceAsString();
            $msg = "[ERR] Falló al conectar con la BD. Error: ".$e." Fecha: ".$GLOBALS['date']."\n";
            errorLog($msg);
            
        }
        ## 3 more checks
        if(!$this->conn){
            $msg = "[ERR] Error con la conexion en la base de datos ".$GLOBALS['date']. "\n";
            errorLog($msg);
            print "<h2 style=\"color:red;\">".$msg."</h2>";
        }
        
        $check2 = pg_get_result($this->conn);
        echo pg_result_error($check2);
        
        $check3 = pg_connection_status($this->conn);
        if ($check3 === PGSQL_CONNECTION_OK){
            $msg = "[INFO] Connect to Database established ".$GLOBALS['date']."\n";
            controlLog($msg);
        }
        return $this->conn;

    }
}
