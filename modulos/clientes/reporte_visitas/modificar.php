<?php

/**
*
* Copyright (C) 2009 FELINUX Ltda
* Francisco J. Lozano B. <fjlozano@felinux.com.co>
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

    $tipo_solicitud = array(
        "M" => $textos["MANTENIMIENTO"],
        "E" => $textos["EMERGENCIA"],
        "S" => $textos["SERVICIO"],
        "P" => $textos["PROYECTO"]
    );
    
    $estado_cotizacion = array(
        "0" => $textos["NO_APROBADA"],
        "1" => $textos["APROBADA"]
    );
    
    $forma_pago = array(
        "0" => $textos["PAGO_PARCIAL"],
        "1" => $textos["CONTRAENTREGA"]
    );
    
    $estado_cliente = array(
        "0" => $textos["NO_ENVIADA"],
        "1" => $textos["ENVIADA"]
    );
    
    /*** Verificar que se haya enviado el ID del elemento a modificar ***/
    if (empty($url_id)) {
        $error     = $textos["ERROR_MODIFICAR_VACIO"];
        $titulo    = "";
        $contenido = "";

    } else {
        $vistaConsulta          = "buscador_cotizaciones";
        $condicion              = "id = '$url_id'";
        $columnas               = SQL::obtenerColumnas($vistaConsulta);
        $consulta               = SQL::seleccionar(array($vistaConsulta), $columnas, $condicion);
        $datos                  = SQL::filaEnObjeto($consulta);
        $error                  = "";
        $titulo                 = $componente->nombre;
        $id_requerimiento       = $datos->id_requerimiento;
        
        $vistaRequerimiento        = "requerimientos_clientes";
        $condicionRequerimiento    = "id = '$id_requerimiento'";
        $columnasRequerimiento     = SQL::obtenerColumnas($vistaRequerimiento);
        $consultaRequerimiento     = SQL::seleccionar(array($vistaRequerimiento), $columnasRequerimiento, $condicionRequerimiento);
        $datosRequerimiento        = SQL::filaEnObjeto($consultaRequerimiento);   
        $forma_id                  = $datosRequerimiento->id; 
        $estado_cotizacion_cliente = $datosRequerimiento->estado_cotizacion_cliente;
        
        $vistaBuscadorRequerimiento     = "seleccion_requerimientos_clientes";
        $condicionBuscadorRequerimiento = "id = '$id_requerimiento'";
        $columnasBuscadorRequerimiento  = SQL::obtenerColumnas($vistaBuscadorRequerimiento);
        $consultaRequerimiento          = SQL::seleccionar(array($vistaBuscadorRequerimiento), $columnasBuscadorRequerimiento, $condicionBuscadorRequerimiento);
        $datosBuscadorRequerimiento     = SQL::filaEnObjeto($consultaRequerimiento);      

        if($estado_cotizacion_cliente == 0){ 
            $error        = $textos["ERROR_MODIFICAR_COTIZAR"];
            $titulo       = "";
            $contenido    = "";
            $respuesta    = array();
            $respuesta[0] = $error;
            $respuesta[1] = $mensaje;
            $respuesta[2] = $mensaje;
            HTTP::enviarJSON($respuesta);
            exit();
            
        }else {
         
        /*** Definición de pestañas ***/
        $formularios["PESTANA_GENERAL"] = array(
            array(   
                HTML::mostrarDato("fecha_ingreso", $textos["FECHA_INGRESO"], $datosRequerimiento->fecha_ingreso)
            ),
            array(   
                HTML::mostrarDato("numero_cotizacion", $textos["NUMERO_COTIZACION"],$datos->numero_cotizacion)
            ),
            array(   
                HTML::mostrarDato("numero_cotizacion_consorciado", $textos["NUMERO_COTIZACION_CONSORCIADO"],$datos->numero_cotizacion_consorciado)
            ),
            array(   
                HTML::mostrarDato("sucursal", $textos["SUCURSAL"], $datosBuscadorRequerimiento->sucursal)
            ),
            array(   
                HTML::mostrarDato("nombre_sede", $textos["SEDE"], $datosBuscadorRequerimiento->nombre_sede)
            ),
            array(
                HTML::mostrarDato("descripcion", $textos["DESCRIPCION"], $datosRequerimiento->descripcion)
            ),
            array(    
                HTML::mostrarDato("observaciones", $textos["OBSERVACIONES"], $datosRequerimiento->observaciones)
            ),
            array(    
                HTML::mostrarDato("nombre_contacto", $textos["CONTACTO"], $datosRequerimiento->contacto)
            ),
            array(    
                HTML::mostrarDato("tipo_solicitud", $textos["TIPO_SOLICITUD"], $datosBuscadorRequerimiento->tipo_solicitud)
            ),   
            array(
                HTML::mostrarDato("estado_consorciado", $textos["ESTADO_CONSORCIADO"],$datosBuscadorRequerimiento->estado_consorciado)
            )
        );
        /*** Definición de pestañas ***/
        $formularios["PESTANA_DATOS_OPERACIONES"] = array(
            array(
                HTML::listaSeleccionSimple("*estado_cotizacion_cliente", $textos["ESTADO_COTIZACION_CLIENTE"], $estado_cliente, SQL::obtenerValor("requerimientos_clientes", "estado_cotizacion_cliente", $condicion), array("title" => $textos["AYUDA_ESTADO_COTIZACION_CLIENTE"]))
            ),
            array(   
                HTML::listaSeleccionSimple("*forma_pago", $textos["FORMA_PAGO"], $forma_pago, SQL::obtenerValor("requerimientos_clientes", "forma_pago", $condicion), array("title" => $textos["AYUDA_FORMA_PAGO"]))
            ),
            array(
                HTML::campoTextoCorto("*valor_mano_obra_cotizacion", $textos["VALOR_MANO_OBRA_COTIZACION"], 12, 12, $datosRequerimiento->valor_mano_obra_cotizacion, array("title" => $textos["AYUDA_VALOR_MANO_OBRA_COTIZACION"], "onChange" => "CalculaCosto()")),
                HTML::campoTextoCorto("*valor_materiales_cotizacion", $textos["VALOR_MATERIALES_COTIZACION"], 12, 12, $datosRequerimiento->valor_materiales_cotizacion, array("title" => $textos["AYUDA_VALOR_MATERIALES_COTIZACION"], "onChange" => "CalculaCosto()")),
                HTML::campoTextoCorto("*costo_directo", $textos["COSTO_DIRECTO"], 12, 12, $datosRequerimiento->costo_directo, array("class" => "costo_directo", "title" => $textos["AYUDA_COSTO_DIRECTO"]))
            ),
            array(
                HTML::campoTextoCorto("*porcentaje_administracion_cotizacion", $textos["PORCENTAJE_ADMINISTRACION_COTIZACION"], 4, 4, $datosRequerimiento->porcentaje_administracion_cotizacion, array("title" => $textos["AYUDA_PORCENTAJE_ADMINISTRACION_COTIZACION"],"onChange" => "CalculaAdministracion()")),
                HTML::campoTextoCorto("*costo_administracion_cotizacion", $textos["VALOR_ADMINISTRACION_COTIZACION"], 12, 12, $datosRequerimiento->costo_administracion_cotizacion, array("class" => "costo_administracion_cotizacion", "title" => $textos["AYUDA_VALOR_ADMINISTRACION_COTIZACION"])),
                HTML::campoTextoCorto("*porcentaje_imprevistos_cotizacion", $textos["PORCENTAJE_IMPREVISTOS_COTIZACION"], 4, 4, $datosRequerimiento->porcentaje_imprevistos_cotizacion, array("title" => $textos["AYUDA_PORCENTAJE_IMPREVISTOS_COTIZACION"],"onChange" => "CalculaImprevistos()")),
                HTML::campoTextoCorto("*costo_imprevistos_cotizacion", $textos["VALOR_IMPREVISTOS_COTIZACION"], 12, 12, $datosRequerimiento->costo_imprevistos_cotizacion, array("class" => "costo_imprevistos_cotizacion", "title" => $textos["AYUDA_VALOR_IMPREVISTOS_COTIZACION"]))
            ),  
            array(
                HTML::campoTextoCorto("*porcentaje_utilidad", $textos["PORCENTAJE_UTILIDAD"], 4, 4, $datosRequerimiento->porcentaje_utilidad, array("title" => $textos["AYUDA_PORCENTAJE_UTILIDAD"],"onChange" => "CalculaUtilidad()")),
                HTML::campoTextoCorto("*costo_utilidad", $textos["VALOR_UTILIDAD"], 12, 12, $datosRequerimiento->costo_utilidad, array("class" => "costo_utilidad", "title" => $textos["AYUDA_VALOR_UTILIDAD"])),
                HTML::campoTextoCorto("*impuesto", $textos["IMPUESTO"], 4, 4, $datosRequerimiento->impuesto, array("title" => $textos["AYUDA_IMPUESTO"], "onChange" => "CalculaCostoImpuesto()")),
                HTML::campoTextoCorto("*costo_impuesto", $textos["VALOR_IMPUESTO"], 12, 12, $datosRequerimiento->costo_impuesto, array("class" => "costo_impuesto", "title" => $textos["AYUDA_VALOR_IMPUESTO"]))
            ),
            array(
                HTML::campoTextoCorto("*porcentaje_anticipo", $textos["PORCENTAJE_ANTICIPO"], 4, 4, $datosRequerimiento->porcentaje_anticipo, array("title" => $textos["AYUDA_PORCENTAJE_ANTICIPO"])),
                HTML::campoTextoCorto("*porcentaje_mano_obra", $textos["PORCENTAJE_MANO_OBRA"], 4, 4, $datosRequerimiento->porcentaje_mano_obra, array("title" => $textos["AYUDA_PORCENTAJE_MANO_OBRA"])),
                HTML::campoTextoCorto("*porcentaje_materiales", $textos["PORCENTAJE_MATERIALES"], 4, 4, $datosRequerimiento->porcentaje_materiales, array("title" => $textos["AYUDA_PORCENTAJE_MATERIALES"]))
            )
        );
        
        }
        /*** Definición de botones ***/
        $botones = array(
            HTML::boton("botonAceptar", $textos["ACEPTAR"], "modificarItem('$forma_id');", "aceptar")
        );

        $contenido = HTML::generarPestanas($formularios, $botones);
    }

    /*** Enviar datos para la generación del formulario al script que originó la petición ***/
    $respuesta    = array();
    $respuesta[0] = $error;
    $respuesta[1] = $titulo;
    $respuesta[2] = $contenido;
    HTTP::enviarJSON($respuesta);


/*** Modificar el elemento seleccionado ***/
} elseif (!empty($forma_procesar)) {

    /*** Asumir por defecto que no hubo error ***/
    $error   = false;
    $mensaje = $textos["ITEM_MODIFICADO"];
       
    /*** Validar el ingreso de los datos requeridos ***/
    if (empty($forma_valor_mano_obra_cotizacion) || empty($forma_valor_materiales_cotizacion)                    
       || empty($forma_porcentaje_mano_obra) || empty($forma_porcentaje_materiales)) {                                                                      
       $error   = true;                                                                                                                                                          
       $mensaje = $textos["ERROR_DATOS_INCOMPLETOS"];                                                            

    } else {

        $datos = array(
            "estado_cotizacion_cliente"             => $forma_estado_cotizacion_cliente,                      
            "valor_mano_obra_cotizacion"            => $forma_valor_mano_obra_cotizacion,                                                                                                                 
            "valor_materiales_cotizacion"           => $forma_valor_materiales_cotizacion,  
            "costo_directo"                         => $forma_costo_directo,
            "porcentaje_administracion_cotizacion"  => $forma_porcentaje_administracion_cotizacion,               
            "costo_administracion_cotizacion"       => $forma_costo_administracion_cotizacion,                                                                                              
            "porcentaje_imprevistos_cotizacion"     => $forma_porcentaje_imprevistos_cotizacion,                                                                                            
            "costo_imprevistos_cotizacion"          => $forma_costo_imprevistos_cotizacion,  
            "estado_cotizacion_cliente"             => '1',
            "porcentaje_utilidad"                   => $forma_porcentaje_utilidad,                                
            "costo_utilidad"                        => $forma_costo_utilidad,                                     
            "impuesto"                              => $forma_impuesto,                                           
            "costo_impuesto"                        => $forma_costo_impuesto,                                     
            "forma_pago"                            => $forma_forma_pago,                                         
            "porcentaje_anticipo"                   => $forma_porcentaje_anticipo,                                
            "porcentaje_mano_obra"                  => $forma_porcentaje_mano_obra,                               
            "porcentaje_materiales"                 => $forma_porcentaje_materiales                                                                                                                                                                                                      
        );

        $consulta = SQL::modificar("requerimientos_clientes", $datos, "id = '$forma_id'");

        if ($consulta) {
            $error   = false;
            $mensaje = $textos["ITEM_MODIFICADO"];
        } else {
            $error   = true;
            $mensaje = $textos["ERROR_MODIFICAR_ITEM"];
        }
    }
    
    /*** Enviar datos con la respuesta del proceso al script que originó la petición ***/
    $respuesta    = array();
    $respuesta[0] = $error;
    $respuesta[1] = $mensaje;
    HTTP::enviarJSON($respuesta);
  
}
?>
