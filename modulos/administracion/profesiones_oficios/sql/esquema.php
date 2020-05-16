<?php

/**
*
* Copyright (C) 2008 LinuxCali Ltda
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
* SIN GARANÍA ALGUNA; ni siquiera la garantía implícita MERCANTIL o
* de APTITUD PARA UN PROPOSITO DETERMINADO. Consulte los detalles de
* la Licencia Pública General GNU para obtener una información más
* detallada.
*
* Debería haber recibido una copia de la Licencia Pública General GNU
* junto a este programa. En caso contrario, consulte:
* <http://www.gnu.org/licenses/>.
*
**/
$borrarSiempre   = false;

/*** Definición de tablas ***/
$tablas["profesiones_oficios"] = array(
    "id"             => "SMALLINT(4) UNSIGNED ZEROFILL AUTO_INCREMENT NOT NULL COMMENT 'Consecutivo interno de la base de datos'",
    "codigo_DANE"    => "SMALLINT(4) UNSIGNED ZEROFILL NOT NULL COMMENT 'Código universal que identifica una profesión u oficio aprobado por el DANE '",
    "codigo_interno" => "SMALLINT(4) UNSIGNED ZEROFILL NOT NULL COMMENT 'Código interno asignado por el usuario '",
    "descripcion"    => "VARCHAR(255) NOT NULL COMMENT 'Detalle que identifica la profesión u oficio'"
);


/*** Definición de llaves primarias ***/
$llavesPrimarias["profesiones_oficios"]   = "id";

/*** Definición de las llaves unicas ***/
$llavesUnicas["profesiones_oficios"] = array(
    "codigo_DANE",
    "codigo_interno",
    "descripcion"
);

/*** Inserción de datos iniciales ***/
$registros["componentes"] = array(
    array(
        "id"        => "GESTPROF",
        "padre"     => "SUBMDCAD",
        "id_modulo" => "ADMINISTRACION",
        "orden"     => "0010",
        "visible"   => "1",
        "carpeta"   => "profesiones_oficios",
        "archivo"   => "menu"
    ),
    array(
        "id"        => "ADICPROF",
        "padre"     => "GESTPROF",
        "id_modulo" => "ADMINISTRACION",
        "visible"   => "0",
        "orden"     => "0005",
        "carpeta"   => "profesiones_oficios",
        "archivo"   => "adicionar"
    ),
    array(
        "id"        => "CONSPROF",
        "padre"     => "GESTPROF",
        "id_modulo" => "ADMINISTRACION",
        "visible"   => "0",
        "orden"     => "0010",
        "carpeta"   => "profesiones_oficios",
        "archivo"   => "consultar"
    ),
    array(
        "id"        => "MODIPROF",
        "padre"     => "GESTPROF",
        "id_modulo" => "ADMINISTRACION",
        "visible"   => "0",
        "orden"     => "0015",
        "carpeta"   => "profesiones_oficios",
        "archivo"   => "modificar"
    ),
    array(
        "id"        => "ELIMPROF",
        "padre"     => "GESTPROF",
        "id_modulo" => "ADMINISTRACION",
        "visible"   => "0",
        "orden"     => "0020",
        "carpeta"   => "profesiones_oficios",
        "archivo"   => "eliminar"
    )
);

/*** Sentencia para la creación de la vista requerida ***/
/*** 
CREATE OR REPLACE VIEW pance_menu_profesiones_oficios AS
SELECT id AS id,
codigo_DANE AS CODIGO_DANE,
codigo_interno AS CODIGO_INTERNO,
descripcion AS DESCRIPCION
FROM pance_profesiones_oficios;

CREATE OR REPLACE VIEW pance_buscador_profesiones_oficios AS
SELECT id AS id,
descripcion AS descripcion
FROM pance_profesiones_oficios;

***/
?>
