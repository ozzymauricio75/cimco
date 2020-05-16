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
    $error         = "";
    $titulo        = $componente->nombre;
    $paises        = HTML::generarDatosLista("paises", "id", "nombre");
    $departamentos = HTML::generarDatosLista("departamentos", "id", "nombre", "id_pais = '".array_shift(array_keys($paises))."'");

    /*** Definici�n de pesta�as ***/
    $formularios["PESTANA_GENERAL"] = array(
        array(
            HTML::listaSeleccionSimple("*pais", $textos["PAIS"], $paises, "", array("onChange" => "recargarLista('pais','departamento');", "title" => $textos["AYUDA_PAIS"]))
        ),
        array(
            HTML::listaSeleccionSimple("*departamento", $textos["DEPARTAMENTO"], $departamentos, "", array("title" => $textos["AYUDA_DEPARTAMENTO"]))
        ),
        array(
            HTML::campoTextoCorto("*nombre", $textos["NOMBRE"], 30, 255, "", array("title" => $textos["AYUDA_NOMBRE"]))
        ),
        array(
            HTML::campoTextoCorto("codigo_dane", $textos["CODIGO_DANE"], 3, 3, "", array("title" => $textos["AYUDA_CODIGO_DANE"])),
            HTML::campoTextoCorto("codigo_interno", $textos["CODIGO_INTERNO"], 4, 4, "", array("title" => $textos["AYUDA_CODIGO_INTERNO"])),
        ),
        array(
            HTML::campoTextoCorto("comunas", $textos["COMUNAS"], 3, 3, "", array("title" => $textos["AYUDA_COMUNAS"]))
        ),
        array(
            HTML::marcaChequeo("capital", $textos["CAPITAL"], 1)
        )
    );

    /*** Definici�n de botones ***/
    $botones = array(
        HTML::boton("botonAceptar", $textos["ACEPTAR"], "adicionarItem();", "aceptar")
    );

    $contenido = HTML::generarPestanas($formularios, $botones);

    /*** Enviar datos para la generaci�n del formulario al script que origin� la petici�n ***/
    $respuesta[0] = $error;
    $respuesta[1] = $titulo;
    $respuesta[2] = $contenido;
    HTTP::enviarJSON($respuesta);

/*** Recargar un elemento del formulario ***/
} elseif (!empty($url_recargar)) {

    if ($url_elemento == "departamento") {
       $respuesta = HTML::generarDatosLista("departamentos", "id", "nombre", "id_pais = '$url_origen'");
    }

    HTTP::enviarJSON($respuesta);

/*** Validaci�n en l�nea de los datos provenientes del formulario ***/
} elseif (!empty($url_validar)) {

    $respuesta = "";

    if ($url_item == "nombre" && $url_valor) {
        $existe = SQL::existeItem("municipios", "nombre", $url_valor);

        if ($existe) {
            $respuesta =  $textos["ERROR_EXISTE_NOMBRE"];
        }
    }

    if ($url_item == "codigo_dane" && $url_valor) {
        $existe = SQL::existeItem("municipios", "codigo_dane", $url_valor);

        if ($existe) {
            $respuesta =  $textos["ERROR_EXISTE_CODIGO_DANE"];

        } elseif (!Cadena::validarNumeros($url_valor, 3, 3)) {
            $respuesta =  $textos["ERROR_FORMATO_CODIGO_DANE"];
        }
    }

    if ($url_item == "codigo_interno" && $url_valor) {
        $existe = SQL::existeItem("municipios", "codigo_interno", $url_valor);

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
    if (empty($forma_departamento) || empty($forma_nombre)) {
        $error   = true;
        $mensaje = $textos["ERROR_DATOS_INCOMPLETOS"];

    } elseif (SQL::existeItem("municipios", "nombre", $forma_nombre, "id_departamento = '$forma_departamento'")) {
        $error   = true;
        $mensaje =  $textos["ERROR_EXISTE_NOMBRE"];

    } elseif (!empty($forma_codigo_dane) && SQL::existeItem("municipios", "codigo_dane", $forma_codigo_dane, "id_departamento = '$forma_departamento'")) {
            $error   = true;
            $mensaje =  $textos["ERROR_EXISTE_CODIGO_DANE"];

    } elseif (!empty($forma_codigo_dane) && !Cadena::validarNumeros($forma_codigo_dane, 3, 3)) {
        $error   = true;
        $mensaje =  $textos["ERROR_FORMATO_CODIGO_DANE"];

    } elseif (!empty($forma_codigo_interno) && SQL::existeItem("municipios", "codigo_interno", $forma_codigo_interno, "id_departamento = '$forma_departamento'")) {
        $error   = true;
        $mensaje =  $textos["ERROR_EXISTE_CODIGO_INTERNO"];

    } elseif (!empty($forma_codigo_interno) && !Cadena::validarNumeros($forma_codigo_interno)) {
        $error   = true;
        $mensaje =  $textos["ERROR_FORMATO_CODIGO_INTERNO"];

    } elseif (!empty($forma_comunas) && !Cadena::validarNumeros($forma_comunas)) {
        $error   = true;
        $mensaje =  $textos["ERROR_FORMATO_COMUNAS"];

    } else {

        $datos = array(
            "id_departamento" => $forma_departamento,
            "nombre"          => $forma_nombre,
            "codigo_dane"     => $forma_codigo_dane,
            "codigo_interno"  => $forma_codigo_interno,
            "comunas"         => $forma_comunas,
            "capital"         => $forma_capital
        );

        $insertar = SQL::insertar("municipios", $datos);

        /*** Error de inserci�n ***/
        if (!$insertar) {
            $error   = true;
            $mensaje = $textos["ERROR_ADICIONAR_ITEM"];
        }
    }


    /*** Enviar datos con la respuesta del proceso al script que origin� la petici�n ***/
    $respuesta    = array();
    $respuesta[0] = $error;
    $respuesta[1] = $mensaje;
    HTTP::enviarJSON($respuesta);
}
?>