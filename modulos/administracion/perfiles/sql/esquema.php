<?php

/**
*
* Copyright (C) 2009 FELINUX Ltda
* Francisco J. Lozano B. <fjlozano@felinux.com.co>
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

/*** Definición de tablas ***/
$tablas["perfiles"] = array(
    "id"     => "SMALLINT(4) UNSIGNED ZEROFILL AUTO_INCREMENT NOT NULL COMMENT 'Consecutivo interno de la base de datos'",
    "codigo" => "SMALLINT(4) UNSIGNED ZEROFILL NOT NULL COMMENT 'Código asignado al perfil'",
    "nombre" => "VARCHAR(255) NOT NULL DEFAULT '' COMMENT 'Nombre del perfil'"
);

$tablas["componentes_perfil"]   = array(
    "id_perfil"     => "SMALLINT(4) UNSIGNED ZEROFILL NOT NULL COMMENT 'Consecutivo interno para la base de datos del perfil'",
    "id_componente" => "VARCHAR(8) NOT NULL COMMENT 'Identificador del componente'",
);

/*** Definición de llaves primarias ***/
$llavesPrimarias["perfiles"]           = "id";
$llavesPrimarias["componentes_perfil"] = "id_perfil, id_componente";

/*** Definición de llaves primarias ***/
$llavesUnicas["perfiles"] = array(
    "codigo",
    "nombre"
);

$llavesForaneas["componentes_perfil"] = array(
    array(
        /*** Nombre de la llave ***/
        "componente_perfil_perfil",
        /*** Nombre del campo clave de la tabla local ***/
        "id_perfil",
        /*** Nombre de la tabla relacionada ***/
        "perfiles",
        /*** Nombre del campo clave en la tabla relacionada ***/
        "id"
    ),
    array(
        /*** Nombre de la llave ***/
        "componente_perfil_componente",
        /*** Nombre del campo clave de la tabla local ***/
        "id_componente",
        /*** Nombre de la tabla relacionada ***/
        "componentes",
        /*** Nombre del campo clave en la tabla relacionada ***/
        "id"
    )
);

/*** Inserción de datos iniciales ***/
$registros["componentes"] = array(
    array(
        "id"        => "GESTPERF",
        "padre"     => "SUBMACCE",
        "id_modulo" => "ADMINISTRACION",
        "orden"     => "0050",
        "carpeta"   => "perfiles",
        "archivo"   => "menu"
    ),
    array(
        "id"        => "ADICPERF",
        "padre"     => "GESTPERF",
        "id_modulo" => "ADMINISTRACION",
        "visible"   => "0",
        "orden"     => "0005",
        "carpeta"   => "perfiles",
        "archivo"   => "adicionar"
    ),
    array(
        "id"        => "CONSPERF",
        "padre"     => "GESTPERF",
        "id_modulo" => "ADMINISTRACION",
        "visible"   => "0",
        "orden"     => "0010",
        "carpeta"   => "perfiles",
        "archivo"   => "consultar"
    ),
    array(
        "id"        => "MODIPERF",
        "padre"     => "GESTPERF",
        "id_modulo" => "ADMINISTRACION",
        "visible"   => "0",
        "orden"     => "0015",
        "carpeta"   => "perfiles",
        "archivo"   => "modificar"
    ),
    array(
        "id"        => "ELIMPERF",
        "padre"     => "GESTPERF",
        "id_modulo" => "ADMINISTRACION",
        "visible"   => "0",
        "orden"     => "0020",
        "carpeta"   => "perfiles",
        "archivo"   => "eliminar"
    )
);

/*** Sentencias para la creación de las vistas requeridas

    CREATE OR REPLACE VIEW pance_menu_perfiles AS
    SELECT pance_perfiles.id AS id, pance_perfiles.codigo AS CODIGO, pance_perfiles.nombre AS NOMBRE
    FROM pance_perfiles;

    CREATE OR REPLACE VIEW pance_buscador_perfiles AS SELECT id AS id, codigo, nombre FROM pance_perfiles;

***/

?>