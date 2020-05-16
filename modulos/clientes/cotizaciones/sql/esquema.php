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
$tablas ["cotizaciones"] = array(
    "id"                                    => "INT(6) UNSIGNED ZEROFILL AUTO_INCREMENT NOT NULL COMMENT 'Código interno en la base de datos'",
    "id_requerimiento"                      => "INT(8) UNSIGNED ZEROFILL NOT NULL COMMENT 'Código interno que relaciona la cotizacion con el requerimiento'",
    "fecha_registro_aprobacion_clientes"    => "DATE NULL COMMENT 'Fecha aprobacion requerimiento por parte del cliente'",
    "fecha_registro_aprobacion_sistema"     => "DATETIME NULL COMMENT 'Fecha y hora aprobacion requerimiento por parte del cliente'",
    "observaciones_aprobacion_cliente"      => "VARCHAR(60) COMMENT 'Observaciones despues de aprobado por el cliente'",
    "estado"                                => "ENUM('1','2','3','4','5','6','7','8') DEFAULT '1' COMMENT 'Estado de la cotizacion: 1=Pendiente, 2=En ejecucion, 3=Descartada, 4=Facturada total, 5=Facturada parcial,6=Ejecutada, 7=Remplazada, 8=Recotizada'",
    "enviada"                               => "ENUM('0','1') NOT NULL DEFAULT '0' COMMENT 'Cotización enviada 0->No 1->Si'",
    "valor_mano_obra_cotizacion"            => "DECIMAL(12,2) COMMENT 'Valor mano de obra cotizado'",
    "valor_materiales_cotizacion"           => "DECIMAL(12,2) COMMENT 'Valor de los materiales cotizados'",
    "costo_directo"                         => "DECIMAL(12,2) COMMENT 'Valor del costo directo del requerimiento'",
    "porcentaje_administracion_cotizacion"  => "DECIMAL(4,2) COMMENT 'Porcentaje cobro por administracion cotizado'",
    "costo_administracion_cotizacion"       => "DECIMAL(12,2) COMMENT 'Valor por administracion cotizado'",
    "porcentaje_imprevistos_cotizacion"     => "DECIMAL(4,2) COMMENT 'Porcentaje de los imprevistos cotizados'",
    "costo_imprevistos_cotizacion"          => "DECIMAL(12,2) COMMENT 'Valor de los imprevistos cotizados'",
    "porcentaje_utilidad"                   => "DECIMAL(4,2) COMMENT 'Porcentaje de la utilidad'",
    "costo_utilidad"                        => "DECIMAL(12,2) COMMENT 'Valor de la utilidad cotizado'",
    "impuesto"                              => "DECIMAL(4,2) COMMENT 'Porcentaje del impuesto sobre la utilidad'",
    "costo_impuesto"                        => "DECIMAL(12,2) COMMENT 'Valor del impuesto sobre la utilidad'",
    "forma_pago"                            => "ENUM('0','1') DEFAULT '1' COMMENT 'Forma de pago del requerimiento: 0=Pago parcial, 1=Contra-entrega'",
    "porcentaje_anticipo"                   => "DECIMAL(4,2) COMMENT 'Porcentaje sobre el valor total que debe tener el anticipo'",
    "numero_cotizacion"                     => "INT(8) UNSIGNED ZEROFILL NOT NULL COMMENT 'Numero de la cotizacion'",
    "consecutivo_cotizacion"                => "SMALLINT(2) UNSIGNED ZEROFILL DEFAULT '0' NOT NULL COMMENT 'Consecutivo numero cotización'",
    "numero_cotizacion_consorciado"         => "VARCHAR(15) COMMENT 'Numero de la cotizacion del consorciado'",
    "fecha_registro_cotizacion_consorciado" => "DATETIME NULL COMMENT 'Fecha registro cotizacion por parte del consorciado'",
    "tipo_acta"                             => "ENUM('1','2','3','4','5') DEFAULT '5' COMMENT 'Tipo de acta: 1=Acta inicio, 2=Acta avance obra, 3=Acta finalización, 4=Informe, 5=No aplica'",
    "numero_contrato"                       => "VARCHAR(15) NULL COMMENT 'Numero del contrato asignado al requerimiento'",
    "numero_poliza"                         => "VARCHAR(15) NULL COMMENT 'Numero de la poliza asignada al requerimiento'"
);

/*** Definición de llaves primarias ***/
$llavesPrimarias["cotizaciones"] = "id";

/*** Definición de llaves primarias ***/
$llavesUnicas["cotizaciones"] = array(
    "numero_cotizacion,consecutivo_cotizacion"
);

/***  Definición de llaves foráneas ***/
$llavesForaneas["cotizaciones"] = array(
    array(
        /*** Nombre de la llave ***/
        "cotizacion_requerimiento",
        /*** Nombre del campo clave de la tabla local ***/
        "id_requerimiento",
        /*** Nombre de la tabla relacionada ***/
        "requerimientos_clientes",
        /*** Nombre del campo clave en la tabla relacionada ***/
        "id"
    )

);

/*** Inserción de datos iniciales ***/
$registros["componentes"] = array(
    array(
        "id"        => "GESTCOCL",
        "padre"     => "SUBMCOSE",
        "id_modulo" => "CLIENTES",
        "visible"   => "1",
        "orden"     => "0060",
        "carpeta"   => "cotizaciones",
        "archivo"   => "menu"
    ),
    array(
        "id"        => "EXPOCOTI",
        "padre"     => "GESTCOCL",
        "id_modulo" => "CLIENTES",
        "visible"   => "0",
        "orden"     => "0005",
        "carpeta"   => "cotizaciones",
        "archivo"   => "exportar"
    ),
    array(
        "id"        => "APROCOTI",
        "padre"     => "GESTCOCL",
        "id_modulo" => "CLIENTES",
        "visible"   => "0",
        "orden"     => "0010",
        "carpeta"   => "cotizaciones",
        "archivo"   => "aprobar"
    ),
    array(
        "id"        => "ANULCOTI",
        "padre"     => "GESTCOCL",
        "id_modulo" => "CLIENTES",
        "visible"   => "0",
        "orden"     => "0015",
        "carpeta"   => "cotizaciones",
        "archivo"   => "anular"
    ),
    array(
        "id"        => "REPLCOTI",
        "padre"     => "GESTCOCL",
        "id_modulo" => "CLIENTES",
        "visible"   => "0",
        "orden"     => "0020",
        "carpeta"   => "cotizaciones",
        "archivo"   => "reemplazar"
    ),
    array(
        "id"        => "RECOCOTI",
        "padre"     => "GESTCOCL",
        "id_modulo" => "CLIENTES",
        "visible"   => "0",
        "orden"     => "0025",
        "carpeta"   => "cotizaciones",
        "archivo"   => "recotizar"
    ),
    array(
        "id"        => "EJECCOTI",
        "padre"     => "GESTCOCL",
        "id_modulo" => "CLIENTES",
        "visible"   => "0",
        "orden"     => "0030",
        "carpeta"   => "cotizaciones",
        "archivo"   => "ejecutar"
    ),
    array(
        "id"        => "REPOCOTI",
        "padre"     => "GESTCOCL",
        "id_modulo" => "CLIENTES",
        "visible"   => "0",
        "orden"     => "0035",
        "carpeta"   => "cotizaciones",
        "archivo"   => "reporte"
    )
);

/*** Sentencia para la creación de la vista requerida ***/
/*** CREATE OR REPLACE VIEW pance_menu_cotizaciones AS SELECT pance_cotizaciones.id AS id,
     pance_requerimientos_clientes.id_sucursal AS id_sucursal,
     CONCAT(pance_cotizaciones.numero_cotizacion,'-',pance_cotizaciones.consecutivo_cotizacion) AS NUMERO_COTIZACION,
     pance_cotizaciones.numero_contrato AS CONTRATO,
     pance_cotizaciones.numero_poliza AS POLIZA,
     pance_sedes_clientes.nombre_sede AS SEDE,
     pance_municipios.nombre AS MUNICIPIO,
     DATE_FORMAT(pance_cotizaciones.fecha_registro_cotizacion_consorciado, '%Y-%m-%d') AS FECHA_INGRESO,
     FORMAT(
       (pance_cotizaciones.costo_directo +
        (if(pance_cotizaciones.costo_administracion_cotizacion is NULL, 0, pance_cotizaciones.costo_administracion_cotizacion)) +
        (if(pance_cotizaciones.costo_imprevistos_cotizacion is NULL, 0, pance_cotizaciones.costo_imprevistos_cotizacion)) +
        (if(pance_cotizaciones.costo_utilidad is NULL, 0, pance_cotizaciones.costo_utilidad)) +
        pance_cotizaciones.costo_impuesto
       ), 0
     ) AS TOTAL_GENERAL,
     pance_requerimientos_clientes.descripcion AS DESCRIPCION,
     pance_sucursales.nombre AS SUCURSAL,
     pance_cotizaciones.numero_cotizacion_consorciado AS NUMERO_COTIZACION_CONSORCIADO,
     CASE pance_cotizaciones.estado WHEN '1' THEN 'Pendiente'
     WHEN '2' THEN 'En ejecución'
     WHEN '3' THEN 'Descartada'
     WHEN '4' THEN 'Facturada total' 
     WHEN '5' THEN 'Facturada parcial'
     WHEN '6' THEN 'Ejecutada'
     WHEN '7' THEN 'Reemplazada'
     WHEN '8' THEN 'Recotizada'  END AS ESTADO
     FROM pance_requerimientos_clientes, pance_sucursales, pance_sedes_clientes, pance_municipios, pance_cotizaciones
     WHERE pance_cotizaciones.id_requerimiento = pance_requerimientos_clientes.id 
     AND pance_requerimientos_clientes.id_sede = pance_sedes_clientes.id
     AND pance_requerimientos_clientes.id_sucursal = pance_sucursales.id 
     AND pance_municipios.id = pance_sedes_clientes.id_municipios;

     CREATE OR REPLACE VIEW pance_consulta_cotizaciones AS SELECT pance_cotizaciones.id AS id,
     pance_cotizaciones.id_requerimiento AS id_requerimiento,
     CONCAT(
        pance_cotizaciones.numero_cotizacion,'-',pance_cotizaciones.consecutivo_cotizacion
     ) AS NUMERO_COTIZACION,
     pance_cotizaciones.numero_contrato AS CONTRATO,
     pance_cotizaciones.fecha_registro_cotizacion_consorciado AS FECHA_COTIZACION,
     CONCAT('$',FORMAT(pance_cotizaciones.valor_mano_obra_cotizacion, 0)) AS MANO_OBRA,
     CONCAT('$',FORMAT(pance_cotizaciones.valor_materiales_cotizacion, 0)) AS MATERIALES,
     CONCAT('$',FORMAT(pance_cotizaciones.costo_directo, 0)) AS COSTO_DIRECTO,
     CONCAT('$',FORMAT(pance_cotizaciones.costo_administracion_cotizacion, 0)) AS COSTO_ADMINISTRACION,
     CONCAT('$',FORMAT(pance_cotizaciones.costo_imprevistos_cotizacion, 0)) AS COSTO_IMPREVISTOS,
     CONCAT('$',FORMAT(pance_cotizaciones.costo_utilidad, 0)) AS COSTO_UTILIDAD,
     CONCAT('$',FORMAT(pance_cotizaciones.costo_impuesto, 0)) AS COSTO_IMPUESTO,
     pance_cotizaciones.numero_cotizacion_consorciado AS NUMERO_COTIZACION_CONSORCIADO,
     CASE pance_cotizaciones.estado WHEN '1' THEN 'Pendiente'
     WHEN '2' THEN 'En ejecución'
     WHEN '3' THEN 'Descartada'
     WHEN '4' THEN 'Facturada total' 
     WHEN '5' THEN 'Facturada parcial'
     WHEN '6' THEN 'Ejecutada'
     WHEN '7' THEN 'Reemplazada'
     WHEN '8' THEN 'Recotizada'  END AS ESTADO_COTIZACION
     FROM pance_cotizaciones;

     CREATE OR REPLACE VIEW pance_buscador_cotizaciones AS SELECT pance_cotizaciones.id AS id,
     pance_requerimientos_clientes.id_sucursal AS id_sucursal,
     CONCAT(pance_cotizaciones.numero_cotizacion,'-',pance_cotizaciones.consecutivo_cotizacion) AS numero_cotizacion,
     pance_cotizaciones.numero_cotizacion_consorciado AS numero_cotizacion_consorciado,
     pance_cotizaciones.numero_contrato AS numero_contrato,
     pance_cotizaciones.numero_poliza AS numero_poliza,
     DATE_FORMAT(pance_cotizaciones.fecha_registro_cotizacion_consorciado, '%Y-%m-%d') AS fecha_ingreso,
     pance_requerimientos_clientes.id_sede AS id_sede,
     pance_sedes_clientes.nombre_sede AS nombre_sede,
     pance_municipios.nombre AS municipio,
     pance_sucursales.nombre AS sucursal,
     CASE pance_requerimientos_clientes.tipo_solicitud WHEN 'M' THEN 'Mantenimiento'
     WHEN  'E' THEN 'Emergencia'
     WHEN 'S' THEN 'Servicio por demanda'
     WHEN 'P' THEN 'Proyecto' END AS tipo_solicitud,
     pance_requerimientos_clientes.descripcion AS descripcion,
     pance_requerimientos_clientes.nombre_contacto AS contacto,
     IF(pance_cotizaciones.forma_pago = '0', 'Pago parcial', 'Contra-entrega') AS forma_pago,
     CASE pance_cotizaciones.estado WHEN '1' THEN 'Pendiente'
     WHEN '2' THEN 'En ejecución'
     WHEN '3' THEN 'Descartada'
     WHEN '4' THEN 'Facturada total' 
     WHEN '5' THEN 'Facturada parcial'
     WHEN '6' THEN 'Ejecutada'
     WHEN '7' THEN 'Reemplazada'
     WHEN '8' THEN 'Recotizada'  END AS ESTADO
     FROM pance_requerimientos_clientes, pance_sedes_clientes, pance_sucursales, pance_cotizaciones, pance_municipios
     WHERE pance_cotizaciones.id_requerimiento = pance_requerimientos_clientes.id 
     AND pance_requerimientos_clientes.id_sede = pance_sedes_clientes.id
     AND pance_requerimientos_clientes.id_sucursal = pance_sucursales.id 
     AND pance_municipios.id = pance_sedes_clientes.id_municipios;

***/
?>
