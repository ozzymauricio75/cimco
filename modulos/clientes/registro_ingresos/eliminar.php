<?php

/**
*
* Copyright (C) 2008 LinuxCali Ltda
* Francisco J. Lozano B. <pacho@linuxcali.com>
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
        $vistaRegistroIngreso            = "registro_ingresos";
        $columnasRegistroIngreso         = SQL::obtenerColumnas($vistaRegistroIngreso);
        $consultaRegistroIngreso         = SQL::seleccionar(array($vistaRegistroIngreso), $columnasRegistroIngreso, "id_requerimiento = '$url_id'");
        $datosRegistroIngreso            = SQL::filaEnObjeto($consultaRegistroIngreso);
        $concepto                        = $datosRegistroIngreso->concepto;
        $valor_concepto                  = $datosRegistroIngreso->valor_concepto;
        $fecha_concepto                  = $datosRegistroIngreso->fecha_concepto;
        $valor_concepto                  = number_format($valor_concepto);    

        $vistaRegistroObra               = "registro_obras";
        $columnasRegistroObra            = SQL::obtenerColumnas($vistaRegistroObra);
        $consultaRegistroObra            = SQL::seleccionar(array($vistaRegistroObra), $columnasRegistroObra, "id = '$url_id'");
        $datosRegistroObra               = SQL::filaEnObjeto($consultaRegistroObra);
        
        $valor_mano_obra_cotizacion      = SQL::obtenerValor("cotizaciones", "valor_mano_obra_cotizacion", "id_requerimiento = '$url_id'");
        $valor_materiales_cotizacion     = SQL::obtenerValor("cotizaciones", "valor_materiales_cotizacion", "id_requerimiento = '$url_id'");
        $costo_directo                   = SQL::obtenerValor("cotizaciones", "costo_directo", "id_requerimiento = '$url_id'");
        $costo_administracion_cotizacion = SQL::obtenerValor("cotizaciones", "costo_administracion_cotizacion", "id_requerimiento = '$url_id'");
        $costo_imprevistos_cotizacion    = SQL::obtenerValor("cotizaciones", "costo_imprevistos_cotizacion", "id_requerimiento = '$url_id'");
        $costo_impuesto                  = SQL::obtenerValor("cotizaciones", "costo_impuesto", "id_requerimiento = '$url_id'");
        $costo_utilidad                  = SQL::obtenerValor("cotizaciones", "costo_utilidad", "id_requerimiento = '$url_id'");
        
        $valor_mano_obra_cotizacion      = number_format($valor_mano_obra_cotizacion);
        $valor_materiales_cotizacion     = number_format($valor_materiales_cotizacion);
        $costo_directo                   = number_format($costo_directo);
        $costo_administracion_cotizacion = number_format($costo_administracion_cotizacion);
        $costo_imprevistos_cotizacion    = number_format($costo_imprevistos_cotizacion);
        $costo_impuesto                  = number_format($costo_impuesto);
        $costo_utilidad                  = number_format($costo_utilidad);
        
        $subTotal                        = $costo_administracion_cotizacion + $costo_imprevistos_cotizacion + $costo_utilidad  + $costo_impuesto; 
        $subTotal                        = number_format($subTotal);
        $totalGeneral                    = $subTotal + $costo_directo;

        $valor_facturado                 = number_format($datosRegistroObra->valor_facturar);
        $factura_consorciado             = $datosRegistroObra->factura_consorciado;
        $pago_cliente                    = $datosRegistroObra->pago_cliente;
        $pago_consorciado                = $datosRegistroObra->pago_consorciado;

        $factura_consorciado             = SQL::obtenerValor("buscador_actas", "FACTURA_CONSORCIADO", "id = '$url_id'");
        $pago_cliente                    = SQL::obtenerValor("buscador_actas", "PAGO_CLIENTE", "id = '$url_id'");
        $pago_consorciado                = SQL::obtenerValor("buscador_actas", "PAGO_CONSORCIADO", "id = '$url_id'");
        $valor_mano_obra_cotizacion      = SQL::obtenerValor("cotizaciones", "valor_mano_obra_cotizacion", "id = '$datosRegistroObra->id_cotizacion'");
        $valor_materiales_cotizacion     = SQL::obtenerValor("cotizaciones", "valor_materiales_cotizacion", "id = '$datosRegistroObra->id_cotizacion'");
        $costo_directo                   = SQL::obtenerValor("cotizaciones", "costo_directo", "id = '$datosRegistroObra->id_cotizacion'");
        $costo_administracion_cotizacion = SQL::obtenerValor("cotizaciones", "costo_administracion_cotizacion", "id = '$datosRegistroObra->id_cotizacion'");
        $costo_imprevistos_cotizacion    = SQL::obtenerValor("cotizaciones", "costo_imprevistos_cotizacion", "id = '$datosRegistroObra->id_cotizacion'");
        $costo_impuesto                  = SQL::obtenerValor("cotizaciones", "costo_impuesto", "id = '$datosRegistroObra->id_cotizacion'");
        $costo_utilidad                  = SQL::obtenerValor("cotizaciones", "costo_utilidad", "id = '$datosRegistroObra->id_cotizacion'");
        
        $subTotal                        = $costo_administracion_cotizacion + $costo_imprevistos_cotizacion + $costo_utilidad  + $costo_impuesto; 
        $subTotal                        = number_format($subTotal);
        $totalGeneral                    = $subTotal + $costo_directo;
        
        $id_requerimiento                     = SQL::obtenerValor("cotizaciones", "id_requerimiento", "id = '$datosRegistroObra->id_cotizacion'");
        $numero_cotizacion                    = SQL::obtenerValor("cotizaciones", "numero_cotizacion", "id = '$datosRegistroObra->id_cotizacion'");
        $numero_cotizacion_consorciado        = SQL::obtenerValor("cotizaciones", "numero_cotizacion_consorciado", "id = '$datosRegistroObra->id_cotizacion'");
        $porcentaje_administracion_cotizacion = SQL::obtenerValor("cotizaciones", "porcentaje_administracion_cotizacion", "id = '$datosRegistroObra->id_cotizacion'");
        $porcentaje_imprevistos_cotizacion    = SQL::obtenerValor("cotizaciones", "porcentaje_imprevistos_cotizacion", "id = '$datosRegistroObra->id_cotizacion'");
        $porcentaje_utilidad                  = SQL::obtenerValor("cotizaciones", "porcentaje_utilidad", "id = '$datosRegistroObra->id_cotizacion'");
        $impuesto                             = SQL::obtenerValor("cotizaciones", "impuesto", "id = '$datosRegistroObra->id_cotizacion'");
        $porcentaje_anticipo                  = SQL::obtenerValor("cotizaciones", "porcentaje_anticipo", "id = '$datosRegistroObra->id_cotizacion'");
        
        $estado                = SQL::obtenerValor("buscador_cotizaciones", "estado", "id = '$datosRegistroObra->id_cotizacion'");
        $tipo_solicitud        = SQL::obtenerValor("buscador_cotizaciones", "tipo_solicitud", "id = '$datosRegistroObra->id_cotizacion'");
        $forma_pago            = SQL::obtenerValor("buscador_cotizaciones", "forma_pago", "id = '$datosRegistroObra->id_cotizacion'");
        
        $descripcion           = SQL::obtenerValor("requerimientos_clientes", "descripcion", "id = '$datosRegistroObra->id_requerimiento'");
        $observaciones_visita  = SQL::obtenerValor("requerimientos_clientes", "observaciones_visita", "id = '$datosRegistroObra->id_requerimiento'");
        $nombre_contacto       = SQL::obtenerValor("requerimientos_clientes", "nombre_contacto", "id = '$datosRegistroObra->id_requerimiento'");
        $fecha_ingreso         = SQL::obtenerValor("requerimientos_clientes", "fecha_ingreso", "id = '$datosRegistroObra->id_requerimiento'");
        $Sede                  = SQL::obtenerValor("requerimientos_clientes", "id_sede", "id = '$datosRegistroObra->id_requerimiento'");
        $nombreSede            = SQL::obtenerValor("sedes_clientes", "nombre_sede", "id = '$Sede'");
        $municipio             = SQL::obtenerValor("sedes_clientes", "id_municipios", "id = '$Sede'");
        $nombreMunicipio       = SQL::obtenerValor("municipios", "nombre", "id = '$municipio'");
        $id_sucursal           = SQL::obtenerValor("requerimientos_clientes", "id_sucursal", "id = '$datosRegistroObra->id_requerimiento'");
        $nombreSucursal        = SQL::obtenerValor("sucursales", "nombre", "id = '$id_sucursal'");       
        
        $valor_facturar        = SQL::obtenerValor("registro_obras", "valor_facturar", "id = '$url_id'");
        
        $nombre_concepto = array(
            "1" => $textos["INGRESO"],
            "2" => $textos["EGRESO"]
        );
        
        if($valor_concepto != "0"){
             /*** Definición de pestañas ***/
            $formularios["PESTANA_REQUERIMIENTO"] = array(
                array(                   
                    HTML::mostrarDato("fecha_ingreso", $textos["FECHA_INGRESO"], $fecha_ingreso)
                ),
                array(   
                    HTML::mostrarDato("nombre_sede", $textos["SEDE"], $nombreSede)
                ),
                array(   
                    HTML::mostrarDato("municipio", $textos["MUNICIPIO"], $nombreMunicipio)
                ),            
                array(   
                    HTML::mostrarDato("sucursal", $textos["SUCURSAL"], $nombreSucursal)
                ),
                array(
                    HTML::mostrarDato("descripcion", $textos["DESCRIPCION"], $descripcion)
                ),
                array(    
                    HTML::mostrarDato("observaciones", $textos["OBSERVACIONES_VISITA"], $observaciones_visita)
                ),
                array(    
                    HTML::mostrarDato("nombre_contacto", $textos["CONTACTO"], $nombre_contacto)
                ),
                array(    
                    HTML::mostrarDato("tipo_solicitud", $textos["TIPO_SOLICITUD"], $tipo_solicitud)
                ),
                array(    
                    HTML::mostrarDato("estado", $textos["ESTADO"], $estado)
                )
            );
  
            $formularios["PESTANA_COTIZACION"] = array(
                array(
                    HTML::mostrarDato("numero_cotizacion", $textos["NUMERO_COTIZACION"], $numero_cotizacion),
                    HTML::mostrarDato("numero_cotizacion_consorciado", $textos["NUMERO_COTIZACION_CONSORCIADO"], $numero_cotizacion_consorciado)
                ),
                array(    
                    HTML::mostrarDato("valor_mano_obra_cotizacion", $textos["VALOR_MANO_OBRA_COTIZACION"], $textos["SIMBOLO_PESO"].$valor_mano_obra_cotizacion),
                    HTML::mostrarDato("valor_materiales_cotizacion", $textos["VALOR_MATERIALES_COTIZACION"], $textos["SIMBOLO_PESO"].$valor_materiales_cotizacion)
                ),
                array(    
                    HTML::mostrarDato("costo", $textos["COSTO_DIRECTO"], $textos["SIMBOLO_PESO"].$costo_directo),  
                    HTML::mostrarDato("forma_pago", $textos["FORMA_PAGO"], $forma_pago)
                ),
                array(  
                    HTML::mostrarDato("porcentaje_anticipo", $textos["PORCENTAJE_ANTICIPO"], $porcentaje_anticipo.$textos["SIMBOLO_PORCENTAJE"])
                ),
                array(
                    HTML::mostrarDato("porcentaje_administracion_cotizacion", $textos["PORCENTAJE_ADMINISTRACION_COTIZACION"], $porcentaje_administracion_cotizacion.$textos["SIMBOLO_PORCENTAJE"]),
                    HTML::mostrarDato("costo_administracion_cotizacion", $textos["VALOR_ADMINISTRACION_COTIZACION"], $textos["SIMBOLO_PESO"].$costo_administracion_cotizacion)
                ),     
                array( 
                    HTML::mostrarDato("porcentaje_imprevistos_cotizacion", $textos["PORCENTAJE_IMPREVISTOS_COTIZACION"], $porcentaje_imprevistos_cotizacion.$textos["SIMBOLO_PORCENTAJE"]),
                    HTML::mostrarDato("costo_imprevistos_cotizacion", $textos["VALOR_IMPREVISTOS_COTIZACION"], $textos["SIMBOLO_PESO"].$costo_imprevistos_cotizacion)
                ),
                array(      
                    HTML::mostrarDato("porcentaje_utilidad", $textos["PORCENTAJE_UTILIDAD"], $porcentaje_utilidad.$textos["SIMBOLO_PORCENTAJE"]),
                    HTML::mostrarDato("costo_utilidad", $textos["VALOR_UTILIDAD"], $textos["SIMBOLO_PESO"].$costo_utilidad)
                ),
                array(    
                    HTML::mostrarDato("impuesto", $textos["IMPUESTO"], $impuesto.$textos["SIMBOLO_PORCENTAJE"]),
                    HTML::mostrarDato("costo_impuesto", $textos["VALOR_IMPUESTO"], $textos["SIMBOLO_PESO"].$costo_impuesto)
                ),
                array(    
                    HTML::mostrarDato("sub_total", $textos["SUB_TOTAL"], $textos["SIMBOLO_PESO"].$subTotal),
                    HTML::mostrarDato("total_general", $textos["TOTAL_GENERAL"], $textos["SIMBOLO_PESO"].number_format($totalGeneral))
                )
            );
          
            $formularios["PESTANA_MOVIMIENTO"] = array(
                array(   
                    HTML::mostrarDato("fecha_concepto", $textos["FECHA_CONCEPTO"], $fecha_concepto)
                ),
                array(   
                    HTML::mostrarDato("concepto", $textos["CONCEPTO"], $nombre_concepto[$concepto])
                ),
                array(   
                    HTML::mostrarDato("valor_concepto", $textos["VALOR_CONCEPTO"], $valor_concepto)
                ),
  	            array(
                    HTML::campoOculto("id", $url_id)
                )
            );
            
        }else{
             /*** Definición de pestañas ***/
            $formularios["PESTANA_REQUERIMIENTO"] = array(
                array(                   
                    HTML::mostrarDato("fecha_ingreso", $textos["FECHA_INGRESO"], $fecha_ingreso)
                ),
                array(   
                    HTML::mostrarDato("nombre_sede", $textos["SEDE"], $nombreSede)
                ),
                array(   
                    HTML::mostrarDato("municipio", $textos["MUNICIPIO"], $nombreMunicipio)
                ),            
                array(   
                    HTML::mostrarDato("sucursal", $textos["SUCURSAL"], $nombreSucursal)
                ),
                array(
                    HTML::mostrarDato("descripcion", $textos["DESCRIPCION"], $descripcion)
                ),
                array(    
                    HTML::mostrarDato("observaciones", $textos["OBSERVACIONES_VISITA"], $observaciones_visita)
                ),
                array(    
                    HTML::mostrarDato("nombre_contacto", $textos["CONTACTO"], $nombre_contacto)
                ),
                array(    
                    HTML::mostrarDato("tipo_solicitud", $textos["TIPO_SOLICITUD"], $tipo_solicitud)
                ),
                array(    
                    HTML::mostrarDato("estado", $textos["ESTADO"], $estado)
                )
            );
  
            $formularios["PESTANA_COTIZACION"] = array(
                array(
                    HTML::mostrarDato("numero_cotizacion", $textos["NUMERO_COTIZACION"], $numero_cotizacion),
                    HTML::mostrarDato("numero_cotizacion_consorciado", $textos["NUMERO_COTIZACION_CONSORCIADO"], $numero_cotizacion_consorciado)
                ),
                array(    
                    HTML::mostrarDato("valor_mano_obra_cotizacion", $textos["VALOR_MANO_OBRA_COTIZACION"], $textos["SIMBOLO_PESO"].$valor_mano_obra_cotizacion),
                    HTML::mostrarDato("valor_materiales_cotizacion", $textos["VALOR_MATERIALES_COTIZACION"], $textos["SIMBOLO_PESO"].$valor_materiales_cotizacion)
                ),
                array(    
                    HTML::mostrarDato("costo", $textos["COSTO_DIRECTO"], $textos["SIMBOLO_PESO"].$costo_directo),  
                    HTML::mostrarDato("forma_pago", $textos["FORMA_PAGO"], $forma_pago)
                ),
                array(  
                    HTML::mostrarDato("porcentaje_anticipo", $textos["PORCENTAJE_ANTICIPO"], $porcentaje_anticipo.$textos["SIMBOLO_PORCENTAJE"])
                ),
                array(
                    HTML::mostrarDato("porcentaje_administracion_cotizacion", $textos["PORCENTAJE_ADMINISTRACION_COTIZACION"], $porcentaje_administracion_cotizacion.$textos["SIMBOLO_PORCENTAJE"]),
                    HTML::mostrarDato("costo_administracion_cotizacion", $textos["VALOR_ADMINISTRACION_COTIZACION"], $textos["SIMBOLO_PESO"].$costo_administracion_cotizacion)
                ),     
                array( 
                    HTML::mostrarDato("porcentaje_imprevistos_cotizacion", $textos["PORCENTAJE_IMPREVISTOS_COTIZACION"], $porcentaje_imprevistos_cotizacion.$textos["SIMBOLO_PORCENTAJE"]),
                    HTML::mostrarDato("costo_imprevistos_cotizacion", $textos["VALOR_IMPREVISTOS_COTIZACION"], $textos["SIMBOLO_PESO"].$costo_imprevistos_cotizacion)
                ),
                array(      
                    HTML::mostrarDato("porcentaje_utilidad", $textos["PORCENTAJE_UTILIDAD"], $porcentaje_utilidad.$textos["SIMBOLO_PORCENTAJE"]),
                    HTML::mostrarDato("costo_utilidad", $textos["VALOR_UTILIDAD"], $textos["SIMBOLO_PESO"].$costo_utilidad)
                ),
                array(    
                    HTML::mostrarDato("impuesto", $textos["IMPUESTO"], $impuesto.$textos["SIMBOLO_PORCENTAJE"]),
                    HTML::mostrarDato("costo_impuesto", $textos["VALOR_IMPUESTO"], $textos["SIMBOLO_PESO"].$costo_impuesto)
                ),
                array(    
                    HTML::mostrarDato("sub_total", $textos["SUB_TOTAL"], $textos["SIMBOLO_PESO"].$subTotal),
                    HTML::mostrarDato("total_general", $textos["TOTAL_GENERAL"], $textos["SIMBOLO_PESO"].number_format($totalGeneral))
                )
            );
        }
       
        /*** Definición de botones ***/
        $botones = array(
            HTML::boton("botonAceptar", $textos["ACEPTAR"], "modificarItem('$url_id');", "aceptar")
        );

        $contenido = HTML::generarPestanas($formularios, $botones);

    }

    /*** Enviar datos para la generación del formulario al script que originó la petición ***/
    $respuesta    = array();
    $respuesta[0] = $error;
    $respuesta[1] = $titulo;
    $respuesta[2] = $contenido;
    HTTP::enviarJSON($respuesta);
    
/*** Eliminar el elemento seleccionado ***/

} elseif (!empty($forma_procesar)) {
    $consulta = SQL::eliminar("registro_ingresos", "id_requerimiento = '$forma_id'");

    if ($consulta) {
        $error   = false;
        $mensaje = $textos["ITEM_ELIMINADO"];
    } else {
        $error   = true;
        $mensaje = $textos["ERROR_ELIMINAR_ITEM"];
    }

    /*** Enviar datos con la respuesta del proceso al script que originó la petición ***/
    $respuesta    = array();
    $respuesta[0] = $error;
    $respuesta[1] = $mensaje;
    HTTP::enviarJSON($respuesta);
}
?>
