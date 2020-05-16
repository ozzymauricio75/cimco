<?php

/**
*
* Copyright (C) 2020 Raul Mauricio Oidor Lozano
* Raul Mauricio Oidor Lozano. <ozzymauricio75@gmail.com>
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

//$borrarSiempre = array();
// Definición de tablas
$borrarSiempre["articulos"] = false;
$tablas["articulos"] = array(
    "id"                      => "INT(9) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Llave primaria'",
    "id_sucursal"             => "MEDIUMINT(5) UNSIGNED ZEROFILL NOT NULL COMMENT 'Id de la tabla sucursales'",
    "codigo"                  => "VARCHAR(15) NOT NULL COMMENT 'Codigo interno'",
    "detalle"                 => "VARCHAR(40) NOT NULL COMMENT 'Detalle del articulo'",
    "referencia"              => "VARCHAR(15) NOT NULL COMMENT 'Referencia principal del articulo'",
    "tipo_inventario"         => "ENUM('0','1','2','3') NOT NULL DEFAULT '0' COMMENT '0->Mercancia 1->Materia prima 2->Suministro 3->Obsequio'",
    "estado"                  => "ENUM('0','1') NOT NULL DEFAULT '0' COMMENT 'Inactivo 0->No 1->Si'",
    "precio"                  => "DECIMAL(11,4) NOT NULL COMMENT 'Precio'",
    "id_tasa"                 => "INT(7) UNSIGNED ZEROFILL NOT NULL COMMENT 'Id de la tabla tasas'",
    "id_usuario_registra"     => "SMALLINT(4) UNSIGNED ZEROFILL NOT NULL DEFAULT '0' COMMENT 'Id del usuario que genera el registro'",
    "fecha_registra"          => "DATETIME NOT NULL COMMENT 'Fecha ingreso al sistema'",
    "fecha_modificacion"      => "TIMESTAMP  NOT NULL COMMENT 'Fecha ultima modificación'",
);
// Definición de llaves primarias
$llavesPrimarias["articulos"] = "id";

// Definición de campos únicos
$llavesUnicas["articulos"] = array(
    "codigo,referencia"
);

$indicesTabla["articulos"] = array(
    array(
        "articulo_detalle",
        "detalle"
    )
);

//Definición de llave foraneas
$llavesForaneas["articulos"] = array(
    array(
        // Nombre de la llave
        "articulos_tasa",
        // Nombre del campo clave de la tabla local
        "id_tasa",
        // Nombre de la tabla relacionada
        "tasas",
        // Nombre del campo clave en la tabla relacionada
        "id"
    ),
    array(
        // Nombre de la llave
        "articulos_sucursal",
        // Nombre del campo clave de la tabla local
        "id_sucursal",
        // Nombre de la tabla relacionada
        "sucursales",
        // Nombre del campo clave en la tabla relacionada
        "id"
    ),
    array(
        // Nombre de la llave
        "articulos_usuarios",
        // Nombre del campo clave de la tabla local
        "id_usuario",
        // Nombre de la tabla relacionada
        "usuarios",
        // Nombre del campo clave en la tabla relacionada
        "id"
    )
);

// Inserción de datos iniciales***/
$registros["articulos"] = array(
    array(
        "id"                  => "0",
        "id_sucursal"         => "0",
        "codigo"              => "0",
        "detalle"             => "",
        "referencia"          => "",
        "tipo_inventario"     => "0",
        "estado"              => "0",
        "precio"              => 0,
        "id_tasa"             => "0",
        "id_usuario_registra" => "0",
        "fecha_registra"      => "",
        "fecha_modificacion"  => ""
    )
);

// Inserción de datos iniciales***/
$registros["componentes"] = array(
    array(
        "id"              => "GESTARTI",
        "padre"           => "SUBMARTI",
        "id_modulo"       => "INVENTARIO",
        "visible"         => "1",
        "orden"           => "5",
        "carpeta"         => "articulos",
        "archivo"         => "menu"
    ),
    array(
        "id"              => "ADICARTI",
        "padre"           => "GESTARTI",
        "id_modulo"       => "INVENTARIO",
        "visible"         => "0",
        "orden"           => "0010",
        "carpeta"         => "articulos",
        "archivo"         => "adicionar"
    ),
    array(
        "id"              => "CONSARTI",
        "padre"           => "GESTARTI",
        "id_modulo"       => "INVENTARIO",
        "visible"         => "0",
        "orden"           => "0020",
        "carpeta"         => "articulos",
        "archivo"         => "consultar"
    ),
    array(
        "id"              => "MODIARTI",
        "padre"           => "GESTARTI",
        "id_modulo"       => "INVENTARIO",
        "visible"         => "0",
        "orden"           => "0030",
        "carpeta"         => "articulos",
        "archivo"         => "modificar"
    ),
    array(
        "id"              => "ELIMARTI",
        "padre"           => "GESTARTI",
        "id_modulo"       => "INVENTARIO",
        "visible"         => "0",
        "orden"           => "0040",
        "carpeta"         => "articulos",
        "archivo"         => "eliminar"
    ),
    array(
        "id"              => "LISTARTI",
        "padre"           => "GESTARTI",
        "id_modulo"       => "INVENTARIO",
        "visible"         => "0",
        "orden"           => "0050",
        "carpeta"         => "articulos",
        "archivo"         => "listar"
    )
);

$vistas = array(
    array(
        "CREATE OR REPLACE ALGORITHM = MERGE VIEW sem_menu_articulos AS
            SELECT  sem_articulos.codigo AS id,
                    sem_articulos.codigo AS CODIGO,
                    sem_articulos.codigo_alfanumerico AS CODIGO_ALFANUMERICO,
                    sem_articulos.descripcion AS DESCRIPCION
            FROM    sem_articulos
            WHERE   sem_articulos.codigo != 0;"
    ),
    array(
        "CREATE OR REPLACE ALGORITHM = MERGE VIEW sem_buscador_articulos AS
        SELECT  sem_articulos.codigo AS id,
                    sem_articulos.codigo AS CODIGO,
                    sem_articulos.codigo_alfanumerico AS CODIGO_ALFANUMERICO,
                    sem_articulos.descripcion AS DESCRIPCION
            FROM    sem_articulos
            WHERE   sem_articulos.codigo != 0;"
    ),
    array(
        "CREATE OR REPLACE ALGORITHM = MERGE VIEW sem_seleccion_articulos AS
        SELECT  sem_articulos.codigo AS id,
                CONCAT(
                    sem_articulos.codigo, ' - ',
                    sem_articulos.descripcion,
                    '|', sem_articulos.codigo
                ) AS descripcion
        FROM
            sem_articulos
        WHERE
            sem_articulos.codigo != '';"
    ),
    array("CREATE OR REPLACE ALGORITHM = MERGE VIEW sem_relacion_articulo_proveedor AS
            SELECT  AR.codigo AS id,
                    PR.documento_identidad AS id_proveedor,
                    CONCAT (AR.codigo,' - ',AR.descripcion,'|',AR.codigo) AS articulo
            FROM    sem_referencias_proveedor RP, sem_articulos AR, sem_proveedores PR, sem_terceros TR
            WHERE   RP.codigo_articulo = AR.codigo AND RP.documento_identidad_proveedor = PR.documento_identidad
                    AND PR.documento_identidad = TR.documento_identidad"
    )
);
?>
