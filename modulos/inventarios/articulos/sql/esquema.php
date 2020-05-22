<?php

/**
*
* Copyright (C) 2020 Raul Mauricio Oidor Lozano
* Raul Mauricio Oidor Lozano <ozzymauricio75@gmail.com>
*
* Este archivo es parte de:
* PANCE :: Software empresarial a la medida
*
* Este programa es software libre: usted puede redistribuirlo y/o
* modificarlo  bajo los términos de la Licencia Pública General GNU
* publicada por la Fundación para el Software Libre, ya sea la versión 3
* de la Licencia, o (a su elección) cualquier versión posterior.
*
* Este programa se distribuye con la esperanza de que sea útil, pero
* SIN GARANTÍA ALGUNA; ni siquiera la garantía implícita MERCANTIL o
* de APTITUD PARA UN PROPÓITO DETERMINADO. Consulte los detalles de
* la Licencia Pública General GNU para obtener una información más
* detallada.
*
* Debería haber recibido una copia de la Licencia Pública General GNU
* junto a este programa. En caso contrario, consulte:
* <http://www.gnu.org/licenses/>.
*
**/
$borrarSiempre["articulos"] = false;
$tablas["articulos"] = array(
    "id"                      => "INT(9) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Llave primaria'",
    "id_sucursal"             => "MEDIUMINT(5) UNSIGNED ZEROFILL NOT NULL COMMENT 'Id de la tabla sucursales'",
    "id_proveedor"            => "INT(8) UNSIGNED ZEROFILL NOT NULL COMMENT 'Id de la tabla terceros'",
    "codigo"                  => "VARCHAR(15) NOT NULL COMMENT 'Codigo interno'",
    "detalle"                 => "VARCHAR(40) NOT NULL COMMENT 'Detalle del articulo'",
    "referencia"              => "VARCHAR(15) NOT NULL COMMENT 'Referencia principal del articulo'",
    "tipo_inventario"         => "ENUM('1','2') NOT NULL DEFAULT '1' COMMENT '1->Materia prima 2->Suministro'",
    "estado"                  => "ENUM('0','1') NOT NULL DEFAULT '1' COMMENT 'Inactivo 0->No 1->Si'",
    "precio"                  => "DECIMAL(11,2) NOT NULL COMMENT 'Precio'",
    "id_tasa"                 => "INT(7) UNSIGNED ZEROFILL NOT NULL COMMENT 'Id de la tabla tasas'",
    "id_usuario_registra"     => "SMALLINT(4) UNSIGNED ZEROFILL NOT NULL DEFAULT '0' COMMENT 'Id del usuario que genera el registro'",
    "fecha_registra"          => "DATETIME NOT NULL COMMENT 'Fecha ingreso al sistema'",
    "fecha_modificacion"      => "TIMESTAMP  NOT NULL COMMENT 'Fecha ultima modificación'",
);
// Definición de llaves primarias
$llavesPrimarias["articulos"] = "id";

// Definición de campos únicos
$llavesUnicas["articulos"] = array(
    "codigo,referencia"
);

$indicesTabla["articulos"] = array(
    array(
        "articulo_detalle",
        "detalle"
    )
);

//Definición de llave foraneas
$llavesForaneas["articulos"] = array(
    array(
        // Nombre de la llave
        "articulos_tasa",
        // Nombre del campo clave de la tabla local
        "id_tasa",
        // Nombre de la tabla relacionada
        "tasas",
        // Nombre del campo clave en la tabla relacionada
        "id"
    ),
    array(
        // Nombre de la llave
        "articulos_sucursal",
        // Nombre del campo clave de la tabla local
        "id_sucursal",
        // Nombre de la tabla relacionada
        "sucursales",
        // Nombre del campo clave en la tabla relacionada
        "id"
    ),
    array(
        // Nombre de la llave
        "articulos_terceros",
        // Nombre del campo clave de la tabla local
        "id_proveedor",
        // Nombre de la tabla relacionada
        "terceros",
        // Nombre del campo clave en la tabla relacionada
        "id"
    ),
);

// Inserción de datos iniciales***/
$registros["articulos"] = array(
    array(
        "id"                  => "0",
        "id_sucursal"         => "0",
        "codigo"              => "0",
        "detalle"             => "",
        "referencia"          => "",
        "tipo_inventario"     => "0",
        "estado"              => "0",
        "precio"              => 0,
        "id_tasa"             => "0",
        "id_usuario_registra" => "0",
        "fecha_registra"      => "",
        "fecha_modificacion"  => ""
    )
);

// Inserción de datos iniciales***/
$registros["componentes"] = array(
    array(
        "id"              => "GESTARTI",
        "padre"           => "MENUINVE",
        "id_modulo"       => "INVENTARIO",
        "visible"         => "1",
        "orden"           => "5",
        "carpeta"         => "articulos",
        "archivo"         => "menu"
    ),
    array(
        "id"              => "ADICARTI",
        "padre"           => "GESTARTI",
        "id_modulo"       => "INVENTARIO",
        "visible"         => "0",
        "orden"           => "0010",
        "carpeta"         => "articulos",
        "archivo"         => "adicionar"
    ),
    array(
        "id"              => "CONSARTI",
        "padre"           => "GESTARTI",
        "id_modulo"       => "INVENTARIO",
        "visible"         => "0",
        "orden"           => "0020",
        "carpeta"         => "articulos",
        "archivo"         => "consultar"
    ),
    array(
        "id"              => "MODIARTI",
        "padre"           => "GESTARTI",
        "id_modulo"       => "INVENTARIO",
        "visible"         => "0",
        "orden"           => "0030",
        "carpeta"         => "articulos",
        "archivo"         => "modificar"
    ),
    array(
        "id"              => "ELIMARTI",
        "padre"           => "GESTARTI",
        "id_modulo"       => "INVENTARIO",
        "visible"         => "0",
        "orden"           => "0040",
        "carpeta"         => "articulos",
        "archivo"         => "eliminar"
    ),
    array(
        "id"              => "LISTARTI",
        "padre"           => "GESTARTI",
        "id_modulo"       => "INVENTARIO",
        "visible"         => "0",
        "orden"           => "0040",
        "carpeta"         => "articulos",
        "archivo"         => "listar"
    )
);

$vistas = array(
    array(
        "CREATE OR REPLACE ALGORITHM = MERGE VIEW pance_menu_articulos AS
            SELECT  pance_articulos.id AS id,
                    pance_articulos.id_sucursal AS SUCURSAL,
                    pance_articulos.codigo AS CODIGO,
                    pance_articulos.detalle AS DESCRIPCION
            FROM    pance_articulos
            WHERE   pance_articulos.codigo != 0;"
    ),
    array(
        "CREATE OR REPLACE ALGORITHM = MERGE VIEW pance_buscador_articulos AS
            SELECT  pance_articulos.id AS id,
                    pance_articulos.id_sucursal AS SUCURSAL,
                    pance_articulos.codigo AS CODIGO,
                    pance_articulos.detalle AS DESCRIPCION
            FROM    pance_articulos
            WHERE   pance_articulos.codigo != 0;"
    )
);
/*** Sentencia para la creación de la vista requerida ***/
/***
    CREATE OR REPLACE VIEW pance_menu_articulos AS
        SELECT pance_articulos.id AS id,
            pance_sucursales.nombre AS SUCURSAL,
            pance_articulos.codigo AS CODIGO,
            pance_articulos.detalle  AS DESCRIPCION,
            pance_articulos.referencia AS REFERENCIA,
            pance_articulos.precio AS COSTO,
        CONCAT(if(pance_terceros.primer_nombre is not null, pance_terceros.primer_nombre, ''),' ',
            if(pance_terceros.segundo_nombre is not null, pance_terceros.segundo_nombre, ''),' ',
            if(pance_terceros.primer_apellido is not null, pance_terceros.primer_apellido, ''),' ',
            if(pance_terceros.segundo_apellido is not null, pance_terceros.segundo_apellido, ''),' ',
            if(pance_terceros.razon_social is not null, pance_terceros.razon_social, '')) AS PROVEEDOR
        FROM 
            pance_articulos,pance_terceros,pance_proveedores,pance_sucursales
        WHERE 
            pance_articulos.id_proveedor = pance_proveedores.id AND
            pance_terceros.id = pance_proveedores.id AND 
            pance_articulos.id_sucursal = pance_sucursales.id;
*/
?>

