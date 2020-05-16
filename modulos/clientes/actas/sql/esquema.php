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
        "id"        => "GESTACTA",
        "padre"     => "SUBMCOSE",
        "id_modulo" => "CLIENTES",
        "visible"   => "1",
        "orden"     => "0080",
        "carpeta"   => "actas",
        "archivo"   => "menu"
    ),
    array(
        "id"        => "CONSACTA",
        "padre"     => "GESTACTA",
        "id_modulo" => "CLIENTES",
        "visible"   => "0",
        "orden"     => "0005",
        "carpeta"   => "actas",
        "archivo"   => "consultar"
    ),
    array(
        "id"        => "MODIACTA",
        "padre"     => "GESTACTA",
        "id_modulo" => "CLIENTES",
        "visible"   => "0",
        "orden"     => "0010",
        "carpeta"   => "actas",
        "archivo"   => "modificar"
    ),
    array(
        "id"        => "ELIMACTA",
        "padre"     => "GESTACTA",
        "id_modulo" => "CLIENTES",
        "visible"   => "0",
        "orden"     => "0015",
        "carpeta"   => "actas",
        "archivo"   => "eliminar"
    ),
    array(
        "id"        => "NOTIACTA",
        "padre"     => "GESTACTA",
        "id_modulo" => "CLIENTES",
        "visible"   => "0",
        "orden"     => "0020",
        "carpeta"   => "actas",
        "archivo"   => "notificar"
    ),
    array(
        "id"        => "PAGOCLIE",
        "padre"     => "GESTACTA",
        "id_modulo" => "CLIENTES",
        "visible"   => "0",
        "orden"     => "0025",
        "carpeta"   => "actas",
        "archivo"   => "confirmar_cliente"
    ),
    array(
        "id"        => "PAGOCONS",
        "padre"     => "GESTACTA",
        "id_modulo" => "CLIENTES",
        "visible"   => "0",
        "orden"     => "0030",
        "carpeta"   => "actas",
        "archivo"   => "confirmar_consorciado"
    ),
    array(
        "id"        => "REPOACTA",
        "padre"     => "GESTACTA",
        "id_modulo" => "CLIENTES",
        "visible"   => "0",
        "orden"     => "0035",
        "carpeta"   => "actas",
        "archivo"   => "reporte"
    )
);

/*** Sentencia para la creación de la vista requerida ***/
/*** CREATE OR REPLACE VIEW pance_menu_actas AS SELECT pance_registro_obras.id AS id, 
     pance_requerimientos_clientes.id_sucursal AS id_sucursal,
     CONCAT(pance_cotizaciones.numero_cotizacion,'-',pance_cotizaciones.consecutivo_cotizacion) AS NUMERO_COTIZACION,
     CASE pance_registro_obras.tipo_acta WHEN '1' THEN 'Inicio'
     WHEN '2' THEN 'Avance obra' 
     WHEN '3' THEN 'Finalización' 
     WHEN '4' THEN 'Informe' END AS TIPO_ACTA,
     pance_registro_obras.fecha_entrega_acta AS FECHA_ENTREGA_ACTA,
     CONCAT('$ ',FORMAT(pance_registro_obras.valor_facturar, 0)) AS VALOR_FACTURAR,
     IF(pance_registro_obras.factura_consorciado = '0', 'No Enviada', 'Enviada') AS FACTURA_CLIENTE,
     IF(pance_registro_obras.pago_cliente = '0', 'Pendiente', 'Efectuado') AS PAGO_CLIENTE,
     CONCAT('$ ',FORMAT(pance_registro_obras.valor_factura_cliente,0)) AS VALOR_PAGO_CLIENTE,
     IF(pance_registro_obras.pago_consorciado = '0', 'Pendiente', 'Efectuado') AS PAGO_CONSORCIADO,
     CONCAT(
        '$ ',
        FORMAT(
            IF (pance_registro_obras.valor_mano_obra_consorciado IS NOT NULL, pance_registro_obras.valor_mano_obra_consorciado, 0) +
            IF (pance_registro_obras.valor_materiales_consorciado IS NOT NULL, pance_registro_obras.valor_materiales_consorciado, 0) +
            IF (pance_registro_obras.valor_administracion_consorciado IS NOT NULL, pance_registro_obras.valor_administracion_consorciado, 0) + 
            IF (pance_registro_obras.valor_imprevistos_consorciado IS NOT NULL, pance_registro_obras.valor_imprevistos_consorciado, 0) +
            IF (pance_registro_obras.valor_utilidad_consorciado IS NOT NULL, pance_registro_obras.valor_utilidad_consorciado, 0) + 
            IF (pance_registro_obras.valor_iva_consorciado IS NOT NULL, pance_registro_obras.valor_iva_consorciado, 0),
        0)
     ) AS VALOR_PAGO_CONSORCIADO,
     CONCAT(
        '$ ',
        FORMAT(
            IF(pance_registro_obras.valor_mano_obra_administracion IS NOT NULL, pance_registro_obras.valor_mano_obra_administracion, 0) + 
            IF(pance_registro_obras.valor_materiales_administracion IS NOT NULL, pance_registro_obras.valor_materiales_administracion, 0) +
            IF(pance_registro_obras.valor_administracion_administracion IS NOT NULL, pance_registro_obras.valor_administracion_administracion,0) +
            IF(pance_registro_obras.valor_imprevistos_administracion IS NOT NULL, pance_registro_obras.valor_imprevistos_administracion, 0) +
            IF(pance_registro_obras.valor_utilidad_administracion IS NOT NULL, pance_registro_obras.valor_utilidad_administracion, 0) + 
            IF(pance_registro_obras.valor_iva_administracion IS NOT NULL, pance_registro_obras.valor_iva_administracion,0)
            , 0)
     ) AS VALOR_ADMINISTRACION
     FROM pance_registro_obras, pance_cotizaciones, pance_requerimientos_clientes, pance_sucursales
     WHERE pance_registro_obras.id_cotizacion = pance_cotizaciones.id AND pance_requerimientos_clientes.id = pance_cotizaciones.id_requerimiento AND
     pance_requerimientos_clientes.id_sucursal=pance_sucursales.id;
               
     CREATE OR REPLACE VIEW pance_buscador_actas AS SELECT pance_registro_obras.id AS id, 
     pance_sucursales.id AS id_sucursal,
     CONCAT(pance_cotizaciones.numero_cotizacion,'-',pance_cotizaciones.consecutivo_cotizacion) AS NUMERO_COTIZACION,
     CASE pance_registro_obras.tipo_acta WHEN '1' THEN 'Inicio'
     WHEN '2' THEN 'Avance obra' 
     WHEN '3' THEN 'Finalización' 
     WHEN '4' THEN 'Informe' END AS TIPO_ACTA,
     pance_registro_obras.fecha_entrega_acta AS FECHA_ENTREGA_ACTA,
     CONCAT('$ ',FORMAT(pance_registro_obras.valor_facturar, 0)) AS VALOR_FACTURAR,
     IF(pance_registro_obras.factura_consorciado = '0', 'No Enviada', 'Enviada') AS FACTURA_CLIENTE,
     CONCAT('$ ',FORMAT(pance_registro_obras.valor_factura_cliente,0)) AS VALOR_PAGO_CLIENTE,
     IF(pance_registro_obras.pago_consorciado = '0', 'Pendiente', 'Efectuado') AS PAGO_CONSORCIADO
     FROM pance_registro_obras, pance_cotizaciones, pance_requerimientos_clientes, pance_sucursales
     WHERE pance_requerimientos_clientes.id_sucursal=pance_sucursales.id AND 
     pance_registro_obras.id_cotizacion = pance_cotizaciones.id
     AND pance_requerimientos_clientes.id = pance_cotizaciones.id_requerimiento;

***/
?>
