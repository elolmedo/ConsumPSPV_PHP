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
                                <li id="list" role="presentation"><a href="../index.php?namemenu=insercio">Inserció Automàtica</a></li>
                                <li id="list" role="presentation"><a href="../index.php?namemenu=lastinsert">Últimes insercions</a></li>
                                <li id="list" role="presentation"><a href="../index.php?namemenu=predict">Predicció</a></li>
                                <li id="list" role="presentation"><a href="../index.php?namemenu=tutorial">Com Funciona</a> </li>
                                <li id="list" role="presentation"><a href="../index.php?namemenu=contact">Contacte</a></li>
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
            	        }else if ($posicionmenu == "predict"){
            	            include 'prediccio.php';
            	        }
               ?>
				
                 
               </div>
            </div>
    	</body>
    	
    </html>