 <?php

###
#
# Script para la creación de los usuarios que tendrán acceso en primera instancia, y que serán capaces de crear más usuarios.
#
###
 
 require 'globals.php';
 require 'database.php';
 require 'core.php';
 
 //Conexión, consultas e inserciones
 $database = new Database();
 $db = $database->getConnection();

 $usernick      = "oguerrero";
 $username      = "Boss Bayona";
 $userpassword  = "5325csd$$";
 $usermail      = "oguerrero@perevirgili.cat";

 define('Session Email',$usermail);
 

 // Filtro anti-XSS
 // TODO investigar y docmentar anti-XSS
 // Ejemplo para mysql
 // $userPOST = htmlspecialchars(mysqli_real_escape_string($conexion, $userPOST));
//var_dump($username);

// $username      = htmlspecialchars(pg_prepare($db, $username));
// $userpassword  = htmlspecialchars(pg_prepare($db, $userpassword));
// $useremail     = htmlspecialchars(pg_prepare($db, $usermail));

// var_dump($username);
 // Comprobamos los valores, si se superan el resto del código muere y muestra una respuesta.
 if(strlen($usernick) > $GLOBALS['Max Chars nickUser']){

     die($GLOBALS['Fail maxCharnickUser']);
 }

 if(strlen($userpassword) > $GLOBALS['Max Chars passwd']){

     die($GLOBALS['Fail maxCharpasswd']);
 }

 if(strlen($usermail) > $GLOBALS['Max Chars email']){

     die($GLOBALS['Fail maxCharemail']);
 }
 if(strlen($username) > $GLOBALS['Max Chars nameUser']){
     die($GLOBALS['Fail maxusername']);

 }

 // Queremos que en la base de datos todos los usuarios su nick con minúsculas.
 // Pasamo el contenido de username a minúsculas
 $usernameMinus = strtolower($usernick);

 // Users in Db
 $sqlUsersInDb =    "SELECT userid FROM pspv_schema.users WHERE userid ='$usernameMinus'";
 $sqlEmailsinDb =    "SELECT email FROM pspv_schema.users WHERE email ='$usermail'";

 $resultUsers = pg_query($db,$sqlUsersInDb) or die(pg_errormessage($db));
 $resultEmails = pg_query($db,$sqlEmailsinDb) or die(pg_errormessage($db));

 $arrayUsers = pg_fetch_array($resultUsers);
 $arrayEmails = pg_fetch_array($resultEmails);

// Si los input estan vacíos, mostramos un mensaje de error.
// Si el valor de usuario es igual a alguno en la base de dato, mostramos un mensaje de error.
//
 if(empty($usernameMinus) || empty($userpassword || empty($usermail))){
     //Mensaje de error, las variables están vacías
     echo $usernameMinus;
     echo $userpassword;
     echo $usermail;
     die($GLOBALS['Fail IData loginForm']);


 }else if($usernameMinus == $arrayUsers["userid"]){

     die($GLOBALS['Fail Input User']);

 }else if($usermail == $arrayEmails["email"]){

     die($GLOBALS['Fail Input Email']);


 }else {

     // Si no hay errores procedemos a encryptar la contraseña
     $random = randomChars();
     $valor = "07";
     $salto = "$2y$".$valor."$".$random."$";
     $passConSalto = crypt($userpassword,$salto);

     $sqlInsertUsers = "INSERT INTO pspv_schema.users(userid,password,fullname,email) VALUES('$usernameMinus','$passConSalto','$username','$usermail')";


     // Si los datos son introducidos de forma correcta los mostramos, sino mostramos un mensaje de error

     if( pg_send_query($db,$sqlInsertUsers)){
        die('
            Registrado con éxito <br>
            Ya puedes acceder a tu cuenta <br>
            <br>
            Datos:<br>
            Usuario: '.$usernick.'<br>
            Contraseña: '.$passConSalto);

     } else {

         die($GLOBALS['Fail INTO DB loginFrom']);
         
     };

 };
 ?>
