<?php

/**
*
* Copyright (C) 2009 FELINUX Ltda
* Francisco J. Lozano B. <fjlozano@felinux.com.co>
* Margarita Hoyos <margarita@linuxcali.com>
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
$borrarSiempre   = false;

/*** Definici�n de tablas ***/
$tablas["usuarios"]   = array(
    "id"                       => "SMALLINT(4) UNSIGNED ZEROFILL AUTO_INCREMENT NOT NULL COMMENT 'Consecutivo interno para la base de datos'",
    "usuario"                  => "VARCHAR(12) NOT NULL COMMENT 'Nombre de acceso (login)'",
    "contrasena"               => "CHAR(32) NOT NULL COMMENT 'Contrase�a'",
    "nombre"                   => "CHAR(50) NOT NULL COMMENT 'Nombre completo'",
    "correo"                   => "VARCHAR(255) NOT NULL COMMENT 'Direcci�n de correo electr�nico'",
    "cambiar_contrasena"       => "ENUM('0','1') NOT NULL DEFAULT '1' COMMENT 'Puede cambiar la contrase�a: 0=No, 1=Si'",
    "fecha_cambio_contrasena"  => "DATETIME DEFAULT NULL COMMENT 'Fecha del �ltimo cambio de contrase�a'",
    "cambio_contrasena_minimo" => "SMALLINT(4) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'M�nimo n�mero de d�as que deben transcurrir antes de cambiar la contrase�a: 0=No aplica'",
    "cambio_contrasena_maximo" => "SMALLINT(4) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'M�ximo n�mero de d�as de que pueden transcurrir sin cambiar la contrase�a: 0=No aplica'",
    "fecha_expiracion"         => "DATETIME DEFAULT NULL COMMENT 'Fecha m�xima hasta la cual el usuario puede acceder a la aplicaci�n: NULL = No aplica'",
    "activo"                   => "ENUM('0','1') NOT NULL DEFAULT '1' COMMENT 'El usuario se encuentra activo y puede acceder a la aplicaci�n: 0 = No, 1= Si'"
);

/*** Definici�n de llaves primarias ***/
$llavesPrimarias["usuarios"] = "id";

/*** Definici�n de campos �nicos ***/
$llavesUnicas["usuarios"] = array(
    "usuario",
    "correo"
);

/*** Inserci�n de datos iniciales ***/
/*$registros["usuarios"] = array(
    array(
        "id"         => "1",
        "usuario"    => "admin",*/
//        "contrasena" => "21232f297a57a5a743894a0e4a801fc3", /*** Versi�n cifrada con MD5 de la palabra 'admin' ***/
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

/*** Sentencia para la creaci�n de la vista requerida

    CREATE OR REPLACE VIEW pance_menu_usuarios AS SELECT id AS id, usuario AS USUARIO, nombre AS NOMBRE FROM pance_usuarios;
    CREATE OR REPLACE VIEW pance_buscador_usuarios AS SELECT id AS id, usuario, nombre FROM pance_usuarios;

***/

?>
