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
    $error    = "";
    $titulo   = $componente->nombre;
    
    $tipo_solicitud = array(
        "M" => $textos["MANTENIMIENTO"],
        "E" => $textos["EMERGENCIA"],
        "S" => $textos["SERVICIO"],
        "P" => $textos["PROYECTO"],
        "V" => $textos["VISITA"]
    );
    
    $estado = array(
        "1" => $textos["APROBADA"],
        "0" => $textos["NO_APROBADA"]
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
        $error     = $textos["ERROR_SELECCIONAR"];
        $titulo    = "";
        $contenido = "";
        
    } else {
        $vistaConsulta     = "requerimientos_clientes";
        $condicion         = "id = '$url_id'";
        $columnas          = SQL::obtenerColumnas($vistaConsulta);
        $consulta          = SQL::seleccionar(array($vistaConsulta), $columnas, $condicion);
        $datos             = SQL::filaEnObjeto($consulta);
        $error             = "";
        
        if ($datos->notificado==1){
            $notificado = "Si";
        } else{
            $notificado = "No";
        }
        $titulo            = $componente->nombre;
        $id_municipio_sede = SQL::ObtenerValor("sedes_clientes","id_municipios","id = '$datos->id_sede'");
        $nombreSede        = SQL::ObtenerValor("sedes_clientes","nombre_sede","id = '$datos->id_sede'");
        $nombreMunicipio   = SQL::ObtenerValor("municipios","nombre", "id = '$id_municipio_sede'");
        $nombreSucursal    = SQL::ObtenerValor("sucursales","nombre","id = '$datos->id_sucursal'");
        
        if ($datos->estado_requerimiento != '4'){
           $visita = HTML::marcaChequeo("visita_sin_oferta", $textos["VISITA_SIN_OFERTA"]);
        } else {
           $visita = "";
        }

         /*** Definición de pestañas general ***/
         $formularios["PESTANA_GENERAL"] = array(
                array(
                    HTML::mostrarDato("sucursal", $textos["EMPRESA"],$nombreSucursal),
                    HTML::mostrarDato("numero_requerimiento", $textos["NUMERO_REQUERIMIENTO"], number_format($datos->id))
                ),
                array(
                    HTML::mostrarDato("nombre_sede", $textos["SEDE"],$nombreSede),
                    HTML::mostrarDato("municipio", $textos["MUNICIPIO"], $nombreMunicipio)
                ),
                array(
                    HTML::mostrarDato("fecha_ingreso", $textos["FECHA_INGRESO"],$datos->fecha_ingreso),
                    HTML::mostrarDato("fecha_limte_visita", $textos["FECHA_LIMITE_VISITA"],$datos->fecha_limite_visita)
                ),
                array(
                    HTML::mostrarDato("tipo_solictud", $textos["TIPO_SOLICITUD"],$tipo_solicitud[$datos->tipo_solicitud]),
                ),
                array(
                    HTML::mostrarDato("descripcion", $textos["DESCRIPCION"],$datos->descripcion)
                ),
                array(
                    HTML::mostrarDato("observaciones", $textos["OBSERVACIONES"],$datos->observaciones)
                ),
                array(
                    HTML::mostrarDato("nombre_contacto", $textos["CONTACTO"],$datos->nombre_contacto),
                    HTML::mostrarDato("telefono_contacto", $textos["TELEFONO_CONTACTO"],$datos->telefono_contacto)
                ),
                array(
                    HTML::mostrarDato("codigo_contable", $textos["CODIGO_CONTABLE"],$datos->codigo_contable)
                ),
                array(
                    HTML::mostrarDato("persona_recibe", $textos["PERSONA_RECIBE"],$datos->persona_recibe),
                    HTML::mostrarDato("medio_recibo", $textos["MEDIO_RECIBO"],$datos->medio_recibo)
                )
         );

         $formularios["PESTANA_VISITA"] = array(
             array(
                 HTML::campoTextoCorto("*fecha_visita", $textos["FECHA_VISITA"], 10, 10, $datos->fecha_visita, array("class" => "selectorFecha"), array("title" => $textos["AYUDA_FECHA_VISITA"]))
             ),
             array(
                $visita,
                HTML::campoOculto("estado_requerimiento",$datos->estado_requerimiento)
	         ),        
	         array(
	             HTML::campoTextoCorto("observaciones_visita", $textos["OBSERVACIONES_VISITA"], 60, 255, $datos->observaciones_visita,  array("title" => $textos["AYUDA_OBSERVACIONES"]))
             )
         );

        /*** Definición de botones ***/
        $botones = array(
            HTML::boton("botonAceptar", $textos["ACEPTAR"], "modificarItem('$url_id');", "aceptar")
        );
        $contenido = HTML::generarPestanas($formularios, $botones);
    }
    
    /*** Enviar datos para la generacion del formulario al script que origino la peticion ***/
    $respuesta[0] = $error;
    $respuesta[1] = $titulo;
    $respuesta[2] = $contenido;
    HTTP::enviarJSON($respuesta);

/*** Adicionar los datos provenientes del formulario ***/
} elseif (!empty($forma_procesar)) {
    
    /*** Asumir por defecto que no hubo error ***/
    $error   = false;
    $mensaje = $textos["ITEM_ADICIONADO"];
    
    if($forma_visita_sin_oferta == 1){
        $datos= array(
            "fecha_visita"         => $forma_fecha_visita,
            "observaciones_visita" => $forma_observaciones_visita,
            "estado_requerimiento" => '2'            
        );

    } else {                        
        if ($forma_estado_requerimiento == '4'){
            $estado = '4';
        } else {
            $estado = '3';
        }
        $datos= array(
            "fecha_visita"         => $forma_fecha_visita,
            "observaciones_visita" => $forma_observaciones_visita,
            "estado_requerimiento" => $estado
        );
    }
    $consulta = SQL::modificar("requerimientos_clientes", $datos, "id = '$forma_id'");
            
    if ($consulta) {                                                                                                                                                          
        $error   = false;                                                                                                                                                     
        $mensaje = $textos["ITEM_NO_COTIZAR"];                                                                                                                                
                                                                                                                                                                                      
    } else {                                                                                                                                                                  
        $error   = true;                                                                                                                                                      
        $mensaje = $textos["ERROR_NO_COTIZAR"];                                                                                                                           
    }   

    /*** Enviar datos con la respuesta del proceso al script que originó la petición ***/
    $respuesta    = array();
    $respuesta[0] = $error;
    $respuesta[1] = $mensaje;
    $respuesta[2] = $mensaje;
    HTTP::enviarJSON($respuesta);
}
?>
