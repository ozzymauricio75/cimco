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

    /*** Verificar que se haya enviado el ID del elemento a consultar ***/
    if (empty($url_id)) {
        $error     = $textos["ERROR_CONSULTAR_VACIO"];
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

        $contenido = HTML::generarPestanas($formularios);
    }

    /*** Enviar datos para la generaci�n del formulario al script que origin� la petici�n ***/
    $respuesta    = array();
    $respuesta[0] = $error;
    $respuesta[1] = $titulo;
    $respuesta[2] = $contenido;
    HTTP::enviarJSON($respuesta);
}
?>
