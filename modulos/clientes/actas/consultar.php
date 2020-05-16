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

    /*** Verificar que se haya enviado el ID del elemento a consultar ***/
    if (empty($url_id)) {
        $error     = $textos["ERROR_CONSULTAR_VACIO"];
        $titulo    = "";
        $contenido = "";

    } else {
        $vistaConsulta         = "cotizaciones";
        $columnas              = SQL::obtenerColumnas($vistaConsulta);
        $consulta              = SQL::seleccionar(array($vistaConsulta), $columnas, "id = '$url_id'");
        $datos                 = SQL::filaEnObjeto($consulta);
        $error                 = "";
        $titulo                = $componente->nombre;
        
        /*** Obtener los resultados para la pagina actual ***/
        $vistaRegistroObra               = "registro_obras";
        $columnasRegistroObra            = SQL::obtenerColumnas($vistaRegistroObra);
        $consultaRegistroObra            = SQL::seleccionar(array($vistaRegistroObra), $columnasRegistroObra, "id_cotizacion = '$url_id' ");
        $datosRegistroObra               = SQL::filaEnObjeto($consultaRegistroObra);
        
        $consulta                        = SQL::seleccionar(array("imagenes"), array("id","ancho","alto"), "id_asociado = '$url_id' AND categoria = '2'");
        $imagen                          = SQL::filaEnObjeto($consulta);

        $valor_mano_obra_cotizacion      = number_format($datos->valor_mano_obra_cotizacion);
        $valor_materiales_cotizacion     = number_format($datos->valor_materiales_cotizacion);
        $costo_directo                   = number_format($datos->costo_directo);
        $costo_administracion_cotizacion = number_format($datos->costo_administracion_cotizacion);
        $costo_imprevistos_cotizacion    = number_format($datos->costo_imprevistos_cotizacion);
        $costo_impuesto                  = number_format($datos->costo_impuesto);
        $costo_utilidad                  = number_format($datos->costo_utilidad);
        
        $subTotal              = $datos->costo_administracion_cotizacion + $datos->costo_imprevistos_cotizacion + $datos->costo_utilidad + $datos->costo_impuesto; 
        $subTotal              = number_format($subTotal);
        $totalGeneral          = $subTotal + $datos->costo_directo;

        $id_requerimiento      = SQL::obtenerValor("cotizaciones", "id_requerimiento", "id = '$url_id'");
        $estado                = SQL::obtenerValor("buscador_cotizaciones", "estado", "id = '$url_id'");
        $tipo_solicitud        = SQL::obtenerValor("buscador_cotizaciones", "tipo_solicitud", "id = '$url_id'");
        $forma_pago            = SQL::obtenerValor("buscador_cotizaciones", "forma_pago", "id = '$url_id'");
                
        $Sede                  = SQL::obtenerValor("requerimientos_clientes", "id_sede", "id = '$id_requerimiento'");
        $nombreSede            = SQL::obtenerValor("sedes_clientes", "nombre_sede", "id = '$Sede'");
        $municipio             = SQL::obtenerValor("sedes_clientes", "id_municipios", "id = '$Sede'");
        $nombreMunicipio       = SQL::obtenerValor("municipios", "nombre", "id = '$municipio'");

        $vistaRequerimiento    = "requerimientos_clientes";
        $columnasRequerimiento = SQL::obtenerColumnas($vistaRequerimiento);
        $consultaRequerimiento = SQL::seleccionar(array($vistaRequerimiento), $columnasRequerimiento, "id = '$id_requerimiento'");
        $datosRequerimiento    = SQL::filaEnObjeto($consultaRequerimiento);
        $nombreSucursal        = SQL::obtenerValor("sucursales", "nombre", "id = '$datosRequerimiento->id_sucursal'");       
        
        $valor_facturar        = SQL::obtenerValor("registro_obras", "valor_facturar", "id = '$url_id'");
        $consulta              = mysql_query("SELECT SUM(valor_facturar)AS valor FROM pance_registro_obras WHERE id_cotizacion = '$url_id'");
        $resultado             = mysql_fetch_object($consulta);
        $acumulado             = $resultado->valor;
        
	    $vistaConsulta         = "seleccion_registro_obras";
	    $alineacion            = array("C","C","C","C","C","C","C");
	    $columnas              = SQL::obtenerColumnas($vistaConsulta);
	    $consulta              = SQL::seleccionar(array($vistaConsulta), $columnas, "id_cotizacion = '$url_id'");
	    $tabla 	               = HTML::generarTabla($columnas, $consulta, $alineacion, "cotizaciones");
	      
        /*** Definición de pestañas ***/
            $formularios["PESTANA_REQUERIMIENTO"] = array(
                array(                   
                    HTML::mostrarDato("fecha_ingreso", $textos["FECHA_INGRESO"], $datosRequerimiento->fecha_ingreso)
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
                    HTML::mostrarDato("descripcion", $textos["DESCRIPCION"], $datosRequerimiento->descripcion)
                ),
                array(    
                    HTML::mostrarDato("observaciones", $textos["OBSERVACIONES_VISITA"], $datosRequerimiento->observaciones_visita)
                ),
                array(    
                    HTML::mostrarDato("nombre_contacto", $textos["CONTACTO"], $datosRequerimiento->nombre_contacto)
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
                    HTML::mostrarDato("numero_cotizacion", $textos["NUMERO_COTIZACION"], $datos->numero_cotizacion),
                    HTML::mostrarDato("numero_cotizacion_consorciado", $textos["NUMERO_COTIZACION_CONSORCIADO"], $datos->numero_cotizacion_consorciado)
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
                    HTML::mostrarDato("porcentaje_anticipo", $textos["PORCENTAJE_ANTICIPO"], $datos->porcentaje_anticipo.$textos["SIMBOLO_PORCENTAJE"])
                ),
                array(
                    HTML::mostrarDato("porcentaje_administracion_cotizacion", $textos["PORCENTAJE_ADMINISTRACION_COTIZACION"], $datos->porcentaje_administracion_cotizacion.$textos["SIMBOLO_PORCENTAJE"]),
                    HTML::mostrarDato("costo_administracion_cotizacion", $textos["VALOR_ADMINISTRACION_COTIZACION"], $textos["SIMBOLO_PESO"].$costo_administracion_cotizacion)
                ),     
                array( 
                    HTML::mostrarDato("porcentaje_imprevistos_cotizacion", $textos["PORCENTAJE_IMPREVISTOS_COTIZACION"], $datos->porcentaje_imprevistos_cotizacion.$textos["SIMBOLO_PORCENTAJE"]),
                    HTML::mostrarDato("costo_imprevistos_cotizacion", $textos["VALOR_IMPREVISTOS_COTIZACION"], $textos["SIMBOLO_PESO"].$costo_imprevistos_cotizacion)
                ),
                array(      
                    HTML::mostrarDato("porcentaje_utilidad", $textos["PORCENTAJE_UTILIDAD"], $datos->porcentaje_utilidad.$textos["SIMBOLO_PORCENTAJE"]),
                    HTML::mostrarDato("costo_utilidad", $textos["VALOR_UTILIDAD"], $textos["SIMBOLO_PESO"].$costo_utilidad)
                ),
                array(    
                    HTML::mostrarDato("impuesto", $textos["IMPUESTO"], $datos->impuesto.$textos["SIMBOLO_PORCENTAJE"]),
                    HTML::mostrarDato("costo_impuesto", $textos["VALOR_IMPUESTO"], $textos["SIMBOLO_PESO"].$costo_impuesto)
                ),
                array(    
                    HTML::mostrarDato("sub_total", $textos["SUB_TOTAL"], $textos["SIMBOLO_PESO"].$subTotal),
                    HTML::mostrarDato("total_general", $textos["TOTAL_GENERAL"], $textos["SIMBOLO_PESO"].number_format($totalGeneral))
                )
            );
            
            $formularios["PESTANA_ACTAS"] = array(
	              array(
	                  HTML::contenedor($tabla)
	              ),
	              array(
                    HTML::mostrarDato("acumulado", $textos["ACUMULADO"], $textos["SIMBOLO_PESO"]. number_format($acumulado)),
                    HTML::mostrarDato("total_general", $textos["TOTAL_GENERAL"], $textos["SIMBOLO_PESO"].number_format($totalGeneral))
                )
            );
            
            if ($imagen) {
                $formularios["PESTANA_IMAGEN"] = array(
                    array(
                        HTML::imagen(HTTP::generarURL("VISUIMAG")."&id=".$imagen->id, array("width" => $imagen->ancho, "height" => $imagen->alto))
                    )
                );
            }
            
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
