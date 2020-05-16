CREATE OR REPLACE VIEW pance_menu_usuarios AS SELECT id AS id, usuario AS USUARIO, nombre AS NOMBRE FROM pance_usuarios;
CREATE OR REPLACE VIEW pance_menu_terceros AS
     SELECT pance_terceros.id AS id,
     pance_terceros.documento_identidad AS DOCUMENTO_IDENTIDAD,
     pance_terceros.primer_nombre AS PRIMER_NOMBRE,
     pance_terceros.segundo_nombre AS SEGUNDO_NOMBRE,
     pance_terceros.primer_apellido AS PRIMER_APELLIDO,
     pance_terceros.segundo_apellido AS SEGUNDO_APELLIDO,
     CONCAT(pance_terceros.primer_nombre,' ',pance_terceros.segundo_nombre,' ',pance_terceros.primer_apellido,' ',pance_terceros.segundo_apellido)
     AS NOMBRE_COMPLETO
     FROM pance_terceros;
CREATE OR REPLACE VIEW pance_menu_actividades_economicas AS
SELECT id AS id,
codigo_DIAN AS CODIGO_DIAN,
codigo_interno AS CODIGO_INTERNO,
descripcion AS DESCRIPCION
FROM pance_actividades_economicas;
CREATE OR REPLACE VIEW pance_buscador_actividades_economicas AS
SELECT id AS id,
codigo_DIAN AS codigo_DIAN,
codigo_interno AS codigo_interno,
descripcion AS descripcion
FROM pance_actividades_economicas;
CREATE OR REPLACE VIEW pance_menu_barrios AS
    SELECT pance_localidades.id AS id,
    pance_localidades.nombre AS NOMBRE, pance_municipios.nombre AS MUNICIPIO,  pance_departamentos.nombre AS DEPARTAMENTO, pance_paises.nombre AS PAIS
    FROM pance_localidades, pance_municipios, pance_departamentos, pance_paises
    WHERE pance_localidades.id_municipio = pance_municipios.id AND  pance_municipios.id_departamento = pance_departamentos.id AND
    pance_departamentos.id_pais = pance_paises.id AND pance_localidades.tipo = 'B';

    CREATE OR REPLACE VIEW pance_buscador_barrios AS
    SELECT pance_localidades.id AS id,
    pance_localidades.codigo_municipal AS codigo_municipal, pance_localidades.nombre AS nombre, pance_localidades.codigo_interno AS codigo_interno,
    pance_localidades.comuna AS comuna, pance_localidades.estrato AS estrato, pance_municipios.nombre AS municipio,
    pance_departamentos.nombre AS departamento, pance_paises.nombre AS pais
    FROM pance_localidades, pance_municipios, pance_departamentos, pance_paises
    WHERE pance_localidades.id_municipio = pance_municipios.id AND  pance_municipios.id_departamento = pance_departamentos.id AND
    pance_departamentos.id_pais = pance_paises.id AND pance_localidades.tipo = 'B';

CREATE OR REPLACE VIEW pance_seleccion_localidades AS
    SELECT pance_localidades.id AS id,
    CONCAT(pance_localidades.nombre, ', ', pance_municipios.nombre, ', ', pance_departamentos.nombre, ', ',pance_paises.nombre, '|', pance_localidades.id) AS nombre
    FROM pance_localidades, pance_municipios, pance_departamentos, pance_paises
    WHERE pance_localidades.id_municipio = pance_municipios.id AND pance_municipios.id_departamento = pance_departamentos.id AND pance_departamentos.id_pais = pance_paises.id
    ORDER BY pance_municipios.nombre ASC;
CREATE OR REPLACE VIEW pance_menu_conexiones AS
    SELECT pance_conexiones.id AS id, DATE_FORMAT(pance_conexiones.fecha, '%Y/%m/%d') AS FECHA, DATE_FORMAT(pance_conexiones.fecha, '%r') AS HORA,
    pance_usuarios.nombre AS USUARIO, pance_conexiones.ip AS IP, pance_conexiones.proxy AS PROXY, pance_conexiones.fecha AS id_fecha
    FROM pance_usuarios, pance_conexiones
    WHERE pance_conexiones.id_usuario = pance_usuarios.id;

    CREATE OR REPLACE VIEW pance_buscador_conexiones AS
    SELECT pance_conexiones.id AS id, pance_conexiones.fecha AS FECHA, pance_usuarios.nombre AS USUARIO,
    pance_conexiones.ip AS IP, pance_conexiones.proxy AS PROXY
    FROM pance_usuarios, pance_conexiones
    WHERE pance_conexiones.id_usuario = pance_usuarios.id;

    CREATE OR REPLACE VIEW pance_consulta_bitacora AS
    SELECT id_conexion AS id, DATE_FORMAT(fecha, '%Y/%m/%d') AS FECHA, DATE_FORMAT(fecha, '%r') AS HORA,
    componente AS COMPONENTE, consulta AS CONSULTA, mensaje AS MENSAJE
    FROM pance_bitacora;
CREATE OR REPLACE VIEW pance_menu_bodegas AS
     SELECT pance_bodegas.id AS id,
     pance_bodegas.codigo AS CODIGO,
     pance_bodegas.nombre AS NOMBRE,
     pance_bodegas.descripcion AS DESCRIPCION,
     pance_sucursales.nombre AS SUCURSAL
     FROM pance_bodegas, pance_sucursales
     WHERE
     pance_bodegas.id_sucursal = pance_sucursales.id;

     CREATE OR REPLACE VIEW pance_buscador_bodegas AS SELECT pance_bodegas.id AS id,
     pance_bodegas.codigo AS codigo, pance_bodegas.id_sucursal AS codigo_sucursal, pance_bodegas.nombre AS nombre,
     pance_bodegas.descripcion AS descripcion, pance_bodegas.tipo_bodega AS tipo_bodega, pance_sucursales.nombre AS sucursal
     FROM pance_bodegas, pance_sucursales
     WHERE pance_bodegas.id_sucursal = pance_sucursales.id;
CREATE OR REPLACE VIEW pance_menu_cargos AS
SELECT id AS id,
codigo_interno AS CODIGO,
nombre AS NOMBRE,
if(interno = 0, 'General', 'Interno') AS INTERNO
FROM pance_cargos;

CREATE OR REPLACE VIEW pance_buscador_cargos AS
SELECT id AS id,
codigo_interno AS codigo,
nombre AS nombre,
if(interno = 0, 'General', 'Interno') AS INTERNO
FROM pance_cargos;
CREATE OR REPLACE VIEW pance_menu_corregimientos AS
    SELECT pance_localidades.id AS id,
    pance_localidades.nombre AS NOMBRE, pance_municipios.nombre AS MUNICIPIO,  pance_departamentos.nombre AS DEPARTAMENTO, pance_paises.nombre AS PAIS
    FROM pance_localidades, pance_municipios, pance_departamentos, pance_paises
    WHERE pance_localidades.id_municipio = pance_municipios.id AND  pance_municipios.id_departamento = pance_departamentos.id AND
    pance_departamentos.id_pais = pance_paises.id AND pance_localidades.tipo = 'C';

    CREATE OR REPLACE VIEW pance_buscador_corregimientos AS
    SELECT pance_localidades.id AS id,
    CONCAT(pance_departamentos.codigo_dane,pance_municipios.codigo_dane,pance_localidades.codigo_dane) AS codigo_dane,
    pance_localidades.nombre AS nombre, pance_localidades.codigo_interno AS codigo_interno,
    pance_municipios.nombre AS municipio, pance_departamentos.nombre AS departamento, pance_paises.nombre AS pais
    FROM pance_localidades, pance_municipios, pance_departamentos, pance_paises
    WHERE pance_localidades.id_municipio = pance_municipios.id AND  pance_municipios.id_departamento = pance_departamentos.id AND
    pance_departamentos.id_pais = pance_paises.id AND pance_localidades.tipo = 'C';
CREATE OR REPLACE VIEW pance_menu_departamentos AS
    SELECT pance_departamentos.id AS id,
    pance_departamentos.codigo_dane AS CODIGO_DANE, pance_departamentos.nombre AS NOMBRE, pance_paises.nombre AS PAIS
    FROM pance_departamentos, pance_paises
    WHERE pance_departamentos.id_pais = pance_paises.id;

    CREATE OR REPLACE VIEW pance_buscador_departamentos AS
    SELECT pance_departamentos.id AS id,
    pance_departamentos.codigo_dane AS codigo_dane, pance_departamentos.codigo_interno AS codigo_interno,
    pance_departamentos.nombre AS nombre, pance_paises.nombre AS pais
    FROM pance_departamentos, pance_paises
    WHERE pance_departamentos.id_pais = pance_paises.id;
CREATE OR REPLACE VIEW pance_menu_empresas AS
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
CREATE OR REPLACE VIEW `pance_menu_impresoras` AS
SELECT `id` AS id,
`nombre_cola` AS NOMBRE_COLA,
`descripcion` AS DESCRIPCION
FROM `pance_impresoras`;

CREATE OR REPLACE VIEW `pance_buscador_impresoras` AS
SELECT `id` AS id,
`nombre_cola` AS nombre_cola,
`descripcion` AS descripcion
FROM `pance_impresoras`;
CREATE OR REPLACE VIEW pance_menu_municipios AS
    SELECT pance_municipios.id AS id,
    CONCAT(pance_departamentos.codigo_dane, pance_municipios.codigo_dane) AS CODIGO_DANE,
    pance_municipios.nombre AS NOMBRE, pance_departamentos.nombre AS DEPARTAMENTO, pance_paises.nombre AS PAIS
    FROM pance_municipios, pance_departamentos, pance_paises
    WHERE pance_municipios.id_departamento = pance_departamentos.id AND pance_departamentos.id_pais = pance_paises.id
    ORDER BY NOMBRE ASC;

    CREATE OR REPLACE VIEW pance_buscador_municipios AS
    SELECT pance_municipios.id AS id,
    CONCAT(pance_departamentos.codigo_dane, pance_municipios.codigo_dane) AS codigo_dane, pance_municipios.codigo_interno AS codigo_interno,
    pance_municipios.nombre AS nombre, pance_departamentos.nombre AS departamento, pance_paises.nombre AS pais
    FROM pance_municipios, pance_departamentos, pance_paises
    WHERE pance_municipios.id_departamento = pance_departamentos.id AND pance_departamentos.id_pais = pance_paises.id
    ORDER BY nombre ASC;

    CREATE OR REPLACE VIEW pance_seleccion_municipios AS
    SELECT pance_municipios.id AS id,
    CONCAT(pance_municipios.nombre, ', ', pance_departamentos.nombre, ', ',pance_paises.nombre, '|', pance_municipios.id) AS nombre
    FROM pance_municipios, pance_departamentos, pance_paises
    WHERE pance_municipios.id_departamento = pance_departamentos.id AND pance_departamentos.id_pais = pance_paises.id
    ORDER BY pance_municipios.nombre ASC;
    CREATE OR REPLACE VIEW pance_menu_paises AS SELECT id AS id, codigo_iso AS CODIGO_ISO, nombre AS NOMBRE FROM pance_paises;
    CREATE OR REPLACE VIEW pance_buscador_paises AS SELECT id AS id, codigo_iso, codigo_interno, nombre FROM pance_paises;
CREATE OR REPLACE VIEW pance_menu_perfiles AS
    SELECT pance_perfiles.id AS id, pance_perfiles.codigo AS CODIGO, pance_perfiles.nombre AS NOMBRE
    FROM pance_perfiles;

    CREATE OR REPLACE VIEW pance_buscador_perfiles AS SELECT id AS id, codigo, nombre FROM pance_perfiles;
CREATE OR REPLACE VIEW pance_menu_privilegios AS
    SELECT pance_perfiles_usuario.id AS id, pance_usuarios.nombre AS USUARIO, pance_sucursales.nombre AS SUCURSAL
    FROM pance_perfiles_usuario, pance_usuarios, pance_sucursales
    WHERE pance_perfiles_usuario.id_usuario = pance_usuarios.id AND pance_perfiles_usuario.id_sucursal = pance_sucursales.id;

    CREATE OR REPLACE VIEW pance_buscador_privilegios AS
    SELECT pance_perfiles_usuario.id AS id, pance_usuarios.nombre AS usuario, pance_sucursales.nombre AS sucursal
    FROM pance_perfiles_usuario, pance_usuarios, pance_sucursales
    WHERE pance_perfiles_usuario.id_usuario = pance_usuarios.id AND pance_perfiles_usuario.id_sucursal = pance_sucursales.id;
CREATE OR REPLACE VIEW pance_menu_privilegios AS
    SELECT pance_perfiles_usuario.id AS id, pance_usuarios.nombre AS USUARIO, pance_sucursales.nombre AS SUCURSAL
    FROM pance_perfiles_usuario, pance_usuarios, pance_sucursales
    WHERE pance_perfiles_usuario.id_usuario = pance_usuarios.id AND pance_perfiles_usuario.id_sucursal = pance_sucursales.id;

    CREATE OR REPLACE VIEW pance_buscador_privilegios AS
    SELECT pance_perfiles_usuario.id AS id, pance_usuarios.nombre AS usuario, pance_sucursales.nombre AS sucursal
    FROM pance_perfiles_usuario, pance_usuarios, pance_sucursales
    WHERE pance_perfiles_usuario.id_usuario = pance_usuarios.id AND pance_perfiles_usuario.id_sucursal = pance_sucursales.id;
CREATE OR REPLACE VIEW pance_menu_profesiones_oficios AS
SELECT id AS id,
codigo_DANE AS CODIGO_DANE,
codigo_interno AS CODIGO_INTERNO,
descripcion AS DESCRIPCION
FROM pance_profesiones_oficios;

CREATE OR REPLACE VIEW pance_buscador_profesiones_oficios AS
SELECT id AS id,
descripcion AS descripcion
FROM pance_profesiones_oficios;
CREATE OR REPLACE VIEW pance_menu_secciones AS
     SELECT pance_secciones.id AS id, pance_secciones.codigo AS CODIGO,
     pance_secciones.nombre AS NOMBRE,
     pance_secciones.descripcion AS DESCRIPCION,
     pance_bodegas.nombre AS BODEGA
     FROM pance_secciones, pance_bodegas
     WHERE pance_secciones.id_bodega = pance_bodegas.id;

     CREATE OR REPLACE VIEW pance_buscador_secciones AS SELECT pance_secciones.id AS id,
     pance_secciones.nombre AS nombre, pance_secciones.descripcion AS descripcion, pance_secciones.id_bodega AS codigo_bodega,
     pance_secciones.codigo AS codigo, pance_bodegas.nombre AS bodega
     FROM pance_secciones, pance_bodegas
     WHERE pance_secciones.id_bodega = pance_bodegas.id;
CREATE OR REPLACE VIEW `pance_menu_servidores` AS
SELECT `id` AS id,
`ip` AS IP,
`nombre_netbios` AS NOMBRE_NETBIOS,
`nombre_tcpip` AS NOMBRE_TCPIP
FROM `pance_servidores`;

CREATE OR REPLACE VIEW `pance_buscador_servidores` AS
SELECT `id` AS id,
`ip` AS ip,
`nombre_netbios` AS nombre_netbios,
`nombre_tcpip` AS nombre_tcpip
FROM `pance_servidores`;
CREATE OR REPLACE VIEW pance_menu_sucursales AS
     SELECT pance_sucursales.id AS id,
     pance_sucursales.codigo AS CODIGO,
     pance_sucursales.nombre AS NOMBRE,
     pance_empresas.razon_social AS EMPRESA,
     pance_terceros.documento_identidad AS TERCERO
     FROM pance_sucursales, pance_empresas, pance_terceros
     WHERE pance_sucursales.id_empresa = pance_empresas.id AND pance_empresas.id_tercero = pance_terceros.id;

     CREATE OR REPLACE VIEW pance_buscador_sucursales AS SELECT pance_sucursales.id AS id,
     pance_sucursales.codigo AS codigo, pance_sucursales.nombre AS nombre,
     pance_sucursales.nombre_corto AS nombre_corto,
     pance_empresas.razon_social AS empresa,
     CONCAT(
     if(pance_terceros.primer_nombre is not null, pance_terceros.primer_nombre,''), ' ',
     if(pance_terceros.segundo_nombre is not null, pance_terceros.segundo_nombre,''), ' ',
     if(pance_terceros.primer_apellido is not null, pance_terceros.primer_apellido,''), ' ',
     if(pance_terceros.segundo_apellido is not null, pance_terceros.segundo_apellido,''), ' ',
     if(pance_terceros.razon_social is not null, pance_terceros.razon_social, '')
     ) AS tercero
     FROM pance_sucursales, pance_terceros, pance_empresas
     WHERE pance_sucursales.id_empresa = pance_empresas.id AND
     pance_empresas.id_tercero = pance_terceros.id;

     CREATE OR REPLACE VIEW pance_seleccion_sucursales AS
     SELECT pance_sucursales.id AS id,
     CONCAT(pance_sucursales.nombre,'|', pance_sucursales.id) AS nombre
     FROM pance_sucursales
     ORDER BY pance_sucursales.nombre ASC;
CREATE OR REPLACE VIEW `pance_menu_terminales` AS
SELECT `id`,
`ip` AS IP,
`nombre_netbios` AS NOMBRE_NETBIOS,
`nombre_tcpip` AS NOMBRE_TCPIP
FROM `pance_terminales`;

CREATE OR REPLACE VIEW `pance_buscador_terminales` AS
SELECT `id`,
`ip` AS ip,
`nombre_netbios` AS nombre_netbios,
`nombre_tcpip` AS nombre_tcpip
FROM `pance_terminales`;
CREATE OR REPLACE VIEW pance_menu_tipos_bodegas AS
     SELECT pance_tipos_bodegas.id AS id,
     pance_tipos_bodegas.nombre AS NOMBRE,
     pance_tipos_bodegas.descripcion AS DESCRIPCION
     FROM pance_tipos_bodegas;

     CREATE OR REPLACE VIEW pance_buscador_tipos_bodegas AS SELECT pance_tipos_bodegas.id AS id,
     pance_tipos_bodegas.nombre AS nombre,
     pance_tipos_bodegas.descripcion AS descripcion
     FROM pance_tipos_bodegas;

CREATE OR REPLACE VIEW pance_menu_tipos_documento_identidad AS
SELECT id AS id,
codigo_DIAN AS CODIGO_DIAN,
codigo_interno AS CODIGO_INTERNO,
descripcion AS DESCRIPCION
FROM pance_tipos_documento_identidad;

CREATE OR REPLACE VIEW pance_buscador_tipos_documento_identidad AS
SELECT id AS id,
codigo_DIAN AS codigo_DIAN,
codigo_interno AS codigo_interno,
descripcion AS descripcion
FROM pance_tipos_documento_identidad;
CREATE OR REPLACE VIEW pance_menu_usuarios AS SELECT id AS id, usuario AS USUARIO, nombre AS NOMBRE FROM pance_usuarios;
    CREATE OR REPLACE VIEW pance_buscador_usuarios AS SELECT id AS id, usuario, nombre FROM pance_usuarios;
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
     pance_sedes_clientes.id_municipios AS municipio,
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
CREATE OR REPLACE VIEW pance_menu_registro_obras AS SELECT pance_cotizaciones.id AS id,
     pance_sedes_clientes.nombre_sede AS SEDE,
     pance_sucursales.nombre AS SUCURSAL,
     pance_municipios.nombre AS MUNICIPIO,
     pance_requerimientos_clientes.descripcion AS DESCRIPCION,
     CASE pance_requerimientos_clientes.tipo_solicitud WHEN 'M' THEN 'Mantenimiento'
     WHEN 'E' THEN 'Emergencia'
     WHEN 'S' THEN 'Servicio por demanda'
     WHEN 'P' THEN 'Proyecto' END AS TIPO_SOLICITUD,
     pance_requerimientos_clientes.fecha_ingreso AS FECHA_INGRESO
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
     WHEN 'P' THEN 'Proyecto' END AS tipo_solicitud,
     pance_requerimientos_clientes.descripcion AS descripcion
     FROM pance_requerimientos_clientes, pance_sedes_clientes, pance_sucursales, pance_cotizaciones, pance_municipios, pance_registro_obras
     WHERE pance_cotizaciones.id_requerimiento = pance_requerimientos_clientes.id AND pance_requerimientos_clientes.id_sede = pance_sedes_clientes.id
     AND pance_requerimientos_clientes.id_sucursal = pance_sucursales.id AND pance_municipios.id = pance_sedes_clientes.id_municipios;
CREATE OR REPLACE VIEW pance_menu_reporte_visitas AS SELECT pance_requerimientos_clientes.id AS id,
     pance_sedes_clientes.nombre_sede AS SEDE,
     pance_sucursales.nombre AS SUCURSAL,
     pance_requerimientos_clientes.fecha_ingreso AS FECHA_INGRESO,
     pance_requerimientos_clientes.descripcion AS DESCRIPCION,
     pance_municipios.nombre AS MUNICIPIO
     FROM pance_requerimientos_clientes, pance_sedes_clientes, pance_sucursales, pance_municipios
     WHERE pance_requerimientos_clientes.id_sede = pance_sedes_clientes.id AND pance_requerimientos_clientes.id_sucursal = pance_sucursales.id
     AND pance_requerimientos_clientes.notificado = '1' AND pance_requerimientos_clientes.estado_aprobacion_requerimiento = '0' AND pance_sedes_clientes.id_municipios = pance_municipios.id
     AND pance_requerimientos_clientes.estado_cotizacion != '7';


     CREATE OR REPLACE VIEW pance_buscador_reporte_visitas AS SELECT pance_requerimientos_clientes.id AS id,
     pance_requerimientos_clientes.fecha_ingreso AS fecha_ingreso,
     pance_sedes_clientes.nombre_sede AS nombre_sede,
     pance_sedes_clientes.id_municipios AS municipio,
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
     CASE pance_requerimientos_clientes.tipo_solicitud WHEN 'M' THEN 'Mantenimiento'
     WHEN  'E' THEN 'Emergencia'
     WHEN 'S' THEN 'Servicio por demanda'
     WHEN 'P' THEN 'Proyecto'
     WHEN 'V' THEN 'Visita' END AS tipo_solicitud,
     pance_requerimientos_clientes.nombre_contacto AS contacto
     FROM pance_requerimientos_clientes, pance_sedes_clientes, pance_sucursales
     WHERE pance_requerimientos_clientes.id_sede = pance_sedes_clientes.id AND pance_requerimientos_clientes.id_sucursal = pance_sucursales.id;

CREATE OR REPLACE VIEW pance_buscador_requerimientos_clientes AS SELECT pance_requerimientos_clientes.id AS id,
     pance_sedes_clientes.nombre_sede AS nombre_sede,
     pance_sucursales.nombre AS sucursal,
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
CREATE OR REPLACE VIEW pance_menu_notas AS SELECT `id` , `nota` AS NOTAS FROM `pance_notas` ORDER BY `fecha` ASC;
CREATE OR REPLACE VIEW pance_menu_preferencias_globales  AS
    SELECT id, CODIGO, NOMBRE
    FROM pance_menu_sucursales;
CREATE OR REPLACE VIEW pance_menu_preferencias  AS
    SELECT
	  pance_preferencias.id AS id,
	  IF(pance_preferencias.tipo=1, 'Global', 'Individual') AS TIPO,
	  IF(pance_preferencias.usuario LIKE '',
		'',
		(SELECT pance_usuarios.nombre AS nombre
		FROM pance_usuarios, pance_preferencias
		WHERE pance_preferencias.usuario = pance_usuarios.id
		GROUP BY pance_preferencias.usuario)
	  ) AS USUARIO
    FROM
	  pance_preferencias
    GROUP BY
	  pance_preferencias.usuario;

    CREATE OR REPLACE VIEW pance_buscador_preferencias  AS
    SELECT
	  pance_usuarios.id AS id,
	  IF(pance_preferencias.tipo=1, 'Global', 'Individual') AS TIPO,
	  pance_preferencias.variable AS VARIABLE,
	  pance_preferencias.valor AS VALOR,
	  IF(pance_preferencias.usuario LIKE '',
		'',
		(SELECT pance_usuarios.nombre AS nombre
		FROM pance_usuarios, pance_preferencias
		WHERE pance_preferencias.usuario = pance_usuarios.id
		GROUP BY pance_preferencias.usuario)
	  ) AS USUARIO
    FROM
	  pance_preferencias, pance_usuarios;
