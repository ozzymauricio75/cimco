<?php

/**
*
* Copyright (C) 2009 FELINUX Ltda
* Francisco J. Lozano B. <fjlozano@felinux.com.co>
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

    /*** Verificar que se haya enviado el ID del elemento a eliminar ***/
    if (empty($url_id)) {
        $error     = $textos["ERROR_ELIMINAR_VACIO"];
        $titulo    = "";
        $contenido = "";

    } else {
        $estado_requerimiento = SQL::obtenerValor("requerimientos_clientes","estado_requerimiento","id ='$url_id'");
        
        if ($estado_requerimiento == 4){
            $error     = $textos["REQUERIMIENTO_COTIZADO"];
            $titulo    = "";
            $contenido = "";
        } else if ($estado_requerimiento == 3){
            $error     = $textos["REQUERIMIENTO_VISITA"];
            $titulo    = "";
            $contenido = "";
        } else if ($estado_requerimiento == 2){
            $error     = $textos["REQUERIMIENTO_SIN_COTIZACION"];
            $titulo    = "";
            $contenido = "";
        } else {
            $vistaConsulta = "requerimientos_clientes";
            $columnas      = SQL::obtenerColumnas($vistaConsulta);
            $consulta      = SQL::seleccionar(array($vistaConsulta), $columnas, "id = '$url_id'");
            $datos         = SQL::filaEnObjeto($consulta);
            $error         = "";
            $titulo        = $componente->nombre;
    
            if ($datos->notificado==1){
                $notificado = "Si";
            } else{
                $notificado = "No";
            }
                
            $sede     = SQL::obtenerValor("sedes_clientes","nombre_sede","id = '$datos->id_sede'");
            $sucursal = SQL::obtenerValor("sucursales","nombre","id = '$datos->id_sucursal'");
    
            $tipo_solicitud = array(
                "M" => $textos["MANTENIMIENTO"],
                "E" => $textos["EMERGENCIA"],
                "S" => $textos["SERVICIO"],
                "P" => $textos["PROYECTO"],
                "V" => $textos["VISITA"]
            );
    
            /*** Definición de pestañas ***/
            $formularios["PESTANA_GENERAL"] = array(
                array(
                    HTML::mostrarDato("nombre_sede", $textos["SEDE"],$sede),
                    HTML::mostrarDato("sucursal", $textos["EMPRESA"],$sucursal)
                ),
                array(
                    HTML::mostrarDato("fecha_ingreso", $textos["FECHA_INGRESO"],$datos->fecha_ingreso),
                    HTML::mostrarDato("fecha_limite_visita", $textos["FECHA_LIMITE_VISITA"],$datos->fecha_limite_visita)
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
                    HTML::mostrarDato("notificado",$textos["NOTIFICADO"],$notificado)
                ),
                array(
                    HTML::mostrarDato("nombre_contacto", $textos["CONTACTO"],$datos->nombre_contacto)
                ),
                array(
                    HTML::mostrarDato("telefono_contacto", $textos["TELEFONO_CONTACTO"],$datos->telefono_contacto),
                    HTML::mostrarDato("codigo_contable", $textos["CODIGO_CONTABLE"],$datos->codigo_contable)
                ),
                array(
                    HTML::mostrarDato("persona_recibe", $textos["PERSONA_RECIBE"],$datos->persona_recibe),
                    HTML::mostrarDato("medio_recibo", $textos["MEDIO_RECIBO"],$datos->medio_recibo)
                )
            );
    
            /*** Definición de botones ***/
            $botones = array(
                HTML::boton("botonAceptar", $textos["ACEPTAR"], "eliminarItem('$url_id');", "aceptar")
            );
    
            $contenido = HTML::generarPestanas($formularios, $botones);
        }
    }

    /*** Enviar datos para la generación del formulario al script que originó la petición ***/
    $respuesta    = array();
    $respuesta[0] = $error;
    $respuesta[1] = $titulo;
    $respuesta[2] = $contenido;
    HTTP::enviarJSON($respuesta);

/*** Eliminar el elemento seleccionado ***/
} elseif (!empty($forma_procesar)) {
    $consulta = SQL::eliminar("requerimientos_clientes", "id = '$forma_id'");

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
