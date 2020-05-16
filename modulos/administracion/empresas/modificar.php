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
/*** Devolver datos para autocompletar la búsqueda ***/
if (isset($url_completar)) {

    if (($url_item) == "selector1") {
        echo SQL::datosAutoCompletar("seleccion_municipios", $url_q);
    }
    if (($url_item) == "selector2") {
        echo SQL::datosAutoCompletar("seleccion_localidades", $url_q);
    }
    exit;
}

/*** Generar el formulario para la captura de datos ***/
if (!empty($url_generar)) {

    /*** Verificar que se haya enviado el ID del elemento a modificar ***/
    if (empty($url_id)) {
        $error     = $textos["ERROR_MODIFICAR_VACIO"];
        $titulo    = "";
        $contenido = "";

    } else {
        $vistaConsulta = "buscador_empresas";
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
        $regimen = array(
            "1" => $textos["REGIMEN_COMUN"],
            "2" => $textos["REGIMEN_SIMPLIFICADO"]
        );

        $tipo_persona = array(
            "1" => $textos["NATURAL"],
            "2" => $textos["JURIDICA"],
            "3" => $textos["INTERNO"]
        );

        /***Obtener los datos de la tabla de empresas***/
        $activo_tabla            = SQL::obtenerValor("empresas", "activo", "id = '$url_id'");
        $fecha_cierre            = SQL::obtenerValor("empresas", "fecha_cierre", "id = '$url_id'");
        $regimen_tabla           = SQL::obtenerValor("empresas", "regimen", "id = '$url_id'");
        $retiene_fuente          = SQL::obtenerValor("empresas", "retiene_fuente", "id = '$url_id'");
        $autoretenedor           = SQL::obtenerValor("empresas", "autoretenedor", "id = '$url_id'");
        $retiene_iva             = SQL::obtenerValor("empresas", "retiene_iva", "id = '$url_id'");
        $retiene_ica             = SQL::obtenerValor("empresas", "retiene_ica", "id = '$url_id'");
        $gran_contribuyente      = SQL::obtenerValor("empresas", "gran_contribuyente", "id = '$url_id'");
        $id_actividad_principal  = SQL::obtenerValor("empresas", "id_actividad_principal", "id = '$url_id'");
        $actividad_principal     = SQL::obtenerValor("actividades_economicas", "descripcion", "id = '$id_actividad_principal'");
        $id_actividad_secundaria = SQL::obtenerValor("empresas", "id_actividad_secundaria", "id = '$url_id'");
        $actividad_secundaria    = SQL::obtenerValor("actividades_economicas", "descripcion", "id = '$id_actividad_secundaria'");

        /*** Obtener los datos de la tabla de terceros ***/
        $id_tercero                     = SQL::obtenerValor("empresas", "id_tercero", "id = '$url_id'");        
        $vistaTercero    = "terceros";
        $columnasTercero = SQL::obtenerColumnas($vistaTercero);
        $consultaTercero = SQL::seleccionar(array($vistaTercero), $columnasTercero, "id = '$id_tercero'");
        $datosTercero    = SQL::filaEnObjeto($consultaTercero);
        if ($datosTercero->tipo_persona == 1){
            $valor_persona_natural  = true;
            $valor_oculto_natural   = "";
            $valor_oculto_juridica  = "oculto";
            $valor_persona_juridica = false;
            $valor_codigo_interno   = false;
        }elseif($datosTercero->tipo_persona == 2){
            $valor_persona_natural  = false;
            $valor_persona_juridica = true;
            $valor_oculto_natural   = "oculto";
            $valor_oculto_juridica  = "";
            $valor_codigo_interno   = false;
        }else{
            $valor_persona_natural  = false;
            $valor_persona_juridica = false;
            $valor_codigo_interno   = true;
            $valor_oculto_natural   = "oculto";
            $valor_oculto_juridica  = "";
        }        
        $descripcion_tipo_documento     = SQL::obtenerValor("tipos_documento_identidad", "descripcion", "id = '$datosTercero->id_tipo_documento'");        
        $municipio_documento            = SQL::obtenerValor("seleccion_municipios", "nombre", "id = '$datosTercero->id_municipio_documento'");
        $municipio_documento            = explode("|", $municipio_documento);
        $municipio_documento            = $municipio_documento[0];
        $localidad_residencia           = SQL::obtenerValor("seleccion_localidades", "nombre", "id = '$datosTercero->id_municipio_residencia'");
        $localidad_residencia           = explode("|",$localidad_residencia);
        $localidad_residencia           = $localidad_residencia[0];

        /*** Definición de pestañas para datos del tercero***/
        $formularios["PESTANA_TERCERO"] = array(
            array(
                HTML::campoTextoCorto("*documento_identidad", $textos["DOCUMENTO_TERCERO"], 15, 15, $datosTercero->documento_identidad, array("title" => $textos["AYUDA_TERCERO"],"onblur" => "validarItem(this);"))
            ),
            array(
                HTML::listaSeleccionSimple("*id_tipo_documento", $textos["TIPO_DOCUMENTO_IDENTIDAD"], HTML::generarDatosLista("tipos_documento_identidad", "id", "descripcion"), $datosTercero->id_tipo_documento)
            ),
            array(
                HTML::marcaSeleccion("tipo_persona", $textos["PERSONA_NATURAL"], 1, $valor_persona_natural, array("id" => "persona_natural", "onChange" => "activarNombres(1)")),
                HTML::marcaSeleccion("tipo_persona", $textos["PERSONA_JURIDICA"], 2, $valor_persona_juridica, array("id" => "persona_juridica", "onChange" => "activarNombres(2)")),
                HTML::marcaSeleccion("tipo_persona", $textos["CODIGO_INTERNO"], 3, $valor_codigo_interno, array("id" => "codigo_interno", "onChange" => "activarNombres(3)"))
            ),
            array(
                HTML::campoTextoCorto("*primer_nombre", $textos["PRIMER_NOMBRE"], 15, 15, $datosTercero->primer_nombre, array("title" => $textos["AYUDA_PRIMER_NOMBRE"], "onblur" => "validarItem(this)", "class" => "$valor_oculto_natural")),
                HTML::campoTextoCorto("*segundo_nombre", $textos["SEGUNDO_NOMBRE"], 15, 15, $datosTercero->segundo_nombre, array("title" => $textos["AYUDA_SEGUNDO_NOMBRE"], "onblur" => "validarItem(this)", "class" => "$valor_oculto_natural"))
            ),
            array(
                HTML::campoTextoCorto("*primer_apellido", $textos["PRIMER_APELLIDO"], 15, 15, $datosTercero->primer_apellido, array("title" => $textos["AYUDA_PRIMER_APELLIDO"], "onblur" => "validarItem(this)", "class" => "$valor_oculto_natural")),
                HTML::campoTextoCorto("*segundo_apellido", $textos["SEGUNDO_APELLIDO"], 15, 15, $datosTercero->segundo_apellido, array("title" => $textos["AYUDA_SEGUNDO_APELLIDO"], "onblur" => "validarItem(this)", "class" => "$valor_oculto_natural"))
            ),
            array(
                HTML::campoTextoCorto("*razon_social", $textos["RAZON_SOCIAL"], 30, 60, $datosTercero->razon_social, array("title" => $textos["AYUDA_RAZON_SOCIAL"], "onblur" => "validarItem(this)", "class" => "$valor_oculto_juridica")),
                HTML::campoTextoCorto("*nombre_comercial", $textos["NOMBRE_COMERCIAL"], 30, 60, $datosTercero->nombre_comercial, array("title" => $textos["AYUDA_NOMBRE_COMERCIAL"], "onblur" => "validarItem(this)"))
            ),
            array(
                HTML::campoTextoCorto("*selector1", $textos["MUNICIPIO"], 40, 255, $municipio_documento, array("title" => $textos["AYUDA_DOCUMENTO_MUNICIPIO"], "class" => "autocompletable")).HTML::campoOculto("id_municipio_documento", $datosTercero->id_municipio_documento)
            )
        );

        /*** Definición de pestañas para la ubicación del tercero***/
        $formularios["PESTANA_UBICACION_TERCERO"] = array(
            array(
                HTML::campoTextoCorto("*selector2", $textos["LOCALIDAD"], 50, 255, $localidad_residencia, array("title" => $textos["AYUDA_DOCUMENTO_MUNICIPIO"], "class" => "autocompletable")).HTML::campoOculto("id_municipio_residencia", $datosTercero->id_municipio_residencia)
            ),
            array(
                HTML::campoTextoCorto("*direccion_principal", $textos["DIRECCION"], 50, 50, $datosTercero->direccion_principal, array("title" => $textos["AYUDA_DIRECCION"]))
            ),
            array(
                HTML::campoTextoCorto("telefono_principal", $textos["TELEFONO_PRINCIPAL"], 15, 15, $datosTercero->telefono_principal, array("title" => $textos["AYUDA_TELEFONO_PRINCIPAL"])),
                HTML::campoTextoCorto("fax", $textos["FAX"], 15, 15, $datosTercero->fax, array("title" => $textos["AYUDA_FAX"])),
                HTML::campoTextoCorto("celular", $textos["CELULAR"], 20, 20, $datosTercero->celular, array("title" => $textos["AYUDA_CELULAR"]))
            ),
            array(
                HTML::campoTextoCorto("correo", $textos["CORREO"], 50, 255, $datosTercero->correo, array("title" => $textos["AYUDA_CORREO"]))
            ),
            array(
                HTML::campoTextoCorto("sitio_web", $textos["SITIO_WEB"], 50, 50, $datosTercero->sitio_web, array("title" => $textos["AYUDA_SITIO_WEB"]))
            )
        );

        /*** Definicion de pestañas general ***/
        $formularios["PESTANA_GENERAL"] = array(
            array(
                HTML::campoTextoCorto("*codigo", $textos["CODIGO"], 4, 4, $datos->codigo, array("title" => $textos["AYUDA_CODIGO"],"onBlur" => "validarItem(this);")),
                HTML::listaSeleccionSimple("*activo", $textos["ACTIVO"], $activo, $activo_tabla)
            ),
            array(
                HTML::campoTextoCorto("*razon_social_empresa", $textos["RAZON_SOCIAL"], 60, 60, $datos->razon_social, array("title" => $textos["AYUDA_RAZON_SOCIAL"],"onBlur" => "validarItem(this);"))
            ),
            array(
                HTML::campoTextoCorto("nombre_corto", $textos["NOMBRE_CORTO"], 10, 10, $datos->nombre_corto, array("title" => $textos["AYUDA_NOMBRE_CORTO"],"onBlur" => "validarItem(this);")),
                HTML::campoTextoCorto("fecha_cierre", $textos["FECHA_CIERRE"], 10, 10, $fecha_cierre, array("class" => "selectorFecha"), array("title" => $textos["AYUDA_FECHA_CIERRE"],"onBlur" => "validarItem(this);"))
            ),
            array(
                HTML::listaSeleccionSimple("*id_actividad_principal", $textos["ACTIVIDAD_PRINCIPAL"], HTML::generarDatosLista("actividades_economicas", "id", "descripcion"), $id_actividad_principal, array("title" => $textos["AYUDA_ACTIVIDAD_PRINCIPAL"],"onBlur" => "validarItem(this);"))
            ),
            array(
                HTML::listaSeleccionSimple("*id_actividad_secundaria", $textos["ACTIVIDAD_SECUNDARIA"], HTML::generarDatosLista("actividades_economicas", "id", "descripcion"), $id_actividad_secundaria, array("title" => $textos["AYUDA_ACTIVIDAD_SECUNDARIA"],"onBlur" => "validarItem(this);"))
            )
        );

        /*** Definición pestaña tributaria ***/
        $formularios["PESTANA_TRIBUTARIA"] = array(
            array(
                HTML::listaSeleccionSimple("regimen", $textos["REGIMEN"], $regimen, $regimen_tabla)
            ),
            array(
                HTML::marcaChequeo("retiene_fuente", $textos["RETIENE_FUENTE"], 1, $retiene_fuente),
            ),
            array(
                HTML::marcaChequeo("autoretenedor", $textos["AUTORETENEDOR"], 1, $autoretenedor)
            ),
            array(
                HTML::marcaChequeo("retiene_iva", $textos["RETIENE_IVA"], 1, $retiene_iva)
            ),
            array(
                HTML::marcaChequeo("retiene_ica", $textos["RETIENE_ICA"], 1, $retiene_ica)
            ),
            array(
                HTML::marcaChequeo("gran_contribuyente", $textos["GRAN_CONTRIBUYENTE"], 1, $gran_contribuyente)
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
        $existe = SQL::existeItem("empresas", "codigo", $url_valor, "id != '$url_id'");

        if ($existe) {
            $respuesta = $textos["ERROR_EXISTE_CODIGO"];
        }
    }

    /*** Validar razon social ***/ 
    if ($url_item == "razon_social_empresa" && $url_valor) {
        $existe = SQL::existeItem("empresas", "razon_social", $url_valor, "codigo != '$url_codigo'", "id != '$url_id'");

        if ($existe) {
            $respuesta = $textos["ERROR_EXISTE_RAZON_SOCIAL"];
        }
    }

    /*** Validar nombre_corto ***/
    if ($url_item == "nombre_corto" && $url_valor) {
        $existe = SQL::existeItem("empresas", "nombre_corto", $url_valor, "codigo != '$url_codigo'", "id != '$url_id'");

        if ($existe) {
            $respuesta = $textos["ERROR_EXISTE_NOMBRE_CORTO"];
        }
    }
    
    HTTP::enviarJSON($respuesta);

/*** Modificar el elemento seleccionado ***/
} elseif (!empty($forma_procesar)) {

    /*** Asumir por defecto que no hubo error ***/
    $error   = false;
    $mensaje = $textos["ITEM_ADICIONADO"];

    /*** Validar el ingreso de los datos requeridos para el tercero ***/
    if (empty($forma_documento_identidad) ||
        empty($forma_tipo_persona) ||
        empty($forma_id_municipio_documento) ||
        empty($forma_id_municipio_residencia) ||
        empty($forma_direccion_principal) ||
        empty($forma_id_tipo_documento) || (
        empty($forma_primer_nombre) &&
        empty($forma_primer_apellido) &&
        empty($forma_razon_social)) || (
        empty($forma_primer_nombre) &&
        !empty($forma_primer_apellido)) ||
        (!empty($forma_primer_nombre) && empty($forma_primer_apellido))) {
        $error   = true;
        $mensaje = $textos["ERROR_DATOS_INCOMPLETOS"];

    } elseif (!empty($forma_codigo) && !Cadena::validarNumeros($forma_codigo)) {
        $error   = true;
        $mensaje =  $textos["ERROR_FORMATO_CODIGO"];

    } elseif (empty($forma_codigo) ||
              empty($forma_razon_social_empresa) ||
              empty($forma_id_actividad_principal) ||
              empty($forma_id_actividad_secundaria)) {
        /*** Validar el ingreso de los datos requeridos para la empresa ***/
        $error   = true;
        $mensaje = $textos["ERROR_DATOS_INCOMPLETOS"];

    } else {

        $id_tercero = SQL::obtenerValor("empresas", "id_tercero", "id = '$forma_id'");
        
        if ($forma_tipo_persona == 1){
            $forma_razon_social = "";
        }elseif($forma_tipo_persona == 2 || $forma_tipo_persona == 3){
            $forma_primer_nombre    = "";
            $forma_segundo_nombre   = "";
            $forma_primer_apellido  = "";
            $forma_segundo_apellido = "";
        }
        
        $datos = array(
            "documento_identidad"     => $forma_documento_identidad,
            "tipo_persona"            => $forma_tipo_persona,
            "id_tipo_documento"       => $forma_id_tipo_documento,
            "primer_nombre"           => $forma_primer_nombre,
            "segundo_nombre"          => $forma_segundo_nombre,
            "primer_apellido"         => $forma_primer_apellido,
            "segundo_apellido"        => $forma_segundo_apellido,
            "razon_social"            => $forma_razon_social,
            "nombre_comercial"        => $forma_nombre_comercial,
            "id_municipio_documento"  => $forma_id_municipio_documento,
            "id_municipio_residencia" => $forma_id_municipio_residencia,
            "direccion_principal"     => $forma_direccion_principal,
            "telefono_principal"      => $forma_telefono_principal,
            "fax"                     => $forma_fax,
            "celular"                 => $forma_celular,
            "correo"                  => $forma_correo,
            "sitio_web"               => $forma_sitio_web
        );
        
        $consulta = SQL::modificar("terceros", $datos, "id = '$id_tercero'");

        if (!isset($forma_retiene_fuente)) {
                $forma_retiene_fuente = "0";
        }
        if (!isset($forma_autoretenedor)) {
                $forma_autoretenedor = "0";
        }
        if (!isset($forma_retiene_iva)) {
                $forma_retiene_iva = "0";
        }
        if (!isset($forma_retiene_ica)) {
                $forma_retiene_ica = "0";
        }
        if (!isset($forma_gran_contribuyente)) {
            $forma_gran_contribuyente = "0";
        }
        $datos = array(
            "codigo"                  => $forma_codigo,
            "razon_social"            => $forma_razon_social_empresa,
            "nombre_corto"            => $forma_nombre_corto,
            "fecha_cierre"            => $forma_fecha_cierre,
            "activo"                  => $forma_activo,
            "id_tercero"              => $id_tercero,
            "id_actividad_principal"  => $forma_id_actividad_principal,
            "id_actividad_secundaria" => $forma_id_actividad_secundaria,
            "regimen"                 => $forma_regimen,
            "retiene_fuente"          => $forma_retiene_fuente,
            "autoretenedor"           => $forma_autoretenedor,
            "retiene_iva"             => $forma_retiene_iva,
            "retiene_ica"             => $forma_retiene_ica,
            "gran_contribuyente"      => $forma_gran_contribuyente
        );

        $consulta = SQL::modificar("empresas", $datos, "id = '$forma_id'");

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
