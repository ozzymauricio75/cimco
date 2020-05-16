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
        $vistaConsulta = "sucursales";
        $condicion     = "id = '$url_id'";
        $columnas      = SQL::obtenerColumnas($vistaConsulta);
        $consulta      = SQL::seleccionar(array($vistaConsulta), $columnas, $condicion);
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

        /*** Definición de pestañas general ***/
        $formularios["PESTANA_GENERAL"] = array(
            array(
                HTML::campoTextoCorto("*codigo", $textos["CODIGO"], 4, 4, $datos->codigo, array("title" => $textos["AYUDA_CODIGO"],"onBlur" => "validarItem(this);"))
            ),
            array(
                HTML::listaSeleccionSimple("*id_empresa", $textos["EMPRESA"], HTML::generarDatosLista("empresas", "id", "razon_social"), $datos->id_empresa, array("title" => $textos["AYUDA_EMPRESAS"],"onBlur" => "validarItem(this);"))
            ),
            array(
                HTML::campoTextoCorto("*nombre", $textos["NOMBRE"], 60, 60, $datos->nombre, array("title" => $textos["AYUDA_NOMBRE"],"onBlur" => "validarItem(this);"))
            ),
            array(
                HTML::campoTextoCorto("nombre_corto", $textos["NOMBRE_CORTO"], 10, 10, $datos->nombre_corto, array("title" => $textos["AYUDA_NOMBRE_CORTO"],"onBlur" => "validarItem(this);")),
                HTML::listaSeleccionSimple("activo", $textos["ESTADO"], $activo, $datos->activo, array("title" => $textos["AYUDA_ACTIVO"],"onBlur" => "validarItem(this);")),
                HTML::listaSeleccionSimple("contratista", $textos["CONTRATISTA"], $indicador, $datos->contratista, array("title" => $textos["AYUDA_CONTRATISTA"],"onBlur" => "validarItem(this);"))
            ),
            array(
                HTML::campoTextoCorto("*selector1", $textos["MUNICIPIO"], 40, 255, $municipio, array("title" => $textos["AYUDA_MUNICIPIOS"], "class" => "autocompletable")).HTML::campoOculto("id_municipio", $datos->id_municipio)
            ),
            array(
                HTML::campoTextoCorto("*direccion_residencia", $textos["DIRECCION_RESIDENCIA"], 60, 60, $datos->direccion_residencia, array("title" => $textos["AYUDA_DIRECCION"],"onBlur" => "validarItem(this);"))
            ),
            array(
                HTML::campoTextoCorto("*telefono_1", $textos["TELEFONO_1"], 15, 15, $datos->telefono_1, array("title" => $textos["AYUDA_TELEFONO_1"],"onBlur" => "validarItem(this);")),
                HTML::campoTextoCorto("telefono_2", $textos["TELEFONO_2"], 15, 15, $datos->telefono_2, array("title" => $textos["AYUDA_TELEFONO_2"],"onBlur" => "validarItem(this);"))
            ),
            array(
                HTML::campoTextoCorto("celular", $textos["CELULAR"], 15, 15, $datos->celular, array("title" => $textos["AYUDA_CELULAR"],"onBlur" => "validarItem(this);"))
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

    /*** Validar codigo ***/
    if ($url_item == "codigo" && $url_valor) {
        $existe = SQL::existeItem("sucursales", "codigo", $url_valor, "id != '$url_id'");

        if ($existe) {
            $respuesta = $textos["ERROR_EXISTE_CODIGO"];
        }
    }

    /*** Validar nombre ***/ 
    if ($url_item == "nombre" && $url_valor) {
        $existe = SQL::existeItem("sucursales", "nombre", $url_valor, "id != '$url_id'");

        if ($existe) {
            $respuesta = $textos["ERROR_EXISTE_NOMBRE"];
        }
    }

    /*** Validar nombre_corto ***/
    if ($url_item == "nombre_corto" && $url_valor) {
        $existe = SQL::existeItem("sucursales", "nombre_corto", $url_valor, "id != '$url_id'");

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
    if (empty($forma_codigo) || empty($forma_id_empresa) || empty($forma_nombre) || empty($forma_id_municipio) || empty($forma_direccion_residencia) || empty($forma_telefono_1)) {
        $error   = true;
        $mensaje = $textos["ERROR_DATOS_INCOMPLETOS"];

    } elseif (!empty($forma_codigo) && !Cadena::validarNumeros($forma_codigo)) {
        $error   = true;
        $mensaje =  $textos["ERROR_FORMATO_CODIGO"];

    } else {
    
        $datos = array(
            "codigo"                    => $forma_codigo,
            "id_empresa"                => $forma_id_empresa,
            "nombre"                    => $forma_nombre,
            "nombre_corto"              => $forma_nombre_corto,
            "activo"                    => $forma_activo,
            "contratista"               => $forma_contratista,
            "id_municipio"              => $forma_id_municipio,
            "direccion_residencia"      => $forma_direccion_residencia,
            "telefono_1"                => $forma_telefono_1,
            "telefono_2"                => $forma_telefono_2,
            "celular"                   => $forma_celular
        );

        $consulta = SQL::modificar("sucursales", $datos, "id = '$forma_id'");

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
