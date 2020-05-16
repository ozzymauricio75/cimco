<?php

/**
*
* Copyright (C) 2009 FELINUX Ltda
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
* SIN GARANÍA ALGUNA; ni siquiera la garant�a impl�cita MERCANTIL o
* de APTITUD PARA UN PROPOSITO DETERMINADO. Consulte los detalles de
* la Licencia P�blica General GNU para obtener una informaci�n más
* detallada.
*
* Deber�a haber recibido una copia de la Licencia P�blica General GNU
* junto a este programa. En caso contrario, consulte:
* <http://www.gnu.org/licenses/>.
*
**/
$borrarSiempre   = false;

/*** Definici�n de tablas ***/
$tablas["impresoras"] = array(
    "id"             => "SMALLINT(3) UNSIGNED ZEROFILL AUTO_INCREMENT NOT NULL COMMENT 'Consecutivo interno de la base de datos'",
    "nombre_cola" => "VARCHAR(50) NOT NULL COMMENT 'Nombre de la cola de impresi�n'",
    "descripcion"    => "VARCHAR(50) NOT NULL COMMENT 'Descripci�n de la impresora'"
);


/*** Definici�n de llaves primarias ***/
$llavesPrimarias["impresoras"]   = "id";

/*** Definici�n de las llaves unicas ***/
// $llavesUnicas["impresoras"] = array(
//     "codigo_interno",
//     "nombre"
// );

/*** Inserci�n de datos iniciales ***/
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

/*** Sentencia para la creaci�n de la vista requerida ***/
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
