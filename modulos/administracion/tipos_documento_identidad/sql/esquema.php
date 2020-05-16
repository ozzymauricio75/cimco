<?php

/**
*
* Copyright (C) 2008 LinuxCali Ltda
* Francisco J. Lozano B. <pacho@linuxcali.com>
* Margarita Hoyos <margarita@linuxcali.com>
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
* SIN GARANT�A ALGUNA; ni siquiera la garant�a impl�cita MERCANTIL o
* de APTITUD PARA UN PROP�SITO DETERMINADO. Consulte los detalles de
* la Licencia P�blica General GNU para obtener una informaci�n m�s
* detallada.
*
* Deber�a haber recibido una copia de la Licencia P�blica General GNU
* junto a este programa. En caso contrario, consulte:
* <http://www.gnu.org/licenses/>.
*
**/
$borrarSiempre   = false;

/*** Definición de tablas ***/
$tablas["tipos_documento_identidad"] = array(
    "id"             => "SMALLINT(3) UNSIGNED ZEROFILL AUTO_INCREMENT NOT NULL COMMENT 'Consecutivo interno de la base de datos'",
    "codigo_DIAN"    => "SMALLINT(3) UNSIGNED ZEROFILL NOT NULL COMMENT 'C�digo manejo por la DIAN'",
    "codigo_interno" => "SMALLINT(3) UNSIGNED ZEROFILL NOT NULL COMMENT 'C�digo asignado por el usuario'",
    "descripcion"    => "VARCHAR(255) NOT NULL COMMENT 'Detalle que identifica el tipo de documento de identidad'"
);

/*** Definici�n de llaves primarias ***/
$llavesPrimarias["tipos_documento_identidad"] = "id";

 /*** Definici�n de campos �nicos ***/
$llavesUnicas["tipos_documento_identidad"] = array(
    "codigo_DIAN",
    "codigo_interno",
    "descripcion"
);

/*** Inserci�n de datos iniciales ***/
$registros["componentes"] = array(
    array(
        "id"        => "GESTTIDI",
        "padre"     => "SUBMDCAD",
        "id_modulo" => "ADMINISTRACION",
        "orden"     => "0070",
        "visible"   => "1",
        "carpeta"   => "tipos_documento_identidad",
        "archivo"   => "menu"
    ),
    array(
        "id"        => "ADICTIDI",
        "padre"     => "GESTTIDI",
        "id_modulo" => "ADMINISTRACION",
        "visible"   => "0",
        "orden"     => "0005",
        "carpeta"   => "tipos_documento_identidad",
        "archivo"   => "adicionar"
    ),
    array(
        "id"        => "CONSTIDI",
        "padre"     => "GESTTIDI",
        "id_modulo" => "ADMINISTRACION",
        "visible"   => "0",
        "orden"     => "0010",
        "carpeta"   => "tipos_documento_identidad",
        "archivo"   => "consultar"
    ),
    array(
        "id"        => "MODITIDI",
        "padre"     => "GESTTIDI",
        "id_modulo" => "ADMINISTRACION",
        "visible"   => "0",
        "orden"     => "0015",
        "carpeta"   => "tipos_documento_identidad",
        "archivo"   => "modificar"
    ),
    array(
        "id"        => "ELIMTIDI",
        "padre"     => "GESTTIDI",
        "id_modulo" => "ADMINISTRACION",
        "visible"   => "0",
        "orden"     => "0020",
        "carpeta"   => "tipos_documento_identidad",
        "archivo"   => "eliminar"
    )
);
/*** Sentencia para la creaci�n de la vista requerida ***/
/***
CREATE OR REPLACE VIEW pance_menu_tipos_documento_identidad AS
SELECT id AS id,
codigo_DIAN AS CODIGO_DIAN,
codigo_interno AS CODIGO_INTERNO,
descripcion AS DESCRIPCION
FROM pance_tipos_documento_identidad;

CREATE OR REPLACE VIEW pance_buscador_tipos_documento_identidad AS
SELECT id AS id,
codigo_DIAN AS codigo_DIAN,
codigo_interno AS codigo_interno,
descripcion AS descripcion
FROM pance_tipos_documento_identidad;
***/
?>
