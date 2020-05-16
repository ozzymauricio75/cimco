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
if (!empty($url_generar)) {
        
    $tipo_solicitud = array(
        "M" => $textos["MANTENIMIENTO"],
        "E" => $textos["EMERGENCIA"],
        "S" => $textos["SERVICIO"],
        "P" => $textos["PROYECTO"]
    );
   
   $forma_pago = array(
        "0" => $textos["PAGO_PARCIAL"],
        "1" => $textos["CONTRAENTREGA"]
   );

    /*** Verificar que se haya enviado el ID del elemento a consultar ***/
    if (empty($url_id)) {
        $error     = $textos["ERROR_CONSULTAR_VACIO"];
        $titulo    = "";
        $contenido = "";
    } else {
        $error     = "";
        $titulo    = $componente->nombre;
        $contenido = "";
    	  
        /*** Obtener datos para la consulta ***/
        $vistaConsulta               = "cotizaciones";
        $columnas                    = SQL::obtenerColumnas($vistaConsulta);
        $consulta                    = SQL::seleccionar(array($vistaConsulta), $columnas, "id = '$url_id'");
        $datos                       = SQL::filaEnObjeto($consulta);
        $error                       = "";
        $titulo                      = $componente->nombre;

        $Sede                        = SQL::obtenerValor("requerimientos_clientes", "id_sede", "id = '$datos->id_requerimiento'");
        $nombreSede                  = SQL::obtenerValor("sedes_clientes", "nombre_sede", "id = '$Sede'");
        $municipio                   = SQL::obtenerValor("sedes_clientes", "id_municipios", "id = '$Sede'");
        $nombreMunicipio             = SQL::obtenerValor("municipios", "nombre", "id = '$municipio'");
        
        $vistaRequerimiento          = "requerimientos_clientes";
        $columnasRequerimiento       = SQL::obtenerColumnas($vistaRequerimiento);
        $consultaRequerimiento       = SQL::seleccionar(array($vistaRequerimiento), $columnasRequerimiento, "id = '$datos->id_requerimiento'");
        $datosRequerimiento          = SQL::filaEnObjeto($consultaRequerimiento);
        $nombreSucursal              = SQL::obtenerValor("sucursales", "nombre", "id = '$datosRequerimiento->id_sucursal'"); 

        /*** Valores de la cotizacion ***/
        $mano_de_obra  = number_format($datos->valor_mano_obra_cotizacion);
        $materiales    = number_format($datos->valor_materiales_cotizacion);
        $costo_directo = number_format($datos->costo_directo);

        if (!empty($datos->porcentaje_administracion_cotizacion) && 
            $datos->porcentaje_administracion_cotizacion > '0'){
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
            $total            = $subTotal + $datos->costo_directo;
        } else {
            $base = $datos->costo_directo;
            $titulo_subtotal  = "";
            $simbolo_subtotal = "";
            $subTotal         = "";
            $total            = $datos->costo_directo + $datos->costo_impuesto;
        }
        $base               = number_format($base);
        $costo_impuesto     = number_format($datos->costo_impuesto);
        
        if (!empty($datos->porcentaje_anticipo) && $datos->porcentaje_anticipo > 0){
            $titulo_base_aticipo         = $textos["VALOR_BASE"];
            $simbolo_base_anticipo       = $textos["SIMBOLO_PESO"];
            $total_general_anticipo      = $totalGeneral;
            $titulo_porcentaje_anticipo  = $textos["PORCENTAJE_ANTICIPO"];
            $porcentaje_anticipo         = $datos->porcentaje_anticipo;
            $simbolo_porcentaje_anticipo = $textos["SIMBOLO_PORCENTAJE"];
            $titulo_valor_anticipo       = $textos["VALOR_ANTICIPO"];
            $simbolo_peso_valor_anticipo = $textos["SIMBOLO_PESO"];
            $valor_anticipo              = ($total * $datos->porcentaje_anticipo)/100;
        } else {
            $titulo_base_aticipo         = "";
            $simbolo_base_anticipo       = "";
            $total_general_anticipo      = "";
            $titulo_porcentaje_anticipo  = "";
            $porcentaje_anticipo         = "";
            $simbolo_porcentaje_anticipo = "";
            $titulo_valor_anticipo       = "";
            $simbolo_peso_valor_anticipo = "";
            $valor_anticipo              = "";
        }
        
        if($subTotal > 0){
            $subTotal = number_format($subTotal);
        }
        $totalGeneral       = number_format($total);
        $porcentajeAnticipo = number_format($porcentajeAnticipo);
        /************************************************************/

       
        /*** Definición de pestañas general ***/    
    	$formularios["PESTANA_REQUERIMIENTO"] = array(
            array(
                HTML::mostrarDato("nombre_sede", $textos["SEDE"],$nombreSede),
                HTML::mostrarDato("sucursal", $textos["EMPRESA"],$nombreSucursal),
                HTML::campoOculto("id", $datos->id),
	            HTML::campoOculto("requerimiento", $datos->id_requerimiento),
                HTML::campoOculto("sucursal", $nombreSucursal),
                HTML::campoOculto("sede", $nombreSede)
            ),
            array(
                HTML::mostrarDato("numero_requerimiento", $textos["NUMERO_REQUERIMIENTO"],$datosRequerimiento->id),
                HTML::mostrarDato("fecha_ingreso", $textos["FECHA_INGRESO"],$datosRequerimiento->fecha_ingreso),
                HTML::campoOculto("fecha_ingreso",$datosRequerimiento->fecha_ingreso),
                HTML::mostrarDato("fecha_limte_visita", $textos["FECHA_LIMITE_VISITA"],$datosRequerimiento->fecha_limite_visita)
            ),
            array(
                HTML::mostrarDato("tipo_solictud", $textos["TIPO_SOLICITUD"],$tipo_solicitud[$datosRequerimiento->tipo_solicitud]),
                HTML::campoOculto("solicitud", $tipo_solicitud[$datosRequerimiento->tipo_solicitud])
            ),
            array(
                HTML::mostrarDato("descripcion", $textos["DESCRIPCION"],$datosRequerimiento->descripcion),
                HTML::campoOculto("descripcion",$datosRequerimiento->descripcion)
            ),
            array(
                HTML::mostrarDato("observaciones", $textos["OBSERVACIONES"],$datosRequerimiento->observaciones),
                HTML::campoOculto("observaciones",$datosRequerimiento->observaciones)
            ),
            array(
                HTML::mostrarDato("nombre_contacto", $textos["CONTACTO"],$datosRequerimiento->nombre_contacto)
            ),
            array(
                HTML::mostrarDato("telefono_contacto", $textos["TELEFONO_CONTACTO"],$datosRequerimiento->telefono_contacto),
                HTML::mostrarDato("codigo_contable", $textos["CODIGO_CONTABLE"],$datosRequerimiento->codigo_contable)
            ),
            array(
                HTML::mostrarDato("persona_recibe", $textos["PERSONA_RECIBE"],$datosRequerimiento->persona_recibe),
                HTML::mostrarDato("medio_recibo", $textos["MEDIO_RECIBO"],$datosRequerimiento->medio_recibo)
            )
        );

        $formularios["PESTANA_COTIZACION"] = array(
            array(
                HTML::mostrarDato("numero_cotizacion", $textos["NUMERO_COTIZACION"],$datos->numero_cotizacion."-".$datos->consecutivo_cotizacion),
                HTML::mostrarDato("numero_cotizacion_consorciado", $textos["NUMERO_COTIZACION_CONSORCIADO"],$datos->numero_cotizacion_consorciado)
            ),
            array(
                HTML::mostrarDato("fecha_visita", $textos["FECHA_VISITA"],$datosRequerimiento->fecha_visita)
            ),
            array(
                HTML::mostrarDato("observaciones_visita", $textos["OBSERVACIONES_VISITA"],$datosRequerimiento->observaciones_visita),
            ),
            array(
                HTML::mostrarDato("valor_mano_obra_cotizacion", $textos["VALOR_MANO_OBRA_COTIZACION"], $textos["SIMBOLO_PESO"].$mano_de_obra),
                HTML::mostrarDato("valor_materiales_cotizacion", $textos["VALOR_MATERIALES_COTIZACION"], $textos["SIMBOLO_PESO"].$materiales),
                HTML::mostrarDato("costo_directo", $textos["COSTO_DIRECTO"], $textos["SIMBOLO_PESO"].$costo_directo)
            ),
            array(
//                HTML::mostrarDato("base_adminitracion", $base_administracion, $simbolo_admin_peso.$valor_base_administracion),
                HTML::mostrarDato("porcentaje_administracion", $administracion, $porcentaje_administracion.$simbolo_admin_porcentaje),
                HTML::mostrarDato("costo_administracion", $texto_costo_administracion, $simbolo_admin_peso.$costo_administracion)
            ),
            array(
//                HTML::mostrarDato("base_imprevistos", $base_imprevistos, $simbolo_impr_peso.$valor_base_imprevistos),
                HTML::mostrarDato("porcentaje_imprevistos", $imprevistos, $porcentaje_imprevistos.$simbolo_impr_porcentaje),
                HTML::mostrarDato("costo_imprevistos", $texto_costo_imprevistos, $simbolo_impr_peso.$costo_imprevistos)
            ),
            array(
//                HTML::mostrarDato("base_utilidad", $base_utilidad, $simbolo_util_peso.$valor_base_utilidad),
                HTML::mostrarDato("porcentaje_utilidad", $utilidad, $porcentaje_utilidad.$simbolo_util_porcentaje),
                HTML::mostrarDato("costo_utilidad", $texto_costo_utilidad, $simbolo_util_peso.$costo_utilidad)
            ),
            array(
                HTML::mostrarDato("base", $textos["BASE_IMPUESTO"], $textos["SIMBOLO_PESO"].$base),
                HTML::mostrarDato("impuesto", $textos["IMPUESTO"], $textos["SIMBOLO_PESO"].$datos->impuesto.$textos["SIMBOLO_PORCENTAJE"]),
                HTML::mostrarDato("costo_impuesto", $textos["VALOR_IMPUESTO"], $textos["SIMBOLO_PESO"].$costo_impuesto)
            ),
            array(
                HTML::mostrarDato("sub_total", $titulo_subtotal, $simbolo_subtotal.$subTotal),
            ),
            array(
                HTML::mostrarDato("total_general", $textos["TOTAL_GENERAL"], $textos["SIMBOLO_PESO"].$totalGeneral),
            ),
            array(
                HTML::mostrarDato("base", $titulo_base_aticipo, $simbolo_base_anticipo.$total_general_anticipo),
                HTML::mostrarDato("porcentaje_anticipo", $titulo_pordentale_anitcipo, $porcentaje_anticipo.$simbolo_porcentaje_anticipo),
                HTML::mostrarDato("valor_anticipo", $titulo_valor_anticipo, $simbolo_peso_valor_anticipo.$valor_anticipo),
            ),
            array(
                HTML::campoOculto("anticipo", $datos->porcentaje_anticipo),
                HTML::campoOculto("valor_impuesto", $datos->costo_impuesto),
                HTML::campoOculto("porcentaje_impuesto",$datos->impuesto),
                HTML::campoOculto("valor_mano_obra", $datos->valor_mano_obra_cotizacion),
                HTML::campoOculto("valor_materiales", $datos->valor_materiales_cotizacion),
                HTML::campoOculto("costo_administracion", $datos->costo_administracion_cotizacion),
                HTML::campoOculto("costo_imprevistos", $datos->costo_imprevistos_cotizacion),
                HTML::campoOculto("costo_utilidad", $datos->costo_utilidad),
                HTML::campoOculto("costo", $datos->costo_directo),
                HTML::campoOculto("v_anticipo", $porcentajeAnticipo),
                HTML::campoOculto("subtotal", $subTotal),
                HTML::campoOculto("total", $total),
	            HTML::campoOculto("estado", $datos->estado),
                HTML::campoOculto("nombre_contacto", $datosRequerimiento->nombre_contacto)
            )
        );

            $vistaDirecciones  = "consulta_registro_obras";
            $alineacion        = array("I","I","C","I","I","D","I","D","I","D","D");
            $columnas          = array("id","id_requerimiento","NUMERO_COTIZACION","TIPO_ACTA","FECHA_ACTA","PORCENTAJE_MANO_OBRA","PORCENTAJE_MATERIALES","VALOR_ACTA","FACTURA_CLIENTE","VALOR_CLIENTE","FACTURA_CONSORCIADO","VALOR_CONSORCIADO","VALOR_ADMINISTRACION");
            $condicion         = "id_cotizacion = '$url_id'";
            $consulta          = SQL::seleccionar(array($vistaDirecciones), $columnas, $condicion, "", "");
            $error             = "";
            $titulo            = $componente->nombre;
            $datos             = array();

            $actas = HTML::generarTabla(SQL::obtenerColumnas($vistaDirecciones), $consulta, $alineacion, "tablaActas");
            
            if(SQL::filasDevueltas($consulta)){
                $formularios["PESTANA_ACTAS"] = array(
                    array(
                        HTML::contenedor($actas)
                    )
                );        
            }
        /*** Definición de botones ***/
    	$botones = array(
    	    HTML::boton("botonAceptar", $textos["EXPORTAR"], "exportarDatos();", "aceptar", array("class" => "pdf"))
    	);
    	 
        $contenido = HTML::generarPestanas($formularios, $botones);
    }

    /*** Enviar datos para la generación del formulario al script que originó la petición ***/
    $respuesta    = array();
    $respuesta[0] = $error;
    $respuesta[1] = $titulo;
    $respuesta[2] = $contenido;
    HTTP::enviarJSON($respuesta);
    
} elseif (!empty($forma_procesar)) {
    
    if($forma_estado != '2'){
        $error        = $textos["ERROR_ENVIANDO_ITEM"];
        $respuesta    = array();
        $respuesta[0] = $error;
        $respuesta[1] = $error;
        HTTP::enviarJSON($respuesta);
        exit();

    }else{

        $error   = false;
        $mensaje = $textos["ITEM_ENVIADO"];
      
        $datos = array(   
            "enviada" => '1'
        );
        $consulta = SQL::modificar("cotizaciones", $datos, "id = '$forma_id'");
      
        if ($consulta) {
            $nombreArchivo      = $rutasGlobales["archivos"]."/cotizacion".$forma_id.".pdf";
            $nombreArchivo2     = "cotizacion".$forma_id.".pdf";
            $anchoColumnas      = array(20,50);
            $alineacionColumnas = array("I","I");
          
            $archivo = new PDF("P","mm","Letter");
          
            $archivo->AddPage();
            $archivo->SetFont('Arial','B',8);
  
            $archivo->Ln(0);
            $archivo->Cell(190,8,"Cotización No: ".$forma_id."     Fecha: ".$forma_fecha_ingreso,0,1,'R');
                
            $archivo->Ln(3);        
            $archivo->SetFont('Arial','B',8);
            $archivo->Cell(21,8,$textos["ATTE"]." :",0,0,'L');
           
            $archivo->SetFont('Arial','',8);
            $archivo->Cell(21,8,"".$forma_nombre_contacto."",0);

            $archivo->Ln(8);        
            $archivo->SetFont('Arial','B',8);
            $archivo->Cell(21,8,$textos["ASUNTO"]." :",0,0,'L');
           
            $archivo->SetFont('Arial','',8);
            $archivo->Cell(21,8,"".$textos["TEMA_ASUNTO"]."",0);

            $archivo->Ln(9);
            $archivo->SetFont('Arial','B',8);
            $archivo->Cell(21,8,$textos["SEDE"]." :",0,0,'L');
           
            $archivo->SetFont('Arial','',8);
            $archivo->Cell(20,8,"".$forma_sede."",0);
    
            $archivo->Ln(10);
            $archivo->SetFont('Arial','B',8);
            $archivo->Cell(21,8,$textos["SUCURSAL"]." :",0,0,'L');
            
            $archivo->SetFont('Arial','',8);
            $archivo->Cell(60,8,"".$forma_sucursal."",0);
            
            $archivo->Ln(10);
            $archivo->SetFont('Arial','B',8);
            $archivo->Cell(21,8,$textos["TIPO_SOLICITUD"]." :",0,0,'L');
            
            $archivo->SetFont('Arial','',8);
            $archivo->Cell(60,8,"".$forma_solicitud."",0);
    
            $archivo->Ln(10);
            $archivo->SetFont('Arial','',8);
            $archivo->Cell(30,8,$textos["SALUDO"],0,0,'L');
            
            $archivo->Ln(5);
            $archivo->SetFont('Arial','',8);
            $archivo->Cell(30,8,$textos["TITULO"],0,0,'J');
                        
            $archivo->Ln(10);
            $archivo->SetFont('Arial','B',8);
            $archivo->Cell(25,8,$textos["DESCRIPCION"]." :",0,0,'L');
            
            $archivo->SetFont('Arial','',8);
            $descripcion_1 = substr($forma_descripcion, 0, 100);
            $descripcion_2 = substr($forma_descripcion, 100, 100);
            $descripcion_3 = substr($forma_descripcion, 200, 55);
            
            $archivo->Cell(200,8,"".$descripcion_1."",0);
            $archivo->Cell(20,8,"",0,1,'R');
            $archivo->Cell(25,8,"",0,0,'L');
            $archivo->Cell(200,8,"".$descripcion_2."",0);
            $archivo->Cell(20,8,"",0,1,'R');
            $archivo->Cell(25,8,"",0,0,'L');
            $archivo->Cell(200,8,"".$descripcion_3."",0);

            if(!empty($forma_observaciones)){
                $archivo->SetFont('Arial','B',8);
                $archivo->Cell(25,8,$textos["OBSERVACIONES"]." :",0,0,'L');
    
                $observacion_1 = substr($forma_observaciones, 0, 100);
                $observacion_2 = substr($forma_observaciones, 100, 200);
                $observacion_3 = substr($forma_observaciones, 200, 255);
                $archivo->SetFont('Arial','',8);
                $archivo->Cell(60,8,"".$observacion_1."",0,0,'j');
            }
    
            $archivo->Ln(10);
            $archivo->SetFont('Arial','B',8);
            $archivo->Cell(30,8,$textos["VALOR_MANO_OBRA_COTIZACION"]." :",0,0,'L');

            $archivo->SetFont('Arial','',8);
            $archivo->Cell(60,8,"".$textos["SIMBOLO_PESO"].number_format($forma_valor_mano_obra,'2')."",0);
            $archivo->Cell(20,8,"",0,1,'R');

            $archivo->SetFont('Arial','B',8);
            $archivo->Cell(30,8,$textos["VALOR_MATERIALES_COTIZACION"]." :",0,0,'L');
            
            $archivo->SetFont('Arial','',8);
            $archivo->Cell(60,8,"".$textos["SIMBOLO_PESO"].number_format($forma_valor_materiales,'2')."",0);
            $archivo->Cell(20,8,"",0,1,'R');

            $archivo->SetFont('Arial','B',8);
            $archivo->Cell(30,8,$textos["COSTO_DIRECTO"]." :",0,0,'L');

            $forma_costo_administracion =intval($forma_costo_administracion);
            $forma_costo_imprevistos    =intval($forma_costo_imprevistos);
            $forma_costo_utilidad       =intval($forma_costo_utilidad);
            if ((($forma_costo_utilidad) || $forma_costo_utilidad > 0)){
                $base = $forma_costo_utilidad;
            } else {
                $base = $forma_costo;
            };
            $archivo->SetFont('Arial','',8);
            $archivo->Cell(60,8,"".$textos["SIMBOLO_PESO"].number_format($forma_costo,'2')."",0);
            $archivo->Cell(20,8,"",0,1,'R');


            if(!empty($forma_costo_administracion) || $forma_costo_administracion > 0){
                $archivo->SetFont('Arial','B',8);
                $archivo->Cell(30,8,"__________________",0,0,'L');
                $archivo->Cell(20,8,"",0,1,'R');

                $archivo->SetFont('Arial','B',8);
                $archivo->Cell(30,8,$textos["VALOR_ADMINISTRACION_COTIZACION"]." :",0,0,'L');

                $archivo->SetFont('Arial','',8);
                $archivo->Cell(60,8,"".$textos["SIMBOLO_PESO"].number_format($forma_costo_administracion,'2')."",0);
                $archivo->Cell(20,8,"",0,1,'R');
            }

            if(!empty($forma_costo_imprevistos) || $forma_costo_imprevistos > 0){
                $archivo->SetFont('Arial','B',8);
                $archivo->Cell(30,8,$textos["VALOR_IMPREVISTOS_COTIZACION"]." :",0,0,'L');

                $archivo->SetFont('Arial','',8);
                $archivo->Cell(60,8,"".$textos["SIMBOLO_PESO"].number_format($forma_costo_imprevistos,'2')."",0);
                $archivo->Cell(20,8,"",0,1,'R');
            }

            if(!empty($forma_costo_utilidad) || $forma_costo_utilidad > 0){
                $archivo->SetFont('Arial','B',8);
                $archivo->Cell(30,8,$textos["VALOR_UTILIDAD"]." :",0,0,'L');

                $archivo->SetFont('Arial','',8);
                $archivo->Cell(60,8,"".$textos["SIMBOLO_PESO"].number_format($forma_costo_utilidad,'2')."",0);
                $archivo->Cell(20,8,"",0,1,'R');
            }
            

            $archivo->SetFont('Arial','B',8);
            $archivo->Cell(30,8,$textos["BASE_IMPUESTO"]." :",0,0,'L');

            $archivo->SetFont('Arial','',8);
            $archivo->Cell(30,8,"".$textos["SIMBOLO_PESO"].number_format($base,'2')."",0);
            $archivo->Cell(20,8,"",0,1,'R');

            $archivo->SetFont('Arial','B',8);
            $archivo->Cell(30,8,$textos["IMPUESTO"]." :",0,0,'L');

            $archivo->SetFont('Arial','',8);
            $archivo->Cell(30,8,"".$textos["SIMBOLO_PESO"].number_format($forma_valor_impuesto,'2')."",0);
            $archivo->Cell(20,8,"",0,1,'R');
            
            $archivo->SetFont('Arial','B',8);
            $archivo->Cell(30,8,"__________________",0,0,'L');
            $archivo->Cell(20,8,"",0,1,'R');

            $archivo->SetFont('Arial','B',8);
            $archivo->Cell(30,8,$textos["TOTAL_GENERAL"]." :",0,0,'L');
            
            $archivo->SetFont('Arial','',8);
            $archivo->Cell(60,8,"".$textos["SIMBOLO_PESO"].number_format($forma_total,'2')."",0);
            $archivo->Cell(20,8,"",0,1,'R');
            
            $archivo->Ln(20);
            $archivo->SetFont('Arial','',8);        
            $archivo->Cell(30,8,$textos["TITULO_2"],0,0,'J');
            
            $archivo->Ln(21);
            $archivo->SetFont('Arial','',8);        
            $archivo->Cell(30,8,$textos["CORDIALMENTE"],0,0,'L');

            
            $archivo->Output($nombreArchivo, "F");
            $mensaje = HTML::enlazarPagina($textos["IMPRIMIR_PDF"], $nombreArchivo, array("target" => "_new"));	     

        } else {
            $error   = true;
            $mensaje = $textos["ERROR_ENVIANDO_ITEM"];
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
