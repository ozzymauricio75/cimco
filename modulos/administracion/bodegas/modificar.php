<?php

/**
*
* Copyright (C) 2008 LinuxCali Ltda
* Francisco J. Lozano B. <pacho@linuxcali.com>
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
        $vistaConsulta = "buscador_bodegas";
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
                HTML::listaSeleccionSimple("*sucursal", $textos["SUCURSAL"], HTML::generarDatosLista("sucursales", "id", "nombre"), SQL::obtenerValor("bodegas", "descripcion", $condicion), array("title" => $textos["AYUDA_ALMACEN"]))
            ),
            array(
                HTML::campoTextoCorto("*nombre", $textos["NOMBRE"],60, 60, $datos->nombre, array("title" => $textos["AYUDA_NOMBRE"]))
            ),
            array(
                HTML::campoTextoCorto("*descripcion", $textos["DESCRIPCION"],60, 60, $datos->descripcion, array("title" => $textos["AYUDA_DESCRIPCION"]))
            ),
            array(
                HTML::listaSeleccionSimple("*tipo_bodega", $textos["TIPO_BODEGA"], HTML::generarDatosLista("tipos_bodegas", "id", "nombre"), SQL::obtenerValor("bodegas", "tipo_bodega", $condicion), array("title" => $textos["AYUDA_TIPO_BODEGA"]))
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

    /*** Validar descripcion***/
    if ($url_item == "descripcion" && $url_valor) {
        $existe = SQL::existeItem("bodegas", "descripcion", $url_valor, "id != $url_id");

        if ($existe) {
            HTTP::enviarJSON($textos["ERROR_EXISTE_DESCRIPCION"]);
        }
    }

    /*** Validar tipo bodega***/
    if ($url_item == "tipo_bodega" && $url_valor) {
        $existe = SQL::existeItem("bodegas", "tipo_bodega", $url_valor, "id != $url_id");

        if ($existe) {
            HTTP::enviarJSON($textos["ERROR_EXISTE_TIPO_BODEGA"]);
        }
    }
    
    
    /*** Validar nombre_corto ***/
    if ($url_item == "nombre_corto" && $url_valor) {
        $existe = SQL::existeItem("sucursales", "nombre_corto", $url_valor, "codigo != '$url_codigo'");

        if ($existe) {
            $respuesta = $textos["ERROR_EXISTE_NOMBRE_CORTO"];
        }
    }
    
    HTTP::enviarJSON($respuesta);

/*** Modificar el elemento seleccionado ***/
} elseif (!empty($forma_procesar)) {

    /*** Asumir por defecto que no hubo error ***/
    $error   = false;
    $mensaje = $textos["ITEM_MODIFICADO"];

    /*** Validar el ingreso de los datos requeridos ***/
    if (empty($forma_sucursal) || empty($forma_nombre) || empty($forma_descripcion) || empty($forma_tipo_bodega)) {
        $error   = true;
        $mensaje = $textos["ERROR_DATOS_INCOMPLETOS"];

    } elseif (SQL::existeItem("bodegas", "nombre", $forma_nombre, "codigo = '$forma_codigo'")) {
        $error   = true;
        $mensaje =  $textos["ERROR_EXISTE_NOMBRE"];
    
    } elseif (SQL::existeItem("bodegas", "descripcion", $forma_descripcion, "codigo = '$forma_codigo'")) {
        $error   = true;
        $mensaje =  $textos["ERROR_EXISTE_DESCRIPCION"];    
        
    } else {

        $datos = array(
            "id_sucursal" => $forma_sucursal,
            "nombre"      => $forma_nombre,
            "descripcion" => $forma_descripcion,
            "tipo_bodega" => $forma_tipo_bodega
        );

        $consulta = SQL::modificar("bodegas", $datos, "id = '$forma_id'");

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
