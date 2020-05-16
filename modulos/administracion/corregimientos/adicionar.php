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
    $error         = "";
    $titulo        = $componente->nombre;
    $paises        = HTML::generarDatosLista("paises", "id", "nombre");
    $departamentos = HTML::generarDatosLista("departamentos", "id", "nombre", "id_pais = '".array_shift(array_keys($paises))."'");
    $municipios    = HTML::generarDatosLista("municipios", "id", "nombre", "id_departamento = '".array_shift(array_keys($departamentos))."'");

    /*** Definición de pestañas ***/
    $formularios["PESTANA_GENERAL"] = array(
        array(
            HTML::listaSeleccionSimple("*pais", $textos["PAIS"], $paises, "", array("title" => $textos["AYUDA_PAIS"], "onChange" => "recargarLista('pais','departamento');"))
        ),
        array(
            HTML::listaSeleccionSimple("*departamento", $textos["DEPARTAMENTO"], $departamentos, "", array("title" => $textos["AYUDA_DEPARTAMENTO"], "onChange" => "recargarLista('departamento','municipio');"))
        ),
        array(
            HTML::listaSeleccionSimple("*municipio", $textos["MUNICIPIO"], $municipios, "", array("title" => $textos["AYUDA_MUNICIPIO"]))
        ),
        array(
            HTML::campoTextoCorto("*nombre", $textos["NOMBRE"], 30, 255, "", array("title" => $textos["AYUDA_NOMBRE"]))
        ),
        array(
            HTML::campoTextoCorto("codigo_dane", $textos["CODIGO_DANE"], 2, 2, "", array("title" => $textos["AYUDA_CODIGO_DANE"])),
            HTML::campoTextoCorto("codigo_interno", $textos["CODIGO_INTERNO"], 4, 4, "", array("title" => $textos["AYUDA_CODIGO_INTERNO"])),
        )
    );

    /*** Definición de botones ***/
    $botones = array(
        HTML::boton("botonAceptar", $textos["ACEPTAR"], "adicionarItem();", "aceptar")
    );

    $contenido = HTML::generarPestanas($formularios, $botones);

    /*** Enviar datos para la generación del formulario al script que originó la petición ***/
    $respuesta[0] = $error;
    $respuesta[1] = $titulo;
    $respuesta[2] = $contenido;
    HTTP::enviarJSON($respuesta);

/*** Recargar un elemento del formulario ***/
} elseif (!empty($url_recargar)) {

    if ($url_elemento == "departamento") {
       $respuesta = HTML::generarDatosLista("departamentos", "id", "nombre", "id_pais = '$url_origen'");
    }

    if ($url_elemento == "municipio") {
       $respuesta = HTML::generarDatosLista("municipios", "id", "nombre", "id_departamento = '$url_origen'");
    }

    HTTP::enviarJSON($respuesta);

/*** Validación en línea de los datos provenientes del formulario ***/
} elseif (!empty($url_validar)) {

    $respuesta = "";

    if ($url_item == "nombre" && $url_valor) {
        $existe = SQL::existeItem("localidades", "nombre", $url_valor);

        if ($existe) {
            $respuesta =  $textos["ERROR_EXISTE_NOMBRE"];
        }
    }

    if ($url_item == "codigo_dane" && $url_valor) {
        $existe = SQL::existeItem("localidades", "codigo_dane", $url_valor);

        if ($existe) {
            $respuesta =  $textos["ERROR_EXISTE_CODIGO_DANE"];

        } elseif (!Cadena::validarNumeros($url_valor, 3, 3)) {
            $respuesta =  $textos["ERROR_FORMATO_CODIGO_DANE"];
        }
    }

    if ($url_item == "codigo_interno" && $url_valor) {
        $existe = SQL::existeItem("localidades", "codigo_interno", $url_valor);

        if ($existe) {
            $respuesta =  $textos["ERROR_EXISTE_CODIGO_INTERNO"];

        } elseif (!Cadena::validarNumeros($url_valor)) {
            $respuesta =  $textos["ERROR_FORMATO_CODIGO_INTERNO"];
        }
    }

    HTTP::enviarJSON($respuesta);

/*** Adicionar los datos provenientes del formulario ***/
} elseif (!empty($forma_procesar)) {

    /*** Asumir por defecto que no hubo error ***/
    $error   = false;
    $mensaje = $textos["ITEM_ADICIONADO"];

    /*** Validar el ingreso de los datos requeridos ***/
    if (empty($forma_municipio) || empty($forma_nombre)) {
        $error   = true;
        $mensaje = $textos["ERROR_DATOS_INCOMPLETOS"];

    } elseif (SQL::existeItem("localidades", "nombre", $forma_nombre, "id_municipio = '$forma_municipio'")) {
        $error   = true;
        $mensaje =  $textos["ERROR_EXISTE_NOMBRE"];

    } elseif (!empty($forma_codigo_dane) && SQL::existeItem("localidades", "codigo_dane", $forma_codigo_dane, "id_municipio = '$forma_municipio'")) {
            $error   = true;
            $mensaje =  $textos["ERROR_EXISTE_CODIGO_DANE"];

    } elseif (!empty($forma_codigo_dane) && !Cadena::validarNumeros($forma_codigo_dane, 2, 2)) {
        $error   = true;
        $mensaje =  $textos["ERROR_FORMATO_CODIGO_DANE"];

    } elseif (!empty($forma_codigo_interno) && SQL::existeItem("localidades", "codigo_interno", $forma_codigo_interno, "id_municipio = '$forma_municipio'")) {
        $error   = true;
        $mensaje =  $textos["ERROR_EXISTE_CODIGO_INTERNO"];

    } elseif (!empty($forma_codigo_interno) && !Cadena::validarNumeros($forma_codigo_interno)) {
        $error   = true;
        $mensaje =  $textos["ERROR_FORMATO_CODIGO_INTERNO"];

    } else {

        $datos = array(
            "id_municipio"     => $forma_municipio,
            "nombre"           => $forma_nombre,
            "codigo_dane"      => $forma_codigo_dane,
            "codigo_interno"   => $forma_codigo_interno,
            "tipo"             => 'C'
        );

        $insertar = SQL::insertar("localidades", $datos);

        /*** Error de inserción ***/
        if (!$insertar) {
            $error   = true;
            $mensaje = $textos["ERROR_ADICIONAR_ITEM"];
        }
    }


    /*** Enviar datos con la respuesta del proceso al script que originó la petición ***/
    $respuesta    = array();
    $respuesta[0] = $error;
    $respuesta[1] = $mensaje;
    HTTP::enviarJSON($respuesta);
}
?>