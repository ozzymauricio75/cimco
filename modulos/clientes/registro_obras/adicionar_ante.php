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

    $tipo_acta = array(
        "1" => $textos["ACTA_INICIO"],
        "2" => $textos["ACTA_AVANCE_OBRA"],
        "3" => $textos["ACTA_FINALIZACION"]
    );
        
    /*** Verificar que se haya enviado el ID del elemento a consultar ***/
    if (empty($url_id)) {
        $error     = $textos["ERROR_CONSULTAR_VACIO"];
        $titulo    = "";
        $contenido = "";

    } else {
        /*** Obtener los resultados para la pagina actual ***/
        $vistaConsulta                   = "cotizaciones";                                                             
        $columnas                        = SQL::obtenerColumnas($vistaConsulta);                                       
        $consulta                        = SQL::seleccionar(array($vistaConsulta), $columnas, "id = '$url_id' AND estado = '2'");       
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
        
        $estado                          = SQL::obtenerValor("buscador_cotizaciones", "estado", "id = '$url_id'");                                       
        $tipo_solicitud                  = SQL::obtenerValor("buscador_cotizaciones", "tipo_solicitud", "id = '$url_id'");                               
        $forma_pago                      = SQL::obtenerValor("buscador_cotizaciones", "forma_pago", "id = '$url_id'");                                   
                                                                                                                                                         
        $descripcion                     = SQL::obtenerValor("requerimientos_clientes", "descripcion", "id = '$datos->id_requerimiento'");               
        $observaciones_visita            = SQL::obtenerValor("requerimientos_clientes", "observaciones_visita", "id = '$datos->id_requerimiento'");      
        $nombre_contacto                 = SQL::obtenerValor("requerimientos_clientes", "nombre_contacto", "id = '$datos->id_requerimiento'");           
        $fecha_ingreso                   = SQL::obtenerValor("requerimientos_clientes", "fecha_ingreso", "id = '$datos->id_requerimiento'");             
        $Sede                            = SQL::obtenerValor("requerimientos_clientes", "id_sede", "id = '$datos->id_requerimiento'");                   
        $nombreSede                      = SQL::obtenerValor("sedes_clientes", "nombre_sede", "id = '$Sede'");                                           
        $municipio                       = SQL::obtenerValor("sedes_clientes", "id_municipios", "id = '$Sede'");                                         
        $nombreMunicipio                 = SQL::obtenerValor("municipios", "nombre", "id = '$municipio'");                                               
        $id_sucursal                     = SQL::obtenerValor("requerimientos_clientes", "id_sucursal", "id = '$datos->id_requerimiento'");               
        $nombreSucursal                  = SQL::obtenerValor("sucursales", "nombre", "id = '$id_sucursal'"); 
        $acta                            = SQL::obtenerValor("registro_obras", "tipo_acta", "id_cotizacion = '$url_id' LIMIT 0,1");
        $valor_facturar                  = SQL::obtenerValor("registro_obras", "valor_facturar", "id_cotizacion = '$url_id'");
       
        $consulta                        = mysql_query("SELECT SUM(valor_facturar)AS valor FROM pance_registro_obras WHERE id_cotizacion = '$datos->id'");
        $resultado                       = mysql_fetch_object($consulta);
        $acumulado                       = $resultado->valor;
        $acumulado_formato               = $totalGeneral - $acumulado;
        $acumulado_formato               = number_format($acumulado_formato);
        $subTotal                        = number_format($subTotal);
        $totalGeneral                    = number_format($totalGeneral);        
     
      if(($acta == '3') && ($valor_facturar != "")){
            $error     = "La obra se encuentra finalizada";
            $respuesta    = array();
            $respuesta[0] = $error;
            $respuesta[1] = $error;
            HTTP::enviarJSON($respuesta);
            exit();
            
        } elseif(($acta == '1') && ($valor_facturar == "") ||($acta == '2') && ($valor_facturar != "")) {
            if($forma_pago == "Pago parcial"){
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
                    HTML::mostrarDato("numero_cotizacion", $textos["NUMERO_COTIZACION"], $datos->numero_cotizacion."-".$datos->consecutivo_cotizacion),
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
                    HTML::mostrarDato("total_general", $textos["TOTAL_GENERAL"], $textos["SIMBOLO_PESO"].$totalGeneral)
                )
            );
          
            /*** Definición de pestañas ***/
            $formularios["PESTANA_DATOS_CONTROL"] = array(   
                array(   
                    HTML::marcaSeleccion("tipo_acta", $textos["ACTA_AVANCE_OBRA"], 2, true, array("id" => "avance", "onChange" => "activarValorFacturar(2)"))
                ),   
                array(   
                    HTML::marcaSeleccion("tipo_acta", $textos["ACTA_FINALIZACION"], 3, false, array("id" => "final", "onChange" => "activarValorFacturar(3)"))
                ),   
                array(   
                    HTML::campoTextoCorto("*fecha_entrega_acta", $textos["FECHA_ENTREGA_ACTA"], 10, 10, date("Y-m-d"), array("class" => "selectorFecha"), array("title" => $textos["AYUDA_FECHA_ENTREGA_ACTA"])),
                ),
                array(   
                    HTML::campoTextoCorto("*valor_facturar", $textos["VALOR_FACTURAR"], 12, 12, 0, array("title" => $textos["AYUDA_VALOR_FACTURAR"],"class" => "numero")),
                    HTML::campoTextoCorto("*porcentaje_mano_obra", $textos["PORCENTAJE_MANO_OBRA"], 4, 4, "", array("title" => $textos["AYUDA_PORCENTAJE_MANO_OBRA"])),
                    HTML::campoTextoCorto("*porcentaje_materiales", $textos["PORCENTAJE_MATERIALES"], 4, 4, "", array("title" => $textos["AYUDA_PORCENTAJE_MATERIALES"]))
                ),
                array(
                    HTML::selectorArchivo("imagen", $textos["IMAGEN"], array("title" => $textos["AYUDA_IMAGEN"]))
                ),
                array(
  	                HTML::campoOculto("requerimiento", $datos->id_requerimiento),
  	                HTML::campoOculto("cotizacion", $url_id),
  	                HTML::campoOculto("acumulado", $acumulado),
  	                HTML::campoOculto("acumulado_formato", $acumulado_formato),
  	                HTML::campoOculto("total_general", $totalGeneral)
                )
            );
       
            }elseif($forma_pago == "Contra-entrega"){
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
                        HTML::mostrarDato("numero_cotizacion", $textos["NUMERO_COTIZACION"], $datos->numero_cotizacion."-".$datos->consecutivo_cotizacion),
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
                        HTML::mostrarDato("total_general", $textos["TOTAL_GENERAL"], $textos["SIMBOLO_PESO"].$totalGeneral)
                    )
                );
          
                /*** Definición de pestañas ***/
                $formularios["PESTANA_DATOS_CONTROL"] = array(
                    array(   
                        HTML::marcaSeleccion("tipo_acta", $textos["ACTA_FINALIZACION"], 3, true, array("id" => "final", "onChange" => "activarValorFacturar(3)"))
                    ),
                    array(   
                        HTML::campoTextoCorto("*fecha_entrega_acta", $textos["FECHA_ENTREGA_ACTA"], 10, 10, date("Y-m-d"), array("class" => "selectorFecha"), array("title" => $textos["AYUDA_FECHA_ENTREGA_ACTA"])),
                    ),
                    array(   
                        HTML::campoTextoCorto("*valor_facturar", $textos["VALOR_FACTURAR"], 12, 12, 0, array("title" => $textos["AYUDA_VALOR_FACTURAR"],"class" => "numero")),
                        HTML::campoTextoCorto("*porcentaje_mano_obra", $textos["PORCENTAJE_MANO_OBRA"], 4, 4, "", array("title" => $textos["AYUDA_PORCENTAJE_MANO_OBRA"])),
                        HTML::campoTextoCorto("*porcentaje_materiales", $textos["PORCENTAJE_MATERIALES"], 4, 4, "", array("title" => $textos["AYUDA_PORCENTAJE_MATERIALES"]))
                    ),            
                    array(
                        HTML::selectorArchivo("imagen", $textos["IMAGEN"], array("title" => $textos["AYUDA_IMAGEN"]))
                    ),
                    array(
  	                    HTML::campoOculto("requerimiento", $datos->id_requerimiento),
  	                    HTML::campoOculto("cotizacion", $url_id),
  	                    HTML::campoOculto("acumulado", $acumulado),
  	                    HTML::campoOculto("total_general", $totalGeneral)
                    )
                );
            }

        }elseif(($acta != '1') || ($acta != '2') || ($acta != '3')){            
            if($forma_pago == "Pago parcial"){
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
                        HTML::mostrarDato("numero_cotizacion", $textos["NUMERO_COTIZACION"], $datos->numero_cotizacion."-".$datos->consecutivo_cotizacion),
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
                        HTML::mostrarDato("total_general", $textos["TOTAL_GENERAL"], $textos["SIMBOLO_PESO"].$totalGeneral)
                    )
                );
          
                /*** Definición de pestañas ***/
                $formularios["PESTANA_DATOS_CONTROL"] = array(
                    array(  
                        HTML::marcaSeleccion("tipo_acta", $textos["ACTA_INICIO"], 1, true, array("id" => "inicio", "onFocus" => "activarValorFacturar(1)"))
                    ),   
                    array(   
                        HTML::campoTextoCorto("*fecha_entrega_acta", $textos["FECHA_ENTREGA_ACTA"], 10, 10, date("Y-m-d"), array("class" => "selectorFecha"), array("title" => $textos["AYUDA_FECHA_ENTREGA_ACTA"])),
                    ),
                    array(
                        HTML::selectorArchivo("imagen", $textos["IMAGEN"], array("title" => $textos["AYUDA_IMAGEN"]))
                    ),
                    array(
  	                    HTML::campoOculto("requerimiento", $datos->id_requerimiento),
  	                    HTML::campoOculto("cotizacion", $url_id),
  	                    HTML::campoOculto("acumulado", $acumulado),
  	                    HTML::campoOculto("total_general", $totalGeneral)
                    )
                );
       
            }elseif($forma_pago == "Contra-entrega"){
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
                        HTML::mostrarDato("numero_cotizacion", $textos["NUMERO_COTIZACION"], $datos->numero_cotizacion."-".$datos->consecutivo_cotizacion),
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
                        HTML::mostrarDato("total_general", $textos["TOTAL_GENERAL"], $textos["SIMBOLO_PESO"].$totalGeneral)
                    )
                );
          
                /*** Definición de pestañas ***/
                $formularios["PESTANA_DATOS_CONTROL"] = array(
                    array(   
                        HTML::marcaSeleccion("tipo_acta", $textos["ACTA_FINALIZACION"], 3, true, array("id" => "final", "onChange" => "activarValorFacturar(3)"))
                    ),
                    array(   
                        HTML::campoTextoCorto("*fecha_entrega_acta", $textos["FECHA_ENTREGA_ACTA"], 10, 10, date("Y-m-d"), array("class" => "selectorFecha"), array("title" => $textos["AYUDA_FECHA_ENTREGA_ACTA"])),
                    ),
                    array(   
                        HTML::campoTextoCorto("*valor_facturar", $textos["VALOR_FACTURAR"], 12, 12, $totalGeneral, array("title" => $textos["AYUDA_VALOR_FACTURAR"],"class" => "numero")),
                        HTML::campoTextoCorto("*porcentaje_mano_obra", $textos["PORCENTAJE_MANO_OBRA"], 4, 4, "", array("title" => $textos["AYUDA_PORCENTAJE_MANO_OBRA"])),
                        HTML::campoTextoCorto("*porcentaje_materiales", $textos["PORCENTAJE_MATERIALES"], 4, 4, "", array("title" => $textos["AYUDA_PORCENTAJE_MATERIALES"]))
                    ),            
                    array(
                        HTML::selectorArchivo("imagen", $textos["IMAGEN"], array("title" => $textos["AYUDA_IMAGEN"]))
                    ),
                    array(
  	                    HTML::campoOculto("requerimiento", $datos->id_requerimiento),
  	                    HTML::campoOculto("cotizacion", $url_id),
  	                    HTML::campoOculto("acumulado", $acumulado),
  	                    HTML::campoOculto("total_general", $totalGeneral)
                    )
                );
            }
        }
        /*** Definición de botones ***/
        $botones = array(
            HTML::boton("botonAceptar", $textos["ACEPTAR"], "adicionarItem();", "aceptar")
        );

        $contenido = HTML::generarPestanas($formularios, $botones);

    }
    /*** Enviar datos para la generación del formulario al script que originó la petición ***/
    $respuesta[0] = $error;
    $respuesta[1] = $titulo;
    $respuesta[2] = $contenido;
    HTTP::enviarJSON($respuesta);
    exit();
/*** Validar los datos provenientes del formulario ***/
} elseif (!empty($url_validar)) {

    /*** Validar numero de la cotizacion consorciado***/
    if ($url_item == "id" && $url_valor) {
        $existe = SQL::existeItem("registro_obras", "id", $url_valor);

        if ($existe) {
            $respuesta = $textos["ERROR_EXISTE_ACTA"];
        }
    }
    
    HTTP::enviarJSON($respuesta);
    exit();
}
    /*** Adicionar los datos provenientes del formulario ***/
    /*** Asumir por defecto que no hubo error ***/
    $error   = false;
    $mensaje = $textos["ITEM_ADICIONADO"];

    if(!isset($forma_factura_consorciado)){
        $forma_factura_consorciado = 0;
    }
    if(!isset($forma_pago_cliente)){
        $forma_pago_cliente = 0;
    }
    if(!isset($forma_pago_consorciado)){
        $forma_pago_consorciado = 0;
    }

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
    
    $forma_valor_facturar = quitarMiles($forma_valor_facturar);
    $forma_total_general  = quitarMiles($forma_total_general);

    if($forma_tipo_acta == '1'){
        if (empty($forma_tipo_acta) || empty($forma_fecha_entrega_acta)){
            $error   = true;
            $mensaje = $textos["ERROR_DATOS_INCOMPLETOS"];
        }
    }else{
        if (empty($forma_tipo_acta) || empty($forma_fecha_entrega_acta) || empty($forma_porcentaje_mano_obra) || empty($forma_porcentaje_materiales)){
            $error   = true;
            $mensaje = $textos["ERROR_DATOS_INCOMPLETOS"];
        }
    }
    if (!empty($forma_valor_facturar) && !Cadena::validarNumeros($forma_valor_facturar)) {                                                          
            $error   = true;                                                                                                                                                          
            $mensaje =  $textos["ERROR_FORMATO_VALOR_FACTURAR"];     
    }elseif (!empty($forma_porcentaje_mano_obra) && !Cadena::validarNumeros($forma_porcentaje_mano_obra)) {                                                          
            $error   = true;                                                                                                                                                          
            $mensaje =  $textos["ERROR_FORMATO_PORCENTAJE_MANO_OBRA"];     
    }elseif (!empty($forma_porcentaje_materiales) && !Cadena::validarNumeros($forma_porcentaje_materiales)) {                                                          
            $error   = true;                                                                                                                                                          
            $mensaje =  $textos["ERROR_FORMATO_PORCENTAJE_MATERIALES"];     
    }else{
        $total_acumulado      = $forma_acumulado + $forma_valor_facturar;
        /*if(($forma_tipo_acta == '3') && ($total_acumulado < $forma_total_general) || ($forma_tipo_acta == '3') && ($forma_valor_facturar > $forma_total_general)){
            $error        = "El valor del acta finalización debe ser igual al total general";
            $respuesta    = array();
            $respuesta[0] = $error;
            $respuesta[1] = $error;
            HTTP::enviarJSON($respuesta);
            exit();

        }elseif($forma_acumulado >= $forma_total_general){
            $error        = $textos["ERROR_COMPLETO_OBRA"];
            $respuesta    = array();
            $respuesta[0] = $error;
            $respuesta[1] = $error;
            HTTP::enviarJSON($respuesta);
            exit();
   
        }elseif($total_acumulado > $forma_total_general){     
            $resto_facturar = $forma_total_general - $forma_acumulado;
            $error          = $textos["FALTA_FACTURAR"].number_format($resto_facturar);
            $respuesta      = array();
            $respuesta[0]   = $error;
            $respuesta[1]   = $error;
            HTTP::enviarJSON($respuesta);
            exit();

        } else{
        */  $datos = array(
                "id_cotizacion"         => $forma_cotizacion,
                "tipo_acta"             => $forma_tipo_acta,
                "fecha_entrega_acta"    => $forma_fecha_entrega_acta,
                "valor_facturar"        => $forma_valor_facturar,
                "porcentaje_mano_obra"  => $forma_porcentaje_mano_obra,
                "porcentaje_materiales" => $forma_porcentaje_materiales
            );

            $insertar = SQL::insertar("registro_obras", $datos);                                                                                        

            /*** Error de inserción ***/
            if (!$insertar) {
                $error   = true;
                $mensaje = $textos["ERROR_ADICIONAR_ITEM"];
        
            } else {
           	    if (!empty($_FILES["imagen"])) {
                    $idAsignado = SQL::$ultimoId;
                    $original   = $_FILES["imagen"]["name"];
                    $temporal   = $_FILES["imagen"]["tmp_name"];
                    $extension  = strtolower(substr($original, (strrpos($original, ".") - strlen($original)) + 1));

                    if (strtolower($extension) != "png" && strtolower($extension) != "jpg" && strtolower($extension) != "gif") {
                        $error   = true;
                        $mensaje = $textos["ERROR_FORMATO_IMAGEN"];

                    } else {
                        list($ancho, $alto, $tipo) = getimagesize($temporal);

                        $datos   = array(
                            "categoria"   => 2,
                            "id_asociado" => $idAsignado,
                            "contenido"   => file_get_contents($temporal),
                            "tipo"        => $tipo,
                            "extension"   => $extension,
                            "ancho"       => $ancho,
                            "alto"        => $alto
                        );

                        $insertar = SQL::insertarArchivo("imagenes", $datos);
                        /*** Error de insercón ***/
                        if (!$insertar) {
                            $error   = true;
                            $mensaje = $textos["ERROR_ADICIONAR_IMAGEN"];
                        }
                    }
                }
            }
    }
    /*** Enviar datos con la respuesta del proceso al script que originï¿½ la peticiï¿½n ***/
    $respuesta    = array();
    $respuesta[0] = $error;
    $respuesta[1] = $mensaje;
    HTTP::enviarJSON($respuesta);
?>
