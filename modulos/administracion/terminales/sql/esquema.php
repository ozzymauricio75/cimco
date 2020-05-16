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
$tablas["terminales"] = array(
    "id"             => "SMALLINT(3) UNSIGNED ZEROFILL AUTO_INCREMENT NOT NULL COMMENT 'Consecutivo interno de la base de datos'",
    "id_servidor"    => "SMALLINT(3) UNSIGNED ZEROFILL NOT NULL COMMENT 'Consecutivo interno de la base de datos para el servidor al que pertenece'",
    "ip"	         => "VARCHAR(15) NOT NULL COMMENT 'Drirección IP de la terminal'",
    "nombre_netbios" => "VARCHAR(50) NOT NULL COMMENT 'Nombre NetBIOS'",
    "nombre_tcpip"   => "VARCHAR(50) NOT NULL COMMENT 'Nombre TCP/IP'",
    "descripcion"    => "VARCHAR(50) NULL COMMENT 'Descripción de la terminal'"
);

/*** Definición de llaves foráneas ***/
$llavesForaneas["terminales"] = array(
    array(
        /*** Nombre de la llave ***/
        "terminal_servidor",
        /*** Nombre del campo clave de la tabla local ***/
        "id_servidor",
        /*** Nombre de la tabla relacionada ***/
        "servidores",
        /*** Nombre del campo clave en la tabla relacionada ***/
        "id"
    )
);

/*** Definición de llaves primarias ***/
$llavesPrimarias["terminales"]   = "id";

/*** Inserción de datos iniciales ***/
$registros["componentes"] = array(
    array(
        "id"        => "GESTTERM",
        "padre"     => "SUBMDISP",
        "id_modulo" => "ADMINISTRACION",
        "orden"     => "0005",
        "visible"   => "1",
        "carpeta"   => "terminales",
        "archivo"   => "menu"
    ),
    array(
        "id"        => "ADICTERM",
        "padre"     => "GESTTERM",
        "id_modulo" => "ADMINISTRACION",
        "visible"   => "0",
        "orden"     => "0005",
        "carpeta"   => "terminales",
        "archivo"   => "adicionar"
    ),
    array(
        "id"        => "CONSTERM",
        "padre"     => "GESTTERM",
        "id_modulo" => "ADMINISTRACION",
        "visible"   => "0",
        "orden"     => "0010",
        "carpeta"   => "terminales",
        "archivo"   => "consultar"
    ),
    array(
        "id"        => "MODITERM",
        "padre"     => "GESTTERM",
        "id_modulo" => "ADMINISTRACION",
        "visible"   => "0",
        "orden"     => "0015",
        "carpeta"   => "terminales",
        "archivo"   => "modificar"
    ),
    array(
        "id"        => "ELIMTERM",
        "padre"     => "GESTTERM",
        "id_modulo" => "ADMINISTRACION",
        "visible"   => "0",
        "orden"     => "0020",
        "carpeta"   => "terminales",
        "archivo"   => "eliminar"
    )
);

/*** Sentencia para la creación de la vista requerida ***/
/***

CREATE OR REPLACE VIEW `pance_menu_terminales` AS
SELECT `id`,
`ip` AS IP,
`nombre_netbios` AS NOMBRE_NETBIOS,
`nombre_tcpip` AS NOMBRE_TCPIP
FROM `pance_terminales`;

CREATE OR REPLACE VIEW `pance_buscador_terminales` AS
SELECT `id`,
`ip` AS ip,
`nombre_netbios` AS nombre_netbios,
`nombre_tcpip` AS nombre_tcpip
FROM `pance_terminales`;

***/
?>
