<?php

//Reanudamos la sesión
session_start();
if(!isset($_SESSION['usuario']) and $_SESSION['estado'] != 'Autorizado'){
    echo 'Mal inicio de sesión;';
    header('Location: ../index.php');
}else{
    
    $usernick = $_SESSION['usuario'];
    $userpass = $_SESSION['password'];
    
    require ('/var/www/ConsumsPSPV/config/sesiones.php');
    
}

?>

 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">
        <head>
            <title>Consums Parc Sanitari Pere Virgili</title>
            <link rel="stylesheet" type="text/css" href="../css/principal.css" />
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"></link>
            
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
            <script type="text/javascript" src="../js_functions/functions.js"></script>
            <!-- Datatable Framework -->
<!--     		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.5/date-1.1.2/sc-2.0.5/datatables.min.css"/> -->
<!-- 			<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.5/date-1.1.2/sc-2.0.5/datatables.min.js"></script> -->			
			
			<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.13.1/b-2.3.2/datatables.min.js"></script>
			<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.13.1/b-2.3.2/sl-1.5.0/datatables.min.js"></script>
			<script type="text/javascript" src="https://cdn.datatables.net/select/1.5.0/js/dataTables.select.min.js"></script>
			<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"</script>			
			<script type="text/javascript" src="https://editor.datatables.net/extensions/Editor/js/dataTables.editor.min.js"></script>
						
			
			<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css"/>
			<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.13.1/b-2.3.2/datatables.min.css"/>
			<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.13.1/b-2.3.2/sl-1.5.0/datatables.min.css"/>
			
            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>            
     		<script type="text/javascript">
      	      google.charts.load('current', {'packages':['corechart','controls']});
              google.charts.load('current', {'packages':['table']});
              google.charts.load("current", {'packages': ['bar']});
              google.charts.load('current', {'packages': ['corechart'], 'callback': LineChart});
              google.charts.load('current', {'packages': ['corechart'], 'language': 'es'});
      		</script>
            <script>
        		$(document).ready(function(){
            		$(".dropdown-toggle").dropdown();            		                 
        		});

        		 $(document).ready(function (){
     				$('#buttonType').on('click',function(){
     					var tipo = $('#sel_tipus_insercio') .val();
     					if (tipo == ""){
     						alert("Error no se ha seleccionado ningún tipo de consumo");
     					}else{
     						$.post({
     						       url: "../Ajax_Reception_PHP/ajaxforms.php?tipo="+tipo,
     						       type: "POST",
     						       dataType: "HTML",
     						       cache: false,
     						       contentType: false,
     						       processData: false,
     						       success: function(data){
     						           $('#divforms').html(data);
     						       }
     						   });
     					}
     				});
     			});        	
    		</script>
    		
        </head>
    	<body>
        	<div class="container col-md-12">
        		<!-- Cabecera dd-->
        		 <div class="panel panel-primary">
    		         <div class="sidebar-nav">
                        <nav class="navbar navbar-inverse  navbar-fixed nav-justified navbar-fixed-top">
                            <div class="navbar-header">
                                <img class="navbar-brand" src="../images/png/pspv.png" href="../index.php">
                            </div>
                            <ul id="listaOpciones" class="nav navbar-nav">
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle"  id="totals" type="button" data-toggle="dropdown" >Creació de Grafiques<span class="caret"></span></a>
                
                                  <ul class="dropdown-menu" role="menu" aria-labelledby="totals">
                                        <li id="list" role="presentation"><a role="menuitem" tabindex="-1" href="../index.php?namemenu=creacioGraph">Electricitat - Oxigen - Aigua</li>
                                        <li id="list" role="presentation"><a role="menuitem" tabindex="-1" href="../index.php?namemenu=creacioGraphEdificis">Gas Natural - Oxiflow</a></li>
                                  </ul>
                                </li>                              
                                <li id="list" role="presentation"><a href="../index.php?namemenu=manual">Inserció Manual</a></li>
<!--                                <li id="list" role="presentation"><a href="../index.php?namemenu=insercio">Inserció Automàtica</a></li>-->
                                <li id="list" role="presentation"><a href="../index.php?namemenu=lastinsert">Últimes insercions</a></li>
<!--                                 <li id="list" role="presentation"><a href="../index.php?namemenu=predict">Predicció</a></li> -->
                                <li id="list" role="presentation"><a href="../index.php?namemenu=tutorial">Com Funciona</a> </li>
								<li id="list" role="presentation"><a href="../index.php?namemenu=contact">Contacte</a></li>
								<li id="list" role="presentation"><a href="../index.php?namemenu=exit">Tancar Sessió</a></li>
                            </ul>
                        </div>
                
                	</nav>
        		</div>
        	</div>

       			<div id="cuerpo" class="col col-md-12">
       				<div id="homeImage">
       					<img id="pspvImage" src="../images/png/pspv.png" href="../index.php"></img>
       				</div>
 			        <?php
                        error_reporting(E_ALL);

                        /*
                         * Agafem les dades del menu principal
                         */
            
                        $posicionmenu = isset($_GET['namemenu']) ? $_GET['namemenu'] : null ;
                    
                        if ($posicionmenu == "creacioGraph") {                        	
                        	include('makeGraph.php');             
                        }else if ($posicionmenu == "creacioGraphEdificis") {                        	
                           include('makeGraphEdificis.php');                           
                   	    }else if ($posicionmenu == "lastinsert"){                        	
            				include('lastinsert.php');          				
            	        }else if ($posicionmenu == "insercio"){            	        	
            	        	include 'insercioAutomatica.php';            
            	        }else if ($posicionmenu == "tutorial"){            
                            include 'tutorial.php';
            	        }else if ($posicionmenu == "contact"){
            	            include 'contacte.php';
            	        }else if ($posicionmenu == "manual"){
            	        	include 'tipoconsumo.php';
            	        }else if ($posicionmenu == "exit"){			
							$msg = "Cerrando Sessión Usuario: ".$_SESSION['usuario'];
			  		   		header_remove();
		     				unset($_SESSION);
				     		session_destroy();
		     				echo '	<script>document.location.href = "../index.php";</script>';
				     		die();
					}
               ?> 
               </div>
            </div>
    	</body>
    	
    </html>
