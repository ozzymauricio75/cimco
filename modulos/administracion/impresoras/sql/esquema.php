<?php

/**
*
* Copyright (C) 2009 FELINUX Ltda
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
* SIN GARANÃA ALGUNA; ni siquiera la garantía implícita MERCANTIL o
* de APTITUD PARA UN PROPOSITO DETERMINADO. Consulte los detalles de
* la Licencia Pública General GNU para obtener una información mÃ¡s
* detallada.
*
* Debería haber recibido una copia de la Licencia Pública General GNU
* junto a este programa. En caso contrario, consulte:
* <http://www.gnu.org/licenses/>.
*
**/
$borrarSiempre   = false;

/*** Definición de tablas ***/
$tablas["impresoras"] = array(
    "id"             => "SMALLINT(3) UNSIGNED ZEROFILL AUTO_INCREMENT NOT NULL COMMENT 'Consecutivo interno de la base de datos'",
    "nombre_cola" => "VARCHAR(50) NOT NULL COMMENT 'Nombre de la cola de impresión'",
    "descripcion"    => "VARCHAR(50) NOT NULL COMMENT 'Descripción de la impresora'"
);


/*** Definición de llaves primarias ***/
$llavesPrimarias["impresoras"]   = "id";

/*** Definición de las llaves unicas ***/
// $llavesUnicas["impresoras"] = array(
//     "codigo_interno",
//     "nombre"
// );

/*** Inserción de datos iniciales ***/
$registros["componentes"] = array(
    array(
        "id"        => "GESTIMPR",
        "padre"     => "SUBMDISP",
        "id_modulo" => "ADMINISTRACION",
        "orden"     => "0100",
        "visible"   => "1",
        "carpeta"   => "impresoras",
        "archivo"   => "menu"
    ),
    array(
        "id"        => "ADICIMPR",
        "padre"     => "GESTIMPR",
        "id_modulo" => "ADMINISTRACION",
        "visible"   => "0",
        "orden"     => "0005",
        "carpeta"   => "impresoras",
        "archivo"   => "adicionar"
    ),
    array(
        "id"        => "CONSIMPR",
        "padre"     => "GESTIMPR",
        "id_modulo" => "ADMINISTRACION",
        "visible"   => "0",
        "orden"     => "0010",
        "carpeta"   => "impresoras",
        "archivo"   => "consultar"
    ),
    array(
        "id"        => "MODIIMPR",
        "padre"     => "GESTIMPR",
        "id_modulo" => "ADMINISTRACION",
        "visible"   => "0",
        "orden"     => "0015",
        "carpeta"   => "impresoras",
        "archivo"   => "modificar"
    ),
    array(
        "id"        => "ELIMIMPR",
        "padre"     => "GESTIMPR",
        "id_modulo" => "ADMINISTRACION",
        "visible"   => "0",
        "orden"     => "0020",
        "carpeta"   => "impresoras",
        "archivo"   => "eliminar"
    )
);

/*** Sentencia para la creación de la vista requerida ***/
/*** 
CREATE OR REPLACE VIEW `pance_menu_impresoras` AS
SELECT `id` AS id,
`nombre_cola` AS NOMBRE_COLA,
`descripcion` AS DESCRIPCION
FROM `pance_impresoras`;

CREATE OR REPLACE VIEW `pance_buscador_impresoras` AS
SELECT `id` AS id,
`nombre_cola` AS nombre_cola,
`descripcion` AS descripcion
FROM `pance_impresoras`;

***/
?>
