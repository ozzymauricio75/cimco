<?php

/**
*
* Copyright (C) 2009 FELINUX Ltda
* Francisco J. Lozano B. <fjlozano@felinux.com.co>
* Margarita Hoyos <margarita@linuxcali.com>
* Mauricio Oidor L. <ozzymauricio75@gmail.com>
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

/*** Eliminar la tabla y crearla de nuevo cada vez que se ejecute el script de creaci�n ***/
$borrarSiempre = false;

/*** Definici�n de tablas ***/
$tablas ["secciones"] = array(
    "id"          => "INT(8) UNSIGNED ZEROFILL AUTO_INCREMENT NOT NULL COMMENT 'C�digo interno en al base de datos'",
    "id_bodega"   => "MEDIUMINT(5) UNSIGNED ZEROFILL NOT NULL COMMENT 'C�digo interno relaciona con la bodega'",
    "codigo"      => "SMALLINT(4) UNSIGNED ZEROFILL NOT NULL COMMENT 'C�digo asignado usuario'",
    "nombre"      => "VARCHAR(60) NOT NULL COMMENT 'Nombre que identifica la seccion'",
    "descripcion" => "VARCHAR(60) NOT NULL COMMENT 'Nombre que describe la seccion'"
);

/*** Definici�n de llaves primarias ***/
$llavesPrimarias["secciones"] = "id";

/***  Definici�n de llaves for�neas ***/
$llavesForaneas["secciones"] = array(
    array(
        /*** Nombre de la llave ***/
        "secciones_bodegas",
        /*** Nombre del campo clave de la tabla local ***/
        "id_bodega",
        /*** Nombre de la tabla relacionada ***/
        "bodegas",
        /*** Nombre del campo clave en la tabla relacionada ***/
        "id"
    )
);

/*** Inserci�n de datos iniciales ***/
$registros["componentes"] = array(
    array(
        "id"        => "GESTSECC",
        "padre"     => "SUBMESTC",
        "id_modulo" => "ADMINISTRACION",
        "visible"   => "1",
        "orden"     => "0020",
        "carpeta"   => "secciones",
        "archivo"   => "menu"
    ),
    array(
        "id"        => "ADICSECC",
        "padre"     => "GESTSECC",
        "id_modulo" => "ADMINISTRACION",
        "visible"   => "0",
        "orden"     => "0005",
        "carpeta"   => "secciones",
        "archivo"   => "adicionar"
    ),
    array(
        "id"        => "CONSSECC",
        "padre"     => "GESTSECC",
        "id_modulo" => "ADMINISTRACION",
        "visible"   => "0",
        "orden"     => "0010",
        "carpeta"   => "secciones",
        "archivo"   => "consultar"
    ),
    array(
        "id"        => "MODISECC",
        "padre"     => "GESTSECC",
        "id_modulo" => "ADMINISTRACION",
        "visible"   => "0",
        "orden"     => "0015",
        "carpeta"   => "secciones",
        "archivo"   => "modificar"
    ),
    array(
        "id"        => "ELIMSECC",
        "padre"     => "GESTSECC",
        "id_modulo" => "ADMINISTRACION",
        "visible"   => "0",
        "orden"     => "0020",
        "carpeta"   => "secciones",
        "archivo"   => "eliminar"
    )
);

/*** Sentencia para la creaci�n de la vista requerida ***/
/*** CREATE OR REPLACE VIEW pance_menu_secciones AS
     SELECT pance_secciones.id AS id, pance_secciones.codigo AS CODIGO,
     pance_secciones.nombre AS NOMBRE,
     pance_secciones.descripcion AS DESCRIPCION,
     pance_bodegas.nombre AS BODEGA
     FROM pance_secciones, pance_bodegas
     WHERE pance_secciones.id_bodega = pance_bodegas.id;

     CREATE OR REPLACE VIEW pance_buscador_secciones AS SELECT pance_secciones.id AS id,
     pance_secciones.nombre AS nombre, pance_secciones.descripcion AS descripcion, pance_secciones.id_bodega AS codigo_bodega,
     pance_secciones.codigo AS codigo, pance_bodegas.nombre AS bodega
     FROM pance_secciones, pance_bodegas
     WHERE pance_secciones.id_bodega = pance_bodegas.id;

***/
?>
