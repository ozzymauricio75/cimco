<?php

/**
*
* Copyright (C) 2020 Raul Mauricio Oidor Lozano
* Raul Mauricio Oidor Lozano <Raul Mauricio Oidor Lozano>
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
* de APTITUD PARA UN PROPÓITO DETERMINADO. Consulte los detalles de
* la Licencia Pública General GNU para obtener una información más
* detallada.
*
* Debería haber recibido una copia de la Licencia Pública General GNU
* junto a este programa. En caso contrario, consulte:
* <http://www.gnu.org/licenses/>.
*
**/
$borrarSiempre = array();

//  Definición de tablas
$borrarSiempre["tasas"] = false;
$tablas["tasas"] = array(
    "id"                  => "INT(7) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Código para uso interno de la empresa'",
    "descripcion"         => "VARCHAR(255) NOT NULL DEFAULT '' COMMENT 'Detalle que describe de la tasa'",
    "porcentaje"          => "DECIMAL(7,4) NOT NULL DEFAULT '0.0000' COMMENT 'Porcentaje de la tasa'",
    "valor_base"          => "DECIMAL(15,2) NOT NULL DEFAULT '0' COMMENT 'Valor base a partir del cual se aplica el porcentaje anterior'",
    "id_usuario_registra" => "SMALLINT(4) UNSIGNED ZEROFILL NOT NULL DEFAULT '0' COMMENT 'Id del usuario que genera el registro'",
    "fecha_registra"      => "DATETIME NOT NULL COMMENT 'Fecha ingreso al sistema'",
    "fecha_modificacion"  => "TIMESTAMP NOT NULL COMMENT 'Fecha ultima modificación'"
);

//  Definición de llaves primarias
$llavesPrimarias["tasas"] = "id";

 //  Definición de campos únicos
$llavesUnicas["tasas"] = array(
    "descripcion"
);

//  Definición de llaves foranes
$llavesForaneas["tasas"] = array(
    array(
        // Nombre de la llave
        "tasas_usuario_registra",
        // Nombre del campo clave de la tabla local
        "id_usuario_registra",
        // Nombre de la tabla relacionada
        "usuarios",
        // Nombre del campo clave en la tabla relacionada
        "id"
    )
);

//  Inserción de datos iniciales
$registros["tasas"] = array(
    array(
        "id"                  => "0",
        "descripcion"         => "Prueba",
        "porcentaje"          => 0,
        "valor_base"          => 0,
        "id_usuario_registra" => 0,
        "fecha_registra"      => "0000-00-00 00:00:00",
        "fecha_modificacion"  => "0000-00-00 00:00:00"
    )
);

//  Inserción de datos iniciales
$registros["componentes"] = array(
    array(
        "id"              => "GESTTASA",
        "padre"           => "SUBMDCAD",
        "id_modulo"       => "ADMINISTRACION",
        "orden"           => "0005",
        "visible"         => "1",
        "carpeta"         => "tasas",
        "archivo"         => "menu"
    ),
    array(
        "id"              => "ADICTASA",
        "padre"           => "GESTTASA",
        "id_modulo"       => "ADMINISTRACION",
        "visible"         => "0",
        "orden"           => "0005",
        "carpeta"         => "tasas",
        "archivo"         => "adicionar"
    ),
    array(
        "id"              => "CONSTASA",
        "padre"           => "GESTTASA",
        "id_modulo"       => "ADMINISTRACION",
        "visible"         => "0",
        "orden"           => "0010",
        "carpeta"         => "tasas",
        "archivo"         => "consultar"
    ),
    array(
        "id"              => "MODITASA",
        "padre"           => "GESTTASA",
        "id_modulo"       => "ADMINISTRACION",
        "visible"         => "0",
        "orden"           => "0015",
        "carpeta"         => "tasas",
        "archivo"         => "modificar"
    ),
    array(
        "id"              => "ELIMTASA",
        "padre"           => "GESTTASA",
        "id_modulo"       => "ADMINISTRACION",
        "visible"         => "0",
        "orden"           => "0020",
        "carpeta"         => "tasas",
        "archivo"         => "eliminar"
    ),
    array(
        "id"              => "EXPOTASA",
        "padre"           => "GESTTASA",
        "id_modulo"       => "ADMINISTRACION",
        "visible"         => "0",
        "orden"           => "0030",
        "carpeta"         => "tasas",
        "archivo"         => "listar"
    )
);

/*$vistas = array(
    array(
        "CREATE OR REPLACE ALGORITHM = MERGE VIEW pance_menu_tasas AS
        SELECT
            id AS id,
            descripcion AS DESCRIPCION,
            porcentaje AS PORCENTAJE,
            valor_base AS VALOR_BASE
        FROM
            pance_tasas
        WHERE
            id > 0;"
    ),
    array(
        "CREATE OR REPLACE ALGORITHM = MERGE VIEW pance_buscador_tasas AS
        SELECT
            id AS id,
            descripcion AS descripcion,
            porcentaje AS porcentaje
        FROM
            pance_tasas
        WHERE
            id > 0;"
    )
);*/

?>
