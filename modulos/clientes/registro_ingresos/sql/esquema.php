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
$tablas ["registro_ingresos"] = array(
    "id"               => "INT(6) UNSIGNED ZEROFILL AUTO_INCREMENT NOT NULL COMMENT 'Código interno en la base de datos'",
    "id_requerimiento" => "INT(8) UNSIGNED ZEROFILL NOT NULL COMMENT 'Código interno que relaciona la cotizacion con el requerimiento'",
    "concepto"         => "ENUM('1','2') DEFAULT '1' COMMENT 'Concepto: 1=Ingreso, 2=Gasto'",
    "fecha_concepto"   => "DATE NOT NULL COMMENT 'Fecha del concepto'",
    "valor_concepto"   => "DECIMAL(12,2) COMMENT 'Valor del ingreso o egreso'",
);

/*** Definición de llaves primarias ***/
$llavesPrimarias["registro_ingresos"] = "id";

/***  Definición de llaves foráneas ***/
$llavesForaneas["registro_ingresos"] = array(
    array(
        /*** Nombre de la llave ***/
        "registro_ingresos_requerimiento",
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
        "id"        => "GESTINEG",
        "padre"     => "SUBMCOSE",
        "id_modulo" => "CLIENTES",
        "visible"   => "1",
        "orden"     => "0100",
        "carpeta"   => "registro_ingresos",
        "archivo"   => "menu"
    ),
    array(
        "id"        => "ADICINEG",
        "padre"     => "GESTINEG",
        "id_modulo" => "CLIENTES",
        "visible"   => "0",
        "orden"     => "0005",
        "carpeta"   => "registro_ingresos",
        "archivo"   => "adicionar"
    ),
    array(
        "id"        => "CONSINEG",
        "padre"     => "GESTINEG",
        "id_modulo" => "CLIENTES",
        "visible"   => "0",
        "orden"     => "0010",
        "carpeta"   => "registro_ingresos",
        "archivo"   => "consultar"
    ),
    array(
        "id"        => "MODIINEG",
        "padre"     => "GESTINEG",
        "id_modulo" => "CLIENTES",
        "visible"   => "0",
        "orden"     => "0015",
        "carpeta"   => "registro_ingresos",
        "archivo"   => "modificar"
    ),
    array(
        "id"        => "ELIMINEG",
        "padre"     => "GESTINEG",
        "id_modulo" => "CLIENTES",
        "visible"   => "0",
        "orden"     => "0020",
        "carpeta"   => "registro_ingresos",
        "archivo"   => "eliminar"
    )
);

/*** Sentencia para la creación de la vista requerida ***/
/*** CREATE OR REPLACE VIEW pance_menu_registro_ingresos AS SELECT pance_cotizaciones.id AS id, 
     pance_requerimientos_clientes.id_sucursal AS id_sucursal,
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
     WHEN 'V' THEN 'Visita' END AS TIPO_SOLICITUD
     FROM pance_requerimientos_clientes, pance_sedes_clientes, pance_sucursales, pance_municipios, pance_cotizaciones, pance_registro_obras
     WHERE pance_requerimientos_clientes.id_sede = pance_sedes_clientes.id 
     AND pance_requerimientos_clientes.id_sucursal = pance_sucursales.id
     AND pance_sedes_clientes.id_municipios = pance_municipios.id
     AND pance_requerimientos_clientes.id = pance_cotizaciones.id_requerimiento 
     AND (pance_cotizaciones.estado = '2' OR pance_cotizaciones.estado = '4')
     AND pance_cotizaciones.id = pance_registro_obras.id_cotizacion;
                       
     CREATE OR REPLACE VIEW pance_seleccion_registro_ingresos AS SELECT pance_cotizaciones.id AS id, 
     pance_cotizaciones.numero_cotizacion AS NUMERO_COTIZACION,
     pance_registro_ingresos.fecha_concepto AS FECHA_CONCEPTO,
     pance_requerimientos_clientes.descripcion AS DESCRIPCION,
     IF(pance_registro_ingresos.concepto = '1', 'Ingreso', 'Egreso') AS CONCEPTO,
     pance_registro_ingresos.valor_concepto AS VALOR_CONCEPTO
     FROM pance_requerimientos_clientes, pance_registro_ingresos, pance_cotizaciones
     WHERE pance_registro_ingresos.id_requerimiento = pance_requerimientos_clientes.id 
     AND pance_cotizaciones.id_requerimiento = pance_requerimientos_clientes.id;
       
***/
?>
