    $(document).ready(function() {
        ejecutarFuncionesGlobales();
    });

    /*** Cargar datos si el requerimiento existe ***/
    function cargarDatos() {
        var id                = $('#id').val();
        var destino           = $('#URLFormulario').val();

        /*** Descargar contenido  ***/
        $.getJSON(destino, {recargar: true, id_carga: id}, function(datos){
            if (datos != ""){                                                                     
                $('#id').val(datos[0]);                                                           
                $('#id_sede').val(datos[1]);                                                     
                $('#tipo_solicitud').val(datos[2]);                                               
                $('#fecha_ingreso').val(datos[3]);                                                
                $('#descripcion').val(datos[4]);                                                                                                    
                $('#observaciones').val(datos[5]);                                                                                                
                $('#aiu').val(datos[6]);
                
                var aiu = $('#aiu').val(datos[6]);
                                                                                                                                                                                                                  
                if (datos[6] == 0){
                    $('#no_aiu').attr("checked","true")                                                                          
                    $('#porcentaje_administracion_cotizacion').parent().hide();                                                  
                    $('#porcentaje_administracion_cotizacion').addClass("campoInactivo").attr("disabled");              
                    $('#porcentaje_imprevistos_cotizacion').parent().hide();                                                     
                    $('#porcentaje_imprevistos_cotizacion').addClass("campoInactivo").attr("disabled");                 
                    $('#porcentaje_utilidad').parent().hide();                                                                     
                    $('#porcentaje_utilidad').addClass("campoInactivo").attr("disabled");                               
                    
                }else if(datos[6] == 1){
                    $('#si_aiu').attr("checked","true")                                                                        
                    $('#porcentaje_administracion_cotizacion').parent().show();                                                
                    $('#porcentaje_administracion_cotizacion').removeClass("campoInactivo").removeAttr("disabled","disabled");       
                    $('#porcentaje_imprevistos_cotizacion').parent().show();                                                   
                    $('#porcentaje_imprevistos_cotizacion').removeClass("campoInactivo").removeAttr("disabled","disabled");          
                    $('#porcentaje_utilidad').parent().show();                                                                 
                    $('#porcentaje_utilidad').removeClass("campoInactivo").removeAttr("disabled","disabled");                        
                    $('#impuesto').parent().show();                                                                            
                    $('#impuesto').removeClass("campoInactivo").removeAttr("disabled","disabled");                                   
                }
            }              
        });
    }; 
    
    
    /*** Desactivar o activar algunos campos dependiendo si escoje AIU ***/
    function activarAiu(valor){

        if (valor == 1){
            $('#porcentaje_administracion_cotizacion').parent().show();
            $('#porcentaje_administracion_cotizacion').removeClass("campoInactivo").removeAttr("disabled");
	        $('#porcentaje_imprevistos_cotizacion').parent().show();
            $('#porcentaje_imprevistos_cotizacion').removeClass("campoInactivo").removeAttr("disabled");
            $('#porcentajeutilidad').parent().show();
            $('#porcentajeutilidad').removeClass("campoInactivo").removeAttr("disabled");
            $('#impuesto').parent().show();
            $('#impuesto').removeClass("campoInactivo").removeAttr("disabled");
            $('#porcentaje_utilidad').parent().show();
            $('#porcentaje_utilidad').removeClass("campoInactivo").removeAttr("disabled");
            $('#costo_administracion_cotizacion').parent().show();
            $('#costo_administracion_cotizacion').removeClass("campoInactivo").removeAttr("disabled","disabled"); 
            $('#costo_imprevistos_cotizacion').parent().show();
            $('#costo_imprevistos_cotizacion').removeClass("campoInactivo").removeAttr("disabled","disabled"); 
            $('#costo_utilidad').parent().show();
            $('#costo_utilidad').removeClass("campoInactivo").removeAttr("disabled","disabled");
            $('#costo_impuesto').parent().show();
            $('#costo_impuesto').removeClass("campoInactivo").removeAttr("disabled","disabled"); 
            $('#porcentaje_administracion_cotizacion').val(0);
            $('#porcentaje_imprevistos_cotizacion').val(0);
            $('#porcentaje_utilidad').val(0);
            $('#costo_administracion_cotizacion').val(0);
            $('#costo_imprevistos_cotizacion').val(0);
            $('#costo_utilidad').val(0);
            $('#base_impuesto').val(0);
            $('#costo_impuesto').val(0);
            $('#porcentaje_anticipo').val(0);
            $('#sub_total').val(0);
            $('#total_general').val(0);
        } else if (valor == 0){
            $('#porcentaje_administracion_cotizacion').parent().hide();
            $('#porcentaje_administracion_cotizacion').addClass("campoInactivo").attr("disabled","disabled");
            $('#porcentaje_imprevistos_cotizacion').parent().hide();
            $('#porcentaje_imprevistos_cotizacion').addClass("campoInactivo").attr("disabled","disabled");
            $('#porcentaje_utilidad').parent().hide();
            $('#porcentaje_utilidad').addClass("campoInactivo").attr("disabled","disabled");
            $('#impuesto').parent().show();
            $('#impuesto').removeClass("campoInactivo").removeAttr("disabled");
            $('#costo_administracion_cotizacion').parent().hide();                                                               
            $('#costo_administracion_cotizacion').addClass("campoInactivo").attr("disabled","disabled");  
            $('#costo_imprevistos_cotizacion').parent().hide();                                                               
            $('#costo_imprevistos_cotizacion').addClass("campoInactivo").attr("disabled","disabled");  
            $('#costo_utilidad').parent().hide();                                                               
            $('#costo_utilidad').addClass("campoInactivo").attr("disabled","disabled");  
            $('#costo_impuesto').parent().show();                                                               
            $('#costo_impuesto').removeClass("campoInactivo").removeAttr("disabled","disabled");
            $('#porcentaje_administracion_cotizacion').val(0);
            $('#porcentaje_imprevistos_cotizacion').val(0);
            $('#porcentaje_utilidad').val(0);
            $('#costo_administracion_cotizacion').val(0);
            $('#costo_imprevistos_cotizacion').val(0);
            $('#costo_utilidad').val(0);
            $('#base_impuesto').val(0);
            $('#costo_impuesto').val(0);
            $('#porcentaje_anticipo').val(0);
            $('#sub_total').val(0);
            $('#total_general').val(0);
        }
        CalculaCostoImpuesto();
        CalculaAdministracion();
        CalculaImprevistos();
        CalculaUtilidad();
        if(valor == 0){
            $('#sub_total').val(0);
        } else {
            if(($('#porcentaje_utilidad').val()) == 0 ||
               ($('#costo_utilidad').val() == 0)
              ){
                $('#sub_total').val(0);
            }

        }


    };
    
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
    
    function CalculaCosto(){
        var valor1        = formato_numero($('#valor_mano_obra_cotizacion').val());        
        var valor2        = formato_numero($('#valor_materiales_cotizacion').val());
        var valorObra     = parseInt(valor1);
        var valorMaterial = parseInt(valor2);

        $('#PESTANA_COTIZACION').find('.costo_directo').each(function (margen) {                    
            var costo      = $('#costo_directo').val();
            var valorCosto = (parseInt(valorObra) + parseInt(valorMaterial));
            var valorMiles = ponerMiles(valorCosto);            
            $(this).val(valorMiles);
        });
        CalculaCostoImpuesto();
        CalculaAdministracion();
        CalculaImprevistos();
        CalculaUtilidad();
        if(($('#porcentaje_utilidad').val()) == 0 ||
           ($('#costo_utilidad').val() == 0)
          ){
            $('#sub_total').val(0);
        }
    };
    
    function CalculaCostoImpuesto(){
        var valor  = formato_numero($('#costo_directo').val());
        var valor1 = formato_numero($('#costo_administracion_cotizacion').val());
        var valor2 = formato_numero($('#costo_imprevistos_cotizacion').val());
        var valor3 = formato_numero($('#costo_utilidad').val());
        var valor4 = formato_numero($('#sub_total').val());
        var valor5 = formato_numero($('#costo_impuesto').val());
        var porcentajeImpuesto = $('#impuesto').val();

        var valor  = parseInt(valor);
        var valor1 = parseInt(valor1);
        var valor2 = parseInt(valor2);
        var valor3 = parseInt(valor3);
        var valor4 = parseInt(valor4);
        var valor5 = parseInt(valor5);
                
        if(valor3 > 0 && porcentajeImpuesto > 0){
            var baseImpuesto  = parseInt(valor3);
            var valorImpuesto = ((parseInt(valor3))*(parseInt(porcentajeImpuesto)))/100;
            //var valorImpuesto = redondearCentenas(((parseInt(valor3))*(parseInt(porcentajeImpuesto)))/100);
        }else{
            var baseImpuesto  = parseInt(valor);
            var valorImpuesto = ((parseInt(valor))*(parseInt(porcentajeImpuesto)))/100;
        }

        $('#PESTANA_COTIZACION').find('.costo_impuesto').each(function (margen) {                    
            var valorMiles = ponerMiles(baseImpuesto);
            $('#base_impuesto').val(valorMiles);
            valorImpuesto = parseInt(valorImpuesto);
            var valorMiles = ponerMiles(valorImpuesto);
            $(this).val(valorMiles);
        });
        
        var valor5 = formato_numero($('#costo_impuesto').val());
        var valorSubTotal = parseInt(valor1) + parseInt(valor2) + parseInt(valor3) + parseInt(valor5);
        var valorMiles = ponerMiles(valorSubTotal);
        $('#sub_total').val(valorMiles);
        /*$('#PESTANA_COTIZACION').find('.sub_total').each(function (margen) {
            valorAnterior = valorSubTotal;
            var valorMiles = ponerMiles(valorSubTotal);
            console.log(valorMiles);
            $(this).val(valorMiles);            
        });    */

        var subTotal = formato_numero($('#sub_total').val());
        var valorTotalGeneral  = parseInt(subTotal) + parseInt(valor);         
        $('#PESTANA_COTIZACION').find('.total_general').each(function (margen) {
            valorAnterior  = valorTotalGeneral;
            var valorMiles = ponerMiles(valorTotalGeneral);
            $(this).val(valorMiles);
        });

        if(porcentajeImpuesto == 0){
            $('#sub_total').val(0);
        }
    };
    
    function CalculaAdministracion(){
        var valor         = formato_numero($('#costo_directo').val());
        var valorAnterior = parseInt(valor);
        

        $('#PESTANA_COTIZACION').find('.costo_administracion_cotizacion').each(function (margen) {                    
            var porcentajeAdministracion = $('#porcentaje_administracion_cotizacion').val();
            var valorAdministracion      = parseInt(valorAnterior*(porcentajeAdministracion/100));
            valorAnterior                = valorAdministracion;
            var valorMiles               = ponerMiles(valorAdministracion);
            $(this).val(valorMiles);
        });               
        CalculaCostoImpuesto();
    };
    
    function CalculaImprevistos(){
        var valor         = formato_numero($('#costo_directo').val());
        var valorAnterior = parseInt(valor);

        $('#PESTANA_COTIZACION').find('.costo_imprevistos_cotizacion').each(function (margen) {                    
            var porcentajeImprevistos = $('#porcentaje_imprevistos_cotizacion').val();
            var valorImprevistos      = parseInt(valorAnterior*(porcentajeImprevistos/100));
            valorAnterior             = valorImprevistos;
            var valorMiles            = ponerMiles(valorImprevistos);
            $(this).val(valorMiles);
        });               
        CalculaCostoImpuesto();
    }
    
    function CalculaUtilidad(){
        var valor         = formato_numero($('#costo_directo').val());
        var valorAnterior = parseInt(valor);

        $('#PESTANA_COTIZACION').find('.costo_utilidad').each(function (margen) {                    
            var porcentajeUtilidad = $('#porcentaje_utilidad').val();
            var valorUtilidad      = parseInt(valorAnterior*(porcentajeUtilidad/100));
            valorAnterior          = valorUtilidad;
            var valorMiles         = ponerMiles(valorUtilidad);
            $(this).val(valorMiles);            
        });
        CalculaCostoImpuesto();
    };
    
    function redondearCentenas(numero) {
        var residuo = parseInt(numero % 100);
        var valor   = parseInt(numero - residuo);

        if (residuo > 50) {
            valor += 100;
        }

        return valor;
    };
