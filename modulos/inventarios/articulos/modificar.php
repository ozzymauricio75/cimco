<?php

/**
*
* Copyright (C) 2020 Raul Mauricio Oidor Lozano
* Raul Mauricio Oidor Lozano <ozzymauricio75@gmail.com>
*
* Este archivo es parte de:
* PANCE :: Software empresarial a la medida
*
* Este programa es software libre: usted puede redistribuirlo y/o
* modificarlo  bajo los términos de la Licencia Pública General GNU
* publicada por la Fundación para el Software Libre, ya sea la versión 3
* de la Licencia, o (a su elección) cualquier versión posterior.
*
* Este programa se distribuye con la esperanza de que sea útil, pero
* SIN GARANTÍA ALGUNA; ni siquiera la garantía implícita MERCANTIL o
* de APTITUD PARA UN PROPÓITO DETERMINADO. Consulte los detalles de
* la Licencia Pública General GNU para obtener una información más
* detallada.
*
* Debería haber recibido una copia de la Licencia Pública General GNU
* junto a este programa. En caso contrario, consulte:
* <http://www.gnu.org/licenses/>.
*
**/
$tabla = "usuarios";
$columnas                   = SQL::obtenerColumnas($tabla);
$consulta                   = SQL::seleccionar(array($tabla), $columnas, "usuario = '$sesion_usuario'");
$datos                      = SQL::filaEnObjeto($consulta);
$sesion_id_usuario_ingreso  = $datos->id;
/*** Devolver datos para autocompletar la búsqueda ***/
if (isset($url_completar)) {
    echo SQL::datosAutoCompletar("seleccion_proveedores", $url_q);
    exit;
}

/*** Recargar información acorde al proveedor seleccionado ***/
if(!empty($url_recargarPais)){

    $id_proveedor = $url_id_proveedor;

    $consulta     = SQL::obtenerValor("proveedores","id_tercero","id = '$id_proveedor'");
    $id_tercero   = $consulta;
    $consulta     = SQL::obtenerValor("terceros","id_municipio_documento","id = '$id_tercero'");
    $id_ciudad    = $consulta;
    $consulta     = SQL::obtenerValor("municipios","id_departamento","id = '$id_ciudad'");
    $id_departamento = $consulta;
    $consulta     = SQL::obtenerValor("departamentos","id_pais","id = '$id_departamento'");
    $id_pais        = $consulta;

    $elementos[0] = $id_pais;
    HTTP::enviarJSON($elementos);
    exit;
}

/*** Generar el formulario para la captura de datos ***/
if (!empty($url_generar)) {

    /*** Verificar que se haya enviado el ID del elemento a modificar ***/
    if (empty($url_id)) {
        $error     = $textos["ERROR_MODIFICAR_VACIO"];
        $titulo    = "";
        $contenido = "";
        exit();
    } else {
        $vistaConsulta = "articulos";
        $condicion     = "id = '$url_id'";
        $columnas      = SQL::obtenerColumnas($vistaConsulta);
        $consulta      = SQL::seleccionar(array($vistaConsulta), $columnas, "id = '$url_id'");
        $datos         = SQL::filaEnObjeto($consulta);
        $error         = "";
        $titulo        = $componente->nombre;
        $precio        = number_format($datos->precio);

        $id_sucursal   = SQL::obtenerValor("sucursales","nombre","id='$datos->id_sucursal'");

        /***Obtener datos de la tabla de articulos ***/
        $id                     = $url_id;
        $pais                   = SQL::obtenerValor("paises", "nombre", "id = '$datos->id_pais'");
        $nombre_proveedor       = SQL::obtenerValor("seleccion_proveedores", "nombre", "id = '$datos->id_proveedor'");
        $nombre_proveedor       = explode("|",$nombre_proveedor);
        $nombre_proveedor       = $nombre_proveedor[0];
        
        $tipo_inventario = array(
            "1" => $textos["MATERIA_PRIMA"],
            "2" => $textos["SUMINISTRO"]
        );

        $estado = array(
            "0" => $textos["INACTIVO"],
            "1" => $textos["ACTIVO"]
        );

        /*** Definición de pestaña general ***/
         $formularios["PESTANA_GENERAL"] = array(
            array(
                HTML::listaSeleccionSimple("*id_sucursal", $textos["SUCURSAL"],HTML::generarDatosLista("sucursales", "id", "nombre"), "", array("title" => $textos["AYUDA_SUCURSALES"],"onBlur" => "validarItem(this);"))
            ),
            array(
                HTML::campoTextoCorto("*selector1", $textos["PROVEEDOR"], 40, 255, $nombre_proveedor, array("title" => $textos["AYUDA_PROVEEDOR"], "class" => "autocompletable")).HTML::campoOculto("id_proveedor", $datos->id_proveedor)
            ),
            array(
                HTML::campoTextoCorto("*codigo", $textos["CODIGO"], 15, 15, $datos->codigo, array("title" => $textos["AYUDA_CODIGO"],"onBlur" => "validarItem(this);")).
                HTML::campoOculto("id",$id),
            ),
            array(
                HTML::campoTextoCorto("*detalle", $textos["DESCRIPCION"], 55, 255, htmlentities(stripslashes($datos->detalle)), array("title" => $textos["AYUDA_DESCRIPCION"],"onBlur" => "validarItem(this);"))
            ),
            array(
                HTML::campoTextoCorto("*referencia", $textos["REFERENCIA"], 15, 15, $datos->referencia, array("title" => $textos["AYUDA_REFERENCIA"]))
            ),
            array(
                HTML::listaSeleccionSimple("tipo_inventario", $textos["TIPO_INVENTARIO"], $tipo_inventario, $datos->tipo_inventario)
            ),
            array(
                HTML::listaSeleccionSimple("estado", $textos["ESTADO"], $estado, $datos->estado)
            ),
            array(
                HTML::campoTextoCorto("*precio", $textos["COSTO"], 15, 15, $precio, array("title" => $textos["AYUDA_PRECIO"],"class" => "numero", "onblur" => "validarItem(this);"))
            ),
            array(
                HTML::listaSeleccionSimple("*tasa", $textos["TASA"], HTML::generarDatosLista("tasas", "id", "descripcion"), SQL::obtenerValor("articulos", "id_tasa", $condicion)),
            ),
        );

        /*** Definición de botones ***/
        $botones = array(
            HTML::boton("botonAceptar", $textos["ACEPTAR"], "modificarItem('$url_id');", "aceptar")
        );

        $contenido = HTML::generarPestanas($formularios, $botones);
    }

    /*** Enviar datos para la generaciï¿½n del formulario al script que originï¿½ la peticiï¿½n ***/
    $respuesta    = array();
    $respuesta[0] = $error;
    $respuesta[1] = $titulo;
    $respuesta[2] = $contenido;
    HTTP::enviarJSON($respuesta);
    exit();

/*** Validar los datos provenientes del formulario ***/
} elseif (!empty($url_validar)) {

    /*** Validar nmbre ***/
    if ($url_item == "codigo") {
        $existe = SQL::existeItem("articulos", "codigo", $url_valor, "id != $url_id");

        if ($existe) {
            HTTP::enviarJSON($textos["ERROR_EXISTE_CODIGO"]);
        }
    }
    exit();

/*** Modificar el elemento seleccionado ***/
} 

    /*** Asumir por defecto que no hubo error ***/
    $error        = false;
    $mensaje      = $textos["ITEM_MODIFICADO"];
    $forma_precio = str_replace(',','',$forma_precio);

    if (empty($forma_codigo)||
        empty($forma_detalle)||
        empty($forma_referencia)||
        empty($forma_selector1)){
        $error = true;
        $mensaje = $textos["ERROR_DATOS_INCOMPLETOS"];
    } else {

        $datos = array(
            "id_sucursal"            => $forma_id_sucursal,
            "id_proveedor"           => $forma_id_proveedor,
            "codigo"                 => $forma_codigo,
            "detalle"                => $forma_detalle,
            "referencia"             => $forma_referencia,
            "tipo_inventario"        => $forma_tipo_inventario,
            "estado"                 => $forma_estado,
            "precio"                 => $forma_precio,
            "id_tasa"                => $forma_tasa,
            "id_usuario_registra"    => $sesion_id_usuario_ingreso,
            "fecha_registra"         => date("Y-m-d H:i:s"),
            "fecha_modificacion"     => date("Y-m-d H:i:s")
        );

        $consulta = SQL::modificar("articulos", $datos, "id = '$forma_id'");
        if ($consulta) {
            $error   = false;
            $mensaje = $textos["ITEM_MODIFICADO"];
        } else {
            $error   = true;
            $mensaje = $textos["ERROR_MODIFICAR_ITEM"];
        }
    }

    /*** Enviar datos con la respuesta del proceso al script que originï¿½ la peticiï¿½n ***/
    $respuesta    = array();
    $respuesta[0] = $error;
    $respuesta[1] = $mensaje;
    HTTP::enviarJSON($respuesta);
?>
