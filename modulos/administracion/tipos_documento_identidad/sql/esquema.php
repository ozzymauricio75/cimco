<?php

/**
*
* Copyright (C) 2008 LinuxCali Ltda
* Francisco J. Lozano B. <pacho@linuxcali.com>
* Margarita Hoyos <margarita@linuxcali.com>
*
* Este archivo es parte de:
* PANCE :: Plataforma para la Administraciï¿½n del Nexo Cliente-Empresa
*
* Este programa es software libre: usted puede redistribuirlo y/o
* modificarlo  bajo los tï¿½rminos de la Licencia Pï¿½blica General GNU
* publicada por la Fundaciï¿½n para el Software Libre, ya sea la versiï¿½n 3
* de la Licencia, o (a su elecciï¿½n) cualquier versiï¿½n posterior.
*
* Este programa se distribuye con la esperanza de que sea ï¿½til, pero
* SIN GARANTï¿½A ALGUNA; ni siquiera la garantï¿½a implï¿½cita MERCANTIL o
* de APTITUD PARA UN PROPï¿½SITO DETERMINADO. Consulte los detalles de
* la Licencia Pï¿½blica General GNU para obtener una informaciï¿½n mï¿½s
* detallada.
*
* Deberï¿½a haber recibido una copia de la Licencia Pï¿½blica General GNU
* junto a este programa. En caso contrario, consulte:
* <http://www.gnu.org/licenses/>.
*
**/
$borrarSiempre   = false;

/*** DefiniciÃ³n de tablas ***/
$tablas["tipos_documento_identidad"] = array(
    "id"             => "SMALLINT(3) UNSIGNED ZEROFILL AUTO_INCREMENT NOT NULL COMMENT 'Consecutivo interno de la base de datos'",
    "codigo_DIAN"    => "SMALLINT(3) UNSIGNED ZEROFILL NOT NULL COMMENT 'Código manejo por la DIAN'",
    "codigo_interno" => "SMALLINT(3) UNSIGNED ZEROFILL NOT NULL COMMENT 'Código asignado por el usuario'",
    "descripcion"    => "VARCHAR(255) NOT NULL COMMENT 'Detalle que identifica el tipo de documento de identidad'"
);

/*** Definiciï¿½n de llaves primarias ***/
$llavesPrimarias["tipos_documento_identidad"] = "id";

 /*** Definiciï¿½n de campos ï¿½nicos ***/
$llavesUnicas["tipos_documento_identidad"] = array(
    "codigo_DIAN",
    "codigo_interno",
    "descripcion"
);

/*** Inserción de datos iniciales ***/
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
/*** Sentencia para la creaciÓn de la vista requerida ***/
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
