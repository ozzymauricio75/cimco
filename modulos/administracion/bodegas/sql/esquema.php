<?php

/**
*
* Copyright (C) 2008 LinuxCali Ltda
* Francisco J. Lozano B. <pacho@linuxcali.com>
* Margarita Hoyos <margarita@linuxcali.com>
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
$tablas ["bodegas"] = array(
    "id"             => "MEDIUMINT(5) UNSIGNED ZEROFILL AUTO_INCREMENT NOT NULL COMMENT 'Consecutivo interno de la base de datos'",
    "codigo"         => "SMALLINT(4) UNSIGNED ZEROFILL NOT NULL COMMENT 'Código interno de la bodega'",
    "id_sucursal"    => "MEDIUMINT(5) UNSIGNED ZEROFILL NOT NULL COMMENT 'Código interno de la sucursal a la cual pertenece'",
    "nombre"         => "VARCHAR(60) NOT NULL COMMENT 'Nombre que identifica la bodega'",
    "descripcion"    => "VARCHAR(60) NOT NULL COMMENT 'Nombre que describe la bodega'",
    "tipo_bodega"    => "SMALLINT(3) UNSIGNED ZEROFILL NOT NULL COMMENT 'Localizacion donde se encuentra ubicado el articulo'"
);

/*** Definición de llaves primarias ***/
$llavesPrimarias["bodegas"] = "id";

/*** Definición de campos únicos ***/
$llavesUnicas["bodegas"] = array(
    "codigo"
);

/***  Definición de llaves foráneas ***/
$llavesForaneas["bodegas"] = array(
    array(
        /*** Nombre de la llave ***/
        "bodega_sucursal",
        /*** Nombre del campo clave de la tabla local ***/
        "id_sucursal",
        /*** Nombre de la tabla relacionada ***/
        "sucursales",
        /*** Nombre del campo clave en la tabla relacionada ***/
        "id"
    ),
    array(
        /*** Nombre de la llave ***/
        "tipo_bodega",
        /*** Nombre del campo clave de la tabla local ***/
        "tipo_bodega",
        /*** Nombre de la tabla relacionada ***/
        "tipos_bodegas",
        /*** Nombre del campo clave en la tabla relacionada ***/
        "id"
    )
);

/*** Inserción de datos iniciales ***/
$registros["componentes"] = array(
    array(
        "id"        => "GESTBODE",
        "padre"     => "SUBMESTC",
        "id_modulo" => "ADMINISTRACION",
        "visible"   => "1",
        "orden"     => "0015",
        "carpeta"   => "bodegas",
        "archivo"   => "menu"
    ),
    array(
        "id"        => "ADICBODE",
        "padre"     => "GESTBODE",
        "id_modulo" => "ADMINISTRACION",
        "visible"   => "0",
        "orden"     => "0005",
        "carpeta"   => "bodegas",
        "archivo"   => "adicionar"
    ),
    array(
        "id"        => "CONSBODE",
        "padre"     => "GESTBODE",
        "id_modulo" => "ADMINISTRACION",
        "visible"   => "0",
        "orden"     => "0010",
        "carpeta"   => "bodegas",
        "archivo"   => "consultar"
    ),
    array(
        "id"        => "MODIBODE",
        "padre"     => "GESTBODE",
        "id_modulo" => "ADMINISTRACION",
        "visible"   => "0",
        "orden"     => "0015",
        "carpeta"   => "bodegas",
        "archivo"   => "modificar"
    ),
    array(
        "id"        => "ELIMBODE",
        "padre"     => "GESTBODE",
        "id_modulo" => "ADMINISTRACION",
        "visible"   => "0",
        "orden"     => "0020",
        "carpeta"   => "bodegas",
        "archivo"   => "eliminar"
    )
);

/*** Sentencia para la creación de la vista requerida ***/
/*** CREATE OR REPLACE VIEW pance_menu_bodegas AS
     SELECT pance_bodegas.id AS id,
     pance_bodegas.codigo AS CODIGO,
     pance_bodegas.nombre AS NOMBRE,
     pance_bodegas.descripcion AS DESCRIPCION,
     pance_sucursales.nombre AS SUCURSAL
     FROM pance_bodegas, pance_sucursales
     WHERE
     pance_bodegas.id_sucursal = pance_sucursales.id;

     CREATE OR REPLACE VIEW pance_buscador_bodegas AS SELECT pance_bodegas.id AS id,
     pance_bodegas.codigo AS codigo, pance_bodegas.id_sucursal AS codigo_sucursal, pance_bodegas.nombre AS nombre,
     pance_bodegas.descripcion AS descripcion, pance_bodegas.tipo_bodega AS tipo_bodega, pance_sucursales.nombre AS sucursal
     FROM pance_bodegas, pance_sucursales
     WHERE pance_bodegas.id_sucursal = pance_sucursales.id;
     ***/
?>
