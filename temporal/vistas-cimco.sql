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
CREATE OR REPLACE VIEW pance_menu_actas AS SELECT pance_registro_obras.id AS id, 
     CASE pance_registro_obras.tipo_acta WHEN '1' THEN 'Inicio'
     WHEN '2' THEN 'Avance obra' 
     WHEN '3' THEN 'Finalización' END AS TIPO_ACTA,
     pance_registro_obras.fecha_entrega_acta AS FECHA_ENTREGA_ACTA,
     pance_registro_obras.valor_facturar AS VALOR_FACTURAR,
     IF(pance_registro_obras.factura_consorciado = '0', 'No realizada', 'Realizada') AS FACTURA_CONSORCIADO,
     IF(pance_registro_obras.pago_cliente = '0', 'Pendiente', 'Pagada') AS PAGO_CLIENTE,
     IF(pance_registro_obras.pago_consorciado = '0', 'Pendiente', 'Pagada') AS PAGO_CONSORCIADO,
     pance_registro_obras.porcentaje_mano_obra AS PORCENTAJE_MANO_OBRA,
     pance_registro_obras.porcentaje_materiales AS PORCENTAJE_MATERIALES
     FROM pance_registro_obras, pance_cotizaciones, pance_requerimientos_clientes
     WHERE pance_registro_obras.id_cotizacion = pance_cotizaciones.id AND pance_registro_obras.id_requerimiento = pance_requerimientos_clientes.id;
               
     CREATE OR REPLACE VIEW pance_buscador_actas AS SELECT pance_registro_obras.id AS id, 
     pance_registro_obras.fecha_entrega_acta AS FECHA_ENTREGA_ACTA,
     pance_registro_obras.valor_facturar AS VALOR_FACTURAR,
     IF(pance_registro_obras.factura_consorciado = '0', 'No realizada', 'Realizada') AS FACTURA_CONSORCIADO,
     IF(pance_registro_obras.pago_cliente = '0', 'Pendiente', 'Pagada') AS PAGO_CLIENTE,
     IF(pance_registro_obras.pago_consorciado = '0', 'Pendiente', 'Pagada') AS PAGO_CONSORCIADO,
     pance_registro_obras.porcentaje_mano_obra AS PORCENTAJE_MANO_OBRA,
     pance_registro_obras.porcentaje_materiales AS PORCENTAJE_MATERIALES
     FROM pance_registro_obras, pance_cotizaciones, pance_requerimientos_clientes
     WHERE pance_registro_obras.id_cotizacion = pance_cotizaciones.id AND pance_registro_obras.id_requerimiento = pance_requerimientos_clientes.id;
CREATE OR REPLACE VIEW pance_menu_clientes AS
     SELECT pance_terceros.id AS id,
     pance_terceros.documento_identidad AS DOCUMENTO_CLIENTE,
     CONCAT(IF(pance_terceros.primer_nombre IS NOT NULL,pance_terceros.primer_nombre,''),' ',
     IF(pance_terceros.segundo_nombre IS NOT NULL,pance_terceros.segundo_nombre,''),' ',
     IF(pance_terceros.primer_apellido IS NOT NULL,pance_terceros.primer_apellido,''),' ',
     IF(pance_terceros.segundo_apellido IS NOT NULL,pance_terceros.segundo_apellido,''),' ',
     IF(pance_terceros.razon_social IS NOT NULL,pance_terceros.razon_social,'')) AS CLIENTE
     FROM pance_terceros WHERE pance_terceros.cliente = '1';

 
     CREATE OR REPLACE VIEW pance_buscador_clientes AS SELECT pance_terceros.id AS id,
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
     WHERE pance_terceros.cliente = '1';
     
    CREATE OR REPLACE VIEW pance_seleccion_clientes AS
    SELECT pance_terceros.id AS id,
    CONCAT(
    pance_terceros.documento_identidad, '-',
    if(pance_terceros.primer_nombre is not null, pance_terceros.primer_nombre, ''), ' ',
    if(pance_terceros.segundo_nombre is not null, pance_terceros.segundo_nombre, ''), ' ',
    if(pance_terceros.primer_apellido is not null, pance_terceros.primer_apellido, ''), ' ',
    if(pance_terceros.segundo_apellido is not null, pance_terceros.segundo_apellido, ''), ' ',
    if(pance_terceros.razon_social is not null, pance_terceros.razon_social, ''), '|',
    pance_terceros.id) AS nombre
    FROM pance_terceros
    WHERE pance_terceros.cliente = '1'
    ORDER BY pance_terceros.primer_nombre ASC;
CREATE OR REPLACE VIEW pance_menu_cotizaciones AS SELECT pance_cotizaciones.id AS id, 
     CONCAT(pance_cotizaciones.numero_cotizacion,'-',pance_cotizaciones.consecutivo_cotizacion) AS NUMERO_COTIZACION,
     pance_cotizaciones.numero_cotizacion_consorciado AS NUMERO_COTIZACION_CONSORCIADO,
     pance_sedes_clientes.nombre_sede AS SEDE,
     pance_municipios.nombre AS MUNICIPIO,
     pance_sucursales.nombre AS SUCURSAL,
     pance_requerimientos_clientes.fecha_ingreso AS FECHA_INGRESO,
     pance_requerimientos_clientes.descripcion AS DESCRIPCION,
     pance_requerimientos_clientes.nombre_contacto AS CONTACTO,
     CASE pance_cotizaciones.estado WHEN '1' THEN 'Pendiente'
     WHEN  '2' THEN 'Aprobada' 
     WHEN '3' THEN 'Anulada'
     WHEN '4' THEN 'Recotizada'
     WHEN '5' THEN 'Reemplazada' 
     WHEN '6' THEN 'Cotizada' END AS ESTADO
     FROM pance_requerimientos_clientes, pance_sedes_clientes, pance_municipios, pance_cotizaciones, pance_sucursales
     WHERE pance_cotizaciones.id_requerimiento = pance_requerimientos_clientes.id AND pance_requerimientos_clientes.id_sede = pance_sedes_clientes.id
     AND pance_requerimientos_clientes.id_sucursal = pance_sucursales.id AND pance_municipios.id = pance_sedes_clientes.id_municipios;
               
     CREATE OR REPLACE VIEW pance_buscador_cotizaciones AS SELECT pance_cotizaciones.id AS id, 
     CONCAT(pance_cotizaciones.numero_cotizacion,'-',pance_cotizaciones.consecutivo_cotizacion) AS numero_cotizacion,
     pance_cotizaciones.numero_cotizacion_consorciado AS numero_cotizacion_consorciado,
     pance_requerimientos_clientes.fecha_ingreso AS fecha_ingreso,
     pance_requerimientos_clientes.id_sede AS id_sede,
     pance_sedes_clientes.nombre_sede AS nombre_sede,
     pance_municipios.nombre AS municipio,
     pance_requerimientos_clientes.id_sucursal AS sucursal,
     CASE pance_requerimientos_clientes.tipo_solicitud WHEN 'M' THEN 'Mantenimiento'
     WHEN  'E' THEN 'Emergencia' 
     WHEN 'S' THEN 'Servicio por demanda'
     WHEN 'P' THEN 'Proyecto' END AS tipo_solicitud,
     pance_requerimientos_clientes.descripcion AS descripcion,
     pance_requerimientos_clientes.nombre_contacto AS contacto,
     IF(pance_cotizaciones.forma_pago = '0', 'Pago parcial', 'Contra-entrega') AS forma_pago,
     CASE pance_cotizaciones.estado WHEN '1' THEN 'Pendiente'
     WHEN '2' THEN 'Aprobada' 
     WHEN '3' THEN 'Anulada'
     WHEN '4' THEN 'Recotizada'
     WHEN '5' THEN 'Reemplazada' 
     WHEN '6' THEN 'Cotizada' END AS estado  
     FROM pance_requerimientos_clientes, pance_sedes_clientes, pance_sucursales, pance_cotizaciones, pance_municipios
     WHERE pance_cotizaciones.id_requerimiento = pance_requerimientos_clientes.id AND pance_requerimientos_clientes.id_sede = pance_sedes_clientes.id
     AND pance_requerimientos_clientes.id_sucursal = pance_sucursales.id AND pance_municipios.id = pance_sedes_clientes.id_municipios;
CREATE OR REPLACE VIEW pance_menu_registro_ingresos AS SELECT pance_requerimientos_clientes.id AS id, 
     pance_requerimientos_clientes.fecha_ingreso AS FECHA_INGRESO,
     pance_cotizaciones.numero_cotizacion AS NUMERO_COTIZACION,
     pance_requerimientos_clientes.descripcion AS DESCRIPCION
     FROM pance_requerimientos_clientes, pance_cotizaciones;
     
     CREATE OR REPLACE VIEW pance_seleccion_registro_ingresos AS SELECT pance_requerimientos_clientes.id AS id, 
     pance_cotizaciones.numero_cotizacion AS NUMERO_COTIZACION,
     pance_requerimientos_clientes.descripcion AS DESCRIPCION,
     pance_registro_ingresos.fecha_concepto AS FECHA_CONCEPTO,
     IF(pance_registro_ingresos.concepto = '1', 'Ingreso', 'Egreso') AS CONCEPTO,
     pance_registro_ingresos.valor_concepto AS VALOR_CONCEPTO
     FROM pance_requerimientos_clientes, pance_registro_ingresos, pance_cotizaciones
     WHERE pance_registro_ingresos.id_requerimiento = pance_requerimientos_clientes.id;
 CREATE OR REPLACE VIEW pance_menu_registro_obras AS SELECT pance_cotizaciones.id AS id, 
     pance_requerimientos_clientes.fecha_ingreso AS FECHA_INGRESO,
     pance_sedes_clientes.nombre_sede AS SEDE,
     pance_municipios.nombre AS MUNICIPIO,
     pance_requerimientos_clientes.descripcion AS DESCRIPCION,
     pance_sucursales.nombre AS SUCURSAL,
     CASE pance_requerimientos_clientes.tipo_solicitud WHEN 'M' THEN 'Mantenimiento'
     WHEN 'E' THEN 'Emergencia' 
     WHEN 'S' THEN 'Servicio por demanda'
     WHEN 'P' THEN 'Proyecto' 
     WHEN 'V' THEN 'Visita' END AS TIPO_SOLICITUD
     FROM pance_requerimientos_clientes, pance_sedes_clientes, pance_sucursales, pance_municipios, pance_cotizaciones
     WHERE pance_requerimientos_clientes.id_sede = pance_sedes_clientes.id AND pance_requerimientos_clientes.id_sucursal = pance_sucursales.id
     AND pance_sedes_clientes.id_municipios = pance_municipios.id AND pance_requerimientos_clientes.estado_aprobacion_requerimiento = '1' 
     AND pance_requerimientos_clientes.id = pance_cotizaciones.id_requerimiento AND pance_cotizaciones.estado = '2';
               
     CREATE OR REPLACE VIEW pance_buscador_registro_obras AS SELECT pance_cotizaciones.id AS id, 
     pance_requerimientos_clientes.fecha_ingreso AS fecha_ingreso,
     pance_requerimientos_clientes.id_sede AS id_sede,
     pance_sedes_clientes.nombre_sede AS nombre_sede,
     pance_sedes_clientes.id_municipios AS municipio,
     pance_requerimientos_clientes.id_sucursal AS sucursal,
     pance_registro_obras.valor_facturar,
     CASE pance_requerimientos_clientes.tipo_solicitud WHEN 'M' THEN 'Mantenimiento'
     WHEN  'E' THEN 'Emergencia' 
     WHEN 'S' THEN 'Servicio por demanda'
     WHEN 'P' THEN 'Proyecto' 
     WHEN 'V' THEN 'Visita' END AS tipo_solicitud,
     pance_requerimientos_clientes.descripcion AS descripcion
     FROM pance_requerimientos_clientes, pance_sedes_clientes, pance_sucursales, pance_cotizaciones, pance_municipios, pance_registro_obras
     WHERE pance_cotizaciones.id_requerimiento = pance_requerimientos_clientes.id AND pance_requerimientos_clientes.id_sede = pance_sedes_clientes.id
     AND pance_requerimientos_clientes.id_sucursal = pance_sucursales.id AND pance_municipios.id = pance_sedes_clientes.id_municipios;
CREATE OR REPLACE VIEW pance_menu_reporte_visitas AS SELECT pance_requerimientos_clientes.id AS id, 
     pance_requerimientos_clientes.fecha_ingreso AS FECHA_INGRESO,
     pance_sedes_clientes.nombre_sede AS SEDE,
     pance_municipios.nombre AS MUNICIPIO,
     pance_requerimientos_clientes.descripcion AS DESCRIPCION,
     pance_sucursales.nombre AS SUCURSAL,
     CASE pance_requerimientos_clientes.tipo_solicitud WHEN 'M' THEN 'Mantenimiento'
     WHEN 'E' THEN 'Emergencia' 
     WHEN 'S' THEN 'Servicio por demanda'
     WHEN 'P' THEN 'Proyecto' 
     WHEN 'V' THEN 'Visita' END AS TIPO_SOLICITUD,
     IF(pance_requerimientos_clientes.notificado = '0', 'No', 'Si') AS NOTIFICADO,
     CASE pance_requerimientos_clientes.estado_cotizacion WHEN '1' THEN 'Pendiente'
     WHEN '2' THEN 'Aprobada' 
     WHEN '3' THEN 'Anulada'
     WHEN '4' THEN 'Recotizar' 
     WHEN '5' THEN 'Reemplazada' 
     WHEN '6' THEN 'No cotizada'
     WHEN '7' THEN 'No requiere' END AS ESTADO_COTIZACION
     FROM pance_requerimientos_clientes, pance_sedes_clientes, pance_sucursales, pance_municipios
     WHERE pance_requerimientos_clientes.id_sede = pance_sedes_clientes.id AND pance_requerimientos_clientes.id_sucursal = pance_sucursales.id
     AND pance_sedes_clientes.id_municipios = pance_municipios.id 
     AND pance_requerimientos_clientes.notificado = '1' AND pance_requerimientos_clientes.estado_aprobacion_requerimiento = '0' 
     AND pance_requerimientos_clientes.estado_cotizacion != '7'
     ORDER BY pance_requerimientos_clientes.fecha_ingreso DESC;
     
     
     CREATE OR REPLACE VIEW pance_buscador_reporte_visitas AS SELECT pance_requerimientos_clientes.id AS id, 
     pance_requerimientos_clientes.fecha_ingreso AS fecha_ingreso,
     pance_sedes_clientes.nombre_sede AS nombre_sede,
     pance_municipios.nombre AS municipio,
     pance_requerimientos_clientes.id_sucursal AS sucursal,
     CASE pance_requerimientos_clientes.tipo_solicitud WHEN 'M' THEN 'Mantenimiento'
     WHEN  'E' THEN 'Emergencia' 
     WHEN 'S' THEN 'Servicio por demanda'
     WHEN 'P' THEN 'Proyecto'
     WHEN 'V' THEN 'Visita' END AS tipo_solicitud,
     pance_requerimientos_clientes.descripcion AS descripcion,
     pance_requerimientos_clientes.nombre_contacto AS contacto,
     IF(pance_requerimientos_clientes.notificado = '0', 'No notificado', 'Notificado') AS NOTIFICADO
     FROM pance_requerimientos_clientes, pance_sedes_clientes, pance_sucursales, pance_municipios
     WHERE pance_requerimientos_clientes.id_sede = pance_sedes_clientes.id 
     AND pance_sedes_clientes.id_sucursal = pance_sucursales.id AND pance_sedes_clientes.id_municipios = pance_municipios.id
     AND pance_requerimientos_clientes.estado_cotizacion != '7';
CREATE OR REPLACE VIEW pance_menu_requerimientos_clientes AS SELECT pance_requerimientos_clientes.id AS id, 
     pance_requerimientos_clientes.fecha_ingreso AS FECHA_INGRESO,
     pance_sedes_clientes.nombre_sede AS SEDE,
     pance_municipios.nombre AS MUNICIPIO,
     pance_requerimientos_clientes.descripcion AS DESCRIPCION,
     pance_sucursales.nombre AS SUCURSAL,
     CASE pance_requerimientos_clientes.tipo_solicitud WHEN 'M' THEN 'Mantenimiento'
     WHEN 'E' THEN 'Emergencia' 
     WHEN 'S' THEN 'Servicio por demanda'
     WHEN 'P' THEN 'Proyecto' 
     WHEN 'V' THEN 'Visita' END AS TIPO_SOLICITUD,
     IF(pance_requerimientos_clientes.notificado = '0', 'No', 'Si') AS NOTIFICADO,
     CASE pance_requerimientos_clientes.estado_cotizacion WHEN '1' THEN 'Pendiente'
     WHEN '2' THEN 'Aprobada' 
     WHEN '3' THEN 'Anulada'
     WHEN '4' THEN 'Recotizar' 
     WHEN '5' THEN 'Reemplazada' 
     WHEN '6' THEN 'No cotizada'
     WHEN '7' THEN 'No requiere' END AS ESTADO_COTIZACION
     FROM pance_requerimientos_clientes, pance_sedes_clientes, pance_sucursales, pance_municipios
     WHERE pance_requerimientos_clientes.id_sede = pance_sedes_clientes.id AND pance_requerimientos_clientes.id_sucursal = pance_sucursales.id
     AND pance_sedes_clientes.id_municipios = pance_municipios.id ORDER BY pance_requerimientos_clientes.fecha_ingreso DESC;

     CREATE OR REPLACE VIEW pance_buscador_requerimientos_clientes AS SELECT pance_requerimientos_clientes.id AS id, 
     pance_sedes_clientes.nombre_sede AS nombre_sede,     
     pance_sucursales.nombre AS sucursal,
     pance_municipios.nombre AS municipio,
     CASE pance_requerimientos_clientes.tipo_solicitud WHEN 'M' THEN 'Mantenimiento'
     WHEN  'E' THEN 'Emergencia' 
     WHEN 'S' THEN 'Servicio por demanda'
     WHEN 'P' THEN 'Proyecto' 
     WHEN 'V' THEN 'Visita' END AS tipo_solicitud,
     CASE pance_requerimientos_clientes.estado_cotizacion WHEN '1' THEN 'Pendiente'
     WHEN '2' THEN 'Aprobada'
     WHEN '3' THEN 'Anulada'
     WHEN '4' THEN 'Recotizar'
     WHEN '5' THEN 'Reemplazada'
     WHEN '6' THEN 'No cotizada'
     WHEN '7' THEN 'No requiere' END AS estado_cotizacion,
     pance_requerimientos_clientes.nombre_contacto AS contacto
     FROM pance_requerimientos_clientes, pance_sedes_clientes, pance_sucursales, pance_municipios
     WHERE pance_requerimientos_clientes.id_sede = pance_sedes_clientes.id AND pance_requerimientos_clientes.id_sucursal = pance_sucursales.id 
     AND pance_sedes_clientes.id_municipios = pance_municipios.id;
     
     CREATE OR REPLACE VIEW pance_seleccion_requerimientos_clientes AS SELECT pance_requerimientos_clientes.id AS id, 
     pance_sedes_clientes.nombre_sede AS nombre_sede,     
     pance_sucursales.nombre AS sucursal,
     CASE pance_requerimientos_clientes.tipo_solicitud WHEN 'M' THEN 'Mantenimiento'
     WHEN  'E' THEN 'Emergencia' 
     WHEN 'S' THEN 'Servicio por demanda'
     WHEN 'P' THEN 'Proyecto' 
     WHEN 'V' THEN 'Visita' END AS tipo_solicitud
     FROM pance_requerimientos_clientes, pance_sedes_clientes, pance_sucursales
     WHERE pance_requerimientos_clientes.id_sede = pance_sedes_clientes.id AND pance_requerimientos_clientes.id_sucursal = pance_sucursales.id;
CREATE OR REPLACE VIEW pance_menu_sedes_clientes AS
     SELECT pance_sedes_clientes.id AS id, 
     CONCAT(
     IF(pance_terceros.primer_nombre is not null, pance_terceros.primer_nombre,''), ' ',
     IF(pance_terceros.segundo_nombre is not null, pance_terceros.segundo_nombre,''), ' ',
     IF(pance_terceros.primer_apellido is not null, pance_terceros.primer_apellido,''), ' ',
     IF(pance_terceros.segundo_apellido is not null, pance_terceros.segundo_apellido,''), ' ',
     IF(pance_terceros.razon_social is not null, pance_terceros.razon_social, '')) AS CLIENTE,
     pance_sucursales.nombre AS CONSORCIADO,
     pance_sedes_clientes.nombre_sede AS SEDE,
     pance_sedes_clientes.nombre_contacto AS CONTACTO,
     pance_sedes_clientes.correo AS CORREO_ELECTRONICO
     FROM pance_sedes_clientes, pance_terceros, pance_sucursales 
     WHERE pance_sedes_clientes.id_cliente = pance_terceros.id AND pance_sedes_clientes.id_sucursal = pance_sucursales.id;

     CREATE OR REPLACE VIEW pance_buscador_sedes_clientes AS SELECT pance_sedes_clientes.id AS id, 
     CONCAT(
     IF(pance_terceros.primer_nombre is not null, pance_terceros.primer_nombre,''), ' ',
     IF(pance_terceros.segundo_nombre is not null, pance_terceros.segundo_nombre,''), ' ',
     IF(pance_terceros.primer_apellido is not null, pance_terceros.primer_apellido,''), ' ',
     IF(pance_terceros.segundo_apellido is not null, pance_terceros.segundo_apellido,''), ' ',
     IF(pance_terceros.razon_social is not null, pance_terceros.razon_social, '')) AS id_cliente,
     IF(pance_sucursales.nombre is not null, pance_sucursales.nombre,'') AS id_sucursal,
     pance_sedes_clientes.nombre_sede AS nombre_sede, 
     pance_sedes_clientes.nombre_contacto AS nombre_contacto, 
     pance_sedes_clientes.id_municipios AS id_municipios,
     pance_sedes_clientes.direccion AS direccion,
     pance_sedes_clientes.telefono_principal AS telefono_principal,
     pance_sedes_clientes.celular AS celular, 
     pance_sedes_clientes.correo AS correo
     FROM pance_sedes_clientes, pance_sucursales, pance_terceros, pance_municipios
     WHERE pance_terceros.id = pance_sedes_clientes.id_cliente AND pance_sedes_clientes.id_sucursal = pance_sucursales.id;
     
     CREATE OR REPLACE VIEW pance_seleccion_sedes_clientes AS SELECT
     pance_sedes_clientes.id AS id,
     pance_sedes_clientes.nombre_sede AS nombre_sede,
     CONCAT(
        IF(pance_terceros.primer_nombre is not null, pance_terceros.primer_nombre,''), ' ',
        IF(pance_terceros.segundo_nombre is not null, pance_terceros.segundo_nombre,''), ' ',
        IF(pance_terceros.primer_apellido is not null, pance_terceros.primer_apellido,''), ' ',
        IF(pance_terceros.segundo_apellido is not null, pance_terceros.segundo_apellido,''), ' ',
        IF(pance_terceros.razon_social is not null, pance_terceros.razon_social, ''),'|',
        pance_sedes_clientes.id
     ) AS id_cliente
     FROM pance_sedes_clientes, pance_terceros
     WHERE pance_terceros.id = pance_sedes_clientes.id_cliente;         
     
