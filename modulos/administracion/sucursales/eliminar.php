<?php

/**
*
* Copyright (C) 2008 LinuxCali Ltda
* Francisco J. Lozano B. <pacho@linuxcali.com>
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

    /*** Verificar que se haya enviado el ID del elemento a eliminar ***/
    if (empty($url_id)) {
        $error     = $textos["ERROR_ELIMINAR_VACIO"];
        $titulo    = "";
        $contenido = "";

    } else {
        $vistaConsulta = "sucursales";
        $columnas      = SQL::obtenerColumnas($vistaConsulta);
        $consulta      = SQL::seleccionar(array($vistaConsulta), $columnas, "id = '$url_id'");
        $datos         = SQL::filaEnObjeto($consulta);
        $error         = "";
        $titulo        = $componente->nombre;

        $activo = array(
            "0" => $textos["ESTADO_INACTIVA"],
            "1" => $textos["ESTADO_ACTIVA"]
        );

        $indicador = array(
            "0" => $textos["INDICADOR_NO"],
            "1" => $textos["INDICADOR_SI"]
        );

        /*** Obtener valores ***/
        $municipio = SQL::obtenerValor("seleccion_municipios","nombre","id = '$datos->id_municipio'");
        $municipio = explode("|",$municipio);
        $municipio = $municipio[0];
        $empresa   = SQL::obtenerValor("empresas","razon_social","id = '$datos->id_empresa'");

        /*** Definici�n de pesta�as general ***/
        $formularios["PESTANA_GENERAL"] = array(
            array(
                HTML::mostrarDato("codigo", $textos["CODIGO"], $datos->codigo)
            ),
            array(
                HTML::mostrarDato("empresa", $textos["EMPRESA"], $empresa)
            ),
            array(
                HTML::mostrarDato("nombre", $textos["NOMBRE"], $datos->nombre)
            ),
            array(
                HTML::mostrarDato("nombre_corto", $textos["NOMBRE_CORTO"], $datos->nombre_corto),
                HTML::mostrarDato("activo", $textos["ESTADO"], $textos["ACTIVO_".intval($datos->activo)]),
                HTML::mostrarDato("contratista", $textos["CONTRATISTA"], $indicador[$datos->contratista])
            ),
            array(
                HTML::mostrarDato("municipio", $textos["MUNICIPIO"], $municipio)
            ),
            array(
                HTML::mostrarDato("*direccion_residencia", $textos["DIRECCION_RESIDENCIA"], $datos->direccion_residencia)
            ),
            array(
                HTML::mostrarDato("telefono_1", $textos["TELEFONO_1"], $datos->telefono_1),
                HTML::mostrarDato("telefono_2", $textos["TELEFONO_2"], $datos->telefono_2)
            ),
            array(
                HTML::mostrarDato("celular", $textos["CELULAR"], $datos->celular)
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
    $consulta = SQL::eliminar("sucursales", "id = '$forma_id'");

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