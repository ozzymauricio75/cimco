    <?php

/**
*
* Copyright (C) 2009 FELINUX Ltda
* Francisco J. Lozano B. <fjlozano@felinux.com.co>
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

$borrarSiempre   = false;

$tablas["perfiles_usuario"]   = array(
    "id"          => "INT(8) UNSIGNED ZEROFILL AUTO_INCREMENT NOT NULL COMMENT 'Consecutivo interno de la base de datos'",
    "id_usuario"  => "SMALLINT(4) UNSIGNED ZEROFILL NOT NULL COMMENT 'Consecutivo interno de la base de datos para el usuario'",
    "id_sucursal" => "MEDIUMINT(5) UNSIGNED ZEROFILL NOT NULL COMMENT 'Consecutivo interno de la base de datos para la sucursal'",
    "id_perfil"   => "SMALLINT(4) UNSIGNED ZEROFILL NOT NULL COMMENT 'Consecutivo interno de la base de datos para el perfil'",
);

$tablas["componentes_usuario"]   = array(
    "id"            => "INT(8) UNSIGNED ZEROFILL AUTO_INCREMENT NOT NULL COMMENT 'Consecutivo interno de la base de datos'",
	"id_perfil"     => "INT(8) UNSIGNED ZEROFILL NOT NULL COMMENT 'Identificador de la tabla perfil usuario'",
    "id_componente" => "VARCHAR(8) NOT NULL COMMENT 'Identificador del componente'",
);

/*** Definici�n de llaves primarias ***/
$llavesPrimarias["perfiles_usuario"]    = "id";
$llavesPrimarias["componentes_usuario"] = "id, id_perfil, id_componente";

/*** Definici�n de llaves primarias ***/
$llavesUnicas["perfiles_usuario"] = array(
    "id_usuario, id_sucursal"
);

$llavesForaneas["perfiles_usuario"] = array(
    array(
        /*** Nombre de la llave ***/
        "perfiles_usuario_usuario",
        /*** Nombre del campo clave de la tabla local ***/
        "id_usuario",
        /*** Nombre de la tabla relacionada ***/
        "usuarios",
        /*** Nombre del campo clave en la tabla relacionada ***/
        "id"
    ),
    array(
        /*** Nombre de la llave ***/
        "perfiles_usuario_sucursal",
        /*** Nombre del campo clave de la tabla local ***/
        "id_sucursal",
        /*** Nombre de la tabla relacionada ***/
        "sucursales",
        /*** Nombre del campo clave en la tabla relacionada ***/
        "id"
    ),
    array(
        /*** Nombre de la llave ***/
        "perfiles_usuario_perfil",
        /*** Nombre del campo clave de la tabla local ***/
        "id_perfil",
        /*** Nombre de la tabla relacionada ***/
        "perfiles",
        /*** Nombre del campo clave en la tabla relacionada ***/
        "id"
    )
);

$llavesForaneas["componentes_usuario"] = array(
    array(
        /*** Nombre de la llave ***/
        "componente_usuario_perfil",
        /*** Nombre del campo clave de la tabla local ***/
        "id_perfil",
        /*** Nombre de la tabla relacionada ***/
        "perfiles_usuario",
        /*** Nombre del campo clave en la tabla relacionada ***/
        "id"
    ),
    array(
        /*** Nombre de la llave ***/
        "componente_usuario_componente",
        /*** Nombre del campo clave de la tabla local ***/
        "id_componente",
        /*** Nombre de la tabla relacionada ***/
        "componentes",
        /*** Nombre del campo clave en la tabla relacionada ***/
        "id"
    )
);

/*** Inserci�n de datos iniciales ***/
$registros["componentes"] = array(
    array(
        "id"        => "GESTPRIV",
        "padre"     => "SUBMACCE",
        "id_modulo" => "ADMINISTRACION",
        "orden"     => "0150",
        "carpeta"   => "privilegios",
        "archivo"   => "menu"
    ),
    array(
        "id"        => "ADICPRIV",
        "padre"     => "GESTPRIV",
        "id_modulo" => "ADMINISTRACION",
        "visible"   => "0",
        "orden"     => "0005",
        "carpeta"   => "privilegios",
        "archivo"   => "adicionar"
    ),
    array(
        "id"        => "CONSPRIV",
        "padre"     => "GESTPRIV",
        "id_modulo" => "ADMINISTRACION",
        "visible"   => "0",
        "orden"     => "0010",
        "carpeta"   => "privilegios",
        "archivo"   => "consultar"
    ),
    array(
        "id"        => "MODIPRIV",
        "padre"     => "GESTPRIV",
        "id_modulo" => "ADMINISTRACION",
        "visible"   => "0",
        "orden"     => "0015",
        "carpeta"   => "privilegios",
        "archivo"   => "modificar"
    ),
    array(
        "id"        => "ELIMPRIV",
        "padre"     => "GESTPRIV",
        "id_modulo" => "ADMINISTRACION",
        "visible"   => "0",
        "orden"     => "0020",
        "carpeta"   => "privilegios",
        "archivo"   => "eliminar"
    )
);

/*** Sentencias para la creaci�n de las vistas requeridas

    CREATE OR REPLACE VIEW pance_menu_privilegios AS
    SELECT pance_perfiles_usuario.id AS id, 
    pance_usuarios.nombre AS USUARIO, 
    pance_perfiles.nombre AS PERFIL, 
    pance_sucursales.nombre AS SUCURSAL
    FROM pance_perfiles_usuario, pance_perfiles, pance_usuarios, pance_sucursales
    WHERE pance_perfiles_usuario.id_perfil=pance_perfiles.id AND pance_perfiles_usuario.id_usuario = pance_usuarios.id AND pance_perfiles_usuario.id_sucursal = pance_sucursales.id;

    CREATE OR REPLACE VIEW pance_buscador_privilegios AS
    SELECT pance_perfiles_usuario.id AS id, pance_usuarios.nombre AS usuario, pance_sucursales.nombre AS sucursal
    FROM pance_perfiles_usuario, pance_usuarios, pance_sucursales
    WHERE pance_perfiles_usuario.id_usuario = pance_usuarios.id AND pance_perfiles_usuario.id_sucursal = pance_sucursales.id;

***/

?>