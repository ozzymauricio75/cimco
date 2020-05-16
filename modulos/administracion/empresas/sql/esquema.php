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
$tablas ["empresas"] = array(
    "id"                      => "SMALLINT(3) UNSIGNED ZEROFILL AUTO_INCREMENT NOT NULL COMMENT 'Consecutivo interno de la base de datos'",
    "codigo"                  => "SMALLINT(3) UNSIGNED ZEROFILL NOT NULL COMMENT 'Código interno de la empresa'",
    "razon_social"            => "VARCHAR(60) NOT NULL COMMENT 'Razon social que identifica la empresa'",
    "nombre_corto"            => "CHAR(10) NOT NULL COMMENT 'Nombre corto que identifica la empresa en consultas'",
    "fecha_cierre"            => "DATE DEFAULT NULL COMMENT 'Fecha que estuvo activa la empresa'",
    "activo"                  => "ENUM('0','1') NOT NULL DEFAULT '1' COMMENT 'Indicador de estado de la empresa: 0=Inactiva, 1=Activa'",
    "id_tercero"              => "INT(8) UNSIGNED ZEROFILL NOT NULL COMMENT 'Codigo interno asignado ala empresa en la tabla terceros'",
    "regimen"                 => "ENUM('1','2') DEFAULT '1' COMMENT '1->Regimen comun 2->Regimen simplificado'",
    "retiene_fuente"          => "ENUM('0','1') DEFAULT '0' COMMENT 'Realiza retencion en la fuente 0->No 1->Si'",
    "autoretenedor"           => "ENUM('0','1') NOT NULL DEFAULT '0' COMMENT 'Autoretenedor 0->No 1->Si'",
    "retiene_iva"             => "ENUM('0','1') NOT NULL DEFAULT '0' COMMENT 'Retiene IVA 0->No 1->Si'",
    "retiene_ica"             => "ENUM('0','1') NOT NULL DEFAULT '0' COMMENT 'Retiene ICA 0->No 1->Si'",
    "gran_contribuyente"      => "ENUM('0','1') NOT NULL COMMENT 'Empresa esta catalogada como gran contribuyente por la DIAN 0->No 1-Si'",
    "id_actividad_principal"  => "SMALLINT(4) UNSIGNED ZEROFILL NOT NULL COMMENT 'Actividad económica principal a la cual se dedica la Empresa'",
    "id_actividad_secundaria" => "SMALLINT(4) UNSIGNED ZEROFILL NOT NULL COMMENT 'Actividad económica secundaria a la cual se dedica la Empresa'"      
);

/*** Definición de llaves primarias ***/
$llavesPrimarias["empresas"] = "id";

/*** Definición de campos únicos ***/
$llavesUnicas["empresas"] = array(
    "codigo"
);

/***  Definición de llaves foráneas ***/
$llavesForaneas["empresas"] = array(
    array(    
        /*** Nombre de la llave ***/
        "empresas_tercero",
        /*** Nombre del campo clave de la tabla local ***/
        "id_tercero",
        /*** Nombre de la tabla relacionada ***/
        "terceros",
        /*** Nombre del campo clave en la tabla relacionada ***/
        "id"
    ),
    array(    
        /*** Nombre de la llave ***/
        "empresas_actividad_principal",
        /*** Nombre del campo clave de la tabla local ***/
        "id_actividad_principal",
        /*** Nombre de la tabla relacionada ***/
        "actividades_economicas",
        /*** Nombre del campo clave en la tabla relacionada ***/
        "id"
    ),
    array(    
        /*** Nombre de la llave ***/
        "empresas_actividad_secundaria",
        /*** Nombre del campo clave de la tabla local ***/
        "id_actividad_secundaria",
        /*** Nombre de la tabla relacionada ***/
        "actividades_economicas",
        /*** Nombre del campo clave en la tabla relacionada ***/
        "id"
    )
);

/*** Inserción de datos iniciales ***/
$registros["componentes"] = array(
    array(
        "id"        => "GESTEMPR",
        "padre"     => "SUBMESTC",
        "id_modulo" => "ADMINISTRACION",
        "visible"   => "1",
        "orden"     => "0005",
        "carpeta"   => "empresas",
        "archivo"   => "menu"
    ),
    array(
        "id"        => "ADICEMPR",
        "padre"     => "GESTEMPR",
        "id_modulo" => "ADMINISTRACION",
        "visible"   => "0",
        "orden"     => "0005",
        "carpeta"   => "empresas",
        "archivo"   => "adicionar"
    ),
    array(
        "id"        => "CONSEMPR",
        "padre"     => "GESTEMPR",
        "id_modulo" => "ADMINISTRACION",
        "visible"   => "0",
        "orden"     => "0010",
        "carpeta"   => "empresas",
        "archivo"   => "consultar"
    ),
    array(
        "id"        => "MODIEMPR",
        "padre"     => "GESTEMPR",
        "id_modulo" => "ADMINISTRACION",
        "visible"   => "0",
        "orden"     => "0015",
        "carpeta"   => "empresas",
        "archivo"   => "modificar"
    ),
    array(
        "id"        => "ELIMEMPR",
        "padre"     => "GESTEMPR",
        "id_modulo" => "ADMINISTRACION",
        "visible"   => "0",
        "orden"     => "0020",
        "carpeta"   => "empresas",
        "archivo"   => "eliminar"
    )       
);

/*** Sentencia para la creación de la vista requerida ***/
/*** CREATE OR REPLACE VIEW pance_menu_empresas AS
     SELECT pance_empresas.id AS id,
     pance_empresas.codigo AS CODIGO_EMPRESA,
     pance_empresas.razon_social AS RAZON_SOCIAL,
     if(pance_empresas.activo = 0, 'Inactiva','Activa') AS ACTIVO,
     if(pance_empresas.regimen = 1, 'Comun', 'Simplificado') AS REGIMEN,
     pance_terceros.documento_identidad AS TERCERO
     FROM pance_empresas, pance_terceros
     WHERE pance_empresas.id_tercero = pance_terceros.id;
    
     CREATE OR REPLACE VIEW pance_buscador_empresas AS SELECT pance_empresas.id AS id, 
     pance_empresas.codigo AS codigo, pance_empresas.razon_social AS razon_social, pance_empresas.nombre_corto AS nombre_corto, 
     CONCAT(IF(pance_terceros.primer_nombre IS NOT NULL,pance_terceros.primer_nombre,''),' ',
     IF(pance_terceros.segundo_nombre IS NOT NULL,pance_terceros.segundo_nombre,''),' ',
     IF(pance_terceros.primer_apellido IS NOT NULL,pance_terceros.primer_apellido,''),' ',
     IF(pance_terceros.segundo_apellido IS NOT NULL,pance_terceros.segundo_apellido,''),' ',
     IF(pance_terceros.razon_social IS NOT NULL,pance_terceros.razon_social,'')) AS nombre_completo
     FROM pance_empresas, pance_terceros 
     WHERE pance_empresas.id_tercero = pance_terceros.id;
     
     CREATE OR REPLACE VIEW pance_seleccion_empresas AS
     SELECT pance_empresas.id AS id,
     CONCAT(pance_empresas.razon_social,'|', pance_empresas.id) AS nombre
     FROM pance_empresas
     ORDER BY pance_empresas.razon_social ASC;
***/
?>
