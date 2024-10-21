<?php
/**
 * Created by PhpStorm.
 * User: badrom
 * Date: 21/03/17
 * Time: 14:14
 */

// include '/var/www/ConsumsPSPV/php_functions/functions.php';
require  '../config/globals.php';
require '../config/database.php';

$database = new Database();
$db = $database->getConnection();

$username = $_POST["user"];
$upass = $_POST["passwd"];


if(strlen($username) > $GLOBALS['Max Chars nameUser']){

    die($GLOBALS['Fail maxusername']);
}

if(strlen($upass) > $GLOBALS['Max Chars passwd']){

    die($GLOBALS['Fail maxCharpasswd']);
}

$usernameMinus = strtolower($username);

$sqlUsersInDb =    "SELECT * FROM pspv_schema.users WHERE userid ='$usernameMinus'";

$resultUser = pg_query($db, $sqlUsersInDb);

$arrayUser = pg_fetch_array($resultUser);

$nick = $arrayUser["userid"];
$userid = $arrayUser["id"];
$pass = $arrayUser["password"];

if($nick == $usernameMinus and password_verify($upass,$pass)){

    session_start();
    $_SESSION['usuario'] = $nick;
    $_SESSION['estado'] = 'Autorizado';
    $_SESSION['password'] = $pass;
    $_SESSION['userid'] = $userid;
    
    echo $_SESSION['usuario'];
    
    if ($_SESSION['usuario'] == "amiguez"){
    	
    	echo '	<script>
                	document.location.href = "../layouts/view.php";
            	</script>
		';
    	
    }else{
    	
    	echo '	<script>
                	document.location.href = "../layouts/fullview.php";
            	</script>
		';
    	
    }


}else if ($nick != $usernameMinus || $username == "" || $upass == "" || !password_verify($upass,$pass)){
    echo "<script>
            $(\".acceso\").val(\"\");
            alert('Los datos de acceso son incorrectos')
        </script>
          ";
    die('');
}else{
    echo "<script>
            $(\".acceso\").val(\"\");
            alert('[ERR] conexión fallida. Pongáse en contacto con el administrador')
        </script>
          ";
    die('Error!!!');
}
