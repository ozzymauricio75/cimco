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
                $('#tipo_acta').val(datos[1]);
                
                var tipo_acta = $('#tipo_acta').val(datos[1]);
                                                                                                                                                                                                                  
                if (datos[1] != 1){                                                                        
                    $('#avance').attr("checked","true")
                    $('#valor_facturar').parent().show();                                                
                    $('#valor_facturar').removeClass("campoInactivo").removeAttr("disabled","disabled");
                    $('#facturado').parent().show();                                                
                    $('#facturado').removeClass("campoInactivo").removeAttr("disabled","disabled");   
                    $('#porcentaje_mano_obra').parent().show();                                                
                    $('#porcentaje_mano_obra').removeClass("campoInactivo").removeAttr("disabled","disabled");
                    $('#porcentaje_materiales').parent().show();                                                
                    $('#porcentaje_materiales').removeClass("campoInactivo").removeAttr("disabled","disabled");       
                    
                }else if(datos[1] == 1){
                    $('#inicio').attr("checked","true")
                    $('#valor_facturar').parent().hide();                                                     
                    $('#valor_facturar').addClass("campoInactivo").attr("disabled"); 
                    $('#facturado').parent().hide();                                                     
                    $('#facturado').addClass("campoInactivo").attr("disabled");                 
                }
            }              
        });
    } 
    
    
    /*** Desactivar o activar algunos campos dependiendo si escoje AIU ***/
    function activarValorFacturar(valor){

     if (valor != 1){
            $('#valor_facturar').parent().show();                                                
            $('#valor_facturar').removeClass("campoInactivo").removeAttr("disabled","disabled"); 
            $('#facturado').parent().show();                                                
            $('#facturado').removeClass("campoInactivo").removeAttr("disabled","disabled"); 
            $('#porcentaje_mano_obra').parent().show();                                                
            $('#porcentaje_mano_obra').removeClass("campoInactivo").removeAttr("disabled","disabled");
            $('#porcentaje_materiales').parent().show();                                                
            $('#porcentaje_materiales').removeClass("campoInactivo").removeAttr("disabled","disabled");       

        } else if (valor == 1){
            $('#valor_facturar').parent().hide();
            $('#valor_facturar').addClass("campoInactivo").attr("disabled","disabled");
            $('#facturado').parent().hide();
            $('#facturado').addClass("campoInactivo").attr("disabled","disabled");
        }
    }
    
    function removerItem(boton) {      
        var id     = $(boton).parents('tr').attr('id')[1];
        var precio = parseInt($("input[name='precios["+id+"]']").val());
        $(boton).parents('tr').remove();
        var valorAnterior = parseInt($('#precio_compra_total').val());
    }

    
