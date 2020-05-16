<?php

/**
*
* Copyright (C) 2009 FELINUX Ltda
* Francisco J. Lozano B. <fjlozano@felinux.com.co>
* Mauricio Oidor L. <ozzymauricio75@gmail.com>
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

    /*** Verificar que se haya enviado el ID del elemento a modificar ***/
    if (empty($url_id)) {
        $error     = $textos["ERROR_MODIFICAR_VACIO"];
        $titulo    = "";
        $contenido = "";

    } else {
        $vistaConsulta = "buscador_tipos_bodegas";
        $condicion     = "id = '$url_id'";
        $columnas      = SQL::obtenerColumnas($vistaConsulta);
        $consulta      = SQL::seleccionar(array($vistaConsulta), $columnas, $condicion);
        $datos         = SQL::filaEnObjeto($consulta);
        $error         = "";
        $titulo        = $componente->nombre;
        
        /*** Definici�n de pesta�as ***/
        $formularios["PESTANA_GENERAL"] = array(            
            array(                
                HTML::campoTextoCorto("*nombre", $textos["NOMBRE"],60, 60, $datos->nombre, array("title" => $textos["AYUDA_NOMBRE"]))
            ),
            array(
                HTML::campoTextoCorto("*descripcion", $textos["DESCRIPCION"],60, 60, $datos->descripcion, array("title" => $textos["AYUDA_DESCRIPCION"]))
            )
        );

        /*** Definici�n de botones ***/
        $botones = array(
            HTML::boton("botonAceptar", $textos["ACEPTAR"], "modificarItem('$url_id');", "aceptar")
        );

        $contenido = HTML::generarPestanas($formularios, $botones);
    }

    /*** Enviar datos para la generaci�n del formulario al script que origin� la petici�n ***/
    $respuesta    = array();
    $respuesta[0] = $error;
    $respuesta[1] = $titulo;
    $respuesta[2] = $contenido;
    HTTP::enviarJSON($respuesta);
} elseif (!empty($url_validar)) {

    $respuesta = "";
    
    /*** Validar nombre ***/
    if ($url_item == "nombre") {
        $existe = SQL::existeItem("tipos_bodegas", "nombre", $url_valor);

        if ($existe) {
            $respuesta = $textos["ERROR_EXISTE_NOMBRE"];
        }
    }
    
    /*** Validar descripcion ***/
    if ($url_item == "descripcion") {
        $existe = SQL::existeItem("tipos_bodegas", "descripcion", $url_valor);

        if ($existe) {
            $respuesta = $textos["ERROR_EXISTE_DESCRIPCION"];
        }
    }
    
    HTTP::enviarJSON($respuesta);

/*** Validar los datos provenientes del formulario ***/
} elseif (!empty($url_validar)) {

    $respuesta = "";
    
    HTTP::enviarJSON($respuesta);

/*** Modificar el elemento seleccionado ***/
} elseif (!empty($forma_procesar)) {

    /*** Asumir por defecto que no hubo error ***/
    $error   = false;
    $mensaje = $textos["ITEM_MODIFICADO"];

    /*** Validar el ingreso de los datos requeridos ***/
    if (empty($forma_descripcion)) {
        $error   = true;
        $mensaje = $textos["ERROR_DATOS_INCOMPLETOS"];
        
    } else {

        $datos = array(
            "descripcion" => $forma_descripcion
        );

        $consulta = SQL::modificar("tipos_bodegas", $datos, "id = '$forma_id'");

        if ($consulta) {
            $error   = false;
            $mensaje = $textos["ITEM_MODIFICADO"];
        } else {
            $error   = true;
            $mensaje = $textos["ERROR_MODIFICAR_ITEM"];
        }
    }
    
    /*** Enviar datos con la respuesta del proceso al script que origin� la petici�n ***/
    $respuesta    = array();
    $respuesta[0] = $error;
    $respuesta[1] = $mensaje;
    HTTP::enviarJSON($respuesta);
}
?>
