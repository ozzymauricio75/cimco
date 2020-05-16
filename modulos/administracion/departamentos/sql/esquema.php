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

/*** Eliminar la tabla y crearla de nuevo cada vez que se ejecute el script de creación ***/
$borrarSiempre = false;

/*** Definición de tablas ***/
$tablas["departamentos"] = array(
    "id"             => "INT(5) UNSIGNED ZEROFILL AUTO_INCREMENT NOT NULL COMMENT 'Consecutivo interno para la base de datos'",
    "id_pais"        => "SMALLINT(3) UNSIGNED ZEROFILL NOT NULL COMMENT 'Consecutivo interno para la base de datos del país al cual pertenece'",
    "codigo_dane"    => "VARCHAR(2) COMMENT 'Código DANE'",
    "codigo_interno" => "SMALLINT(3) UNSIGNED ZEROFILL COMMENT 'Código para uso interno de la empresa (opcional)'",
    "nombre"         => "VARCHAR(255) NOT NULL DEFAULT '' COMMENT 'Nombre completo'"
);

/*** Definición de llaves primarias ***/
$llavesPrimarias["departamentos"] = "id";

/*** Definición de campos únicos ***/
$llavesUnicas["departamentos"] = array(
    "codigo_dane",
    "codigo_interno"
);

/*** Definición de llaves foráneas ***/
$llavesForaneas["departamentos"] = array(
    array(
        /*** Nombre de la llave ***/
        "departamento_pais",
        /*** Nombre del campo clave de la tabla local ***/
        "id_pais",
        /*** Nombre de la tabla relacionada ***/
        "paises",
        /*** Nombre del campo clave en la tabla relacionada ***/
        "id"
    )
);

/*** Inserción de datos iniciales ***/
$registros["componentes"] = array(
    array(
        "id"        => "GESTDEPA",
        "padre"     => "SUBMUBIG",
        "id_modulo" => "ADMINISTRACION",
        "orden"     => "0200",
        "carpeta"   => "departamentos",
        "archivo"   => "menu"
    ),
    array(
        "id"        => "ADICDEPA",
        "padre"     => "GESTDEPA",
        "id_modulo" => "ADMINISTRACION",
        "visible"   => "0",
        "orden"     => "0005",
        "carpeta"   => "departamentos",
        "archivo"   => "adicionar"
    ),
    array(
        "id"        => "CONSDEPA",
        "padre"     => "GESTDEPA",
        "id_modulo" => "ADMINISTRACION",
        "visible"   => "0",
        "orden"     => "0010",
        "carpeta"   => "departamentos",
        "archivo"   => "consultar"
    ),
    array(
        "id"        => "MODIDEPA",
        "padre"     => "GESTDEPA",
        "id_modulo" => "ADMINISTRACION",
        "visible"   => "0",
        "orden"     => "0015",
        "carpeta"   => "departamentos",
        "archivo"   => "modificar"
    ),
    array(
        "id"        => "ELIMDEPA",
        "padre"     => "GESTDEPA",
        "id_modulo" => "ADMINISTRACION",
        "visible"   => "0",
        "orden"     => "0020",
        "carpeta"   => "departamentos",
        "archivo"   => "eliminar"
    )
);

/*** Sentencia para la creación de la vista requerida

    CREATE OR REPLACE VIEW pance_menu_departamentos AS
    SELECT pance_departamentos.id AS id,
    pance_departamentos.codigo_dane AS CODIGO_DANE, pance_departamentos.nombre AS NOMBRE, pance_paises.nombre AS PAIS
    FROM pance_departamentos, pance_paises
    WHERE pance_departamentos.id_pais = pance_paises.id;

    CREATE OR REPLACE VIEW pance_buscador_departamentos AS
    SELECT pance_departamentos.id AS id,
    pance_departamentos.codigo_dane AS codigo_dane, pance_departamentos.codigo_interno AS codigo_interno,
    pance_departamentos.nombre AS nombre, pance_paises.nombre AS pais
    FROM pance_departamentos, pance_paises
    WHERE pance_departamentos.id_pais = pance_paises.id;

***/

?>