
<script type="text/javascript">
$("#homeImage").hide();		
var editor;
	$(document).ready(function(){
		$('#btn_lastinsert').on('click',function(){
			var consum = $('#sel_last_insert').val();
			if (consum == "Gas Natural"){
				$('#container_ampolles').hide();
				$('#container_tank').hide();
				$('#container_elec').hide();
				$('#container_aigua').hide();
				$('#container_gas').removeAttr("style").hide();
				$('#container_gas').show();

				$('#tabla_ord_gas_TRA').show();
// 				$.ajax({
// 					   type: "POST",				
// 				       url: '/Ajax_Reception_PHP/Ajaxlastinsert.php?lastinserts='+consum+'&edifici=TRA',								      						      
// 				       success: function(msg){
// 				           console.log(msg)
// 				       }
// 			});
				$('table.display').DataTable();
				
				 var table = $('#tabla_ord_gas_TRA').DataTable({
			    	"columnDefs": [
			            {"className": "dt-center", "targets": [0,1,2,3,4,5]}
			     	],
			        ajax:{"url":'/Ajax_Reception_PHP/Ajaxlastinsert.php?lastinserts='+consum+'&edifici=TRA', 'dataSrc':'GasNatural_TRA', "cache":false},			        		
			        contentType:"application/json", 	 						
				 	aadata:"GasNatural_TRA",				 		
				 	"paging": false,
				 	"searching":false,
				 	"info":false,
				 	select:true,
				 	"lengthChange": false,
					dom: 'Bftrip',	 		
				 	"bDestroy": true,
				 	select: true,
			
					columns:[
			 			{data:'Id',width:"3%"},
						{data:'Temporada',width:"10%"},
						{data:'Mes',width:"15%"},
						{data:'Edifici',width:"15%"},
						{data:'LecturaAnterior',width:"25%"},
						{data:'LecturaActual',width:"25%"},
					],
					buttons: [
				 		{
					 		text: "Editar",
					 		action: function (e, dt, node, config){
					 			var data = table.rows( { selected: true } ).data().each(element => console.log(element));					 			
					 			var data = table.rows( { selected: true } ).data();
					 								 			
								var id = data[0].Id;
								var temporada = data[0].Temporada;
								var mes = data[0].Mes;
								var edifici = data[0].Edifici;				
								var anterior = data[0].LecturaAnterior;
								var actual = data[0].LecturaActual;

								$.post({
	     						       url: "/Ajax_Reception_PHP/updateForms.php?id="+id+"&any="+temporada+"&mes="+mes+"&anterior="+anterior+"&actual="+actual+"&edifici="+edifici+"&tipo="+consum,	     						     	     						       
	     						       type: "POST",
	     						       dataType: "HTML",
	     						       cache: false,
	     						       contentType: false,
	     						       processData: false,
	     						       success: function(data){			
											$('#div_forms_gas').html(data);
											$("#div_image").hide();		
	     						       }
	     						   });
					 		}
						}						 							 		
			         ],
				});         	               	                		
			           
				var table2 = $('#tabla_ord_gas_GRE').DataTable({
			    	"columnDefs": [
			            {"className": "dt-center", "targets": [0,1,2,3,4,5]}
			     	],
			        ajax:{"url":'/Ajax_Reception_PHP/Ajaxlastinsert.php?lastinserts='+consum+'&edifici=GRE', 'dataSrc':'GasNatural_GRE', "cache":false},			        		
			            	contentType:"application/json", 	 						
				 			aadata:"GasNatural_GRE",				 						 			
				 			"lengthChange": false,
				 			dom: 'Bftrip',
				 			"paging": false,
						 	"searching":false,
						 	"info":false,
						 	select:true,
				 			"bDestroy": true, 	 			  
				 			columns:[
				 	 			{data:'Id',width:"3%"},
								{data:'Temporada',width:"10%"},
								{data:'Mes',width:"15%"},
								{data:'Edifici',width:"15%"},
								{data:'LecturaAnterior',width:"25%"},
								{data:'LecturaActual',width:"25%"},
							],
							buttons: [
						 		{
							 		text: "Editar",
							 		action: function (e, dt, node, config){
							 			var data = table2.rows( { selected: true } ).data().each(element => console.log(element));					 			
							 			var data = table2.rows( { selected: true } ).data();
							 								 			
							 			var id = data[0].Id;
										var temporada = data[0].Temporada;
										var mes = data[0].Mes;
										var edifici = data[0].Edifici;				
										var anterior = data[0].LecturaAnterior;
										var actual = data[0].LecturaActual;

										$.post({
			     						       url: "/Ajax_Reception_PHP/updateForms.php?id="+id+"&any="+temporada+"&mes="+mes+"&anterior="+anterior+"&actual="+actual+"&edifici="+edifici+"&tipo="+consum,	     						     	     						       
			     						       type: "POST",
			     						       dataType: "HTML",
			     						       cache: false,
			     						       contentType: false,
			     						       processData: false,
			     						       success: function(data){			
													$('#div_forms_gas').html(data);
													$("#div_image").hide();		
			     						       }
			     						   });
							 		}
								}						 							 		
					         ],		         	               	                		
			        });
		        
				var table3 = $('#tabla_ord_gas_XAL').DataTable({
			    	"columnDefs": [
			            {"className": "dt-center", "targets": [0,1,2,3,4,5]}
			     	],
			        ajax:{"url":'/Ajax_Reception_PHP/Ajaxlastinsert.php?lastinserts='+consum+'&edifici=XAL', 'dataSrc':'GasNatural_XAL', "cache":false},			        		
			            	contentType:"application/json", 	 						
				 			aadata:"GasNatural_XAL",				 		
				 		
				 		          "paging": false,
								 	"searching":false,
								 	"info":false,
								 	select:true,
				 			"lengthChange": false,
				 			dom: 'Bftrip',
				 		
				 			"bDestroy": true, 	 			  
				 			columns:[
				 	 			{data:'Id',width:"3%"},
								{data:'Temporada',width:"10%"},
								{data:'Mes',width:"15%"},
								{data:'Edifici',width:"15%"},
								{data:'LecturaAnterior',width:"25%"},
								{data:'LecturaActual',width:"25%"},
							],
							buttons: [
						 		{
							 		text: "Editar",
							 		action: function (e, dt, node, config){
							 			var data = table3.rows( { selected: true } ).data().each(element => console.log(element));					 			
							 			var data = table3.rows( { selected: true } ).data();
							 								 			
							 			var id = data[0].Id;
										var temporada = data[0].Temporada;
										var mes = data[0].Mes;
										var edifici = data[0].Edifici;				
										var anterior = data[0].LecturaAnterior;
										var actual = data[0].LecturaActual;

										$.post({
			     						       url: "/Ajax_Reception_PHP/updateForms.php?id="+id+"&any="+temporada+"&mes="+mes+"&anterior="+anterior+"&actual="+actual+"&edifici="+edifici+"&tipo="+consum,	     						     	     						       
			     						       type: "POST",
			     						       dataType: "HTML",
			     						       cache: false,
			     						       contentType: false,
			     						       processData: false,
			     						       success: function(data){			
													$('#div_forms_gas').html(data);
													$("#div_image").hide();		
			     						       }
			     						   });
							 		}
								}						 							 		
					         ],			         	               	                		
			        });
				var table4 = $('#tabla_ord_gas_PUI').DataTable({
			    	"columnDefs": [
			            {"className": "dt-center", "targets": [0,1,2,3,4,5]}
			     	],
			        ajax:{"url":'/Ajax_Reception_PHP/Ajaxlastinsert.php?lastinserts='+consum+'&edifici=PUI', 'dataSrc':'GasNatural_PUI', "cache":false},			        		
			            	contentType:"application/json", 	 						
				 			aadata:"GasNatural_PUI",				 		
				 			"paging": false,
						 	"searching":false,
						 	"info":false,
						 	select:true,
				 			"lengthChange": false,
				 			dom: 'Bftrip',				 		
				 			"bDestroy": true, 	 			  
				 			columns:[
				 	 			{data:'Id',width:"3%"},
								{data:'Temporada',width:"10%"},
								{data:'Mes',width:"15%"},
								{data:'Edifici',width:"15%"},
								{data:'LecturaAnterior',width:"25%"},
								{data:'LecturaActual',width:"25%"},
							],
							buttons: [
						 		{
							 		text: "Editar",
							 		action: function (e, dt, node, config){
							 			var data = table4.rows( { selected: true } ).data().each(element => console.log(element));					 			
							 			var data = table4.rows( { selected: true } ).data();
							 								 			
							 			var id = data[0].Id;
										var temporada = data[0].Temporada;
										var mes = data[0].Mes;
										var edifici = data[0].Edifici;				
										var anterior = data[0].LecturaAnterior;
										var actual = data[0].LecturaActual;

										$.post({
			     						       url: "/Ajax_Reception_PHP/updateForms.php?id="+id+"&any="+temporada+"&mes="+mes+"&anterior="+anterior+"&actual="+actual+"&edifici="+edifici+"&tipo="+consum,	     						     	     						       
			     						       type: "POST",
			     						       dataType: "HTML",
			     						       cache: false,
			     						       contentType: false,
			     						       processData: false,
			     						       success: function(data){			
													$('#div_forms_gas').html(data);
													$("#div_image").hide();		
			     						       }
			     						   });  
							 		}
								}						 							 		
					         ],         	               	                		
			        });
				var table5 = $('#tabla_ord_gas_SUP').DataTable({
			    	"columnDefs": [
			            {"className": "dt-center", "targets": [0,1,2,3,4,5]}
			     	],
			        ajax:{"url":'/Ajax_Reception_PHP/Ajaxlastinsert.php?lastinserts='+consum+'&edifici=SUP', 'dataSrc':'GasNatural_SUP', "cache":false},			        		
			            	contentType:"application/json", 	 						
				 			aadata:"GasNatural_SUP",				 		
				 			"paging": false,
						 	"searching":false,
						 	"info":false,
						 	select:true,
				 			"lengthChange": false,
				 			dom: 'Bftrip',			 		
				 			"bDestroy": true, 	 			  
				 			columns:[
				 	 			{data:'Id',width:"3%"},
								{data:'Temporada',width:"10%"},
								{data:'Mes',width:"15%"},
								{data:'Edifici',width:"15%"},
								{data:'LecturaAnterior',width:"25%"},
								{data:'LecturaActual',width:"25%"},
							],
							buttons: [
						 		{
							 		text: "Editar",
							 		action: function (e, dt, node, config){
							 			var data = table5.rows( { selected: true } ).data().each(element => console.log(element));					 			
							 			var data = table5.rows( { selected: true } ).data();
							 								 			
							 			var id = data[0].Id;
										var temporada = data[0].Temporada;
										var mes = data[0].Mes;
										var edifici = data[0].Edifici;				
										var anterior = data[0].LecturaAnterior;
										var actual = data[0].LecturaActual;

										$.post({
			     						       url: "/Ajax_Reception_PHP/updateForms.php?id="+id+"&any="+temporada+"&mes="+mes+"&anterior="+anterior+"&actual="+actual+"&edifici="+edifici+"&tipo="+consum,	     						     	     						       
			     						       type: "POST",
			     						       dataType: "HTML",
			     						       cache: false,
			     						       contentType: false,
			     						       processData: false,
			     						       success: function(data){			
													$('#div_forms_gas').html(data);
													$("#div_image").hide();		
			     						       }
			     						   });
							 		}
								}						 							 		
					         ],			         	               	                		
			        });
				
			}else if (consum == "Oxigen Ampolles"){
				$('#container_gas').hide();				
				$('#container_tank').hide();
				$('#container_elec').hide();
				$('#container_aigua').hide();
				$('#container_ampolles').removeAttr("style").hide();
				$('#container_ampolles').show()

				//Control in console log
// 				$.ajax({
// 					type: "POST",				
// 				    url: '/Ajax_Reception_PHP/Ajaxlastinsert.php?lastinserts='+consum+'&edifici=',								      						      
// 				    success: function(msg){
// 				    	console.log(msg)
// 				    }
// 				});
				
				$('#tabla_ord_amp_GRE').show();
				
				$('table.display').DataTable();
				var table = $('#tabla_ord_amp_GRE').DataTable({
			    	"columnDefs": [
			            {"className": "dt-center", "targets": [0,1,2,3,4]}
			     	],
			        ajax:{"url":'/Ajax_Reception_PHP/Ajaxlastinsert.php?lastinserts='+consum+'&edifici=GRE', 'dataSrc':'Oxiflow_GRE', "cache":false},			        		
			        contentType:"application/json", 	 						
				 	aadata:"Oxiflow_GRE",				 		
				 	"paging": false,
				 	"searching":false,
				 	"info":false,
				 	select:true,
				 	"lengthChange": false,
					dom: 'Bftrip',	 		
				 	"bDestroy": true,
				 	select: true,
			
					columns:[
						{data:'Temporada',width:"10%"},
						{data:'Mes',width:"15%"},
						{data:'Edifici',width:"15%"},
						{data:'Planta',width:"25%"},
						{data:'Ampolles',width:"25%"},
					],
			        buttons: [
				 		{
					 		text: "Editar",
					 		action: function (e, dt, node, config){
					 			var data = table.rows( { selected: true } ).data().each(element => console.log(element));					 			
					 			var data = table.rows( { selected: true } ).data();					 								 			
								var temporada = data[0].Temporada;
								var mes = data[0].Mes;
								var edifici = data[0].Edifici;				
								var planta = data[0].Planta;
								var ampolles = data[0].Ampolles;

								$.post({
	     						       url: "/Ajax_Reception_PHP/updateForms.php?any="+temporada+"&mes="+mes+"&planta="+planta+"&ampolles="+ampolles+"&edifici="+edifici+"&tipo="+consum,	     						     	     						       
	     						       type: "POST",
	     						       dataType: "HTML",
	     						       cache: false,
	     						       contentType: false,
	     						       processData: false,
	     						       success: function(data){			
											$('#div_forms_oxi').html(data);
											$("#div_image").hide();		
	     						       }
	     						   });
					 		}
						}						 							 		
			         ],	
				});

				var table2 = $('#tabla_ord_amp_LLE').DataTable({
			    	"columnDefs": [
			            {"className": "dt-center", "targets": [0,1,2,3,4]}
			     	],
			        ajax:{"url":'/Ajax_Reception_PHP/Ajaxlastinsert.php?lastinserts='+consum+'&edifici=LLE', 'dataSrc':'Oxiflow_LLE', "cache":false},			        		
			        contentType:"application/json", 	 						
				 	aadata:"Oxiflow_LLE",				 		
				 	"paging": false,
				 	"searching":false,
				 	"info":false,
				 	select:true,
				 	"lengthChange": false,
					dom: 'Bftrip',	 		
				 	"bDestroy": true,
				 	select: true,
			
					columns:[
						{data:'Temporada',width:"10%"},
						{data:'Mes',width:"15%"},
						{data:'Edifici',width:"15%"},
						{data:'Planta',width:"25%"},
						{data:'Ampolles',width:"25%"},
					],
					buttons: [
				 		{
					 		text: "Editar",
					 		action: function (e, dt, node, config){
					 			var data = table2.rows( { selected: true } ).data().each(element => console.log(element));					 			
					 			var data = table2.rows( { selected: true } ).data();
					 								 			
 					 			var id = data[0].id;
								var temporada = data[0].Temporada;
								var mes = data[0].Mes;
								var edifici = data[0].Edifici;				
								var planta = data[0].Planta;
								var ampolles = data[0].Ampolles;

								$.post({
	     						       url: "/Ajax_Reception_PHP/updateForms.php?id="+id+"&any="+temporada+"&mes="+mes+"&planta="+planta+"&ampolles="+ampolles+"&edifici="+edifici+"&tipo="+consum,	     						     	     						       
	     						       type: "POST",
	     						       dataType: "HTML",
	     						       cache: false,
	     						       contentType: false,
	     						       processData: false,
	     						       success: function(data){			
											$('#div_forms_oxi').html(data);
											$("#div_image").hide();		
	     						       }
	     						   });
					 		}
						}						 							 		
			         ],	
				});
				
				var table3 = $('#tabla_ord_amp_XAL').DataTable({
			    	"columnDefs": [
			            {"className": "dt-center", "targets": [0,1,2,3,4]}
			     	],
			        ajax:{"url":'/Ajax_Reception_PHP/Ajaxlastinsert.php?lastinserts='+consum+'&edifici=XAL', 'dataSrc':'Oxiflow_XAL', "cache":false},			        		
			        contentType:"application/json", 	 						
				 	aadata:"Oxiflow_XAL",				 		
				 	"paging": false,
				 	"searching":false,
				 	"info":false,
				 	select:true,
				 	"lengthChange": false,
					dom: 'Bftrip',	 		
				 	"bDestroy": true,
				 	select: true,			
					columns:[
						{data:'Temporada',width:"10%"},
						{data:'Mes',width:"15%"},
						{data:'Edifici',width:"15%"},
						{data:'Planta',width:"25%"},
						{data:'Ampolles',width:"25%"},
					],
			        buttons: [
				 		{
					 		text: "Editar",
					 		action: function (e, dt, node, config){
					 			var data = table3.rows( { selected: true } ).data().each(element => console.log(element));					 			
					 			var data = table3.rows( { selected: true } ).data();
					 								 			
					 			var id = data[0].id;
								var temporada = data[0].Temporada;
								var mes = data[0].Mes;
								var edifici = data[0].Edifici;				
								var planta = data[0].Planta;
								var ampolles = data[0].Ampolles;

								$.post({
	     						       url: "/Ajax_Reception_PHP/updateForms.php?id="+id+"&any="+temporada+"&mes="+mes+"&planta="+planta+"&ampolles="+ampolles+"&edifici="+edifici+"&tipo="+consum,	     						     	     						       
	     						       type: "POST",
	     						       dataType: "HTML",
	     						       cache: false,
	     						       contentType: false,
	     						       processData: false,
	     						       success: function(data){			
											$('#div_forms_oxi').html(data);
											$("#div_image").hide();		
	     						       }
	     						   });
					 		}
						}						 							 		
			         ],	
				});

				
			}else if (consum == "Oxigen"){
				
				$('#container_ampolles').hide();				
				$('#container_elec').hide();
				$('#container_aigua').hide();
				$('#container_gas').hide();		
				$('#container_tank').removeAttr("style").hide();
				$('#container_tank').show()

				//Control in console log
// 				$.ajax({
// 					type: "POST",				
// 				    url: '/Ajax_Reception_PHP/Ajaxlastinsert.php?lastinserts='+consum+'&edifici=""',								      						      
// 				    success: function(msg){
// 				    	console.log(msg)
// 				    }
// 				});				
				
				$('#tabla_ord_tank').show();				
				$('table.display').DataTable();
				
				var table = $('#tabla_ord_tank').DataTable({
			    	"columnDefs": [
			            {"className": "dt-center", "targets": [0,1,2,3,4]}
			     	],
			        ajax:{"url":'/Ajax_Reception_PHP/Ajaxlastinsert.php?lastinserts='+consum+'&edifici=""', 'dataSrc':'Oxigen', "cache":false},			        		
			        contentType:"application/json", 	 						
				 	aadata:"Oxigen",				 		
				 	"paging": false,
				 	"searching":false,
				 	"info":false,
				 	select:true,
				 	"lengthChange": false,
					dom: 'Bftrip',	 		
				 	"bDestroy": true,
				 	select: true,
					columns:[
						{data:'Id',width:"3%"},
						{data:'Temporada',width:"10%"},
						{data:'Mes',width:"15%"},						
						{data:'ConsumTank',width:"25%"},
						{data:'IdPreu',width:"25%"},
					],
					buttons: [
				 		{
					 		text: "Editar",
					 		action: function (e, dt, node, config){
					 			var data = table.rows( { selected: true } ).data().each(element => console.log(element));					 			
					 			var data = table.rows( { selected: true } ).data();
					 								 			
								var id = data[0].Id;
								var temporada = data[0].Temporada;
								var mes = data[0].Mes;
								var consumTank = data[0].ConsumTank						
								var totalf = data[0].TotalFactura
								var idPreu = data[0].IdPreu

								$.post({
	     						       url: "/Ajax_Reception_PHP/updateForms.php?id="+id+"&temporada="+temporada+"&mes="+mes+"&consumTank="+consumTank+"&totalf="+totalf+"&tipo="+consum+"&preu="+idPreu,	     						     	     						       
	     						       type: "POST",
	     						       dataType: "HTML",
	     						       cache: false,
	     						       contentType: false,
	     						       processData: false,
	     						       success: function(data){			
											$('#div_forms').html(data);
											$("#div_image").hide();		
	     						       }
	     						   });
					 		}
						}						 							 		
			         ],
				});
			}else if (consum == "Electricitat"){

				$('#container_ampolles').hide();
				$('#container_tank').hide();							
				$('#container_aigua').hide();
				$('#container_gas').hide();		
				$('#container_elec').removeAttr("style").hide();				
				$('#container_elec').show()
				
				//Control in console log
// 				$.ajax({
// 					type: "POST",				
// 				    url: '/Ajax_Reception_PHP/Ajaxlastinsert.php?lastinserts='+consum+'&edifici=""',								      						      
// 				    success: function(msg){
// 				    	console.log(msg)
// 				    }
// 				});				
				
				$('#tabla_ord_elec').show();				
				$('table.display').DataTable();				
						
				var table = $('#tabla_ord_elec').DataTable({					 						
			    	"columnDefs": [
			            {"className": "dt-center", "targets": [0,1,2,3,4]}
			     	],
			     	
			        ajax:{"url":'/Ajax_Reception_PHP/Ajaxlastinsert.php?lastinserts='+consum+'&edifici=""', 'dataSrc':'Electricitat', "cache":false},			        		
			        contentType:"application/json", 	 						
				 	aadata:"Electricitat",				 						
					dom: 'Bftrip',
				 	select:true,			 					 	
			
			      	"paging": false,
				 	"searching":false,
				 	"info":false,				 	
				 	"lengthChange": false,
				 	"bDestroy": true,
				 	
					columns:[
						{data:'Id',width:"3%"},
						{data:'Temporada',width:"10%"},
						{data:'Mes',width:"15%"},						
						{data:'ConsumP1',width:"10%"},
						{data:'ConsumP2',width:"10%"},
						{data:'ConsumP3',width:"10%"},
						{data:'ConsumP4',width:"10%"},
						{data:'ConsumP5',width:"10%"},
						{data:'ConsumP6',width:"10%"},
						{data:'TotalFactura',width:"10%"}						
					],
				 	buttons: [
				 		{
					 		text: "Editar",
					 		action: function (e, dt, node, config){
					 			var data = table.rows( { selected: true } ).data().each(element => console.log(element));					 			
					 			var data = table.rows( { selected: true } ).data();
					 								 			
								var id = data[0].Id;
								var temporada = data[0].Temporada;
								var mes = data[0].Mes;
								var consumP1 = data[0].ConsumP1
								var consumP2 = data[0].ConsumP2
								var consumP3 = data[0].ConsumP3
								var consumP4 = data[0].ConsumP4
								var consumP5 = data[0].ConsumP5
								var consumP6 = data[0].ConsumP6
								var totalf = data[0].TotalFactura


								
								$.post({
	     						       url: "/Ajax_Reception_PHP/updateForms.php?id="+id+"&temporada="+temporada+"&mes="+mes+"&p1="+consumP1+"&p2="+consumP2+"&p3="+consumP3+"&p4="+consumP4+"&p5="+consumP5+"&p6="+consumP6+"&totalf="+totalf+"&tipo="+consum,	     						     	     						       
	     						       type: "POST",
	     						       dataType: "HTML",
	     						       cache: false,
	     						       contentType: false,
	     						       processData: false,
	     						       success: function(data){			
											$('#div_forms').html(data);
											$("#div_image").hide();		
	     						       }
	     						   });
					 		}
						}						 							 		
			         ],
			         
				});

				
				
				
			///////////////////////////////////7
			// Aigua	
			}else if (consum == "Aigua"){
				$('#container_ampolles').hide();
				$('#container_tank').hide();							
				$('#container_elec').hide();
				$('#container_gas').hide();						
				$('#container_aigua').removeAttr("style").hide();
				$('#container_aigua').show()
				
//  				$.ajax({
// 					type: "POST",				
// 				    url: '/Ajax_Reception_PHP/Ajaxlastinsert.php?lastinserts='+consum+'&edifici=""',								      						      
// 				    success: function(msg){
// 				    	console.log(msg)
// 				    }
// 				});		
				$('#tabla_ord_aigua').show();				
				$('table.display').DataTable();								
				var table = $('#tabla_ord_aigua').DataTable({
			    	"columnDefs": [
			            {"className": "dt-center", "targets": [0,1,2,3,4]}
			     	],
			        ajax:{"url":'/Ajax_Reception_PHP/Ajaxlastinsert.php?lastinserts='+consum+'&edifici=""', 'dataSrc':'Aigua', "cache":false},			        		
			        contentType:"application/json", 	 						
				 	aadata:"Aigua",				 		
				 	dom: 'Bftrip',
				 	select:true,			 					 	
			
			      	"paging": false,
				 	"searching":false,
				 	"info":false,				 	
				 	"lengthChange": false,
				 	"bDestroy": true,
				 	
					columns:[
						{data:'Id',width:"3%"},
						{data:'Temporada',width:"10%"},
						{data:'Mes',width:"15%"},						
						{data:'Tram1',width:"10%"},
						{data:'Tram2',width:"10%"},
						{data:'Tram3',width:"10%"},					
						{data:'TotalFactura',width:"10%"}						
					],
					buttons: [
				 		{
					 		text: "Editar",
					 		action: function (e, dt, node, config){
					 			var data = table.rows( { selected: true } ).data().each(element => console.log(element));					 			
					 			var data = table.rows( { selected: true } ).data();
					 								 			
								var id = data[0].Id;
								var any = data[0].Temporada;
								var mes = data[0].Mes;
								var Tram1 = data[0].Tram1
								var Tram2 = data[0].Tram2
								var Tram3 = data[0].Tram3								
								var totalf = data[0].TotalFactura
	
								$.post({
	     						       url: "/Ajax_Reception_PHP/updateForms.php?id="+id+"&any="+any+"&mes="+mes+"&p1="+Tram1+"&p2="+Tram2+"&p3="+Tram3+"&totalf="+totalf+"&tipo="+consum,	     						     	     						       
	     						       type: "POST",
	     						       dataType: "HTML",
	     						       cache: false,
	     						       contentType: false,
	     						       processData: false,
	     						       success: function(data){			
											$('#div_forms').html(data);
											$("#div_image").hide();		
	     						       }
	     						});
					 		}
						}						 							 		
			         ]
				});
			};			
		});
	});
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
    <!-- <input class="btn btn-primary" type="button" name="submit" value="Triar ultima inserció" onclick="lastinsterts()">-->
    <input class="btn btn-primary" id="btn_lastinsert"type="button" name="submit" value="Triar ultima inserció">
    
    </form>
    </div>
    <div id="LastInsert"></div>
    <br>
    <div id="formslastinserts">
    <div class="col-md-12 col container" id="container_gas" style="border: 1px solid #920000; display:none;" >   
     <div class="col-md-6 col">
     <h5>Últimes insercions Gas Natural <b>Tramuntana</b></h5>
       <table id="tabla_ord_gas_TRA" class="stripe display cell-border compact order-column" style="width:60%;">
       		<thead>
        		<tr>
        			<th>Id</th>
        			<th>Temporada</th>
        			<th>Mes</th>
        			<th>Edifici</th>
        			<th>Lectura Anterior</th>
        			<th>Lectura Actual</th>        				
        		</tr>
        	</thead>
       	</table>
       </div>
       <div class="col-md-6 col">
            <h5>Últimes insercions Gas Natural <b>Gregal</b></h5>
       
       <table id="tabla_ord_gas_GRE" class="stripe display cell-border compact order-column" style="width:60%;">       		<thead>
        		<tr>
        			<th>Id</th>
        			<th>Temporada</th>
        			<th>Mes</th>
        			<th>Edifici</th>
        			<th>Lectura Anterior</th>
        			<th>Lectura Actual</th>        				
        		</tr>
        	</thead>
       	</table>
       </div>
       <div class="col-md-6 col">
                   <h5>Últimes insercions Gas Natural <b>Xaloc</b></h5>
       
       <table id="tabla_ord_gas_XAL" class="stripe display cell-border compact order-column" style="width:60%;">
       		<thead>
        		<tr>
        			<th>Id</th>
        			<th>Temporada</th>
        			<th>Mes</th>
        			<th>Edifici</th>
        			<th>Lectura Anterior</th>
        			<th>Lectura Actual</th>        				
        		</tr>
        	</thead>
       	</table>
       </div>
       <div class="col-md-6 col">
                   <h5>Últimes insercions Gas Natural <b>Puigmal</b></h5>
       
       <table id="tabla_ord_gas_PUI" class="stripe display cell-border compact order-column" style="width:60%;">
       		<thead>
        		<tr>
        			<th>Id</th>
        			<th>Temporada</th>
        			<th>Mes</th>
        			<th>Edifici</th>
        			<th>Lectura Anterior</th>
        			<th>Lectura Actual</th>        				
        		</tr>
        	</thead>
       	</table>
       </div>
       <div class="col-md-6 col">
                   <h5>Últimes insercions Gas Natural <b>Suport</b></h5>
       
       <table id="tabla_ord_gas_SUP" class="stripe display cell-border compact order-column" style="width:60%;">
       		<thead>
        		<tr>
        			<th>Id</th>
        			<th>Temporada</th>
        			<th>Mes</th>
        			<th>Edifici</th>
        			<th>Lectura Anterior</th>
        			<th>Lectura Actual</th>        				
        		</tr>
        	</thead>
       	</table>
       </div>
        <div class="col-md-6 col" id="div_forms_gas">
 		</div>
     </div> 
	    <!-- Oxigen Tank  -->
    <div class="col-md-12 col container" id="container_tank" style="border: 1px solid #920000; display:none;" >
                <h5>Últimes insercions <b>Oxigen Tank</b></h5>
    
       <table id="tabla_ord_tank" class="stripe display cell-border compact order-column" style="width:60%;">
       		<thead>
        		<tr>
        			<th>Id</th>
        			<th>Temporada</th>
        			<th>Mes</th>
        			<th>Consum tank</th>
        			<th>Id Preu</th>        				
        		</tr>
        	</thead>
       	</table>
    </div>
    <!-- Electricitat  -->
    <div class="col-md-12 col container" id="container_elec" style="border: 1px solid #920000; display:none;" >
                    <h5>Últimes insercions <b>Electricitat</b></h5>
    
       <table id="tabla_ord_elec" class="stripe display cell-border compact order-column" style="width:60%;">
       		<thead>
        		<tr>
        			<th>Id</th>
        			<th>Temporada</th>
        			<th>Mes</th>
        			<th>Consum P1</th>
        			<th>Consum P2</th>
        			<th>Consum P3</th>
        			<th>Consum P4</th>
        			<th>Consum P5</th>
        			<th>Consum P6</th>        			
        			<th>Total Factura</th>        				
        		</tr>
        	</thead>
       	</table>
    </div>
    <!-- Aigua  -->
    <div class="col-md-12 col container" id="container_aigua" style="border: 1px solid #920000; display:none;" >
                    <h5>Últimes insercions <b>Aigua</b></h5>
    
       <table id="tabla_ord_aigua" class="stripe display cell-border compact order-column" style="width:60%;">
       		<thead>
        		<tr>
        			<th>Id</th>
        			<th>Temporada</th>
        			<th>Mes</th>
        			<th>Tram 1</th>
        			<th>Tram 2</th>
        			<th>Tram 3</th>	
        			<th>Total Factura</th>        				
        		</tr>
        	</thead>
       	</table>
    </div>
    <div class="col-md-12 col container" id="container_ampolles" style="border: 1px solid #920000; display:none;" >
	    <div class="col-md-6 col">
	     <h5>Últimes insercions Oxigen Ampolles <b>Gregal</b></h5>
	    
	       <table id="tabla_ord_amp_GRE" class="stripe display cell-border compact order-column" style="width:60%;">
	       		<thead>
	        		<tr>
	        			<th>Temporada</th>
	        			<th>Edifici</th>
	        			<th>Mes</th>
	        			<th>Planta</th>	
	        			<th>Ampolles</th>        				
	        		</tr>
	        	</thead>
	       	</table>
	     </div>
	    <div class="col-md-6 col">
	    	     <h5>Últimes insercions Oxigen Ampolles <b>Xaloc<b></h5>
	       <table id="tabla_ord_amp_XAL" class="stripe display cell-border compact order-column" style="width:60%;">
	       		<thead>
	        		<tr>        			
	        			<th>Temporada</th>
	        			<th>Edifici</th>
	        			<th>Mes</th>
	        			<th>Planta</th>	
	        			<th>Ampolles</th>        				
	        		</tr>
	        	</thead>
	       	</table>
	     </div>
	   	<div class="col-md-6 col">
	   		     <h5>Últimes insercions Oxigen Ampolles <b>LLevant</b></h5>
	       <table id="tabla_ord_amp_LLE" class="stripe display cell-border compact order-column" style="width:60%;">
	       		<thead>
	        		<tr>        			
	        			<th>Temporada</th>
	        			<th>Edifici</th>
	        			<th>Mes</th>
	        			<th>Planta</th>	
	        			<th>Ampolles</th>        				
	        		</tr>
	        	</thead>
	       	</table>
	     </div>
	      <div class="col-md-6 col" id="div_forms_oxi">
 		</div>
    </div>
    <div class="col col-md-4" id="div_image">
     	<image class="img-rounded img-responsive" id="homeImage" src="../images/png/pspv.png">
    	    <a>Heu de triar un <b>tipus de Consulta</b> (Consum o PMP) i un <b>tipus de consum</b>, en aquest
        	    cas<br>Electricitat, Aigua o Oxigen</a>
    </div>       
</div>

 <div class="col-md-12 col" id="div_forms">
 </div>
