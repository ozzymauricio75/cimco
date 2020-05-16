<?php

/**
*
* Copyright (C) 2009 FELINUX Ltda
* Francisco J. Lozano B. <fjlozano@felinux.com.co>
* Margarita Hoyos <margarita@linuxcali.com>
* Mauricio Oidor L. <ozzymauricio75@gmail.com>
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
$tablas ["tipos_bodegas"] = array(
    "id"          => "SMALLINT(3) UNSIGNED ZEROFILL AUTO_INCREMENT NOT NULL COMMENT 'Consecutivo interno de la base de datos'",
    "nombre"      => "VARCHAR(60) NOT NULL COMMENT 'Nombre que identifica el tipo de bodega'",
    "descripcion" => "VARCHAR(60) NOT NULL COMMENT 'Nombre que describe el tipo de bodega'"
);

/*** Definición de llaves primarias ***/
$llavesPrimarias["tipos_bodegas"] = "id";

/*** Definición de campos únicos ***/
$llavesUnicas["tipos_bodegas"] = array(
    "nombre"
);

/*** Inserción de datos iniciales ***/
$registros["componentes"] = array(
    array(
        "id"        => "GESTTIBO",
        "padre"     => "SUBMDCAD",
        "id_modulo" => "ADMINISTRACION",
        "visible"   => "1",
        "orden"     => "0015",
        "carpeta"   => "tipos_bodegas",
        "archivo"   => "menu"
    ),
    array(
        "id"        => "ADICTIBO",
        "padre"     => "GESTTIBO",
        "id_modulo" => "ADMINISTRACION",
        "visible"   => "0",
        "orden"     => "0005",
        "carpeta"   => "tipos_bodegas",
        "archivo"   => "adicionar"
    ),
    array(
        "id"        => "CONSTIBO",
        "padre"     => "GESTTIBO",
        "id_modulo" => "ADMINISTRACION",
        "visible"   => "0",
        "orden"     => "0010",
        "carpeta"   => "tipos_bodegas",
        "archivo"   => "consultar"
    ),
    array(
        "id"        => "MODITIBO",
        "padre"     => "GESTTIBO",
        "id_modulo" => "ADMINISTRACION",
        "visible"   => "0",
        "orden"     => "0015",
        "carpeta"   => "tipos_bodegas",
        "archivo"   => "modificar"
    ),
    array(
        "id"        => "ELIMTIBO",
        "padre"     => "GESTTIBO",
        "id_modulo" => "ADMINISTRACION",
        "visible"   => "0",
        "orden"     => "0020",
        "carpeta"   => "tipos_bodegas",
        "archivo"   => "eliminar"
    )       
);

/*** Sentencia para la creación de la vista requerida ***/
/*** CREATE OR REPLACE VIEW pance_menu_tipos_bodegas AS
     SELECT pance_tipos_bodegas.id AS id, 
     pance_tipos_bodegas.nombre AS NOMBRE,
     pance_tipos_bodegas.descripcion AS DESCRIPCION
     FROM pance_tipos_bodegas;
       
     CREATE OR REPLACE VIEW pance_buscador_tipos_bodegas AS SELECT pance_tipos_bodegas.id AS id,
     pance_tipos_bodegas.nombre AS nombre,
     pance_tipos_bodegas.descripcion AS descripcion
     FROM pance_tipos_bodegas;
     
***/
?>
