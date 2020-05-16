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
    //$terceros = HTML::generarDatosLista("menu_terceros", "id", "NOMBRE_COMPLETO");
    
    /*** Definición de pestañas general ***/
    $formularios["PESTANA_GENERAL"] = array(
        array(
            HTML::listaSeleccionSimple("*bodega", $textos["BODEGA"], HTML::generarDatosLista("bodegas", "id", "nombre"), "", array("title" => $textos["AYUDA_BODEGA"],"onBlur" => "validarItem(this);"))
        ),
        array(
             HTML::campoTextoCorto("*codigo", $textos["CODIGO"], 4, 4, "",  array("title" => $textos["AYUDA_CODIGO"],"onBlur" => "validarItem(this);"))
        ),
        array(
            HTML::campoTextoCorto("*nombre", $textos["NOMBRE"], 60, 60, "", array("title" => $textos["AYUDA_NOMBRE"],"onBlur" => "validarItem(this);"))
        ),
        array(
            HTML::campoTextoCorto("*descripcion", $textos["DESCRIPCION"], 60, 60, "", array("title" => $textos["AYUDA_DESCRIPCION"],"onBlur" => "validarItem(this);"))
        )
    );

    /*** Definicion de botones ***/
    $botones = array(
        HTML::boton("botonAceptar", $textos["ACEPTAR"], "adicionarItem();", "aceptar")
    );

    $contenido = HTML::generarPestanas($formularios, $botones);

    /*** Enviar datos para la generacion del formulario al script que origino la peticion ***/
    $respuesta[0] = $error;
    $respuesta[1] = $titulo;
    $respuesta[2] = $contenido;
    HTTP::enviarJSON($respuesta);

/*** Validar los datos provenientes del formulario ***/
} elseif (!empty($url_validar)) {

    $respuesta = "";
    
    /*** Validar codigo ***/
    if ($url_item == "codigo" && $url_valor) {
        $existe = SQL::existeItem("secciones", "codigo", $url_valor);

        if ($existe) {
            $respuesta = $textos["ERROR_EXISTE_CODIGO"];
        }
    }
    
    /*** Validar nombre ***/
    if ($url_item == "nombre" && $url_valor) {
        $existe = SQL::existeItem("secciones", "nombre", $url_valor);

        if ($existe) {
            $respuesta = $textos["ERROR_EXISTE_NOMBRE"];
        }
    }
    
    /*** Validar descripcion ***/
    if ($url_item == "descripcion" && $url_valor) {
        $existe = SQL::existeItem("secciones", "descripcion", $url_valor);

        if ($existe) {
            $respuesta = $textos["ERROR_EXISTE_DESCRIPCION"];
        }
    }
    
    HTTP::enviarJSON($respuesta);

/*** Adicionar los datos provenientes del formulario ***/
} elseif (!empty($forma_procesar)) {

    /*** Asumir por defecto que no hubo error ***/
    $error   = false;
    $mensaje = $textos["ITEM_ADICIONADO"];

    /*** Validar el ingreso de los datos requeridos ***/
    if (empty($forma_codigo) || empty($forma_nombre) || empty($forma_descripcion) || empty($forma_bodega)) {
        $error   = true;
        $mensaje = $textos["ERROR_DATOS_INCOMPLETOS"];

    } elseif (SQL::existeItem("secciones", "codigo", $forma_codigo, "codigo = '$forma_codigo'")) {
        $error   = true;
        $mensaje =  $textos["ERROR_EXISTE_CODIGO"];
    
    } elseif (!empty($forma_codigo) && !Cadena::validarNumeros($forma_codigo)) {
        $error   = true;
        $mensaje =  $textos["ERROR_FORMATO_CODIGO"];

    } elseif (!empty($forma_nombre) && SQL::existeItem("secciones", "nombre", $forma_nombre, "codigo = '$forma_codigo'")) {
            $error   = true;
            $mensaje =  $textos["ERROR_EXISTE_NOMBRE"];

    } elseif (!empty($forma_descripcion) && SQL::existeItem("secciones", "descripcion", $forma_descripcion, "codigo = '$forma_codigo'")) {
        $error   = true;
        $mensaje =  $textos["ERROR_EXISTE_DESCRIPCION"];
    
    } else {
        $datos = array(
            "id_bodega"   => $forma_bodega,
            "codigo"      => $forma_codigo,
            "nombre"      => $forma_nombre,
            "descripcion" => $forma_descripcion  
        );

        $insertar = SQL::insertar("secciones", $datos);

        /*** Error de insercion ***/
        if (!$insertar) {
            $error   = true;
            $mensaje = $textos["ERROR_ADICIONAR_ITEM"];
        }
    }    

    /*** Enviar datos con la respuesta del proceso al script que origin? la petici?n ***/
    $respuesta    = array();
    $respuesta[0] = $error;
    $respuesta[1] = $mensaje;
    HTTP::enviarJSON($respuesta);
}
?>
