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
        $vistaConsulta                   = "cotizaciones";                                                             
        $columnas                        = SQL::obtenerColumnas($vistaConsulta);                                       
        $consulta                        = SQL::seleccionar(array($vistaConsulta), $columnas, "id = '$url_id'");       
        $datos                           = SQL::filaEnObjeto($consulta);                                               
        $error                           = "";                                                                         
        $titulo                          = $componente->nombre;                                                        
        
        $subTotal                        = $datos->costo_administracion_cotizacion + $datos->costo_imprevistos_cotizacion + $datos->costo_utilidad  + $datos->costo_impuesto; 
        $totalGeneral                    = $subTotal + $datos->costo_directo;

        $valor_mano_obra_cotizacion      = number_format($datos->valor_mano_obra_cotizacion);
        $valor_materiales_cotizacion     = number_format($datos->valor_materiales_cotizacion);
        $costo_directo                   = number_format($datos->costo_directo);
        $costo_administracion_cotizacion = number_format($datos->costo_administracion_cotizacion);
        $costo_imprevistos_cotizacion    = number_format($datos->costo_imprevistos_cotizacion);
        $costo_impuesto                  = number_format($datos->costo_impuesto);
        $costo_utilidad                  = number_format($datos->costo_utilidad);
        $subTotal                        = number_format($subTotal);
        $totalGeneral                    = number_format($totalGeneral);        
        
        $numero_cotizacion               = SQL::obtenerValor("cotizaciones", "numero_cotizacion", "id = '$url_id'"); 
        $consecutivo                     = SQL::obtenerValor("cotizaciones", "consecutivo_cotizacion", "id = '$url_id'"); 
        $numero_cotizacion_consorciado   = SQL::obtenerValor("cotizaciones", "numero_cotizacion_consorciado", "id = '$url_id'");
        $estado                          = SQL::obtenerValor("buscador_cotizaciones", "estado", "id = '$url_id'");                                       
        $tipo_solicitud                  = SQL::obtenerValor("buscador_cotizaciones", "tipo_solicitud", "id = '$url_id'");                               
        $forma_pago                      = SQL::obtenerValor("buscador_cotizaciones", "forma_pago", "id = '$url_id'");                                   
                                                                                                                                                         
        $descripcion                     = SQL::obtenerValor("requerimientos_clientes", "descripcion", "id = '$datos->id_requerimiento'");               
        $observaciones_visita            = SQL::obtenerValor("requerimientos_clientes", "observaciones_visita", "id = '$datos->id_requerimiento'");      
        $nombre_contacto                 = SQL::obtenerValor("requerimientos_clientes", "nombre_contacto", "id = '$datos->id_requerimiento'");           
        $fecha_ingreso                   = SQL::obtenerValor("requerimientos_clientes", "fecha_ingreso", "id = '$datos->id_requerimiento'");             
        $fecha_visita                    = SQL::obtenerValor("requerimientos_clientes", "fecha_visita", "id = '$datos->id_requerimiento'");             
        $Sede                            = SQL::obtenerValor("requerimientos_clientes", "id_sede", "id = '$datos->id_requerimiento'");                   
        $nombreSede                      = SQL::obtenerValor("sedes_clientes", "nombre_sede", "id = '$Sede'");                                           
        $municipio                       = SQL::obtenerValor("sedes_clientes", "id_municipios", "id = '$Sede'");                                         
        $nombreMunicipio                 = SQL::obtenerValor("municipios", "nombre", "id = '$municipio'");                                               
        $id_sucursal                     = SQL::obtenerValor("requerimientos_clientes", "id_sucursal", "id = '$datos->id_requerimiento'");               
        $nombreSucursal                  = SQL::obtenerValor("sucursales", "nombre", "id = '$id_sucursal'");
        
        $vistaRegistroObra               = "registro_obras";
        $columnasRegistroObra            = SQL::obtenerColumnas($vistaRegistroObra);
        $consultaRegistroObra            = SQL::seleccionar(array($vistaRegistroObra), $columnasRegistroObra, "id_cotizacion = '$url_id' ");
        $datosRegistroObra               = SQL::filaEnObjeto($consultaRegistroObra);
        
        $acta                            = SQL::obtenerValor("registro_obras", "tipo_acta", "id_cotizacion = '$url_id'");
        $valor_facturar                  = SQL::obtenerValor("registro_obras", "valor_facturar", "id_cotizacion = '$url_id'");
       
        $consulta                        = mysql_query("SELECT SUM(valor_facturar)AS valor FROM pance_registro_obras WHERE id_cotizacion = '$url_id'");
        $resultado                       = mysql_fetch_object($consulta);
        $acumulado                       = $resultado->valor;
        
	    $vistaConsulta                   = "seleccion_registro_ingresos";
	    $alineacion                      = array("C","C","I","C","D");
	    $columnas                        = SQL::obtenerColumnas($vistaConsulta);
	    $consulta                        = SQL::seleccionar(array($vistaConsulta), $columnas, "id = '$url_id'");
	    $tabla 	                         = HTML::generarTabla($columnas, $consulta, $alineacion, "seleccion_registro_ingresos");
	      
        $concepto = array(
            "1" => $textos["INGRESO"],
            "2" => $textos["EGRESO"]
        );

/*** Definición de pestañas ***/
            $formularios["PESTANA_REQUERIMIENTO"] = array(
                array(   
                    HTML::mostrarDato("sucursal", $textos["SUCURSAL"], $nombreSucursal)
                    HTML::mostrarDato("numero_requerimiento", $textos["NUMERO_REQUERIMIENTO"], $datos->id_requerimiento)
                ),
                array(                   
                    HTML::mostrarDato("fecha_ingreso", $textos["FECHA_INGRESO"], $fecha_ingreso)
                    HTML::mostrarDato("fecha_visita", $textos["FECHA_VISITA"], $fecha_visita)
                ),
                array(   
                    HTML::mostrarDato("nombre_sede", $textos["SEDE"], $nombreSede)
                ),
                array(   
                    HTML::mostrarDato("municipio", $textos["MUNICIPIO"], $nombreMunicipio)
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
                )
            );
  
            $formularios["PESTANA_COTIZACION"] = array(
                array(
                    HTML::mostrarDato("numero_cotizacion", $textos["NUMERO_COTIZACION"], $numero_cotizacion."-".$consecutivo),
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
                    HTML::mostrarDato("total_general", $textos["TOTAL_GENERAL"], $textos["SIMBOLO_PESO"].($totalGeneral))
                )
            );
            
            $formularios["PESTANA_MOVIMIENTO"] = array(
	              array(
	                  HTML::contenedor($tabla)
	              )
            );
            
            $contenido = HTML::generarPestanas($formularios);
    }

    /*** Enviar datos para la generación del formulario al script que originó la petición ***/
    $respuesta    = array();
    $respuesta[0] = $error;
    $respuesta[1] = $titulo;
    $respuesta[2] = $contenido;
    HTTP::enviarJSON($respuesta);
}
?>
