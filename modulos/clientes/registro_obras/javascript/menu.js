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
                    $('#numero_factura').parent().hide();                                                     
                    $('#numero_factura').addClass("campoInactivo").attr("disabled");                     
                    $('#porcentaje_mano_obra').parent().hide();                                                     
                    $('#porcentaje_mano_obra').addClass("campoInactivo").attr("disabled"); 
                    $('#porcentaje_materiales').parent().hide();                                                     
                    $('#porcentaje_materiales').addClass("campoInactivo").attr("disabled"); 
                    $('#informes').parent().hide();                                                     
                    $('#informes').addClass("campoInactivo").attr("disabled");
                }else if (datos[1] == 2 || datos[1] == 3){                                                                        
                    $('#avance').attr("checked","true")
                    $('#informes').parent().hide();                                                     
                    $('#informes').addClass("campoInactivo").attr("disabled");
                    $('#valor_facturar').parent().show();                                                
                    $('#valor_facturar').removeClass("campoInactivo").removeAttr("disabled","disabled");
                    $('#numero_factura').parent().show();                                                
                    $('#numero_factura').removeClass("campoInactivo").removeAttr("disabled","disabled");                    
                    $('#porcentaje_mano_obra').parent().show();                                                
                    $('#porcentaje_mano_obra').removeClass("campoInactivo").removeAttr("disabled","disabled");
                    $('#porcentaje_materiales').parent().show();                                                
                    $('#porcentaje_materiales').removeClass("campoInactivo").removeAttr("disabled","disabled");                           
                }else if(datos[1] == 4){
                    $('#informe').attr("checked","true")
                    $('#valor_facturar').parent().hide();                                                     
                    $('#valor_facturar').addClass("campoInactivo").attr("disabled");
                    $('#numero_factura').parent().hide();                                                     
                    $('#numero_factura').addClass("campoInactivo").attr("disabled");                     
                    $('#porcentaje_mano_obra').parent().hide();                                                     
                    $('#porcentaje_mano_obra').addClass("campoInactivo").attr("disabled"); 
                    $('#porcentaje_materiales').parent().hide();                                                     
                    $('#porcentaje_materiales').addClass("campoInactivo").attr("disabled"); 
                    $('#informes').parent().show();                                                
                    $('#informes').removeClass("campoInactivo").removeAttr("disabled","disabled");
                }              
        });
    } 
    
    
    /*** Desactivar o activar algunos campos dependiendo del tipo de acta ***/
    function activarValorFacturar(valor){
        if (valor == 1){
            $('#valor_facturar').parent().hide();
            $('#valor_facturar').addClass("campoInactivo").attr("disabled","disabled");
            $('#numero_factura').parent().hide();
            $('#numero_factura').addClass("campoInactivo").attr("disabled","disabled");
            $('#porcentaje_mano_obra').parent().hide();                                                     
            $('#porcentaje_mano_obra').addClass("campoInactivo").attr("disabled"); 
            $('#porcentaje_materiales').parent().hide();                                                     
            $('#porcentaje_materiales').addClass("campoInactivo").attr("disabled"); 
            $('#informes').parent().hide();
            $('#informes').addClass("campoInactivo").attr("disabled","disabled");
            $('#imagen').parent().show();                                                
            $('#imagen').removeClass("campoInactivo").removeAttr("disabled","disabled"); 

        }else if((valor == 2) || (valor == 3)){
            if(valor == 3){
              var acumulado =  $('#acumulado_formato').val(); 
                $('#valor_facturar').val($('#acumulado_formato').val());
            } 
            $('#valor_facturar').parent().show();                                                
            $('#valor_facturar').removeClass("campoInactivo").removeAttr("disabled","disabled"); 
            $('#numero_factura').parent().show();                                                
            $('#numero_factura').removeClass("campoInactivo").removeAttr("disabled","disabled");             
            $('#porcentaje_mano_obra').parent().show();                                                
            $('#porcentaje_mano_obra').removeClass("campoInactivo").removeAttr("disabled","disabled");
            $('#porcentaje_materiales').parent().show();                                                
            $('#porcentaje_materiales').removeClass("campoInactivo").removeAttr("disabled","disabled"); 
            $('#imagen').parent().show();                                                
            $('#imagen').removeClass("campoInactivo").removeAttr("disabled","disabled"); 
            $('#informes').parent().hide();
            $('#informes').addClass("campoInactivo").attr("disabled","disabled");
        }else if(valor == 4){
            $('#valor_facturar').parent().hide();
            $('#valor_facturar').addClass("campoInactivo").attr("disabled","disabled");
            $('#numero_factura').parent().hide();
            $('#numero_factura').addClass("campoInactivo").attr("disabled","disabled");
            $('#porcentaje_mano_obra').parent().hide();                                                     
            $('#porcentaje_mano_obra').addClass("campoInactivo").attr("disabled"); 
            $('#porcentaje_materiales').parent().hide();                                                     
            $('#porcentaje_materiales').addClass("campoInactivo").attr("disabled"); 
            $('#informes').parent().show();                                                
            $('#informes').removeClass("campoInactivo").removeAttr("disabled","disabled"); 
            $('#imagen').parent().hide();
            $('#imagen').addClass("campoInactivo").attr("disabled","disabled");
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


    
