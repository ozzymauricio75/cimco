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

/*** Eliminar la tabla y crearla de nuevo cada vez que se ejecute el script de creaci�n ***/
$borrarSiempre = false;

/*** Definici�n de tablas ***/
$tablas["sesiones"] = array(
    "id"         => "CHAR(32) NOT NULL COMMENT 'Identificador de la sesi�n'",
    "expiracion" => "INT(11) NOT NULL COMMENT 'Fecha de expiraci�n (en formato Unix Timestamp) de la sesi�n por inactividad'",
    "contenido"  => "TEXT NOT NULL COMMENT 'Variables definidas en la sesi�n con sus respectivos valores'"
);

$tablas["modulos"] = array(
    "id"          => "CHAR(32) NOT NULL COMMENT 'Identificador del m�dulo'",
    "nombre"      => "VARCHAR(32) NOT NULL COMMENT 'Nombre del m�dulo'",
    "descripcion" => "VARCHAR(255) NOT NULL COMMENT 'Descripci�n del m�dulo'",
    "carpeta"     => "VARCHAR(255) COMMENT 'Carpeta donde estar�n almacenados los componentes del m�dulo'",
    "url"         => "VARCHAR(255)  NULL COMMENT 'URL del m�dulo'",
    "version"     => "CHAR(10) NULL COMMENT 'Versi�n del m�dulo (Formato: AAAAMMDD+consecutivo. Ej: 2008031501)'"
);

$tablas["componentes"] = array(
    "id"        => "VARCHAR(8) NOT NULL COMMENT 'Identificador del componente'",
    "padre"     => "VARCHAR(8) COMMENT 'Identificador del padre del componente: NULL = Componente principal'",
    "id_modulo" => "CHAR(32) NOT NULL COMMENT 'Identificador del modulo al cual pertenece'",
    "global"    => "ENUM('0','1') NOT NULL DEFAULT '0' COMMENT 'Todos los usuarios lo pueden cargar sin verificar permisos: 0=No, 1=Si'",
    "visible"   => "ENUM('0','1') NOT NULL DEFAULT '1' COMMENT 'El componente debe aparecer en el men�: 0=No, 1=Si'",
    "orden"     => "SMALLINT(4) UNSIGNED ZEROFILL NOT NULL DEFAULT '0' COMMENT 'Orden en el que debe presentarse en el men� � en los listados'",
    "carpeta"   => "VARCHAR(255) COMMENT 'Carpeta donde est� almacenado el archivo'",
    "archivo"   => "VARCHAR(255) COMMENT 'Archivo que se debe cargar al seleccionar el componente: NULL = No genera enlace o acci�n'"
);

$tablas["terceros"] = array(
    "id"                      => "INT(8) UNSIGNED ZEROFILL AUTO_INCREMENT NOT NULL COMMENT 'Consecutivo interno para la base de datos'",
    "documento_identidad"     => "VARCHAR(12) NOT NULL COMMENT 'N�mero del documento de identidad'",
    "id_tipo_documento"       => "SMALLINT(3) UNSIGNED ZEROFILL NOT NULL COMMENT 'Consecutivo interno para la base de datos del tipo de documento de identidad'",
    "id_municipio_documento"  => "INT(8) UNSIGNED ZEROFILL NOT NULL COMMENT 'Consecutivo interno para la base de datos del municipio de expedici�n del documento de identidad'",
    "tipo_persona"            => "ENUM('1','2','3') NOT NULL DEFAULT '1' COMMENT 'Tipo de persona: 1=Natural, 2=Juridica, 3=C�digo interno'",
    "primer_nombre"           => "VARCHAR(15) DEFAULT NULL COMMENT 'Primer nombre (persona natural)'",
    "segundo_nombre"          => "VARCHAR(15) DEFAULT NULL COMMENT 'Segundo nombre (persona natural)'",
    "primer_apellido"         => "VARCHAR(20) DEFAULT NULL COMMENT 'Primer apellido (persona natural)'",
    "segundo_apellido"        => "VARCHAR(20) DEFAULT NULL COMMENT 'Segundo apellido (persona natural)'",
    "razon_social"            => "VARCHAR(255) DEFAULT NULL COMMENT 'Razon social (persona jur�dica)'",
    "nombre_comercial"        => "VARCHAR(255) DEFAULT NULL COMMENT 'Nombre comercial (persona jur�dica)'",
    "fecha_nacimiento"        => "DATE NOT NULL COMMENT 'Fecha de nacimiento de la persona � constituci�n de la sociedad'",
    "fecha_ingreso"           => "DATE NOT NULL COMMENT 'Fecha en que se vinculo el tercero por primera vez con las empresas'",
    "id_municipio_residencia" => "INT(8) UNSIGNED ZEROFILL NOT NULL COMMENT 'Consecutivo interno para la base de datos del municipio de residencia'",
    "direccion_principal"     => "VARCHAR(50) DEFAULT NULL COMMENT 'Direcci�n de residencia'",
    "telefono_principal"      => "VARCHAR(15) DEFAULT NULL COMMENT 'N�mero de tel�fono'",
    "telefono_secundario"     => "VARCHAR(15) DEFAULT NULL COMMENT 'N�mero de tel�fono secundario'",
    "celular"                 => "VARCHAR(20) DEFAULT NULL COMMENT 'N�mero de celular'",
    "fax"                     => "VARCHAR(20) DEFAULT NULL COMMENT 'N�mero de fax'",
    "correo"                  => "VARCHAR(255) DEFAULT NULL COMMENT 'Direcci�n de correo electr�nico'",
    "sitio_web"               => "VARCHAR(50) DEFAULT NULL COMMENT 'Direcci�n del sitio web'",
    "genero"                  => "ENUM('M','F','N') NOT NULL DEFAULT 'N' COMMENT 'G�nero: M=Masculino, F=Femenino, N=No aplica'",
    "activo"                  => "ENUM('0','1') NOT NULL DEFAULT '1' COMMENT 'El tercero est� activo 0=No, 1=Si'",
    "cliente"                 => "ENUM('0','1') NOT NULL DEFAULT '0' COMMENT 'Cliente 0=No, 1=Si'",
    "proveedor"               => "ENUM('0','1') NOT NULL DEFAULT '0' COMMENT 'Proveedor 0=No, 1=Si'",
    "comprador"               => "ENUM('0','1') NOT NULL DEFAULT '0' COMMENT 'Comprador 0=No, 1=Si'"
);

$tablas["imagenes"] = array(
    "id"          => "INT(10) UNSIGNED ZEROFILL AUTO_INCREMENT NOT NULL COMMENT 'Consecutivo interno para la base de datos'",
    "categoria"   => "ENUM('1','2') NOT NULL COMMENT 'Clase de imagen: 1=Usuarios, 2=Art�culos'",
    "id_asociado" => "INT(12) UNSIGNED ZEROFILL NOT NULL COMMENT 'Consecutivo interno del �tem en la tabla asociada seg�n la categor�a'",
    "contenido"   => "MEDIUMBLOB NOT NULL COMMENT 'Lista de valores (datos) de las columnas'",
    "tipo"        => "VARCHAR(255) NOT NULL COMMENT 'TIpo de archivo (MIME)'",
    "extension"   => "ENUM('png','jpg','gif') NOT NULL COMMENT 'Extensi�n que determina el tipo de imagen'",
    "ancho"       => "SMALLINT(4) NOT NULL COMMENT 'Ancho de la imagen en pixeles'",
    "alto"        => "SMALLINT(4) NOT NULL COMMENT 'Alto de la imagen en pixeles'"
);

$tablas["actualizaciones_almacen"] = array(
    "id"          => "INT(10) UNSIGNED ZEROFILL AUTO_INCREMENT NOT NULL COMMENT 'Consecutivo interno para la base de datos'",
    "fecha"       => "DATETIME NOT NULL COMMENT 'Fecha y hora en la que se ejecut� la instrucci�n'",
    "instruccion" => "ENUM('I','U','D') NOT NULL COMMENT 'Tipo de sentencia SQL originada en el almac�n: I=INSERT, U=UPDATE, D=DELETE'",
    "tabla"       => "VARCHAR(255) NOT NULL COMMENT 'Nombre de la tabla en la que se debe ejecutar la instrucci�n'",
    "columnas"    => "TEXT NOT NULL COMMENT 'Lista de columnas'",
    "valores"     => "TEXT NOT NULL COMMENT 'Lista de valores (datos) de las columnas'",
    "id_asignado" => "INT(10) NOT NULL COMMENT 'Consecutivo interno asginado autom�ticamente para la instrucci�n actual'"
);

$tablas["actualizaciones_servidor"] = array(
    "id"           => "INT(10) UNSIGNED ZEROFILL AUTO_INCREMENT NOT NULL COMMENT 'Consecutivo interno para la base de datos'",
    "id_servidor"  => "SMALLINT(3) UNSIGNED ZEROFILL NOT NULL COMMENT 'Consecutivo interno para la base de datos del almac�n que origin� la instrucci�n'",
    "instruccion1" => "TEXT NOT NULL COMMENT 'Sentencia SQL para el almac�n que origin� la actualizaci�n'",
    "instruccion2" => "TEXT NOT NULL COMMENT 'Sentencia SQL para el resto de almacenes'",
    "id"           => "INT(10) UNSIGNED ZEROFILL NOT NULL COMMENT 'Consecutivo interno para la base de datos'"
);

// $tablas["actualizaciones_relaciones"] = array(
//     "id"            => "INT(10) NOT NULL COMMENT 'Consecutivo interno para la base de datos'",
//     "tabla_origen"  => "VARCHAR(255) DEFAULT NOT NULL COMMENT ''",
//     "campo_origen"  => "VARCHAR(255) DEFAULT NOT NULL COMMENT ''",
//     "tabla_destino" => "VARCHAR(255) DEFAULT NOT NULL COMMENT ''",
//     "campo_destino" => "VARCHAR(255) DEFAULT NOT NULL COMMENT ''"
// );

/*** Definici�n de llaves primarias ***/
$llavesPrimarias["sesiones"]                   = "id";
$llavesPrimarias["modulos"]                    = "id";
$llavesPrimarias["componentes"]                = "id";
$llavesPrimarias["terceros"]                   = "id";
$llavesPrimarias["imagenes"]                   = "id";
$llavesPrimarias["actualizaciones_almacen"]    = "id";
$llavesPrimarias["actualizaciones_servidor"]   = "id";
$llavesPrimarias["actualizaciones_relaciones"] = "id";

/*** Definici�n de campos �nicos ***/
$llavesUnicas["modulos"]  = array(
    "nombre"
);

$llavesUnicas["terceros"] = array(
    "documento_identidad",
    "razon_social",
    "nombre_comercial"
);

/*** Definici�n de llaves for�neas ***/
$llavesForaneas["componentes"] = array(
    array(
        /*** Nombre de la llave ***/
        "componente_modulo",
        /*** Nombre del campo clave de la tabla local ***/
        "id_modulo",
        /*** Nombre de la tabla relacionada ***/
        "modulos",
        /*** Nombre del campo clave en la tabla relacionada ***/
        "id"
    )
);

$llavesForaneas["terceros"] = array(
    array(
        /*** Nombre de la llave ***/
        "tercero_tipo_documento",
        /*** Nombre del campo clave de la tabla local ***/
        "id_tipo_documento",
        /*** Nombre de la tabla relacionada ***/
        "tipos_documento_identidad",
        /*** Nombre del campo clave en la tabla relacionada ***/
        "id"
    ),
    array(
        /*** Nombre de la llave ***/
        "tercero_municipio_documento",
        /*** Nombre del campo clave de la tabla local ***/
        "id_municipio_documento",
        /*** Nombre de la tabla relacionada ***/
        "municipios",
        /*** Nombre del campo clave en la tabla relacionada ***/
        "id"
    ),
    array(
        /*** Nombre de la llave ***/
        "tercero_municipio_residencia",
        /*** Nombre del campo clave de la tabla local ***/
        "id_municipio_residencia",
        /*** Nombre de la tabla relacionada ***/
        "localidades",
        /*** Nombre del campo clave en la tabla relacionada ***/
        "id"
    )
);

/*** Definici�n de llaves for�neas ***/
$llavesForaneas["actualizaciones_servidor"] = array(
    array(
        /*** Nombre de la llave ***/
        "actualizaciones_servidor_servidor",
        /*** Nombre del campo clave de la tabla local ***/
        "id_servidor",
        /*** Nombre de la tabla relacionada ***/
        "servidores",
        /*** Nombre del campo clave en la tabla relacionada ***/
        "id"
    )
);

/*** Inserci�n de datos iniciales ***/
$registros["modulos"] = array(
    array(
        "id"          => "ADMINISTRACION",
        "nombre"      => "Administraci�n",
        "descripcion" => "Operaciones y datos de control relacionados con el acceso a la aplicaci�n y la integraci�n de sus componentes",
        "carpeta"     => "administracion"
    ),
    /*array(
        "id"          => "INVENTARIO",
        "nombre"      => "Inventario",
        "descripcion" => "Operaciones y datos de control relacionados con el inventario",
        "carpeta"     => "inventarios"
    ),
    array(
        "id"          => "PROVEEDORES",
        "nombre"      => "Proveedores",
        "descripcion" => "Operaciones y datos de control relacionados con los proveedores",
        "carpeta"     => "proveedores"
    ),*/
    array(
        "id"          => "PROVEEDORES",
        "nombre"      => "Proveedores",
        "descripcion" => "Operaciones y datos de control relacionados con los proveedores",
        "carpeta"     => "proveedores"
    ),
    array(
        "id"          => "CLIENTES",
        "nombre"      => "Clientes",
        "descripcion" => "Operaciones y datos de control relacionados con los clientes",
        "carpeta"     => "clientes"
    ),
    array(
        "id"          => "INVENTARIO",
        "nombre"      => "Inventario",
        "descripcion" => "Operaciones y datos de control relacionados con los articulos",
        "carpeta"     => "articulos"
    ),/*
    array(
        "id"          => "CONTABILIDAD",
        "nombre"      => "Contabilidad",
        "descripcion" => "Menu de contabilidad",
        "carpeta"     => "contabilidad"
    ),*/
    array(
        "id"          => "EXTENSIONES",
        "nombre"      => "Extensiones",
        "descripcion" => "Extensiones de uso general de la aplicaci�n",
        "carpeta"     => "extensiones"
    )
);

$registros["componentes"] = array(
    array(
        "id"        => "MENUINSE",
        "padre"     => "NULL",
        "id_modulo" => "ADMINISTRACION",
        "visible"   => "0",
        "orden"     => "0000",
        "carpeta"   => "principal",
        "archivo"   => "iniciar",
        "global"    => "1"
        ),
    array(
        "id"        => "MENUPRIN",
        "padre"     => "NULL",
        "id_modulo" => "ADMINISTRACION",
        "orden"     => "0001",
        "carpeta"   => "principal",
        "archivo"   => "principal",
        "global"    => "1"
    ),/*
    array(
        "id"        => "MENUINVE",
        "padre"     => "NULL",
        "id_modulo" => "ADMINISTRACION",
        "orden"     => "1000",
        "carpeta"   => "principal",
        "archivo"   => "NULL"
    ),
    array(
        "id"        => "MENUPROV",
        "padre"     => "NULL",
        "id_modulo" => "ADMINISTRACION",
        "orden"     => "2000",
        "carpeta"   => "principal",
        "archivo"   => "NULL"
    ),
    array(
        "id"        => "MENUPROD",
        "padre"     => "NULL",
        "id_modulo" => "ADMINISTRACION",
        "orden"     => "3000",
        "carpeta"   => "principal",
        "archivo"   => "NULL"
    ),*/
    array(
        "id"        => "MENUCLIE",
        "padre"     => "NULL",
        "id_modulo" => "ADMINISTRACION",
        "orden"     => "4000",
        "carpeta"   => "principal",
        "archivo"   => "NULL"
    ),
    array(
        "id"        => "MENUPROV",
        "padre"     => "NULL",
        "id_modulo" => "ADMINISTRACION",
        "orden"     => "4500",
        "carpeta"   => "principal",
        "archivo"   => "NULL"
    ),
    array(
        "id"        => "MENUINVE",
        "padre"     => "NULL",
        "id_modulo" => "ADMINISTRACION",
        "orden"     => "5000",
        "carpeta"   => "principal",
        "archivo"   => "NULL"
    ),/*
    array(
        "id"        => "MENUMERC",
        "padre"     => "NULL",
        "id_modulo" => "ADMINISTRACION",
        "orden"     => "5000",
        "carpeta"   => "principal",
        "archivo"   => "NULL"
    ),
    array(
        "id"        => "MENUFINA",
        "padre"     => "NULL",
        "id_modulo" => "ADMINISTRACION",
        "orden"     => "6000",
        "carpeta"   => "principal",
        "archivo"   => "NULL"
    ),
    array(
        "id"        => "MENULOGI",
        "padre"     => "NULL",
        "id_modulo" => "ADMINISTRACION",
        "orden"     => "7000",
        "carpeta"   => "principal",
        "archivo"   => "NULL"
    ),
    array(
        "id"        => "MENUREHU",
        "padre"     => "NULL",
        "id_modulo" => "ADMINISTRACION",
        "orden"     => "8000",
        "carpeta"   => "principal",
        "archivo"   => "NULL"
    ),
    array(
        "id"        => "MENUCONT",
        "padre"     => "NULL",
        "id_modulo" => "ADMINISTRACION",
        "orden"     => "9000",
        "carpeta"   => "principal",
        "archivo"   => "NULL"
    ),*/
    array(
        "id"        => "MENUADMI",
        "padre"     => "NULL",
        "id_modulo" => "ADMINISTRACION",
        "orden"     => "9500",
        "carpeta"   => "principal",
        "archivo"   => "NULL"
    ),
    array(
        "id"        => "MENUFINS",
        "padre"     => "NULL",
        "id_modulo" => "ADMINISTRACION",
        "orden"     => "9999",
        "carpeta"   => "principal",
        "archivo"   => "finalizar",
        "global"    => "1"
    ),
    array(
        "id"        => "SUBMESTC",
        "padre"     => "MENUADMI",
        "id_modulo" => "ADMINISTRACION",
        "orden"     => "1000",
        "carpeta"   => "principal",
        "archivo"   => "NULL"
    ),
    array(
        "id"        => "SUBMACCE",
        "padre"     => "MENUADMI",
        "id_modulo" => "ADMINISTRACION",
        "orden"     => "2000",
        "carpeta"   => "principal",
        "archivo"   => "NULL"
    ),
    array(
        "id"        => "SUBMDISP",
        "padre"     => "MENUADMI",
        "id_modulo" => "ADMINISTRACION",
        "orden"     => "3000",
        "carpeta"   => "principal",
        "archivo"   => "NULL"
    ),
    array(
        "id"        => "SUBMSEGU",
        "padre"     => "MENUADMI",
        "id_modulo" => "ADMINISTRACION",
        "orden"     => "4000",
        "carpeta"   => "principal",
        "archivo"   => "NULL"
    ),
    array(
        "id"        => "SUBMDCAD",
        "padre"     => "MENUADMI",
        "id_modulo" => "ADMINISTRACION",
        "orden"     => "5000",
        "carpeta"   => "principal",
        "archivo"   => "NULL"
    ),
    array(
        "id"        => "SUBMUBIG",
        "padre"     => "SUBMDCAD",
        "id_modulo" => "ADMINISTRACION",
        "orden"     => "1000",
        "carpeta"   => "principal",
        "archivo"   => "NULL"
    ),
    /*** Componente especial para la visualizaci�n de im�genes desde una tabla ***/
    array(
        "id"        => "VISUIMAG",
        "padre"     => "NULL",
        "id_modulo" => "ADMINISTRACION",
        "visible"   => "0",
        "orden"     => "0500",
        "carpeta"   => "principal",
        "archivo"   => "visualizar",
        "global"    => "1"
    )
);

/***Sentencia para la creaci�n de la vista requerida

CREATE OR REPLACE VIEW pance_menu_usuarios AS SELECT id AS id, usuario AS USUARIO, nombre AS NOMBRE FROM pance_usuarios;

CREATE OR REPLACE VIEW pance_menu_terceros AS
     SELECT pance_terceros.id AS id,
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
     )AS NOMBRE_COMPLETO
     FROM pance_terceros;
*/
?>
