<?php

/**
*
* Copyright (C) 2009 SAE Ltda
* Mauricio Oidor L. <ozzymauricio75@gmail.com>
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
$tablas ["sedes_clientes"] = array(
    "id"                 => "INT(8) UNSIGNED ZEROFILL AUTO_INCREMENT NOT NULL COMMENT 'C�digo interno en al base de datos'",
    "id_cliente"         => "INT(8) UNSIGNED ZEROFILL NOT NULL COMMENT 'C�digo interno relaciona con el cliente'",
    "nombre_sede"        => "VARCHAR(60) NOT NULL COMMENT 'Nombre de la sede'",
    "id_sucursal"        => "MEDIUMINT(5) UNSIGNED ZEROFILL NOT NULL COMMENT 'Consecutivo interno identifica la sucursal'",
    "nombre_contacto"    => "VARCHAR(255) NOT NULL COMMENT 'Nombre que identifica el contacto'",
    "id_cargo"           => "SMALLINT(3) UNSIGNED ZEROFILL NOT NULL COMMENT 'Consecutivo interno que identifica el cargo'",
    "id_municipios"      => "INT(8) UNSIGNED ZEROFILL NOT NULL COMMENT 'C�digo del municipio donde reside la sede'",
    "direccion"          => "VARCHAR(50) NOT NULL COMMENT 'Direccion de la sede'",
    "telefono_principal" => "VARCHAR(15) NOT NULL COMMENT 'N�mero de tel�fono'",
    "celular"            => "VARCHAR(15) COMMENT 'N�mero de celular'",
    "correo"             => "VARCHAR(100) COMMENT 'Direcci�n de correo electr�nico'"
);

/*** Definici�n de llaves primarias ***/
$llavesPrimarias["sedes_clientes"] = "id";

/***  Definici�n de llaves for�neas ***/
$llavesForaneas["sedes_clientes"] = array(
    array(
        /*** Nombre de la llave ***/
        "sedes_terceros",
        /*** Nombre del campo clave de la tabla local ***/
        "id_cliente",
        /*** Nombre de la tabla relacionada ***/
        "terceros",
        /*** Nombre del campo clave en la tabla relacionada ***/
        "id"
    ),
    array(
        /*** Nombre de la llave ***/
        "sedes_sucursal",
        /*** Nombre del campo clave de la tabla local ***/
        "id_sucursal",
        /*** Nombre de la tabla relacionada ***/
        "sucursales",
        /*** Nombre del campo clave en la tabla relacionada ***/
        "id"
    ),
    array(
        /*** Nombre de la llave ***/
        "sedes_municipio",
        /*** Nombre del campo clave de la tabla local ***/
        "id_municipios",
        /*** Nombre de la tabla relacionada ***/
        "municipios",
        /*** Nombre del campo clave en la tabla relacionada ***/
        "id"
    )
);

/*** Inserci�n de datos iniciales ***/
$registros["componentes"] = array(
    array(
        "id"        => "GESTSEDE",
        "padre"     => "SUBMCOSE",
        "id_modulo" => "CLIENTES",
        "visible"   => "1",
        "orden"     => "0030",
        "carpeta"   => "sedes_clientes",
        "archivo"   => "menu"
    ),
    array(
        "id"        => "ADICSEDE",
        "padre"     => "GESTSEDE",
        "id_modulo" => "CLIENTES",
        "visible"   => "0",
        "orden"     => "0005",
        "carpeta"   => "sedes_clientes",
        "archivo"   => "adicionar"
    ),
    array(
        "id"        => "CONSSEDE",
        "padre"     => "GESTSEDE",
        "id_modulo" => "CLIENTES",
        "visible"   => "0",
        "orden"     => "0010",
        "carpeta"   => "sedes_clientes",
        "archivo"   => "consultar"
    ),
    array(
        "id"        => "MODISEDE",
        "padre"     => "GESTSEDE",
        "id_modulo" => "CLIENTES",
        "visible"   => "0",
        "orden"     => "0015",
        "carpeta"   => "sedes_clientes",
        "archivo"   => "modificar"
    ),
    array(
        "id"        => "ELIMSEDE",
        "padre"     => "GESTSEDE",
        "id_modulo" => "CLIENTES",
        "visible"   => "0",
        "orden"     => "0020",
        "carpeta"   => "sedes_clientes",
        "archivo"   => "eliminar"
    )
);

/*** Sentencia para la creaci�n de la vista requerida ***/
/*** CREATE OR REPLACE VIEW pance_menu_sedes_clientes AS
     SELECT pance_sedes_clientes.id AS id, 
     CONCAT(
     IF(pance_terceros.primer_nombre is not null, pance_terceros.primer_nombre,''), ' ',
     IF(pance_terceros.segundo_nombre is not null, pance_terceros.segundo_nombre,''), ' ',
     IF(pance_terceros.primer_apellido is not null, pance_terceros.primer_apellido,''), ' ',
     IF(pance_terceros.segundo_apellido is not null, pance_terceros.segundo_apellido,''), ' ',
     IF(pance_terceros.razon_social is not null, pance_terceros.razon_social, '')) AS CLIENTE,
     pance_sucursales.nombre AS CONSORCIADO,
     pance_sedes_clientes.nombre_sede AS SEDE,
     pance_sedes_clientes.nombre_contacto AS CONTACTO,
     pance_sedes_clientes.correo AS CORREO_ELECTRONICO
     FROM pance_sedes_clientes, pance_terceros, pance_sucursales 
     WHERE pance_sedes_clientes.id_cliente = pance_terceros.id AND pance_sedes_clientes.id_sucursal = pance_sucursales.id;

     CREATE OR REPLACE VIEW pance_buscador_sedes_clientes AS SELECT pance_sedes_clientes.id AS id, 
     CONCAT(
     IF(pance_terceros.primer_nombre is not null, pance_terceros.primer_nombre,''), ' ',
     IF(pance_terceros.segundo_nombre is not null, pance_terceros.segundo_nombre,''), ' ',
     IF(pance_terceros.primer_apellido is not null, pance_terceros.primer_apellido,''), ' ',
     IF(pance_terceros.segundo_apellido is not null, pance_terceros.segundo_apellido,''), ' ',
     IF(pance_terceros.razon_social is not null, pance_terceros.razon_social, '')) AS id_cliente,
     IF(pance_sucursales.nombre is not null, pance_sucursales.nombre,'') AS id_sucursal,
     pance_sedes_clientes.nombre_sede AS nombre_sede, 
     pance_sedes_clientes.nombre_contacto AS nombre_contacto, 
     pance_sedes_clientes.id_municipios AS id_municipios,
     pance_sedes_clientes.direccion AS direccion,
     pance_sedes_clientes.telefono_principal AS telefono_principal,
     pance_sedes_clientes.celular AS celular, 
     pance_sedes_clientes.correo AS correo
     FROM pance_sedes_clientes, pance_sucursales, pance_terceros, pance_municipios
     WHERE pance_terceros.id = pance_sedes_clientes.id_cliente AND pance_sedes_clientes.id_sucursal = pance_sucursales.id;
     
     CREATE OR REPLACE VIEW pance_seleccion_sedes_clientes AS SELECT
     pance_sedes_clientes.id AS id,
     pance_sedes_clientes.nombre_sede AS nombre_sede,
     CONCAT(
        IF(pance_terceros.primer_nombre is not null, pance_terceros.primer_nombre,''), ' ',
        IF(pance_terceros.segundo_nombre is not null, pance_terceros.segundo_nombre,''), ' ',
        IF(pance_terceros.primer_apellido is not null, pance_terceros.primer_apellido,''), ' ',
        IF(pance_terceros.segundo_apellido is not null, pance_terceros.segundo_apellido,''), ' ',
        IF(pance_terceros.razon_social is not null, pance_terceros.razon_social, ''),'|',
        pance_sedes_clientes.id
     ) AS id_cliente
     FROM pance_sedes_clientes, pance_terceros
     WHERE pance_terceros.id = pance_sedes_clientes.id_cliente;
***/
?>
