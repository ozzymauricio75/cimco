    $(document).ready(function() {
        ejecutarFuncionesGlobales();
    });
    
    /*** Desactivar o activar algunos campos dependiendo del estado de la cotizacion aprobada o no-aprobada ***/

    function activarCampos(valor){
        var estado_cotizacion = $('#estado_cotizacion').val();
        var destino = $('#URLFormulario').val();

	   if (valor == 1){
            $('#valor_mano_obra_cotizacion').parent().show();
            $('#valor_mano_obra_cotizacion').removeClass("campoInactivo").removeAttr("disabled");
	          $('#valor_materiales_cotizacion').parent().show();
            $('#valor_materiales_cotizacion').removeClass("campoInactivo").removeAttr("disabled");
            $('#forma_pago').parent().show();
            $('#forma_pago').removeClass("campoInactivo").removeAttr("disabled");
            $('#porcentaje_anticipo').parent().show();
            $('#porcentaje_anticipo').removeClass("campoInactivo").removeAttr("disabled");
            $('#porcentaje_mano_obra').parent().hide();
            $('#porcentaje_mano_obra').addClass("campoInactivo").attr("disabled","disabled");
            $('#porcentaje_materiales').parent().hide();
            $('#porcentaje_materiales').addClass("campoInactivo").attr("disabled","disabled");
            $('#estado_cotizacion_cliente').parent().hide();
            $('#estado_cotizacion_cliente').addClass("campoInactivo").attr("disabled","disabled");
        } else {
            $('#valor_mano_obra_cotizacion').parent().hide();
            $('#valor_mano_obra_cotizacion').addClass("campoInactivo").attr("disabled","disabled");
            $('#valor_materiales_cotizacion').parent().hide();
            $('#valor_materiales_cotizacion').addClass("campoInactivo").attr("disabled","disabled");
            $('#forma_pago').parent().hide();
            $('#forma_pago').addClass("campoInactivo").attr("disabled","disabled");
            $('#porcentaje_anticipo').parent().hide();
            $('#porcentaje_anticipo').addClass("campoInactivo").attr("disabled","disabled");
            $('#porcentaje_mano_obra').parent().show();
            $('#porcentaje_mano_obra').removeClass("campoInactivo").removeAttr("disabled");
            $('#porcentaje_materiales').parent().show();
            $('#porcentaje_materiales').removeClass("campoInactivo").removeAttr("disabled");
            $('#estado_cotizacion_cliente').parent().show();
            $('#estado_cotizacion_cliente').removeClass("campoInactivo").removeAttr("disabled");
        }
    }
    
    /*** Traer consorciado de acuerdo a la sede seleccionada ***/
    function cargarConsorciado(){
        var dato    = $('#id_sede').val();        
        var destino = $('#URLFormulario').val();

        /*** Descargar contenido  ***/
        $.getJSON(destino, {recargar: true, id_carga: dato}, function(datos){
            if (datos != ""){
                $('#id_sucursal').val(datos[0]);
                $('#nombre_contacto').val(datos[1]);
            } else {
                $('#id_sucursal').val('');
                $('#nombre_contacto').val('');
            }
        });
    }    
    
    function seleccionar_todas_sucursales(){
      var seleccionar_todos = true;
      var contador_casillas_seleccionadas = 0;
      var contador_total_casillas = 0;
      $('#PESTANA_REPORTE').find('.sucursales:checkbox').each(function (consorciados) {

        var id = $(this).val();
        if($('#sucursales_'+id).attr('checked')){
            contador_casillas_seleccionadas++;
        }
        contador_total_casillas++;
      });
      
      if(contador_total_casillas == contador_casillas_seleccionadas)
        seleccionar_todos=false;
        $(".sucursales:checkbox").attr('checked', seleccionar_todos);
    }
