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
        $vistaConsulta = "sedes_clientes";
        $columnas      = SQL::obtenerColumnas($vistaConsulta);
        $consulta      = SQL::seleccionar(array($vistaConsulta), $columnas, "id = '$url_id'");
        $datos         = SQL::filaEnObjeto($consulta);
        $error         = "";
        $titulo        = $componente->nombre;
        
        $cliente             = SQL::obtenerValor("menu_terceros","NOMBRE_COMPLETO","id ='$datos->id_cliente'");
        $sucursal            = SQL::obtenerValor("sucursales","nombre","id = '$datos->id_sucursal'");
        $nombre_municipio    = SQL::obtenerValor("municipios","nombre","id = '$datos->id_municipios'");
        $departamento        = SQL::obtenerValor("municipios","id_departamento","id = '$datos->id_municipios'");
        $nombre_departamento = SQL::obtenerValor("departamentos","nombre","id = '$departamento'");
        $pais                = SQL::obtenerValor("departamentos","id_pais","id = '$departamento'");
        $nombre_pais         = SQL::obtenerValor("paises","nombre","id = '$pais'");

        /*** Definición de pestañas ***/
        $formularios["PESTANA_GENERAL"] = array(
            array(
                HTML::mostrarDato("cliente", $textos["CLIENTE"], $cliente)
            ),
            array(
                HTML::mostrarDato("nombre_sede", $textos["NOMBRE_SEDE"], $datos->nombre_sede),
                HTML::mostrarDato("sucursal", $textos["SUCURSAL"], $sucursal)
            ),
            array(
                HTML::mostrarDato("nombre_contacto", $textos["CONTACTO"],$datos->nombre_contacto)
            ),
            array(
                HTML::mostrarDato("id_pais", $textos["PAIS"], $nombre_pais),
                HTML::mostrarDato("id_departamento", $textos["DEPARTAMENTO"], $nombre_departamento),
                HTML::mostrarDato("id_municipios", $textos["MUNICIPIO"], $nombre_municipio)
            ),
            array(
                HTML::mostrarDato("direccion", $textos["DIRECCION"], $datos->direccion)
            ),
            array(
                HTML::mostrarDato("telefono_principal", $textos["TELEFONO_PRINCIPAL"], $datos->telefono_principal),
                HTML::mostrarDato("celular", $textos["CELULAR"], $datos->celular)
            ),
            array( 
                HTML::mostrarDato("correo", $textos["CORREO_ELECTRONICO"], $datos->correo)
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
