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

    require 'config/core.php';
?>
<script>
	$("#homeImage").hide();						  
</script>
<div id="Totals_1" class="col col-md-12">
	<h3>Totals</h3>
	<hr>

    <div id="TotalesForm1" class="col col-md-4">
    <!-- Formulario para la elección del tipo de Consumo-->
        <div id="Form1totales" xmlns="http://www.w3.org/1999/html">
            <h5>Selecció de dades</h5>
            <hr>
            <div class="form-group">                
                <form name="form1" style="display:inline" method="POST">                    
                    <h6>Tipus de consulta</h6>
                	<!-- <label class="radio-inline" name="ratio_form1" id="Consum"><input type="radio" name="consulta" value="consum">Consum</label>
                	<label class="radio-inline" name="ratio_form1" id="Consum"><input type="radio" name="consulta" value="pmp">PMP </label> -->
                	
                 	<select class="form-control" id="sel_tipus" name="consulta"  value="Consum" required="required"> 
                 		<option>Consum</option> 
                		<option>PMP</option> 
                 	</select>                          	
                    <hr>                   
        			<h6>Tipus de Consum</h6>        							
                    <select class="form-control" id="sel_consum" name="consum" value="Oxigen"   required="required">
     					<option>Oxigen</option> 
     					<option>Electricitat</option> 
     					<option>Aigua</option>     					
     				</select> 
                    <hr>
                    <!-- Input de los años que tiene almacenados la BD para los consumos de Electricidad -->
                       	<?php 
                       	    createYears();
                       	?>
                    <div style="text-align:center; margin-top:5%;">        
                    	<input  class="btn btn-primary" type="button" name="btn_1" value="Triar Formulari Consum" onclick="MostrarTabla1(); CreateGraph1();" />
                    </div>        
                </form>
                <br>
            </div>
        </div>    
    </div>
    <div id="TotalesTablas" class=" col col-md-8">
        <div id="tablasAjax_Consumos1" class="col col-md-4">
            <image class="img-rounded img-responsive" src="../images/png/pspv.png">
                <a>Heu de triar un <b>tipus de Consulta</b> (Consum o PMP) i un <b>tipus de consum</b>, en aquest
                    cas<br>Electricitat, Aigua o Oxigen</a>
    
        </div>
    </div>
    <div class="col col-md-4"></div>
    <div class="bar col col-md-8">
        <div id="curve_chart" ></div>
    </div>

</div>



