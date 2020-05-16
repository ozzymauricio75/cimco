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
$borrarSiempre   = false;

/*** Definición de tablas ***/
$tablas["paises"]   = array(
    "id"             => "SMALLINT(3) UNSIGNED ZEROFILL AUTO_INCREMENT NOT NULL COMMENT 'Consecutivo interno para la base de datos'",
    "codigo_iso"     => "VARCHAR(2) NOT NULL COMMENT 'Código ISO'",
    "codigo_interno" => "SMALLINT(3) UNSIGNED ZEROFILL COMMENT 'Código para uso interno de la empresa (opcional)'",
    "nombre"         => "VARCHAR(255) NOT NULL DEFAULT '' COMMENT 'Nombre completo'"
);

/*** Definición de llaves primarias ***/
$llavesPrimarias["paises"]   = "id";

/*** Definición de campos únicos ***/
$llavesUnicas["paises"]   = array(
    "codigo_iso",
    "codigo_interno"
);

/*** Inserción de datos iniciales ***/
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

/*** Sentencias para la creación de las vistas requeridas

    CREATE OR REPLACE VIEW pance_menu_paises AS SELECT id AS id, codigo_iso AS CODIGO_ISO, nombre AS NOMBRE FROM pance_paises;
    CREATE OR REPLACE VIEW pance_buscador_paises AS SELECT id AS id, codigo_iso, codigo_interno, nombre FROM pance_paises;

***/

?>