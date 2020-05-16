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

    /*** Verificar que se haya enviado el ID del elemento a modificar ***/
    if (empty($url_id)) {
        $error     = $textos["ERROR_MODIFICAR_VACIO"];
        $titulo    = "";
        $contenido = "";

    } else {
        $vistaConsulta = "departamentos";
        $condicion     = "id = '$url_id'";
        $columnas      = SQL::obtenerColumnas($vistaConsulta);
        $consulta      = SQL::seleccionar(array($vistaConsulta), $columnas, $condicion);
        $datos         = SQL::filaEnObjeto($consulta);
        $error         = "";
        $titulo        = $componente->nombre;
        $paises        = HTML::generarDatosLista("paises", "id", "nombre");

        /*** Definici�n de pesta�as ***/
        $formularios["PESTANA_GENERAL"] = array(
            array(
                HTML::listaSeleccionSimple("*pais", $textos["PAIS"], $paises, $datos->id_pais, array("title" => $textos["AYUDA_PAIS"]))
            ),
            array(
                HTML::campoTextoCorto("*nombre", $textos["NOMBRE"], 30, 255, $datos->nombre, array("title" => $textos["AYUDA_NOMBRE"], "onBlur" => "validarItem(this);"))
            ),
            array(
                HTML::campoTextoCorto("codigo_dane", $textos["CODIGO_DANE"], 2, 2, $datos->codigo_dane, array("title" => $textos["AYUDA_CODIGO_DANE"], "onBlur" => "validarItem(this);")),
                HTML::campoTextoCorto("codigo_interno", $textos["CODIGO_INTERNO"], 3, 3, $datos->codigo_interno, array("title" => $textos["AYUDA_CODIGO_INTERNO"], "onBlur" => "validarItem(this);"))
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

/*** Validar los datos provenientes del formulario ***/
} elseif (!empty($url_validar)) {

    $respuesta = "";

    if ($url_item == "nombre" && $url_valor) {
        $existe = SQL::existeItem("departamentos", "nombre", $url_valor, "id != '$url_id'");

        if ($existe) {
            $respuesta =  $textos["ERROR_EXISTE_NOMBRE"];
        }
    }

    if ($url_item == "codigo_dane" && $url_valor) {
        $existe = SQL::existeItem("departamentos", "codigo_dane", $url_valor, "id != '$url_id'");

        if ($existe) {
            $respuesta =  $textos["ERROR_EXISTE_CODIGO_DANE"];

        } elseif (!Cadena::validarMayusculas($url_valor, 2, 2)) {
            $respuesta =  $textos["ERROR_FORMATO_CODIGO_DANE"];
        }
    }

    if ($url_item == "codigo_interno" && $url_valor) {
        $existe = SQL::existeItem("departamentos", "codigo_interno", $url_valor, "id != '$url_id'");

        if ($existe) {
            $respuesta =  $textos["ERROR_EXISTE_CODIGO_INTERNO"];

        } elseif (!Cadena::validarNumeros($url_valor)) {
            $respuesta =  $textos["ERROR_FORMATO_CODIGO_INTERNO"];
        }
    }

    HTTP::enviarJSON($respuesta);

/*** Modificar el elemento seleccionado ***/
} elseif (!empty($forma_procesar)) {

    /*** Asumir por defecto que no hubo error ***/
    $error   = false;
    $mensaje = $textos["ITEM_MODIFICADO"];

    /*** Validar el ingreso de los datos requeridos ***/
    if (empty($forma_pais) || empty($forma_nombre)) {
        $error   = true;
        $mensaje = $textos["ERROR_DATOS_INCOMPLETOS"];

    } elseif (SQL::existeItem("departamentos", "nombre", $forma_nombre, "id != $forma_id AND id_pais = '$forma_pais'")) {
        $error   = true;
        $mensaje =  $textos["ERROR_EXISTE_NOMBRE"];

    } elseif (SQL::existeItem("departamentos", "codigo_dane", $forma_codigo_dane, "id != $forma_id AND id_pais = '$forma_pais'")) {
            $error   = true;
            $mensaje =  $textos["ERROR_EXISTE_CODIGO_DANE"];

    } elseif (!Cadena::validarNumeros($forma_codigo_dane, 2, 2)) {
        $error   = true;
        $mensaje =  $textos["ERROR_FORMATO_CODIGO_DANE"];

    } elseif (!empty($forma_codigo_interno) && SQL::existeItem("departamentos", "codigo_interno", $forma_codigo_interno, "id != $forma_id AND id_pais = '$forma_pais'")) {
        $error   = true;
        $mensaje =  $textos["ERROR_EXISTE_CODIGO_INTERNO"];

    } elseif (!empty($forma_codigo_interno) && !Cadena::validarNumeros($forma_codigo_interno)) {
        $error   = true;
        $mensaje =  $textos["ERROR_FORMATO_CODIGO_INTERNO"];

    } else {

        $datos = array(
            "id_pais"        => $forma_pais,
            "nombre"         => $forma_nombre,
            "codigo_dane"    => $forma_codigo_dane,
            "codigo_interno" => $forma_codigo_interno
        );

        $consulta = SQL::modificar("departamentos", $datos, "id = '$forma_id'");

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