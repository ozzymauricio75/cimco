<?php

/**
*
* Copyright (C) 2008 LinuxCali Ltda
* Francisco J. Lozano B. <pacho@linuxcali.com>
* Mauricio Oidor L. <ozzymauricio75@gmail.com>
*
* Este archivo es parte de:
* PANCE :: Plataforma para la Administracion del Nexo Cliente-Empresa
*
* Este programa es software libre: usted puede redistribuirlo y/o
* modificarlo  bajo los terminos de la Licencia Publica General GNU
* publicada por la Fundaci?n para el Software Libre, ya sea la versi?n 3
* de la Licencia, o (a su elecci?n) cualquier versi?n posterior.
*
* Este programa se distribuye con la esperanza de que sea util, pero
* SIN GARANT?A ALGUNA; ni siquiera la garant?a impl?cita MERCANTIL o
* de APTITUD PARA UN PROPoSITO DETERMINADO. Consulte los detalles de
* la Licencia P?blica General GNU para obtener una informaci?n m?s
* detallada.
*
* Deberia haber recibido una copia de la Licencia Publica General GNU
* junto a este programa. En caso contrario, consulte:
* <http://www.gnu.org/licenses/>.
*
**/

/*** Devolver datos para autocompletar la búsqueda ***/
if (isset($url_completar)) {
    if (($url_item) == "selector1") {
        echo SQL::datosAutoCompletar("seleccion_municipios", $url_q);
    }
    exit;
}

/*** Generar el formulario para la captura de datos ***/
if (!empty($url_generar)) {
    $error    = "";
    $titulo   = $componente->nombre;
    //$terceros = HTML::generarDatosLista("menu_terceros", "id", "NOMBRE_COMPLETO");
    
    $activo = array(
        "0" => $textos["ESTADO_INACTIVA"],
        "1" => $textos["ESTADO_ACTIVA"]
    );
    
    $tipoEmpresa = array(
        "1" => $textos["EMPRESA_DISTRIBUIDORA_MAYORISTA"],
        "2" => $textos["EMPRESA_VENTAS_PUBLICO"],
        "3" => $textos["EMPRESA_AMBAS"],
        "4" => $textos["EMPRESA_SOPORTE"]
    );
    
    $indicador = array(
        "0" => $textos["INDICADOR_NO"],
        "1" => $textos["INDICADOR_SI"]
    );
    
     /*** Definición de pestañas general ***/
    $formularios["PESTANA_GENERAL"] = array(
        array(
            HTML::campoTextoCorto("*codigo", $textos["CODIGO"], 4, 4, "", array("title" => $textos["AYUDA_CODIGO"],"onBlur" => "validarItem(this);"))
        ),
        array(
            HTML::listaSeleccionSimple("*id_empresa", $textos["EMPRESA"], HTML::generarDatosLista("empresas", "id", "razon_social"), "", array("title" => $textos["AYUDA_EMPRESAS"],"onBlur" => "validarItem(this);"))
        ),
        array(
            HTML::campoTextoCorto("*nombre", $textos["NOMBRE"], 60, 60, "", array("title" => $textos["AYUDA_NOMBRE"],"onBlur" => "validarItem(this);"))
        ),
        array(
            HTML::campoTextoCorto("nombre_corto", $textos["NOMBRE_CORTO"], 10, 10, "", array("title" => $textos["AYUDA_NOMBRE_CORTO"],"onBlur" => "validarItem(this);")),
            HTML::listaSeleccionSimple("activo", $textos["ESTADO"], $activo, 1, array("title" => $textos["AYUDA_ACTIVO"],"onBlur" => "validarItem(this);")),
            HTML::listaSeleccionSimple("contratista", $textos["CONTRATISTA"], $indicador, 0, array("title" => $textos["AYUDA_CONTRATISTA"],"onBlur" => "validarItem(this);"))
        ),
        array(
            HTML::campoTextoCorto("*selector1", $textos["MUNICIPIO"], 40, 255, "", array("title" => $textos["AYUDA_MUNICIPIOS"], "class" => "autocompletable")).HTML::campoOculto("id_municipio", "")
        ),
        array(
            HTML::campoTextoCorto("*direccion_residencia", $textos["DIRECCION_RESIDENCIA"], 60, 60, "", array("title" => $textos["AYUDA_DIRECCION"],"onBlur" => "validarItem(this);"))
        ),
        array(
            HTML::campoTextoCorto("*telefono_1", $textos["TELEFONO_1"], 15, 15, "", array("title" => $textos["AYUDA_TELEFONO_1"],"onBlur" => "validarItem(this);")),
            HTML::campoTextoCorto("telefono_2", $textos["TELEFONO_2"], 15, 15, "", array("title" => $textos["AYUDA_TELEFONO_2"],"onBlur" => "validarItem(this);"))
        ), 
        array(
            HTML::campoTextoCorto("celular", $textos["CELULAR"], 15, 15, "", array("title" => $textos["AYUDA_CELULAR"],"onBlur" => "validarItem(this);"))
        )       
    );

    /*** Definicion de botones ***/
    $botones = array(
        HTML::boton("botonAceptar", $textos["ACEPTAR"], "adicionarItem();", "aceptar")
    );

    $contenido = HTML::generarPestanas($formularios, $botones);

    /*** Enviar datos para la generacion del formulario al script que origino la peticion ***/
    $respuesta[0] = $error;
    $respuesta[1] = $titulo;
    $respuesta[2] = $contenido;
    HTTP::enviarJSON($respuesta);

/*** Validar los datos provenientes del formulario ***/
} elseif (!empty($url_validar)) {

    $respuesta = "";

    /*** Validar codigo ***/
    if ($url_item == "codigo") {
        $existe = SQL::existeItem("sucursales", "codigo", $url_valor);

        if ($existe) {
            $respuesta = $textos["ERROR_EXISTE_CODIGO"];
        }
    }
    
    /*** Validar nombre ***/
    if ($url_item == "nombre") {
        $existe = SQL::existeItem("sucursales", "nombre", $url_valor);

        if ($existe) {
            $respuesta = $textos["ERROR_EXISTE_NOMBRE"];
        }
    }
    
    /*** Validar nombre corto ***/
    if ($url_item == "nombre_corto" && $url_valor) {
        $existe = SQL::existeItem("sucursales", "nombre_corto", $url_valor);

        if ($existe) {
            $respuesta = $textos["ERROR_EXISTE_NOMBRE_CORTO"];
        }
    }
    
    HTTP::enviarJSON($respuesta);

/*** Adicionar los datos provenientes del formulario ***/
} elseif (!empty($forma_procesar)) {

    /*** Asumir por defecto que no hubo error ***/
    $error   = false;
    $mensaje = $textos["ITEM_ADICIONADO"];

    /*** Validar el ingreso de los datos requeridos ***/
    if (empty($forma_codigo) || empty($forma_id_empresa) || empty($forma_nombre) || empty($forma_id_municipio) || empty($forma_direccion_residencia) || empty($forma_telefono_1)) {
        $error   = true;
        $mensaje = $textos["ERROR_DATOS_INCOMPLETOS"];

    } elseif (SQL::existeItem("sucursales", "codigo", $forma_codigo, "codigo = '$forma_codigo'")) {
        $error   = true;
        $mensaje =  $textos["ERROR_EXISTE_CODIGO"];
    
    } elseif (!empty($forma_codigo) && !Cadena::validarNumeros($forma_codigo)) {
        $error   = true;
        $mensaje =  $textos["ERROR_FORMATO_CODIGO"];

    } elseif (!empty($forma_nombre) && SQL::existeItem("sucursales", "nombre", $forma_nombre, "codigo = '$forma_codigo'")) {
            $error   = true;
            $mensaje =  $textos["ERROR_EXISTE_NOMBRE"];

    } elseif (!empty($forma_nombre_corto) && SQL::existeItem("sucursales", "nombre_corto", $forma_nombre_corto, "codigo = '$forma_codigo'")) {
        $error   = true;
        $mensaje =  $textos["ERROR_EXISTE_NOMBRE_CORTO"];

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

        $insertar = SQL::insertar("sucursales", $datos);

        /*** Error de insercion ***/
        if (!$insertar) {
            $error   = true;
            $mensaje = $textos["ERROR_ADICIONAR_ITEM"];
        }
    }    

    /*** Enviar datos con la respuesta del proceso al script que origin? la petici?n ***/
    $respuesta    = array();
    $respuesta[0] = $error;
    $respuesta[1] = $mensaje;
    HTTP::enviarJSON($respuesta);
}
?>
