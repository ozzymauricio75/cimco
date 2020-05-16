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

    /*** Verificar que se haya enviado el ID del elemento a consultar ***/
    if (empty($url_id)) {
        $error     = $textos["ERROR_CONSULTAR_VACIO"];
        $titulo    = "";
        $contenido = "";

    } else {
        $vistaConsulta = "buscador_municipios";
        $columnas      = SQL::obtenerColumnas($vistaConsulta);
        $consulta      = SQL::seleccionar(array($vistaConsulta), $columnas, "id = '$url_id'");
        $datos         = SQL::filaEnObjeto($consulta);
        $error         = "";
        $titulo        = $componente->nombre;
        $comunas       = SQL::obtenerValor("municipios", "comunas", "id = '$url_id'");
        $capital       = SQL::obtenerValor("municipios", "capital", "id = '$url_id'");

        /*** Definici�n de pesta�as ***/
        $formularios["PESTANA_GENERAL"] = array(
            array(
                HTML::mostrarDato("pais", $textos["PAIS"], $datos->pais)
            ),
            array(
                HTML::mostrarDato("departamento", $textos["DEPARTAMENTO"], $datos->departamento)
            ),
            array(
                HTML::mostrarDato("nombre", $textos["NOMBRE"], $datos->nombre)
            ),
            array(
                HTML::mostrarDato("codigo_dane", $textos["CODIGO_DANE"], $datos->codigo_dane),
                HTML::mostrarDato("codigo_interno", $textos["CODIGO_INTERNO"], $datos->codigo_interno)
            ),
            array(
                HTML::mostrarDato("comunas", $textos["COMUNAS"], intval($comunas)),
            ),
            array(
                HTML::mostrarDato("capital", $textos["CAPITAL"], $textos["SI_NO_".intval($capital)])
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