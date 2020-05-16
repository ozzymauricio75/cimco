<?php

/**
*
* Copyright (C) 2009 FELINUX Ltda
* Francisco J. Lozano B. <fjlozano@felinux.com.co>
* Margarita Hoyos <margarita@linuxcali.com>
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
$tablas["usuarios"]   = array(
    "id"                       => "SMALLINT(4) UNSIGNED ZEROFILL AUTO_INCREMENT NOT NULL COMMENT 'Consecutivo interno para la base de datos'",
    "usuario"                  => "VARCHAR(12) NOT NULL COMMENT 'Nombre de acceso (login)'",
    "contrasena"               => "CHAR(32) NOT NULL COMMENT 'Contraseña'",
    "nombre"                   => "CHAR(50) NOT NULL COMMENT 'Nombre completo'",
    "correo"                   => "VARCHAR(255) NOT NULL COMMENT 'Dirección de correo electrónico'",
    "cambiar_contrasena"       => "ENUM('0','1') NOT NULL DEFAULT '1' COMMENT 'Puede cambiar la contraseña: 0=No, 1=Si'",
    "fecha_cambio_contrasena"  => "DATETIME DEFAULT NULL COMMENT 'Fecha del último cambio de contraseña'",
    "cambio_contrasena_minimo" => "SMALLINT(4) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Mínimo número de días que deben transcurrir antes de cambiar la contraseña: 0=No aplica'",
    "cambio_contrasena_maximo" => "SMALLINT(4) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Máximo número de días de que pueden transcurrir sin cambiar la contraseña: 0=No aplica'",
    "fecha_expiracion"         => "DATETIME DEFAULT NULL COMMENT 'Fecha máxima hasta la cual el usuario puede acceder a la aplicación: NULL = No aplica'",
    "activo"                   => "ENUM('0','1') NOT NULL DEFAULT '1' COMMENT 'El usuario se encuentra activo y puede acceder a la aplicación: 0 = No, 1= Si'"
);

/*** Definición de llaves primarias ***/
$llavesPrimarias["usuarios"] = "id";

/*** Definición de campos únicos ***/
$llavesUnicas["usuarios"] = array(
    "usuario",
    "correo"
);

/*** Inserción de datos iniciales ***/
/*$registros["usuarios"] = array(
    array(
        "id"         => "1",
        "usuario"    => "admin",*/
//        "contrasena" => "21232f297a57a5a743894a0e4a801fc3", /*** Versión cifrada con MD5 de la palabra 'admin' ***/
/*        "nombre"     => "Administrador Principal",
        "correo"     => "pance@linuxcali.com"
    )
);*/

$registros["componentes"] = array(
    array(
        "id"        => "GESTUSUA",
        "padre"     => "SUBMACCE",
        "id_modulo" => "ADMINISTRACION",
        "orden"     => "0100",
        "carpeta"   => "usuarios",
        "archivo"   => "menu"
    ),
    array(
        "id"        => "ADICUSUA",
        "padre"     => "GESTUSUA",
        "id_modulo" => "ADMINISTRACION",
        "visible"   => "0",
        "orden"     => "0005",
        "carpeta"   => "usuarios",
        "archivo"   => "adicionar"
    ),
    array(
        "id"        => "CONSUSUA",
        "padre"     => "GESTUSUA",
        "id_modulo" => "ADMINISTRACION",
        "visible"   => "0",
        "orden"     => "0010",
        "carpeta"   => "usuarios",
        "archivo"   => "consultar"
    ),
    array(
        "id"        => "MODIUSUA",
        "padre"     => "GESTUSUA",
        "id_modulo" => "ADMINISTRACION",
        "visible"   => "0",
        "orden"     => "0015",
        "carpeta"   => "usuarios",
        "archivo"   => "modificar"
    ),
    array(
        "id"        => "ELIMUSUA",
        "padre"     => "GESTUSUA",
        "id_modulo" => "ADMINISTRACION",
        "visible"   => "0",
        "orden"     => "0020",
        "carpeta"   => "usuarios",
        "archivo"   => "eliminar"
    )
);

/*** Sentencia para la creación de la vista requerida

    CREATE OR REPLACE VIEW pance_menu_usuarios AS SELECT id AS id, usuario AS USUARIO, nombre AS NOMBRE FROM pance_usuarios;
    CREATE OR REPLACE VIEW pance_buscador_usuarios AS SELECT id AS id, usuario, nombre FROM pance_usuarios;

***/

?>
