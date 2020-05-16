    $(document).ready(function() {
        ejecutarFuncionesGlobales();
    });

    /*** Cargar datos si el requerimiento existe ***/
    function cargarDatos() {
        var id      = $('#id').val();
        var destino = $('#URLFormulario').val();
        
        /*** Descargar contenido  ***/
        $.getJSON(destino, {recargar: true, id_carga: id}, function(datos){
            if (datos != ""){                                                                     
                $('#id').val(datos[0]);                                                           
                $('#tipo_acta').val(datos[1]);
                
                var tipo_acta = $('#tipo_acta').val(datos[1]);
                                                                                                                                                                                                                  
                }if(datos[1] == 1){
                    $('#inicio').attr("checked","true")
                    $('#valor_facturar').parent().hide();                                                     
                    $('#valor_facturar').addClass("campoInactivo").attr("disabled"); 
                    $('#porcentaje_mano_obra').parent().hide();                                                     
                    $('#porcentaje_mano_obra').addClass("campoInactivo").attr("disabled"); 
                    $('#porcentaje_materiales').parent().hide();                                                     
                    $('#porcentaje_materiales').addClass("campoInactivo").attr("disabled"); 
                }else if (datos[1] != 1){                                                                        
                    $('#avance').attr("checked","true")
                    $('#valor_facturar').parent().show();                                                
                    $('#valor_facturar').removeClass("campoInactivo").removeAttr("disabled","disabled");
                    $('#porcentaje_mano_obra').parent().show();                                                
                    $('#porcentaje_mano_obra').removeClass("campoInactivo").removeAttr("disabled","disabled");
                    $('#porcentaje_materiales').parent().show();                                                
                    $('#porcentaje_materiales').removeClass("campoInactivo").removeAttr("disabled","disabled");                           
                }              
        });
    } 
    
    
    /*** Desactivar o activar algunos campos dependiendo del tipo de acta ***/
    function activarValorFacturar(valor){
        if (valor == 1){
            $('#valor_facturar').parent().hide();
            $('#valor_facturar').addClass("campoInactivo").attr("disabled","disabled");
            $('#porcentaje_mano_obra').parent().hide();                                                     
            $('#porcentaje_mano_obra').addClass("campoInactivo").attr("disabled"); 
            $('#porcentaje_materiales').parent().hide();                                                     
            $('#porcentaje_materiales').addClass("campoInactivo").attr("disabled"); 
        }else if (valor != 1){
            if(valor == 3){
              var acumulado =  $('#acumulado_formato').val(); 
                $('#valor_facturar').val($('#acumulado_formato').val());
            } 
            $('#valor_facturar').parent().show();                                                
            $('#valor_facturar').removeClass("campoInactivo").removeAttr("disabled","disabled"); 
            $('#porcentaje_mano_obra').parent().show();                                                
            $('#porcentaje_mano_obra').removeClass("campoInactivo").removeAttr("disabled","disabled");
            $('#porcentaje_materiales').parent().show();                                                
            $('#porcentaje_materiales').removeClass("campoInactivo").removeAttr("disabled","disabled");       

        }
    }
    
    function formato_numero(valor){
        var valor_formato = '';
        for ( m=0; m < valor.length; m++) {

            if (valor.charAt(m) != ',') {
                valor_formato = valor_formato + valor.charAt(m);
            }
        }
        return valor_formato;
    };
    
    function ponerMiles(valor) {
        var valorMiles = '';
        valor          = valor.toString();
        cont           = 0;
        for ( m=valor.length; m>=0; m--) {
            if (cont != 3) {
                valorMiles = valor.charAt(m-1)+valorMiles;
                cont++;
            } else {
                cont = 0;
                if (m != 0) {
                    valorMiles = ','+valorMiles;
                    m++;
                }
            }
        }
        return valorMiles;
    };

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
