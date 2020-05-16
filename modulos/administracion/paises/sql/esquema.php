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
$borrarSiempre   = false;

/*** Definici�n de tablas ***/
$tablas["paises"]   = array(
    "id"             => "SMALLINT(3) UNSIGNED ZEROFILL AUTO_INCREMENT NOT NULL COMMENT 'Consecutivo interno para la base de datos'",
    "codigo_iso"     => "VARCHAR(2) NOT NULL COMMENT 'C�digo ISO'",
    "codigo_interno" => "SMALLINT(3) UNSIGNED ZEROFILL COMMENT 'C�digo para uso interno de la empresa (opcional)'",
    "nombre"         => "VARCHAR(255) NOT NULL DEFAULT '' COMMENT 'Nombre completo'"
);

/*** Definici�n de llaves primarias ***/
$llavesPrimarias["paises"]   = "id";

/*** Definici�n de campos �nicos ***/
$llavesUnicas["paises"]   = array(
    "codigo_iso",
    "codigo_interno"
);

/*** Inserci�n de datos iniciales ***/
$registros["componentes"]   = array(
    array(
        "id"        => "GESTPAIS",
        "padre"     => "SUBMUBIG",
        "id_modulo" => "ADMINISTRACION",
        "orden"     => "0100",
        "carpeta"   => "paises",
        "archivo"   => "menu"
    ),
    array(
        "id"        => "ADICPAIS",
        "padre"     => "GESTPAIS",
        "id_modulo" => "ADMINISTRACION",
        "visible"   => "0",
        "orden"     => "0005",
        "carpeta"   => "paises",
        "archivo"   => "adicionar"
    ),
    array(
        "id"        => "CONSPAIS",
        "padre"     => "GESTPAIS",
        "id_modulo" => "ADMINISTRACION",
        "visible"   => "0",
        "orden"     => "0010",
        "carpeta"   => "paises",
        "archivo"   => "consultar"
    ),
    array(
        "id"        => "MODIPAIS",
        "padre"     => "GESTPAIS",
        "id_modulo" => "ADMINISTRACION",
        "visible"   => "0",
        "orden"     => "0015",
        "carpeta"   => "paises",
        "archivo"   => "modificar"
    ),
    array(
        "id"        => "ELIMPAIS",
        "padre"     => "GESTPAIS",
        "id_modulo" => "ADMINISTRACION",
        "visible"   => "0",
        "orden"     => "0020",
        "carpeta"   => "paises",
        "archivo"   => "eliminar"
    )
);

/*** Sentencias para la creaci�n de las vistas requeridas

    CREATE OR REPLACE VIEW pance_menu_paises AS SELECT id AS id, codigo_iso AS CODIGO_ISO, nombre AS NOMBRE FROM pance_paises;
    CREATE OR REPLACE VIEW pance_buscador_paises AS SELECT id AS id, codigo_iso, codigo_interno, nombre FROM pance_paises;

***/

?>