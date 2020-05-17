<?php

/**
*
* Copyright (C) 2020 Raul Mauricio Oidor Lozano
* Raul Mauricio Oidor Lozano <ozzymauricio75@gmail.com>
*
* Este archivo es parte de:
* SEM :: Software empresarial a la medida
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
$borrarSiempre = array();

$borrarSiempre["compradores"] = false;
$tablas["compradores"] = array(
    "id"                         => "INT(9) UNSIGNED ZEROFILL AUTO_INCREMENT NOT NULL COMMENT 'Llave principal'",
    "id_tercero"                 => "INT(8) UNSIGNED ZEROFILL NOT NULL COMMENT 'Id de la tabla terceros'",
    "activo"                     => "ENUM('0','1') NOT NULL DEFAULT '1' COMMENT 'El comprador está activo 0=No, 1=Si'",
    "id_usuario_registra"        => "SMALLINT(4) UNSIGNED ZEROFILL NOT NULL DEFAULT '0' COMMENT 'Id del usuario que genera el registro'",
    "fecha_registra"             => "DATETIME NOT NULL DEFAULT '0000-00-00' COMMENT 'Fecha ingreso al sistema'",
    "fecha_modificacion"         => "TIMESTAMP NOT NULL DEFAULT '0000-00-00' COMMENT 'Fecha ultima modificación'"
);

$llavesPrimarias["compradores"] = "id";

$llavesForaneas["compradores"] = array(
    array(
        // Nombre de la llave
        "compradores_id_tercero",
        // Nombre del campo clave de la tabla local
        "id_tercero",
        // Nombre de la tabla relacionada
        "terceros",
        // Nombre del campo clave en la tabla relacionada
        "id"
    ),
    array(
        // Nombre de la llave
        "compradores_usuario_registra",
        // Nombre del campo clave de la tabla local
        "id_usuario_registra",
        // Nombre de la tabla relacionada
        "usuarios",
        // Nombre del campo clave en la tabla relacionada
        "id"
    ),
    array(
        // Nombre de la llave
        "compradores_tercero",
        // Nombre del campo clave de la tabla local
        "id_tercero",
        // Nombre de la tabla relacionada
        "terceros",
        // Nombre del campo clave en la tabla relacionada
        "id"
    )
);

//  Inserción de datos iniciales
$registros["componentes"] = array(
    array(
        "id"              => "GESTCMPR",
        "padre"           => "MENUPROV",
        "id_modulo"       => "INVENTARIO",
        "orden"           => "8000",
        "visible"         => "1",
        "carpeta"         => "compradores",
        "archivo"         => "menu"
    ),
    array(
        "id"              => "ADICCMPR",
        "padre"           => "GESTCMPR",
        "id_modulo"       => "INVENTARIO",
        "visible"         => "0",
        "orden"           => "0005",
        "carpeta"         => "compradores",
        "archivo"         => "adicionar"
    ),
    array(
        "id"              => "CONSCMPR",
        "padre"           => "GESTCMPR",
        "id_modulo"       => "INVENTARIO",
        "visible"         => "0",
        "orden"           => "0010",
        "carpeta"         => "compradores",
        "archivo"         => "consultar"
    ),
    array(
        "id"              => "MODICMPR",
        "padre"           => "GESTCMPR",
        "id_modulo"       => "INVENTARIO",
        "visible"         => "0",
        "orden"           => "0015",
        "carpeta"         => "compradores",
        "archivo"         => "modificar"
    ),
    array(
        "id"              => "ELIMCMPR",
        "padre"           => "GESTCMPR",
        "id_modulo"       => "INVENTARIO",
        "visible"         => "0",
        "orden"           => "0020",
        "carpeta"         => "compradores",
        "archivo"         => "eliminar"
    ),
    array(
        "id"              => "LISTCMPR",
        "padre"           => "GESTCMPR",
        "id_modulo"       => "INVENTARIO",
        "visible"         => "0",
        "orden"           => "0025",
        "carpeta"         => "compradores"
    )
);

$vistas = array(
    array(
        "CREATE OR REPLACE ALGORITHM = MERGE VIEW pance_menu_compradores AS
        SELECT
            pance_compradores.id AS id,
            pance_compradores.activo AS id_activo,
            pance_terceros.documento_identidad AS DOCUMENTO_IDENTIDAD,
            pance_terceros.primer_nombre AS PRIMER_NOMBRE,
            pance_terceros.segundo_nombre AS SEGUNDO_NOMBRE,
            pance_terceros.primer_apellido AS PRIMER_APELLIDO,
            pance_terceros.segundo_apellido AS SEGUNDO_APELLIDO,
            CONCAT(pance_terceros.documento_identidad,' ',(
                IF(pance_terceros.primer_nombre = ' ',
                    CONCAT(pance_terceros.segundo_nombre,' ',pance_terceros.segundo_nombre,' ',pance_terceros.primer_apellido,' ',pance_terceros.segundo_apellido),
                        pance_terceros.razon_social
                    )
                )
            )AS NOMBRE_COMPLETO,
            IF (pance_compradores.activo = '1',
                'Activo',
                'Inactivo'
            ) AS ACTIVO
        FROM
            pance_terceros,
            pance_tipos_documento_identidad,
            pance_compradores
        WHERE
            pance_compradores.id_tercero = pance_terceros.id AND
            pance_compradores.id > 0
        ORDER BY
            pance_terceros.primer_nombre, pance_terceros.razon_social;"
    ),
    array(
        "CREATE OR REPLACE ALGORITHM = MERGE VIEW pance_buscador_compradores AS
        SELECT
            pance_compradores.id AS id,
            pance_compradores.activo AS id_activo,
            pance_terceros.documento_identidad AS DOCUMENTO_IDENTIDAD,
            pance_terceros.primer_nombre AS PRIMER_NOMBRE,
            pance_terceros.segundo_nombre AS SEGUNDO_NOMBRE,
            pance_terceros.primer_apellido AS PRIMER_APELLIDO,
            pance_terceros.segundo_apellido AS SEGUNDO_APELLIDO,
            CONCAT(pance_terceros.documento_identidad,' ',(
                IF(pance_terceros.primer_nombre = ' ',
                    CONCAT(pance_terceros.segundo_nombre,' ',pance_terceros.segundo_nombre,' ',pance_terceros.primer_apellido,' ',pance_terceros.segundo_apellido),
                        pance_terceros.razon_social
                    )
                )
            )AS NOMBRE_COMPLETO,
            IF (pance_compradores.activo = '1',
                'Activo',
                'Inactivo'
            ) AS ACTIVO
        FROM
            pance_terceros,
            pance_tipos_documento_identidad,
            pance_compradores
        WHERE
            pance_compradores.id_tercero = pance_terceros.id AND
            pance_compradores.id > 0
        ORDER BY
            pance_terceros.primer_nombre, pance_terceros.razon_social;"
    ),
    /*array(
        "CREATE OR REPLACE ALGORITHM = MERGE VIEW pance_seleccion_compradores AS
        SELECT  pance_compradores.id AS id,
            pance_compradores.activo AS id_activo,
            CONCAT(
                pance_terceros.documento_identidad, ', ',
                if(pance_terceros.primer_nombre is not null, CONCAT(pance_terceros.primer_nombre, ' '), ''),
                if(pance_terceros.segundo_nombre is not null, CONCAT(pance_terceros.segundo_nombre, ' '), ''),
                if(pance_terceros.primer_apellido is not null, CONCAT(pance_terceros.primer_apellido, ' '), ''),
                if(pance_terceros.segundo_apellido is not null, CONCAT(pance_terceros.segundo_apellido, ' '), ''),
                if(pance_terceros.razon_social is not null, pance_terceros.razon_social, ''),
                '|',pance_terceros.id
            ) AS nombre

        FROM
            pance_terceros,
            pance_compradores
        WHERE
            pance_compradores.id_tercero = pance_terceros.id AND
            pance_compradores.id
        ORDER BY
            pance_terceros.primer_nombre ASC;"
    )*/
);
?>
