<?php

/**
*
* Copyright (C) 2020 Raul Mauricio Oidor Lozano
* Raul Mauricio Oidor Lozano <ozzymauricio75@gmail.com>
*
* Este archivo es parte de:
* SEM :: Software empresarial a la medida
*
* Este programa es software libre: usted puede redistribuirlo y/o
* modificarlo  bajo los t�rminos de la Licencia P�blica General GNU
* publicada por la Fundaci�n para el Software Libre, ya sea la versi�n 3
* de la Licencia, o (a su elecci�n) cualquier versi�n posterior.
*
* Este programa se distribuye con la esperanza de que sea �til, pero
* SIN GARANT�A ALGUNA; ni siquiera la garant�a impl�cita MERCANTIL o
* de APTITUD PARA UN PROP�ITO DETERMINADO. Consulte los detalles de
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
        $vistaConsulta = "tasas";
        $columnas      = SQL::obtenerColumnas($vistaConsulta);
        $consulta      = SQL::seleccionar(array($vistaConsulta), $columnas, "id = '$url_id'");
        $datos         = SQL::filaEnObjeto($consulta);

        $error         = "";
        $titulo        = $componente->nombre;

        /*** Definici�n de pesta�as ***/
        $formularios["PESTANA_GENERAL"] = array(
            array(
                HTML::campoTextoCorto("*descripcion", $textos["DESCRIPCION"], 30, 255, $datos->descripcion, array("title" => $textos["AYUDA_DESCRIPCION"],"onBlur" => "validarItem(this);"))
            ),
            array(
                HTML::campoOculto("descripcion_anterior", $datos->descripcion)
            ),
            array(
                HTML::campoTextoCorto("*porcentaje", $textos["PORCENTAJE"], 30, 255, $datos->porcentaje, array("title" => $textos["AYUDA_PORCENTAJE"],"onBlur" => "validarItem(this);"))
            ),
            array(
                HTML::campoTextoCorto("*valor_base", $textos["VALOR_BASE"], 30, 255, $datos->valor_base, array("title" => $textos["AYUDA_VALOR_BASE"],"onBlur" => "validarItem(this);"))
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

    /*** Validar nmbre ***/
    if ($url_item == "descripcion") {
        $existe = SQL::existeItem("tasas", "descripcion", $url_valor, "descripcion !='' AND id!='$forma_id'");

        if ($existe) {
            HTTP::enviarJSON($textos["ERROR_EXISTE_DESCRIPCION"]);
        }
    }

/*** Modificar el elemento seleccionado ***/
} elseif (!empty($forma_procesar)) {
    /*** Asumir por defecto que no hubo error ***/
    $error   = false;
    $mensaje = $textos["ITEM_ADICIONADO"];

    if(empty($forma_descripcion)){
        $error   = true;
        $mensaje = $textos["DESCRIPCION_VACIO"];

    /*}elseif($existe = SQL::existeItem("tasas", "descripcion", $forma_descripcion,"descripcion !='' AND id!='$forma_id'")){
        $error   = true;
        $mensaje = $textos["ERROR_EXISTE_DESCRIPCION"];
    */
    }else {
        if ($forma_descripcion_anterior != $forma_descripcion){
            $datos["descripcion"] = $forma_descripcion;
            $datos["porcentaje"]  = $forma_porcentaje;
            $datos["valor_base"]  = $forma_valor_base;
        }

        if (isset($datos)){
            $consulta = SQL::modificar("tasas", $datos, "id = '$forma_id'");
            /*** Error inserci�n ***/
            if ($consulta) {
                $error   = false;
                $mensaje = $textos["ITEM_MODIFICADO"];
            } else {
                $error   = true;
                $mensaje = $textos["ERROR_MODIFICAR_ITEM"];
            }
        } else {
            $error   = false;
            $mensaje = $textos["ITEM_MODIFICADO_SIN_CAMBIOS"];
        }
    }

    /*** Enviar datos con la respuesta del proceso al script que origin� la petici�n ***/
    $respuesta    = array();
    $respuesta[0] = $error;
    $respuesta[1] = $mensaje;
    HTTP::enviarJSON($respuesta);
}
?>
