<?php

/**
*
* Copyright (C) 2009 SAE Ltda
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

/*** Eliminar la tabla y crearla de nuevo cada vez que se ejecute el script de creación ***/
$borrarSiempre = false;

/*** Definición de tablas ***/
$tablas ["registro_obras"] = array(
    "id"                                  => "INT(6) UNSIGNED ZEROFILL AUTO_INCREMENT NOT NULL COMMENT 'Código interno en la base de datos'",
    "id_cotizacion"                       => "INT(6) UNSIGNED ZEROFILL NOT NULL COMMENT 'Código interno que relaciona la acta con la cotización'",
    "tipo_acta"                           => "ENUM('1','2','3','4') DEFAULT '1' COMMENT ' Tipo de acta: 1=Acta inicio, 2=Acta avance obra, 3=Acta finalización, 4=Informe'",
    "fecha_entrega_acta"                  => "DATE NULL COMMENT 'Fecha de entrega del acta'",
    "valor_facturar"                      => "DECIMAL(12,2) COMMENT 'Valor del acta'",
    "valor_factura_cliente"               => "DECIMAL(12,2) COMMENT 'Valor facturado al cliente'",
    "valor_factura_consorciado"           => "DECIMAL(12,2) COMMENT 'Valor facturado al consorciado'",
    "numero_factura"                      => "VARCHAR(15) NULL COMMENT 'Numero de la factura realizada por el consorcio'",
    "numero_factura_consorciado"          => "VARCHAR(15) NULL COMMENT 'Numero de la factura realizada por el consorciado'",
    "factura_consorciado"                 => "ENUM('0','1') DEFAULT '0' COMMENT 'Envio de la factura al consorciado: 0=No, 1=Si'",
    "pago_cliente"                        => "ENUM('0','1') DEFAULT '0' COMMENT 'Estado del pago del cliente: 0=No, 1=Si'",
    "pago_consorciado"                    => "ENUM('0','1') DEFAULT '0' COMMENT 'Estado del pago del consorciado: 0=No, 1=Si'",
    "porcentaje_mano_obra"                => "DECIMAL(5,2) COMMENT 'Porcentaje que le corresponde al consorciado por la mano de obra'",
    "porcentaje_materiales"               => "DECIMAL(5,2) COMMENT 'Porcentaje que le corresponde al consorciado por materiales'",    
    "imagen"                              => "VARCHAR(255) NULL COMMENT 'Imagen del acta'",
    "informe"                             => "VARCHAR(255) NULL COMMENT 'Informe especial sobre el acta'",
    "valor_mano_obra_consorciado"         => "DECIMAL(12,2) NULL DEFAULT '0' COMMENT 'Valor mano de obra consorciado'",
    "valor_materiales_consorciado"        => "DECIMAL(12,2) NULL DEFAULT '0' COMMENT 'Valor de los materiales consorciado'",
    "costo_directo_consorciado"           => "DECIMAL(12,2) NULL DEFAULT '0' COMMENT 'Valor del costo directo del requerimiento para el consorciado'",
    "valor_administracion_consorciado"    => "DECIMAL(12,2) NULL DEFAULT '0' COMMENT 'Valor por administracion cotizado consorciado'",
    "valor_imprevistos_consorciado"       => "DECIMAL(12,2) NULL DEFAULT '0' COMMENT 'Valor de los imprevistos cotizados consorciado'",
    "valor_utilidad_consorciado"          => "DECIMAL(12,2) NULL DEFAULT '0' COMMENT 'Valor de la utilidad cotizado consorciado'",
    "valor_iva_consorciado"               => "DECIMAL(12,2) NULL DEFAULT '0' COMMENT 'Valor del impuesto sobre la utilidad consorciado'",
    "valor_mano_obra_administracion"      => "DECIMAL(12,2) NULL DEFAULT '0' COMMENT 'Valor mano de obra administracion'",
    "valor_materiales_administracion"     => "DECIMAL(12,2) NULL DEFAULT '0' COMMENT 'Valor de los materiales administracion'",
    "costo_directo_administracion"        => "DECIMAL(12,2) NULL DEFAULT '0' COMMENT 'Valor del costo directo del requerimiento administracion'",
    "valor_administracion_administracion" => "DECIMAL(12,2) NULL DEFAULT '0' COMMENT 'Valor por administracion cotizado administracion'",
    "valor_imprevistos_administracion"    => "DECIMAL(12,2) NULL DEFAULT '0' COMMENT 'Valor de los imprevistos cotizados administracion'",
    "valor_utilidad_administracion"       => "DECIMAL(12,2) NULL DEFAULT '0' COMMENT 'Valor de la utilidad cotizado administracion'",
    "valor_iva_administracion"            => "DECIMAL(12,2) NULL DEFAULT '0' COMMENT 'Valor del impuesto sobre la utilidad administracion'"
);

/*** Definición de llaves primarias ***/
$llavesPrimarias["registro_obras"] = "id";

/***  Definición de llaves foráneas ***/
$llavesForaneas["registro_obras"] = array(
    array(
        /*** Nombre de la llave ***/
        "registro_obras_cotizacion",
        /*** Nombre del campo clave de la tabla local ***/
        "id_cotizacion",
        /*** Nombre de la tabla relacionada ***/
        "cotizaciones",
        /*** Nombre del campo clave en la tabla relacionada ***/
        "id"
    )  
);  

/*** Inserción de datos iniciales ***/
$registros["componentes"] = array(
    array(
        "id"        => "GESTREOB",
        "padre"     => "SUBMCOSE",
        "id_modulo" => "CLIENTES",
        "visible"   => "1",
        "orden"     => "0060",
        "carpeta"   => "registro_obras",
        "archivo"   => "menu"
    ),
    array(
        "id"        => "ADICREOB",
        "padre"     => "GESTREOB",
        "id_modulo" => "CLIENTES",
        "visible"   => "0",
        "orden"     => "0005",
        "carpeta"   => "registro_obras",
        "archivo"   => "adicionar"
    ),
    array(
        "id"        => "CONSREOB",
        "padre"     => "GESTREOB",
        "id_modulo" => "CLIENTES",
        "visible"   => "0",
        "orden"     => "0010",
        "carpeta"   => "registro_obras",
        "archivo"   => "consultar"
    ),
    array(
        "id"        => "MODIREOB",
        "padre"     => "GESTREOB",
        "id_modulo" => "CLIENTES",
        "visible"   => "0",
        "orden"     => "0015",
        "carpeta"   => "registro_obras",
        "archivo"   => "modificar"
    ),
    array(
        "id"        => "ELIMREOB",
        "padre"     => "GESTREOB",
        "id_modulo" => "CLIENTES",
        "visible"   => "0",
        "orden"     => "0020",
        "carpeta"   => "registro_obras",
        "archivo"   => "eliminar"
    )
);

/*** Sentencia para la creación de la vista requerida ***/
/*** CREATE OR REPLACE VIEW pance_menu_registro_obras AS SELECT pance_cotizaciones.id AS id, 
     pance_sucursales.id AS id_sucursal,
     CONCAT(pance_cotizaciones.numero_cotizacion,'-',pance_cotizaciones.consecutivo_cotizacion) AS NUMERO_COTIZACION,
     pance_requerimientos_clientes.fecha_ingreso AS FECHA_INGRESO,
     pance_sedes_clientes.nombre_sede AS SEDE,
     pance_municipios.nombre AS MUNICIPIO,
     pance_requerimientos_clientes.descripcion AS DESCRIPCION,
     pance_sucursales.nombre AS SUCURSAL,
     CASE pance_requerimientos_clientes.tipo_solicitud WHEN 'M' THEN 'Mantenimiento'
     WHEN 'E' THEN 'Emergencia' 
     WHEN 'S' THEN 'Servicio por demanda'
     WHEN 'P' THEN 'Proyecto' 
     WHEN 'V' THEN 'Visita' END AS TIPO_SOLICITUD,
     CASE pance_cotizaciones.tipo_acta WHEN '1' THEN 'Inicio'
     WHEN '2' THEN 'Avance obra' 
     WHEN '3' THEN 'Finalización'
     WHEN '4' THEN 'Informe'  
     WHEN '5' THEN 'No aplica' END AS TIPO_ACTA ,
     CASE pance_cotizaciones.estado WHEN '1' THEN 'Pendiente'
     WHEN '2' THEN 'En ejecución'
     WHEN '3' THEN 'Descartada'
     WHEN '4' THEN 'Facturada total' 
     WHEN '5' THEN 'Facturada parcial'
     WHEN '6' THEN 'Ejecutada'
     WHEN '7' THEN 'Recotizada'
     WHEN '8' THEN 'Reemplazada'  END AS ESTADO
     FROM pance_requerimientos_clientes, pance_sedes_clientes, pance_sucursales, pance_municipios, pance_cotizaciones
     WHERE pance_requerimientos_clientes.id_sede = pance_sedes_clientes.id
     AND pance_requerimientos_clientes.id_sucursal = pance_sucursales.id
     AND pance_sedes_clientes.id_municipios = pance_municipios.id 
     AND pance_requerimientos_clientes.id = pance_cotizaciones.id_requerimiento 
     AND ((pance_cotizaciones.estado = '2') OR (pance_cotizaciones.estado = '5')  OR (pance_cotizaciones.estado = '6'));

     CREATE OR REPLACE VIEW pance_menu_registro_obras AS SELECT pance_cotizaciones.id AS id, 
     pance_sucursales.id AS id_sucursal,
     CONCAT(pance_cotizaciones.numero_cotizacion,'-',pance_cotizaciones.consecutivo_cotizacion) AS NUMERO_COTIZACION,
     pance_requerimientos_clientes.fecha_ingreso AS FECHA_INGRESO,
     pance_sedes_clientes.nombre_sede AS SEDE,
     pance_municipios.nombre AS MUNICIPIO,
     pance_requerimientos_clientes.descripcion AS DESCRIPCION,
     pance_sucursales.nombre AS SUCURSAL,
     CASE pance_requerimientos_clientes.tipo_solicitud WHEN 'M' THEN 'Mantenimiento'
     WHEN 'E' THEN 'Emergencia' 
     WHEN 'S' THEN 'Servicio por demanda'
     WHEN 'P' THEN 'Proyecto' 
     WHEN 'V' THEN 'Visita' END AS TIPO_SOLICITUD,
     CASE pance_cotizaciones.tipo_acta WHEN '1' THEN 'Inicio'
     WHEN '2' THEN 'Avance obra' 
     WHEN '3' THEN 'Finalización'
     WHEN '4' THEN 'Informe'  
     WHEN '5' THEN 'No aplica' END AS TIPO_ACTA ,
     CASE pance_cotizaciones.estado WHEN '1' THEN 'Pendiente'
     WHEN '2' THEN 'En ejecución'
     WHEN '3' THEN 'Descartada'
     WHEN '4' THEN 'Facturada total' 
     WHEN '5' THEN 'Facturada parcial'
     WHEN '6' THEN 'Ejecutada'
     WHEN '7' THEN 'Recotizada'
     WHEN '8' THEN 'Reemplazada'  END AS ESTADO
     FROM pance_requerimientos_clientes, pance_sedes_clientes, pance_sucursales, pance_municipios, pance_cotizaciones
     WHERE pance_requerimientos_clientes.id_sede = pance_sedes_clientes.id
     AND pance_requerimientos_clientes.id_sucursal = pance_sucursales.id
     AND pance_sedes_clientes.id_municipios = pance_municipios.id 
     AND pance_requerimientos_clientes.id = pance_cotizaciones.id_requerimiento 
     AND ((pance_cotizaciones.estado = '2') OR (pance_cotizaciones.estado = '5')  OR (pance_cotizaciones.estado = '6'));               
     
     CREATE OR REPLACE VIEW pance_consulta_registro_obras AS SELECT
     pance_registro_obras.id AS id,
     pance_registro_obras.id_cotizacion AS id_cotizacion,
     pance_cotizaciones.id_requerimiento AS id_requerimiento,
     CONCAT(pance_cotizaciones.numero_cotizacion,'-',pance_cotizaciones.consecutivo_cotizacion) AS NUMERO_COTIZACION,
     CASE pance_registro_obras.tipo_acta WHEN '1' THEN 'Inicio'
     WHEN '2' THEN 'Avance obra' 
     WHEN '3' THEN 'Finalización'
     WHEN '4' THEN 'Informe'  
     WHEN '5' THEN 'No aplica' END AS TIPO_ACTA,
     pance_registro_obras.fecha_entrega_acta AS FECHA_ACTA,
     pance_registro_obras.porcentaje_mano_obra AS PORCENTAJE_MANO_OBRA,
     pance_registro_obras.porcentaje_materiales AS PORCENTAJE_MATERIALES,
     CONCAT('$', FORMAT(pance_registro_obras.valor_facturar,0)) AS VALOR_ACTA,
     pance_registro_obras.numero_factura AS FACTURA_CLIENTE,
     CONCAT('$', FORMAT(pance_registro_obras.valor_factura_cliente,0)) AS VALOR_CLIENTE,
     pance_registro_obras.numero_factura_consorciado AS FACTURA_CONSORCIADO,
     CONCAT('$',
        FORMAT(
            IF(pance_registro_obras.valor_mano_obra_consorciado IS NOT NULL, pance_registro_obras.valor_mano_obra_consorciado, 0) +
            IF(pance_registro_obras.valor_materiales_consorciado IS NOT NULL, pance_registro_obras.valor_materiales_consorciado, 0) +
            IF(pance_registro_obras.valor_administracion_consorciado IS NOT NULL, pance_registro_obras.valor_administracion_consorciado, 0) +
            IF(pance_registro_obras.valor_imprevistos_consorciado IS NOT NULL, pance_registro_obras.valor_imprevistos_consorciado, 0) +
            IF(pance_registro_obras.valor_utilidad_consorciado IS NOT NULL, pance_registro_obras.valor_utilidad_consorciado, 0) +
            IF(pance_registro_obras.valor_iva_consorciado IS NOT NULL, pance_registro_obras.valor_iva_consorciado, 0),
            0
        )
     ) AS VALOR_CONSORCIADO,
     CONCAT('$',
        FORMAT(
            IF(pance_registro_obras.valor_mano_obra_administracion IS NOT NULL, pance_registro_obras.valor_mano_obra_administracion, 0) +
            IF(pance_registro_obras.valor_materiales_administracion IS NOT NULL, pance_registro_obras.valor_materiales_administracion, 0) +
            IF(pance_registro_obras.valor_administracion_administracion IS NOT NULL, pance_registro_obras.valor_administracion_administracion, 0) +
            IF(pance_registro_obras.valor_imprevistos_administracion IS NOT NULL, pance_registro_obras.valor_imprevistos_administracion, 0) +
            IF(pance_registro_obras.valor_utilidad_administracion IS NOT NULL, pance_registro_obras.valor_utilidad_administracion, 0) +
            IF(pance_registro_obras.valor_iva_administracion IS NOT NULL, pance_registro_obras.valor_iva_administracion, 0),
            0
        )
     ) AS VALOR_ADMINISTRACION
     FROM pance_registro_obras,pance_requerimientos_clientes,pance_cotizaciones
     WHERE pance_cotizaciones.id_requerimiento = pance_requerimientos_clientes.id AND
     pance_cotizaciones.id = pance_registro_obras.id_cotizacion
     ;
     
     CREATE OR REPLACE VIEW pance_seleccion_registro_obras AS SELECT pance_cotizaciones.id AS id, 
     CONCAT(pance_cotizaciones.numero_cotizacion,'-',pance_cotizaciones.consecutivo_cotizacion) AS NUMEROCOTIZACION,
     CASE pance_registro_obras.tipo_acta WHEN '1' THEN 'Inicio'
     WHEN '2' THEN 'Avance obra' 
     WHEN '3' THEN 'Finalización' 
     WHEN '4' THEN 'Informe' END AS TIPOACTA,
     pance_registro_obras.fecha_entrega_acta AS FECHAENTREGA,
     pance_registro_obras.numero_factura AS NUMEROFACTURA,
     FORMAT(pance_registro_obras.valor_facturar, 0) AS VALORFACTURAR,
     IF(pance_registro_obras.factura_consorciado = '0', 'No enviada', 'Enviada') AS FACTURACONSORCIADO,
     IF(pance_registro_obras.pago_cliente = '0', 'Pendiente', 'Pagada') AS PAGOCLIENTE,
     IF(pance_registro_obras.pago_consorciado = '0', 'Pendiente', 'Pagada') AS PAGOCONSORCIADO,
     pance_registro_obras.porcentaje_mano_obra AS PORCENTAJEMANOOBRA,
     pance_registro_obras.porcentaje_materiales AS PORCENTAJEMATERIALES
     FROM pance_registro_obras, pance_cotizaciones, pance_requerimientos_clientes
     WHERE pance_registro_obras.id_cotizacion = pance_cotizaciones.id AND pance_cotizaciones.id_requerimiento = pance_requerimientos_clientes.id;
    
    CODIGO PHP PARA CALCULAR VALORES CONSORCIADO Y ADMINISTRACION
        $cotizaciones = SQL::seleccionar(array("registro_obras"),array("*"),"valor_factura_cliente > 0");
        if(SQL::filasDevueltas($cotizaciones)){
            while($datos_pagos=SQL::filaEnObjeto($cotizaciones)){
 
                $mano_obra                            = SQL::obtenerValor("cotizaciones","valor_mano_obra_cotizacion","id = '$datos_pagos->id_cotizacion'");
                $materiales                           = SQL::obtenerValor("cotizaciones","valor_materiales_cotizacion","id = '$datos_pagos->id_cotizacion'");
                $costo_directo                        = $mano_obra + $materiales;
                $impuesto                             = SQL::obtenerValor("cotizaciones","impuesto","id = '$datos_pagos->id_cotizacion'");
                $iva                                  = SQL::obtenerValor("cotizaciones","costo_impuesto","id = '$datos_pagos->id_cotizacion'");
                $porcentaje_administracion_cotizacion = SQL::obtenerValor("cotizaciones","porcentaje_administracion_cotizacion","id = '$datos_pagos->id_cotizacion'");
                $porcentaje_imprevistos_cotizacion    = SQL::obtenerValor("cotizaciones","porcentaje_imprevistos_cotizacion","id = '$datos_pagos->id_cotizacion'");
                $porcentaje_utilidad_cotizacion       = SQL::obtenerValor("cotizaciones","porcentaje_utilidad","id = '$datos_pagos->id_cotizacion'");
                $costo_administracion_cotizacion      = SQL::obtenerValor("cotizaciones","costo_administracion_cotizacion","id = '$datos_pagos->id_cotizacion'");
                $costo_imprevistos_cotizacion         = SQL::obtenerValor("cotizaciones","costo_imprevistos_cotizacion","id = '$datos_pagos->id_cotizacion'");
                $costo_utilidad_cotizacion            = SQL::obtenerValor("cotizaciones","costo_utilidad","id = '$datos_pagos->id_cotizacion'");

                if (empty($forma_porcentaje_administracion_cotizacion)){
                    $total_aiu  = 0;
                } else {
                    $total_aiu = $costo_administracion_cotizacion + $costo_imprevistos_cotizacion + $costo_utilidad_cotizacion;
                }

                $porcentaje_participacion = $datos_pagos->valor_factura_cliente / ($costo_directo + $iva + $total_aiu);
                
                if ($porcentaje_participacion>1){
                    $porcentaje_participacion = 1;
                }
                    
                $valor_mano_obra_consorciado      = $mano_obra * $porcentaje_participacion;
                $valor_mano_obra_consorciado      = ($valor_mano_obra_consorciado * $datos_pagos->porcentaje_mano_obra) / 100;
                $valor_materiales_consorciado     = $materiales * $porcentaje_participacion;
                $valor_materiales_consorciado     = ($valor_materiales_consorciado * $datos_pagos->porcentaje_materiales) / 100;
                $costo_directo_consorciado        = $valor_mano_obra_consorciado + $valor_materiales_consorciado;
                $valor_administracion_consorciado = ($costo_directo_consorciado * $porcentaje_administracion_cotizacion) / 100;
                $valor_imprevistos_consorciado    = ($costo_directo_consorciado * $porcentaje_imprevistos_cotizacion) / 100;
                $valor_utilidad_consorciado       = ($costo_directo_consorciado * $porcentaje_utilidad_cotizacion) / 100;

                if ($valor_utilidad_consorciado > 0){
                    $iva_consorciado = ($valor_utilidad_consorciado * $impuesto) / 100;
                } else {
                    $iva_consorciado = ($costo_directo_consorciado * $impuesto) / 100;
                }

                $porcentaje_mano_obra_administracion  = 100 - $datos_pagos->porcentaje_mano_obra;
                $porcentaje_materiales_administracion = 100 - $datos_pagos->porcentaje_materiales;
                
                $valor_mano_obra_administracion       = $mano_obra * $porcentaje_participacion;
                $valor_mano_obra_administracion       = ($valor_mano_obra_administracion * $porcentaje_mano_obra_administracion) / 100;
                $valor_materiales_administracion      = $materiales * $porcentaje_participacion;
                $valor_materiales_administracion      = ($valor_materiales_administracion * $porcentaje_materiales_administracion) / 100;
                $costo_directo_administracion         = $valor_mano_obra_administracion + $valor_materiales_administracion;
                $valor_administracion_administracion  = ($costo_directo_administracion * $porcentaje_administracion_cotizacion) / 100;
                $valor_imprevistos_administracion     = ($costo_directo_administracion * $porcentaje_imprevistos_cotizacion) / 100;
                $valor_utilidad_administracion        = ($costo_directo_administracion * $porcentaje_utilidad_cotizaion) / 100;

                if ($valor_utilidad_administracion > 0){
                    $iva_administracion = ($valor_utilidad_administracion * $impuesto) / 100;
                } else {
                    $iva_administracion = ($costo_directo_administracion * $impuesto) / 100;
                }
                
                $datos = array(
                    "valor_mano_obra_consorciado"         => round($valor_mano_obra_consorciado),
                    "valor_materiales_consorciado"        => round($valor_materiales_consorciado),
                    "costo_directo_consorciado"           => round($costo_directo_consorciado),
                    "valor_administracion_consorciado"    => round($valor_administracion_consorciado),
                    "valor_imprevistos_consorciado"       => round($valor_imprevistos_consorciado),
                    "valor_utilidad_consorciado"          => round($valor_utilidad_consorciado),
                    "valor_iva_consorciado"               => round($iva_consorciado),
                    "valor_mano_obra_administracion"      => round($valor_mano_obra_administracion),
                    "valor_materiales_administracion"     => round($valor_materiales_administracion),
                    "costo_directo_administracion"        => round($costo_directo_administracion),
                    "valor_administracion_administracion" => round($valor_administracion_administracion),
                    "valor_imprevistos_administracion"    => round($valor_imprevistos_administracion),
                    "valor_utilidad_administracion"       => round($valor_utilidad_administracion),
                    "valor_iva_administracion"            => round($iva_administracion)
                );
                $modificar = SQL::modificar("registro_obras",$datos,"id='$datos_pagos->id'");
            }
        }
           
***/
?>
