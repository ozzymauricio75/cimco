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

// Devolver datos para autocompletar la búsqueda
if(isset($url_completar)){
    if(($url_item) == "selector1"){
        echo SQL::datosAutoCompletar("seleccion_municipios", $url_q);
    }
    if($url_item == "selector2"){
        echo SQL::datosAutoCompletar("seleccion_localidades", $url_q);
    }
    exit;
}

if(isset($url_tipo_persona)){
    $tipo_persona = SQL::obtenervalor("tipos_documento_identidad","tipo_persona","id='$url_id_tipo_documento_identidad'");
    if (!$tipo_persona){
        $tipo_persona = "";
    }
    HTTP::enviarJSON($tipo_persona);
    exit;
}

if (isset($url_recargarActividad)){

    $id_municipio = SQL::obtenerValor("localidades","id_municipio","id='$url_id_localidad'");
    $id_departamento = SQL::obtenerValor("municipios","id_departamento","id='$id_municipio'");
    $id_pais = SQL::obtenerValor("departamentos","id_pais","id='$id_departamento'");
    $consulta     = SQL::seleccionar(array("actividades_economicas"),array("*"),"id_pais='$id_pais'");
    echo SQL::datosAutoCompletar("seleccion_actividades_economicas", $url_q, "id_pais='$id_pais'");
    exit;
}
if (isset($url_cargar_datos_tercero)){
    $consulta = SQL::seleccionar(array("terceros"),array("*"),"documento_identidad='$url_documento_identidad'");
    if (SQL::filasDevueltas($consulta)){

        $datos_tercero = SQL::filaEnObjeto($consulta);
        $condicion = "id_tercero='$datos_tercero->id'";
        if (!empty($url_id_comprador)){
            $condicion .= " AND id!='$url_id_comprador'";
        }
        $id_comprador = SQL::obtenerValor("compradores","id",$condicion);
        if (!$id_comprador){
            $datos = array();
            if ($datos_tercero->activo =="1"){
                $datos[] = "inactivo";
            } else {
                $tipo_persona = SQL::obtenerValor("tipos_documento_identidad","tipo_persona","id='$datos_tercero->id_tipo_documento_identidad'");
                $municipio = explode('|',SQL::obtenerValor("seleccion_municipios","nombre","id = '$datos_tercero->id_municipio_documento'"));
                $localidad = explode('|',SQL::obtenerValor("seleccion_localidades","nombre","id = '$datos_tercero->id_localidad'"));
                $actividad_principal  = explode('|',SQL::obtenerValor("seleccion_actividades_economicas","descripcion","id = '$datos_tercero->id_actividad_principal'"));
                $actividad_secundaria = explode('|',SQL::obtenerValor("seleccion_actividades_economicas","descripcion","id = '$datos_tercero->id_actividad_secundaria'"));
                $datos = array(
                    $tipo_persona,
                    $datos_tercero->id_tipo_documento_identidad,
                    $municipio[0],
                    $datos_tercero->id_municipio_documento,
                    $localidad[0],
                    $datos_tercero->id_localidad,
                    $datos_tercero->direccion_principal,
                    $datos_tercero->telefono_principal,
                    $datos_tercero->celular,
                    $datos_tercero->celular2,
                    $datos_tercero->fax,
                    $datos_tercero->correo2,
                    $datos_tercero->sitio_web,
                    $datos_tercero->primer_nombre,
                    $datos_tercero->segundo_nombre,
                    $datos_tercero->primer_apellido,
                    $datos_tercero->segundo_apellido,
                    $datos_tercero->fecha_nacimiento,
                    $datos_tercero->genero,
                    $actividad_principal[0],
                    $datos_tercero->id_actividad_principal,
                    $actividad_secundaria[0],
                    $datos_tercero->id_actividad_secundaria,
                    $datos_tercero->razon_social,
                    $datos_tercero->nombre_comercial,
                    $datos_tercero->documento_representante_legal,
                    $datos_tercero->nombre_representante_legal,
                    $datos_tercero->sociedad_grupo,
                    $datos_tercero->cliente_detal,
                    $datos_tercero->cliente_mayorista,
                    $datos_tercero->filial,
                    $datos_tercero->socio,
                    $datos_tercero->empleado,
                    $datos_tercero->proveedor,
                    $datos_tercero->proveedor_servicios,
                    $datos_tercero->entidad_oficial
                );
            }
        } else {
            $datos[] = "existe";
        }
    } else {
        $datos = false;
    }
    HTTP::enviarJSON($datos);
    exit;
}

if (isset($url_verificar_grupo)){
    if ($url_id_comprador >0){
        $existe = SQL::existeItem("compradores_grupo_compradores","id_grupo_comprador",$url_id_grupo_comprador,"id_comprador='$url_id_comprador'");
        if ($existe){
            $respuesta[] = false;
            $respuesta[] = $textos["EXISTE_GRUPO_COMPRADOR"];
        } else {
            $respuesta[] = true;
            $respuesta[] = SQL::obtenerValor("grupo_compradores","descripcion","id='$url_id_grupo_comprador'");
            $datos = array(
                "id_comprador" => $url_id_comprador,
                "id_grupo_comprador" => $url_id_grupo_comprador
            );
            $insertar = SQL::insertar("compradores_grupo_compradores",$datos);
        }
    } else {
        $respuesta[] = true;
        $respuesta[] = SQL::obtenerValor("grupo_compradores","descripcion","id='$url_id_grupo_comprador'");
    }
    HTTP::enviarJSON($respuesta);
    exit;
}

if (isset($url_elimina_movimiento)){
    $respuesta[0] = true;
    $url_id_grupo_comprador = str_replace("fila_","",$url_id_grupo_comprador);
    if ($url_id_comprador > 0){
        $eliminar = SQL::eliminar("compradores_grupo_compradores","id_comprador='$url_id_comprador' AND id_grupo_comprador='$url_id_grupo_comprador'");
        if (!$eliminar){
            $respuesta[0] = false;
            $respuesta[1] = $textos["ERROR_ELIMINAR_ITEM"];
        }
    }
    HTTP::enviarJSON($respuesta);
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
        $vistaConsulta = "compradores";
        $columnas        = SQL::obtenerColumnas($vistaConsulta);
        $consulta        = SQL::seleccionar(array($vistaConsulta), $columnas, "id = '$url_id'");
        $datos_comprador = SQL::filaEnObjeto($consulta);

        $vistaConsulta = "terceros";
        $columnas      = SQL::obtenerColumnas($vistaConsulta);
        $consulta      = SQL::seleccionar(array($vistaConsulta), $columnas, "id = '$datos_comprador->id_tercero'");
        $datos         = SQL::filaEnObjeto($consulta);

        $error         = "";
        $titulo        = $componente->nombre;

        $municipio       = explode('|',SQL::obtenerValor("seleccion_municipios","nombre","id = '$datos->id_municipio_documento'"));
        $localidad       = explode('|',SQL::obtenerValor("seleccion_localidades","nombre","id = '$datos->id_localidad'"));
        if ($datos->id_actividad_principal >0){
            $actividad_principal  = explode('|',SQL::obtenerValor("seleccion_actividades_economicas","descripcion","id = '$datos->id_actividad_principal'"));
        } else {
            $actividad_principal[0] = "";
            $actividad_principal[1] = "0";
        }

        if ($datos->id_actividad_secundaria >0){
            $actividad_secundaria = explode('|',SQL::obtenerValor("seleccion_actividades_economicas","descripcion","id = '$datos->id_actividad_secundaria'"));
        } else {
            $actividad_secundaria[0] = "";
            $actividad_secundaria[1] = "0";
        }

        $tipo_persona = SQL::obtenerValor("tipos_documento_identidad","tipo_persona","id='$datos->id_tipo_documento_identidad'");
        if($tipo_persona=='1'){
            $nombres   = "";
            $razon     = "oculto";
            $comercial = "oculto";
            $digito    = "oculto";
            $genero    = "";
            $fecha_nacimiento = "";
        }elseif($tipo_persona=='2'){
            $nombres   = "oculto";
            $razon     = "";
            $comercial = "";
            $digito    = "";
            $genero    = "oculto";
            $fecha_nacimiento = "oculto";
        }elseif($tipo_persona=='3'){
            $nombres   = "oculto";
            $razon     = "";
            $comercial = "";
            $digito    = "";
            $genero    = "";
            $fecha_nacimiento = "oculto";
        }elseif($tipo_persona=='4'){
            $nombres   = "";
            $razon     = "oculto";
            $comercial = "";
            $digito    = "";
            $genero    = "oculto";
            $fecha_nacimiento = "oculto";
        }

        if($datos->genero=='M'){
            $masculino = true;
            $femenino  = false;
        }elseif($datos->genero=='F'){
            $masculino = false;
            $femenino  = true;
        }elseif($datos->genero=='N'){
            $masculino = false;
            $femenino  = false;
        }

        $activo = array(
            "0" => $textos["INACTIVO"],
            "1" => $textos["ACTIVO"]
        );

        $digito_verificacion = Cadena::digitoVerficacion((int)$datos->documento_identidad);

        /*** Definición de pestañas ***/
        $formularios["PESTANA_GENERAL"] = array(
            array(
                HTML::campoTextoCorto("*documento_identidad", $textos["DOCUMENTO_IDENTIDAD"], 15, 12, $datos->documento_identidad,array("title" => $textos["AYUDA_DOCUMENTO_IDENTIDAD"],"onblur" => "cargarDatos()","onChange"=>"calcularDV(this)", "onKeyPress"=>"return campoEntero(event)")),
                HTML::campoTextoCorto("digito_verificacion", $textos["DIGITO_VERIFICACION"], 1, 1, $digito_verificacion ,array("class"=>$digito,"readOnly" => "true")),
            ),
            array(
                HTML::listaSeleccionSimple("*id_tipo_documento_identidad", $textos["TIPO_DOCUMENTO_IDENTIDAD"], HTML::generarDatosLista("tipos_documento_identidad", "id", "descripcion","id>=0"),$datos->id_tipo_documento_identidad,array("title" => $textos["AYUDA_TIPO_DOCUMENTO"], "onChange" => "activarNombres()")),
                HTML::campoTextoCorto("*selector1", $textos["MUNICIPIO"], 32, 255, $municipio[0], array("title" => $textos["AYUDA_MUNICIPIO_DOCUMENTO"], "class" => "autocompletable"))
                .HTML::campoOculto("id_municipio_documento", $municipio[1])
            ),
            array(
                HTML::campoTextoCorto("*primer_nombre", $textos["PRIMER_NOMBRE"], 20, 15, $datos->primer_nombre, array("title" => $textos["AYUDA_PRIMER_NOMBRE"],"class" => $nombres)),
                HTML::campoTextoCorto("segundo_nombre", $textos["SEGUNDO_NOMBRE"], 20, 15, $datos->segundo_nombre, array("title" => $textos["AYUDA_SEGUNDO_NOMBRE"],"class" => $nombres))
            ),
            array(
                HTML::campoTextoCorto("*primer_apellido", $textos["PRIMER_APELLIDO"], 20, 20, $datos->primer_apellido, array("title" => $textos["AYUDA_PRIMER_APELLIDO"],"class" => $nombres)),
                HTML::campoTextoCorto("segundo_apellido", $textos["SEGUNDO_APELLIDO"], 20, 20, $datos->segundo_apellido, array("title" => $textos["AYUDA_SEGUNDO_APELLIDO"],"class" => $nombres))
            ),
            array(
                HTML::campoTextoCorto("fecha_nacimiento", $textos["FECHA_NACIMIENTO"], 10, 10, $datos->fecha_nacimiento, array("title" => $textos["AYUDA_FECHA_NACIMIENTO"], "class" => "fechaAntigua $fecha_nacimiento"))
            ),
            array(
                HTML::mostrarDato("nombre_genero", $textos["GENERO"], "","",array("class"=>$genero)),
                HTML::contenedor(
                    HTML::marcaSeleccion("genero", $textos["MASCULINO"], 'M', $masculino, array("id" => "genero_masculino", "class">=$genero)).
                    HTML::marcaSeleccion("genero", $textos["FEMENINO"], 'F', $femenino, array("id" => "genero_femenino", "class">=$genero)),
                    array("id"=>"seleccion_genero","class"=>$genero)
                )
            ),
            array(
                HTML::campoTextoCorto("*razon_social", $textos["RAZON_SOCIAL"], 47, 255, $datos->razon_social, array("title" => $textos["AYUDA_RAZON_SOCIAL"],"class" => $razon)),
                HTML::campoTextoCorto("nombre_comercial", $textos["NOMBRE_COMERCIAL"], 47,255,$datos->nombre_comercial, array("title" => $textos["AYUDA_NOMBRE_COMERCIAL"],"class" => $comercial))
            ),
            array(
                HTML::listaSeleccionSimple("activo", $textos["ESTADO"], $activo,$datos_comprador->activo,array("title" => $textos["AYUDA_ESTADO"]))
            ),
            array(
                HTML::campoOculto("id_comprador",$url_id),
                HTML::campoOculto("mensaje_tercero_inactivo",$textos["MENSAJE_TERCERO_INACTIVO"]),
                HTML::campoOculto("mensaje_comprador_existe",$textos["ERROR_COMPRADOR_EXISTE"]),
                HTML::campoOculto("id_tercero_anterior",$datos_comprador->id_tercero),
                HTML::campoOculto("activo_anterior",$datos_comprador->activo)
            )
        );
        $formularios["PESTANA_PERSONAL"] = array(
            array(
                HTML::campoTextoCorto("*selector2", $textos["LOCALIDAD"], 30, 255, $localidad[0], array("title" => $textos["AYUDA_LOCALIDAD"], "class" => "autocompletable"))
                .HTML::campoOculto("id_localidad", $localidad[1])
            ),
            array(
                HTML::campoTextoCorto("direccion_principal", $textos["DIRECCION"], 30, 50, $datos->direccion_principal, array("title" => $textos["AYUDA_DIRECCION"]))
            ),
            array(
                HTML::campoTextoCorto("telefono_principal", $textos["TELEFONO"], 19, 15, $datos->telefono_principal, array("title" => $textos["AYUDA_TELEFONO"])),
                HTML::campoTextoCorto("fax", $textos["FAX"], 19, 20, $datos->fax, array("title" => $textos["AYUDA_FAX"])),
                HTML::campoTextoCorto("celular", $textos["CELULAR"], 19, 20, $datos->celular, array("title" => $textos["AYUDA_CELULAR"]))
            ),
            array(
                HTML::campoTextoCorto("correo", $textos["CORREO"], 31, 255, $datos->correo, array("title" => $textos["AYUDA_CORREO"])),
                HTML::campoTextoCorto("sitio_web", $textos["SITIO_WEB"], 31, 50, $datos->sitio_web, array("title" => $textos["AYUDA_SITIO_WEB"]))
            ),
            array(
                HTML::campoTextoCorto("correo2", $textos["CORREO2"], 31, 255, $datos->correo2, array("title" => $textos["AYUDA_CORREO"])),
                HTML::campoTextoCorto("celular2", $textos["CELULAR2"], 31, 50, $datos->celular2, array("title" => $textos["AYUDA_CELULAR"]))
            )
        );
        if ($tipo_persona==2){
            $opciones["PESTANA_TRIBUTARIA"] = array("id"=>"LI_PESTANA_TRIBUTARIA");
        } else {
            $opciones["PESTANA_TRIBUTARIA"] = array("id"=>"LI_PESTANA_TRIBUTARIA","class"=>"oculto");
        }
        $formularios["PESTANA_TRIBUTARIA"] = array(
            array(
                HTML::campoTextoCorto("documento_representante_legal",$textos["DOCUMENTO_REPRESENTANTE"], 15, 15, $datos->documento_representante_legal, array("title"=>$textos["AYUDA_DOCUMENTO_REPRESENTANTE"], "onKeyPress"=>"return campoEntero(event)"))
            ),
            array(
                HTML::campoTextoCorto("nombre_representante_legal",$textos["NOMBRE_REPRESENTANTE"], 30, 255, $datos->nombre_representante_legal, array("title"=>$textos["AYUDA_NOMBRE_REPRESENTANTE"]))
            ),
            array(
                HTML::campoTextoCorto("selector3", $textos["ACTIVIDAD_PRINCIPAL"], 50, 255, $actividad_principal[0], array("title" => $textos["AYUDA_ACTIVIDAD_PRINCIPAL"], "onFocus" => "recargarActividades(this)", "onKeyUp"=>"limpiar_oculto_Autocompletable(selector3, id_actividad_principal)"))
                .HTML::campoOculto("id_actividad_principal", $actividad_principal[1]),
            ),
            array(
                HTML::campoTextoCorto("selector4", $textos["ACTIVIDAD_SECUNDARIA"], 50, 255, $actividad_secundaria[0], array("title" => $textos["AYUDA_ACTIVIDAD_SECUNDARIA"], "onFocus" => "recargarActividades(this)", "onKeyUp"=>"limpiar_oculto_Autocompletable(selector4, id_actividad_secundaria)"))
                .HTML::campoOculto("id_actividad_secundaria", $actividad_secundaria[1]),
            ),
            array(
                HTML::marcaChequeo("sociedad_grupo",$textos["SOCIEDAD_GRUPO"], 1, $datos->sociedad_grupo, array("title"=>$textos["AYUDA_SOCIEDAD_GRUPO"])),
                HTML::marcaChequeo("cliente_detal",$textos["CLIENTE_DETAL"], 1, $datos->cliente_detal, array("title"=>$textos["AYUDA_CLIENTE_DETAL"])),
                HTML::marcaChequeo("cliente_mayorista",$textos["CLIENTE_MAYORISTA"], 1, $datos->cliente_mayorista, array("title"=>$textos["AYUDA_CLIENTE_MAYORISTA"]))
            ),
            array(
                HTML::marcaChequeo("filial",$textos["FILIAL"], 1, $datos->filial, array("title"=>$textos["AYUDA_FILIAL"])),
                HTML::marcaChequeo("socio",$textos["SOCIO"], 1, $datos->socio, array("title"=>$textos["AYUDA_SOCIO"])),
                HTML::marcaChequeo("empleado",$textos["EMPLEADO"], 1, $datos->empleado, array("title"=>$textos["AYUDA_EMPLEADO"]))
            ),
            array(
                HTML::marcaChequeo("proveedor",$textos["PROVEEDOR"], 1, $datos->proveedor, array("title"=>$textos["AYUDA_PROVEEDOR"])),
                HTML::marcaChequeo("proveedor_servicios",$textos["PROVEEDOR_SERVICIOS"], 1, $datos->proveedor_servicios, array("title"=>$textos["AYUDA_PROVEEDOR_SERVICIOS"])),
                HTML::marcaChequeo("entidad_oficial",$textos["ENTIDAD_OFICIAL"], 1, $datos->entidad_oficial, array("title"=>$textos["AYUDA_ENTIDAD_OFICIAL"]))
            )
        );

        $lista_grupos = HTML::generarDatosLista("grupo_compradores","id","descripcion","id>0");
        if ($lista_grupos){
            $consulta_grupos = SQL::seleccionar(array("compradores_grupo_compradores"),array("id","id_grupo_comprador"),"id_comprador='$datos_comprador->id'");
            if (SQL::filasDevueltas($consulta_grupos)){
                while($datos_grupos = SQL::filaEnObjeto($consulta_grupos)){
                    $grupo_comprador = SQL::obtenerValor("grupo_compradores","descripcion","id='$datos_grupos->id_grupo_comprador'");
                    $oculto   = HTML::campoOculto("id_grupo_comprador_tabla[$datos_grupos->id_grupo_comprador]",$datos_grupos->id_grupo_comprador);
                    $remover  = HTML::boton("botonRemover", "", "remover(this);", "eliminar", array("title" => $textos["REMOVER"]));
                    $grupos[] = array(
                        $datos_grupos->id_grupo_comprador,
                        $oculto.$remover,
                        $grupo_comprador
                    );
                }
            } else {
                $grupos = "";
            }
            $formularios["PESTANA_GRUPO_COMPRADORES"] = array(
                array(
                    HTML::listaSeleccionSimple("id_grupo_comprador",$textos["GRUPO_COMPRADOR"], $lista_grupos, "", array("title"=>$textos["AYUDA_GRUPO_COMPRADOR"]))
                ),
                array(
                    HTML::boton("botonAgregar", $textos["AGREGAR"], "agregar();", "adicionar","","etiqueta"),
                    HTML::contenedor(
                        HTML::boton("botonRemover", "", "remover(this);", "eliminar"),
                        array("id" => "remover", "style" => "display: none")
                    )
                ),
                array(
                    HTML::campoOculto("datos_incompletos",""),
                    HTML::campoOculto("existe_grupo_comprador",$textos["EXISTE_GRUPO_COMPRADOR"]),
                    HTML::campoOculto("id_comprador",0),
                    HTML::campoOculto("cambios_registro",0)
                ),
                array(
                    HTML::generarTabla(
                        array("id","","GRUPO_COMPRADOR"),
                        $grupos,
                        array("I","I"),
                        "listaGrupos",
                        false
                    )
                ),
                array(
                    HTML::campoOculto("id_comprador",$datos_comprador->id)
                )
            );
        }
        /*** Definición de botones ***/
        $botones = array(
            HTML::boton("botonAceptar", $textos["ACEPTAR"], "modificarItem('".$url_id."');", "aceptar")
        );

        $contenido = HTML::generarPestanas($formularios, $botones, "", "", "", $opciones);
    }

    /*** Enviar datos para la generación del formulario al script que originó la petición ***/
    $respuesta    = array();
    $respuesta[0] = $error;
    $respuesta[1] = $titulo;
    $respuesta[2] = $contenido;
    HTTP::enviarJSON($respuesta);

} else if (!empty($forma_procesar)) {
    /*** Asumir por defecto que no hubo error ***/
    $error   = false;
    $mensaje = $textos["ITEM_MODIFICADO"];
    $id_tercero = SQL::obtenerValor("terceros","id","documento_identidad='$forma_documento_identidad'");
    $crear_tercero = false;
    $forma_selector1 = utf8_decode($forma_selector1);
    $forma_selector2 = utf8_decode($forma_selector2);
    $tipo_persona = SQL::obtenervalor("tipos_documento_identidad","tipo_persona","id='$forma_id_tipo_documento_identidad'");
    if (!$tipo_persona){
        $tipo_persona = "3";
    }

    if(empty($forma_documento_identidad)){
        $error   = true;
        $mensaje = $textos["ERROR_DOCUMENTO_IDENTIDAD_VACIO"];

    }elseif($id_tercero && SQL::existeItem("compradores","id_tercero",$id_tercero,"id!='$forma_id'")){
        $error   = true;
        $mensaje = $textos["ERROR_COMPRADOR_EXISTE"];

    }elseif(empty($forma_selector1)){
        $error   = true;
        $mensaje = $textos["ERROR_MUNICIPIO_EXPEDICION_VACIO"];

    }elseif(empty($forma_selector2)){
        $error   = true;
        $mensaje = $textos["ERROR_BARRIO_CORREGIMIENTO_VACIO"];

    } else if(empty($forma_id_tipo_documento_identidad)){
        $error   = true;
        $mensaje = $textos["ERROR_TIPO_DOCUMENTO_IDENTIDAD_VACIO"];

    }elseif(($tipo_persona=='1' || $tipo_persona=='4') && (empty($forma_primer_nombre) || empty($forma_primer_apellido))){
        $error   = true;
        $mensaje = $textos["ERROR_NOMBRE_APELLIDO_VACIO"];

    }elseif(($tipo_persona=='2' || $tipo_persona=='3') && empty($forma_razon_social)){
        $error   = true;
        $mensaje = $textos["ERROR_RAZON_SOCIAL_VACIO"];

    }elseif(($tipo_persona=='2' || $tipo_persona=='3') && !empty($forma_razon_social) && SQL::existeItem("terceros","razon_social",$forma_razon_social,"razon_social!='' AND documento_identidad!='$forma_documento_identidad'")){
        $error   = true;
        $mensaje = $textos["ERROR_EXISTE_SOCIAL_VACIO"];

    }elseif(!empty($forma_correo) && !Cadena::validarCorreo($forma_correo)) {
        $error   = true;
        $mensaje =  $textos["ERROR_SINTAXIS_CORREO"];

    }elseif(!empty($forma_correo2) && !Cadena::validarCorreo($forma_correo2)) {
        $error   = true;
        $mensaje =  $textos["ERROR_SINTAXIS_CORREO"];

    }else {
        // Insertar datos

        if(empty($forma_nombre_comercial)){
            $forma_nombre_comercial = "";
        }
        if(empty($forma_razon_social)){
            $forma_razon_social = "";
        }
        if(empty($forma_primer_nombre)){
            $forma_primer_nombre = "";
        }
        if(empty($forma_segundo_nombre)){
            $forma_segundo_nombre = "";
        }
        if(empty($forma_primer_apellido)){
            $forma_primer_apellido = "";
        }
        if(empty($forma_segundo_apellido)){
            $forma_segundo_apellido = "";
        }
        if (empty($forma_direccion_principal)){
            $forma_direccion_principal = "";
        }
        if (empty($forma_telefono_principal)){
            $forma_telefono_principal = "";
        }
        if (empty($forma_celular)){
            $forma_celular = "";
        }
        if (empty($forma_correo)){
            $forma_correo = "";
        }
        if (empty($forma_sitio_web)){
            $forma_sitio_web = "";
        }
        if (empty($forma_correo2)){
            $forma_correo2 = "";
        }
        if (empty($forma_celular2)){
            $forma_celular2 = "";
        }
        if (empty($forma_id_actividad_principal)){
            $forma_id_actividad_principal = 0;
        }
        if (empty($forma_id_actividad_secundaria)){
            $forma_id_actividad_secundaria = 0;
        }

        $forma_primer_nombre    = trim($forma_primer_nombre);
        $forma_segundo_nombre   = trim($forma_segundo_nombre);
        $forma_primer_apellido  = trim($forma_primer_apellido);
        $forma_segundo_apellido = trim($forma_segundo_apellido);
        $forma_razon_social     = trim($forma_razon_social);
        $forma_nombre_comercial = trim($forma_nombre_comercial);
        if (empty($forma_fecha_nacimiento)){
            $forma_fecha_nacimiento = "0000-00-00";
        }
        if (!isset($forma_genero)){
            $forma_genero = "N";
        }
        if (empty($forma_documento_representante_legal)){
            $forma_documento_representante_legal = 0;
        }
        if (empty($forma_nombre_representante_legal)){
            $forma_nombre_representante_legal = "";
        }
        if (!isset($forma_sociedad_grupo)){
            $forma_sociedad_grupo = "0";
        }
        if (!isset($forma_cliente_detal)){
            $forma_cliente_detal = "0";
        }
        if (!isset($forma_cliente_mayorista)){
            $forma_cliente_mayorista = "0";
        }
        if (!isset($forma_filial)){
            $forma_filial = "0";
        }
        if (!isset($forma_socio)){
            $forma_socio = "0";
        }
        if (!isset($forma_empleado)){
            $forma_empleado = "0";
        }
        if (!isset($forma_proveedor)){
            $forma_proveedor = "0";
        }
        if (!isset($forma_proveedor_servicios)){
            $forma_proveedor_servicios = "0";
        }
        if (!isset($forma_entidad_oficial)){
            $forma_entidad_oficial = "0";
        }

        if ($id_tercero){
            $consulta = SQL::seleccionar(array("terceros"),array("*"),"id='$id_tercero'");
            $datos_tercero = SQL::filaEnObjeto($consulta);
            if ($datos_tercero->documento_identidad != $forma_documento_identidad){
                $datos["documento_identidad"] = $forma_documento_identidad;
            }
            if ($datos_tercero->id_tipo_documento_identidad != $forma_id_tipo_documento_identidad){
                $datos["id_tipo_documento_identidad"] = $forma_id_tipo_documento_identidad;
            }
            if ($datos_tercero->id_municipio_documento != $forma_id_municipio_documento){
                $datos["id_municipio_documento"] = $forma_id_municipio_documento;
            }
            if (Cadena::contieneUTF8($forma_primer_nombre)){
                $forma_primer_nombre = utf8_decode($forma_primer_nombre);
            }
            if ($datos_tercero->primer_nombre != $forma_primer_nombre){
                $datos["primer_nombre"] = $forma_primer_nombre;
            }
            if (Cadena::contieneUTF8($forma_segundo_nombre)){
                $forma_segundo_nombre = utf8_decode($forma_segundo_nombre);
            }
            if ($datos_tercero->segundo_nombre != $forma_segundo_nombre){
                $datos["segundo_nombre"] = $forma_segundo_nombre;
            }
            if (Cadena::contieneUTF8($forma_primer_apellido)){
                $forma_primer_apellido = utf8_decode($forma_primer_apellido);
            }
            if ($datos_tercero->primer_apellido != $forma_primer_apellido){
                $datos["primer_apellido"] = $forma_primer_apellido;
            }
            if (Cadena::contieneUTF8($forma_segundo_apellido)){
                $forma_segundo_apellido = utf8_decode($forma_segundo_apellido);
            }
            if ($datos_tercero->segundo_apellido != $forma_segundo_apellido){
                $datos["segundo_apellido"] = $forma_segundo_apellido;
            }
            if ($datos_tercero->id_localidad != $forma_id_localidad){
                $datos["id_localidad"] = $forma_id_localidad;
            }
            if (Cadena::contieneUTF8($forma_direccion_principal)){
                $forma_direccion_principal = utf8_decode($forma_direccion_principal);
            }
            if ($datos_tercero->direccion_principal != $forma_direccion_principal){
                $datos["direccion_principal"] = $forma_direccion_principal;
            }
            if ($datos_tercero->telefono_principal != $forma_telefono_principal){
                $datos["telefono_principal"] = $forma_telefono_principal;
            }
            if ($datos_tercero->celular != $forma_celular){
                $datos["celular"] = $forma_celular;
            }
            if ($datos_tercero->celular2 != $forma_celular2){
                $datos["celular2"] = $forma_celular2;
            }
            if ($datos_tercero->fax != $forma_fax){
                $datos["fax"] = $forma_fax;
            }
            if ($datos_tercero->correo != $forma_correo){
                $datos["correo"] = $forma_correo;
            }
            if ($datos_tercero->correo2 != $forma_correo2){
                $datos["correo2"] = $forma_correo2;
            }
            if ($datos_tercero->sitio_web != $forma_sitio_web){
                $datos["sitio_web"] = $forma_sitio_web;
            }
            if ($datos_tercero->fecha_nacimiento != $forma_fecha_nacimiento){
                $datos["fecha_nacimiento"] = $forma_fecha_nacimiento;
            }
            if ($datos_tercero->genero != $forma_genero){
                $datos["genero"] = $forma_genero;
            }
            if ($datos_tercero->id_actividad_principal != $forma_id_actividad_principal){
                $datos["id_actividad_principal"] = $forma_id_actividad_principal;
            }
            if ($datos_tercero->id_actividad_secundaria != $forma_id_actividad_secundaria){
                $datos["id_actividad_secundaria"] = $forma_id_actividad_secundaria;
            }
            if (Cadena::contieneUTF8($forma_razon_social)){
                $forma_razon_social = utf8_decode($forma_razon_social);
            }
            if ($datos_tercero->razon_social != $forma_razon_social){
                $datos["razon_social"] = $forma_razon_social;
            }
            if (Cadena::contieneUTF8($forma_nombre_comercial)){
                $forma_nombre_comercial = utf8_decode($forma_nombre_comercial);
            }
            if ($datos_tercero->nombre_comercial != $forma_nombre_comercial){
                $datos["nombre_comercial"] = $forma_nombre_comercial;
            }
            if ($datos_tercero->documento_representante_legal != $forma_documento_representante_legal){
                $datos["documento_representante_legal"] = $forma_documento_representante_legal;
            }
            if (Cadena::contieneUTF8($forma_nombre_representante_legal)){
                $forma_nombre_representante_legal = utf8_decode($forma_nombre_representante_legal);
            }
            if ($datos_tercero->nombre_representante_legal != $forma_nombre_representante_legal){
                $datos["nombre_representante_legal"] = $forma_nombre_representante_legal;
            }
            if ($datos_tercero->sociedad_grupo != $forma_sociedad_grupo){
                $datos["sociedad_grupo"] = $forma_sociedad_grupo;
            }
            if ($datos_tercero->cliente_detal != $forma_cliente_detal){
                $datos["cliente_detal"] = $forma_cliente_detal;
            }
            if ($datos_tercero->cliente_mayorista != $forma_cliente_mayorista){
                $datos["cliente_mayorista"] = $forma_cliente_mayorista;
            }
            if ($datos_tercero->filial != $forma_filial){
                $datos["filial"] = $forma_filial;
            }
            if ($datos_tercero->socio != $forma_socio){
                $datos["socio"] = $forma_socio;
            }
            if ($datos_tercero->empleado != $forma_empleado){
                $datos["empleado"] = $forma_empleado;
            }
            if ($datos_tercero->proveedor != $forma_proveedor){
                $datos["proveedor"] = $forma_proveedor;
            }
            if ($datos_tercero->proveedor_servicios != $forma_proveedor_servicios){
                $datos["proveedor_servicios"] = $forma_proveedor_servicios;
            }
            if ($datos_tercero->entidad_oficial != $forma_entidad_oficial){
                $datos["entidad_oficial"] = $forma_entidad_oficial;
            }
            if (isset($datos)){

                $modificar = SQL::modificar("terceros", $datos,"id = '$id_tercero'");
                // Verificar si hubo error
                if (!$modificar){
                    $error   = true;
                    $mensaje = $textos["ERROR_MODIFICAR_ITEM"];
                    $id_tercero = false;
                } else {
                    $error   = false;
                    $mensaje = $textos["ITEM_MODIFICADO"];
                }
            } else {
                $error   = false;
                $mensaje = $textos["ITEM_MODIFICADO_SIN_CAMBIOS"];
            }

        } else {
            $datos = array(
                "documento_identidad" => $forma_documento_identidad,
                "id_tipo_documento_identidad" => $forma_id_tipo_documento_identidad,
                "id_municipio_documento" => $forma_id_municipio_documento,
                "id_localidad"        => $forma_id_localidad,
                "direccion_principal" => $forma_direccion_principal,
                "telefono_principal"  => $forma_telefono_principal,
                "celular"             => $forma_celular,
                "celular2"            => $forma_celular2,
                "fax"                 => $forma_fax,
                "correo"              => $forma_correo,
                "correo2"             => $forma_correo2,
                "sitio_web"           => $forma_sitio_web,
                "primer_nombre"       => $forma_primer_nombre,
                "segundo_nombre"      => $forma_segundo_nombre,
                "primer_apellido"     => $forma_primer_apellido,
                "segundo_apellido"    => $forma_segundo_apellido,
                "fecha_nacimiento"    => $forma_fecha_nacimiento,
                "genero"              => $forma_genero,
                "id_actividad_principal" => $forma_id_actividad_principal,
                "id_actividad_secundaria" => $forma_id_actividad_secundaria,
                "razon_social"        => $forma_razon_social,
                "nombre_comercial"    => $forma_nombre_comercial,
                "documento_representante_legal" => $forma_documento_representante_legal,
                "nombre_representante_legal"  => $forma_nombre_representante_legal,
                "sociedad_grupo"              => $forma_sociedad_grupo,
                "cliente_detal"               => $forma_cliente_detal,
                "cliente_mayorista"           => $forma_cliente_mayorista,
                "filial"                      => $forma_filial,
                "socio"                       => $forma_socio,
                "empleado"                    => $forma_empleado,
                "proveedor"                   => $forma_proveedor,
                "proveedor_servicios"         => $forma_proveedor_servicios,
                "entidad_oficial"             => $forma_entidad_oficial,
                "activo"              => $forma_activo,
                "id_usuario_registra" => $sesion_id_usuario_ingreso,
                "fecha_registra"      => date("Y-m-d H:i:s"),
                "fecha_modificacion"  => date("0000-00-00 00:00:00")
            );
            $id_tercero = SQL::insertar("terceros", $datos, true);
            // Verificar si hubo error
            if (!$id_tercero){
                $error   = true;
                $mensaje = $textos["ERROR_MODIFICAR_ITEM"];
            } else {
                $error   = false;
                $mensaje = $textos["ITEM_MODIFICADO"];
                $crear_tercero = true;
            }
        }

        if ($id_tercero){
            if (empty($forma_activo_anterior)){
                $forma_activo_anterior = "0";
            }
            if ($forma_id_tercero_anterior != $id_tercero){
                $datos_comprador["id_tercero"] = $id_tercero;
            }
            if ($forma_activo_anterior != $forma_activo){
                $datos_comprador["activo"] = $forma_activo;
            }
            if (isset($datos_comprador)){
                $modificar = SQL::modificar("compradores",$datos_comprador,"id='$forma_id'");
                if (!$modificar){
                    $error   = true;
                    $mensaje = $textos["ERROR_MODIFICAR_ITEM"];
                    if ($crear_tercero){
                        $eliminar = SQL::eliminar("terceros","id='$id_tercero'");
                    }
                } else {
                    $error   = false;
                    $mensaje = $textos["ITEM_MODIFICADO"];
                }
            } else {
                if(!isset($datos) && !isset($datos_comprador) && (!isset($forma_cambios_registro) || empty($forma_cambios_registro))){
                    $error   = false;
                    $mensaje = $textos["ITEM_MODIFICADO_SIN_CAMBIOS"];
                } else {
                    $error   = false;
                    $mensaje = $textos["ITEM_MODIFICADO"];
                }
            }
        }
    }

    /*** Enviar datos con la respuesta del proceso al script que originó la petición ***/
    $respuesta    = array();
    $respuesta[0] = $error;
    $respuesta[1] = $mensaje;
    HTTP::enviarJSON($respuesta);
}
?>
