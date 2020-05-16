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

    /*** Verificar que se haya enviado el ID del elemento a modificar ***/
    if (empty($url_id)) {
        $error     = $textos["ERROR_MODIFICAR_VACIO"];
        $titulo    = "";
        $contenido = "";

    } else {
        $vistaConsulta = "buscador_secciones";
        $condicion     = "id = '$url_id'";
        $columnas      = SQL::obtenerColumnas($vistaConsulta);
        $consulta      = SQL::seleccionar(array($vistaConsulta), $columnas, $condicion);
        $datos         = SQL::filaEnObjeto($consulta);
        $error         = "";
        $titulo        = $componente->nombre;

        /*** Definición de pestañas ***/
        $formularios["PESTANA_GENERAL"] = array(
            array(
                HTML::mostrarDato("codigo", $textos["CODIGO"],$datos->codigo)
            ),
            array(
                HTML::listaSeleccionSimple("*bodega", $textos["BODEGA"], HTML::generarDatosLista("bodegas", "id", "descripcion"), SQL::obtenerValor("ubicaciones", "id_bodega", $condicion), array("title" => $textos["AYUDA_BODEGA"]))
            ),
            array(
                HTML::campoTextoCorto("*nombre", $textos["NOMBRE"], 60, 60, $datos->nombre, array("title" => $textos["AYUDA_NOMBRE"]))
            ),
            array(
                 HTML::campoTextoCorto("*descripcion", $textos["DESCRIPCION"], 60, 60, $datos->descripcion, array("title" => $textos["AYUDA_DESCRIPCION"]))
            )
        );

        /*** Definición de botones ***/
        $botones = array(
            HTML::boton("botonAceptar", $textos["ACEPTAR"], "modificarItem('$url_id');", "aceptar")
        );

        $contenido = HTML::generarPestanas($formularios, $botones);
    }

    /*** Enviar datos para la generación del formulario al script que originó la petición ***/
    $respuesta    = array();
    $respuesta[0] = $error;
    $respuesta[1] = $titulo;
    $respuesta[2] = $contenido;
    HTTP::enviarJSON($respuesta);

/*** Validar los datos provenientes del formulario ***/
} elseif (!empty($url_validar)) {

    $respuesta = "";

     /*** Validar bodega ***/
    if ($url_item == "bodega" && $url_valor) {
        $existe = SQL::existeItem("secciones", "bodega", $url_valor, "id != $url_id");

        if ($existe) {
            HTTP::enviarJSON($textos["ERROR_EXISTE_BODEGA_SECCION"]);
        }
    }
    
    /*** Validar codigo ***/
    if ($url_item == "codigo" && $url_valor) {
        $existe = SQL::existeItem("secciones", "codigo", $url_valor, "id != $url_id");

        if ($existe) {
            HTTP::enviarJSON($textos["ERROR_EXISTE_CODIGO"]);
        }
    }
    
    /*** Validar nombre ***/
    if ($url_item == "nombre" && $url_valor) {
        $existe = SQL::existeItem("secciones", "nombre", $url_valor, "id != $url_id");

        if ($existe) {
            HTTP::enviarJSON($textos["ERROR_EXISTE_NOMBRE"]);
        }
    }
    
    /*** Validar descripcion ***/
    if ($url_item == "descripcion" && $url_valor) {
        $existe = SQL::existeItem("secciones", "descripcion", $url_valor, "id != $url_id");

        if ($existe) {
            HTTP::enviarJSON($textos["ERROR_EXISTE_DESCRIPCION"]);
        }
    }
 
    HTTP::enviarJSON($respuesta);

/*** Modificar el elemento seleccionado ***/
} elseif (!empty($forma_procesar)) {

    /*** Asumir por defecto que no hubo error ***/
    $error   = false;
    $mensaje = $textos["ITEM_MODIFICADO"];

    /*** Validar el ingreso de los datos requeridos ***/
    if (empty($forma_nombre) || empty($forma_bodega) || empty($forma_descripcion)) {
        $error   = true;
        $mensaje = $textos["ERROR_DATOS_INCOMPLETOS"];

    } elseif (SQL::existeItem("secciones", "codigo", $forma_codigo, "codigo = '$forma_codigo'")) {
        $error   = true;
        $mensaje =  $textos["ERROR_EXISTE_NOMBRE"];
        
    } elseif (SQL::existeItem("secciones", "nombre", $forma_nombre, "codigo = '$forma_codigo'")) {
        $error   = true;
        $mensaje =  $textos["ERROR_EXISTE_NOMBRE"];
    
    } elseif (SQL::existeItem("secciones", "descripcion", $forma_descripcion, "codigo = '$forma_codigo'")) {
        $error   = true;
        $mensaje =  $textos["ERROR_EXISTE_NOMBRE"];    
        
    } else {

        $datos = array(
            "id_bodega"   => $forma_bodega,
            "nombre"      => $forma_nombre,
            "descripcion" => $forma_descripcion
        );

        $consulta = SQL::modificar("secciones", $datos, "id = '$forma_id'");

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
