 
<script>
	$("#homeImage").hide();						  
</script>
<div id="Totals_2" class="col-md-12">
	<h3>Totals con edificis</h3>
	<hr>    
    <div id="Form2totales" class="col-md-4">
            
            <h5>Selecció de dades per edificis<br> (només Gas Natural<br> i Ampolles Oxigen)</h5>
	    <hr>
	    
	    <div class="form-group">
	        <form name="form2" action="" method="POST" onload="formOnload()">
	            
	            <h6>Tipus de consulta</h6>
	            
	            	<select class="form-control" id="sel_tipus" name="consulta2" required="required"  value="Consum">
	            		<option>Consum</option>
	            		<option>PMP</option>
	            	</select>
	            <hr>
                    <h6>Tipus de Consum</h6>
                    <select class="form-control" id="sel_consum" name="consulta2" required="required"  value="Gas Natural" onchange="formOnload()">
                                <option>Gas Natural</option>
                                <option>Oxigen Ampolles</option>
                        </select>
	            <hr>

                   <h4>Edifici</h4>
                   <select class="form-control" id="sel_buid_gas" name="select_build_oxi" required="required"  value="Tramuntana">
                        <option>Gregal</option>
                        <option>Xaloc</option>
                        <option>Tramuntana</option>
                        <option>Puigmal</option>
                        <option>Suport</option>
                        <option>Totals</option>
                    </select>
                    <select class="form-control" id="sel_buid_oxi" name="select_build_oxi" style="display: none;" required="required" value="Gregal">
                        <option>Gregal</option>
                        <option>Xaloc</option>
                        <option>Llevant</option>
                        <option>Totals</option>
                    </select>
                    <hr>
                    <!-- Input de los años que tiene almacenados la BD para los consumos de Electricidad -->
                       <?php 
                            require 'config/core.php';                       
                       	    createYears();
                       	?>    
                    
                    <input class="btn btn-primary"type="button" name="bnt_2" value="Triar Formulari Consum" onclick="MostrarTabla2(); CreateGraph2();" />
	
	        </form>
	    </div> 
	</div>
	 <div id="TotalesTablas" class="col col-md-8">
        <div id="tablasAjax_Consumos2" class="col col-md-4">
            <image class="img-rounded img-responsive" src="../images/png/pspv.png">
                <a>Heu de triar un <b>tipus de Consulta</b> (Consum o PMP) i un <b>tipus de consum</b>, en aquest
                    cas<br>Electricitat, Aigua o Oxigen</a>
    
        </div>
    </div>
    <div class="bar col-md-8">

        <!--              <svg width="50" height="50">-->
        <!--                  <circle cx="25" cy="25" r="22"-->
        <!--                          fill="blue" stroke="gray" stroke-width="2"/>-->
        <!--              </svg>-->

        <div id="curve_chart"></div>
    </div>
</div>