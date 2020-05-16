<?php

/**
*
* Copyright (C) 2008 LinuxCali Ltda
* Francisco J. Lozano B. <pacho@linuxcali.com>
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

    /*** Verificar que se haya enviado el ID del elemento a eliminar ***/
    if (empty($url_id)) {
        $error     = $textos["ERROR_ELIMINAR_VACIO"];
        $titulo    = "";
        $contenido = "";

    } else {
        $vistaConsulta = "buscador_empresas";
        $columnas      = SQL::obtenerColumnas($vistaConsulta);
        $consulta      = SQL::seleccionar(array($vistaConsulta), $columnas, "id = '$url_id'");
        $datos         = SQL::filaEnObjeto($consulta);
        $error         = "";
        $titulo        = $componente->nombre;

        $activo = array(
            "0" => $textos["ESTADO_ACTIVA"],
            "1" => $textos["ESTADO_INACTIVA"]
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
        $id_tercero              = SQL::obtenerValor("empresas", "id_tercero", "id = '$url_id'");
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
        $vistaTercero    = "terceros";
        $columnasTercero = SQL::obtenerColumnas($vistaTercero);
        $consultaTercero = SQL::seleccionar(array($vistaTercero), $columnasTercero, "id = '$id_tercero'");
        $datosTercero    = SQL::filaEnObjeto($consultaTercero);
        if(($datosTercero->tipo_persona) == 1){
            $primer_nombre    = "PRIMER_NOMBRE";
            $segundo_nombre   = "SEGUNDO_NOMBRE";
            $primer_apellido  = "PRIMER_APELLIDO";
            $segundo_apellido = "SEGUNDO_APELLIDO";
            $razon_social     = "DATO_VACIO";
        }else{
            $razon_social     = "RAZON_SOCIAL";
            $primer_nombre    = "DATO_VACIO";
            $segundo_nombre   = "DATO_VACIO";
            $primer_apellido  = "DATO_VACIO";
            $segundo_apellido = "DATO_VACIO";
        }
        $descripcion_tipo_documento     = SQL::obtenerValor("tipos_documento_identidad", "descripcion", "id = '$datosTercero->id_tipo_documento'");
        $nombre_municipio_documento     = SQL::obtenerValor("municipios", "nombre", "id = '$datosTercero->id_municipio_documento'");
        $departamento_documento         = SQL::obtenerValor("municipios", "id_departamento", "id = '$datosTercero->id_municipio_documento'");
        $nombre_departamento_documento  = SQL::obtenerValor("departamentos", "nombre", "id = '$departamento_documento'");
        $pais_documento                 = SQL::obtenerValor("departamentos", "id_pais", "id = '$departamento_documento'");
        $nombre_pais_documento          = SQL::obtenerValor("paises", "nombre", "id = '$pais_documento'");
        $nombre_localidad_residencia    = SQL::obtenerValor("localidades", "nombre", "id = '$datosTercero->id_municipio_residencia'");
        $municipio_residencia           = SQL::obtenerValor("localidades", "id_municipio", "id = '$datosTercero->id_municipio_residencia'");
        $nombre_municipio_residencia    = SQL::obtenerValor("municipios", "nombre", "id = '$municipio_residencia'");
        $departamento_residencia        = SQL::obtenerValor("municipios", "id_departamento", "id = '$municipio_residencia'");
        $nombre_departamento_residencia = SQL::obtenerValor("departamentos", "nombre", "id = '$departamento_residencia'");
        $pais_residencia                = SQL::obtenerValor("departamentos", "id_pais", "id = '$departamento_residencia'");
        $nombre_pais_residencia         = SQL::obtenerValor("paises", "nombre", "id = '$pais_residencia'");

         /*** Definición de pestañas ***/
        $formularios["PESTANA_TERCERO"] = array(
            array(
                HTML::mostrarDato("documento_identidad", $textos["DOCUMENTO_TERCERO"], $datosTercero->documento_identidad)
            ),
            array(
                HTML::mostrarDato("tipo_persona", $textos["TIPO_PERSONA"], $tipo_persona[$datosTercero->tipo_persona]),
                HTML::mostrarDato("descripcion_tipo_documento", $textos["TIPO_DOCUMENTO_IDENTIDAD"], $descripcion_tipo_documento)
            ),
            array(
                HTML::mostrarDato("primer_nombre", $textos["$primer_nombre"], $datosTercero->primer_nombre),
                HTML::mostrarDato("segundo_nombre", $textos["$segundo_nombre"], $datosTercero->segundo_nombre),
                HTML::mostrarDato("primer_apellido", $textos["$primer_apellido"], $datosTercero->primer_apellido),
                HTML::mostrarDato("segusndo_apellido", $textos["$segundo_apellido"], $datosTercero->segundo_apellido)
            ),
            array(
                HTML::mostrarDato("razon_social", $textos["$razon_social"], $datosTercero->razon_social)
            ),
            array(
                HTML::mostrarDato("nombre_comercial", $textos["NOMBRE_COMERCIAL"], $datosTercero->nombre_comercial)
            ),
            array(
                HTML::mostrarDato("pais_documento", $textos["PAIS"], $nombre_pais_documento),
                HTML::mostrarDato("departamento_documento", $textos["DEPARTAMENTO"], $nombre_departamento_documento),
                HTML::mostrarDato("municipio_documento", $textos["MUNICIPIO"], $nombre_municipio_documento),
            )
        );

        /***Definición pestaña ubicacion***/
        $formularios["PESTANA_UBICACION_TERCERO"] = array(
            array(
                HTML::mostrarDato("pais_residencia", $textos["PAIS"], $nombre_pais_residencia),
                HTML::mostrarDato("departamento_residencia", $textos["DEPARTAMENTO"], $nombre_departamento_residencia)
            ),
            array(
                HTML::mostrarDato("municipio_residencia", $textos["MUNICIPIO"], $nombre_municipio_residencia),
                HTML::mostrarDato("localidad_residencia", $textos["LOCALIDAD"], $nombre_localidad_residencia)
            ),
            array(
                HTML::mostrarDato("direccion_principal", $textos["DIRECCION"], $datosTercero->direccion_principal),
                HTML::mostrarDato("telefono_principal", $textos["TELEFONO_PRINCIPAL"], $datosTercero->telefono_principal),
                HTML::mostrarDato("fax", $textos["FAX"], $datosTercero->fax),
                HTML::mostrarDato("celular", $textos["CELULAR"], $datosTercero->celular)
            ),
            array(
                HTML::mostrarDato("correo", $textos["CORREO"], $datosTercero->correo),
                HTML::mostrarDato("sitio_web", $textos["SITIO_WEB"], $datosTercero->sitio_web)
            )
        );

        /*** Definición pestaña empresa ***/
        $formularios["PESTANA_GENERAL"] = array(
            array(
                HTML::mostrarDato("codigo", $textos["CODIGO"],$datos->codigo)
            ),
            array(
                HTML::mostrarDato("razon_social", $textos["RAZON_SOCIAL"],$datos->razon_social)
            ),
            array(
                HTML::mostrarDato("nombre_corto", $textos["NOMBRE_CORTO"],$datos->nombre_corto)
            ),
            array(
                HTML::mostrarDato("actividad_principal", $textos["ACTIVIDAD_PRINCIPAL"], $actividad_principal)
            ),
            array(
                HTML::mostrarDato("actividad_secundaria", $textos["ACTIVIDAD_SECUNDARIA"], $actividad_secundaria)
            ),
            array(
                HTML::mostrarDato("fecha_cierre", $textos["FECHA_CIERRE"], $fecha_cierre),
                HTML::mostrarDato("activo", $textos["ACTIVO"], $textos["ACTIVO_".intval($activo)])
            )
        );
        /*** Definición pestaña empresa ***/
        $formularios["PESTANA_TRIBUTARIA"] = array(
            array(
                HTML::mostrarDato("regimen", $textos["REGIMEN"], $regimen[$regimen_tabla])
            ),
            array(
                HTML::mostrarDato("retiene_fuente", $textos["RETIENE_FUENTE"], $textos["SI_NO_".intval($retiene_fuente)])
            ),
            array(
                HTML::mostrarDato("autoretenedor", $textos["AUTORETENEDOR"], $textos["SI_NO_".intval($autoretenedor)])
            ),
            array(
                HTML::mostrarDato("retiene_iva", $textos["RETIENE_IVA"], $textos["SI_NO_".intval($retiene_iva)])
            ),
            array(
                HTML::mostrarDato("retiene_ica", $textos["RETIENE_ICA"], $textos["SI_NO_".intval($retiene_ica)])
            ),
            array(
                HTML::mostrarDato("gran_contribuyente", $textos["GRAN_CONTRIBUYENTE"], $textos["SI_NO_".intval($gran_contribuyente)])
            )
        );

        /*** Definición de botones ***/
        $botones = array(
            HTML::boton("botonAceptar", $textos["ACEPTAR"], "eliminarItem('$url_id');", "aceptar")
        );

        $contenido = HTML::generarPestanas($formularios, $botones);
    }

    /*** Enviar datos para la generación del formulario al script que originó la petición ***/
    $respuesta    = array();
    $respuesta[0] = $error;
    $respuesta[1] = $titulo;
    $respuesta[2] = $contenido;
    HTTP::enviarJSON($respuesta);

/*** Eliminar el elemento seleccionado ***/
} elseif (!empty($forma_procesar)) {
    $id_tercero = SQL::obtenerValor("empresas", "id_tercero", "id = '$forma_id'");
    $consulta   = SQL::eliminar("empresas", "id = '$forma_id'");

    if ($consulta) {
        $error   = false;
        $mensaje = $textos["ITEM_ELIMINADO"];
    } else {
        $error   = true;
        $mensaje = $textos["ERROR_ELIMINAR_ITEM"];
    }

    $consulta   = SQL::eliminar("terceros", "id = '$id_tercero'");

    /*** Enviar datos con la respuesta del proceso al script que originó la petición ***/
    $respuesta    = array();
    $respuesta[0] = $error;
    $respuesta[1] = $mensaje;
    HTTP::enviarJSON($respuesta);
}
?>
