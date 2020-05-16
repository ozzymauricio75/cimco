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

    /*** Verificar que se haya enviado el ID del elemento a consultar ***/
    if (empty($url_id)) {
        $error     = $textos["ERROR_CONSULTAR_VACIO"];
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
        
        /*** Definición de pestañas general ***/
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

        $contenido = HTML::generarPestanas($formularios);
    }

    /*** Enviar datos para la generación del formulario al script que originó la petición ***/
    $respuesta    = array();
    $respuesta[0] = $error;
    $respuesta[1] = $titulo;
    $respuesta[2] = $contenido;
    HTTP::enviarJSON($respuesta);
}
?>
