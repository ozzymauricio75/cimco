<?php

/**
*
* Copyright (C) 2008 LinuxCali Ltda
* Francisco J. Lozano B. <pacho@linuxcali.com>
* Margarita Hoyos <margarita@linuxcali.com>
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

/*** Devolver datos para cargar los elementos del formulario relacionados con el documento del cliente digitado***/
if (isset($url_recargar)) {

    if (!empty($url_documento_identidad_carga)) {

        $consulta = SQL::seleccionar(array("terceros"), array("*"), "documento_identidad = '$url_documento_identidad_carga'", "", "documento_identidad", 1);
        $tabla = array();

        if (SQL::filasDevueltas($consulta)) {
            $datos = SQL::filaEnObjeto($consulta);
            $tabla = array(
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
                $datos->id_municipio_residencia,
                $datos->direccion_principal,
                $datos->telefono_principal,
                $datos->celular,
                $datos->fax,
                $datos->correo,
                $datos->sitio_web
            );
        } else {
            $tabla[] = "";
        }
        HTTP::enviarJSON($tabla);
    }
    exit;
}

/*** ***/
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
    $error    = "";
    $titulo   = $componente->nombre;
    
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
    
    /*** Definición de pestañas para datos del tercero***/
    $formularios["PESTANA_TERCERO"] = array(
        array(
            HTML::campoTextoCorto("*documento_identidad", $textos["DOCUMENTO_TERCERO"], 15, 15, "",array("title" => $textos["AYUDA_TERCERO"],"onchange" => "cargarDatos()"))
        ),
        array(
            HTML::listaSeleccionSimple("*id_tipo_documento", $textos["TIPO_DOCUMENTO_IDENTIDAD"], HTML::generarDatosLista("tipos_documento_identidad", "id", "descripcion"))
        ),
        array(
            HTML::marcaSeleccion("tipo_persona", $textos["PERSONA_NATURAL"], 1, true, array("id" => "persona_natural", "onChange" => "activarNombres(1)")),
            HTML::marcaSeleccion("tipo_persona", $textos["PERSONA_JURIDICA"], 2, false, array("id" => "persona_juridica", "onChange" => "activarNombres(2)")),
            HTML::marcaSeleccion("tipo_persona", $textos["CODIGO_INTERNO"], 3, false, array("id" => "codigo_interno", "onChange" => "activarNombres(3)"))
        ),
        array(
            HTML::campoTextoCorto("*primer_nombre", $textos["PRIMER_NOMBRE"], 15, 15, "", array("title" => $textos["AYUDA_PRIMER_NOMBRE"], "onblur" => "validarItem(this)")),
            HTML::campoTextoCorto("segundo_nombre", $textos["SEGUNDO_NOMBRE"], 15, 15, "", array("title" => $textos["AYUDA_SEGUNDO_NOMBRE"], "onblur" => "validarItem(this)"))
        ),
        array(
            HTML::campoTextoCorto("*primer_apellido", $textos["PRIMER_APELLIDO"], 15, 15, "", array("title" => $textos["AYUDA_PRIMER_APELLIDO"], "onblur" => "validarItem(this)")),
            HTML::campoTextoCorto("segundo_apellido", $textos["SEGUNDO_APELLIDO"], 15, 15, "", array("title" => $textos["AYUDA_SEGUNDO_APELLIDO"], "onblur" => "validarItem(this)"))
        ),
        array(
            HTML::campoTextoCorto("*razon_social", $textos["RAZON_SOCIAL"], 30, 60, "", array("title" => $textos["AYUDA_RAZON_SOCIAL"], "onblur" => "validarItem(this)", "class" => "oculto")),
            HTML::campoTextoCorto("nombre_comercial", $textos["NOMBRE_COMERCIAL"], 30, 60, "", array("title" => $textos["AYUDA_NOMBRE_COMERCIAL"], "onblur" => "validarItem(this)"))
        ),
        array(
            HTML::campoTextoCorto("*selector1", $textos["MUNICIPIO"], 40, 255, "", array("title" => $textos["AYUDA_DOCUMENTO_MUNICIPIO"], "class" => "autocompletable")).HTML::campoOculto("id_municipio_documento", "")
        )
    );

    /*** Definición de pestañas para la ubicación del tercero***/
    $formularios["PESTANA_UBICACION_TERCERO"] = array(
        array(
            HTML::campoTextoCorto("*selector2", $textos["LOCALIDAD"], 50, 255, "", array("title" => $textos["AYUDA_DOCUMENTO_MUNICIPIO"], "class" => "autocompletable")).HTML::campoOculto("id_municipio_residencia", "")
        ),
        array(
            HTML::campoTextoCorto("*direccion_principal", $textos["DIRECCION"], 50, 50, "", array("title" => $textos["AYUDA_DIRECCION"]))
        ),
        array(
            HTML::campoTextoCorto("telefono_principal", $textos["TELEFONO_PRINCIPAL"], 15, 15, "", array("title" => $textos["AYUDA_TELEFONO_PRINCIPAL"])),
            HTML::campoTextoCorto("fax", $textos["FAX"], 15, 15, "", array("title" => $textos["AYUDA_FAX"])),
            HTML::campoTextoCorto("celular", $textos["CELULAR"], 20, 20, "", array("title" => $textos["AYUDA_CELULAR"]))
        ),
        array(
            HTML::campoTextoCorto("correo", $textos["CORREO"], 50, 255, "", array("title" => $textos["AYUDA_CORREO"]))
        ),
        array(
            HTML::campoTextoCorto("sitio_web", $textos["SITIO_WEB"], 50, 50, "", array("title" => $textos["AYUDA_SITIO_WEB"]))
        )
    );
    
    /*** Definicion de pestañas general ***/
    $formularios["PESTANA_GENERAL"] = array(
        array(
            HTML::campoTextoCorto("*codigo", $textos["CODIGO"], 4, 4, "", array("title" => $textos["AYUDA_CODIGO"],"onBlur" => "validarItem(this);")),
            HTML::listaSeleccionSimple("*activo", $textos["ACTIVO"], $activo, 1, array("title" => $textos["AYUDA_ACTIVO"],"onBlur" => "validarItem(this);"))
        ),
        array(
            HTML::campoTextoCorto("*razon_social_empresa", $textos["RAZON_SOCIAL"], 60, 60, "", array("title" => $textos["AYUDA_RAZON_SOCIAL"],"onBlur" => "validarItem(this);"))
        ),
        array(
            HTML::campoTextoCorto("nombre_corto", $textos["NOMBRE_CORTO"], 10, 10, "", array("title" => $textos["AYUDA_NOMBRE_CORTO"],"onBlur" => "validarItem(this);")),
            HTML::campoTextoCorto("fecha_cierre", $textos["FECHA_CIERRE"], 10, 10, "", array("class" => "selectorFecha"), array("title" => $textos["AYUDA_FECHA_CIERRE"],"onBlur" => "validarItem(this);"))
        ),
        array(
            HTML::listaSeleccionSimple("*id_actividad_principal", $textos["ACTIVIDAD_PRINCIPAL"], HTML::generarDatosLista("actividades_economicas", "id", "descripcion"), "", array("title" => $textos["AYUDA_ACTIVIDAD_PRINCIPAL"],"onBlur" => "validarItem(this);"))
        ),
        array(
            HTML::listaSeleccionSimple("*id_actividad_secundaria", $textos["ACTIVIDAD_SECUNDARIA"], HTML::generarDatosLista("actividades_economicas", "id", "descripcion"), "", array("title" => $textos["AYUDA_ACTIVIDAD_SECUNDARIA"],"onBlur" => "validarItem(this);"))
        )
    );
    
    /*** Definición pestaña tributaria ***/
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
        $existe = SQL::existeItem("empresas", "codigo", $url_valor);

        if ($existe) {
            $respuesta = $textos["ERROR_EXISTE_CODIGO"];
        }
    }
    
    /*** Validar razon social ***/
    if ($url_item == "razon_social_empresa") {
        $existe = SQL::existeItem("empresas", "razon_social", $url_valor);

        if ($existe) {
            $respuesta = $textos["ERROR_EXISTE_RAZON_SOCIAL"];
        }
    }
    
    /*** Validar nombre corto ***/
    if ($url_item == "nombre_corto" && $url_valor) {
        $existe = SQL::existeItem("empresas", "nombre_corto", $url_valor);

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

    } elseif (SQL::existeItem("empresas", "codigo", $forma_codigo, "codigo = '$forma_codigo'")) {
        $error   = true;
        $mensaje =  $textos["ERROR_EXISTE_CODIGO"];
    
    } elseif (!empty($forma_codigo) && !Cadena::validarNumeros($forma_codigo)) {
        $error   = true;
        $mensaje =  $textos["ERROR_FORMATO_CODIGO"];

    } elseif (!empty($forma_razon_social_empresa) && SQL::existeItem("empresas", "razon_social", $forma_razon_social_empresa, "codigo = '$forma_codigo'")) {
        $error   = true;
        $mensaje =  $textos["ERROR_EXISTE_RAZON_SOCIAL"];

    } elseif (!empty($forma_nombre_corto) && SQL::existeItem("empresas", "nombre_corto", $forma_nombre_corto, "codigo = '$forma_codigo'")) {
        $error   = true;
        $mensaje =  $textos["ERROR_EXISTE_NOMBRE_CORTO"];
    
    } elseif (empty($forma_codigo) || 
              empty($forma_razon_social_empresa) ||
              empty($forma_id_actividad_principal) ||
              empty($forma_id_actividad_secundaria)) {
        /*** Validar el ingreso de los datos requeridos para la empresa ***/ 
        $error   = true;
        $mensaje = $textos["ERROR_DATOS_INCOMPLETOS"];

    } elseif (SQL::existeItem("empresas", "codigo", $forma_codigo, "codigo = '$forma_codigo'")) {
        $error   = true;
        $mensaje =  $textos["ERROR_EXISTE_CODIGO"];
    
    } elseif (!empty($forma_codigo) && !Cadena::validarNumeros($forma_codigo)) {
        $error   = true;
        $mensaje =  $textos["ERROR_FORMATO_CODIGO"];

    } elseif (!empty($forma_razon_social_empresa) && SQL::existeItem("empresas", "razon_social", $forma_razon_social_empresa, "codigo = '$forma_codigo'")) {
        $error   = true;
        $mensaje =  $textos["ERROR_EXISTE_RAZON_SOCIAL"];

    } elseif (!empty($forma_nombre_corto) && SQL::existeItem("empresas", "nombre_corto", $forma_nombre_corto, "codigo = '$forma_codigo'")) {
        $error   = true;
        $mensaje =  $textos["ERROR_EXISTE_NOMBRE_CORTO"];
    
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
            "id_municipio_documento"  => $forma_id_municipio_documento,           
            "id_municipio_residencia" => $forma_id_municipio_residencia,          
            "direccion_principal"     => $forma_direccion_principal,              
            "telefono_principal"      => $forma_telefono_principal,               
            "fax"                     => $forma_fax,                              
            "celular"                 => $forma_celular,                          
            "correo"                  => $forma_correo,                           
            "sitio_web"               => $forma_sitio_web                         
        );                                           
                                                        
        if (!$existe_tercero) {
            $insertar = SQL::insertar("terceros", $datos);
            /*** Error de inserción ***/
            if (!$insertar) {
                $error   = true;
                $mensaje = $textos["ERROR_ADICIONAR_ITEM"];
            }
            $idAsignado = SQL::$ultimoId;
        }else{
            $modificar = SQL::modificar("terceros", $datos, "id = '$idAsignado'");
            if ($modificar) {
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
        $datos = array(
            "codigo"                  => $forma_codigo,
            "razon_social"            => $forma_razon_social_empresa,
            "nombre_corto"            => $forma_nombre_corto,
            "fecha_cierre"            => $forma_fecha_cierre,
            "activo"                  => $forma_activo,
            "id_tercero"              => $idAsignado,
            "id_actividad_principal"  => $forma_id_actividad_principal,
            "id_actividad_secundaria" => $forma_id_actividad_secundaria,
            "regimen"                 => $forma_regimen,                 
            "retiene_fuente"          => $forma_retiene_fuente,                   
            "autoretenedor"           => $forma_autoretenedor,                    
            "retiene_iva"             => $forma_retiene_iva,                      
            "retiene_ica"             => $forma_retiene_ica,                      
            "gran_contribuyente"      => $forma_gran_contribuyente            
        );

        $insertar = SQL::insertar("empresas", $datos);

        /*** Error de insercion ***/
        if (!$insertar) {
            $error   = true;
            $mensaje = $textos["ERROR_ADICIONAR_ITEM"];
        }
    }    

    /*** Enviar datos con la respuesta del proceso al script que origino la peticion ***/
    $respuesta    = array();
    $respuesta[0] = $error;
    $respuesta[1] = $mensaje;
    HTTP::enviarJSON($respuesta);
}
?>
