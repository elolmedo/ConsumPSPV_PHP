//Función que recibe los parámetros del formulario de makeGraph.php y los manda hacia tablas_Consumos1.php para generar las tablas con los datos solicitados
function MostrarTabla1() {

        var tipo = $('#sel_tipus').val();
        var consumo = $('#sel_consum').val();               
        
        //Obtenemos todos los elementos del checkbox. JavaScript
        var temporadas 	= document.getElementsByClassName('form-check-input');
        
        var temporadasSeleccionadas = "";
        //Parseamos el checkbox para quedarnos con los chequeados
        for (i = 0; i < temporadas.length; i++){
        	
        	if (temporadas[i].checked){
        		temporadasSeleccionadas += temporadas[i].value + " ";	
        	}
        }
//        //Quitamos la última coma
        temporadasSeleccionadas = temporadasSeleccionadas.slice(0,-1);

        if ((tipo.length == 0) && (consumo.length == 0)) {
        	document.getElementById("tablasAjax_Consumos1").innerHTML = "";
        	return;

        } else {
        	$.post("/Ajax_Reception_PHP/tablas_Consumos1.php?tipoconsulta="+tipo+"&tipoconsumo="+consumo+"&temporadas="+temporadasSeleccionadas,        			
        			function(htmlexterno){
        				$('#tablasAjax_Consumos1').html(htmlexterno);
        			});
        }
}

//Función que nos muestra los edificis correctos, en función del consumo seleccionado
function formOnload(){
    
    edificisforms();
}

function edificisforms(){
    
    consum  = document.getElementById('sel_consum').value;
    
    
    
    var edificis    = "";
    var edi = "";

     if (consum == 'Gas Natural'){
         
        // Hacemos visible el elemento y cogemos su Valor
       document.getElementById('sel_buid_oxi').style.display = 'none';
       document.getElementById('sel_buid_gas').style.display = 'inline';
       edi = document.getElementById('sel_buid_gas').value;
        
        
    }else if(consum == 'Oxigen Ampolles'){
        
        document.getElementById('sel_buid_gas').style.display = 'none';
        document.getElementById('sel_buid_oxi').style.display = 'inline';
        edi = document.getElementById('sel_buid_oxi').value;

    }else {

        document.getElementById('sel_buid_oxi').style.display = 'none';
        document.getElementById('sel_buid_gas').style.display = 'none';            
        
    }

    edificis = edi;
    return edificis;

}

//Función que recibe los parámetros del formulario de makeGraphEdificis.php y los manda hacia tablas_ConsumosEdificis.php para generar las tablas con los datos solicitados
function MostrarTabla2(){
	
   var tipo = $('#sel_tipus').val();
   var consum = $('#sel_consum').val();
   var edifici = edificisforms();
   var temporadas 	= document.getElementsByClassName('form-check-input');               
   var temporadasSeleccionadas = "";
   
    //Parseamos el checkbox para quedarnos con los chequeados
    for (i = 0; i < temporadas.length; i++){
    	
    	if (temporadas[i].checked){
    		temporadasSeleccionadas += temporadas[i].value + " ";	
    	}
    }

              
    if ((tipo.length == 0) && (consum.length == 0) && (edifici.length == 0)){
        document.getElementById('tablasAjax_Consumos2').innerHTML = '';
        return;
        
    }else {
    	 $.post("/Ajax_Reception_PHP/tablas_ConsumosEdificis.php?tipo="+tipo+"&consumo="+consum+"&edificio="+edifici+"&temporadas="+temporadasSeleccionadas,
    			 function(htmlexterno){
				$('#tablasAjax_Consumos2').html(htmlexterno);
			});        
    }    
}

function createOptions1(tipo,consumo){
	if (tipo == "Consumo") {
		if (consumo == "Aigua") {
			console.log("dentro!!!!");
	    	var formatter = new google.visualization.NumberFormat({ prefix: 'm³ ',decimalSymbol: ',', groupingSymbol: '.' });
	    	  var options = {
	                  title: 'Consum Aigua en m³',
	                  chart:{

	                      curveType: 'function',
	                      legend: { position: 'bottom' }
	                  },
	                  axes: {
	                      x: {
	                          0: {side: 'top'}
	                      }
	                  }
	              };
	    }else if (consumo == "Oxigen"){
	    	var formatter = new google.visualization.NumberFormat({ prefix: 'm³ ',decimalSymbol: ',', groupingSymbol: '.' });
	        var options = {
	                title: 'Consum Oxigen en m³',
	                chart:{

	                    curveType: 'function',
	                    legend: { position: 'bottom' }
	                },
	                axes: {
	                    x: {
	                        0: {side: 'top'}
	                    }
	                }
	            };
	    }else if(consumo == "Electricitat") {
	    	var formatter = new google.visualization.NumberFormat({ prefix: '€ ',decimalSymbol: ',', groupingSymbol: '.' });
	        var options = {
	                title: 'Consum electricitat en kw',
	                chart:{

	                    curveType: 'function',
	                    legend: { position: 'bottom' }
	                },
	                axes: {
	                    x: {
	                        0: {side: 'top'}
	                    }
	                }
	            };
	    
	    }
	}else if (tipo == "PMP"){
		if (consumo == "Aigua"){
	      var formatter = new google.visualization.NumberFormat({ prefix: '€ ',decimalSymbol: ',', groupingSymbol: '.' });
		  var options = {
		          title: 'PMP Aigua en €',
		          chart:{
		
		              curveType: 'function',
		              legend: { position: 'bottom' }
		          },
		          axes: {
		              x: {
		                  0: {side: 'top'}
		              }
		          }
		      };
	    }else if (consumo == "Oxigen"){
	    	var formatter = new google.visualization.NumberFormat({ prefix: '€ ',decimalSymbol: ',', groupingSymbol: '.' });
	        var options = {
	                title: 'PMP Oxigen en €',
	                chart:{
	
	                    curveType: 'function',
	                    legend: { position: 'bottom' }
	                },
	                axes: {
	                    x: {
	                        0: {side: 'top'}
	                    }
	                }
	            };
	    }else if (consumo == "Electricitat") {
	    	var formatter = new google.visualization.NumberFormat({ prefix: '€ ',decimalSymbol: ',', groupingSymbol: '.' });
	        var options = {
	                title: 'PMP electricitat en €',
	                chart:{

	                    curveType: 'function',
	                    legend: { position: 'bottom' }
	                },
	                axes: {
	                    x: {
	                        0: {side: 'top'}
	                    }
	                }
	            };
	    	
	    }
	}
	
	return {formatter, options};
}

function CreateGraph1(){
	
	var tipo 		= document.getElementById('sel_tipus').value; 
    var consumo  	= document.getElementById('sel_consum').value;
    
    //Obtenemos todos los elementos del checkbox
    var temporadas 	= document.getElementsByClassName('form-check-input');               
    var temporadasSeleccionadas = "";
    //Parseamos el checkbox para quedarnos con los chequeados
    for (i = 0; i < temporadas.length; i++){
    	
    	if (temporadas[i].checked){
    		temporadasSeleccionadas += temporadas[i].value + " ";	
    	}
    }
    
    var jsonData = $.ajax({
        url:"/Ajax_Reception_PHP/graphsTotals_Consumos1.php?tipo="+tipo+"&consumo="+consumo+"&temporadas="+temporadasSeleccionadas,
        type: "POST",
        data: tipo, consumo,temporadasSeleccionadas,
        dataType: "JSON",
        async: false,        
        processData: false,
        contentType: false,        
    }).responseText;
    
    //alert(jsonData);
    
    google.charts.load('current', {'packages':['corechart']});
    
    jsonData = JSON.parse(jsonData);

    var data = new google.visualization.DataTable(jsonData);
    
    var options = {};
    
    if (tipo == "Consum"){
    	if (consumo == "Electricitat"){
    		options = {
    	            title: 'Consum '+consumo+' en kw',
    	            chart:{

    	                curveType: 'function',
    	                legend: { position: 'bottom' }
    	            },
    	            axes: {
    	                x: {
    	                    0: {side: 'top'}
    	                }
    	            }
    	        };

    	    var formatter = new google.visualization.NumberFormat({ prefix: 'kw ',decimalSymbol: ',', groupingSymbol: '.' });
    	    var i = 1;
    	    for (i; i<=1;i++){
    	        formatter.format(data,i);
    	    }

    	}else if (consumo == "Aigua" || consumo == "Oxigen"){
    		options = {
    	            title: 'Consum '+consumo+' en m³',
    	            chart:{

    	                curveType: 'function',
    	                legend: { position: 'bottom' }
    	            },
    	            axes: {
    	                x: {
    	                    0: {side: 'top'}
    	                }
    	            }
    	        };

    	    var formatter = new google.visualization.NumberFormat({ prefix: 'm³ ',decimalSymbol: ',', groupingSymbol: '.' });
    	    var i = 1;
    	    for (i; i<=1;i++){
    	        formatter.format(data,i);
    	    }
    	
    	}
    }else if (tipo == "PMP"){
    	if (consumo == "Electricitat" || consumo =="Aigua"){
    		options = {
    	            title: 'PMP '+consumo+' en €',
    	            chart:{

    	                curveType: 'function',
    	                legend: { position: 'bottom' }
    	            },
    	            axes: {
    	                x: {
    	                    0: {side: 'top'}
    	                }
    	            }
    	        };

    	    var formatter = new google.visualization.NumberFormat({ prefix: '€ ',decimalSymbol: ',', groupingSymbol: '.' });
    	    var i = 1;
    	    for (i; i<=1;i++){
    	        formatter.format(data,i);
    	    }
    	}else if (consumo == "Oxigen"){
    		options = {
    	            title: 'Cost '+consumo+' en €',
    	            chart:{

    	                curveType: 'function',
    	                legend: { position: 'bottom' }
    	            },
    	            axes: {
    	                x: {
    	                    0: {side: 'top'}
    	                }
    	            }
    	        };

    	    var formatter = new google.visualization.NumberFormat({ prefix: '€ ',decimalSymbol: ',', groupingSymbol: '.' });
    	    var i = 1;
    	    for (i; i<=1;i++){
    	        formatter.format(data,i);
    	    }
    	}
    }
    var chart = new google.visualization.LineChart(document.getElementById("curve_chart"));

//    // The select handler. Call the chart's getSelection() method
    function selectHandler() {
        var selectedItem = chart.getSelection()[0];
        if (selectedItem) {
            var value = data.getValue(selectedItem.row, selectedItem.column);
            alert('The user selected ' + value);
        }
    }

    // Listen for the 'select' event, and call my function selectHandler() when
//    // the user selects something on the chart.
    google.visualization.events.addListener(chart, 'select', selectHandler);

    chart.draw(data,options);

}

function CreateGraph2(){
	
	var tipo    = document.getElementById('sel_tipus').value;
    var consumo  = document.getElementById('sel_consum').value;
    
    var edifici = edificisforms();
        
    var temporadas 	= document.getElementsByClassName('form-check-input');               
    var temporadasSeleccionadas = "";
    //Parseamos el checkbox para quedarnos con los chequeados
    for (i = 0; i < temporadas.length; i++){
    	
    	if (temporadas[i].checked){
    		temporadasSeleccionadas += temporadas[i].value + " ";	
    	}
    }
    // Inicamos objeto Ajax
    var jsonData = $.ajax({});
    
    //Totals muestra una gráfica de columnas el resto gráficas lineales.
    if (edifici == "Totals"){
    	
    	jsonData = $.ajax({
            url:"/Ajax_Reception_PHP/TotalesGraphsPSPV.php?tipo="+tipo+"&consumo="+consumo+"&edifici="+edifici+"&temporadas="+temporadasSeleccionadas,
            type: "POST",
            data: tipo, consumo,temporadasSeleccionadas,edifici,
            dataType: "json",
            async: false,        
            processData: false,
            contentType: false,           
        }).responseText;

        google.charts.load('current', {'packages':['corechart']});
        
        jsonData = JSON.parse(jsonData);
        

        var data = new google.visualization.DataTable(jsonData);
        
        var options = {};
        if (tipo == "Consum"){
	        if (consumo == "Gas Natural"){
	        	
	        	options = {
	                    title: 'Consum Totals de Gas Natural en kw',
	                    bar: 'horizontal',
	
	                    chart:{
	                       legend: { position: 'bottom' }
	                    },
	                    axes: {
	                        hAxis: {
	                            title: 'Consumo'
	                        },
	                        vAxis: {
	                            title: 'Edificis'
	                        },
	                        x: {
	                            0: {side: 'top'}
	                        }
	                    }
	                };
	
	            var formatter = new google.visualization.NumberFormat({ prefix: 'kw ',decimalSymbol: ',', groupingSymbol: '.' });
	            var i = 1;
	            for (i; i<=5;i++){
	                formatter.format(data,i);
	            }
	
	        }else if (consumo == "Oxigen Ampolles"){
	        	
	        	options = {
	                    title: 'Consum Totals de  Oxigen Ampolles',
	                    bar: 'horizontal',
	
	                    chart:{
	                       legend: { position: 'bottom' }
	                    },
	                    axes: {
	                        hAxis: {
	                            title: 'Oxigen Ampolles'
	                        },
	                        vAxis: {
	                            title: 'Edificis'
	                        },
	                        x: {
	                            0: {side: 'top'}
	                        }
	                    }
	                };
	
	            var formatter = new google.visualization.NumberFormat({ prefix: 'ampolles ',decimalSymbol: ',', groupingSymbol: '.' });
	            var i = 1;
	            for (i; i<=3;i++){
	                formatter.format(data,i);
	            }
	
	        }
        }else if (tipo == "PMP"){
	        if (consumo == "Gas Natural"){
	        	
	        	options = {
	                    title: 'Cost Totals Gas Natural en €',
	                    bar: 'horizontal',
	
	                    chart:{
	                       legend: { position: 'bottom' }
	                    },
	                    axes: {
	                        hAxis: {
	                            title: 'Cost'
	                        },
	                        vAxis: {
	                            title: 'Edificis'
	                        },
	                        x: {
	                            0: {side: 'top'}
	                        }
	                    }
	                };
	
	            var formatter = new google.visualization.NumberFormat({ prefix: '€ ',decimalSymbol: ',', groupingSymbol: '.' });
	            var i = 1;
	            for (i; i<=5;i++){
	                formatter.format(data,i);
	            }
	
	        }else if (consumo == "Oxigen Ampolles"){
	        	
	        	options = {
	                    title: 'Cost Total Oxigen Ampolles',
	                    bar: 'horizontal',
	
	                    chart:{
	                       legend: { position: 'bottom' }
	                    },
	                    axes: {
	                        hAxis: {
	                            title: 'Oxigen Ampolles'
	                        },
	                        vAxis: {
	                            title: 'Edificis'
	                        },
	                        x: {
	                            0: {side: 'top'}
	                        }
	                    }
	                };
	
	            var formatter = new google.visualization.NumberFormat({ prefix: '€ ',decimalSymbol: ',', groupingSymbol: '.' });
	            var i = 1;
	            for (i; i<=3;i++){
	                formatter.format(data,i);
	            }
	
	        }
        	
        }

                var chart = new google.charts.Bar(document.getElementById("curve_chart"));

        // The select handler. Call the chart's getSelection() method
        function selectHandler() {
            var selectedItem = chart.getSelection()[0];
            if (selectedItem) {
                var value = data.getValue(selectedItem.row, selectedItem.column);
                alert('The user selected ' + value);
            }
        }

        // Listen for the 'select' event, and call my function selectHandler() when
        // the user selects something on the chart.
        google.visualization.events.addListener(chart, 'select', selectHandler);

        chart.draw(data);


    }else {
    	
    	jsonData = $.ajax({
            url:"/Ajax_Reception_PHP/graphsTotals_Consumos2.php?tipo="+tipo+"&consumo="+consumo+"&edifici="+edifici+"&temporadas="+temporadasSeleccionadas,
            type: "POST",
            data: tipo, consumo,temporadasSeleccionadas,edifici,
            dataType: "JSON",
            async: false,        
            processData: false,
            contentType: false,
            
        }).responseText;
    	
        //alert(jsonData);

    	
    	google.charts.load('current', {'packages':['corechart']});
        
        jsonData = JSON.parse(jsonData);

        var data = new google.visualization.DataTable(jsonData);
        
        var options = {};

        if (tipo == "Consum"){
        	if(consumo == "Gas Natural"){
        		options = {
                        title: 'Consum Gas Natural '+edifici+' en kw',
                        chart:{

                            curveType: 'function',
                            legend: { position: 'bottom' }
                        },
                        axes: {
                            x: {
                                0: {side: 'top'}
                            }
                        }
                    };
        		var formatter = new google.visualization.NumberFormat({ prefix: 'kw ',decimalSymbol: ',', groupingSymbol: '.' });
                var i = 1;
                for (i; i<=1;i++){
                    formatter.format(data,i);
                }

        	}else if (consumo == "Oxigen Ampolles"){
        		options = {
                        title: 'Consum Oxigen Ampolles '+edifici+' en ampolles',
                        chart:{

                            curveType: 'function',
                            legend: { position: 'bottom' }
                        },
                        axes: {
                            x: {
                                0: {side: 'top'}
                            }
                        }
                    };
        		var formatter = new google.visualization.NumberFormat({ prefix: 'ampolles ',decimalSymbol: ',', groupingSymbol: '.' });
                var i = 1;
                for (i; i<=1;i++){
                    formatter.format(data,i);
                }
        	}
        }else if (tipo == "PMP"){
        	if(consumo == "Gas Natural"){
        		options = {
                        title: 'Cost Gas Natural '+edifici+' en euros',
                        chart:{

                            curveType: 'function',
                            legend: { position: 'bottom' }
                        },
                        axes: {
                            x: {
                                0: {side: 'top'}
                            }
                        }
                    };
        		var formatter = new google.visualization.NumberFormat({ prefix: '€ ',decimalSymbol: ',', groupingSymbol: '.' });
                var i = 1;
                for (i; i<=1;i++){
                    formatter.format(data,i);
                }
        	}else if (consumo == "Oxigen Ampolles"){
        		options = {
                        title: 'Cost Oxigen Ampolles '+edifici+' en ampolles',
                        chart:{

                            curveType: 'function',
                            legend: { position: 'bottom' }
                        },
                        axes: {
                            x: {
                                0: {side: 'top'}
                            }
                        }
                    };
        		var formatter = new google.visualization.NumberFormat({ prefix: '€ ',decimalSymbol: ',', groupingSymbol: '.' });
                var i = 1;
                for (i; i<=1;i++){
                    formatter.format(data,i);
                }
        	}
        }
        
        var chart = new google.visualization.LineChart(document.getElementById("curve_chart"));

//        // The select handler. Call the chart's getSelection() method
        function selectHandler() {
            var selectedItem = chart.getSelection()[0];
            if (selectedItem) {
                var value = data.getValue(selectedItem.row, selectedItem.column);
                alert('The user selected ' + value);
            }
        }

        // Listen for the 'select' event, and call my function selectHandler() when
//        // the user selects something on the chart.
        google.visualization.events.addListener(chart, 'select', selectHandler);

        chart.draw(data,options);
    }
}

function MostrarFormularios(){
		
	
	var consumo = document.getElementById('sel_tipus_insercio').value;
	
	
	if (consumo == "Aigua"){
		
		document.getElementById('insertFormAigua').style.display = 'inline';
		document.getElementById('insertFormElectricitat').style.display = 'none';
		document.getElementById('insertFormOxigen').style.display = 'none';
		document.getElementById('insertFormGasNatural').style.display = 'none';
		document.getElementById('insertFormOxigenAmpolles').style.display = 'none';
		
	}else if (consumo == "Electricitat"){
		
		document.getElementById('insertFormElectricitat').style.display = 'inline';
		document.getElementById('insertFormAigua').style.display = 'none';
		document.getElementById('insertFormOxigen').style.display = 'none';
		document.getElementById('insertFormGasNatural').style.display = 'none';
		document.getElementById('insertFormOxigenAmpolles').style.display = 'none';
		
	}else if (consumo == "Oxigen"){
		
		document.getElementById('insertFormOxigen').style.display = 'inline';
		document.getElementById('insertFormElectricitat').style.display = 'none';
		document.getElementById('insertFormAigua').style.display = 'none';
		document.getElementById('insertFormGasNatural').style.display = 'none';
		document.getElementById('insertFormOxigenAmpolles').style.display = 'none';
		
	} else if (consumo == "Gas Natural"){
		
		document.getElementById('insertFormGasNatural').style.display = 'inline';
		document.getElementById('insertFormElectricitat').style.display = 'none';
		document.getElementById('insertFormOxigen').style.display = 'none';
		document.getElementById('insertFormAigua').style.display = 'none';
		document.getElementById('insertFormOxigenAmpolles').style.display = 'none';
		
	}else if (consumo == "Oxigen Ampolles"){
		
		document.getElementById('insertFormOxigenAmpolles').style.display = 'inline';
		document.getElementById('insertFormElectricitat').style.display = 'none';
		document.getElementById('insertFormOxigen').style.display = 'none';
		document.getElementById('insertFormGasNatural').style.display = 'none';
		document.getElementById('insertFormAigua').style.display = 'none';
	}
	
         
}

function insertData(){
	
     var consumo = $('#sel_tipus_insercio').val();

     if (consumo.length == 0){

         document.getElementById("autoInsert").innerHTML = "";
         return;

     } else {
    	 
     	$.post("/Ajax_Reception_PHP/autoInsert.php?tipoconsumo=" + consumo,        			
     			function(htmlexterno){
     				$('#autoInsert').html(htmlexterno);
     			});
     }
}

function insertPreu(){
	var consumo = $('#sel_tipus_insercio').val();

    if (consumo.length == 0){

        document.getElementById("insertPreu").innerHTML = "";
        return;

    } else {
   	 
    	$.post("/Ajax_Reception_PHP/preuInsert.php?tipoconsumo=" + consumo,        			
    			function(htmlexterno){
    				$('#insertPreu').html(htmlexterno);
    			});
    }
}


function uploadFitxer(){
	
	$(".custom-file-input").on("change", function(){
		
		var filename = $(this).val();
		var tipo = $('#sel_tipo').val();
		
		$(this).siblings(".custom-file-label").addClass("selected").html(filename);
		
	});
	
	
}

function lastinsterts(){
    
    var string = "";
    
    string = document.getElementById("sel_last_insert").value;
    
    if(string.length == 0) {
        
        document.getElementById("formslastinserts").innerHTML = "";
        return;
        
    }else {
        
        if (window.XMLHttpRequest) {
            //Code for IE,Firefox, Chrome, SAfari
            xmlhttp = new XMLHttpRequest();
        } else {
            
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        
        xmlhttp.onreadystatechange = function () {
            
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                
                document.getElementById("formslastinserts").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET", "/Ajax_Reception_PHP/Ajaxlastinsert.php?lastinserts=" + string, true);
        xmlhttp.send();
    }
}
