<?php

/**
*
* Copyright (C) 2020 Raul Mauricio Oidor Lozano
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
$tablas ["proveedores"] = array(
    "id"                        => "INT(8) UNSIGNED ZEROFILL AUTO_INCREMENT NOT NULL COMMENT 'Consecutivo interno para la base de datos'",
    "id_tercero"              => "INT(8) UNSIGNED ZEROFILL NOT NULL COMMENT 'Id de la tabla de terceros'",
    "id_forma_pago_contado"   => "SMALLINT(3) UNSIGNED ZEROFILL NOT NULL DEFAULT '0' COMMENT 'Numero de dias para pago de contado'",
    "id_forma_pago_credito"   => "SMALLINT(3) UNSIGNED ZEROFILL NOT NULL DEFAULT '0' COMMENT 'Numero de dias para pago a credito'",
    "regimen"                 => "ENUM('1','2') DEFAULT '1' COMMENT '1->Regimen comun 2->Regimen simplificado'",
    "retiene_fuente"          => "ENUM('0','1') DEFAULT '0' COMMENT 'Realiza retencion en la fuente 0->No 1->Si'",
    "autoretenedor"           => "ENUM('0','1') NOT NULL DEFAULT '0' COMMENT 'Autoretenedor 0->No 1->Si'",
    "retiene_iva"             => "ENUM('0','1') NOT NULL DEFAULT '0' COMMENT 'Retiene IVA 0->No 1->Si'",
    "retiene_ica"             => "ENUM('0','1') NOT NULL DEFAULT '0' COMMENT 'Retiene ICA 0->No 1->Si'",
    "gran_contribuyente"      => "ENUM('0','1') NOT NULL COMMENT 'Empresa esta catalogada como gran contribuyente por la DIAN 0->No 1-Si'",
    "id_actividad_principal"  => "SMALLINT(4) UNSIGNED ZEROFILL NOT NULL COMMENT 'Actividad económica principal a la cual se dedica la Empresa'",
    "id_actividad_secundaria" => "SMALLINT(4) UNSIGNED ZEROFILL NOT NULL COMMENT 'Actividad económica secundaria a la cual se dedica la Empresa'",
    "id_usuario_registra"     => "SMALLINT(4) UNSIGNED ZEROFILL NOT NULL DEFAULT '0' COMMENT 'Id del usuario que genera el registro'",
    "fecha_registra"          => "DATETIME NOT NULL DEFAULT '0000-00-00' COMMENT 'Fecha ingreso al sistema'",
    "fecha_modificacion"      => "TIMESTAMP NOT NULL DEFAULT '0000-00-00' COMMENT 'Fecha ultima modificación'"
);

/*** Definición de llaves primarias ***/
$llavesPrimarias["proveedores"] = "id";

/*** Definición de llaves foráneas ***/
$llavesForaneas["proveedores"] = array(
    array(
        /*** Nombre de la llave ***/
        "proveedor_tercero",
        /*** Nombre del campo clave de la tabla local ***/
        "id_tercero",
        /*** Nombre de la tabla relacionada ***/
        "terceros",
        /*** Nombre del campo clave en la tabla relacionada ***/
        "id"
    ),
    array(
        /*** Nombre de la llave ***/
        "proveedor_actividad_principal",
        /*** Nombre del campo clave de la tabla local ***/
        "id_actividad_principal",
        /*** Nombre de la tabla relacionada ***/
        "actividades_economicas",
        /*** Nombre del campo clave en la tabla relacionada ***/
        "id"
    ),
    array(
        /*** Nombre de la llave ***/
        "proveedor_actividad_secundaria",
        /*** Nombre del campo clave de la tabla local ***/
        "id_actividad_secundaria",
        /*** Nombre de la tabla relacionada ***/
        "actividades_economicas",
        /*** Nombre del campo clave en la tabla relacionada ***/
        "id"
    ),
    array(
        /*** Nombre de la llave ***/
        "proveedor_forma_pago_contado",
        /*** Nombre del campo clave de la tabla local ***/
        "id_forma_pago_contado",
        /*** Nombre de la tabla relacionada ***/
        "plazos_pago_proveedores",
        /*** Nombre del campo clave en la tabla relacionada ***/
        "id"
    ),
    array(
        /*** Nombre de la llave ***/
        "proveedor_forma_pago_credito",
        /*** Nombre del campo clave de la tabla local ***/
        "id_forma_pago_credito",
        /*** Nombre de la tabla relacionada ***/
        "plazos_pago_proveedores",
        /*** Nombre del campo clave en la tabla relacionada ***/
        "id"
    )    
);

/*** Inserción de datos iniciales ***/
$registros["componentes"] = array(
    /*array(
        "id"        => "SUBMMAYO",
        "padre"     => "MENUCLIE",
        "id_modulo" => "CLIENTES",
        "visible"   => "1",
        "orden"     => "2000",
        "carpeta"   => "principal",
        "archivo"   => "NULL"
    ),
    array(
        "id"        => "SUBMMINO",
        "padre"     => "MENUCLIE",
        "id_modulo" => "CLIENTES",
        "visible"   => "1",
        "orden"     => "5000",
        "carpeta"   => "principal",
        "archivo"   => "NULL"
    ),*/
    array(
        "id"        => "GESTPROV",
        "padre"     => "SUBMDCPV",
        "id_modulo" => "PROVEEDORES",
        "visible"   => "1",
        "orden"     => "1000",
        "carpeta"   => "proveedores",
        "archivo"   => "menu"
    ),
    array(
        "id"        => "ADICPROV",
        "padre"     => "GESTPROV",
        "id_modulo" => "PROVEEDORES",
        "visible"   => "0",
        "orden"     => "00010",
        "carpeta"   => "proveedores",
        "archivo"   => "adicionar"
    ),
    array(
        "id"        => "CONSPROV",
        "padre"     => "GESTPROV",
        "id_modulo" => "PROVEEDORES",
        "visible"   => "0",
        "orden"     => "0012",
        "carpeta"   => "proveedores",
        "archivo"   => "consultar"
    ),
    array(
        "id"        => "MODIPROV",
        "padre"     => "GESTPROV",
        "id_modulo" => "PROVEEDORES",
        "visible"   => "0",
        "orden"     => "0014",
        "carpeta"   => "proveedores",
        "archivo"   => "modificar"
    ),
    array(
        "id"        => "ELIMPROV",
        "padre"     => "GESTPROV",
        "id_modulo" => "PROVEEDORES",
        "visible"   => "0",
        "orden"     => "0016",
        "carpeta"   => "proveedores",
        "archivo"   => "eliminar"
    )
    /*
    array(
        "id"        => "SUBMVEMA",
        "padre"     => "SUBMMAYO",
        "id_modulo" => "CLIENTES",
        "visible"   => "1",
        "orden"     => "0005",
        "carpeta"   => "principal",
        "archivo"   => "NULL"
    ),
    array(
        "id"        => "SUBMCOMA",
        "padre"     => "SUBMMAYO",
        "id_modulo" => "CLIENTES",
        "visible"   => "1",
        "orden"     => "0010",
        "carpeta"   => "principal",
        "archivo"   => "NULL"
    ),
    array(
        "id"        => "SUBMDCMA",
        "padre"     => "SUBMMAYO",
        "id_modulo" => "CLIENTES",
        "visible"   => "1",
        "orden"     => "0015",
        "carpeta"   => "principal",
        "archivo"   => "NULL"
    ),
    array(
        "id"        => "GESTCLMA",
        "padre"     => "SUBMDCMA",
        "id_modulo" => "CLIENTES",
        "orden"     => "0005",
        "carpeta"   => "clientes_mayoristas",
        "archivo"   => "menu"
    ),
    array(
        "id"        => "GESTSUMA",
        "padre"     => "SUBMDCMA",
        "id_modulo" => "CLIENTES",
        "orden"     => "0010",
        "carpeta"   => "sucursales_mayoristas",
        "archivo"   => "menu"
    ),
    array(
        "id"        => "GESTCOMA",
        "padre"     => "SUBMDCMA",
        "id_modulo" => "CLIENTES",
        "orden"     => "0012",
        "carpeta"   => "contactos_mayoristas",
        "archivo"   => "menu"
    ),
    array(
        "id"        => "GESTVECO",
        "padre"     => "SUBMDCMA",
        "id_modulo" => "CLIENTES",
        "orden"     => "0015",
        "carpeta"   => "vendedores_cobradores",
        "archivo"   => "menu"
    ),
    array(
        "id"        => "GESTZOVM",
        "padre"     => "SUBMDCMA",
        "id_modulo" => "CLIENTES",
        "orden"     => "0020",
        "carpeta"   => "zona_ventas_mayoristas",
        "archivo"   => "menu"
    ),
    array(
        "id"        => "GESTCMMY",
        "padre"     => "SUBMDCMA",
        "id_modulo" => "CLIENTES",
        "orden"     => "0025",
        "carpeta"   => "comisiones_mayoristas",
        "archivo"   => "menu"
    ),
    array(
        "id"        => "GESTTRMA",
        "padre"     => "SUBMDCMA",
        "id_modulo" => "CLIENTES",
        "orden"     => "0090",
        "carpeta"   => "transacciones_clientes_mayoristas",
        "archivo"   => "menu"
    )*/
);

/*** Sentencia para la creación de la vista requerida ***/

/*** CREATE OR REPLACE VIEW pance_menu_proveedores AS
     SELECT pance_terceros.id AS id,
     pance_terceros.documento_identidad AS DOCUMENTO_PROVEEDOR,
     CONCAT(IF(pance_terceros.primer_nombre IS NOT NULL,pance_terceros.primer_nombre,''),' ',
     IF(pance_terceros.segundo_nombre IS NOT NULL,pance_terceros.segundo_nombre,''),' ',
     IF(pance_terceros.primer_apellido IS NOT NULL,pance_terceros.primer_apellido,''),' ',
     IF(pance_terceros.segundo_apellido IS NOT NULL,pance_terceros.segundo_apellido,''),' ',
     IF(pance_terceros.razon_social IS NOT NULL,pance_terceros.razon_social,'')) AS PROVEEDOR
     FROM pance_terceros WHERE pance_terceros.proveedor = '1';


     CREATE OR REPLACE VIEW pance_buscador_proveedores AS SELECT pance_terceros.id AS id,
     pance_terceros.documento_identidad AS documento_identidad,
     CASE pance_terceros.tipo_persona WHEN '1' THEN 'Natural'
     WHEN  '2' THEN 'Juridica' 
     WHEN '3' THEN 'Interno'
     END AS tipo_persona,
     pance_terceros.id_tipo_documento AS id_tipo_documento,
     pance_terceros.id_municipio_documento AS id_municipio_documento,
     pance_terceros.id_municipio_residencia AS id_municipio_residencia,
     pance_terceros.primer_nombre AS primer_nombre,
     pance_terceros.segundo_nombre AS segundo_nombre,
     pance_terceros.primer_apellido AS primer_apellido,
     pance_terceros.segundo_apellido AS segundo_apellido,
     pance_terceros.razon_social AS razon_social,
     pance_terceros.nombre_comercial AS nombre_comercial,
     pance_terceros.id_tipo_documento AS genero,
     pance_terceros.direccion_principal AS direccion_principal,
     pance_terceros.telefono_principal AS telefono_principal,  
     CONCAT(IF(pance_terceros.primer_nombre IS NOT NULL,pance_terceros.primer_nombre,''),' ',
     IF(pance_terceros.segundo_nombre IS NOT NULL,pance_terceros.segundo_nombre,''),' ',
     IF(pance_terceros.primer_apellido IS NOT NULL,pance_terceros.primer_apellido,''),' ',
     IF(pance_terceros.segundo_apellido IS NOT NULL,pance_terceros.segundo_apellido,''),' ',
     IF(pance_terceros.razon_social IS NOT NULL,pance_terceros.razon_social,'')) AS nombre_completo,
     pance_terceros.fax AS fax,
     pance_terceros.celular AS celular,
     pance_terceros.correo AS correo,
     pance_terceros.sitio_web AS sitio_web
     FROM pance_terceros, pance_tipos_documento_identidad
     WHERE pance_terceros.proveedor = '1';

     /*** Sentencia para la creación de la vista requerida ***/
/***
    CREATE OR REPLACE VIEW pance_menu_proveedores AS
    SELECT pance_proveedores.id AS id,
    pance_terceros.documento_identidad AS DOCUMENTO_PROVEEDOR,
    CONCAT(IF(pance_terceros.primer_nombre IS NOT NULL,pance_terceros.primer_nombre,''),' ',
    IF(pance_terceros.segundo_nombre IS NOT NULL,pance_terceros.segundo_nombre,''),' ',
    IF(pance_terceros.primer_apellido IS NOT NULL,pance_terceros.primer_apellido,''),' ',
    IF(pance_terceros.segundo_apellido IS NOT NULL,pance_terceros.segundo_apellido,''),' ',
    IF(pance_terceros.razon_social IS NOT NULL,pance_terceros.razon_social,'')) AS PROVEEDOR
    FROM pance_proveedores, pance_terceros
    WHERE  pance_proveedores.id_tercero = pance_terceros.id;

    CREATE OR REPLACE VIEW pance_buscador_proveedores AS SELECT
    pance_proveedores.id AS id,
    pance_terceros.documento_identidad AS documento_identidad,
    pance_terceros.primer_nombre AS primer_nombre,
    pance_terceros.segundo_nombre AS segundo_nombre,
    pance_terceros.primer_apellido AS primer_apellido,
    pance_terceros.segundo_apellido AS segundo_apellido,
    pance_terceros.razon_social AS razon_social,
    pance_terceros.nombre_comercial AS nombre_comercial,
    CONCAT(IF(pance_terceros.primer_nombre IS NOT NULL,pance_terceros.primer_nombre,''),' ',
    IF(pance_terceros.segundo_nombre IS NOT NULL,pance_terceros.segundo_nombre,''),' ',
    IF(pance_terceros.primer_apellido IS NOT NULL,pance_terceros.primer_apellido,''),' ',
    IF(pance_terceros.segundo_apellido IS NOT NULL,pance_terceros.segundo_apellido,''),' ',
    IF(pance_terceros.razon_social IS NOT NULL,pance_terceros.razon_social,'')) AS nombre_completo
    FROM pance_proveedores, pance_terceros
    WHERE pance_proveedores.id_tercero = pance_terceros.id;

    CREATE OR REPLACE VIEW pance_seleccion_proveedores AS
    SELECT pance_proveedores.id AS id,
    CONCAT(
    pance_terceros.documento_identidad, '-',
    if(pance_terceros.primer_nombre is not null, pance_terceros.primer_nombre, ''), ' ',
    if(pance_terceros.segundo_nombre is not null, pance_terceros.segundo_nombre, ''), ' ',
    if(pance_terceros.primer_apellido is not null, pance_terceros.primer_apellido, ''), ' ',
    if(pance_terceros.segundo_apellido is not null, pance_terceros.segundo_apellido, ''), ' ',
    if(pance_terceros.razon_social is not null, pance_terceros.razon_social, ''), '|',
    pance_proveedores.id) AS nombre
    FROM pance_terceros, pance_proveedores
    WHERE pance_terceros.id = pance_proveedores.id_tercero
    ORDER BY pance_terceros.primer_nombre ASC;
***/
?>
