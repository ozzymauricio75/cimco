<?php

/**
*
* Copyright (C) 2008 LinuxCali Ltda
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
* de APTITUD PARA UN PROPOSITO DESERVINADO. Consulte los detalles de
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
$tablas["servidores"] = array(
    "id"             => "SMALLINT(3) UNSIGNED ZEROFILL AUTO_INCREMENT NOT NULL COMMENT 'Consecutivo interno de la base de datos'",
    "ip"	     => "VARCHAR(15) NOT NULL COMMENT 'Drirecci�n IP de la servidor'",
    "nombre_netbios" => "VARCHAR(50) NOT NULL COMMENT 'Nombre NetBIOS'",
    "nombre_tcpip"   => "VARCHAR(50) NOT NULL COMMENT 'NONBRE TCPIP'",
    "descripcion"    => "VARCHAR(50) NULL COMMENT 'Descripci�n de la servidor'"
);


/*** Definici�n de llaves primarias ***/
$llavesPrimarias["servidores"]   = "id";

/*** Inserci�n de datos iniciales ***/
$registros["componentes"] = array(
    array(
        "id"        => "GESTSRVD",
        "padre"     => "SUBMDISP",
        "id_modulo" => "ADMINISTRACION",
        "orden"     => "0003",
        "visible"   => "1",
        "carpeta"   => "servidores",
        "archivo"   => "menu"
    ),
    array(
        "id"        => "ADICSRVD",
        "padre"     => "GESTSRVD",
        "id_modulo" => "ADMINISTRACION",
        "visible"   => "0",
        "orden"     => "0005",
        "carpeta"   => "servidores",
        "archivo"   => "adicionar"
    ),
    array(
        "id"        => "CONSSRVD",
        "padre"     => "GESTSRVD",
        "id_modulo" => "ADMINISTRACION",
        "visible"   => "0",
        "orden"     => "0010",
        "carpeta"   => "servidores",
        "archivo"   => "consultar"
    ),
    array(
        "id"        => "MODISRVD",
        "padre"     => "GESTSRVD",
        "id_modulo" => "ADMINISTRACION",
        "visible"   => "0",
        "orden"     => "0015",
        "carpeta"   => "servidores",
        "archivo"   => "modificar"
    ),
    array(
        "id"        => "ELIMSRVD",
        "padre"     => "GESTSRVD",
        "id_modulo" => "ADMINISTRACION",
        "visible"   => "0",
        "orden"     => "0020",
        "carpeta"   => "servidores",
        "archivo"   => "eliminar"
    )
);

/*** Sentencia para la creaci�n de la vista requerida ***/
/***

CREATE OR REPLACE VIEW `pance_menu_servidores` AS
SELECT `id` AS id,
`ip` AS IP,
`nombre_netbios` AS NOMBRE_NETBIOS,
`nombre_tcpip` AS NOMBRE_TCPIP
FROM `pance_servidores`;

CREATE OR REPLACE VIEW `pance_buscador_servidores` AS
SELECT `id` AS id,
`ip` AS ip,
`nombre_netbios` AS nombre_netbios,
`nombre_tcpip` AS nombre_tcpip
FROM `pance_servidores`;

***/
?>
