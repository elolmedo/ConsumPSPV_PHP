<?php
    //Iniciamos la sesión
    session_start();
    
    require ('/var/www/ConsumsPSPV/config/sesiones.php');
    
?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">
        <head>
            <title>Consums Parc Sanitari Pere Virgili</title>
            <link rel="stylesheet" type="text/css" href="../css/principal.css" />
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
            <script>
                $(document).ready(function() {
                    $('#accesoForm').on('submit', function (e) {
            
                        e.preventDefault();
            
                        var formData = new FormData(document.getElementById("accesoForm"));
            
                        $.ajax({
                            url: "../Ajax_Reception_PHP/access.php",
                            type: "POST",
                            dataType: "HTML",
                            data: formData,
                            cache: false,
                            contentType: false,
                            processData: false,
                            success: function (data) {
                                $('#respuesta').html(data);
                            }
                        });
                    });
                });
            </script>
            
        </head>
        <body>
        <div class="container">
  			<div class="header">
  				<h1>Consums PSPV <small>Menú Principal</small></h1><image class="img-rounded img-responsive logo" src="../images/png/pspv.png"></image>
  			</div>
            	<div id="boxlogin" class="cajas" tabindex="1">
                	<span>Login </span>
                	<form method="post" id="accesoForm" action="" accept-charset="utf-8">
                		<div class="form-group">
                        	<label for="user">Introduce el usuario: </label>
                            <input type="text" id="user" name="user" value="Insertar correo o nombre de usuario" required="required" placeholder="Usuario" autocomplete="off" maxlength="100">
                            <label for="passwd">Introduce la contraseña: </label>
                            <input type="password" id="passwd" name="passwd" placeholder="Password" autocomplete="off" maxlength="16">
                            <br>
                            <input type="submit" name="registro" class="btn btn-secondary" value="Registrarse">

                		</div>
                	</form>
                </div>
				<div id="respuesta" class="col-md-id"></div>
        </div>
        </body>
    </html>
    