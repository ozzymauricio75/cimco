<?php

/**
*
* Copyright (C) 2009 FELINUX Ltda
* Francisco J. Lozano B. <fjlozano@felinux.com.co>
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
$tablas["departamentos"] = array(
    "id"             => "INT(5) UNSIGNED ZEROFILL AUTO_INCREMENT NOT NULL COMMENT 'Consecutivo interno para la base de datos'",
    "id_pais"        => "SMALLINT(3) UNSIGNED ZEROFILL NOT NULL COMMENT 'Consecutivo interno para la base de datos del pa�s al cual pertenece'",
    "codigo_dane"    => "VARCHAR(2) COMMENT 'C�digo DANE'",
    "codigo_interno" => "SMALLINT(3) UNSIGNED ZEROFILL COMMENT 'C�digo para uso interno de la empresa (opcional)'",
    "nombre"         => "VARCHAR(255) NOT NULL DEFAULT '' COMMENT 'Nombre completo'"
);

/*** Definici�n de llaves primarias ***/
$llavesPrimarias["departamentos"] = "id";

/*** Definici�n de campos �nicos ***/
$llavesUnicas["departamentos"] = array(
    "codigo_dane",
    "codigo_interno"
);

/*** Definici�n de llaves for�neas ***/
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

/*** Inserci�n de datos iniciales ***/
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

/*** Sentencia para la creaci�n de la vista requerida

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