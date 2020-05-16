<?php

/**
*
* Copyright (C) 2008 LinuxCali Ltda
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
* SIN GARANÍA ALGUNA; ni siquiera la garantía implícita MERCANTIL o
* de APTITUD PARA UN PROPOSITO DETERMINADO. Consulte los detalles de
* la Licencia Pública General GNU para obtener una información más
* detallada.
*
* Debería haber recibido una copia de la Licencia Pública General GNU
* junto a este programa. En caso contrario, consulte:
* <http://www.gnu.org/licenses/>.
*
**/
$borrarSiempre   = false;

/*** Definición de tablas ***/
$tablas["cargos"] = array(
    "id"             => "SMALLINT(3) UNSIGNED ZEROFILL AUTO_INCREMENT NOT NULL COMMENT 'Consecutivo interno de la base de datos'",
    "codigo_interno" => "SMALLINT(3) UNSIGNED ZEROFILL NOT NULL COMMENT 'Codigo interno asignado por el usuario'",
    "nombre"         => "VARCHAR(50) NOT NULL COMMENT 'Nombre del cargo'",
    "interno"        => "ENUM('0','1') NOT NULL DEFAULT '1' COMMENT 'Cargo interno 0->No 1->Si'"
);


/*** Definición de llaves primarias ***/
$llavesPrimarias["cargos"]   = "id";

/*** Definición de las llaves unicas ***/
$llavesUnicas["cargos"] = array(
    "codigo_interno",
    "nombre"
);

/*** Inserción de datos iniciales ***/
$registros["componentes"] = array(
    array(
        "id"        => "GESTCARG",
        "padre"     => "SUBMDCAD",
        "id_modulo" => "ADMINISTRACION",
        "orden"     => "0045",
        "visible"   => "1",
        "carpeta"   => "cargos",
        "archivo"   => "menu"
    ),
    array(
        "id"        => "ADICCARG",
        "padre"     => "GESTCARG",
        "id_modulo" => "ADMINISTRACION",
        "visible"   => "0",
        "orden"     => "0005",
        "carpeta"   => "cargos",
        "archivo"   => "adicionar"
    ),
    array(
        "id"        => "CONSCARG",
        "padre"     => "GESTCARG",
        "id_modulo" => "ADMINISTRACION",
        "visible"   => "0",
        "orden"     => "0010",
        "carpeta"   => "cargos",
        "archivo"   => "consultar"
    ),
    array(
        "id"        => "MODICARG",
        "padre"     => "GESTCARG",
        "id_modulo" => "ADMINISTRACION",
        "visible"   => "0",
        "orden"     => "0015",
        "carpeta"   => "cargos",
        "archivo"   => "modificar"
    ),
    array(
        "id"        => "ELIMCARG",
        "padre"     => "GESTCARG",
        "id_modulo" => "ADMINISTRACION",
        "visible"   => "0",
        "orden"     => "0020",
        "carpeta"   => "cargos",
        "archivo"   => "eliminar"
    )
);

/*** Sentencia para la creación de la vista requerida ***/
/*** 
CREATE OR REPLACE VIEW pance_menu_cargos AS
SELECT id AS id,
codigo_interno AS CODIGO,
nombre AS NOMBRE,
if(interno = 0, 'General', 'Interno') AS INTERNO
FROM pance_cargos;

CREATE OR REPLACE VIEW pance_buscador_cargos AS
SELECT id AS id,
codigo_interno AS codigo,
nombre AS nombre,
if(interno = 0, 'General', 'Interno') AS INTERNO
FROM pance_cargos;

***/
?>
