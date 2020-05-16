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
$tablas ["requerimientos_clientes"] = array(
    "id"                                    => "INT(8) UNSIGNED ZEROFILL AUTO_INCREMENT NOT NULL COMMENT 'Código interno en al base de datos'",
    "id_sede"                               => "INT(8) UNSIGNED ZEROFILL NOT NULL COMMENT 'Código interno relaciona con la empresa'",
    "id_sucursal"                           => "MEDIUMINT(5) UNSIGNED ZEROFILL NOT NULL COMMENT 'Consecutivo interno que identifica la sucursal'",
    "tipo_solicitud"                        => "ENUM('M','E','S','P','V') NOT NULL DEFAULT 'M' COMMENT 'El tipo de servicio que se presta el consorcio: M=Mantenimiento, E=Emergencia, S=Servicio por demanda, P=Proyecto, V=Visita'",
    "fecha_ingreso"                         => "DATE NOT NULL COMMENT 'Fecha de solicitud del servicio ingresada por el usuario'",
    "fecha_ingreso_sistema"                 => "DATETIME NULL COMMENT 'Fecha de solicitud del servicio del sistema'",
    "fecha_confirmacion"                    => "DATE COMMENT 'Fecha de confirmación del servicio ingresada por el usuario'",
    "fecha_confirmacion_sistema"            => "DATETIME NULL COMMENT 'Fecha de confirmación del servicio del sistema'",
    "descripcion"                           => "VARCHAR(255) NOT NULL COMMENT 'Descripción del servicio solicitado'",
    "observaciones"                         => "VARCHAR(60) COMMENT 'Observación del cliente'",
    "observaciones_visita"                  => "VARCHAR(60) COMMENT 'Observaciones de la visita'",
    "fecha_visita"                          => "DATE NULL DEFAULT '0000-00-00' COMMENT 'Fecha en que se realiza la visita'",
    "fecha_limite_visita"                   => "DATE NULL DEFAULT '0000-00-00' COMMENT 'Fecha limite para realizar la visita'",
    "nombre_contacto"                       => "VARCHAR(255) NULL COMMENT 'Nombre que identifica el contacto del requerimiento'",
    "telefono_contacto"                     => "VARCHAR(15) NULL COMMENT 'Telefono del contacto requerimiento'",
    "persona_recibe"                        => "VARCHAR(255) NULL COMMENT 'Nombre que identifica el contacto del requerimiento'",
    "estado_requerimiento"                  => "ENUM('1','2','3','4') DEFAULT '1' COMMENT 'Estado del requerimiento 1=Requerimiento 2=Visita sin oferta 3=Visita reportada 4=Cotizado'",
    "notificado"                            => "ENUM('0','1') DEFAULT '0' COMMENT 'Consorciado notificado: 0=No, 1=Si'",
    "medio_recibo"                          => "VARCHAR(255) NULL COMMENT 'Medio por el cual se recibio el requerimiento (ejemplo: internet, celular, etc)'",
    "codigo_contable"                       => "VARCHAR(15) NULL COMMENT 'código del plan contable'"
);

/*** Definición de llaves primarias ***/
$llavesPrimarias["requerimientos_clientes"] = "id";


/***  Definición de llaves foráneas ***/
$llavesForaneas["requerimientos_clientes"] = array(
    array(
        /*** Nombre de la llave ***/
        "requerimientos_sedes",
        /*** Nombre del campo clave de la tabla local ***/
        "id_sede",
        /*** Nombre de la tabla relacionada ***/
        "sedes_clientes",
        /*** Nombre del campo clave en la tabla relacionada ***/
        "id"
    ),
    array(
        /*** Nombre de la llave ***/
        "requerimientos_sucursales",
        /*** Nombre del campo clave de la tabla local ***/
        "id_sucursal",
        /*** Nombre de la tabla relacionada ***/
        "sucursales",
        /*** Nombre del campo clave en la tabla relacionada ***/
        "id"
    )

);

/*** Inserción de datos iniciales ***/
$registros["componentes"] = array(
    array(
        "id"        => "GESTRECL",
        "padre"     => "SUBMCOSE",
        "id_modulo" => "CLIENTES",
        "visible"   => "1",
        "orden"     => "0040",
        "carpeta"   => "requerimientos_clientes",
        "archivo"   => "menu"
    ),
    array(
        "id"        => "ADICRECL",
        "padre"     => "GESTRECL",
        "id_modulo" => "CLIENTES",
        "visible"   => "0",
        "orden"     => "0005",
        "carpeta"   => "requerimientos_clientes",
        "archivo"   => "adicionar"
    ),
    array(
        "id"        => "CONSRECL",
        "padre"     => "GESTRECL",
        "id_modulo" => "CLIENTES",
        "visible"   => "0",
        "orden"     => "0010",
        "carpeta"   => "requerimientos_clientes",
        "archivo"   => "consultar"
    ),
    array(
        "id"        => "MODIRECL",
        "padre"     => "GESTRECL",
        "id_modulo" => "CLIENTES",
        "visible"   => "0",
        "orden"     => "0015",
        "carpeta"   => "requerimientos_clientes",
        "archivo"   => "modificar"
    ),
    array(
        "id"        => "ELIMRECL",
        "padre"     => "GESTRECL",
        "id_modulo" => "CLIENTES",
        "visible"   => "0",
        "orden"     => "0020",
        "carpeta"   => "requerimientos_clientes",
        "archivo"   => "eliminar"

    ),
    array(
        "id"        => "NOTIRECL",
        "padre"     => "GESTRECL",
        "id_modulo" => "CLIENTES",
        "visible"   => "0",
        "orden"     => "0025",
        "carpeta"   => "requerimientos_clientes",
        "archivo"   => "notificar"

    ),
    array(
        "id"        => "REPORECL",
        "padre"     => "GESTRECL",
        "id_modulo" => "CLIENTES",
        "visible"   => "0",
        "orden"     => "0035",
        "carpeta"   => "requerimientos_clientes",
        "archivo"   => "reporte"
    )
);

/*** Sentencia para la creación de la vista requerida ***/
/*** CREATE OR REPLACE VIEW pance_menu_requerimientos_clientes AS SELECT pance_requerimientos_clientes.id AS id,
     pance_sucursales.id AS id_sucursal,
     pance_requerimientos_clientes.id AS CONSECUTIVO,
     pance_requerimientos_clientes.fecha_ingreso AS FECHA_INGRESO,
     pance_sedes_clientes.nombre_sede AS SEDE,
     pance_municipios.nombre AS MUNICIPIO,
     pance_requerimientos_clientes.descripcion AS DESCRIPCION,
     pance_requerimientos_clientes.observaciones AS OBSERVACIONES,
     pance_sucursales.nombre AS SUCURSAL,
     CASE pance_requerimientos_clientes.tipo_solicitud WHEN 'M' THEN 'Mantenimiento'
     WHEN 'E' THEN 'Emergencia'
     WHEN 'S' THEN 'Servicio por demanda'
     WHEN 'P' THEN 'Proyecto'
     WHEN 'V' THEN 'Visita' END AS TIPO_SOLICITUD,
     IF(pance_requerimientos_clientes.notificado = '0', 'No', 'Si') AS NOTIFICADO,
     CASE pance_requerimientos_clientes.estado_requerimiento WHEN '1' THEN 'Requerimiento'
     WHEN '2' THEN 'Visita sin oferta'
     WHEN '3' THEN 'Visita reportada'
     WHEN '4' THEN 'Cotizado' END AS ESTADO_REQUERIMIENTO
     FROM pance_requerimientos_clientes, pance_sedes_clientes, pance_sucursales, pance_municipios
     WHERE pance_requerimientos_clientes.id_sede = pance_sedes_clientes.id AND pance_requerimientos_clientes.id_sucursal = pance_sucursales.id
     AND pance_sedes_clientes.id_municipios = pance_municipios.id ORDER BY pance_requerimientos_clientes.fecha_ingreso DESC;

     CREATE OR REPLACE VIEW pance_buscador_requerimientos_clientes AS SELECT pance_requerimientos_clientes.id AS id,
     pance_sucursales.id AS id_sucursal,     pance_requerimientos_clientes.id AS consecutivo,
     pance_sedes_clientes.nombre_sede AS nombre_sede,
     pance_sucursales.nombre AS sucursal,
     pance_municipios.nombre AS municipio,
     pance_requerimientos_clientes.descripcion AS descripcion,
     pance_requerimientos_clientes.observaciones AS observaciones,
     pance_requerimientos_clientes.fecha_ingreso_sistema AS fecha_ingreso,
     CASE pance_requerimientos_clientes.tipo_solicitud WHEN 'M' THEN 'Mantenimiento'
     WHEN  'E' THEN 'Emergencia'
     WHEN 'S' THEN 'Servicio por demanda'
     WHEN 'P' THEN 'Proyecto'
     WHEN 'V' THEN 'Visita' END AS tipo_solicitud,
     CASE pance_requerimientos_clientes.estado_requerimiento WHEN '1' THEN 'Requerimiento'
     WHEN '2' THEN 'Visita sin oferta'
     WHEN '3' THEN 'Visita reportada'
     WHEN '4' THEN 'Cotizado' END AS estado_requerimiento,
     pance_requerimientos_clientes.nombre_contacto AS contacto
     FROM pance_requerimientos_clientes, pance_sedes_clientes, pance_sucursales, pance_municipios
     WHERE pance_requerimientos_clientes.id_sede = pance_sedes_clientes.id AND pance_requerimientos_clientes.id_sucursal = pance_sucursales.id
     AND pance_sedes_clientes.id_municipios = pance_municipios.id;

     CREATE OR REPLACE VIEW pance_seleccion_requerimientos_clientes AS SELECT pance_requerimientos_clientes.id AS id,
     pance_sedes_clientes.nombre_sede AS nombre_sede,
     pance_sucursales.nombre AS sucursal,
     CASE pance_requerimientos_clientes.tipo_solicitud WHEN 'M' THEN 'Mantenimiento'
     WHEN  'E' THEN 'Emergencia'
     WHEN 'S' THEN 'Servicio por demanda'
     WHEN 'P' THEN 'Proyecto'
     WHEN 'V' THEN 'Visita' END AS tipo_solicitud
     FROM pance_requerimientos_clientes, pance_sedes_clientes, pance_sucursales
     WHERE pance_requerimientos_clientes.id_sede = pance_sedes_clientes.id AND pance_requerimientos_clientes.id_sucursal = pance_sucursales.id;

***/
?>
