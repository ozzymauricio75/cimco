<?php

/**
*
* Copyright (C) 2008 LinuxCali Ltda
* Francisco J. Lozano B. <pacho@linuxcali.com>
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
$tablas ["sucursales"] = array(
    "id"                        => "MEDIUMINT(5) UNSIGNED ZEROFILL AUTO_INCREMENT NOT NULL COMMENT 'Consecutivo interno de la base de datos'",
    "codigo"                    => "SMALLINT(3) UNSIGNED ZEROFILL NOT NULL COMMENT 'Código interno asignado al almacen'",
    "id_empresa"                => "SMALLINT(3) UNSIGNED ZEROFILL NOT NULL COMMENT 'Código interno de la empresa con la que se relaciona el almacen'",
    "nombre"                    => "VARCHAR(60) NOT NULL COMMENT 'Nombre que identifica el almacen'",
    "nombre_corto"              => "CHAR(10) NOT NULL COMMENT 'Nombre que identifica el almacen en consultas'",
    "activo"                    => "ENUM('0','1') NOT NULL DEFAULT '0' COMMENT 'Indicador de estado del almacen: 0=Inactiva, 1=Activa'",
    "contratista"               => "ENUM('0','1') NOT NULL DEFAULT '0' COMMENT 'Indicador contratista: 0=No, 1=Si'",
    "id_municipio"              => "INT(5) UNSIGNED ZEROFILL NOT NULL COMMENT 'Codigo interno del municipio donde se encuentra la persona o empresa'",
    "direccion_residencia"      => "VARCHAR(60) NOT NULL COMMENT 'Direccion donde se encuentra la persona o empresa'",
    "telefono_1"                => "VARCHAR(15) NULL COMMENT 'Primer numero de telefono del lugar de residencia'",
    "telefono_2"                => "VARCHAR(15) NULL COMMENT 'Segundo numero de telefono del lugar de residencia'",
    "celular"                   => "VARCHAR(15) NULL COMMENT 'Numero de telefono celular'"
);

/*** Definición de llaves primarias ***/
$llavesPrimarias["sucursales"] = "id";

/*** Definición de campos únicos ***/
$llavesUnicas["sucursales"] = array(
    "codigo"
);

/***  Definición de llaves foráneas ***/
$llavesForaneas["sucursales"] = array(
    array(
        /*** Nombre de la llave ***/
        "sucursal_empresa",
        /*** Nombre del campo clave de la tabla local ***/
        "id_empresa",
        /*** Nombre de la tabla relacionada ***/
        "empresas",
        /*** Nombre del campo clave en la tabla relacionada ***/
        "id"
    ),
    array(
        /*** Nombre de la llave ***/
        "sucursal_municipio",
        /*** Nombre del campo clave de la tabla local ***/
        "id_municipio",
        /*** Nombre de la tabla relacionada ***/
        "municipios",
        /*** Nombre del campo clave en la tabla relacionada ***/
        "id"
    )    
);

/*** Inserción de datos iniciales ***/
$registros["componentes"] = array(
    array(
        "id"        => "GESTSUCU",
        "padre"     => "SUBMESTC",
        "id_modulo" => "ADMINISTRACION",
        "visible"   => "1",
        "orden"     => "0010",
        "carpeta"   => "sucursales",
        "archivo"   => "menu"
    ),
    array(
        "id"        => "ADICSUCU",
        "padre"     => "GESTSUCU",
        "id_modulo" => "ADMINISTRACION",
        "visible"   => "0",
        "orden"     => "0005",
        "carpeta"   => "sucursales",
        "archivo"   => "adicionar"
    ),
    array(
        "id"        => "CONSSUCU",
        "padre"     => "GESTSUCU",
        "id_modulo" => "ADMINISTRACION",
        "visible"   => "0",
        "orden"     => "0010",
        "carpeta"   => "sucursales",
        "archivo"   => "consultar"
    ),
    array(
        "id"        => "MODISUCU",
        "padre"     => "GESTSUCU",
        "id_modulo" => "ADMINISTRACION",
        "visible"   => "0",
        "orden"     => "0015",
        "carpeta"   => "sucursales",
        "archivo"   => "modificar"
    ),
    array(
        "id"        => "ELIMSUCU",
        "padre"     => "GESTSUCU",
        "id_modulo" => "ADMINISTRACION",
        "visible"   => "0",
        "orden"     => "0020",
        "carpeta"   => "sucursales",
        "archivo"   => "eliminar"
    )
);

/*** Sentencia para la creación de la vista requerida ***/
/*** CREATE OR REPLACE VIEW pance_menu_sucursales AS
     SELECT pance_sucursales.id AS id,
     pance_sucursales.codigo AS CODIGO,
     pance_sucursales.nombre AS NOMBRE,
     pance_empresas.razon_social AS EMPRESA,
     pance_terceros.documento_identidad AS TERCERO
     FROM pance_sucursales, pance_empresas, pance_terceros
     WHERE pance_sucursales.id_empresa = pance_empresas.id AND pance_empresas.id_tercero = pance_terceros.id;

     CREATE OR REPLACE VIEW pance_buscador_sucursales AS SELECT pance_sucursales.id AS id,
     pance_sucursales.codigo AS codigo, pance_sucursales.nombre AS nombre,
     pance_sucursales.nombre_corto AS nombre_corto,
     pance_empresas.razon_social AS empresa,
     CONCAT(
     if(pance_terceros.primer_nombre is not null, pance_terceros.primer_nombre,''), ' ',
     if(pance_terceros.segundo_nombre is not null, pance_terceros.segundo_nombre,''), ' ',
     if(pance_terceros.primer_apellido is not null, pance_terceros.primer_apellido,''), ' ',
     if(pance_terceros.segundo_apellido is not null, pance_terceros.segundo_apellido,''), ' ',
     if(pance_terceros.razon_social is not null, pance_terceros.razon_social, '')
     ) AS tercero
     FROM pance_sucursales, pance_terceros, pance_empresas
     WHERE pance_sucursales.id_empresa = pance_empresas.id AND
     pance_empresas.id_tercero = pance_terceros.id;

     CREATE OR REPLACE VIEW pance_seleccion_sucursales AS
     SELECT pance_sucursales.id AS id,
     CONCAT(pance_sucursales.nombre,'|', pance_sucursales.id) AS nombre
     FROM pance_sucursales
     ORDER BY pance_sucursales.nombre ASC;
***/
?>
