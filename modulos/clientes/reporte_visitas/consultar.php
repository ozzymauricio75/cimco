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

    /*** Verificar que se haya enviado el ID del elemento a consultar ***/
    if (empty($url_id)) {
        $error     = $textos["ERROR_CONSULTAR_VACIO"];
        $titulo    = "";
        $contenido = "";

    } else {
        $vistaConsulta = "requerimientos_clientes";
        $columnas      = SQL::obtenerColumnas($vistaConsulta);
        $consulta      = SQL::seleccionar(array($vistaConsulta), $columnas, "id = '$url_id'");
        $datos         = SQL::filaEnObjeto($consulta);
        $error         = "";
        $titulo        = $componente->nombre;

        $sede              = SQL::obtenerValor("sedes_clientes","nombre_sede","id = '$datos->id_sede'");
        $id_municipio_sede = SQL::ObtenerValor("sedes_clientes", "id_municipios", "id = '$datos->id_sede'");
        $nombreMunicipio   = SQL::ObtenerValor("municipios", "nombre", "id = '$id_municipio_sede'");
        $sucursal          = SQL::obtenerValor("sucursales","nombre","id = '$datos->id_sucursal'");
        
        $tipo_solicitud = array(
            "M" => $textos["MANTENIMIENTO"],
            "E" => $textos["EMERGENCIA"],
            "S" => $textos["SERVICIO"],
            "P" => $textos["PROYECTO"],
            "V" => $textos["VISITA"]
        );

        $formularios["PESTANA_REQUERIMIENTO"] = array(
            array(
                HTML::mostrarDato("sucursal", $textos["EMPRESA"],$sucursal),
                HTML::mostrarDato("numero_requerimiento", $textos["NUMERO_REQUERIMIENTO"], number_format($datos->id))                
            ),
            array(
                HTML::mostrarDato("nombre_sede", $textos["SEDE"],$sede),
                HTML::mostrarDato("municipio", $textos["MUNICIPIO"], $nombreMunicipio)
            ),
            array(
                HTML::mostrarDato("fecha_ingreso", $textos["FECHA_INGRESO"],$datos->fecha_ingreso),
                HTML::mostrarDato("fecha_visita", $textos["FECHA_VISITA"],$datos->fecha_visita),
                HTML::mostrarDato("fecha_limte_visita", $textos["FECHA_LIMITE_VISITA"],$datos->fecha_limite_visita)
            ),
            array(
                HTML::mostrarDato("tipo_solictud", $textos["TIPO_SOLICITUD"],$tipo_solicitud[$datos->tipo_solicitud]),
            ),
            array(
                HTML::mostrarDato("descripcion", $textos["DESCRIPCION"],$datos->descripcion)
            ),
            array(
                HTML::mostrarDato("observaciones", $textos["OBSERVACIONES"],$datos->observaciones)
            ),
            array(
                HTML::mostrarDato("nombre_contacto", $textos["CONTACTO"],$datos->nombre_contacto),
                HTML::mostrarDato("telefono_contacto", $textos["TELEFONO_CONTACTO"],$datos->telefono_contacto)
            ),
            array(
                HTML::mostrarDato("codigo_contable", $textos["CODIGO_CONTABLE"],$datos->codigo_contable)
            ),
            array(
                HTML::mostrarDato("persona_recibe", $textos["PERSONA_RECIBE"],$datos->persona_recibe),
                HTML::mostrarDato("medio_recibo", $textos["MEDIO_RECIBO"],$datos->medio_recibo)
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
