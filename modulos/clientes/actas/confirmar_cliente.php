<?php

/**
*
* Copyright (C) 2008 LinuxCali Ltda
* Francisco J. Lozano B. <pacho@linuxcali.com>
* Mauricio Oidor L. <ozzymauricio75@gmail.com>
*
* Este archivo es parte de:
* PANCE :: Plataforma para la Administración del Nexo Cliente-Empresa
*
* Este programa es software libre: usted puede redistribuirlo y/o
* modificarlo  bajo los términos de la Licencia Pública General GNU
* publicada por la Fundación para el Software Libre, ya sea la versión 3
* de la Licencia, o (a su elección) cualquier versión posterior.
*
* Este programa se distribuye con la esperanza de que sea útil, pero
* SIN GARANTÍA ALGUNA; ni siquiera la garantía implícita MERCANTIL o
* de APTITUD PARA UN PROPÓSITO DETERMINADO. Consulte los detalles de
* la Licencia Pública General GNU para obtener una información más
* detallada.
*
* Debería haber recibido una copia de la Licencia Pública General GNU
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
        $vistaRegistroObra               = "registro_obras";
        $columnasRegistroObra            = SQL::obtenerColumnas($vistaRegistroObra);
        $consultaRegistroObra            = SQL::seleccionar(array($vistaRegistroObra), $columnasRegistroObra, "id = '$url_id' ");
        $datosRegistroObra               = SQL::filaEnObjeto($consultaRegistroObra);
        
        $consulta                        = SQL::seleccionar(array("imagenes"), array("id","ancho","alto"), "id_asociado = '$url_id' AND categoria = '2'");
        $imagen                          = SQL::filaEnObjeto($consulta);

        $acta                            = SQL::obtenerValor("registro_obras", "tipo_acta", "id = '$url_id'");
        $valor_facturar                  = SQL::obtenerValor("registro_obras", "valor_facturar", "id = '$url_id'");
       
        $consulta                        = mysql_query("SELECT SUM(valor_facturar)AS valor FROM pance_registro_obras WHERE id = '$url_id'");
        $resultado                       = mysql_fetch_object($consulta);
        $acumulado                       = $resultado->valor;
        
        $vistaConsulta                   = "cotizaciones";                                                             
        $columnas                        = SQL::obtenerColumnas($vistaConsulta);                                       
        $consulta                        = SQL::seleccionar(array($vistaConsulta), $columnas, "id = '$datosRegistroObra->id_cotizacion'");       
        $datos                           = SQL::filaEnObjeto($consulta);                                               
        $error                           = "";                                                                         
        $titulo                          = $componente->nombre;

        $valor_mano_obra_cotizacion  = number_format($datos->valor_mano_obra_cotizacion);
        $valor_materiales_cotizacion    = number_format($datos->valor_materiales_cotizacion);
        $costo_directo = number_format($datos->costo_directo);
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
        
        $estado                          = SQL::obtenerValor("buscador_cotizaciones", "estado", "id = '$datosRegistroObra->id_cotizacion'");                                       
        $forma_pago                      = SQL::obtenerValor("buscador_cotizaciones", "forma_pago", "id = '$datosRegistroObra->id_cotizacion'");                                   
                                                                                                                                                         
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
        
        $tipo_acta = array(
            "1" => $textos["ACTA_INICIO"],
            "2" => $textos["ACTA_AVANCE_OBRA"],
            "3" => $textos["ACTA_FINALIZACION"]
        );
        
        $estado_pagos = array(
            "0" => $textos["NO"],
            "1" => $textos["SI"]
        );
        
        }if($datosRegistroObra->pago_cliente == 1){
            $error     = $textos["ERROR_ACTA_PAGADA"];
	        $titulo    = "";
	        $contenido = "";
        } else {

            /*** Definición de pestañas ***/
            $formularios["PESTANA_REQUERIMIENTO"] = array(
                array(   
                    HTML::mostrarDato("sucursal", $textos["SUCURSAL"], $nombreSucursal),
                    HTML::mostrarDato("numero_requerimiento", $textos["NUMERO_REQUERIMIENTO"], $datosRequerimiento->id),
                ),
                array(   
                    HTML::mostrarDato("nombre_sede", $textos["SEDE"], $nombreSede),
                    HTML::mostrarDato("municipio", $textos["MUNICIPIO"], $nombreMunicipio)
                ),            
                array(
                    HTML::mostrarDato("fecha_ingreso", $textos["FECHA_INGRESO"],$datosRequerimiento->fecha_ingreso),
                    HTML::mostrarDato("fecha_limte_visita", $textos["FECHA_LIMITE_VISITA"],$datosRequerimiento->fecha_limite_visita)
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
                    HTML::mostrarDato("mano_obra_cotizacion", $textos["VALOR_MANO_OBRA_COTIZACION"], $textos["SIMBOLO_PESO"].$valor_mano_obra_cotizacion),
                    HTML::mostrarDato("materiales_cotizacion", $textos["VALOR_MATERIALES_COTIZACION"], $textos["SIMBOLO_PESO"].$valor_materiales_cotizacion),
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
          
            /*** Definición de pestañas ***/
            $formularios["PESTANA_DATOS_ACTA"] = array(
                array(   
                    HTML::mostrarDato("tipo_acta", $textos["TIPO_ACTA"], $tipo_acta[$datosRegistroObra->tipo_acta])
                ),
                array(   
                    HTML::mostrarDato("fecha_entrega_acta", $textos["FECHA_ENTREGA_ACTA"], $datosRegistroObra->fecha_entrega_acta)
                ),
                array(   
                    HTML::mostrarDato("numero_factura", $textos["NUMERO_FACTURA"], $datosRegistroObra->numero_factura)
                ),
                array(   
                    HTML::mostrarDato("valor_facturar", $textos["VALOR_FACTURAR"], $textos["SIMBOLO_PESO"].number_format($datosRegistroObra->valor_facturar))
                ),
                array(
                    HTML::mostrarDato("porcentaje_mano_obra", $textos["PORCENTAJE_MANO_OBRA"], $datosRegistroObra->porcentaje_mano_obra.$textos["SIMBOLO_PORCENTAJE"])
                ),
                array(    
                    HTML::mostrarDato("porcentaje_materiales", $textos["PORCENTAJE_MATERIALES"], $datosRegistroObra->porcentaje_materiales.$textos["SIMBOLO_PORCENTAJE"])
                ), 
                array(
                    HTML::campoTextoCorto("valor_factura_cliente", $textos["VALOR_CANCELADO"], 12, 15, 0, array("title" => $textos["AYUDA_VALOR_CANCELADO"],"class" => "numero")),  
                ),           
                array(
  	                HTML::campoOculto("requerimiento", $datos->id_requerimiento),
  	                HTML::campoOculto("id_acta", $url_id),
  	                HTML::campoOculto("acumulado", $acumulado),
  	                HTML::campoOculto("total_general", $totalGeneral),
  	                HTML::campoOculto("valor_facturar", $datosRegistroObra->valor_facturar),
  	                HTML::campoOculto("numero_factura", $datosRegistroObra->numero_factura),
  	                HTML::campoOculto("valor_mano_obra_cotizacion", $datos->valor_mano_obra_cotizacion),
  	                HTML::campoOculto("valor_materiales_cotizacion", $datos->valor_materiales_cotizacion),
  	                HTML::campoOculto("porcentaje_mano_obra", $datosRegistroObra->porcentaje_mano_obra),
  	                HTML::campoOculto("porcentaje_materiales", $datosRegistroObra->porcentaje_materiales),
  	                HTML::campoOculto("porcentaje_administracion_cotizacion", $datos->porcentaje_administracion_cotizacion),
  	                HTML::campoOculto("costo_administracion_cotizacion", $datos->costo_administracion_cotizacion),
  	                HTML::campoOculto("porcentaje_imprevistos_cotizacion", $datos->porcentaje_imprevistos_cotizacion),
  	                HTML::campoOculto("costo_imprevistos_cotizacion", $datos->costo_imprevistos_cotizacion),
  	                HTML::campoOculto("impuesto", $datos->impuesto),
  	                HTML::campoOculto("costo_impuesto", $datos->costo_impuesto),
  	                HTML::campoOculto("porcentaje_utilidad", $datos->porcentaje_utilidad),
  	                HTML::campoOculto("costo_utilidad", $datos->costo_utilidad),
                    HTML::campoOculto("sucursal",$nombreSucursal),
                    HTML::campoOculto("id_sucursal",$id_sucursal),
                    HTML::campoOculto("sede",$nombreSede),
                    HTML::campoOculto("solicitud",$datosRequerimiento->tipo_solicitud),
                    HTML::campoOculto("descripcion",$datosRequerimiento->descripcion),
                    HTML::campoOculto("tipo_acta",$acta),
                    HTML::campoOculto("fecha_entrega_acta", $datosRegistroObra->fecha_entrega_acta)
                )
            );
            
            if ($imagen) {
                $formularios["PESTANA_IMAGEN"] = array(
                    array(
                        HTML::imagen(HTTP::generarURL("VISUIMAG")."&id=".$imagen->id, array("width" => $imagen->ancho, "height" => $imagen->alto))
                    )
                );
            }
            /*** Definición de botones ***/
            $botones = array(
    	          HTML::boton("botonAceptar", $textos["EXPORTAR"], "exportarDatos();", "aceptar", array("class" => "pdf"))
            );

            $contenido = HTML::generarPestanas($formularios, $botones);
    }   
    /*** Enviar datos para la generación del formulario al script que originó la petición ***/
    $respuesta[0] = $error;
    $respuesta[1] = $titulo;
    $respuesta[2] = $contenido;
    HTTP::enviarJSON($respuesta);
    exit();
    
} elseif (!empty($forma_procesar)) {
    $error   = false;
    $mensaje = $textos["ITEM_ENVIADO"];

    $tipo_solicitud = array(
        "M" => $textos["MANTENIMIENTO"],
        "E" => $textos["EMERGENCIA"],
        "S" => $textos["SERVICIO"],
        "P" => $textos["PROYECTO"],
        "V" => $textos["VISITA"]
    );
    
    /*** Quitar separador de miles a un numero ***/
    function quitarMiles($cadena){
        $valor = array();
        for ($i = 0; $i < strlen($cadena); $i++) {
            if (substr($cadena, $i, 1) != ",") {
                $valor[$i] = substr($cadena, $i, 1);
            }
        }
        $valor = implode($valor);
        return $valor;
    }
    
    $forma_total_general = quitarMiles($forma_total_general);
    $forma_valor_factura_cliente = quitarMiles($forma_valor_factura_cliente);
    
    
    if(($forma_tipo_acta != '1') && ($forma_valor_facturar != $forma_total_general)){
        $porcentaje_participa_mano_obra  = (($forma_valor_mano_obra_cotizacion / $forma_total_general) * 100);
        $porcentaje_participa_materiales = (($forma_valor_materiales_cotizacion / $forma_total_general) * 100);
        $valor_mano_obra_cliente         = (($forma_valor_factura_cliente * $porcentaje_participa_mano_obra) / 100);
        $valor_materiales_cliente        = (($forma_valor_factura_cliente * $porcentaje_participa_materiales) / 100);
    
    }else{
        $valor_consorciado_mano_obra  = (($forma_valor_mano_obra_cotizacion * $forma_porcentaje_mano_obra) / 100);
        $valor_consorciado_materiales = (($forma_valor_materiales_cotizacion * $forma_porcentaje_materiales) / 100);
    }

    if (empty($forma_porcentaje_administracion_cotizacion)){
        $forma_porcentaje_administracion_cotizacion = 0;
        $forma_porcentaje_imprevistos_cotizacion    = 0;
        $forma_porcentaje_utilidad                  = 0;
        $forma_costo_administracion_cotizacion      = 0;
        $forma_costo_imprevistos_cotizacion         = 0;
        $forma_costo_utilidad                       = 0;           
        $total_aiu                                  = 0;
    } else {
        $total_aiu = $forma_costo_administracion_cotizacion + $forma_costo_imprevistos_cotizacion + $forma_costo_utilidad;
    }

    $costo_directo            = $forma_valor_mano_obra_cotizacion + $forma_valor_materiales_cotizacion;
    $iva                      = $forma_costo_impuesto;
    $porcentaje_participacion = $forma_valor_factura_cliente / ($costo_directo + $iva + $total_aiu);
    if ($porcentaje_participacion>1){
        $porcentaje_participacion = 1;
    }
        
    $valor_mano_obra          = $forma_valor_mano_obra_cotizacion * $porcentaje_participacion;
    $valor_mano_obra          = ($valor_mano_obra * $forma_porcentaje_mano_obra) / 100;
    $valor_materiales         = $forma_valor_materiales_cotizacion * $porcentaje_participacion;
    $valor_materiales         = ($valor_materiales * $forma_porcentaje_materiales) / 100;
    $costo_directo            = $valor_mano_obra + $valor_materiales;
    $valor_administracion     = ($costo_directo * $forma_porcentaje_administracion_cotizacion) / 100;
    $valor_imprevistos        = ($costo_directo * $forma_porcentaje_imprevistos_cotizacion) / 100;
    $valor_utilidad           = ($costo_directo * $forma_porcentaje_utilidad) / 100;

    if ($valor_utilidad > 0){
        $iva = ($valor_utilidad * $forma_impuesto) / 100;
    } else {
        $iva = ($costo_directo * $forma_impuesto) / 100;
    }

    $total_aiu = $valor_administracion + $valor_imprevistos + $valor_utilidad;        
    $total = $costo_directo + $total_aiu + $iva;
    
    /*** Calcular valor administracion ***/
    $porcentaje_mano_obra_administracion  = 100 - $forma_porcentaje_mano_obra;
    $porcentaje_materiales_administracion = 100 - $forma_porcentaje_materiales;
    $valor_mano_obra_administracion       = $forma_valor_mano_obra_cotizacion * $porcentaje_participacion;
    $valor_mano_obra_administracion       = ($valor_mano_obra_administracion * $porcentaje_mano_obra_administracion) / 100;
    $valor_materiales_administracion      = $forma_valor_materiales_cotizacion * $porcentaje_participacion;
    $valor_materiales_administracion      = ($valor_materiales_administracion * $porcentaje_materiales_administracion) / 100;
    $costo_directo_administracion         = $valor_mano_obra_administracion + $valor_materiales_administracion;
    $valor_administracion_administracion  = ($costo_directo_administracion * $forma_porcentaje_administracion_cotizacion) / 100;
    $valor_imprevistos_administracion     = ($costo_directo_administracion * $forma_porcentaje_imprevistos_cotizacion) / 100;
    $valor_utilidad_administracion        = ($costo_directo_administracion * $forma_porcentaje_utilidad) / 100;

    if ($valor_utilidad_administracion > 0){
        $iva_administracion = ($valor_utilidad_administracion * $forma_impuesto) / 100;
    } else {
        $iva_administracion = ($costo_directo_administracion * $forma_impuesto) / 100;
    }

    if($forma_id_sucursal == 1){
        $pago_consorciado='1';
    } else {
        $pago_consorciado='0';
    }

    $datos = array(   
        "pago_consorciado"                    => $pago_consorciado,
        "pago_cliente"                        => 1,
        "valor_factura_cliente"               => $forma_valor_factura_cliente,
        "valor_mano_obra_consorciado"         => round($valor_mano_obra),
        "valor_materiales_consorciado"        => round($valor_materiales),
        "costo_directo_consorciado"           => round($costo_directo),
        "valor_administracion_consorciado"    => round($valor_administracion),
        "valor_imprevistos_consorciado"       => round($valor_imprevistos),
        "valor_utilidad_consorciado"          => round($valor_utilidad),
        "valor_iva_consorciado"               => round($iva),
        "valor_mano_obra_administracion"      => round($valor_mano_obra_administracion),
        "valor_materiales_administracion"     => round($valor_materiales_administracion),
        "costo_directo_administracion"        => round($costo_directo_administracion),
        "valor_administracion_administracion" => round($valor_administracion_administracion),
        "valor_imprevistos_administracion"    => round($valor_imprevistos_administracion),
        "valor_utilidad_administracion"       => round($valor_utilidad_administracion),
        "valor_iva_administracion"            => round($iva_administracion)
    );
        
    
    $consulta = SQL::modificar("registro_obras", $datos, "id = '$forma_id_acta'");
    
    if ($consulta) {

        $usuario = SQL::obtenerValor("usuarios","nombre","id = '$sesion_id_usuario'");
        
        $nombreArchivo      = $rutasGlobales["archivos"]."/pago_cliente".$forma_id_acta.".pdf";
        $nombreArchivo2     = "pago_cliente".$forma_id_acta.".pdf";
        $anchoColumnas      = array(20,50);
        $alineacionColumnas = array("I","I");
          
        $archivo = new PDF("P","mm","Letter");
         
        $archivo->AddPage();
        $archivo->SetFont('Arial','B',8);
  
        $archivo->Ln(0);
        $archivo->Cell(190,8,"Acta No: ".$forma_id_acta."     Fecha: ".$forma_fecha_entrega_acta,0,1,'R');
                
        $archivo->Ln(7);        
        $archivo->SetFont('Arial','B',8);
        $archivo->Cell(21,8,$textos["ASUNTO"]." :",0,0,'L');
           
        $archivo->SetFont('Arial','',8);
        $archivo->Cell(21,8,"".$textos["INFORME_CLIENTE"]."",0);
        
        $archivo->Ln(7);        
        $archivo->SetFont('Arial','B',8);
        $archivo->Cell(21,8,$textos["FACTURA"]." :",0,0,'L');
           
        $archivo->SetFont('Arial','',8);
        $archivo->Cell(60,8,"".$forma_numero_factura."",0);

        $archivo->Ln(8);
        $archivo->SetFont('Arial','B',8);
        $archivo->Cell(21,8,$textos["SEDE"]." :",0,0,'L');
          
        $archivo->SetFont('Arial','',8);
        $archivo->Cell(20,8,"".$forma_sede."",0);
    
        $archivo->Ln(9);
        $archivo->SetFont('Arial','B',8);
        $archivo->Cell(21,8,$textos["SUCURSAL"]." :",0,0,'L');
            
        $archivo->SetFont('Arial','',8);
        $archivo->Cell(60,8,"".$forma_sucursal."",0);
            
        $archivo->Ln(10);
        $archivo->SetFont('Arial','B',8);
        $archivo->Cell(21,8,$textos["TIPO_SOLICITUD"]." :",0,0,'L');
            
        $archivo->SetFont('Arial','',8);
        $archivo->Cell(60,8,"".$tipo_solicitud[$forma_solicitud]."",0);
    
        $archivo->Ln(11);
        $archivo->SetFont('Arial','',8);
        $archivo->Cell(30,8,$textos["SALUDO"],0,0,'L');
           
        $archivo->Ln(12);
        $archivo->SetFont('Arial','',8);
        $archivo->Cell(30,8,$textos["TITULO"],0,0,'J');
                        
        $archivo->Ln(13);
        $archivo->SetFont('Arial','B',8);
        $archivo->Cell(25,8,$textos["DESCRIPCION"]." :",0,0,'L');
            
        $archivo->SetFont('Arial','',8);
        $descripcion_1 = substr($forma_descripcion, 0, 100);
        $descripcion_2 = substr($forma_descripcion, 100, 100);
        $descripcion_3 = substr($forma_descripcion, 200, 55);
            
        $archivo->Cell(200,8,"".$descripcion_1."",0);
        $archivo->Cell(20,8,"",0,1,'R');
        $archivo->Cell(25,8,"",0,0,'L');

        $archivo->Ln(12);
        $archivo->SetFont('Arial','B',8);
        $archivo->Cell(20,8,$textos["VALOR_MANO_OBRA_COTIZACION"]." :",0,0,'L');

        $archivo->SetFont('Arial','',8);
        $archivo->Cell(30,8,"".$textos["SIMBOLO_PESO"].number_format($valor_mano_obra)."",0,0,'R');
        $archivo->Cell(20,8,"",0,1,'L');

        $archivo->SetFont('Arial','B',8);
        $archivo->Cell(20,8,$textos["VALOR_MATERIALES_COTIZACION"]." :",0,0,'L');
            
        $archivo->SetFont('Arial','',8);
        $archivo->Cell(30,8,"".$textos["SIMBOLO_PESO"].number_format($valor_materiales)."",0,0,'R');
        $archivo->Cell(20,8,"",0,1,'L');
        if ($valor_utilidad > 0){
//        echo var_dump($valor_utilidad);
            $archivo->SetFont('Arial','B',8);
            $archivo->Cell(20,8,$textos["VALOR_ADMINISTRACION_COTIZACION"]." :",0,0,'L');

            $archivo->SetFont('Arial','',8);
            $archivo->Cell(30,8,"".$textos["SIMBOLO_PESO"].number_format($valor_administracion)."",0,0,'R');
            $archivo->Cell(20,8,"",0,1,'L');

            $archivo->SetFont('Arial','B',8);
            $archivo->Cell(20,8,$textos["VALOR_IMPREVISTOS_COTIZACION"]." :",0,0,'L');
                
            $archivo->SetFont('Arial','',8);
            $archivo->Cell(30,8,"".$textos["SIMBOLO_PESO"].number_format($valor_imprevistos)."",0,0,'R');
            $archivo->Cell(20,8,"",0,1,'L');

            $archivo->SetFont('Arial','B',8);
            $archivo->Cell(20,8,$textos["VALOR_UTILIDAD"]." :",0,0,'L');
                
            $archivo->SetFont('Arial','',8);
            $archivo->Cell(30,8,"".$textos["SIMBOLO_PESO"].number_format($valor_utilidad)."",0,0,'R');
            $archivo->Cell(20,8,"",0,1,'L');
        }
        
        $archivo->SetFont('Arial','B',8);
        $archivo->Cell(20,8,$textos["VALOR_IMPUESTO"]." :",0,0,'L');
            
        $archivo->SetFont('Arial','',8);
        $archivo->Cell(30,8,"".$textos["SIMBOLO_PESO"].number_format($iva)."",0,0,'R');
        $archivo->Cell(20,8,"",0,1,'R');

        $archivo->SetFont('Arial','B',8);
        $archivo->Cell(20,8,$textos["TOTAL_GENERAL"]." :",0,0,'L');
            
        $archivo->SetFont('Arial','',8);
        $archivo->Cell(30,8,"".$textos["SIMBOLO_PESO"].number_format($total)."",0,0,'R');
        $archivo->Cell(20,8,"",0,1,'R');
            
        $archivo->Ln(21);
        $archivo->SetFont('Arial','',8);        
        $archivo->Cell(30,8,$textos["CORDIALMENTE"],0,0,'L');

        $archivo->Ln(5);
        $archivo->SetFont('Arial','',8);
        $archivo->Cell(30,8,$usuario,0,0,'L');
        
        $archivo->Output($nombreArchivo, "F");
        $mensaje = HTML::enlazarPagina($textos["IMPRIMIR_PDF"], $pance["url"]."/archivos/".$nombreArchivo2, array("target" => "adjunto"));	     

    }else {
        $error   = true;
        $mensaje = $textos["ERROR_ENVIANDO_ITEM"];
    }
    /*** Enviar datos con la respuesta del proceso al script que originó la petición ***/
    $respuesta    = array();
    $respuesta[0] = $error;
    $respuesta[1] = $mensaje;
    $respuesta[2] = $mensaje;
    HTTP::enviarJSON($respuesta);
}
?>
