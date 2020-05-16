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
                    $('#no_aiu').attr("checked","true");
                    $('#porcentaje_administracion_cotizacion').parent().hide();
                    $('#porcentaje_administracion_cotizacion').addClass("campoInactivo").attr("disabled");
                    $('#porcentaje_imprevistos_cotizacion').parent().hide();
                    $('#porcentaje_imprevistos_cotizacion').addClass("campoInactivo").attr("disabled");
                    $('#porcentaje_utilidad').parent().hide();
                    $('#porcentaje_utilidad').addClass("campoInactivo").attr("disabled");

                }else if(datos[6] == 1){
                    $('#si_aiu').attr("checked","true");
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
            if(($('#porcentaje_utilidad').val(0)) == 0 ||
               ($('#costo_utilidad').val(0) == 0)
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

        var valor = parseInt(valor);
        var valor1 = parseInt(valor1);
        var valor2 = parseInt(valor2);
        var valor3 = parseInt(valor3);
        var valor4 = parseInt(valor4);
        var valor5 = parseInt(valor5);

        if(valor3 > 0 && porcentajeImpuesto > 0){
            var baseImpuesto  = parseInt(valor3);
            //var valorImpuesto = redondearCentenas(((parseInt(valor3))*(parseInt(porcentajeImpuesto)))/100);
            var valorImpuesto = ((parseInt(valor3))*(parseInt(porcentajeImpuesto)))/100;
        }else{
            var baseImpuesto  = parseInt(valor);
            //var valorImpuesto = redondearCentenas(((parseInt(valor))*(parseInt(porcentajeImpuesto)))/100);
            var valorImpuesto = ((parseInt(valor))*(parseInt(porcentajeImpuesto)))/100;
        }
        
        var subTotal = parseInt(valorImpuesto) + parseInt(valor) + parseInt(valor1) + parseInt(valor2) + parseInt(valor3);
        
        $('#PESTANA_COTIZACION').find('.costo_impuesto').each(function (margen) {
            var valorMiles = ponerMiles(baseImpuesto);
            $('#base_impuesto').val(valorMiles);
            valorImpuesto = parseInt(valorImpuesto);
            var valorMiles = ponerMiles(valorImpuesto);
            $(this).val(valorMiles);
        });

        var valor5 = formato_numero($('#costo_impuesto').val());
        var valorSubTotal = parseInt(valor1) + parseInt(valor2) + parseInt(valor3) + parseInt(valor5);
        $('#PESTANA_COTIZACION').find('.sub_total').each(function (margen) {
            valorAnterior = valorSubTotal;
            var valorMiles = ponerMiles(valorSubTotal);
            $(this).val(valorMiles);
        });

        //var subTotal = formato_numero($('#sub_total').val());
        var valorTotalGeneral  = parseInt(subTotal);
        $('#PESTANA_COTIZACION').find('.total_general').each(function (margen) {
            valorAnterior  = valorTotalGeneral;
            var valorMiles = ponerMiles(valorTotalGeneral);
            $(this).val(valorMiles);
            $('#total_general').val(valorMiles);
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
    };

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

    /*** Adicionar cotizaciones en tabla ***/
    function agregarItem() {
        var id                                  = new Date();
        var requerimiento_tabla                 = $('#requerimiento').val();

        var numero_cotizacion_tabla             = $('#numero_cotizacion').val();
        var consecutivo_cotizacion_tabla        = $('#consecutivo_cotizacion').val();
        var numero_cotizacion_consorciado_tabla = $('#numero_cotizacion_consorciado').val();

        var valor_mano_obra_directa_tabla       = formato_numero($('#valor_mano_obra_cotizacion').val());
        var valor_materiales_tabla              = formato_numero($('#valor_materiales_cotizacion').val());
        var costo_directo_tabla                 = formato_numero($('#costo_directo').val());

        var porcentaje_administracion_tabla     = formato_numero($('#porcentaje_administracion_cotizacion').val());
        var porcentaje_imprevistos_tabla        = formato_numero($('#porcentaje_imprevistos_cotizacion').val());
        var porcentaje_utilidad_tabla           = formato_numero($('#porcentaje_utilidad').val());

        var costo_administracion_tabla          = formato_numero($('#costo_administracion_cotizacion').val());
        var costo_imprevistos_tabla             = formato_numero($('#costo_imprevistos_cotizacion').val());
        var costo_utilidad_tabla                = formato_numero($('#costo_utilidad').val());
        
        var impuesto_tabla                      = formato_numero($('#impuesto').val());
        var costo_impuesto_tabla                = formato_numero($('#costo_impuesto').val());

        var fecha_cotizacion_consorciado_tabla  = ($('#fecha_cotizacion_consorciado').val());
        var fecha_visita_tabla                  = ($('#fecha_visita').val());
        var observaciones_visita_tabla          = ($('#observaciones_visita_consorciado').val());

        var valor_mano_obra_directa = ponerMiles(valor_mano_obra_directa_tabla);
        var valor_materiales        = ponerMiles(valor_materiales_tabla);
        var costo_directo           = ponerMiles(costo_directo_tabla);
        var costo_administracion    = ponerMiles(costo_administracion_tabla);
        var costo_imprevistos       = ponerMiles(costo_imprevistos_tabla);
        var costo_utilidad          = ponerMiles(costo_utilidad_tabla);
        var costo_impuesto          = ponerMiles(costo_impuesto_tabla);

        if (costo_utilidad_tabla > 0 && porcentaje_utilidad_tabla > 0){
            var base_impuesto = costo_utilidad_tabla;
            var subtotal      = parseInt(costo_administracion_tabla) + parseInt(costo_imprevistos_tabla) + parseInt(costo_utilidad_tabla) + parseInt(costo_impuesto_tabla);
            var total         = parseInt(subtotal) + parseInt(costo_directo_tabla);
            var activar_aiu   = 1;
        } else {
            var base_impuesto = costo_directo_tabla;
            var subtotal      = 0;
            var total         = parseInt(costo_impuesto_tabla) + parseInt(costo_directo_tabla);
            var activar_aiu   = 0;
        }
        base_impuesto = ponerMiles(base_impuesto);
        subtotal      = ponerMiles(subtotal);
        total         = ponerMiles(total);
        if (numero_cotizacion_tabla &&
            numero_cotizacion_consorciado_tabla &&
            (
             (
              valor_mano_obra_directa_tabla > 0 ||
              valor_materiales_tabla == 0
             ) ||
             (
              valor_mano_obra_directa_tabla == 0 ||
              valor_materiales_tabla > 0
             )
            ) &&
            costo_directo_tabla > 0 &&
            impuesto_tabla > 0 &&
            costo_impuesto_tabla > 0)
            {
            var boton  = $('#removedor').html();
            var boton2 = $('#modificador').html();
            var item  = '<tr id="'+id+'">'+
                        '<td align="center">'+
                        '<input type="hidden" name="requerimiento_tabla[]" value="'+requerimiento_tabla+'">'+
                        '<input type="hidden" name="requerimiento_modificar['+id+']" value="'+requerimiento_tabla+'">'+
                        '<input type="hidden" name="numero_cotizacion_tabla[]" value="'+numero_cotizacion_tabla+'">'+
                        '<input type="hidden" name="numero_cotizacion_modificar['+id+']" value="'+numero_cotizacion_tabla+'">'+
                        '<input type="hidden" name="consecutivo_cotizacion_tabla[]" value="'+consecutivo_cotizacion_tabla+'">'+
                        '<input type="hidden" name="consecutivo_cotizacion_modificar['+id+']" value="'+consecutivo_cotizacion_tabla+'">'+
                        '<input type="hidden" name="numero_cotizacion_consorciado_tabla[]" value="'+numero_cotizacion_consorciado_tabla+'">'+
                        '<input type="hidden" name="numero_cotizacion_consorciado_modificar['+id+']" value="'+numero_cotizacion_consorciado_tabla+'">'+
                        '<input type="hidden" name="valor_mano_obra_directa_tabla[]" value="'+valor_mano_obra_directa_tabla+'">'+
                        '<input type="hidden" name="valor_mano_obra_directa_modificar['+id+']" value="'+valor_mano_obra_directa_tabla+'">'+
                        '<input type="hidden" name="valor_materiales_tabla[]" value="'+valor_materiales_tabla+'">'+
                        '<input type="hidden" name="valor_materiales_modificar['+id+']" value="'+valor_materiales_tabla+'">'+
                        '<input type="hidden" name="costo_directo_tabla[]" value="'+costo_directo_tabla+'">'+
                        '<input type="hidden" name="costo_directo_modificar['+id+']" value="'+costo_directo_tabla+'">'+
                        '<input type="hidden" name="porcentaje_administracion_tabla[]" value="'+porcentaje_administracion_tabla+'">'+
                        '<input type="hidden" name="porcentaje_administracion_modificar['+id+']" value="'+porcentaje_administracion_tabla+'">'+
                        '<input type="hidden" name="porcentaje_imprevistos_tabla[]" value="'+porcentaje_imprevistos_tabla+'">'+
                        '<input type="hidden" name="porcentaje_imprevistos_modificar['+id+']" value="'+porcentaje_imprevistos_tabla+'">'+
                        '<input type="hidden" name="porcentaje_utilidad_tabla[]" value="'+porcentaje_utilidad_tabla+'">'+
                        '<input type="hidden" name="porcentaje_utilidad_modificar['+id+']" value="'+porcentaje_utilidad_tabla+'">'+
                        '<input type="hidden" name="costo_administracion_tabla[]" value="'+costo_administracion_tabla+'">'+
                        '<input type="hidden" name="costo_administracion_modificar['+id+']" value="'+costo_administracion_tabla+'">'+
                        '<input type="hidden" name="costo_imprevistos_tabla[]" value="'+costo_imprevistos_tabla+'">'+
                        '<input type="hidden" name="costo_imprevistos_modificar['+id+']" value="'+costo_imprevistos_tabla+'">'+
                        '<input type="hidden" name="costo_utilidad_tabla[]" value="'+costo_utilidad_tabla+'">'+
                        '<input type="hidden" name="costo_utilidad_modificar['+id+']" value="'+costo_utilidad_tabla+'">'+
                        '<input type="hidden" name="impuesto_tabla[]" value="'+impuesto_tabla+'">'+
                        '<input type="hidden" name="impuesto_modificar['+id+']" value="'+impuesto_tabla+'">'+
                        '<input type="hidden" name="costo_impuesto_tabla[]" value="'+costo_impuesto_tabla+'">'+
                        '<input type="hidden" name="costo_impuesto_modificar['+id+']" value="'+costo_impuesto_tabla+'">'+
                        '<input type="hidden" name="fecha_cotizacion_consorciado_tabla[]" value="'+fecha_cotizacion_consorciado_tabla+'">'+
                        '<input type="hidden" name="fecha_cotizacion_consorciado_modificar['+id+']" value="'+fecha_cotizacion_consorciado_tabla+'">'+
                        '<input type="hidden" name="fecha_visita_tabla[]" value="'+fecha_visita_tabla+'">'+
                        '<input type="hidden" name="fecha_visita_modificar['+id+']" value="'+fecha_visita_tabla+'">'+
                        '<input type="hidden" name="observaciones_visita_tabla[]" value="'+observaciones_visita_tabla+'">'+
                        '<input type="hidden" name="observaciones_visita_modificar['+id+']" value="'+observaciones_visita_tabla+'">'+boton+' '+boton2+'</td>'+
                        '<td class="dato" align="left">'+numero_cotizacion_tabla+'</td>'+
                        '<td class="dato" align="left">'+consecutivo_cotizacion_tabla+'</td>'+
                        '<td class="dato" align="left">'+numero_cotizacion_consorciado_tabla+'</td>'+
                        '<td class="dato" align="left">'+valor_mano_obra_directa+'</td>'+
                        '<td class="dato" align="left">'+valor_materiales+'</td>'+
                        '<td class="dato" align="left">'+costo_directo+'</td>'+
                        '<td class="dato" align="left">'+porcentaje_administracion_tabla+'</td>'+
                        '<td class="dato" align="left">'+costo_administracion+'</td>'+
                        '<td class="dato" align="left">'+porcentaje_imprevistos_tabla+'</td>'+
                        '<td class="dato" align="left">'+costo_imprevistos+'</td>'+
                        '<td class="dato" align="left">'+porcentaje_utilidad_tabla+'</td>'+
                        '<td class="dato" align="left">'+costo_utilidad+'</td>'+
                        '<td class="dato" align="left">'+base_impuesto+'</td>'+
                        '<td class="dato" align="left">'+impuesto_tabla+'</td>'+
                        '<td class="dato" align="left">'+costo_impuesto+'</td>'+
                        '<td class="dato" align="left">'+subtotal+'</td>'+
                        '<td class="dato" align="left">'+total+'</td></tr>';
                        '<td class="dato" align="left">'+fecha_visita_tabla+'</td>'+
                        '<td class="dato" align="left">'+observaciones_visita_tabla+'</td>'+

            $('#listaItems').append(item);
            $('#valor_mano_obra_cotizacion').val(0);
            $('#valor_materiales_cotizacion').val(0);
            $('#costo_directo').val(0);

            activarAiu(activar_aiu);
            
            if(activar_aiu == 1){
                $('#si_aiu').attr("checked","true");
                $('#aiu').val(activar_aiu);
            } else {
                $('#no_aiu').attr("checked","true");
                $('#aiu').val(activar_aiu);
            }

            var consecutivo = parseInt(consecutivo_cotizacion_tabla) + 1;
            $('#consecutivo_cotizacion').val(consecutivo);
        }
    };

    function removerItem(boton) {
        $(boton).parents('tr').remove();
    };

    function modificarCotizacion(boton) {
        var id = $(boton).parents('tr').attr('id').split('_')[0];

        if (id == 'fila'){
            var id = $(boton).parents('tr').attr('id').split('_')[1];
        }

        var numero_cotizacion             = $("input[name='numero_cotizacion_modificar["+id+"]']").val();
        var consecutivo_cotizacion        = $("input[name='consecutivo_cotizacion_modificar["+id+"]']").val();
        var numero_cotizacion_consorciado = $("input[name='numero_cotizacion_consorciado_modificar["+id+"]']").val();

        var valor_mano_obra_directa       = ponerMiles($("input[name='valor_mano_obra_directa_modificar["+id+"]']").val());
        var valor_materiales              = ponerMiles($("input[name='valor_materiales_modificar["+id+"]']").val());
        var costo_directo                 = ponerMiles($("input[name='costo_directo_modificar["+id+"]']").val());
        var costo_directo_2               = $("input[name='costo_directo_modificar["+id+"]']").val();

        var porcentaje_administracion     = $("input[name='porcentaje_administracion_modificar["+id+"]']").val();
        var costo_administracion          = ponerMiles($("input[name='costo_administracion_modificar["+id+"]']").val());
        var costo_administracion_2        = $("input[name='costo_administracion_modificar["+id+"]']").val();

        var porcentaje_imprevistos        = $("input[name='porcentaje_imprevistos_modificar["+id+"]']").val();
        var costo_imprevistos             = ponerMiles($("input[name='costo_imprevistos_modificar["+id+"]']").val());
        var costo_imprevistos_2           = $("input[name='costo_imprevistos_modificar["+id+"]']").val();

        var porcentaje_utilidad           = $("input[name='porcentaje_utilidad_modificar["+id+"]']").val();
        var costo_utilidad                = ponerMiles($("input[name='costo_utilidad_modificar["+id+"]']").val());
        var costo_utilidad_2              = $("input[name='costo_utilidad_modificar["+id+"]']").val();

        var impuesto                      = $("input[name='impuesto_modificar["+id+"]']").val();
        var costo_impuesto               = ponerMiles($("input[name='costo_impuesto_modificar["+id+"]']").val());
        var costo_impuesto_2                = $("input[name='costo_impuesto_modificar["+id+"]']").val();

        var fecha_visita                  = $("input[name='fecha_visita_modificar["+id+"]']").val();
        var observaciones_visita          = $("input[name='observaciones_visita_modificar["+id+"]']").val();

        if (costo_utilidad_2 > 0 && porcentaje_utilidad > 0){
            var base_impuesto = costo_utilidad_2;
            var subtotal      = parseInt(costo_administracion_2) + parseInt(costo_imprevistos_2) + parseInt(costo_utilidad_2) + parseInt(costo_impuesto_2);
            var total         = parseInt(subtotal) + parseInt(costo_directo_2);
            var activar_aiu   = 1;
        } else {
            var base_impuesto = costo_directo_2;
            var subtotal      = 0;
            var total         = parseInt(costo_impuesto_2) + parseInt(costo_directo_2);
            var activar_aiu   = 0;
        }
        base_impuesto = ponerMiles(base_impuesto);
        subtotal      = ponerMiles(subtotal);
        total         = ponerMiles(total);

        activarAiu(activar_aiu);
        
        if(activar_aiu == 1){
            $('#si_aiu').attr("checked","true");
            $('#aiu').val(activar_aiu);
        } else {
            $('#no_aiu').attr("checked","true");
            $('#aiu').val(activar_aiu);
        }

        $('#numero_cotizacion').val(numero_cotizacion);
        $('#consecutivo_cotizacion').val(consecutivo_cotizacion);
        $('#numero_cotizacion_consorciado').val(numero_cotizacion_consorciado);
        $('#valor_mano_obra_cotizacion').val(valor_mano_obra_directa);
        $('#valor_materiales_cotizacion').val(valor_materiales);
        $('#costo_directo').val(costo_directo);
        $('#porcentaje_administracion_cotizacion').val(porcentaje_administracion);
        $('#porcentaje_imprevistos_cotizacion').val(porcentaje_imprevistos);
        $('#porcentaje_utilidad').val(porcentaje_utilidad);
        $('#costo_administracion_cotizacion').val(costo_administracion);
        $('#costo_imprevistos_cotizacion').val(costo_imprevistos);
        $('#costo_utilidad').val(costo_utilidad);
        $('#impuesto').val(impuesto);
        $('#base_impuesto').val(base_impuesto);
        $('#costo_impuesto').val(costo_impuesto);
        $('#porcentaje_anticipo').val(0);
        $('#sub_total').val(subtotal);
        $('#total_general').val(total);
        $('#fecha_visita').val(fecha_visita);
        $('#observaciones_visita').val(observaciones_visita);

        $(boton).parents('tr').remove();
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
