<?php

/**
*
* Copyright (C) 2009 FELINUX Ltda
* Francisco J. Lozano B. <fjlozano@felinux.com.co>
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

/*** Eliminar la tabla y crearla de nuevo cada vez que se ejecute el script de creaci�n ***/
$borrarSiempre   = false;

/*** Definici�n de tablas ***/
$tablas["localidades"]   = array(
    "id"               => "INT(8) UNSIGNED ZEROFILL AUTO_INCREMENT NOT NULL COMMENT 'Consecutivo interno para la base de datos'",
    "id_municipio"     => "INT(8) UNSIGNED ZEROFILL NOT NULL COMMENT 'Consecutivo interno para la base de datos para del municipio al cual pertenece'",
    "tipo"             => "ENUM('B','C') DEFAULT 'B' COMMENT 'Tipo de localidad: B=Barrio, C=Corregimiento'",
    "codigo_municipal" => "SMALLINT(3) UNSIGNED ZEROFILL COMMENT 'C�digo oficial asignado por el municipio (s�lo para barrios)'",
    "codigo_dane"      => "VARCHAR(3) COMMENT 'C�digo DANE (s�lo para corregimientos)'",
    "codigo_interno"   => "INT(8) UNSIGNED ZEROFILL COMMENT 'C�digo para uso interno de la empresa (opcional)'",
    "nombre"           => "VARCHAR(255) NOT NULL DEFAULT '' COMMENT 'Nombre completo'",
    "comuna"           => "TINYINT(2) NOT NULL DEFAULT '0' COMMENT 'Comuna a la que pertenece (s�lo para barrios)'",
    "estrato"          => "TINYINT(1) NOT NULL DEFAULT '0' COMMENT 'Estrato al que pertenece (s�lo para barrios)'"
);

/*** Definici�n de llaves primarias ***/
$llavesPrimarias["localidades"]   = "id";

/*** Definici�n de llaves for�neas ***/
$llavesForaneas["localidades"]   = array(
    array(
        /*** Nombre de la llave ***/
        "localidad_municipio",
        /*** Nombre del campo clave de la tabla local ***/
        "id_municipio",
        /*** Nombre de la tabla relacionada ***/
        "municipios",
        /*** Nombre del campo clave en la tabla relacionada ***/
        "id"
    )
);

/*** Inserci�n de datos iniciales ***/
$registros["componentes"]   = array(
    array(
        "id"        => "GESTBARR",
        "padre"     => "SUBMUBIG",
        "id_modulo" => "ADMINISTRACION",
        "visible"   => "1",
        "orden"     => "0500",
        "carpeta"   => "barrios",
        "archivo"   => "menu"
    ),
    array(
        "id"        => "ADICBARR",
        "padre"     => "GESTBARR",
        "id_modulo" => "ADMINISTRACION",
        "visible"   => "0",
        "orden"     => "0005",
        "carpeta"   => "barrios",
        "archivo"   => "adicionar"
    ),
    array(
        "id"        => "CONSBARR",
        "padre"     => "GESTBARR",
        "id_modulo" => "ADMINISTRACION",
        "visible"   => "0",
        "orden"     => "0010",
        "carpeta"   => "barrios",
        "archivo"   => "consultar"
    ),
    array(
        "id"        => "MODIBARR",
        "padre"     => "GESTBARR",
        "id_modulo" => "ADMINISTRACION",
        "visible"   => "0",
        "orden"     => "0015",
        "carpeta"   => "barrios",
        "archivo"   => "modificar"
    ),
    array(
        "id"        => "ELIMBARR",
        "padre"     => "GESTBARR",
        "id_modulo" => "ADMINISTRACION",
        "visible"   => "0",
        "orden"     => "0020",
        "carpeta"   => "barrios",
        "archivo"   => "eliminar"
    )
);

/*** Sentencia para la creaci�n de la vista requerida

    CREATE OR REPLACE VIEW pance_menu_barrios AS
    SELECT pance_localidades.id AS id,
    pance_localidades.nombre AS NOMBRE, pance_municipios.nombre AS MUNICIPIO,  pance_departamentos.nombre AS DEPARTAMENTO, pance_paises.nombre AS PAIS
    FROM pance_localidades, pance_municipios, pance_departamentos, pance_paises
    WHERE pance_localidades.id_municipio = pance_municipios.id AND  pance_municipios.id_departamento = pance_departamentos.id AND
    pance_departamentos.id_pais = pance_paises.id AND pance_localidades.tipo = 'B';

    CREATE OR REPLACE VIEW pance_buscador_barrios AS
    SELECT pance_localidades.id AS id,
    pance_localidades.codigo_municipal AS codigo_municipal, pance_localidades.nombre AS nombre, pance_localidades.codigo_interno AS codigo_interno,
    pance_localidades.comuna AS comuna, pance_localidades.estrato AS estrato, pance_municipios.nombre AS municipio,
    pance_departamentos.nombre AS departamento, pance_paises.nombre AS pais
    FROM pance_localidades, pance_municipios, pance_departamentos, pance_paises
    WHERE pance_localidades.id_municipio = pance_municipios.id AND  pance_municipios.id_departamento = pance_departamentos.id AND
    pance_departamentos.id_pais = pance_paises.id AND pance_localidades.tipo = 'B';

CREATE OR REPLACE VIEW pance_seleccion_localidades AS
    SELECT pance_localidades.id AS id,
    CONCAT(pance_localidades.nombre, ', ', pance_municipios.nombre, ', ', pance_departamentos.nombre, ', ',pance_paises.nombre, '|', pance_localidades.id) AS nombre
    FROM pance_localidades, pance_municipios, pance_departamentos, pance_paises
    WHERE pance_localidades.id_municipio = pance_municipios.id AND pance_municipios.id_departamento = pance_departamentos.id AND pance_departamentos.id_pais = pance_paises.id
    ORDER BY pance_municipios.nombre ASC;

***/

?>
