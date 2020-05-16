<?php

/**
*
* Copyright (C) 2009 FELINUX Ltda
* Francisco J. Lozano B. <fjlozano@felinux.com.co>
* Margarita Hoyos <margarita@linuxcali.com>
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

/*** Eliminar la tabla y crearla de nuevo cada vez que se ejecute el script de creación ***/
$borrarSiempre   = false;

/*** Definición de tablas ***/
$tablas["municipios"]   = array(
    "id"              => "INT(8) UNSIGNED ZEROFILL AUTO_INCREMENT NOT NULL COMMENT 'Consecutivo interno para la base de datos'",
    "id_departamento" => "INT(5) UNSIGNED ZEROFILL NOT NULL COMMENT 'Consecutivo interno para la base de datos para del país al cual pertenece'",
    "codigo_dane"     => "VARCHAR(3) COMMENT 'Código DANE'",
    "codigo_interno"  => "INT(4) UNSIGNED ZEROFILL COMMENT 'Código para uso interno de la empresa (opcional)'",
    "nombre"          => "VARCHAR(255) NOT NULL DEFAULT '' COMMENT 'Nombre completo'",
    "capital"         => "ENUM('0','1') DEFAULT '0' COMMENT 'El municipio es la capital del departamento: 0=No, 1=Si'",
    "comunas"         => "TINYINT(3) NOT NULL DEFAULT '0' COMMENT 'Número de comunas en las cuales se divide el municipio'"
);

/*** Definición de llaves primarias ***/
$llavesPrimarias["municipios"]   = "id";

 /*** Definición de campos únicos ***/
$llavesUnicas["municipios"]   =  array(
    "id_departamento, codigo_dane",
    "codigo_interno"
);

/*** Definición de llaves foráneas ***/
$llavesForaneas["municipios"]   = array(
    array(
        /*** Nombre de la llave ***/
        "municipio_departamento",
        /*** Nombre del campo clave de la tabla local ***/
        "id_departamento",
        /*** Nombre de la tabla relacionada ***/
        "departamentos",
        /*** Nombre del campo clave en la tabla relacionada ***/
        "id"
    )
);

/*** Inserción de datos iniciales ***/
$registros["componentes"]   = array(
    array(
        "id"        => "GESTMUNI",
        "padre"     => "SUBMUBIG",
        "id_modulo" => "ADMINISTRACION",
        "visible"   => "1",
        "orden"     => "0300",
        "carpeta"   => "municipios",
        "archivo"   => "menu"
    ),
    array(
        "id"        => "ADICMUNI",
        "padre"     => "GESTMUNI",
        "id_modulo" => "ADMINISTRACION",
        "visible"   => "0",
        "orden"     => "0005",
        "carpeta"   => "municipios",
        "archivo"   => "adicionar"
    ),
    array(
        "id"        => "CONSMUNI",
        "padre"     => "GESTMUNI",
        "id_modulo" => "ADMINISTRACION",
        "visible"   => "0",
        "orden"     => "0010",
        "carpeta"   => "municipios",
        "archivo"   => "consultar"
    ),
    array(
        "id"        => "MODIMUNI",
        "padre"     => "GESTMUNI",
        "id_modulo" => "ADMINISTRACION",
        "visible"   => "0",
        "orden"     => "0015",
        "carpeta"   => "municipios",
        "archivo"   => "modificar"
    ),
    array(
        "id"        => "ELIMMUNI",
        "padre"     => "GESTMUNI",
        "id_modulo" => "ADMINISTRACION",
        "visible"   => "0",
        "orden"     => "0020",
        "carpeta"   => "municipios",
        "archivo"   => "eliminar"
    )
);

/*** Sentencia para la creación de la vista requerida

    CREATE OR REPLACE VIEW pance_menu_municipios AS
    SELECT pance_municipios.id AS id,
    CONCAT(pance_departamentos.codigo_dane, pance_municipios.codigo_dane) AS CODIGO_DANE,
    pance_municipios.nombre AS NOMBRE, pance_departamentos.nombre AS DEPARTAMENTO, pance_paises.nombre AS PAIS
    FROM pance_municipios, pance_departamentos, pance_paises
    WHERE pance_municipios.id_departamento = pance_departamentos.id AND pance_departamentos.id_pais = pance_paises.id
    ORDER BY NOMBRE ASC;

    CREATE OR REPLACE VIEW pance_buscador_municipios AS
    SELECT pance_municipios.id AS id,
    CONCAT(pance_departamentos.codigo_dane, pance_municipios.codigo_dane) AS codigo_dane, pance_municipios.codigo_interno AS codigo_interno,
    pance_municipios.nombre AS nombre, pance_departamentos.nombre AS departamento, pance_paises.nombre AS pais
    FROM pance_municipios, pance_departamentos, pance_paises
    WHERE pance_municipios.id_departamento = pance_departamentos.id AND pance_departamentos.id_pais = pance_paises.id
    ORDER BY nombre ASC;

    CREATE OR REPLACE VIEW pance_seleccion_municipios AS
    SELECT pance_municipios.id AS id,
    CONCAT(pance_municipios.nombre, ', ', pance_departamentos.nombre, ', ',pance_paises.nombre, '|', pance_municipios.id) AS nombre
    FROM pance_municipios, pance_departamentos, pance_paises
    WHERE pance_municipios.id_departamento = pance_departamentos.id AND pance_departamentos.id_pais = pance_paises.id
    ORDER BY pance_municipios.nombre ASC;

***/

?>