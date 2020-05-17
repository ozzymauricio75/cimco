<?php

/**
*
* Copyright (C) 2020 Raul Mauricio Oidor Lozano
* Raul Mauricio Oidor Lozano <ozzymauricio75@gmail.com>
*
* Este archivo es parte de:
* SEM :: Software empresarial a la medida
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
        $vistaConsulta = "compradores";
        $columnas      = SQL::obtenerColumnas($vistaConsulta);
        $consulta      = SQL::seleccionar(array($vistaConsulta), $columnas, "id = '$url_id'");
        $datos_comprador = SQL::filaEnObjeto($consulta);

        $vistaConsulta = "terceros";
        $columnas      = SQL::obtenerColumnas($vistaConsulta);
        $consulta      = SQL::seleccionar(array($vistaConsulta), $columnas, "id = '$datos_comprador->id_tercero'");
        $datos         = SQL::filaEnObjeto($consulta);

        $error  = "";
        $titulo = $componente->nombre;

        $municipio = explode('|',SQL::obtenerValor("seleccion_municipios","nombre","id = '$datos->id_municipio_documento'"));
        $municipio = $municipio[0];
        $localidad = explode('|',SQL::obtenerValor("seleccion_localidades","nombre","id = '$datos->id_localidad'"));
        $localidad = $localidad[0];

        $persona = array(
            "1" => $textos["PERSONA_NATURAL"],
            "2" => $textos["PERSONA_JURIDICA"],
            "3" => $textos["CODIGO_INTERNO"],
            "4" => $textos["NATURAL_COMERCIANTE"]
        );

        $activo = array(
            "0" => $textos["INACTIVO"],
            "1" => $textos["ACTIVO"]
        );

        $genero = array(
            "M" => $textos["MASCULINO"],
            "F" => $textos["FEMENINO"],
            "N" => $textos["NO_APLICA"]
        );

        $tipo_persona = SQL::obtenerValor("tipos_documento_identidad","tipo_persona","id='$datos->id_tipo_documento_identidad'");
        $nombre_completo = SQL::obtenerValor("menu_terceros","NOMBRE_COMPLETO","id='$datos->id'");
        $nombre = array(
            HTML::mostrarDato("nombre", $textos["NOMBRE_COMPLETO"], $nombre_completo)
        );

        $fecha_nacimiento = array(
            HTML::campoOculto("fecha_nacimiento", "")
        );
        if (($tipo_persona==1 || $tipo_persona==4) && $datos->fecha_nacimiento != "0000-00-00"){
            $fecha_nacimiento = array(
                HTML::mostrarDato("fecha_nacimiento", $textos["FECHA_NACIMIENTO"], $datos->fecha_nacimiento),
            );
        }

        $tipo_documento = SQL::obtenerValor("tipos_documento_identidad","descripcion","id = '".$datos->id_tipo_documento_identidad."'");

        /*** Definición de pestañas ***/
        $encabezado["PESTANA_GENERAL"] = array(
            $nombre,
            array(
                HTML::mostrarDato("tipo_persona", $textos["TIPO_PERSONA"], $persona[$tipo_persona])
            ),
            array(
                HTML::mostrarDato("tipo_documento", $textos["TIPO_DOCUMENTO_IDENTIDAD"], $tipo_documento),
                HTML::mostrarDato("documento_identidad", $textos["DOCUMENTO_IDENTIDAD"], $datos->documento_identidad),
                HTML::mostrarDato("municipio_documento", $textos["MUNICIPIO"], $municipio)
            ),
        );
        $formularios["PESTANA_GENERAL"] = array(
            $fecha_nacimiento,
            array(
                HTML::mostrarDato("localidad_residencia", $textos["LOCALIDAD"], $localidad),
            ),
            array(
                HTML::mostrarDato("direccion_principal", $textos["DIRECCION"], $datos->direccion_principal)
            ),
            array(
                HTML::mostrarDato("telefono_principal", $textos["TELEFONO"], $datos->telefono_principal),
                HTML::mostrarDato("fax", $textos["FAX"], $datos->fax),
                HTML::mostrarDato("celular", $textos["CELULAR"], $datos->celular)
            ),
            array(
                HTML::mostrarDato("correo", $textos["CORREO"], $datos->correo),
                HTML::mostrarDato("sitio_web", $textos["SITIO_WEB"], $datos->sitio_web)
            ),
            array(
                HTML::mostrarDato("correo2", $textos["CORREO2"], $datos->correo2),
                HTML::mostrarDato("celular2", $textos["CELULAR2"], $datos->celular2)
            ),
            array(
                HTML::mostrarDato("genero", $textos["GENERO"], $genero[$datos->genero]),
                HTML::mostrarDato("activo", $textos["ESTADO"], $activo[$datos_comprador->activo])
            )
        );

        if ($tipo_persona != "1" && $tipo_persona != "4"){
            $datos_pestana = array();
            if ($datos->documento_representante_legal != ""){
                $datos_pestana[] = array(
                    HTML::mostrarDato("documento_representante_legal", $textos["DOCUMENTO_REPRESENTANTE"], $datos->documento_representante_legal)
                );
            }
            if ($datos->nombre_representante_legal != ""){
                $datos_pestana[] = array(
                    HTML::mostrarDato("nombre_representante_legal", $textos["NOMBRE_REPRESENTANTE"], $datos->nombre_representante_legal)
                );
            }
            $datos_pestana[] = array(
                HTML::mostrarDato("sociedad_grupo", $textos["SOCIEDAD_GRUPO"], $textos["SI_NO_".$datos->sociedad_grupo]),
                HTML::mostrarDato("cliente_detal", $textos["CLIENTE_DETAL"], $textos["SI_NO_".$datos->cliente_detal]),
                HTML::mostrarDato("cliente_mayorista", $textos["CLIENTE_MAYORISTA"], $textos["SI_NO_".$datos->cliente_mayorista])
            );
            $datos_pestana[] = array(
                HTML::mostrarDato("filial", $textos["FILIAL"], $textos["SI_NO_".$datos->filial]),
                HTML::mostrarDato("socio", $textos["SOCIO"], $textos["SI_NO_".$datos->socio]),
                HTML::mostrarDato("empleado", $textos["EMPLEADO"], $textos["SI_NO_".$datos->empleado])
            );
            $datos_pestana[] = array(
                HTML::mostrarDato("proveedor", $textos["PROVEEDOR"], $textos["SI_NO_".$datos->proveedor]),
                HTML::mostrarDato("proveedor_servicios", $textos["PROVEEDOR_SERVICIOS"], $textos["SI_NO_".$datos->proveedor_servicios]),
                HTML::mostrarDato("entidad_oficial", $textos["ENTIDAD_OFICIAL"], $textos["SI_NO_".$datos->entidad_oficial])
            );

            if ($datos->id_actividad_principal > 0){
                $actividad_principal = SQL::obtenerValor("actividades_economicas", "descripcion", "id = '$datos->id_actividad_principal'");
                $titulo_actividad_principal = $textos["ACTIVIDAD_PRINCIPAL"];
                $datos_pestana[] = array(
                    HTML::mostrarDato("actividad_primaria", $textos["ACTIVIDAD_PRINCIPAL"], $actividad_principal)
                );
            }
            if ($datos->id_actividad_secundaria > 0){
                $actividad_secundaria = SQL::obtenerValor("actividades_economicas", "descripcion", "id = '$datos->id_actividad_secundaria'");
                $titulo_actividad_secundaria = $textos["ACTIVIDAD_SECUNDARIA"];
                $datos_pestana[] = array(
                    HTML::mostrarDato("actividad_secundaria", $textos["ACTIVIDAD_SECUNDARIA"], $actividad_secundaria)
                );
            }
            $formularios["PESTANA_TRIBUTARIA"] = array();
            $formularios["PESTANA_TRIBUTARIA"] = array_merge($formularios["PESTANA_TRIBUTARIA"],$datos_pestana);
        }

        $consulta_grupos = SQL::seleccionar(array("compradores_grupo_compradores"),array("id","id_grupo_comprador"),"id_comprador='$datos_comprador->id'");
        if (SQL::filasDevueltas($consulta_grupos)){
            while($datos_grupos = SQL::filaEnObjeto($consulta_grupos)){
                $grupo_comprador = SQL::obtenerValor("grupo_compradores","descripcion","id='$datos_grupos->id_grupo_comprador'");
                $grupos[] = array(
                    $datos_grupos->id,
                    $grupo_comprador
                );
            }
        }
        if (isset($grupos)){
            $formularios["PESTANA_GRUPO_COMPRADORES"] = array(
                array(
                    HTML::generarTabla(
                        array("id","GRUPO_COMPRADOR"),
                        $grupos,
                        array("I"),
                        "listaGrupos",
                        false
                    )
                )
            );
        }

        $contenido = HTML::generarPestanas($formularios,"","","",$encabezado);
    }

    /*** Enviar datos para la generación del formulario al script que originó la petición ***/
    $respuesta    = array();
    $respuesta[0] = $error;
    $respuesta[1] = $titulo;
    $respuesta[2] = $contenido;
    HTTP::enviarJSON($respuesta);
}
?>
