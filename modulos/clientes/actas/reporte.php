<?php

/**
*
* Copyright (C) 2008 LinuxCali Ltda
* Francisco J. Lozano B. <pacho@linuxcali.com>
* Margarita Hoyos <margarita@linuxcali.com>
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
    $error    = "";
    $titulo   = $componente->nombre;

    $tipo_acta = array(
        "0" => $textos["TODAS"],
        "2" => $textos["ACTA_AVANCE_OBRA"],
        "3" => $textos["ACTA_FINALIZACION"],
        "4" => $textos["INFORME"]
    );

    /*** Obtener lista de sucursales para selecci�n ***/
    $tablas     = array(
        "a" => "perfiles_usuario",
        "b" => "componentes_usuario",
        "c" => "sucursales"
    );
    $columnas = array(
        "id"     => "a.id_sucursal",
        "nombre" => "c.nombre"
    );

    $condicion = "c.id = a.id_sucursal AND a.id = b.id_perfil AND a.id_usuario = '$sesion_id_usuario' AND b.id_componente = '".$componente->id."'";
    $consulta_privilegios = SQL::seleccionar($tablas, $columnas, $condicion, "", "");
    $sucursales = array();
    
    if (SQL::filasDevueltas($consulta_privilegios)) {
        $sucursales[] = array(HTML::mostrarDato("consorciado", $textos["CONSORCIADOS"], ""));
        $sucursales[] = array(HTML::boton("botonSeleccionarTodos", $textos["SELECCIONAR_TODOS"], "seleccionar_todas_sucursales();", "", array()));
        while ($datos_sucursal = SQL::filaEnObjeto($consulta_privilegios)) {
            $idSucursal     = $datos_sucursal->id;
            $nombreSucursal = $datos_sucursal->nombre;
            $sucursales[]   = array(HTML::marcaChequeo("sucursales[]", $nombreSucursal, $idSucursal, false, array("class"=>"sucursales", "id"=>"sucursales_".$idSucursal)));
        }
    }

    /*** Definici�n de pesta�as para datos del tercero***/
    $formularios["PESTANA_REPORTE"] = array(
        array(   
            HTML::listaSeleccionSimple("*tipo_acta", $textos["TIPO_ACTA"], $tipo_acta, "", array("title" => $textos["AYUDA_TIPO_ACTA"],"onBlur" => "validarItem(this);")),
            HTML::campoTextoCorto("*fecha_desde", $textos["FECHA_DESDE"], 10, 10, date("Y-m-d"), array("class" => "selectorFecha"), array("title" => $textos["AYUDA_FECHA_DESDE"])),
            HTML::campoTextoCorto("*fecha_hasta", $textos["FECHA_HASTA"], 10, 10, date("Y-m-d"), array("class" => "selectorFecha"), array("title" => $textos["AYUDA_FECHA_HASTA"]))
        )
    );
    
    $formularios["PESTANA_REPORTE"] = array_merge($formularios["PESTANA_REPORTE"],$sucursales);

    /*** Definicion de botones ***/
    $botones = array(
        HTML::boton("botonAceptar", $textos["GENERAR_PLANO"],"exportarDatos();", "reporte")
    );

    $contenido = HTML::generarPestanas($formularios, $botones);

    /*** Enviar datos para la generacion del formulario al script que origino la peticion ***/
    $respuesta[0] = $error;
    $respuesta[1] = $titulo;
    $respuesta[2] = $contenido;
    HTTP::enviarJSON($respuesta);

/*** Validar los datos provenientes del formulario ***/
} elseif (!empty($forma_procesar)) {

    /*** Asumir por defecto que no hubo error ***/
    $error   = false;
    $mensaje = $textos["PLANO_GENERADO"];
    
    /*** Validar ingreso de campo fecha al formulario ***/
    if (empty($forma_fecha_desde) || empty($forma_fecha_hasta) || empty($forma_sucursales)){
        $error   = true;
        $mensaje = $textos["ERROR_DATOS_INCOMPLETOS"];
    } else if($forma_fecha_desde > $forma_fecha_hasta){
        $error   = true;
        $mensaje = $textos["ERROR_FECHAS"];
    } else {
        /*** Generar archivo plano ***/
        if ($forma_tipo_acta == 0){
            $condicion_acta = "";
        } else {
            $condicion_acta = "tipo_acta = '$forma_tipo_acta' AND ";
        }
        
        $nombreArchivo = $rutasGlobales["archivos"]."/acta".$forma_fecha_desde."-".$forma_fecha_hasta.".csv";
        if (file_exists($nombreArchivo)){
            unlink($nombreArchivo);
            $archivo = fopen($nombreArchivo,"a+");
        } else {
            $archivo = fopen($nombreArchivo,"a+");
        }    
        
        /*** Obtener los datos de la tabla ***/
        $registro_obras = SQL::seleccionar(array("registro_obras"),array("*"),"$condicion_acta fecha_entrega_acta BETWEEN '$forma_fecha_desde' AND '$forma_fecha_hasta'");      
        if (SQL::filasDevueltas($registro_obras)){
            $titulos_plano = "consorciado;numero requerimiento;fecha requerimiento;descripcion;tipo solicitud;sede;ubicacion;numero cotizacion consorcio;fecha cotizacion consorcio;numero cotizacion consorciado;fecha cotizacion consorciado;estado cotizacion;valor mano de obra;valor materiales;costo directo;administracion;imprevistos;utilidad;impuesto;total;valor facturado;valor pagado;numero factura;tipo acta;fecha acta;detalle acta;pago consorciado;numero factura consorciado;valor mano obra consorciado;valor materiales consorciado;costo directo consorciado;administracion consorciado;imprevistos consorciado;utilidad consorciado;impuesto consorciado;total consorciado;valor mano obra administracion;valor materiales administracion;costo directo administracion;administracion administracion;imprevistos administracion;utilidad administracion;impuesto administracion;total administracion\n";
            fwrite($archivo, $titulos_plano);
       
            while($datos_actas=SQL::filaEnObjeto($registro_obras)){
                $id_requerimiento = SQL::obtenerValor("cotizaciones","id_requerimiento","id='$datos_actas->id_cotizacion'");
                $id_sucursal      = SQL::obtenerValor("requerimientos_clientes","id_sucursal","id='$id_requerimiento'");
                $grabar_registro  = 0;
        
                foreach($forma_sucursales as $sucursal_seleccionada){
                    if ($sucursal_seleccionada == $id_sucursal){
                        $grabar_registro  = 1;
                    }
                }
                if ($grabar_registro==1){
                    $vistaConsultaRequerimiento = "requerimientos_clientes";
                    $columnasRequerimiento      = SQL::obtenerColumnas($vistaConsultaRequerimiento);
                    $consultaRequerimiento      = SQL::seleccionar(array($vistaConsultaRequerimiento), $columnasRequerimiento, "id = '$id_requerimiento'");
                    $datosRequerimiento         = SQL::filaEnObjeto($consultaRequerimiento);

                    $vistaConsultaCotizacion    = "cotizaciones";
                    $columnasCotizacion         = SQL::obtenerColumnas($vistaConsultaCotizacion);
                    $consultaCotizacion         = SQL::seleccionar(array($vistaConsultaCotizacion), $columnasCotizacion, "id = '$datos_actas->id_cotizacion'");
                    $datosCotizacion            = SQL::filaEnObjeto($consultaCotizacion);

                    $consorciado                = SQL::obtenerValor("sucursales","nombre","id='$datosRequerimiento->id_sucursal'");
                    $numero_requerimiento       = $datosRequerimiento->id;
                    $fecha_requerimiento        = $datosRequerimiento->fecha_ingreso;
                    $descripcion_requerimiento  = $datosRequerimiento->descripcion;
                    $descripcion_requerimiento  = str_replace(";",",","$descripcion_requerimiento");
                    $descripcion_requerimiento  = str_replace("  "," ","$descripcion_requerimiento");
                    if ($datosRequerimiento->tipo_solicitud == 'M'){
                       $tipo_solicitud_requerimiento = $textos["MANTENIMIENTO"];
                    }
                    if ($datosRequerimiento->tipo_solicitud == 'P'){
                       $tipo_solicitud_requerimiento = $textos["PROYECTO"];
                    }
                    if ($datosRequerimiento->tipo_solicitud == 'E'){
                       $tipo_solicitud_requerimiento = $textos["EMERGENCIA"];
                    }
                    if ($datosRequerimiento->tipo_solicitud == 'S'){
                       $tipo_solicitud_requerimiento = $textos["SERVICIO"];
                    }
                    if ($datosRequerimiento->tipo_solicitud == 'V'){
                       $tipo_solicitud_requerimiento = $textos["VISITA"];
                    }
                    $id_municipio                  = SQL::obtenerValor("sedes_clientes","id_municipios","id='$datosRequerimiento->id_sede'");
                    $sede_requerimiento            = SQL::obtenerValor("sedes_clientes","nombre_sede","id='$datosRequerimiento->id_sede'");
                    $ubicacion_requerimiento       = SQL::obtenerValor("municipios","nombre","id='$id_municipio'");

                    /*** Cotizaciones ***/
                    $numero_cotizacion             = $datosCotizacion->numero_cotizacion."-".$datosCotizacion->consecutivo_cotizacion;
                    $fecha_cotizacion              = $datosCotizacion->fecha_registro_cotizacion_consorciado;
                    $fecha_cotizacion              = explode(" ",$fecha_cotizacion);
                    $fecha_cotizacion              = $fecha_cotizacion[0];
                    $numero_cotizacion_consorciado = $datosCotizacion->numero_cotizacion_consorciado;
                    $fecha_aprobacion_consorciado  = $datosCotizacion->fecha_registro_aprobacion_clientes;
                    $fecha_aprobacion_cotizacion   = explode(" ",$fecha_aprobacion_cotizacion);
                    $fecha_aprobacion_cotizacion   = $fecha_aprobacion_cotizacion[0];
                    if($datosCotizacion->estado=='1'){
                        $estado_cotizacion = $textos["PENDIENTE"];
                    }
                    if($datosCotizacion->estado=='2'){
                        $estado_cotizacion = $textos["EJECUCION"];
                    }
                    if($datosCotizacion->estado=='3'){
                        $estado_cotizacion = $textos["DESCARTADA"];
                    }
                    if($datosCotizacion->estado=='4'){
                        $estado_cotizacion = $textos["FACTURADA_TOTAL"];
                    }
                    if($datosCotizacion->estado=='5'){
                        $estado_cotizacion = $textos["FACTURADA_PARCIAL"];
                    }
                    if($datosCotizacion->estado=='6'){
                        $estado_cotizacion = $textos["EJECUTADA"];
                    }
                    if($datosCotizacion->estado=='7'){
                        $estado_cotizacion = $textos["REEMPLAZADA"];
                    }
                    if($datosCotizacion->estado=='8'){
                        $estado_cotizacion = $textos["RECOTIZADA"];
                    }
                    $valor_mano_obra_cotizacion  = intval($datosCotizacion->valor_mano_obra_cotizacion);
                    $valor_materiales_cotizacion = intval($datosCotizacion->valor_materiales_cotizacion);
                    $costo_directo_cotizacion    = intval($valor_mano_obra_cotizacion + $valor_materiales_cotizacion);
                    $administracion_cotizacion   = intval($datosCotizacion->costo_administracion_cotizacion);
                    $imprevistos_cotizacion      = intval($datosCotizacion->costo_imprevistos_cotizacion);
                    $utilidad_cotizacion         = intval($datosCotizacion->costo_utilidad);
                    $impuesto_cotizacion         = intval($datosCotizacion->costo_impuesto);
                    $total_cotizacion            = intval($costo_directo_cotizacion + $administracion_cotizacion + $imprevistos_cotizacion + $ultidad_cotizacion + $impuesto_cotizacion);
                    
                    /*** Actas ***/
                    $valor_facturado            = intval($datos_actas->valor_facturar);
                    $valor_pagado               = intval($datos_actas->valor_factura_cliente);
                    
                    if($datos_actas->tipo_acta=='1'){
                        $tipo_acta = $textos["ACTA_INICIO"];
                    }
                    if($datos_actas->tipo_acta=='2'){
                        $tipo_acta = $textos["ACTA_AVANCE_OBRA"];
                    }
                    if($datos_actas->tipo_acta=='3'){
                        $tipo_acta = $textos["ACTA_FINALIZACION"];
                    }
                    if($datos_actas->tipo_acta=='4'){
                        $tipo_acta = $textos["INFORME"];
                    }
                    $fecha_acta                 = $datos_actas->fecha_entrega_acta;
                    $detalle_acta               = $datos_actas->informe;
                    $numero_factura             = $datos_actas->numero_factura;
                    $numero_factura_consorciado = $datos_actas->numero_factura;
                    $pago_consorciado           = $textos["SI_NO_".intval($datos_actas->pago_consorciado)];
                    $mano_obra_consorciado      = intval($datos_actas->valor_mano_obra_consorciado,0);
                    $materiales_consorciado     = intval($datos_actas->valor_materiales_consorciado);
                    $costo_directo_consorciado  = intval($mano_obra_consorciado + $materiales_consorciado);
                    $administracion_consorciado = intval($datos_actas->valor_administracion_consorciado);
                    $imprevistos_consorciado    = intval($datos_actas->valor_imprevistos_consorciado);
                    $utilidad_consorciado       = intval($datos_actas->valor_utilidad_consorciado);
                    $iva_consorciado            = intval($datos_actas->valor_iva_consorciado);
                    $total_consorciado          = intval($costo_directo_consorciado + $administracion_consorciado + $imprevistos_consorciado + $utilidad_consorciado + $iva_consorciado);

                    $mano_obra_administracion      = intval($datos_actas->valor_mano_obra_administracion,0);
                    $materiales_administracion     = intval($datos_actas->valor_materiales_administracion);
                    $costo_directo_administracion  = intval($mano_obra_administracion + $materiales_administracion);
                    $administracion_administracion = intval($datos_actas->valor_administracion_administracion);
                    $imprevistos_administracion    = intval($datos_actas->valor_imprevistos_administracion);
                    $utilidad_administracion       = intval($datos_actas->valor_utilidad_administracion);
                    $iva_administracion            = intval($datos_actas->valor_iva_administracion);
                    $total_administracion          = intval($costo_directo_administracion + $administracion_administracion + $imprevistos_administracion + $utilidad_administracion + $iva_administracion);
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      
                    $contenido      = "$consorciado;$numero_requerimiento;$fecha_requerimiento;\"$descripcion_requerimiento\";$tipo_solicitud_requerimiento;$sede_requerimiento;$ubicacion_requerimiento;$numero_cotizacion;$fecha_cotizacion;$numero_cotizacion_consorciado;$fecha_aprobacion_consorciado;$estado_cotizacion;$valor_mano_obra_cotizacion;$valor_materiales_cotizacion;$costo_directo_cotizacion;$administracion_cotizacion;$imprevistos_cotizacion;$utilidad_cotizacion;$impuesto_cotizacion;$total_cotizacion;$valor_facturado;$valor_pagado;$numero_factura;$tipo_acta;$fecha_acta;$detalle_acta;$pago_consorciado;$numero_factura_consorciado;$mano_obra_consorciado;$materiales_consorciado;$costo_directo_consorciado;$administracion_consorciado;$imprevistos_consorciado;$utilidad_consorciado;$iva_consorciado;$total_consorciado;$mano_obra_administracion;$materiales_administracion;$costo_directo_administracion;$administracion_administracion;$imprevistos_administracion;$utilidad_administracion;$iva_administracion;$total_administracion\n";
                    $guardarArchivo = fwrite($archivo,$contenido);                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 
                }
            }
        }
        fclose($archivo);
        $mensaje = HTML::enlazarPagina($textos["ABRIR_PLANO"], $nombreArchivo, array("target" => "_new"));
    }    
    /*** Enviar datos con la respuesta del proceso al script que origino la peticion ***/
    $respuesta    = array();
    $respuesta[0] = $error;
    $respuesta[1] = $mensaje;
    $respuesta[2] = $mensaje;
    HTTP::enviarJSON($respuesta);
}
?>
