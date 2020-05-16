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

    } else{

        $vistaConsulta         = "cotizaciones";
        $columnas              = SQL::obtenerColumnas($vistaConsulta);
        $consulta              = SQL::seleccionar(array($vistaConsulta), $columnas, "id = '$url_id'");
        $datos                 = SQL::filaEnObjeto($consulta);
        $error                 = "";
        $titulo                = $componente->nombre;
        
        if ($datos->estado == '3'){
            $error     = $textos["COTIZACION_DESCARTADA"];
            $titulo    = "";
            $contenido = "";
        } else if($datos->estado == '4' || $datos->estado == '5'){
            $error     = $textos["COTIZACION_FACTURADA"];
            $titulo    = "";
            $contenido = "";
        } else if($datos->estado == '6'){
            $error     = $textos["COTIZACION_EJECUTADA"];
            $titulo    = "";
            $contenido = "";
        } else if($datos->estado == '7' || $datos->estado == '8'){
            $error     = $textos["OTRA_COTIZACION"];
            $titulo    = "";
            $contenido = "";            
        } else {
            $vector_variables = array();
    		$vector_variables[] = "impuesto";

    	    $i=0;
    	    foreach($vector_variables AS $id_preferencias){
                $posicion = $vector_variables[$i];
    		    if(isset($sesion_preferencias_individuales)){
    		        $valor[] = $sesion_preferencias_individuales[$posicion];
    		    }else{
    		        $valor[] = 0;
    		    }
    		    $i++;
    	    }
            $forma_pago = array(
                "0" => $textos["PAGO_PARCIAL"],
                "1" => $textos["CONTRAENTREGA"]
            );

            $tipo_solicitud = array(
                "M" => $textos["MANTENIMIENTO"],
                "E" => $textos["EMERGENCIA"],
                "S" => $textos["SERVICIO"],
                "P" => $textos["PROYECTO"],
                "V" => $textos["VISITA"]
            );

            $estado = array(
                "1" => $textos["PENDIENTE"],
                "2" => $textos["APROBADA"],
                "3" => $textos["ANULADA"],
                "4" => $textos["RECOTIZAR"],
                "5" => $textos["REEMPLAZAR"],
                "6" => $textos["COTIZADA"],
            );
            $Sede                  = SQL::obtenerValor("requerimientos_clientes", "id_sede", "id = '$datos->id_requerimiento'");
            $nombreSede            = SQL::obtenerValor("sedes_clientes", "nombre_sede", "id = '$Sede'");
            $id_municipio_sede = SQL::ObtenerValor("sedes_clientes", "id_municipios", "id = '$datos->id_sede'");
            $nombreMunicipio   = SQL::ObtenerValor("municipios", "nombre", "id = '$id_municipio_sede'");
            $municipio             = SQL::obtenerValor("sedes_clientes", "id_municipios", "id = '$Sede'");
            $nombreMunicipio       = SQL::obtenerValor("municipios", "nombre", "id = '$municipio'");
            if ($datos->porcentaje_utilidad > 0 || $datos->costo_utilidad > 0){
                $si_aiu      = 1;
                $true_si_aiu = true;
                $no_aiu      = 0;
                $true_no_aiu = false;
                $oculto_porcentaje_administracion = "";
                $oculto_porcentaje_imprevistos    = "";
                $oculto_porcentaje_utilidad       = "";
                $oculto_costo_administracion      = "";
                $oculto_costo_imprevistos         = "";
                $oculto_costo_utilidad            = "";
            } else{
                $si_aiu      = 0;
                $true_si_aiu = false;
                $no_aiu      = 1;
                $true_no_aiu = true;
                $oculto_porcentaje_administracion = "oculto";
                $oculto_porcentaje_imprevistos    = "oculto";
                $oculto_porcentaje_utilidad       = "oculto";
                $oculto_costo_administracion      = "oculto";
                $oculto_costo_imprevistos         = "oculto";
                $oculto_costo_utilidad            = "oculto";
            }

            $datos_consecutivo_cotizacion = SQL::seleccionar(array("cotizaciones"), array("*"), "numero_cotizacion = $datos->numero_cotizacion", "", "consecutivo_cotizacion DESC",1,0);
            if (SQL::filasDevueltas($datos_consecutivo_cotizacion)) {
                $consecutivo                    = SQL::filaEnObjeto($datos_consecutivo_cotizacion);
                $ultimo_consecutivo_cotizacion = $consecutivo->consecutivo_cotizacion;
                $ultimo_consecutivo_cotizacion ++;
            }else{
                $ultimo_consecutivo_cotizacion = 0;
            }

            $vistaRequerimiento    = "requerimientos_clientes";
            $columnasRequerimiento = SQL::obtenerColumnas($vistaRequerimiento);
            $consultaRequerimiento = SQL::seleccionar(array($vistaRequerimiento), $columnasRequerimiento, "id = '$datos->id_requerimiento'");
            $datosRequerimiento    = SQL::filaEnObjeto($consultaRequerimiento);
            $nombreSucursal        = SQL::obtenerValor("sucursales", "nombre", "id = '$datosRequerimiento->id_sucursal'");

            $valor_mano_obra_cotizacion      = number_format($datos->valor_mano_obra_cotizacion);
            $valor_materiales_cotizacion     = number_format($datos->valor_materiales_cotizacion);
            $costo_directo                   = number_format($datos->costo_directo);
            $costo_administracion_cotizacion = number_format($datos->costo_administracion_cotizacion);
            $costo_imprevistos_cotizacion    = number_format($datos->costo_imprevistos_cotizacion);
            $costo_utilidad_cotizacion       = number_format($datos->costo_utilidad);
            
            if ($datos->costo_administracion_cotizacion <= 0){
                $valor_oculto = "oculto";
            } else {
                $valor_oculto = "";
            }

            if($datos->porcentaje_utilidad > 0 || $datos->costo_utilidad > 0){
                $base_impuesto = number_format($datos->costo_utilidad);
                $subtotal      = $datos->costo_administracion_cotizacion + $datos->costo_imprevistos_cotizacion + $datos->costo_utilidad  + $datos->costo_impuesto;
                $total_general = $subtotal + $datos->costo_directo;
            } else {
                $base_impuesto = number_format($datos->costo_directo);
                $subtotal      = "";
                $total_general  = $datos->costo_impuesto + $datos->costo_directo;
            }
            
            $costo_impuesto = number_format($datos->costo_impuesto);
            $subtotal       = number_format($subtotal);
            $total_general  = number_format($total_general);

            $formularios["PESTANA_REQUERIMIENTO"] = array(
                array(
                    HTML::mostrarDato("sucursal", $textos["EMPRESA"],$nombreSucursal),
                    HTML::mostrarDato("numero_requerimiento", $textos["NUMERO_REQUERIMIENTO"], number_format($datosRequerimiento->id))                
                ),
                array(
                    HTML::mostrarDato("nombre_sede", $textos["SEDE"],$nombreSede),
                    HTML::mostrarDato("municipio", $textos["MUNICIPIO"], $nombreMunicipio)
                ),
                array(
                    HTML::mostrarDato("fecha_ingreso", $textos["FECHA_INGRESO"],$datosRequerimiento->fecha_ingreso),
                    HTML::mostrarDato("fecha_limte_visita", $textos["FECHA_LIMITE_VISITA"],$datosRequerimiento->fecha_limite_visita)
                ),
                array(
                    HTML::mostrarDato("tipo_solictud", $textos["TIPO_SOLICITUD"],$tipo_solicitud[$datosRequerimiento->tipo_solicitud]),
                ),
                array(
                    HTML::mostrarDato("descripcion", $textos["DESCRIPCION"],$datosRequerimiento->descripcion)
                ),
                array(
                    HTML::mostrarDato("observaciones", $textos["OBSERVACIONES"],$datosRequerimiento->observaciones)
                ),
                array(
                    HTML::mostrarDato("nombre_contacto", $textos["CONTACTO"],$datosRequerimiento->nombre_contacto),
                    HTML::mostrarDato("telefono_contacto", $textos["TELEFONO_CONTACTO"],$datosRequerimiento->telefono_contacto)
                ),
                array(
                    HTML::mostrarDato("codigo_contable", $textos["CODIGO_CONTABLE"],$datosRequerimiento->codigo_contable)
                ),
                array(
                    HTML::mostrarDato("persona_recibe", $textos["PERSONA_RECIBE"],$datosRequerimiento->persona_recibe),
                    HTML::mostrarDato("medio_recibo", $textos["MEDIO_RECIBO"],$datosRequerimiento->medio_recibo)
                )
            );
            
            $formularios["PESTANA_COTIZACION"] = array(
                array(
                    HTML::campoTextoCorto("*numero_cotizacion", $textos["NUMERO_COTIZACION"], 8, 8, $datos->numero_cotizacion, array("title" => $textos["AYUDA_NUMERO_COTIZACION"])),
                    HTML::campoTextoCorto("consecutivo_cotizacion", $textos["CONSECUTIVO_COTIZACION"], 2, 2, $ultimo_consecutivo_cotizacion, array("readOnly" => "true")),
                    HTML::campoTextoCorto("*numero_cotizacion_consorciado", $textos["NUMERO_COTIZACION_CONSORCIADO"], 15, 15, $datos->numero_cotizacion_consorciado, array("title" => $textos["AYUDA_NUMERO_COTIZACION_CONSORCIADO"]))
                ),
                array(
                   HTML::campoTextoCorto("*fecha_visita", $textos["FECHA_VISITA"], 10, 10, substr($datosRequerimiento->fecha_visita, 0, 10), array("class" => "selectorFecha"), array("title" => $textos["AYUDA_FECHA_VISITA"]))
                ),
                array(
        	          HTML::campoTextoCorto("observaciones_visita", $textos["OBSERVACIONES_VISITA"], 60, 255, $datosRequerimiento->observaciones_visita, array("title" => $textos["AYUDA_OBSERVACIONES"]))
                ),
                array(
                    HTML::campoTextoCorto("*valor_mano_obra_cotizacion", $textos["VALOR_MANO_OBRA_COTIZACION"], 12, 12, $valor_mano_obra_cotizacion, array("title" => $textos["AYUDA_VALOR_MANO_OBRA_COTIZACION"], "class" => "numero", "onblur" => "CalculaCosto()")),
                    HTML::campoTextoCorto("*valor_materiales_cotizacion", $textos["VALOR_MATERIALES_COTIZACION"], 12, 12, $valor_materiales_cotizacion, array("title" => $textos["AYUDA_VALOR_MATERIALES_COTIZACION"], "class" => "numero", "onblur" => "CalculaCosto()")),
                    HTML::campoTextoCorto("costo_directo", $textos["COSTO_DIRECTO"], 12, 12, $costo_directo, array("class" => "costo_directo", "title" => $textos["AYUDA_COSTO_DIRECTO"], "readonly" => "true"))
                ),
                array(
                    HTML::marcaSeleccion("aiu", $textos["AIU"], 1, $true_si_aiu, array("id" => "si_aiu", "onblur" => "activarAiu(1)")),
                    HTML::marcaSeleccion("aiu", $textos["NO_AIU"], 0, $true_no_aiu, array("id" => "no_aiu", "onblur" => "activarAiu(0)"))
                ),
                array(
                    HTML::campoTextoCorto("*porcentaje_administracion_cotizacion", $textos["PORCENTAJE_ADMINISTRACION_COTIZACION"], 4, 4, $datos->porcentaje_administracion_cotizacion, array("title" => $textos["AYUDA_PORCENTAJE_ADMINISTRACION_COTIZACION"], "class" => "$valor_oculto", "onblur" => "CalculaAdministracion()")),
                    HTML::campoTextoCorto("costo_administracion_cotizacion", $textos["VALOR_ADMINISTRACION_COTIZACION"], 12, 12, $costo_administracion_cotizacion, array("class" => "$valor_oculto costo_administracion_cotizacion", "title" => $textos["AYUDA_VALOR_ADMINISTRACION_COTIZACION"], "readonly" => "true"))
                ),
                array(
                    HTML::campoTextoCorto("*porcentaje_imprevistos_cotizacion", $textos["PORCENTAJE_IMPREVISTOS_COTIZACION"], 4, 4, $datos->porcentaje_imprevistos_cotizacion, array("title" => $textos["AYUDA_PORCENTAJE_IMPREVISTOS_COTIZACION"],"class" => "$valor_oculto", "onblur" => "CalculaImprevistos()")),
                    HTML::campoTextoCorto("costo_imprevistos_cotizacion", $textos["VALOR_IMPREVISTOS_COTIZACION"], 12, 12, $costo_imprevistos_cotizacion, array("class" => "$valor_oculto costo_imprevistos_cotizacion", "title" => $textos["AYUDA_VALOR_IMPREVISTOS_COTIZACION"], "readonly" => "true"))
                ),
                array(
                    HTML::campoTextoCorto("*porcentaje_utilidad", $textos["PORCENTAJE_UTILIDAD"], 4, 4, $datos->porcentaje_utilidad, array("title" => $textos["AYUDA_PORCENTAJE_UTILIDAD"], "class" => "$valor_oculto", "onblur" => "CalculaUtilidad()")),
                    HTML::campoTextoCorto("costo_utilidad", $textos["VALOR_UTILIDAD"], 12, 12, $costo_utilidad_cotizacion, array("class" => "$valor_oculto costo_utilidad", "title" => $textos["AYUDA_VALOR_UTILIDAD"], "readonly" => "true"))
                ),
                array(
                    HTML::campoTextoCorto("*impuesto", $textos["IMPUESTO"], 5, 5, $datos->impuesto, array("title" => $textos["AYUDA_IMPUESTO"],"onblur" => "CalculaCostoImpuesto()")),
                    HTML::campoTextoCorto("base_impuesto", $textos["VALOR_BASE_IMPUESTO"], 12, 12, $base_impuesto, array("class" => "costo_impuesto", "title" => $textos["AYUDA_BASE_IMPUESTO"], "readonly" => "true")),
                    HTML::campoTextoCorto("costo_impuesto", $textos["VALOR_IMPUESTO"], 12, 12, $costo_impuesto, array("class" => "costo_impuesto", "title" => $textos["AYUDA_VALOR_IMPUESTO"], "readonly" => "true"))
                ),
                array(
                    HTML::campoTextoCorto("sub_total", $textos["SUB_TOTAL"], 12, 12, $subtotal, array("class" => "sub_total $valor_oculto", "title" => $textos["AYUDA_SUB_TOTAL"], "readonly" => "true"))
                ),
                array(
                    HTML::campoTextoCorto("total_general", $textos["TOTAL_GENERAL"], 12, 12, $total_general, array("class" => "total_general", "title" => $textos["AYUDA_TOTAL_GENERAL"], "readonly" => "true"))
                ),
                array(                
                    HTML::campoOculto("forma_pago", $datos->forma_pago),
                    HTML::campoOculto("porcentaje_anticipo", $datos->porcentaje_anticipo),
        	        HTML::campoOculto("requerimiento", $datos->id_requerimiento)
                )
            );

            /*** Definición de botones ***/
            $botones = array(
                HTML::boton("botonAceptar", $textos["ACEPTAR"], "modificarItem('$url_id');", "aceptar")
            );

            $contenido = HTML::generarPestanas($formularios, $botones);
        }
    }
    /*** Enviar datos para la generacion del formulario al script que origino la peticion ***/
    $respuesta[0] = $error;
    $respuesta[1] = $titulo;
    $respuesta[2] = $contenido;
    HTTP::enviarJSON($respuesta);

/*** Validar los datos provenientes del formulario ***/
} elseif (!empty($url_validar)) {
   
    /*** Validar numero de la cotizacion consorciado***/
    if ($url_item == "numero_cotizacion_consorciado" && $url_valor) {
        $existe = SQL::existeItem("cotizaciones", "numero_cotizacion_consorciado", $url_valor);

        if ($existe) {
            $respuesta = $textos["ERROR_EXISTE_NUMERO_COTIZACION"];
        }
    }
    
    HTTP::enviarJSON($respuesta);

/*** Adicionar los datos provenientes del formulario ***/
}elseif (!empty($forma_procesar)) {

    /*** Asumir por defecto que no hubo error ***/
    $error   = false;
    $mensaje = $textos["ITEM_ADICIONADO"];
    
    $datos = array (
        "estado" => '8'
    );
    $consulta = SQL::modificar("cotizaciones", $datos, "id = '$forma_id'");
    
    if($consulta){
        /*** Ingresar fecha del sistema por defecto cuando genere la cotizacion***/
        $forma_fecha_registro_cotizacion_consorciado = date("Y-m-d H:m:s");

        /*** Quitar separador de miles a un numero ***/
        function quitarMiles($cadena){
            $valor = array();
            for ($i = 0; $i < strlen($cadena); $i++) {
                if (substr($cadena, $i, 1) != ",") {
                    $valor[$i] = substr($cadena, $i, 1);
                }
            }
            $valor = implode($valor);
            return $valor;
        }
        
        if(!isset($forma_valor_mano_obra_cotizacion)){
            $forma_valor_mano_obra_cotizacion=0;
        }
        if(!isset($forma_valor_materiales_cotizacion)){
            $forma_valor_materiales_cotizacion=0;
        }
        if(!isset($forma_costo_directo)){
            $forma_costo_directo=0;
        }
        if(!isset($forma_porcentaje_anticipo)){
            $forma_porcentaje_anticipo=0;
        }

        $forma_valor_mano_obra_cotizacion      = quitarMiles($forma_valor_mano_obra_cotizacion);
        $forma_valor_materiales_cotizacion     = quitarMiles($forma_valor_materiales_cotizacion);
        $forma_costo_directo                   = quitarMiles($forma_costo_directo);
        $forma_porcentaje_anticipo             = quitarMiles($forma_porcentaje_anticipo);

        if (isset($forma_costo_administracion_cotizacion)){
            $forma_costo_administracion_cotizacion = quitarMiles($forma_costo_administracion_cotizacion);
        }
        if(isset($forma_costo_imprevistos_cotizacion)){
            $forma_costo_imprevistos_cotizacion    = quitarMiles($forma_costo_imprevistos_cotizacion);
        }
        if(isset($forma_costo_utilidad)){
            $forma_costo_utilidad                  = quitarMiles($forma_costo_utilidad);
        }
        if(isset($forma_costo_impuesto)){
            $forma_costo_impuesto                  = quitarMiles($forma_costo_impuesto);
        }
        /***********************************************************************************/
        if($forma_aiu == 1){

            if (empty($forma_numero_cotizacion)){
                $error   = true;
                $mensaje = "NUMERO COTIZACION VACIO";
            } elseif(empty($forma_numero_cotizacion_consorciado)){
                $error   = true;
                $mensaje = "NUMERO COTIZACION CONSORCIADO VACIO";
            } elseif(empty($forma_fecha_visita)){
                $error   = true;
                $mensaje = "FECHA VISITA VACIO";
            } elseif(empty($forma_valor_mano_obra_cotizacion) && empty($forma_valor_materiales_cotizacion)){
                $error   = true;
                $mensaje = "MANO DE OBRA Y/O MATERIALES VACIO";
            } elseif(empty($forma_porcentaje_administracion_cotizacion)){
                $error   = true;
                $mensaje = "PORCENTAJE ADMINISTRACION VACIO";
            } elseif(empty($forma_porcentaje_imprevistos_cotizacion)){
                $error   = true;
                $mensaje = "PORCENTAJE IMPREVISTOS VACIO";
            } elseif(empty($forma_porcentaje_utilidad)){
                $error   = true;
                $mensaje = "PORCENTAJE UTILIDAD VACIO";
            } elseif(empty($forma_impuesto)){
                $error   = true;
                $mensaje = "IMPUESTO VACIO";
            } elseif(empty($forma_costo_impuesto)){
                $error   = true;
                $mensaje = "COSTO IMPUESTO VACIO";
            } elseif (!empty($forma_numero_cotizacion) && !Cadena::validarNumeros($forma_numero_cotizacion)) {
                $error   = true;
                $mensaje =  $textos["ERROR_FORMATO_NUMERO_COTIZACION"];

            } elseif (!empty($forma_valor_mano_obra_cotizacion) && !Cadena::validarNumeros($forma_valor_mano_obra_cotizacion)) {
                $error   = true;
                $mensaje =  $textos["ERROR_FORMATO_MANO_OBRA"];

            } elseif (!empty($forma_valor_materiales_cotizacion) && !Cadena::validarNumeros($forma_valor_materiales_cotizacion)) {
                $error   = true;
                $mensaje =  $textos["ERROR_FORMATO_MATERIALES"];

            } else {
                $datos = array(
                    "id_requerimiento"                      => $forma_requerimiento,
                    "numero_cotizacion"                     => $forma_numero_cotizacion,
                    "consecutivo_cotizacion"                => $forma_consecutivo_cotizacion,
                    "numero_cotizacion_consorciado"         => $forma_numero_cotizacion_consorciado,
                    "estado"                                => '1',
                    "valor_mano_obra_cotizacion"            => $forma_valor_mano_obra_cotizacion,
                    "valor_materiales_cotizacion"           => $forma_valor_materiales_cotizacion,
                    "costo_directo"                         => $forma_costo_directo,
                    "porcentaje_administracion_cotizacion"  => $forma_porcentaje_administracion_cotizacion,
                    "costo_administracion_cotizacion"       => $forma_costo_administracion_cotizacion,
                    "porcentaje_imprevistos_cotizacion"     => $forma_porcentaje_imprevistos_cotizacion,
                    "costo_imprevistos_cotizacion"          => $forma_costo_imprevistos_cotizacion,
                    "porcentaje_utilidad"                   => $forma_porcentaje_utilidad,
                    "costo_utilidad"                        => $forma_costo_utilidad,
                    "impuesto"                              => $forma_impuesto,
                    "costo_impuesto"                        => $forma_costo_impuesto,
                    "forma_pago"                            => $forma_forma_pago,
                    "porcentaje_anticipo"                   => $forma_porcentaje_anticipo,
                    "fecha_registro_cotizacion_consorciado" => $forma_fecha_registro_cotizacion_consorciado
                );

                $insertar = SQL::insertar("cotizaciones", $datos);

               /*** Error de inserción ***/
                if (!$insertar) {
                    $error   = true;
                    $mensaje = $textos["ERROR_ADICIONAR_ITEM"];
                }

                $datos = array(
                    "fecha_visita"                    => $forma_fecha_visita,
                    "observaciones_visita"            => $forma_observaciones_visita,
                    "estado_requerimiento"            => 4
                );

                $consulta = SQL::modificar("requerimientos_clientes", $datos, "id = '$forma_requerimiento'");

                if ($consulta) {
                    $error   = false;
                    $mensaje = $textos["ITEM_COTIZAR"];

                } else {
                    $error   = true;
                    $mensaje = $textos["ERROR_COTIZAR"];
                }

            }

        }else if($forma_aiu == "0"){

            /*** Validar el ingreso de los datos requeridos ***/
            if (empty($forma_numero_cotizacion) ||
                empty($forma_numero_cotizacion_consorciado) ||
                empty($forma_fecha_visita) ||
                (empty($forma_valor_mano_obra_cotizacion) && empty($forma_valor_materiales_cotizacion)) ||
                empty($forma_impuesto)) {
                $error   = true;
                $mensaje = $textos["ERROR_DATOS_INCOMPLETOS"];

            } elseif (!empty($forma_numero_cotizacion) && !Cadena::validarNumeros($forma_numero_cotizacion)) {
                $error   = true;
                $mensaje =  $textos["ERROR_FORMATO_NUMERO_COTIZACION"];

            } elseif (!empty($forma_valor_mano_obra_cotizacion) && !Cadena::validarNumeros($forma_valor_mano_obra_cotizacion)) {
                $error   = true;
                $mensaje =  $textos["ERROR_FORMATO_MANO_OBRA"];

            } elseif (!empty($forma_valor_materiales_cotizacion) && !Cadena::validarNumeros($forma_valor_materiales_cotizacion)) {
                $error   = true;
                $mensaje =  $textos["ERROR_FORMATO_MATERIALES"];

            } else {
                $datos = array(
                    "id_requerimiento"                      => $forma_requerimiento,
                    "numero_cotizacion"                     => $forma_numero_cotizacion,
                    "consecutivo_cotizacion"                => $forma_consecutivo_cotizacion,
                    "numero_cotizacion_consorciado"         => $forma_numero_cotizacion_consorciado,
                    "estado"                                => '1',
                    "valor_mano_obra_cotizacion"            => $forma_valor_mano_obra_cotizacion,
                    "valor_materiales_cotizacion"           => $forma_valor_materiales_cotizacion,
                    "costo_directo"                         => $forma_costo_directo,
                    "impuesto"                              => $forma_impuesto,
                    "costo_impuesto"                        => $forma_costo_impuesto,
                    "forma_pago"                            => $forma_forma_pago,
                    "porcentaje_anticipo"                   => $forma_porcentaje_anticipo,
                    "fecha_registro_cotizacion_consorciado" => $forma_fecha_registro_cotizacion_consorciado
                );

                $insertar = SQL::insertar("cotizaciones", $datos);

               /*** Error de inserción ***/
                if (!$insertar) {
                    $error   = true;
                    $mensaje = $textos["ERROR_ADICIONAR_ITEM"];
                }

                $datos = array(
                    "fecha_visita"                    => $forma_fecha_visita,
                    "observaciones_visita"            => $forma_observaciones_visita,
                    "estado_requerimiento"            => 4
                );

                $consulta = SQL::modificar("requerimientos_clientes", $datos, "id = '$forma_requerimiento'");

                if ($consulta) {
                    $error   = false;
                    $mensaje = $textos["ITEM_COTIZAR"];

                } else {
                    $error   = true;
                    $mensaje = $textos["ERROR_COTIZAR"];
                }

            }
        }
    } else
    {
        $error   = true;
            $mensaje = $textos["ERROR_REEMPLAZAR"];
    }

    /*** Enviar datos con la respuesta del proceso al script que originó la petición ***/                                                                                            
    $respuesta    = array();                                                                                                                                                         
    $respuesta[0] = $error;                                                                                                                                                          
    $respuesta[1] = $mensaje;                                                                                                                                                        
    $respuesta[2] = $mensaje;                                                                                                                                                        
    HTTP::enviarJSON($respuesta);
}
?>
