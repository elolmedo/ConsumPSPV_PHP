<script>
	$("#homeImage").hide();						  
</script>
<div id="LastInsert_principal">
    <div id="LastInsert-title" class="col-md-12">
    <h3>Ultimes insercions</h3>
    <hr>
    </div>
    <div class="col col-md-4">
    <form name="lastinsert-form" method="POST">
    <select class="form-control" id="sel_last_insert" name="Linsert" required="required">
    <option>Gas Natural</option>
    <option>Oxigen Ampolles</option>
    <option>Oxigen</option>
    <option>Electricitat</option>
    <option>Aigua</option>
    </select>
    <input class="btn btn-primary" type="button" name="submit" value="Triar ultima inserció" onclick="lastinsterts()">
    </form>
    </div>
    <div id="LastInsert"></div>
    <br>
    <div id="formslastinserts">
    	 <div class="col col-md-4">
    	 	<image class="img-rounded img-responsive" src="../images/png/pspv.png">
                        <a>Heu de triar un <b>tipus de Consulta</b> (Consum o PMP) i un <b>tipus de consum</b>, en aquest
                            cas<br>Electricitat, Aigua o Oxigen</a>
    	 </div>
    
    </div>
</div>
