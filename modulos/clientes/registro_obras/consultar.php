<?php

/**
*
* Copyright (C) 2008 LinuxCali Ltda
* Francisco J. Lozano B. <pacho@linuxcali.com>
*
* Este archivo es parte de:
* PANCE :: Plataforma para la Administraci�n del Nexo Cliente-Empresa
*
* Este programa es software libre: usted puede redistribuirlo y/o
* modificarlo  bajo los t�rminos de la Licencia P�blica General GNU
* publicada por la Fundaci�n para el Software Libre, ya sea la versi�n 3
* de la Licencia, o (a su elecci�n) cualquier versi�n posterior.
*
* Este programa se distribuye con la esperanza de que sea �til, pero
* SIN GARANT�A ALGUNA; ni siquiera la garant�a impl�cita MERCANTIL o
* de APTITUD PARA UN PROP�SITO DETERMINADO. Consulte los detalles de
* la Licencia P�blica General GNU para obtener una informaci�n m�s
* detallada.
*
* Deber�a haber recibido una copia de la Licencia P�blica General GNU
* junto a este programa. En caso contrario, consulte:
* <http://www.gnu.org/licenses/>.
*
**/

/*** Generar el formulario para la captura de datos ***/
if (!empty($url_generar)) {
    $error  = "";
    $titulo = $componente->nombre;

    /*** Verificar que se haya enviado el ID del elemento a consultar ***/
    if (empty($url_id)) {
        $error     = $textos["ERROR_CONSULTAR_VACIO"];
        $titulo    = "";
        $contenido = "";

    } else {
        /*** Obtener los resultados para la pagina actual ***/
        $vistaRegistroObra                    = "registro_obras";                                                                                           
        $columnasRegistroObra                 = SQL::obtenerColumnas($vistaRegistroObra);                                                                   
        $consultaRegistroObra                 = SQL::seleccionar(array($vistaRegistroObra), $columnasRegistroObra, "id_cotizacion = '$url_id'");            
        $datosRegistroObra                    = SQL::filaEnObjeto($consultaRegistroObra);                                                                   
    
        $valor_facturado                      = number_format($datosRegistroObra->valor_facturar);                                                          
        $factura_consorciado                  = $datosRegistroObra->factura_consorciado;                                                                    
        $pago_cliente                         = $datosRegistroObra->pago_cliente;                                                                           
        $pago_consorciado                     = $datosRegistroObra->pago_consorciado;                                                                       
                                                                                                                                                            
        $vistaConsulta                   = "cotizaciones";                                                             
        $columnas                        = SQL::obtenerColumnas($vistaConsulta);                                       
        $consulta                        = SQL::seleccionar(array($vistaConsulta), $columnas, "id = '$url_id'");       
        $datos                           = SQL::filaEnObjeto($consulta);                                               
        $error                           = "";                                                                         
        $titulo                          = $componente->nombre;                                                        
        $subTotal                        = $datos->costo_administracion_cotizacion + $datos->costo_imprevistos_cotizacion + $datos->costo_utilidad  + $datos->costo_impuesto; 
        $totalGeneral                    = $subTotal + intval($datos->costo_directo);
        $valor_mano_obra_cotizacion     = number_format($datos->valor_mano_obra_cotizacion);
        $valor_materiales_cotizacion    = number_format($datos->valor_materiales_cotizacion);
        $costo_directo                  = number_format($datos->costo_directo);
        
        if (!empty($datos->porcentaje_administracion_cotizacion) &&
            $datos->porcentaje_administracion_cotizacion > 0){
            $base_administracion        = $textos["VALOR_BASE"];
            $simbolo_admin_porcentaje   = $textos["SIMBOLO_PORCENTAJE"];
            $simbolo_admin_peso         = $textos["SIMBOLO_PESO"];
            $valor_base_administracion  = $datos->costo_directo;
            $valor_base_administracion  = number_format($valor_base_administracion);
            $administracion             = $textos["PORCENTAJE_ADMINISTRACION_COTIZACION"];
            $porcentaje_administracion  = $datos->porcentaje_administracion_cotizacion;
            $texto_costo_administracion = $textos["VALOR_ADMINISTRACION_COTIZACION"];
            $costo_administracion       = number_format($datos->costo_administracion_cotizacion);
        } else{
            $base_administracion        = "";
            $simbolo_admin_porcentaje   = "";
            $simbolo_admin_peso         = "";
            $valor_base_administracion  = "";
            $administracion             = "";
            $porcentaje_administracion  = "";
            $texto_costo_administracion = "";
            $costo_administracion       = "";
        }
        if (!empty($datos->porcentaje_imprevistos_cotizacion) &&
            $datos->porcentaje_imprevistos_cotizacion > 0){
            $base_imprevistos        = $textos["VALOR_BASE"];
            $simbolo_impr_porcentaje = $textos["SIMBOLO_PORCENTAJE"];
            $simbolo_impr_peso       = $textos["SIMBOLO_PESO"];
            $valor_base_imprevistos  = $datos->costo_directo;
            $valor_base_imprevistos  = number_format($valor_base_imprevistos);
            $imprevistos             = $textos["PORCENTAJE_IMPREVISTOS_COTIZACION"];
            $porcentaje_imprevistos  = $datos->porcentaje_imprevistos_cotizacion;
            $texto_costo_imprevistos = $textos["VALOR_IMPREVISTOS_COTIZACION"];
            $costo_imprevistos       = number_format($datos->costo_imprevistos_cotizacion);
        } else{
            $base_imprevistos        = "";
            $simbolo_impr_porcentaje = "";
            $simbolo_impr_peso       = "";
            $valor_base_imprevistos  = "";
            $imprevistos             = "";
            $porcentaje_imprevistos  = "";
            $texto_costo_imprevistos = "";
            $costo_imprevistos       = "";
        }
        if (!empty($datos->porcentaje_utilidad) &&
            $datos->porcentaje_utilidad > 0){
            $base_utilidad           = $textos["VALOR_BASE"];
            $simbolo_util_porcentaje = $textos["SIMBOLO_PORCENTAJE"];
            $simbolo_util_peso       = $textos["SIMBOLO_PESO"];
            $valor_base_utilidad     = $datos->costo_directo;
            $valor_base_utilidad     = number_format($valor_base_utilidad);
            $utilidad                = $textos["PORCENTAJE_UTILIDAD"];
            $porcentaje_utilidad     = $datos->porcentaje_utilidad;
            $texto_costo_utilidad    = $textos["VALOR_UTILIDAD"];
            $costo_utilidad          = number_format($datos->costo_utilidad);
        } else{
            $base_utilidad           = "";
            $base_administracon      = "";
            $base_administracon      = "";
            $simbolo_util_porcentaje = "";
            $simbolo_util_peso       = "";
            $valor_base_utilidad     = "";
            $utilidad                = "";
            $porcentaje_utilidad     = "";
            $texto_costo_utilidad    = "";
            $costo_utilidad          = "";
        }
        if ((!empty($datos->porcentaje_utilidad) && $datos->porcentaje_utilidad > 0)){
            $base             = $datos->costo_utilidad;
            $titulo_subtotal  = $textos["SUB_TOTAL"];
            $simbolo_subtotal = $textos["SIMBOLO_PESO"];
            $subTotal         = $datos->costo_administracion_cotizacion + $datos->costo_imprevistos_cotizacion + $datos->costo_utilidad + $datos->costo_impuesto;
            $totalGeneral     = $subTotal + $datos->costo_directo;
        } else {
            $base             = $datos->costo_directo;
            $titulo_subtotal  = "";
            $simbolo_subtotal = "";
            $subTotal         = "";
            $totalGeneral     = $datos->costo_impuesto + $datos->costo_directo;
        }
        $base               = number_format($base);
        $costo_impuesto     = number_format($datos->costo_impuesto);
        $porcentajeAnticipo = ($totalGeneral * $datos->porcentaje_anticipo)/100;
        if($subTotal > 0){
            $subTotal = number_format($subTotal);
        }
        
        $estado                          = SQL::obtenerValor("buscador_cotizaciones", "estado", "id = '$url_id'");                                       
        $forma_pago                      = SQL::obtenerValor("buscador_cotizaciones", "forma_pago", "id = '$url_id'");                                   
                                                                                                                                                         
        $vistaRequerimiento             = "requerimientos_clientes";
        $columnasRequerimiento          = SQL::obtenerColumnas($vistaRequerimiento);
        $consultaRequerimiento          = SQL::seleccionar(array($vistaRequerimiento), $columnasRequerimiento, "id = '$datos->id_requerimiento'");
        $datosRequerimiento             = SQL::filaEnObjeto($consultaRequerimiento);
        $nombreSede                     = SQL::obtenerValor("sedes_clientes", "nombre_sede", "id = '$datosRequerimiento->id_sede'");                                           
        $municipio                      = SQL::obtenerValor("sedes_clientes", "id_municipios", "id = '$datosRequerimiento->id_sede'");
        
        $tipo_solicitud = array(
            "M" => $textos["MANTENIMIENTO"],
            "E" => $textos["EMERGENCIA"],
            "S" => $textos["SERVICIO"],
            "P" => $textos["PROYECTO"],
            "V" => $textos["VISITA"]
        );
        
        $nombreMunicipio                = SQL::obtenerValor("municipios", "nombre", "id = '$municipio'");                                               
        $id_sucursal                    = SQL::obtenerValor("requerimientos_clientes", "id_sucursal", "id = '$datos->id_requerimiento'");               
        $nombreSucursal                 = SQL::obtenerValor("sucursales", "nombre", "id = '$id_sucursal'"); 
        $acta                           = SQL::obtenerValor("registro_obras", "tipo_acta", "id_cotizacion = '$url_id'");
        $valor_facturar                 = SQL::obtenerValor("registro_obras", "valor_facturar", "id_cotizacion = '$url_id'");
                                                                                                                                                                                           
        $valor_facturar                       = SQL::obtenerValor("registro_obras", "valor_facturar", "id_cotizacion = '$url_id'");                                                                       
        $consulta                             = mysql_query("SELECT SUM(valor_facturar)AS valor FROM pance_registro_obras WHERE id_cotizacion = '$datosRegistroObra->id_cotizacion'");                    
        $resultado                            = mysql_fetch_object($consulta);                                                                                                                            
        $acumulado                            = $resultado->valor;                                                                                                                                        
        $acumulado                            = number_format($acumulado);                                                                                                                                

	    $vistaConsulta                        = "seleccion_registro_obras";                                                                                                                              
	    $alineacion                           = array("C","I","I","I","I","I","I","I","I","I");                                                                                                              
	    $columnas                             = SQL::obtenerColumnas($vistaConsulta);                                                                                                                    
	    $consulta                             = SQL::seleccionar(array($vistaConsulta), $columnas, "id = '$url_id'");                                                               
	    $tabla 	                              = HTML::generarTabla($columnas, $consulta, $alineacion, "seleccion_registro_obras");                                                                       
	      
        /*** Definici�n de pesta�as ***/
            $formularios["PESTANA_REQUERIMIENTO"] = array(
                array(   
                    HTML::mostrarDato("sucursal", $textos["SUCURSAL"], $nombreSucursal),
                    HTML::mostrarDato("numero_requerimiento", $textos["NUMERO_REQUERIMIENTO"], $datosRequerimiento->id)
                ),
                array(   
                    HTML::mostrarDato("nombre_sede", $textos["SEDE"], $nombreSede),
                    HTML::mostrarDato("municipio", $textos["MUNICIPIO"], $nombreMunicipio)
                ),            
                array(
                    HTML::mostrarDato("fecha_ingreso", $textos["FECHA_INGRESO"],$datosRequerimiento->fecha_ingreso),
                    HTML::mostrarDato("fecha_visita", $textos["FECHA_VISITA"],$datosRequerimiento->fecha_visita)
                ),
                array(
                    HTML::mostrarDato("tipo_solictud", $textos["TIPO_SOLICITUD"],$tipo_solicitud[$datosRequerimiento->tipo_solicitud]),
                ),
                array(
                    HTML::mostrarDato("descripcion", $textos["DESCRIPCION"], $datosRequerimiento->descripcion)
                ),
                array(    
                    HTML::mostrarDato("observaciones", $textos["OBSERVACIONES_VISITA"], $datosRequerimiento->observaciones_visita)
                ),
                array(
                    HTML::mostrarDato("nombre_contacto", $textos["CONTACTO"],$datosRequerimiento->nombre_contacto),
                    HTML::mostrarDato("telefono_contacto", $textos["TELEFONO_CONTACTO"],$datosRequerimiento->telefono_contacto)
                ),
                array(
                    HTML::mostrarDato("codigo_contable", $textos["CODIGO_CONTABLE"],$datosRequerimiento->codigo_contable)
                ),
                array(
                    HTML::mostrarDato("persona_recibe", $textos["PERSONA_RECIBE"],$datosRequerimiento->persona_recibe),
                    HTML::mostrarDato("medio_recibo", $textos["MEDIO_RECIBO"],$datosRequerimiento->medio_recibo)
                )
            );
  
            $formularios["PESTANA_COTIZACION"] = array(
                array(
                    HTML::mostrarDato("numero_cotizacion", $textos["NUMERO_COTIZACION"], $datos->numero_cotizacion."-".$datos->consecutivo_cotizacion),
                    HTML::mostrarDato("numero_cotizacion_consorciado", $textos["NUMERO_COTIZACION_CONSORCIADO"], $datos->numero_cotizacion_consorciado)
                ),
                array(    
                    HTML::mostrarDato("valor_mano_obra_cotizacion", $textos["VALOR_MANO_OBRA_COTIZACION"], $textos["SIMBOLO_PESO"].$valor_mano_obra_cotizacion),
                    HTML::mostrarDato("valor_materiales_cotizacion", $textos["VALOR_MATERIALES_COTIZACION"], $textos["SIMBOLO_PESO"].$valor_materiales_cotizacion),
                    HTML::mostrarDato("costo", $textos["COSTO_DIRECTO"], $textos["SIMBOLO_PESO"].$costo_directo),  
                ),
                array(
                    HTML::mostrarDato("porcentaje_administracion", $administracion, $porcentaje_administracion.$simbolo_admin_porcentaje),
                    HTML::mostrarDato("costo_administracion", $texto_costo_administracion, $simbolo_admin_peso.$costo_administracion)
                ),
                array(
                    HTML::mostrarDato("porcentaje_imprevistos", $imprevistos, $porcentaje_imprevistos.$simbolo_impr_porcentaje),
                    HTML::mostrarDato("costo_imprevistos", $texto_costo_imprevistos, $simbolo_impr_peso.$costo_imprevistos)
                ),
                array(
                    HTML::mostrarDato("porcentaje_utilidad", $utilidad, $porcentaje_utilidad.$simbolo_util_porcentaje),
                    HTML::mostrarDato("costo_utilidad", $texto_costo_utilidad, $simbolo_util_peso.$costo_utilidad)
                ),
                array(
                    HTML::mostrarDato("base", $textos["BASE_IMPUESTO"], $textos["SIMBOLO_PESO"].$base),
                    HTML::mostrarDato("impuesto", $textos["IMPUESTO"], $datos->impuesto.$textos["SIMBOLO_PORCENTAJE"]),
                    HTML::mostrarDato("costo_impuesto", $textos["VALOR_IMPUESTO"], $textos["SIMBOLO_PESO"].$costo_impuesto)
                ),
                array(
                    HTML::mostrarDato("sub_total", $titulo_subtotal, $simbolo_subtotal.$subTotal),
                ),
                array(
                    HTML::mostrarDato("total_general", $textos["TOTAL_GENERAL"], $textos["SIMBOLO_PESO"].number_format($totalGeneral))
                )
            );
            
            $formularios["PESTANA_ACTAS"] = array(
	              array(
	                  HTML::contenedor($tabla)
	              ),
	              array(
                    HTML::mostrarDato("acumulado", $textos["ACUMULADO"], $textos["SIMBOLO_PESO"].$acumulado),
                    HTML::mostrarDato("total_general", $textos["TOTAL_GENERAL"], $textos["SIMBOLO_PESO"].number_format($totalGeneral))
                )
            );

            $contenido = HTML::generarPestanas($formularios);
    }

    /*** Enviar datos para la generaci�n del formulario al script que origin� la petici�n ***/
    $respuesta    = array();
    $respuesta[0] = $error;
    $respuesta[1] = $titulo;
    $respuesta[2] = $contenido;
    HTTP::enviarJSON($respuesta);
}
?>