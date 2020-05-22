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

    /*** Verificar que se haya enviado el ID del elemento a eliminar ***/
    if (empty($url_id)) {
        $error     = $textos["ERROR_ELIMINAR_VACIO"];
        $titulo    = "";
        $contenido = "";

    } else {
        $vistaConsulta = "articulos";
        $columnas      = SQL::obtenerColumnas($vistaConsulta);
        $consulta      = SQL::seleccionar(array($vistaConsulta), $columnas, "id = '$url_id'");
        $datos         = SQL::filaEnObjeto($consulta);

        $error         = "";
        $titulo        = $componente->nombre;
        $id_sucursal   = SQL::obtenerValor("sucursales","nombre","id='$datos->id_sucursal'");
        
        $tercero       = SQL::obtenerValor("menu_terceros","NOMBRE_COMPLETO","id='$datos->id_proveedor'");
        
        $tipo_inventario = array(
            "0" => $textos["MERCANCIA"],
            "1" => $textos["MATERIA_PRIMA"],
            "2" => $textos["SUMINISTRO"],
            "3" => $textos["OBSEQUIO"],
        );

        $tipo_articulo = array(
            "1" => $textos["PRODUCTO_TERMINADO"],
            "2" => $textos["OBSEQUIO"],
            "3" => $textos["ACTIVO_FIJO"],
            "4" => $textos["MATERIA_PRIMA"]
        );

        $manejo_inventario = array(
            "1" => $textos["INVENTARIO_VALORIZADO"],
            "2" => $textos["INVENTARIO_SOLO_KARDEX"]
        );

        $activo = array(
            "0" => $textos["INACTIVO"],
            "1" => $textos["ACTIVO"]
        );

        /*** Definici�n de pesta�as ***/
        $formularios["PESTANA_DATOS_GENERALES"] = array(
            array(
                HTML::mostrarDato("codigo",$textos["CODIGO"],$datos->codigo),
            ),
            array(    
                HTML::mostrarDato("referencia",$textos["REFERENCIA_PRINCIPAL"],$datos->referencia),
            ),
            array(
                HTML::mostrarDato("detalle",$textos["DETALLE"],$datos->detalle)
            ),
            array(
                HTML::mostrarDato("proveedor",$textos["PROVEEDOR"],$tercero)
            ),
            array(
                HTML::mostrarDato("tipo_inventario",$textos["TIPO_INVENTARIO"],$tipo_inventario[$datos->tipo_inventario]),
            )
        );
        
        /*** Definici�n de botones ***/
        $botones = array(
            HTML::boton("botonAceptar", $textos["ACEPTAR"], "eliminarItem('$url_id');", "aceptar")
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
    $consulta = SQL::eliminar("articulos", "id = '$forma_id'");

    if ($consulta) {
        $error   = false;
        $mensaje = $textos["ITEM_ELIMINADO"];
    } else {
        $error   = true;
        $mensaje = $textos["ERROR_ELIMINAR_ITEM"];
    }

    /*** Enviar datos con la respuesta del proceso al script que origin� la petici�n ***/
    $respuesta    = array();
    $respuesta[0] = $error;
    $respuesta[1] = $mensaje;
    HTTP::enviarJSON($respuesta);
}
?>
