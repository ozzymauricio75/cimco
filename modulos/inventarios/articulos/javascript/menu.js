    $(document).ready(function() {
        ejecutarFuncionesGlobales();
    });

    function cargarReferencia(){
        var valor  = $('#codigo_interno').val();
        $('#referencia').val(valor);
    }

    function recargarDatos(id)
    {
        var destino = $('#URLFormulario').val();
        $.getJSON(destino, {recargarPais: true, id_proveedor:id}, function(elementos) {
            if (elementos) {
                    var pais = elementos[0];
                    $('#pais').val(pais);

                    /******************************************************************/
                    /*$('#marca').html('');

                    var id_marcas = elementos[1];
                    vector_id_marcas = id_marcas.split('-');

                    var descripcion_marcas = elementos[2];
                    vector_descripcion_marcas = descripcion_marcas.split('-');

                    for(var i=0;i<vector_id_marcas.length;i++){
                    $('#marca').append('<option value="'+vector_id_marcas[i]+'">' +vector_descripcion_marcas[i]+ '</option>');
                    }*/
                    /******************************************************************/
            }
        });
    }


    function funcion_ordenamiento_1(){
	
	var primera_seleccion = $('#item1').val(); 	
	if(primera_seleccion!=0){
	    $('#orden1').parent().show();
	    $('#orden1').removeClass("campoInactivo").removeAttr("disabled");

	    $('#item2').parent().show();
	    $('#item2').removeClass("campoInactivo").removeAttr("disabled");
	    $('#orden2').parent().hide();
	    $('#orden2').addClass("campoInactivo").attr("disabled","disabled");

	    $('#item3').parent().hide();
	    $('#item3').addClass("campoInactivo").attr("disabled","disabled");
	    $('#orden3').parent().hide();
	    $('#orden3').addClass("campoInactivo").attr("disabled","disabled");	   
	}else{
	    $('#orden1').parent().hide();
	    $('#orden1').addClass("campoInactivo").attr("disabled","disabled");

	    $('#item2').parent().hide();
	    $('#item2').addClass("campoInactivo").attr("disabled","disabled");
	    $('#orden2').parent().hide();
	    $('#orden2').addClass("campoInactivo").attr("disabled","disabled");

	    $('#item3').parent().hide();
	    $('#item3').addClass("campoInactivo").attr("disabled","disabled");
	    $('#orden3').parent().hide();
	    $('#orden3').addClass("campoInactivo").attr("disabled","disabled");	    
	}     


	    var destino = $('#URLFormulario').val();	
	    $.getJSON(destino, {recargarOrdenamiento: true, id_item1:primera_seleccion, valor:1}, function(elementos) {
	    if (elementos) {
		    $('#item2').html('');

		    var ids = elementos[0];
		    vector_ids = ids.split('-');
		    
		    var descripciones = elementos[1];
		    vector_descripciones = descripciones.split('-');

		    for(var i=0;i<vector_ids.length;i++){
			$('#item2').append('<option value="'+vector_ids[i]+'">' +vector_descripciones[i]+ '</option>');
		    }
	    }
	    });	

	    $('#item2').val('0');
	    $('#item3').val('0');
    }

    function funcion_ordenamiento_2(){
        var primera_seleccion = $('#item1').val();
        var segunda_seleccion = $('#item2').val();

        if(segunda_seleccion!=0){
            $('#orden2').parent().show();
            $('#orden2').removeClass("campoInactivo").removeAttr("disabled");

            $('#item3').parent().show();
            $('#item3').removeClass("campoInactivo").removeAttr("disabled");
            $('#orden3').parent().hide();
            $('#orden3').addClass("campoInactivo").attr("disabled","disabled");
        }else{
            $('#orden2').parent().hide();
            $('#orden2').addClass("campoInactivo").attr("disabled","disabled");

            $('#item3').parent().hide();
            $('#item3').addClass("campoInactivo").attr("disabled","disabled");
            $('#orden3').parent().hide();
            $('#orden3').addClass("campoInactivo").attr("disabled","disabled");
        }

	    var destino = $('#URLFormulario').val();	
	    $.getJSON(destino, {recargarOrdenamiento: true, id_item1:primera_seleccion, id_item2:segunda_seleccion, valor:2}, function(elementos) {
	    if (elementos) {
		    $('#item3').html('');

		    var ids = elementos[0];
		    vector_ids = ids.split('-');
		    
		    var descripciones = elementos[1];
		    vector_descripciones = descripciones.split('-');

		    for(var i=0;i<vector_ids.length;i++){
			$('#item3').append('<option value="'+vector_ids[i]+'">' +vector_descripciones[i]+ '</option>');
		    }
	    }
	    });	

	    $('#item3').val('0');
    }

    function funcion_ordenamiento_3(){
        var primera_seleccion = $('#item1').val();
        var segunda_seleccion = $('#item2').val();
        var tercera_seleccion = $('#item3').val();

        if(tercera_seleccion!=0 && primera_seleccion!=0){
            $('#orden3').parent().show();
            $('#orden3').removeClass("campoInactivo").removeAttr("disabled");
        }else{
            $('#orden3').parent().hide();
            $('#orden3').addClass("campoInactivo").attr("disabled","disabled");
        }
    }
	
    /*function seleccionar_todos_grupos(){
        $(".grupos_electrodomesticos:checkbox").attr('checked', $('.grupos_electrodomesticos').is(':checked'));
    }   
    function seleccionar_todos_proveedores(){
        $(".proveedores_electrodomesticos:checkbox").attr('checked', $('.proveedores_electrodomesticos').is(':checked'));
    }   
    function seleccionar_todos_marcas(){
        $(".marcas_electrodomesticos:checkbox").attr('checked', $('.marcas_electrodomesticos').is(':checked'));
    }*/



    function seleccionar_todos_grupos(){
      var seleccionar_todos = true;
      var contador_casillas_seleccionadas = 0;
      var contador_total_casillas = 0;
      $('#PESTANA_GRUPOS').find('.grupos_electrodomesticos:checkbox').each(function (grupos) {
        var id = $(this).val();
        if($('#grupos_'+id).attr('checked')){
            contador_casillas_seleccionadas++;
        }
        contador_total_casillas++;
      });

      if(contador_total_casillas == contador_casillas_seleccionadas)
        seleccionar_todos=false;
        $(".grupos_electrodomesticos:checkbox").attr('checked', seleccionar_todos);
    }
    function seleccionar_todos_proveedores(){
      var seleccionar_todos = true;
      var contador_casillas_seleccionadas = 0;
      var contador_total_casillas = 0;
      $('#PESTANA_PROVEEDORES').find('.proveedores_electrodomesticos:checkbox').each(function (grupos) {

      var id = $(this).val();
        if($('#proveedores_'+id).attr('checked')){
            contador_casillas_seleccionadas++;
        }
        contador_total_casillas++;
      });

      if(contador_total_casillas == contador_casillas_seleccionadas)
            seleccionar_todos=false;

      $(".proveedores_electrodomesticos:checkbox").attr('checked', seleccionar_todos);
    }
    /*function seleccionar_todos_marcas(){
      var seleccionar_todos = true;
      var contador_casillas_seleccionadas = 0;
      var contador_total_casillas = 0;
      $('#PESTANA_MARCAS').find('.marcas_electrodomesticos:checkbox').each(function (grupos) {

        var id = $(this).val();
        if($('#marcas_'+id).attr('checked')){
            contador_casillas_seleccionadas++;
        }
        contador_total_casillas++;
      });

      if(contador_total_casillas == contador_casillas_seleccionadas)
         seleccionar_todos=false;
         $(".marcas_electrodomesticos:checkbox").attr('checked', seleccionar_todos);
    }*/
    function seleccionar_todas_sucursales(){
      var seleccionar_todos = true;
      var contador_casillas_seleccionadas = 0;
      var contador_total_casillas = 0;
      $('#PESTANA_SUCURSALES').find('.sucursales_electrodomesticos:checkbox').each(function (grupos) {

        var id = $(this).val();
        if($('#sucursales_'+id).attr('checked')){
            contador_casillas_seleccionadas++;
        }
        contador_total_casillas++;
      });

      if(contador_total_casillas == contador_casillas_seleccionadas)
        seleccionar_todos=false;
        $(".sucursales_electrodomesticos:checkbox").attr('checked', seleccionar_todos);
    }