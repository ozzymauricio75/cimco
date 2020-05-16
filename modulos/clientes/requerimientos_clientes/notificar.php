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
    /*** Verificar que se haya enviado el ID del elemento a consultar ***/
    if (empty($url_id)) {
        $error     = $textos["ERROR_CONSULTAR_VACIO"];
        $titulo    = "";
        $contenido = "";
    } else {

        $error     = "";
        $titulo    = $componente->nombre;
        $contenido = "";

        $vistaConsulta = "requerimientos_clientes";
        $columnas      = SQL::obtenerColumnas($vistaConsulta);
        $consulta      = SQL::seleccionar(array($vistaConsulta), $columnas, "id = '$url_id'");
        $datos         = SQL::filaEnObjeto($consulta);
        
    	//datos de la primera consulta
    	$sucursal = SQL::obtenerValor("sucursales","nombre","id = '$datos->id_sucursal'");
    	$sede     = SQL::obtenerValor("sedes_clientes","nombre_sede","id = '$datos->id_sede'");
        $tipo_solicitud = array(
            "M" => $textos["MANTENIMIENTO"],
            "E" => $textos["EMERGENCIA"],
            "S" => $textos["SERVICIO"],
            "P" => $textos["PROYECTO"],
            "V" => $textos["VISITA"]
        );
    
    	/*if($estado!=1){
    	      $error     = $textos["ERROR_ORDEN_ENVIADA"];
    	      $titulo    = "";
    	      $contenido = "";
    	}else{*/
    	    /*** Definición de pestañas general ***/    
    	$formularios["PESTANA_GENERAL"] = array(
    	    array(
                HTML::mostrarDato("nombre_sede", $textos["SEDE"],$sede),
                HTML::mostrarDato("nombre_sucursal", $textos["EMPRESA"],$sucursal),
                HTML::campoOculto("id",$datos->id),
                HTML::campoOculto("sucursal",$sucursal),
                HTML::campoOculto("sede",$sede)
            ),
            array(
                HTML::mostrarDato("ingreso", $textos["FECHA_INGRESO"],$datos->fecha_ingreso),
                HTML::mostrarDato("ingreso_sistema", $textos["FECHA_INGRESO_SISTEMA"],$datos->fecha_ingreso_sistema),
                HTML::mostrarDato("limite_visita", $textos["FECHA_LIMITE_VISITA"],$datos->fecha_limite_visita),
                HTML::campoOculto("fecha_ingreso",$datos->fecha_ingreso),
                HTML::campoOculto("fecha_ingreso_sistema",$datos->fecha_ingreso_sistema)
            ),
            array(
                HTML::mostrarDato("tipo_solictud", $textos["TIPO_SOLICITUD"],$tipo_solicitud[$datos->tipo_solicitud]),
                HTML::campoOculto("solicitud",$tipo_solicitud[$datos->tipo_solicitud])
            ),
            array(
                HTML::mostrarDato("descripcion_requerimiento", $textos["DESCRIPCION"],$datos->descripcion),
                HTML::campoOculto("descripcion",$datos->descripcion)
            ),
            array(
                HTML::mostrarDato("observaciones_requerimiento", $textos["OBSERVACIONES"],$datos->observaciones),
                HTML::campoOculto("observaciones",$datos->observaciones)
            ),
            array(
                HTML::mostrarDato("nombre", $textos["CONTACTO"],$datos->nombre_contacto),
                HTML::mostrarDato("telefono", $textos["TELEFONO_CONTACTO"],$datos->telefono_contacto),
                HTML::campoOculto("nombre_contacto",$datos->nombre_contacto),
                HTML::campoOculto("telefono_contacto",$datos->telefono_contacto)
            ),
            array(
                HTML::mostrarDato("persona_recibe_requerimiento", $textos["PERSONA_RECIBE"],$datos->persona_recibe),
                HTML::mostrarDato("medio_recibo_requerimiento", $textos["MEDIO_RECIBO"],$datos->medio_recibo),
                HTML::mostrarDato("codigo_contable", $textos["CODIGO_CONTABLE"],$datos->codigo_contable),
                HTML::campoOculto("persona_recibe",$datos->persona_recibe),
                HTML::campoOculto("medio_recibo",$datos->medio_recibo)
            )
        ) ;      
    	/*** Definición de botones ***/
    	$botones = array(    	   
    	   HTML::boton("botonAceptar", $textos["NOTIFICAR"], "exportarDatos();", "aceptar", array("class" => "pdf"))
    	);
    	$contenido = HTML::generarPestanas($formularios, $botones);
	//}
    }

    /*** Enviar datos para la generación del formulario al script que originó la petición ***/
    $respuesta    = array();
    $respuesta[0] = $error;
    $respuesta[1] = $titulo;
    $respuesta[2] = $contenido;
    HTTP::enviarJSON($respuesta);
    
} elseif (!empty($forma_procesar)) {

    $error   = false;
    $mensaje = $textos["ITEM_ENVIADO"];
    
    $datos = array(   
        "notificado" => 1
    );

    $consulta = SQL::modificar("requerimientos_clientes", $datos, "id = '$forma_id'");
    if ($consulta) {
        $nombreArchivo      = $rutasGlobales["archivos"]."/requerimiento".$forma_id.".pdf";
        $nombreArchivo2     = "requerimiento".$forma_id.".pdf";
        $anchoColumnas      = array(20,50);
        $alineacionColumnas = array("I","I");
        
        $archivo = new PDF("P","mm","Letter");

        $archivo->AddPage();
        $archivo->SetFont('Arial','B',8);

        $archivo->Ln(3);
        $archivo->Cell(180,8,"Requerimiento No: ".$forma_id."     Fecha: ".$forma_fecha_ingreso,0,1,'R');
        

        $archivo->Ln(0);
        $archivo->SetFont('Arial','B',8);
        $archivo->Cell(20,8,$textos["SEDE"]." :",0,0,'L');
        $archivo->SetFont('Arial','',8);
        $archivo->Cell(60,8,"".$forma_sede."",0);
        $archivo->Cell(20,8,"",0);
        $archivo->Cell(20,8,"",0);

        $archivo->Ln(3);
        $archivo->SetFont('Arial','B',8);
        $archivo->Cell(20,8,$textos["SUCURSAL"]." :",0,0,'L');
        $archivo->SetFont('Arial','',8);
        $archivo->Cell(60,8,"".$forma_sucursal."",0);

        $archivo->Cell(20,8,"",0,1,'R');

        $archivo->Ln(5);
        $archivo->SetFont('Arial','B',8);
        $archivo->Cell(20,8,$textos["TIPO_SOLICITUD"]." :",0,0,'L');
        $archivo->SetFont('Arial','',8);
        $archivo->Cell(60,8,"".$forma_solicitud."",0);
        $archivo->Cell(20,8,"",0,1,'R');
        
        if(!empty($forma_nombre_contacto)){       
            $archivo->Ln(5);
            $archivo->SetFont('Arial','B',8);
            $archivo->Cell(20,8,$textos["CONTACTO"]." :",0,0,'L');
            $archivo->SetFont('Arial','',8);
            $archivo->Cell(60,8,"".$forma_nombre_contacto."",0);
            
            $archivo->SetFont('Arial','B',8);
            $archivo->Cell(30,8,$textos["TELEFONO_CONTACTO"]." :",0,0,'L');
            $archivo->SetFont('Arial','',8);
            $archivo->Cell(60,8,"".$forma_telefono_contacto."",0);
            
        }
        
        $archivo->Ln(5);
        $archivo->SetFont('Arial','B',8);
        $archivo->Cell(20,8,$textos["DESCRIPCION"]." :",0,0,'L');
        $archivo->SetFont('Arial','',8);
        $archivo->Ln(5);
        $descripcion_1 = substr($forma_descripcion, 0, 100);
        $descripcion_2 = substr($forma_descripcion, 100, 100);
        $descripcion_3 = substr($forma_descripcion, 200, 55);
        $archivo->Cell(200,8,"".$descripcion_1."",0);
        $archivo->Ln(3);
        $archivo->Cell(200,8,"".$descripcion_2."",0);
        $archivo->Ln(3);
        $archivo->Cell(200,8,"".$descripcion_3."",0);
        $archivo->Cell(20,8,"",0,1,'R');
        
        if(!empty($forma_observaciones)){
            $archivo->Ln(5);
            $archivo->SetFont('Arial','B',8);
            $archivo->Cell(20,8,$textos["OBSERVACIONES"],0,0,'L');
            $archivo->SetFont('Arial','',8);
            $archivo->Ln(5);
            $observacion_1 = substr($forma_observaciones, 0, 100);
            $observacion_2 = substr($forma_observaciones, 100, 200);
            $observacion_3 = substr($forma_observaciones, 200, 255);
            $archivo->Cell(200,8,"".$observacion_1."",0);
            $archivo->Ln(3);
            $archivo->Cell(200,8,"".$observacion_2."",0);
            $archivo->Ln(3);
            $archivo->Cell(200,8,"".$observacion_3."",0);
            $archivo->Cell(20,8,"",0,1,'R');
        }

        $archivo->Output($nombreArchivo, "F");
        $mensaje = HTML::enlazarPagina($textos["IMPRIMIR_PDF"], $pance["url"]."/archivos/".$nombreArchivo2, array("target" => "adjunto"));	     
    } else {
        $error   = true;
        $mensaje = $textos["ERROR_ENVIADO_ITEM"];
    }
    /*** Enviar datos con la respuesta del proceso al script que originó la petición ***/
    $respuesta    = array();
    $respuesta[0] = false;
    $respuesta[1] = $mensaje; 
    HTTP::enviarJSON($respuesta);
}
?>
