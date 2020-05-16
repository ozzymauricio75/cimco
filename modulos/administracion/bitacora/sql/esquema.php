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

$tablas["conexiones"] = array(
    "id"         => "INT(8) UNSIGNED ZEROFILL AUTO_INCREMENT NOT NULL COMMENT 'Consecutivo interno para la base de datos'",
    "fecha"      => "DATETIME NOT NULL COMMENT 'Fecha y hora de la conexión'",
    "id_usuario" => "SMALLINT(4) UNSIGNED ZEROFILL NOT NULL COMMENT 'Consecutivo interno para la base de datos del usuario que realiza la conexión'",
    "ip"         => "VARCHAR(15) NOT NULL COMMENT 'Dirección IP desde la cual se realiza la conexión'",
    "proxy"      => "VARCHAR(15) COMMENT 'Dirección IP del proxy, si lo hay, desde el cual se realiza la conexión'",
    "navegador"  => "VARCHAR(255) COMMENT 'Identificación del navegador'",
    "sistema"    => "VARCHAR(255) COMMENT 'Sistema operativo del cliente'"
);

$tablas["bitacora"] = array(
    "id"          => "INT(10) UNSIGNED ZEROFILL AUTO_INCREMENT NOT NULL COMMENT 'Consecutivo interno para la base de datos'",
    "id_conexion" => "INT(8) UNSIGNED ZEROFILL NOT NULL COMMENT 'Consecutivo interno para la base de datos de la conexión a la cual pertenece'",
    "fecha"       => "DATETIME NOT NULL COMMENT 'Fecha y hora de la operación'",
    "componente"  => "TEXT NOT NULL COMMENT 'Nombre del componente requerido por el usuario'",
    "consulta"    => "TEXT NOT NULL COMMENT 'Detalles de la sintáxis SQL de la(s) consulta(s) generada(s) por el componente'",
    "mensaje"     => "TEXT COMMENT 'Mensaje de error (si existe) devuelto por el motor de bases de datos'"
);

/*** Definición de llaves primarias ***/
$llavesPrimarias["conexiones"]  = "id";
$llavesPrimarias["bitacora"]    = "id";

/*** Definición de llaves foráneas ***/
$llavesForaneas["conexiones"] = array(
    array(
        /*** Nombre de la llave ***/
        "conexion_usuario",
        /*** Nombre del campo clave de la tabla local ***/
        "id_usuario",
        /*** Nombre de la tabla relacionada ***/
        "usuarios",
        /*** Nombre del campo clave en la tabla relacionada ***/
        "id"
    )
);

$llavesForaneas["bitacora"] = array(
    array(
        /*** Nombre de la llave ***/
        "bitacora_conexion",
        /*** Nombre del campo clave de la tabla local ***/
        "id_conexion",
        /*** Nombre de la tabla relacionada ***/
        "conexiones",
        /*** Nombre del campo clave en la tabla relacionada ***/
        "id"
    )
);

/*** Inserción de datos iniciales ***/
$registros["componentes"]   = array(
    array(
        "id"        => "GESTBITA",
        "padre"     => "SUBMSEGU",
        "id_modulo" => "ADMINISTRACION",
        "visible"   => "1",
        "orden"     => "0100",
        "carpeta"   => "bitacora",
        "archivo"   => "menu"
    ),
    array(
        "id"        => "CONSBITA",
        "padre"     => "GESTBITA",
        "id_modulo" => "ADMINISTRACION",
        "visible"   => "0",
        "orden"     => "0010",
        "carpeta"   => "bitacora",
        "archivo"   => "consultar"
    )
);

/*** Sentencias para la creación de las vistas requeridas

    CREATE OR REPLACE VIEW pance_menu_conexiones AS
    SELECT pance_conexiones.id AS id, DATE_FORMAT(pance_conexiones.fecha, '%Y/%m/%d') AS FECHA, DATE_FORMAT(pance_conexiones.fecha, '%r') AS HORA,
    pance_usuarios.nombre AS USUARIO, pance_conexiones.ip AS IP, pance_conexiones.proxy AS PROXY, pance_conexiones.fecha AS id_fecha
    FROM pance_usuarios, pance_conexiones
    WHERE pance_conexiones.id_usuario = pance_usuarios.id;

    CREATE OR REPLACE VIEW pance_buscador_conexiones AS
    SELECT pance_conexiones.id AS id, pance_conexiones.fecha AS FECHA, pance_usuarios.nombre AS USUARIO,
    pance_conexiones.ip AS IP, pance_conexiones.proxy AS PROXY
    FROM pance_usuarios, pance_conexiones
    WHERE pance_conexiones.id_usuario = pance_usuarios.id;

    CREATE OR REPLACE VIEW pance_consulta_bitacora AS
    SELECT id_conexion AS id, DATE_FORMAT(fecha, '%Y/%m/%d') AS FECHA, DATE_FORMAT(fecha, '%r') AS HORA,
    componente AS COMPONENTE, consulta AS CONSULTA, mensaje AS MENSAJE
    FROM pance_bitacora;


***/

?>