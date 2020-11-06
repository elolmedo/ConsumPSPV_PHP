<script>
	$("#homeImage").hide();						  
</script>
<!-- Formulario para la elección del tipo de Consumo-->
<div id="Consumos_principal" class="col col-md-12">
	<div id="Tipus_de_Consum">
		<h3>Tipus de Consum</h3>
		<hr>
	</div>
	<div class="col col-md-4">
		<form name="tipoconsumo" method="POST">
			<select class="form-control" id="sel_tipus_insercio" name="insercio" required="required">
				<option>Gas Natural</option>
				<option>Oxigen Ampolles</option>
				<option>Oxigen</option>
				<option>Electricitat</option>
				<option>Aigua</option>
 			</select> 
 			<input class="btn btn-primary"  id="btn_tipus_insercio" type="button" name="submit"
 			value="Triar Formulari Consum" onclick="insertData(); insertPreu();">
		</form>
	</div>
	<div class="col col-md-8" id="insertPreu">
	
	</div>
	<div class="col col-md-8" id="autoInsert">
    	<div class="col col-md-4">
    		<image class="img-rounded img-responsive" src="../images/png/pspv.png">
                    <a>Heu de triar un <b>tipus de Consulta</b> (Consum o PMP) i un <b>tipus de consum</b>, en aquest
                        cas<br>Electricitat, Aigua o Oxigen</a>
    	</div>
	</div>
	
	<div class="col col-md-8" id="dataInsert">
	
	</div>
</div>





