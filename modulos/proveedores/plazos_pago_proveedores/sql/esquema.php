<?php

/**
*
* Copyright (C) 2020 Raul Mauricio Oidor Lozano
* Raul Mauricio Oidor Lozano <ozzymauricio75@gmail.com>
*
* Este archivo es parte de:
* PANCE :: Plataforma para la Administración del Nexo Cliente-Empresa
*
* Este programa es software libre: usted puede redistribuirlo y/o
* modificarlo  bajo los términos de la Licencia Pública General GNU
* publicada por la Fundación para el Software Libre, ya sea la versión 3
* de la Licencia, o (a su elección) cualquier versión posterior.
*|
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

$borrarSiempre   = false;

$tablas["plazos_pago_proveedores"] = array(
    "id"		    => "SMALLINT(3) UNSIGNED ZEROFILL AUTO_INCREMENT NOT NULL COMMENT 'Consecutivo interno para la base de datos'",
    "nombre"		=> "VARCHAR(15) NOT NULL COMMENT 'Nombre de la forma de pago a credito asignado por el usuario'",
    "descripcion"	=> "VARCHAR(255) NOT NULL COMMENT 'Descripcion de la forma de pago a credito'",
    "periodo"		=> "SMALLINT(2) UNSIGNED NOT NULL COMMENT 'Periodicidad de dias para los pagos dentro del intervalo inicial-final'",
    "inicial"		=> "enum('1','30','60','90','120','150','180','210','240','270') NOT NULL default '1' COMMENT 'Plazo para pago inicial(dias): 1,30,60,90,120,150,180,210,240,270'",
    "final"		=> "enum('1','30','60','90','120','150','180','210','240','270') NOT NULL default '1' COMMENT 'Plazo para pago final(dias): 1,30,60,90,120,150,180,210,240,270'"
);

/*** Definición de llaves primarias ***/
$llavesPrimarias["plazos_pago_proveedores"] = "id";

/*** Definición de llaves unicas ***/
$llavesUnicas["plazos_pago_proveedores"] =  array(
    "nombre"
);

/*** Inserción de datos iniciales***/
$registros["componentes"] = array(
    array(
        "id"        => "GESTPPPR",
        "padre"     => "SUBMDCPV",
        "id_modulo" => "PROVEEDORES",
        "visible"   => "1",
        "orden"     => "3000",
        "carpeta"   => "plazos_pago_proveedores",
        "archivo"   => "menu"
    ),
    array(
        "id"        => "ADICPPPR",
        "padre"     => "GESTPPPR",
        "id_modulo" => "PROVEEDORES",
        "visible"   => "0",
        "orden"     => "0025",
        "carpeta"   => "plazos_pago_proveedores",
        "archivo"   => "adicionar"
    ),
    array(
        "id"        => "CONSPPPR",
        "padre"     => "GESTPPPR",
        "id_modulo" => "PROVEEDORES",
        "visible"   => "0",
        "orden"     => "0010",
        "carpeta"   => "plazos_pago_proveedores",
        "archivo"   => "consultar"
    ),
    array(
        "id"        => "MODIPPPR",
        "padre"     => "GESTPPPR",
        "id_modulo" => "PROVEEDORES",
        "visible"   => "0",
        "orden"     => "0015",
        "carpeta"   => "plazos_pago_proveedores",
        "archivo"   => "modificar"
    ),
    array(
        "id"        => "ELIMPPPR",
        "padre"     => "GESTPPPR",
        "id_modulo" => "PROVEEDORES",
        "visible"   => "0",
        "orden"     => "0020",
        "carpeta"   => "plazos_pago_proveedores",
        "archivo"   => "eliminar"
    )    
);

  
/***
    CREATE OR REPLACE VIEW pance_menu_plazos_pago_provedores
    AS 
      SELECT 
	    pance_plazos_pago_proveedores.id AS id, 
	    pance_plazos_pago_proveedores.nombre AS NOMBRE,
	    pance_plazos_pago_proveedores.inicial AS INICIAL,
	    pance_plazos_pago_proveedores.final AS FINAL,
	    pance_plazos_pago_proveedores.periodo AS PERIODO
      FROM 
	    pance_plazos_pago_proveedores
      WHERE
	    pance_plazos_pago_proveedores.id != '0';
      
   CREATE OR REPLACE VIEW pance_buscador_plazos_pago_proveedores
    AS 
      SELECT 
	    pance_plazos_pago_proveedores.id AS id,
	    pance_plazos_pago_proveedores.nombre AS nombre,
	    pance_plazos_pago_proveedores.inicial AS inicial,
	    pance_plazos_pago_proveedores.final AS final
      FROM 
	    pance_plazos_pago_proveedores
      WHERE
	    pance_plazos_pago_proveedores.id != '0';
*/
?>

