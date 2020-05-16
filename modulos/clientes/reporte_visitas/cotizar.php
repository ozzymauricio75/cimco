<?php

/**
*
* Copyright (C) 2009 FELINUX Ltda
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
    $error    = "";
    $titulo   = $componente->nombre;
    
    $datos_numero_cotizacion = SQL::seleccionar(array("cotizaciones"), array("*"), "", "", "numero_cotizacion DESC",1,0);
    if (SQL::filasDevueltas($datos_numero_cotizacion)) {
        $datos                    = SQL::filaEnObjeto($datos_numero_cotizacion);
        $ultimo_numero_cotizacion = $datos->numero_cotizacion;
        $ultimo_numero_cotizacion ++;
    }else{
        $ultimo_numero_cotizacion = 1;
    }

    $tipo_solicitud = array(
        "M" => $textos["MANTENIMIENTO"],
        "E" => $textos["EMERGENCIA"],
        "S" => $textos["SERVICIO"],
        "P" => $textos["PROYECTO"],
        "V" => $textos["VISITA"]
    );
    
    $estado = array(
        "1" => $textos["APROBADA"],
        "0" => $textos["NO_APROBADA"]
    );
    
    $forma_pago = array(
        "0" => $textos["PAGO_PARCIAL"],
        "1" => $textos["CONTRAENTREGA"]
    );
    
    $estado_cliente = array(
        "0" => $textos["NO_ENVIADA"],
        "1" => $textos["ENVIADA"]
    );
    
    /*** Verificar que se haya enviado el ID del elemento a modificar ***/
    if (empty($url_id)) {
        $error     = $textos["ERROR_SELECCIONAR"];
        $titulo    = "";
        $contenido = "";        
    } else {
        $vistaConsulta     = "requerimientos_clientes";
        $condicion         = "id = '$url_id'";
        $columnas          = SQL::obtenerColumnas($vistaConsulta);
        $consulta          = SQL::seleccionar(array($vistaConsulta), $columnas, $condicion);
        $datos             = SQL::filaEnObjeto($consulta);
        
        if ($datos->estado_requerimiento=='3' || $datos->estado_requerimiento=='1'){
            $error             = "";
            $titulo            = $componente->nombre;
            $solicitud         = SQL::ObtenerValor("requerimientos_clientes", "tipo_solicitud", "id = '$url_id'");
            $id_municipio_sede = SQL::ObtenerValor("sedes_clientes", "id_municipios", "id = '$datos->id_sede'");
            $nombreSede        = SQL::ObtenerValor("sedes_clientes", "nombre_sede", "id = '$datos->id_sede'");
            $nombreMunicipio   = SQL::ObtenerValor("municipios", "nombre", "id = '$id_municipio_sede'");
            $nombreSucursal    = SQL::ObtenerValor("sucursales", "nombre", "id = '$datos->id_sucursal'");

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

            $formularios["PESTANA_REQUERIMIENTO"] = array(
                array(
                    HTML::mostrarDato("sucursal", $textos["EMPRESA"],$nombreSucursal),
                    HTML::mostrarDato("numero_requerimiento", $textos["NUMERO_REQUERIMIENTO"], number_format($datos->id)),
                    HTML::campoOculto("estado_requerimiento",$datos->estado_requerimiento)
                ),
                array(
                    HTML::mostrarDato("nombre_sede", $textos["SEDE"],$nombreSede),
                    HTML::mostrarDato("municipio", $textos["MUNICIPIO"], $nombreMunicipio)
                ),
                array(
                    HTML::mostrarDato("fecha_ingreso", $textos["FECHA_INGRESO"],$datos->fecha_ingreso),
                    HTML::mostrarDato("fecha_limte_visita", $textos["FECHA_LIMITE_VISITA"],$datos->fecha_limite_visita),
                    HTML::mostrarDato("fecha_visita", $textos["FECHA_VISITA"],$datos->fecha_visita)
                ),
                array(
                    HTML::mostrarDato("tipo_solictud", $textos["TIPO_SOLICITUD"],$tipo_solicitud[$datos->tipo_solicitud]),
                ),
                array(
                    HTML::mostrarDato("descripcion", $textos["DESCRIPCION"],$datos->descripcion)
                ),
                array(
                    HTML::mostrarDato("observaciones", $textos["OBSERVACIONES"],$datos->observaciones)
                ),
                array(
                    HTML::mostrarDato("nombre_contacto", $textos["CONTACTO"],$datos->nombre_contacto),
                    HTML::mostrarDato("telefono_contacto", $textos["TELEFONO_CONTACTO"],$datos->telefono_contacto)
                ),
                array(
                    HTML::mostrarDato("codigo_contable", $textos["CODIGO_CONTABLE"],$datos->codigo_contable)
                ),
                array(
                    HTML::mostrarDato("persona_recibe", $textos["PERSONA_RECIBE"],$datos->persona_recibe),
                    HTML::mostrarDato("medio_recibo", $textos["MEDIO_RECIBO"],$datos->medio_recibo)
                )
            );
            
            if($solicitud == 'P'){
                /*** Definición de pestañas general ***/
                $formularios["PESTANA_COTIZACION"] = array(
                   array(
                       HTML::campoTextoCorto("*numero_cotizacion", $textos["NUMERO_COTIZACION"], 8, 8, $ultimo_numero_cotizacion, array("title" => $textos["AYUDA_NUMERO_COTIZACION"])),
                       HTML::campoTextoCorto("*numero_cotizacion_consorciado", $textos["NUMERO_COTIZACION_CONSORCIADO"], 15, 15, "", array("title" => $textos["AYUDA_NUMERO_COTIZACION_CONSORCIADO"]))
                    ),
                    array(
                        HTML::campoTextoCorto("*valor_mano_obra_cotizacion", $textos["VALOR_MANO_OBRA_COTIZACION"], 12, 12, 0, array("title" => $textos["AYUDA_VALOR_MANO_OBRA_COTIZACION"], "class" => "numero", "onBlur" => "CalculaCosto()")),
                        HTML::campoTextoCorto("*valor_materiales_cotizacion", $textos["VALOR_MATERIALES_COTIZACION"], 12, 12, 0, array("title" => $textos["AYUDA_VALOR_MATERIALES_COTIZACION"], "class" => "numero", "onBlur" => "CalculaCosto()")),
                        HTML::campoTextoCorto("costo_directo", $textos["COSTO_DIRECTO"], 12, 12, 0, array("class" => "costo_directo", "title" => $textos["AYUDA_COSTO_DIRECTO"], "readonly" => "true"))
                    ),
                    array(
                        HTML::marcaSeleccion("aiu", $textos["AIU"], 1, true, array("id" => "si_aiu", "onChange" => "activarAiu(1)")),
                        HTML::marcaSeleccion("aiu", $textos["NO_AIU"], 0, false, array("id" => "no_aiu", "onChange" => "activarAiu(0)"))
                    ),
                    array(
                        HTML::campoTextoCorto("*porcentaje_administracion_cotizacion", $textos["PORCENTAJE_ADMINISTRACION_COTIZACION"], 4, 4, "", array("title" => $textos["AYUDA_PORCENTAJE_ADMINISTRACION_COTIZACION"],"onChange" => "CalculaAdministracion()")),
                        HTML::campoTextoCorto("costo_administracion_cotizacion", $textos["VALOR_ADMINISTRACION_COTIZACION"], 12, 12, 0, array("class" => "costo_administracion_cotizacion", "title" => $textos["AYUDA_VALOR_ADMINISTRACION_COTIZACION"], "readonly" => "true"))
                    ),
                    array(
                        HTML::campoTextoCorto("*porcentaje_imprevistos_cotizacion", $textos["PORCENTAJE_IMPREVISTOS_COTIZACION"], 4, 4, "", array("title" => $textos["AYUDA_PORCENTAJE_IMPREVISTOS_COTIZACION"],"onChange" => "CalculaImprevistos()")),
                        HTML::campoTextoCorto("costo_imprevistos_cotizacion", $textos["VALOR_IMPREVISTOS_COTIZACION"], 12, 12, 0, array("class" => "costo_imprevistos_cotizacion", "title" => $textos["AYUDA_VALOR_IMPREVISTOS_COTIZACION"], "readonly" => "true"))
                    ),
                    array(
                        HTML::campoTextoCorto("*porcentaje_utilidad", $textos["PORCENTAJE_UTILIDAD"], 4, 4, "", array("title" => $textos["AYUDA_PORCENTAJE_UTILIDAD"],"onChange" => "CalculaUtilidad()")),
                        HTML::campoTextoCorto("costo_utilidad", $textos["VALOR_UTILIDAD"], 12, 12, 0, array("class" => "costo_utilidad", "title" => $textos["AYUDA_VALOR_UTILIDAD"], "readonly" => "true"))
                    ),
                    array(
                        HTML::campoTextoCorto("*impuesto", $textos["IMPUESTO"], 5, 5, $valor[0],array("title" => $textos["AYUDA_IMPUESTO"],"onChange" => "CalculaCostoImpuesto()")),
                        HTML::campoTextoCorto("base_impuesto", $textos["VALOR_BASE_IMPUESTO"], 12, 12, 0, array("class" => "costo_impuesto", "title" => $textos["AYUDA_BASE_IMPUESTO"], "readonly" => "true")),
                        HTML::campoTextoCorto("costo_impuesto", $textos["VALOR_IMPUESTO"], 12, 12, 0, array("class" => "costo_impuesto", "title" => $textos["AYUDA_VALOR_IMPUESTO"], "readonly" => "true"))
                    ),
                    array(
                        HTML::campoTextoCorto("sub_total", $textos["SUB_TOTAL"], 12, 12, 0, array("class" => "sub_total", "title" => $textos["AYUDA_SUB_TOTAL"], "readonly" => "true")),
                        HTML::campoTextoCorto("total_general", $textos["TOTAL_GENERAL"], 12, 12, 0, array("class" => "total_general", "title" => $textos["AYUDA_TOTAL_GENERAL"], "readonly" => "true")),
            	        HTML::campoOculto("requerimiento", $datos->id)
                    )
                );
            } else if ($solicitud != 'P'){
            /*** Definición de pestañas general ***/
            
                $formularios["PESTANA_COTIZACION"] = array(
                   array(
                       HTML::campoTextoCorto("*numero_cotizacion", $textos["NUMERO_COTIZACION"], 8, 8, $ultimo_numero_cotizacion, array("title" => $textos["AYUDA_NUMERO_COTIZACION"])),
                       HTML::campoTextoCorto("*numero_cotizacion_consorciado", $textos["NUMERO_COTIZACION_CONSORCIADO"], 15, 15, "", array("title" => $textos["AYUDA_NUMERO_COTIZACION_CONSORCIADO"]))
                    ),
                    array(
                        HTML::campoTextoCorto("*valor_mano_obra_cotizacion", $textos["VALOR_MANO_OBRA_COTIZACION"], 12, 12, 0, array("title" => $textos["AYUDA_VALOR_MANO_OBRA_COTIZACION"], "class" => "numero", "onBlur" => "CalculaCosto()")),
                        HTML::campoTextoCorto("*valor_materiales_cotizacion", $textos["VALOR_MATERIALES_COTIZACION"], 12, 12, 0, array("title" => $textos["AYUDA_VALOR_MATERIALES_COTIZACION"], "class" => "numero", "onBlur" => "CalculaCosto()")),
                        HTML::campoTextoCorto("costo_directo", $textos["COSTO_DIRECTO"], 12, 12, 0, array("class" => "costo_directo", "title" => $textos["AYUDA_COSTO_DIRECTO"], "readonly" => "true"))
                    ),
                    array(
                        HTML::campoTextoCorto("*impuesto", $textos["IMPUESTO"], 5, 5, $valor[0],array("title" => $textos["AYUDA_IMPUESTO"],"onChange" => "CalculaCostoImpuesto()")),
                        HTML::campoTextoCorto("base_impuesto", $textos["VALOR_BASE_IMPUESTO"], 12, 12, 0, array("class" => "costo_impuesto", "title" => $textos["AYUDA_BASE_IMPUESTO"], "readonly" => "true")),
                        HTML::campoTextoCorto("costo_impuesto", $textos["VALOR_IMPUESTO"], 12, 12, 0, array("class" => "costo_impuesto", "title" => $textos["AYUDA_VALOR_IMPUESTO"], "readonly" => "true"))
                    ),
                    array(
                        HTML::campoTextoCorto("total_general", $textos["TOTAL_GENERAL"], 12, 12, 0, array("class" => "total_general", "title" => $textos["AYUDA_TOTAL_GENERAL"], "readonly" => "true")),
            	        HTML::campoOculto("requerimiento", $datos->id),
                        HTML::campoOculto("sub_total","")
                    ),
                    array(
                        HTML::campoOculto("aiu","0"),
                        HTML::campoOculto("porcentaje_administracion_cotizacion","0"),
                        HTML::campoOculto("costo_administracion_cotizacion", "0"),
                        HTML::campoOculto("porcentaje_imprevistos_cotizacion", "0"),
                        HTML::campoOculto("costo_imprevistos_cotizacion", "0"),
                        HTML::campoOculto("porcentaje_utilidad", "0"),
                        HTML::campoOculto("costo_utilidad", "0")
                    )
                );       
            }
            /*** Definición de botones ***/
            $botones = array(
                HTML::boton("botonAceptar", $textos["ACEPTAR"], "modificarItem('$url_id');", "aceptar")
            );

            $contenido = HTML::generarPestanas($formularios, $botones);
        } else {
            $error     = $textos["REQUERIMIENTO_COTIZADO"];
            $titulo    = "";
            $contenido = "";
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
    if ($url_item == "numero_cotizacion" && $url_valor) {
        $existe = SQL::existeItem("cotizaciones", "numero_cotizacion", $url_valor);

        if ($existe) {
            $respuesta = $textos["ERROR_EXISTE_NUMERO_COTIZACION"];
        }
    }
    
    HTTP::enviarJSON($respuesta);
    

/*** Adicionar los datos provenientes del formulario ***/
} elseif (!empty($forma_procesar)) {
    
    /*** Asumir por defecto que no hubo error ***/
    $error   = false;
    $mensaje = $textos["ITEM_ADICIONADO"];
    if(empty($forma_aiu)){
        $forma_aiu = 0;
    }
    
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
        
    if($forma_aiu == "1"){     
    
    /*** Validar el ingreso de los datos requeridos ***/                                                                                                                          
        /*if (empty($forma_numero_cotizacion) ||
            empty($forma_numero_cotizacion_consorciado) ||
            empty($forma_fecha_visita) ||
            empty($forma_valor_mano_obra_cotizacion) ||
            empty($forma_valor_materiales_cotizacion) ||
            empty($forma_porcentaje_anticipo) ||
            empty($forma_porcentaje_administracion_cotizacion) ||
            empty($forma_porcentaje_imprevistos_cotizacion) ||
            empty($forma_porcentaje_utilidad) ||
            empty($forma_impuesto)) {
            $error   = true;                                                                                                                                                          
            $mensaje = $textos["ERROR_DATOS_INCOMPLETOS"];*/
        if (empty($forma_numero_cotizacion)){
            $error   = true;
            $mensaje = "NUMERO COTIZACION VACIO";
        } elseif(empty($forma_numero_cotizacion_consorciado)){
            $error   = true;
            $mensaje = "NUMERO COTIZACION CONSORCIADO VACIO";
        } elseif(empty($forma_valor_mano_obra_cotizacion) && empty($forma_valor_materiales_cotizacion)){
            $error   = true;
            $mensaje = "MANO DE OBRA Y/O MATERIALES VACIO";
        } elseif(empty($forma_porcentaje_administracion_cotizacion)){
            $error   = true;
            $mensaje = "PORCENTAJE ADMINISTRACION VACIO";
        } elseif(empty($forma_porcentaje_imprevistos_cotizacion)){
            $error   = true;
            $mensaje = "PORCENTAJE ADMINISTRACION VACIO";
        } elseif(empty($forma_porcentaje_utilidad)){
            $error   = true;
            $mensaje = "PORCENTAJE UTILIDAD VACIO";
        } elseif(empty($forma_impuesto)){
            $error   = true;
            $mensaje = "IMPUESTO VACIO";
        } elseif(empty($forma_costo_impuesto)){
            $error   = true;
            $mensaje = "COSTO IMPUESTO VACIO";
        } elseif (SQL::existeItem("cotizaciones", "numero_cotizacion", $forma_numero_cotizacion, "")) {
            $error   = true;                                                                                                                                                          
            $mensaje =  $textos["ERROR_EXISTE_NUMERO_COTIZACION"];                                                                                                                    
                                                                                                                                                                                      
        } elseif (!empty($forma_numero_cotizacion) && !Cadena::validarNumeros($forma_numero_cotizacion)) {                                                                            
            $error   = true;                                                                                                                                                          
            $mensaje =  $textos["ERROR_FORMATO_NUMERO_COTIZACION"];                                                                                                                   
                                                                                                                                                                                      
        } elseif (!empty($forma_valor_mano_obra_cotizacion) && !Cadena::validarNumeros($forma_valor_mano_obra_cotizacion)) {                                                          
            $error   = true;                                                                                                                                                          
            $mensaje =  $textos["ERROR_FORMATO_MANO_OBRA"];                                                                                                                           
                                                                                                                                                                                      
        } elseif (!empty($forma_valor_materiales_cotizacion) && !Cadena::validarNumeros($forma_valor_materiales_cotizacion)) {                                                        
            $error   = true;                                                                                                                                                          
            $mensaje =  $textos["ERROR_FORMATO_MATERIALES"];                                                                                                                          
                                                                                                                                                                                      
        } elseif (!empty($forma_porcentaje_anticipo) && !Cadena::validarNumeros($forma_porcentaje_anticipo)) {                                                                        
            $error   = true;                                                                                                                                                          
            $mensaje =  $textos["ERROR_FORMATO_PORCENTAJE_ANTICIPO"];                                                                                                                 
                                                                                                                                                                                      
        } elseif (!empty($forma_porcentaje_mano_obra) && !Cadena::validarNumeros($forma_porcentaje_mano_obra)) {                                                                      
            $error   = true;                                                                                                                                                          
            $mensaje =  $textos["ERROR_FORMATO_PORCENTAJE_MANO_OBRA"];                                                                                                                
                                                                                                                                                                                      
        } elseif (!empty($forma_porcentaje_materiales) && !Cadena::validarNumeros($forma_porcentaje_materiales)) {                                                                    
            $error   = true;                                                                                                                                                          
            $mensaje =  $textos["ERROR_FORMATO_PORCENTAJE_MATERIALES"];                                                                                                               
                                                                                                                                                                                      
        } elseif (!empty($forma_porcentaje_administracion_cotizacion) && !Cadena::validarNumeros($forma_porcentaje_administracion_cotizacion)) {                                                
            $error   = true;                                                                                                                                                          
            $mensaje =  $textos["ERROR_FORMATO_ADMINISTRACION"];                                                                                                                      
                                                                                                                                                                                      
        } elseif (!empty($forma_porcentaje_imprevistos_cotizacion) && !Cadena::validarNumeros($forma_porcentaje_imprevistos_cotizacion)) {                                                      
            $error   = true;                                                                                                                                                          
            $mensaje =  $textos["ERROR_FORMATO_IMPREVISTOS"];                                                                                                                         
                                                                                                                                                                                      
        } elseif (!empty($forma_porcentaje_utilidad) && !Cadena::validarNumeros($forma_porcentaje_utilidad)) {                                                                                              
            $error   = true;                                                                                                                                                          
            $mensaje =  $textos["ERROR_FORMATO_UTILIDAD"];                                                                                                                            
                                                                                                                                                                                                                                                                                                                                                                            
        } else {
            $datos = array(                                                                                                                                                                                                                                                                                                                                                                          
                "id_requerimiento"                      => $forma_requerimiento,
                "numero_cotizacion"                     => $forma_numero_cotizacion,
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
                "estado_requerimiento" => 4
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
            (empty($forma_valor_mano_obra_cotizacion) && empty($forma_valor_materiales_cotizacion)) ||
            empty($forma_impuesto)) {
            $error   = true;                                                                                                                                                          
            $mensaje = $textos["ERROR_DATOS_INCOMPLETOS"];                                                                                                                            
                                                                                                                                                                                      
        } elseif (SQL::existeItem("cotizaciones", "numero_cotizacion", $forma_numero_cotizacion, "")) {                                                                    
            $error   = true;                                                                                                                                                        
            $mensaje =  $textos["ERROR_EXISTE_NUMERO_COTIZACION"];                                                                                                                    
                                                                                                                                                                                      
        } elseif (!empty($forma_numero_cotizacion) && !Cadena::validarNumeros($forma_numero_cotizacion)) {                                                                            
            $error   = true;                                                                                                                                                          
            $mensaje =  $textos["ERROR_FORMATO_NUMERO_COTIZACION"];                                                                                                                   
                                                                                                                                                                                      
        } elseif (!empty($forma_valor_mano_obra_cotizacion) && !Cadena::validarNumeros($forma_valor_mano_obra_cotizacion)) {                                                          
            $error   = true;                                                                                                                                                          
            $mensaje =  $textos["ERROR_FORMATO_MANO_OBRA"];                                                                                                                           
                                                                                                                                                                                      
        } elseif (!empty($forma_valor_materiales_cotizacion) && !Cadena::validarNumeros($forma_valor_materiales_cotizacion)) {                                                        
            $error   = true;                                                                                                                                                          
            $mensaje =  $textos["ERROR_FORMATO_MATERIALES"];                                                                                                                          
                                                                                                                                                                                      
        } elseif (!empty($forma_porcentaje_anticipo) && !Cadena::validarNumeros($forma_porcentaje_anticipo)) {                                                                        
            $error   = true;                                                                                                                                                          
            $mensaje =  $textos["ERROR_FORMATO_PORCENTAJE_ANTICIPO"];                                                                                                                 
                                                                                                                                                                                      
        } elseif (!empty($forma_porcentaje_mano_obra) && !Cadena::validarNumeros($forma_porcentaje_mano_obra)) {                                                                      
            $error   = true;                                                                                                                                                          
            $mensaje =  $textos["ERROR_FORMATO_PORCENTAJE_MANO_OBRA"];                                                                                                                
                                                                                                                                                                                      
        } elseif (!empty($forma_porcentaje_materiales) && !Cadena::validarNumeros($forma_porcentaje_materiales)) {                                                                    
            $error   = true;                                                                                                                                                          
            $mensaje =  $textos["ERROR_FORMATO_PORCENTAJE_MATERIALES"];                                                                                                               
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     
        } else {                                                                                                                                                                      
            $datos = array(                                                                                                                                                           
                "id_requerimiento"                      => $forma_requerimiento,
                "numero_cotizacion"                     => $forma_numero_cotizacion,
                "numero_cotizacion_consorciado"         => $forma_numero_cotizacion_consorciado,
                "estado"                                => '1',
                "valor_mano_obra_cotizacion"            => $forma_valor_mano_obra_cotizacion,                                                                                               
                "valor_materiales_cotizacion"           => $forma_valor_materiales_cotizacion,   
                "costo_directo"                         => $forma_costo_directo,
                "impuesto"                              => $forma_impuesto,
                "costo_impuesto"                        => $forma_costo_impuesto,
                "forma_pago"                            => $forma_forma_pago,                                                                                                               
                "porcentaje_anticipo"                   => $forma_porcentaje_anticipo,                                                                                                      
                "fecha_registro_cotizacion_consorciado" => $forma_fecha_registro_cotizacion_consorciado,
                "numero_contrato"                       => $forma_numero_contrato,
                "numero_poliza"                         => $forma_numero_poliza
            );                                                                                                                                                                        
            
            $insertar = SQL::insertar("cotizaciones", $datos);                                                                                        
                                                                                                                                                                                      
           /*** Error de inserción ***/
            if (!$insertar) {
                $error   = true;
                $mensaje = $textos["ERROR_ADICIONAR_ITEM"];
            }            
                
            $datos = array(
                "estado_requerimiento" => 4
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

    /*** Enviar datos con la respuesta del proceso al script que originó la petición ***/
    $respuesta    = array();
    $respuesta[0] = $error;
    $respuesta[1] = $mensaje;
    $respuesta[2] = $mensaje;
    HTTP::enviarJSON($respuesta);
}
?>
