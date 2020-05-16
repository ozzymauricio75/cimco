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
    $error  = "";
    $titulo = $componente->nombre;

    $tipo_acta = array(
        "1" => $textos["ACTA_INICIO"],
        "2" => $textos["ACTA_AVANCE_OBRA"],
        "3" => $textos["ACTA_FINALIZACION"],
        "4" => $textos["INFORME"]
    );
        
    /*** Verificar que se haya enviado el ID del elemento a consultar ***/
    if (empty($url_id)) {
        $error     = $textos["ERROR_CONSULTAR_VACIO"];
        $titulo    = "";
        $contenido = "";

    } else {
        /*** Obtener los resultados para la pagina actual ***/
        $vistaConsulta                   = "cotizaciones";                                                             
        $columnas                        = SQL::obtenerColumnas($vistaConsulta);                                       
        $consulta                        = SQL::seleccionar(array($vistaConsulta), $columnas, "id = '$url_id'");       
        $datos                           = SQL::filaEnObjeto($consulta);                                               
        $error                           = "";                                                                         
        $titulo                          = $componente->nombre;                                                        
        $subTotal                        = $datos->costo_administracion_cotizacion + $datos->costo_imprevistos_cotizacion + $datos->costo_utilidad  + $datos->costo_impuesto; 
        $totalGeneral                    = $subTotal + $datos->costo_directo;

        $valor_mano_obra_cotizacion  = number_format($datos->valor_mano_obra_cotizacion);
        $valor_materiales_cotizacion    = number_format($datos->valor_materiales_cotizacion);
        $costo_directo = number_format($datos->costo_directo);
        if (!empty($datos->porcentaje_administracion_cotizacion) &&
            $datos->porcentaje_administracion_cotizacion > 0){
            $base_administracion        = $textos["VALOR_BASE"];
            $simbolo_admin_porcentaje   = $textos["SIMBOLO_PORCENTAJE"];
            $simbolo_admin_peso         = $textos["SIMBOLO_PESO"];
            $valor_base_administracion  = $datos->costo_directo;
            $valor_base_administracion  = number_format($valor_base_administracion);
            $administracion             = $textos["PORCENTAJE_ADMINISTRACION_COTIZACION"];
            $porcentaje_administracion  = $datos->porcentaje_administracion_cotizacion;
            $texto_costo_administracion = $textos["VALOR_ADMINISTRACION_COTIZACION"];
            $costo_administracion       = number_format($datos->costo_administracion_cotizacion);
        } else{
            $base_administracion        = "";
            $simbolo_admin_porcentaje   = "";
            $simbolo_admin_peso         = "";
            $valor_base_administracion  = "";
            $administracion             = "";
            $porcentaje_administracion  = "";
            $texto_costo_administracion = "";
            $costo_administracion       = "";
        }
        if (!empty($datos->porcentaje_imprevistos_cotizacion) &&
            $datos->porcentaje_imprevistos_cotizacion > 0){
            $base_imprevistos        = $textos["VALOR_BASE"];
            $simbolo_impr_porcentaje = $textos["SIMBOLO_PORCENTAJE"];
            $simbolo_impr_peso       = $textos["SIMBOLO_PESO"];
            $valor_base_imprevistos  = $datos->costo_directo;
            $valor_base_imprevistos  = number_format($valor_base_imprevistos);
            $imprevistos             = $textos["PORCENTAJE_IMPREVISTOS_COTIZACION"];
            $porcentaje_imprevistos  = $datos->porcentaje_imprevistos_cotizacion;
            $texto_costo_imprevistos = $textos["VALOR_IMPREVISTOS_COTIZACION"];
            $costo_imprevistos       = number_format($datos->costo_imprevistos_cotizacion);
        } else{
            $base_imprevistos        = "";
            $simbolo_impr_porcentaje = "";
            $simbolo_impr_peso       = "";
            $valor_base_imprevistos  = "";
            $imprevistos             = "";
            $porcentaje_imprevistos  = "";
            $texto_costo_imprevistos = "";
            $costo_imprevistos       = "";
        }
        if (!empty($datos->porcentaje_utilidad) &&
            $datos->porcentaje_utilidad > 0){
            $base_utilidad           = $textos["VALOR_BASE"];
            $simbolo_util_porcentaje = $textos["SIMBOLO_PORCENTAJE"];
            $simbolo_util_peso       = $textos["SIMBOLO_PESO"];
            $valor_base_utilidad     = $datos->costo_directo;
            $valor_base_utilidad     = number_format($valor_base_utilidad);
            $utilidad                = $textos["PORCENTAJE_UTILIDAD"];
            $porcentaje_utilidad     = $datos->porcentaje_utilidad;
            $texto_costo_utilidad    = $textos["VALOR_UTILIDAD"];
            $costo_utilidad          = number_format($datos->costo_utilidad);
        } else{
            $base_utilidad           = "";
            $base_administracon      = "";
            $base_administracon      = "";
            $simbolo_util_porcentaje = "";
            $simbolo_util_peso       = "";
            $valor_base_utilidad     = "";
            $utilidad                = "";
            $porcentaje_utilidad     = "";
            $texto_costo_utilidad    = "";
            $costo_utilidad          = "";
        }
        if ((!empty($datos->porcentaje_utilidad) && $datos->porcentaje_utilidad > 0)){
            $base             = $datos->costo_utilidad;
            $titulo_subtotal  = $textos["SUB_TOTAL"];
            $simbolo_subtotal = $textos["SIMBOLO_PESO"];
            $subTotal         = $datos->costo_administracion_cotizacion + $datos->costo_imprevistos_cotizacion + $datos->costo_utilidad + $datos->costo_impuesto;
            $totalGeneral     = $subTotal + $datos->costo_directo;
        } else {
            $base             = $datos->costo_directo;
            $titulo_subtotal  = "";
            $simbolo_subtotal = "";
            $subTotal         = "";
            $totalGeneral     = $datos->costo_impuesto + $datos->costo_directo;
        }
        $base               = number_format($base);
        $costo_impuesto     = number_format($datos->costo_impuesto);
        $porcentajeAnticipo = ($totalGeneral * $datos->porcentaje_anticipo)/100;
        if($subTotal > 0){
            $subTotal = number_format($subTotal);
        }
        
        $estado                          = SQL::obtenerValor("buscador_cotizaciones", "estado", "id = '$url_id'");                                       
        $forma_pago                      = SQL::obtenerValor("buscador_cotizaciones", "forma_pago", "id = '$url_id'");                                   
                                                                                                                                                         
        $vistaRequerimiento             = "requerimientos_clientes";
        $columnasRequerimiento          = SQL::obtenerColumnas($vistaRequerimiento);
        $consultaRequerimiento          = SQL::seleccionar(array($vistaRequerimiento), $columnasRequerimiento, "id = '$datos->id_requerimiento'");
        $datosRequerimiento             = SQL::filaEnObjeto($consultaRequerimiento);
        $nombreSede                     = SQL::obtenerValor("sedes_clientes", "nombre_sede", "id = '$datosRequerimiento->id_sede'");                                           
        $municipio                      = SQL::obtenerValor("sedes_clientes", "id_municipios", "id = '$datosRequerimiento->id_sede'");
        
        $tipo_solicitud = array(
            "M" => $textos["MANTENIMIENTO"],
            "E" => $textos["EMERGENCIA"],
            "S" => $textos["SERVICIO"],
            "P" => $textos["PROYECTO"],
            "V" => $textos["VISITA"]
        );
        
        $nombreMunicipio                = SQL::obtenerValor("municipios", "nombre", "id = '$municipio'");                                               
        $id_sucursal                    = SQL::obtenerValor("requerimientos_clientes", "id_sucursal", "id = '$datos->id_requerimiento'");               
        $nombreSucursal                 = SQL::obtenerValor("sucursales", "nombre", "id = '$id_sucursal'"); 
        $acta                           = SQL::obtenerValor("registro_obras", "tipo_acta", "id_cotizacion = '$url_id'");
        $valor_facturar                 = SQL::obtenerValor("registro_obras", "valor_facturar", "id_cotizacion = '$url_id'");
       
        $consulta                        = mysql_query("SELECT SUM(valor_facturar)AS valor FROM pance_registro_obras WHERE id_cotizacion = '$url_id'");
        $resultado                       = mysql_fetch_object($consulta);
        $acumulado                       = $resultado->valor;
        $acumulado_formato               = $totalGeneral - $acumulado;
        $acumulado_formato               = number_format($acumulado_formato);
     
       if ($acumulado >= $totalGeneral) {
            $error        = "La obra se encuentra finalizada";
            $respuesta    = array();
            $respuesta[0] = $error;
            $respuesta[1] = $error;
            HTTP::enviarJSON($respuesta);
            exit();
      
        } else {
            /*** Definición de pestañas ***/
            $formularios["PESTANA_REQUERIMIENTO"] = array(
                array(   
                    HTML::mostrarDato("sucursal", $textos["SUCURSAL"], $nombreSucursal),
                    HTML::mostrarDato("numero_requerimiento", $textos["NUMERO_REQUERIMIENTO"], $datosRequerimiento->id),
                ),
                array(   
                    HTML::mostrarDato("nombre_sede", $textos["SEDE"], $nombreSede),
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
                    HTML::mostrarDato("descripcion", $textos["DESCRIPCION"], $datosRequerimiento->descripcion)
                ),
                array(    
                    HTML::mostrarDato("observaciones", $textos["OBSERVACIONES_VISITA"], $datosRequerimiento->observaciones_visita)
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
                    HTML::mostrarDato("numero_cotizacion", $textos["NUMERO_COTIZACION"], $datos->numero_cotizacion."-".$datos->consecutivo_cotizacion),
                    HTML::mostrarDato("numero_cotizacion_consorciado", $textos["NUMERO_COTIZACION_CONSORCIADO"], $datos->numero_cotizacion_consorciado)
                ),
                array(    
                    HTML::mostrarDato("valor_mano_obra_cotizacion", $textos["VALOR_MANO_OBRA_COTIZACION"], $textos["SIMBOLO_PESO"].$valor_mano_obra_cotizacion),
                    HTML::mostrarDato("valor_materiales_cotizacion", $textos["VALOR_MATERIALES_COTIZACION"], $textos["SIMBOLO_PESO"].$valor_materiales_cotizacion),
                    HTML::mostrarDato("costo", $textos["COSTO_DIRECTO"], $textos["SIMBOLO_PESO"].$costo_directo),  
                ),
                array(
                    HTML::mostrarDato("porcentaje_administracion", $administracion, $porcentaje_administracion.$simbolo_admin_porcentaje),
                    HTML::mostrarDato("costo_administracion", $texto_costo_administracion, $simbolo_admin_peso.$costo_administracion)
                ),
                array(
                    HTML::mostrarDato("porcentaje_imprevistos", $imprevistos, $porcentaje_imprevistos.$simbolo_impr_porcentaje),
                    HTML::mostrarDato("costo_imprevistos", $texto_costo_imprevistos, $simbolo_impr_peso.$costo_imprevistos)
                ),
                array(
                    HTML::mostrarDato("porcentaje_utilidad", $utilidad, $porcentaje_utilidad.$simbolo_util_porcentaje),
                    HTML::mostrarDato("costo_utilidad", $texto_costo_utilidad, $simbolo_util_peso.$costo_utilidad)
                ),
                array(
                    HTML::mostrarDato("base", $textos["BASE_IMPUESTO"], $textos["SIMBOLO_PESO"].$base),
                    HTML::mostrarDato("impuesto", $textos["IMPUESTO"], $datos->impuesto.$textos["SIMBOLO_PORCENTAJE"]),
                    HTML::mostrarDato("costo_impuesto", $textos["VALOR_IMPUESTO"], $textos["SIMBOLO_PESO"].$costo_impuesto)
                ),
                array(
                    HTML::mostrarDato("sub_total", $titulo_subtotal, $simbolo_subtotal.$subTotal),
                ),
/*                array(    
                    HTML::mostrarDato("sub_total", $textos["SUB_TOTAL"], $textos["SIMBOLO_PESO"].$subTotal)
                ),*/
                array(
                    HTML::mostrarDato("total_general", $textos["TOTAL_GENERAL"], $textos["SIMBOLO_PESO"].number_format($totalGeneral))
                )
            );
            
            if ($datosRequerimiento->tipo_solicitud == "P") {
          
                $formularios["PESTANA_DATOS_CONTROL"] = array(
                    array(   
                        HTML::marcaSeleccion("tipo_acta", $textos["ACTA_INICIO"], 1, true, array("id" => "inicio", "onChange" => "activarValorFacturar(1)"))
                    ),   
                    array(   
                        HTML::marcaSeleccion("tipo_acta", $textos["ACTA_AVANCE_OBRA"], 2, false, array("id" => "avance", "onChange" => "activarValorFacturar(2)"))
                    ),   
                    array(   
                        HTML::marcaSeleccion("tipo_acta", $textos["ACTA_FINALIZACION"], 3, false, array("id" => "avance", "onChange" => "activarValorFacturar(3)"))
                    ),
                    array(   
                        HTML::marcaSeleccion("tipo_acta", $textos["INFORME"], 4, false, array("id" => "informe", "onChange" => "activarValorFacturar(4)"))
                    ),
                    array(   
                        HTML::campoTextoCorto("*fecha_entrega_acta", $textos["FECHA_ENTREGA_ACTA"], 10, 10, date("Y-m-d"), array("class" => "selectorFecha"), array("title" => $textos["AYUDA_FECHA_ENTREGA_ACTA"])),
                    ),
                    array(   
                        HTML::campoTextoCorto("numero_factura", $textos["NUMERO_FACTURA"], 12, 15, 0, array("title" => $textos["AYUDA_NUMERO_FACTURA"])),
                        HTML::campoTextoCorto("*valor_facturar", $textos["VALOR_FACTURAR"], 12, 12, 0, array("title" => $textos["AYUDA_VALOR_FACTURAR"],"class" => "numero")),
                        HTML::campoTextoCorto("*porcentaje_mano_obra", $textos["PORCENTAJE_MANO_OBRA"], 4, 4, "", array("title" => $textos["AYUDA_PORCENTAJE_MANO_OBRA"])),
                        HTML::campoTextoCorto("*porcentaje_materiales", $textos["PORCENTAJE_MATERIALES"], 4, 4, "", array("title" => $textos["AYUDA_PORCENTAJE_MATERIALES"]))
                    ),            
                    array(
                        HTML::selectorArchivo("imagen", $textos["IMAGEN"], array("title" => $textos["AYUDA_IMAGEN"]))
                    ),
                    array(
                        HTML::campoTextoLargo("informes", $textos["INFORME"], 10, 50, "", array("title" => $textos["AYUDA_INFORME"]))
                    ),
                    array(
      	                HTML::campoOculto("requerimiento", $datos->id_requerimiento),
      	                HTML::campoOculto("cotizacion", $url_id),
      	                HTML::campoOculto("acumulado", $acumulado),
      	                HTML::campoOculto("total_general", $totalGeneral)
                    )
                );
          
            } else {
          
                $formularios["PESTANA_DATOS_CONTROL"] = array(
                    array(   
                        HTML::marcaSeleccion("tipo_acta", $textos["ACTA_FINALIZACION"], 3, true, array("id" => "avance", "onChange" => "activarValorFacturar(3)"))
                    ),
                    array(   
                        HTML::campoTextoCorto("*fecha_entrega_acta", $textos["FECHA_ENTREGA_ACTA"], 10, 10, date("Y-m-d"), array("class" => "selectorFecha"), array("title" => $textos["AYUDA_FECHA_ENTREGA_ACTA"])),
                    ),
                    array(   
                        HTML::campoTextoCorto("numero_factura", $textos["NUMERO_FACTURA"], 12, 15, 0, array("title" => $textos["AYUDA_NUMERO_FACTURA"])),
                        HTML::campoTextoCorto("*valor_facturar", $textos["VALOR_FACTURAR"], 12, 12, 0, array("title" => $textos["AYUDA_VALOR_FACTURAR"],"class" => "numero")),    
                        HTML::campoTextoCorto("*porcentaje_mano_obra", $textos["PORCENTAJE_MANO_OBRA"], 4, 4, "", array("title" => $textos["AYUDA_PORCENTAJE_MANO_OBRA"])),
                        HTML::campoTextoCorto("*porcentaje_materiales", $textos["PORCENTAJE_MATERIALES"], 4, 4, "", array("title" => $textos["AYUDA_PORCENTAJE_MATERIALES"]))
                    ),            
                    array(
                        HTML::selectorArchivo("imagen", $textos["IMAGEN"], array("title" => $textos["AYUDA_IMAGEN"]))
                    ),
                    array(
  	                    HTML::campoOculto("requerimiento", $datos->id_requerimiento),
  	                    HTML::campoOculto("cotizacion", $url_id),
  	                    HTML::campoOculto("acumulado", $acumulado),
  	                    HTML::campoOculto("total_general", $totalGeneral)
                    )
                );  
            }
            /*** Definición de botones ***/
            $botones = array(
                HTML::boton("botonAceptar", $textos["ACEPTAR"], "adicionarItem();", "aceptar")
            );
            $contenido = HTML::generarPestanas($formularios, $botones);
            
        }
    }
    /*** Enviar datos para la generación del formulario al script que originó la petición ***/
    $respuesta[0] = $error;
    $respuesta[1] = $titulo;
    $respuesta[2] = $contenido;
    HTTP::enviarJSON($respuesta);
    exit();
    
/*** Validar los datos provenientes del formulario ***/
} elseif (!empty($url_validar)) {

    /*** Validar numero de la cotizacion consorciado***/
    if ($url_item == "id" && $url_valor) {
        $existe = SQL::existeItem("registro_obras", "id", $url_valor);

        if ($existe) {
            $respuesta = $textos["ERROR_EXISTE_ACTA"];
        }
    }
    
    HTTP::enviarJSON($respuesta);
    exit();
}
    /*** Adicionar los datos provenientes del formulario ***/
    /*** Asumir por defecto que no hubo error ***/
    $error   = false;
    $mensaje = $textos["ITEM_ADICIONADO"];

    if(!isset($forma_factura_consorciado)){
        $forma_factura_consorciado = 0;
    }
    if(!isset($forma_pago_cliente)){
        $forma_pago_cliente = 0;
    }
    if(!isset($forma_pago_consorciado)){
        $forma_pago_consorciado = 0;
    }
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
    
    $forma_valor_facturar = quitarMiles($forma_valor_facturar);
    $forma_total_general  = quitarMiles($forma_total_general);
    
    if($forma_tipo_acta == '1' || $forma_tipo_acta == '4'){
        if (empty($forma_tipo_acta) || empty($forma_fecha_entrega_acta)){
            $error   = true;
            $mensaje = $textos["ERROR_DATOS_INCOMPLETOS"];
        }
    }else{
        if (empty($forma_tipo_acta) || empty($forma_fecha_entrega_acta) || empty($forma_porcentaje_mano_obra) || empty($forma_porcentaje_materiales)){
            $error   = true;
            $mensaje = $textos["ERROR_DATOS_INCOMPLETOS"];
        }
    }
    if (!empty($forma_valor_facturar) && !Cadena::validarNumeros($forma_valor_facturar)) {                                                          
            $error   = true;                                                                                                                                                          
            $mensaje =  $textos["ERROR_FORMATO_VALOR_FACTURAR"];     
    }elseif (!empty($forma_porcentaje_mano_obra) && !Cadena::validarNumeros($forma_porcentaje_mano_obra)) {                                                          
            $error   = true;                                                                                                                                                          
            $mensaje =  $textos["ERROR_FORMATO_PORCENTAJE_MANO_OBRA"];     
    }elseif (!empty($forma_porcentaje_materiales) && !Cadena::validarNumeros($forma_porcentaje_materiales)) {                                                          
            $error   = true;                                                                                                                                                          
            $mensaje =  $textos["ERROR_FORMATO_PORCENTAJE_MATERIALES"];     
    }else{
        $total_acumulado      = $forma_acumulado + $forma_valor_facturar;
        /*if(($forma_tipo_acta == '3') && ($total_acumulado < $forma_total_general) || ($forma_tipo_acta == '3') && ($forma_valor_facturar > $forma_total_general)){
            $error        = "El valor del acta finalización debe ser igual al total general";
            $respuesta    = array();
            $respuesta[0] = $error;
            $respuesta[1] = $error;
            HTTP::enviarJSON($respuesta);
            exit();

        }elseif($forma_acumulado >= $forma_total_general){
            $error        = $textos["ERROR_COMPLETO_OBRA"];
            $respuesta    = array();
            $respuesta[0] = $error;
            $respuesta[1] = $error;
            HTTP::enviarJSON($respuesta);
            exit();
   
        }elseif($total_acumulado > $forma_total_general){     
            $resto_facturar = $forma_total_general - $forma_acumulado;
            $error          = $textos["FALTA_FACTURAR"].number_format($resto_facturar);
            $respuesta      = array();
            $respuesta[0]   = $error;
            $respuesta[1]   = $error;
            HTTP::enviarJSON($respuesta);
            exit();

        } else{
        */  $datos = array(
                "id_cotizacion"         => $forma_cotizacion,
                "tipo_acta"             => $forma_tipo_acta,
                "fecha_entrega_acta"    => $forma_fecha_entrega_acta,
                "valor_facturar"        => $forma_valor_facturar,
                "numero_factura"        => $forma_numero_factura,
                "porcentaje_mano_obra"  => $forma_porcentaje_mano_obra,
                "porcentaje_materiales" => $forma_porcentaje_materiales,
                "informe"               => $forma_informes
            );

            $insertar = SQL::insertar("registro_obras", $datos);                                                                                        
           
            if($forma_tipo_acta == '3'){
                
                $datos1 = array(
                    "tipo_acta" => $forma_tipo_acta,
                    "estado"    => 4
                );
                $consulta1 = SQL::modificar("cotizaciones", $datos1, "id = '$forma_cotizacion'");  
                                
            }elseif($forma_tipo_acta == '2'){ 
                $datos1 = array(
                    "tipo_acta" => $forma_tipo_acta,
                    "estado"    => 5
                );
                $consulta1 = SQL::modificar("cotizaciones", $datos1, "id = '$forma_cotizacion'"); 
                
            
            }else{
                $datos1 = array(
                    "tipo_acta" => $forma_tipo_acta
                );
                $consulta1 = SQL::modificar("cotizaciones", $datos1, "id = '$forma_cotizacion'"); 
            }
            
            /*** Error de inserción ***/
            if (!$insertar) {
                $error   = true;
                $mensaje = $textos["ERROR_ADICIONAR_ITEM"];
        
            } else {
                   if (!empty($_FILES["imagen"])) {
                    $idAsignado = SQL::$ultimoId;
                    $original   = $_FILES["imagen"]["name"];
                    $temporal   = $_FILES["imagen"]["tmp_name"];
                    $extension  = strtolower(substr($original, (strrpos($original, ".") - strlen($original)) + 1));

                    if (strtolower($extension) != "png" && strtolower($extension) != "jpg" && strtolower($extension) != "gif") {
                        $error   = true;
                        $mensaje = $textos["ERROR_FORMATO_IMAGEN"];

                    } else {
                        list($ancho, $alto, $tipo) = getimagesize($temporal);

                        $datos   = array(
                            "categoria"   => 2,
                            "id_asociado" => $idAsignado,
                            "contenido"   => file_get_contents($temporal),
                            "tipo"        => $tipo,
                            "extension"   => $extension,
                            "ancho"       => $ancho,
                            "alto"        => $alto
                        );

                        $insertar = SQL::insertarArchivo("imagenes", $datos);
                        /*** Error de insercón ***/
                        if (!$insertar) {
                            $error   = true;
                            $mensaje = $textos["ERROR_ADICIONAR_IMAGEN"];
                        }
                    }
                }
            }
    }
    /*** Enviar datos con la respuesta del proceso al script que originï¿½ la peticiï¿½n ***/
    $respuesta    = array();
    $respuesta[0] = $error;
    $respuesta[1] = $mensaje;
    HTTP::enviarJSON($respuesta);
?>
