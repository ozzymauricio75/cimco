<?php

/**
*
* Copyright (C) 2009 FELINUX Ltda
* Francisco J. Lozano B. <fjlozano@felinux.com.co>
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

    /*** Verificar que se haya enviado el ID del elemento a eliminar ***/
    if (empty($url_id)) {
        $error     = $textos["ERROR_ELIMINAR_VACIO"];
        $titulo    = "";
        $contenido = "";

    } else {
        $vistaConsulta             = "buscador_cotizaciones";
        $columnas                  = SQL::obtenerColumnas($vistaConsulta);
        $consulta                  = SQL::seleccionar(array($vistaConsulta), $columnas, "id = '$url_id'");
        $datos                     = SQL::filaEnObjeto($consulta);
        $error                     = "";
        $titulo                    = $componente->nombre;
        $id_requerimiento          = $datos->id_requerimiento;
        $estado_cotizacion_cliente = $datos->estado_cotizacion_cliente;
        
        $vistaRequerimiento     = "buscador_requerimientos_clientes";
        $condicionRequerimiento = "id = '$id_requerimiento'";
        $columnasRequerimiento  = SQL::obtenerColumnas($vistaRequerimiento);
        $consultaRequerimiento  = SQL::seleccionar(array($vistaRequerimiento), $columnasRequerimiento, $condicionRequerimiento);
        $datosRequerimiento     = SQL::filaEnObjeto($consultaRequerimiento);   
        $forma_id               = $datosRequerimiento->id; 

        if($estado != "1"){ 
            $error        = $textos["ERROR_ELIMINAR_COTIZAR"];
            $titulo       = "";
            $contenido    = "";
            $respuesta    = array();
            $respuesta[0] = $error;
            $respuesta[1] = $mensaje;
            $respuesta[2] = $mensaje;
            HTTP::enviarJSON($respuesta);
            exit();
            
        }else {
        
        /*** Definici�n de pesta�as ***/
        $formularios["PESTANA_GENERAL"] = array(
            array(   
                HTML::mostrarDato("fecha_ingreso", $textos["FECHA_INGRESO"], $datosRequerimiento->fecha_ingreso)
            ),
            array(   
                HTML::mostrarDato("numero_cotizacion", $textos["NUMERO_COTIZACION"], $datos->numero_cotizacion)
            ),
            array(   
                HTML::mostrarDato("numero_cotizacion_consorciado", $textos["NUMERO_COTIZACION_CONSORCIADO"], $datos->numero_cotizacion_consorciado)
            ),
            array(   
                HTML::mostrarDato("sucursal", $textos["SUCURSAL"], $datosRequerimiento->sucursal)
            ),
            array(   
                HTML::mostrarDato("nombre_sede", $textos["SEDE"], $datosRequerimiento->nombre_sede)
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
                HTML::mostrarDato("tipo_solicitud", $textos["TIPO_SOLICITUD"], $datosRequerimiento->tipo_solicitud)
            ),   
            array(
                HTML::mostrarDato("estado_consorciado", $textos["ESTADO_CONSORCIADO"], $datosRequerimiento->estado_consorciado),
                HTML::mostrarDato("estado_cotizacion_cliente", $textos["ESTADO_COTIZACION_CLIENTE"], $estado_cotizacion_cliente)
            )
        );
        
        }
        /*** Definici�n de botones ***/
        $botones = array(
            HTML::boton("botonAceptar", $textos["ACEPTAR"], "eliminarItem('$forma_id');", "aceptar")
        );

        $contenido = HTML::generarPestanas($formularios, $botones);
    }

    /*** Enviar datos para la generaci�n del formulario al script que origin� la petici�n ***/
    $respuesta    = array();
    $respuesta[0] = $error;
    $respuesta[1] = $titulo;
    $respuesta[2] = $contenido;
    HTTP::enviarJSON($respuesta);

/*** Eliminar el elemento seleccionado ***/
} elseif (!empty($forma_procesar)) {
    
    $consulta = SQL::eliminar("cotizaciones", "id_requerimiento = '$forma_id'");
    
    if ($consulta) {
        $error   = false;
        $mensaje = $textos["ITEM_ELIMINADO"];
    } else {
        $error   = true;
        $mensaje = $textos["ERROR_ELIMINAR_ITEM"];
    }
    
    $datos = array(
        "estado_requerimiento" => '1'
    );

    $consulta = SQL::modificar("requerimientos_clientes", $datos, "id = '$forma_id'");
        

    /*** Enviar datos con la respuesta del proceso al script que origin� la petici�n ***/
    $respuesta    = array();
    $respuesta[0] = $error;
    $respuesta[1] = $mensaje;
    HTTP::enviarJSON($respuesta);echo var_dump($estado_cotizacion_cliente);
}
?>
