<?php

/**
*
* Copyright (C) 2020 Raul Mauricio Oidor Lozano
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
$tabla = "usuarios";
$columnas                   = SQL::obtenerColumnas($tabla);
$consulta                   = SQL::seleccionar(array($tabla), $columnas, "usuario = '$sesion_usuario'");
$datos                      = SQL::filaEnObjeto($consulta);
$sesion_id_usuario_ingreso  = $datos->id;

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

/*** Devolver datos para cargar los elementos del formulario relacionados con el documento del cliente digitado***/
if (isset($url_recargar)) {

    if (!empty($url_documento_identidad_carga)) {

        $consulta = SQL::seleccionar(array("terceros"), array("*"), "documento_identidad = '$url_documento_identidad_carga'", "", "documento_identidad", 1);
        $tabla = array();

        if (SQL::filasDevueltas($consulta)) {
            $datos = SQL::filaEnObjeto($consulta);
            $tabla = array(
                //$datos->documento_identidad,
                $datos->id_tipo_documento,
                $datos->id_municipio_documento,
                $datos->tipo_persona,
                $datos->primer_nombre,
                $datos->segundo_nombre,
                $datos->primer_apellido,
                $datos->segundo_apellido,
                $datos->razon_social,
                $datos->nombre_comercial,
                $datos->fecha_nacimiento,
                $datos->fecha_ingreso,  
                $datos->id_municipio_residencia,
                $datos->direccion_principal,
                $datos->telefono_principal,
                $datos->telefono_secundario,
                $datos->celular,
                $datos->fax,
                $datos->correo,
                $datos->sitio_web,
                $datos->activo,
                $datos->genero,
                $datos->cliente,
                $datos->proveedor,
                $datos->comprador,
            );
        } else {
            $tabla[] = "";
        }
        HTTP::enviarJSON($tabla);
    }
    exit;
}

if (isset($url_recargarMunicipioDocumento)){

    if(!empty($url_municipio_documento)){

        $consulta = SQL::seleccionar(array("seleccion_municipios"), array("nombre"), "id = '$url_municipio_documento'", "", "nombre", 1);

        if (SQL::filasDevueltas($consulta)) {
            $datos = SQL::filaEnObjeto($consulta);
            $nombre_municipio_documento  = $datos->nombre;
            $nombre_municipio_documento  = explode("|", $nombre_municipio_documento);
            $nombre_municipio_documento  = $nombre_municipio_documento[0];
        }else {
            $nombre_municipio_documento = "";
        }
        HTTP::enviarJSON($nombre_municipio_documento);
    }
    exit;
}

if (isset($url_recargarMunicipioResidencia)){

    if(!empty($url_municipio_residencia)){

        $consulta = SQL::seleccionar(array("seleccion_localidades"), array("nombre"), "id = '$url_municipio_residencia'", "", "nombre", 1);

        if (SQL::filasDevueltas($consulta)) {
            $datos = SQL::filaEnObjeto($consulta);
            $nombre_municipio_residencia  = $datos->nombre;
            $nombre_municipio_residencia  = explode("|", $nombre_municipio_residencia);
            $nombre_municipio_residencia  = $nombre_municipio_residencia[0];
        }else {
            $nombre_municipio_residencia = "";
        }
        HTTP::enviarJSON($nombre_municipio_residencia);
    }
    exit;
}

/*** Generar el formulario para la captura de datos ***/
if (!empty($url_generar)) {
    $error  = "";
    $titulo = $componente->nombre;

    $regimen = array(
        "1" => $textos["REGIMEN_COMUN"],
        "2" => $textos["REGIMEN_SIMPLIFICADO"]
    );

    $tipo_persona = array(
        "1" => $textos["PERSONA_NATURAL"],
        "2" => $textos["PERSONA_JURIDICA"],
        "3" => $textos["CODIGO_INTERNO"]
    );
    $inicio_cobro = array(
        "1" => $textos["FECHA_FACTURA"],
        "2" => $textos["FECHA_RECIBO"]
    );
    
    $genero = array(
        "M" => $textos["MASCULINO"],
        "F" => $textos["FEMENINO"],
        "N" => $textos["NO_APLICA"],
    );
    
    $barrios_localidades = HTML::generarDatosLista("localidades", "id", "nombre");
    $id_tipo_documento   = SQL::obtenerValor("tipos_documento_identidad", "id", "");

    /*** Definición de pestañas para datos del tercero***/
    $formularios["PESTANA_PROVEEDOR"] = array(
        array(
            HTML::campoTextoCorto("*documento_identidad", $textos["DOCUMENTO_PROVEEDOR"], 15, 15, "",array("title" => $textos["AYUDA_DOCUMENTO_PROVEEDOR"],"onblur" => "validarItem(this);","onchange" => "cargarDatos()"))
        ),
        array(
            HTML::listaSeleccionSimple("*id_tipo_documento", $textos["TIPO_DOCUMENTO_IDENTIDAD"], HTML::generarDatosLista("tipos_documento_identidad", "id", "descripcion"), $id_tipo_documento)
        ),
       array(
            HTML::campoTextoCorto("*selector1", $textos["MUNICIPIO"], 40, 255, "", array("title" => $textos["AYUDA_DOCUMENTO_MUNICIPIO"], "class" => "autocompletable")).HTML::campoOculto("id_municipio_documento", "")
        ),
        array(
            HTML::marcaSeleccion("tipo_persona", $textos["PERSONA_NATURAL"], 1, false, array("id" => "persona_natural", "onChange" => "activarNombres(1)")),
            HTML::marcaSeleccion("tipo_persona", $textos["PERSONA_JURIDICA"], 2, true, array("id" => "persona_juridica", "onChange" => "activarNombres(2)")),
            HTML::marcaSeleccion("tipo_persona", $textos["CODIGO_INTERNO"], 3, false, array("id" => "codigo_interno", "onChange" => "activarNombres(3)"))
        ),
        array(
            HTML::campoTextoCorto("*primer_nombre", $textos["PRIMER_NOMBRE"], 15, 15, "", array("title" => $textos["AYUDA_PRIMER_NOMBRE"], "onblur" => "validarItem(this)", "class" => "oculto")),
            HTML::campoTextoCorto("segundo_nombre", $textos["SEGUNDO_NOMBRE"], 15, 15, "", array("title" => $textos["AYUDA_SEGUNDO_NOMBRE"], "onblur" => "validarItem(this)", "class" => "oculto"))
        ),
        array(
            HTML::campoTextoCorto("*primer_apellido", $textos["PRIMER_APELLIDO"], 15, 15, "", array("title" => $textos["AYUDA_PRIMER_APELLIDO"], "onblur" => "validarItem(this)", "class" => "oculto")),
            HTML::campoTextoCorto("segundo_apellido", $textos["SEGUNDO_APELLIDO"], 15, 15, "", array("title" => $textos["AYUDA_SEGUNDO_APELLIDO"], "onblur" => "validarItem(this)", "class" => "oculto"))
        ),
                array(   
            HTML::listaSeleccionSimple("*genero", $textos["GENERO"], $genero, "", array("title" => $textos["AYUDA_GENERO"],"onBlur" => "validarItem(this);", "class" => "oculto"))
        ),
        array(
            HTML::campoTextoCorto("*razon_social", $textos["RAZON_SOCIAL"], 30, 100, "", array("title" => $textos["AYUDA_RAZON_SOCIAL"], "onblur" => "validarItem(this)")),
            HTML::campoTextoCorto("nombre_comercial", $textos["NOMBRE_COMERCIAL"], 30, 60, "", array("title" => $textos["AYUDA_NOMBRE_COMERCIAL"], "onblur" => "validarItem(this)"))
        ),
        array(
                HTML::listaSeleccionSimple("*id_municipio_residencia", $textos["AYUDA_DOCUMENTO_MUNICIPIO"], $barrios_localidades, $datos->id_municipio_residencia, array("title" => $textos["AYUDA_DEPARTAMENTO"], "onChange" => "recargarLista('departamento','municipio');"))
        ),
    );

    /*** Definición de pestañas para la ubicación del tercero***/
    $formularios["PESTANA_UBICACION_PROVEEDOR"] = array(
        array(
            HTML::campoTextoCorto("*direccion_principal", $textos["DIRECCION"], 50, 50, "", array("title" => $textos["AYUDA_DIRECCION"]))
        ),
        array(
            HTML::campoTextoCorto("*telefono_principal", $textos["TELEFONO_PRINCIPAL"], 15, 15, "", array("title" => $textos["AYUDA_TELEFONO_PRINCIPAL"])),
            HTML::campoTextoCorto("telefono_secundario", $textos["TELEFONO_SECUNDARIO"], 15, 15, "", array("title" => $textos["AYUDA_TELEFONO_SECUNDARIO"])),
            HTML::campoTextoCorto("fax", $textos["FAX"], 15, 15, "", array("title" => $textos["AYUDA_FAX"])),
            HTML::campoTextoCorto("celular", $textos["CELULAR"], 20, 20, "", array("title" => $textos["AYUDA_CELULAR"]))
        ),
        array(
            HTML::campoTextoCorto("correo", $textos["CORREO"], 50, 255, "", array("title" => $textos["AYUDA_CORREO"]))
        ),
        array(
            HTML::campoTextoCorto("sitio_web", $textos["SITIO_WEB"], 50, 50, "", array("title" => $textos["AYUDA_SITIO_WEB"]))
        ),
        array(
            HTML::listaSeleccionSimple("*id_actividad_principal", $textos["ACTIVIDAD_PRINCIPAL"], HTML::generarDatosLista("actividades_economicas", "id", "descripcion"), "", array("title" => $textos["AYUDA_ACTIVIDAD_PRINCIPAL"],"onBlur" => "validarItem(this);"))
        ),
        array(
            HTML::listaSeleccionSimple("*id_actividad_secundaria", $textos["ACTIVIDAD_SECUNDARIA"], HTML::generarDatosLista("actividades_economicas", "id", "descripcion"), "", array("title" => $textos["AYUDA_ACTIVIDAD_SECUNDARIA"],"onBlur" => "validarItem(this);"))
        ),        
    );

    /*** Definición de pestaña tributaria ***/
    $formularios["PESTANA_TRIBUTARIA"] = array(
        array(
            HTML::listaSeleccionSimple("regimen", $textos["REGIMEN"], $regimen)
        ),
        array(
            HTML::marcaChequeo("retiene_fuente", $textos["RETIENE_FUENTE"])
        ),
        array(
            HTML::marcaChequeo("autoretenedor", $textos["AUTORETENEDOR"])
        ),
        array(
            HTML::marcaChequeo("retiene_iva", $textos["RETIENE_IVA"])
        ),
        array(
            HTML::marcaChequeo("retiene_ica", $textos["RETIENE_ICA"])
        ),
        array(
            HTML::marcaChequeo("gran_contribuyente", $textos["GRAN_CONTRIBUYENTE"])
        ),
    );

    /*** Definición de pestaña PAGOS ***/
    $formularios["PESTANA_PAGOS"] = array(
        array(
            HTML::listaSeleccionSimple("id_forma_pago_contado", $textos["FORMA_PAGO_CONTADO"], HTML::generarDatosLista("plazos_pago_proveedores", "id", "nombre"))
        ),
        array(
            HTML::listaSeleccionSimple("id_forma_pago_credito", $textos["FORMA_PAGO_CREDITO"], HTML::generarDatosLista("plazos_pago_proveedores", "id", "nombre"))
        ),
    );

    /*** Definición de botones ***/
    $botones = array(
        HTML::boton("botonAceptar", $textos["ACEPTAR"], "adicionarItem();", "aceptar"),
    );

    $contenido = HTML::generarPestanas($formularios, $botones);

    /*** Enviar datos para la generación del formulario al script que originó la petición ***/
    $respuesta[0] = $error;
    $respuesta[1] = $titulo;
    $respuesta[2] = $contenido;
    HTTP::enviarJSON($respuesta);

/*** Validar los datos provenientes del formulario ***/
} elseif (!empty($url_validar)) {
    $respuesta = "";

    /*** Validar documento de identidad ***/
    if ($url_item == "documento_identidad" && $url_valor) {
        $existe_tercero = SQL::existeItem("terceros", "documento_identidad", $url_valor);
        if ($existe_tercero) {
            $id_tercero = SQL::obtenerValor("terceros", "id", "documento_identidad = '$url_valor'");
            $idAsignado = $id_tercero;
            $existe_proveedor = SQL::existeItem("proveedores", "id_tercero", $id_tercero);
            if ($existe_proveedor) {
                echo json_encode($textos["ERROR_EXISTE_TERCERO"]);
            }
        }
    }

/*** Adicionar los datos provenientes del formulario ***/
} elseif (!empty($forma_procesar)) {
    /*** Asumir por defecto que no hubo error ***/
    $error   = false;
    $mensaje = $textos["ITEM_ADICIONADO"];

    if (empty($forma_documento_identidad) ||
        empty($forma_tipo_persona) ||
        empty($forma_id_municipio_documento) ||
        empty($forma_id_municipio_residencia) ||
        empty($forma_direccion_principal) ||
        empty($forma_id_tipo_documento) ||
        (
         empty($forma_primer_nombre) &&
         empty($forma_primer_apellido) &&
         empty($forma_razon_social)
        ) ||
        (
         empty($forma_primer_nombre) &&
         !empty($forma_primer_apellido)
        ) ||
        (
         !empty($forma_primer_nombre) &&
         empty($forma_primer_apellido)
        )
        )
        {
        $error   = true;
        $mensaje = $textos["ERROR_DATOS_INCOMPLETOS"];

    } else {

        $existe_tercero = SQL::existeItem("terceros", "documento_identidad", $forma_documento_identidad);
        if ($existe_tercero) {
            $idAsignado = SQL::obtenerValor("terceros", "id", "documento_identidad = '$forma_documento_identidad'");
        }

        if ($forma_tipo_persona == 1){
            $forma_razon_social = "";
        }else{
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
            "fecha_ingreso"           => date("Y-m-d H:i:s"),
            "id_municipio_documento"  => $forma_id_municipio_documento,
            "id_municipio_residencia" => $forma_id_municipio_residencia,
            "direccion_principal"     => $forma_direccion_principal,
            "telefono_principal"      => $forma_telefono_principal,
            "telefono_secundario"     => $forma_telefono_secundario,
            "fax"                     => $forma_fax,
            "celular"                 => $forma_celular,
            "correo"                  => $forma_correo,
            "sitio_web"               => $forma_sitio_web,
            "proveedor"               => '1',
            "genero"                  => $forma_genero
        );

        if (!$existe_tercero) {
            $insertar = SQL::insertar("terceros", $datos);
            /*** Error de inserci�n ***/
            if (!$insertar) {
                $error   = true;
                $mensaje = $textos["ERROR_ADICIONAR_ITEM"];
            }
            $idAsignado = SQL::$ultimoId;
        }else{
            $modificar = SQL::modificar("terceros", $datos, "id = '$idAsignado'");
            if (!$modificar) {
                $error   = false;
                $mensaje = $textos["ITEM_MODIFICADO"];
            } else {
                $error   = true;
                $mensaje = $textos["ERROR_MODIFICAR_ITEM"];
            }
        }

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
        
        if (!isset($forma_pagos_anticipados)) {
            $forma_pagos_anticipados = "0";
        }
        if (!isset($forma_pagos_efectivo)) {
            $forma_pagos_efectivo = "0";
        }
        
        /*$tabla      = "terceros";
        $columnas   = SQL::obtenerColumnas($tabla);
        $consulta   = SQL::seleccionar(array($tabla), $columnas, "documento_identidad = '$forma_documento_identidad'");
        $datos      = SQL::filaEnObjeto($consulta);
        $id_tercero = $datos->id;*/

        $datos_proveedor = array(
            "id_tercero"              => $idAsignado,
            "id_forma_pago_contado"   => $forma_id_forma_pago_contado,
            "id_forma_pago_credito"   => $forma_id_forma_pago_credito,
            "regimen"                 => $forma_regimen,
            "retiene_fuente"          => $forma_retiene_fuente,
            "autoretenedor"           => $forma_autoretenedor,
            "retiene_iva"             => $forma_retiene_iva,
            "retiene_ica"             => $forma_retiene_ica,
            "gran_contribuyente"      => $forma_gran_contribuyente,
            "id_actividad_principal"  => $forma_id_actividad_principal,
            "id_actividad_secundaria" => $forma_id_actividad_secundaria,
            "id_usuario_registra"     => $sesion_id_usuario_ingreso,
            "fecha_registra"          => date("Y-m-d H:i:s"),
            "fecha_modificacion"      => date("Y-m-d H:i:s")
        );
           
        $insertar = SQL::insertar("proveedores", $datos_proveedor);

        /*** Error de inserción ***/
        if (!$insertar) {
            $error   = true;
            $mensaje = $textos["ERROR_ADICIONAR_ITEM"];
        }
    }

    /*** Enviar datos con la respuesta del proceso al script que originï¿½ la peticiï¿½n ***/
    $respuesta    = array();
    $respuesta[0] = $error;
    $respuesta[1] = $mensaje;
    HTTP::enviarJSON($respuesta);
}
?>
