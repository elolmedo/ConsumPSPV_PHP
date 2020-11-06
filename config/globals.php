<?php

    //FECHA
    $GLOBALS['date']                   = date("d/m/Y h:i:sa");

    //Nombre de Usuario
    
    #$GLOBALS['Session usernick'] = $usernick;
    
    // Años de Datos
    $GLOBALS['yearsData']               = ["2013","2014","2015","2016","2017"];
   
    //Carácteres máximos
    $GLOBALS['Max Chars nickUser']      = "100";
    $GLOBALS['Max Chars nameUser']      = "200";
    $GLOBALS['Max Chars passwd']        = "16";
    $GLOBALS['Max Chars email']         = "200";
    $GLOBALS['Max Chars phone']         = "15";
    
    //Archivos de log
    $GLOBALS['log_file']                = fopen('/var/www/ConsumsPSPV/consumPSPV.log','a');
    $GLOBALS['log_db']                  = fopen('/var/www/ConsumsPSPV/errorbd.log','a');
    
    //Errores
    $GLOBALS['Fail Connect']            = "Fallo de conexión";
    $GLOBALS['Fail maxCharnickUser']    = 'El nombre de usuario no puede tener más de '.$GLOBALS['Max Chars nickUser'].' caracteres';
    $GLOBALS['Fail maxCharpasswd']      = 'La contraseña no puede tener más de ' .$GLOBALS['Max Chars passwd'].' caracteres';
    $GLOBALS['Fail maxCharemail']       = 'El email no puede tener más de '.$GLOBALS['Max Chars email'].' caracteres';
    $GLOBALS['Fail maxusername']        = 'El nombre de usuario no puede tener más de '.$GLOBALS['Max Chars nameUser'].' caracteres';
    $GLOBALS['Fail maxcharphone']       = 'El telefono no puede tener más de '.$GLOBALS['Max Chars phone'].' caracteres';
    $GLOBALS['Fail IData loginForm']    = 'Formulario de registro!! Debes introducir datos válidos';
    $GLOBALS['Fail Input User']         = 'Ya existe una usuario con el nick, debes introducir un nombre de usuario válido';
    $GLOBALS['Fail Input Email']        = 'Ya existe una usuario con el email, debes introducir un email válido';
    $GLOBALS['Fail INTO DB loginFrom']  = 'Error en formulario de registro, al insertar los datos en la bd';
    $GLOBALS['Fail Update User']        = 'Error al actualizar los datos del usuarios';
    $GLOBALS['Fail Function returnUser']= 'Error en la función returnUser';
    $GLOBALS['Fail Elimination Players']= 'Error al eliminar los jugadores';
    $GLOBALS['Fail Elimination User']   = 'Error eliminado el usuario';
    $GLOBALS['null_point']              = "Campo Vació";

?>