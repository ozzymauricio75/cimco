<?php

/**
*
* Copyright (C) 2008 LinuxCali Ltda
* Francisco J. Lozano B. <pacho@linuxcali.com>
* Mauricio Oidor L. <ozzymauricio75@gmail.com>
*
* Este archivo es parte de:
* PANCE :: Plataforma para la Administraci�n del Nexo Cliente-Empresa
*
* Este programa es software libre: usted puede redistribuirlo y/o
* modificarlo  bajo los t�rminos de la Licencia P�blica General GNU
* publicada por la Fundaci�n para el Software Libre, ya sea la versi�n 3
* de la Licencia, o (a su elecci�n) cualquier versi�n posterior.
*
* Este programa se distribuye con la esperanza de que sea �til, pero
* SIN GARANT�A ALGUNA; ni siquiera la garant�a impl�cita MERCANTIL o
* de APTITUD PARA UN PROP�SITO DETERMINADO. Consulte los detalles de
* la Licencia P�blica General GNU para obtener una informaci�n m�s
* detallada.
*
* Deber�a haber recibido una copia de la Licencia P�blica General GNU
* junto a este programa. En caso contrario, consulte:
* <http://www.gnu.org/licenses/>.
*
**/

/*** Generar el formulario para la captura de datos ***/
if (!empty($url_generar)) {
    $error  = "";
    $titulo = $componente->nombre;
        
    /*** Verificar que se haya enviado el ID del elemento a consultar ***/
    if (empty($url_id)) {
        $error     = $textos["ERROR_CONSULTAR_VACIO"];
        $titulo    = "";
        $contenido = "";

    } else {
        /*** Obtener los resultados para la pagina actual ***/
        $vistaRegistroObra               = "registro_obras";
        $columnasRegistroObra            = SQL::obtenerColumnas($vistaRegistroObra);
        $consultaRegistroObra            = SQL::seleccionar(array($vistaRegistroObra), $columnasRegistroObra, "id = '$url_id' ");
        $datosRegistroObra               = SQL::filaEnObjeto($consultaRegistroObra);
        
        $consulta                        = SQL::seleccionar(array("imagenes"), array("id","ancho","alto"), "id_asociado = '$url_id' AND categoria = '2'");
        $imagen                          = SQL::filaEnObjeto($consulta);

        $acta                            = SQL::obtenerValor("registro_obras", "tipo_acta", "id = '$url_id'");
        $valor_facturar                  = SQL::obtenerValor("registro_obras", "valor_facturar", "id = '$url_id'");
       
        $consulta                        = mysql_query("SELECT SUM(valor_facturar)AS valor FROM pance_registro_obras WHERE id = '$url_id'");
        $resultado                       = mysql_fetch_object($consulta);
        $acumulado                       = $resultado->valor;
        
        $vistaConsulta                   = "cotizaciones";                                                             
        $columnas                        = SQL::obtenerColumnas($vistaConsulta);                                       
        $consulta                        = SQL::seleccionar(array($vistaConsulta), $columnas, "id = '$datosRegistroObra->id_cotizacion' AND estado = '2'");       
        $datos                           = SQL::filaEnObjeto($consulta);                                               
        $error                           = "";                                                                         
        $titulo                          = $componente->nombre;                                                        
        $subTotal                        = $datos->costo_administracion_cotizacion + $datos->costo_imprevistos_cotizacion + $datos->costo_utilidad  + $datos->costo_impuesto; 
        $totalGeneral                    = $subTotal + $datos->costo_directo;

        $valor_mano_obra_cotizacion      = number_format($datos->valor_mano_obra_cotizacion);
        $valor_materiales_cotizacion     = number_format($datos->valor_materiales_cotizacion);
        $costo_directo                   = number_format($datos->costo_directo);
        $costo_administracion_cotizacion = number_format($datos->costo_administracion_cotizacion);
        $costo_imprevistos_cotizacion    = number_format($datos->costo_imprevistos_cotizacion);
        $costo_impuesto                  = number_format($datos->costo_impuesto);
        $costo_utilidad                  = number_format($datos->costo_utilidad);
        $subTotal                        = number_format($subTotal);
        $totalGeneral                    = number_format($totalGeneral);        
        
        $estado                          = SQL::obtenerValor("buscador_cotizaciones", "estado", "id = '$datosRegistroObra->id_cotizacion'");                                       
        $tipo_solicitud                  = SQL::obtenerValor("buscador_cotizaciones", "tipo_solicitud", "id = '$datosRegistroObra->id_cotizacion'");                               
        $forma_pago                      = SQL::obtenerValor("buscador_cotizaciones", "forma_pago", "id = '$datosRegistroObra->id_cotizacion'");                                   
                                                                                                                                                         
        $descripcion                     = SQL::obtenerValor("requerimientos_clientes", "descripcion", "id = '$datos->id_requerimiento'");               
        $observaciones_visita            = SQL::obtenerValor("requerimientos_clientes", "observaciones_visita", "id = '$datos->id_requerimiento'");      
        $nombre_contacto                 = SQL::obtenerValor("requerimientos_clientes", "nombre_contacto", "id = '$datos->id_requerimiento'");           
        $fecha_ingreso                   = SQL::obtenerValor("requerimientos_clientes", "fecha_ingreso", "id = '$datos->id_requerimiento'");             
        $Sede                            = SQL::obtenerValor("requerimientos_clientes", "id_sede", "id = '$datos->id_requerimiento'");                   
        $nombreSede                      = SQL::obtenerValor("sedes_clientes", "nombre_sede", "id = '$Sede'");                                           
        $municipio                       = SQL::obtenerValor("sedes_clientes", "id_municipios", "id = '$Sede'");                                         
        $nombreMunicipio                 = SQL::obtenerValor("municipios", "nombre", "id = '$municipio'");                                               
        $id_sucursal                     = SQL::obtenerValor("requerimientos_clientes", "id_sucursal", "id = '$datos->id_requerimiento'");               
        $nombreSucursal                  = SQL::obtenerValor("sucursales", "nombre", "id = '$id_sucursal'");
        
        $tipo_acta = array(
            "1" => $textos["ACTA_INICIO"],
            "2" => $textos["ACTA_AVANCE_OBRA"],
            "3" => $textos["ACTA_FINALIZACION"]
        );
        
        $estado_pagos = array(
            "0" => $textos["NO"],
            "1" => $textos["SI"]
        );

        /*** Definici�n de pesta�as ***/
            $formularios["PESTANA_REQUERIMIENTO"] = array(
                array(                   
                    HTML::mostrarDato("fecha_ingreso", $textos["FECHA_INGRESO"], $fecha_ingreso)
                ),
                array(   
                    HTML::mostrarDato("nombre_sede", $textos["SEDE"], $nombreSede)
                ),
                array(   
                    HTML::mostrarDato("municipio", $textos["MUNICIPIO"], $nombreMunicipio)
                ),            
                array(   
                    HTML::mostrarDato("sucursal", $textos["SUCURSAL"], $nombreSucursal)
                ),
                array(
                    HTML::mostrarDato("descripcion", $textos["DESCRIPCION"], $descripcion)
                ),
                array(    
                    HTML::mostrarDato("observaciones", $textos["OBSERVACIONES_VISITA"], $observaciones_visita)
                ),
                array(    
                    HTML::mostrarDato("nombre_contacto", $textos["CONTACTO"], $nombre_contacto)
                ),
                array(    
                    HTML::mostrarDato("tipo_solicitud", $textos["TIPO_SOLICITUD"], $tipo_solicitud)
                ),
                array(    
                    HTML::mostrarDato("estado", $textos["ESTADO"], $estado)
                )
            );
  
            $formularios["PESTANA_COTIZACION"] = array(
                array(
                    HTML::mostrarDato("numero_cotizacion", $textos["NUMERO_COTIZACION"], $datos->numero_cotizacion."-".$datos->consecutivo_cotizacion),
                    HTML::mostrarDato("numero_cotizacion_consorciado", $textos["NUMERO_COTIZACION_CONSORCIADO"], $datos->numero_cotizacion_consorciado)
                ),
                array(    
                    HTML::mostrarDato("valor_mano_obra_cotizacion", $textos["VALOR_MANO_OBRA_COTIZACION"], $textos["SIMBOLO_PESO"].$valor_mano_obra_cotizacion),
                    HTML::mostrarDato("valor_materiales_cotizacion", $textos["VALOR_MATERIALES_COTIZACION"], $textos["SIMBOLO_PESO"].$valor_materiales_cotizacion)
                ),
                array(    
                    HTML::mostrarDato("costo", $textos["COSTO_DIRECTO"], $textos["SIMBOLO_PESO"].$costo_directo),  
                    HTML::mostrarDato("forma_pago", $textos["FORMA_PAGO"], $forma_pago)
                ),
                array(  
                    HTML::mostrarDato("porcentaje_anticipo", $textos["PORCENTAJE_ANTICIPO"], $datos->porcentaje_anticipo.$textos["SIMBOLO_PORCENTAJE"])
                ),
                array(
                    HTML::mostrarDato("porcentaje_administracion_cotizacion", $textos["PORCENTAJE_ADMINISTRACION_COTIZACION"], $datos->porcentaje_administracion_cotizacion.$textos["SIMBOLO_PORCENTAJE"]),
                    HTML::mostrarDato("costo_administracion_cotizacion", $textos["VALOR_ADMINISTRACION_COTIZACION"], $textos["SIMBOLO_PESO"].$costo_administracion_cotizacion)
                ),     
                array( 
                    HTML::mostrarDato("porcentaje_imprevistos_cotizacion", $textos["PORCENTAJE_IMPREVISTOS_COTIZACION"], $datos->porcentaje_imprevistos_cotizacion.$textos["SIMBOLO_PORCENTAJE"]),
                    HTML::mostrarDato("costo_imprevistos_cotizacion", $textos["VALOR_IMPREVISTOS_COTIZACION"], $textos["SIMBOLO_PESO"].$costo_imprevistos_cotizacion)
                ),
                array(      
                    HTML::mostrarDato("porcentaje_utilidad", $textos["PORCENTAJE_UTILIDAD"], $datos->porcentaje_utilidad.$textos["SIMBOLO_PORCENTAJE"]),
                    HTML::mostrarDato("costo_utilidad", $textos["VALOR_UTILIDAD"], $textos["SIMBOLO_PESO"].$costo_utilidad)
                ),
                array(    
                    HTML::mostrarDato("impuesto", $textos["IMPUESTO"], $datos->impuesto.$textos["SIMBOLO_PORCENTAJE"]),
                    HTML::mostrarDato("costo_impuesto", $textos["VALOR_IMPUESTO"], $textos["SIMBOLO_PESO"].$costo_impuesto)
                ),
                array(    
                    HTML::mostrarDato("sub_total", $textos["SUB_TOTAL"], $textos["SIMBOLO_PESO"].$subTotal),
                    HTML::mostrarDato("total_general", $textos["TOTAL_GENERAL"], $textos["SIMBOLO_PESO"].$totalGeneral)
                )
            );
          
            /*** Definici�n de pesta�as ***/
            $formularios["PESTANA_DATOS_ACTA"] = array(
                array(   
                    HTML::mostrarDato("tipo_acta", $textos["TIPO_ACTA"], $tipo_acta[$datosRegistroObra->tipo_acta])
                ),
                array(   
                    HTML::mostrarDato("fecha_entrega_acta", $textos["FECHA_ENTREGA_ACTA"], $datosRegistroObra->fecha_entrega_acta)
                ),
                array(   
                    HTML::mostrarDato("numero_factura", $textos["NUMERO_FACTURA"], $datosRegistroObra->numero_factura)
                ),
                array(   
                    HTML::mostrarDato("valor_facturar", $textos["VALOR_FACTURAR"], $textos["SIMBOLO_PESO"].number_format($datosRegistroObra->valor_facturar))
                ),
                array(
                    HTML::mostrarDato("porcentaje_mano_obra", $textos["PORCENTAJE_MANO_OBRA"], $datosRegistroObra->porcentaje_mano_obra.$textos["SIMBOLO_PORCENTAJE"])
                ),
                array(    
                    HTML::mostrarDato("porcentaje_materiales", $textos["PORCENTAJE_MATERIALES"], $datosRegistroObra->porcentaje_materiales.$textos["SIMBOLO_PORCENTAJE"])
                ),            
                array(
  	                HTML::campoOculto("requerimiento", $datos->id_requerimiento),
  	                HTML::campoOculto("id_acta", $url_id),
  	                HTML::campoOculto("acumulado", $acumulado),
  	                HTML::campoOculto("total_general", $totalGeneral),
  	                HTML::campoOculto("valor_facturar", $datosRegistroObra->valor_facturar),
  	                HTML::campoOculto("numero_factura", $datosRegistroObra->numero_factura),
  	                HTML::campoOculto("valor_mano_obra_cotizacion", $datos->valor_mano_obra_cotizacion),
  	                HTML::campoOculto("valor_materiales_cotizacion", $datos->valor_materiales_cotizacion),
  	                HTML::campoOculto("porcentaje_mano_obra", $datosRegistroObra->porcentaje_mano_obra),
  	                HTML::campoOculto("porcentaje_materiales", $datosRegistroObra->porcentaje_materiales),
                    HTML::campoOculto("sucursal",$nombreSucursal),
                    HTML::campoOculto("sede",$nombreSede),
                    HTML::campoOculto("solicitud",$tipo_solicitud),
                    HTML::campoOculto("descripcion",$descripcion),
                    HTML::campoOculto("tipo_acta",$acta),
                    HTML::campoOculto("fecha_entrega_acta",$datosRegistroObra->fecha_entrega_acta)
                )
            );
            
            if ($imagen) {
                $formularios["PESTANA_IMAGEN"] = array(
                    array(
                        HTML::imagen(HTTP::generarURL("VISUIMAG")."&id=".$imagen->id, array("width" => $imagen->ancho, "height" => $imagen->alto))
                    )
                );
            }
            /*** Definici�n de botones ***/
            $botones = array(
    	          HTML::boton("botonAceptar", $textos["EXPORTAR"], "exportarDatos();", "aceptar", array("class" => "pdf"))
            );

            $contenido = HTML::generarPestanas($formularios, $botones);
        }
    
        /*** Enviar datos para la generaci�n del formulario al script que origin� la petici�n ***/
        $respuesta[0] = $error;
        $respuesta[1] = $titulo;
        $respuesta[2] = $contenido;
        HTTP::enviarJSON($respuesta);
        exit();
    
} elseif (!empty($forma_procesar)) {
    $error   = false;
    $mensaje = $textos["ITEM_ENVIADO"];
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
    
    $forma_total_general = quitarMiles($forma_total_general);
    
    if(($forma_tipo_acta != '1') && ($forma_valor_facturar != $forma_total_general)){
        $porcentaje_participacion     = ($forma_valor_facturar / $forma_total_general) * 100;
        $valor_participa_mano_obra    = (($forma_valor_mano_obra_cotizacion * $porcentaje_participacion) / 100);
        $valor_participa_materiales   = (($forma_valor_materiales_cotizacion * $porcentaje_participacion) / 100);
        $valor_consorciado_mano_obra  = (($valor_participa_mano_obra * $forma_porcentaje_mano_obra) / 100);
        $valor_consorciado_materiales = (($valor_participa_materiales * $forma_porcentaje_materiales) / 100);
    
    }else{
        $valor_consorciado_mano_obra  = (($forma_valor_mano_obra_cotizacion * $forma_porcentaje_mano_obra) / 100);
        $valor_consorciado_materiales = (($forma_valor_materiales_cotizacion * $forma_porcentaje_materiales) / 100);
    }

    $datos = array(   
        "factura_consorciado" => 1
    );

    $consulta = SQL::modificar("registro_obras", $datos, "id = '$forma_id_acta'");
    if ($consulta) {
        $nombreArchivo      = $rutasGlobales["archivos"]."/acta".$forma_id_acta.".pdf";
        $nombreArchivo2     = "acta".$forma_id_acta.".pdf";
        $anchoColumnas      = array(20,50);
        $alineacionColumnas = array("I","I");
          
        $archivo = new PDF("P","mm","Letter");
         
        $archivo->AddPage();
        $archivo->SetFont('Arial','B',8);
  
        $archivo->Ln(0);
        $archivo->Cell(190,8,"Acta No: ".$forma_id_acta."     Fecha: ".$forma_fecha_entrega_acta,0,1,'R');
                
        $archivo->Ln(7);        
        $archivo->SetFont('Arial','B',8);
        $archivo->Cell(21,8,$textos["ASUNTO"]." :",0,0,'L');
           
        $archivo->SetFont('Arial','',8);
        $archivo->Cell(21,8,"".$textos["TEMA_ASUNTO"]."",0);
        
        $archivo->Ln(7);        
        $archivo->SetFont('Arial','B',8);
        $archivo->Cell(21,8,$textos["FACTURA"]." :",0,0,'L');
           
        $archivo->SetFont('Arial','',8);
        $archivo->Cell(60,8,"".$forma_numero_factura."",0);

        $archivo->Ln(8);
        $archivo->SetFont('Arial','B',8);
        $archivo->Cell(21,8,$textos["SEDE"]." :",0,0,'L');
          
        $archivo->SetFont('Arial','',8);
        $archivo->Cell(20,8,"".$forma_sede."",0);
    
        $archivo->Ln(9);
        $archivo->SetFont('Arial','B',8);
        $archivo->Cell(21,8,$textos["SUCURSAL"]." :",0,0,'L');
            
        $archivo->SetFont('Arial','',8);
        $archivo->Cell(60,8,"".$forma_sucursal."",0);
            
        $archivo->Ln(10);
        $archivo->SetFont('Arial','B',8);
        $archivo->Cell(21,8,$textos["TIPO_SOLICITUD"]." :",0,0,'L');
            
        $archivo->SetFont('Arial','',8);
        $archivo->Cell(60,8,"".$forma_solicitud."",0);
    
        $archivo->Ln(11);
        $archivo->SetFont('Arial','',8);
        $archivo->Cell(30,8,$textos["SALUDO"],0,0,'L');
           
        $archivo->Ln(12);
        $archivo->SetFont('Arial','',8);
        $archivo->Cell(30,8,$textos["TITULO"],0,0,'J');
                        
        $archivo->Ln(13);
        $archivo->SetFont('Arial','B',8);
        $archivo->Cell(25,8,$textos["DESCRIPCION"]." :",0,0,'L');
            
        $archivo->SetFont('Arial','',8);
        $descripcion_1 = substr($forma_descripcion, 0, 100);
        $descripcion_2 = substr($forma_descripcion, 100, 100);
        $descripcion_3 = substr($forma_descripcion, 200, 55);
            
        $archivo->Cell(200,8,"".$descripcion_1."",0);
        $archivo->Cell(20,8,"",0,1,'R');
        $archivo->Cell(25,8,"",0,0,'L');

        $archivo->Ln(12);
        $archivo->SetFont('Arial','B',8);
        $archivo->Cell(30,8,$textos["VALOR_MANO_OBRA_COTIZACION"]." :",0,0,'L');

        $valor_consorciado_mano_obra = quitarMiles($valor_consorciado_mano_obra);
        $archivo->SetFont('Arial','',8);
        $archivo->Cell(60,8,"".$textos["SIMBOLO_PESO"].number_format($valor_consorciado_mano_obra)."",0);
        $archivo->Cell(20,8,"",0,1,'R');

        $archivo->SetFont('Arial','B',8);
        $archivo->Cell(30,8,$textos["VALOR_MATERIALES_COTIZACION"]." :",0,0,'L');
            
        $valor_consorciado_materiales = quitarMiles($valor_consorciado_materiales);
        $archivo->SetFont('Arial','',8);
        $archivo->Cell(60,8,"".$textos["SIMBOLO_PESO"].number_format($valor_consorciado_materiales)."",0);
        $archivo->Cell(20,8,"",0,1,'R');

        /*$archivo->SetFont('Arial','B',8);
        $archivo->Cell(30,8,$textos["COSTO_DIRECTO"]." :",0,0,'L');

        if ((($forma_costo_utilidad) || $forma_costo_utilidad != 0)){
            $base = $forma_costo_utilidad;
        } else {
            $base = $forma_costo;
        };
        $archivo->SetFont('Arial','',8);
        $archivo->Cell(60,8,"".$textos["SIMBOLO_PESO"].number_format($forma_costo,'2')."",0);
        $archivo->Cell(20,8,"",0,1,'R');
            
        if(!empty($forma_costo_administracion) || $forma_costo_administracion != 0){
            $archivo->SetFont('Arial','B',8);
            $archivo->Cell(30,8,"__________________",0,0,'L');
            $archivo->Cell(20,8,"",0,1,'R');

            $archivo->SetFont('Arial','B',8);
            $archivo->Cell(30,8,$textos["VALOR_ADMINISTRACION_COTIZACION"]." :",0,0,'L');

            $archivo->SetFont('Arial','',8);
            $archivo->Cell(60,8,"".$textos["SIMBOLO_PESO"].number_format($forma_costo_administracion,'2')."",0);
            $archivo->Cell(20,8,"",0,1,'R');
        }

        if(!empty($forma_costo_imprevistos) || $forma_costo_imprevistos != 0){
            $archivo->SetFont('Arial','B',8);
            $archivo->Cell(30,8,$textos["VALOR_IMPREVISTOS_COTIZACION"]." :",0,0,'L');

            $archivo->SetFont('Arial','',8);
            $archivo->Cell(60,8,"".$textos["SIMBOLO_PESO"].number_format($forma_costo_imprevistos,'2')."",0);
            $archivo->Cell(20,8,"",0,1,'R');
        }

        if(!empty($forma_costo_utilidad) || $forma_costo_utilidad != 0){
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
            
        */$archivo->Ln(21);
        $archivo->SetFont('Arial','',8);        
        $archivo->Cell(30,8,$textos["CORDIALMENTE"],0,0,'L');
        
        $archivo->Output($nombreArchivo, "F");
        $mensaje = HTML::enlazarPagina($textos["IMPRIMIR_PDF"], $pance["url"]."/archivos/".$nombreArchivo2, array("target" => "adjunto"));	     

    }else {
        $error   = true;
        $mensaje = $textos["ERROR_ENVIANDO_ITEM"];
    }
    /*** Enviar datos con la respuesta del proceso al script que origin� la petici�n ***/
    $respuesta    = array();
    $respuesta[0] = $error;
    $respuesta[1] = $mensaje;
    $respuesta[2] = $mensaje;
    HTTP::enviarJSON($respuesta);
}
?>
