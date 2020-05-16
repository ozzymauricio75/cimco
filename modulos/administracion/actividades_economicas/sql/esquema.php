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
$tablas["actividades_economicas"] = array(
	"id"          	 => "SMALLINT(4) UNSIGNED ZEROFILL AUTO_INCREMENT NOT NULL COMMENT 'Consecutivo interno de la base de datos'",
    "codigo_DIAN"    => "SMALLINT(4) UNSIGNED ZEROFILL NOT NULL COMMENT 'Código definido por la DIAN'",
    "codigo_interno" => "SMALLINT(4) UNSIGNED ZEROFILL NOT NULL COMMENT 'Código para uso interno de la empresa'",
    "descripcion"    => "VARCHAR(255) NOT NULL DEFAULT '' COMMENT 'Detalle que describe de la tasa'"
);

/*** Definici�n de llaves primarias ***/
$llavesPrimarias["actividades_economicas"] = "id";

 /*** Definici�n de campos �nicos ***/
$llavesUnicas["actividades_economicas"] = array(
	"codigo_DIAN",
    "codigo_interno",
    "descripcion"
);

/*** Inserci�n de datos iniciales ***/
$registros["componentes"] = array(
    array(
        "id"        => "GESTAECO",
        "padre"     => "SUBMDCAD",
        "id_modulo" => "ADMINISTRACION",
        "orden"     => "0005",
        "visible"   => "1",
        "carpeta"   => "actividades_economicas",
        "archivo"   => "menu"
    ),
    array(
        "id"        => "ADICAECO",
        "padre"     => "GESTAECO",
        "id_modulo" => "ADMINISTRACION",
        "visible"   => "0",
        "orden"     => "0005",
        "carpeta"   => "actividades_economicas",
        "archivo"   => "adicionar"
    ),
    array(
        "id"        => "CONSAECO",
        "padre"     => "GESTAECO",
        "id_modulo" => "ADMINISTRACION",
        "visible"   => "0",
        "orden"     => "0010",
        "carpeta"   => "actividades_economicas",
        "archivo"   => "consultar"
    ),
    array(
        "id"        => "MODIAECO",
        "padre"     => "GESTAECO",
        "id_modulo" => "CONTABILIDAD",
        "visible"   => "0",
        "orden"     => "0015",
        "carpeta"   => "ADMINISTRACION",
        "archivo"   => "modificar"
    ),
    array(
        "id"        => "ELIMAECO",
        "padre"     => "GESTAECO",
        "id_modulo" => "ADMINISTRACION",
        "visible"   => "0",
        "orden"     => "0020",
        "carpeta"   => "actividades_economicas",
        "archivo"   => "eliminar"
    )
);
/*** Sentencia para la creaci�n de la vista requerida ***/
/*** 
CREATE OR REPLACE VIEW pance_menu_actividades_economicas AS 
SELECT id AS id,
codigo_DIAN AS CODIGO_DIAN,
codigo_interno AS CODIGO_INTERNO,
descripcion AS DESCRIPCION
FROM pance_actividades_economicas;
CREATE OR REPLACE VIEW pance_buscador_actividades_economicas AS 
SELECT id AS id, 
codigo_DIAN AS codigo_DIAN,
codigo_interno AS codigo_interno,
descripcion AS descripcion
FROM pance_actividades_economicas;
***/

?>
