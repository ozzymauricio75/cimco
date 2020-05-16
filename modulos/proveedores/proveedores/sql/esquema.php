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
        "padre"     => "MENUPROV",
        "id_modulo" => "PROVEEDORES",
        "orden"     => "0005",
        "carpeta"   => "proveedores",
        "archivo"   => "menu"
    ),
    array(
        "id"        => "ADICPROV",
        "padre"     => "MENUPROV",
        "id_modulo" => "PROVEEDORES",
        "visible"   => "0",
        "orden"     => "00010",
        "carpeta"   => "proveedores",
        "archivo"   => "adicionar"
    ),
    array(
        "id"        => "CONSPROV",
        "padre"     => "MENUPROV",
        "id_modulo" => "PROVEEDORES",
        "visible"   => "0",
        "orden"     => "0012",
        "carpeta"   => "proveedores",
        "archivo"   => "consultar"
    ),
    array(
        "id"        => "MODIPROV",
        "padre"     => "MENUPROV",
        "id_modulo" => "PROVEEDORES",
        "visible"   => "0",
        "orden"     => "0014",
        "carpeta"   => "proveedores",
        "archivo"   => "modificar"
    ),
    array(
        "id"        => "ELIMPROV",
        "padre"     => "MENUPROV",
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

***/
?>
