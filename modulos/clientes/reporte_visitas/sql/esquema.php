<?php

/**
*
* Copyright (C) 2009 SAE Ltda
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
    array(
        "id"        => "GESTREVI",
        "padre"     => "SUBMCOSE",
        "id_modulo" => "CLIENTES",
        "visible"   => "1",
        "orden"     => "0050",
        "carpeta"   => "reporte_visitas",
        "archivo"   => "menu"
    ),
    array(
        "id"        => "ADICREVI",
        "padre"     => "GESTREVI",
        "id_modulo" => "CLIENTES",
        "visible"   => "0",
        "orden"     => "0005",
        "carpeta"   => "reporte_visitas",
        "archivo"   => "cotizar"
    ),
    array(
        "id"        => "CONSREVI",
        "padre"     => "GESTREVI",
        "id_modulo" => "CLIENTES",
        "visible"   => "0",
        "orden"     => "0010",
        "carpeta"   => "reporte_visitas",
        "archivo"   => "consultar"
    ),
    array(
        "id"        => "MODIREVI",
        "padre"     => "GESTREVI",
        "id_modulo" => "CLIENTES",
        "visible"   => "0",
        "orden"     => "0015",
        "carpeta"   => "reporte_visitas",
        "archivo"   => "modificar"
    ),
    array(
        "id"        => "ELIMREVI",
        "padre"     => "GESTREVI",
        "id_modulo" => "CLIENTES",
        "visible"   => "0",
        "orden"     => "0020",
        "carpeta"   => "reporte_visitas",
        "archivo"   => "eliminar"
   ),
   array(
        "id"        => "VIOFREVI",
        "padre"     => "GESTREVI",
        "id_modulo" => "CLIENTES",
        "visible"   => "0",
        "orden"     => "0025",
        "carpeta"   => "reporte_visitas",
        "archivo"   => "visitar"
   
   )
);

/*** Sentencia para la creación de la vista requerida ***/
/*** 
CREATE OR REPLACE VIEW pance_menu_reporte_visitas AS SELECT pance_requerimientos_clientes.id AS id, 
     pance_sucursales.id AS id_sucursal,
     pance_requerimientos_clientes.fecha_ingreso AS FECHA_INGRESO,
     pance_requerimientos_clientes.id AS NUMERO_REQUERIMIENTO,
     pance_sedes_clientes.nombre_sede AS SEDE,
     pance_municipios.nombre AS MUNICIPIO,
     pance_requerimientos_clientes.descripcion AS DESCRIPCION,
     pance_sucursales.nombre AS SUCURSAL,
     CASE pance_requerimientos_clientes.tipo_solicitud WHEN 'M' THEN 'Mantenimiento'
     WHEN 'E' THEN 'Emergencia' 
     WHEN 'S' THEN 'Servicio por demanda'
     WHEN 'P' THEN 'Proyecto' 
     WHEN 'V' THEN 'Visita' END AS TIPO_SOLICITUD,
     IF (pance_requerimientos_clientes.estado_requerimiento = '3', "Visitado", 
        IF(pance_requerimientos_clientes.estado_requerimiento = '4',"Cotizado", "Sin visitar")
     ) AS VISITA
     FROM pance_requerimientos_clientes, pance_sedes_clientes, pance_sucursales, pance_municipios
     WHERE 
     pance_requerimientos_clientes.id_sede = pance_sedes_clientes.id 
     AND pance_requerimientos_clientes.id_sucursal = pance_sucursales.id
     AND pance_sedes_clientes.id_municipios = pance_municipios.id 
     AND pance_requerimientos_clientes.notificado = '1' 
     AND (
            pance_requerimientos_clientes.estado_requerimiento = '1' OR
            pance_requerimientos_clientes.estado_requerimiento = '3' OR
            (
                pance_requerimientos_clientes.estado_requerimiento = '4' AND
                (
                    pance_requerimientos_clientes.fecha_visita = '0000-00-00' OR
                    pance_requerimientos_clientes.fecha_visita IS NULL
                )
            )
     ) ORDER BY pance_requerimientos_clientes.fecha_ingreso DESC;
         
     CREATE OR REPLACE VIEW pance_buscador_reporte_visitas AS SELECT pance_requerimientos_clientes.id AS id,
     pance_sucursales.id AS id_sucursal, 
     pance_requerimientos_clientes.id AS numero_requerimiento,
     pance_requerimientos_clientes.fecha_ingreso AS fecha_ingreso,
     pance_sedes_clientes.nombre_sede AS nombre_sede,
     pance_municipios.nombre AS municipio,
     pance_requerimientos_clientes.id_sucursal AS sucursal,
     pance_requerimientos_clientes.descripcion AS descripcion,
     CASE pance_requerimientos_clientes.tipo_solicitud WHEN 'M' THEN 'Mantenimiento'
     WHEN  'E' THEN 'Emergencia' 
     WHEN 'S' THEN 'Servicio por demanda'
     WHEN 'P' THEN 'Proyecto'
     WHEN 'V' THEN 'Visita' END AS tipo_solicitud,
     pance_requerimientos_clientes.nombre_contacto AS contacto,
     IF(pance_requerimientos_clientes.notificado = '0', 'No notificado', 'Notificado') AS NOTIFICADO
     FROM pance_requerimientos_clientes, pance_sedes_clientes, pance_sucursales, pance_municipios
     WHERE 
     pance_requerimientos_clientes.id_sede = pance_sedes_clientes.id 
     AND pance_requerimientos_clientes.id_sucursal = pance_sucursales.id
     AND pance_sedes_clientes.id_municipios = pance_municipios.id 
     AND pance_requerimientos_clientes.notificado = '1' 
     AND (
            pance_requerimientos_clientes.estado_requerimiento = '1' OR
            pance_requerimientos_clientes.estado_requerimiento = '3' OR
            (
                pance_requerimientos_clientes.estado_requerimiento = '4' AND
                (
                    pance_requerimientos_clientes.fecha_visita = '0000-00-00' OR
                    pance_requerimientos_clientes.fecha_visita IS NULL
                )
            )
     );
***/
?>
