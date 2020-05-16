-- MySQL dump 10.11
--
-- Host: localhost    Database: cimco
-- ------------------------------------------------------
-- Server version	5.0.51b-community-nt

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES latin1 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `pance_actividades_economicas`
--

DROP TABLE IF EXISTS `pance_actividades_economicas`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `pance_actividades_economicas` (
  `id` smallint(4) unsigned zerofill NOT NULL auto_increment COMMENT 'Consecutivo interno de la base de datos',
  `codigo_DIAN` smallint(4) unsigned zerofill NOT NULL COMMENT 'CÃƒÂ³digo definido por la DIAN',
  `codigo_interno` smallint(4) unsigned zerofill NOT NULL COMMENT 'CÃƒÂ³digo para uso interno de la empresa',
  `descripcion` varchar(255) NOT NULL default '' COMMENT 'Detalle que describe de la tasa',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `codigo_DIAN` (`codigo_DIAN`),
  UNIQUE KEY `codigo_interno` (`codigo_interno`),
  UNIQUE KEY `descripcion` (`descripcion`)
) ENGINE=InnoDB AUTO_INCREMENT=9002 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `pance_actividades_economicas`
--

LOCK TABLES `pance_actividades_economicas` WRITE;
/*!40000 ALTER TABLE `pance_actividades_economicas` DISABLE KEYS */;
INSERT INTO `pance_actividades_economicas` VALUES (9000,0001,0001,'SERVICIOS'),(9001,9999,9999,'&lt;NO APLICA&gt;');
/*!40000 ALTER TABLE `pance_actividades_economicas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pance_actualizaciones_almacen`
--

DROP TABLE IF EXISTS `pance_actualizaciones_almacen`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `pance_actualizaciones_almacen` (
  `id` int(10) unsigned zerofill NOT NULL auto_increment COMMENT 'Consecutivo interno para la base de datos',
  `fecha` datetime NOT NULL COMMENT 'Fecha y hora en la que se ejecutÃ³ la instrucciÃ³n',
  `instruccion` enum('I','U','D') NOT NULL COMMENT 'Tipo de sentencia SQL originada en el almacÃ©n: I=INSERT, U=UPDATE, D=DELETE',
  `tabla` varchar(255) NOT NULL COMMENT 'Nombre de la tabla en la que se debe ejecutar la instrucciÃ³n',
  `columnas` text NOT NULL COMMENT 'Lista de columnas',
  `valores` text NOT NULL COMMENT 'Lista de valores (datos) de las columnas',
  `id_asignado` int(10) NOT NULL COMMENT 'Consecutivo interno asginado automÃ¡ticamente para la instrucciÃ³n actual',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=148 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `pance_actualizaciones_almacen`
--

LOCK TABLES `pance_actualizaciones_almacen` WRITE;
/*!40000 ALTER TABLE `pance_actualizaciones_almacen` DISABLE KEYS */;
INSERT INTO `pance_actualizaciones_almacen` VALUES (0000000001,'2009-07-13 13:46:35','I','pance_perfiles','codigo,nombre','\\\'1\\\',\\\'GLOBAL\\\'',9000),(0000000002,'2009-07-13 13:47:46','I','pance_tipos_documento_identidad','codigo_DIAN,codigo_interno,descripcion','\\\'1\\\',\\\'1\\\',\\\'CEDULA\\\'',900),(0000000003,'2009-07-13 13:48:01','I','pance_tipos_documento_identidad','codigo_DIAN,codigo_interno,descripcion','\\\'2\\\',\\\'2\\\',\\\'NIT\\\'',901),(0000000004,'2009-07-13 14:03:14','I','pance_actividades_economicas','codigo_DIAN,codigo_interno,descripcion','\\\'1\\\',\\\'1\\\',\\\'SERVICIOS\\\'',9000),(0000000005,'2009-07-13 14:05:29','I','pance_localidades','id_municipio,nombre,codigo_dane,codigo_interno,tipo','\\\'00001002\\\',\\\'CALI\\\',\\\'01\\\',\\\'1\\\',\\\'C\\\'',90000000),(0000000006,'2009-07-13 14:08:19','I','pance_terceros','documento_identidad,tipo_persona,id_tipo_documento,razon_social,nombre_comercial,id_municipio_documento,id_municipio_residencia,direccion_principal','\\\'1234\\\',\\\'2\\\',\\\'901\\\',\\\'CIMCO\\\',\\\'CIMCO\\\',\\\'00001002\\\',\\\'90000000\\\',\\\'PASOANCHO\\\'',90000000),(0000000007,'2009-07-13 14:08:20','I','pance_empresas','codigo,razon_social,nombre_corto,activo,id_tercero,id_actividad_principal,id_actividad_secundaria,regimen,retiene_fuente,autoretenedor,retiene_iva,retiene_ica,gran_contribuyente','\\\'1\\\',\\\'CONSORCIO CIMCO\\\',\\\'CIMCO\\\',\\\'1\\\',\\\'90000000\\\',\\\'9000\\\',\\\'9000\\\',\\\'1\\\',\\\'0\\\',\\\'0\\\',\\\'0\\\',\\\'0\\\',\\\'0\\\'',900),(0000000008,'2009-07-13 14:09:28','I','pance_sucursales','codigo,id_empresa,nombre,nombre_corto,activo,id_municipio,direccion_residencia,telefono_1','\\\'1\\\',\\\'900\\\',\\\'ALMACEN\\\',\\\'ALM CIMCO\\\',\\\'1\\\',\\\'00001002\\\',\\\'PASOANCHO\\\',\\\'1234567\\\'',90000),(0000000009,'2009-07-13 14:09:59','I','pance_perfiles_usuario','id_usuario,id_sucursal,id_perfil','\\\'0001\\\',\\\'90000\\\',\\\'9000\\\'',90000000),(0000000010,'2009-07-13 14:13:28','I','pance_componentes_usuario','id_perfil,id_componente','\\\'90000000\\\',\\\'GESTAGEN\\\'',90000000),(0000000011,'2009-07-13 14:13:28','I','pance_componentes_usuario','id_perfil,id_componente','\\\'90000000\\\',\\\'ADICAGEN\\\'',90000001),(0000000012,'2009-07-13 14:13:28','I','pance_componentes_usuario','id_perfil,id_componente','\\\'90000000\\\',\\\'CONSAGEN\\\'',90000002),(0000000013,'2009-07-13 14:13:29','I','pance_componentes_usuario','id_perfil,id_componente','\\\'90000000\\\',\\\'MODIAGEN\\\'',90000003),(0000000014,'2009-07-13 14:13:29','I','pance_componentes_usuario','id_perfil,id_componente','\\\'90000000\\\',\\\'ELIMAGEN\\\'',90000004),(0000000015,'2009-07-13 14:13:29','I','pance_componentes_usuario','id_perfil,id_componente','\\\'90000000\\\',\\\'GESTNOTA\\\'',90000005),(0000000016,'2009-07-13 14:13:29','I','pance_componentes_usuario','id_perfil,id_componente','\\\'90000000\\\',\\\'ADICNOTA\\\'',90000006),(0000000017,'2009-07-13 14:13:29','I','pance_componentes_usuario','id_perfil,id_componente','\\\'90000000\\\',\\\'CONSNOTA\\\'',90000007),(0000000018,'2009-07-13 14:13:30','I','pance_componentes_usuario','id_perfil,id_componente','\\\'90000000\\\',\\\'MODINOTA\\\'',90000008),(0000000019,'2009-07-13 14:13:30','I','pance_componentes_usuario','id_perfil,id_componente','\\\'90000000\\\',\\\'ELIMNOTA\\\'',90000009),(0000000020,'2009-07-13 14:13:30','I','pance_componentes_usuario','id_perfil,id_componente','\\\'90000000\\\',\\\'MENUCLIE\\\'',90000010),(0000000021,'2009-07-13 14:13:31','I','pance_componentes_usuario','id_perfil,id_componente','\\\'90000000\\\',\\\'SUBMCOSE\\\'',90000011),(0000000022,'2009-07-13 14:13:31','I','pance_componentes_usuario','id_perfil,id_componente','\\\'90000000\\\',\\\'GESTCLIE\\\'',90000012),(0000000023,'2009-07-13 14:13:31','I','pance_componentes_usuario','id_perfil,id_componente','\\\'90000000\\\',\\\'GESTSEDE\\\'',90000013),(0000000024,'2009-07-13 14:13:31','I','pance_componentes_usuario','id_perfil,id_componente','\\\'90000000\\\',\\\'ADICSEDE\\\'',90000014),(0000000025,'2009-07-13 14:13:32','I','pance_componentes_usuario','id_perfil,id_componente','\\\'90000000\\\',\\\'CONSSEDE\\\'',90000015),(0000000026,'2009-07-13 14:13:32','I','pance_componentes_usuario','id_perfil,id_componente','\\\'90000000\\\',\\\'MODISEDE\\\'',90000016),(0000000027,'2009-07-13 14:13:32','I','pance_componentes_usuario','id_perfil,id_componente','\\\'90000000\\\',\\\'ELIMSEDE\\\'',90000017),(0000000028,'2009-07-13 14:13:32','I','pance_componentes_usuario','id_perfil,id_componente','\\\'90000000\\\',\\\'GESTRECL\\\'',90000018),(0000000029,'2009-07-13 14:13:33','I','pance_componentes_usuario','id_perfil,id_componente','\\\'90000000\\\',\\\'ADICRECL\\\'',90000019),(0000000030,'2009-07-13 14:13:33','I','pance_componentes_usuario','id_perfil,id_componente','\\\'90000000\\\',\\\'CONSRECL\\\'',90000020),(0000000031,'2009-07-13 14:13:33','I','pance_componentes_usuario','id_perfil,id_componente','\\\'90000000\\\',\\\'MODIRECL\\\'',90000021),(0000000032,'2009-07-13 14:13:34','I','pance_componentes_usuario','id_perfil,id_componente','\\\'90000000\\\',\\\'ELIMRECL\\\'',90000022),(0000000033,'2009-07-13 14:13:34','I','pance_componentes_usuario','id_perfil,id_componente','\\\'90000000\\\',\\\'GESTCOCL\\\'',90000023),(0000000034,'2009-07-13 14:13:34','I','pance_componentes_usuario','id_perfil,id_componente','\\\'90000000\\\',\\\'ADICCOTI\\\'',90000024),(0000000035,'2009-07-13 14:13:35','I','pance_componentes_usuario','id_perfil,id_componente','\\\'90000000\\\',\\\'CONSCOTI\\\'',90000025),(0000000036,'2009-07-13 14:13:35','I','pance_componentes_usuario','id_perfil,id_componente','\\\'90000000\\\',\\\'MODICOTI\\\'',90000026),(0000000037,'2009-07-13 14:13:35','I','pance_componentes_usuario','id_perfil,id_componente','\\\'90000000\\\',\\\'ELIMCOTI\\\'',90000027),(0000000038,'2009-07-13 14:13:35','I','pance_componentes_usuario','id_perfil,id_componente','\\\'90000000\\\',\\\'GESTAPCO\\\'',90000028),(0000000039,'2009-07-13 14:13:36','I','pance_componentes_usuario','id_perfil,id_componente','\\\'90000000\\\',\\\'ADICAPCO\\\'',90000029),(0000000040,'2009-07-13 14:13:36','I','pance_componentes_usuario','id_perfil,id_componente','\\\'90000000\\\',\\\'CONSAPCO\\\'',90000030),(0000000041,'2009-07-13 14:13:37','I','pance_componentes_usuario','id_perfil,id_componente','\\\'90000000\\\',\\\'MODIAPCO\\\'',90000031),(0000000042,'2009-07-13 14:13:38','I','pance_componentes_usuario','id_perfil,id_componente','\\\'90000000\\\',\\\'ELIMAPCO\\\'',90000032),(0000000043,'2009-07-13 14:13:38','I','pance_componentes_usuario','id_perfil,id_componente','\\\'90000000\\\',\\\'MENUADMI\\\'',90000033),(0000000044,'2009-07-13 14:13:38','I','pance_componentes_usuario','id_perfil,id_componente','\\\'90000000\\\',\\\'SUBMESTC\\\'',90000034),(0000000045,'2009-07-13 14:13:38','I','pance_componentes_usuario','id_perfil,id_componente','\\\'90000000\\\',\\\'GESTEMPR\\\'',90000035),(0000000046,'2009-07-13 14:13:39','I','pance_componentes_usuario','id_perfil,id_componente','\\\'90000000\\\',\\\'ADICEMPR\\\'',90000036),(0000000047,'2009-07-13 14:13:39','I','pance_componentes_usuario','id_perfil,id_componente','\\\'90000000\\\',\\\'CONSEMPR\\\'',90000037),(0000000048,'2009-07-13 14:13:40','I','pance_componentes_usuario','id_perfil,id_componente','\\\'90000000\\\',\\\'MODIEMPR\\\'',90000038),(0000000049,'2009-07-13 14:13:40','I','pance_componentes_usuario','id_perfil,id_componente','\\\'90000000\\\',\\\'ELIMEMPR\\\'',90000039),(0000000050,'2009-07-13 14:13:41','I','pance_componentes_usuario','id_perfil,id_componente','\\\'90000000\\\',\\\'GESTSUCU\\\'',90000040),(0000000051,'2009-07-13 14:13:41','I','pance_componentes_usuario','id_perfil,id_componente','\\\'90000000\\\',\\\'ADICSUCU\\\'',90000041),(0000000052,'2009-07-13 14:13:41','I','pance_componentes_usuario','id_perfil,id_componente','\\\'90000000\\\',\\\'CONSSUCU\\\'',90000042),(0000000053,'2009-07-13 14:13:42','I','pance_componentes_usuario','id_perfil,id_componente','\\\'90000000\\\',\\\'MODISUCU\\\'',90000043),(0000000054,'2009-07-13 14:13:42','I','pance_componentes_usuario','id_perfil,id_componente','\\\'90000000\\\',\\\'ELIMSUCU\\\'',90000044),(0000000055,'2009-07-13 14:13:43','I','pance_componentes_usuario','id_perfil,id_componente','\\\'90000000\\\',\\\'GESTBODE\\\'',90000045),(0000000056,'2009-07-13 14:13:44','I','pance_componentes_usuario','id_perfil,id_componente','\\\'90000000\\\',\\\'ADICBODE\\\'',90000046),(0000000057,'2009-07-13 14:13:45','I','pance_componentes_usuario','id_perfil,id_componente','\\\'90000000\\\',\\\'CONSBODE\\\'',90000047),(0000000058,'2009-07-13 14:13:46','I','pance_componentes_usuario','id_perfil,id_componente','\\\'90000000\\\',\\\'MODIBODE\\\'',90000048),(0000000059,'2009-07-13 14:13:47','I','pance_componentes_usuario','id_perfil,id_componente','\\\'90000000\\\',\\\'ELIMBODE\\\'',90000049),(0000000060,'2009-07-13 14:13:47','I','pance_componentes_usuario','id_perfil,id_componente','\\\'90000000\\\',\\\'GESTSECC\\\'',90000050),(0000000061,'2009-07-13 14:13:50','I','pance_componentes_usuario','id_perfil,id_componente','\\\'90000000\\\',\\\'ADICSECC\\\'',90000051),(0000000062,'2009-07-13 14:13:52','I','pance_componentes_usuario','id_perfil,id_componente','\\\'90000000\\\',\\\'CONSSECC\\\'',90000052),(0000000063,'2009-07-13 14:13:53','I','pance_componentes_usuario','id_perfil,id_componente','\\\'90000000\\\',\\\'MODISECC\\\'',90000053),(0000000064,'2009-07-13 14:13:55','I','pance_componentes_usuario','id_perfil,id_componente','\\\'90000000\\\',\\\'ELIMSECC\\\'',90000054),(0000000065,'2009-07-13 14:13:56','I','pance_componentes_usuario','id_perfil,id_componente','\\\'90000000\\\',\\\'SUBMACCE\\\'',90000055),(0000000066,'2009-07-13 14:14:18','I','pance_componentes_usuario','id_perfil,id_componente','\\\'90000000\\\',\\\'GESTAGEN\\\'',90000000),(0000000067,'2009-07-13 14:14:18','I','pance_componentes_usuario','id_perfil,id_componente','\\\'90000000\\\',\\\'ADICAGEN\\\'',90000001),(0000000068,'2009-07-13 14:14:18','I','pance_componentes_usuario','id_perfil,id_componente','\\\'90000000\\\',\\\'CONSAGEN\\\'',90000002),(0000000069,'2009-07-13 14:14:19','I','pance_componentes_usuario','id_perfil,id_componente','\\\'90000000\\\',\\\'MODIAGEN\\\'',90000003),(0000000070,'2009-07-13 14:14:19','I','pance_componentes_usuario','id_perfil,id_componente','\\\'90000000\\\',\\\'ELIMAGEN\\\'',90000004),(0000000071,'2009-07-13 14:14:19','I','pance_componentes_usuario','id_perfil,id_componente','\\\'90000000\\\',\\\'GESTNOTA\\\'',90000005),(0000000072,'2009-07-13 14:14:20','I','pance_componentes_usuario','id_perfil,id_componente','\\\'90000000\\\',\\\'ADICNOTA\\\'',90000006),(0000000073,'2009-07-13 14:14:20','I','pance_componentes_usuario','id_perfil,id_componente','\\\'90000000\\\',\\\'CONSNOTA\\\'',90000007),(0000000074,'2009-07-13 14:14:20','I','pance_componentes_usuario','id_perfil,id_componente','\\\'90000000\\\',\\\'MODINOTA\\\'',90000008),(0000000075,'2009-07-13 14:14:21','I','pance_componentes_usuario','id_perfil,id_componente','\\\'90000000\\\',\\\'ELIMNOTA\\\'',90000009),(0000000076,'2009-07-13 14:14:21','I','pance_componentes_usuario','id_perfil,id_componente','\\\'90000000\\\',\\\'MENUCLIE\\\'',90000010),(0000000077,'2009-07-13 14:14:22','I','pance_componentes_usuario','id_perfil,id_componente','\\\'90000000\\\',\\\'SUBMCOSE\\\'',90000011),(0000000078,'2009-07-13 14:14:23','I','pance_componentes_usuario','id_perfil,id_componente','\\\'90000000\\\',\\\'GESTCLIE\\\'',90000012),(0000000079,'2009-07-13 14:14:24','I','pance_componentes_usuario','id_perfil,id_componente','\\\'90000000\\\',\\\'GESTSEDE\\\'',90000013),(0000000080,'2009-07-13 14:14:25','I','pance_componentes_usuario','id_perfil,id_componente','\\\'90000000\\\',\\\'ADICSEDE\\\'',90000014),(0000000081,'2009-07-13 14:14:26','I','pance_componentes_usuario','id_perfil,id_componente','\\\'90000000\\\',\\\'CONSSEDE\\\'',90000015),(0000000082,'2009-07-13 14:14:27','I','pance_componentes_usuario','id_perfil,id_componente','\\\'90000000\\\',\\\'MODISEDE\\\'',90000016),(0000000083,'2009-07-13 14:14:28','I','pance_componentes_usuario','id_perfil,id_componente','\\\'90000000\\\',\\\'ELIMSEDE\\\'',90000017),(0000000084,'2009-07-13 14:14:30','I','pance_componentes_usuario','id_perfil,id_componente','\\\'90000000\\\',\\\'GESTRECL\\\'',90000018),(0000000085,'2009-07-13 14:14:31','I','pance_componentes_usuario','id_perfil,id_componente','\\\'90000000\\\',\\\'ADICRECL\\\'',90000019),(0000000086,'2009-07-13 14:14:32','I','pance_componentes_usuario','id_perfil,id_componente','\\\'90000000\\\',\\\'CONSRECL\\\'',90000020),(0000000087,'2009-07-13 14:14:32','I','pance_componentes_usuario','id_perfil,id_componente','\\\'90000000\\\',\\\'MODIRECL\\\'',90000021),(0000000088,'2009-07-13 14:14:33','I','pance_componentes_usuario','id_perfil,id_componente','\\\'90000000\\\',\\\'ELIMRECL\\\'',90000022),(0000000089,'2009-07-13 14:14:34','I','pance_componentes_usuario','id_perfil,id_componente','\\\'90000000\\\',\\\'GESTCOCL\\\'',90000023),(0000000090,'2009-07-13 14:14:34','I','pance_componentes_usuario','id_perfil,id_componente','\\\'90000000\\\',\\\'ADICCOTI\\\'',90000024),(0000000091,'2009-07-13 14:14:34','I','pance_componentes_usuario','id_perfil,id_componente','\\\'90000000\\\',\\\'CONSCOTI\\\'',90000025),(0000000092,'2009-07-13 14:14:35','I','pance_componentes_usuario','id_perfil,id_componente','\\\'90000000\\\',\\\'MODICOTI\\\'',90000026),(0000000093,'2009-07-13 14:14:36','I','pance_componentes_usuario','id_perfil,id_componente','\\\'90000000\\\',\\\'ELIMCOTI\\\'',90000027),(0000000094,'2009-07-13 14:14:36','I','pance_componentes_usuario','id_perfil,id_componente','\\\'90000000\\\',\\\'GESTAPCO\\\'',90000028),(0000000095,'2009-07-13 14:14:37','I','pance_componentes_usuario','id_perfil,id_componente','\\\'90000000\\\',\\\'ADICAPCO\\\'',90000029),(0000000096,'2009-07-13 14:14:37','I','pance_componentes_usuario','id_perfil,id_componente','\\\'90000000\\\',\\\'CONSAPCO\\\'',90000030),(0000000097,'2009-07-13 14:14:38','I','pance_componentes_usuario','id_perfil,id_componente','\\\'90000000\\\',\\\'MODIAPCO\\\'',90000031),(0000000098,'2009-07-13 14:14:39','I','pance_componentes_usuario','id_perfil,id_componente','\\\'90000000\\\',\\\'ELIMAPCO\\\'',90000032),(0000000099,'2009-07-13 14:14:41','I','pance_componentes_usuario','id_perfil,id_componente','\\\'90000000\\\',\\\'MENUADMI\\\'',90000033),(0000000100,'2009-07-13 14:14:42','I','pance_componentes_usuario','id_perfil,id_componente','\\\'90000000\\\',\\\'SUBMESTC\\\'',90000034),(0000000101,'2009-07-13 14:14:42','I','pance_componentes_usuario','id_perfil,id_componente','\\\'90000000\\\',\\\'GESTEMPR\\\'',90000035),(0000000102,'2009-07-13 14:14:43','I','pance_componentes_usuario','id_perfil,id_componente','\\\'90000000\\\',\\\'ADICEMPR\\\'',90000036),(0000000103,'2009-07-13 14:14:43','I','pance_componentes_usuario','id_perfil,id_componente','\\\'90000000\\\',\\\'CONSEMPR\\\'',90000037),(0000000104,'2009-07-13 14:14:44','I','pance_componentes_usuario','id_perfil,id_componente','\\\'90000000\\\',\\\'MODIEMPR\\\'',90000038),(0000000105,'2009-07-13 14:14:44','I','pance_componentes_usuario','id_perfil,id_componente','\\\'90000000\\\',\\\'ELIMEMPR\\\'',90000039),(0000000106,'2009-07-13 14:14:45','I','pance_componentes_usuario','id_perfil,id_componente','\\\'90000000\\\',\\\'GESTSUCU\\\'',90000040),(0000000107,'2009-07-13 14:14:45','I','pance_componentes_usuario','id_perfil,id_componente','\\\'90000000\\\',\\\'ADICSUCU\\\'',90000041),(0000000108,'2009-07-13 14:14:46','I','pance_componentes_usuario','id_perfil,id_componente','\\\'90000000\\\',\\\'CONSSUCU\\\'',90000042),(0000000109,'2009-07-13 14:14:46','I','pance_componentes_usuario','id_perfil,id_componente','\\\'90000000\\\',\\\'MODISUCU\\\'',90000043),(0000000110,'2009-07-13 14:14:47','I','pance_componentes_usuario','id_perfil,id_componente','\\\'90000000\\\',\\\'ELIMSUCU\\\'',90000044),(0000000111,'2009-07-13 23:08:20','I','pance_cargos','codigo_interno,nombre,interno','\\\'999\\\',\\\'&amp;lt; No aplica &amp;gt;\\\',\\\'0\\\'',900),(0000000112,'2009-07-13 23:47:02','I','pance_terceros','documento_identidad,tipo_persona,id_tipo_documento,primer_nombre,segundo_nombre,primer_apellido,segundo_apellido,nombre_comercial,fecha_ingreso,id_municipio_documento,id_municipio_residencia,direccion_principal,telefono_principal,cliente','\\\'94072403\\\',\\\'1\\\',\\\'900\\\',\\\'Walter\\\',\\\'Andrés\\\',\\\'Márquez\\\',\\\'Gutiérrez\\\',\\\'Sae ltda\\\',\\\'2009-07-13\\\',\\\'00001002\\\',\\\'90000000\\\',\\\'7 de agosto\\\',\\\'1234567\\\',\\\'1\\\'',90000001),(0000000113,'2009-07-14 07:31:38','U','pance_terceros','documento_identidad,tipo_persona,id_tipo_documento,primer_nombre,segundo_nombre,primer_apellido,segundo_apellido,razon_social,nombre_comercial,genero,fecha_ingreso,id_municipio_documento,id_municipio_residencia,direccion_principal,telefono_principal,fax,celular,correo,sitio_web','\'94072403\',\'1\',\'900\',\'Walter\',\'Andrés\',\'Márquez\',\'Gutiérrez\',NULL,\'Sae ltda\',\'N\',\'2009-07-13\',\'00001002\',\'90000000\',\'7 de agosto\',\'1234567\',\'7654321\',\'3153153103000\',NULL,NULL',90000001),(0000000114,'2009-07-14 15:05:11','D','pance_terceros','','',90000001),(0000000115,'2009-07-14 15:05:40','D','pance_sucursales','','',90000),(0000000116,'2009-07-14 15:05:53','D','pance_empresas','','',900),(0000000117,'2009-07-14 15:05:53','D','pance_terceros','','',900),(0000000118,'2009-07-14 15:09:30','I','pance_terceros','documento_identidad,tipo_persona,id_tipo_documento,razon_social,nombre_comercial,id_municipio_documento,id_municipio_residencia,direccion_principal,telefono_principal,celular','\\\'891200487\\\',\\\'2\\\',\\\'901\\\',\\\'INGENIERIA DE DISE;O Y CONSTRUCCIONES ELECTRICAS INCOEL LTDA\\\',\\\'INCOEL LTDA\\\',\\\'00001002\\\',\\\'90000000\\\',\\\'CALLE 13 No 66Bis 57 Oficina 227\\\',\\\'6783532\\\',\\\'312\\\'',90000000),(0000000119,'2009-07-14 15:09:30','I','pance_empresas','codigo,razon_social,nombre_corto,activo,id_tercero,id_actividad_principal,id_actividad_secundaria,regimen,retiene_fuente,autoretenedor,retiene_iva,retiene_ica,gran_contribuyente','\\\'1\\\',\\\'INGENIERIA DE DISE;O Y CONSTRUCCIONES ELECTRICAS INCOEL LTDA\\\',\\\'INCOEL\\\',\\\'1\\\',\\\'90000000\\\',\\\'9000\\\',\\\'9000\\\',\\\'1\\\',\\\'1\\\',\\\'0\\\',\\\'1\\\',\\\'1\\\',\\\'0\\\'',900),(0000000120,'2009-07-14 15:11:55','I','pance_localidades','id_municipio,nombre,tipo','\\\'00000513\\\',\\\'Mosquera\\\',\\\'B\\\'',90000001),(0000000121,'2009-07-14 15:12:55','I','pance_terceros','documento_identidad,tipo_persona,id_tipo_documento,razon_social,nombre_comercial,id_municipio_documento,id_municipio_residencia,direccion_principal,telefono_principal','\\\'900092131\\\',\\\'2\\\',\\\'901\\\',\\\'EMPRESA ANDINA DE INGENIERIA S.A.\\\',\\\'ANDINA\\\',\\\'00000513\\\',\\\'90000001\\\',\\\'CARRERA 3C No 20-06\\\',\\\'8948484\\\'',90000001),(0000000122,'2009-07-14 15:12:56','I','pance_empresas','codigo,razon_social,nombre_corto,activo,id_tercero,id_actividad_principal,id_actividad_secundaria,regimen,retiene_fuente,autoretenedor,retiene_iva,retiene_ica,gran_contribuyente','\\\'2\\\',\\\'EMPRESA ANDINA DE INGENIERIA S.A.\\\',\\\'ANDINA\\\',\\\'1\\\',\\\'90000001\\\',\\\'9000\\\',\\\'9000\\\',\\\'1\\\',\\\'1\\\',\\\'0\\\',\\\'1\\\',\\\'1\\\',\\\'0\\\'',901),(0000000123,'2009-07-14 15:17:06','I','pance_localidades','id_municipio,nombre,tipo','\\\'00000427\\\',\\\'Montería\\\',\\\'B\\\'',90000002),(0000000124,'2009-07-14 15:18:56','I','pance_actividades_economicas','codigo_DIAN,codigo_interno,descripcion','\\\'9999\\\',\\\'9999\\\',\\\'&amp;lt;NO APLICA&amp;gt;\\\'',9001),(0000000125,'2009-07-14 15:19:35','I','pance_terceros','documento_identidad,tipo_persona,id_tipo_documento,razon_social,nombre_comercial,id_municipio_documento,id_municipio_residencia,direccion_principal,telefono_principal','\\\'812000053\\\',\\\'2\\\',\\\'901\\\',\\\'INGENIEROS ELECTRICOS DE CORDOBA LTDA\\\',\\\'INGELCOR LTDA\\\',\\\'00000427\\\',\\\'90000002\\\',\\\'CALLE 61 No. 7-52\\\',\\\'7854745\\\'',90000002),(0000000126,'2009-07-14 15:19:36','I','pance_empresas','codigo,razon_social,nombre_corto,activo,id_tercero,id_actividad_principal,id_actividad_secundaria,regimen,retiene_fuente,autoretenedor,retiene_iva,retiene_ica,gran_contribuyente','\\\'3\\\',\\\'INGENIEROS ELECTRICOS DE CORDOBA LTDA\\\',\\\'INGELCOR\\\',\\\'1\\\',\\\'90000002\\\',\\\'9000\\\',\\\'9000\\\',\\\'1\\\',\\\'1\\\',\\\'0\\\',\\\'0\\\',\\\'1\\\',\\\'0\\\'',902),(0000000127,'2009-07-14 15:24:09','I','pance_terceros','documento_identidad,tipo_persona,id_tipo_documento,razon_social,nombre_comercial,id_municipio_documento,id_municipio_residencia,direccion_principal,telefono_principal','\\\'900192661\\\',\\\'2\\\',\\\'901\\\',\\\'ENERGIA ELECTRICA Y CONSTRUCCIONES LTDA\\\',\\\'ENERCON LTDA\\\',\\\'00000829\\\',\\\'90000000\\\',\\\'CARRERA 12 CALLE 19 C.CIAL FIDUCENTRO LOCAL F207\\\',\\\'3354801\\\'',90000003),(0000000128,'2009-07-14 15:24:09','I','pance_empresas','codigo,razon_social,nombre_corto,activo,id_tercero,id_actividad_principal,id_actividad_secundaria,regimen,retiene_fuente,autoretenedor,retiene_iva,retiene_ica,gran_contribuyente','\\\'4\\\',\\\'ENERGIA ELECTRICA Y CONSTRUCCIONES LTDA\\\',\\\'ENERCON\\\',\\\'1\\\',\\\'90000003\\\',\\\'9000\\\',\\\'9001\\\',\\\'1\\\',\\\'1\\\',\\\'0\\\',\\\'0\\\',\\\'1\\\',\\\'0\\\'',903),(0000000129,'2009-07-14 15:28:31','I','pance_sucursales','codigo,id_empresa,nombre,nombre_corto,activo,id_municipio,direccion_residencia,telefono_1','\\\'1\\\',\\\'901\\\',\\\'ANDINA\\\',\\\'ANDINA\\\',\\\'1\\\',\\\'00000513\\\',\\\'CARRERA 3 C No. 20-06\\\',\\\'8948484\\\'',90000),(0000000130,'2009-07-14 15:29:57','I','pance_sucursales','codigo,id_empresa,nombre,nombre_corto,activo,id_municipio,direccion_residencia,telefono_1','\\\'4\\\',\\\'903\\\',\\\'ENERCON\\\',\\\'ENERCON\\\',\\\'1\\\',\\\'00000829\\\',\\\'CARRERA 12 CALLE 19 C.CIAL FIDUCENTRO LOCAL F207\\\',\\\'3354801\\\'',90001),(0000000131,'2009-07-14 15:30:14','U','pance_sucursales','codigo,id_empresa,nombre,nombre_corto,activo,id_municipio,direccion_residencia,telefono_1,telefono_2,celular','\\\'002\\\',\\\'901\\\',\\\'ANDINA\\\',\\\'ANDINA\\\',\\\'1\\\',\\\'00513\\\',\\\'CARRERA 3 C No. 20-06\\\',\\\'8948484\\\',NULL,NULL',90000),(0000000132,'2009-07-14 15:31:22','I','pance_sucursales','codigo,id_empresa,nombre,nombre_corto,activo,id_municipio,direccion_residencia,telefono_1','\\\'1\\\',\\\'900\\\',\\\'INCOEL LTDA\\\',\\\'INCOEL\\\',\\\'1\\\',\\\'00001002\\\',\\\'CALLE 13 No. 66 BIS - 57 C.CIAL LA FONTANA OF 227\\\',\\\'6783532\\\'',90002),(0000000133,'2009-07-14 15:32:16','I','pance_sucursales','codigo,id_empresa,nombre,nombre_corto,activo,id_municipio,direccion_residencia,telefono_1','\\\'3\\\',\\\'902\\\',\\\'INGELCOR LTDA\\\',\\\'INGELCOR\\\',\\\'1\\\',\\\'00000427\\\',\\\'CALLE 61 No. 7 - 52\\\',\\\'7854745\\\'',90003),(0000000134,'2009-07-14 15:32:34','U','pance_sucursales','codigo,id_empresa,nombre,nombre_corto,activo,id_municipio,direccion_residencia,telefono_1,telefono_2,celular','\\\'002\\\',\\\'901\\\',\\\'ANDINA S.A.\\\',\\\'ANDINA\\\',\\\'1\\\',\\\'00513\\\',\\\'CARRERA 3 C No. 20-06\\\',\\\'8948484\\\',NULL,NULL',90000),(0000000135,'2009-07-14 15:32:47','U','pance_sucursales','codigo,id_empresa,nombre,nombre_corto,activo,id_municipio,direccion_residencia,telefono_1,telefono_2,celular','\\\'004\\\',\\\'903\\\',\\\'ENERCON LTDA\\\',\\\'ENERCON\\\',\\\'1\\\',\\\'00829\\\',\\\'CARRERA 12 CALLE 19 C.CIAL FIDUCENTRO LOCAL F207\\\',\\\'3354801\\\',NULL,NULL',90001),(0000000136,'2009-07-14 15:36:43','I','pance_terceros','documento_identidad,tipo_persona,id_tipo_documento,razon_social,nombre_comercial,fecha_ingreso,id_municipio_documento,id_municipio_residencia,direccion_principal,telefono_principal,cliente','\\\'860005224\\\',\\\'2\\\',\\\'901\\\',\\\'BAVARIA S.A.\\\',\\\'BAVARIA S.A.\\\',\\\'2009-02-01\\\',\\\'00000149\\\',\\\'90000151\\\',\\\'CALLE 94 No. 7A - 47\\\',\\\'4249000\\\',\\\'1\\\'',90000004),(0000000137,'2009-07-14 15:46:33','I','pance_terceros','documento_identidad,tipo_persona,id_tipo_documento,razon_social,nombre_comercial,fecha_ingreso,id_municipio_documento,id_municipio_residencia,direccion_principal,telefono_principal,cliente','\\\'900136638\\\',\\\'2\\\',\\\'901\\\',\\\'CERVECERIA DEL VALLE S.A.\\\',\\\'CERVALLE\\\',\\\'2009-02-01\\\',\\\'00001042\\\',\\\'90001044\\\',\\\'KM 5 VIA AUTOPISTA CALI YUMBO\\\',\\\'6919400\\\',\\\'1\\\'',90000005),(0000000138,'2009-07-14 15:50:05','I','pance_cargos','codigo_interno,nombre,interno','\\\'1\\\',\\\'INGENIERO DE PROYECTOS\\\',\\\'0\\\'',901),(0000000139,'2009-07-14 15:50:27','I','pance_cargos','codigo_interno,nombre,interno','\\\'2\\\',\\\'JEFE DE DEPOSITO\\\',\\\'0\\\'',902),(0000000140,'2009-07-14 15:50:41','I','pance_cargos','codigo_interno,nombre,interno','\\\'3\\\',\\\'JEFE DE VENTAS\\\',\\\'0\\\'',903),(0000000141,'2009-07-14 16:35:18','U','pance_sucursales','codigo,id_empresa,nombre,nombre_corto,activo,id_municipio,direccion_residencia,telefono_1,telefono_2,celular','\\\'004\\\',\\\'903\\\',\\\'ENERCON LTDA\\\',\\\'ENERCON\\\',\\\'1\\\',\\\'00829\\\',\\\'CARRERA 12 CALLE 19 C.CIAL FIDUCENTRO LOCAL F207\\\',\\\'3354801\\\',NULL,NULL',90001),(0000000142,'2009-07-14 16:35:47','U','pance_terceros','documento_identidad,tipo_persona,id_tipo_documento,primer_nombre,segundo_nombre,primer_apellido,segundo_apellido,razon_social,nombre_comercial,id_municipio_documento,id_municipio_residencia,direccion_principal,telefono_principal,fax,celular,correo,sitio_web','\\\'900192661\\\',\\\'2\\\',\\\'901\\\',NULL,NULL,NULL,NULL,\\\'ENERGIA ELECTRICA Y CONSTRUCCIONES LTDA\\\',\\\'ENERCON LTDA\\\',\\\'00000829\\\',\\\'90000831\\\',\\\'CARRERA 12 CALLE 19 C.CIAL FIDUCENTRO LOCAL F207\\\',\\\'3354801\\\',NULL,NULL,NULL,NULL',903),(0000000143,'2009-07-14 16:35:47','U','pance_empresas','codigo,razon_social,nombre_corto,fecha_cierre,activo,id_tercero,id_actividad_principal,id_actividad_secundaria,regimen,retiene_fuente,autoretenedor,retiene_iva,retiene_ica,gran_contribuyente','\\\'004\\\',\\\'ENERGIA ELECTRICA Y CONSTRUCCIONES LTDA\\\',\\\'ENERCON\\\',NULL,\\\'1\\\',\\\'90000003\\\',\\\'9000\\\',\\\'9001\\\',\\\'1\\\',\\\'1\\\',\\\'0\\\',\\\'0\\\',\\\'1\\\',\\\'0\\\'',903),(0000000144,'2009-07-30 14:58:17','I','pance_terceros','documento_identidad,tipo_persona,id_tipo_documento,razon_social,nombre_comercial,fecha_ingreso,id_municipio_documento,id_municipio_residencia,direccion_principal,telefono_principal,cliente','\\\'890900168\\\',\\\'2\\\',\\\'901\\\',\\\'CERVECERIA UNION S.AA\\\',\\\'CERVUNION\\\',\\\'2009-02-02\\\',\\\'00000059\\\',\\\'90000061\\\',\\\'CARRERA 50 No. 38-39\\\',\\\'1\\\',\\\'1\\\'',90000006),(0000000145,'2009-07-30 14:59:07','U','pance_terceros','documento_identidad,tipo_persona,id_tipo_documento,primer_nombre,segundo_nombre,primer_apellido,segundo_apellido,razon_social,nombre_comercial,genero,fecha_ingreso,id_municipio_documento,id_municipio_residencia,direccion_principal,telefono_principal,fax,celular,correo,sitio_web','\\\'890900168\\\',\\\'2\\\',\\\'901\\\',NULL,NULL,NULL,NULL,\\\'CERVECERIA UNION S.A.\\\',\\\'CERVUNION\\\',\\\'N\\\',\\\'2009-02-02\\\',\\\'00000059\\\',\\\'90000061\\\',\\\'CARRERA 50 No. 38-39\\\',\\\'1\\\',NULL,NULL,NULL,NULL',90000006),(0000000146,'2009-07-30 15:01:49','I','pance_terceros','documento_identidad,tipo_persona,id_tipo_documento,razon_social,nombre_comercial,fecha_ingreso,id_municipio_documento,id_municipio_residencia,direccion_principal,telefono_principal,cliente','\\\'860528319\\\',\\\'2\\\',\\\'901\\\',\\\'IMPRESORA DEL SUR S.A.\\\',\\\'IMPRESUR S.A.\\\',\\\'2009-02-02\\\',\\\'00000149\\\',\\\'90000151\\\',\\\'CALLE 94 No.7A-47\\\',\\\'1\\\',\\\'1\\\'',90000007),(0000000147,'2009-07-30 15:03:43','I','pance_terceros','documento_identidad,tipo_persona,id_tipo_documento,razon_social,nombre_comercial,fecha_ingreso,id_municipio_documento,id_municipio_residencia,direccion_principal,telefono_principal,cliente','\\\'830101107\\\',\\\'2\\\',\\\'901\\\',\\\'MALTERIA TROPICAL S.A.\\\',\\\'MALTERIA TROPICAL S.A.\\\',\\\'2009-02-02\\\',\\\'00000149\\\',\\\'90000151\\\',\\\'CALLE 94 No. 7A-47\\\',\\\'1\\\',\\\'1\\\'',90000008);
/*!40000 ALTER TABLE `pance_actualizaciones_almacen` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pance_actualizaciones_servidor`
--

DROP TABLE IF EXISTS `pance_actualizaciones_servidor`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `pance_actualizaciones_servidor` (
  `id` int(10) unsigned zerofill NOT NULL COMMENT 'Consecutivo interno para la base de datos',
  `id_servidor` smallint(3) unsigned zerofill NOT NULL COMMENT 'Consecutivo interno para la base de datos del almacÃ©n que originÃ³ la instrucciÃ³n',
  `instruccion1` text NOT NULL COMMENT 'Sentencia SQL para el almacÃ©n que originÃ³ la actualizaciÃ³n',
  `instruccion2` text NOT NULL COMMENT 'Sentencia SQL para el resto de almacenes',
  PRIMARY KEY  (`id`),
  KEY `actualizaciones_servidor_servidor` (`id_servidor`),
  CONSTRAINT `actualizaciones_servidor_servidor` FOREIGN KEY (`id_servidor`) REFERENCES `pance_servidores` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `pance_actualizaciones_servidor`
--

LOCK TABLES `pance_actualizaciones_servidor` WRITE;
/*!40000 ALTER TABLE `pance_actualizaciones_servidor` DISABLE KEYS */;
/*!40000 ALTER TABLE `pance_actualizaciones_servidor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pance_agenda`
--

DROP TABLE IF EXISTS `pance_agenda`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `pance_agenda` (
  `id` smallint(3) unsigned zerofill NOT NULL auto_increment COMMENT 'Consecutivo interno de la base de datos',
  `id_usuario` smallint(4) unsigned zerofill NOT NULL COMMENT 'Usuario al que pertenece el apunte de la agenda (Llave foranea tabla usuarios)',
  `fecha` date NOT NULL COMMENT 'Fecha de inicio del apunte',
  `hora_inicio` time NOT NULL COMMENT 'Hora de inicio del apunte',
  `duracion` int(3) NOT NULL COMMENT 'Tiempo de duracion del apunte',
  `titulo` varchar(255) NOT NULL COMMENT 'Titulo del apunte',
  `descripcion` varchar(255) NOT NULL COMMENT 'DescripciÃ³n del apunte',
  PRIMARY KEY  (`id`),
  KEY `agenda_usuarios` (`id_usuario`),
  CONSTRAINT `agenda_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `pance_usuarios` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `pance_agenda`
--

LOCK TABLES `pance_agenda` WRITE;
/*!40000 ALTER TABLE `pance_agenda` DISABLE KEYS */;
/*!40000 ALTER TABLE `pance_agenda` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pance_bitacora`
--

DROP TABLE IF EXISTS `pance_bitacora`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `pance_bitacora` (
  `id` int(10) unsigned zerofill NOT NULL auto_increment COMMENT 'Consecutivo interno para la base de datos',
  `id_conexion` int(8) unsigned zerofill NOT NULL COMMENT 'Consecutivo interno para la base de datos de la conexiÃ³n a la cual pertenece',
  `fecha` datetime NOT NULL COMMENT 'Fecha y hora de la operaciÃ³n',
  `componente` text NOT NULL COMMENT 'Nombre del componente requerido por el usuario',
  `consulta` text NOT NULL COMMENT 'Detalles de la sintÃ¡xis SQL de la(s) consulta(s) generada(s) por el componente',
  `mensaje` text COMMENT 'Mensaje de error (si existe) devuelto por el motor de bases de datos',
  PRIMARY KEY  (`id`),
  KEY `bitacora_conexion` (`id_conexion`),
  CONSTRAINT `bitacora_conexion` FOREIGN KEY (`id_conexion`) REFERENCES `pance_conexiones` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=510 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `pance_bitacora`
--

LOCK TABLES `pance_bitacora` WRITE;
/*!40000 ALTER TABLE `pance_bitacora` DISABLE KEYS */;
INSERT INTO `pance_bitacora` VALUES (0000000001,00000001,'2009-07-13 13:15:35','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-07-13 13:15:35\\\',\\\'0001\\\',\\\'127.0.0.1\\\')',NULL),(0000000002,00000002,'2009-07-13 13:29:10','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-07-13 13:29:10\\\',\\\'0001\\\',\\\'127.0.0.1\\\')',NULL),(0000000003,00000003,'2009-07-13 13:31:16','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-07-13 13:31:16\\\',\\\'0001\\\',\\\'127.0.0.1\\\')',NULL),(0000000004,00000004,'2009-07-13 13:46:35','Adicionar perfil','INSERT INTO pance_perfiles (codigo,nombre) VALUES (\\\'1\\\',\\\'GLOBAL\\\')',NULL),(0000000005,00000004,'2009-07-13 13:47:46','Adicionar tipo de documento de identidad','INSERT INTO pance_tipos_documento_identidad (codigo_DIAN,codigo_interno,descripcion) VALUES (\\\'1\\\',\\\'1\\\',\\\'CEDULA\\\')',NULL),(0000000006,00000004,'2009-07-13 13:48:01','Adicionar tipo de documento de identidad','INSERT INTO pance_tipos_documento_identidad (codigo_DIAN,codigo_interno,descripcion) VALUES (\\\'2\\\',\\\'2\\\',\\\'NIT\\\')',NULL),(0000000007,00000004,'2009-07-13 14:03:14','Adicionar actividad economica','INSERT INTO pance_actividades_economicas (codigo_DIAN,codigo_interno,descripcion) VALUES (\\\'1\\\',\\\'1\\\',\\\'SERVICIOS\\\')',NULL),(0000000008,00000004,'2009-07-13 14:05:29','Adicionar corregimiento','INSERT INTO pance_localidades (id_municipio,nombre,codigo_dane,codigo_interno,tipo) VALUES (\\\'00001002\\\',\\\'CALI\\\',\\\'01\\\',\\\'1\\\',\\\'C\\\')',NULL),(0000000009,00000004,'2009-07-13 14:06:46','Adicionar empresas','INSERT INTO pance_terceros (documento_identidad,tipo_persona,id_tipo_documento,razon_social,nombre_comercial,id_municipio_documento,id_municipio_residencia,direccion_principal) VALUES (\\\'1234\\\',\\\'2\\\',\\\'901\\\',\\\'CIMCO\\\',\\\'CIMCO\\\',\\\'00001002\\\',\\\'90000000\\\',\\\'PASOANCHO\\\')','Field \\\'fecha_nacimiento\\\' doesn\\\'t have a default value'),(0000000010,00000004,'2009-07-13 14:06:46','Adicionar empresas','INSERT INTO pance_empresas (codigo,razon_social,nombre_corto,activo,id_actividad_principal,id_actividad_secundaria,regimen,retiene_fuente,autoretenedor,retiene_iva,retiene_ica,gran_contribuyente) VALUES (\\\'1\\\',\\\'CONSORCIO CIMCO\\\',\\\'CIMCO\\\',\\\'1\\\',\\\'9000\\\',\\\'9000\\\',\\\'1\\\',\\\'0\\\',\\\'0\\\',\\\'0\\\',\\\'0\\\',\\\'0\\\')','Field \\\'id_tercero\\\' doesn\\\'t have a default value'),(0000000011,00000004,'2009-07-13 14:08:19','Adicionar empresas','INSERT INTO pance_terceros (documento_identidad,tipo_persona,id_tipo_documento,razon_social,nombre_comercial,id_municipio_documento,id_municipio_residencia,direccion_principal) VALUES (\\\'1234\\\',\\\'2\\\',\\\'901\\\',\\\'CIMCO\\\',\\\'CIMCO\\\',\\\'00001002\\\',\\\'90000000\\\',\\\'PASOANCHO\\\')',NULL),(0000000012,00000004,'2009-07-13 14:08:20','Adicionar empresas','INSERT INTO pance_empresas (codigo,razon_social,nombre_corto,activo,id_tercero,id_actividad_principal,id_actividad_secundaria,regimen,retiene_fuente,autoretenedor,retiene_iva,retiene_ica,gran_contribuyente) VALUES (\\\'1\\\',\\\'CONSORCIO CIMCO\\\',\\\'CIMCO\\\',\\\'1\\\',\\\'90000000\\\',\\\'9000\\\',\\\'9000\\\',\\\'1\\\',\\\'0\\\',\\\'0\\\',\\\'0\\\',\\\'0\\\',\\\'0\\\')',NULL),(0000000013,00000004,'2009-07-13 14:09:28','Adicionar consorciado','INSERT INTO pance_sucursales (codigo,id_empresa,nombre,nombre_corto,activo,id_municipio,direccion_residencia,telefono_1) VALUES (\\\'1\\\',\\\'900\\\',\\\'ALMACEN\\\',\\\'ALM CIMCO\\\',\\\'1\\\',\\\'00001002\\\',\\\'PASOANCHO\\\',\\\'1234567\\\')',NULL),(0000000014,00000004,'2009-07-13 14:09:29','Adicionar consorciado','INSERT INTO pance_sucursales (codigo,id_empresa,nombre,nombre_corto,activo,id_municipio,direccion_residencia,telefono_1) VALUES (\\\'1\\\',\\\'900\\\',\\\'ALMACEN\\\',\\\'ALM CIMCO\\\',\\\'1\\\',\\\'00001002\\\',\\\'PASOANCHO\\\',\\\'1234567\\\')','Duplicate entry \\\'001\\\' for key 2'),(0000000015,00000004,'2009-07-13 14:09:59','Adicionar privilegios','INSERT INTO pance_perfiles_usuario (id_usuario,id_sucursal,id_perfil) VALUES (\\\'0001\\\',\\\'90000\\\',\\\'9000\\\')',NULL),(0000000016,00000004,'2009-07-13 14:13:27','Modificar privilegios','DELETE FROM pance_componentes_usuario WHERE id_perfil = \\\'90000000\\\'',NULL),(0000000017,00000004,'2009-07-13 14:13:28','Modificar privilegios','INSERT INTO pance_componentes_usuario (id_perfil,id_componente) VALUES (\\\'90000000\\\',\\\'GESTAGEN\\\')',NULL),(0000000018,00000004,'2009-07-13 14:13:28','Modificar privilegios','INSERT INTO pance_componentes_usuario (id_perfil,id_componente) VALUES (\\\'90000000\\\',\\\'ADICAGEN\\\')',NULL),(0000000019,00000004,'2009-07-13 14:13:28','Modificar privilegios','INSERT INTO pance_componentes_usuario (id_perfil,id_componente) VALUES (\\\'90000000\\\',\\\'CONSAGEN\\\')',NULL),(0000000020,00000004,'2009-07-13 14:13:29','Modificar privilegios','INSERT INTO pance_componentes_usuario (id_perfil,id_componente) VALUES (\\\'90000000\\\',\\\'MODIAGEN\\\')',NULL),(0000000021,00000004,'2009-07-13 14:13:29','Modificar privilegios','INSERT INTO pance_componentes_usuario (id_perfil,id_componente) VALUES (\\\'90000000\\\',\\\'ELIMAGEN\\\')',NULL),(0000000022,00000004,'2009-07-13 14:13:29','Modificar privilegios','INSERT INTO pance_componentes_usuario (id_perfil,id_componente) VALUES (\\\'90000000\\\',\\\'GESTNOTA\\\')',NULL),(0000000023,00000004,'2009-07-13 14:13:29','Modificar privilegios','INSERT INTO pance_componentes_usuario (id_perfil,id_componente) VALUES (\\\'90000000\\\',\\\'ADICNOTA\\\')',NULL),(0000000024,00000004,'2009-07-13 14:13:29','Modificar privilegios','INSERT INTO pance_componentes_usuario (id_perfil,id_componente) VALUES (\\\'90000000\\\',\\\'CONSNOTA\\\')',NULL),(0000000025,00000004,'2009-07-13 14:13:30','Modificar privilegios','INSERT INTO pance_componentes_usuario (id_perfil,id_componente) VALUES (\\\'90000000\\\',\\\'MODINOTA\\\')',NULL),(0000000026,00000004,'2009-07-13 14:13:30','Modificar privilegios','INSERT INTO pance_componentes_usuario (id_perfil,id_componente) VALUES (\\\'90000000\\\',\\\'ELIMNOTA\\\')',NULL),(0000000027,00000004,'2009-07-13 14:13:30','Modificar privilegios','INSERT INTO pance_componentes_usuario (id_perfil,id_componente) VALUES (\\\'90000000\\\',\\\'MENUCLIE\\\')',NULL),(0000000028,00000004,'2009-07-13 14:13:31','Modificar privilegios','INSERT INTO pance_componentes_usuario (id_perfil,id_componente) VALUES (\\\'90000000\\\',\\\'SUBMCOSE\\\')',NULL),(0000000029,00000004,'2009-07-13 14:13:31','Modificar privilegios','INSERT INTO pance_componentes_usuario (id_perfil,id_componente) VALUES (\\\'90000000\\\',\\\'GESTCLIE\\\')',NULL),(0000000030,00000004,'2009-07-13 14:13:31','Modificar privilegios','INSERT INTO pance_componentes_usuario (id_perfil,id_componente) VALUES (\\\'90000000\\\',\\\'GESTSEDE\\\')',NULL),(0000000031,00000004,'2009-07-13 14:13:31','Modificar privilegios','INSERT INTO pance_componentes_usuario (id_perfil,id_componente) VALUES (\\\'90000000\\\',\\\'ADICSEDE\\\')',NULL),(0000000032,00000004,'2009-07-13 14:13:32','Modificar privilegios','INSERT INTO pance_componentes_usuario (id_perfil,id_componente) VALUES (\\\'90000000\\\',\\\'CONSSEDE\\\')',NULL),(0000000033,00000004,'2009-07-13 14:13:32','Modificar privilegios','INSERT INTO pance_componentes_usuario (id_perfil,id_componente) VALUES (\\\'90000000\\\',\\\'MODISEDE\\\')',NULL),(0000000034,00000004,'2009-07-13 14:13:32','Modificar privilegios','INSERT INTO pance_componentes_usuario (id_perfil,id_componente) VALUES (\\\'90000000\\\',\\\'ELIMSEDE\\\')',NULL),(0000000035,00000004,'2009-07-13 14:13:32','Modificar privilegios','INSERT INTO pance_componentes_usuario (id_perfil,id_componente) VALUES (\\\'90000000\\\',\\\'GESTRECL\\\')',NULL),(0000000036,00000004,'2009-07-13 14:13:33','Modificar privilegios','INSERT INTO pance_componentes_usuario (id_perfil,id_componente) VALUES (\\\'90000000\\\',\\\'ADICRECL\\\')',NULL),(0000000037,00000004,'2009-07-13 14:13:33','Modificar privilegios','INSERT INTO pance_componentes_usuario (id_perfil,id_componente) VALUES (\\\'90000000\\\',\\\'CONSRECL\\\')',NULL),(0000000038,00000004,'2009-07-13 14:13:33','Modificar privilegios','INSERT INTO pance_componentes_usuario (id_perfil,id_componente) VALUES (\\\'90000000\\\',\\\'MODIRECL\\\')',NULL),(0000000039,00000004,'2009-07-13 14:13:34','Modificar privilegios','INSERT INTO pance_componentes_usuario (id_perfil,id_componente) VALUES (\\\'90000000\\\',\\\'ELIMRECL\\\')',NULL),(0000000040,00000004,'2009-07-13 14:13:34','Modificar privilegios','INSERT INTO pance_componentes_usuario (id_perfil,id_componente) VALUES (\\\'90000000\\\',\\\'GESTCOCL\\\')',NULL),(0000000041,00000004,'2009-07-13 14:13:34','Modificar privilegios','INSERT INTO pance_componentes_usuario (id_perfil,id_componente) VALUES (\\\'90000000\\\',\\\'ADICCOTI\\\')',NULL),(0000000042,00000004,'2009-07-13 14:13:35','Modificar privilegios','INSERT INTO pance_componentes_usuario (id_perfil,id_componente) VALUES (\\\'90000000\\\',\\\'CONSCOTI\\\')',NULL),(0000000043,00000004,'2009-07-13 14:13:35','Modificar privilegios','INSERT INTO pance_componentes_usuario (id_perfil,id_componente) VALUES (\\\'90000000\\\',\\\'MODICOTI\\\')',NULL),(0000000044,00000004,'2009-07-13 14:13:35','Modificar privilegios','INSERT INTO pance_componentes_usuario (id_perfil,id_componente) VALUES (\\\'90000000\\\',\\\'ELIMCOTI\\\')',NULL),(0000000045,00000004,'2009-07-13 14:13:35','Modificar privilegios','INSERT INTO pance_componentes_usuario (id_perfil,id_componente) VALUES (\\\'90000000\\\',\\\'GESTAPCO\\\')',NULL),(0000000046,00000004,'2009-07-13 14:13:36','Modificar privilegios','INSERT INTO pance_componentes_usuario (id_perfil,id_componente) VALUES (\\\'90000000\\\',\\\'ADICAPCO\\\')',NULL),(0000000047,00000004,'2009-07-13 14:13:36','Modificar privilegios','INSERT INTO pance_componentes_usuario (id_perfil,id_componente) VALUES (\\\'90000000\\\',\\\'CONSAPCO\\\')',NULL),(0000000048,00000004,'2009-07-13 14:13:37','Modificar privilegios','INSERT INTO pance_componentes_usuario (id_perfil,id_componente) VALUES (\\\'90000000\\\',\\\'MODIAPCO\\\')',NULL),(0000000049,00000004,'2009-07-13 14:13:38','Modificar privilegios','INSERT INTO pance_componentes_usuario (id_perfil,id_componente) VALUES (\\\'90000000\\\',\\\'ELIMAPCO\\\')',NULL),(0000000050,00000004,'2009-07-13 14:13:38','Modificar privilegios','INSERT INTO pance_componentes_usuario (id_perfil,id_componente) VALUES (\\\'90000000\\\',\\\'MENUADMI\\\')',NULL),(0000000051,00000004,'2009-07-13 14:13:38','Modificar privilegios','INSERT INTO pance_componentes_usuario (id_perfil,id_componente) VALUES (\\\'90000000\\\',\\\'SUBMESTC\\\')',NULL),(0000000052,00000004,'2009-07-13 14:13:38','Modificar privilegios','INSERT INTO pance_componentes_usuario (id_perfil,id_componente) VALUES (\\\'90000000\\\',\\\'GESTEMPR\\\')',NULL),(0000000053,00000004,'2009-07-13 14:13:39','Modificar privilegios','INSERT INTO pance_componentes_usuario (id_perfil,id_componente) VALUES (\\\'90000000\\\',\\\'ADICEMPR\\\')',NULL),(0000000054,00000004,'2009-07-13 14:13:39','Modificar privilegios','INSERT INTO pance_componentes_usuario (id_perfil,id_componente) VALUES (\\\'90000000\\\',\\\'CONSEMPR\\\')',NULL),(0000000055,00000004,'2009-07-13 14:13:40','Modificar privilegios','INSERT INTO pance_componentes_usuario (id_perfil,id_componente) VALUES (\\\'90000000\\\',\\\'MODIEMPR\\\')',NULL),(0000000056,00000004,'2009-07-13 14:13:40','Modificar privilegios','INSERT INTO pance_componentes_usuario (id_perfil,id_componente) VALUES (\\\'90000000\\\',\\\'ELIMEMPR\\\')',NULL),(0000000057,00000004,'2009-07-13 14:13:41','Modificar privilegios','INSERT INTO pance_componentes_usuario (id_perfil,id_componente) VALUES (\\\'90000000\\\',\\\'GESTSUCU\\\')',NULL),(0000000058,00000004,'2009-07-13 14:13:41','Modificar privilegios','INSERT INTO pance_componentes_usuario (id_perfil,id_componente) VALUES (\\\'90000000\\\',\\\'ADICSUCU\\\')',NULL),(0000000059,00000004,'2009-07-13 14:13:41','Modificar privilegios','INSERT INTO pance_componentes_usuario (id_perfil,id_componente) VALUES (\\\'90000000\\\',\\\'CONSSUCU\\\')',NULL),(0000000060,00000004,'2009-07-13 14:13:42','Modificar privilegios','INSERT INTO pance_componentes_usuario (id_perfil,id_componente) VALUES (\\\'90000000\\\',\\\'MODISUCU\\\')',NULL),(0000000061,00000004,'2009-07-13 14:13:42','Modificar privilegios','INSERT INTO pance_componentes_usuario (id_perfil,id_componente) VALUES (\\\'90000000\\\',\\\'ELIMSUCU\\\')',NULL),(0000000062,00000004,'2009-07-13 14:13:43','Modificar privilegios','INSERT INTO pance_componentes_usuario (id_perfil,id_componente) VALUES (\\\'90000000\\\',\\\'GESTBODE\\\')',NULL),(0000000063,00000004,'2009-07-13 14:13:44','Modificar privilegios','INSERT INTO pance_componentes_usuario (id_perfil,id_componente) VALUES (\\\'90000000\\\',\\\'ADICBODE\\\')',NULL),(0000000064,00000004,'2009-07-13 14:13:45','Modificar privilegios','INSERT INTO pance_componentes_usuario (id_perfil,id_componente) VALUES (\\\'90000000\\\',\\\'CONSBODE\\\')',NULL),(0000000065,00000004,'2009-07-13 14:13:46','Modificar privilegios','INSERT INTO pance_componentes_usuario (id_perfil,id_componente) VALUES (\\\'90000000\\\',\\\'MODIBODE\\\')',NULL),(0000000066,00000004,'2009-07-13 14:13:47','Modificar privilegios','INSERT INTO pance_componentes_usuario (id_perfil,id_componente) VALUES (\\\'90000000\\\',\\\'ELIMBODE\\\')',NULL),(0000000067,00000004,'2009-07-13 14:13:47','Modificar privilegios','INSERT INTO pance_componentes_usuario (id_perfil,id_componente) VALUES (\\\'90000000\\\',\\\'GESTSECC\\\')',NULL),(0000000068,00000004,'2009-07-13 14:13:50','Modificar privilegios','INSERT INTO pance_componentes_usuario (id_perfil,id_componente) VALUES (\\\'90000000\\\',\\\'ADICSECC\\\')',NULL),(0000000069,00000004,'2009-07-13 14:13:52','Modificar privilegios','INSERT INTO pance_componentes_usuario (id_perfil,id_componente) VALUES (\\\'90000000\\\',\\\'CONSSECC\\\')',NULL),(0000000070,00000004,'2009-07-13 14:13:54','Modificar privilegios','INSERT INTO pance_componentes_usuario (id_perfil,id_componente) VALUES (\\\'90000000\\\',\\\'MODISECC\\\')',NULL),(0000000071,00000004,'2009-07-13 14:13:55','Modificar privilegios','INSERT INTO pance_componentes_usuario (id_perfil,id_componente) VALUES (\\\'90000000\\\',\\\'ELIMSECC\\\')',NULL),(0000000072,00000004,'2009-07-13 14:13:56','Modificar privilegios','INSERT INTO pance_componentes_usuario (id_perfil,id_componente) VALUES (\\\'90000000\\\',\\\'SUBMACCE\\\')',NULL),(0000000073,00000004,'2009-07-13 14:14:17','Modificar privilegios','DELETE FROM pance_componentes_usuario WHERE id_perfil = \\\'90000000\\\'',NULL),(0000000074,00000004,'2009-07-13 14:14:18','Modificar privilegios','INSERT INTO pance_componentes_usuario (id_perfil,id_componente) VALUES (\\\'90000000\\\',\\\'GESTAGEN\\\')',NULL),(0000000075,00000004,'2009-07-13 14:14:18','Modificar privilegios','INSERT INTO pance_componentes_usuario (id_perfil,id_componente) VALUES (\\\'90000000\\\',\\\'ADICAGEN\\\')',NULL),(0000000076,00000004,'2009-07-13 14:14:18','Modificar privilegios','INSERT INTO pance_componentes_usuario (id_perfil,id_componente) VALUES (\\\'90000000\\\',\\\'CONSAGEN\\\')',NULL),(0000000077,00000004,'2009-07-13 14:14:19','Modificar privilegios','INSERT INTO pance_componentes_usuario (id_perfil,id_componente) VALUES (\\\'90000000\\\',\\\'MODIAGEN\\\')',NULL),(0000000078,00000004,'2009-07-13 14:14:19','Modificar privilegios','INSERT INTO pance_componentes_usuario (id_perfil,id_componente) VALUES (\\\'90000000\\\',\\\'ELIMAGEN\\\')',NULL),(0000000079,00000004,'2009-07-13 14:14:19','Modificar privilegios','INSERT INTO pance_componentes_usuario (id_perfil,id_componente) VALUES (\\\'90000000\\\',\\\'GESTNOTA\\\')',NULL),(0000000080,00000004,'2009-07-13 14:14:20','Modificar privilegios','INSERT INTO pance_componentes_usuario (id_perfil,id_componente) VALUES (\\\'90000000\\\',\\\'ADICNOTA\\\')',NULL),(0000000081,00000004,'2009-07-13 14:14:20','Modificar privilegios','INSERT INTO pance_componentes_usuario (id_perfil,id_componente) VALUES (\\\'90000000\\\',\\\'CONSNOTA\\\')',NULL),(0000000082,00000004,'2009-07-13 14:14:20','Modificar privilegios','INSERT INTO pance_componentes_usuario (id_perfil,id_componente) VALUES (\\\'90000000\\\',\\\'MODINOTA\\\')',NULL),(0000000083,00000004,'2009-07-13 14:14:21','Modificar privilegios','INSERT INTO pance_componentes_usuario (id_perfil,id_componente) VALUES (\\\'90000000\\\',\\\'ELIMNOTA\\\')',NULL),(0000000084,00000004,'2009-07-13 14:14:21','Modificar privilegios','INSERT INTO pance_componentes_usuario (id_perfil,id_componente) VALUES (\\\'90000000\\\',\\\'MENUCLIE\\\')',NULL),(0000000085,00000004,'2009-07-13 14:14:23','Modificar privilegios','INSERT INTO pance_componentes_usuario (id_perfil,id_componente) VALUES (\\\'90000000\\\',\\\'SUBMCOSE\\\')',NULL),(0000000086,00000004,'2009-07-13 14:14:23','Modificar privilegios','INSERT INTO pance_componentes_usuario (id_perfil,id_componente) VALUES (\\\'90000000\\\',\\\'GESTCLIE\\\')',NULL),(0000000087,00000004,'2009-07-13 14:14:24','Modificar privilegios','INSERT INTO pance_componentes_usuario (id_perfil,id_componente) VALUES (\\\'90000000\\\',\\\'GESTSEDE\\\')',NULL),(0000000088,00000004,'2009-07-13 14:14:25','Modificar privilegios','INSERT INTO pance_componentes_usuario (id_perfil,id_componente) VALUES (\\\'90000000\\\',\\\'ADICSEDE\\\')',NULL),(0000000089,00000004,'2009-07-13 14:14:26','Modificar privilegios','INSERT INTO pance_componentes_usuario (id_perfil,id_componente) VALUES (\\\'90000000\\\',\\\'CONSSEDE\\\')',NULL),(0000000090,00000004,'2009-07-13 14:14:27','Modificar privilegios','INSERT INTO pance_componentes_usuario (id_perfil,id_componente) VALUES (\\\'90000000\\\',\\\'MODISEDE\\\')',NULL),(0000000091,00000004,'2009-07-13 14:14:28','Modificar privilegios','INSERT INTO pance_componentes_usuario (id_perfil,id_componente) VALUES (\\\'90000000\\\',\\\'ELIMSEDE\\\')',NULL),(0000000092,00000004,'2009-07-13 14:14:30','Modificar privilegios','INSERT INTO pance_componentes_usuario (id_perfil,id_componente) VALUES (\\\'90000000\\\',\\\'GESTRECL\\\')',NULL),(0000000093,00000004,'2009-07-13 14:14:31','Modificar privilegios','INSERT INTO pance_componentes_usuario (id_perfil,id_componente) VALUES (\\\'90000000\\\',\\\'ADICRECL\\\')',NULL),(0000000094,00000004,'2009-07-13 14:14:32','Modificar privilegios','INSERT INTO pance_componentes_usuario (id_perfil,id_componente) VALUES (\\\'90000000\\\',\\\'CONSRECL\\\')',NULL),(0000000095,00000004,'2009-07-13 14:14:32','Modificar privilegios','INSERT INTO pance_componentes_usuario (id_perfil,id_componente) VALUES (\\\'90000000\\\',\\\'MODIRECL\\\')',NULL),(0000000096,00000004,'2009-07-13 14:14:33','Modificar privilegios','INSERT INTO pance_componentes_usuario (id_perfil,id_componente) VALUES (\\\'90000000\\\',\\\'ELIMRECL\\\')',NULL),(0000000097,00000004,'2009-07-13 14:14:34','Modificar privilegios','INSERT INTO pance_componentes_usuario (id_perfil,id_componente) VALUES (\\\'90000000\\\',\\\'GESTCOCL\\\')',NULL),(0000000098,00000004,'2009-07-13 14:14:34','Modificar privilegios','INSERT INTO pance_componentes_usuario (id_perfil,id_componente) VALUES (\\\'90000000\\\',\\\'ADICCOTI\\\')',NULL),(0000000099,00000004,'2009-07-13 14:14:34','Modificar privilegios','INSERT INTO pance_componentes_usuario (id_perfil,id_componente) VALUES (\\\'90000000\\\',\\\'CONSCOTI\\\')',NULL),(0000000100,00000004,'2009-07-13 14:14:35','Modificar privilegios','INSERT INTO pance_componentes_usuario (id_perfil,id_componente) VALUES (\\\'90000000\\\',\\\'MODICOTI\\\')',NULL),(0000000101,00000004,'2009-07-13 14:14:36','Modificar privilegios','INSERT INTO pance_componentes_usuario (id_perfil,id_componente) VALUES (\\\'90000000\\\',\\\'ELIMCOTI\\\')',NULL),(0000000102,00000004,'2009-07-13 14:14:36','Modificar privilegios','INSERT INTO pance_componentes_usuario (id_perfil,id_componente) VALUES (\\\'90000000\\\',\\\'GESTAPCO\\\')',NULL),(0000000103,00000004,'2009-07-13 14:14:37','Modificar privilegios','INSERT INTO pance_componentes_usuario (id_perfil,id_componente) VALUES (\\\'90000000\\\',\\\'ADICAPCO\\\')',NULL),(0000000104,00000004,'2009-07-13 14:14:38','Modificar privilegios','INSERT INTO pance_componentes_usuario (id_perfil,id_componente) VALUES (\\\'90000000\\\',\\\'CONSAPCO\\\')',NULL),(0000000105,00000004,'2009-07-13 14:14:38','Modificar privilegios','INSERT INTO pance_componentes_usuario (id_perfil,id_componente) VALUES (\\\'90000000\\\',\\\'MODIAPCO\\\')',NULL),(0000000106,00000004,'2009-07-13 14:14:39','Modificar privilegios','INSERT INTO pance_componentes_usuario (id_perfil,id_componente) VALUES (\\\'90000000\\\',\\\'ELIMAPCO\\\')',NULL),(0000000107,00000004,'2009-07-13 14:14:41','Modificar privilegios','INSERT INTO pance_componentes_usuario (id_perfil,id_componente) VALUES (\\\'90000000\\\',\\\'MENUADMI\\\')',NULL),(0000000108,00000004,'2009-07-13 14:14:42','Modificar privilegios','INSERT INTO pance_componentes_usuario (id_perfil,id_componente) VALUES (\\\'90000000\\\',\\\'SUBMESTC\\\')',NULL),(0000000109,00000004,'2009-07-13 14:14:42','Modificar privilegios','INSERT INTO pance_componentes_usuario (id_perfil,id_componente) VALUES (\\\'90000000\\\',\\\'GESTEMPR\\\')',NULL),(0000000110,00000004,'2009-07-13 14:14:43','Modificar privilegios','INSERT INTO pance_componentes_usuario (id_perfil,id_componente) VALUES (\\\'90000000\\\',\\\'ADICEMPR\\\')',NULL),(0000000111,00000004,'2009-07-13 14:14:43','Modificar privilegios','INSERT INTO pance_componentes_usuario (id_perfil,id_componente) VALUES (\\\'90000000\\\',\\\'CONSEMPR\\\')',NULL),(0000000112,00000004,'2009-07-13 14:14:44','Modificar privilegios','INSERT INTO pance_componentes_usuario (id_perfil,id_componente) VALUES (\\\'90000000\\\',\\\'MODIEMPR\\\')',NULL),(0000000113,00000004,'2009-07-13 14:14:44','Modificar privilegios','INSERT INTO pance_componentes_usuario (id_perfil,id_componente) VALUES (\\\'90000000\\\',\\\'ELIMEMPR\\\')',NULL),(0000000114,00000004,'2009-07-13 14:14:45','Modificar privilegios','INSERT INTO pance_componentes_usuario (id_perfil,id_componente) VALUES (\\\'90000000\\\',\\\'GESTSUCU\\\')',NULL),(0000000115,00000004,'2009-07-13 14:14:45','Modificar privilegios','INSERT INTO pance_componentes_usuario (id_perfil,id_componente) VALUES (\\\'90000000\\\',\\\'ADICSUCU\\\')',NULL),(0000000116,00000004,'2009-07-13 14:14:46','Modificar privilegios','INSERT INTO pance_componentes_usuario (id_perfil,id_componente) VALUES (\\\'90000000\\\',\\\'CONSSUCU\\\')',NULL),(0000000117,00000004,'2009-07-13 14:14:46','Modificar privilegios','INSERT INTO pance_componentes_usuario (id_perfil,id_componente) VALUES (\\\'90000000\\\',\\\'MODISUCU\\\')',NULL),(0000000118,00000004,'2009-07-13 14:14:47','Modificar privilegios','INSERT INTO pance_componentes_usuario (id_perfil,id_componente) VALUES (\\\'90000000\\\',\\\'ELIMSUCU\\\')',NULL),(0000000119,00000004,'2009-07-13 14:17:14','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-07-13 14:17:14\\\',\\\'0001\\\',\\\'127.0.0.1\\\')',NULL),(0000000120,00000006,'2009-07-13 23:08:20','Adicionar cargo','INSERT INTO pance_cargos (codigo_interno,nombre,interno) VALUES (\\\'999\\\',\\\'&amp;lt; No aplica &amp;gt;\\\',\\\'0\\\')',NULL),(0000000121,00000006,'2009-07-13 23:47:02','Adicionar clientes','INSERT INTO pance_terceros (documento_identidad,tipo_persona,id_tipo_documento,primer_nombre,segundo_nombre,primer_apellido,segundo_apellido,nombre_comercial,fecha_ingreso,id_municipio_documento,id_municipio_residencia,direccion_principal,telefono_principal,cliente) VALUES (\\\'94072403\\\',\\\'1\\\',\\\'900\\\',\\\'Walter\\\',\\\'Andrés\\\',\\\'Márquez\\\',\\\'Gutiérrez\\\',\\\'Sae ltda\\\',\\\'2009-07-13\\\',\\\'00001002\\\',\\\'90000000\\\',\\\'7 de agosto\\\',\\\'1234567\\\',\\\'1\\\')',NULL),(0000000122,00000007,'2009-07-14 07:31:38','Modificar clientes','UPDATE pance_terceros SET documento_identidad=\\\'94072403\\\', tipo_persona=\\\'1\\\', id_tipo_documento=\\\'900\\\', primer_nombre=\\\'Walter\\\', segundo_nombre=\\\'Andrés\\\', primer_apellido=\\\'Márquez\\\', segundo_apellido=\\\'Gutiérrez\\\', razon_social=NULL, nombre_comercial=\\\'Sae ltda\\\', genero=\\\'N\\\', fecha_ingreso=\\\'2009-07-13\\\', id_municipio_documento=\\\'00001002\\\', id_municipio_residencia=\\\'90000000\\\', direccion_principal=\\\'7 de agosto\\\', telefono_principal=\\\'1234567\\\', fax=\\\'7654321\\\', celular=\\\'3153153103000\\\', correo=NULL, sitio_web=NULL WHERE id = \\\'90000001\\\'',NULL),(0000000123,00000007,'2009-07-14 07:46:45','Adicionar sede','INSERT INTO pance_sedes_clientes (id_cliente,nombre_sede,id_sucursal,nombre_contacto,id_cargo,id_municipios,direccion,telefono_principal) VALUES (\\\'90000001\\\',\\\'PRINCIPAL\\\',\\\'90000\\\',\\\'JAMIR\\\',\\\'900\\\',\\\'00001002\\\',\\\'COLON\\\',\\\'1234567\\\')',NULL),(0000000124,00000007,'2009-07-14 07:47:18','Eliminar sede','DELETE FROM pance_sedes_clientes WHERE id = \\\'00000001\\\'',NULL),(0000000125,00000007,'2009-07-14 07:49:41','Adicionar sede','INSERT INTO pance_sedes_clientes (id_cliente,nombre_sede,id_sucursal,nombre_contacto,id_cargo,id_municipios,direccion,telefono_principal) VALUES (\\\'90000001\\\',\\\'PRINCIPAL\\\',\\\'90000\\\',\\\'JAMIR\\\',\\\'900\\\',\\\'00001002\\\',\\\'COLON\\\',\\\'123456\\\')',NULL),(0000000126,00000007,'2009-07-14 08:20:47','Modificar sede','UPDATE pance_sedes_clientes SET id_cliente=\\\'90000001\\\', id_sucursal=\\\'90000\\\', nombre_sede=\\\'PRINCIPAL\\\', nombre_contacto=\\\'JAMIR\\\', id_cargo=\\\'900\\\', id_municipios=\\\'00001002\\\', direccion=\\\'COLON\\\', telefono_principal=\\\'123456\\\', celular=\\\'315310316311\\\', correo=\\\'w@algo.com\\\' WHERE id = \\\'00000001\\\'',NULL),(0000000127,00000007,'2009-07-14 08:24:18','Eliminar sede','DELETE FROM pance_sedes_clientes WHERE id = \\\'00000001\\\'',NULL),(0000000128,00000007,'2009-07-14 08:36:57','Adicionar sede','INSERT INTO pance_sedes_clientes (id_cliente,nombre_sede,id_sucursal,nombre_contacto,id_cargo,id_municipios,direccion,telefono_principal) VALUES (\\\'90000001\\\',\\\'PRINCIPAL\\\',\\\'90000\\\',\\\'JAMIR\\\',\\\'900\\\',\\\'00001002\\\',\\\'PASOANCHO\\\',\\\'1234567\\\')',NULL),(0000000129,00000009,'2009-07-14 15:02:11','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-07-14 15:02:11\\\',\\\'0001\\\',\\\'192.168.0.253\\\')',NULL),(0000000130,00000010,'2009-07-14 15:03:07','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-07-14 15:03:07\\\',\\\'0001\\\',\\\'192.168.0.113\\\')',NULL),(0000000131,00000013,'2009-07-14 15:03:19','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-07-14 15:03:19\\\',\\\'0001\\\',\\\'192.168.0.113\\\')',NULL),(0000000132,00000011,'2009-07-14 15:05:01','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-07-14 15:05:01\\\',\\\'0001\\\',\\\'192.168.0.253\\\')',NULL),(0000000133,00000014,'2009-07-14 15:05:11','Eliminar clientes','DELETE FROM pance_terceros WHERE id = \\\'90000001\\\'',NULL),(0000000134,00000014,'2009-07-14 15:05:40','Eliminar consorciado','DELETE FROM pance_sucursales WHERE id = \\\'90000\\\'',NULL),(0000000135,00000014,'2009-07-14 15:05:53','Eliminar empresas','DELETE FROM pance_empresas WHERE id = \\\'900\\\'',NULL),(0000000136,00000014,'2009-07-14 15:05:53','Eliminar empresas','DELETE FROM pance_terceros WHERE id = \\\'90000000\\\'',NULL),(0000000137,00000014,'2009-07-14 15:09:30','Adicionar empresas','INSERT INTO pance_terceros (documento_identidad,tipo_persona,id_tipo_documento,razon_social,nombre_comercial,id_municipio_documento,id_municipio_residencia,direccion_principal,telefono_principal,celular) VALUES (\\\'891200487\\\',\\\'2\\\',\\\'901\\\',\\\'INGENIERIA DE DISE;O Y CONSTRUCCIONES ELECTRICAS INCOEL LTDA\\\',\\\'INCOEL LTDA\\\',\\\'00001002\\\',\\\'90000000\\\',\\\'CALLE 13 No 66Bis 57 Oficina 227\\\',\\\'6783532\\\',\\\'312\\\')',NULL),(0000000138,00000014,'2009-07-14 15:09:30','Adicionar empresas','INSERT INTO pance_empresas (codigo,razon_social,nombre_corto,activo,id_tercero,id_actividad_principal,id_actividad_secundaria,regimen,retiene_fuente,autoretenedor,retiene_iva,retiene_ica,gran_contribuyente) VALUES (\\\'1\\\',\\\'INGENIERIA DE DISE;O Y CONSTRUCCIONES ELECTRICAS INCOEL LTDA\\\',\\\'INCOEL\\\',\\\'1\\\',\\\'90000000\\\',\\\'9000\\\',\\\'9000\\\',\\\'1\\\',\\\'1\\\',\\\'0\\\',\\\'1\\\',\\\'1\\\',\\\'0\\\')',NULL),(0000000139,00000015,'2009-07-14 15:11:55','Adicionar barrio','INSERT INTO pance_localidades (id_municipio,nombre,tipo) VALUES (\\\'00000513\\\',\\\'Mosquera\\\',\\\'B\\\')',NULL),(0000000140,00000014,'2009-07-14 15:12:55','Adicionar empresas','INSERT INTO pance_terceros (documento_identidad,tipo_persona,id_tipo_documento,razon_social,nombre_comercial,id_municipio_documento,id_municipio_residencia,direccion_principal,telefono_principal) VALUES (\\\'900092131\\\',\\\'2\\\',\\\'901\\\',\\\'EMPRESA ANDINA DE INGENIERIA S.A.\\\',\\\'ANDINA\\\',\\\'00000513\\\',\\\'90000001\\\',\\\'CARRERA 3C No 20-06\\\',\\\'8948484\\\')',NULL),(0000000141,00000014,'2009-07-14 15:12:56','Adicionar empresas','INSERT INTO pance_empresas (codigo,razon_social,nombre_corto,activo,id_tercero,id_actividad_principal,id_actividad_secundaria,regimen,retiene_fuente,autoretenedor,retiene_iva,retiene_ica,gran_contribuyente) VALUES (\\\'2\\\',\\\'EMPRESA ANDINA DE INGENIERIA S.A.\\\',\\\'ANDINA\\\',\\\'1\\\',\\\'90000001\\\',\\\'9000\\\',\\\'9000\\\',\\\'1\\\',\\\'1\\\',\\\'0\\\',\\\'1\\\',\\\'1\\\',\\\'0\\\')',NULL),(0000000142,00000015,'2009-07-14 15:17:07','Adicionar barrio','INSERT INTO pance_localidades (id_municipio,nombre,tipo) VALUES (\\\'00000427\\\',\\\'Montería\\\',\\\'B\\\')',NULL),(0000000143,00000015,'2009-07-14 15:18:05','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-07-14 15:18:05\\\',\\\'0001\\\',\\\'192.168.0.253\\\')',NULL),(0000000144,00000016,'2009-07-14 15:18:56','Adicionar actividad economica','INSERT INTO pance_actividades_economicas (codigo_DIAN,codigo_interno,descripcion) VALUES (\\\'9999\\\',\\\'9999\\\',\\\'&amp;lt;NO APLICA&amp;gt;\\\')',NULL),(0000000145,00000014,'2009-07-14 15:19:36','Adicionar empresas','INSERT INTO pance_terceros (documento_identidad,tipo_persona,id_tipo_documento,razon_social,nombre_comercial,id_municipio_documento,id_municipio_residencia,direccion_principal,telefono_principal) VALUES (\\\'812000053\\\',\\\'2\\\',\\\'901\\\',\\\'INGENIEROS ELECTRICOS DE CORDOBA LTDA\\\',\\\'INGELCOR LTDA\\\',\\\'00000427\\\',\\\'90000002\\\',\\\'CALLE 61 No. 7-52\\\',\\\'7854745\\\')',NULL),(0000000146,00000014,'2009-07-14 15:19:36','Adicionar empresas','INSERT INTO pance_empresas (codigo,razon_social,nombre_corto,activo,id_tercero,id_actividad_principal,id_actividad_secundaria,regimen,retiene_fuente,autoretenedor,retiene_iva,retiene_ica,gran_contribuyente) VALUES (\\\'3\\\',\\\'INGENIEROS ELECTRICOS DE CORDOBA LTDA\\\',\\\'INGELCOR\\\',\\\'1\\\',\\\'90000002\\\',\\\'9000\\\',\\\'9000\\\',\\\'1\\\',\\\'1\\\',\\\'0\\\',\\\'0\\\',\\\'1\\\',\\\'0\\\')',NULL),(0000000147,00000014,'2009-07-14 15:24:09','Adicionar empresas','INSERT INTO pance_terceros (documento_identidad,tipo_persona,id_tipo_documento,razon_social,nombre_comercial,id_municipio_documento,id_municipio_residencia,direccion_principal,telefono_principal) VALUES (\\\'900192661\\\',\\\'2\\\',\\\'901\\\',\\\'ENERGIA ELECTRICA Y CONSTRUCCIONES LTDA\\\',\\\'ENERCON LTDA\\\',\\\'00000829\\\',\\\'90000000\\\',\\\'CARRERA 12 CALLE 19 C.CIAL FIDUCENTRO LOCAL F207\\\',\\\'3354801\\\')',NULL),(0000000148,00000014,'2009-07-14 15:24:09','Adicionar empresas','INSERT INTO pance_empresas (codigo,razon_social,nombre_corto,activo,id_tercero,id_actividad_principal,id_actividad_secundaria,regimen,retiene_fuente,autoretenedor,retiene_iva,retiene_ica,gran_contribuyente) VALUES (\\\'4\\\',\\\'ENERGIA ELECTRICA Y CONSTRUCCIONES LTDA\\\',\\\'ENERCON\\\',\\\'1\\\',\\\'90000003\\\',\\\'9000\\\',\\\'9001\\\',\\\'1\\\',\\\'1\\\',\\\'0\\\',\\\'0\\\',\\\'1\\\',\\\'0\\\')',NULL),(0000000149,00000014,'2009-07-14 15:28:31','Adicionar consorciado','INSERT INTO pance_sucursales (codigo,id_empresa,nombre,nombre_corto,activo,id_municipio,direccion_residencia,telefono_1) VALUES (\\\'1\\\',\\\'901\\\',\\\'ANDINA\\\',\\\'ANDINA\\\',\\\'1\\\',\\\'00000513\\\',\\\'CARRERA 3 C No. 20-06\\\',\\\'8948484\\\')',NULL),(0000000150,00000014,'2009-07-14 15:29:57','Adicionar consorciado','INSERT INTO pance_sucursales (codigo,id_empresa,nombre,nombre_corto,activo,id_municipio,direccion_residencia,telefono_1) VALUES (\\\'4\\\',\\\'903\\\',\\\'ENERCON\\\',\\\'ENERCON\\\',\\\'1\\\',\\\'00000829\\\',\\\'CARRERA 12 CALLE 19 C.CIAL FIDUCENTRO LOCAL F207\\\',\\\'3354801\\\')',NULL),(0000000151,00000014,'2009-07-14 15:30:14','Modificar consorciado','UPDATE pance_sucursales SET codigo=\\\'002\\\', id_empresa=\\\'901\\\', nombre=\\\'ANDINA\\\', nombre_corto=\\\'ANDINA\\\', activo=\\\'1\\\', id_municipio=\\\'00513\\\', direccion_residencia=\\\'CARRERA 3 C No. 20-06\\\', telefono_1=\\\'8948484\\\', telefono_2=NULL, celular=NULL WHERE id = \\\'90000\\\'',NULL),(0000000152,00000014,'2009-07-14 15:31:22','Adicionar consorciado','INSERT INTO pance_sucursales (codigo,id_empresa,nombre,nombre_corto,activo,id_municipio,direccion_residencia,telefono_1) VALUES (\\\'1\\\',\\\'900\\\',\\\'INCOEL LTDA\\\',\\\'INCOEL\\\',\\\'1\\\',\\\'00001002\\\',\\\'CALLE 13 No. 66 BIS - 57 C.CIAL LA FONTANA OF 227\\\',\\\'6783532\\\')',NULL),(0000000153,00000014,'2009-07-14 15:32:16','Adicionar consorciado','INSERT INTO pance_sucursales (codigo,id_empresa,nombre,nombre_corto,activo,id_municipio,direccion_residencia,telefono_1) VALUES (\\\'3\\\',\\\'902\\\',\\\'INGELCOR LTDA\\\',\\\'INGELCOR\\\',\\\'1\\\',\\\'00000427\\\',\\\'CALLE 61 No. 7 - 52\\\',\\\'7854745\\\')',NULL),(0000000154,00000014,'2009-07-14 15:32:34','Modificar consorciado','UPDATE pance_sucursales SET codigo=\\\'002\\\', id_empresa=\\\'901\\\', nombre=\\\'ANDINA S.A.\\\', nombre_corto=\\\'ANDINA\\\', activo=\\\'1\\\', id_municipio=\\\'00513\\\', direccion_residencia=\\\'CARRERA 3 C No. 20-06\\\', telefono_1=\\\'8948484\\\', telefono_2=NULL, celular=NULL WHERE id = \\\'90000\\\'',NULL),(0000000155,00000014,'2009-07-14 15:32:47','Modificar consorciado','UPDATE pance_sucursales SET codigo=\\\'004\\\', id_empresa=\\\'903\\\', nombre=\\\'ENERCON LTDA\\\', nombre_corto=\\\'ENERCON\\\', activo=\\\'1\\\', id_municipio=\\\'00829\\\', direccion_residencia=\\\'CARRERA 12 CALLE 19 C.CIAL FIDUCENTRO LOCAL F207\\\', telefono_1=\\\'3354801\\\', telefono_2=NULL, celular=NULL WHERE id = \\\'90001\\\'',NULL),(0000000156,00000014,'2009-07-14 15:36:43','Adicionar clientes','INSERT INTO pance_terceros (documento_identidad,tipo_persona,id_tipo_documento,razon_social,nombre_comercial,fecha_ingreso,id_municipio_documento,id_municipio_residencia,direccion_principal,telefono_principal,cliente) VALUES (\\\'860005224\\\',\\\'2\\\',\\\'901\\\',\\\'BAVARIA S.A.\\\',\\\'BAVARIA S.A.\\\',\\\'2009-02-01\\\',\\\'00000149\\\',\\\'90000151\\\',\\\'CALLE 94 No. 7A - 47\\\',\\\'4249000\\\',\\\'1\\\')',NULL),(0000000157,00000016,'2009-07-14 15:44:36','Adicionar requerimiento','INSERT INTO pance_requerimientos_clientes (id_sede,tipo_solicitud,fecha_ingreso,descripcion,id_sucursal,observaciones,nombre_contacto,estado_consorciado) VALUES (\\\'00000002\\\',\\\'E\\\',\\\'2009-07-01\\\',\\\'Prueba\\\',\\\'90003\\\',\\\'Prueba 2\\\',\\\'Juan Perez\\\',\\\'1\\\')',NULL),(0000000158,00000014,'2009-07-14 15:46:33','Adicionar clientes','INSERT INTO pance_terceros (documento_identidad,tipo_persona,id_tipo_documento,razon_social,nombre_comercial,fecha_ingreso,id_municipio_documento,id_municipio_residencia,direccion_principal,telefono_principal,cliente) VALUES (\\\'900136638\\\',\\\'2\\\',\\\'901\\\',\\\'CERVECERIA DEL VALLE S.A.\\\',\\\'CERVALLE\\\',\\\'2009-02-01\\\',\\\'00001042\\\',\\\'90001044\\\',\\\'KM 5 VIA AUTOPISTA CALI YUMBO\\\',\\\'6919400\\\',\\\'1\\\')',NULL),(0000000159,00000014,'2009-07-14 15:47:21','Eliminar sede','DELETE FROM pance_sedes_clientes WHERE id = \\\'00000002\\\'',NULL),(0000000160,00000014,'2009-07-14 15:50:05','Adicionar cargo','INSERT INTO pance_cargos (codigo_interno,nombre,interno) VALUES (\\\'1\\\',\\\'INGENIERO DE PROYECTOS\\\',\\\'0\\\')',NULL),(0000000161,00000014,'2009-07-14 15:50:27','Adicionar cargo','INSERT INTO pance_cargos (codigo_interno,nombre,interno) VALUES (\\\'2\\\',\\\'JEFE DE DEPOSITO\\\',\\\'0\\\')',NULL),(0000000162,00000014,'2009-07-14 15:50:41','Adicionar cargo','INSERT INTO pance_cargos (codigo_interno,nombre,interno) VALUES (\\\'3\\\',\\\'JEFE DE VENTAS\\\',\\\'0\\\')',NULL),(0000000163,00000014,'2009-07-14 15:53:00','Adicionar sede','INSERT INTO pance_sedes_clientes (id_cliente,nombre_sede,id_sucursal,nombre_contacto,id_cargo,id_municipios,direccion,telefono_principal) VALUES (\\\'90000004\\\',\\\'TECHO\\\',\\\'90002\\\',\\\'JESUS MAURICIO CHAVARRO\\\',\\\'901\\\',\\\'00000149\\\',\\\'AV. BOYACA No. 9 - 04\\\',\\\'4249000\\\')',NULL),(0000000164,00000016,'2009-07-14 15:53:09','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-07-14 15:53:09\\\',\\\'0001\\\',\\\'192.168.0.253\\\')',NULL),(0000000165,00000014,'2009-07-14 15:56:43','Adicionar sede','INSERT INTO pance_sedes_clientes (id_cliente,nombre_sede,id_sucursal,nombre_contacto,id_cargo,id_municipios,direccion,telefono_principal) VALUES (\\\'90000004\\\',\\\'PRUEBA\\\',\\\'90001\\\',\\\'JAMIR\\\',\\\'902\\\',\\\'00001002\\\',\\\'CALLE 99\\\',\\\'44444\\\')',NULL),(0000000166,00000014,'2009-07-14 15:59:24','Adicionar requerimiento','INSERT INTO pance_requerimientos_clientes (id_sede,tipo_solicitud,fecha_ingreso,descripcion,id_sucursal,estado_consorciado) VALUES (\\\'00000003\\\',\\\'P\\\',\\\'2009-05-26\\\',\\\'ILUMINACION VIA BAHIA VENTAS\\\',\\\'90002\\\',\\\'1\\\')',NULL),(0000000167,00000014,'2009-07-14 15:59:56','Modificar requerimiento','UPDATE pance_requerimientos_clientes SET descripcion=\\\'ILUMINACION VIA BAHIA VENTAS\\\', observaciones=NULL, nombre_contacto=NULL, estado_consorciado=\\\'2\\\', fecha_ingreso_sistema=\\\'2009-07-14 15:07:56\\\' WHERE id = \\\'00000002\\\'',NULL),(0000000168,00000014,'2009-07-14 16:02:52','Adicionar requerimiento','INSERT INTO pance_requerimientos_clientes (id_sede,tipo_solicitud,fecha_ingreso,descripcion,id_sucursal,estado_consorciado) VALUES (\\\'00000003\\\',\\\'M\\\',\\\'2009-07-14\\\',\\\'MANTENIMIENTO TRANSFORMADORES DE BOYACA\\\',\\\'90000\\\',\\\'1\\\')',NULL),(0000000169,00000014,'2009-07-14 16:12:01','Adicionar cotización','UPDATE pance_requerimientos_clientes SET fecha_visita=\\\'2009-07-14\\\', fecha_envio=\\\'2009-07-14 16:07:01\\\', observaciones_visita=NULL, estado_cotizacion=\\\'1\\\', estado_cotizacion_cliente=\\\'1\\\', valor_mano_obra_cotizacion=\\\'5000000\\\', valor_materiales_cotizacion=\\\'2500000\\\', costo_directo=\\\'7500000\\\', impuesto=\\\'16\\\', costo_impuesto=\\\'8700000\\\', forma_pago=\\\'0\\\', porcentaje_anticipo=\\\'15\\\', porcentaje_mano_obra=\\\'80\\\', porcentaje_materiales=\\\'100\\\' WHERE id = \\\'00000002\\\'',NULL),(0000000170,00000014,'2009-07-14 16:12:01','Adicionar cotización','INSERT INTO pance_cotizaciones (id_requerimiento,numero_cotizacion,numero_cotizacion_consorciado,fecha_registro_cotizacion_consorciado) VALUES (\\\'00000002\\\',\\\'001\\\',\\\'002\\\',\\\'2009-07-14 16:07:01\\\')',NULL),(0000000171,00000014,'2009-07-14 16:13:54','Modificar cotización','UPDATE pance_requerimientos_clientes SET estado_cotizacion_cliente=\\\'1\\\', valor_mano_obra_cotizacion=\\\'5000000.00\\\', valor_materiales_cotizacion=\\\'2500000.00\\\', costo_directo=\\\'7500000.00\\\', porcentaje_administracion_cotizacion=NULL, costo_administracion_cotizacion=NULL, porcentaje_imprevistos_cotizacion=NULL, costo_imprevistos_cotizacion=NULL, porcentaje_utilidad=NULL, costo_utilidad=NULL, impuesto=\\\'16.00\\\', costo_impuesto=\\\'8700000.00\\\', forma_pago=\\\'0\\\', porcentaje_anticipo=\\\'15.00\\\', porcentaje_mano_obra=\\\'80.00\\\', porcentaje_materiales=\\\'99.99\\\' WHERE id = \\\'00000002\\\'',NULL),(0000000172,00000014,'2009-07-14 16:15:01','Modificar requerimiento','UPDATE pance_requerimientos_clientes SET descripcion=\\\'MANTENIMIENTO TRANSFORMADORES DE BOYACA\\\', observaciones=NULL, nombre_contacto=NULL, estado_consorciado=\\\'2\\\', fecha_ingreso_sistema=\\\'2009-07-14 16:07:01\\\' WHERE id = \\\'00000003\\\'',NULL),(0000000173,00000014,'2009-07-14 16:17:04','Adicionar cotización','UPDATE pance_requerimientos_clientes SET fecha_visita=\\\'2009-07-14\\\', fecha_envio=NULL, observaciones_visita=NULL, estado_cotizacion=\\\'1\\\', estado_cotizacion_cliente=\\\'0\\\', valor_mano_obra_cotizacion=\\\'3000000\\\', valor_materiales_cotizacion=\\\'1500000\\\', costo_directo=\\\'4500000\\\', impuesto=\\\'16\\\', costo_impuesto=\\\'5220000\\\', forma_pago=\\\'1\\\', porcentaje_anticipo=\\\'10\\\', porcentaje_mano_obra=\\\'80\\\', porcentaje_materiales=\\\'100\\\' WHERE id = \\\'00000003\\\'',NULL),(0000000174,00000014,'2009-07-14 16:17:04','Adicionar cotización','INSERT INTO pance_cotizaciones (id_requerimiento,numero_cotizacion,numero_cotizacion_consorciado) VALUES (\\\'00000003\\\',\\\'003\\\',\\\'004\\\')',NULL),(0000000175,00000014,'2009-07-14 16:25:36','Modificar cotización','UPDATE pance_requerimientos_clientes SET estado_cotizacion_cliente=\\\'1\\\', valor_mano_obra_cotizacion=\\\'5000000.00\\\', valor_materiales_cotizacion=\\\'2500000.00\\\', costo_directo=\\\'7500000.00\\\', porcentaje_administracion_cotizacion=NULL, costo_administracion_cotizacion=NULL, porcentaje_imprevistos_cotizacion=NULL, costo_imprevistos_cotizacion=NULL, porcentaje_utilidad=NULL, costo_utilidad=NULL, impuesto=\\\'16.00\\\', costo_impuesto=\\\'8700000.00\\\', forma_pago=\\\'0\\\', porcentaje_anticipo=\\\'15.00\\\', porcentaje_mano_obra=\\\'80.00\\\', porcentaje_materiales=\\\'99.99\\\' WHERE id = \\\'00000002\\\'',NULL),(0000000176,00000014,'2009-07-14 16:35:18','Modificar consorciado','UPDATE pance_sucursales SET codigo=\\\'004\\\', id_empresa=\\\'903\\\', nombre=\\\'ENERCON LTDA\\\', nombre_corto=\\\'ENERCON\\\', activo=\\\'1\\\', id_municipio=\\\'00829\\\', direccion_residencia=\\\'CARRERA 12 CALLE 19 C.CIAL FIDUCENTRO LOCAL F207\\\', telefono_1=\\\'3354801\\\', telefono_2=NULL, celular=NULL WHERE id = \\\'90001\\\'',NULL),(0000000177,00000014,'2009-07-14 16:35:46','Modificar empresas','UPDATE pance_terceros SET documento_identidad=\\\'900192661\\\', tipo_persona=\\\'2\\\', id_tipo_documento=\\\'901\\\', primer_nombre=NULL, segundo_nombre=NULL, primer_apellido=NULL, segundo_apellido=NULL, razon_social=\\\'ENERGIA ELECTRICA Y CONSTRUCCIONES LTDA\\\', nombre_comercial=\\\'ENERCON LTDA\\\', id_municipio_documento=\\\'00000829\\\', id_municipio_residencia=\\\'90000831\\\', direccion_principal=\\\'CARRERA 12 CALLE 19 C.CIAL FIDUCENTRO LOCAL F207\\\', telefono_principal=\\\'3354801\\\', fax=NULL, celular=NULL, correo=NULL, sitio_web=NULL WHERE id = \\\'90000003\\\'',NULL),(0000000178,00000014,'2009-07-14 16:35:47','Modificar empresas','UPDATE pance_empresas SET codigo=\\\'004\\\', razon_social=\\\'ENERGIA ELECTRICA Y CONSTRUCCIONES LTDA\\\', nombre_corto=\\\'ENERCON\\\', fecha_cierre=NULL, activo=\\\'1\\\', id_tercero=\\\'90000003\\\', id_actividad_principal=\\\'9000\\\', id_actividad_secundaria=\\\'9001\\\', regimen=\\\'1\\\', retiene_fuente=\\\'1\\\', autoretenedor=\\\'0\\\', retiene_iva=\\\'0\\\', retiene_ica=\\\'1\\\', gran_contribuyente=\\\'0\\\' WHERE id = \\\'903\\\'',NULL),(0000000179,00000020,'2009-07-22 16:43:04','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-07-22 16:43:04\\\',\\\'0001\\\',\\\'192.168.0.103\\\')',NULL),(0000000180,00000021,'2009-07-22 16:43:04','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-07-22 16:43:04\\\',\\\'0001\\\',\\\'192.168.0.103\\\')',NULL),(0000000181,00000022,'2009-07-22 16:51:57','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-07-22 16:51:57\\\',\\\'0001\\\',\\\'192.168.0.103\\\')',NULL),(0000000182,00000023,'2009-07-22 17:12:09','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-07-22 17:12:09\\\',\\\'0001\\\',\\\'192.168.0.103\\\')',NULL),(0000000183,00000024,'2009-07-22 17:23:44','Notificar','UPDATE pance_requerimientos_clientes SET notificado=\\\'1\\\' WHERE id = \\\'00000002\\\'',NULL),(0000000184,00000024,'2009-07-22 17:24:07','Notificar','UPDATE pance_requerimientos_clientes SET notificado=\\\'1\\\' WHERE id = \\\'00000001\\\'',NULL),(0000000185,00000024,'2009-07-22 17:29:29','Adicionar requerimiento','INSERT INTO pance_requerimientos_clientes (id_sede,tipo_solicitud,fecha_ingreso,fecha_ingreso_sistema,descripcion,id_sucursal,observaciones,nombre_contacto,persona_recibe,medio_recibo) VALUES (\\\'00000004\\\',\\\'M\\\',\\\'2009-07-22\\\',\\\'2009-07-22 17:07:28\\\',\\\'1\\\',\\\'90002\\\',\\\'1\\\',\\\'JESUS MAURICIO CHAVARRO\\\',\\\'1\\\',\\\'1\\\')',NULL),(0000000186,00000024,'2009-07-22 17:29:41','Adicionar requerimiento','INSERT INTO pance_requerimientos_clientes (id_sede,tipo_solicitud,fecha_ingreso,fecha_ingreso_sistema,descripcion,id_sucursal,observaciones,nombre_contacto,persona_recibe,medio_recibo) VALUES (\\\'00000004\\\',\\\'M\\\',\\\'2009-07-22\\\',\\\'2009-07-22 17:07:40\\\',\\\'12\\\',\\\'90002\\\',\\\'1\\\',\\\'JESUS MAURICIO CHAVARRO\\\',\\\'1\\\',\\\'1\\\')',NULL),(0000000187,00000025,'2009-07-22 17:30:53','Eliminar requerimiento','DELETE FROM pance_requerimientos_clientes WHERE id = \\\'00000003\\\'',NULL),(0000000188,00000025,'2009-07-22 17:30:56','Eliminar requerimiento','DELETE FROM pance_requerimientos_clientes WHERE id = \\\'00000004\\\'',NULL),(0000000189,00000025,'2009-07-22 17:31:03','Adicionar requerimiento','INSERT INTO pance_requerimientos_clientes (id_sede,tipo_solicitud,fecha_ingreso,fecha_ingreso_sistema,descripcion,id_sucursal,observaciones,nombre_contacto,persona_recibe,medio_recibo) VALUES (\\\'00000004\\\',\\\'M\\\',\\\'2009-07-22\\\',\\\'2009-07-22 17:07:03\\\',\\\'1\\\',\\\'90002\\\',\\\'1\\\',\\\'JESUS MAURICIO CHAVARRO\\\',\\\'1\\\',\\\'1\\\')',NULL),(0000000190,00000025,'2009-07-22 17:31:44','Notificar','UPDATE pance_requerimientos_clientes SET notificado=\\\'1\\\' WHERE id = \\\'00000005\\\'',NULL),(0000000191,00000025,'2009-07-22 17:34:27','Generar cotización','INSERT INTO pance_cotizaciones (id_requerimiento,numero_cotizacion,numero_cotizacion_consorciado,estado_cotizacion_cliente,estado,valor_mano_obra_cotizacion,valor_materiales_cotizacion,costo_directo,porcentaje_administracion_cotizacion,costo_administracion_cotizacion,porcentaje_imprevistos_cotizacion,costo_imprevistos_cotizacion,porcentaje_utilidad,costo_utilidad,impuesto,costo_impuesto,forma_pago,porcentaje_anticipo,porcentaje_mano_obra,porcentaje_materiales,fecha_registro_cotizacion_consorciado) VALUES (\\\'00000005\\\',\\\'1\\\',\\\'1\\\',\\\'0\\\',\\\'1\\\',\\\'12000\\\',\\\'15000\\\',\\\'27000\\\',\\\'12\\\',\\\'30000\\\',\\\'12\\\',\\\'30000\\\',\\\'12\\\',\\\'30000\\\',\\\'16.00\\\',\\\'31320\\\',\\\'0\\\',\\\'12\\\',\\\'12\\\',\\\'12\\\',\\\'2009-07-22 17:07:27\\\')','Unknown column \\\'estado_cotizacion_cliente\\\' in \\\'field list\\\''),(0000000192,00000025,'2009-07-22 17:34:27','Generar cotización','UPDATE pance_requerimientos_clientes SET fecha_visita=\\\'2009-07-22\\\', observaciones_visita=\\\'1\\\', estado_aprobacion_requerimiento=\\\'1\\\' WHERE id = \\\'00000005\\\'',NULL),(0000000193,00000025,'2009-07-22 17:40:22','Notificar','UPDATE pance_requerimientos_clientes SET notificado=\\\'1\\\' WHERE id = \\\'00000005\\\'',NULL),(0000000194,00000025,'2009-07-22 17:43:15','Generar cotización','INSERT INTO pance_cotizaciones (id_requerimiento,numero_cotizacion,numero_cotizacion_consorciado,estado_cotizacion_cliente,estado,valor_mano_obra_cotizacion,valor_materiales_cotizacion,costo_directo,porcentaje_administracion_cotizacion,costo_administracion_cotizacion,porcentaje_imprevistos_cotizacion,costo_imprevistos_cotizacion,porcentaje_utilidad,costo_utilidad,impuesto,forma_pago,porcentaje_anticipo,porcentaje_mano_obra,porcentaje_materiales,fecha_registro_cotizacion_consorciado) VALUES (\\\'00000005\\\',\\\'1\\\',\\\'1\\\',\\\'0\\\',\\\'1\\\',\\\'1\\\',\\\'1\\\',\\\'2\\\',\\\'1\\\',\\\'0\\\',\\\'1\\\',\\\'0\\\',\\\'1\\\',\\\'0\\\',\\\'10.00\\\',\\\'0\\\',\\\'1\\\',\\\'1\\\',\\\'1\\\',\\\'2009-07-22 17:07:15\\\')','Unknown column \\\'estado_cotizacion_cliente\\\' in \\\'field list\\\''),(0000000195,00000025,'2009-07-22 17:43:15','Generar cotización','UPDATE pance_requerimientos_clientes SET fecha_visita=\\\'2009-07-22\\\', observaciones_visita=\\\'1\\\', estado_aprobacion_requerimiento=\\\'1\\\' WHERE id = \\\'00000005\\\'',NULL),(0000000196,00000025,'2009-07-22 17:47:06','Notificar','UPDATE pance_requerimientos_clientes SET notificado=\\\'1\\\' WHERE id = \\\'00000005\\\'',NULL),(0000000197,00000025,'2009-07-22 17:47:38','Generar cotización','INSERT INTO pance_cotizaciones (id_requerimiento,numero_cotizacion,numero_cotizacion_consorciado,estado_cotizacion_cliente,estado,valor_mano_obra_cotizacion,valor_materiales_cotizacion,costo_directo,porcentaje_administracion_cotizacion,costo_administracion_cotizacion,porcentaje_imprevistos_cotizacion,costo_imprevistos_cotizacion,porcentaje_utilidad,costo_utilidad,impuesto,costo_impuesto,forma_pago,porcentaje_anticipo,porcentaje_mano_obra,porcentaje_materiales,fecha_registro_cotizacion_consorciado) VALUES (\\\'00000005\\\',\\\'1\\\',\\\'1\\\',\\\'0\\\',\\\'1\\\',\\\'10000\\\',\\\'12000\\\',\\\'22000\\\',\\\'12\\\',\\\'25000\\\',\\\'12\\\',\\\'25000\\\',\\\'12\\\',\\\'25000\\\',\\\'16.00\\\',\\\'25520\\\',\\\'0\\\',\\\'1\\\',\\\'1\\\',\\\'1\\\',\\\'2009-07-22 17:07:38\\\')','Unknown column \\\'estado_cotizacion_cliente\\\' in \\\'field list\\\''),(0000000198,00000025,'2009-07-22 17:47:38','Generar cotización','UPDATE pance_requerimientos_clientes SET fecha_visita=\\\'2009-07-22\\\', observaciones_visita=\\\'1\\\', estado_aprobacion_requerimiento=\\\'1\\\' WHERE id = \\\'00000005\\\'',NULL),(0000000199,00000025,'2009-07-22 17:51:52','Notificar','UPDATE pance_requerimientos_clientes SET notificado=\\\'1\\\' WHERE id = \\\'00000005\\\'',NULL),(0000000200,00000025,'2009-07-22 17:52:27','Generar cotización','INSERT INTO pance_cotizaciones (id_requerimiento,numero_cotizacion,numero_cotizacion_consorciado,estado_cotizacion_cliente,estado,valor_mano_obra_cotizacion,valor_materiales_cotizacion,costo_directo,porcentaje_administracion_cotizacion,costo_administracion_cotizacion,porcentaje_imprevistos_cotizacion,costo_imprevistos_cotizacion,porcentaje_utilidad,costo_utilidad,impuesto,costo_impuesto,forma_pago,porcentaje_anticipo,porcentaje_mano_obra,porcentaje_materiales,fecha_registro_cotizacion_consorciado) VALUES (\\\'00000005\\\',\\\'1\\\',\\\'1\\\',\\\'0\\\',\\\'1\\\',\\\'12000\\\',\\\'14000\\\',\\\'26000\\\',\\\'12\\\',\\\'29000\\\',\\\'12\\\',\\\'29000\\\',\\\'10\\\',\\\'29000\\\',\\\'16.00\\\',\\\'30160\\\',\\\'0\\\',\\\'12\\\',\\\'12\\\',\\\'12\\\',\\\'2009-07-22 17:07:27\\\')',NULL),(0000000201,00000025,'2009-07-22 17:52:27','Generar cotización','UPDATE pance_requerimientos_clientes SET fecha_visita=\\\'2009-07-22\\\', observaciones_visita=\\\'1\\\', estado_aprobacion_requerimiento=\\\'1\\\' WHERE id = \\\'00000005\\\'',NULL),(0000000202,00000025,'2009-07-22 17:55:43','Notificar','UPDATE pance_requerimientos_clientes SET notificado=\\\'1\\\' WHERE id = \\\'00000005\\\'',NULL),(0000000203,00000025,'2009-07-22 18:06:34','Notificar','UPDATE pance_requerimientos_clientes SET notificado=\\\'1\\\' WHERE id = \\\'00000005\\\'',NULL),(0000000204,00000025,'2009-07-22 18:06:36','Notificar','UPDATE pance_requerimientos_clientes SET notificado=\\\'1\\\' WHERE id = \\\'00000005\\\'',NULL),(0000000205,00000025,'2009-07-22 18:06:38','Notificar','UPDATE pance_requerimientos_clientes SET notificado=\\\'1\\\' WHERE id = \\\'00000005\\\'',NULL),(0000000206,00000025,'2009-07-22 18:07:17','Notificar','UPDATE pance_requerimientos_clientes SET notificado=\\\'1\\\' WHERE id = \\\'00000005\\\'',NULL),(0000000207,00000025,'2009-07-22 18:08:07','Notificar','UPDATE pance_requerimientos_clientes SET notificado=\\\'1\\\' WHERE id = \\\'00000005\\\'',NULL),(0000000208,00000025,'2009-07-22 18:09:01','Aprobar cotización','UPDATE pance_cotizaciones SET estado=\\\'2\\\', observaciones_aprobacion_cliente=\\\'1\\\', fecha_registro_aprobacion_clientes=\\\'2009-07-22\\\', fecha_registro_aprobacion_sistema=\\\'2009-07-22 18:07:01\\\' WHERE id_requerimiento = \\\'00000005\\\'',NULL),(0000000209,00000025,'2009-07-22 18:09:09','Anular cotización','UPDATE pance_cotizaciones SET estado=\\\'3\\\' WHERE id_requerimiento = \\\'00000005\\\'',NULL),(0000000210,00000025,'2009-07-22 18:09:27','Notificar','UPDATE pance_requerimientos_clientes SET notificado=\\\'1\\\' WHERE id = \\\'00000005\\\'',NULL),(0000000211,00000025,'2009-07-22 18:09:59','Modificar requerimiento','UPDATE pance_requerimientos_clientes SET id_sede=\\\'00000004\\\', tipo_solicitud=\\\'M\\\', fecha_ingreso=\\\'2009-07-22\\\', fecha_ingreso_sistema=NULL, descripcion=\\\'* Este programa es software libre: usted puede redistribuirlo y/o\n* modificarlo  bajo los tÃ©rminos de la Licencia PÃºblica General GNU\n* publicada por la FundaciÃ³n para el Software Libre, ya sea la versiÃ³n 3\n* de la Licencia, o (a su elecciÃ³n) cualquier versiÃ³n posterior.\n\\\', id_sucursal=\\\'90002\\\', observaciones=NULL, nombre_contacto=\\\'JESUS MAURICIO CHAVARRO\\\', persona_recibe=\\\'1\\\', medio_recibo=\\\'1\\\' WHERE id = \\\'00000005\\\'',NULL),(0000000212,00000025,'2009-07-22 18:10:03','Notificar','UPDATE pance_requerimientos_clientes SET notificado=\\\'1\\\' WHERE id = \\\'00000005\\\'',NULL),(0000000213,00000025,'2009-07-22 18:10:22','Notificar','UPDATE pance_requerimientos_clientes SET notificado=\\\'1\\\' WHERE id = \\\'00000005\\\'',NULL),(0000000214,00000025,'2009-07-22 18:10:53','Notificar','UPDATE pance_requerimientos_clientes SET notificado=\\\'1\\\' WHERE id = \\\'00000005\\\'',NULL),(0000000215,00000025,'2009-07-22 18:11:23','Notificar','UPDATE pance_requerimientos_clientes SET notificado=\\\'1\\\' WHERE id = \\\'00000005\\\'',NULL),(0000000216,00000025,'2009-07-22 18:11:38','Notificar','UPDATE pance_requerimientos_clientes SET notificado=\\\'1\\\' WHERE id = \\\'00000005\\\'',NULL),(0000000217,00000025,'2009-07-22 18:12:23','Notificar','UPDATE pance_requerimientos_clientes SET notificado=\\\'1\\\' WHERE id = \\\'00000005\\\'',NULL),(0000000218,00000025,'2009-07-22 18:15:31','Notificar','UPDATE pance_requerimientos_clientes SET notificado=\\\'1\\\' WHERE id = \\\'00000005\\\'',NULL),(0000000219,00000025,'2009-07-22 18:18:53','Aprobar cotización','UPDATE pance_cotizaciones SET estado=\\\'2\\\', observaciones_aprobacion_cliente=NULL, fecha_registro_aprobacion_clientes=\\\'2009-07-22\\\', fecha_registro_aprobacion_sistema=\\\'2009-07-22 18:07:53\\\' WHERE id_requerimiento = \\\'00000005\\\'',NULL),(0000000220,00000026,'2009-07-22 18:36:17','Notificar','UPDATE pance_requerimientos_clientes SET notificado=\\\'1\\\' WHERE id = \\\'00000005\\\'',NULL),(0000000221,00000027,'2009-07-30 14:43:56','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-07-30 14:43:56\\\',\\\'0001\\\',\\\'192.168.0.107\\\')',NULL),(0000000222,00000028,'2009-07-30 14:58:17','Adicionar clientes','INSERT INTO pance_terceros (documento_identidad,tipo_persona,id_tipo_documento,razon_social,nombre_comercial,fecha_ingreso,id_municipio_documento,id_municipio_residencia,direccion_principal,telefono_principal,cliente) VALUES (\\\'890900168\\\',\\\'2\\\',\\\'901\\\',\\\'CERVECERIA UNION S.AA\\\',\\\'CERVUNION\\\',\\\'2009-02-02\\\',\\\'00000059\\\',\\\'90000061\\\',\\\'CARRERA 50 No. 38-39\\\',\\\'1\\\',\\\'1\\\')',NULL),(0000000223,00000028,'2009-07-30 14:59:07','Modificar clientes','UPDATE pance_terceros SET documento_identidad=\\\'890900168\\\', tipo_persona=\\\'2\\\', id_tipo_documento=\\\'901\\\', primer_nombre=NULL, segundo_nombre=NULL, primer_apellido=NULL, segundo_apellido=NULL, razon_social=\\\'CERVECERIA UNION S.A.\\\', nombre_comercial=\\\'CERVUNION\\\', genero=\\\'N\\\', fecha_ingreso=\\\'2009-02-02\\\', id_municipio_documento=\\\'00000059\\\', id_municipio_residencia=\\\'90000061\\\', direccion_principal=\\\'CARRERA 50 No. 38-39\\\', telefono_principal=\\\'1\\\', fax=NULL, celular=NULL, correo=NULL, sitio_web=NULL WHERE id = \\\'90000006\\\'',NULL),(0000000224,00000028,'2009-07-30 15:01:49','Adicionar clientes','INSERT INTO pance_terceros (documento_identidad,tipo_persona,id_tipo_documento,razon_social,nombre_comercial,fecha_ingreso,id_municipio_documento,id_municipio_residencia,direccion_principal,telefono_principal,cliente) VALUES (\\\'860528319\\\',\\\'2\\\',\\\'901\\\',\\\'IMPRESORA DEL SUR S.A.\\\',\\\'IMPRESUR S.A.\\\',\\\'2009-02-02\\\',\\\'00000149\\\',\\\'90000151\\\',\\\'CALLE 94 No.7A-47\\\',\\\'1\\\',\\\'1\\\')',NULL),(0000000225,00000028,'2009-07-30 15:03:43','Adicionar clientes','INSERT INTO pance_terceros (documento_identidad,tipo_persona,id_tipo_documento,razon_social,nombre_comercial,fecha_ingreso,id_municipio_documento,id_municipio_residencia,direccion_principal,telefono_principal,cliente) VALUES (\\\'830101107\\\',\\\'2\\\',\\\'901\\\',\\\'MALTERIA TROPICAL S.A.\\\',\\\'MALTERIA TROPICAL S.A.\\\',\\\'2009-02-02\\\',\\\'00000149\\\',\\\'90000151\\\',\\\'CALLE 94 No. 7A-47\\\',\\\'1\\\',\\\'1\\\')',NULL),(0000000226,00000028,'2009-07-30 15:08:28','Modificar sede','UPDATE pance_sedes_clientes SET id_cliente=\\\'90000004\\\', id_sucursal=\\\'90001\\\', nombre_sede=\\\'APARTADO\\\', nombre_contacto=\\\'MAURICIO CHAVARRO\\\', id_cargo=\\\'901\\\', id_municipios=\\\'00000013\\\', direccion=\\\'APARTADO\\\', telefono_principal=\\\'3216442945\\\', celular=NULL, correo=NULL WHERE id = \\\'00000004\\\'',NULL),(0000000227,00000028,'2009-07-30 15:08:56','Modificar sede','UPDATE pance_sedes_clientes SET id_cliente=\\\'90000004\\\', id_sucursal=\\\'90001\\\', nombre_sede=\\\'APARTADO\\\', nombre_contacto=\\\'JESUS MAURICIO CHAVARRO\\\', id_cargo=\\\'901\\\', id_municipios=\\\'00000013\\\', direccion=\\\'APARTADO\\\', telefono_principal=\\\'3216442945\\\', celular=NULL, correo=NULL WHERE id = \\\'00000004\\\'',NULL),(0000000228,00000028,'2009-07-30 15:10:55','Adicionar sede','INSERT INTO pance_sedes_clientes (id_cliente,nombre_sede,id_sucursal,nombre_contacto,id_cargo,id_municipios,direccion,telefono_principal) VALUES (\\\'90000004\\\',\\\'ARMENIA - VENTAS\\\',\\\'90001\\\',\\\'JESUS MAURICIO CHAVARRO\\\',\\\'901\\\',\\\'00000817\\\',\\\'CALLE 7 No. 14-34\\\',\\\'3216442945\\\')',NULL),(0000000229,00000028,'2009-07-30 15:12:20','Adicionar sede','INSERT INTO pance_sedes_clientes (id_cliente,nombre_sede,id_sucursal,nombre_contacto,id_cargo,id_municipios,direccion,telefono_principal) VALUES (\\\'90000004\\\',\\\'BARRANCABERMEJA - VENTAS\\\',\\\'90000\\\',\\\'JESUS MAURICIO CHAVARRO\\\',\\\'901\\\',\\\'00000849\\\',\\\'CARRERA 25 No. 48-35\\\',\\\'3216442945\\\')',NULL),(0000000230,00000028,'2009-07-30 15:14:15','Adicionar sede','INSERT INTO pance_sedes_clientes (id_cliente,nombre_sede,id_sucursal,nombre_contacto,id_cargo,id_municipios,direccion,telefono_principal) VALUES (\\\'90000008\\\',\\\'MALTERIA TROPICAL\\\',\\\'90003\\\',\\\'JESUS MAURICIO CHAVARRO\\\',\\\'901\\\',\\\'00000149\\\',\\\'CALLE 94 No. 7A-47\\\',\\\'3216442945\\\')',NULL),(0000000231,00000028,'2009-07-30 15:16:31','Adicionar sede','INSERT INTO pance_sedes_clientes (id_cliente,nombre_sede,id_sucursal,nombre_contacto,id_cargo,id_municipios,direccion,telefono_principal) VALUES (\\\'90000007\\\',\\\'IMPRESORA DEL SUR\\\',\\\'90002\\\',\\\'JESUS MAURICIO CHAVARRO\\\',\\\'901\\\',\\\'00001042\\\',\\\'CARRERA 35 No. 10-597 ACOPI\\\',\\\'3216442945\\\')',NULL),(0000000232,00000028,'2009-07-30 15:29:35','Adicionar requerimiento','INSERT INTO pance_requerimientos_clientes (id_sede,tipo_solicitud,fecha_ingreso,fecha_ingreso_sistema,descripcion,id_sucursal,nombre_contacto,persona_recibe,medio_recibo) VALUES (\\\'00000008\\\',\\\'P\\\',\\\'2009-02-04\\\',\\\'2009-07-30 15:07:35\\\',\\\'ACOMETIDA ELECTRICA PLANTA DE EMERGENCIA 625 KVA\\\',\\\'90002\\\',\\\'JESUS MAURICIO CHAVARRO\\\',\\\'ING. MARIO OCAÑA\\\',\\\'CORREO ELECTRONICO\\\')',NULL),(0000000233,00000028,'2009-07-30 15:32:39','Notificar','UPDATE pance_requerimientos_clientes SET notificado=\\\'1\\\' WHERE id = \\\'00000006\\\'',NULL),(0000000234,00000028,'2009-07-30 15:38:24','Notificar','UPDATE pance_requerimientos_clientes SET notificado=\\\'1\\\' WHERE id = \\\'00000006\\\'',NULL),(0000000235,00000028,'2009-07-30 15:57:27','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-07-30 15:57:27\\\',\\\'0001\\\',\\\'192.168.0.107\\\')',NULL),(0000000236,00000029,'2009-07-30 16:01:57','Modificar requerimiento','UPDATE pance_requerimientos_clientes SET id_sede=\\\'00000004\\\', tipo_solicitud=\\\'M\\\', fecha_ingreso=\\\'2009-07-22\\\', fecha_ingreso_sistema=NULL, descripcion=\\\'Este programa es software libre: usted puede redistribuirlo y/o\nmodificarlo  bajo los términos de la Licencia Pública General GNU\npublicada por la Fundación para el Software Libre, ya sea la versión 3  de la Licencia, o (a su elección)\\\', id_sucursal=\\\'90002\\\', observaciones=\\\'Este programa es software libre\\\', nombre_contacto=\\\'JESUS MAURICIO CHAVARRO\\\', persona_recibe=\\\'1\\\', medio_recibo=\\\'1\\\' WHERE id = \\\'00000005\\\'',NULL),(0000000237,00000029,'2009-07-30 16:04:46','Modificar requerimiento','UPDATE pance_requerimientos_clientes SET id_sede=\\\'00000004\\\', tipo_solicitud=\\\'M\\\', fecha_ingreso=\\\'2009-07-22\\\', fecha_ingreso_sistema=NULL, descripcion=\\\'Emergencia presentada por falta de mantenimiento en el grupo electrogeno 150 KW, 187.5 KVA\\\', id_sucursal=\\\'90002\\\', observaciones=\\\'Este programa es software libre\\\', nombre_contacto=\\\'JESUS MAURICIO CHAVARRO\\\', persona_recibe=\\\'1\\\', medio_recibo=\\\'1\\\' WHERE id = \\\'00000005\\\'',NULL),(0000000238,00000029,'2009-07-30 16:06:09','Notificar','UPDATE pance_requerimientos_clientes SET notificado=\\\'1\\\' WHERE id = \\\'00000006\\\'',NULL),(0000000239,00000029,'2009-07-30 16:09:56','Adicionar requerimiento','INSERT INTO pance_requerimientos_clientes (id_sede,tipo_solicitud,fecha_ingreso,fecha_ingreso_sistema,descripcion,id_sucursal,nombre_contacto) VALUES (\\\'00000003\\\',\\\'M\\\',\\\'2009-07-30\\\',\\\'2009-07-30 16:07:56\\\',\\\'1\\\',\\\'90002\\\',\\\'JESUS MAURICIO CHAVARRO\\\')',NULL),(0000000240,00000029,'2009-07-30 16:12:13','Adicionar requerimiento','INSERT INTO pance_requerimientos_clientes (id_sede,tipo_solicitud,fecha_ingreso,fecha_ingreso_sistema,descripcion,id_sucursal,nombre_contacto,notificado) VALUES (\\\'00000003\\\',\\\'M\\\',\\\'2009-07-30\\\',\\\'2009-07-30 16:07:13\\\',\\\'1\\\',\\\'90002\\\',\\\'JESUS MAURICIO CHAVARRO\\\',\\\'0\\\')',NULL),(0000000241,00000029,'2009-07-30 16:17:29','Notificar','UPDATE pance_requerimientos_clientes SET notificado=\\\'1\\\' WHERE id = \\\'00000006\\\'',NULL),(0000000242,00000029,'2009-07-30 16:17:35','Notificar','UPDATE pance_requerimientos_clientes SET notificado=\\\'1\\\' WHERE id = \\\'00000008\\\'',NULL),(0000000243,00000029,'2009-07-30 16:17:44','Notificar','UPDATE pance_requerimientos_clientes SET notificado=\\\'1\\\' WHERE id = \\\'00000005\\\'',NULL),(0000000244,00000029,'2009-07-30 16:18:37','Notificar','UPDATE pance_requerimientos_clientes SET notificado=\\\'1\\\' WHERE id = \\\'00000005\\\'',NULL),(0000000245,00000031,'2009-07-30 17:14:20','Generar cotización','INSERT INTO pance_cotizaciones (id_requerimiento,numero_cotizacion,numero_cotizacion_consorciado,estado,valor_mano_obra_cotizacion,valor_materiales_cotizacion,costo_directo,porcentaje_administracion_cotizacion,costo_administracion_cotizacion,porcentaje_imprevistos_cotizacion,costo_imprevistos_cotizacion,porcentaje_utilidad,costo_utilidad,impuesto,costo_impuesto,forma_pago,porcentaje_anticipo,fecha_registro_cotizacion_consorciado) VALUES (\\\'00000006\\\',\\\'002\\\',\\\'101\\\',\\\'1\\\',\\\'5000\\\',\\\'8000\\\',\\\'13000\\\',\\\'7\\\',\\\'910\\\',\\\'3\\\',\\\'390\\\',\\\'4\\\',\\\'520\\\',\\\'16.00\\\',\\\'100\\\',\\\'0\\\',\\\'0\\\',\\\'2009-07-30 17:07:20\\\')',NULL),(0000000246,00000031,'2009-07-30 17:14:20','Generar cotización','UPDATE pance_requerimientos_clientes SET fecha_visita=\\\'2009-07-30\\\', observaciones_visita=NULL, estado_aprobacion_requerimiento=\\\'1\\\', estado_cotizacion=\\\'1\\\' WHERE id = \\\'00000006\\\'',NULL),(0000000247,00000031,'2009-07-30 17:14:52','Notificar','UPDATE pance_requerimientos_clientes SET notificado=\\\'1\\\' WHERE id = \\\'00000002\\\'',NULL),(0000000248,00000031,'2009-07-30 17:18:57','Aprobar cotización','UPDATE pance_cotizaciones SET estado=\\\'2\\\', observaciones_aprobacion_cliente=NULL, fecha_registro_aprobacion_clientes=\\\'2009-07-30\\\', fecha_registro_aprobacion_sistema=\\\'2009-07-30 17:07:57\\\' WHERE id = \\\'000002\\\'',NULL),(0000000249,00000031,'2009-07-30 17:18:57','Aprobar cotización','UPDATE pance_requerimientos_clientes SET estado_cotizacion=\\\'2\\\' WHERE id = \\\'00000006\\\'',NULL),(0000000250,00000031,'2009-07-30 17:19:49','Exportar cotización','UPDATE pance_cotizaciones SET estado_cotizacion_cliente=\\\'1\\\' WHERE id = \\\'000002\\\'',NULL),(0000000251,00000032,'2009-08-03 14:44:31','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-08-03 14:44:31\\\',\\\'0001\\\',\\\'192.168.0.102\\\')',NULL),(0000000252,00000033,'2009-08-03 14:44:52','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-08-03 14:44:52\\\',\\\'0001\\\',\\\'192.168.0.102\\\')',NULL),(0000000253,00000034,'2009-08-03 14:44:57','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-08-03 14:44:57\\\',\\\'0001\\\',\\\'192.168.0.102\\\')',NULL),(0000000254,00000035,'2009-08-03 14:45:01','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-08-03 14:45:01\\\',\\\'0001\\\',\\\'192.168.0.102\\\')',NULL),(0000000255,00000036,'2009-08-03 14:45:05','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-08-03 14:45:05\\\',\\\'0001\\\',\\\'192.168.0.102\\\')',NULL),(0000000256,00000037,'2009-08-03 14:45:07','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-08-03 14:45:07\\\',\\\'0001\\\',\\\'192.168.0.102\\\')',NULL),(0000000257,00000038,'2009-08-03 14:45:10','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-08-03 14:45:10\\\',\\\'0001\\\',\\\'192.168.0.102\\\')',NULL),(0000000258,00000039,'2009-08-03 14:46:32','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-08-03 14:46:32\\\',\\\'0001\\\',\\\'192.168.0.102\\\')',NULL),(0000000259,00000040,'2009-08-03 14:50:43','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-08-03 14:50:43\\\',\\\'0001\\\',\\\'192.168.0.102\\\')',NULL),(0000000260,00000041,'2009-08-03 14:50:56','Modificar Preferencias','INSERT INTO pance_preferencias (tipo,variable,valor,usuario) VALUES (\\\'2\\\',\\\'impuesto\\\',\\\'16\\\',\\\'0001\\\')',NULL),(0000000261,00000041,'2009-08-03 14:51:17','Adicionar requerimiento','INSERT INTO pance_requerimientos_clientes (id_sede,tipo_solicitud,fecha_ingreso,fecha_ingreso_sistema,descripcion,id_sucursal,nombre_contacto,notificado) VALUES (\\\'00000005\\\',\\\'M\\\',\\\'2009-08-03\\\',\\\'2009-08-03 14:08:17\\\',\\\'1\\\',\\\'90001\\\',\\\'JESUS MAURICIO CHAVARRO\\\',\\\'0\\\')',NULL),(0000000262,00000041,'2009-08-03 14:51:32','Modificar requerimiento','UPDATE pance_requerimientos_clientes SET id_sede=\\\'00000005\\\', tipo_solicitud=\\\'M\\\', fecha_ingreso=\\\'2009-08-03\\\', descripcion=\\\'PRUEBA\\\', id_sucursal=\\\'90001\\\', observaciones=NULL, nombre_contacto=\\\'JESUS MAURICIO CHAVARRO\\\', telefono_contacto=\\\'1233\\\', persona_recibe=NULL, medio_recibo=NULL WHERE id = \\\'00000001\\\'',NULL),(0000000263,00000041,'2009-08-03 14:51:39','Notificar','UPDATE pance_requerimientos_clientes SET notificado=\\\'1\\\' WHERE id = \\\'00000001\\\'',NULL),(0000000264,00000041,'2009-08-03 14:53:20','Modificar Preferencias','UPDATE pance_preferencias SET tipo=\\\'2\\\', variable=\\\'impuesto\\\', valor=\\\'16\\\', usuario=\\\'0001\\\' WHERE usuario = \\\'0001\\\' AND variable LIKE \\\'impuesto\\\'',NULL),(0000000265,00000041,'2009-08-03 14:53:27','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-08-03 14:53:27\\\',\\\'0001\\\',\\\'192.168.0.102\\\')',NULL),(0000000266,00000042,'2009-08-03 14:57:09','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-08-03 14:57:09\\\',\\\'0001\\\',\\\'192.168.0.102\\\')',NULL),(0000000267,00000043,'2009-08-03 14:58:37','Generar cotización','INSERT INTO pance_cotizaciones (id_requerimiento,numero_cotizacion,numero_cotizacion_consorciado,estado,valor_mano_obra_cotizacion,valor_materiales_cotizacion,costo_directo,porcentaje_administracion_cotizacion,costo_administracion_cotizacion,porcentaje_imprevistos_cotizacion,costo_imprevistos_cotizacion,porcentaje_utilidad,costo_utilidad,impuesto,costo_impuesto,forma_pago,fecha_registro_cotizacion_consorciado) VALUES (\\\'00000001\\\',\\\'1\\\',\\\'q1\\\',\\\'1\\\',\\\'500000\\\',\\\'600000\\\',\\\'1100000\\\',\\\'5\\\',\\\'55000\\\',\\\'5\\\',\\\'55000\\\',\\\'5\\\',\\\'55000\\\',\\\'16\\\',\\\'8800\\\',\\\'0\\\',\\\'2009-08-03 14:08:37\\\')',NULL),(0000000268,00000043,'2009-08-03 14:58:38','Generar cotización','UPDATE pance_requerimientos_clientes SET fecha_visita=\\\'2009-08-03\\\', observaciones_visita=NULL, estado_aprobacion_requerimiento=\\\'1\\\', estado_cotizacion=\\\'1\\\' WHERE id = \\\'00000001\\\'',NULL),(0000000269,00000043,'2009-08-03 14:59:16','Aprobar cotización','UPDATE pance_cotizaciones SET estado=\\\'2\\\', observaciones_aprobacion_cliente=NULL, fecha_registro_aprobacion_clientes=\\\'2009-08-03\\\', fecha_registro_aprobacion_sistema=\\\'2009-08-03 14:08:16\\\' WHERE id = \\\'000001\\\'',NULL),(0000000270,00000043,'2009-08-03 14:59:16','Aprobar cotización','UPDATE pance_requerimientos_clientes SET estado_cotizacion=\\\'2\\\' WHERE id = \\\'00000001\\\'',NULL),(0000000271,00000044,'2009-08-03 15:21:24','Adicionar requerimiento','INSERT INTO pance_requerimientos_clientes (id_sede,tipo_solicitud,fecha_ingreso,fecha_ingreso_sistema,descripcion,id_sucursal,nombre_contacto,notificado) VALUES (\\\'00000003\\\',\\\'M\\\',\\\'2009-08-03\\\',\\\'2009-08-03 15:08:24\\\',\\\'1\\\',\\\'90002\\\',\\\'JESUS MAURICIO CHAVARRO\\\',\\\'0\\\')',NULL),(0000000272,00000044,'2009-08-03 15:21:29','Notificar','UPDATE pance_requerimientos_clientes SET notificado=\\\'1\\\' WHERE id = \\\'00000001\\\'',NULL),(0000000273,00000045,'2009-08-03 15:55:35','Generar cotización','INSERT INTO pance_cotizaciones (id_requerimiento,numero_cotizacion,numero_cotizacion_consorciado,estado,valor_mano_obra_cotizacion,valor_materiales_cotizacion,costo_directo,porcentaje_administracion_cotizacion,costo_administracion_cotizacion,porcentaje_imprevistos_cotizacion,costo_imprevistos_cotizacion,porcentaje_utilidad,costo_utilidad,impuesto,costo_impuesto,forma_pago,fecha_registro_cotizacion_consorciado) VALUES (\\\'00000001\\\',\\\'1\\\',\\\'1\\\',\\\'1\\\',\\\'600000\\\',\\\'400000\\\',\\\'1000000\\\',\\\'5\\\',\\\'50000\\\',\\\'10\\\',\\\'100000\\\',\\\'15\\\',\\\'150000\\\',\\\'16\\\',\\\'24000\\\',\\\'0\\\',\\\'2009-08-03 15:08:35\\\')',NULL),(0000000274,00000045,'2009-08-03 15:55:35','Generar cotización','UPDATE pance_requerimientos_clientes SET fecha_visita=\\\'2009-08-03\\\', observaciones_visita=\\\'PRUEBA\\\', estado_aprobacion_requerimiento=\\\'1\\\', estado_cotizacion=\\\'1\\\' WHERE id = \\\'00000001\\\'',NULL),(0000000275,00000045,'2009-08-03 15:55:58','Aprobar cotización','UPDATE pance_cotizaciones SET estado=\\\'2\\\', observaciones_aprobacion_cliente=\\\'APROBADA\\\', fecha_registro_aprobacion_clientes=\\\'2009-08-03\\\', fecha_registro_aprobacion_sistema=\\\'2009-08-03 15:08:58\\\' WHERE id = \\\'000001\\\'',NULL),(0000000276,00000045,'2009-08-03 15:55:58','Aprobar cotización','UPDATE pance_requerimientos_clientes SET estado_cotizacion=\\\'2\\\' WHERE id = \\\'00000001\\\'',NULL),(0000000277,00000045,'2009-08-03 15:56:39','Adicionar requerimiento','INSERT INTO pance_requerimientos_clientes (id_sede,tipo_solicitud,fecha_ingreso,fecha_ingreso_sistema,descripcion,id_sucursal,nombre_contacto,notificado) VALUES (\\\'00000003\\\',\\\'M\\\',\\\'2009-08-03\\\',\\\'2009-08-03 15:08:39\\\',\\\'2\\\',\\\'90002\\\',\\\'JESUS MAURICIO CHAVARRO\\\',\\\'0\\\')',NULL),(0000000278,00000045,'2009-08-03 15:56:43','Adicionar requerimiento','INSERT INTO pance_requerimientos_clientes (id_sede,tipo_solicitud,fecha_ingreso,fecha_ingreso_sistema,descripcion,id_sucursal,nombre_contacto,notificado) VALUES (\\\'00000003\\\',\\\'M\\\',\\\'2009-08-03\\\',\\\'2009-08-03 15:08:43\\\',\\\'3\\\',\\\'90002\\\',\\\'JESUS MAURICIO CHAVARRO\\\',\\\'0\\\')',NULL),(0000000279,00000045,'2009-08-03 15:56:48','Adicionar requerimiento','INSERT INTO pance_requerimientos_clientes (id_sede,tipo_solicitud,fecha_ingreso,fecha_ingreso_sistema,descripcion,id_sucursal,nombre_contacto,notificado) VALUES (\\\'00000003\\\',\\\'M\\\',\\\'2009-08-03\\\',\\\'2009-08-03 15:08:48\\\',\\\'4\\\',\\\'90002\\\',\\\'JESUS MAURICIO CHAVARRO\\\',\\\'0\\\')',NULL),(0000000280,00000045,'2009-08-03 15:56:52','Adicionar requerimiento','INSERT INTO pance_requerimientos_clientes (id_sede,tipo_solicitud,fecha_ingreso,fecha_ingreso_sistema,descripcion,id_sucursal,nombre_contacto,notificado) VALUES (\\\'00000003\\\',\\\'M\\\',\\\'2009-08-03\\\',\\\'2009-08-03 15:08:52\\\',\\\'5\\\',\\\'90002\\\',\\\'JESUS MAURICIO CHAVARRO\\\',\\\'0\\\')',NULL),(0000000281,00000045,'2009-08-03 15:57:30','Modificar requerimiento','UPDATE pance_requerimientos_clientes SET id_sede=\\\'00000004\\\', tipo_solicitud=\\\'M\\\', fecha_ingreso=\\\'2009-08-03\\\', descripcion=\\\'2\\\', id_sucursal=\\\'90000\\\', observaciones=NULL, nombre_contacto=\\\'JESUS MAURICIO CHAVARRO\\\', telefono_contacto=NULL, persona_recibe=NULL, medio_recibo=NULL WHERE id = \\\'00000002\\\'',NULL),(0000000282,00000045,'2009-08-03 15:57:44','Eliminar requerimiento','DELETE FROM pance_requerimientos_clientes WHERE id = \\\'00000005\\\'',NULL),(0000000283,00000045,'2009-08-03 15:58:00','Eliminar requerimiento','DELETE FROM pance_requerimientos_clientes WHERE id = \\\'00000002\\\'',NULL),(0000000284,00000045,'2009-08-03 15:58:10','Adicionar requerimiento','INSERT INTO pance_requerimientos_clientes (id_sede,tipo_solicitud,fecha_ingreso,fecha_ingreso_sistema,descripcion,id_sucursal,nombre_contacto,notificado) VALUES (\\\'00000006\\\',\\\'M\\\',\\\'2009-08-03\\\',\\\'2009-08-03 15:08:10\\\',\\\'2\\\',\\\'90000\\\',\\\'JESUS MAURICIO CHAVARRO\\\',\\\'0\\\')',NULL),(0000000285,00000045,'2009-08-03 15:58:19','Notificar','UPDATE pance_requerimientos_clientes SET notificado=\\\'1\\\' WHERE id = \\\'00000006\\\'',NULL),(0000000286,00000045,'2009-08-03 15:58:34','Notificar','UPDATE pance_requerimientos_clientes SET notificado=\\\'1\\\' WHERE id = \\\'00000003\\\'',NULL),(0000000287,00000045,'2009-08-03 15:58:41','Notificar','UPDATE pance_requerimientos_clientes SET notificado=\\\'1\\\' WHERE id = \\\'00000004\\\'',NULL),(0000000288,00000045,'2009-08-03 15:59:05','Visita sin oferta','UPDATE pance_requerimientos_clientes SET fecha_visita=\\\'2009-08-03\\\', observaciones_visita=\\\'NO ERA GRABE EL DAÑO\\\', estado_cotizacion=\\\'7\\\' WHERE id = \\\'00000003\\\'',NULL),(0000000289,00000045,'2009-08-03 15:59:58','Generar cotización','INSERT INTO pance_cotizaciones (id_requerimiento,numero_cotizacion,numero_cotizacion_consorciado,estado,valor_mano_obra_cotizacion,valor_materiales_cotizacion,costo_directo,impuesto,costo_impuesto,forma_pago,porcentaje_anticipo,fecha_registro_cotizacion_consorciado) VALUES (\\\'00000004\\\',\\\'2\\\',\\\'2W\\\',\\\'1\\\',\\\'1500000\\\',\\\'2000000\\\',\\\'3500000\\\',\\\'16\\\',\\\'560000\\\',\\\'0\\\',\\\'0\\\',\\\'2009-08-03 15:08:58\\\')',NULL),(0000000290,00000045,'2009-08-03 15:59:58','Generar cotización','UPDATE pance_requerimientos_clientes SET fecha_visita=\\\'2009-08-03\\\', observaciones_visita=\\\'PRUEBA NUMERO 2\\\', estado_aprobacion_requerimiento=\\\'1\\\', estado_cotizacion=\\\'1\\\' WHERE id = \\\'00000004\\\'',NULL),(0000000291,00000045,'2009-08-03 16:01:19','Generar cotización','INSERT INTO pance_cotizaciones (id_requerimiento,numero_cotizacion,numero_cotizacion_consorciado,estado,valor_mano_obra_cotizacion,valor_materiales_cotizacion,costo_directo,porcentaje_administracion_cotizacion,costo_administracion_cotizacion,porcentaje_imprevistos_cotizacion,costo_imprevistos_cotizacion,porcentaje_utilidad,costo_utilidad,impuesto,costo_impuesto,forma_pago,fecha_registro_cotizacion_consorciado) VALUES (\\\'00000006\\\',\\\'3\\\',\\\'3E\\\',\\\'1\\\',\\\'2000000\\\',\\\'5000000\\\',\\\'7000000\\\',\\\'2\\\',\\\'140000\\\',\\\'2\\\',\\\'140000\\\',\\\'5\\\',\\\'350000\\\',\\\'16\\\',\\\'56000\\\',\\\'0\\\',\\\'2009-08-03 16:08:19\\\')',NULL),(0000000292,00000045,'2009-08-03 16:01:20','Generar cotización','UPDATE pance_requerimientos_clientes SET fecha_visita=\\\'2009-08-03\\\', observaciones_visita=\\\'RECOTIZAR\\\', estado_aprobacion_requerimiento=\\\'1\\\', estado_cotizacion=\\\'1\\\' WHERE id = \\\'00000006\\\'',NULL),(0000000293,00000045,'2009-08-03 16:02:11','Recotizar cotización','UPDATE pance_cotizaciones SET estado=\\\'4\\\' WHERE id = \\\'000002\\\'',NULL),(0000000294,00000045,'2009-08-03 16:02:12','Recotizar cotización','INSERT INTO pance_cotizaciones (id_requerimiento,numero_cotizacion,consecutivo_cotizacion,numero_cotizacion_consorciado,estado,valor_mano_obra_cotizacion,valor_materiales_cotizacion,costo_directo,impuesto,costo_impuesto,forma_pago,porcentaje_anticipo,fecha_registro_cotizacion_consorciado) VALUES (\\\'00000004\\\',\\\'00000002\\\',\\\'1\\\',\\\'2W\\\',\\\'1\\\',\\\'1300000\\\',\\\'2000000\\\',\\\'3300000\\\',\\\'16.00\\\',\\\'528000\\\',\\\'0\\\',\\\'0.00\\\',\\\'2009-08-03 16:08:11\\\')',NULL),(0000000295,00000045,'2009-08-03 16:02:12','Recotizar cotización','UPDATE pance_requerimientos_clientes SET fecha_visita=\\\'2009-08-03\\\', observaciones_visita=\\\'PRUEBA NUMERO 2\\\', estado_aprobacion_requerimiento=\\\'1\\\', estado_cotizacion=\\\'1\\\' WHERE id = \\\'00000004\\\'',NULL),(0000000296,00000045,'2009-08-03 16:02:36','Exportar cotización','UPDATE pance_cotizaciones SET estado_cotizacion=\\\'1\\\' WHERE id = \\\'000001\\\'',NULL),(0000000297,00000045,'2009-08-03 16:06:02','Anular cotización','UPDATE pance_cotizaciones SET estado=\\\'3\\\' WHERE id = \\\'000003\\\'',NULL),(0000000298,00000045,'2009-08-03 16:06:03','Anular cotización','UPDATE pance_requerimientos_clientes SET estado_cotizacion=\\\'3\\\' WHERE id = \\\'00000006\\\'',NULL),(0000000299,00000045,'2009-08-03 16:07:45','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-08-03 16:07:45\\\',\\\'0001\\\',\\\'192.168.0.102\\\')',NULL),(0000000300,00000048,'2009-08-04 11:07:42','Adicionar requerimiento','INSERT INTO pance_requerimientos_clientes (id_sede,tipo_solicitud,fecha_ingreso,fecha_ingreso_sistema,descripcion,id_sucursal,nombre_contacto,notificado) VALUES (\\\'00000003\\\',\\\'M\\\',\\\'2009-08-04\\\',\\\'2009-08-04 11:08:42\\\',\\\'1\\\',\\\'90002\\\',\\\'JESUS MAURICIO CHAVARRO\\\',\\\'0\\\')',NULL),(0000000301,00000048,'2009-08-04 11:07:53','Adicionar requerimiento','INSERT INTO pance_requerimientos_clientes (id_sede,tipo_solicitud,fecha_ingreso,fecha_ingreso_sistema,descripcion,id_sucursal,nombre_contacto,notificado) VALUES (\\\'00000003\\\',\\\'M\\\',\\\'2009-08-04\\\',\\\'2009-08-04 11:08:53\\\',\\\'2\\\',\\\'90002\\\',\\\'JESUS MAURICIO CHAVARRO\\\',\\\'0\\\')',NULL),(0000000302,00000048,'2009-08-04 11:08:03','Adicionar requerimiento','INSERT INTO pance_requerimientos_clientes (id_sede,tipo_solicitud,fecha_ingreso,fecha_ingreso_sistema,descripcion,id_sucursal,nombre_contacto,notificado) VALUES (\\\'00000003\\\',\\\'M\\\',\\\'2009-08-04\\\',\\\'2009-08-04 11:08:03\\\',\\\'3\\\',\\\'90002\\\',\\\'JESUS MAURICIO CHAVARRO\\\',\\\'0\\\')',NULL),(0000000303,00000048,'2009-08-04 11:08:13','Adicionar requerimiento','INSERT INTO pance_requerimientos_clientes (id_sede,tipo_solicitud,fecha_ingreso,fecha_ingreso_sistema,descripcion,id_sucursal,nombre_contacto,notificado) VALUES (\\\'00000003\\\',\\\'M\\\',\\\'2009-08-04\\\',\\\'2009-08-04 11:08:13\\\',\\\'4\\\',\\\'90002\\\',\\\'JESUS MAURICIO CHAVARRO\\\',\\\'0\\\')',NULL),(0000000304,00000048,'2009-08-04 11:08:23','Adicionar requerimiento','INSERT INTO pance_requerimientos_clientes (id_sede,tipo_solicitud,fecha_ingreso,fecha_ingreso_sistema,descripcion,id_sucursal,nombre_contacto,notificado) VALUES (\\\'00000003\\\',\\\'M\\\',\\\'2009-08-04\\\',\\\'2009-08-04 11:08:23\\\',\\\'5\\\',\\\'90002\\\',\\\'JESUS MAURICIO CHAVARRO\\\',\\\'0\\\')',NULL),(0000000305,00000048,'2009-08-04 11:08:34','Adicionar requerimiento','INSERT INTO pance_requerimientos_clientes (id_sede,tipo_solicitud,fecha_ingreso,fecha_ingreso_sistema,descripcion,id_sucursal,nombre_contacto,notificado) VALUES (\\\'00000003\\\',\\\'M\\\',\\\'2009-08-04\\\',\\\'2009-08-04 11:08:34\\\',\\\'6\\\',\\\'90002\\\',\\\'JESUS MAURICIO CHAVARRO\\\',\\\'0\\\')',NULL),(0000000306,00000048,'2009-08-04 11:09:20','Modificar requerimiento','UPDATE pance_requerimientos_clientes SET id_sede=\\\'00000006\\\', tipo_solicitud=\\\'M\\\', fecha_ingreso=\\\'2009-08-04\\\', descripcion=\\\'PRUEBA NUMERO 1\\\', id_sucursal=\\\'90000\\\', observaciones=\\\'PARA COTIZAR\\\', nombre_contacto=\\\'JESUS MAURICIO CHAVARRO\\\', telefono_contacto=NULL, persona_recibe=NULL, medio_recibo=NULL WHERE id = \\\'00000001\\\'',NULL),(0000000307,00000048,'2009-08-04 11:10:21','Modificar requerimiento','UPDATE pance_requerimientos_clientes SET id_sede=\\\'00000003\\\', tipo_solicitud=\\\'M\\\', fecha_ingreso=\\\'2009-08-04\\\', descripcion=\\\'PRUEBA NUMERO 2\\\', id_sucursal=\\\'90000\\\', observaciones=\\\'PARA  VISITAR\\\', nombre_contacto=\\\'JESUS MAURICIO CHAVARRO\\\', telefono_contacto=NULL, persona_recibe=NULL, medio_recibo=NULL WHERE id = \\\'00000002\\\'',NULL),(0000000308,00000048,'2009-08-04 11:10:49','Modificar requerimiento','UPDATE pance_requerimientos_clientes SET id_sede=\\\'00000004\\\', tipo_solicitud=\\\'M\\\', fecha_ingreso=\\\'2009-08-04\\\', descripcion=\\\'PRUEBA NUMERO 3\\\', id_sucursal=\\\'90002\\\', observaciones=\\\'ANULAR\\\', nombre_contacto=\\\'JESUS MAURICIO CHAVARRO\\\', telefono_contacto=NULL, persona_recibe=NULL, medio_recibo=NULL WHERE id = \\\'00000003\\\'',NULL),(0000000309,00000048,'2009-08-04 11:11:20','Modificar requerimiento','UPDATE pance_requerimientos_clientes SET id_sede=\\\'00000008\\\', tipo_solicitud=\\\'E\\\', fecha_ingreso=\\\'2009-08-04\\\', descripcion=\\\'PRUEBA NUMERO 4\\\', id_sucursal=\\\'90003\\\', observaciones=NULL, nombre_contacto=\\\'JESUS MAURICIO CHAVARRO\\\', telefono_contacto=NULL, persona_recibe=NULL, medio_recibo=NULL WHERE id = \\\'00000004\\\'',NULL),(0000000310,00000048,'2009-08-04 11:11:46','Modificar requerimiento','UPDATE pance_requerimientos_clientes SET id_sede=\\\'00000007\\\', tipo_solicitud=\\\'P\\\', fecha_ingreso=\\\'2009-08-04\\\', descripcion=\\\'PRUEBA NUMERO 5\\\', id_sucursal=\\\'90002\\\', observaciones=NULL, nombre_contacto=\\\'JESUS MAURICIO CHAVARRO\\\', telefono_contacto=NULL, persona_recibe=NULL, medio_recibo=NULL WHERE id = \\\'00000005\\\'',NULL),(0000000311,00000048,'2009-08-04 11:12:11','Eliminar requerimiento','DELETE FROM pance_requerimientos_clientes WHERE id = \\\'00000006\\\'',NULL),(0000000312,00000048,'2009-08-04 11:12:23','Notificar','UPDATE pance_requerimientos_clientes SET notificado=\\\'1\\\' WHERE id = \\\'00000001\\\'',NULL),(0000000313,00000048,'2009-08-04 11:12:36','Notificar','UPDATE pance_requerimientos_clientes SET notificado=\\\'1\\\' WHERE id = \\\'00000002\\\'',NULL),(0000000314,00000048,'2009-08-04 11:12:55','Notificar','UPDATE pance_requerimientos_clientes SET notificado=\\\'1\\\' WHERE id = \\\'00000003\\\'',NULL),(0000000315,00000048,'2009-08-04 11:13:08','Notificar','UPDATE pance_requerimientos_clientes SET notificado=\\\'1\\\' WHERE id = \\\'00000004\\\'',NULL),(0000000316,00000048,'2009-08-04 11:13:22','Notificar','UPDATE pance_requerimientos_clientes SET notificado=\\\'1\\\' WHERE id = \\\'00000005\\\'',NULL),(0000000317,00000048,'2009-08-04 11:17:13','Generar cotización','INSERT INTO pance_cotizaciones (id_requerimiento,numero_cotizacion,numero_cotizacion_consorciado,estado,valor_mano_obra_cotizacion,valor_materiales_cotizacion,costo_directo,porcentaje_administracion_cotizacion,costo_administracion_cotizacion,porcentaje_imprevistos_cotizacion,costo_imprevistos_cotizacion,porcentaje_utilidad,costo_utilidad,impuesto,costo_impuesto,forma_pago,fecha_registro_cotizacion_consorciado) VALUES (\\\'00000001\\\',\\\'1\\\',\\\'S1\\\',\\\'1\\\',\\\'5600000\\\',\\\'3600000\\\',\\\'9200000\\\',\\\'3\\\',\\\'276000\\\',\\\'3\\\',\\\'276000\\\',\\\'3\\\',\\\'276000\\\',\\\'16\\\',\\\'44200\\\',\\\'0\\\',\\\'2009-08-04 11:08:13\\\')',NULL),(0000000318,00000048,'2009-08-04 11:17:13','Generar cotización','UPDATE pance_requerimientos_clientes SET fecha_visita=\\\'2009-08-04\\\', observaciones_visita=\\\'TODO ESTA DETERIORADO\\\', estado_aprobacion_requerimiento=\\\'1\\\', estado_cotizacion=\\\'1\\\' WHERE id = \\\'00000001\\\'',NULL),(0000000319,00000048,'2009-08-04 11:18:23','Generar cotización','INSERT INTO pance_cotizaciones (id_requerimiento,numero_cotizacion,numero_cotizacion_consorciado,estado,valor_mano_obra_cotizacion,valor_materiales_cotizacion,costo_directo,impuesto,costo_impuesto,forma_pago,porcentaje_anticipo,fecha_registro_cotizacion_consorciado) VALUES (\\\'00000002\\\',\\\'2\\\',\\\'S2\\\',\\\'1\\\',\\\'2000000\\\',\\\'650000\\\',\\\'2650000\\\',\\\'16\\\',\\\'424000\\\',\\\'0\\\',\\\'0\\\',\\\'2009-08-04 11:08:23\\\')',NULL),(0000000320,00000048,'2009-08-04 11:18:23','Generar cotización','UPDATE pance_requerimientos_clientes SET fecha_visita=\\\'2009-08-04\\\', observaciones_visita=\\\'NECESARIOS AJUSTES DE TORNILLERIA\\\', estado_aprobacion_requerimiento=\\\'1\\\', estado_cotizacion=\\\'1\\\' WHERE id = \\\'00000002\\\'',NULL),(0000000321,00000048,'2009-08-04 11:21:16','Generar cotización','INSERT INTO pance_cotizaciones (id_requerimiento,numero_cotizacion,numero_cotizacion_consorciado,estado,valor_mano_obra_cotizacion,valor_materiales_cotizacion,costo_directo,porcentaje_administracion_cotizacion,costo_administracion_cotizacion,porcentaje_imprevistos_cotizacion,costo_imprevistos_cotizacion,porcentaje_utilidad,costo_utilidad,impuesto,costo_impuesto,forma_pago,fecha_registro_cotizacion_consorciado) VALUES (\\\'00000003\\\',\\\'3\\\',\\\'C3\\\',\\\'1\\\',\\\'125000000\\\',\\\'98000000\\\',\\\'223000000\\\',\\\'1\\\',\\\'2230000\\\',\\\'1\\\',\\\'2230000\\\',\\\'2\\\',\\\'4460000\\\',\\\'16\\\',\\\'713600\\\',\\\'0\\\',\\\'2009-08-04 11:08:16\\\')',NULL),(0000000322,00000048,'2009-08-04 11:21:16','Generar cotización','UPDATE pance_requerimientos_clientes SET fecha_visita=\\\'2009-08-04\\\', observaciones_visita=\\\'PRUEBA NUMERO 3\\\', estado_aprobacion_requerimiento=\\\'1\\\', estado_cotizacion=\\\'1\\\' WHERE id = \\\'00000003\\\'',NULL),(0000000323,00000048,'2009-08-04 11:25:56','Generar cotización','INSERT INTO pance_cotizaciones (id_requerimiento,numero_cotizacion,numero_cotizacion_consorciado,estado,valor_mano_obra_cotizacion,valor_materiales_cotizacion,costo_directo,impuesto,costo_impuesto,forma_pago,porcentaje_anticipo,fecha_registro_cotizacion_consorciado) VALUES (\\\'00000004\\\',\\\'4\\\',\\\'C4\\\',\\\'1\\\',\\\'68000000\\\',\\\'4200000\\\',\\\'72200000\\\',\\\'16\\\',\\\'11552000\\\',\\\'0\\\',\\\'0\\\',\\\'2009-08-04 11:08:56\\\')',NULL),(0000000324,00000048,'2009-08-04 11:25:56','Generar cotización','UPDATE pance_requerimientos_clientes SET fecha_visita=\\\'2009-08-04\\\', observaciones_visita=\\\'CONSORCIADO 4\\\', estado_aprobacion_requerimiento=\\\'1\\\', estado_cotizacion=\\\'1\\\' WHERE id = \\\'00000004\\\'',NULL),(0000000325,00000048,'2009-08-04 11:26:35','Visita sin oferta','UPDATE pance_requerimientos_clientes SET fecha_visita=\\\'2009-08-04\\\', observaciones_visita=\\\'PROBLEMAS LOGISTICOS DE USUARIO\\\', estado_cotizacion=\\\'7\\\' WHERE id = \\\'00000005\\\'',NULL),(0000000326,00000048,'2009-08-04 11:27:25','Aprobar cotización','UPDATE pance_cotizaciones SET estado=\\\'2\\\', observaciones_aprobacion_cliente=\\\'EJECUTESE Y CUMPLASE\\\', fecha_registro_aprobacion_clientes=\\\'2009-08-04\\\', fecha_registro_aprobacion_sistema=\\\'2009-08-04 11:08:25\\\' WHERE id = \\\'000001\\\'',NULL),(0000000327,00000048,'2009-08-04 11:27:25','Aprobar cotización','UPDATE pance_requerimientos_clientes SET estado_cotizacion=\\\'2\\\' WHERE id = \\\'00000001\\\'',NULL),(0000000328,00000048,'2009-08-04 11:27:44','Anular cotización','UPDATE pance_cotizaciones SET estado=\\\'3\\\' WHERE id = \\\'000002\\\'',NULL),(0000000329,00000048,'2009-08-04 11:27:44','Anular cotización','UPDATE pance_requerimientos_clientes SET estado_cotizacion=\\\'3\\\' WHERE id = \\\'00000002\\\'',NULL),(0000000330,00000048,'2009-08-04 11:28:21','Recotizar cotización','UPDATE pance_cotizaciones SET estado=\\\'4\\\' WHERE id = \\\'000003\\\'',NULL),(0000000331,00000048,'2009-08-04 11:28:21','Recotizar cotización','INSERT INTO pance_cotizaciones (id_requerimiento,numero_cotizacion,consecutivo_cotizacion,numero_cotizacion_consorciado,estado,valor_mano_obra_cotizacion,valor_materiales_cotizacion,costo_directo,porcentaje_administracion_cotizacion,costo_administracion_cotizacion,porcentaje_imprevistos_cotizacion,costo_imprevistos_cotizacion,porcentaje_utilidad,costo_utilidad,impuesto,costo_impuesto,forma_pago,fecha_registro_cotizacion_consorciado) VALUES (\\\'00000003\\\',\\\'00000003\\\',\\\'1\\\',\\\'C3\\\',\\\'1\\\',\\\'120000000\\\',\\\'98000000\\\',\\\'218000000\\\',\\\'1.00\\\',\\\'2180000\\\',\\\'1.00\\\',\\\'2180000\\\',\\\'2.00\\\',\\\'4460000\\\',\\\'16.00\\\',\\\'713600\\\',\\\'0\\\',\\\'2009-08-04 11:08:21\\\')',NULL),(0000000332,00000048,'2009-08-04 11:28:21','Recotizar cotización','UPDATE pance_requerimientos_clientes SET fecha_visita=\\\'2009-08-04\\\', observaciones_visita=\\\'PRUEBA NUMERO 3\\\', estado_aprobacion_requerimiento=\\\'1\\\', estado_cotizacion=\\\'1\\\' WHERE id = \\\'00000003\\\'',NULL),(0000000333,00000048,'2009-08-04 11:29:29','Exportar cotización','UPDATE pance_cotizaciones SET estado_cotizacion=\\\'1\\\' WHERE id = \\\'000001\\\'',NULL),(0000000334,00000048,'2009-08-04 11:32:37','Aprobar cotización','UPDATE pance_cotizaciones SET estado=\\\'2\\\', observaciones_aprobacion_cliente=NULL, fecha_registro_aprobacion_clientes=\\\'2009-08-04\\\', fecha_registro_aprobacion_sistema=\\\'2009-08-04 11:08:37\\\' WHERE id = \\\'000005\\\'',NULL),(0000000335,00000048,'2009-08-04 11:32:38','Aprobar cotización','UPDATE pance_requerimientos_clientes SET estado_cotizacion=\\\'2\\\' WHERE id = \\\'00000003\\\'',NULL),(0000000336,00000048,'2009-08-04 12:18:40','Adicionar acta','INSERT INTO pance_registro_obras (id_requerimiento,id_cotizacion,tipo_acta,fecha_entrega_acta,factura_consorciado,pago_cliente,pago_consorciado,porcentaje_mano_obra,porcentaje_materiales) VALUES (\\\'00000001\\\',\\\'000001\\\',\\\'1\\\',\\\'2009-08-04\\\',\\\'1\\\',\\\'1\\\',\\\'1\\\',\\\'5\\\',\\\'5\\\')',NULL),(0000000337,00000048,'2009-08-04 12:28:08','Adicionar acta','INSERT INTO pance_registro_obras (id_requerimiento,id_cotizacion,tipo_acta,fecha_entrega_acta,factura_consorciado,porcentaje_mano_obra,porcentaje_materiales) VALUES (\\\'00000003\\\',\\\'000005\\\',\\\'1\\\',\\\'2009-08-04\\\',\\\'1\\\',\\\'10\\\',\\\'10\\\')',NULL),(0000000338,00000048,'2009-08-04 12:30:35','Adicionar acta','INSERT INTO pance_registro_obras (id_requerimiento,id_cotizacion,tipo_acta,fecha_entrega_acta,valor_facturar,pago_consorciado,porcentaje_mano_obra,porcentaje_materiales) VALUES (\\\'00000003\\\',\\\'000005\\\',\\\'2\\\',\\\'2009-08-04\\\',\\\'0\\\',\\\'1\\\',\\\'15\\\',\\\'15\\\')',NULL),(0000000339,00000049,'2009-08-04 18:16:06','Reemplazar cotización','UPDATE pance_cotizaciones SET estado=\\\'4\\\' WHERE id = \\\'000001\\\'',NULL),(0000000340,00000049,'2009-08-04 18:16:06','Reemplazar cotización','INSERT INTO pance_cotizaciones (id_requerimiento,numero_cotizacion,consecutivo_cotizacion,numero_cotizacion_consorciado,estado,valor_mano_obra_cotizacion,valor_materiales_cotizacion,costo_directo,porcentaje_administracion_cotizacion,costo_administracion_cotizacion,porcentaje_imprevistos_cotizacion,costo_imprevistos_cotizacion,porcentaje_utilidad,costo_utilidad,impuesto,costo_impuesto,forma_pago,fecha_registro_cotizacion_consorciado) VALUES (\\\'00000001\\\',\\\'00000001\\\',\\\'1\\\',\\\'S1\\\',\\\'1\\\',\\\'5600000\\\',\\\'3600000\\\',\\\'9200000\\\',\\\'3.00\\\',\\\'276000\\\',\\\'3.00\\\',\\\'276000\\\',\\\'3.00\\\',\\\'276000\\\',\\\'16.00\\\',\\\'44200\\\',\\\'0\\\',\\\'2009-08-04 18:08:06\\\')',NULL),(0000000341,00000049,'2009-08-04 18:16:06','Reemplazar cotización','UPDATE pance_requerimientos_clientes SET fecha_visita=\\\'2009-08-04\\\', observaciones_visita=\\\'TODO ESTA DETERIORADO\\\', estado_aprobacion_requerimiento=\\\'1\\\', estado_cotizacion=\\\'1\\\' WHERE id = \\\'00000001\\\'',NULL),(0000000342,00000050,'2009-08-04 20:44:22','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-08-04 20:44:22\\\',\\\'0001\\\',\\\'127.0.0.1\\\')',NULL),(0000000343,00000051,'2009-08-04 20:44:38','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-08-04 20:44:38\\\',\\\'0001\\\',\\\'127.0.0.1\\\')',NULL),(0000000344,00000052,'2009-08-04 20:44:50','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-08-04 20:44:50\\\',\\\'0001\\\',\\\'127.0.0.1\\\')',NULL),(0000000345,00000052,'2009-08-04 20:44:51','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-08-04 20:44:51\\\',\\\'0001\\\',\\\'127.0.0.1\\\')',NULL),(0000000346,00000053,'2009-08-04 20:44:51','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-08-04 20:44:51\\\',\\\'0001\\\',\\\'127.0.0.1\\\')',NULL),(0000000347,00000053,'2009-08-04 20:44:51','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-08-04 20:44:51\\\',\\\'0001\\\',\\\'127.0.0.1\\\')',NULL),(0000000348,00000053,'2009-08-04 20:44:51','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-08-04 20:44:51\\\',\\\'0001\\\',\\\'127.0.0.1\\\')',NULL),(0000000349,00000053,'2009-08-04 20:44:52','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-08-04 20:44:52\\\',\\\'0001\\\',\\\'127.0.0.1\\\')',NULL),(0000000350,00000056,'2009-08-04 20:44:52','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-08-04 20:44:52\\\',\\\'0001\\\',\\\'127.0.0.1\\\')',NULL),(0000000351,00000059,'2009-08-04 20:45:03','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-08-04 20:45:03\\\',\\\'0001\\\',\\\'127.0.0.1\\\')',NULL),(0000000352,00000060,'2009-08-04 20:45:04','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-08-04 20:45:04\\\',\\\'0001\\\',\\\'127.0.0.1\\\')',NULL),(0000000353,00000061,'2009-08-04 20:45:44','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-08-04 20:45:44\\\',\\\'0001\\\',\\\'127.0.0.1\\\')',NULL),(0000000354,00000062,'2009-08-04 20:45:46','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-08-04 20:45:46\\\',\\\'0001\\\',\\\'127.0.0.1\\\')',NULL),(0000000355,00000063,'2009-08-04 20:45:47','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-08-04 20:45:47\\\',\\\'0001\\\',\\\'127.0.0.1\\\')',NULL),(0000000356,00000063,'2009-08-04 20:45:47','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-08-04 20:45:47\\\',\\\'0001\\\',\\\'127.0.0.1\\\')',NULL),(0000000357,00000063,'2009-08-04 20:45:47','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-08-04 20:45:47\\\',\\\'0001\\\',\\\'127.0.0.1\\\')',NULL),(0000000358,00000063,'2009-08-04 20:45:48','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-08-04 20:45:48\\\',\\\'0001\\\',\\\'127.0.0.1\\\')',NULL),(0000000359,00000063,'2009-08-04 20:45:48','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-08-04 20:45:48\\\',\\\'0001\\\',\\\'127.0.0.1\\\')',NULL),(0000000360,00000063,'2009-08-04 20:45:48','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-08-04 20:45:48\\\',\\\'0001\\\',\\\'127.0.0.1\\\')',NULL),(0000000361,00000064,'2009-08-04 20:45:50','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-08-04 20:45:50\\\',\\\'0001\\\',\\\'127.0.0.1\\\')',NULL),(0000000362,00000066,'2009-08-04 20:45:51','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-08-04 20:45:51\\\',\\\'0001\\\',\\\'127.0.0.1\\\')',NULL),(0000000363,00000071,'2009-08-04 20:46:25','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-08-04 20:46:25\\\',\\\'0001\\\',\\\'127.0.0.1\\\')',NULL),(0000000364,00000072,'2009-08-04 20:46:29','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-08-04 20:46:29\\\',\\\'0001\\\',\\\'127.0.0.1\\\')',NULL),(0000000365,00000073,'2009-08-04 20:46:44','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-08-04 20:46:44\\\',\\\'0001\\\',\\\'127.0.0.1\\\')',NULL),(0000000366,00000074,'2009-08-04 20:47:04','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-08-04 20:47:04\\\',\\\'0001\\\',\\\'127.0.0.1\\\')',NULL),(0000000367,00000075,'2009-08-04 20:47:24','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-08-04 20:47:24\\\',\\\'0001\\\',\\\'127.0.0.1\\\')',NULL),(0000000368,00000076,'2009-08-04 20:47:28','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-08-04 20:47:27\\\',\\\'0001\\\',\\\'127.0.0.1\\\')',NULL),(0000000369,00000077,'2009-08-04 20:47:30','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-08-04 20:47:30\\\',\\\'0001\\\',\\\'127.0.0.1\\\')',NULL),(0000000370,00000078,'2009-08-04 20:48:22','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-08-04 20:48:22\\\',\\\'0001\\\',\\\'127.0.0.1\\\')',NULL),(0000000371,00000079,'2009-08-04 20:49:37','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-08-04 20:49:37\\\',\\\'0001\\\',\\\'127.0.0.1\\\')',NULL),(0000000372,00000080,'2009-08-04 20:50:17','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-08-04 20:50:17\\\',\\\'0001\\\',\\\'127.0.0.1\\\')',NULL),(0000000373,00000081,'2009-08-04 20:50:23','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-08-04 20:50:23\\\',\\\'0001\\\',\\\'127.0.0.1\\\')',NULL),(0000000374,00000082,'2009-08-04 20:50:55','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-08-04 20:50:55\\\',\\\'0001\\\',\\\'127.0.0.1\\\')',NULL),(0000000375,00000083,'2009-08-04 20:52:57','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-08-04 20:52:57\\\',\\\'0001\\\',\\\'127.0.0.1\\\')',NULL),(0000000376,00000085,'2009-08-04 21:04:38','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-08-04 21:04:38\\\',\\\'0001\\\',\\\'127.0.0.1\\\')',NULL),(0000000377,00000086,'2009-08-04 21:09:59','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-08-04 21:09:59\\\',\\\'0001\\\',\\\'127.0.0.1\\\')',NULL),(0000000378,00000087,'2009-08-04 21:12:09','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-08-04 21:12:09\\\',\\\'0001\\\',\\\'127.0.0.1\\\')',NULL),(0000000379,00000088,'2009-08-04 21:12:13','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-08-04 21:12:13\\\',\\\'0001\\\',\\\'127.0.0.1\\\')',NULL),(0000000380,00000089,'2009-08-04 21:12:14','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-08-04 21:12:14\\\',\\\'0001\\\',\\\'127.0.0.1\\\')',NULL),(0000000381,00000089,'2009-08-04 21:12:15','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-08-04 21:12:14\\\',\\\'0001\\\',\\\'127.0.0.1\\\')',NULL),(0000000382,00000089,'2009-08-04 21:12:15','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-08-04 21:12:15\\\',\\\'0001\\\',\\\'127.0.0.1\\\')',NULL),(0000000383,00000089,'2009-08-04 21:12:15','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-08-04 21:12:15\\\',\\\'0001\\\',\\\'127.0.0.1\\\')',NULL),(0000000384,00000089,'2009-08-04 21:12:16','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-08-04 21:12:16\\\',\\\'0001\\\',\\\'127.0.0.1\\\')',NULL),(0000000385,00000089,'2009-08-04 21:12:16','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-08-04 21:12:16\\\',\\\'0001\\\',\\\'127.0.0.1\\\')',NULL),(0000000386,00000090,'2009-08-04 21:12:18','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-08-04 21:12:18\\\',\\\'0001\\\',\\\'127.0.0.1\\\')',NULL),(0000000387,00000091,'2009-08-04 21:12:18','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-08-04 21:12:18\\\',\\\'0001\\\',\\\'127.0.0.1\\\')',NULL),(0000000388,00000092,'2009-08-04 21:12:19','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-08-04 21:12:19\\\',\\\'0001\\\',\\\'127.0.0.1\\\')',NULL),(0000000389,00000093,'2009-08-04 21:12:19','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-08-04 21:12:19\\\',\\\'0001\\\',\\\'127.0.0.1\\\')',NULL),(0000000390,00000099,'2009-08-04 21:13:59','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-08-04 21:13:59\\\',\\\'0001\\\',\\\'127.0.0.1\\\')',NULL),(0000000391,00000100,'2009-08-04 21:14:01','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-08-04 21:14:01\\\',\\\'0001\\\',\\\'127.0.0.1\\\')',NULL),(0000000392,00000101,'2009-08-04 21:14:01','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-08-04 21:14:01\\\',\\\'0001\\\',\\\'127.0.0.1\\\')',NULL),(0000000393,00000101,'2009-08-04 21:14:02','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-08-04 21:14:02\\\',\\\'0001\\\',\\\'127.0.0.1\\\')',NULL),(0000000394,00000101,'2009-08-04 21:14:02','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-08-04 21:14:02\\\',\\\'0001\\\',\\\'127.0.0.1\\\')',NULL),(0000000395,00000101,'2009-08-04 21:14:02','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-08-04 21:14:02\\\',\\\'0001\\\',\\\'127.0.0.1\\\')',NULL),(0000000396,00000101,'2009-08-04 21:14:02','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-08-04 21:14:02\\\',\\\'0001\\\',\\\'127.0.0.1\\\')',NULL),(0000000397,00000101,'2009-08-04 21:14:03','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-08-04 21:14:03\\\',\\\'0001\\\',\\\'127.0.0.1\\\')',NULL),(0000000398,00000102,'2009-08-04 21:14:04','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-08-04 21:14:04\\\',\\\'0001\\\',\\\'127.0.0.1\\\')',NULL),(0000000399,00000107,'2009-08-04 21:14:15','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-08-04 21:14:15\\\',\\\'0001\\\',\\\'127.0.0.1\\\')',NULL),(0000000400,00000109,'2009-08-04 21:15:37','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-08-04 21:15:37\\\',\\\'0001\\\',\\\'127.0.0.1\\\')',NULL),(0000000401,00000110,'2009-08-04 21:16:06','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-08-04 21:16:06\\\',\\\'0001\\\',\\\'127.0.0.1\\\')',NULL),(0000000402,00000111,'2009-08-04 21:16:10','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-08-04 21:16:10\\\',\\\'0001\\\',\\\'127.0.0.1\\\')',NULL),(0000000403,00000111,'2009-08-04 21:16:10','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-08-04 21:16:10\\\',\\\'0001\\\',\\\'127.0.0.1\\\')',NULL),(0000000404,00000111,'2009-08-04 21:16:10','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-08-04 21:16:10\\\',\\\'0001\\\',\\\'127.0.0.1\\\')',NULL),(0000000405,00000111,'2009-08-04 21:16:11','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-08-04 21:16:11\\\',\\\'0001\\\',\\\'127.0.0.1\\\')',NULL),(0000000406,00000115,'2009-08-04 21:18:18','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-08-04 21:18:18\\\',\\\'0001\\\',\\\'127.0.0.1\\\')',NULL),(0000000407,00000116,'2009-08-04 21:20:29','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-08-04 21:20:29\\\',\\\'0001\\\',\\\'127.0.0.1\\\')',NULL),(0000000408,00000117,'2009-08-04 21:22:08','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-08-04 21:22:08\\\',\\\'0001\\\',\\\'127.0.0.1\\\')',NULL),(0000000409,00000118,'2009-08-04 21:24:28','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-08-04 21:24:28\\\',\\\'0001\\\',\\\'127.0.0.1\\\')',NULL),(0000000410,00000119,'2009-08-04 21:26:23','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-08-04 21:26:23\\\',\\\'0001\\\',\\\'127.0.0.1\\\')',NULL),(0000000411,00000120,'2009-08-04 21:28:50','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-08-04 21:28:50\\\',\\\'0001\\\',\\\'127.0.0.1\\\')',NULL),(0000000412,00000121,'2009-08-04 21:29:24','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-08-04 21:29:24\\\',\\\'0001\\\',\\\'127.0.0.1\\\')',NULL),(0000000413,00000122,'2009-08-04 21:30:14','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-08-04 21:30:14\\\',\\\'0001\\\',\\\'127.0.0.1\\\')',NULL),(0000000414,00000123,'2009-08-04 21:30:30','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-08-04 21:30:30\\\',\\\'0001\\\',\\\'127.0.0.1\\\')',NULL),(0000000415,00000124,'2009-08-04 21:30:48','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-08-04 21:30:48\\\',\\\'0001\\\',\\\'127.0.0.1\\\')',NULL),(0000000416,00000125,'2009-08-04 21:31:07','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-08-04 21:31:06\\\',\\\'0001\\\',\\\'127.0.0.1\\\')',NULL),(0000000417,00000126,'2009-08-04 21:31:27','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-08-04 21:31:27\\\',\\\'0001\\\',\\\'127.0.0.1\\\')',NULL),(0000000418,00000127,'2009-08-04 21:33:12','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-08-04 21:33:12\\\',\\\'0001\\\',\\\'127.0.0.1\\\')',NULL),(0000000419,00000128,'2009-08-04 21:33:43','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-08-04 21:33:43\\\',\\\'0001\\\',\\\'127.0.0.1\\\')',NULL),(0000000420,00000129,'2009-08-04 21:34:03','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-08-04 21:34:03\\\',\\\'0001\\\',\\\'127.0.0.1\\\')',NULL),(0000000421,00000130,'2009-08-04 21:34:26','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-08-04 21:34:26\\\',\\\'0001\\\',\\\'127.0.0.1\\\')',NULL),(0000000422,00000131,'2009-08-04 21:34:55','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-08-04 21:34:55\\\',\\\'0001\\\',\\\'127.0.0.1\\\')',NULL),(0000000423,00000132,'2009-08-04 21:35:23','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-08-04 21:35:23\\\',\\\'0001\\\',\\\'127.0.0.1\\\')',NULL),(0000000424,00000133,'2009-08-04 21:35:42','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-08-04 21:35:42\\\',\\\'0001\\\',\\\'127.0.0.1\\\')',NULL),(0000000425,00000134,'2009-08-04 21:40:14','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-08-04 21:40:14\\\',\\\'0001\\\',\\\'127.0.0.1\\\')',NULL),(0000000426,00000135,'2009-08-04 21:40:40','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-08-04 21:40:40\\\',\\\'0001\\\',\\\'127.0.0.1\\\')',NULL),(0000000427,00000136,'2009-08-04 21:43:02','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-08-04 21:43:02\\\',\\\'0001\\\',\\\'127.0.0.1\\\')',NULL),(0000000428,00000137,'2009-08-04 21:46:13','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-08-04 21:46:13\\\',\\\'0001\\\',\\\'127.0.0.1\\\')',NULL),(0000000429,00000138,'2009-08-04 22:46:56','Reemplazar cotización','UPDATE pance_cotizaciones SET estado=\\\'5\\\' WHERE id = \\\'000006\\\'',NULL),(0000000430,00000138,'2009-08-04 22:54:28','Reemplazar cotización','UPDATE pance_cotizaciones SET estado=\\\'5\\\' WHERE id = \\\'000004\\\'',NULL),(0000000431,00000138,'2009-08-04 22:54:28','Reemplazar cotización','INSERT INTO pance_cotizaciones (id_requerimiento,numero_cotizacion,consecutivo_cotizacion,estado,valor_mano_obra_cotizacion,costo_directo,impuesto,fecha_registro_cotizacion_consorciado) VALUES (\\\'00000004\\\',\\\'00000004\\\',\\\'1\\\',\\\'1\\\',\\\'6800000\\\',\\\'11000000\\\',\\\'16.00\\\',\\\'2009-08-04 22:08:30\\\')',NULL),(0000000432,00000138,'2009-08-04 22:54:28','Reemplazar cotización','UPDATE pance_requerimientos_clientes SET fecha_visita=\\\'2009-08-04\\\', observaciones_visita=\\\'undefined\\\', estado_aprobacion_requerimiento=\\\'1\\\', estado_cotizacion=\\\'1\\\' WHERE id = \\\'00000004\\\'',NULL),(0000000433,00000138,'2009-08-04 22:54:28','Reemplazar cotización','INSERT INTO pance_cotizaciones (id_requerimiento,numero_cotizacion,consecutivo_cotizacion,estado,valor_mano_obra_cotizacion,costo_directo,impuesto,fecha_registro_cotizacion_consorciado) VALUES (\\\'00000004\\\',\\\'00000004\\\',\\\'2\\\',\\\'1\\\',\\\'61200000\\\',\\\'61225000\\\',\\\'16.00\\\',\\\'2009-08-04 22:08:30\\\')',NULL),(0000000434,00000138,'2009-08-04 22:54:28','Reemplazar cotización','UPDATE pance_requerimientos_clientes SET fecha_visita=\\\'2009-08-04\\\', observaciones_visita=\\\'undefined\\\', estado_aprobacion_requerimiento=\\\'1\\\', estado_cotizacion=\\\'1\\\' WHERE id = \\\'00000004\\\'',NULL),(0000000435,00000138,'2009-08-04 23:03:04','Reemplazar cotización','UPDATE pance_cotizaciones SET estado=\\\'5\\\' WHERE id = \\\'000004\\\'',NULL),(0000000436,00000138,'2009-08-04 23:03:04','Reemplazar cotización','INSERT INTO pance_cotizaciones (id_requerimiento,numero_cotizacion,consecutivo_cotizacion,estado,valor_mano_obra_cotizacion,valor_materiales_cotizacion,costo_directo,impuesto,fecha_registro_cotizacion_consorciado) VALUES (\\\'00000004\\\',\\\'00000004\\\',\\\'1\\\',\\\'1\\\',\\\'6800000\\\',\\\'4200000\\\',\\\'11000000\\\',\\\'16.00\\\',\\\'2009-08-04 22:08:30\\\')','Duplicate entry \\\'00000004-01\\\' for key 2'),(0000000437,00000138,'2009-08-04 23:03:04','Reemplazar cotización','UPDATE pance_requerimientos_clientes SET fecha_visita=\\\'2009-08-04\\\', observaciones_visita=\\\'undefined\\\', estado_aprobacion_requerimiento=\\\'1\\\', estado_cotizacion=\\\'1\\\' WHERE id = \\\'00000004\\\'',NULL),(0000000438,00000138,'2009-08-04 23:03:04','Reemplazar cotización','INSERT INTO pance_cotizaciones (id_requerimiento,numero_cotizacion,consecutivo_cotizacion,estado,valor_mano_obra_cotizacion,valor_materiales_cotizacion,costo_directo,impuesto,fecha_registro_cotizacion_consorciado) VALUES (\\\'00000004\\\',\\\'00000004\\\',\\\'2\\\',\\\'1\\\',\\\'61200000\\\',\\\'25000\\\',\\\'61225000\\\',\\\'16.00\\\',\\\'2009-08-04 22:08:30\\\')','Duplicate entry \\\'00000004-02\\\' for key 2'),(0000000439,00000138,'2009-08-04 23:03:04','Reemplazar cotización','UPDATE pance_requerimientos_clientes SET fecha_visita=\\\'2009-08-04\\\', observaciones_visita=\\\'undefined\\\', estado_aprobacion_requerimiento=\\\'1\\\', estado_cotizacion=\\\'1\\\' WHERE id = \\\'00000004\\\'',NULL),(0000000440,00000138,'2009-08-04 23:05:51','Reemplazar cotización','UPDATE pance_cotizaciones SET estado=\\\'5\\\' WHERE id = \\\'000008\\\'',NULL),(0000000441,00000138,'2009-08-04 23:05:51','Reemplazar cotización','INSERT INTO pance_cotizaciones (id_requerimiento,numero_cotizacion,consecutivo_cotizacion,numero_cotizacion_consorciado,estado,valor_mano_obra_cotizacion,valor_materiales_cotizacion,costo_directo,impuesto,fecha_registro_cotizacion_consorciado) VALUES (\\\'00000004\\\',\\\'00000004\\\',\\\'3\\\',\\\'S1\\\',\\\'1\\\',\\\'6120000\\\',\\\'25000\\\',\\\'6145000\\\',\\\'16.00\\\',\\\'2009-08-04 23:08:17\\\')',NULL),(0000000442,00000138,'2009-08-04 23:05:51','Reemplazar cotización','UPDATE pance_requerimientos_clientes SET fecha_visita=\\\'2009-08-04\\\', observaciones_visita=\\\'undefined\\\', estado_aprobacion_requerimiento=\\\'1\\\', estado_cotizacion=\\\'1\\\' WHERE id = \\\'00000004\\\'',NULL),(0000000443,00000138,'2009-08-04 23:05:51','Reemplazar cotización','INSERT INTO pance_cotizaciones (id_requerimiento,numero_cotizacion,consecutivo_cotizacion,numero_cotizacion_consorciado,estado,valor_mano_obra_cotizacion,valor_materiales_cotizacion,costo_directo,impuesto,fecha_registro_cotizacion_consorciado) VALUES (\\\'00000004\\\',\\\'00000004\\\',\\\'4\\\',\\\'S1\\\',\\\'1\\\',\\\'6000000\\\',\\\'60000000\\\',\\\'66000000\\\',\\\'16.00\\\',\\\'2009-08-04 23:08:17\\\')',NULL),(0000000444,00000138,'2009-08-04 23:05:51','Reemplazar cotización','UPDATE pance_requerimientos_clientes SET fecha_visita=\\\'2009-08-04\\\', observaciones_visita=\\\'undefined\\\', estado_aprobacion_requerimiento=\\\'1\\\', estado_cotizacion=\\\'1\\\' WHERE id = \\\'00000004\\\'',NULL),(0000000445,00000138,'2009-08-04 23:16:25','Reemplazar cotización','UPDATE pance_cotizaciones SET estado=\\\'5\\\' WHERE id = \\\'000008\\\'',NULL),(0000000446,00000138,'2009-08-04 23:16:25','Reemplazar cotización','INSERT INTO pance_cotizaciones (id_requerimiento,numero_cotizacion,consecutivo_cotizacion,numero_cotizacion_consorciado,estado,valor_mano_obra_cotizacion,valor_materiales_cotizacion,costo_directo,impuesto,fecha_registro_cotizacion_consorciado) VALUES (\\\'00000004\\\',\\\'00000004\\\',\\\'3\\\',\\\'S1\\\',\\\'1\\\',\\\'6120000\\\',\\\'25000\\\',\\\'6145000\\\',\\\'16.00\\\',\\\'2009-08-04 23:08:17\\\')','Duplicate entry \\\'00000004-03\\\' for key 2'),(0000000447,00000138,'2009-08-04 23:16:25','Reemplazar cotización','UPDATE pance_requerimientos_clientes SET fecha_visita=\\\'2009-08-04\\\', observaciones_visita=\\\'undefined\\\', estado_aprobacion_requerimiento=\\\'1\\\', estado_cotizacion=\\\'1\\\' WHERE id = \\\'00000004\\\'',NULL),(0000000448,00000138,'2009-08-04 23:16:25','Reemplazar cotización','INSERT INTO pance_cotizaciones (id_requerimiento,numero_cotizacion,consecutivo_cotizacion,numero_cotizacion_consorciado,estado,valor_mano_obra_cotizacion,valor_materiales_cotizacion,costo_directo,impuesto,fecha_registro_cotizacion_consorciado) VALUES (\\\'00000004\\\',\\\'00000004\\\',\\\'4\\\',\\\'S1\\\',\\\'1\\\',\\\'6000000\\\',\\\'60000000\\\',\\\'66000000\\\',\\\'16.00\\\',\\\'2009-08-04 23:08:17\\\')','Duplicate entry \\\'00000004-04\\\' for key 2'),(0000000449,00000138,'2009-08-04 23:16:25','Reemplazar cotización','UPDATE pance_requerimientos_clientes SET fecha_visita=\\\'2009-08-04\\\', observaciones_visita=\\\'undefined\\\', estado_aprobacion_requerimiento=\\\'1\\\', estado_cotizacion=\\\'1\\\' WHERE id = \\\'00000004\\\'',NULL),(0000000450,00000138,'2009-08-04 23:41:52','Notificar','UPDATE pance_requerimientos_clientes SET notificado=\\\'1\\\' WHERE id = \\\'00000002\\\'',NULL),(0000000451,00000138,'2009-08-04 23:42:04','Notificar','UPDATE pance_requerimientos_clientes SET notificado=\\\'1\\\' WHERE id = \\\'00000004\\\'',NULL),(0000000452,00000138,'2009-08-04 23:42:16','Notificar','UPDATE pance_requerimientos_clientes SET notificado=\\\'1\\\' WHERE id = \\\'00000001\\\'',NULL),(0000000453,00000138,'2009-08-04 23:42:28','Notificar','UPDATE pance_requerimientos_clientes SET notificado=\\\'1\\\' WHERE id = \\\'00000005\\\'',NULL),(0000000454,00000138,'2009-08-04 23:42:39','Notificar','UPDATE pance_requerimientos_clientes SET notificado=\\\'1\\\' WHERE id = \\\'00000003\\\'',NULL),(0000000455,00000138,'2009-08-04 23:45:55','Generar cotización','INSERT INTO pance_cotizaciones (id_requerimiento,numero_cotizacion,numero_cotizacion_consorciado,estado,valor_mano_obra_cotizacion,valor_materiales_cotizacion,costo_directo,porcentaje_administracion_cotizacion,costo_administracion_cotizacion,porcentaje_imprevistos_cotizacion,costo_imprevistos_cotizacion,porcentaje_utilidad,costo_utilidad,impuesto,costo_impuesto,forma_pago,fecha_registro_cotizacion_consorciado) VALUES (\\\'00000001\\\',\\\'1\\\',\\\'C1\\\',\\\'1\\\',\\\'25000000\\\',\\\'12000000\\\',\\\'37000000\\\',\\\'5\\\',\\\'1850000\\\',\\\'5\\\',\\\'1850000\\\',\\\'5\\\',\\\'1850000\\\',\\\'16\\\',\\\'296000\\\',\\\'0\\\',\\\'2009-08-04 23:08:55\\\')',NULL),(0000000456,00000138,'2009-08-04 23:45:55','Generar cotización','UPDATE pance_requerimientos_clientes SET fecha_visita=\\\'2009-08-04\\\', observaciones_visita=\\\'PRUEBA\\\', estado_aprobacion_requerimiento=\\\'1\\\', estado_cotizacion=\\\'1\\\' WHERE id = \\\'00000001\\\'',NULL),(0000000457,00000138,'2009-08-04 23:48:21','Reemplazar cotización','UPDATE pance_cotizaciones SET estado=\\\'5\\\' WHERE id = \\\'000001\\\'',NULL),(0000000458,00000138,'2009-08-04 23:48:21','Reemplazar cotización','INSERT INTO pance_cotizaciones (id_requerimiento,numero_cotizacion,consecutivo_cotizacion,numero_cotizacion_consorciado,estado,valor_mano_obra_cotizacion,costo_directo,porcentaje_administracion_cotizacion,costo_administracion_cotizacion,porcentaje_imprevistos_cotizacion,porcentaje_utilidad,costo_utilidad,impuesto,costo_impuesto,fecha_registro_cotizacion_consorciado) VALUES (\\\'00000001\\\',\\\'00000001\\\',\\\'1\\\',\\\'C1\\\',\\\'1\\\',\\\'15000000\\\',\\\'21000000\\\',\\\'5.00\\\',\\\'5.00\\\',\\\'5.00\\\',\\\'5.00\\\',\\\'5.00\\\',\\\'16.00\\\',\\\'168000\\\',\\\'2009-08-04 23:08:21\\\')',NULL),(0000000459,00000138,'2009-08-04 23:48:21','Reemplazar cotización','UPDATE pance_requerimientos_clientes SET fecha_visita=\\\'2009-08-04\\\', observaciones_visita=\\\'undefined\\\', estado_aprobacion_requerimiento=\\\'1\\\', estado_cotizacion=\\\'1\\\' WHERE id = \\\'00000001\\\'',NULL),(0000000460,00000138,'2009-08-04 23:48:21','Reemplazar cotización','INSERT INTO pance_cotizaciones (id_requerimiento,numero_cotizacion,consecutivo_cotizacion,numero_cotizacion_consorciado,estado,valor_mano_obra_cotizacion,costo_directo,porcentaje_administracion_cotizacion,costo_administracion_cotizacion,porcentaje_imprevistos_cotizacion,porcentaje_utilidad,costo_utilidad,impuesto,costo_impuesto,fecha_registro_cotizacion_consorciado) VALUES (\\\'00000001\\\',\\\'00000001\\\',\\\'2\\\',\\\'C1\\\',\\\'1\\\',\\\'10000000\\\',\\\'16000000\\\',\\\'05\\\',\\\'05\\\',\\\'5\\\',\\\'5\\\',\\\'5\\\',\\\'16.00\\\',\\\'128000\\\',\\\'2009-08-04 23:08:21\\\')',NULL),(0000000461,00000138,'2009-08-04 23:48:21','Reemplazar cotización','UPDATE pance_requerimientos_clientes SET fecha_visita=\\\'2009-08-04\\\', observaciones_visita=\\\'undefined\\\', estado_aprobacion_requerimiento=\\\'1\\\', estado_cotizacion=\\\'1\\\' WHERE id = \\\'00000001\\\'',NULL),(0000000462,00000138,'2009-08-04 23:50:21','Reemplazar cotización','UPDATE pance_cotizaciones SET estado=\\\'5\\\' WHERE id = \\\'000001\\\'',NULL),(0000000463,00000138,'2009-08-04 23:50:21','Reemplazar cotización','INSERT INTO pance_cotizaciones (id_requerimiento,numero_cotizacion,consecutivo_cotizacion,numero_cotizacion_consorciado,estado,valor_mano_obra_cotizacion,valor_materiales_cotizacion,costo_directo,porcentaje_administracion_cotizacion,costo_administracion_cotizacion,porcentaje_imprevistos_cotizacion,costo_imprevistos_cotizacion,porcentaje_utilidad,costo_utilidad,impuesto,costo_impuesto,fecha_registro_cotizacion_consorciado) VALUES (\\\'00000001\\\',\\\'00000001\\\',\\\'1\\\',\\\'C1\\\',\\\'1\\\',\\\'15000000\\\',\\\'6000000\\\',\\\'21000000\\\',\\\'5.00\\\',\\\'5.00\\\',\\\'5.00\\\',\\\'5.00\\\',\\\'5.00\\\',\\\'5.00\\\',\\\'16.00\\\',\\\'168000\\\',\\\'2009-08-04 23:08:21\\\')','Duplicate entry \\\'00000001-01\\\' for key 2'),(0000000464,00000138,'2009-08-04 23:50:21','Reemplazar cotización','UPDATE pance_requerimientos_clientes SET fecha_visita=\\\'2009-08-04\\\', observaciones_visita=\\\'undefined\\\', estado_aprobacion_requerimiento=\\\'1\\\', estado_cotizacion=\\\'1\\\' WHERE id = \\\'00000001\\\'',NULL),(0000000465,00000138,'2009-08-04 23:50:21','Reemplazar cotización','INSERT INTO pance_cotizaciones (id_requerimiento,numero_cotizacion,consecutivo_cotizacion,numero_cotizacion_consorciado,estado,valor_mano_obra_cotizacion,valor_materiales_cotizacion,costo_directo,porcentaje_administracion_cotizacion,costo_administracion_cotizacion,porcentaje_imprevistos_cotizacion,costo_imprevistos_cotizacion,porcentaje_utilidad,costo_utilidad,impuesto,costo_impuesto,fecha_registro_cotizacion_consorciado) VALUES (\\\'00000001\\\',\\\'00000001\\\',\\\'2\\\',\\\'C1\\\',\\\'1\\\',\\\'10000000\\\',\\\'6000000\\\',\\\'16000000\\\',\\\'05\\\',\\\'05\\\',\\\'5\\\',\\\'5\\\',\\\'5\\\',\\\'5\\\',\\\'16.00\\\',\\\'128000\\\',\\\'2009-08-04 23:08:21\\\')','Duplicate entry \\\'00000001-02\\\' for key 2'),(0000000466,00000138,'2009-08-04 23:50:21','Reemplazar cotización','UPDATE pance_requerimientos_clientes SET fecha_visita=\\\'2009-08-04\\\', observaciones_visita=\\\'undefined\\\', estado_aprobacion_requerimiento=\\\'1\\\', estado_cotizacion=\\\'1\\\' WHERE id = \\\'00000001\\\'',NULL),(0000000467,00000138,'2009-08-04 23:50:47','Reemplazar cotización','UPDATE pance_cotizaciones SET estado=\\\'5\\\' WHERE id = \\\'000001\\\'',NULL),(0000000468,00000138,'2009-08-04 23:50:47','Reemplazar cotización','INSERT INTO pance_cotizaciones (id_requerimiento,numero_cotizacion,consecutivo_cotizacion,numero_cotizacion_consorciado,estado,valor_mano_obra_cotizacion,valor_materiales_cotizacion,costo_directo,impuesto,costo_impuesto) VALUES (\\\'00000001\\\',\\\'00000001\\\',\\\'3\\\',\\\'C1\\\',\\\'1\\\',\\\'325000\\\',\\\'328000\\\',\\\'653000\\\',\\\'16.00\\\',\\\'104500\\\')',NULL),(0000000469,00000138,'2009-08-04 23:50:47','Reemplazar cotización','UPDATE pance_requerimientos_clientes SET fecha_visita=\\\'2009-08-04\\\', observaciones_visita=\\\'undefined\\\', estado_aprobacion_requerimiento=\\\'1\\\', estado_cotizacion=\\\'1\\\' WHERE id = \\\'00000001\\\'',NULL),(0000000470,00000138,'2009-08-04 23:51:44','Reemplazar cotización','UPDATE pance_cotizaciones SET estado=\\\'5\\\' WHERE id = \\\'000001\\\'',NULL),(0000000471,00000138,'2009-08-04 23:51:44','Reemplazar cotización','INSERT INTO pance_cotizaciones (id_requerimiento,numero_cotizacion,consecutivo_cotizacion,numero_cotizacion_consorciado,estado,valor_mano_obra_cotizacion,valor_materiales_cotizacion,costo_directo,impuesto,costo_impuesto) VALUES (\\\'00000001\\\',\\\'00000001\\\',\\\'3\\\',\\\'C1\\\',\\\'1\\\',\\\'325000\\\',\\\'328000\\\',\\\'653000\\\',\\\'16.00\\\',\\\'104500\\\')','Duplicate entry \\\'00000001-03\\\' for key 2'),(0000000472,00000138,'2009-08-04 23:51:44','Reemplazar cotización','UPDATE pance_requerimientos_clientes SET fecha_visita=\\\'2009-08-04\\\', observaciones_visita=\\\'undefined\\\', estado_aprobacion_requerimiento=\\\'1\\\', estado_cotizacion=\\\'1\\\' WHERE id = \\\'00000001\\\'',NULL),(0000000473,00000138,'2009-08-04 23:52:01','Reemplazar cotización','UPDATE pance_cotizaciones SET estado=\\\'5\\\' WHERE id = \\\'000001\\\'',NULL),(0000000474,00000138,'2009-08-04 23:52:01','Reemplazar cotización','INSERT INTO pance_cotizaciones (id_requerimiento,numero_cotizacion,consecutivo_cotizacion,numero_cotizacion_consorciado,estado,valor_mano_obra_cotizacion,valor_materiales_cotizacion,costo_directo,impuesto,costo_impuesto,fecha_registro_cotizacion_consorciado) VALUES (\\\'00000001\\\',\\\'00000001\\\',\\\'3\\\',\\\'C1\\\',\\\'1\\\',\\\'325000\\\',\\\'328000\\\',\\\'653000\\\',\\\'16.00\\\',\\\'104500\\\',\\\'2009-08-04 23:08:01\\\')','Duplicate entry \\\'00000001-03\\\' for key 2'),(0000000475,00000138,'2009-08-04 23:52:01','Reemplazar cotización','UPDATE pance_requerimientos_clientes SET fecha_visita=\\\'2009-08-04\\\', observaciones_visita=\\\'undefined\\\', estado_aprobacion_requerimiento=\\\'1\\\', estado_cotizacion=\\\'1\\\' WHERE id = \\\'00000001\\\'',NULL),(0000000476,00000138,'2009-08-04 23:59:10','Generar cotización','INSERT INTO pance_cotizaciones (id_requerimiento,numero_cotizacion,numero_cotizacion_consorciado,estado,valor_mano_obra_cotizacion,valor_materiales_cotizacion,costo_directo,porcentaje_administracion_cotizacion,costo_administracion_cotizacion,porcentaje_imprevistos_cotizacion,costo_imprevistos_cotizacion,porcentaje_utilidad,costo_utilidad,impuesto,costo_impuesto,forma_pago,fecha_registro_cotizacion_consorciado) VALUES (\\\'00000001\\\',\\\'1\\\',\\\'C1\\\',\\\'1\\\',\\\'20000000\\\',\\\'20000000\\\',\\\'40000000\\\',\\\'5\\\',\\\'2000000\\\',\\\'10\\\',\\\'4000000\\\',\\\'15\\\',\\\'6000000\\\',\\\'16\\\',\\\'960000\\\',\\\'0\\\',\\\'2009-08-04 23:08:10\\\')',NULL),(0000000477,00000138,'2009-08-04 23:59:10','Generar cotización','UPDATE pance_requerimientos_clientes SET fecha_visita=\\\'2009-08-04\\\', observaciones_visita=\\\'PARA REEMPLAZAR\\\', estado_aprobacion_requerimiento=\\\'1\\\', estado_cotizacion=\\\'1\\\' WHERE id = \\\'00000001\\\'',NULL),(0000000478,00000138,'2009-08-05 00:01:13','Reemplazar cotización','UPDATE pance_cotizaciones SET estado=\\\'5\\\' WHERE id = \\\'000001\\\'',NULL),(0000000479,00000138,'2009-08-05 00:01:13','Reemplazar cotización','INSERT INTO pance_cotizaciones (id_requerimiento,numero_cotizacion,consecutivo_cotizacion,numero_cotizacion_consorciado,estado,valor_mano_obra_cotizacion,valor_materiales_cotizacion,costo_directo,porcentaje_administracion_cotizacion,costo_administracion_cotizacion,porcentaje_imprevistos_cotizacion,costo_imprevistos_cotizacion,porcentaje_utilidad,costo_utilidad,impuesto,costo_impuesto,fecha_registro_cotizacion_consorciado) VALUES (\\\'00000001\\\',\\\'00000001\\\',\\\'1\\\',\\\'C1\\\',\\\'1\\\',\\\'5000000\\\',\\\'5000000\\\',\\\'10000000\\\',\\\'5.00\\\',\\\'5.00\\\',\\\'10.00\\\',\\\'10.00\\\',\\\'15.00\\\',\\\'15.00\\\',\\\'16.00\\\',\\\'240000\\\',\\\'2009-08-05 00:08:13\\\')',NULL),(0000000480,00000138,'2009-08-05 00:01:13','Reemplazar cotización','UPDATE pance_requerimientos_clientes SET fecha_visita=\\\'2009-08-04\\\', observaciones_visita=\\\'undefined\\\', estado_aprobacion_requerimiento=\\\'1\\\', estado_cotizacion=\\\'1\\\' WHERE id = \\\'00000001\\\'',NULL),(0000000481,00000138,'2009-08-05 00:01:14','Reemplazar cotización','INSERT INTO pance_cotizaciones (id_requerimiento,numero_cotizacion,consecutivo_cotizacion,numero_cotizacion_consorciado,estado,valor_mano_obra_cotizacion,valor_materiales_cotizacion,costo_directo,porcentaje_administracion_cotizacion,costo_administracion_cotizacion,porcentaje_imprevistos_cotizacion,costo_imprevistos_cotizacion,porcentaje_utilidad,costo_utilidad,impuesto,costo_impuesto,fecha_registro_cotizacion_consorciado) VALUES (\\\'00000001\\\',\\\'00000001\\\',\\\'2\\\',\\\'C1\\\',\\\'1\\\',\\\'5000000\\\',\\\'5000000\\\',\\\'10000000\\\',\\\'5\\\',\\\'5\\\',\\\'10\\\',\\\'10\\\',\\\'15\\\',\\\'15\\\',\\\'16.00\\\',\\\'240000\\\',\\\'2009-08-05 00:08:13\\\')',NULL),(0000000482,00000138,'2009-08-05 00:01:14','Reemplazar cotización','UPDATE pance_requerimientos_clientes SET fecha_visita=\\\'2009-08-04\\\', observaciones_visita=\\\'undefined\\\', estado_aprobacion_requerimiento=\\\'1\\\', estado_cotizacion=\\\'1\\\' WHERE id = \\\'00000001\\\'',NULL),(0000000483,00000138,'2009-08-05 00:01:14','Reemplazar cotización','INSERT INTO pance_cotizaciones (id_requerimiento,numero_cotizacion,consecutivo_cotizacion,numero_cotizacion_consorciado,estado,valor_mano_obra_cotizacion,valor_materiales_cotizacion,costo_directo,porcentaje_administracion_cotizacion,costo_administracion_cotizacion,porcentaje_imprevistos_cotizacion,costo_imprevistos_cotizacion,porcentaje_utilidad,costo_utilidad,impuesto,costo_impuesto,fecha_registro_cotizacion_consorciado) VALUES (\\\'00000001\\\',\\\'00000001\\\',\\\'3\\\',\\\'C1\\\',\\\'1\\\',\\\'10000000\\\',\\\'10000000\\\',\\\'20000000\\\',\\\'5\\\',\\\'5\\\',\\\'10\\\',\\\'10\\\',\\\'15\\\',\\\'15\\\',\\\'16.00\\\',\\\'480000\\\',\\\'2009-08-05 00:08:13\\\')',NULL),(0000000484,00000138,'2009-08-05 00:01:14','Reemplazar cotización','UPDATE pance_requerimientos_clientes SET fecha_visita=\\\'2009-08-04\\\', observaciones_visita=\\\'undefined\\\', estado_aprobacion_requerimiento=\\\'1\\\', estado_cotizacion=\\\'1\\\' WHERE id = \\\'00000001\\\'',NULL),(0000000485,00000138,'2009-08-05 00:07:57','Generar cotización','INSERT INTO pance_cotizaciones (id_requerimiento,numero_cotizacion,numero_cotizacion_consorciado,estado,valor_mano_obra_cotizacion,valor_materiales_cotizacion,costo_directo,porcentaje_administracion_cotizacion,costo_administracion_cotizacion,porcentaje_imprevistos_cotizacion,costo_imprevistos_cotizacion,porcentaje_utilidad,costo_utilidad,impuesto,costo_impuesto,forma_pago,fecha_registro_cotizacion_consorciado) VALUES (\\\'00000001\\\',\\\'1\\\',\\\'C1\\\',\\\'1\\\',\\\'20000000\\\',\\\'30000000\\\',\\\'50000000\\\',\\\'5\\\',\\\'2500000\\\',\\\'10\\\',\\\'5000000\\\',\\\'15\\\',\\\'7500000\\\',\\\'16\\\',\\\'1200000\\\',\\\'0\\\',\\\'2009-08-05 00:08:57\\\')',NULL),(0000000486,00000138,'2009-08-05 00:07:57','Generar cotización','UPDATE pance_requerimientos_clientes SET fecha_visita=\\\'2009-08-05\\\', observaciones_visita=\\\'PRUEBA REEMPLAZAR\\\', estado_aprobacion_requerimiento=\\\'1\\\', estado_cotizacion=\\\'1\\\' WHERE id = \\\'00000001\\\'',NULL),(0000000487,00000138,'2009-08-05 00:11:10','Reemplazar cotización','UPDATE pance_cotizaciones SET estado=\\\'5\\\' WHERE id = \\\'000001\\\'',NULL),(0000000488,00000138,'2009-08-05 00:11:10','Reemplazar cotización','INSERT INTO pance_cotizaciones (id_requerimiento,numero_cotizacion,consecutivo_cotizacion,numero_cotizacion_consorciado,estado,valor_mano_obra_cotizacion,valor_materiales_cotizacion,costo_directo,porcentaje_administracion_cotizacion,costo_administracion_cotizacion,porcentaje_imprevistos_cotizacion,costo_imprevistos_cotizacion,porcentaje_utilidad,costo_utilidad,impuesto,costo_impuesto,fecha_registro_cotizacion_consorciado) VALUES (\\\'00000001\\\',\\\'00000001\\\',\\\'1\\\',\\\'C1\\\',\\\'1\\\',\\\'5000000\\\',\\\'5000000\\\',\\\'10000000\\\',\\\'5.00\\\',\\\'500000\\\',\\\'10.00\\\',\\\'1000000\\\',\\\'15.00\\\',\\\'1500000\\\',\\\'16.00\\\',\\\'240000\\\',\\\'2009-08-05 00:08:10\\\')',NULL),(0000000489,00000138,'2009-08-05 00:11:10','Reemplazar cotización','UPDATE pance_requerimientos_clientes SET fecha_visita=\\\'2009-08-05\\\', observaciones_visita=\\\'undefined\\\', estado_aprobacion_requerimiento=\\\'1\\\', estado_cotizacion=\\\'1\\\' WHERE id = \\\'00000001\\\'',NULL),(0000000490,00000138,'2009-08-05 00:11:10','Reemplazar cotización','INSERT INTO pance_cotizaciones (id_requerimiento,numero_cotizacion,consecutivo_cotizacion,numero_cotizacion_consorciado,estado,valor_mano_obra_cotizacion,valor_materiales_cotizacion,costo_directo,porcentaje_administracion_cotizacion,costo_administracion_cotizacion,porcentaje_imprevistos_cotizacion,costo_imprevistos_cotizacion,porcentaje_utilidad,costo_utilidad,impuesto,costo_impuesto,fecha_registro_cotizacion_consorciado) VALUES (\\\'00000001\\\',\\\'00000001\\\',\\\'2\\\',\\\'C1\\\',\\\'1\\\',\\\'5000000\\\',\\\'10000000\\\',\\\'15000000\\\',\\\'5\\\',\\\'750000\\\',\\\'10\\\',\\\'1500000\\\',\\\'15\\\',\\\'2250000\\\',\\\'16.00\\\',\\\'360000\\\',\\\'2009-08-05 00:08:10\\\')',NULL),(0000000491,00000138,'2009-08-05 00:11:10','Reemplazar cotización','UPDATE pance_requerimientos_clientes SET fecha_visita=\\\'2009-08-05\\\', observaciones_visita=\\\'undefined\\\', estado_aprobacion_requerimiento=\\\'1\\\', estado_cotizacion=\\\'1\\\' WHERE id = \\\'00000001\\\'',NULL),(0000000492,00000138,'2009-08-05 00:11:11','Reemplazar cotización','INSERT INTO pance_cotizaciones (id_requerimiento,numero_cotizacion,consecutivo_cotizacion,numero_cotizacion_consorciado,estado,valor_mano_obra_cotizacion,valor_materiales_cotizacion,costo_directo,porcentaje_administracion_cotizacion,costo_administracion_cotizacion,porcentaje_imprevistos_cotizacion,costo_imprevistos_cotizacion,porcentaje_utilidad,costo_utilidad,impuesto,costo_impuesto,fecha_registro_cotizacion_consorciado) VALUES (\\\'00000001\\\',\\\'00000001\\\',\\\'3\\\',\\\'C1\\\',\\\'1\\\',\\\'10000000\\\',\\\'15000000\\\',\\\'25000000\\\',\\\'5\\\',\\\'1250000\\\',\\\'10\\\',\\\'2500000\\\',\\\'15\\\',\\\'3750000\\\',\\\'16.00\\\',\\\'600000\\\',\\\'2009-08-05 00:08:10\\\')',NULL),(0000000493,00000138,'2009-08-05 00:11:11','Reemplazar cotización','UPDATE pance_requerimientos_clientes SET fecha_visita=\\\'2009-08-05\\\', observaciones_visita=\\\'undefined\\\', estado_aprobacion_requerimiento=\\\'1\\\', estado_cotizacion=\\\'1\\\' WHERE id = \\\'00000001\\\'',NULL),(0000000494,00000138,'2009-08-05 00:13:16','Aprobar cotización','UPDATE pance_cotizaciones SET estado=\\\'2\\\', observaciones_aprobacion_cliente=NULL, fecha_registro_aprobacion_clientes=\\\'2009-08-05\\\', fecha_registro_aprobacion_sistema=\\\'2009-08-05 00:08:16\\\' WHERE id = \\\'000004\\\'',NULL),(0000000495,00000138,'2009-08-05 00:13:16','Aprobar cotización','UPDATE pance_requerimientos_clientes SET estado_cotizacion=\\\'2\\\' WHERE id = \\\'00000001\\\'',NULL),(0000000496,00000138,'2009-08-05 00:13:29','Aprobar cotización','UPDATE pance_cotizaciones SET estado=\\\'2\\\', observaciones_aprobacion_cliente=NULL, fecha_registro_aprobacion_clientes=\\\'2009-08-05\\\', fecha_registro_aprobacion_sistema=\\\'2009-08-05 00:08:29\\\' WHERE id = \\\'000003\\\'',NULL),(0000000497,00000138,'2009-08-05 00:13:29','Aprobar cotización','UPDATE pance_requerimientos_clientes SET estado_cotizacion=\\\'2\\\' WHERE id = \\\'00000001\\\'',NULL),(0000000498,00000138,'2009-08-05 00:16:00','Recotizar cotización','UPDATE pance_cotizaciones SET estado=\\\'4\\\' WHERE id = \\\'000002\\\'',NULL),(0000000499,00000138,'2009-08-05 00:16:00','Recotizar cotización','INSERT INTO pance_cotizaciones (id_requerimiento,numero_cotizacion,consecutivo_cotizacion,numero_cotizacion_consorciado,estado,valor_mano_obra_cotizacion,valor_materiales_cotizacion,costo_directo,porcentaje_administracion_cotizacion,costo_administracion_cotizacion,porcentaje_imprevistos_cotizacion,costo_imprevistos_cotizacion,porcentaje_utilidad,costo_utilidad,impuesto,costo_impuesto,forma_pago,fecha_registro_cotizacion_consorciado) VALUES (\\\'00000001\\\',\\\'00000001\\\',\\\'4\\\',\\\'C1\\\',\\\'1\\\',\\\'4000000\\\',\\\'4000000\\\',\\\'8000000\\\',\\\'5.00\\\',\\\'400000\\\',\\\'10.00\\\',\\\'800000\\\',\\\'15.00\\\',\\\'1200000\\\',\\\'16.00\\\',\\\'192000\\\',\\\'1\\\',\\\'2009-08-05 00:08:00\\\')',NULL),(0000000500,00000138,'2009-08-05 00:16:00','Recotizar cotización','UPDATE pance_requerimientos_clientes SET fecha_visita=\\\'2009-08-05\\\', observaciones_visita=\\\'undefined\\\', estado_aprobacion_requerimiento=\\\'1\\\', estado_cotizacion=\\\'1\\\' WHERE id = \\\'00000001\\\'',NULL),(0000000501,00000138,'2009-08-05 00:17:03','Generar cotización','INSERT INTO pance_cotizaciones (id_requerimiento,numero_cotizacion,numero_cotizacion_consorciado,estado,valor_mano_obra_cotizacion,valor_materiales_cotizacion,costo_directo,impuesto,costo_impuesto,forma_pago,porcentaje_anticipo,fecha_registro_cotizacion_consorciado) VALUES (\\\'00000003\\\',\\\'2\\\',\\\'C1\\\',\\\'1\\\',\\\'85000000\\\',\\\'5600000\\\',\\\'90600000\\\',\\\'16\\\',\\\'14496000\\\',\\\'0\\\',\\\'0\\\',\\\'2009-08-05 00:08:03\\\')',NULL),(0000000502,00000138,'2009-08-05 00:17:03','Generar cotización','UPDATE pance_requerimientos_clientes SET fecha_visita=\\\'2009-08-04\\\', observaciones_visita=\\\'PRUEBA NO AIU\\\', estado_aprobacion_requerimiento=\\\'1\\\', estado_cotizacion=\\\'1\\\' WHERE id = \\\'00000003\\\'',NULL),(0000000503,00000138,'2009-08-05 00:19:19','Reemplazar cotización','UPDATE pance_cotizaciones SET estado=\\\'5\\\' WHERE id = \\\'000006\\\'',NULL),(0000000504,00000138,'2009-08-05 00:19:19','Reemplazar cotización','INSERT INTO pance_cotizaciones (id_requerimiento,numero_cotizacion,consecutivo_cotizacion,numero_cotizacion_consorciado,estado,valor_mano_obra_cotizacion,valor_materiales_cotizacion,costo_directo,impuesto,costo_impuesto,fecha_registro_cotizacion_consorciado) VALUES (\\\'00000003\\\',\\\'00000002\\\',\\\'1\\\',\\\'C1\\\',\\\'1\\\',\\\'40000000\\\',\\\'2600000\\\',\\\'42600000\\\',\\\'16.00\\\',\\\'6816000\\\',\\\'2009-08-05 00:08:19\\\')',NULL),(0000000505,00000138,'2009-08-05 00:19:19','Reemplazar cotización','UPDATE pance_requerimientos_clientes SET fecha_visita=\\\'2009-08-04\\\', observaciones_visita=\\\'undefined\\\', estado_aprobacion_requerimiento=\\\'1\\\', estado_cotizacion=\\\'1\\\' WHERE id = \\\'00000003\\\'',NULL),(0000000506,00000138,'2009-08-05 00:19:19','Reemplazar cotización','INSERT INTO pance_cotizaciones (id_requerimiento,numero_cotizacion,consecutivo_cotizacion,numero_cotizacion_consorciado,estado,valor_mano_obra_cotizacion,valor_materiales_cotizacion,costo_directo,impuesto,costo_impuesto,fecha_registro_cotizacion_consorciado) VALUES (\\\'00000003\\\',\\\'00000002\\\',\\\'2\\\',\\\'C1\\\',\\\'1\\\',\\\'45000000\\\',\\\'2000000\\\',\\\'47000000\\\',\\\'16.00\\\',\\\'7520000\\\',\\\'2009-08-05 00:08:19\\\')',NULL),(0000000507,00000138,'2009-08-05 00:19:19','Reemplazar cotización','UPDATE pance_requerimientos_clientes SET fecha_visita=\\\'2009-08-04\\\', observaciones_visita=\\\'undefined\\\', estado_aprobacion_requerimiento=\\\'1\\\', estado_cotizacion=\\\'1\\\' WHERE id = \\\'00000003\\\'',NULL),(0000000508,00000138,'2009-08-05 00:20:33','Exportar cotización','UPDATE pance_cotizaciones SET estado_cotizacion=\\\'1\\\' WHERE id = \\\'000004\\\'',NULL),(0000000509,00000139,'2009-08-06 13:57:45','Iniciar sesión','INSERT INTO pance_conexiones (fecha,id_usuario,ip) VALUES (\\\'2009-08-06 13:57:45\\\',\\\'0001\\\',\\\'127.0.0.1\\\')',NULL);
/*!40000 ALTER TABLE `pance_bitacora` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pance_bodegas`
--

DROP TABLE IF EXISTS `pance_bodegas`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `pance_bodegas` (
  `id` mediumint(5) unsigned zerofill NOT NULL auto_increment COMMENT 'Consecutivo interno de la base de datos',
  `codigo` smallint(4) unsigned zerofill NOT NULL COMMENT 'CÃ³digo interno de la bodega',
  `id_sucursal` mediumint(5) unsigned zerofill NOT NULL COMMENT 'CÃ³digo interno de la sucursal a la cual pertenece',
  `nombre` varchar(60) NOT NULL COMMENT 'Nombre que identifica la bodega',
  `descripcion` varchar(60) NOT NULL COMMENT 'Nombre que describe la bodega',
  `tipo_bodega` smallint(3) unsigned zerofill NOT NULL COMMENT 'Localizacion donde se encuentra ubicado el articulo',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `codigo` (`codigo`),
  KEY `bodega_sucursal` (`id_sucursal`),
  KEY `tipo_bodega` (`tipo_bodega`),
  CONSTRAINT `bodega_sucursal` FOREIGN KEY (`id_sucursal`) REFERENCES `pance_sucursales` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `tipo_bodega` FOREIGN KEY (`tipo_bodega`) REFERENCES `pance_tipos_bodegas` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `pance_bodegas`
--

LOCK TABLES `pance_bodegas` WRITE;
/*!40000 ALTER TABLE `pance_bodegas` DISABLE KEYS */;
/*!40000 ALTER TABLE `pance_bodegas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `pance_buscador_actas`
--

DROP TABLE IF EXISTS `pance_buscador_actas`;
/*!50001 DROP VIEW IF EXISTS `pance_buscador_actas`*/;
/*!50001 CREATE TABLE `pance_buscador_actas` (
  `id` int(6) unsigned zerofill,
  `FECHA_ENTREGA_ACTA` date,
  `VALOR_FACTURAR` decimal(12,2),
  `FACTURA_CONSORCIADO` varchar(12),
  `PAGO_CLIENTE` varchar(9),
  `PAGO_CONSORCIADO` varchar(9),
  `PORCENTAJE_MANO_OBRA` decimal(5,2),
  `PORCENTAJE_MATERIALES` decimal(5,2)
) */;

--
-- Temporary table structure for view `pance_buscador_actividades_economicas`
--

DROP TABLE IF EXISTS `pance_buscador_actividades_economicas`;
/*!50001 DROP VIEW IF EXISTS `pance_buscador_actividades_economicas`*/;
/*!50001 CREATE TABLE `pance_buscador_actividades_economicas` (
  `id` smallint(4) unsigned zerofill,
  `codigo_DIAN` smallint(4) unsigned zerofill,
  `codigo_interno` smallint(4) unsigned zerofill,
  `descripcion` varchar(255)
) */;

--
-- Temporary table structure for view `pance_buscador_agenda`
--

DROP TABLE IF EXISTS `pance_buscador_agenda`;
/*!50001 DROP VIEW IF EXISTS `pance_buscador_agenda`*/;
/*!50001 CREATE TABLE `pance_buscador_agenda` (
  `id` smallint(3) unsigned zerofill,
  `fecha` date,
  `hora_inicio` time,
  `titulo` varchar(255)
) */;

--
-- Temporary table structure for view `pance_buscador_barrios`
--

DROP TABLE IF EXISTS `pance_buscador_barrios`;
/*!50001 DROP VIEW IF EXISTS `pance_buscador_barrios`*/;
/*!50001 CREATE TABLE `pance_buscador_barrios` (
  `id` int(8) unsigned zerofill,
  `codigo_municipal` smallint(3) unsigned zerofill,
  `nombre` varchar(255),
  `codigo_interno` int(8) unsigned zerofill,
  `comuna` tinyint(2),
  `estrato` tinyint(1),
  `municipio` varchar(255),
  `departamento` varchar(255),
  `pais` varchar(255)
) */;

--
-- Temporary table structure for view `pance_buscador_bodegas`
--

DROP TABLE IF EXISTS `pance_buscador_bodegas`;
/*!50001 DROP VIEW IF EXISTS `pance_buscador_bodegas`*/;
/*!50001 CREATE TABLE `pance_buscador_bodegas` (
  `id` mediumint(5) unsigned zerofill,
  `codigo` smallint(4) unsigned zerofill,
  `codigo_sucursal` mediumint(5) unsigned zerofill,
  `nombre` varchar(60),
  `descripcion` varchar(60),
  `tipo_bodega` smallint(3) unsigned zerofill,
  `sucursal` varchar(60)
) */;

--
-- Temporary table structure for view `pance_buscador_cargos`
--

DROP TABLE IF EXISTS `pance_buscador_cargos`;
/*!50001 DROP VIEW IF EXISTS `pance_buscador_cargos`*/;
/*!50001 CREATE TABLE `pance_buscador_cargos` (
  `id` smallint(3) unsigned zerofill,
  `codigo` smallint(3) unsigned zerofill,
  `nombre` varchar(50),
  `INTERNO` varchar(7)
) */;

--
-- Temporary table structure for view `pance_buscador_clientes`
--

DROP TABLE IF EXISTS `pance_buscador_clientes`;
/*!50001 DROP VIEW IF EXISTS `pance_buscador_clientes`*/;
/*!50001 CREATE TABLE `pance_buscador_clientes` (
  `id` int(8) unsigned zerofill,
  `documento_identidad` varchar(12),
  `tipo_persona` varchar(8),
  `id_tipo_documento` smallint(3) unsigned zerofill,
  `id_municipio_documento` int(8) unsigned zerofill,
  `id_municipio_residencia` int(8) unsigned zerofill,
  `primer_nombre` varchar(15),
  `segundo_nombre` varchar(15),
  `primer_apellido` varchar(20),
  `segundo_apellido` varchar(20),
  `razon_social` varchar(255),
  `nombre_comercial` varchar(255),
  `genero` smallint(3) unsigned zerofill,
  `direccion_principal` varchar(50),
  `telefono_principal` varchar(15),
  `nombre_completo` varchar(329),
  `fax` varchar(20),
  `celular` varchar(20),
  `correo` varchar(255),
  `sitio_web` varchar(50)
) */;

--
-- Temporary table structure for view `pance_buscador_conexiones`
--

DROP TABLE IF EXISTS `pance_buscador_conexiones`;
/*!50001 DROP VIEW IF EXISTS `pance_buscador_conexiones`*/;
/*!50001 CREATE TABLE `pance_buscador_conexiones` (
  `id` int(8) unsigned zerofill,
  `FECHA` datetime,
  `USUARIO` char(50),
  `IP` varchar(15),
  `PROXY` varchar(15)
) */;

--
-- Temporary table structure for view `pance_buscador_corregimientos`
--

DROP TABLE IF EXISTS `pance_buscador_corregimientos`;
/*!50001 DROP VIEW IF EXISTS `pance_buscador_corregimientos`*/;
/*!50001 CREATE TABLE `pance_buscador_corregimientos` (
  `id` int(8) unsigned zerofill,
  `codigo_dane` varchar(8),
  `nombre` varchar(255),
  `codigo_interno` int(8) unsigned zerofill,
  `municipio` varchar(255),
  `departamento` varchar(255),
  `pais` varchar(255)
) */;

--
-- Temporary table structure for view `pance_buscador_cotizaciones`
--

DROP TABLE IF EXISTS `pance_buscador_cotizaciones`;
/*!50001 DROP VIEW IF EXISTS `pance_buscador_cotizaciones`*/;
/*!50001 CREATE TABLE `pance_buscador_cotizaciones` (
  `id` int(6) unsigned zerofill,
  `numero_cotizacion` varbinary(18),
  `numero_cotizacion_consorciado` varchar(15),
  `fecha_ingreso` date,
  `id_sede` int(8) unsigned zerofill,
  `nombre_sede` varchar(60),
  `municipio` varchar(255),
  `sucursal` mediumint(5) unsigned zerofill,
  `tipo_solicitud` varchar(20),
  `descripcion` varchar(255),
  `contacto` varchar(255),
  `forma_pago` varchar(14),
  `estado` varchar(11)
) */;

--
-- Temporary table structure for view `pance_buscador_departamentos`
--

DROP TABLE IF EXISTS `pance_buscador_departamentos`;
/*!50001 DROP VIEW IF EXISTS `pance_buscador_departamentos`*/;
/*!50001 CREATE TABLE `pance_buscador_departamentos` (
  `id` int(5) unsigned zerofill,
  `codigo_dane` varchar(2),
  `codigo_interno` smallint(3) unsigned zerofill,
  `nombre` varchar(255),
  `pais` varchar(255)
) */;

--
-- Temporary table structure for view `pance_buscador_empresas`
--

DROP TABLE IF EXISTS `pance_buscador_empresas`;
/*!50001 DROP VIEW IF EXISTS `pance_buscador_empresas`*/;
/*!50001 CREATE TABLE `pance_buscador_empresas` (
  `id` smallint(3) unsigned zerofill,
  `codigo` smallint(3) unsigned zerofill,
  `razon_social` varchar(60),
  `nombre_corto` char(10),
  `nombre_completo` varchar(329)
) */;

--
-- Temporary table structure for view `pance_buscador_impresoras`
--

DROP TABLE IF EXISTS `pance_buscador_impresoras`;
/*!50001 DROP VIEW IF EXISTS `pance_buscador_impresoras`*/;
/*!50001 CREATE TABLE `pance_buscador_impresoras` (
  `id` smallint(3) unsigned zerofill,
  `nombre_cola` varchar(50),
  `descripcion` varchar(50)
) */;

--
-- Temporary table structure for view `pance_buscador_municipios`
--

DROP TABLE IF EXISTS `pance_buscador_municipios`;
/*!50001 DROP VIEW IF EXISTS `pance_buscador_municipios`*/;
/*!50001 CREATE TABLE `pance_buscador_municipios` (
  `id` int(8) unsigned zerofill,
  `codigo_dane` varchar(5),
  `codigo_interno` int(4) unsigned zerofill,
  `nombre` varchar(255),
  `departamento` varchar(255),
  `pais` varchar(255)
) */;

--
-- Temporary table structure for view `pance_buscador_paises`
--

DROP TABLE IF EXISTS `pance_buscador_paises`;
/*!50001 DROP VIEW IF EXISTS `pance_buscador_paises`*/;
/*!50001 CREATE TABLE `pance_buscador_paises` (
  `id` smallint(3) unsigned zerofill,
  `codigo_iso` varchar(2),
  `codigo_interno` smallint(3) unsigned zerofill,
  `nombre` varchar(255)
) */;

--
-- Temporary table structure for view `pance_buscador_perfiles`
--

DROP TABLE IF EXISTS `pance_buscador_perfiles`;
/*!50001 DROP VIEW IF EXISTS `pance_buscador_perfiles`*/;
/*!50001 CREATE TABLE `pance_buscador_perfiles` (
  `id` smallint(4) unsigned zerofill,
  `codigo` smallint(4) unsigned zerofill,
  `nombre` varchar(255)
) */;

--
-- Temporary table structure for view `pance_buscador_preferencias`
--

DROP TABLE IF EXISTS `pance_buscador_preferencias`;
/*!50001 DROP VIEW IF EXISTS `pance_buscador_preferencias`*/;
/*!50001 CREATE TABLE `pance_buscador_preferencias` (
  `id` smallint(4) unsigned zerofill,
  `TIPO` varchar(10),
  `VARIABLE` varchar(255),
  `VALOR` varchar(255),
  `USUARIO` varchar(50)
) */;

--
-- Temporary table structure for view `pance_buscador_privilegios`
--

DROP TABLE IF EXISTS `pance_buscador_privilegios`;
/*!50001 DROP VIEW IF EXISTS `pance_buscador_privilegios`*/;
/*!50001 CREATE TABLE `pance_buscador_privilegios` (
  `id` int(8) unsigned zerofill,
  `usuario` char(50),
  `sucursal` varchar(60)
) */;

--
-- Temporary table structure for view `pance_buscador_profesiones_oficios`
--

DROP TABLE IF EXISTS `pance_buscador_profesiones_oficios`;
/*!50001 DROP VIEW IF EXISTS `pance_buscador_profesiones_oficios`*/;
/*!50001 CREATE TABLE `pance_buscador_profesiones_oficios` (
  `id` smallint(4) unsigned zerofill,
  `descripcion` varchar(255)
) */;

--
-- Temporary table structure for view `pance_buscador_registro_obras`
--

DROP TABLE IF EXISTS `pance_buscador_registro_obras`;
/*!50001 DROP VIEW IF EXISTS `pance_buscador_registro_obras`*/;
/*!50001 CREATE TABLE `pance_buscador_registro_obras` (
  `id` int(6) unsigned zerofill,
  `fecha_ingreso` date,
  `id_sede` int(8) unsigned zerofill,
  `nombre_sede` varchar(60),
  `municipio` int(8) unsigned zerofill,
  `sucursal` mediumint(5) unsigned zerofill,
  `valor_facturar` decimal(12,2),
  `tipo_solicitud` varchar(20),
  `descripcion` varchar(255)
) */;

--
-- Temporary table structure for view `pance_buscador_reporte_visitas`
--

DROP TABLE IF EXISTS `pance_buscador_reporte_visitas`;
/*!50001 DROP VIEW IF EXISTS `pance_buscador_reporte_visitas`*/;
/*!50001 CREATE TABLE `pance_buscador_reporte_visitas` (
  `id` int(8) unsigned zerofill,
  `fecha_ingreso` date,
  `nombre_sede` varchar(60),
  `municipio` varchar(255),
  `sucursal` mediumint(5) unsigned zerofill,
  `tipo_solicitud` varchar(20),
  `descripcion` varchar(255),
  `contacto` varchar(255),
  `NOTIFICADO` varchar(13)
) */;

--
-- Temporary table structure for view `pance_buscador_requerimientos_clientes`
--

DROP TABLE IF EXISTS `pance_buscador_requerimientos_clientes`;
/*!50001 DROP VIEW IF EXISTS `pance_buscador_requerimientos_clientes`*/;
/*!50001 CREATE TABLE `pance_buscador_requerimientos_clientes` (
  `id` int(8) unsigned zerofill,
  `nombre_sede` varchar(60),
  `sucursal` varchar(60),
  `municipio` varchar(255),
  `tipo_solicitud` varchar(20),
  `estado_cotizacion` varchar(11),
  `contacto` varchar(255)
) */;

--
-- Temporary table structure for view `pance_buscador_secciones`
--

DROP TABLE IF EXISTS `pance_buscador_secciones`;
/*!50001 DROP VIEW IF EXISTS `pance_buscador_secciones`*/;
/*!50001 CREATE TABLE `pance_buscador_secciones` (
  `id` int(8) unsigned zerofill,
  `nombre` varchar(60),
  `descripcion` varchar(60),
  `codigo_bodega` mediumint(5) unsigned zerofill,
  `codigo` smallint(4) unsigned zerofill,
  `bodega` varchar(60)
) */;

--
-- Temporary table structure for view `pance_buscador_sedes_clientes`
--

DROP TABLE IF EXISTS `pance_buscador_sedes_clientes`;
/*!50001 DROP VIEW IF EXISTS `pance_buscador_sedes_clientes`*/;
/*!50001 CREATE TABLE `pance_buscador_sedes_clientes` (
  `id` int(8) unsigned zerofill,
  `id_cliente` varchar(329),
  `id_sucursal` varchar(60),
  `nombre_sede` varchar(60),
  `nombre_contacto` varchar(255),
  `id_municipios` int(8) unsigned zerofill,
  `direccion` varchar(50),
  `telefono_principal` varchar(15),
  `celular` varchar(15),
  `correo` varchar(100)
) */;

--
-- Temporary table structure for view `pance_buscador_servidores`
--

DROP TABLE IF EXISTS `pance_buscador_servidores`;
/*!50001 DROP VIEW IF EXISTS `pance_buscador_servidores`*/;
/*!50001 CREATE TABLE `pance_buscador_servidores` (
  `id` smallint(3) unsigned zerofill,
  `ip` varchar(15),
  `nombre_netbios` varchar(50),
  `nombre_tcpip` varchar(50)
) */;

--
-- Temporary table structure for view `pance_buscador_sucursales`
--

DROP TABLE IF EXISTS `pance_buscador_sucursales`;
/*!50001 DROP VIEW IF EXISTS `pance_buscador_sucursales`*/;
/*!50001 CREATE TABLE `pance_buscador_sucursales` (
  `id` mediumint(5) unsigned zerofill,
  `codigo` smallint(3) unsigned zerofill,
  `nombre` varchar(60),
  `nombre_corto` char(10),
  `empresa` varchar(60),
  `tercero` varchar(329)
) */;

--
-- Temporary table structure for view `pance_buscador_terminales`
--

DROP TABLE IF EXISTS `pance_buscador_terminales`;
/*!50001 DROP VIEW IF EXISTS `pance_buscador_terminales`*/;
/*!50001 CREATE TABLE `pance_buscador_terminales` (
  `id` smallint(3) unsigned zerofill,
  `ip` varchar(15),
  `nombre_netbios` varchar(50),
  `nombre_tcpip` varchar(50)
) */;

--
-- Temporary table structure for view `pance_buscador_tipos_bodegas`
--

DROP TABLE IF EXISTS `pance_buscador_tipos_bodegas`;
/*!50001 DROP VIEW IF EXISTS `pance_buscador_tipos_bodegas`*/;
/*!50001 CREATE TABLE `pance_buscador_tipos_bodegas` (
  `id` smallint(3) unsigned zerofill,
  `nombre` varchar(60),
  `descripcion` varchar(60)
) */;

--
-- Temporary table structure for view `pance_buscador_tipos_documento_identidad`
--

DROP TABLE IF EXISTS `pance_buscador_tipos_documento_identidad`;
/*!50001 DROP VIEW IF EXISTS `pance_buscador_tipos_documento_identidad`*/;
/*!50001 CREATE TABLE `pance_buscador_tipos_documento_identidad` (
  `id` smallint(3) unsigned zerofill,
  `codigo_DIAN` smallint(3) unsigned zerofill,
  `codigo_interno` smallint(3) unsigned zerofill,
  `descripcion` varchar(255)
) */;

--
-- Temporary table structure for view `pance_buscador_usuarios`
--

DROP TABLE IF EXISTS `pance_buscador_usuarios`;
/*!50001 DROP VIEW IF EXISTS `pance_buscador_usuarios`*/;
/*!50001 CREATE TABLE `pance_buscador_usuarios` (
  `id` smallint(4) unsigned zerofill,
  `usuario` varchar(12),
  `nombre` char(50)
) */;

--
-- Table structure for table `pance_cargos`
--

DROP TABLE IF EXISTS `pance_cargos`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `pance_cargos` (
  `id` smallint(3) unsigned zerofill NOT NULL auto_increment COMMENT 'Consecutivo interno de la base de datos',
  `codigo_interno` smallint(3) unsigned zerofill NOT NULL COMMENT 'Codigo interno asignado por el usuario',
  `nombre` varchar(50) NOT NULL COMMENT 'Nombre del cargo',
  `interno` enum('0','1') NOT NULL default '1' COMMENT 'Cargo interno 0->No 1->Si',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `codigo_interno` (`codigo_interno`),
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=904 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `pance_cargos`
--

LOCK TABLES `pance_cargos` WRITE;
/*!40000 ALTER TABLE `pance_cargos` DISABLE KEYS */;
INSERT INTO `pance_cargos` VALUES (900,999,'&lt; No aplica &gt;','0'),(901,001,'INGENIERO DE PROYECTOS','0'),(902,002,'JEFE DE DEPOSITO','0'),(903,003,'JEFE DE VENTAS','0');
/*!40000 ALTER TABLE `pance_cargos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pance_componentes`
--

DROP TABLE IF EXISTS `pance_componentes`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `pance_componentes` (
  `id` varchar(8) NOT NULL COMMENT 'Identificador del componente',
  `padre` varchar(8) default NULL COMMENT 'Identificador del padre del componente: NULL = Componente principal',
  `id_modulo` char(32) NOT NULL COMMENT 'Identificador del modulo al cual pertenece',
  `global` enum('0','1') NOT NULL default '0' COMMENT 'Todos los usuarios lo pueden cargar sin verificar permisos: 0=No, 1=Si',
  `visible` enum('0','1') NOT NULL default '1' COMMENT 'El componente debe aparecer en el menÃº: 0=No, 1=Si',
  `orden` smallint(4) unsigned zerofill NOT NULL default '0000' COMMENT 'Orden en el que debe presentarse en el menÃº Ã³ en los listados',
  `carpeta` varchar(255) default NULL COMMENT 'Carpeta donde estÃ¡ almacenado el archivo',
  `archivo` varchar(255) default NULL COMMENT 'Archivo que se debe cargar al seleccionar el componente: NULL = No genera enlace o acciÃ³n',
  PRIMARY KEY  (`id`),
  KEY `componente_modulo` (`id_modulo`),
  CONSTRAINT `componente_modulo` FOREIGN KEY (`id_modulo`) REFERENCES `pance_modulos` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `pance_componentes`
--

LOCK TABLES `pance_componentes` WRITE;
/*!40000 ALTER TABLE `pance_componentes` DISABLE KEYS */;
INSERT INTO `pance_componentes` VALUES ('ADICAECO','GESTAECO','ADMINISTRACION','0','0',0005,'actividades_economicas','adicionar'),('ADICAGEN','GESTAGEN','EXTENSIONES','0','0',0005,'agenda','adicionar'),('ADICANCO','GESTANCO','CONTABILIDAD','0','0',0005,'anexos_contables','adicionar'),('ADICAUCO','GESTAUCO','CONTABILIDAD','0','0',0005,'auxiliares_contables','adicionar'),('ADICBANC','GESTBANC','CONTABILIDAD','0','0',0005,'bancos','adicionar'),('ADICBARR','GESTBARR','ADMINISTRACION','0','0',0005,'barrios','adicionar'),('ADICBODE','GESTBODE','ADMINISTRACION','0','0',0005,'bodegas','adicionar'),('ADICCARG','GESTCARG','ADMINISTRACION','0','0',0005,'cargos','adicionar'),('ADICCLIE','GESTCLIE','CLIENTES','0','0',0005,'clientes','adicionar'),('ADICCLMA','GESTCLMA','CLIENTES','0','0',0005,'clientes_mayoristas','adicionar'),('ADICCMMY','GESTCMMY','CLIENTES','0','0',0005,'comisiones_mayoristas','adicionar'),('ADICCODI','GESTCODI','CONTABILIDAD','0','0',0005,'conceptos_DIAN','adicionar'),('ADICCOFE','GESTCOFE','CONTABILIDAD','0','0',0005,'conceptos_flujo_efectivo','adicionar'),('ADICCOMA','GESTCOMA','CLIENTES','0','0',0005,'contactos_mayoristas','adicionar'),('ADICCORR','GESTCORR','ADMINISTRACION','0','0',0005,'corregimientos','adicionar'),('ADICCOTI','GESTCOCL','CLIENTES','0','0',0005,'cotizaciones','adicionar'),('ADICDEPA','GESTDEPA','ADMINISTRACION','0','0',0005,'departamentos','adicionar'),('ADICEMPR','GESTEMPR','ADMINISTRACION','0','0',0005,'empresas','adicionar'),('ADICFODI','GESTFODI','CONTABILIDAD','0','0',0005,'formatos_DIAN','adicionar'),('ADICICAE','GESTICAE','CONTABILIDAD','0','0',0005,'tasas_ica_por_actividad_economica','adicionar'),('ADICIMPR','GESTIMPR','ADMINISTRACION','0','0',0005,'impresoras','adicionar'),('ADICINEG','GESTINEG','CLIENTES','0','0',0005,'registro_ingresos','adicionar'),('ADICMUNI','GESTMUNI','ADMINISTRACION','0','0',0005,'municipios','adicionar'),('ADICNOTA','GESTNOTA','EXTENSIONES','0','0',0005,'notas','adicionar'),('ADICPAIS','GESTPAIS','ADMINISTRACION','0','0',0005,'paises','adicionar'),('ADICPERF','GESTPERF','ADMINISTRACION','0','0',0005,'perfiles','adicionar'),('ADICPLCO','GESTPLCO','CONTABILIDAD','0','0',0005,'plan_contable','adicionar'),('ADICPREF','GESTPREF','ADMINISTRACION','0','0',0005,'preferencias','adicionar'),('ADICPRIV','GESTPRIV','ADMINISTRACION','0','0',0005,'privilegios','adicionar'),('ADICPROF','GESTPROF','ADMINISTRACION','0','0',0005,'profesiones_oficios','adicionar'),('ADICREAR','GESTREAR','CONTABILIDAD','0','0',0005,'resoluciones_auto_retencion','adicionar'),('ADICRECL','GESTRECL','CLIENTES','0','0',0005,'requerimientos_clientes','adicionar'),('ADICREDI','GESTREDI','CONTABILIDAD','0','0',0005,'resoluciones_DIAN','adicionar'),('ADICREIC','GESTREIC','CONTABILIDAD','0','0',0005,'resoluciones_ica','adicionar'),('ADICREOB','GESTREOB','CLIENTES','0','0',0005,'registro_obras','adicionar'),('ADICREVI','GESTREVI','CLIENTES','0','0',0005,'reporte_visitas','cotizar'),('ADICSECC','GESTSECC','ADMINISTRACION','0','0',0005,'secciones','adicionar'),('ADICSEDE','GESTSEDE','CLIENTES','0','0',0005,'sedes_clientes','adicionar'),('ADICSRVD','GESTSRVD','ADMINISTRACION','0','0',0005,'servidores','adicionar'),('ADICSUCU','GESTSUCU','ADMINISTRACION','0','0',0005,'sucursales','adicionar'),('ADICSUMA','GESTSUMA','CLIENTES','0','0',0005,'sucursales_mayoristas','adicionar'),('ADICTACA','GESTTACA','CONTABILIDAD','0','0',0005,'tasas_de_cambio','adicionar'),('ADICTASA','GESTTASA','CONTABILIDAD','0','0',0005,'tasas','adicionar'),('ADICTERM','GESTTERM','ADMINISTRACION','0','0',0005,'terminales','adicionar'),('ADICTIBO','GESTTIBO','ADMINISTRACION','0','0',0005,'tipos_bodegas','adicionar'),('ADICTICO','GESTTICO','CONTABILIDAD','0','0',0005,'tipos_de_comprobantes','adicionar'),('ADICTIDI','GESTTIDI','ADMINISTRACION','0','0',0005,'tipos_documento_identidad','adicionar'),('ADICTIDO','GESTTIDO','CONTABILIDAD','0','0',0005,'tipos_de_documentos','adicionar'),('ADICTIMO','GESTTIMO','CONTABILIDAD','0','0',0005,'tipos_de_moneda','adicionar'),('ADICTRMA','GESTTRMA','CLIENTES','0','0',0005,'transacciones_clientes_mayoristas','adicionar'),('ADICUSUA','GESTUSUA','ADMINISTRACION','0','0',0005,'usuarios','adicionar'),('ADICVECO','GESTVECO','CLIENTES','0','0',0005,'vendedores_cobradores','adicionar'),('ADICVITA','GESTVITA','CONTABILIDAD','0','0',0005,'vigencia_tasas','adicionar'),('ADICZOVM','GESTZOVM','CLIENTES','0','0',0005,'zona_ventas_mayoristas','adicionar'),('ANULCOTI','GESTCOCL','CLIENTES','0','0',0015,'cotizaciones','anular'),('APROCOTI','GESTCOCL','CLIENTES','0','0',0010,'cotizaciones','aprobar'),('CONSACTA','GESTACTA','CLIENTES','0','0',0005,'actas','consultar'),('CONSAECO','GESTAECO','ADMINISTRACION','0','0',0010,'actividades_economicas','consultar'),('CONSAGEN','GESTAGEN','EXTENSIONES','0','0',0010,'agenda','consultar'),('CONSANCO','GESTANCO','CONTABILIDAD','0','0',0010,'anexos_contables','consultar'),('CONSAUCO','GESTAUCO','CONTABILIDAD','0','0',0010,'auxiliares_contables','consultar'),('CONSBANC','GESTBANC','CONTABILIDAD','0','0',0010,'bancos','consultar'),('CONSBARR','GESTBARR','ADMINISTRACION','0','0',0010,'barrios','consultar'),('CONSBITA','GESTBITA','ADMINISTRACION','0','0',0010,'bitacora','consultar'),('CONSBODE','GESTBODE','ADMINISTRACION','0','0',0010,'bodegas','consultar'),('CONSCARG','GESTCARG','ADMINISTRACION','0','0',0010,'cargos','consultar'),('CONSCLIE','GESTCLIE','CLIENTES','0','0',0010,'clientes','consultar'),('CONSCLMA','GESTCLMA','CLIENTES','0','0',0010,'clientes_mayoristas','consultar'),('CONSCMMY','GESTCMMY','CLIENTES','0','0',0010,'comisiones_mayoristas','consultar'),('CONSCODI','GESTCODI','CONTABILIDAD','0','0',0010,'conceptos_DIAN','consultar'),('CONSCOFE','GESTCOFE','CONTABILIDAD','0','0',0010,'conceptos_flujo_efectivo','consultar'),('CONSCOMA','GESTCOMA','CLIENTES','0','0',0010,'contactos_mayoristas','consultar'),('CONSCORR','GESTCORR','ADMINISTRACION','0','0',0010,'corregimientos','consultar'),('CONSCOTI','GESTCOCL','CLIENTES','0','0',0010,'cotizaciones','consultar'),('CONSDEPA','GESTDEPA','ADMINISTRACION','0','0',0010,'departamentos','consultar'),('CONSEMPR','GESTEMPR','ADMINISTRACION','0','0',0010,'empresas','consultar'),('CONSFODI','GESTFODI','CONTABILIDAD','0','0',0010,'formatos_DIAN','consultar'),('CONSICAE','GESTICAE','CONTABILIDAD','0','0',0010,'tasas_ica_por_actividad_economica','consultar'),('CONSIMPR','GESTIMPR','ADMINISTRACION','0','0',0010,'impresoras','consultar'),('CONSINEG','GESTINEG','CLIENTES','0','0',0010,'registro_ingresos','consultar'),('CONSMUNI','GESTMUNI','ADMINISTRACION','0','0',0010,'municipios','consultar'),('CONSNOTA','GESTNOTA','EXTENSIONES','0','0',0010,'notas','consultar'),('CONSPAIS','GESTPAIS','ADMINISTRACION','0','0',0010,'paises','consultar'),('CONSPERF','GESTPERF','ADMINISTRACION','0','0',0010,'perfiles','consultar'),('CONSPLCO','GESTPLCO','CONTABILIDAD','0','0',0010,'plan_contable','consultar'),('CONSPREF','GESTPREF','ADMINISTRACION','0','0',0010,'preferencias','consultar'),('CONSPRIV','GESTPRIV','ADMINISTRACION','0','0',0010,'privilegios','consultar'),('CONSPROF','GESTPROF','ADMINISTRACION','0','0',0010,'profesiones_oficios','consultar'),('CONSREAR','GESTREAR','CONTABILIDAD','0','0',0010,'resoluciones_auto_retencion','consultar'),('CONSRECL','GESTRECL','CLIENTES','0','0',0010,'requerimientos_clientes','consultar'),('CONSREDI','GESTREDI','CONTABILIDAD','0','0',0010,'resoluciones_DIAN','consultar'),('CONSREIC','GESTREIC','CONTABILIDAD','0','0',0010,'resoluciones_ica','consultar'),('CONSREOB','GESTREOB','CLIENTES','0','0',0010,'registro_obras','consultar'),('CONSREVI','GESTREVI','CLIENTES','0','0',0010,'reporte_visitas','consultar'),('CONSSECC','GESTSECC','ADMINISTRACION','0','0',0010,'secciones','consultar'),('CONSSEDE','GESTSEDE','CLIENTES','0','0',0010,'sedes_clientes','consultar'),('CONSSRVD','GESTSRVD','ADMINISTRACION','0','0',0010,'servidores','consultar'),('CONSSUCU','GESTSUCU','ADMINISTRACION','0','0',0010,'sucursales','consultar'),('CONSSUMA','GESTSUMA','CLIENTES','0','0',0010,'sucursales_mayoristas','consultar'),('CONSTACA','GESTTACA','CONTABILIDAD','0','0',0010,'tasas_de_cambio','consultar'),('CONSTASA','GESTTASA','CONTABILIDAD','0','0',0010,'tasas','consultar'),('CONSTERM','GESTTERM','ADMINISTRACION','0','0',0010,'terminales','consultar'),('CONSTIBO','GESTTIBO','ADMINISTRACION','0','0',0010,'tipos_bodegas','consultar'),('CONSTICO','GESTTICO','CONTABILIDAD','0','0',0010,'tipos_de_comprobantes','consultar'),('CONSTIDI','GESTTIDI','ADMINISTRACION','0','0',0010,'tipos_documento_identidad','consultar'),('CONSTIDO','GESTTIDO','CONTABILIDAD','0','0',0010,'tipos_de_documentos','consultar'),('CONSTIMO','GESTTIMO','CONTABILIDAD','0','0',0010,'tipos_de_moneda','consultar'),('CONSTRMA','GESTTRMA','CLIENTES','0','0',0010,'transacciones_clientes_mayoristas','consultar'),('CONSUSUA','GESTUSUA','ADMINISTRACION','0','0',0010,'usuarios','consultar'),('CONSVECO','GESTVECO','CLIENTES','0','0',0010,'vendedores_cobradores','consultar'),('CONSVITA','GESTVITA','CONTABILIDAD','0','0',0010,'vigencia_tasas','consultar'),('CONSZOVM','GESTZOVM','CLIENTES','0','0',0010,'zona_ventas_mayoristas','consultar'),('ELIMACTA','GESTACTA','CLIENTES','0','0',0015,'actas','eliminar'),('ELIMAECO','GESTAECO','ADMINISTRACION','0','0',0020,'actividades_economicas','eliminar'),('ELIMAGEN','GESTAGEN','EXTENSIONES','0','0',0020,'agenda','eliminar'),('ELIMANCO','GESTANCO','CONTABILIDAD','0','0',0020,'anexos_contables','eliminar'),('ELIMAUCO','GESTAUCO','CONTABILIDAD','0','0',0020,'auxiliares_contables','eliminar'),('ELIMBANC','GESTBANC','CONTABILIDAD','0','0',0020,'bancos','eliminar'),('ELIMBARR','GESTBARR','ADMINISTRACION','0','0',0020,'barrios','eliminar'),('ELIMBODE','GESTBODE','ADMINISTRACION','0','0',0020,'bodegas','eliminar'),('ELIMCARG','GESTCARG','ADMINISTRACION','0','0',0020,'cargos','eliminar'),('ELIMCLIE','GESTCLIE','CLIENTES','0','0',0020,'clientes','eliminar'),('ELIMCLMA','GESTCLMA','CLIENTES','0','0',0020,'clientes_mayoristas','eliminar'),('ELIMCMMY','GESTCMMY','CLIENTES','0','0',0020,'comisiones_mayoristas','eliminar'),('ELIMCODI','GESTCODI','CONTABILIDAD','0','0',0020,'conceptos_DIAN','eliminar'),('ELIMCOFE','GESTCOFE','CONTABILIDAD','0','0',0020,'conceptos_flujo_efectivo','eliminar'),('ELIMCOMA','GESTCOMA','CLIENTES','0','0',0020,'contactos_mayoristas','eliminar'),('ELIMCORR','GESTCORR','ADMINISTRACION','0','0',0020,'corregimientos','eliminar'),('ELIMCOTI','GESTCOCL','CLIENTES','0','0',0020,'cotizaciones','eliminar'),('ELIMDEPA','GESTDEPA','ADMINISTRACION','0','0',0020,'departamentos','eliminar'),('ELIMEMPR','GESTEMPR','ADMINISTRACION','0','0',0020,'empresas','eliminar'),('ELIMFODI','GESTFODI','CONTABILIDAD','0','0',0020,'formatos_DIAN','eliminar'),('ELIMICAE','GESTICAE','CONTABILIDAD','0','0',0020,'tasas_ica_por_actividad_economica','eliminar'),('ELIMIMPR','GESTIMPR','ADMINISTRACION','0','0',0020,'impresoras','eliminar'),('ELIMINEG','GESTINEG','CLIENTES','0','0',0020,'registro_ingresos','eliminar'),('ELIMMUNI','GESTMUNI','ADMINISTRACION','0','0',0020,'municipios','eliminar'),('ELIMNOTA','GESTNOTA','EXTENSIONES','0','0',0020,'notas','eliminar'),('ELIMPAIS','GESTPAIS','ADMINISTRACION','0','0',0020,'paises','eliminar'),('ELIMPERF','GESTPERF','ADMINISTRACION','0','0',0020,'perfiles','eliminar'),('ELIMPLCO','GESTPLCO','CONTABILIDAD','0','0',0020,'plan_contable','eliminar'),('ELIMPREF','GESTPREF','ADMINISTRACION','0','0',0020,'preferencias','eliminar'),('ELIMPRIV','GESTPRIV','ADMINISTRACION','0','0',0020,'privilegios','eliminar'),('ELIMPROF','GESTPROF','ADMINISTRACION','0','0',0020,'profesiones_oficios','eliminar'),('ELIMREAR','GESTREAR','CONTABILIDAD','0','0',0020,'resoluciones_auto_retencion','eliminar'),('ELIMRECL','GESTRECL','CLIENTES','0','0',0020,'requerimientos_clientes','eliminar'),('ELIMREDI','GESTREDI','CONTABILIDAD','0','0',0020,'resoluciones_DIAN','eliminar'),('ELIMREIC','GESTREIC','CONTABILIDAD','0','0',0020,'resoluciones_ica','eliminar'),('ELIMREOB','GESTREOB','CLIENTES','0','0',0020,'registro_obras','eliminar'),('ELIMREVI','GESTREVI','CLIENTES','0','0',0020,'reporte_visitas','eliminar'),('ELIMSECC','GESTSECC','ADMINISTRACION','0','0',0020,'secciones','eliminar'),('ELIMSEDE','GESTSEDE','CLIENTES','0','0',0020,'sedes_clientes','eliminar'),('ELIMSRVD','GESTSRVD','ADMINISTRACION','0','0',0020,'servidores','eliminar'),('ELIMSUCU','GESTSUCU','ADMINISTRACION','0','0',0020,'sucursales','eliminar'),('ELIMSUMA','GESTSUMA','CLIENTES','0','0',0020,'sucursales_mayoristas','eliminar'),('ELIMTACA','GESTTACA','CONTABILIDAD','0','0',0020,'tasas_de_cambio','eliminar'),('ELIMTASA','GESTTASA','CONTABILIDAD','0','0',0020,'tasas','eliminar'),('ELIMTERM','GESTTERM','ADMINISTRACION','0','0',0020,'terminales','eliminar'),('ELIMTIBO','GESTTIBO','ADMINISTRACION','0','0',0020,'tipos_bodegas','eliminar'),('ELIMTICO','GESTTICO','CONTABILIDAD','0','0',0020,'tipos_de_comprobantes','eliminar'),('ELIMTIDI','GESTTIDI','ADMINISTRACION','0','0',0020,'tipos_documento_identidad','eliminar'),('ELIMTIDO','GESTTIDO','CONTABILIDAD','0','0',0020,'tipos_de_documentos','eliminar'),('ELIMTIMO','GESTTIMO','CONTABILIDAD','0','0',0020,'tipos_de_moneda','eliminar'),('ELIMTRMA','GESTTRMA','CLIENTES','0','0',0020,'transacciones_clientes_mayoristas','eliminar'),('ELIMUSUA','GESTUSUA','ADMINISTRACION','0','0',0020,'usuarios','eliminar'),('ELIMVECO','GESTVECO','CLIENTES','0','0',0020,'vendedores_cobradores','eliminar'),('ELIMVITA','GESTVITA','CONTABILIDAD','0','0',0020,'vigencia_tasas','eliminar'),('ELIMZOVM','GESTZOVM','CLIENTES','0','0',0020,'zona_ventas_mayoristas','eliminar'),('EXPOCOTI','GESTCOCL','CLIENTES','0','0',0005,'cotizaciones','exportar'),('GESTACTA','SUBMCOSE','CLIENTES','0','1',0080,'actas','menu'),('GESTAECO','SUBMDCAD','ADMINISTRACION','0','1',0005,'actividades_economicas','menu'),('GESTAGEN','MENUINSE','EXTENSIONES','0','0',0001,'agenda','menu'),('GESTANCO','SUBMINCO','CONTABILIDAD','0','1',0010,'anexos_contables','menu'),('GESTAUCO','SUBMINCO','CONTABILIDAD','0','1',0015,'auxiliares_contables','menu'),('GESTBANC','SUBMFINA','CONTABILIDAD','0','1',0010,'bancos','menu'),('GESTBARR','SUBMUBIG','ADMINISTRACION','0','1',0500,'barrios','menu'),('GESTBITA','SUBMSEGU','ADMINISTRACION','0','1',0100,'bitacora','menu'),('GESTBODE','SUBMESTC','ADMINISTRACION','0','1',0015,'bodegas','menu'),('GESTCARG','SUBMDCAD','ADMINISTRACION','0','1',0045,'cargos','menu'),('GESTCLIE','SUBMCOSE','CLIENTES','0','1',0005,'clientes','menu'),('GESTCOCL','SUBMCOSE','CLIENTES','0','1',0060,'cotizaciones','menu'),('GESTCODI','SUBMINTR','CONTABILIDAD','0','1',0025,'conceptos_DIAN','menu'),('GESTCOFE','SUBMFINA','CONTABILIDAD','0','1',0015,'conceptos_flujo_efectivo','menu'),('GESTCORR','SUBMUBIG','ADMINISTRACION','0','1',0400,'corregimientos','menu'),('GESTDEPA','SUBMUBIG','ADMINISTRACION','0','1',0200,'departamentos','menu'),('GESTEMPR','SUBMESTC','ADMINISTRACION','0','1',0005,'empresas','menu'),('GESTFODI','SUBMINTR','CONTABILIDAD','0','1',0020,'formatos_DIAN','menu'),('GESTICAE','SUBMTASA','CONTABILIDAD','0','1',0015,'tasas_ica_por_actividad_economica','menu'),('GESTIMPR','SUBMDISP','ADMINISTRACION','0','1',0100,'impresoras','menu'),('GESTINEG','SUBMCOSE','CLIENTES','0','1',0100,'registro_ingresos','menu'),('GESTMUNI','SUBMUBIG','ADMINISTRACION','0','1',0300,'municipios','menu'),('GESTNOTA','MENUINSE','EXTENSIONES','0','1',0100,'notas','menu'),('GESTPAIS','SUBMUBIG','ADMINISTRACION','0','1',0100,'paises','menu'),('GESTPERF','SUBMACCE','ADMINISTRACION','0','1',0050,'perfiles','menu'),('GESTPLCO','SUBMINCO','CONTABILIDAD','0','1',0005,'plan_contable','menu'),('GESTPREF','SUBMACCE','ADMINISTRACION','0','1',0100,'principal',NULL),('GESTPRIV','SUBMACCE','ADMINISTRACION','0','1',0150,'privilegios','menu'),('GESTPROF','SUBMDCAD','ADMINISTRACION','0','1',0010,'profesiones_oficios','menu'),('GESTREAR','SUBMINTR','CONTABILIDAD','0','1',0015,'resoluciones_auto_retencion','menu'),('GESTRECL','SUBMCOSE','CLIENTES','0','1',0040,'requerimientos_clientes','menu'),('GESTREDI','SUBMINTR','CONTABILIDAD','0','1',0005,'resoluciones_DIAN','menu'),('GESTREIC','SUBMINTR','CONTABILIDAD','0','1',0010,'resoluciones_ica','menu'),('GESTREOB','SUBMCOSE','CLIENTES','0','1',0060,'registro_obras','menu'),('GESTREVI','SUBMCOSE','CLIENTES','0','1',0050,'reporte_visitas','menu'),('GESTSECC','SUBMESTC','ADMINISTRACION','0','1',0020,'secciones','menu'),('GESTSEDE','SUBMCOSE','CLIENTES','0','1',0030,'sedes_clientes','menu'),('GESTSRVD','SUBMDISP','ADMINISTRACION','0','1',0003,'servidores','menu'),('GESTSUCU','SUBMESTC','ADMINISTRACION','0','1',0010,'sucursales','menu'),('GESTTACA','SUBMFINA','CONTABILIDAD','0','1',0025,'tasas_de_cambio','menu'),('GESTTASA','SUBMTASA','CONTABILIDAD','0','1',0005,'tasas','menu'),('GESTTERM','SUBMDISP','ADMINISTRACION','0','1',0005,'terminales','menu'),('GESTTIBO','SUBMDCAD','ADMINISTRACION','0','1',0015,'tipos_bodegas','menu'),('GESTTICO','SUBMINCO','CONTABILIDAD','0','1',0020,'tipos_de_comprobantes','menu'),('GESTTIDI','SUBMDCAD','ADMINISTRACION','0','1',0070,'tipos_documento_identidad','menu'),('GESTTIDO','SUBMINCO','CONTABILIDAD','0','1',0025,'tipos_de_documentos','menu'),('GESTTIMO','SUBMFINA','CONTABILIDAD','0','1',0020,'tipos_de_moneda','menu'),('GESTUSUA','SUBMACCE','ADMINISTRACION','0','1',0100,'usuarios','menu'),('GESTVITA','SUBMTASA','CONTABILIDAD','0','1',0010,'vigencia_tasas','menu'),('MENUADMI',NULL,'ADMINISTRACION','0','1',9500,'principal',NULL),('MENUCLIE',NULL,'ADMINISTRACION','0','1',4000,'principal',NULL),('MENUFINS',NULL,'ADMINISTRACION','1','1',9999,'principal','finalizar'),('MENUINSE',NULL,'ADMINISTRACION','1','0',0000,'principal','iniciar'),('MENUPRIN',NULL,'ADMINISTRACION','1','1',0001,'principal','principal'),('MODIACTA','GESTACTA','CLIENTES','0','0',0010,'actas','modificar'),('MODIAECO','GESTAECO','CONTABILIDAD','0','0',0015,'ADMINISTRACION','modificar'),('MODIAGEN','GESTAGEN','EXTENSIONES','0','0',0015,'agenda','modificar'),('MODIANCO','GESTANCO','CONTABILIDAD','0','0',0015,'anexos_contables','modificar'),('MODIAUCO','GESTAUCO','CONTABILIDAD','0','0',0015,'auxiliares_contables','modificar'),('MODIBANC','GESTBANC','CONTABILIDAD','0','0',0015,'bancos','modificar'),('MODIBARR','GESTBARR','ADMINISTRACION','0','0',0015,'barrios','modificar'),('MODIBODE','GESTBODE','ADMINISTRACION','0','0',0015,'bodegas','modificar'),('MODICARG','GESTCARG','ADMINISTRACION','0','0',0015,'cargos','modificar'),('MODICLIE','GESTCLIE','CLIENTES','0','0',0015,'clientes','modificar'),('MODICLMA','GESTCLMA','CLIENTES','0','0',0015,'clientes_mayoristas','modificar'),('MODICMMY','GESTCMMY','CLIENTES','0','0',0015,'comisiones_mayoristas','modificar'),('MODICODI','GESTCODI','CONTABILIDAD','0','0',0015,'conceptos_DIAN','modificar'),('MODICOFE','GESTCOFE','CONTABILIDAD','0','0',0015,'conceptos_flujo_efectivo','modificar'),('MODICOMA','GESTCOMA','CLIENTES','0','0',0015,'contactos_mayoristas','modificar'),('MODICORR','GESTCORR','ADMINISTRACION','0','0',0015,'corregimientos','modificar'),('MODICOTI','GESTCOCL','CLIENTES','0','0',0015,'cotizaciones','modificar'),('MODIDEPA','GESTDEPA','ADMINISTRACION','0','0',0015,'departamentos','modificar'),('MODIEMPR','GESTEMPR','ADMINISTRACION','0','0',0015,'empresas','modificar'),('MODIFODI','GESTFODI','CONTABILIDAD','0','0',0015,'formatos_DIAN','modificar'),('MODIICAE','GESTICAE','CONTABILIDAD','0','0',0015,'tasas_ica_por_actividad_economica','modificar'),('MODIIMPR','GESTIMPR','ADMINISTRACION','0','0',0015,'impresoras','modificar'),('MODIINEG','GESTINEG','CLIENTES','0','0',0015,'registro_ingresos','modificar'),('MODIMUNI','GESTMUNI','ADMINISTRACION','0','0',0015,'municipios','modificar'),('MODINOTA','GESTNOTA','EXTENSIONES','0','0',0015,'notas','modificar'),('MODIPAIS','GESTPAIS','ADMINISTRACION','0','0',0015,'paises','modificar'),('MODIPERF','GESTPERF','ADMINISTRACION','0','0',0015,'perfiles','modificar'),('MODIPLCO','GESTPLCO','CONTABILIDAD','0','0',0015,'plan_contable','modificar'),('MODIPREF','PREFUSUA','ADMINISTRACION','0','0',0015,'preferencias_individuales','modificar'),('MODIPRGB','PREFGLOB','ADMINISTRACION','0','0',0015,'preferencias_globales','modificar'),('MODIPRIV','GESTPRIV','ADMINISTRACION','0','0',0015,'privilegios','modificar'),('MODIPROF','GESTPROF','ADMINISTRACION','0','0',0015,'profesiones_oficios','modificar'),('MODIREAR','GESTREAR','CONTABILIDAD','0','0',0015,'resoluciones_auto_retencion','modificar'),('MODIRECL','GESTRECL','CLIENTES','0','0',0015,'requerimientos_clientes','modificar'),('MODIREDI','GESTREDI','CONTABILIDAD','0','0',0015,'resoluciones_DIAN','modificar'),('MODIREIC','GESTREIC','CONTABILIDAD','0','0',0015,'resoluciones_ica','modificar'),('MODIREOB','GESTREOB','CLIENTES','0','0',0015,'registro_obras','modificar'),('MODIREVI','GESTREVI','CLIENTES','0','0',0015,'reporte_visitas','modificar'),('MODISECC','GESTSECC','ADMINISTRACION','0','0',0015,'secciones','modificar'),('MODISEDE','GESTSEDE','CLIENTES','0','0',0015,'sedes_clientes','modificar'),('MODISRVD','GESTSRVD','ADMINISTRACION','0','0',0015,'servidores','modificar'),('MODISUCU','GESTSUCU','ADMINISTRACION','0','0',0015,'sucursales','modificar'),('MODISUMA','GESTSUMA','CLIENTES','0','0',0015,'sucursales_mayoristas','modificar'),('MODITACA','GESTTACA','CONTABILIDAD','0','0',0015,'tasas_de_cambio','modificar'),('MODITASA','GESTTASA','CONTABILIDAD','0','0',0015,'tasas','modificar'),('MODITERM','GESTTERM','ADMINISTRACION','0','0',0015,'terminales','modificar'),('MODITIBO','GESTTIBO','ADMINISTRACION','0','0',0015,'tipos_bodegas','modificar'),('MODITICO','GESTTICO','CONTABILIDAD','0','0',0015,'tipos_de_comprobantes','modificar'),('MODITIDI','GESTTIDI','ADMINISTRACION','0','0',0015,'tipos_documento_identidad','modificar'),('MODITIDO','GESTTIDO','CONTABILIDAD','0','0',0015,'tipos_de_documentos','modificar'),('MODITIMO','GESTTIMO','CONTABILIDAD','0','0',0015,'tipos_de_moneda','modificar'),('MODITRMA','GESTTRMA','CLIENTES','0','0',0015,'transacciones_clientes_mayoristas','modificar'),('MODIUSUA','GESTUSUA','ADMINISTRACION','0','0',0015,'usuarios','modificar'),('MODIVECO','GESTVECO','CLIENTES','0','0',0015,'vendedores_cobradores','modificar'),('MODIVITA','GESTVITA','CONTABILIDAD','0','0',0015,'vigencia_tasas','modificar'),('MODIZOVM','GESTZOVM','CLIENTES','0','0',0015,'zona_ventas_mayoristas','modificar'),('NOTIRECL','GESTRECL','CLIENTES','0','0',0025,'requerimientos_clientes','notificar'),('PREFGLOB','GESTPREF','ADMINISTRACION','0','1',0200,'preferencias_globales','menu'),('PREFUSUA','GESTPREF','ADMINISTRACION','0','1',0200,'preferencias_individuales','menu'),('RECOCOTI','GESTCOCL','CLIENTES','0','0',0025,'cotizaciones','recotizar'),('REPLCOTI','GESTCOCL','CLIENTES','0','0',0020,'cotizaciones','reemplazar'),('SUBMACCE','MENUADMI','ADMINISTRACION','0','1',2000,'principal',NULL),('SUBMCOSE','MENUCLIE','CLIENTES','0','1',8000,'principal',NULL),('SUBMDCAD','MENUADMI','ADMINISTRACION','0','1',5000,'principal',NULL),('SUBMDCCO','MENUCONT','CONTABILIDAD','0','1',9000,'principal',NULL),('SUBMDISP','MENUADMI','ADMINISTRACION','0','1',3000,'principal',NULL),('SUBMESTC','MENUADMI','ADMINISTRACION','0','1',1000,'principal',NULL),('SUBMFINA','SUBMDCCO','CONTABILIDAD','0','1',0015,'principal',NULL),('SUBMINCO','SUBMDCCO','CONTABILIDAD','0','1',0005,'principal',NULL),('SUBMINTR','SUBMDCCO','CONTABILIDAD','0','1',0010,'principal',NULL),('SUBMSEGU','MENUADMI','ADMINISTRACION','0','1',4000,'principal',NULL),('SUBMTASA','SUBMDCCO','CONTABILIDAD','0','1',0020,'principal',NULL),('SUBMUBIG','SUBMDCAD','ADMINISTRACION','0','1',1000,'principal',NULL),('VIOFREVI','GESTREVI','CLIENTES','0','0',0025,'reporte_visitas','visitar'),('VISUIMAG',NULL,'ADMINISTRACION','1','0',0500,'principal','visualizar');
/*!40000 ALTER TABLE `pance_componentes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pance_componentes_perfil`
--

DROP TABLE IF EXISTS `pance_componentes_perfil`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `pance_componentes_perfil` (
  `id_perfil` smallint(4) unsigned zerofill NOT NULL COMMENT 'Consecutivo interno para la base de datos del perfil',
  `id_componente` varchar(8) NOT NULL COMMENT 'Identificador del componente',
  PRIMARY KEY  (`id_perfil`,`id_componente`),
  KEY `componente_perfil_componente` (`id_componente`),
  CONSTRAINT `componente_perfil_componente` FOREIGN KEY (`id_componente`) REFERENCES `pance_componentes` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `componente_perfil_perfil` FOREIGN KEY (`id_perfil`) REFERENCES `pance_perfiles` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `pance_componentes_perfil`
--

LOCK TABLES `pance_componentes_perfil` WRITE;
/*!40000 ALTER TABLE `pance_componentes_perfil` DISABLE KEYS */;
/*!40000 ALTER TABLE `pance_componentes_perfil` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pance_componentes_usuario`
--

DROP TABLE IF EXISTS `pance_componentes_usuario`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `pance_componentes_usuario` (
  `id` int(8) unsigned zerofill NOT NULL auto_increment COMMENT 'Consecutivo interno de la base de datos',
  `id_perfil` int(8) unsigned zerofill NOT NULL COMMENT 'Identificador de la tabla perfil usuario',
  `id_componente` varchar(8) NOT NULL COMMENT 'Identificador del componente',
  PRIMARY KEY  (`id`,`id_perfil`,`id_componente`),
  KEY `componente_usuario_perfil` (`id_perfil`),
  KEY `componente_usuario_componente` (`id_componente`),
  CONSTRAINT `componente_usuario_componente` FOREIGN KEY (`id_componente`) REFERENCES `pance_componentes` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `componente_usuario_perfil` FOREIGN KEY (`id_perfil`) REFERENCES `pance_perfiles_usuario` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=90000045 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `pance_componentes_usuario`
--

LOCK TABLES `pance_componentes_usuario` WRITE;
/*!40000 ALTER TABLE `pance_componentes_usuario` DISABLE KEYS */;
INSERT INTO `pance_componentes_usuario` VALUES (90000000,90000000,'GESTAGEN'),(90000001,90000000,'ADICAGEN'),(90000002,90000000,'CONSAGEN'),(90000003,90000000,'MODIAGEN'),(90000004,90000000,'ELIMAGEN'),(90000005,90000000,'GESTNOTA'),(90000006,90000000,'ADICNOTA'),(90000007,90000000,'CONSNOTA'),(90000008,90000000,'MODINOTA'),(90000009,90000000,'ELIMNOTA'),(90000010,90000000,'MENUCLIE'),(90000011,90000000,'SUBMCOSE'),(90000012,90000000,'GESTCLIE'),(90000013,90000000,'GESTSEDE'),(90000014,90000000,'ADICSEDE'),(90000015,90000000,'CONSSEDE'),(90000016,90000000,'MODISEDE'),(90000017,90000000,'ELIMSEDE'),(90000018,90000000,'GESTRECL'),(90000019,90000000,'ADICRECL'),(90000020,90000000,'CONSRECL'),(90000021,90000000,'MODIRECL'),(90000022,90000000,'ELIMRECL'),(90000023,90000000,'GESTCOCL'),(90000024,90000000,'ADICCOTI'),(90000025,90000000,'CONSCOTI'),(90000026,90000000,'MODICOTI'),(90000027,90000000,'ELIMCOTI'),(90000033,90000000,'MENUADMI'),(90000034,90000000,'SUBMESTC'),(90000035,90000000,'GESTEMPR'),(90000036,90000000,'ADICEMPR'),(90000037,90000000,'CONSEMPR'),(90000038,90000000,'MODIEMPR'),(90000039,90000000,'ELIMEMPR'),(90000040,90000000,'GESTSUCU'),(90000041,90000000,'ADICSUCU'),(90000042,90000000,'CONSSUCU'),(90000043,90000000,'MODISUCU'),(90000044,90000000,'ELIMSUCU');
/*!40000 ALTER TABLE `pance_componentes_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pance_conexiones`
--

DROP TABLE IF EXISTS `pance_conexiones`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `pance_conexiones` (
  `id` int(8) unsigned zerofill NOT NULL auto_increment COMMENT 'Consecutivo interno para la base de datos',
  `fecha` datetime NOT NULL COMMENT 'Fecha y hora de la conexiÃ³n',
  `id_usuario` smallint(4) unsigned zerofill NOT NULL COMMENT 'Consecutivo interno para la base de datos del usuario que realiza la conexiÃ³n',
  `ip` varchar(15) NOT NULL COMMENT 'DirecciÃ³n IP desde la cual se realiza la conexiÃ³n',
  `proxy` varchar(15) default NULL COMMENT 'DirecciÃ³n IP del proxy, si lo hay, desde el cual se realiza la conexiÃ³n',
  `navegador` varchar(255) default NULL COMMENT 'IdentificaciÃ³n del navegador',
  `sistema` varchar(255) default NULL COMMENT 'Sistema operativo del cliente',
  PRIMARY KEY  (`id`),
  KEY `conexion_usuario` (`id_usuario`),
  CONSTRAINT `conexion_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `pance_usuarios` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=141 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `pance_conexiones`
--

LOCK TABLES `pance_conexiones` WRITE;
/*!40000 ALTER TABLE `pance_conexiones` DISABLE KEYS */;
INSERT INTO `pance_conexiones` VALUES (00000001,'2009-07-13 13:12:37',0001,'127.0.0.1',NULL,NULL,NULL),(00000002,'2009-07-13 13:15:35',0001,'127.0.0.1',NULL,NULL,NULL),(00000003,'2009-07-13 13:29:10',0001,'127.0.0.1',NULL,NULL,NULL),(00000004,'2009-07-13 13:31:16',0001,'127.0.0.1',NULL,NULL,NULL),(00000005,'2009-07-13 14:17:14',0001,'127.0.0.1',NULL,NULL,NULL),(00000006,'2009-07-13 22:16:05',0001,'127.0.0.1',NULL,NULL,NULL),(00000007,'2009-07-14 07:15:21',0001,'127.0.0.1',NULL,NULL,NULL),(00000008,'2009-07-14 14:58:47',0001,'192.168.0.107',NULL,NULL,NULL),(00000009,'2009-07-14 15:00:18',0001,'192.168.0.253',NULL,NULL,NULL),(00000010,'2009-07-14 15:02:02',0001,'192.168.0.113',NULL,NULL,NULL),(00000011,'2009-07-14 15:02:11',0001,'192.168.0.253',NULL,NULL,NULL),(00000012,'2009-07-14 15:02:29',0001,'192.168.0.107',NULL,NULL,NULL),(00000013,'2009-07-14 15:03:07',0001,'192.168.0.113',NULL,NULL,NULL),(00000014,'2009-07-14 15:03:19',0001,'192.168.0.113',NULL,NULL,NULL),(00000015,'2009-07-14 15:05:01',0001,'192.168.0.253',NULL,NULL,NULL),(00000016,'2009-07-14 15:18:05',0001,'192.168.0.253',NULL,NULL,NULL),(00000017,'2009-07-14 15:53:09',0001,'192.168.0.253',NULL,NULL,NULL),(00000018,'2009-07-22 11:26:43',0001,'192.168.0.104',NULL,NULL,NULL),(00000019,'2009-07-22 16:09:30',0001,'192.168.0.109',NULL,NULL,NULL),(00000020,'2009-07-22 16:39:15',0001,'192.168.0.103',NULL,NULL,NULL),(00000021,'2009-07-22 16:43:04',0001,'192.168.0.103',NULL,NULL,NULL),(00000022,'2009-07-22 16:43:04',0001,'192.168.0.103',NULL,NULL,NULL),(00000023,'2009-07-22 16:51:57',0001,'192.168.0.103',NULL,NULL,NULL),(00000024,'2009-07-22 17:12:09',0001,'192.168.0.103',NULL,NULL,NULL),(00000025,'2009-07-22 17:30:43',0001,'192.168.0.103',NULL,NULL,NULL),(00000026,'2009-07-22 18:35:47',0001,'192.168.0.103',NULL,NULL,NULL),(00000027,'2009-07-30 14:42:15',0001,'192.168.0.107',NULL,NULL,NULL),(00000028,'2009-07-30 14:43:56',0001,'192.168.0.107',NULL,NULL,NULL),(00000029,'2009-07-30 15:57:27',0001,'192.168.0.107',NULL,NULL,NULL),(00000030,'2009-07-30 16:15:44',0001,'192.168.0.107',NULL,NULL,NULL),(00000031,'2009-07-30 17:08:24',0001,'192.168.0.107',NULL,NULL,NULL),(00000032,'2009-08-03 14:44:22',0001,'192.168.0.102',NULL,NULL,NULL),(00000033,'2009-08-03 14:44:31',0001,'192.168.0.102',NULL,NULL,NULL),(00000034,'2009-08-03 14:44:52',0001,'192.168.0.102',NULL,NULL,NULL),(00000035,'2009-08-03 14:44:57',0001,'192.168.0.102',NULL,NULL,NULL),(00000036,'2009-08-03 14:45:01',0001,'192.168.0.102',NULL,NULL,NULL),(00000037,'2009-08-03 14:45:05',0001,'192.168.0.102',NULL,NULL,NULL),(00000038,'2009-08-03 14:45:07',0001,'192.168.0.102',NULL,NULL,NULL),(00000039,'2009-08-03 14:45:10',0001,'192.168.0.102',NULL,NULL,NULL),(00000040,'2009-08-03 14:46:32',0001,'192.168.0.102',NULL,NULL,NULL),(00000041,'2009-08-03 14:50:43',0001,'192.168.0.102',NULL,NULL,NULL),(00000042,'2009-08-03 14:53:27',0001,'192.168.0.102',NULL,NULL,NULL),(00000043,'2009-08-03 14:57:09',0001,'192.168.0.102',NULL,NULL,NULL),(00000044,'2009-08-03 15:21:00',0001,'192.168.0.102',NULL,NULL,NULL),(00000045,'2009-08-03 15:30:04',0001,'192.168.0.102',NULL,NULL,NULL),(00000046,'2009-08-03 15:36:04',0001,'192.168.0.102',NULL,NULL,NULL),(00000047,'2009-08-03 16:07:45',0001,'192.168.0.102',NULL,NULL,NULL),(00000048,'2009-08-04 11:04:52',0001,'127.0.0.1',NULL,NULL,NULL),(00000049,'2009-08-04 15:34:33',0001,'127.0.0.1',NULL,NULL,NULL),(00000050,'2009-08-04 20:44:11',0001,'127.0.0.1',NULL,NULL,NULL),(00000051,'2009-08-04 20:44:22',0001,'127.0.0.1',NULL,NULL,NULL),(00000052,'2009-08-04 20:44:38',0001,'127.0.0.1',NULL,NULL,NULL),(00000053,'2009-08-04 20:44:50',0001,'127.0.0.1',NULL,NULL,NULL),(00000054,'2009-08-04 20:44:51',0001,'127.0.0.1',NULL,NULL,NULL),(00000055,'2009-08-04 20:44:51',0001,'127.0.0.1',NULL,NULL,NULL),(00000056,'2009-08-04 20:44:51',0001,'127.0.0.1',NULL,NULL,NULL),(00000057,'2009-08-04 20:44:51',0001,'127.0.0.1',NULL,NULL,NULL),(00000058,'2009-08-04 20:44:52',0001,'127.0.0.1',NULL,NULL,NULL),(00000059,'2009-08-04 20:44:52',0001,'127.0.0.1',NULL,NULL,NULL),(00000060,'2009-08-04 20:45:03',0001,'127.0.0.1',NULL,NULL,NULL),(00000061,'2009-08-04 20:45:04',0001,'127.0.0.1',NULL,NULL,NULL),(00000062,'2009-08-04 20:45:44',0001,'127.0.0.1',NULL,NULL,NULL),(00000063,'2009-08-04 20:45:46',0001,'127.0.0.1',NULL,NULL,NULL),(00000064,'2009-08-04 20:45:47',0001,'127.0.0.1',NULL,NULL,NULL),(00000065,'2009-08-04 20:45:47',0001,'127.0.0.1',NULL,NULL,NULL),(00000066,'2009-08-04 20:45:47',0001,'127.0.0.1',NULL,NULL,NULL),(00000067,'2009-08-04 20:45:48',0001,'127.0.0.1',NULL,NULL,NULL),(00000068,'2009-08-04 20:45:48',0001,'127.0.0.1',NULL,NULL,NULL),(00000069,'2009-08-04 20:45:48',0001,'127.0.0.1',NULL,NULL,NULL),(00000070,'2009-08-04 20:45:50',0001,'127.0.0.1',NULL,NULL,NULL),(00000071,'2009-08-04 20:45:51',0001,'127.0.0.1',NULL,NULL,NULL),(00000072,'2009-08-04 20:46:25',0001,'127.0.0.1',NULL,NULL,NULL),(00000073,'2009-08-04 20:46:29',0001,'127.0.0.1',NULL,NULL,NULL),(00000074,'2009-08-04 20:46:44',0001,'127.0.0.1',NULL,NULL,NULL),(00000075,'2009-08-04 20:47:04',0001,'127.0.0.1',NULL,NULL,NULL),(00000076,'2009-08-04 20:47:24',0001,'127.0.0.1',NULL,NULL,NULL),(00000077,'2009-08-04 20:47:27',0001,'127.0.0.1',NULL,NULL,NULL),(00000078,'2009-08-04 20:47:30',0001,'127.0.0.1',NULL,NULL,NULL),(00000079,'2009-08-04 20:48:22',0001,'127.0.0.1',NULL,NULL,NULL),(00000080,'2009-08-04 20:49:37',0001,'127.0.0.1',NULL,NULL,NULL),(00000081,'2009-08-04 20:50:17',0001,'127.0.0.1',NULL,NULL,NULL),(00000082,'2009-08-04 20:50:23',0001,'127.0.0.1',NULL,NULL,NULL),(00000083,'2009-08-04 20:50:55',0001,'127.0.0.1',NULL,NULL,NULL),(00000084,'2009-08-04 20:52:57',0001,'127.0.0.1',NULL,NULL,NULL),(00000085,'2009-08-04 21:02:30',0001,'127.0.0.1',NULL,NULL,NULL),(00000086,'2009-08-04 21:04:38',0001,'127.0.0.1',NULL,NULL,NULL),(00000087,'2009-08-04 21:09:59',0001,'127.0.0.1',NULL,NULL,NULL),(00000088,'2009-08-04 21:12:09',0001,'127.0.0.1',NULL,NULL,NULL),(00000089,'2009-08-04 21:12:13',0001,'127.0.0.1',NULL,NULL,NULL),(00000090,'2009-08-04 21:12:14',0001,'127.0.0.1',NULL,NULL,NULL),(00000091,'2009-08-04 21:12:14',0001,'127.0.0.1',NULL,NULL,NULL),(00000092,'2009-08-04 21:12:15',0001,'127.0.0.1',NULL,NULL,NULL),(00000093,'2009-08-04 21:12:15',0001,'127.0.0.1',NULL,NULL,NULL),(00000094,'2009-08-04 21:12:16',0001,'127.0.0.1',NULL,NULL,NULL),(00000095,'2009-08-04 21:12:16',0001,'127.0.0.1',NULL,NULL,NULL),(00000096,'2009-08-04 21:12:18',0001,'127.0.0.1',NULL,NULL,NULL),(00000097,'2009-08-04 21:12:18',0001,'127.0.0.1',NULL,NULL,NULL),(00000098,'2009-08-04 21:12:19',0001,'127.0.0.1',NULL,NULL,NULL),(00000099,'2009-08-04 21:12:19',0001,'127.0.0.1',NULL,NULL,NULL),(00000100,'2009-08-04 21:13:59',0001,'127.0.0.1',NULL,NULL,NULL),(00000101,'2009-08-04 21:14:01',0001,'127.0.0.1',NULL,NULL,NULL),(00000102,'2009-08-04 21:14:01',0001,'127.0.0.1',NULL,NULL,NULL),(00000103,'2009-08-04 21:14:02',0001,'127.0.0.1',NULL,NULL,NULL),(00000104,'2009-08-04 21:14:02',0001,'127.0.0.1',NULL,NULL,NULL),(00000105,'2009-08-04 21:14:02',0001,'127.0.0.1',NULL,NULL,NULL),(00000106,'2009-08-04 21:14:02',0001,'127.0.0.1',NULL,NULL,NULL),(00000107,'2009-08-04 21:14:03',0001,'127.0.0.1',NULL,NULL,NULL),(00000108,'2009-08-04 21:14:04',0001,'127.0.0.1',NULL,NULL,NULL),(00000109,'2009-08-04 21:14:15',0001,'127.0.0.1',NULL,NULL,NULL),(00000110,'2009-08-04 21:15:37',0001,'127.0.0.1',NULL,NULL,NULL),(00000111,'2009-08-04 21:16:06',0001,'127.0.0.1',NULL,NULL,NULL),(00000112,'2009-08-04 21:16:10',0001,'127.0.0.1',NULL,NULL,NULL),(00000113,'2009-08-04 21:16:10',0001,'127.0.0.1',NULL,NULL,NULL),(00000114,'2009-08-04 21:16:10',0001,'127.0.0.1',NULL,NULL,NULL),(00000115,'2009-08-04 21:16:11',0001,'127.0.0.1',NULL,NULL,NULL),(00000116,'2009-08-04 21:18:18',0001,'127.0.0.1',NULL,NULL,NULL),(00000117,'2009-08-04 21:20:29',0001,'127.0.0.1',NULL,NULL,NULL),(00000118,'2009-08-04 21:22:08',0001,'127.0.0.1',NULL,NULL,NULL),(00000119,'2009-08-04 21:24:28',0001,'127.0.0.1',NULL,NULL,NULL),(00000120,'2009-08-04 21:26:23',0001,'127.0.0.1',NULL,NULL,NULL),(00000121,'2009-08-04 21:28:50',0001,'127.0.0.1',NULL,NULL,NULL),(00000122,'2009-08-04 21:29:24',0001,'127.0.0.1',NULL,NULL,NULL),(00000123,'2009-08-04 21:30:14',0001,'127.0.0.1',NULL,NULL,NULL),(00000124,'2009-08-04 21:30:30',0001,'127.0.0.1',NULL,NULL,NULL),(00000125,'2009-08-04 21:30:48',0001,'127.0.0.1',NULL,NULL,NULL),(00000126,'2009-08-04 21:31:06',0001,'127.0.0.1',NULL,NULL,NULL),(00000127,'2009-08-04 21:31:27',0001,'127.0.0.1',NULL,NULL,NULL),(00000128,'2009-08-04 21:33:12',0001,'127.0.0.1',NULL,NULL,NULL),(00000129,'2009-08-04 21:33:43',0001,'127.0.0.1',NULL,NULL,NULL),(00000130,'2009-08-04 21:34:03',0001,'127.0.0.1',NULL,NULL,NULL),(00000131,'2009-08-04 21:34:26',0001,'127.0.0.1',NULL,NULL,NULL),(00000132,'2009-08-04 21:34:55',0001,'127.0.0.1',NULL,NULL,NULL),(00000133,'2009-08-04 21:35:23',0001,'127.0.0.1',NULL,NULL,NULL),(00000134,'2009-08-04 21:35:42',0001,'127.0.0.1',NULL,NULL,NULL),(00000135,'2009-08-04 21:40:14',0001,'127.0.0.1',NULL,NULL,NULL),(00000136,'2009-08-04 21:40:40',0001,'127.0.0.1',NULL,NULL,NULL),(00000137,'2009-08-04 21:43:02',0001,'127.0.0.1',NULL,NULL,NULL),(00000138,'2009-08-04 21:46:13',0001,'127.0.0.1',NULL,NULL,NULL),(00000139,'2009-08-06 13:37:52',0001,'127.0.0.1',NULL,NULL,NULL),(00000140,'2009-08-06 13:57:45',0001,'127.0.0.1',NULL,NULL,NULL);
/*!40000 ALTER TABLE `pance_conexiones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `pance_consulta_bitacora`
--

DROP TABLE IF EXISTS `pance_consulta_bitacora`;
/*!50001 DROP VIEW IF EXISTS `pance_consulta_bitacora`*/;
/*!50001 CREATE TABLE `pance_consulta_bitacora` (
  `id` int(8) unsigned zerofill,
  `FECHA` varchar(10),
  `HORA` varchar(11),
  `COMPONENTE` text,
  `CONSULTA` text,
  `MENSAJE` text
) */;

--
-- Table structure for table `pance_cotizaciones`
--

DROP TABLE IF EXISTS `pance_cotizaciones`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `pance_cotizaciones` (
  `id` int(6) unsigned zerofill NOT NULL auto_increment COMMENT 'CÃ³digo interno en la base de datos',
  `id_requerimiento` int(8) unsigned zerofill NOT NULL COMMENT 'CÃ³digo interno que relaciona la cotizacion con el requerimiento',
  `fecha_registro_aprobacion_clientes` date default NULL COMMENT 'Fecha aprobacion requerimiento por parte del cliente',
  `fecha_registro_aprobacion_sistema` datetime default NULL COMMENT 'Fecha y hora aprobacion requerimiento por parte del cliente',
  `observaciones_aprobacion_cliente` varchar(60) default NULL COMMENT 'Observaciones despues de aprobado por el cliente',
  `estado_cotizacion` enum('0','1') default '0' COMMENT 'Estado de la cotizacion aprobada: 0=No, 1=Si',
  `estado` enum('1','2','3','4','5') default '1' COMMENT 'Estado de la cotizacion: 1=Pendiente, 2=Aprobada, 3=Anulada, 4=Recotizar, 5=Remplazada',
  `valor_mano_obra_cotizacion` decimal(12,2) default NULL COMMENT 'Valor mano de obra cotizado',
  `valor_materiales_cotizacion` decimal(12,2) default NULL COMMENT 'Valor de los materiales cotizados',
  `costo_directo` decimal(12,2) default NULL COMMENT 'Valor del costo directo del requerimiento',
  `porcentaje_administracion_cotizacion` decimal(4,2) default NULL COMMENT 'Porcentaje cobro por administracion cotizado',
  `costo_administracion_cotizacion` decimal(12,2) default NULL COMMENT 'Valor por administracion cotizado',
  `porcentaje_imprevistos_cotizacion` decimal(4,2) default NULL COMMENT 'Porcentaje de los imprevistos cotizados',
  `costo_imprevistos_cotizacion` decimal(12,2) default NULL COMMENT 'Valor de los imprevistos cotizados',
  `porcentaje_utilidad` decimal(4,2) default NULL COMMENT 'Porcentaje de la utilidad',
  `costo_utilidad` decimal(12,2) default NULL COMMENT 'Valor de la utilidad cotizado',
  `impuesto` decimal(4,2) default NULL COMMENT 'Porcentaje del impuesto sobre la utilidad',
  `costo_impuesto` decimal(12,2) default NULL COMMENT 'Valor del impuesto sobre la utilidad',
  `forma_pago` enum('0','1') default '1' COMMENT 'Forma de pago del requerimiento: 0=Pago parcial, 1=Contra-entrega',
  `porcentaje_anticipo` decimal(4,2) default NULL COMMENT 'Porcentaje sobre el valor total que debe tener el anticipo',
  `numero_cotizacion` int(8) unsigned zerofill NOT NULL COMMENT 'Numero de la cotizacion',
  `consecutivo_cotizacion` smallint(2) unsigned zerofill NOT NULL default '00' COMMENT 'Consecutivo numero cotizacion',
  `numero_cotizacion_consorciado` varchar(15) default NULL COMMENT 'Numero de la cotizacion del consorciado',
  `fecha_registro_cotizacion_consorciado` datetime default NULL COMMENT 'Fecha registro cotizacion por parte del consorciado',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `numero_cotizacion` (`numero_cotizacion`,`consecutivo_cotizacion`),
  KEY `cotizacion_requerimiento` (`id_requerimiento`),
  CONSTRAINT `cotizacion_requerimiento` FOREIGN KEY (`id_requerimiento`) REFERENCES `pance_requerimientos_clientes` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `pance_cotizaciones`
--

LOCK TABLES `pance_cotizaciones` WRITE;
/*!40000 ALTER TABLE `pance_cotizaciones` DISABLE KEYS */;
/*!40000 ALTER TABLE `pance_cotizaciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pance_departamentos`
--

DROP TABLE IF EXISTS `pance_departamentos`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `pance_departamentos` (
  `id` int(5) unsigned zerofill NOT NULL auto_increment COMMENT 'Consecutivo interno para la base de datos',
  `id_pais` smallint(3) unsigned zerofill NOT NULL COMMENT 'Consecutivo interno para la base de datos del paÃ­s al cual pertenece',
  `codigo_dane` varchar(2) default NULL COMMENT 'CÃ³digo DANE',
  `codigo_interno` smallint(3) unsigned zerofill default NULL COMMENT 'CÃ³digo para uso interno de la empresa (opcional)',
  `nombre` varchar(255) NOT NULL default '' COMMENT 'Nombre completo',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `codigo_dane` (`codigo_dane`),
  UNIQUE KEY `codigo_interno` (`codigo_interno`),
  KEY `departamento_pais` (`id_pais`),
  CONSTRAINT `departamento_pais` FOREIGN KEY (`id_pais`) REFERENCES `pance_paises` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `pance_departamentos`
--

LOCK TABLES `pance_departamentos` WRITE;
/*!40000 ALTER TABLE `pance_departamentos` DISABLE KEYS */;
INSERT INTO `pance_departamentos` VALUES (00001,046,'05',NULL,'Antioquia'),(00002,046,'08',NULL,'Atlántico'),(00003,046,'11',NULL,'Bogotá'),(00004,046,'13',NULL,'Bolivar'),(00005,046,'15',NULL,'Boyacá'),(00006,046,'17',NULL,'Caldas'),(00007,046,'18',NULL,'Caquetá'),(00008,046,'19',NULL,'Cauca'),(00009,046,'20',NULL,'Cesar'),(00010,046,'23',NULL,'Córdoba'),(00011,046,'25',NULL,'Cundinamarca'),(00012,046,'27',NULL,'Chocó'),(00013,046,'41',NULL,'Huila'),(00014,046,'44',NULL,'La Guajira'),(00015,046,'47',NULL,'Magdalena'),(00016,046,'50',NULL,'Meta'),(00017,046,'52',NULL,'Nariño'),(00018,046,'54',NULL,'Norte de Santander'),(00019,046,'63',NULL,'Quindío'),(00020,046,'66',NULL,'Risaralda'),(00021,046,'68',NULL,'Santander'),(00022,046,'70',NULL,'Sucre'),(00023,046,'73',NULL,'Tolima'),(00024,046,'76',NULL,'Valle del Cauca'),(00025,046,'81',NULL,'Arauca'),(00026,046,'85',NULL,'Casanare'),(00027,046,'86',NULL,'Putumayo'),(00028,046,'88',NULL,'San Andrés'),(00029,046,'91',NULL,'Amazonas'),(00030,046,'94',NULL,'Guainía'),(00031,046,'95',NULL,'Guaviare'),(00032,046,'97',NULL,'Vaupes'),(00033,046,'99',NULL,'Vichada');
/*!40000 ALTER TABLE `pance_departamentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pance_empresas`
--

DROP TABLE IF EXISTS `pance_empresas`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `pance_empresas` (
  `id` smallint(3) unsigned zerofill NOT NULL auto_increment COMMENT 'Consecutivo interno de la base de datos',
  `codigo` smallint(3) unsigned zerofill NOT NULL COMMENT 'CÃ³digo interno de la empresa',
  `razon_social` varchar(60) NOT NULL COMMENT 'Razon social que identifica la empresa',
  `nombre_corto` char(10) NOT NULL COMMENT 'Nombre corto que identifica la empresa en consultas',
  `fecha_cierre` date default NULL COMMENT 'Fecha que estuvo activa la empresa',
  `activo` enum('0','1') NOT NULL default '1' COMMENT 'Indicador de estado de la empresa: 0=Inactiva, 1=Activa',
  `id_tercero` int(8) unsigned zerofill NOT NULL COMMENT 'Codigo interno asignado ala empresa en la tabla terceros',
  `regimen` enum('1','2') default '1' COMMENT '1->Regimen comun 2->Regimen simplificado',
  `retiene_fuente` enum('0','1') default '0' COMMENT 'Realiza retencion en la fuente 0->No 1->Si',
  `autoretenedor` enum('0','1') NOT NULL default '0' COMMENT 'Autoretenedor 0->No 1->Si',
  `retiene_iva` enum('0','1') NOT NULL default '0' COMMENT 'Retiene IVA 0->No 1->Si',
  `retiene_ica` enum('0','1') NOT NULL default '0' COMMENT 'Retiene ICA 0->No 1->Si',
  `gran_contribuyente` enum('0','1') NOT NULL COMMENT 'Empresa esta catalogada como gran contribuyente por la DIAN 0->No 1-Si',
  `id_actividad_principal` smallint(4) unsigned zerofill NOT NULL COMMENT 'Actividad econÃ³mica principal a la cual se dedica la Empresa',
  `id_actividad_secundaria` smallint(4) unsigned zerofill NOT NULL COMMENT 'Actividad econÃ³mica secundaria a la cual se dedica la Empresa',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `codigo` (`codigo`),
  KEY `empresas_tercero` (`id_tercero`),
  KEY `empresas_actividad_principal` (`id_actividad_principal`),
  KEY `empresas_actividad_secundaria` (`id_actividad_secundaria`),
  CONSTRAINT `empresas_actividad_principal` FOREIGN KEY (`id_actividad_principal`) REFERENCES `pance_actividades_economicas` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `empresas_actividad_secundaria` FOREIGN KEY (`id_actividad_secundaria`) REFERENCES `pance_actividades_economicas` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `empresas_tercero` FOREIGN KEY (`id_tercero`) REFERENCES `pance_terceros` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=904 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `pance_empresas`
--

LOCK TABLES `pance_empresas` WRITE;
/*!40000 ALTER TABLE `pance_empresas` DISABLE KEYS */;
INSERT INTO `pance_empresas` VALUES (900,001,'INGENIERIA DE DISE;O Y CONSTRUCCIONES ELECTRICAS INCOEL LTDA','INCOEL',NULL,'1',90000000,'1','1','0','1','1','0',9000,9000),(901,002,'EMPRESA ANDINA DE INGENIERIA S.A.','ANDINA',NULL,'1',90000001,'1','1','0','1','1','0',9000,9000),(902,003,'INGENIEROS ELECTRICOS DE CORDOBA LTDA','INGELCOR',NULL,'1',90000002,'1','1','0','0','1','0',9000,9000),(903,004,'ENERGIA ELECTRICA Y CONSTRUCCIONES LTDA','ENERCON',NULL,'1',90000003,'1','1','0','0','1','0',9000,9001);
/*!40000 ALTER TABLE `pance_empresas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pance_imagenes`
--

DROP TABLE IF EXISTS `pance_imagenes`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `pance_imagenes` (
  `id` int(10) unsigned zerofill NOT NULL auto_increment COMMENT 'Consecutivo interno para la base de datos',
  `categoria` enum('1','2') NOT NULL COMMENT 'Clase de imagen: 1=Usuarios, 2=ArtÃ­culos',
  `id_asociado` int(12) unsigned zerofill NOT NULL COMMENT 'Consecutivo interno del Ã­tem en la tabla asociada segÃºn la categorÃ­a',
  `contenido` mediumblob NOT NULL COMMENT 'Lista de valores (datos) de las columnas',
  `tipo` varchar(255) NOT NULL COMMENT 'TIpo de archivo (MIME)',
  `extension` enum('png','jpg','gif') NOT NULL COMMENT 'ExtensiÃ³n que determina el tipo de imagen',
  `ancho` smallint(4) NOT NULL COMMENT 'Ancho de la imagen en pixeles',
  `alto` smallint(4) NOT NULL COMMENT 'Alto de la imagen en pixeles',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `pance_imagenes`
--

LOCK TABLES `pance_imagenes` WRITE;
/*!40000 ALTER TABLE `pance_imagenes` DISABLE KEYS */;
/*!40000 ALTER TABLE `pance_imagenes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pance_impresoras`
--

DROP TABLE IF EXISTS `pance_impresoras`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `pance_impresoras` (
  `id` smallint(3) unsigned zerofill NOT NULL auto_increment COMMENT 'Consecutivo interno de la base de datos',
  `nombre_cola` varchar(50) NOT NULL COMMENT 'Nombre de la cola de impresiÃ³n',
  `descripcion` varchar(50) NOT NULL COMMENT 'DescripciÃ³n de la impresora',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `pance_impresoras`
--

LOCK TABLES `pance_impresoras` WRITE;
/*!40000 ALTER TABLE `pance_impresoras` DISABLE KEYS */;
/*!40000 ALTER TABLE `pance_impresoras` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pance_localidades`
--

DROP TABLE IF EXISTS `pance_localidades`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `pance_localidades` (
  `id` int(8) unsigned zerofill NOT NULL auto_increment COMMENT 'Consecutivo interno para la base de datos',
  `id_municipio` int(8) unsigned zerofill NOT NULL COMMENT 'Consecutivo interno para la base de datos para del municipio al cual pertenece',
  `tipo` enum('B','C') default 'B' COMMENT 'Tipo de localidad: B=Barrio, C=Corregimiento',
  `codigo_municipal` smallint(3) unsigned zerofill default NULL COMMENT 'CÃ³digo oficial asignado por el municipio (sÃ³lo para barrios)',
  `codigo_dane` varchar(3) default NULL COMMENT 'CÃ³digo DANE (sÃ³lo para corregimientos)',
  `codigo_interno` int(8) unsigned zerofill default NULL COMMENT 'CÃ³digo para uso interno de la empresa (opcional)',
  `nombre` varchar(255) NOT NULL default '' COMMENT 'Nombre completo',
  `comuna` tinyint(2) NOT NULL default '0' COMMENT 'Comuna a la que pertenece (sÃ³lo para barrios)',
  `estrato` tinyint(1) NOT NULL default '0' COMMENT 'Estrato al que pertenece (sÃ³lo para barrios)',
  PRIMARY KEY  (`id`),
  KEY `localidad_municipio` (`id_municipio`),
  CONSTRAINT `localidad_municipio` FOREIGN KEY (`id_municipio`) REFERENCES `pance_municipios` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=90001117 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `pance_localidades`
--

LOCK TABLES `pance_localidades` WRITE;
/*!40000 ALTER TABLE `pance_localidades` DISABLE KEYS */;
INSERT INTO `pance_localidades` VALUES (90000000,00001002,'C',NULL,'01',00000001,'CALI',0,0),(90000001,00000513,'B',NULL,NULL,NULL,'Mosquera',0,0),(90000002,00000427,'B',NULL,NULL,NULL,'Montería',0,0),(90000003,00000001,'B',000,'',00000000,'Medellín',0,0),(90000004,00000002,'B',000,'',00000000,'Abejorral',0,0),(90000005,00000003,'B',000,'',00000000,'Abriaqui',0,0),(90000006,00000004,'B',000,'',00000000,'Alejandría',0,0),(90000007,00000005,'B',000,'',00000000,'Amaga',0,0),(90000008,00000006,'B',000,'',00000000,'Amalfi',0,0),(90000009,00000007,'B',000,'',00000000,'Andes',0,0),(90000010,00000008,'B',000,'',00000000,'Angelopolis',0,0),(90000011,00000009,'B',000,'',00000000,'Angostura',0,0),(90000012,00000010,'B',000,'',00000000,'Anorí',0,0),(90000013,00000011,'B',000,'',00000000,'Antioquia',0,0),(90000014,00000012,'B',000,'',00000000,'Anza',0,0),(90000015,00000013,'B',000,'',00000000,'Apartado',0,0),(90000016,00000014,'B',000,'',00000000,'Arboletes',0,0),(90000017,00000015,'B',000,'',00000000,'Argelia',0,0),(90000018,00000016,'B',000,'',00000000,'Armenia',0,0),(90000019,00000017,'B',000,'',00000000,'Barbosa',0,0),(90000020,00000018,'B',000,'',00000000,'Belmira',0,0),(90000021,00000019,'B',000,'',00000000,'Bello',0,0),(90000022,00000020,'B',000,'',00000000,'Betania',0,0),(90000023,00000021,'B',000,'',00000000,'Betulia',0,0),(90000024,00000022,'B',000,'',00000000,'Bolívar',0,0),(90000025,00000023,'B',000,'',00000000,'Briceño',0,0),(90000026,00000024,'B',000,'',00000000,'Buritica',0,0),(90000027,00000025,'B',000,'',00000000,'Cáceres',0,0),(90000028,00000026,'B',000,'',00000000,'Caicedo',0,0),(90000029,00000027,'B',000,'',00000000,'Caldas',0,0),(90000030,00000028,'B',000,'',00000000,'Campamento',0,0),(90000031,00000029,'B',000,'',00000000,'Cañasgordas',0,0),(90000032,00000030,'B',000,'',00000000,'Caracolí',0,0),(90000033,00000031,'B',000,'',00000000,'Caramanta',0,0),(90000034,00000032,'B',000,'',00000000,'Carepa',0,0),(90000035,00000033,'B',000,'',00000000,'Carmen De Viboral',0,0),(90000036,00000034,'B',000,'',00000000,'Carolina',0,0),(90000037,00000035,'B',000,'',00000000,'Caucasia',0,0),(90000038,00000036,'B',000,'',00000000,'Chigorodó',0,0),(90000039,00000037,'B',000,'',00000000,'Cisneros',0,0),(90000040,00000038,'B',000,'',00000000,'Cocorná',0,0),(90000041,00000039,'B',000,'',00000000,'Concepción',0,0),(90000042,00000040,'B',000,'',00000000,'Concordia',0,0),(90000043,00000041,'B',000,'',00000000,'Copacabana',0,0),(90000044,00000042,'B',000,'',00000000,'Dabeiba',0,0),(90000045,00000043,'B',000,'',00000000,'Don Matías',0,0),(90000046,00000044,'B',000,'',00000000,'Ebejico',0,0),(90000047,00000045,'B',000,'',00000000,'El Bagre',0,0),(90000048,00000046,'B',000,'',00000000,'Entrerrios',0,0),(90000049,00000047,'B',000,'',00000000,'Envigado',0,0),(90000050,00000048,'B',000,'',00000000,'Fredonia',0,0),(90000051,00000049,'B',000,'',00000000,'Frontino',0,0),(90000052,00000050,'B',000,'',00000000,'Giraldo',0,0),(90000053,00000051,'B',000,'',00000000,'Girardota',0,0),(90000054,00000052,'B',000,'',00000000,'Gómez Plata',0,0),(90000055,00000053,'B',000,'',00000000,'Granada',0,0),(90000056,00000054,'B',000,'',00000000,'Guadalupe',0,0),(90000057,00000055,'B',000,'',00000000,'Guarne',0,0),(90000058,00000056,'B',000,'',00000000,'Guatapé',0,0),(90000059,00000057,'B',000,'',00000000,'Heliconia',0,0),(90000060,00000058,'B',000,'',00000000,'Hispania',0,0),(90000061,00000059,'B',000,'',00000000,'Itagui',0,0),(90000062,00000060,'B',000,'',00000000,'Ituango',0,0),(90000063,00000061,'B',000,'',00000000,'Jardín',0,0),(90000064,00000062,'B',000,'',00000000,'Jericó',0,0),(90000065,00000063,'B',000,'',00000000,'La Ceja',0,0),(90000066,00000064,'B',000,'',00000000,'La Estrella',0,0),(90000067,00000065,'B',000,'',00000000,'La Pintada',0,0),(90000068,00000066,'B',000,'',00000000,'La Unión',0,0),(90000069,00000067,'B',000,'',00000000,'Liborina',0,0),(90000070,00000068,'B',000,'',00000000,'Maceo',0,0),(90000071,00000069,'B',000,'',00000000,'Marinilla',0,0),(90000072,00000070,'B',000,'',00000000,'Montebello',0,0),(90000073,00000071,'B',000,'',00000000,'Murindó',0,0),(90000074,00000072,'B',000,'',00000000,'Mutatá',0,0),(90000075,00000073,'B',000,'',00000000,'Nariño',0,0),(90000076,00000074,'B',000,'',00000000,'Necoclí',0,0),(90000077,00000075,'B',000,'',00000000,'Nechí',0,0),(90000078,00000076,'B',000,'',00000000,'Olaya',0,0),(90000079,00000077,'B',000,'',00000000,'Peñol',0,0),(90000080,00000078,'B',000,'',00000000,'Peque',0,0),(90000081,00000079,'B',000,'',00000000,'Pueblorrico',0,0),(90000082,00000080,'B',000,'',00000000,'Puerto Berrío',0,0),(90000083,00000081,'B',000,'',00000000,'Puerto Nare (La Magdalena)',0,0),(90000084,00000082,'B',000,'',00000000,'Puerto Triunfo',0,0),(90000085,00000083,'B',000,'',00000000,'Remedios',0,0),(90000086,00000084,'B',000,'',00000000,'Retiro',0,0),(90000087,00000085,'B',000,'',00000000,'Rionegro',0,0),(90000088,00000086,'B',000,'',00000000,'Sabanalarga',0,0),(90000089,00000087,'B',000,'',00000000,'Sabaneta',0,0),(90000090,00000088,'B',000,'',00000000,'Salgar',0,0),(90000091,00000089,'B',000,'',00000000,'San Andrés',0,0),(90000092,00000090,'B',000,'',00000000,'San Carlos',0,0),(90000093,00000091,'B',000,'',00000000,'San Francisco',0,0),(90000094,00000092,'B',000,'',00000000,'San Jerónimo',0,0),(90000095,00000093,'B',000,'',00000000,'San José De La Montaña',0,0),(90000096,00000094,'B',000,'',00000000,'San Juan De Uraba',0,0),(90000097,00000095,'B',000,'',00000000,'San Luis',0,0),(90000098,00000096,'B',000,'',00000000,'San Pedro',0,0),(90000099,00000097,'B',000,'',00000000,'San Pedro De Uraba',0,0),(90000100,00000098,'B',000,'',00000000,'San Rafael',0,0),(90000101,00000099,'B',000,'',00000000,'San Roque',0,0),(90000102,00000100,'B',000,'',00000000,'San Vicente',0,0),(90000103,00000101,'B',000,'',00000000,'Santa Bárbara',0,0),(90000104,00000102,'B',000,'',00000000,'Santa Rosa De Osos',0,0),(90000105,00000103,'B',000,'',00000000,'Santo Domingo',0,0),(90000106,00000104,'B',000,'',00000000,'Santuario',0,0),(90000107,00000105,'B',000,'',00000000,'Segovia',0,0),(90000108,00000106,'B',000,'',00000000,'Sonson',0,0),(90000109,00000107,'B',000,'',00000000,'Sopetrán',0,0),(90000110,00000108,'B',000,'',00000000,'Támesis',0,0),(90000111,00000109,'B',000,'',00000000,'Taraza',0,0),(90000112,00000110,'B',000,'',00000000,'Tarso',0,0),(90000113,00000111,'B',000,'',00000000,'Titiribí',0,0),(90000114,00000112,'B',000,'',00000000,'Toledo',0,0),(90000115,00000113,'B',000,'',00000000,'Turbo',0,0),(90000116,00000114,'B',000,'',00000000,'Uramita',0,0),(90000117,00000115,'B',000,'',00000000,'Urrao',0,0),(90000118,00000116,'B',000,'',00000000,'Valdivia',0,0),(90000119,00000117,'B',000,'',00000000,'Valparaíso',0,0),(90000120,00000118,'B',000,'',00000000,'Vegachi',0,0),(90000121,00000119,'B',000,'',00000000,'Venecia',0,0),(90000122,00000120,'B',000,'',00000000,'Vigía Del Fuerte',0,0),(90000123,00000121,'B',000,'',00000000,'Yali',0,0),(90000124,00000122,'B',000,'',00000000,'Yarumal',0,0),(90000125,00000123,'B',000,'',00000000,'Yolombó',0,0),(90000126,00000124,'B',000,'',00000000,'Yondó',0,0),(90000127,00000125,'B',000,'',00000000,'Zaragoza',0,0),(90000128,00000126,'B',000,'',00000000,'Barranquilla',0,0),(90000129,00000127,'B',000,'',00000000,'Baranoa',0,0),(90000130,00000128,'B',000,'',00000000,'Campo de la Cruz',0,0),(90000131,00000129,'B',000,'',00000000,'Candelaria',0,0),(90000132,00000130,'B',000,'',00000000,'Galapa',0,0),(90000133,00000131,'B',000,'',00000000,'Juan De Acosta',0,0),(90000134,00000132,'B',000,'',00000000,'Luruaco',0,0),(90000135,00000133,'B',000,'',00000000,'Malambo',0,0),(90000136,00000134,'B',000,'',00000000,'Manatí',0,0),(90000137,00000135,'B',000,'',00000000,'Palmar De Varela',0,0),(90000138,00000136,'B',000,'',00000000,'Piojó',0,0),(90000139,00000137,'B',000,'',00000000,'Polo Nuevo',0,0),(90000140,00000138,'B',000,'',00000000,'Ponedera',0,0),(90000141,00000139,'B',000,'',00000000,'Puerto Colombia',0,0),(90000142,00000140,'B',000,'',00000000,'Repelón',0,0),(90000143,00000141,'B',000,'',00000000,'Sabanagrande',0,0),(90000144,00000142,'B',000,'',00000000,'Sabanalarga',0,0),(90000145,00000143,'B',000,'',00000000,'Santa Lucia',0,0),(90000146,00000144,'B',000,'',00000000,'Santo Tomas',0,0),(90000147,00000145,'B',000,'',00000000,'Soledad',0,0),(90000148,00000146,'B',000,'',00000000,'Suan',0,0),(90000149,00000147,'B',000,'',00000000,'Tubará',0,0),(90000150,00000148,'B',000,'',00000000,'Usiacurí',0,0),(90000151,00000149,'B',000,'',00000000,'Bogotá',0,0),(90000152,00000150,'B',000,'',00000000,'Cartagena',0,0),(90000153,00000151,'B',000,'',00000000,'Achí',0,0),(90000154,00000152,'B',000,'',00000000,'Altos del Rosario',0,0),(90000155,00000153,'B',000,'',00000000,'Arenal',0,0),(90000156,00000154,'B',000,'',00000000,'Arjona',0,0),(90000157,00000155,'B',000,'',00000000,'Arroyohondo',0,0),(90000158,00000156,'B',000,'',00000000,'Barranco de Loba',0,0),(90000159,00000157,'B',000,'',00000000,'Calamar',0,0),(90000160,00000158,'B',000,'',00000000,'Cantagallo',0,0),(90000161,00000159,'B',000,'',00000000,'Cicuco',0,0),(90000162,00000160,'B',000,'',00000000,'Córdoba',0,0),(90000163,00000161,'B',000,'',00000000,'Clemencia',0,0),(90000164,00000162,'B',000,'',00000000,'El Carmen de Bolívar',0,0),(90000165,00000163,'B',000,'',00000000,'El Guamo',0,0),(90000166,00000164,'B',000,'',00000000,'El Peñon',0,0),(90000167,00000165,'B',000,'',00000000,'Hatillo de Loba',0,0),(90000168,00000166,'B',000,'',00000000,'Magangue',0,0),(90000169,00000167,'B',000,'',00000000,'Mahates',0,0),(90000170,00000168,'B',000,'',00000000,'Margarita',0,0),(90000171,00000169,'B',000,'',00000000,'Maria la Baja',0,0),(90000172,00000170,'B',000,'',00000000,'Montecristo',0,0),(90000173,00000171,'B',000,'',00000000,'Mompos',0,0),(90000174,00000172,'B',000,'',00000000,'Morales',0,0),(90000175,00000173,'B',000,'',00000000,'Pinillos',0,0),(90000176,00000174,'B',000,'',00000000,'Regidor',0,0),(90000177,00000175,'B',000,'',00000000,'Río Viejo',0,0),(90000178,00000176,'B',000,'',00000000,'San Cristobal',0,0),(90000179,00000177,'B',000,'',00000000,'San Estanislao',0,0),(90000180,00000178,'B',000,'',00000000,'San Fernando',0,0),(90000181,00000179,'B',000,'',00000000,'San Jacinto',0,0),(90000182,00000180,'B',000,'',00000000,'San Jacinto del Cauca',0,0),(90000183,00000181,'B',000,'',00000000,'San Juan Nepomuceno',0,0),(90000184,00000182,'B',000,'',00000000,'San Martín de Loba',0,0),(90000185,00000183,'B',000,'',00000000,'San Pablo',0,0),(90000186,00000184,'B',000,'',00000000,'Santa Catalina',0,0),(90000187,00000185,'B',000,'',00000000,'Santa Rosa',0,0),(90000188,00000186,'B',000,'',00000000,'Santa Rosa del Sur',0,0),(90000189,00000187,'B',000,'',00000000,'Simití',0,0),(90000190,00000188,'B',000,'',00000000,'Soplaviento',0,0),(90000191,00000189,'B',000,'',00000000,'Talaigua Nuevo',0,0),(90000192,00000190,'B',000,'',00000000,'Tiquisio',0,0),(90000193,00000191,'B',000,'',00000000,'Turbaco',0,0),(90000194,00000192,'B',000,'',00000000,'Turbaná',0,0),(90000195,00000193,'B',000,'',00000000,'Villanueva',0,0),(90000196,00000194,'B',000,'',00000000,'Zambrano',0,0),(90000197,00000195,'B',000,'',00000000,'Tunja',0,0),(90000198,00000196,'B',000,'',00000000,'Almeida',0,0),(90000199,00000197,'B',000,'',00000000,'Aquitania',0,0),(90000200,00000198,'B',000,'',00000000,'Arcabuco',0,0),(90000201,00000199,'B',000,'',00000000,'Belén',0,0),(90000202,00000200,'B',000,'',00000000,'Berbeo',0,0),(90000203,00000201,'B',000,'',00000000,'Beteitiva',0,0),(90000204,00000202,'B',000,'',00000000,'Boavita',0,0),(90000205,00000203,'B',000,'',00000000,'Boyacá',0,0),(90000206,00000204,'B',000,'',00000000,'Briceño',0,0),(90000207,00000205,'B',000,'',00000000,'Buenavista',0,0),(90000208,00000206,'B',000,'',00000000,'Busbanza',0,0),(90000209,00000207,'B',000,'',00000000,'Caldas',0,0),(90000210,00000208,'B',000,'',00000000,'Campohermoso',0,0),(90000211,00000209,'B',000,'',00000000,'Cerinza',0,0),(90000212,00000210,'B',000,'',00000000,'Chinavita',0,0),(90000213,00000211,'B',000,'',00000000,'Chiquinquirá',0,0),(90000214,00000212,'B',000,'',00000000,'Chiscas',0,0),(90000215,00000213,'B',000,'',00000000,'Chita',0,0),(90000216,00000214,'B',000,'',00000000,'Chitaraque',0,0),(90000217,00000215,'B',000,'',00000000,'Chivata',0,0),(90000218,00000216,'B',000,'',00000000,'Ciénega',0,0),(90000219,00000217,'B',000,'',00000000,'Combita',0,0),(90000220,00000218,'B',000,'',00000000,'Coper',0,0),(90000221,00000219,'B',000,'',00000000,'Corrales',0,0),(90000222,00000220,'B',000,'',00000000,'Covarachia',0,0),(90000223,00000221,'B',000,'',00000000,'Cubara',0,0),(90000224,00000222,'B',000,'',00000000,'Cucaita',0,0),(90000225,00000223,'B',000,'',00000000,'Cuitiva',0,0),(90000226,00000224,'B',000,'',00000000,'Chiquiza',0,0),(90000227,00000225,'B',000,'',00000000,'Chivor',0,0),(90000228,00000226,'B',000,'',00000000,'Duitama',0,0),(90000229,00000227,'B',000,'',00000000,'El Cocuy',0,0),(90000230,00000228,'B',000,'',00000000,'El Espino',0,0),(90000231,00000229,'B',000,'',00000000,'Firavitoba',0,0),(90000232,00000230,'B',000,'',00000000,'Floresta',0,0),(90000233,00000231,'B',000,'',00000000,'Gachantiva',0,0),(90000234,00000232,'B',000,'',00000000,'Gameza',0,0),(90000235,00000233,'B',000,'',00000000,'Garagoa',0,0),(90000236,00000234,'B',000,'',00000000,'Guacamayas',0,0),(90000237,00000235,'B',000,'',00000000,'Guateque',0,0),(90000238,00000236,'B',000,'',00000000,'Guayata',0,0),(90000239,00000237,'B',000,'',00000000,'Guican',0,0),(90000240,00000238,'B',000,'',00000000,'Iza',0,0),(90000241,00000239,'B',000,'',00000000,'Jenesano',0,0),(90000242,00000240,'B',000,'',00000000,'Jericó',0,0),(90000243,00000241,'B',000,'',00000000,'Labranzagrande',0,0),(90000244,00000242,'B',000,'',00000000,'La Capilla',0,0),(90000245,00000243,'B',000,'',00000000,'La Victoria',0,0),(90000246,00000244,'B',000,'',00000000,'La Uvita',0,0),(90000247,00000245,'B',000,'',00000000,'Leiva',0,0),(90000248,00000246,'B',000,'',00000000,'Macanal',0,0),(90000249,00000247,'B',000,'',00000000,'Maripi',0,0),(90000250,00000248,'B',000,'',00000000,'Miraflores',0,0),(90000251,00000249,'B',000,'',00000000,'Mongua',0,0),(90000252,00000250,'B',000,'',00000000,'Monguí',0,0),(90000253,00000251,'B',000,'',00000000,'Moniquirá',0,0),(90000254,00000252,'B',000,'',00000000,'Motavita',0,0),(90000255,00000253,'B',000,'',00000000,'Muzo',0,0),(90000256,00000254,'B',000,'',00000000,'Nobsa',0,0),(90000257,00000255,'B',000,'',00000000,'Nuevo Colón',0,0),(90000258,00000256,'B',000,'',00000000,'Oicata',0,0),(90000259,00000257,'B',000,'',00000000,'Otanche',0,0),(90000260,00000258,'B',000,'',00000000,'Pachavita',0,0),(90000261,00000259,'B',000,'',00000000,'Páez',0,0),(90000262,00000260,'B',000,'',00000000,'Paipa',0,0),(90000263,00000261,'B',000,'',00000000,'Pajarito',0,0),(90000264,00000262,'B',000,'',00000000,'Panqueba',0,0),(90000265,00000263,'B',000,'',00000000,'Pauna',0,0),(90000266,00000264,'B',000,'',00000000,'Paya',0,0),(90000267,00000265,'B',000,'',00000000,'Paz del Río',0,0),(90000268,00000266,'B',000,'',00000000,'Pesca',0,0),(90000269,00000267,'B',000,'',00000000,'Pisba',0,0),(90000270,00000268,'B',000,'',00000000,'Puerto Boyacá',0,0),(90000271,00000269,'B',000,'',00000000,'Quipama',0,0),(90000272,00000270,'B',000,'',00000000,'Ramiriquí',0,0),(90000273,00000271,'B',000,'',00000000,'Ráquira',0,0),(90000274,00000272,'B',000,'',00000000,'Rondón',0,0),(90000275,00000273,'B',000,'',00000000,'Saboya',0,0),(90000276,00000274,'B',000,'',00000000,'Sáchica',0,0),(90000277,00000275,'B',000,'',00000000,'Samacá',0,0),(90000278,00000276,'B',000,'',00000000,'San Eduardo',0,0),(90000279,00000277,'B',000,'',00000000,'San José de Pare',0,0),(90000280,00000278,'B',000,'',00000000,'San Luis de Gaceno',0,0),(90000281,00000279,'B',000,'',00000000,'San Mateo',0,0),(90000282,00000280,'B',000,'',00000000,'San Miguel de Sema',0,0),(90000283,00000281,'B',000,'',00000000,'San Pablo de Borbur',0,0),(90000284,00000282,'B',000,'',00000000,'Santana',0,0),(90000285,00000283,'B',000,'',00000000,'Santa Maria',0,0),(90000286,00000284,'B',000,'',00000000,'Santa Rosa de Viterbo',0,0),(90000287,00000285,'B',000,'',00000000,'Santa Sofía',0,0),(90000288,00000286,'B',000,'',00000000,'Sativanorte',0,0),(90000289,00000287,'B',000,'',00000000,'Sativasur',0,0),(90000290,00000288,'B',000,'',00000000,'Siachoque',0,0),(90000291,00000289,'B',000,'',00000000,'Soata',0,0),(90000292,00000290,'B',000,'',00000000,'Socota',0,0),(90000293,00000291,'B',000,'',00000000,'Socha',0,0),(90000294,00000292,'B',000,'',00000000,'Sogamoso',0,0),(90000295,00000293,'B',000,'',00000000,'Somondoco',0,0),(90000296,00000294,'B',000,'',00000000,'Sora',0,0),(90000297,00000295,'B',000,'',00000000,'Sotaquirá',0,0),(90000298,00000296,'B',000,'',00000000,'Soracá',0,0),(90000299,00000297,'B',000,'',00000000,'Susacon',0,0),(90000300,00000298,'B',000,'',00000000,'Sutamarchán',0,0),(90000301,00000299,'B',000,'',00000000,'Sutatenza',0,0),(90000302,00000300,'B',000,'',00000000,'Tasco',0,0),(90000303,00000301,'B',000,'',00000000,'Tenza',0,0),(90000304,00000302,'B',000,'',00000000,'Tibaná',0,0),(90000305,00000303,'B',000,'',00000000,'Tibasosa',0,0),(90000306,00000304,'B',000,'',00000000,'Tinjacá',0,0),(90000307,00000305,'B',000,'',00000000,'Tipacoque',0,0),(90000308,00000306,'B',000,'',00000000,'Toca',0,0),(90000309,00000307,'B',000,'',00000000,'Toguí',0,0),(90000310,00000308,'B',000,'',00000000,'Topaga',0,0),(90000311,00000309,'B',000,'',00000000,'Tota',0,0),(90000312,00000310,'B',000,'',00000000,'Tunungua',0,0),(90000313,00000311,'B',000,'',00000000,'Turmequé',0,0),(90000314,00000312,'B',000,'',00000000,'Tuta',0,0),(90000315,00000313,'B',000,'',00000000,'Tutasa',0,0),(90000316,00000314,'B',000,'',00000000,'Umbita',0,0),(90000317,00000315,'B',000,'',00000000,'Ventaquemada',0,0),(90000318,00000316,'B',000,'',00000000,'Viracacha',0,0),(90000319,00000317,'B',000,'',00000000,'Zetaquira',0,0),(90000320,00000318,'B',000,'',00000000,'Manizales',0,0),(90000321,00000319,'B',000,'',00000000,'Aguadas',0,0),(90000322,00000320,'B',000,'',00000000,'Anserma',0,0),(90000323,00000321,'B',000,'',00000000,'Aranzazu',0,0),(90000324,00000322,'B',000,'',00000000,'Belalcazar',0,0),(90000325,00000323,'B',000,'',00000000,'Chinchiná',0,0),(90000326,00000324,'B',000,'',00000000,'Filadelfia',0,0),(90000327,00000325,'B',000,'',00000000,'La Dorada',0,0),(90000328,00000326,'B',000,'',00000000,'La Merced',0,0),(90000329,00000327,'B',000,'',00000000,'Manzanares',0,0),(90000330,00000328,'B',000,'',00000000,'Marmato',0,0),(90000331,00000329,'B',000,'',00000000,'Marquetalia',0,0),(90000332,00000330,'B',000,'',00000000,'Marulanda',0,0),(90000333,00000331,'B',000,'',00000000,'Neira',0,0),(90000334,00000332,'B',000,'',00000000,'Norcasia',0,0),(90000335,00000333,'B',000,'',00000000,'Pacora',0,0),(90000336,00000334,'B',000,'',00000000,'Palestina',0,0),(90000337,00000335,'B',000,'',00000000,'Pensilvania',0,0),(90000338,00000336,'B',000,'',00000000,'Riosucio',0,0),(90000339,00000337,'B',000,'',00000000,'Risaralda',0,0),(90000340,00000338,'B',000,'',00000000,'Salamina',0,0),(90000341,00000339,'B',000,'',00000000,'Samana',0,0),(90000342,00000340,'B',000,'',00000000,'San Jose',0,0),(90000343,00000341,'B',000,'',00000000,'Supía',0,0),(90000344,00000342,'B',000,'',00000000,'Victoria',0,0),(90000345,00000343,'B',000,'',00000000,'Villamaría',0,0),(90000346,00000344,'B',000,'',00000000,'Viterbo',0,0),(90000347,00000345,'B',000,'',00000000,'Florencia',0,0),(90000348,00000346,'B',000,'',00000000,'Albania',0,0),(90000349,00000347,'B',000,'',00000000,'Belén Andaquies',0,0),(90000350,00000348,'B',000,'',00000000,'Cartagena del Chaira',0,0),(90000351,00000349,'B',000,'',00000000,'Curillo',0,0),(90000352,00000350,'B',000,'',00000000,'El Doncello',0,0),(90000353,00000351,'B',000,'',00000000,'El Paujil',0,0),(90000354,00000352,'B',000,'',00000000,'La Montañita',0,0),(90000355,00000353,'B',000,'',00000000,'Milán',0,0),(90000356,00000354,'B',000,'',00000000,'Morelia',0,0),(90000357,00000355,'B',000,'',00000000,'Puerto Rico',0,0),(90000358,00000356,'B',000,'',00000000,'San José de Fragua',0,0),(90000359,00000357,'B',000,'',00000000,'SanVicente del Caguan',0,0),(90000360,00000358,'B',000,'',00000000,'Solano',0,0),(90000361,00000359,'B',000,'',00000000,'Solita',0,0),(90000362,00000360,'B',000,'',00000000,'Valparaíso',0,0),(90000363,00000361,'B',000,'',00000000,'Popayán',0,0),(90000364,00000362,'B',000,'',00000000,'Almaguer',0,0),(90000365,00000363,'B',000,'',00000000,'Argelia',0,0),(90000366,00000364,'B',000,'',00000000,'Balboa',0,0),(90000367,00000365,'B',000,'',00000000,'Bolívar',0,0),(90000368,00000366,'B',000,'',00000000,'Buenos Aires',0,0),(90000369,00000367,'B',000,'',00000000,'Cajibio',0,0),(90000370,00000368,'B',000,'',00000000,'Caldono',0,0),(90000371,00000369,'B',000,'',00000000,'Caloto',0,0),(90000372,00000370,'B',000,'',00000000,'Corinto',0,0),(90000373,00000371,'B',000,'',00000000,'El Tambo',0,0),(90000374,00000372,'B',000,'',00000000,'Florencia',0,0),(90000375,00000373,'B',000,'',00000000,'Guapi',0,0),(90000376,00000374,'B',000,'',00000000,'Inza',0,0),(90000377,00000375,'B',000,'',00000000,'Jambaló',0,0),(90000378,00000376,'B',000,'',00000000,'La Sierra',0,0),(90000379,00000377,'B',000,'',00000000,'La Vega',0,0),(90000380,00000378,'B',000,'',00000000,'López',0,0),(90000381,00000379,'B',000,'',00000000,'Mercaderes',0,0),(90000382,00000380,'B',000,'',00000000,'Miranda',0,0),(90000383,00000381,'B',000,'',00000000,'Morales',0,0),(90000384,00000382,'B',000,'',00000000,'Padilla',0,0),(90000385,00000383,'B',000,'',00000000,'Páez',0,0),(90000386,00000384,'B',000,'',00000000,'Patia (El Bordo)',0,0),(90000387,00000385,'B',000,'',00000000,'Piamonte',0,0),(90000388,00000386,'B',000,'',00000000,'Piendamo',0,0),(90000389,00000387,'B',000,'',00000000,'Puerto Tejada',0,0),(90000390,00000388,'B',000,'',00000000,'Purace',0,0),(90000391,00000389,'B',000,'',00000000,'Rosas',0,0),(90000392,00000390,'B',000,'',00000000,'San Sebastián',0,0),(90000393,00000391,'B',000,'',00000000,'Santander de Quilichao',0,0),(90000394,00000392,'B',000,'',00000000,'Santa Rosa',0,0),(90000395,00000393,'B',000,'',00000000,'Silvia',0,0),(90000396,00000394,'B',000,'',00000000,'Sotara',0,0),(90000397,00000395,'B',000,'',00000000,'Suárez',0,0),(90000398,00000396,'B',000,'',00000000,'Sucre',0,0),(90000399,00000397,'B',000,'',00000000,'Timbío',0,0),(90000400,00000398,'B',000,'',00000000,'Timbiquí',0,0),(90000401,00000399,'B',000,'',00000000,'Toribio',0,0),(90000402,00000400,'B',000,'',00000000,'Totoro',0,0),(90000403,00000401,'B',000,'',00000000,'Villa Rica',0,0),(90000404,00000402,'B',000,'',00000000,'Valledupar',0,0),(90000405,00000403,'B',000,'',00000000,'Aguachica',0,0),(90000406,00000404,'B',000,'',00000000,'Agustín Codazzi',0,0),(90000407,00000405,'B',000,'',00000000,'Astrea',0,0),(90000408,00000406,'B',000,'',00000000,'Becerril',0,0),(90000409,00000407,'B',000,'',00000000,'Bosconia',0,0),(90000410,00000408,'B',000,'',00000000,'Chimichagua',0,0),(90000411,00000409,'B',000,'',00000000,'Chiriguaná',0,0),(90000412,00000410,'B',000,'',00000000,'Curumaní',0,0),(90000413,00000411,'B',000,'',00000000,'El Copey',0,0),(90000414,00000412,'B',000,'',00000000,'El Paso',0,0),(90000415,00000413,'B',000,'',00000000,'Gamarra',0,0),(90000416,00000414,'B',000,'',00000000,'González',0,0),(90000417,00000415,'B',000,'',00000000,'La Gloria',0,0),(90000418,00000416,'B',000,'',00000000,'La Jagua Ibirico',0,0),(90000419,00000417,'B',000,'',00000000,'Manaure Balcón Del Cesar',0,0),(90000420,00000418,'B',000,'',00000000,'Pailitas',0,0),(90000421,00000419,'B',000,'',00000000,'Pelaya',0,0),(90000422,00000420,'B',000,'',00000000,'Pueblo Bello',0,0),(90000423,00000421,'B',000,'',00000000,'Río De Oro',0,0),(90000424,00000422,'B',000,'',00000000,'Robles (La Paz)',0,0),(90000425,00000423,'B',000,'',00000000,'San Alberto',0,0),(90000426,00000424,'B',000,'',00000000,'San Diego',0,0),(90000427,00000425,'B',000,'',00000000,'San Martín',0,0),(90000428,00000426,'B',000,'',00000000,'Tamalameque',0,0),(90000429,00000427,'B',000,'',00000000,'Montería',0,0),(90000430,00000428,'B',000,'',00000000,'Ayapel',0,0),(90000431,00000429,'B',000,'',00000000,'Buenavista',0,0),(90000432,00000430,'B',000,'',00000000,'Canalete',0,0),(90000433,00000431,'B',000,'',00000000,'Cereté',0,0),(90000434,00000432,'B',000,'',00000000,'Chima',0,0),(90000435,00000433,'B',000,'',00000000,'Chinú',0,0),(90000436,00000434,'B',000,'',00000000,'Cienaga De Oro',0,0),(90000437,00000435,'B',000,'',00000000,'Cotorra',0,0),(90000438,00000436,'B',000,'',00000000,'La Apartada',0,0),(90000439,00000437,'B',000,'',00000000,'Lorica',0,0),(90000440,00000438,'B',000,'',00000000,'Los Córdobas',0,0),(90000441,00000439,'B',000,'',00000000,'Momil',0,0),(90000442,00000440,'B',000,'',00000000,'Montelíbano',0,0),(90000443,00000441,'B',000,'',00000000,'Moñitos',0,0),(90000444,00000442,'B',000,'',00000000,'Planeta Rica',0,0),(90000445,00000443,'B',000,'',00000000,'Pueblo Nuevo',0,0),(90000446,00000444,'B',000,'',00000000,'Puerto Escondido',0,0),(90000447,00000445,'B',000,'',00000000,'Puerto Libertador',0,0),(90000448,00000446,'B',000,'',00000000,'Purísima',0,0),(90000449,00000447,'B',000,'',00000000,'Sahagún',0,0),(90000450,00000448,'B',000,'',00000000,'San Andrés Sotavento',0,0),(90000451,00000449,'B',000,'',00000000,'San Antero',0,0),(90000452,00000450,'B',000,'',00000000,'San Bernardo Viento',0,0),(90000453,00000451,'B',000,'',00000000,'San Carlos',0,0),(90000454,00000452,'B',000,'',00000000,'San Pelayo',0,0),(90000455,00000453,'B',000,'',00000000,'Tierralta',0,0),(90000456,00000454,'B',000,'',00000000,'Valencia',0,0),(90000457,00000455,'B',000,'',00000000,'Cerromatoso',0,0),(90000458,00000456,'B',000,'',00000000,'Agua de Dios',0,0),(90000459,00000457,'B',000,'',00000000,'Alban',0,0),(90000460,00000458,'B',000,'',00000000,'Anapoima',0,0),(90000461,00000459,'B',000,'',00000000,'Anolaima',0,0),(90000462,00000460,'B',000,'',00000000,'Arbelaez',0,0),(90000463,00000461,'B',000,'',00000000,'Beltrán',0,0),(90000464,00000462,'B',000,'',00000000,'Bituima',0,0),(90000465,00000463,'B',000,'',00000000,'Bojacá',0,0),(90000466,00000464,'B',000,'',00000000,'Cabrera',0,0),(90000467,00000465,'B',000,'',00000000,'Cachipay',0,0),(90000468,00000466,'B',000,'',00000000,'Cajicá',0,0),(90000469,00000467,'B',000,'',00000000,'Caparrapí',0,0),(90000470,00000468,'B',000,'',00000000,'Caqueza',0,0),(90000471,00000469,'B',000,'',00000000,'Carmen de Carupa',0,0),(90000472,00000470,'B',000,'',00000000,'Chaguaní',0,0),(90000473,00000471,'B',000,'',00000000,'Chia',0,0),(90000474,00000472,'B',000,'',00000000,'Chipaque',0,0),(90000475,00000473,'B',000,'',00000000,'Choachí',0,0),(90000476,00000474,'B',000,'',00000000,'Chocontá',0,0),(90000477,00000475,'B',000,'',00000000,'Cogua',0,0),(90000478,00000476,'B',000,'',00000000,'Cota',0,0),(90000479,00000477,'B',000,'',00000000,'Cucunubá',0,0),(90000480,00000478,'B',000,'',00000000,'El Colegio',0,0),(90000481,00000479,'B',000,'',00000000,'El Peñón',0,0),(90000482,00000480,'B',000,'',00000000,'El Rosal',0,0),(90000483,00000481,'B',000,'',00000000,'Facatativa',0,0),(90000484,00000482,'B',000,'',00000000,'Fómeque',0,0),(90000485,00000483,'B',000,'',00000000,'Fosca',0,0),(90000486,00000484,'B',000,'',00000000,'Funza',0,0),(90000487,00000485,'B',000,'',00000000,'Fúquene',0,0),(90000488,00000486,'B',000,'',00000000,'Fusagasuga',0,0),(90000489,00000487,'B',000,'',00000000,'Gachalá',0,0),(90000490,00000488,'B',000,'',00000000,'Gachancipá',0,0),(90000491,00000489,'B',000,'',00000000,'Gacheta',0,0),(90000492,00000490,'B',000,'',00000000,'Gama',0,0),(90000493,00000491,'B',000,'',00000000,'Girardot',0,0),(90000494,00000492,'B',000,'',00000000,'Granada',0,0),(90000495,00000493,'B',000,'',00000000,'Guachetá',0,0),(90000496,00000494,'B',000,'',00000000,'Guaduas',0,0),(90000497,00000495,'B',000,'',00000000,'Guasca',0,0),(90000498,00000496,'B',000,'',00000000,'Guataquí',0,0),(90000499,00000497,'B',000,'',00000000,'Guatavita',0,0),(90000500,00000498,'B',000,'',00000000,'Guayabal de Siquima',0,0),(90000501,00000499,'B',000,'',00000000,'Guayabetal',0,0),(90000502,00000500,'B',000,'',00000000,'Gutiérrez',0,0),(90000503,00000501,'B',000,'',00000000,'Jerusalén',0,0),(90000504,00000502,'B',000,'',00000000,'Junín',0,0),(90000505,00000503,'B',000,'',00000000,'La Calera',0,0),(90000506,00000504,'B',000,'',00000000,'La Mesa',0,0),(90000507,00000505,'B',000,'',00000000,'La Palma',0,0),(90000508,00000506,'B',000,'',00000000,'La Peña',0,0),(90000509,00000507,'B',000,'',00000000,'La Vega',0,0),(90000510,00000508,'B',000,'',00000000,'Lenguazaque',0,0),(90000511,00000509,'B',000,'',00000000,'Machetá',0,0),(90000512,00000510,'B',000,'',00000000,'Madrid',0,0),(90000513,00000511,'B',000,'',00000000,'Manta',0,0),(90000514,00000512,'B',000,'',00000000,'Medina',0,0),(90000515,00000513,'B',000,'',00000000,'Mosquera',0,0),(90000516,00000514,'B',000,'',00000000,'Nariño',0,0),(90000517,00000515,'B',000,'',00000000,'Nemocón',0,0),(90000518,00000516,'B',000,'',00000000,'Nilo',0,0),(90000519,00000517,'B',000,'',00000000,'Nimaima',0,0),(90000520,00000518,'B',000,'',00000000,'Nocaima',0,0),(90000521,00000519,'B',000,'',00000000,'Ospina Pérez',0,0),(90000522,00000520,'B',000,'',00000000,'Pacho',0,0),(90000523,00000521,'B',000,'',00000000,'Paime',0,0),(90000524,00000522,'B',000,'',00000000,'Pandi',0,0),(90000525,00000523,'B',000,'',00000000,'Paratebueno',0,0),(90000526,00000524,'B',000,'',00000000,'Pasca',0,0),(90000527,00000525,'B',000,'',00000000,'Puerto Salgar',0,0),(90000528,00000526,'B',000,'',00000000,'Pulí',0,0),(90000529,00000527,'B',000,'',00000000,'Quebradanegra',0,0),(90000530,00000528,'B',000,'',00000000,'Quetame',0,0),(90000531,00000529,'B',000,'',00000000,'Quipile',0,0),(90000532,00000530,'B',000,'',00000000,'Rafael Reyes',0,0),(90000533,00000531,'B',000,'',00000000,'Ricaurte',0,0),(90000534,00000532,'B',000,'',00000000,'SanAntonio delTequendama',0,0),(90000535,00000533,'B',000,'',00000000,'San Bernardo',0,0),(90000536,00000534,'B',000,'',00000000,'San Cayetano',0,0),(90000537,00000535,'B',000,'',00000000,'San Francisco',0,0),(90000538,00000536,'B',000,'',00000000,'San Juan de Rioseco',0,0),(90000539,00000537,'B',000,'',00000000,'Sasaima',0,0),(90000540,00000538,'B',000,'',00000000,'Sesquilé',0,0),(90000541,00000539,'B',000,'',00000000,'Sibaté',0,0),(90000542,00000540,'B',000,'',00000000,'Silvania',0,0),(90000543,00000541,'B',000,'',00000000,'Simijaca',0,0),(90000544,00000542,'B',000,'',00000000,'Soacha',0,0),(90000545,00000543,'B',000,'',00000000,'Sopo',0,0),(90000546,00000544,'B',000,'',00000000,'Subachoque',0,0),(90000547,00000545,'B',000,'',00000000,'Suesca',0,0),(90000548,00000546,'B',000,'',00000000,'Supatá',0,0),(90000549,00000547,'B',000,'',00000000,'Susa',0,0),(90000550,00000548,'B',000,'',00000000,'Sutatausa',0,0),(90000551,00000549,'B',000,'',00000000,'Tabio',0,0),(90000552,00000550,'B',000,'',00000000,'Tausa',0,0),(90000553,00000551,'B',000,'',00000000,'Tena',0,0),(90000554,00000552,'B',000,'',00000000,'Tenjo',0,0),(90000555,00000553,'B',000,'',00000000,'Tibacuy',0,0),(90000556,00000554,'B',000,'',00000000,'Tibirita',0,0),(90000557,00000555,'B',000,'',00000000,'Tocaima',0,0),(90000558,00000556,'B',000,'',00000000,'Tocancipá',0,0),(90000559,00000557,'B',000,'',00000000,'Topaipí',0,0),(90000560,00000558,'B',000,'',00000000,'Ubalá',0,0),(90000561,00000559,'B',000,'',00000000,'Ubaque',0,0),(90000562,00000560,'B',000,'',00000000,'Ubaté',0,0),(90000563,00000561,'B',000,'',00000000,'Une',0,0),(90000564,00000562,'B',000,'',00000000,'Utica',0,0),(90000565,00000563,'B',000,'',00000000,'Vergara',0,0),(90000566,00000564,'B',000,'',00000000,'Viani',0,0),(90000567,00000565,'B',000,'',00000000,'Villagomez',0,0),(90000568,00000566,'B',000,'',00000000,'Villapinzón',0,0),(90000569,00000567,'B',000,'',00000000,'Villeta',0,0),(90000570,00000568,'B',000,'',00000000,'Viota',0,0),(90000571,00000569,'B',000,'',00000000,'Yacopí',0,0),(90000572,00000570,'B',000,'',00000000,'Zipacón',0,0),(90000573,00000571,'B',000,'',00000000,'Zipaquirá',0,0),(90000574,00000572,'B',000,'',00000000,'Quibdó',0,0),(90000575,00000573,'B',000,'',00000000,'Acandí',0,0),(90000576,00000574,'B',000,'',00000000,'Alto Baudó (Pie de Pato)',0,0),(90000577,00000575,'B',000,'',00000000,'Atrato',0,0),(90000578,00000576,'B',000,'',00000000,'Bagadó',0,0),(90000579,00000577,'B',000,'',00000000,'Bahía Solano (Mutis)',0,0),(90000580,00000578,'B',000,'',00000000,'Bajo Baudó (Pizarro)',0,0),(90000581,00000579,'B',000,'',00000000,'Bojayá (Bellavista)',0,0),(90000582,00000580,'B',000,'',00000000,'Cantóm de San Pablo',0,0),(90000583,00000581,'B',000,'',00000000,'Carmen del Darién',0,0),(90000584,00000582,'B',000,'',00000000,'Certegui',0,0),(90000585,00000583,'B',000,'',00000000,'Condoto',0,0),(90000586,00000584,'B',000,'',00000000,'El Carmen',0,0),(90000587,00000585,'B',000,'',00000000,'Litoral del San Juan',0,0),(90000588,00000586,'B',000,'',00000000,'Itsmina',0,0),(90000589,00000587,'B',000,'',00000000,'Juradó',0,0),(90000590,00000588,'B',000,'',00000000,'Lloró',0,0),(90000591,00000589,'B',000,'',00000000,'Medio Atrato',0,0),(90000592,00000590,'B',000,'',00000000,'Medio Baudó (Boca de Pepe)',0,0),(90000593,00000591,'B',000,'',00000000,'Medio San Juan',0,0),(90000594,00000592,'B',000,'',00000000,'Novita',0,0),(90000595,00000593,'B',000,'',00000000,'Nuquí',0,0),(90000596,00000594,'B',000,'',00000000,'Río Iro',0,0),(90000597,00000595,'B',000,'',00000000,'Ríoi Quito',0,0),(90000598,00000596,'B',000,'',00000000,'Riosucio',0,0),(90000599,00000597,'B',000,'',00000000,'San José Del Palmar',0,0),(90000600,00000598,'B',000,'',00000000,'Sipí',0,0),(90000601,00000599,'B',000,'',00000000,'Tadó',0,0),(90000602,00000600,'B',000,'',00000000,'Unguía',0,0),(90000603,00000601,'B',000,'',00000000,'Unión Paramericana',0,0),(90000604,00000602,'B',000,'',00000000,'Neiva',0,0),(90000605,00000603,'B',000,'',00000000,'Acevedo',0,0),(90000606,00000604,'B',000,'',00000000,'Agrado',0,0),(90000607,00000605,'B',000,'',00000000,'Aipe',0,0),(90000608,00000606,'B',000,'',00000000,'Algeciras',0,0),(90000609,00000607,'B',000,'',00000000,'Altamira',0,0),(90000610,00000608,'B',000,'',00000000,'Baraya',0,0),(90000611,00000609,'B',000,'',00000000,'Campoalegre',0,0),(90000612,00000610,'B',000,'',00000000,'Colombia',0,0),(90000613,00000611,'B',000,'',00000000,'Elias',0,0),(90000614,00000612,'B',000,'',00000000,'Garzón',0,0),(90000615,00000613,'B',000,'',00000000,'Gigante',0,0),(90000616,00000614,'B',000,'',00000000,'Guadalupe',0,0),(90000617,00000615,'B',000,'',00000000,'Hobo',0,0),(90000618,00000616,'B',000,'',00000000,'Iquira',0,0),(90000619,00000617,'B',000,'',00000000,'Isnos',0,0),(90000620,00000618,'B',000,'',00000000,'La Argentina',0,0),(90000621,00000619,'B',000,'',00000000,'La Plata',0,0),(90000622,00000620,'B',000,'',00000000,'Nataga',0,0),(90000623,00000621,'B',000,'',00000000,'Oporapa',0,0),(90000624,00000622,'B',000,'',00000000,'Paicol',0,0),(90000625,00000623,'B',000,'',00000000,'Palermo',0,0),(90000626,00000624,'B',000,'',00000000,'Palestina',0,0),(90000627,00000625,'B',000,'',00000000,'Pital',0,0),(90000628,00000626,'B',000,'',00000000,'Pitalito',0,0),(90000629,00000627,'B',000,'',00000000,'Rivera',0,0),(90000630,00000628,'B',000,'',00000000,'Saladoblanco',0,0),(90000631,00000629,'B',000,'',00000000,'San Agustín',0,0),(90000632,00000630,'B',000,'',00000000,'Santa Maria',0,0),(90000633,00000631,'B',000,'',00000000,'Suaza',0,0),(90000634,00000632,'B',000,'',00000000,'Tarqui',0,0),(90000635,00000633,'B',000,'',00000000,'Tesalia',0,0),(90000636,00000634,'B',000,'',00000000,'Tello',0,0),(90000637,00000635,'B',000,'',00000000,'Teruel',0,0),(90000638,00000636,'B',000,'',00000000,'Timana',0,0),(90000639,00000637,'B',000,'',00000000,'Villavieja',0,0),(90000640,00000638,'B',000,'',00000000,'Yaguara',0,0),(90000641,00000639,'B',000,'',00000000,'Riohacha',0,0),(90000642,00000640,'B',000,'',00000000,'Albania',0,0),(90000643,00000641,'B',000,'',00000000,'Barrancas',0,0),(90000644,00000642,'B',000,'',00000000,'Dibulla',0,0),(90000645,00000643,'B',000,'',00000000,'Distraccion',0,0),(90000646,00000644,'B',000,'',00000000,'El Molino',0,0),(90000647,00000645,'B',000,'',00000000,'Fonseca',0,0),(90000648,00000646,'B',000,'',00000000,'Hatonuevo',0,0),(90000649,00000647,'B',000,'',00000000,'La Jagua del Pilar',0,0),(90000650,00000648,'B',000,'',00000000,'Maicao',0,0),(90000651,00000649,'B',000,'',00000000,'Manaure',0,0),(90000652,00000650,'B',000,'',00000000,'San Juan del Cesar',0,0),(90000653,00000651,'B',000,'',00000000,'Uribia',0,0),(90000654,00000652,'B',000,'',00000000,'Urumita',0,0),(90000655,00000653,'B',000,'',00000000,'Villanueva',0,0),(90000656,00000654,'B',000,'',00000000,'Santa Marta',0,0),(90000657,00000655,'B',000,'',00000000,'Algarrobo',0,0),(90000658,00000656,'B',000,'',00000000,'Aracataca',0,0),(90000659,00000657,'B',000,'',00000000,'Ariguani',0,0),(90000660,00000658,'B',000,'',00000000,'Cerro San Antonio',0,0),(90000661,00000659,'B',000,'',00000000,'Chivolo',0,0),(90000662,00000660,'B',000,'',00000000,'Cienaga',0,0),(90000663,00000661,'B',000,'',00000000,'Concordia',0,0),(90000664,00000662,'B',000,'',00000000,'El Banco',0,0),(90000665,00000663,'B',000,'',00000000,'El Piñon',0,0),(90000666,00000664,'B',000,'',00000000,'El Reten',0,0),(90000667,00000665,'B',000,'',00000000,'Fundacion',0,0),(90000668,00000666,'B',000,'',00000000,'Guamal',0,0),(90000669,00000667,'B',000,'',00000000,'Nueva Granada',0,0),(90000670,00000668,'B',000,'',00000000,'Pedraza',0,0),(90000671,00000669,'B',000,'',00000000,'Pijiño Del Carmen',0,0),(90000672,00000670,'B',000,'',00000000,'Pivijay',0,0),(90000673,00000671,'B',000,'',00000000,'Plato',0,0),(90000674,00000672,'B',000,'',00000000,'Puebloviejo',0,0),(90000675,00000673,'B',000,'',00000000,'Remolino',0,0),(90000676,00000674,'B',000,'',00000000,'Sabanas De San Angel',0,0),(90000677,00000675,'B',000,'',00000000,'Salamina',0,0),(90000678,00000676,'B',000,'',00000000,'San Sebastian De Buenavista',0,0),(90000679,00000677,'B',000,'',00000000,'San Zenon',0,0),(90000680,00000678,'B',000,'',00000000,'Santa Ana',0,0),(90000681,00000679,'B',000,'',00000000,'Santa Barbara De Pinto',0,0),(90000682,00000680,'B',000,'',00000000,'Sitionuevo',0,0),(90000683,00000681,'B',000,'',00000000,'Tenerife',0,0),(90000684,00000682,'B',000,'',00000000,'Zapayan',0,0),(90000685,00000683,'B',000,'',00000000,'Zona Bananera',0,0),(90000686,00000684,'B',000,'',00000000,'Villavicencio',0,0),(90000687,00000685,'B',000,'',00000000,'Acacias',0,0),(90000688,00000686,'B',000,'',00000000,'Barranca de Upia',0,0),(90000689,00000687,'B',000,'',00000000,'Cabuyaro',0,0),(90000690,00000688,'B',000,'',00000000,'Castilla La Nueva',0,0),(90000691,00000689,'B',000,'',00000000,'Cubarral',0,0),(90000692,00000690,'B',000,'',00000000,'Cumaral',0,0),(90000693,00000691,'B',000,'',00000000,'El Calvario',0,0),(90000694,00000692,'B',000,'',00000000,'El Castillo',0,0),(90000695,00000693,'B',000,'',00000000,'El Dorado',0,0),(90000696,00000694,'B',000,'',00000000,'Fuente de Oro',0,0),(90000697,00000695,'B',000,'',00000000,'Granada',0,0),(90000698,00000696,'B',000,'',00000000,'Guamal',0,0),(90000699,00000697,'B',000,'',00000000,'Mapiripán',0,0),(90000700,00000698,'B',000,'',00000000,'Mesetas',0,0),(90000701,00000699,'B',000,'',00000000,'La Macarena',0,0),(90000702,00000700,'B',000,'',00000000,'La Uribe',0,0),(90000703,00000701,'B',000,'',00000000,'Lejanías',0,0),(90000704,00000702,'B',000,'',00000000,'Puerto Concordia',0,0),(90000705,00000703,'B',000,'',00000000,'Puerto Gaitán',0,0),(90000706,00000704,'B',000,'',00000000,'Puerto López',0,0),(90000707,00000705,'B',000,'',00000000,'Puerto Lleras',0,0),(90000708,00000706,'B',000,'',00000000,'Puerto Rico',0,0),(90000709,00000707,'B',000,'',00000000,'Restrepo',0,0),(90000710,00000708,'B',000,'',00000000,'San Carlos Guaroa',0,0),(90000711,00000709,'B',000,'',00000000,'SanJuan de Arama',0,0),(90000712,00000710,'B',000,'',00000000,'San Juanito',0,0),(90000713,00000711,'B',000,'',00000000,'San Martín',0,0),(90000714,00000712,'B',000,'',00000000,'Vista Hermosa',0,0),(90000715,00000713,'B',000,'',00000000,'Pasto',0,0),(90000716,00000714,'B',000,'',00000000,'Alban',0,0),(90000717,00000715,'B',000,'',00000000,'Aldaña',0,0),(90000718,00000716,'B',000,'',00000000,'Ancuya',0,0),(90000719,00000717,'B',000,'',00000000,'Arboleda',0,0),(90000720,00000718,'B',000,'',00000000,'Barbacoas',0,0),(90000721,00000719,'B',000,'',00000000,'Belen',0,0),(90000722,00000720,'B',000,'',00000000,'Buesaco',0,0),(90000723,00000721,'B',000,'',00000000,'Colon(Genova)',0,0),(90000724,00000722,'B',000,'',00000000,'Consaca',0,0),(90000725,00000723,'B',000,'',00000000,'Contadero',0,0),(90000726,00000724,'B',000,'',00000000,'Cordoba',0,0),(90000727,00000725,'B',000,'',00000000,'Cuaspud',0,0),(90000728,00000726,'B',000,'',00000000,'Cumbal',0,0),(90000729,00000727,'B',000,'',00000000,'Cumbitara',0,0),(90000730,00000728,'B',000,'',00000000,'Chachagui',0,0),(90000731,00000729,'B',000,'',00000000,'El Charco',0,0),(90000732,00000730,'B',000,'',00000000,'El Peñol',0,0),(90000733,00000731,'B',000,'',00000000,'El Rosario',0,0),(90000734,00000732,'B',000,'',00000000,'El Tablon',0,0),(90000735,00000733,'B',000,'',00000000,'El Tambo',0,0),(90000736,00000734,'B',000,'',00000000,'Funes',0,0),(90000737,00000735,'B',000,'',00000000,'Guachucal',0,0),(90000738,00000736,'B',000,'',00000000,'Guaitarilla',0,0),(90000739,00000737,'B',000,'',00000000,'Gualmatan',0,0),(90000740,00000738,'B',000,'',00000000,'Iles',0,0),(90000741,00000739,'B',000,'',00000000,'Imues',0,0),(90000742,00000740,'B',000,'',00000000,'Ipiales',0,0),(90000743,00000741,'B',000,'',00000000,'La Cruz',0,0),(90000744,00000742,'B',000,'',00000000,'La Florida',0,0),(90000745,00000743,'B',000,'',00000000,'La Llanada',0,0),(90000746,00000744,'B',000,'',00000000,'La Tola',0,0),(90000747,00000745,'B',000,'',00000000,'La Union',0,0),(90000748,00000746,'B',000,'',00000000,'Leiva',0,0),(90000749,00000747,'B',000,'',00000000,'Linares',0,0),(90000750,00000748,'B',000,'',00000000,'Los Andes',0,0),(90000751,00000749,'B',000,'',00000000,'Magui',0,0),(90000752,00000750,'B',000,'',00000000,'Mallama',0,0),(90000753,00000751,'B',000,'',00000000,'Mosquera',0,0),(90000754,00000752,'B',000,'',00000000,'Nariño',0,0),(90000755,00000753,'B',000,'',00000000,'Olaya Herrera',0,0),(90000756,00000754,'B',000,'',00000000,'Ospina',0,0),(90000757,00000755,'B',000,'',00000000,'Pizarro',0,0),(90000758,00000756,'B',000,'',00000000,'Policarpa',0,0),(90000759,00000757,'B',000,'',00000000,'Potosi',0,0),(90000760,00000758,'B',000,'',00000000,'Providencia',0,0),(90000761,00000759,'B',000,'',00000000,'Puerres',0,0),(90000762,00000760,'B',000,'',00000000,'Pupiales',0,0),(90000763,00000761,'B',000,'',00000000,'Ricaurte',0,0),(90000764,00000762,'B',000,'',00000000,'Roberto Payan',0,0),(90000765,00000763,'B',000,'',00000000,'Samaniego',0,0),(90000766,00000764,'B',000,'',00000000,'Sandona',0,0),(90000767,00000765,'B',000,'',00000000,'San Bernardo',0,0),(90000768,00000766,'B',000,'',00000000,'San Lorenzo',0,0),(90000769,00000767,'B',000,'',00000000,'San Pablo',0,0),(90000770,00000768,'B',000,'',00000000,'San Pedro De Cartago',0,0),(90000771,00000769,'B',000,'',00000000,'Santa Barbara',0,0),(90000772,00000770,'B',000,'',00000000,'Santacruz',0,0),(90000773,00000771,'B',000,'',00000000,'Sapuyes',0,0),(90000774,00000772,'B',000,'',00000000,'Taminango',0,0),(90000775,00000773,'B',000,'',00000000,'Tangua',0,0),(90000776,00000774,'B',000,'',00000000,'Tumaco',0,0),(90000777,00000775,'B',000,'',00000000,'Tuquerres',0,0),(90000778,00000776,'B',000,'',00000000,'Yacuanquer',0,0),(90000779,00000777,'B',000,'',00000000,'Cúcuta',0,0),(90000780,00000778,'B',000,'',00000000,'Abrego',0,0),(90000781,00000779,'B',000,'',00000000,'Arboledas',0,0),(90000782,00000780,'B',000,'',00000000,'Bochalema',0,0),(90000783,00000781,'B',000,'',00000000,'Bucarasica',0,0),(90000784,00000782,'B',000,'',00000000,'Cácota',0,0),(90000785,00000783,'B',000,'',00000000,'Cáchira',0,0),(90000786,00000784,'B',000,'',00000000,'Chinácota',0,0),(90000787,00000785,'B',000,'',00000000,'Chitagá',0,0),(90000788,00000786,'B',000,'',00000000,'Convención',0,0),(90000789,00000787,'B',000,'',00000000,'Cucutilla',0,0),(90000790,00000788,'B',000,'',00000000,'Durania',0,0),(90000791,00000789,'B',000,'',00000000,'El Carmen',0,0),(90000792,00000790,'B',000,'',00000000,'El Tarra',0,0),(90000793,00000791,'B',000,'',00000000,'El Zulia',0,0),(90000794,00000792,'B',000,'',00000000,'Gramalote',0,0),(90000795,00000793,'B',000,'',00000000,'Hacari',0,0),(90000796,00000794,'B',000,'',00000000,'Herrán',0,0),(90000797,00000795,'B',000,'',00000000,'Labateca',0,0),(90000798,00000796,'B',000,'',00000000,'La Esperanza',0,0),(90000799,00000797,'B',000,'',00000000,'La Playa',0,0),(90000800,00000798,'B',000,'',00000000,'Los Patios',0,0),(90000801,00000799,'B',000,'',00000000,'Lourdes',0,0),(90000802,00000800,'B',000,'',00000000,'Mutiscua',0,0),(90000803,00000801,'B',000,'',00000000,'Ocaña',0,0),(90000804,00000802,'B',000,'',00000000,'Pamplona',0,0),(90000805,00000803,'B',000,'',00000000,'Pamplonita',0,0),(90000806,00000804,'B',000,'',00000000,'Puerto Santander',0,0),(90000807,00000805,'B',000,'',00000000,'Ragonvalia',0,0),(90000808,00000806,'B',000,'',00000000,'Salazar',0,0),(90000809,00000807,'B',000,'',00000000,'San Calixto',0,0),(90000810,00000808,'B',000,'',00000000,'San Cayetano',0,0),(90000811,00000809,'B',000,'',00000000,'Santiago',0,0),(90000812,00000810,'B',000,'',00000000,'Sardinata',0,0),(90000813,00000811,'B',000,'',00000000,'Silos',0,0),(90000814,00000812,'B',000,'',00000000,'Teorama',0,0),(90000815,00000813,'B',000,'',00000000,'Tibú',0,0),(90000816,00000814,'B',000,'',00000000,'Toledo',0,0),(90000817,00000815,'B',000,'',00000000,'Villacaro',0,0),(90000818,00000816,'B',000,'',00000000,'Villa del Rosario',0,0),(90000819,00000817,'B',000,'',00000000,'Armenia',0,0),(90000820,00000818,'B',000,'',00000000,'Buenavista',0,0),(90000821,00000819,'B',000,'',00000000,'Calarcá',0,0),(90000822,00000820,'B',000,'',00000000,'Circasia',0,0),(90000823,00000821,'B',000,'',00000000,'Córdoba',0,0),(90000824,00000822,'B',000,'',00000000,'Filandia',0,0),(90000825,00000823,'B',000,'',00000000,'Génova',0,0),(90000826,00000824,'B',000,'',00000000,'La Tebaida',0,0),(90000827,00000825,'B',000,'',00000000,'Montenegro',0,0),(90000828,00000826,'B',000,'',00000000,'Pijao',0,0),(90000829,00000827,'B',000,'',00000000,'Quimbaya',0,0),(90000830,00000828,'B',000,'',00000000,'Salento',0,0),(90000831,00000829,'B',000,'',00000000,'Pereira',0,0),(90000832,00000830,'B',000,'',00000000,'Apia',0,0),(90000833,00000831,'B',000,'',00000000,'Balboa',0,0),(90000834,00000832,'B',000,'',00000000,'Belén de Umbría',0,0),(90000835,00000833,'B',000,'',00000000,'Dos Quebradas',0,0),(90000836,00000834,'B',000,'',00000000,'Guatica',0,0),(90000837,00000835,'B',000,'',00000000,'La Celia',0,0),(90000838,00000836,'B',000,'',00000000,'La Virginia',0,0),(90000839,00000837,'B',000,'',00000000,'Marsella',0,0),(90000840,00000838,'B',000,'',00000000,'Mistrato',0,0),(90000841,00000839,'B',000,'',00000000,'Pueblo Rico',0,0),(90000842,00000840,'B',000,'',00000000,'Quinchía',0,0),(90000843,00000841,'B',000,'',00000000,'Santa Rosa de Cabal',0,0),(90000844,00000842,'B',000,'',00000000,'Santuario',0,0),(90000845,00000843,'B',000,'',00000000,'Bucaramanga',0,0),(90000846,00000844,'B',000,'',00000000,'Aguada',0,0),(90000847,00000845,'B',000,'',00000000,'Albania',0,0),(90000848,00000846,'B',000,'',00000000,'Aratoca',0,0),(90000849,00000847,'B',000,'',00000000,'Barbosa',0,0),(90000850,00000848,'B',000,'',00000000,'Barichara',0,0),(90000851,00000849,'B',000,'',00000000,'Barrancabermeja',0,0),(90000852,00000850,'B',000,'',00000000,'Betulia',0,0),(90000853,00000851,'B',000,'',00000000,'Bolívar',0,0),(90000854,00000852,'B',000,'',00000000,'Cabrera',0,0),(90000855,00000853,'B',000,'',00000000,'California',0,0),(90000856,00000854,'B',000,'',00000000,'Capitanejo',0,0),(90000857,00000855,'B',000,'',00000000,'Carcasi',0,0),(90000858,00000856,'B',000,'',00000000,'Cepita',0,0),(90000859,00000857,'B',000,'',00000000,'Cerrito',0,0),(90000860,00000858,'B',000,'',00000000,'Charalá',0,0),(90000861,00000859,'B',000,'',00000000,'Charta',0,0),(90000862,00000860,'B',000,'',00000000,'Chima',0,0),(90000863,00000861,'B',000,'',00000000,'Chipatá',0,0),(90000864,00000862,'B',000,'',00000000,'Cimitarra',0,0),(90000865,00000863,'B',000,'',00000000,'Concepción',0,0),(90000866,00000864,'B',000,'',00000000,'Confines',0,0),(90000867,00000865,'B',000,'',00000000,'Contratación',0,0),(90000868,00000866,'B',000,'',00000000,'Coromoro',0,0),(90000869,00000867,'B',000,'',00000000,'Curití',0,0),(90000870,00000868,'B',000,'',00000000,'El Carmen',0,0),(90000871,00000869,'B',000,'',00000000,'El Guacamayo',0,0),(90000872,00000870,'B',000,'',00000000,'El Peñón',0,0),(90000873,00000871,'B',000,'',00000000,'El Playón',0,0),(90000874,00000872,'B',000,'',00000000,'Encino',0,0),(90000875,00000873,'B',000,'',00000000,'Enciso',0,0),(90000876,00000874,'B',000,'',00000000,'Florián',0,0),(90000877,00000875,'B',000,'',00000000,'Floridablanca',0,0),(90000878,00000876,'B',000,'',00000000,'Galán',0,0),(90000879,00000877,'B',000,'',00000000,'Gambita',0,0),(90000880,00000878,'B',000,'',00000000,'Girón',0,0),(90000881,00000879,'B',000,'',00000000,'Guaca',0,0),(90000882,00000880,'B',000,'',00000000,'Guadalupe',0,0),(90000883,00000881,'B',000,'',00000000,'Guapota',0,0),(90000884,00000882,'B',000,'',00000000,'Guavatá',0,0),(90000885,00000883,'B',000,'',00000000,'Guepsa',0,0),(90000886,00000884,'B',000,'',00000000,'Hato',0,0),(90000887,00000885,'B',000,'',00000000,'Jesús Maria',0,0),(90000888,00000886,'B',000,'',00000000,'Jordán',0,0),(90000889,00000887,'B',000,'',00000000,'La Belleza',0,0),(90000890,00000888,'B',000,'',00000000,'Landazuri',0,0),(90000891,00000889,'B',000,'',00000000,'La Paz',0,0),(90000892,00000890,'B',000,'',00000000,'Lebrija',0,0),(90000893,00000891,'B',000,'',00000000,'Los Santos',0,0),(90000894,00000892,'B',000,'',00000000,'Macaravita',0,0),(90000895,00000893,'B',000,'',00000000,'Málaga',0,0),(90000896,00000894,'B',000,'',00000000,'Matanza',0,0),(90000897,00000895,'B',000,'',00000000,'Mogotes',0,0),(90000898,00000896,'B',000,'',00000000,'Molagavita',0,0),(90000899,00000897,'B',000,'',00000000,'Ocamonte',0,0),(90000900,00000898,'B',000,'',00000000,'Oiba',0,0),(90000901,00000899,'B',000,'',00000000,'Onzaga',0,0),(90000902,00000900,'B',000,'',00000000,'Palmar',0,0),(90000903,00000901,'B',000,'',00000000,'Palmas del Socorro',0,0),(90000904,00000902,'B',000,'',00000000,'Páramo',0,0),(90000905,00000903,'B',000,'',00000000,'Piedecuesta',0,0),(90000906,00000904,'B',000,'',00000000,'Pinchote',0,0),(90000907,00000905,'B',000,'',00000000,'Puente Nacional',0,0),(90000908,00000906,'B',000,'',00000000,'Puerto Parra',0,0),(90000909,00000907,'B',000,'',00000000,'Puerto Wilches',0,0),(90000910,00000908,'B',000,'',00000000,'Rionegro',0,0),(90000911,00000909,'B',000,'',00000000,'Sabana de Torres',0,0),(90000912,00000910,'B',000,'',00000000,'San Andrés',0,0),(90000913,00000911,'B',000,'',00000000,'San Benito',0,0),(90000914,00000912,'B',000,'',00000000,'San Gil',0,0),(90000915,00000913,'B',000,'',00000000,'San Joaquín',0,0),(90000916,00000914,'B',000,'',00000000,'San José de Miranda',0,0),(90000917,00000915,'B',000,'',00000000,'San Miguel',0,0),(90000918,00000916,'B',000,'',00000000,'San Vicente de Chucurí',0,0),(90000919,00000917,'B',000,'',00000000,'Santa Bárbara',0,0),(90000920,00000918,'B',000,'',00000000,'Santa Helena',0,0),(90000921,00000919,'B',000,'',00000000,'Simacota',0,0),(90000922,00000920,'B',000,'',00000000,'Socorro',0,0),(90000923,00000921,'B',000,'',00000000,'Suaita',0,0),(90000924,00000922,'B',000,'',00000000,'Sucre',0,0),(90000925,00000923,'B',000,'',00000000,'Surata',0,0),(90000926,00000924,'B',000,'',00000000,'Tona',0,0),(90000927,00000925,'B',000,'',00000000,'Valle San José',0,0),(90000928,00000926,'B',000,'',00000000,'Vélez',0,0),(90000929,00000927,'B',000,'',00000000,'Vetas',0,0),(90000930,00000928,'B',000,'',00000000,'Villanueva',0,0),(90000931,00000929,'B',000,'',00000000,'Zapatoca',0,0),(90000932,00000930,'B',000,'',00000000,'Sincelejo',0,0),(90000933,00000931,'B',000,'',00000000,'Buenavista',0,0),(90000934,00000932,'B',000,'',00000000,'Caimito',0,0),(90000935,00000933,'B',000,'',00000000,'Coloso',0,0),(90000936,00000934,'B',000,'',00000000,'Corozal',0,0),(90000937,00000935,'B',000,'',00000000,'Chalán',0,0),(90000938,00000936,'B',000,'',00000000,'El Roble',0,0),(90000939,00000937,'B',000,'',00000000,'Galeras',0,0),(90000940,00000938,'B',000,'',00000000,'Guaranda',0,0),(90000941,00000939,'B',000,'',00000000,'La Unión',0,0),(90000942,00000940,'B',000,'',00000000,'Los Palmitos',0,0),(90000943,00000941,'B',000,'',00000000,'Majagual',0,0),(90000944,00000942,'B',000,'',00000000,'Morroa',0,0),(90000945,00000943,'B',000,'',00000000,'Ovejas',0,0),(90000946,00000944,'B',000,'',00000000,'Palmito',0,0),(90000947,00000945,'B',000,'',00000000,'Sampues',0,0),(90000948,00000946,'B',000,'',00000000,'San Benito Abad',0,0),(90000949,00000947,'B',000,'',00000000,'San Juan De Betulia',0,0),(90000950,00000948,'B',000,'',00000000,'San Marcos',0,0),(90000951,00000949,'B',000,'',00000000,'San Onofre',0,0),(90000952,00000950,'B',000,'',00000000,'San Pedro',0,0),(90000953,00000951,'B',000,'',00000000,'Sincé',0,0),(90000954,00000952,'B',000,'',00000000,'Sucre',0,0),(90000955,00000953,'B',000,'',00000000,'Tolú',0,0),(90000956,00000954,'B',000,'',00000000,'Toluviejo',0,0),(90000957,00000955,'B',000,'',00000000,'Ibagué',0,0),(90000958,00000956,'B',000,'',00000000,'Alpujarra',0,0),(90000959,00000957,'B',000,'',00000000,'Alvarado',0,0),(90000960,00000958,'B',000,'',00000000,'Ambalema',0,0),(90000961,00000959,'B',000,'',00000000,'Anzoategui',0,0),(90000962,00000960,'B',000,'',00000000,'Armero (Guayabal)',0,0),(90000963,00000961,'B',000,'',00000000,'Ataco',0,0),(90000964,00000962,'B',000,'',00000000,'Cajamarca',0,0),(90000965,00000963,'B',000,'',00000000,'Carmen de Apicalá',0,0),(90000966,00000964,'B',000,'',00000000,'Casabianca',0,0),(90000967,00000965,'B',000,'',00000000,'Chaparral',0,0),(90000968,00000966,'B',000,'',00000000,'Coello',0,0),(90000969,00000967,'B',000,'',00000000,'Coyaima',0,0),(90000970,00000968,'B',000,'',00000000,'Cunday',0,0),(90000971,00000969,'B',000,'',00000000,'Dolores',0,0),(90000972,00000970,'B',000,'',00000000,'Espinal',0,0),(90000973,00000971,'B',000,'',00000000,'Falán',0,0),(90000974,00000972,'B',000,'',00000000,'Flandes',0,0),(90000975,00000973,'B',000,'',00000000,'Fresno',0,0),(90000976,00000974,'B',000,'',00000000,'Guamo',0,0),(90000977,00000975,'B',000,'',00000000,'Herveo',0,0),(90000978,00000976,'B',000,'',00000000,'Honda',0,0),(90000979,00000977,'B',000,'',00000000,'Icononzo',0,0),(90000980,00000978,'B',000,'',00000000,'Lérida',0,0),(90000981,00000979,'B',000,'',00000000,'Líbano',0,0),(90000982,00000980,'B',000,'',00000000,'Mariquita',0,0),(90000983,00000981,'B',000,'',00000000,'Melgar',0,0),(90000984,00000982,'B',000,'',00000000,'Murillo',0,0),(90000985,00000983,'B',000,'',00000000,'Natagaima',0,0),(90000986,00000984,'B',000,'',00000000,'Ortega',0,0),(90000987,00000985,'B',000,'',00000000,'Palocabildo',0,0),(90000988,00000986,'B',000,'',00000000,'Piedras',0,0),(90000989,00000987,'B',000,'',00000000,'Planadas',0,0),(90000990,00000988,'B',000,'',00000000,'Prado',0,0),(90000991,00000989,'B',000,'',00000000,'Purificación',0,0),(90000992,00000990,'B',000,'',00000000,'Rioblanco',0,0),(90000993,00000991,'B',000,'',00000000,'Roncesvalles',0,0),(90000994,00000992,'B',000,'',00000000,'Rovira',0,0),(90000995,00000993,'B',000,'',00000000,'Saldaña',0,0),(90000996,00000994,'B',000,'',00000000,'San Antonio',0,0),(90000997,00000995,'B',000,'',00000000,'San Luis',0,0),(90000998,00000996,'B',000,'',00000000,'Santa Isabel',0,0),(90000999,00000997,'B',000,'',00000000,'Suárez',0,0),(90001000,00000998,'B',000,'',00000000,'Valle de San Juan',0,0),(90001001,00000999,'B',000,'',00000000,'Venadillo',0,0),(90001002,00001000,'B',000,'',00000000,'Villahermosa',0,0),(90001003,00001001,'B',000,'',00000000,'Villarrica',0,0),(90001004,00001002,'B',000,'',00000000,'Cali',0,0),(90001005,00001003,'B',000,'',00000000,'Alcalá',0,0),(90001006,00001004,'B',000,'',00000000,'Andalucía',0,0),(90001007,00001005,'B',000,'',00000000,'Ansermanuevo',0,0),(90001008,00001006,'B',000,'',00000000,'Argelia',0,0),(90001009,00001007,'B',000,'',00000000,'Bolívar',0,0),(90001010,00001008,'B',000,'',00000000,'Buenaventura',0,0),(90001011,00001009,'B',000,'',00000000,'Buga',0,0),(90001012,00001010,'B',000,'',00000000,'Bugalagrande',0,0),(90001013,00001011,'B',000,'',00000000,'Caicedonia',0,0),(90001014,00001012,'B',000,'',00000000,'Calima (Darien)',0,0),(90001015,00001013,'B',000,'',00000000,'Candelaria',0,0),(90001016,00001014,'B',000,'',00000000,'Cartago',0,0),(90001017,00001015,'B',000,'',00000000,'Dagua',0,0),(90001018,00001016,'B',000,'',00000000,'El Aguila',0,0),(90001019,00001017,'B',000,'',00000000,'El Cairo',0,0),(90001020,00001018,'B',000,'',00000000,'El Cerrito',0,0),(90001021,00001019,'B',000,'',00000000,'El Dovio',0,0),(90001022,00001020,'B',000,'',00000000,'Florida',0,0),(90001023,00001021,'B',000,'',00000000,'Ginebra',0,0),(90001024,00001022,'B',000,'',00000000,'Guacari',0,0),(90001025,00001023,'B',000,'',00000000,'Jamundí',0,0),(90001026,00001024,'B',000,'',00000000,'La Cumbre',0,0),(90001027,00001025,'B',000,'',00000000,'La Unión',0,0),(90001028,00001026,'B',000,'',00000000,'La Victoria',0,0),(90001029,00001027,'B',000,'',00000000,'Obando',0,0),(90001030,00001028,'B',000,'',00000000,'Palmira',0,0),(90001031,00001029,'B',000,'',00000000,'Pradera',0,0),(90001032,00001030,'B',000,'',00000000,'Restrepo',0,0),(90001033,00001031,'B',000,'',00000000,'Riofrío',0,0),(90001034,00001032,'B',000,'',00000000,'Roldanillo',0,0),(90001035,00001033,'B',000,'',00000000,'San Pedro',0,0),(90001036,00001034,'B',000,'',00000000,'Sevilla',0,0),(90001037,00001035,'B',000,'',00000000,'Toro',0,0),(90001038,00001036,'B',000,'',00000000,'Trujillo',0,0),(90001039,00001037,'B',000,'',00000000,'Tulúa',0,0),(90001040,00001038,'B',000,'',00000000,'Ulloa',0,0),(90001041,00001039,'B',000,'',00000000,'Versalles',0,0),(90001042,00001040,'B',000,'',00000000,'Vijes',0,0),(90001043,00001041,'B',000,'',00000000,'Yotoco',0,0),(90001044,00001042,'B',000,'',00000000,'Yumbo',0,0),(90001045,00001043,'B',000,'',00000000,'Zarzal',0,0),(90001046,00001044,'B',000,'',00000000,'Arauca',0,0),(90001047,00001045,'B',000,'',00000000,'Arauquita',0,0),(90001048,00001046,'B',000,'',00000000,'Cravo Norte',0,0),(90001049,00001047,'B',000,'',00000000,'Fortul',0,0),(90001050,00001048,'B',000,'',00000000,'Puerto Rondón',0,0),(90001051,00001049,'B',000,'',00000000,'Saravena',0,0),(90001052,00001050,'B',000,'',00000000,'Tame',0,0),(90001053,00001051,'B',000,'',00000000,'Yopal',0,0),(90001054,00001052,'B',000,'',00000000,'Aguazul',0,0),(90001055,00001053,'B',000,'',00000000,'Chameza',0,0),(90001056,00001054,'B',000,'',00000000,'Hato Corozal',0,0),(90001057,00001055,'B',000,'',00000000,'La Salina',0,0),(90001058,00001056,'B',000,'',00000000,'Maní',0,0),(90001059,00001057,'B',000,'',00000000,'Monterrey',0,0),(90001060,00001058,'B',000,'',00000000,'Nunchia',0,0),(90001061,00001059,'B',000,'',00000000,'Orocue',0,0),(90001062,00001060,'B',000,'',00000000,'Paz de Ariporo',0,0),(90001063,00001061,'B',000,'',00000000,'Pore',0,0),(90001064,00001062,'B',000,'',00000000,'Recetor',0,0),(90001065,00001063,'B',000,'',00000000,'Sabanalarga',0,0),(90001066,00001064,'B',000,'',00000000,'Sacama',0,0),(90001067,00001065,'B',000,'',00000000,'San Luis de Palenque',0,0),(90001068,00001066,'B',000,'',00000000,'Tamara',0,0),(90001069,00001067,'B',000,'',00000000,'Tauramena',0,0),(90001070,00001068,'B',000,'',00000000,'Trinidad',0,0),(90001071,00001069,'B',000,'',00000000,'Villanueva',0,0),(90001072,00001070,'B',000,'',00000000,'Mocoa',0,0),(90001073,00001071,'B',000,'',00000000,'Colón',0,0),(90001074,00001072,'B',000,'',00000000,'Orito',0,0),(90001075,00001073,'B',000,'',00000000,'Puerto Asís',0,0),(90001076,00001074,'B',000,'',00000000,'Puerto Caycedo',0,0),(90001077,00001075,'B',000,'',00000000,'Puerto Guzmán',0,0),(90001078,00001076,'B',000,'',00000000,'Puerto Leguízamo',0,0),(90001079,00001077,'B',000,'',00000000,'Sibundoy',0,0),(90001080,00001078,'B',000,'',00000000,'San Francisco',0,0),(90001081,00001079,'B',000,'',00000000,'San Miguel',0,0),(90001082,00001080,'B',000,'',00000000,'Santiago',0,0),(90001083,00001081,'B',000,'',00000000,'Valle del Guamuez',0,0),(90001084,00001082,'B',000,'',00000000,'Villagarzón',0,0),(90001085,00001083,'B',000,'',00000000,'San Andrés',0,0),(90001086,00001084,'B',000,'',00000000,'Providencia',0,0),(90001087,00001085,'B',000,'',00000000,'Leticia',0,0),(90001088,00001086,'B',000,'',00000000,'El Encanto',0,0),(90001089,00001087,'B',000,'',00000000,'La Chorrera',0,0),(90001090,00001088,'B',000,'',00000000,'La Pedrera',0,0),(90001091,00001089,'B',000,'',00000000,'Miriti-Parana',0,0),(90001092,00001090,'B',000,'',00000000,'Puerto Nariño',0,0),(90001093,00001091,'B',000,'',00000000,'Puerto Santander',0,0),(90001094,00001092,'B',000,'',00000000,'Tarapaca',0,0),(90001095,00001093,'B',000,'',00000000,'Puerto Inirida',0,0),(90001096,00001094,'B',000,'',00000000,'Barranco Minas',0,0),(90001097,00001095,'B',000,'',00000000,'San Felipe',0,0),(90001098,00001096,'B',000,'',00000000,'Puerto Colombia',0,0),(90001099,00001097,'B',000,'',00000000,'La Guadalupe',0,0),(90001100,00001098,'B',000,'',00000000,'Cacahual',0,0),(90001101,00001099,'B',000,'',00000000,'Pana Pana',0,0),(90001102,00001100,'B',000,'',00000000,'Morichal Nuevo',0,0),(90001103,00001101,'B',000,'',00000000,'San José del Guaviare',0,0),(90001104,00001102,'B',000,'',00000000,'Calamar',0,0),(90001105,00001103,'B',000,'',00000000,'El Retorno',0,0),(90001106,00001104,'B',000,'',00000000,'Miraflores',0,0),(90001107,00001105,'B',000,'',00000000,'Mitu',0,0),(90001108,00001106,'B',000,'',00000000,'Carurú',0,0),(90001109,00001107,'B',000,'',00000000,'Pacoa',0,0),(90001110,00001108,'B',000,'',00000000,'Taraira',0,0),(90001111,00001109,'B',000,'',00000000,'Papunaua',0,0),(90001112,00001110,'B',000,'',00000000,'Yavarate',0,0),(90001113,00001111,'B',000,'',00000000,'Puerto Carreño',0,0),(90001114,00001112,'B',000,'',00000000,'La Primavera',0,0),(90001115,00001113,'B',000,'',00000000,'Santa Rosalía',0,0),(90001116,00001114,'B',000,'',00000000,'Cumaribo',0,0);
/*!40000 ALTER TABLE `pance_localidades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `pance_menu_actas`
--

DROP TABLE IF EXISTS `pance_menu_actas`;
/*!50001 DROP VIEW IF EXISTS `pance_menu_actas`*/;
/*!50001 CREATE TABLE `pance_menu_actas` (
  `id` int(6) unsigned zerofill,
  `TIPO_ACTA` varchar(12),
  `FECHA_ENTREGA_ACTA` date,
  `VALOR_FACTURAR` decimal(12,2),
  `FACTURA_CONSORCIADO` varchar(12),
  `PAGO_CLIENTE` varchar(9),
  `PAGO_CONSORCIADO` varchar(9),
  `PORCENTAJE_MANO_OBRA` decimal(5,2),
  `PORCENTAJE_MATERIALES` decimal(5,2)
) */;

--
-- Temporary table structure for view `pance_menu_actividades_economicas`
--

DROP TABLE IF EXISTS `pance_menu_actividades_economicas`;
/*!50001 DROP VIEW IF EXISTS `pance_menu_actividades_economicas`*/;
/*!50001 CREATE TABLE `pance_menu_actividades_economicas` (
  `id` smallint(4) unsigned zerofill,
  `CODIGO_DIAN` smallint(4) unsigned zerofill,
  `CODIGO_INTERNO` smallint(4) unsigned zerofill,
  `DESCRIPCION` varchar(255)
) */;

--
-- Temporary table structure for view `pance_menu_agenda`
--

DROP TABLE IF EXISTS `pance_menu_agenda`;
/*!50001 DROP VIEW IF EXISTS `pance_menu_agenda`*/;
/*!50001 CREATE TABLE `pance_menu_agenda` (
  `id` smallint(3) unsigned zerofill,
  `HORA_INICIO` time,
  `TITULO` varchar(255),
  `id_usuario` smallint(4) unsigned zerofill,
  `id_fecha` date
) */;

--
-- Temporary table structure for view `pance_menu_barrios`
--

DROP TABLE IF EXISTS `pance_menu_barrios`;
/*!50001 DROP VIEW IF EXISTS `pance_menu_barrios`*/;
/*!50001 CREATE TABLE `pance_menu_barrios` (
  `id` int(8) unsigned zerofill,
  `NOMBRE` varchar(255),
  `MUNICIPIO` varchar(255),
  `DEPARTAMENTO` varchar(255),
  `PAIS` varchar(255)
) */;

--
-- Temporary table structure for view `pance_menu_bodegas`
--

DROP TABLE IF EXISTS `pance_menu_bodegas`;
/*!50001 DROP VIEW IF EXISTS `pance_menu_bodegas`*/;
/*!50001 CREATE TABLE `pance_menu_bodegas` (
  `id` mediumint(5) unsigned zerofill,
  `CODIGO` smallint(4) unsigned zerofill,
  `NOMBRE` varchar(60),
  `DESCRIPCION` varchar(60),
  `SUCURSAL` varchar(60)
) */;

--
-- Temporary table structure for view `pance_menu_cargos`
--

DROP TABLE IF EXISTS `pance_menu_cargos`;
/*!50001 DROP VIEW IF EXISTS `pance_menu_cargos`*/;
/*!50001 CREATE TABLE `pance_menu_cargos` (
  `id` smallint(3) unsigned zerofill,
  `CODIGO` smallint(3) unsigned zerofill,
  `NOMBRE` varchar(50),
  `INTERNO` varchar(7)
) */;

--
-- Temporary table structure for view `pance_menu_clientes`
--

DROP TABLE IF EXISTS `pance_menu_clientes`;
/*!50001 DROP VIEW IF EXISTS `pance_menu_clientes`*/;
/*!50001 CREATE TABLE `pance_menu_clientes` (
  `id` int(8) unsigned zerofill,
  `DOCUMENTO_CLIENTE` varchar(12),
  `CLIENTE` varchar(329)
) */;

--
-- Temporary table structure for view `pance_menu_conexiones`
--

DROP TABLE IF EXISTS `pance_menu_conexiones`;
/*!50001 DROP VIEW IF EXISTS `pance_menu_conexiones`*/;
/*!50001 CREATE TABLE `pance_menu_conexiones` (
  `id` int(8) unsigned zerofill,
  `FECHA` varchar(10),
  `HORA` varchar(11),
  `USUARIO` char(50),
  `IP` varchar(15),
  `PROXY` varchar(15),
  `id_fecha` datetime
) */;

--
-- Temporary table structure for view `pance_menu_corregimientos`
--

DROP TABLE IF EXISTS `pance_menu_corregimientos`;
/*!50001 DROP VIEW IF EXISTS `pance_menu_corregimientos`*/;
/*!50001 CREATE TABLE `pance_menu_corregimientos` (
  `id` int(8) unsigned zerofill,
  `NOMBRE` varchar(255),
  `MUNICIPIO` varchar(255),
  `DEPARTAMENTO` varchar(255),
  `PAIS` varchar(255)
) */;

--
-- Temporary table structure for view `pance_menu_cotizaciones`
--

DROP TABLE IF EXISTS `pance_menu_cotizaciones`;
/*!50001 DROP VIEW IF EXISTS `pance_menu_cotizaciones`*/;
/*!50001 CREATE TABLE `pance_menu_cotizaciones` (
  `id` int(6) unsigned zerofill,
  `NUMERO_COTIZACION` varbinary(18),
  `NUMERO_COTIZACION_CONSORCIADO` varchar(15),
  `SEDE` varchar(60),
  `MUNICIPIO` varchar(255),
  `SUCURSAL` varchar(60),
  `FECHA_INGRESO` date,
  `DESCRIPCION` varchar(255),
  `CONTACTO` varchar(255),
  `ESTADO` varchar(11)
) */;

--
-- Temporary table structure for view `pance_menu_departamentos`
--

DROP TABLE IF EXISTS `pance_menu_departamentos`;
/*!50001 DROP VIEW IF EXISTS `pance_menu_departamentos`*/;
/*!50001 CREATE TABLE `pance_menu_departamentos` (
  `id` int(5) unsigned zerofill,
  `CODIGO_DANE` varchar(2),
  `NOMBRE` varchar(255),
  `PAIS` varchar(255)
) */;

--
-- Temporary table structure for view `pance_menu_empresas`
--

DROP TABLE IF EXISTS `pance_menu_empresas`;
/*!50001 DROP VIEW IF EXISTS `pance_menu_empresas`*/;
/*!50001 CREATE TABLE `pance_menu_empresas` (
  `id` smallint(3) unsigned zerofill,
  `CODIGO_EMPRESA` smallint(3) unsigned zerofill,
  `RAZON_SOCIAL` varchar(60),
  `ACTIVO` varchar(8),
  `REGIMEN` varchar(12),
  `TERCERO` varchar(12)
) */;

--
-- Temporary table structure for view `pance_menu_impresoras`
--

DROP TABLE IF EXISTS `pance_menu_impresoras`;
/*!50001 DROP VIEW IF EXISTS `pance_menu_impresoras`*/;
/*!50001 CREATE TABLE `pance_menu_impresoras` (
  `id` smallint(3) unsigned zerofill,
  `NOMBRE_COLA` varchar(50),
  `DESCRIPCION` varchar(50)
) */;

--
-- Temporary table structure for view `pance_menu_municipios`
--

DROP TABLE IF EXISTS `pance_menu_municipios`;
/*!50001 DROP VIEW IF EXISTS `pance_menu_municipios`*/;
/*!50001 CREATE TABLE `pance_menu_municipios` (
  `id` int(8) unsigned zerofill,
  `CODIGO_DANE` varchar(5),
  `NOMBRE` varchar(255),
  `DEPARTAMENTO` varchar(255),
  `PAIS` varchar(255)
) */;

--
-- Temporary table structure for view `pance_menu_notas`
--

DROP TABLE IF EXISTS `pance_menu_notas`;
/*!50001 DROP VIEW IF EXISTS `pance_menu_notas`*/;
/*!50001 CREATE TABLE `pance_menu_notas` (
  `id` smallint(3) unsigned zerofill,
  `NOTAS` varchar(255)
) */;

--
-- Temporary table structure for view `pance_menu_paises`
--

DROP TABLE IF EXISTS `pance_menu_paises`;
/*!50001 DROP VIEW IF EXISTS `pance_menu_paises`*/;
/*!50001 CREATE TABLE `pance_menu_paises` (
  `id` smallint(3) unsigned zerofill,
  `CODIGO_ISO` varchar(2),
  `NOMBRE` varchar(255)
) */;

--
-- Temporary table structure for view `pance_menu_perfiles`
--

DROP TABLE IF EXISTS `pance_menu_perfiles`;
/*!50001 DROP VIEW IF EXISTS `pance_menu_perfiles`*/;
/*!50001 CREATE TABLE `pance_menu_perfiles` (
  `id` smallint(4) unsigned zerofill,
  `CODIGO` smallint(4) unsigned zerofill,
  `NOMBRE` varchar(255)
) */;

--
-- Temporary table structure for view `pance_menu_preferencias`
--

DROP TABLE IF EXISTS `pance_menu_preferencias`;
/*!50001 DROP VIEW IF EXISTS `pance_menu_preferencias`*/;
/*!50001 CREATE TABLE `pance_menu_preferencias` (
  `id` int(8) unsigned zerofill,
  `TIPO` varchar(10),
  `USUARIO` varchar(50)
) */;

--
-- Temporary table structure for view `pance_menu_preferencias_globales`
--

DROP TABLE IF EXISTS `pance_menu_preferencias_globales`;
/*!50001 DROP VIEW IF EXISTS `pance_menu_preferencias_globales`*/;
/*!50001 CREATE TABLE `pance_menu_preferencias_globales` (
  `id` mediumint(5) unsigned zerofill,
  `CODIGO` smallint(3) unsigned zerofill,
  `NOMBRE` varchar(60)
) */;

--
-- Temporary table structure for view `pance_menu_privilegios`
--

DROP TABLE IF EXISTS `pance_menu_privilegios`;
/*!50001 DROP VIEW IF EXISTS `pance_menu_privilegios`*/;
/*!50001 CREATE TABLE `pance_menu_privilegios` (
  `id` int(8) unsigned zerofill,
  `USUARIO` char(50),
  `SUCURSAL` varchar(60)
) */;

--
-- Temporary table structure for view `pance_menu_profesiones_oficios`
--

DROP TABLE IF EXISTS `pance_menu_profesiones_oficios`;
/*!50001 DROP VIEW IF EXISTS `pance_menu_profesiones_oficios`*/;
/*!50001 CREATE TABLE `pance_menu_profesiones_oficios` (
  `id` smallint(4) unsigned zerofill,
  `CODIGO_DANE` smallint(4) unsigned zerofill,
  `CODIGO_INTERNO` smallint(4) unsigned zerofill,
  `DESCRIPCION` varchar(255)
) */;

--
-- Temporary table structure for view `pance_menu_registro_ingresos`
--

DROP TABLE IF EXISTS `pance_menu_registro_ingresos`;
/*!50001 DROP VIEW IF EXISTS `pance_menu_registro_ingresos`*/;
/*!50001 CREATE TABLE `pance_menu_registro_ingresos` (
  `id` int(8) unsigned zerofill,
  `FECHA_INGRESO` date,
  `NUMERO_COTIZACION` int(8) unsigned zerofill,
  `DESCRIPCION` varchar(255)
) */;

--
-- Temporary table structure for view `pance_menu_registro_obras`
--

DROP TABLE IF EXISTS `pance_menu_registro_obras`;
/*!50001 DROP VIEW IF EXISTS `pance_menu_registro_obras`*/;
/*!50001 CREATE TABLE `pance_menu_registro_obras` (
  `id` int(6) unsigned zerofill,
  `FECHA_INGRESO` date,
  `SEDE` varchar(60),
  `MUNICIPIO` varchar(255),
  `DESCRIPCION` varchar(255),
  `SUCURSAL` varchar(60),
  `TIPO_SOLICITUD` varchar(20)
) */;

--
-- Temporary table structure for view `pance_menu_reporte_visitas`
--

DROP TABLE IF EXISTS `pance_menu_reporte_visitas`;
/*!50001 DROP VIEW IF EXISTS `pance_menu_reporte_visitas`*/;
/*!50001 CREATE TABLE `pance_menu_reporte_visitas` (
  `id` int(8) unsigned zerofill,
  `FECHA_INGRESO` date,
  `SEDE` varchar(60),
  `MUNICIPIO` varchar(255),
  `DESCRIPCION` varchar(255),
  `SUCURSAL` varchar(60),
  `TIPO_SOLICITUD` varchar(20),
  `NOTIFICADO` varchar(2),
  `ESTADO_COTIZACION` varchar(11)
) */;

--
-- Temporary table structure for view `pance_menu_requerimientos_clientes`
--

DROP TABLE IF EXISTS `pance_menu_requerimientos_clientes`;
/*!50001 DROP VIEW IF EXISTS `pance_menu_requerimientos_clientes`*/;
/*!50001 CREATE TABLE `pance_menu_requerimientos_clientes` (
  `id` int(8) unsigned zerofill,
  `FECHA_INGRESO` date,
  `SEDE` varchar(60),
  `MUNICIPIO` varchar(255),
  `DESCRIPCION` varchar(255),
  `SUCURSAL` varchar(60),
  `TIPO_SOLICITUD` varchar(20),
  `NOTIFICADO` varchar(2),
  `ESTADO_COTIZACION` varchar(11)
) */;

--
-- Temporary table structure for view `pance_menu_secciones`
--

DROP TABLE IF EXISTS `pance_menu_secciones`;
/*!50001 DROP VIEW IF EXISTS `pance_menu_secciones`*/;
/*!50001 CREATE TABLE `pance_menu_secciones` (
  `id` int(8) unsigned zerofill,
  `CODIGO` smallint(4) unsigned zerofill,
  `NOMBRE` varchar(60),
  `DESCRIPCION` varchar(60),
  `BODEGA` varchar(60)
) */;

--
-- Temporary table structure for view `pance_menu_sedes_clientes`
--

DROP TABLE IF EXISTS `pance_menu_sedes_clientes`;
/*!50001 DROP VIEW IF EXISTS `pance_menu_sedes_clientes`*/;
/*!50001 CREATE TABLE `pance_menu_sedes_clientes` (
  `id` int(8) unsigned zerofill,
  `CLIENTE` varchar(329),
  `CONSORCIADO` varchar(60),
  `SEDE` varchar(60),
  `CONTACTO` varchar(255),
  `CORREO_ELECTRONICO` varchar(100)
) */;

--
-- Temporary table structure for view `pance_menu_servidores`
--

DROP TABLE IF EXISTS `pance_menu_servidores`;
/*!50001 DROP VIEW IF EXISTS `pance_menu_servidores`*/;
/*!50001 CREATE TABLE `pance_menu_servidores` (
  `id` smallint(3) unsigned zerofill,
  `IP` varchar(15),
  `NOMBRE_NETBIOS` varchar(50),
  `NOMBRE_TCPIP` varchar(50)
) */;

--
-- Temporary table structure for view `pance_menu_sucursales`
--

DROP TABLE IF EXISTS `pance_menu_sucursales`;
/*!50001 DROP VIEW IF EXISTS `pance_menu_sucursales`*/;
/*!50001 CREATE TABLE `pance_menu_sucursales` (
  `id` mediumint(5) unsigned zerofill,
  `CODIGO` smallint(3) unsigned zerofill,
  `NOMBRE` varchar(60),
  `EMPRESA` varchar(60),
  `TERCERO` varchar(12)
) */;

--
-- Temporary table structure for view `pance_menu_terceros`
--

DROP TABLE IF EXISTS `pance_menu_terceros`;
/*!50001 DROP VIEW IF EXISTS `pance_menu_terceros`*/;
/*!50001 CREATE TABLE `pance_menu_terceros` (
  `id` int(8) unsigned zerofill,
  `DOCUMENTO_IDENTIDAD` varchar(12),
  `PRIMER_NOMBRE` varchar(15),
  `SEGUNDO_NOMBRE` varchar(15),
  `PRIMER_APELLIDO` varchar(20),
  `SEGUNDO_APELLIDO` varchar(20),
  `NOMBRE_COMPLETO` varchar(268)
) */;

--
-- Temporary table structure for view `pance_menu_terminales`
--

DROP TABLE IF EXISTS `pance_menu_terminales`;
/*!50001 DROP VIEW IF EXISTS `pance_menu_terminales`*/;
/*!50001 CREATE TABLE `pance_menu_terminales` (
  `id` smallint(3) unsigned zerofill,
  `IP` varchar(15),
  `NOMBRE_NETBIOS` varchar(50),
  `NOMBRE_TCPIP` varchar(50)
) */;

--
-- Temporary table structure for view `pance_menu_tipos_bodegas`
--

DROP TABLE IF EXISTS `pance_menu_tipos_bodegas`;
/*!50001 DROP VIEW IF EXISTS `pance_menu_tipos_bodegas`*/;
/*!50001 CREATE TABLE `pance_menu_tipos_bodegas` (
  `id` smallint(3) unsigned zerofill,
  `NOMBRE` varchar(60),
  `DESCRIPCION` varchar(60)
) */;

--
-- Temporary table structure for view `pance_menu_tipos_documento_identidad`
--

DROP TABLE IF EXISTS `pance_menu_tipos_documento_identidad`;
/*!50001 DROP VIEW IF EXISTS `pance_menu_tipos_documento_identidad`*/;
/*!50001 CREATE TABLE `pance_menu_tipos_documento_identidad` (
  `id` smallint(3) unsigned zerofill,
  `CODIGO_DIAN` smallint(3) unsigned zerofill,
  `CODIGO_INTERNO` smallint(3) unsigned zerofill,
  `DESCRIPCION` varchar(255)
) */;

--
-- Temporary table structure for view `pance_menu_usuarios`
--

DROP TABLE IF EXISTS `pance_menu_usuarios`;
/*!50001 DROP VIEW IF EXISTS `pance_menu_usuarios`*/;
/*!50001 CREATE TABLE `pance_menu_usuarios` (
  `id` smallint(4) unsigned zerofill,
  `USUARIO` varchar(12),
  `NOMBRE` char(50)
) */;

--
-- Table structure for table `pance_modulos`
--

DROP TABLE IF EXISTS `pance_modulos`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `pance_modulos` (
  `id` char(32) NOT NULL COMMENT 'Identificador del mÃ³dulo',
  `nombre` varchar(32) NOT NULL COMMENT 'Nombre del mÃ³dulo',
  `descripcion` varchar(255) NOT NULL COMMENT 'DescripciÃ³n del mÃ³dulo',
  `carpeta` varchar(255) default NULL COMMENT 'Carpeta donde estarÃ¡n almacenados los componentes del mÃ³dulo',
  `url` varchar(255) default NULL COMMENT 'URL del mÃ³dulo',
  `version` char(10) default NULL COMMENT 'VersiÃ³n del mÃ³dulo (Formato: AAAAMMDD+consecutivo. Ej: 2008031501)',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `pance_modulos`
--

LOCK TABLES `pance_modulos` WRITE;
/*!40000 ALTER TABLE `pance_modulos` DISABLE KEYS */;
INSERT INTO `pance_modulos` VALUES ('ADMINISTRACION','Administración','Operaciones y datos de control relacionados con el acceso a la aplicación y la integración de sus componentes','administracion',NULL,NULL),('CLIENTES','Clientes','Operaciones y datos de control relacionados con los clientes','clientes',NULL,NULL),('EXTENSIONES','Extensiones','Extensiones de uso general de la aplicación','extensiones',NULL,NULL);
/*!40000 ALTER TABLE `pance_modulos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pance_municipios`
--

DROP TABLE IF EXISTS `pance_municipios`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `pance_municipios` (
  `id` int(8) unsigned zerofill NOT NULL auto_increment COMMENT 'Consecutivo interno para la base de datos',
  `id_departamento` int(5) unsigned zerofill NOT NULL COMMENT 'Consecutivo interno para la base de datos para del paÃ­s al cual pertenece',
  `codigo_dane` varchar(3) default NULL COMMENT 'CÃ³digo DANE',
  `codigo_interno` int(4) unsigned zerofill default NULL COMMENT 'CÃ³digo para uso interno de la empresa (opcional)',
  `nombre` varchar(255) NOT NULL default '' COMMENT 'Nombre completo',
  `capital` enum('0','1') default '0' COMMENT 'El municipio es la capital del departamento: 0=No, 1=Si',
  `comunas` tinyint(3) NOT NULL default '0' COMMENT 'NÃºmero de comunas en las cuales se divide el municipio',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id_departamento` (`id_departamento`,`codigo_dane`),
  UNIQUE KEY `codigo_interno` (`codigo_interno`),
  CONSTRAINT `municipio_departamento` FOREIGN KEY (`id_departamento`) REFERENCES `pance_departamentos` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1115 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `pance_municipios`
--

LOCK TABLES `pance_municipios` WRITE;
/*!40000 ALTER TABLE `pance_municipios` DISABLE KEYS */;
INSERT INTO `pance_municipios` VALUES (00000001,00001,'001',NULL,'Medellín','0',0),(00000002,00001,'002',NULL,'Abejorral','0',0),(00000003,00001,'004',NULL,'Abriaqui','0',0),(00000004,00001,'021',NULL,'Alejandría','0',0),(00000005,00001,'030',NULL,'Amaga','0',0),(00000006,00001,'031',NULL,'Amalfi','0',0),(00000007,00001,'034',NULL,'Andes','0',0),(00000008,00001,'036',NULL,'Angelopolis','0',0),(00000009,00001,'038',NULL,'Angostura','0',0),(00000010,00001,'040',NULL,'Anorí','0',0),(00000011,00001,'042',NULL,'Antioquia','0',0),(00000012,00001,'044',NULL,'Anza','0',0),(00000013,00001,'045',NULL,'Apartado','0',0),(00000014,00001,'051',NULL,'Arboletes','0',0),(00000015,00001,'055',NULL,'Argelia','0',0),(00000016,00001,'059',NULL,'Armenia','0',0),(00000017,00001,'079',NULL,'Barbosa','0',0),(00000018,00001,'086',NULL,'Belmira','0',0),(00000019,00001,'088',NULL,'Bello','0',0),(00000020,00001,'091',NULL,'Betania','0',0),(00000021,00001,'093',NULL,'Betulia','0',0),(00000022,00001,'101',NULL,'Bolívar','0',0),(00000023,00001,'107',NULL,'Briceño','0',0),(00000024,00001,'113',NULL,'Buritica','0',0),(00000025,00001,'120',NULL,'Cáceres','0',0),(00000026,00001,'125',NULL,'Caicedo','0',0),(00000027,00001,'129',NULL,'Caldas','0',0),(00000028,00001,'134',NULL,'Campamento','0',0),(00000029,00001,'138',NULL,'Cañasgordas','0',0),(00000030,00001,'142',NULL,'Caracolí','0',0),(00000031,00001,'145',NULL,'Caramanta','0',0),(00000032,00001,'147',NULL,'Carepa','0',0),(00000033,00001,'148',NULL,'Carmen De Viboral','0',0),(00000034,00001,'150',NULL,'Carolina','0',0),(00000035,00001,'154',NULL,'Caucasia','0',0),(00000036,00001,'172',NULL,'Chigorodó','0',0),(00000037,00001,'190',NULL,'Cisneros','0',0),(00000038,00001,'197',NULL,'Cocorná','0',0),(00000039,00001,'206',NULL,'Concepción','0',0),(00000040,00001,'209',NULL,'Concordia','0',0),(00000041,00001,'212',NULL,'Copacabana','0',0),(00000042,00001,'234',NULL,'Dabeiba','0',0),(00000043,00001,'237',NULL,'Don Matías','0',0),(00000044,00001,'240',NULL,'Ebejico','0',0),(00000045,00001,'250',NULL,'El Bagre','0',0),(00000046,00001,'264',NULL,'Entrerrios','0',0),(00000047,00001,'266',NULL,'Envigado','0',0),(00000048,00001,'282',NULL,'Fredonia','0',0),(00000049,00001,'284',NULL,'Frontino','0',0),(00000050,00001,'306',NULL,'Giraldo','0',0),(00000051,00001,'308',NULL,'Girardota','0',0),(00000052,00001,'310',NULL,'Gómez Plata','0',0),(00000053,00001,'313',NULL,'Granada','0',0),(00000054,00001,'315',NULL,'Guadalupe','0',0),(00000055,00001,'318',NULL,'Guarne','0',0),(00000056,00001,'321',NULL,'Guatapé','0',0),(00000057,00001,'347',NULL,'Heliconia','0',0),(00000058,00001,'353',NULL,'Hispania','0',0),(00000059,00001,'360',NULL,'Itagui','0',0),(00000060,00001,'361',NULL,'Ituango','0',0),(00000061,00001,'364',NULL,'Jardín','0',0),(00000062,00001,'368',NULL,'Jericó','0',0),(00000063,00001,'376',NULL,'La Ceja','0',0),(00000064,00001,'380',NULL,'La Estrella','0',0),(00000065,00001,'390',NULL,'La Pintada','0',0),(00000066,00001,'400',NULL,'La Unión','0',0),(00000067,00001,'411',NULL,'Liborina','0',0),(00000068,00001,'425',NULL,'Maceo','0',0),(00000069,00001,'440',NULL,'Marinilla','0',0),(00000070,00001,'467',NULL,'Montebello','0',0),(00000071,00001,'475',NULL,'Murindó','0',0),(00000072,00001,'480',NULL,'Mutatá','0',0),(00000073,00001,'483',NULL,'Nariño','0',0),(00000074,00001,'490',NULL,'Necoclí','0',0),(00000075,00001,'495',NULL,'Nechí','0',0),(00000076,00001,'501',NULL,'Olaya','0',0),(00000077,00001,'541',NULL,'Peñol','0',0),(00000078,00001,'543',NULL,'Peque','0',0),(00000079,00001,'576',NULL,'Pueblorrico','0',0),(00000080,00001,'579',NULL,'Puerto Berrío','0',0),(00000081,00001,'585',NULL,'Puerto Nare (La Magdalena)','0',0),(00000082,00001,'591',NULL,'Puerto Triunfo','0',0),(00000083,00001,'604',NULL,'Remedios','0',0),(00000084,00001,'607',NULL,'Retiro','0',0),(00000085,00001,'615',NULL,'Rionegro','0',0),(00000086,00001,'628',NULL,'Sabanalarga','0',0),(00000087,00001,'631',NULL,'Sabaneta','0',0),(00000088,00001,'642',NULL,'Salgar','0',0),(00000089,00001,'647',NULL,'San Andrés','0',0),(00000090,00001,'649',NULL,'San Carlos','0',0),(00000091,00001,'652',NULL,'San Francisco','0',0),(00000092,00001,'656',NULL,'San Jerónimo','0',0),(00000093,00001,'658',NULL,'San José De La Montaña','0',0),(00000094,00001,'659',NULL,'San Juan De Uraba','0',0),(00000095,00001,'660',NULL,'San Luis','0',0),(00000096,00001,'664',NULL,'San Pedro','0',0),(00000097,00001,'665',NULL,'San Pedro De Uraba','0',0),(00000098,00001,'667',NULL,'San Rafael','0',0),(00000099,00001,'670',NULL,'San Roque','0',0),(00000100,00001,'674',NULL,'San Vicente','0',0),(00000101,00001,'679',NULL,'Santa Bárbara','0',0),(00000102,00001,'686',NULL,'Santa Rosa De Osos','0',0),(00000103,00001,'690',NULL,'Santo Domingo','0',0),(00000104,00001,'697',NULL,'Santuario','0',0),(00000105,00001,'736',NULL,'Segovia','0',0),(00000106,00001,'756',NULL,'Sonson','0',0),(00000107,00001,'761',NULL,'Sopetrán','0',0),(00000108,00001,'789',NULL,'Támesis','0',0),(00000109,00001,'790',NULL,'Taraza','0',0),(00000110,00001,'792',NULL,'Tarso','0',0),(00000111,00001,'809',NULL,'Titiribí','0',0),(00000112,00001,'819',NULL,'Toledo','0',0),(00000113,00001,'837',NULL,'Turbo','0',0),(00000114,00001,'842',NULL,'Uramita','0',0),(00000115,00001,'847',NULL,'Urrao','0',0),(00000116,00001,'854',NULL,'Valdivia','0',0),(00000117,00001,'856',NULL,'Valparaíso','0',0),(00000118,00001,'858',NULL,'Vegachi','0',0),(00000119,00001,'861',NULL,'Venecia','0',0),(00000120,00001,'873',NULL,'Vigía Del Fuerte','0',0),(00000121,00001,'885',NULL,'Yali','0',0),(00000122,00001,'887',NULL,'Yarumal','0',0),(00000123,00001,'890',NULL,'Yolombó','0',0),(00000124,00001,'893',NULL,'Yondó','0',0),(00000125,00001,'895',NULL,'Zaragoza','0',0),(00000126,00002,'001',NULL,'Barranquilla','0',0),(00000127,00002,'078',NULL,'Baranoa','0',0),(00000128,00002,'137',NULL,'Campo de la Cruz','0',0),(00000129,00002,'141',NULL,'Candelaria','0',0),(00000130,00002,'296',NULL,'Galapa','0',0),(00000131,00002,'372',NULL,'Juan De Acosta','0',0),(00000132,00002,'421',NULL,'Luruaco','0',0),(00000133,00002,'433',NULL,'Malambo','0',0),(00000134,00002,'436',NULL,'Manatí','0',0),(00000135,00002,'520',NULL,'Palmar De Varela','0',0),(00000136,00002,'549',NULL,'Piojó','0',0),(00000137,00002,'558',NULL,'Polo Nuevo','0',0),(00000138,00002,'560',NULL,'Ponedera','0',0),(00000139,00002,'573',NULL,'Puerto Colombia','0',0),(00000140,00002,'606',NULL,'Repelón','0',0),(00000141,00002,'634',NULL,'Sabanagrande','0',0),(00000142,00002,'638',NULL,'Sabanalarga','0',0),(00000143,00002,'675',NULL,'Santa Lucia','0',0),(00000144,00002,'685',NULL,'Santo Tomas','0',0),(00000145,00002,'758',NULL,'Soledad','0',0),(00000146,00002,'770',NULL,'Suan','0',0),(00000147,00002,'832',NULL,'Tubará','0',0),(00000148,00002,'849',NULL,'Usiacurí','0',0),(00000149,00003,'001',NULL,'Bogotá','0',0),(00000150,00004,'001',NULL,'Cartagena','0',0),(00000151,00004,'006',NULL,'Achí','0',0),(00000152,00004,'030',NULL,'Altos del Rosario','0',0),(00000153,00004,'042',NULL,'Arenal','0',0),(00000154,00004,'052',NULL,'Arjona','0',0),(00000155,00004,'062',NULL,'Arroyohondo','0',0),(00000156,00004,'074',NULL,'Barranco de Loba','0',0),(00000157,00004,'140',NULL,'Calamar','0',0),(00000158,00004,'160',NULL,'Cantagallo','0',0),(00000159,00004,'188',NULL,'Cicuco','0',0),(00000160,00004,'212',NULL,'Córdoba','0',0),(00000161,00004,'222',NULL,'Clemencia','0',0),(00000162,00004,'244',NULL,'El Carmen de Bolívar','0',0),(00000163,00004,'248',NULL,'El Guamo','0',0),(00000164,00004,'268',NULL,'El Peñon','0',0),(00000165,00004,'300',NULL,'Hatillo de Loba','0',0),(00000166,00004,'430',NULL,'Magangue','0',0),(00000167,00004,'433',NULL,'Mahates','0',0),(00000168,00004,'440',NULL,'Margarita','0',0),(00000169,00004,'442',NULL,'Maria la Baja','0',0),(00000170,00004,'458',NULL,'Montecristo','0',0),(00000171,00004,'468',NULL,'Mompos','0',0),(00000172,00004,'473',NULL,'Morales','0',0),(00000173,00004,'549',NULL,'Pinillos','0',0),(00000174,00004,'580',NULL,'Regidor','0',0),(00000175,00004,'600',NULL,'Río Viejo','0',0),(00000176,00004,'620',NULL,'San Cristobal','0',0),(00000177,00004,'647',NULL,'San Estanislao','0',0),(00000178,00004,'650',NULL,'San Fernando','0',0),(00000179,00004,'654',NULL,'San Jacinto','0',0),(00000180,00004,'655',NULL,'San Jacinto del Cauca','0',0),(00000181,00004,'657',NULL,'San Juan Nepomuceno','0',0),(00000182,00004,'667',NULL,'San Martín de Loba','0',0),(00000183,00004,'670',NULL,'San Pablo','0',0),(00000184,00004,'673',NULL,'Santa Catalina','0',0),(00000185,00004,'683',NULL,'Santa Rosa','0',0),(00000186,00004,'688',NULL,'Santa Rosa del Sur','0',0),(00000187,00004,'744',NULL,'Simití','0',0),(00000188,00004,'760',NULL,'Soplaviento','0',0),(00000189,00004,'780',NULL,'Talaigua Nuevo','0',0),(00000190,00004,'810',NULL,'Tiquisio','0',0),(00000191,00004,'836',NULL,'Turbaco','0',0),(00000192,00004,'838',NULL,'Turbaná','0',0),(00000193,00004,'873',NULL,'Villanueva','0',0),(00000194,00004,'894',NULL,'Zambrano','0',0),(00000195,00005,'001',NULL,'Tunja','0',0),(00000196,00005,'022',NULL,'Almeida','0',0),(00000197,00005,'047',NULL,'Aquitania','0',0),(00000198,00005,'051',NULL,'Arcabuco','0',0),(00000199,00005,'087',NULL,'Belén','0',0),(00000200,00005,'090',NULL,'Berbeo','0',0),(00000201,00005,'092',NULL,'Beteitiva','0',0),(00000202,00005,'097',NULL,'Boavita','0',0),(00000203,00005,'104',NULL,'Boyacá','0',0),(00000204,00005,'106',NULL,'Briceño','0',0),(00000205,00005,'109',NULL,'Buenavista','0',0),(00000206,00005,'114',NULL,'Busbanza','0',0),(00000207,00005,'131',NULL,'Caldas','0',0),(00000208,00005,'135',NULL,'Campohermoso','0',0),(00000209,00005,'162',NULL,'Cerinza','0',0),(00000210,00005,'172',NULL,'Chinavita','0',0),(00000211,00005,'176',NULL,'Chiquinquirá','0',0),(00000212,00005,'180',NULL,'Chiscas','0',0),(00000213,00005,'183',NULL,'Chita','0',0),(00000214,00005,'185',NULL,'Chitaraque','0',0),(00000215,00005,'187',NULL,'Chivata','0',0),(00000216,00005,'189',NULL,'Ciénega','0',0),(00000217,00005,'204',NULL,'Combita','0',0),(00000218,00005,'212',NULL,'Coper','0',0),(00000219,00005,'215',NULL,'Corrales','0',0),(00000220,00005,'218',NULL,'Covarachia','0',0),(00000221,00005,'223',NULL,'Cubara','0',0),(00000222,00005,'224',NULL,'Cucaita','0',0),(00000223,00005,'226',NULL,'Cuitiva','0',0),(00000224,00005,'232',NULL,'Chiquiza','0',0),(00000225,00005,'236',NULL,'Chivor','0',0),(00000226,00005,'238',NULL,'Duitama','0',0),(00000227,00005,'244',NULL,'El Cocuy','0',0),(00000228,00005,'248',NULL,'El Espino','0',0),(00000229,00005,'272',NULL,'Firavitoba','0',0),(00000230,00005,'276',NULL,'Floresta','0',0),(00000231,00005,'293',NULL,'Gachantiva','0',0),(00000232,00005,'296',NULL,'Gameza','0',0),(00000233,00005,'299',NULL,'Garagoa','0',0),(00000234,00005,'317',NULL,'Guacamayas','0',0),(00000235,00005,'322',NULL,'Guateque','0',0),(00000236,00005,'325',NULL,'Guayata','0',0),(00000237,00005,'332',NULL,'Guican','0',0),(00000238,00005,'362',NULL,'Iza','0',0),(00000239,00005,'367',NULL,'Jenesano','0',0),(00000240,00005,'368',NULL,'Jericó','0',0),(00000241,00005,'377',NULL,'Labranzagrande','0',0),(00000242,00005,'380',NULL,'La Capilla','0',0),(00000243,00005,'401',NULL,'La Victoria','0',0),(00000244,00005,'403',NULL,'La Uvita','0',0),(00000245,00005,'407',NULL,'Leiva','0',0),(00000246,00005,'425',NULL,'Macanal','0',0),(00000247,00005,'442',NULL,'Maripi','0',0),(00000248,00005,'455',NULL,'Miraflores','0',0),(00000249,00005,'464',NULL,'Mongua','0',0),(00000250,00005,'466',NULL,'Monguí','0',0),(00000251,00005,'469',NULL,'Moniquirá','0',0),(00000252,00005,'476',NULL,'Motavita','0',0),(00000253,00005,'480',NULL,'Muzo','0',0),(00000254,00005,'491',NULL,'Nobsa','0',0),(00000255,00005,'494',NULL,'Nuevo Colón','0',0),(00000256,00005,'500',NULL,'Oicata','0',0),(00000257,00005,'507',NULL,'Otanche','0',0),(00000258,00005,'511',NULL,'Pachavita','0',0),(00000259,00005,'514',NULL,'Páez','0',0),(00000260,00005,'516',NULL,'Paipa','0',0),(00000261,00005,'518',NULL,'Pajarito','0',0),(00000262,00005,'522',NULL,'Panqueba','0',0),(00000263,00005,'531',NULL,'Pauna','0',0),(00000264,00005,'533',NULL,'Paya','0',0),(00000265,00005,'537',NULL,'Paz del Río','0',0),(00000266,00005,'542',NULL,'Pesca','0',0),(00000267,00005,'550',NULL,'Pisba','0',0),(00000268,00005,'572',NULL,'Puerto Boyacá','0',0),(00000269,00005,'580',NULL,'Quipama','0',0),(00000270,00005,'599',NULL,'Ramiriquí','0',0),(00000271,00005,'600',NULL,'Ráquira','0',0),(00000272,00005,'621',NULL,'Rondón','0',0),(00000273,00005,'632',NULL,'Saboya','0',0),(00000274,00005,'638',NULL,'Sáchica','0',0),(00000275,00005,'646',NULL,'Samacá','0',0),(00000276,00005,'660',NULL,'San Eduardo','0',0),(00000277,00005,'664',NULL,'San José de Pare','0',0),(00000278,00005,'667',NULL,'San Luis de Gaceno','0',0),(00000279,00005,'673',NULL,'San Mateo','0',0),(00000280,00005,'676',NULL,'San Miguel de Sema','0',0),(00000281,00005,'681',NULL,'San Pablo de Borbur','0',0),(00000282,00005,'686',NULL,'Santana','0',0),(00000283,00005,'690',NULL,'Santa Maria','0',0),(00000284,00005,'693',NULL,'Santa Rosa de Viterbo','0',0),(00000285,00005,'696',NULL,'Santa Sofía','0',0),(00000286,00005,'720',NULL,'Sativanorte','0',0),(00000287,00005,'723',NULL,'Sativasur','0',0),(00000288,00005,'740',NULL,'Siachoque','0',0),(00000289,00005,'753',NULL,'Soata','0',0),(00000290,00005,'755',NULL,'Socota','0',0),(00000291,00005,'757',NULL,'Socha','0',0),(00000292,00005,'759',NULL,'Sogamoso','0',0),(00000293,00005,'761',NULL,'Somondoco','0',0),(00000294,00005,'762',NULL,'Sora','0',0),(00000295,00005,'763',NULL,'Sotaquirá','0',0),(00000296,00005,'764',NULL,'Soracá','0',0),(00000297,00005,'774',NULL,'Susacon','0',0),(00000298,00005,'776',NULL,'Sutamarchán','0',0),(00000299,00005,'778',NULL,'Sutatenza','0',0),(00000300,00005,'790',NULL,'Tasco','0',0),(00000301,00005,'798',NULL,'Tenza','0',0),(00000302,00005,'804',NULL,'Tibaná','0',0),(00000303,00005,'806',NULL,'Tibasosa','0',0),(00000304,00005,'808',NULL,'Tinjacá','0',0),(00000305,00005,'810',NULL,'Tipacoque','0',0),(00000306,00005,'814',NULL,'Toca','0',0),(00000307,00005,'816',NULL,'Toguí','0',0),(00000308,00005,'820',NULL,'Topaga','0',0),(00000309,00005,'822',NULL,'Tota','0',0),(00000310,00005,'832',NULL,'Tunungua','0',0),(00000311,00005,'835',NULL,'Turmequé','0',0),(00000312,00005,'837',NULL,'Tuta','0',0),(00000313,00005,'839',NULL,'Tutasa','0',0),(00000314,00005,'842',NULL,'Umbita','0',0),(00000315,00005,'861',NULL,'Ventaquemada','0',0),(00000316,00005,'879',NULL,'Viracacha','0',0),(00000317,00005,'897',NULL,'Zetaquira','0',0),(00000318,00006,'001',NULL,'Manizales','0',0),(00000319,00006,'013',NULL,'Aguadas','0',0),(00000320,00006,'042',NULL,'Anserma','0',0),(00000321,00006,'050',NULL,'Aranzazu','0',0),(00000322,00006,'088',NULL,'Belalcazar','0',0),(00000323,00006,'174',NULL,'Chinchiná','0',0),(00000324,00006,'272',NULL,'Filadelfia','0',0),(00000325,00006,'380',NULL,'La Dorada','0',0),(00000326,00006,'388',NULL,'La Merced','0',0),(00000327,00006,'433',NULL,'Manzanares','0',0),(00000328,00006,'442',NULL,'Marmato','0',0),(00000329,00006,'444',NULL,'Marquetalia','0',0),(00000330,00006,'446',NULL,'Marulanda','0',0),(00000331,00006,'486',NULL,'Neira','0',0),(00000332,00006,'495',NULL,'Norcasia','0',0),(00000333,00006,'513',NULL,'Pacora','0',0),(00000334,00006,'524',NULL,'Palestina','0',0),(00000335,00006,'541',NULL,'Pensilvania','0',0),(00000336,00006,'614',NULL,'Riosucio','0',0),(00000337,00006,'616',NULL,'Risaralda','0',0),(00000338,00006,'653',NULL,'Salamina','0',0),(00000339,00006,'662',NULL,'Samana','0',0),(00000340,00006,'665',NULL,'San Jose','0',0),(00000341,00006,'777',NULL,'Supía','0',0),(00000342,00006,'867',NULL,'Victoria','0',0),(00000343,00006,'873',NULL,'Villamaría','0',0),(00000344,00006,'877',NULL,'Viterbo','0',0),(00000345,00007,'001',NULL,'Florencia','0',0),(00000346,00007,'029',NULL,'Albania','0',0),(00000347,00007,'094',NULL,'Belén Andaquies','0',0),(00000348,00007,'150',NULL,'Cartagena del Chaira','0',0),(00000349,00007,'205',NULL,'Curillo','0',0),(00000350,00007,'247',NULL,'El Doncello','0',0),(00000351,00007,'256',NULL,'El Paujil','0',0),(00000352,00007,'410',NULL,'La Montañita','0',0),(00000353,00007,'460',NULL,'Milán','0',0),(00000354,00007,'479',NULL,'Morelia','0',0),(00000355,00007,'592',NULL,'Puerto Rico','0',0),(00000356,00007,'610',NULL,'San José de Fragua','0',0),(00000357,00007,'753',NULL,'SanVicente del Caguan','0',0),(00000358,00007,'756',NULL,'Solano','0',0),(00000359,00007,'785',NULL,'Solita','0',0),(00000360,00007,'860',NULL,'Valparaíso','0',0),(00000361,00008,'001',NULL,'Popayán','0',0),(00000362,00008,'022',NULL,'Almaguer','0',0),(00000363,00008,'050',NULL,'Argelia','0',0),(00000364,00008,'075',NULL,'Balboa','0',0),(00000365,00008,'100',NULL,'Bolívar','0',0),(00000366,00008,'110',NULL,'Buenos Aires','0',0),(00000367,00008,'130',NULL,'Cajibio','0',0),(00000368,00008,'137',NULL,'Caldono','0',0),(00000369,00008,'142',NULL,'Caloto','0',0),(00000370,00008,'212',NULL,'Corinto','0',0),(00000371,00008,'256',NULL,'El Tambo','0',0),(00000372,00008,'290',NULL,'Florencia','0',0),(00000373,00008,'318',NULL,'Guapi','0',0),(00000374,00008,'355',NULL,'Inza','0',0),(00000375,00008,'364',NULL,'Jambaló','0',0),(00000376,00008,'392',NULL,'La Sierra','0',0),(00000377,00008,'397',NULL,'La Vega','0',0),(00000378,00008,'418',NULL,'López','0',0),(00000379,00008,'450',NULL,'Mercaderes','0',0),(00000380,00008,'455',NULL,'Miranda','0',0),(00000381,00008,'473',NULL,'Morales','0',0),(00000382,00008,'513',NULL,'Padilla','0',0),(00000383,00008,'517',NULL,'Páez','0',0),(00000384,00008,'532',NULL,'Patia (El Bordo)','0',0),(00000385,00008,'533',NULL,'Piamonte','0',0),(00000386,00008,'548',NULL,'Piendamo','0',0),(00000387,00008,'573',NULL,'Puerto Tejada','0',0),(00000388,00008,'585',NULL,'Purace','0',0),(00000389,00008,'622',NULL,'Rosas','0',0),(00000390,00008,'693',NULL,'San Sebastián','0',0),(00000391,00008,'698',NULL,'Santander de Quilichao','0',0),(00000392,00008,'701',NULL,'Santa Rosa','0',0),(00000393,00008,'743',NULL,'Silvia','0',0),(00000394,00008,'760',NULL,'Sotara','0',0),(00000395,00008,'780',NULL,'Suárez','0',0),(00000396,00008,'785',NULL,'Sucre','0',0),(00000397,00008,'807',NULL,'Timbío','0',0),(00000398,00008,'809',NULL,'Timbiquí','0',0),(00000399,00008,'821',NULL,'Toribio','0',0),(00000400,00008,'824',NULL,'Totoro','0',0),(00000401,00008,'845',NULL,'Villa Rica','0',0),(00000402,00009,'001',NULL,'Valledupar','0',0),(00000403,00009,'011',NULL,'Aguachica','0',0),(00000404,00009,'013',NULL,'Agustín Codazzi','0',0),(00000405,00009,'032',NULL,'Astrea','0',0),(00000406,00009,'045',NULL,'Becerril','0',0),(00000407,00009,'060',NULL,'Bosconia','0',0),(00000408,00009,'175',NULL,'Chimichagua','0',0),(00000409,00009,'178',NULL,'Chiriguaná','0',0),(00000410,00009,'228',NULL,'Curumaní','0',0),(00000411,00009,'238',NULL,'El Copey','0',0),(00000412,00009,'250',NULL,'El Paso','0',0),(00000413,00009,'295',NULL,'Gamarra','0',0),(00000414,00009,'310',NULL,'González','0',0),(00000415,00009,'383',NULL,'La Gloria','0',0),(00000416,00009,'400',NULL,'La Jagua Ibirico','0',0),(00000417,00009,'443',NULL,'Manaure Balcón Del Cesar','0',0),(00000418,00009,'517',NULL,'Pailitas','0',0),(00000419,00009,'550',NULL,'Pelaya','0',0),(00000420,00009,'570',NULL,'Pueblo Bello','0',0),(00000421,00009,'614',NULL,'Río De Oro','0',0),(00000422,00009,'621',NULL,'Robles (La Paz)','0',0),(00000423,00009,'710',NULL,'San Alberto','0',0),(00000424,00009,'750',NULL,'San Diego','0',0),(00000425,00009,'770',NULL,'San Martín','0',0),(00000426,00009,'787',NULL,'Tamalameque','0',0),(00000427,00010,'001',NULL,'Montería','0',0),(00000428,00010,'068',NULL,'Ayapel','0',0),(00000429,00010,'079',NULL,'Buenavista','0',0),(00000430,00010,'090',NULL,'Canalete','0',0),(00000431,00010,'162',NULL,'Cereté','0',0),(00000432,00010,'168',NULL,'Chima','0',0),(00000433,00010,'182',NULL,'Chinú','0',0),(00000434,00010,'189',NULL,'Cienaga De Oro','0',0),(00000435,00010,'300',NULL,'Cotorra','0',0),(00000436,00010,'350',NULL,'La Apartada','0',0),(00000437,00010,'417',NULL,'Lorica','0',0),(00000438,00010,'419',NULL,'Los Córdobas','0',0),(00000439,00010,'464',NULL,'Momil','0',0),(00000440,00010,'466',NULL,'Montelíbano','0',0),(00000441,00010,'500',NULL,'Moñitos','0',0),(00000442,00010,'555',NULL,'Planeta Rica','0',0),(00000443,00010,'570',NULL,'Pueblo Nuevo','0',0),(00000444,00010,'574',NULL,'Puerto Escondido','0',0),(00000445,00010,'580',NULL,'Puerto Libertador','0',0),(00000446,00010,'586',NULL,'Purísima','0',0),(00000447,00010,'660',NULL,'Sahagún','0',0),(00000448,00010,'670',NULL,'San Andrés Sotavento','0',0),(00000449,00010,'672',NULL,'San Antero','0',0),(00000450,00010,'675',NULL,'San Bernardo Viento','0',0),(00000451,00010,'678',NULL,'San Carlos','0',0),(00000452,00010,'686',NULL,'San Pelayo','0',0),(00000453,00010,'807',NULL,'Tierralta','0',0),(00000454,00010,'855',NULL,'Valencia','0',0),(00000455,00010,'991',NULL,'Cerromatoso','0',0),(00000456,00011,'001',NULL,'Agua de Dios','0',0),(00000457,00011,'019',NULL,'Alban','0',0),(00000458,00011,'035',NULL,'Anapoima','0',0),(00000459,00011,'040',NULL,'Anolaima','0',0),(00000460,00011,'053',NULL,'Arbelaez','0',0),(00000461,00011,'086',NULL,'Beltrán','0',0),(00000462,00011,'095',NULL,'Bituima','0',0),(00000463,00011,'099',NULL,'Bojacá','0',0),(00000464,00011,'120',NULL,'Cabrera','0',0),(00000465,00011,'123',NULL,'Cachipay','0',0),(00000466,00011,'126',NULL,'Cajicá','0',0),(00000467,00011,'148',NULL,'Caparrapí','0',0),(00000468,00011,'151',NULL,'Caqueza','0',0),(00000469,00011,'154',NULL,'Carmen de Carupa','0',0),(00000470,00011,'168',NULL,'Chaguaní','0',0),(00000471,00011,'175',NULL,'Chia','0',0),(00000472,00011,'178',NULL,'Chipaque','0',0),(00000473,00011,'181',NULL,'Choachí','0',0),(00000474,00011,'183',NULL,'Chocontá','0',0),(00000475,00011,'200',NULL,'Cogua','0',0),(00000476,00011,'214',NULL,'Cota','0',0),(00000477,00011,'224',NULL,'Cucunubá','0',0),(00000478,00011,'245',NULL,'El Colegio','0',0),(00000479,00011,'258',NULL,'El Peñón','0',0),(00000480,00011,'260',NULL,'El Rosal','0',0),(00000481,00011,'269',NULL,'Facatativa','0',0),(00000482,00011,'279',NULL,'Fómeque','0',0),(00000483,00011,'281',NULL,'Fosca','0',0),(00000484,00011,'286',NULL,'Funza','0',0),(00000485,00011,'288',NULL,'Fúquene','0',0),(00000486,00011,'290',NULL,'Fusagasuga','0',0),(00000487,00011,'293',NULL,'Gachalá','0',0),(00000488,00011,'295',NULL,'Gachancipá','0',0),(00000489,00011,'297',NULL,'Gacheta','0',0),(00000490,00011,'299',NULL,'Gama','0',0),(00000491,00011,'307',NULL,'Girardot','0',0),(00000492,00011,'312',NULL,'Granada','0',0),(00000493,00011,'317',NULL,'Guachetá','0',0),(00000494,00011,'320',NULL,'Guaduas','0',0),(00000495,00011,'322',NULL,'Guasca','0',0),(00000496,00011,'324',NULL,'Guataquí','0',0),(00000497,00011,'326',NULL,'Guatavita','0',0),(00000498,00011,'328',NULL,'Guayabal de Siquima','0',0),(00000499,00011,'335',NULL,'Guayabetal','0',0),(00000500,00011,'339',NULL,'Gutiérrez','0',0),(00000501,00011,'368',NULL,'Jerusalén','0',0),(00000502,00011,'372',NULL,'Junín','0',0),(00000503,00011,'377',NULL,'La Calera','0',0),(00000504,00011,'386',NULL,'La Mesa','0',0),(00000505,00011,'394',NULL,'La Palma','0',0),(00000506,00011,'398',NULL,'La Peña','0',0),(00000507,00011,'402',NULL,'La Vega','0',0),(00000508,00011,'407',NULL,'Lenguazaque','0',0),(00000509,00011,'426',NULL,'Machetá','0',0),(00000510,00011,'430',NULL,'Madrid','0',0),(00000511,00011,'436',NULL,'Manta','0',0),(00000512,00011,'438',NULL,'Medina','0',0),(00000513,00011,'473',NULL,'Mosquera','0',0),(00000514,00011,'483',NULL,'Nariño','0',0),(00000515,00011,'486',NULL,'Nemocón','0',0),(00000516,00011,'488',NULL,'Nilo','0',0),(00000517,00011,'489',NULL,'Nimaima','0',0),(00000518,00011,'491',NULL,'Nocaima','0',0),(00000519,00011,'506',NULL,'Ospina Pérez','0',0),(00000520,00011,'513',NULL,'Pacho','0',0),(00000521,00011,'518',NULL,'Paime','0',0),(00000522,00011,'524',NULL,'Pandi','0',0),(00000523,00011,'530',NULL,'Paratebueno','0',0),(00000524,00011,'535',NULL,'Pasca','0',0),(00000525,00011,'572',NULL,'Puerto Salgar','0',0),(00000526,00011,'580',NULL,'Pulí','0',0),(00000527,00011,'592',NULL,'Quebradanegra','0',0),(00000528,00011,'594',NULL,'Quetame','0',0),(00000529,00011,'596',NULL,'Quipile','0',0),(00000530,00011,'599',NULL,'Rafael Reyes','0',0),(00000531,00011,'612',NULL,'Ricaurte','0',0),(00000532,00011,'645',NULL,'SanAntonio delTequendama','0',0),(00000533,00011,'649',NULL,'San Bernardo','0',0),(00000534,00011,'653',NULL,'San Cayetano','0',0),(00000535,00011,'658',NULL,'San Francisco','0',0),(00000536,00011,'662',NULL,'San Juan de Rioseco','0',0),(00000537,00011,'718',NULL,'Sasaima','0',0),(00000538,00011,'736',NULL,'Sesquilé','0',0),(00000539,00011,'740',NULL,'Sibaté','0',0),(00000540,00011,'743',NULL,'Silvania','0',0),(00000541,00011,'745',NULL,'Simijaca','0',0),(00000542,00011,'754',NULL,'Soacha','0',0),(00000543,00011,'758',NULL,'Sopo','0',0),(00000544,00011,'769',NULL,'Subachoque','0',0),(00000545,00011,'772',NULL,'Suesca','0',0),(00000546,00011,'777',NULL,'Supatá','0',0),(00000547,00011,'779',NULL,'Susa','0',0),(00000548,00011,'781',NULL,'Sutatausa','0',0),(00000549,00011,'785',NULL,'Tabio','0',0),(00000550,00011,'793',NULL,'Tausa','0',0),(00000551,00011,'797',NULL,'Tena','0',0),(00000552,00011,'799',NULL,'Tenjo','0',0),(00000553,00011,'805',NULL,'Tibacuy','0',0),(00000554,00011,'807',NULL,'Tibirita','0',0),(00000555,00011,'815',NULL,'Tocaima','0',0),(00000556,00011,'817',NULL,'Tocancipá','0',0),(00000557,00011,'823',NULL,'Topaipí','0',0),(00000558,00011,'839',NULL,'Ubalá','0',0),(00000559,00011,'841',NULL,'Ubaque','0',0),(00000560,00011,'843',NULL,'Ubaté','0',0),(00000561,00011,'845',NULL,'Une','0',0),(00000562,00011,'851',NULL,'Utica','0',0),(00000563,00011,'862',NULL,'Vergara','0',0),(00000564,00011,'867',NULL,'Viani','0',0),(00000565,00011,'871',NULL,'Villagomez','0',0),(00000566,00011,'873',NULL,'Villapinzón','0',0),(00000567,00011,'875',NULL,'Villeta','0',0),(00000568,00011,'878',NULL,'Viota','0',0),(00000569,00011,'885',NULL,'Yacopí','0',0),(00000570,00011,'898',NULL,'Zipacón','0',0),(00000571,00011,'899',NULL,'Zipaquirá','0',0),(00000572,00012,'001',NULL,'Quibdó','0',0),(00000573,00012,'006',NULL,'Acandí','0',0),(00000574,00012,'025',NULL,'Alto Baudó (Pie de Pato)','0',0),(00000575,00012,'050',NULL,'Atrato','0',0),(00000576,00012,'073',NULL,'Bagadó','0',0),(00000577,00012,'075',NULL,'Bahía Solano (Mutis)','0',0),(00000578,00012,'077',NULL,'Bajo Baudó (Pizarro)','0',0),(00000579,00012,'099',NULL,'Bojayá (Bellavista)','0',0),(00000580,00012,'135',NULL,'Cantóm de San Pablo','0',0),(00000581,00012,'150',NULL,'Carmen del Darién','0',0),(00000582,00012,'160',NULL,'Certegui','0',0),(00000583,00012,'205',NULL,'Condoto','0',0),(00000584,00012,'245',NULL,'El Carmen','0',0),(00000585,00012,'250',NULL,'Litoral del San Juan','0',0),(00000586,00012,'361',NULL,'Itsmina','0',0),(00000587,00012,'372',NULL,'Juradó','0',0),(00000588,00012,'413',NULL,'Lloró','0',0),(00000589,00012,'425',NULL,'Medio Atrato','0',0),(00000590,00012,'430',NULL,'Medio Baudó (Boca de Pepe)','0',0),(00000591,00012,'450',NULL,'Medio San Juan','0',0),(00000592,00012,'491',NULL,'Novita','0',0),(00000593,00012,'495',NULL,'Nuquí','0',0),(00000594,00012,'580',NULL,'Río Iro','0',0),(00000595,00012,'600',NULL,'Ríoi Quito','0',0),(00000596,00012,'615',NULL,'Riosucio','0',0),(00000597,00012,'660',NULL,'San José Del Palmar','0',0),(00000598,00012,'745',NULL,'Sipí','0',0),(00000599,00012,'787',NULL,'Tadó','0',0),(00000600,00012,'800',NULL,'Unguía','0',0),(00000601,00012,'810',NULL,'Unión Paramericana','0',0),(00000602,00013,'001',NULL,'Neiva','0',0),(00000603,00013,'006',NULL,'Acevedo','0',0),(00000604,00013,'013',NULL,'Agrado','0',0),(00000605,00013,'016',NULL,'Aipe','0',0),(00000606,00013,'020',NULL,'Algeciras','0',0),(00000607,00013,'026',NULL,'Altamira','0',0),(00000608,00013,'078',NULL,'Baraya','0',0),(00000609,00013,'132',NULL,'Campoalegre','0',0),(00000610,00013,'206',NULL,'Colombia','0',0),(00000611,00013,'244',NULL,'Elias','0',0),(00000612,00013,'298',NULL,'Garzón','0',0),(00000613,00013,'306',NULL,'Gigante','0',0),(00000614,00013,'319',NULL,'Guadalupe','0',0),(00000615,00013,'349',NULL,'Hobo','0',0),(00000616,00013,'357',NULL,'Iquira','0',0),(00000617,00013,'359',NULL,'Isnos','0',0),(00000618,00013,'378',NULL,'La Argentina','0',0),(00000619,00013,'396',NULL,'La Plata','0',0),(00000620,00013,'483',NULL,'Nataga','0',0),(00000621,00013,'503',NULL,'Oporapa','0',0),(00000622,00013,'518',NULL,'Paicol','0',0),(00000623,00013,'524',NULL,'Palermo','0',0),(00000624,00013,'530',NULL,'Palestina','0',0),(00000625,00013,'548',NULL,'Pital','0',0),(00000626,00013,'551',NULL,'Pitalito','0',0),(00000627,00013,'615',NULL,'Rivera','0',0),(00000628,00013,'660',NULL,'Saladoblanco','0',0),(00000629,00013,'668',NULL,'San Agustín','0',0),(00000630,00013,'676',NULL,'Santa Maria','0',0),(00000631,00013,'770',NULL,'Suaza','0',0),(00000632,00013,'791',NULL,'Tarqui','0',0),(00000633,00013,'797',NULL,'Tesalia','0',0),(00000634,00013,'799',NULL,'Tello','0',0),(00000635,00013,'801',NULL,'Teruel','0',0),(00000636,00013,'807',NULL,'Timana','0',0),(00000637,00013,'872',NULL,'Villavieja','0',0),(00000638,00013,'885',NULL,'Yaguara','0',0),(00000639,00014,'001',NULL,'Riohacha','0',0),(00000640,00014,'035',NULL,'Albania','0',0),(00000641,00014,'078',NULL,'Barrancas','0',0),(00000642,00014,'090',NULL,'Dibulla','0',0),(00000643,00014,'098',NULL,'Distraccion','0',0),(00000644,00014,'110',NULL,'El Molino','0',0),(00000645,00014,'279',NULL,'Fonseca','0',0),(00000646,00014,'378',NULL,'Hatonuevo','0',0),(00000647,00014,'420',NULL,'La Jagua del Pilar','0',0),(00000648,00014,'430',NULL,'Maicao','0',0),(00000649,00014,'560',NULL,'Manaure','0',0),(00000650,00014,'650',NULL,'San Juan del Cesar','0',0),(00000651,00014,'847',NULL,'Uribia','0',0),(00000652,00014,'855',NULL,'Urumita','0',0),(00000653,00014,'874',NULL,'Villanueva','0',0),(00000654,00015,'001',NULL,'Santa Marta','0',0),(00000655,00015,'030',NULL,'Algarrobo','0',0),(00000656,00015,'053',NULL,'Aracataca','0',0),(00000657,00015,'058',NULL,'Ariguani','0',0),(00000658,00015,'161',NULL,'Cerro San Antonio','0',0),(00000659,00015,'170',NULL,'Chivolo','0',0),(00000660,00015,'189',NULL,'Cienaga','0',0),(00000661,00015,'205',NULL,'Concordia','0',0),(00000662,00015,'245',NULL,'El Banco','0',0),(00000663,00015,'258',NULL,'El Piñon','0',0),(00000664,00015,'268',NULL,'El Reten','0',0),(00000665,00015,'288',NULL,'Fundacion','0',0),(00000666,00015,'318',NULL,'Guamal','0',0),(00000667,00015,'460',NULL,'Nueva Granada','0',0),(00000668,00015,'541',NULL,'Pedraza','0',0),(00000669,00015,'545',NULL,'Pijiño Del Carmen','0',0),(00000670,00015,'551',NULL,'Pivijay','0',0),(00000671,00015,'555',NULL,'Plato','0',0),(00000672,00015,'570',NULL,'Puebloviejo','0',0),(00000673,00015,'605',NULL,'Remolino','0',0),(00000674,00015,'660',NULL,'Sabanas De San Angel','0',0),(00000675,00015,'675',NULL,'Salamina','0',0),(00000676,00015,'692',NULL,'San Sebastian De Buenavista','0',0),(00000677,00015,'703',NULL,'San Zenon','0',0),(00000678,00015,'707',NULL,'Santa Ana','0',0),(00000679,00015,'720',NULL,'Santa Barbara De Pinto','0',0),(00000680,00015,'745',NULL,'Sitionuevo','0',0),(00000681,00015,'798',NULL,'Tenerife','0',0),(00000682,00015,'960',NULL,'Zapayan','0',0),(00000683,00015,'980',NULL,'Zona Bananera','0',0),(00000684,00016,'001',NULL,'Villavicencio','0',0),(00000685,00016,'006',NULL,'Acacias','0',0),(00000686,00016,'110',NULL,'Barranca de Upia','0',0),(00000687,00016,'124',NULL,'Cabuyaro','0',0),(00000688,00016,'150',NULL,'Castilla La Nueva','0',0),(00000689,00016,'223',NULL,'Cubarral','0',0),(00000690,00016,'226',NULL,'Cumaral','0',0),(00000691,00016,'245',NULL,'El Calvario','0',0),(00000692,00016,'251',NULL,'El Castillo','0',0),(00000693,00016,'270',NULL,'El Dorado','0',0),(00000694,00016,'287',NULL,'Fuente de Oro','0',0),(00000695,00016,'313',NULL,'Granada','0',0),(00000696,00016,'318',NULL,'Guamal','0',0),(00000697,00016,'325',NULL,'Mapiripán','0',0),(00000698,00016,'330',NULL,'Mesetas','0',0),(00000699,00016,'350',NULL,'La Macarena','0',0),(00000700,00016,'370',NULL,'La Uribe','0',0),(00000701,00016,'400',NULL,'Lejanías','0',0),(00000702,00016,'450',NULL,'Puerto Concordia','0',0),(00000703,00016,'568',NULL,'Puerto Gaitán','0',0),(00000704,00016,'573',NULL,'Puerto López','0',0),(00000705,00016,'577',NULL,'Puerto Lleras','0',0),(00000706,00016,'590',NULL,'Puerto Rico','0',0),(00000707,00016,'606',NULL,'Restrepo','0',0),(00000708,00016,'680',NULL,'San Carlos Guaroa','0',0),(00000709,00016,'683',NULL,'SanJuan de Arama','0',0),(00000710,00016,'686',NULL,'San Juanito','0',0),(00000711,00016,'689',NULL,'San Martín','0',0),(00000712,00016,'711',NULL,'Vista Hermosa','0',0),(00000713,00017,'001',NULL,'Pasto','0',0),(00000714,00017,'019',NULL,'Alban','0',0),(00000715,00017,'022',NULL,'Aldaña','0',0),(00000716,00017,'036',NULL,'Ancuya','0',0),(00000717,00017,'051',NULL,'Arboleda','0',0),(00000718,00017,'079',NULL,'Barbacoas','0',0),(00000719,00017,'083',NULL,'Belen','0',0),(00000720,00017,'110',NULL,'Buesaco','0',0),(00000721,00017,'203',NULL,'Colon(Genova)','0',0),(00000722,00017,'207',NULL,'Consaca','0',0),(00000723,00017,'210',NULL,'Contadero','0',0),(00000724,00017,'215',NULL,'Cordoba','0',0),(00000725,00017,'224',NULL,'Cuaspud','0',0),(00000726,00017,'227',NULL,'Cumbal','0',0),(00000727,00017,'233',NULL,'Cumbitara','0',0),(00000728,00017,'240',NULL,'Chachagui','0',0),(00000729,00017,'250',NULL,'El Charco','0',0),(00000730,00017,'254',NULL,'El Peñol','0',0),(00000731,00017,'256',NULL,'El Rosario','0',0),(00000732,00017,'258',NULL,'El Tablon','0',0),(00000733,00017,'260',NULL,'El Tambo','0',0),(00000734,00017,'287',NULL,'Funes','0',0),(00000735,00017,'317',NULL,'Guachucal','0',0),(00000736,00017,'320',NULL,'Guaitarilla','0',0),(00000737,00017,'323',NULL,'Gualmatan','0',0),(00000738,00017,'352',NULL,'Iles','0',0),(00000739,00017,'354',NULL,'Imues','0',0),(00000740,00017,'356',NULL,'Ipiales','0',0),(00000741,00017,'378',NULL,'La Cruz','0',0),(00000742,00017,'381',NULL,'La Florida','0',0),(00000743,00017,'385',NULL,'La Llanada','0',0),(00000744,00017,'390',NULL,'La Tola','0',0),(00000745,00017,'399',NULL,'La Union','0',0),(00000746,00017,'405',NULL,'Leiva','0',0),(00000747,00017,'411',NULL,'Linares','0',0),(00000748,00017,'418',NULL,'Los Andes','0',0),(00000749,00017,'427',NULL,'Magui','0',0),(00000750,00017,'435',NULL,'Mallama','0',0),(00000751,00017,'473',NULL,'Mosquera','0',0),(00000752,00017,'480',NULL,'Nariño','0',0),(00000753,00017,'490',NULL,'Olaya Herrera','0',0),(00000754,00017,'506',NULL,'Ospina','0',0),(00000755,00017,'520',NULL,'Pizarro','0',0),(00000756,00017,'540',NULL,'Policarpa','0',0),(00000757,00017,'560',NULL,'Potosi','0',0),(00000758,00017,'565',NULL,'Providencia','0',0),(00000759,00017,'573',NULL,'Puerres','0',0),(00000760,00017,'585',NULL,'Pupiales','0',0),(00000761,00017,'612',NULL,'Ricaurte','0',0),(00000762,00017,'621',NULL,'Roberto Payan','0',0),(00000763,00017,'678',NULL,'Samaniego','0',0),(00000764,00017,'683',NULL,'Sandona','0',0),(00000765,00017,'685',NULL,'San Bernardo','0',0),(00000766,00017,'687',NULL,'San Lorenzo','0',0),(00000767,00017,'693',NULL,'San Pablo','0',0),(00000768,00017,'694',NULL,'San Pedro De Cartago','0',0),(00000769,00017,'696',NULL,'Santa Barbara','0',0),(00000770,00017,'699',NULL,'Santacruz','0',0),(00000771,00017,'720',NULL,'Sapuyes','0',0),(00000772,00017,'786',NULL,'Taminango','0',0),(00000773,00017,'788',NULL,'Tangua','0',0),(00000774,00017,'835',NULL,'Tumaco','0',0),(00000775,00017,'838',NULL,'Tuquerres','0',0),(00000776,00017,'885',NULL,'Yacuanquer','0',0),(00000777,00018,'001',NULL,'Cúcuta','0',0),(00000778,00018,'003',NULL,'Abrego','0',0),(00000779,00018,'051',NULL,'Arboledas','0',0),(00000780,00018,'099',NULL,'Bochalema','0',0),(00000781,00018,'109',NULL,'Bucarasica','0',0),(00000782,00018,'125',NULL,'Cácota','0',0),(00000783,00018,'128',NULL,'Cáchira','0',0),(00000784,00018,'172',NULL,'Chinácota','0',0),(00000785,00018,'174',NULL,'Chitagá','0',0),(00000786,00018,'206',NULL,'Convención','0',0),(00000787,00018,'223',NULL,'Cucutilla','0',0),(00000788,00018,'239',NULL,'Durania','0',0),(00000789,00018,'245',NULL,'El Carmen','0',0),(00000790,00018,'250',NULL,'El Tarra','0',0),(00000791,00018,'261',NULL,'El Zulia','0',0),(00000792,00018,'313',NULL,'Gramalote','0',0),(00000793,00018,'344',NULL,'Hacari','0',0),(00000794,00018,'347',NULL,'Herrán','0',0),(00000795,00018,'377',NULL,'Labateca','0',0),(00000796,00018,'385',NULL,'La Esperanza','0',0),(00000797,00018,'398',NULL,'La Playa','0',0),(00000798,00018,'405',NULL,'Los Patios','0',0),(00000799,00018,'418',NULL,'Lourdes','0',0),(00000800,00018,'480',NULL,'Mutiscua','0',0),(00000801,00018,'498',NULL,'Ocaña','0',0),(00000802,00018,'518',NULL,'Pamplona','0',0),(00000803,00018,'520',NULL,'Pamplonita','0',0),(00000804,00018,'553',NULL,'Puerto Santander','0',0),(00000805,00018,'599',NULL,'Ragonvalia','0',0),(00000806,00018,'660',NULL,'Salazar','0',0),(00000807,00018,'670',NULL,'San Calixto','0',0),(00000808,00018,'673',NULL,'San Cayetano','0',0),(00000809,00018,'680',NULL,'Santiago','0',0),(00000810,00018,'720',NULL,'Sardinata','0',0),(00000811,00018,'743',NULL,'Silos','0',0),(00000812,00018,'800',NULL,'Teorama','0',0),(00000813,00018,'810',NULL,'Tibú','0',0),(00000814,00018,'820',NULL,'Toledo','0',0),(00000815,00018,'871',NULL,'Villacaro','0',0),(00000816,00018,'874',NULL,'Villa del Rosario','0',0),(00000817,00019,'001',NULL,'Armenia','0',0),(00000818,00019,'111',NULL,'Buenavista','0',0),(00000819,00019,'130',NULL,'Calarcá','0',0),(00000820,00019,'190',NULL,'Circasia','0',0),(00000821,00019,'212',NULL,'Córdoba','0',0),(00000822,00019,'272',NULL,'Filandia','0',0),(00000823,00019,'302',NULL,'Génova','0',0),(00000824,00019,'401',NULL,'La Tebaida','0',0),(00000825,00019,'470',NULL,'Montenegro','0',0),(00000826,00019,'548',NULL,'Pijao','0',0),(00000827,00019,'594',NULL,'Quimbaya','0',0),(00000828,00019,'690',NULL,'Salento','0',0),(00000829,00020,'001',NULL,'Pereira','0',0),(00000830,00020,'045',NULL,'Apia','0',0),(00000831,00020,'075',NULL,'Balboa','0',0),(00000832,00020,'088',NULL,'Belén de Umbría','0',0),(00000833,00020,'170',NULL,'Dos Quebradas','0',0),(00000834,00020,'318',NULL,'Guatica','0',0),(00000835,00020,'383',NULL,'La Celia','0',0),(00000836,00020,'400',NULL,'La Virginia','0',0),(00000837,00020,'440',NULL,'Marsella','0',0),(00000838,00020,'456',NULL,'Mistrato','0',0),(00000839,00020,'572',NULL,'Pueblo Rico','0',0),(00000840,00020,'594',NULL,'Quinchía','0',0),(00000841,00020,'682',NULL,'Santa Rosa de Cabal','0',0),(00000842,00020,'687',NULL,'Santuario','0',0),(00000843,00021,'001',NULL,'Bucaramanga','0',0),(00000844,00021,'013',NULL,'Aguada','0',0),(00000845,00021,'020',NULL,'Albania','0',0),(00000846,00021,'051',NULL,'Aratoca','0',0),(00000847,00021,'077',NULL,'Barbosa','0',0),(00000848,00021,'079',NULL,'Barichara','0',0),(00000849,00021,'081',NULL,'Barrancabermeja','0',0),(00000850,00021,'092',NULL,'Betulia','0',0),(00000851,00021,'101',NULL,'Bolívar','0',0),(00000852,00021,'121',NULL,'Cabrera','0',0),(00000853,00021,'132',NULL,'California','0',0),(00000854,00021,'147',NULL,'Capitanejo','0',0),(00000855,00021,'152',NULL,'Carcasi','0',0),(00000856,00021,'160',NULL,'Cepita','0',0),(00000857,00021,'162',NULL,'Cerrito','0',0),(00000858,00021,'167',NULL,'Charalá','0',0),(00000859,00021,'169',NULL,'Charta','0',0),(00000860,00021,'176',NULL,'Chima','0',0),(00000861,00021,'179',NULL,'Chipatá','0',0),(00000862,00021,'190',NULL,'Cimitarra','0',0),(00000863,00021,'207',NULL,'Concepción','0',0),(00000864,00021,'209',NULL,'Confines','0',0),(00000865,00021,'211',NULL,'Contratación','0',0),(00000866,00021,'217',NULL,'Coromoro','0',0),(00000867,00021,'229',NULL,'Curití','0',0),(00000868,00021,'235',NULL,'El Carmen','0',0),(00000869,00021,'245',NULL,'El Guacamayo','0',0),(00000870,00021,'250',NULL,'El Peñón','0',0),(00000871,00021,'255',NULL,'El Playón','0',0),(00000872,00021,'264',NULL,'Encino','0',0),(00000873,00021,'266',NULL,'Enciso','0',0),(00000874,00021,'271',NULL,'Florián','0',0),(00000875,00021,'276',NULL,'Floridablanca','0',0),(00000876,00021,'296',NULL,'Galán','0',0),(00000877,00021,'298',NULL,'Gambita','0',0),(00000878,00021,'307',NULL,'Girón','0',0),(00000879,00021,'318',NULL,'Guaca','0',0),(00000880,00021,'320',NULL,'Guadalupe','0',0),(00000881,00021,'322',NULL,'Guapota','0',0),(00000882,00021,'324',NULL,'Guavatá','0',0),(00000883,00021,'327',NULL,'Guepsa','0',0),(00000884,00021,'344',NULL,'Hato','0',0),(00000885,00021,'368',NULL,'Jesús Maria','0',0),(00000886,00021,'370',NULL,'Jordán','0',0),(00000887,00021,'377',NULL,'La Belleza','0',0),(00000888,00021,'385',NULL,'Landazuri','0',0),(00000889,00021,'397',NULL,'La Paz','0',0),(00000890,00021,'406',NULL,'Lebrija','0',0),(00000891,00021,'418',NULL,'Los Santos','0',0),(00000892,00021,'425',NULL,'Macaravita','0',0),(00000893,00021,'432',NULL,'Málaga','0',0),(00000894,00021,'444',NULL,'Matanza','0',0),(00000895,00021,'464',NULL,'Mogotes','0',0),(00000896,00021,'468',NULL,'Molagavita','0',0),(00000897,00021,'498',NULL,'Ocamonte','0',0),(00000898,00021,'500',NULL,'Oiba','0',0),(00000899,00021,'502',NULL,'Onzaga','0',0),(00000900,00021,'522',NULL,'Palmar','0',0),(00000901,00021,'524',NULL,'Palmas del Socorro','0',0),(00000902,00021,'533',NULL,'Páramo','0',0),(00000903,00021,'547',NULL,'Piedecuesta','0',0),(00000904,00021,'549',NULL,'Pinchote','0',0),(00000905,00021,'572',NULL,'Puente Nacional','0',0),(00000906,00021,'573',NULL,'Puerto Parra','0',0),(00000907,00021,'575',NULL,'Puerto Wilches','0',0),(00000908,00021,'615',NULL,'Rionegro','0',0),(00000909,00021,'655',NULL,'Sabana de Torres','0',0),(00000910,00021,'669',NULL,'San Andrés','0',0),(00000911,00021,'673',NULL,'San Benito','0',0),(00000912,00021,'679',NULL,'San Gil','0',0),(00000913,00021,'682',NULL,'San Joaquín','0',0),(00000914,00021,'684',NULL,'San José de Miranda','0',0),(00000915,00021,'686',NULL,'San Miguel','0',0),(00000916,00021,'689',NULL,'San Vicente de Chucurí','0',0),(00000917,00021,'705',NULL,'Santa Bárbara','0',0),(00000918,00021,'720',NULL,'Santa Helena','0',0),(00000919,00021,'745',NULL,'Simacota','0',0),(00000920,00021,'755',NULL,'Socorro','0',0),(00000921,00021,'770',NULL,'Suaita','0',0),(00000922,00021,'773',NULL,'Sucre','0',0),(00000923,00021,'780',NULL,'Surata','0',0),(00000924,00021,'820',NULL,'Tona','0',0),(00000925,00021,'855',NULL,'Valle San José','0',0),(00000926,00021,'861',NULL,'Vélez','0',0),(00000927,00021,'867',NULL,'Vetas','0',0),(00000928,00021,'872',NULL,'Villanueva','0',0),(00000929,00021,'895',NULL,'Zapatoca','0',0),(00000930,00022,'001',NULL,'Sincelejo','0',0),(00000931,00022,'110',NULL,'Buenavista','0',0),(00000932,00022,'124',NULL,'Caimito','0',0),(00000933,00022,'204',NULL,'Coloso','0',0),(00000934,00022,'215',NULL,'Corozal','0',0),(00000935,00022,'230',NULL,'Chalán','0',0),(00000936,00022,'233',NULL,'El Roble','0',0),(00000937,00022,'235',NULL,'Galeras','0',0),(00000938,00022,'265',NULL,'Guaranda','0',0),(00000939,00022,'400',NULL,'La Unión','0',0),(00000940,00022,'418',NULL,'Los Palmitos','0',0),(00000941,00022,'429',NULL,'Majagual','0',0),(00000942,00022,'473',NULL,'Morroa','0',0),(00000943,00022,'508',NULL,'Ovejas','0',0),(00000944,00022,'523',NULL,'Palmito','0',0),(00000945,00022,'670',NULL,'Sampues','0',0),(00000946,00022,'678',NULL,'San Benito Abad','0',0),(00000947,00022,'702',NULL,'San Juan De Betulia','0',0),(00000948,00022,'708',NULL,'San Marcos','0',0),(00000949,00022,'713',NULL,'San Onofre','0',0),(00000950,00022,'717',NULL,'San Pedro','0',0),(00000951,00022,'742',NULL,'Sincé','0',0),(00000952,00022,'771',NULL,'Sucre','0',0),(00000953,00022,'820',NULL,'Tolú','0',0),(00000954,00022,'823',NULL,'Toluviejo','0',0),(00000955,00023,'001',NULL,'Ibagué','0',0),(00000956,00023,'024',NULL,'Alpujarra','0',0),(00000957,00023,'026',NULL,'Alvarado','0',0),(00000958,00023,'030',NULL,'Ambalema','0',0),(00000959,00023,'043',NULL,'Anzoategui','0',0),(00000960,00023,'055',NULL,'Armero (Guayabal)','0',0),(00000961,00023,'067',NULL,'Ataco','0',0),(00000962,00023,'124',NULL,'Cajamarca','0',0),(00000963,00023,'148',NULL,'Carmen de Apicalá','0',0),(00000964,00023,'152',NULL,'Casabianca','0',0),(00000965,00023,'168',NULL,'Chaparral','0',0),(00000966,00023,'200',NULL,'Coello','0',0),(00000967,00023,'217',NULL,'Coyaima','0',0),(00000968,00023,'226',NULL,'Cunday','0',0),(00000969,00023,'236',NULL,'Dolores','0',0),(00000970,00023,'268',NULL,'Espinal','0',0),(00000971,00023,'270',NULL,'Falán','0',0),(00000972,00023,'275',NULL,'Flandes','0',0),(00000973,00023,'283',NULL,'Fresno','0',0),(00000974,00023,'319',NULL,'Guamo','0',0),(00000975,00023,'347',NULL,'Herveo','0',0),(00000976,00023,'349',NULL,'Honda','0',0),(00000977,00023,'352',NULL,'Icononzo','0',0),(00000978,00023,'408',NULL,'Lérida','0',0),(00000979,00023,'411',NULL,'Líbano','0',0),(00000980,00023,'443',NULL,'Mariquita','0',0),(00000981,00023,'449',NULL,'Melgar','0',0),(00000982,00023,'461',NULL,'Murillo','0',0),(00000983,00023,'483',NULL,'Natagaima','0',0),(00000984,00023,'504',NULL,'Ortega','0',0),(00000985,00023,'520',NULL,'Palocabildo','0',0),(00000986,00023,'547',NULL,'Piedras','0',0),(00000987,00023,'555',NULL,'Planadas','0',0),(00000988,00023,'563',NULL,'Prado','0',0),(00000989,00023,'585',NULL,'Purificación','0',0),(00000990,00023,'616',NULL,'Rioblanco','0',0),(00000991,00023,'622',NULL,'Roncesvalles','0',0),(00000992,00023,'624',NULL,'Rovira','0',0),(00000993,00023,'671',NULL,'Saldaña','0',0),(00000994,00023,'675',NULL,'San Antonio','0',0),(00000995,00023,'678',NULL,'San Luis','0',0),(00000996,00023,'686',NULL,'Santa Isabel','0',0),(00000997,00023,'770',NULL,'Suárez','0',0),(00000998,00023,'854',NULL,'Valle de San Juan','0',0),(00000999,00023,'861',NULL,'Venadillo','0',0),(00001000,00023,'870',NULL,'Villahermosa','0',0),(00001001,00023,'873',NULL,'Villarrica','0',0),(00001002,00024,'001',NULL,'Cali','0',0),(00001003,00024,'020',NULL,'Alcalá','0',0),(00001004,00024,'036',NULL,'Andalucía','0',0),(00001005,00024,'041',NULL,'Ansermanuevo','0',0),(00001006,00024,'054',NULL,'Argelia','0',0),(00001007,00024,'100',NULL,'Bolívar','0',0),(00001008,00024,'109',NULL,'Buenaventura','0',0),(00001009,00024,'111',NULL,'Buga','0',0),(00001010,00024,'113',NULL,'Bugalagrande','0',0),(00001011,00024,'122',NULL,'Caicedonia','0',0),(00001012,00024,'126',NULL,'Calima (Darien)','0',0),(00001013,00024,'130',NULL,'Candelaria','0',0),(00001014,00024,'147',NULL,'Cartago','0',0),(00001015,00024,'233',NULL,'Dagua','0',0),(00001016,00024,'243',NULL,'El Aguila','0',0),(00001017,00024,'246',NULL,'El Cairo','0',0),(00001018,00024,'248',NULL,'El Cerrito','0',0),(00001019,00024,'250',NULL,'El Dovio','0',0),(00001020,00024,'275',NULL,'Florida','0',0),(00001021,00024,'306',NULL,'Ginebra','0',0),(00001022,00024,'318',NULL,'Guacari','0',0),(00001023,00024,'364',NULL,'Jamundí','0',0),(00001024,00024,'377',NULL,'La Cumbre','0',0),(00001025,00024,'400',NULL,'La Unión','0',0),(00001026,00024,'403',NULL,'La Victoria','0',0),(00001027,00024,'497',NULL,'Obando','0',0),(00001028,00024,'520',NULL,'Palmira','0',0),(00001029,00024,'563',NULL,'Pradera','0',0),(00001030,00024,'606',NULL,'Restrepo','0',0),(00001031,00024,'616',NULL,'Riofrío','0',0),(00001032,00024,'622',NULL,'Roldanillo','0',0),(00001033,00024,'670',NULL,'San Pedro','0',0),(00001034,00024,'736',NULL,'Sevilla','0',0),(00001035,00024,'823',NULL,'Toro','0',0),(00001036,00024,'828',NULL,'Trujillo','0',0),(00001037,00024,'834',NULL,'Tulúa','0',0),(00001038,00024,'845',NULL,'Ulloa','0',0),(00001039,00024,'863',NULL,'Versalles','0',0),(00001040,00024,'869',NULL,'Vijes','0',0),(00001041,00024,'890',NULL,'Yotoco','0',0),(00001042,00024,'892',NULL,'Yumbo','0',0),(00001043,00024,'895',NULL,'Zarzal','0',0),(00001044,00025,'001',NULL,'Arauca','0',0),(00001045,00025,'065',NULL,'Arauquita','0',0),(00001046,00025,'220',NULL,'Cravo Norte','0',0),(00001047,00025,'300',NULL,'Fortul','0',0),(00001048,00025,'591',NULL,'Puerto Rondón','0',0),(00001049,00025,'736',NULL,'Saravena','0',0),(00001050,00025,'794',NULL,'Tame','0',0),(00001051,00026,'001',NULL,'Yopal','0',0),(00001052,00026,'010',NULL,'Aguazul','0',0),(00001053,00026,'015',NULL,'Chameza','0',0),(00001054,00026,'125',NULL,'Hato Corozal','0',0),(00001055,00026,'136',NULL,'La Salina','0',0),(00001056,00026,'139',NULL,'Maní','0',0),(00001057,00026,'162',NULL,'Monterrey','0',0),(00001058,00026,'225',NULL,'Nunchia','0',0),(00001059,00026,'230',NULL,'Orocue','0',0),(00001060,00026,'250',NULL,'Paz de Ariporo','0',0),(00001061,00026,'263',NULL,'Pore','0',0),(00001062,00026,'279',NULL,'Recetor','0',0),(00001063,00026,'300',NULL,'Sabanalarga','0',0),(00001064,00026,'315',NULL,'Sacama','0',0),(00001065,00026,'325',NULL,'San Luis de Palenque','0',0),(00001066,00026,'400',NULL,'Tamara','0',0),(00001067,00026,'410',NULL,'Tauramena','0',0),(00001068,00026,'430',NULL,'Trinidad','0',0),(00001069,00026,'440',NULL,'Villanueva','0',0),(00001070,00027,'001',NULL,'Mocoa','0',0),(00001071,00027,'219',NULL,'Colón','0',0),(00001072,00027,'320',NULL,'Orito','0',0),(00001073,00027,'568',NULL,'Puerto Asís','0',0),(00001074,00027,'569',NULL,'Puerto Caycedo','0',0),(00001075,00027,'571',NULL,'Puerto Guzmán','0',0),(00001076,00027,'573',NULL,'Puerto Leguízamo','0',0),(00001077,00027,'749',NULL,'Sibundoy','0',0),(00001078,00027,'755',NULL,'San Francisco','0',0),(00001079,00027,'757',NULL,'San Miguel','0',0),(00001080,00027,'760',NULL,'Santiago','0',0),(00001081,00027,'865',NULL,'Valle del Guamuez','0',0),(00001082,00027,'885',NULL,'Villagarzón','0',0),(00001083,00028,'001',NULL,'San Andrés','0',0),(00001084,00028,'564',NULL,'Providencia','0',0),(00001085,00029,'001',NULL,'Leticia','0',0),(00001086,00029,'263',NULL,'El Encanto','0',0),(00001087,00029,'405',NULL,'La Chorrera','0',0),(00001088,00029,'407',NULL,'La Pedrera','0',0),(00001089,00029,'460',NULL,'Miriti-Parana','0',0),(00001090,00029,'540',NULL,'Puerto Nariño','0',0),(00001091,00029,'669',NULL,'Puerto Santander','0',0),(00001092,00029,'798',NULL,'Tarapaca','0',0),(00001093,00030,'001',NULL,'Puerto Inirida','0',0),(00001094,00030,'343',NULL,'Barranco Minas','0',0),(00001095,00030,'883',NULL,'San Felipe','0',0),(00001096,00030,'884',NULL,'Puerto Colombia','0',0),(00001097,00030,'885',NULL,'La Guadalupe','0',0),(00001098,00030,'886',NULL,'Cacahual','0',0),(00001099,00030,'887',NULL,'Pana Pana','0',0),(00001100,00030,'888',NULL,'Morichal Nuevo','0',0),(00001101,00031,'001',NULL,'San José del Guaviare','0',0),(00001102,00031,'015',NULL,'Calamar','0',0),(00001103,00031,'025',NULL,'El Retorno','0',0),(00001104,00031,'200',NULL,'Miraflores','0',0),(00001105,00032,'001',NULL,'Mitu','0',0),(00001106,00032,'161',NULL,'Carurú','0',0),(00001107,00032,'511',NULL,'Pacoa','0',0),(00001108,00032,'666',NULL,'Taraira','0',0),(00001109,00032,'777',NULL,'Papunaua','0',0),(00001110,00032,'889',NULL,'Yavarate','0',0),(00001111,00033,'001',NULL,'Puerto Carreño','0',0),(00001112,00033,'524',NULL,'La Primavera','0',0),(00001113,00033,'624',NULL,'Santa Rosalía','0',0),(00001114,00033,'773',NULL,'Cumaribo','0',0);
/*!40000 ALTER TABLE `pance_municipios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pance_notas`
--

DROP TABLE IF EXISTS `pance_notas`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `pance_notas` (
  `id` smallint(3) unsigned zerofill NOT NULL auto_increment COMMENT 'Consecutivo interno para la base de datos',
  `id_usuario` smallint(4) unsigned zerofill NOT NULL COMMENT 'Llave foranea del usuario al que pertenece la nota',
  `fecha` datetime NOT NULL COMMENT 'Fecha y hora de creaciÃ³n de la nota',
  `nota` varchar(255) NOT NULL default '' COMMENT 'Contenido de la nota',
  PRIMARY KEY  (`id`),
  KEY `notas_usuarios` (`id_usuario`),
  CONSTRAINT `notas_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `pance_usuarios` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `pance_notas`
--

LOCK TABLES `pance_notas` WRITE;
/*!40000 ALTER TABLE `pance_notas` DISABLE KEYS */;
/*!40000 ALTER TABLE `pance_notas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pance_paises`
--

DROP TABLE IF EXISTS `pance_paises`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `pance_paises` (
  `id` smallint(3) unsigned zerofill NOT NULL auto_increment COMMENT 'Consecutivo interno para la base de datos',
  `codigo_iso` varchar(2) NOT NULL COMMENT 'CÃ³digo ISO',
  `codigo_interno` smallint(3) unsigned zerofill default NULL COMMENT 'CÃ³digo para uso interno de la empresa (opcional)',
  `nombre` varchar(255) NOT NULL default '' COMMENT 'Nombre completo',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `codigo_iso` (`codigo_iso`),
  UNIQUE KEY `codigo_interno` (`codigo_interno`)
) ENGINE=InnoDB AUTO_INCREMENT=241 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `pance_paises`
--

LOCK TABLES `pance_paises` WRITE;
/*!40000 ALTER TABLE `pance_paises` DISABLE KEYS */;
INSERT INTO `pance_paises` VALUES (001,'AF',NULL,'Afganistán'),(002,'AL',NULL,'Albania'),(003,'DE',NULL,'Alemania'),(004,'AD',NULL,'Andorra'),(005,'AO',NULL,'Angola'),(006,'AI',NULL,'Anguilla'),(007,'AQ',NULL,'Antartida'),(008,'AG',NULL,'Antigua y Barbuda'),(009,'AN',NULL,'Antillas Holandesas'),(010,'SA',NULL,'Arabia Saudí'),(011,'DZ',NULL,'Argelia'),(012,'AR',NULL,'Argentina'),(013,'AM',NULL,'Armenia'),(014,'AW',NULL,'Aruba'),(015,'AU',NULL,'Australia'),(016,'AT',NULL,'Austria'),(017,'AZ',NULL,'Azerbaiyán'),(018,'BS',NULL,'Bahamas'),(019,'BH',NULL,'Bahrein'),(020,'BD',NULL,'Bangladesh'),(021,'BB',NULL,'Barbados'),(022,'BY',NULL,'Bielorrusia'),(023,'BE',NULL,'Bélgica'),(024,'BZ',NULL,'Belice'),(025,'BJ',NULL,'Benin'),(026,'BM',NULL,'Bermuda'),(027,'BT',NULL,'Bhutan'),(028,'BO',NULL,'Bolivia'),(029,'BA',NULL,'Bosnia y Herzegovina'),(030,'BW',NULL,'Botswana'),(031,'BR',NULL,'Brasil'),(032,'BN',NULL,'Brunei'),(033,'BG',NULL,'Bulgaria'),(034,'BF',NULL,'Burkina Faso'),(035,'BI',NULL,'Burundi'),(036,'CV',NULL,'Cabo Verde'),(037,'KH',NULL,'Camboya'),(038,'CM',NULL,'Camerún'),(039,'CA',NULL,'Canadá'),(040,'TD',NULL,'Chad'),(041,'CZ',NULL,'Chequia'),(042,'CL',NULL,'Chile'),(043,'CN',NULL,'China continental'),(044,'CY',NULL,'Chipre'),(045,'VA',NULL,'Ciudad del Vaticano'),(046,'CO',NULL,'Colombia'),(047,'KM',NULL,'Comoros'),(048,'CG',NULL,'Congo'),(049,'CD',NULL,'República Democrática del Congo'),(050,'KR',NULL,'Corea del Sur'),(051,'KP',NULL,'Corea del Norte'),(052,'CI',NULL,'Costa de Marfil'),(053,'CR',NULL,'Costa Rica'),(054,'HR',NULL,'Croacia'),(055,'CU',NULL,'Cuba'),(056,'DK',NULL,'Dinamarca'),(057,'DJ',NULL,'Djibouti'),(058,'DM',NULL,'Dominica'),(059,'EC',NULL,'Ecuador'),(060,'EG',NULL,'Egipto'),(061,'SV',NULL,'El Salvador'),(062,'AE',NULL,'Emiratos Árabes Unidos'),(063,'ER',NULL,'Eritrea'),(064,'SK',NULL,'Eslovaquia'),(065,'SI',NULL,'Eslovenia'),(066,'ES',NULL,'España'),(067,'US',NULL,'Estados Unidos'),(068,'EE',NULL,'Estonia'),(069,'SJ',NULL,'Islas Svalbard y Jan Mayen'),(070,'ET',NULL,'Etiopía'),(071,'FJ',NULL,'Fiji'),(072,'PH',NULL,'Filipinas'),(073,'FI',NULL,'Finlandia'),(074,'FR',NULL,'Francia'),(075,'GA',NULL,'Gabón'),(076,'GM',NULL,'Gambia'),(077,'GS',NULL,'Georgia del Sur e Islas Sandwich del Sur'),(078,'GE',NULL,'Georgia'),(079,'GH',NULL,'Ghana'),(080,'GI',NULL,'Gibraltar'),(081,'GD',NULL,'Granada'),(082,'GR',NULL,'Grecia'),(083,'GL',NULL,'Groenlandia'),(084,'GP',NULL,'Guadalupe'),(085,'GU',NULL,'Guam'),(086,'GT',NULL,'Guatemala'),(087,'GY',NULL,'Guyana'),(088,'GN',NULL,'Guinea'),(089,'GW',NULL,'Guinea-Bissau'),(090,'GQ',NULL,'Guinea Ecuatorial'),(091,'GF',NULL,'Guyana Francesa'),(092,'HT',NULL,'Haití'),(093,'NL',NULL,'Holanda'),(094,'HN',NULL,'Honduras'),(095,'HK',NULL,'Hong Kong'),(096,'HU',NULL,'Hungría'),(097,'IN',NULL,'India'),(098,'ID',NULL,'Indonesia'),(099,'IQ',NULL,'Irak'),(100,'IR',NULL,'Irán'),(101,'IE',NULL,'Irlanda'),(102,'BV',NULL,'Isla Bouvet'),(103,'CX',NULL,'Isla Christmas'),(104,'IS',NULL,'Islandia'),(105,'KY',NULL,'Islas Caimán'),(106,'CC',NULL,'Islas Cocos'),(107,'CK',NULL,'Islas Cook'),(108,'MP',NULL,'Islas Marianas'),(109,'FO',NULL,'Islas Faroe'),(110,'HM',NULL,'Islas Heard y McDonald'),(111,'AX',NULL,'Islas Åland'),(112,'FK',NULL,'Islas Malvinas'),(113,'MH',NULL,'Islas Marshall'),(114,'NF',NULL,'Islas Norfolk'),(115,'SB',NULL,'Islas Salomón'),(116,'TC',NULL,'Islas Turcas y Caicos'),(117,'UM',NULL,'Islas Ultramarinas de Estados Unidos'),(118,'VG',NULL,'Islas Vírgenes Británicas'),(119,'VI',NULL,'Islas Vírgenes de los Estados Unidos'),(120,'IL',NULL,'Israel'),(121,'IT',NULL,'Italia'),(122,'JM',NULL,'Jamaica'),(123,'JP',NULL,'Japón'),(124,'JO',NULL,'Jordania'),(125,'KZ',NULL,'Kazajstán'),(126,'KE',NULL,'Kenia'),(127,'KG',NULL,'Kirguistán'),(128,'KI',NULL,'Kiribati'),(129,'KW',NULL,'Kuwait'),(130,'LA',NULL,'Laos'),(131,'LS',NULL,'Lesoto'),(132,'LV',NULL,'Letonia'),(133,'LB',NULL,'Líbano'),(134,'LR',NULL,'Liberia'),(135,'LY',NULL,'Libia'),(136,'LI',NULL,'Liechtenstein'),(137,'LT',NULL,'Lituania'),(138,'LU',NULL,'Luxemburgo'),(139,'MO',NULL,'Macao'),(140,'MK',NULL,'Macedonia'),(141,'MG',NULL,'Madagascar'),(142,'MY',NULL,'Malasia'),(143,'MW',NULL,'Malawi'),(144,'MV',NULL,'Maldivas'),(145,'ML',NULL,'Mali'),(146,'MT',NULL,'Malta'),(147,'MA',NULL,'Marruecos'),(148,'MQ',NULL,'Martinica'),(149,'MU',NULL,'Mauricio'),(150,'MR',NULL,'Mauritania'),(151,'YT',NULL,'Mayotte'),(152,'MX',NULL,'México'),(153,'MM',NULL,'Myanmar'),(154,'FM',NULL,'Micronesia'),(155,'MD',NULL,'Moldavia'),(156,'MC',NULL,'Mónaco'),(157,'MN',NULL,'Mongolia'),(158,'MS',NULL,'Montserrat'),(159,'MZ',NULL,'Mozambique'),(160,'NA',NULL,'Namibia'),(161,'NR',NULL,'Nauru'),(162,'NP',NULL,'Nepal'),(163,'NI',NULL,'Nicaragua'),(164,'NE',NULL,'Níger'),(165,'NG',NULL,'Nigeria'),(166,'NU',NULL,'Niue'),(167,'NO',NULL,'Noruega'),(168,'NC',NULL,'Nueva Caledonia'),(169,'NZ',NULL,'Nueva Zelanda'),(170,'OM',NULL,'Omán'),(171,'PK',NULL,'Pakistán'),(172,'PW',NULL,'Palau'),(173,'PS',NULL,'Palestina'),(174,'PA',NULL,'Panamá'),(175,'PG',NULL,'Papúa Nueva Guinea'),(176,'PY',NULL,'Paraguay'),(177,'PE',NULL,'Perú'),(178,'PN',NULL,'Pitcairn'),(179,'PF',NULL,'Polinesia Francesa'),(180,'PL',NULL,'Polonia'),(181,'PT',NULL,'Portugal'),(182,'PR',NULL,'Puerto Rico'),(183,'QA',NULL,'Qatar'),(184,'GB',NULL,'Reino Unido'),(185,'CF',NULL,'República Centroafricana'),(186,'DO',NULL,'República Dominicana'),(187,'RE',NULL,'Reunión'),(188,'RW',NULL,'Ruanda'),(189,'RO',NULL,'Rumanía'),(190,'RU',NULL,'Rusia'),(191,'EH',NULL,'Sáhara Occidental'),(192,'WS',NULL,'Samoa'),(193,'AS',NULL,'Samoa Americana'),(194,'SM',NULL,'San Marino'),(195,'PM',NULL,'St. Pierre y Miquelon'),(196,'SH',NULL,'Santa Helena'),(197,'KN',NULL,'Saint Kitts y Nevis'),(198,'LC',NULL,'Santa Lucía'),(199,'ST',NULL,'Santo Tomé y Príncipe'),(200,'VC',NULL,'San Vicente y las Granadinas'),(201,'SN',NULL,'Senegal'),(202,'CS',NULL,'Serbia y Montenegro'),(203,'SC',NULL,'Seychelles'),(204,'SL',NULL,'Sierra Leona'),(205,'SG',NULL,'Singapur'),(206,'SY',NULL,'Siria'),(207,'SO',NULL,'Somalia'),(208,'LK',NULL,'Sri Lanka'),(209,'SZ',NULL,'Suazilandia'),(210,'ZA',NULL,'Sudáfrica'),(211,'SD',NULL,'Sudán'),(212,'SE',NULL,'Suecia'),(213,'CH',NULL,'Suiza'),(214,'SR',NULL,'Surinam'),(215,'TH',NULL,'Tailandia'),(216,'TW',NULL,'Taiwán'),(217,'TJ',NULL,'Tayikistán'),(218,'TZ',NULL,'Tanzania'),(219,'IO',NULL,'Territorio Británico del Océano Índico'),(220,'TF',NULL,'Territorios Franceses del Sur'),(221,'TL',NULL,'Timor Oriental'),(222,'TG',NULL,'Togo'),(223,'TK',NULL,'Tokelau'),(224,'TO',NULL,'Tonga'),(225,'TT',NULL,'Trinidad y Tobago'),(226,'TM',NULL,'Turkmenistán'),(227,'TN',NULL,'Túnez'),(228,'TR',NULL,'Turquía'),(229,'TV',NULL,'Tuvalu'),(230,'UA',NULL,'Ucrania'),(231,'UG',NULL,'Uganda'),(232,'UY',NULL,'Uruguay'),(233,'UZ',NULL,'Uzbekistán'),(234,'VU',NULL,'Vanuatu'),(235,'VE',NULL,'Venezuela'),(236,'VN',NULL,'Vietnam'),(237,'WF',NULL,'Wallis y Futuna'),(238,'YE',NULL,'Yemen'),(239,'ZM',NULL,'Zambia'),(240,'ZW',NULL,'Zimbabue');
/*!40000 ALTER TABLE `pance_paises` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pance_perfiles`
--

DROP TABLE IF EXISTS `pance_perfiles`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `pance_perfiles` (
  `id` smallint(4) unsigned zerofill NOT NULL auto_increment COMMENT 'Consecutivo interno de la base de datos',
  `codigo` smallint(4) unsigned zerofill NOT NULL COMMENT 'CÃ³digo asignado al perfil',
  `nombre` varchar(255) NOT NULL default '' COMMENT 'Nombre del perfil',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `codigo` (`codigo`),
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=9001 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `pance_perfiles`
--

LOCK TABLES `pance_perfiles` WRITE;
/*!40000 ALTER TABLE `pance_perfiles` DISABLE KEYS */;
INSERT INTO `pance_perfiles` VALUES (9000,0001,'GLOBAL');
/*!40000 ALTER TABLE `pance_perfiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pance_perfiles_usuario`
--

DROP TABLE IF EXISTS `pance_perfiles_usuario`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `pance_perfiles_usuario` (
  `id` int(8) unsigned zerofill NOT NULL auto_increment COMMENT 'Consecutivo interno de la base de datos',
  `id_usuario` smallint(4) unsigned zerofill NOT NULL COMMENT 'Consecutivo interno de la base de datos para el usuario',
  `id_sucursal` mediumint(5) unsigned zerofill NOT NULL COMMENT 'Consecutivo interno de la base de datos para la sucursal',
  `id_perfil` smallint(4) unsigned zerofill NOT NULL COMMENT 'Consecutivo interno de la base de datos para el perfil',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id_usuario` (`id_usuario`,`id_sucursal`),
  KEY `perfiles_usuario_sucursal` (`id_sucursal`),
  KEY `perfiles_usuario_perfil` (`id_perfil`),
  CONSTRAINT `perfiles_usuario_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `pance_usuarios` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `perfiles_usuario_sucursal` FOREIGN KEY (`id_sucursal`) REFERENCES `pance_sucursales` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `perfiles_usuario_perfil` FOREIGN KEY (`id_perfil`) REFERENCES `pance_perfiles` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `pance_perfiles_usuario`
--

LOCK TABLES `pance_perfiles_usuario` WRITE;
/*!40000 ALTER TABLE `pance_perfiles_usuario` DISABLE KEYS */;
/*!40000 ALTER TABLE `pance_perfiles_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pance_preferencias`
--

DROP TABLE IF EXISTS `pance_preferencias`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `pance_preferencias` (
  `id` int(8) unsigned zerofill NOT NULL auto_increment COMMENT 'Consecutivo interno de la base de datos',
  `tipo` enum('1','2') NOT NULL default '1' COMMENT '1 Global - 2 Individual',
  `variable` varchar(255) NOT NULL COMMENT 'Nombre del componente al cual se aplica la preferencia',
  `valor` varchar(255) NOT NULL COMMENT 'Valor que se aplica para la variable',
  `usuario` varchar(255) default NULL COMMENT 'Usuario en caso de que la prefernecia sea individual',
  `sucursal` varchar(255) default NULL COMMENT 'Sucursal en caso de que la prefernecia sea global',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `pance_preferencias`
--

LOCK TABLES `pance_preferencias` WRITE;
/*!40000 ALTER TABLE `pance_preferencias` DISABLE KEYS */;
INSERT INTO `pance_preferencias` VALUES (00000001,'2','impuesto','16','0001',NULL);
/*!40000 ALTER TABLE `pance_preferencias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pance_profesiones_oficios`
--

DROP TABLE IF EXISTS `pance_profesiones_oficios`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `pance_profesiones_oficios` (
  `id` smallint(4) unsigned zerofill NOT NULL auto_increment COMMENT 'Consecutivo interno de la base de datos',
  `codigo_DANE` smallint(4) unsigned zerofill NOT NULL COMMENT 'CÃƒÂ³digo universal que identifica una profesiÃƒÂ³n u oficio aprobado por el DANE ',
  `codigo_interno` smallint(4) unsigned zerofill NOT NULL COMMENT 'CÃƒÂ³digo interno asignado por el usuario ',
  `descripcion` varchar(255) NOT NULL COMMENT 'Detalle que identifica la profesiÃƒÂ³n u oficio',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `codigo_DANE` (`codigo_DANE`),
  UNIQUE KEY `codigo_interno` (`codigo_interno`),
  UNIQUE KEY `descripcion` (`descripcion`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `pance_profesiones_oficios`
--

LOCK TABLES `pance_profesiones_oficios` WRITE;
/*!40000 ALTER TABLE `pance_profesiones_oficios` DISABLE KEYS */;
/*!40000 ALTER TABLE `pance_profesiones_oficios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pance_registro_ingresos`
--

DROP TABLE IF EXISTS `pance_registro_ingresos`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `pance_registro_ingresos` (
  `id` int(6) unsigned zerofill NOT NULL auto_increment COMMENT 'CÃ³digo interno en la base de datos',
  `id_requerimiento` int(8) unsigned zerofill NOT NULL COMMENT 'CÃ³digo interno que relaciona la cotizacion con el requerimiento',
  `concepto` enum('1','2') default '1' COMMENT 'Concepto: 1=Ingreso, 2=Gasto',
  `fecha_concepto` date NOT NULL COMMENT 'Fecha del concepto',
  `valor_concepto` decimal(12,2) default NULL COMMENT 'Valor del ingreso o egreso',
  PRIMARY KEY  (`id`),
  KEY `registro_ingresos_requerimiento` (`id_requerimiento`),
  CONSTRAINT `registro_ingresos_requerimiento` FOREIGN KEY (`id_requerimiento`) REFERENCES `pance_requerimientos_clientes` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `pance_registro_ingresos`
--

LOCK TABLES `pance_registro_ingresos` WRITE;
/*!40000 ALTER TABLE `pance_registro_ingresos` DISABLE KEYS */;
/*!40000 ALTER TABLE `pance_registro_ingresos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pance_registro_obras`
--

DROP TABLE IF EXISTS `pance_registro_obras`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `pance_registro_obras` (
  `id` int(6) unsigned zerofill NOT NULL auto_increment COMMENT 'CÃ³digo interno en la base de datos',
  `id_requerimiento` int(8) unsigned zerofill NOT NULL COMMENT 'CÃ³digo interno que relaciona la cotizacion con el requerimiento',
  `id_cotizacion` int(6) unsigned zerofill NOT NULL COMMENT 'CÃ³digo interno que relaciona la acta con la cotizacion',
  `tipo_acta` enum('1','2','3') default '1' COMMENT ' Tipo de acta: 1=Acta inicio, 2=Acta avance obra, 3=Acta finalizacion',
  `fecha_entrega_acta` date default NULL COMMENT 'Fecha de entrega del acta',
  `valor_facturar` decimal(12,2) default NULL COMMENT 'Valor a facturar proporcionalmente frente al valor total',
  `factura_consorciado` enum('0','1') default '0' COMMENT 'Envio de la factura al consorciado: 0=No, 1=Si',
  `pago_cliente` enum('0','1') default '0' COMMENT 'Estado del pago del cliente: 0=No, 1=Si',
  `pago_consorciado` enum('0','1') default '0' COMMENT 'Estado del pago del consorciado: 0=No, 1=Si',
  `porcentaje_mano_obra` decimal(5,2) default NULL COMMENT 'Porcentaje que le corresponde al consorciado por la mano de obra',
  `porcentaje_materiales` decimal(5,2) default NULL COMMENT 'Porcentaje que le corresponde al consorciado por materiales',
  `imagen` varchar(255) default '' COMMENT 'Imagen del acta',
  PRIMARY KEY  (`id`),
  KEY `registro_obras_requerimiento` (`id_requerimiento`),
  KEY `registro_obras_cotizacion` (`id_cotizacion`),
  CONSTRAINT `registro_obras_requerimiento` FOREIGN KEY (`id_requerimiento`) REFERENCES `pance_requerimientos_clientes` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `registro_obras_cotizacion` FOREIGN KEY (`id_cotizacion`) REFERENCES `pance_cotizaciones` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `pance_registro_obras`
--

LOCK TABLES `pance_registro_obras` WRITE;
/*!40000 ALTER TABLE `pance_registro_obras` DISABLE KEYS */;
/*!40000 ALTER TABLE `pance_registro_obras` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pance_requerimientos_clientes`
--

DROP TABLE IF EXISTS `pance_requerimientos_clientes`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `pance_requerimientos_clientes` (
  `id` int(8) unsigned zerofill NOT NULL auto_increment COMMENT 'CÃ³digo interno en al base de datos',
  `id_sede` int(8) unsigned zerofill NOT NULL COMMENT 'CÃ³digo interno relaciona con la empresa',
  `id_sucursal` mediumint(5) unsigned zerofill NOT NULL COMMENT 'Consecutivo interno que identifica la sucursal',
  `tipo_solicitud` enum('M','E','S','P','V') NOT NULL default 'M' COMMENT 'El tipo de servicio que se presta el consorcio: M=Mantenimiento, E=Emergencia, S=Servicio por demanda, P=Proyecto, V=Visita',
  `fecha_ingreso` date NOT NULL COMMENT 'Fecha de solicitud del servicio ingresada por el usuario',
  `fecha_ingreso_sistema` datetime default NULL COMMENT 'Fecha de solicitud del servicio del sistema',
  `fecha_confirmacion` date default NULL COMMENT 'Fecha de confirmaciÃ³n del servicio ingresada por el usuario',
  `fecha_confirmacion_sistema` datetime default NULL COMMENT 'Fecha de confirmaciÃ³n del servicio del sistema',
  `descripcion` varchar(255) NOT NULL COMMENT 'DescripciÃ³n del servicio solicitado',
  `observaciones` varchar(60) default NULL COMMENT 'ObservaciÃ³n del cliente',
  `observaciones_visita` varchar(60) default NULL COMMENT 'Observaciones de la visita',
  `fecha_visita` date default NULL COMMENT 'Fecha de solicitud del servicio ingresada por el usuario',
  `nombre_contacto` varchar(255) default NULL COMMENT 'Nombre que identifica el contacto del requerimiento',
  `telefono_contacto` varchar(15) default NULL COMMENT 'Telefono del contacto requerimiento',
  `persona_recibe` varchar(255) default NULL COMMENT 'Nombre que identifica el contacto del requerimiento',
  `estado_aprobacion_requerimiento` enum('0','1') default '0' COMMENT 'Estado aprobacion requerimiento: 0=No, 1=Si',
  `notificado` enum('0','1') default '0' COMMENT 'Consorciado notificado: 0=No, 1=Si',
  `estado_cotizacion` enum('1','2','3','4','5','6','7') default '6' COMMENT 'Estado del cotizacion 1=Pendiente 2=Aprobada 3=Anulada 4=Recotizada 5=Reemplazada 6=No notificada 7=Visita no genero cotizacion',
  `medio_recibo` varchar(255) default NULL COMMENT 'Medio por el cual se recibio el requerimiento (ejemplo: intenet, celular, etc)',
  PRIMARY KEY  (`id`),
  KEY `requerimientos_sedes` (`id_sede`),
  KEY `requerimientos_sucursales` (`id_sucursal`),
  CONSTRAINT `requerimientos_sedes` FOREIGN KEY (`id_sede`) REFERENCES `pance_sedes_clientes` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `requerimientos_sucursales` FOREIGN KEY (`id_sucursal`) REFERENCES `pance_sucursales` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `pance_requerimientos_clientes`
--

LOCK TABLES `pance_requerimientos_clientes` WRITE;
/*!40000 ALTER TABLE `pance_requerimientos_clientes` DISABLE KEYS */;
/*!40000 ALTER TABLE `pance_requerimientos_clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pance_secciones`
--

DROP TABLE IF EXISTS `pance_secciones`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `pance_secciones` (
  `id` int(8) unsigned zerofill NOT NULL auto_increment COMMENT 'CÃ³digo interno en al base de datos',
  `id_bodega` mediumint(5) unsigned zerofill NOT NULL COMMENT 'CÃ³digo interno relaciona con la bodega',
  `codigo` smallint(4) unsigned zerofill NOT NULL COMMENT 'CÃ³digo asignado usuario',
  `nombre` varchar(60) NOT NULL COMMENT 'Nombre que identifica la seccion',
  `descripcion` varchar(60) NOT NULL COMMENT 'Nombre que describe la seccion',
  PRIMARY KEY  (`id`),
  KEY `secciones_bodegas` (`id_bodega`),
  CONSTRAINT `secciones_bodegas` FOREIGN KEY (`id_bodega`) REFERENCES `pance_bodegas` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `pance_secciones`
--

LOCK TABLES `pance_secciones` WRITE;
/*!40000 ALTER TABLE `pance_secciones` DISABLE KEYS */;
/*!40000 ALTER TABLE `pance_secciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pance_sedes_clientes`
--

DROP TABLE IF EXISTS `pance_sedes_clientes`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `pance_sedes_clientes` (
  `id` int(8) unsigned zerofill NOT NULL auto_increment COMMENT 'CÃ³digo interno en al base de datos',
  `id_cliente` int(8) unsigned zerofill NOT NULL COMMENT 'CÃ³digo interno relaciona con el cliente',
  `nombre_sede` varchar(60) NOT NULL COMMENT 'Nombre de la sede',
  `id_sucursal` mediumint(5) unsigned zerofill NOT NULL COMMENT 'Consecutivo interno identifica la sucursal',
  `nombre_contacto` varchar(255) NOT NULL COMMENT 'Nombre que identifica el contacto',
  `id_cargo` smallint(3) unsigned zerofill NOT NULL COMMENT 'Consecutivo interno que identifica el cargo',
  `id_municipios` int(8) unsigned zerofill NOT NULL COMMENT 'CÃ³digo del municipio donde reside la sede',
  `direccion` varchar(50) NOT NULL COMMENT 'Direccion de la sede',
  `telefono_principal` varchar(15) NOT NULL COMMENT 'NÃºmero de telÃ©fono',
  `celular` varchar(15) default NULL COMMENT 'NÃºmero de celular',
  `correo` varchar(100) default NULL COMMENT 'DirecciÃ³n de correo electrÃ³nico',
  PRIMARY KEY  (`id`),
  KEY `sedes_terceros` (`id_cliente`),
  KEY `sedes_sucursal` (`id_sucursal`),
  KEY `sedes_municipios` (`id_municipios`),
  CONSTRAINT `sedes_municipios` FOREIGN KEY (`id_municipios`) REFERENCES `pance_municipios` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `sedes_sucursal` FOREIGN KEY (`id_sucursal`) REFERENCES `pance_sucursales` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `sedes_terceros` FOREIGN KEY (`id_cliente`) REFERENCES `pance_terceros` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `pance_sedes_clientes`
--

LOCK TABLES `pance_sedes_clientes` WRITE;
/*!40000 ALTER TABLE `pance_sedes_clientes` DISABLE KEYS */;
INSERT INTO `pance_sedes_clientes` VALUES (00000003,90000004,'TECHO',90002,'JESUS MAURICIO CHAVARRO',901,00000149,'AV. BOYACA No. 9 - 04','4249000',NULL,NULL),(00000004,90000004,'APARTADO',90001,'JESUS MAURICIO CHAVARRO',901,00000013,'APARTADO','3216442945',NULL,NULL),(00000005,90000004,'ARMENIA - VENTAS',90001,'JESUS MAURICIO CHAVARRO',901,00000817,'CALLE 7 No. 14-34','3216442945',NULL,NULL),(00000006,90000004,'BARRANCABERMEJA - VENTAS',90000,'JESUS MAURICIO CHAVARRO',901,00000849,'CARRERA 25 No. 48-35','3216442945',NULL,NULL),(00000007,90000008,'MALTERIA TROPICAL',90003,'JESUS MAURICIO CHAVARRO',901,00000149,'CALLE 94 No. 7A-47','3216442945',NULL,NULL),(00000008,90000007,'IMPRESORA DEL SUR',90002,'JESUS MAURICIO CHAVARRO',901,00001042,'CARRERA 35 No. 10-597 ACOPI','3216442945',NULL,NULL);
/*!40000 ALTER TABLE `pance_sedes_clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `pance_seleccion_clientes`
--

DROP TABLE IF EXISTS `pance_seleccion_clientes`;
/*!50001 DROP VIEW IF EXISTS `pance_seleccion_clientes`*/;
/*!50001 CREATE TABLE `pance_seleccion_clientes` (
  `id` int(8) unsigned zerofill,
  `nombre` varbinary(354)
) */;

--
-- Temporary table structure for view `pance_seleccion_empresas`
--

DROP TABLE IF EXISTS `pance_seleccion_empresas`;
/*!50001 DROP VIEW IF EXISTS `pance_seleccion_empresas`*/;
/*!50001 CREATE TABLE `pance_seleccion_empresas` (
  `id` smallint(3) unsigned zerofill,
  `nombre` varbinary(67)
) */;

--
-- Temporary table structure for view `pance_seleccion_localidades`
--

DROP TABLE IF EXISTS `pance_seleccion_localidades`;
/*!50001 DROP VIEW IF EXISTS `pance_seleccion_localidades`*/;
/*!50001 CREATE TABLE `pance_seleccion_localidades` (
  `id` int(8) unsigned zerofill,
  `nombre` longblob
) */;

--
-- Temporary table structure for view `pance_seleccion_municipios`
--

DROP TABLE IF EXISTS `pance_seleccion_municipios`;
/*!50001 DROP VIEW IF EXISTS `pance_seleccion_municipios`*/;
/*!50001 CREATE TABLE `pance_seleccion_municipios` (
  `id` int(8) unsigned zerofill,
  `nombre` longblob
) */;

--
-- Temporary table structure for view `pance_seleccion_registro_ingresos`
--

DROP TABLE IF EXISTS `pance_seleccion_registro_ingresos`;
/*!50001 DROP VIEW IF EXISTS `pance_seleccion_registro_ingresos`*/;
/*!50001 CREATE TABLE `pance_seleccion_registro_ingresos` (
  `id` int(8) unsigned zerofill,
  `NUMERO_COTIZACION` int(8) unsigned zerofill,
  `DESCRIPCION` varchar(255),
  `FECHA_CONCEPTO` date,
  `CONCEPTO` varchar(7),
  `VALOR_CONCEPTO` decimal(12,2)
) */;

--
-- Temporary table structure for view `pance_seleccion_registro_obras`
--

DROP TABLE IF EXISTS `pance_seleccion_registro_obras`;
/*!50001 DROP VIEW IF EXISTS `pance_seleccion_registro_obras`*/;
/*!50001 CREATE TABLE `pance_seleccion_registro_obras` (
  `id` int(6) unsigned zerofill,
  `id_cotizacion` int(6) unsigned zerofill,
  `NUMEROCOTIZACION` int(8) unsigned zerofill,
  `TIPOACTA` varchar(12),
  `FECHAENTREGA` date,
  `VALORFACTURAR` decimal(12,2),
  `FACTURACONSORCIADO` varchar(10),
  `PAGOCLIENTE` varchar(9),
  `PAGOCONSORCIADO` varchar(9),
  `PORCENTAJEMANOOBRA` decimal(5,2),
  `PORCENTAJEMATERIALES` decimal(5,2)
) */;

--
-- Temporary table structure for view `pance_seleccion_requerimientos_clientes`
--

DROP TABLE IF EXISTS `pance_seleccion_requerimientos_clientes`;
/*!50001 DROP VIEW IF EXISTS `pance_seleccion_requerimientos_clientes`*/;
/*!50001 CREATE TABLE `pance_seleccion_requerimientos_clientes` (
  `id` int(8) unsigned zerofill,
  `nombre_sede` varchar(60),
  `sucursal` varchar(60),
  `tipo_solicitud` varchar(20)
) */;

--
-- Temporary table structure for view `pance_seleccion_sedes_clientes`
--

DROP TABLE IF EXISTS `pance_seleccion_sedes_clientes`;
/*!50001 DROP VIEW IF EXISTS `pance_seleccion_sedes_clientes`*/;
/*!50001 CREATE TABLE `pance_seleccion_sedes_clientes` (
  `id` int(8) unsigned zerofill,
  `nombre_sede` varchar(60),
  `id_cliente` varbinary(341)
) */;

--
-- Temporary table structure for view `pance_seleccion_sucursales`
--

DROP TABLE IF EXISTS `pance_seleccion_sucursales`;
/*!50001 DROP VIEW IF EXISTS `pance_seleccion_sucursales`*/;
/*!50001 CREATE TABLE `pance_seleccion_sucursales` (
  `id` mediumint(5) unsigned zerofill,
  `nombre` varbinary(69)
) */;

--
-- Table structure for table `pance_servidores`
--

DROP TABLE IF EXISTS `pance_servidores`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `pance_servidores` (
  `id` smallint(3) unsigned zerofill NOT NULL auto_increment COMMENT 'Consecutivo interno de la base de datos',
  `ip` varchar(15) NOT NULL COMMENT 'DrirecciÃ³n IP de la servidor',
  `nombre_netbios` varchar(50) NOT NULL COMMENT 'Nombre NetBIOS',
  `nombre_tcpip` varchar(50) NOT NULL COMMENT 'NONBRE TCPIP',
  `descripcion` varchar(50) default NULL COMMENT 'DescripciÃ³n de la servidor',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `pance_servidores`
--

LOCK TABLES `pance_servidores` WRITE;
/*!40000 ALTER TABLE `pance_servidores` DISABLE KEYS */;
/*!40000 ALTER TABLE `pance_servidores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pance_sesiones`
--

DROP TABLE IF EXISTS `pance_sesiones`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `pance_sesiones` (
  `id` char(32) NOT NULL COMMENT 'Identificador de la sesiÃ³n',
  `expiracion` int(11) NOT NULL COMMENT 'Fecha de expiraciÃ³n (en formato Unix Timestamp) de la sesiÃ³n por inactividad',
  `contenido` text NOT NULL COMMENT 'Variables definidas en la sesiÃ³n con sus respectivos valores',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `pance_sesiones`
--

LOCK TABLES `pance_sesiones` WRITE;
/*!40000 ALTER TABLE `pance_sesiones` DISABLE KEYS */;
INSERT INTO `pance_sesiones` VALUES ('1b7c52f464af3a49747df383563563dd',1249332780,''),('1oc44tccp54f5jourfc6bm7951',1249435091,''),('281029f1eaca0b01ed73c18837f6504e',1247606382,'usuario|s:5:\"admin\";contrasena|s:32:\"21232f297a57a5a743894a0e4a801fc3\";sucursal|s:5:\"90003\";cliente|s:13:\"192.168.0.253\";perfil|b:0;id_usuario|s:4:\"0001\";conexion|i:17;menu|s:3402:\"<ul id=\"menuGeneral\" class=\"menu\">\n   <li id=\"MENUPRIN\" class=\"menuPrincipal\"><a href=\"/index.php?componente=MENUPRIN\">Inicio</a>\n   </li>\n   <li id=\"MENUCLIE\" class=\"menuPrincipal\">Clientes\n   <ul class=\"subMenu\">\n    <li id=\"SUBMCOSE\">Control de servicios\n     <ul>\n    <li id=\"GESTCLIE\"><a href=\"/index.php?componente=GESTCLIE\">Clientes</a>\n    </li>\n    <li id=\"GESTSEDE\"><a href=\"/index.php?componente=GESTSEDE\">Sedes clientes</a>\n    </li>\n    <li id=\"GESTRECL\"><a href=\"/index.php?componente=GESTRECL\">Requerimiento clientes</a>\n    </li>\n    <li id=\"GESTCOCL\"><a href=\"/index.php?componente=GESTCOCL\">Cotizaciones</a>\n    </li>\n    <li id=\"GESTAPCO\"><a href=\"/index.php?componente=GESTAPCO\">Aprobación / Propuesta cliente</a>\n    </li>\n     </ul>\n    </li>\n   </ul>\n   </li>\n   <li id=\"MENUADMI\" class=\"menuPrincipal\">Administración\n   <ul class=\"subMenu\">\n    <li id=\"SUBMESTC\">Estructura corporativa\n     <ul>\n    <li id=\"GESTEMPR\"><a href=\"/index.php?componente=GESTEMPR\">Empresas</a>\n    </li>\n    <li id=\"GESTSUCU\"><a href=\"/index.php?componente=GESTSUCU\">Consorciados</a>\n    </li>\n    <li id=\"GESTBODE\"><a href=\"/index.php?componente=GESTBODE\">Bodegas</a>\n    </li>\n    <li id=\"GESTSECC\"><a href=\"/index.php?componente=GESTSECC\">Secciones</a>\n    </li>\n     </ul>\n    </li>\n    <li id=\"SUBMACCE\">Acceso\n     <ul>\n    <li id=\"GESTPERF\"><a href=\"/index.php?componente=GESTPERF\">Perfiles</a>\n    </li>\n    <li id=\"GESTUSUA\"><a href=\"/index.php?componente=GESTUSUA\">Usuarios</a>\n    </li>\n    <li id=\"GESTPRIV\"><a href=\"/index.php?componente=GESTPRIV\">Privilegios</a>\n    </li>\n    <li id=\"GESTPREF\"><a href=\"/index.php?componente=GESTPREF\">Preferencias</a>\n    </li>\n     </ul>\n    </li>\n    <li id=\"SUBMDISP\">Dispositivos\n     <ul>\n    <li id=\"GESTSRVD\"><a href=\"/index.php?componente=GESTSRVD\">Servidores</a>\n    </li>\n    <li id=\"GESTTERM\"><a href=\"/index.php?componente=GESTTERM\">Terminales</a>\n    </li>\n    <li id=\"GESTIMPR\"><a href=\"/index.php?componente=GESTIMPR\">Impresoras</a>\n    </li>\n     </ul>\n    </li>\n    <li id=\"SUBMSEGU\">Seguridad\n     <ul>\n    <li id=\"GESTBITA\"><a href=\"/index.php?componente=GESTBITA\">Registro de conexiones</a>\n    </li>\n     </ul>\n    </li>\n    <li id=\"SUBMDCAD\">Datos de control\n     <ul>\n    <li id=\"GESTAECO\"><a href=\"/index.php?componente=GESTAECO\">Actividades economicas</a>\n    </li>\n    <li id=\"GESTPROF\"><a href=\"/index.php?componente=GESTPROF\">Profesiones u oficios</a>\n    </li>\n    <li id=\"GESTTIBO\"><a href=\"/index.php?componente=GESTTIBO\">Tipos de bodegas</a>\n    </li>\n    <li id=\"GESTCARG\"><a href=\"/index.php?componente=GESTCARG\">Cargos</a>\n    </li>\n    <li id=\"GESTTIDI\"><a href=\"/index.php?componente=GESTTIDI\">Tipos de documentos de identidad</a>\n    </li>\n    <li id=\"SUBMUBIG\">Ubicación geográfica\n     <ul>\n    <li id=\"GESTPAIS\"><a href=\"/index.php?componente=GESTPAIS\">Paises</a>\n    </li>\n    <li id=\"GESTDEPA\"><a href=\"/index.php?componente=GESTDEPA\">Departamentos</a>\n    </li>\n    <li id=\"GESTMUNI\"><a href=\"/index.php?componente=GESTMUNI\">Municipios</a>\n    </li>\n    <li id=\"GESTCORR\"><a href=\"/index.php?componente=GESTCORR\">Corregimientos</a>\n    </li>\n    <li id=\"GESTBARR\"><a href=\"/index.php?componente=GESTBARR\">Barrios</a>\n    </li>\n     </ul>\n    </li>\n     </ul>\n    </li>\n   </ul>\n   </li>\n   <li id=\"MENUFINS\" class=\"menuPrincipal\"><a href=\"/index.php?componente=MENUFINS\">Finalizar sesión</a>\n   </li>\n</ul>\n\";fechaActual|s:10:\"2009-07-14\";origenOrdenamiento|s:8:\"GESTRECL\";sentidoOrdenamiento|s:3:\"ASC\";columnaOrdenamiento|s:14:\"TIPO_SOLICITUD\";'),('327ab880764abe3437f466c4aff29188',1249333997,'usuario|s:5:\"admin\";contrasena|s:32:\"21232f297a57a5a743894a0e4a801fc3\";sucursal|s:5:\"90000\";cliente|s:13:\"192.168.0.102\";perfil|b:0;id_usuario|s:4:\"0001\";conexion|i:46;menu|s:3633:\"<ul id=\"menuGeneral\" class=\"menu\">\n   <li id=\"MENUPRIN\" class=\"menuPrincipal\"><a href=\"/index.php?componente=MENUPRIN\">Inicio</a>\n   </li>\n   <li id=\"MENUCLIE\" class=\"menuPrincipal\">Clientes\n   <ul class=\"subMenu\">\n    <li id=\"SUBMCOSE\">Control de servicios\n     <ul>\n    <li id=\"GESTCLIE\"><a href=\"/index.php?componente=GESTCLIE\">Clientes</a>\n    </li>\n    <li id=\"GESTSEDE\"><a href=\"/index.php?componente=GESTSEDE\">Sedes clientes</a>\n    </li>\n    <li id=\"GESTRECL\"><a href=\"/index.php?componente=GESTRECL\">Requerimiento clientes</a>\n    </li>\n    <li id=\"GESTREVI\"><a href=\"/index.php?componente=GESTREVI\">Reporte visitas</a>\n    </li>\n    <li id=\"GESTCOCL\"><a href=\"/index.php?componente=GESTCOCL\">Cotizaciones</a>\n    </li>\n    <li id=\"GESTREOB\"><a href=\"/index.php?componente=GESTREOB\">Registro avance obras</a>\n    </li>\n     </ul>\n    </li>\n   </ul>\n   </li>\n   <li id=\"MENUADMI\" class=\"menuPrincipal\">Administración\n   <ul class=\"subMenu\">\n    <li id=\"SUBMESTC\">Estructura corporativa\n     <ul>\n    <li id=\"GESTEMPR\"><a href=\"/index.php?componente=GESTEMPR\">Empresas</a>\n    </li>\n    <li id=\"GESTSUCU\"><a href=\"/index.php?componente=GESTSUCU\">Consorciados</a>\n    </li>\n    <li id=\"GESTBODE\"><a href=\"/index.php?componente=GESTBODE\">Bodegas</a>\n    </li>\n    <li id=\"GESTSECC\"><a href=\"/index.php?componente=GESTSECC\">Secciones</a>\n    </li>\n     </ul>\n    </li>\n    <li id=\"SUBMACCE\">Acceso\n     <ul>\n    <li id=\"GESTPERF\"><a href=\"/index.php?componente=GESTPERF\">Perfiles</a>\n    </li>\n    <li id=\"GESTPREF\">Preferencias\n     <ul>\n    <li id=\"PREFGLOB\"><a href=\"/index.php?componente=PREFGLOB\">Sucursal</a>\n    </li>\n    <li id=\"PREFUSUA\"><a href=\"/index.php?componente=PREFUSUA\">Usuario</a>\n    </li>\n     </ul>\n    </li>\n    <li id=\"GESTUSUA\"><a href=\"/index.php?componente=GESTUSUA\">Usuarios</a>\n    </li>\n    <li id=\"GESTPRIV\"><a href=\"/index.php?componente=GESTPRIV\">Privilegios</a>\n    </li>\n     </ul>\n    </li>\n    <li id=\"SUBMDISP\">Dispositivos\n     <ul>\n    <li id=\"GESTSRVD\"><a href=\"/index.php?componente=GESTSRVD\">Servidores</a>\n    </li>\n    <li id=\"GESTTERM\"><a href=\"/index.php?componente=GESTTERM\">Terminales</a>\n    </li>\n    <li id=\"GESTIMPR\"><a href=\"/index.php?componente=GESTIMPR\">Impresoras</a>\n    </li>\n     </ul>\n    </li>\n    <li id=\"SUBMSEGU\">Seguridad\n     <ul>\n    <li id=\"GESTBITA\"><a href=\"/index.php?componente=GESTBITA\">Registro de conexiones</a>\n    </li>\n     </ul>\n    </li>\n    <li id=\"SUBMDCAD\">Datos de control\n     <ul>\n    <li id=\"GESTAECO\"><a href=\"/index.php?componente=GESTAECO\">Actividades economicas</a>\n    </li>\n    <li id=\"GESTPROF\"><a href=\"/index.php?componente=GESTPROF\">Profesiones u oficios</a>\n    </li>\n    <li id=\"GESTTIBO\"><a href=\"/index.php?componente=GESTTIBO\">Tipos de bodegas</a>\n    </li>\n    <li id=\"GESTCARG\"><a href=\"/index.php?componente=GESTCARG\">Cargos</a>\n    </li>\n    <li id=\"GESTTIDI\"><a href=\"/index.php?componente=GESTTIDI\">Tipos de documentos de identidad</a>\n    </li>\n    <li id=\"SUBMUBIG\">Ubicación geográfica\n     <ul>\n    <li id=\"GESTPAIS\"><a href=\"/index.php?componente=GESTPAIS\">Paises</a>\n    </li>\n    <li id=\"GESTDEPA\"><a href=\"/index.php?componente=GESTDEPA\">Departamentos</a>\n    </li>\n    <li id=\"GESTMUNI\"><a href=\"/index.php?componente=GESTMUNI\">Municipios</a>\n    </li>\n    <li id=\"GESTCORR\"><a href=\"/index.php?componente=GESTCORR\">Corregimientos</a>\n    </li>\n    <li id=\"GESTBARR\"><a href=\"/index.php?componente=GESTBARR\">Barrios</a>\n    </li>\n     </ul>\n    </li>\n     </ul>\n    </li>\n   </ul>\n   </li>\n   <li id=\"MENUFINS\" class=\"menuPrincipal\"><a href=\"/index.php?componente=MENUFINS\">Finalizar sesión</a>\n   </li>\n</ul>\n\";preferencias_individuales|a:1:{s:8:\"impuesto\";s:2:\"16\";}preferencias_globales|a:1:{s:4:\"pais\";i:0;}fechaActual|s:10:\"2009-08-03\";'),('334e28946e16cd59e4df62e15661bff1',1248995198,'usuario|s:5:\"admin\";contrasena|s:32:\"21232f297a57a5a743894a0e4a801fc3\";sucursal|s:5:\"90000\";cliente|s:13:\"192.168.0.107\";perfil|b:0;id_usuario|s:4:\"0001\";conexion|i:31;menu|s:3473:\"<ul id=\"menuGeneral\" class=\"menu\">\n   <li id=\"MENUPRIN\" class=\"menuPrincipal\"><a href=\"/index.php?componente=MENUPRIN\">Inicio</a>\n   </li>\n   <li id=\"MENUCLIE\" class=\"menuPrincipal\">Clientes\n   <ul class=\"subMenu\">\n    <li id=\"SUBMCOSE\">Control de servicios\n     <ul>\n    <li id=\"GESTCLIE\"><a href=\"/index.php?componente=GESTCLIE\">Clientes</a>\n    </li>\n    <li id=\"GESTSEDE\"><a href=\"/index.php?componente=GESTSEDE\">Sedes clientes</a>\n    </li>\n    <li id=\"GESTRECL\"><a href=\"/index.php?componente=GESTRECL\">Requerimiento clientes</a>\n    </li>\n    <li id=\"GESTREVI\"><a href=\"/index.php?componente=GESTREVI\">Reporte visitas</a>\n    </li>\n    <li id=\"GESTCOCL\"><a href=\"/index.php?componente=GESTCOCL\">Cotizaciones</a>\n    </li>\n    <li id=\"GESTAPCO\"><a href=\"/index.php?componente=GESTAPCO\">GESTAPCO</a>\n    </li>\n     </ul>\n    </li>\n   </ul>\n   </li>\n   <li id=\"MENUADMI\" class=\"menuPrincipal\">Administración\n   <ul class=\"subMenu\">\n    <li id=\"SUBMESTC\">Estructura corporativa\n     <ul>\n    <li id=\"GESTEMPR\"><a href=\"/index.php?componente=GESTEMPR\">Empresas</a>\n    </li>\n    <li id=\"GESTSUCU\"><a href=\"/index.php?componente=GESTSUCU\">Consorciados</a>\n    </li>\n    <li id=\"GESTBODE\"><a href=\"/index.php?componente=GESTBODE\">Bodegas</a>\n    </li>\n    <li id=\"GESTSECC\"><a href=\"/index.php?componente=GESTSECC\">Secciones</a>\n    </li>\n     </ul>\n    </li>\n    <li id=\"SUBMACCE\">Acceso\n     <ul>\n    <li id=\"GESTPERF\"><a href=\"/index.php?componente=GESTPERF\">Perfiles</a>\n    </li>\n    <li id=\"GESTUSUA\"><a href=\"/index.php?componente=GESTUSUA\">Usuarios</a>\n    </li>\n    <li id=\"GESTPRIV\"><a href=\"/index.php?componente=GESTPRIV\">Privilegios</a>\n    </li>\n    <li id=\"GESTPREF\"><a href=\"/index.php?componente=GESTPREF\">Preferencias</a>\n    </li>\n     </ul>\n    </li>\n    <li id=\"SUBMDISP\">Dispositivos\n     <ul>\n    <li id=\"GESTSRVD\"><a href=\"/index.php?componente=GESTSRVD\">Servidores</a>\n    </li>\n    <li id=\"GESTTERM\"><a href=\"/index.php?componente=GESTTERM\">Terminales</a>\n    </li>\n    <li id=\"GESTIMPR\"><a href=\"/index.php?componente=GESTIMPR\">Impresoras</a>\n    </li>\n     </ul>\n    </li>\n    <li id=\"SUBMSEGU\">Seguridad\n     <ul>\n    <li id=\"GESTBITA\"><a href=\"/index.php?componente=GESTBITA\">Registro de conexiones</a>\n    </li>\n     </ul>\n    </li>\n    <li id=\"SUBMDCAD\">Datos de control\n     <ul>\n    <li id=\"GESTAECO\"><a href=\"/index.php?componente=GESTAECO\">Actividades economicas</a>\n    </li>\n    <li id=\"GESTPROF\"><a href=\"/index.php?componente=GESTPROF\">Profesiones u oficios</a>\n    </li>\n    <li id=\"GESTTIBO\"><a href=\"/index.php?componente=GESTTIBO\">Tipos de bodegas</a>\n    </li>\n    <li id=\"GESTCARG\"><a href=\"/index.php?componente=GESTCARG\">Cargos</a>\n    </li>\n    <li id=\"GESTTIDI\"><a href=\"/index.php?componente=GESTTIDI\">Tipos de documentos de identidad</a>\n    </li>\n    <li id=\"SUBMUBIG\">Ubicación geográfica\n     <ul>\n    <li id=\"GESTPAIS\"><a href=\"/index.php?componente=GESTPAIS\">Paises</a>\n    </li>\n    <li id=\"GESTDEPA\"><a href=\"/index.php?componente=GESTDEPA\">Departamentos</a>\n    </li>\n    <li id=\"GESTMUNI\"><a href=\"/index.php?componente=GESTMUNI\">Municipios</a>\n    </li>\n    <li id=\"GESTCORR\"><a href=\"/index.php?componente=GESTCORR\">Corregimientos</a>\n    </li>\n    <li id=\"GESTBARR\"><a href=\"/index.php?componente=GESTBARR\">Barrios</a>\n    </li>\n     </ul>\n    </li>\n     </ul>\n    </li>\n   </ul>\n   </li>\n   <li id=\"MENUFINS\" class=\"menuPrincipal\"><a href=\"/index.php?componente=MENUFINS\">Finalizar sesión</a>\n   </li>\n</ul>\n\";fechaActual|s:10:\"2009-07-30\";'),('416c2d8d1eae7c79958f2562a3edbbe4',1248306187,'usuario|s:5:\"admin\";contrasena|s:32:\"21232f297a57a5a743894a0e4a801fc3\";sucursal|s:5:\"90000\";cliente|s:13:\"192.168.0.103\";perfil|b:0;id_usuario|s:4:\"0001\";conexion|i:25;menu|s:3495:\"<ul id=\"menuGeneral\" class=\"menu\">\n   <li id=\"MENUPRIN\" class=\"menuPrincipal\"><a href=\"/index.php?componente=MENUPRIN\">Inicio</a>\n   </li>\n   <li id=\"MENUCLIE\" class=\"menuPrincipal\">Clientes\n   <ul class=\"subMenu\">\n    <li id=\"SUBMCOSE\">Control de servicios\n     <ul>\n    <li id=\"GESTCLIE\"><a href=\"/index.php?componente=GESTCLIE\">Clientes</a>\n    </li>\n    <li id=\"GESTSEDE\"><a href=\"/index.php?componente=GESTSEDE\">Sedes clientes</a>\n    </li>\n    <li id=\"GESTRECL\"><a href=\"/index.php?componente=GESTRECL\">Requerimiento clientes</a>\n    </li>\n    <li id=\"GESTREVI\"><a href=\"/index.php?componente=GESTREVI\">Reporte visitas</a>\n    </li>\n    <li id=\"GESTCOCL\"><a href=\"/index.php?componente=GESTCOCL\">Cotizaciones</a>\n    </li>\n    <li id=\"GESTAPCO\"><a href=\"/index.php?componente=GESTAPCO\">Aprobación / Propuesta cliente</a>\n    </li>\n     </ul>\n    </li>\n   </ul>\n   </li>\n   <li id=\"MENUADMI\" class=\"menuPrincipal\">Administración\n   <ul class=\"subMenu\">\n    <li id=\"SUBMESTC\">Estructura corporativa\n     <ul>\n    <li id=\"GESTEMPR\"><a href=\"/index.php?componente=GESTEMPR\">Empresas</a>\n    </li>\n    <li id=\"GESTSUCU\"><a href=\"/index.php?componente=GESTSUCU\">Consorciados</a>\n    </li>\n    <li id=\"GESTBODE\"><a href=\"/index.php?componente=GESTBODE\">Bodegas</a>\n    </li>\n    <li id=\"GESTSECC\"><a href=\"/index.php?componente=GESTSECC\">Secciones</a>\n    </li>\n     </ul>\n    </li>\n    <li id=\"SUBMACCE\">Acceso\n     <ul>\n    <li id=\"GESTPERF\"><a href=\"/index.php?componente=GESTPERF\">Perfiles</a>\n    </li>\n    <li id=\"GESTUSUA\"><a href=\"/index.php?componente=GESTUSUA\">Usuarios</a>\n    </li>\n    <li id=\"GESTPRIV\"><a href=\"/index.php?componente=GESTPRIV\">Privilegios</a>\n    </li>\n    <li id=\"GESTPREF\"><a href=\"/index.php?componente=GESTPREF\">Preferencias</a>\n    </li>\n     </ul>\n    </li>\n    <li id=\"SUBMDISP\">Dispositivos\n     <ul>\n    <li id=\"GESTSRVD\"><a href=\"/index.php?componente=GESTSRVD\">Servidores</a>\n    </li>\n    <li id=\"GESTTERM\"><a href=\"/index.php?componente=GESTTERM\">Terminales</a>\n    </li>\n    <li id=\"GESTIMPR\"><a href=\"/index.php?componente=GESTIMPR\">Impresoras</a>\n    </li>\n     </ul>\n    </li>\n    <li id=\"SUBMSEGU\">Seguridad\n     <ul>\n    <li id=\"GESTBITA\"><a href=\"/index.php?componente=GESTBITA\">Registro de conexiones</a>\n    </li>\n     </ul>\n    </li>\n    <li id=\"SUBMDCAD\">Datos de control\n     <ul>\n    <li id=\"GESTAECO\"><a href=\"/index.php?componente=GESTAECO\">Actividades economicas</a>\n    </li>\n    <li id=\"GESTPROF\"><a href=\"/index.php?componente=GESTPROF\">Profesiones u oficios</a>\n    </li>\n    <li id=\"GESTTIBO\"><a href=\"/index.php?componente=GESTTIBO\">Tipos de bodegas</a>\n    </li>\n    <li id=\"GESTCARG\"><a href=\"/index.php?componente=GESTCARG\">Cargos</a>\n    </li>\n    <li id=\"GESTTIDI\"><a href=\"/index.php?componente=GESTTIDI\">Tipos de documentos de identidad</a>\n    </li>\n    <li id=\"SUBMUBIG\">Ubicación geográfica\n     <ul>\n    <li id=\"GESTPAIS\"><a href=\"/index.php?componente=GESTPAIS\">Paises</a>\n    </li>\n    <li id=\"GESTDEPA\"><a href=\"/index.php?componente=GESTDEPA\">Departamentos</a>\n    </li>\n    <li id=\"GESTMUNI\"><a href=\"/index.php?componente=GESTMUNI\">Municipios</a>\n    </li>\n    <li id=\"GESTCORR\"><a href=\"/index.php?componente=GESTCORR\">Corregimientos</a>\n    </li>\n    <li id=\"GESTBARR\"><a href=\"/index.php?componente=GESTBARR\">Barrios</a>\n    </li>\n     </ul>\n    </li>\n     </ul>\n    </li>\n   </ul>\n   </li>\n   <li id=\"MENUFINS\" class=\"menuPrincipal\"><a href=\"/index.php?componente=MENUFINS\">Finalizar sesión</a>\n   </li>\n</ul>\n\";fechaActual|s:10:\"2009-07-22\";'),('571f4afd00a86bc2d92f99f92ee025ba',1248299007,'usuario|s:5:\"admin\";contrasena|s:32:\"21232f297a57a5a743894a0e4a801fc3\";sucursal|s:5:\"90000\";cliente|s:13:\"192.168.0.109\";perfil|b:0;id_usuario|s:4:\"0001\";conexion|i:19;menu|s:3402:\"<ul id=\"menuGeneral\" class=\"menu\">\n   <li id=\"MENUPRIN\" class=\"menuPrincipal\"><a href=\"/index.php?componente=MENUPRIN\">Inicio</a>\n   </li>\n   <li id=\"MENUCLIE\" class=\"menuPrincipal\">Clientes\n   <ul class=\"subMenu\">\n    <li id=\"SUBMCOSE\">Control de servicios\n     <ul>\n    <li id=\"GESTCLIE\"><a href=\"/index.php?componente=GESTCLIE\">Clientes</a>\n    </li>\n    <li id=\"GESTSEDE\"><a href=\"/index.php?componente=GESTSEDE\">Sedes clientes</a>\n    </li>\n    <li id=\"GESTRECL\"><a href=\"/index.php?componente=GESTRECL\">Requerimiento clientes</a>\n    </li>\n    <li id=\"GESTCOCL\"><a href=\"/index.php?componente=GESTCOCL\">Cotizaciones</a>\n    </li>\n    <li id=\"GESTAPCO\"><a href=\"/index.php?componente=GESTAPCO\">Aprobación / Propuesta cliente</a>\n    </li>\n     </ul>\n    </li>\n   </ul>\n   </li>\n   <li id=\"MENUADMI\" class=\"menuPrincipal\">Administración\n   <ul class=\"subMenu\">\n    <li id=\"SUBMESTC\">Estructura corporativa\n     <ul>\n    <li id=\"GESTEMPR\"><a href=\"/index.php?componente=GESTEMPR\">Empresas</a>\n    </li>\n    <li id=\"GESTSUCU\"><a href=\"/index.php?componente=GESTSUCU\">Consorciados</a>\n    </li>\n    <li id=\"GESTBODE\"><a href=\"/index.php?componente=GESTBODE\">Bodegas</a>\n    </li>\n    <li id=\"GESTSECC\"><a href=\"/index.php?componente=GESTSECC\">Secciones</a>\n    </li>\n     </ul>\n    </li>\n    <li id=\"SUBMACCE\">Acceso\n     <ul>\n    <li id=\"GESTPERF\"><a href=\"/index.php?componente=GESTPERF\">Perfiles</a>\n    </li>\n    <li id=\"GESTUSUA\"><a href=\"/index.php?componente=GESTUSUA\">Usuarios</a>\n    </li>\n    <li id=\"GESTPRIV\"><a href=\"/index.php?componente=GESTPRIV\">Privilegios</a>\n    </li>\n    <li id=\"GESTPREF\"><a href=\"/index.php?componente=GESTPREF\">Preferencias</a>\n    </li>\n     </ul>\n    </li>\n    <li id=\"SUBMDISP\">Dispositivos\n     <ul>\n    <li id=\"GESTSRVD\"><a href=\"/index.php?componente=GESTSRVD\">Servidores</a>\n    </li>\n    <li id=\"GESTTERM\"><a href=\"/index.php?componente=GESTTERM\">Terminales</a>\n    </li>\n    <li id=\"GESTIMPR\"><a href=\"/index.php?componente=GESTIMPR\">Impresoras</a>\n    </li>\n     </ul>\n    </li>\n    <li id=\"SUBMSEGU\">Seguridad\n     <ul>\n    <li id=\"GESTBITA\"><a href=\"/index.php?componente=GESTBITA\">Registro de conexiones</a>\n    </li>\n     </ul>\n    </li>\n    <li id=\"SUBMDCAD\">Datos de control\n     <ul>\n    <li id=\"GESTAECO\"><a href=\"/index.php?componente=GESTAECO\">Actividades economicas</a>\n    </li>\n    <li id=\"GESTPROF\"><a href=\"/index.php?componente=GESTPROF\">Profesiones u oficios</a>\n    </li>\n    <li id=\"GESTTIBO\"><a href=\"/index.php?componente=GESTTIBO\">Tipos de bodegas</a>\n    </li>\n    <li id=\"GESTCARG\"><a href=\"/index.php?componente=GESTCARG\">Cargos</a>\n    </li>\n    <li id=\"GESTTIDI\"><a href=\"/index.php?componente=GESTTIDI\">Tipos de documentos de identidad</a>\n    </li>\n    <li id=\"SUBMUBIG\">Ubicación geográfica\n     <ul>\n    <li id=\"GESTPAIS\"><a href=\"/index.php?componente=GESTPAIS\">Paises</a>\n    </li>\n    <li id=\"GESTDEPA\"><a href=\"/index.php?componente=GESTDEPA\">Departamentos</a>\n    </li>\n    <li id=\"GESTMUNI\"><a href=\"/index.php?componente=GESTMUNI\">Municipios</a>\n    </li>\n    <li id=\"GESTCORR\"><a href=\"/index.php?componente=GESTCORR\">Corregimientos</a>\n    </li>\n    <li id=\"GESTBARR\"><a href=\"/index.php?componente=GESTBARR\">Barrios</a>\n    </li>\n     </ul>\n    </li>\n     </ul>\n    </li>\n   </ul>\n   </li>\n   <li id=\"MENUFINS\" class=\"menuPrincipal\"><a href=\"/index.php?componente=MENUFINS\">Finalizar sesión</a>\n   </li>\n</ul>\n\";fechaActual|s:10:\"2009-07-22\";'),('5e72d49769d46c841c4610f08364bff6',1247603148,'usuario|s:5:\"admin\";contrasena|s:32:\"21232f297a57a5a743894a0e4a801fc3\";sucursal|s:5:\"90000\";cliente|s:13:\"192.168.0.107\";perfil|b:0;id_usuario|s:4:\"0001\";conexion|i:8;menu|s:3488:\"<ul id=\"menuGeneral\" class=\"menu\">\n   <li id=\"MENUPRIN\" class=\"menuPrincipal\"><a href=\"/index.php?componente=MENUPRIN\">Inicio</a>\n   </li>\n   <li id=\"MENUCLIE\" class=\"menuPrincipal\">Clientes\n   <ul class=\"subMenu\">\n    <li id=\"SUBMCOSE\">Control de servicios\n     <ul>\n    <li id=\"GESTCLIE\"><a href=\"/index.php?componente=GESTCLIE\">Clientes</a>\n    </li>\n    <li id=\"GESTSEDE\"><a href=\"/index.php?componente=GESTSEDE\">Sedes clientes</a>\n    </li>\n    <li id=\"GESTRECL\"><a href=\"/index.php?componente=GESTRECL\">Requerimiento clientes</a>\n    </li>\n    <li id=\"GESTCOCL\"><a href=\"/index.php?componente=GESTCOCL\">Cotizaciones</a>\n    </li>\n    <li id=\"GESTREVI\"><a href=\"/index.php?componente=GESTREVI\">GESTREVI</a>\n    </li>\n    <li id=\"GESTAPCO\"><a href=\"/index.php?componente=GESTAPCO\">Aprobación / Propuesta cliente</a>\n    </li>\n     </ul>\n    </li>\n   </ul>\n   </li>\n   <li id=\"MENUADMI\" class=\"menuPrincipal\">Administración\n   <ul class=\"subMenu\">\n    <li id=\"SUBMESTC\">Estructura corporativa\n     <ul>\n    <li id=\"GESTEMPR\"><a href=\"/index.php?componente=GESTEMPR\">Empresas</a>\n    </li>\n    <li id=\"GESTSUCU\"><a href=\"/index.php?componente=GESTSUCU\">Consorciados</a>\n    </li>\n    <li id=\"GESTBODE\"><a href=\"/index.php?componente=GESTBODE\">Bodegas</a>\n    </li>\n    <li id=\"GESTSECC\"><a href=\"/index.php?componente=GESTSECC\">Secciones</a>\n    </li>\n     </ul>\n    </li>\n    <li id=\"SUBMACCE\">Acceso\n     <ul>\n    <li id=\"GESTPERF\"><a href=\"/index.php?componente=GESTPERF\">Perfiles</a>\n    </li>\n    <li id=\"GESTUSUA\"><a href=\"/index.php?componente=GESTUSUA\">Usuarios</a>\n    </li>\n    <li id=\"GESTPRIV\"><a href=\"/index.php?componente=GESTPRIV\">Privilegios</a>\n    </li>\n    <li id=\"GESTPREF\"><a href=\"/index.php?componente=GESTPREF\">Preferencias</a>\n    </li>\n     </ul>\n    </li>\n    <li id=\"SUBMDISP\">Dispositivos\n     <ul>\n    <li id=\"GESTSRVD\"><a href=\"/index.php?componente=GESTSRVD\">Servidores</a>\n    </li>\n    <li id=\"GESTTERM\"><a href=\"/index.php?componente=GESTTERM\">Terminales</a>\n    </li>\n    <li id=\"GESTIMPR\"><a href=\"/index.php?componente=GESTIMPR\">Impresoras</a>\n    </li>\n     </ul>\n    </li>\n    <li id=\"SUBMSEGU\">Seguridad\n     <ul>\n    <li id=\"GESTBITA\"><a href=\"/index.php?componente=GESTBITA\">Registro de conexiones</a>\n    </li>\n     </ul>\n    </li>\n    <li id=\"SUBMDCAD\">Datos de control\n     <ul>\n    <li id=\"GESTAECO\"><a href=\"/index.php?componente=GESTAECO\">Actividades economicas</a>\n    </li>\n    <li id=\"GESTPROF\"><a href=\"/index.php?componente=GESTPROF\">Profesiones u oficios</a>\n    </li>\n    <li id=\"GESTTIBO\"><a href=\"/index.php?componente=GESTTIBO\">Tipos de bodegas</a>\n    </li>\n    <li id=\"GESTCARG\"><a href=\"/index.php?componente=GESTCARG\">Cargos</a>\n    </li>\n    <li id=\"GESTTIDI\"><a href=\"/index.php?componente=GESTTIDI\">Tipos de documentos de identidad</a>\n    </li>\n    <li id=\"SUBMUBIG\">Ubicación geográfica\n     <ul>\n    <li id=\"GESTPAIS\"><a href=\"/index.php?componente=GESTPAIS\">Paises</a>\n    </li>\n    <li id=\"GESTDEPA\"><a href=\"/index.php?componente=GESTDEPA\">Departamentos</a>\n    </li>\n    <li id=\"GESTMUNI\"><a href=\"/index.php?componente=GESTMUNI\">Municipios</a>\n    </li>\n    <li id=\"GESTCORR\"><a href=\"/index.php?componente=GESTCORR\">Corregimientos</a>\n    </li>\n    <li id=\"GESTBARR\"><a href=\"/index.php?componente=GESTBARR\">Barrios</a>\n    </li>\n     </ul>\n    </li>\n     </ul>\n    </li>\n   </ul>\n   </li>\n   <li id=\"MENUFINS\" class=\"menuPrincipal\"><a href=\"/index.php?componente=MENUFINS\">Finalizar sesión</a>\n   </li>\n</ul>\n\";fechaActual|s:10:\"2009-07-14\";'),('66697a6005ab924baefe4ce46749a1f7',1249332371,'usuario|s:5:\"admin\";contrasena|s:32:\"21232f297a57a5a743894a0e4a801fc3\";sucursal|s:5:\"90000\";cliente|s:13:\"192.168.0.102\";perfil|b:0;id_usuario|s:4:\"0001\";conexion|i:44;menu|s:3633:\"<ul id=\"menuGeneral\" class=\"menu\">\n   <li id=\"MENUPRIN\" class=\"menuPrincipal\"><a href=\"/index.php?componente=MENUPRIN\">Inicio</a>\n   </li>\n   <li id=\"MENUCLIE\" class=\"menuPrincipal\">Clientes\n   <ul class=\"subMenu\">\n    <li id=\"SUBMCOSE\">Control de servicios\n     <ul>\n    <li id=\"GESTCLIE\"><a href=\"/index.php?componente=GESTCLIE\">Clientes</a>\n    </li>\n    <li id=\"GESTSEDE\"><a href=\"/index.php?componente=GESTSEDE\">Sedes clientes</a>\n    </li>\n    <li id=\"GESTRECL\"><a href=\"/index.php?componente=GESTRECL\">Requerimiento clientes</a>\n    </li>\n    <li id=\"GESTREVI\"><a href=\"/index.php?componente=GESTREVI\">Reporte visitas</a>\n    </li>\n    <li id=\"GESTCOCL\"><a href=\"/index.php?componente=GESTCOCL\">Cotizaciones</a>\n    </li>\n    <li id=\"GESTREOB\"><a href=\"/index.php?componente=GESTREOB\">Registro avance obras</a>\n    </li>\n     </ul>\n    </li>\n   </ul>\n   </li>\n   <li id=\"MENUADMI\" class=\"menuPrincipal\">Administración\n   <ul class=\"subMenu\">\n    <li id=\"SUBMESTC\">Estructura corporativa\n     <ul>\n    <li id=\"GESTEMPR\"><a href=\"/index.php?componente=GESTEMPR\">Empresas</a>\n    </li>\n    <li id=\"GESTSUCU\"><a href=\"/index.php?componente=GESTSUCU\">Consorciados</a>\n    </li>\n    <li id=\"GESTBODE\"><a href=\"/index.php?componente=GESTBODE\">Bodegas</a>\n    </li>\n    <li id=\"GESTSECC\"><a href=\"/index.php?componente=GESTSECC\">Secciones</a>\n    </li>\n     </ul>\n    </li>\n    <li id=\"SUBMACCE\">Acceso\n     <ul>\n    <li id=\"GESTPERF\"><a href=\"/index.php?componente=GESTPERF\">Perfiles</a>\n    </li>\n    <li id=\"GESTPREF\">Preferencias\n     <ul>\n    <li id=\"PREFGLOB\"><a href=\"/index.php?componente=PREFGLOB\">Sucursal</a>\n    </li>\n    <li id=\"PREFUSUA\"><a href=\"/index.php?componente=PREFUSUA\">Usuario</a>\n    </li>\n     </ul>\n    </li>\n    <li id=\"GESTUSUA\"><a href=\"/index.php?componente=GESTUSUA\">Usuarios</a>\n    </li>\n    <li id=\"GESTPRIV\"><a href=\"/index.php?componente=GESTPRIV\">Privilegios</a>\n    </li>\n     </ul>\n    </li>\n    <li id=\"SUBMDISP\">Dispositivos\n     <ul>\n    <li id=\"GESTSRVD\"><a href=\"/index.php?componente=GESTSRVD\">Servidores</a>\n    </li>\n    <li id=\"GESTTERM\"><a href=\"/index.php?componente=GESTTERM\">Terminales</a>\n    </li>\n    <li id=\"GESTIMPR\"><a href=\"/index.php?componente=GESTIMPR\">Impresoras</a>\n    </li>\n     </ul>\n    </li>\n    <li id=\"SUBMSEGU\">Seguridad\n     <ul>\n    <li id=\"GESTBITA\"><a href=\"/index.php?componente=GESTBITA\">Registro de conexiones</a>\n    </li>\n     </ul>\n    </li>\n    <li id=\"SUBMDCAD\">Datos de control\n     <ul>\n    <li id=\"GESTAECO\"><a href=\"/index.php?componente=GESTAECO\">Actividades economicas</a>\n    </li>\n    <li id=\"GESTPROF\"><a href=\"/index.php?componente=GESTPROF\">Profesiones u oficios</a>\n    </li>\n    <li id=\"GESTTIBO\"><a href=\"/index.php?componente=GESTTIBO\">Tipos de bodegas</a>\n    </li>\n    <li id=\"GESTCARG\"><a href=\"/index.php?componente=GESTCARG\">Cargos</a>\n    </li>\n    <li id=\"GESTTIDI\"><a href=\"/index.php?componente=GESTTIDI\">Tipos de documentos de identidad</a>\n    </li>\n    <li id=\"SUBMUBIG\">Ubicación geográfica\n     <ul>\n    <li id=\"GESTPAIS\"><a href=\"/index.php?componente=GESTPAIS\">Paises</a>\n    </li>\n    <li id=\"GESTDEPA\"><a href=\"/index.php?componente=GESTDEPA\">Departamentos</a>\n    </li>\n    <li id=\"GESTMUNI\"><a href=\"/index.php?componente=GESTMUNI\">Municipios</a>\n    </li>\n    <li id=\"GESTCORR\"><a href=\"/index.php?componente=GESTCORR\">Corregimientos</a>\n    </li>\n    <li id=\"GESTBARR\"><a href=\"/index.php?componente=GESTBARR\">Barrios</a>\n    </li>\n     </ul>\n    </li>\n     </ul>\n    </li>\n   </ul>\n   </li>\n   <li id=\"MENUFINS\" class=\"menuPrincipal\"><a href=\"/index.php?componente=MENUFINS\">Finalizar sesión</a>\n   </li>\n</ul>\n\";preferencias_individuales|a:1:{s:8:\"impuesto\";s:2:\"16\";}preferencias_globales|a:1:{s:4:\"pais\";i:0;}fechaActual|s:10:\"2009-08-03\";'),('67814e9dde0154ceecb4494b6fef0102',1247603803,'usuario|s:5:\"admin\";contrasena|s:32:\"21232f297a57a5a743894a0e4a801fc3\";sucursal|s:5:\"90000\";cliente|s:13:\"192.168.0.107\";perfil|b:0;id_usuario|s:4:\"0001\";conexion|i:12;menu|s:3402:\"<ul id=\"menuGeneral\" class=\"menu\">\n   <li id=\"MENUPRIN\" class=\"menuPrincipal\"><a href=\"/index.php?componente=MENUPRIN\">Inicio</a>\n   </li>\n   <li id=\"MENUCLIE\" class=\"menuPrincipal\">Clientes\n   <ul class=\"subMenu\">\n    <li id=\"SUBMCOSE\">Control de servicios\n     <ul>\n    <li id=\"GESTCLIE\"><a href=\"/index.php?componente=GESTCLIE\">Clientes</a>\n    </li>\n    <li id=\"GESTSEDE\"><a href=\"/index.php?componente=GESTSEDE\">Sedes clientes</a>\n    </li>\n    <li id=\"GESTRECL\"><a href=\"/index.php?componente=GESTRECL\">Requerimiento clientes</a>\n    </li>\n    <li id=\"GESTCOCL\"><a href=\"/index.php?componente=GESTCOCL\">Cotizaciones</a>\n    </li>\n    <li id=\"GESTAPCO\"><a href=\"/index.php?componente=GESTAPCO\">Aprobación / Propuesta cliente</a>\n    </li>\n     </ul>\n    </li>\n   </ul>\n   </li>\n   <li id=\"MENUADMI\" class=\"menuPrincipal\">Administración\n   <ul class=\"subMenu\">\n    <li id=\"SUBMESTC\">Estructura corporativa\n     <ul>\n    <li id=\"GESTEMPR\"><a href=\"/index.php?componente=GESTEMPR\">Empresas</a>\n    </li>\n    <li id=\"GESTSUCU\"><a href=\"/index.php?componente=GESTSUCU\">Consorciados</a>\n    </li>\n    <li id=\"GESTBODE\"><a href=\"/index.php?componente=GESTBODE\">Bodegas</a>\n    </li>\n    <li id=\"GESTSECC\"><a href=\"/index.php?componente=GESTSECC\">Secciones</a>\n    </li>\n     </ul>\n    </li>\n    <li id=\"SUBMACCE\">Acceso\n     <ul>\n    <li id=\"GESTPERF\"><a href=\"/index.php?componente=GESTPERF\">Perfiles</a>\n    </li>\n    <li id=\"GESTUSUA\"><a href=\"/index.php?componente=GESTUSUA\">Usuarios</a>\n    </li>\n    <li id=\"GESTPRIV\"><a href=\"/index.php?componente=GESTPRIV\">Privilegios</a>\n    </li>\n    <li id=\"GESTPREF\"><a href=\"/index.php?componente=GESTPREF\">Preferencias</a>\n    </li>\n     </ul>\n    </li>\n    <li id=\"SUBMDISP\">Dispositivos\n     <ul>\n    <li id=\"GESTSRVD\"><a href=\"/index.php?componente=GESTSRVD\">Servidores</a>\n    </li>\n    <li id=\"GESTTERM\"><a href=\"/index.php?componente=GESTTERM\">Terminales</a>\n    </li>\n    <li id=\"GESTIMPR\"><a href=\"/index.php?componente=GESTIMPR\">Impresoras</a>\n    </li>\n     </ul>\n    </li>\n    <li id=\"SUBMSEGU\">Seguridad\n     <ul>\n    <li id=\"GESTBITA\"><a href=\"/index.php?componente=GESTBITA\">Registro de conexiones</a>\n    </li>\n     </ul>\n    </li>\n    <li id=\"SUBMDCAD\">Datos de control\n     <ul>\n    <li id=\"GESTAECO\"><a href=\"/index.php?componente=GESTAECO\">Actividades economicas</a>\n    </li>\n    <li id=\"GESTPROF\"><a href=\"/index.php?componente=GESTPROF\">Profesiones u oficios</a>\n    </li>\n    <li id=\"GESTTIBO\"><a href=\"/index.php?componente=GESTTIBO\">Tipos de bodegas</a>\n    </li>\n    <li id=\"GESTCARG\"><a href=\"/index.php?componente=GESTCARG\">Cargos</a>\n    </li>\n    <li id=\"GESTTIDI\"><a href=\"/index.php?componente=GESTTIDI\">Tipos de documentos de identidad</a>\n    </li>\n    <li id=\"SUBMUBIG\">Ubicación geográfica\n     <ul>\n    <li id=\"GESTPAIS\"><a href=\"/index.php?componente=GESTPAIS\">Paises</a>\n    </li>\n    <li id=\"GESTDEPA\"><a href=\"/index.php?componente=GESTDEPA\">Departamentos</a>\n    </li>\n    <li id=\"GESTMUNI\"><a href=\"/index.php?componente=GESTMUNI\">Municipios</a>\n    </li>\n    <li id=\"GESTCORR\"><a href=\"/index.php?componente=GESTCORR\">Corregimientos</a>\n    </li>\n    <li id=\"GESTBARR\"><a href=\"/index.php?componente=GESTBARR\">Barrios</a>\n    </li>\n     </ul>\n    </li>\n     </ul>\n    </li>\n   </ul>\n   </li>\n   <li id=\"MENUFINS\" class=\"menuPrincipal\"><a href=\"/index.php?componente=MENUFINS\">Finalizar sesión</a>\n   </li>\n</ul>\n\";fechaActual|s:10:\"2009-07-14\";'),('6da75e098c0c1bfe27587c24625a23c6',1249331000,'usuario|s:5:\"admin\";contrasena|s:32:\"21232f297a57a5a743894a0e4a801fc3\";sucursal|s:5:\"90000\";cliente|s:13:\"192.168.0.102\";perfil|b:0;id_usuario|s:4:\"0001\";conexion|i:43;menu|s:3633:\"<ul id=\"menuGeneral\" class=\"menu\">\n   <li id=\"MENUPRIN\" class=\"menuPrincipal\"><a href=\"/index.php?componente=MENUPRIN\">Inicio</a>\n   </li>\n   <li id=\"MENUCLIE\" class=\"menuPrincipal\">Clientes\n   <ul class=\"subMenu\">\n    <li id=\"SUBMCOSE\">Control de servicios\n     <ul>\n    <li id=\"GESTCLIE\"><a href=\"/index.php?componente=GESTCLIE\">Clientes</a>\n    </li>\n    <li id=\"GESTSEDE\"><a href=\"/index.php?componente=GESTSEDE\">Sedes clientes</a>\n    </li>\n    <li id=\"GESTRECL\"><a href=\"/index.php?componente=GESTRECL\">Requerimiento clientes</a>\n    </li>\n    <li id=\"GESTREVI\"><a href=\"/index.php?componente=GESTREVI\">Reporte visitas</a>\n    </li>\n    <li id=\"GESTCOCL\"><a href=\"/index.php?componente=GESTCOCL\">Cotizaciones</a>\n    </li>\n    <li id=\"GESTREOB\"><a href=\"/index.php?componente=GESTREOB\">Registro avance obras</a>\n    </li>\n     </ul>\n    </li>\n   </ul>\n   </li>\n   <li id=\"MENUADMI\" class=\"menuPrincipal\">Administración\n   <ul class=\"subMenu\">\n    <li id=\"SUBMESTC\">Estructura corporativa\n     <ul>\n    <li id=\"GESTEMPR\"><a href=\"/index.php?componente=GESTEMPR\">Empresas</a>\n    </li>\n    <li id=\"GESTSUCU\"><a href=\"/index.php?componente=GESTSUCU\">Consorciados</a>\n    </li>\n    <li id=\"GESTBODE\"><a href=\"/index.php?componente=GESTBODE\">Bodegas</a>\n    </li>\n    <li id=\"GESTSECC\"><a href=\"/index.php?componente=GESTSECC\">Secciones</a>\n    </li>\n     </ul>\n    </li>\n    <li id=\"SUBMACCE\">Acceso\n     <ul>\n    <li id=\"GESTPERF\"><a href=\"/index.php?componente=GESTPERF\">Perfiles</a>\n    </li>\n    <li id=\"GESTPREF\">Preferencias\n     <ul>\n    <li id=\"PREFGLOB\"><a href=\"/index.php?componente=PREFGLOB\">Sucursal</a>\n    </li>\n    <li id=\"PREFUSUA\"><a href=\"/index.php?componente=PREFUSUA\">Usuario</a>\n    </li>\n     </ul>\n    </li>\n    <li id=\"GESTUSUA\"><a href=\"/index.php?componente=GESTUSUA\">Usuarios</a>\n    </li>\n    <li id=\"GESTPRIV\"><a href=\"/index.php?componente=GESTPRIV\">Privilegios</a>\n    </li>\n     </ul>\n    </li>\n    <li id=\"SUBMDISP\">Dispositivos\n     <ul>\n    <li id=\"GESTSRVD\"><a href=\"/index.php?componente=GESTSRVD\">Servidores</a>\n    </li>\n    <li id=\"GESTTERM\"><a href=\"/index.php?componente=GESTTERM\">Terminales</a>\n    </li>\n    <li id=\"GESTIMPR\"><a href=\"/index.php?componente=GESTIMPR\">Impresoras</a>\n    </li>\n     </ul>\n    </li>\n    <li id=\"SUBMSEGU\">Seguridad\n     <ul>\n    <li id=\"GESTBITA\"><a href=\"/index.php?componente=GESTBITA\">Registro de conexiones</a>\n    </li>\n     </ul>\n    </li>\n    <li id=\"SUBMDCAD\">Datos de control\n     <ul>\n    <li id=\"GESTAECO\"><a href=\"/index.php?componente=GESTAECO\">Actividades economicas</a>\n    </li>\n    <li id=\"GESTPROF\"><a href=\"/index.php?componente=GESTPROF\">Profesiones u oficios</a>\n    </li>\n    <li id=\"GESTTIBO\"><a href=\"/index.php?componente=GESTTIBO\">Tipos de bodegas</a>\n    </li>\n    <li id=\"GESTCARG\"><a href=\"/index.php?componente=GESTCARG\">Cargos</a>\n    </li>\n    <li id=\"GESTTIDI\"><a href=\"/index.php?componente=GESTTIDI\">Tipos de documentos de identidad</a>\n    </li>\n    <li id=\"SUBMUBIG\">Ubicación geográfica\n     <ul>\n    <li id=\"GESTPAIS\"><a href=\"/index.php?componente=GESTPAIS\">Paises</a>\n    </li>\n    <li id=\"GESTDEPA\"><a href=\"/index.php?componente=GESTDEPA\">Departamentos</a>\n    </li>\n    <li id=\"GESTMUNI\"><a href=\"/index.php?componente=GESTMUNI\">Municipios</a>\n    </li>\n    <li id=\"GESTCORR\"><a href=\"/index.php?componente=GESTCORR\">Corregimientos</a>\n    </li>\n    <li id=\"GESTBARR\"><a href=\"/index.php?componente=GESTBARR\">Barrios</a>\n    </li>\n     </ul>\n    </li>\n     </ul>\n    </li>\n   </ul>\n   </li>\n   <li id=\"MENUFINS\" class=\"menuPrincipal\"><a href=\"/index.php?componente=MENUFINS\">Finalizar sesión</a>\n   </li>\n</ul>\n\";preferencias_individuales|a:1:{s:8:\"impuesto\";s:2:\"16\";}preferencias_globales|a:1:{s:4:\"pais\";i:0;}fechaActual|s:10:\"2009-08-03\";'),('6spaqp5sr8s6uqdnn4oas7jmv7',1249435018,'usuario|s:5:\"admin\";contrasena|s:32:\"21232f297a57a5a743894a0e4a801fc3\";sucursal|s:5:\"90000\";cliente|s:9:\"127.0.0.1\";perfil|b:0;id_usuario|s:4:\"0001\";conexion|i:84;menu|s:4178:\"<ul id=\"menuGeneral\" class=\"menu\">\n   <li id=\"MENUPRIN\" class=\"menuPrincipal\"><a href=\"/cimco/publico/index.php?componente=MENUPRIN\">Inicio</a>\n   </li>\n   <li id=\"MENUCLIE\" class=\"menuPrincipal\">Clientes\n   <ul class=\"subMenu\">\n    <li id=\"SUBMCOSE\">Control de servicios\n     <ul>\n    <li id=\"GESTCLIE\"><a href=\"/cimco/publico/index.php?componente=GESTCLIE\">Clientes</a>\n    </li>\n    <li id=\"GESTSEDE\"><a href=\"/cimco/publico/index.php?componente=GESTSEDE\">Sedes clientes</a>\n    </li>\n    <li id=\"GESTRECL\"><a href=\"/cimco/publico/index.php?componente=GESTRECL\">Requerimiento clientes</a>\n    </li>\n    <li id=\"GESTREVI\"><a href=\"/cimco/publico/index.php?componente=GESTREVI\">Reporte visitas</a>\n    </li>\n    <li id=\"GESTCOCL\"><a href=\"/cimco/publico/index.php?componente=GESTCOCL\">Cotizaciones</a>\n    </li>\n    <li id=\"GESTREOB\"><a href=\"/cimco/publico/index.php?componente=GESTREOB\">Registro avance obras</a>\n    </li>\n    <li id=\"GESTACTA\"><a href=\"/cimco/publico/index.php?componente=GESTACTA\">Mantenimiento actas</a>\n    </li>\n     </ul>\n    </li>\n   </ul>\n   </li>\n   <li id=\"MENUADMI\" class=\"menuPrincipal\">Administración\n   <ul class=\"subMenu\">\n    <li id=\"SUBMESTC\">Estructura corporativa\n     <ul>\n    <li id=\"GESTEMPR\"><a href=\"/cimco/publico/index.php?componente=GESTEMPR\">Empresas</a>\n    </li>\n    <li id=\"GESTSUCU\"><a href=\"/cimco/publico/index.php?componente=GESTSUCU\">Consorciados</a>\n    </li>\n    <li id=\"GESTBODE\"><a href=\"/cimco/publico/index.php?componente=GESTBODE\">Bodegas</a>\n    </li>\n    <li id=\"GESTSECC\"><a href=\"/cimco/publico/index.php?componente=GESTSECC\">Secciones</a>\n    </li>\n     </ul>\n    </li>\n    <li id=\"SUBMACCE\">Acceso\n     <ul>\n    <li id=\"GESTPERF\"><a href=\"/cimco/publico/index.php?componente=GESTPERF\">Perfiles</a>\n    </li>\n    <li id=\"GESTPREF\">Preferencias\n     <ul>\n    <li id=\"PREFGLOB\"><a href=\"/cimco/publico/index.php?componente=PREFGLOB\">Sucursal</a>\n    </li>\n    <li id=\"PREFUSUA\"><a href=\"/cimco/publico/index.php?componente=PREFUSUA\">Usuario</a>\n    </li>\n     </ul>\n    </li>\n    <li id=\"GESTUSUA\"><a href=\"/cimco/publico/index.php?componente=GESTUSUA\">Usuarios</a>\n    </li>\n    <li id=\"GESTPRIV\"><a href=\"/cimco/publico/index.php?componente=GESTPRIV\">Privilegios</a>\n    </li>\n     </ul>\n    </li>\n    <li id=\"SUBMDISP\">Dispositivos\n     <ul>\n    <li id=\"GESTSRVD\"><a href=\"/cimco/publico/index.php?componente=GESTSRVD\">Servidores</a>\n    </li>\n    <li id=\"GESTTERM\"><a href=\"/cimco/publico/index.php?componente=GESTTERM\">Terminales</a>\n    </li>\n    <li id=\"GESTIMPR\"><a href=\"/cimco/publico/index.php?componente=GESTIMPR\">Impresoras</a>\n    </li>\n     </ul>\n    </li>\n    <li id=\"SUBMSEGU\">Seguridad\n     <ul>\n    <li id=\"GESTBITA\"><a href=\"/cimco/publico/index.php?componente=GESTBITA\">Registro de conexiones</a>\n    </li>\n     </ul>\n    </li>\n    <li id=\"SUBMDCAD\">Datos de control\n     <ul>\n    <li id=\"GESTAECO\"><a href=\"/cimco/publico/index.php?componente=GESTAECO\">Actividades economicas</a>\n    </li>\n    <li id=\"GESTPROF\"><a href=\"/cimco/publico/index.php?componente=GESTPROF\">Profesiones u oficios</a>\n    </li>\n    <li id=\"GESTTIBO\"><a href=\"/cimco/publico/index.php?componente=GESTTIBO\">Tipos de bodegas</a>\n    </li>\n    <li id=\"GESTCARG\"><a href=\"/cimco/publico/index.php?componente=GESTCARG\">Cargos</a>\n    </li>\n    <li id=\"GESTTIDI\"><a href=\"/cimco/publico/index.php?componente=GESTTIDI\">Tipos de documentos de identidad</a>\n    </li>\n    <li id=\"SUBMUBIG\">Ubicación geográfica\n     <ul>\n    <li id=\"GESTPAIS\"><a href=\"/cimco/publico/index.php?componente=GESTPAIS\">Paises</a>\n    </li>\n    <li id=\"GESTDEPA\"><a href=\"/cimco/publico/index.php?componente=GESTDEPA\">Departamentos</a>\n    </li>\n    <li id=\"GESTMUNI\"><a href=\"/cimco/publico/index.php?componente=GESTMUNI\">Municipios</a>\n    </li>\n    <li id=\"GESTCORR\"><a href=\"/cimco/publico/index.php?componente=GESTCORR\">Corregimientos</a>\n    </li>\n    <li id=\"GESTBARR\"><a href=\"/cimco/publico/index.php?componente=GESTBARR\">Barrios</a>\n    </li>\n     </ul>\n    </li>\n     </ul>\n    </li>\n   </ul>\n   </li>\n   <li id=\"MENUFINS\" class=\"menuPrincipal\"><a href=\"/cimco/publico/index.php?componente=MENUFINS\">Finalizar sesión</a>\n   </li>\n</ul>\n\";preferencias_individuales|a:1:{s:8:\"impuesto\";s:2:\"16\";}preferencias_globales|a:1:{s:4:\"pais\";i:0;}'),('70itan531geudb2kjn4g4elnm4',1249426038,'usuario|s:5:\"admin\";contrasena|s:32:\"21232f297a57a5a743894a0e4a801fc3\";sucursal|s:5:\"90000\";cliente|s:9:\"127.0.0.1\";perfil|b:0;id_usuario|s:4:\"0001\";conexion|i:49;menu|s:4178:\"<ul id=\"menuGeneral\" class=\"menu\">\n   <li id=\"MENUPRIN\" class=\"menuPrincipal\"><a href=\"/cimco/publico/index.php?componente=MENUPRIN\">Inicio</a>\n   </li>\n   <li id=\"MENUCLIE\" class=\"menuPrincipal\">Clientes\n   <ul class=\"subMenu\">\n    <li id=\"SUBMCOSE\">Control de servicios\n     <ul>\n    <li id=\"GESTCLIE\"><a href=\"/cimco/publico/index.php?componente=GESTCLIE\">Clientes</a>\n    </li>\n    <li id=\"GESTSEDE\"><a href=\"/cimco/publico/index.php?componente=GESTSEDE\">Sedes clientes</a>\n    </li>\n    <li id=\"GESTRECL\"><a href=\"/cimco/publico/index.php?componente=GESTRECL\">Requerimiento clientes</a>\n    </li>\n    <li id=\"GESTREVI\"><a href=\"/cimco/publico/index.php?componente=GESTREVI\">Reporte visitas</a>\n    </li>\n    <li id=\"GESTCOCL\"><a href=\"/cimco/publico/index.php?componente=GESTCOCL\">Cotizaciones</a>\n    </li>\n    <li id=\"GESTREOB\"><a href=\"/cimco/publico/index.php?componente=GESTREOB\">Registro avance obras</a>\n    </li>\n    <li id=\"GESTACTA\"><a href=\"/cimco/publico/index.php?componente=GESTACTA\">Mantenimiento actas</a>\n    </li>\n     </ul>\n    </li>\n   </ul>\n   </li>\n   <li id=\"MENUADMI\" class=\"menuPrincipal\">Administración\n   <ul class=\"subMenu\">\n    <li id=\"SUBMESTC\">Estructura corporativa\n     <ul>\n    <li id=\"GESTEMPR\"><a href=\"/cimco/publico/index.php?componente=GESTEMPR\">Empresas</a>\n    </li>\n    <li id=\"GESTSUCU\"><a href=\"/cimco/publico/index.php?componente=GESTSUCU\">Consorciados</a>\n    </li>\n    <li id=\"GESTBODE\"><a href=\"/cimco/publico/index.php?componente=GESTBODE\">Bodegas</a>\n    </li>\n    <li id=\"GESTSECC\"><a href=\"/cimco/publico/index.php?componente=GESTSECC\">Secciones</a>\n    </li>\n     </ul>\n    </li>\n    <li id=\"SUBMACCE\">Acceso\n     <ul>\n    <li id=\"GESTPERF\"><a href=\"/cimco/publico/index.php?componente=GESTPERF\">Perfiles</a>\n    </li>\n    <li id=\"GESTPREF\">Preferencias\n     <ul>\n    <li id=\"PREFGLOB\"><a href=\"/cimco/publico/index.php?componente=PREFGLOB\">Sucursal</a>\n    </li>\n    <li id=\"PREFUSUA\"><a href=\"/cimco/publico/index.php?componente=PREFUSUA\">Usuario</a>\n    </li>\n     </ul>\n    </li>\n    <li id=\"GESTUSUA\"><a href=\"/cimco/publico/index.php?componente=GESTUSUA\">Usuarios</a>\n    </li>\n    <li id=\"GESTPRIV\"><a href=\"/cimco/publico/index.php?componente=GESTPRIV\">Privilegios</a>\n    </li>\n     </ul>\n    </li>\n    <li id=\"SUBMDISP\">Dispositivos\n     <ul>\n    <li id=\"GESTSRVD\"><a href=\"/cimco/publico/index.php?componente=GESTSRVD\">Servidores</a>\n    </li>\n    <li id=\"GESTTERM\"><a href=\"/cimco/publico/index.php?componente=GESTTERM\">Terminales</a>\n    </li>\n    <li id=\"GESTIMPR\"><a href=\"/cimco/publico/index.php?componente=GESTIMPR\">Impresoras</a>\n    </li>\n     </ul>\n    </li>\n    <li id=\"SUBMSEGU\">Seguridad\n     <ul>\n    <li id=\"GESTBITA\"><a href=\"/cimco/publico/index.php?componente=GESTBITA\">Registro de conexiones</a>\n    </li>\n     </ul>\n    </li>\n    <li id=\"SUBMDCAD\">Datos de control\n     <ul>\n    <li id=\"GESTAECO\"><a href=\"/cimco/publico/index.php?componente=GESTAECO\">Actividades economicas</a>\n    </li>\n    <li id=\"GESTPROF\"><a href=\"/cimco/publico/index.php?componente=GESTPROF\">Profesiones u oficios</a>\n    </li>\n    <li id=\"GESTTIBO\"><a href=\"/cimco/publico/index.php?componente=GESTTIBO\">Tipos de bodegas</a>\n    </li>\n    <li id=\"GESTCARG\"><a href=\"/cimco/publico/index.php?componente=GESTCARG\">Cargos</a>\n    </li>\n    <li id=\"GESTTIDI\"><a href=\"/cimco/publico/index.php?componente=GESTTIDI\">Tipos de documentos de identidad</a>\n    </li>\n    <li id=\"SUBMUBIG\">Ubicación geográfica\n     <ul>\n    <li id=\"GESTPAIS\"><a href=\"/cimco/publico/index.php?componente=GESTPAIS\">Paises</a>\n    </li>\n    <li id=\"GESTDEPA\"><a href=\"/cimco/publico/index.php?componente=GESTDEPA\">Departamentos</a>\n    </li>\n    <li id=\"GESTMUNI\"><a href=\"/cimco/publico/index.php?componente=GESTMUNI\">Municipios</a>\n    </li>\n    <li id=\"GESTCORR\"><a href=\"/cimco/publico/index.php?componente=GESTCORR\">Corregimientos</a>\n    </li>\n    <li id=\"GESTBARR\"><a href=\"/cimco/publico/index.php?componente=GESTBARR\">Barrios</a>\n    </li>\n     </ul>\n    </li>\n     </ul>\n    </li>\n   </ul>\n   </li>\n   <li id=\"MENUFINS\" class=\"menuPrincipal\"><a href=\"/cimco/publico/index.php?componente=MENUFINS\">Finalizar sesión</a>\n   </li>\n</ul>\n\";preferencias_individuales|a:1:{s:8:\"impuesto\";s:2:\"16\";}preferencias_globales|a:1:{s:4:\"pais\";i:0;}fechaActual|s:9:\"CURDATE()\";origenOrdenamiento|s:8:\"GESTCOCL\";sentidoOrdenamiento|s:3:\"ASC\";columnaOrdenamiento|s:17:\"NUMERO_COTIZACION\";'),('92db3b3d5138e1a9065ff7a03675ddcc',1248990000,'usuario|s:5:\"admin\";contrasena|s:32:\"21232f297a57a5a743894a0e4a801fc3\";sucursal|s:5:\"90000\";cliente|s:13:\"192.168.0.107\";perfil|b:0;id_usuario|s:4:\"0001\";conexion|i:30;menu|s:3473:\"<ul id=\"menuGeneral\" class=\"menu\">\n   <li id=\"MENUPRIN\" class=\"menuPrincipal\"><a href=\"/index.php?componente=MENUPRIN\">Inicio</a>\n   </li>\n   <li id=\"MENUCLIE\" class=\"menuPrincipal\">Clientes\n   <ul class=\"subMenu\">\n    <li id=\"SUBMCOSE\">Control de servicios\n     <ul>\n    <li id=\"GESTCLIE\"><a href=\"/index.php?componente=GESTCLIE\">Clientes</a>\n    </li>\n    <li id=\"GESTSEDE\"><a href=\"/index.php?componente=GESTSEDE\">Sedes clientes</a>\n    </li>\n    <li id=\"GESTRECL\"><a href=\"/index.php?componente=GESTRECL\">Requerimiento clientes</a>\n    </li>\n    <li id=\"GESTREVI\"><a href=\"/index.php?componente=GESTREVI\">Reporte visitas</a>\n    </li>\n    <li id=\"GESTCOCL\"><a href=\"/index.php?componente=GESTCOCL\">Cotizaciones</a>\n    </li>\n    <li id=\"GESTAPCO\"><a href=\"/index.php?componente=GESTAPCO\">GESTAPCO</a>\n    </li>\n     </ul>\n    </li>\n   </ul>\n   </li>\n   <li id=\"MENUADMI\" class=\"menuPrincipal\">Administración\n   <ul class=\"subMenu\">\n    <li id=\"SUBMESTC\">Estructura corporativa\n     <ul>\n    <li id=\"GESTEMPR\"><a href=\"/index.php?componente=GESTEMPR\">Empresas</a>\n    </li>\n    <li id=\"GESTSUCU\"><a href=\"/index.php?componente=GESTSUCU\">Consorciados</a>\n    </li>\n    <li id=\"GESTBODE\"><a href=\"/index.php?componente=GESTBODE\">Bodegas</a>\n    </li>\n    <li id=\"GESTSECC\"><a href=\"/index.php?componente=GESTSECC\">Secciones</a>\n    </li>\n     </ul>\n    </li>\n    <li id=\"SUBMACCE\">Acceso\n     <ul>\n    <li id=\"GESTPERF\"><a href=\"/index.php?componente=GESTPERF\">Perfiles</a>\n    </li>\n    <li id=\"GESTUSUA\"><a href=\"/index.php?componente=GESTUSUA\">Usuarios</a>\n    </li>\n    <li id=\"GESTPRIV\"><a href=\"/index.php?componente=GESTPRIV\">Privilegios</a>\n    </li>\n    <li id=\"GESTPREF\"><a href=\"/index.php?componente=GESTPREF\">Preferencias</a>\n    </li>\n     </ul>\n    </li>\n    <li id=\"SUBMDISP\">Dispositivos\n     <ul>\n    <li id=\"GESTSRVD\"><a href=\"/index.php?componente=GESTSRVD\">Servidores</a>\n    </li>\n    <li id=\"GESTTERM\"><a href=\"/index.php?componente=GESTTERM\">Terminales</a>\n    </li>\n    <li id=\"GESTIMPR\"><a href=\"/index.php?componente=GESTIMPR\">Impresoras</a>\n    </li>\n     </ul>\n    </li>\n    <li id=\"SUBMSEGU\">Seguridad\n     <ul>\n    <li id=\"GESTBITA\"><a href=\"/index.php?componente=GESTBITA\">Registro de conexiones</a>\n    </li>\n     </ul>\n    </li>\n    <li id=\"SUBMDCAD\">Datos de control\n     <ul>\n    <li id=\"GESTAECO\"><a href=\"/index.php?componente=GESTAECO\">Actividades economicas</a>\n    </li>\n    <li id=\"GESTPROF\"><a href=\"/index.php?componente=GESTPROF\">Profesiones u oficios</a>\n    </li>\n    <li id=\"GESTTIBO\"><a href=\"/index.php?componente=GESTTIBO\">Tipos de bodegas</a>\n    </li>\n    <li id=\"GESTCARG\"><a href=\"/index.php?componente=GESTCARG\">Cargos</a>\n    </li>\n    <li id=\"GESTTIDI\"><a href=\"/index.php?componente=GESTTIDI\">Tipos de documentos de identidad</a>\n    </li>\n    <li id=\"SUBMUBIG\">Ubicación geográfica\n     <ul>\n    <li id=\"GESTPAIS\"><a href=\"/index.php?componente=GESTPAIS\">Paises</a>\n    </li>\n    <li id=\"GESTDEPA\"><a href=\"/index.php?componente=GESTDEPA\">Departamentos</a>\n    </li>\n    <li id=\"GESTMUNI\"><a href=\"/index.php?componente=GESTMUNI\">Municipios</a>\n    </li>\n    <li id=\"GESTCORR\"><a href=\"/index.php?componente=GESTCORR\">Corregimientos</a>\n    </li>\n    <li id=\"GESTBARR\"><a href=\"/index.php?componente=GESTBARR\">Barrios</a>\n    </li>\n     </ul>\n    </li>\n     </ul>\n    </li>\n   </ul>\n   </li>\n   <li id=\"MENUFINS\" class=\"menuPrincipal\"><a href=\"/index.php?componente=MENUFINS\">Finalizar sesión</a>\n   </li>\n</ul>\n\";fechaActual|s:10:\"2009-07-30\";'),('ae9cc234c8360f708ef95bdcab4cd960',1248285135,''),('cfdb41b80ceaffbf79383c5ebb5221d8',1248303235,'usuario|s:5:\"admin\";contrasena|s:32:\"21232f297a57a5a743894a0e4a801fc3\";sucursal|s:5:\"90000\";cliente|s:13:\"192.168.0.103\";perfil|b:0;id_usuario|s:4:\"0001\";conexion|i:24;menu|s:3495:\"<ul id=\"menuGeneral\" class=\"menu\">\n   <li id=\"MENUPRIN\" class=\"menuPrincipal\"><a href=\"/index.php?componente=MENUPRIN\">Inicio</a>\n   </li>\n   <li id=\"MENUCLIE\" class=\"menuPrincipal\">Clientes\n   <ul class=\"subMenu\">\n    <li id=\"SUBMCOSE\">Control de servicios\n     <ul>\n    <li id=\"GESTCLIE\"><a href=\"/index.php?componente=GESTCLIE\">Clientes</a>\n    </li>\n    <li id=\"GESTSEDE\"><a href=\"/index.php?componente=GESTSEDE\">Sedes clientes</a>\n    </li>\n    <li id=\"GESTRECL\"><a href=\"/index.php?componente=GESTRECL\">Requerimiento clientes</a>\n    </li>\n    <li id=\"GESTREVI\"><a href=\"/index.php?componente=GESTREVI\">Reporte visitas</a>\n    </li>\n    <li id=\"GESTCOCL\"><a href=\"/index.php?componente=GESTCOCL\">Cotizaciones</a>\n    </li>\n    <li id=\"GESTAPCO\"><a href=\"/index.php?componente=GESTAPCO\">Aprobación / Propuesta cliente</a>\n    </li>\n     </ul>\n    </li>\n   </ul>\n   </li>\n   <li id=\"MENUADMI\" class=\"menuPrincipal\">Administración\n   <ul class=\"subMenu\">\n    <li id=\"SUBMESTC\">Estructura corporativa\n     <ul>\n    <li id=\"GESTEMPR\"><a href=\"/index.php?componente=GESTEMPR\">Empresas</a>\n    </li>\n    <li id=\"GESTSUCU\"><a href=\"/index.php?componente=GESTSUCU\">Consorciados</a>\n    </li>\n    <li id=\"GESTBODE\"><a href=\"/index.php?componente=GESTBODE\">Bodegas</a>\n    </li>\n    <li id=\"GESTSECC\"><a href=\"/index.php?componente=GESTSECC\">Secciones</a>\n    </li>\n     </ul>\n    </li>\n    <li id=\"SUBMACCE\">Acceso\n     <ul>\n    <li id=\"GESTPERF\"><a href=\"/index.php?componente=GESTPERF\">Perfiles</a>\n    </li>\n    <li id=\"GESTUSUA\"><a href=\"/index.php?componente=GESTUSUA\">Usuarios</a>\n    </li>\n    <li id=\"GESTPRIV\"><a href=\"/index.php?componente=GESTPRIV\">Privilegios</a>\n    </li>\n    <li id=\"GESTPREF\"><a href=\"/index.php?componente=GESTPREF\">Preferencias</a>\n    </li>\n     </ul>\n    </li>\n    <li id=\"SUBMDISP\">Dispositivos\n     <ul>\n    <li id=\"GESTSRVD\"><a href=\"/index.php?componente=GESTSRVD\">Servidores</a>\n    </li>\n    <li id=\"GESTTERM\"><a href=\"/index.php?componente=GESTTERM\">Terminales</a>\n    </li>\n    <li id=\"GESTIMPR\"><a href=\"/index.php?componente=GESTIMPR\">Impresoras</a>\n    </li>\n     </ul>\n    </li>\n    <li id=\"SUBMSEGU\">Seguridad\n     <ul>\n    <li id=\"GESTBITA\"><a href=\"/index.php?componente=GESTBITA\">Registro de conexiones</a>\n    </li>\n     </ul>\n    </li>\n    <li id=\"SUBMDCAD\">Datos de control\n     <ul>\n    <li id=\"GESTAECO\"><a href=\"/index.php?componente=GESTAECO\">Actividades economicas</a>\n    </li>\n    <li id=\"GESTPROF\"><a href=\"/index.php?componente=GESTPROF\">Profesiones u oficios</a>\n    </li>\n    <li id=\"GESTTIBO\"><a href=\"/index.php?componente=GESTTIBO\">Tipos de bodegas</a>\n    </li>\n    <li id=\"GESTCARG\"><a href=\"/index.php?componente=GESTCARG\">Cargos</a>\n    </li>\n    <li id=\"GESTTIDI\"><a href=\"/index.php?componente=GESTTIDI\">Tipos de documentos de identidad</a>\n    </li>\n    <li id=\"SUBMUBIG\">Ubicación geográfica\n     <ul>\n    <li id=\"GESTPAIS\"><a href=\"/index.php?componente=GESTPAIS\">Paises</a>\n    </li>\n    <li id=\"GESTDEPA\"><a href=\"/index.php?componente=GESTDEPA\">Departamentos</a>\n    </li>\n    <li id=\"GESTMUNI\"><a href=\"/index.php?componente=GESTMUNI\">Municipios</a>\n    </li>\n    <li id=\"GESTCORR\"><a href=\"/index.php?componente=GESTCORR\">Corregimientos</a>\n    </li>\n    <li id=\"GESTBARR\"><a href=\"/index.php?componente=GESTBARR\">Barrios</a>\n    </li>\n     </ul>\n    </li>\n     </ul>\n    </li>\n   </ul>\n   </li>\n   <li id=\"MENUFINS\" class=\"menuPrincipal\"><a href=\"/index.php?componente=MENUFINS\">Finalizar sesión</a>\n   </li>\n</ul>\n\";fechaActual|s:10:\"2009-07-22\";origenOrdenamiento|s:8:\"GESTRECL\";sentidoOrdenamiento|s:3:\"ASC\";columnaOrdenamiento|s:14:\"TIPO_SOLICITUD\";'),('d843hubrjjbeik57pbdoi961d0',1247510513,'usuario|s:5:\"admin\";contrasena|s:32:\"21232f297a57a5a743894a0e4a801fc3\";sucursal|s:5:\"90000\";cliente|s:9:\"127.0.0.1\";perfil|s:8:\"90000000\";id_usuario|s:4:\"0001\";conexion|i:5;menu|s:3908:\"<ul id=\"menuGeneral\" class=\"menu\">\n   <li id=\"MENUPRIN\" class=\"menuPrincipal\"><a href=\"/cimco/publico/index.php?componente=MENUPRIN\">Inicio</a>\n   </li>\n   <li id=\"MENUCLIE\" class=\"menuPrincipal\">Clientes\n   <ul class=\"subMenu\">\n    <li id=\"SUBMCOSE\">Control de servicios\n     <ul>\n    <li id=\"GESTCLIE\"><a href=\"/cimco/publico/index.php?componente=GESTCLIE\">Clientes</a>\n    </li>\n    <li id=\"GESTSEDE\"><a href=\"/cimco/publico/index.php?componente=GESTSEDE\">Sedes clientes</a>\n    </li>\n    <li id=\"GESTRECL\"><a href=\"/cimco/publico/index.php?componente=GESTRECL\">Requerimiento clientes</a>\n    </li>\n    <li id=\"GESTCOCL\"><a href=\"/cimco/publico/index.php?componente=GESTCOCL\">Cotizaciones</a>\n    </li>\n    <li id=\"GESTREVI\"><a href=\"/cimco/publico/index.php?componente=GESTREVI\">GESTREVI</a>\n    </li>\n    <li id=\"GESTAPCO\"><a href=\"/cimco/publico/index.php?componente=GESTAPCO\">Aprobación / Propuesta cliente</a>\n    </li>\n     </ul>\n    </li>\n   </ul>\n   </li>\n   <li id=\"MENUADMI\" class=\"menuPrincipal\">Administración\n   <ul class=\"subMenu\">\n    <li id=\"SUBMESTC\">Estructura corporativa\n     <ul>\n    <li id=\"GESTEMPR\"><a href=\"/cimco/publico/index.php?componente=GESTEMPR\">Empresas</a>\n    </li>\n    <li id=\"GESTSUCU\"><a href=\"/cimco/publico/index.php?componente=GESTSUCU\">Consorciados</a>\n    </li>\n    <li id=\"GESTBODE\"><a href=\"/cimco/publico/index.php?componente=GESTBODE\">Bodegas</a>\n    </li>\n    <li id=\"GESTSECC\"><a href=\"/cimco/publico/index.php?componente=GESTSECC\">Secciones</a>\n    </li>\n     </ul>\n    </li>\n    <li id=\"SUBMACCE\">Acceso\n     <ul>\n    <li id=\"GESTPERF\"><a href=\"/cimco/publico/index.php?componente=GESTPERF\">Perfiles</a>\n    </li>\n    <li id=\"GESTUSUA\"><a href=\"/cimco/publico/index.php?componente=GESTUSUA\">Usuarios</a>\n    </li>\n    <li id=\"GESTPRIV\"><a href=\"/cimco/publico/index.php?componente=GESTPRIV\">Privilegios</a>\n    </li>\n    <li id=\"GESTPREF\"><a href=\"/cimco/publico/index.php?componente=GESTPREF\">Preferencias</a>\n    </li>\n     </ul>\n    </li>\n    <li id=\"SUBMDISP\">Dispositivos\n     <ul>\n    <li id=\"GESTSRVD\"><a href=\"/cimco/publico/index.php?componente=GESTSRVD\">Servidores</a>\n    </li>\n    <li id=\"GESTTERM\"><a href=\"/cimco/publico/index.php?componente=GESTTERM\">Terminales</a>\n    </li>\n    <li id=\"GESTIMPR\"><a href=\"/cimco/publico/index.php?componente=GESTIMPR\">Impresoras</a>\n    </li>\n     </ul>\n    </li>\n    <li id=\"SUBMSEGU\">Seguridad\n     <ul>\n    <li id=\"GESTBITA\"><a href=\"/cimco/publico/index.php?componente=GESTBITA\">Registro de conexiones</a>\n    </li>\n     </ul>\n    </li>\n    <li id=\"SUBMDCAD\">Datos de control\n     <ul>\n    <li id=\"GESTAECO\"><a href=\"/cimco/publico/index.php?componente=GESTAECO\">Actividades economicas</a>\n    </li>\n    <li id=\"GESTPROF\"><a href=\"/cimco/publico/index.php?componente=GESTPROF\">Profesiones u oficios</a>\n    </li>\n    <li id=\"GESTTIBO\"><a href=\"/cimco/publico/index.php?componente=GESTTIBO\">Tipos de bodegas</a>\n    </li>\n    <li id=\"GESTCARG\"><a href=\"/cimco/publico/index.php?componente=GESTCARG\">Cargos</a>\n    </li>\n    <li id=\"GESTTIDI\"><a href=\"/cimco/publico/index.php?componente=GESTTIDI\">Tipos de documentos de identidad</a>\n    </li>\n    <li id=\"SUBMUBIG\">Ubicación geográfica\n     <ul>\n    <li id=\"GESTPAIS\"><a href=\"/cimco/publico/index.php?componente=GESTPAIS\">Paises</a>\n    </li>\n    <li id=\"GESTDEPA\"><a href=\"/cimco/publico/index.php?componente=GESTDEPA\">Departamentos</a>\n    </li>\n    <li id=\"GESTMUNI\"><a href=\"/cimco/publico/index.php?componente=GESTMUNI\">Municipios</a>\n    </li>\n    <li id=\"GESTCORR\"><a href=\"/cimco/publico/index.php?componente=GESTCORR\">Corregimientos</a>\n    </li>\n    <li id=\"GESTBARR\"><a href=\"/cimco/publico/index.php?componente=GESTBARR\">Barrios</a>\n    </li>\n     </ul>\n    </li>\n     </ul>\n    </li>\n   </ul>\n   </li>\n   <li id=\"MENUFINS\" class=\"menuPrincipal\"><a href=\"/cimco/publico/index.php?componente=MENUFINS\">Finalizar sesión</a>\n   </li>\n</ul>\n\";fechaActual|s:9:\"CURDATE()\";'),('de95160f2a5c75431d443c4a5a0fc14b',1249335129,'usuario|s:5:\"admin\";contrasena|s:32:\"21232f297a57a5a743894a0e4a801fc3\";sucursal|s:5:\"90000\";cliente|s:13:\"192.168.0.102\";perfil|b:0;id_usuario|s:4:\"0001\";conexion|i:47;menu|s:3633:\"<ul id=\"menuGeneral\" class=\"menu\">\n   <li id=\"MENUPRIN\" class=\"menuPrincipal\"><a href=\"/index.php?componente=MENUPRIN\">Inicio</a>\n   </li>\n   <li id=\"MENUCLIE\" class=\"menuPrincipal\">Clientes\n   <ul class=\"subMenu\">\n    <li id=\"SUBMCOSE\">Control de servicios\n     <ul>\n    <li id=\"GESTCLIE\"><a href=\"/index.php?componente=GESTCLIE\">Clientes</a>\n    </li>\n    <li id=\"GESTSEDE\"><a href=\"/index.php?componente=GESTSEDE\">Sedes clientes</a>\n    </li>\n    <li id=\"GESTRECL\"><a href=\"/index.php?componente=GESTRECL\">Requerimiento clientes</a>\n    </li>\n    <li id=\"GESTREVI\"><a href=\"/index.php?componente=GESTREVI\">Reporte visitas</a>\n    </li>\n    <li id=\"GESTCOCL\"><a href=\"/index.php?componente=GESTCOCL\">Cotizaciones</a>\n    </li>\n    <li id=\"GESTREOB\"><a href=\"/index.php?componente=GESTREOB\">Registro avance obras</a>\n    </li>\n     </ul>\n    </li>\n   </ul>\n   </li>\n   <li id=\"MENUADMI\" class=\"menuPrincipal\">Administración\n   <ul class=\"subMenu\">\n    <li id=\"SUBMESTC\">Estructura corporativa\n     <ul>\n    <li id=\"GESTEMPR\"><a href=\"/index.php?componente=GESTEMPR\">Empresas</a>\n    </li>\n    <li id=\"GESTSUCU\"><a href=\"/index.php?componente=GESTSUCU\">Consorciados</a>\n    </li>\n    <li id=\"GESTBODE\"><a href=\"/index.php?componente=GESTBODE\">Bodegas</a>\n    </li>\n    <li id=\"GESTSECC\"><a href=\"/index.php?componente=GESTSECC\">Secciones</a>\n    </li>\n     </ul>\n    </li>\n    <li id=\"SUBMACCE\">Acceso\n     <ul>\n    <li id=\"GESTPERF\"><a href=\"/index.php?componente=GESTPERF\">Perfiles</a>\n    </li>\n    <li id=\"GESTPREF\">Preferencias\n     <ul>\n    <li id=\"PREFGLOB\"><a href=\"/index.php?componente=PREFGLOB\">Sucursal</a>\n    </li>\n    <li id=\"PREFUSUA\"><a href=\"/index.php?componente=PREFUSUA\">Usuario</a>\n    </li>\n     </ul>\n    </li>\n    <li id=\"GESTUSUA\"><a href=\"/index.php?componente=GESTUSUA\">Usuarios</a>\n    </li>\n    <li id=\"GESTPRIV\"><a href=\"/index.php?componente=GESTPRIV\">Privilegios</a>\n    </li>\n     </ul>\n    </li>\n    <li id=\"SUBMDISP\">Dispositivos\n     <ul>\n    <li id=\"GESTSRVD\"><a href=\"/index.php?componente=GESTSRVD\">Servidores</a>\n    </li>\n    <li id=\"GESTTERM\"><a href=\"/index.php?componente=GESTTERM\">Terminales</a>\n    </li>\n    <li id=\"GESTIMPR\"><a href=\"/index.php?componente=GESTIMPR\">Impresoras</a>\n    </li>\n     </ul>\n    </li>\n    <li id=\"SUBMSEGU\">Seguridad\n     <ul>\n    <li id=\"GESTBITA\"><a href=\"/index.php?componente=GESTBITA\">Registro de conexiones</a>\n    </li>\n     </ul>\n    </li>\n    <li id=\"SUBMDCAD\">Datos de control\n     <ul>\n    <li id=\"GESTAECO\"><a href=\"/index.php?componente=GESTAECO\">Actividades economicas</a>\n    </li>\n    <li id=\"GESTPROF\"><a href=\"/index.php?componente=GESTPROF\">Profesiones u oficios</a>\n    </li>\n    <li id=\"GESTTIBO\"><a href=\"/index.php?componente=GESTTIBO\">Tipos de bodegas</a>\n    </li>\n    <li id=\"GESTCARG\"><a href=\"/index.php?componente=GESTCARG\">Cargos</a>\n    </li>\n    <li id=\"GESTTIDI\"><a href=\"/index.php?componente=GESTTIDI\">Tipos de documentos de identidad</a>\n    </li>\n    <li id=\"SUBMUBIG\">Ubicación geográfica\n     <ul>\n    <li id=\"GESTPAIS\"><a href=\"/index.php?componente=GESTPAIS\">Paises</a>\n    </li>\n    <li id=\"GESTDEPA\"><a href=\"/index.php?componente=GESTDEPA\">Departamentos</a>\n    </li>\n    <li id=\"GESTMUNI\"><a href=\"/index.php?componente=GESTMUNI\">Municipios</a>\n    </li>\n    <li id=\"GESTCORR\"><a href=\"/index.php?componente=GESTCORR\">Corregimientos</a>\n    </li>\n    <li id=\"GESTBARR\"><a href=\"/index.php?componente=GESTBARR\">Barrios</a>\n    </li>\n     </ul>\n    </li>\n     </ul>\n    </li>\n   </ul>\n   </li>\n   <li id=\"MENUFINS\" class=\"menuPrincipal\"><a href=\"/index.php?componente=MENUFINS\">Finalizar sesión</a>\n   </li>\n</ul>\n\";preferencias_individuales|a:1:{s:8:\"impuesto\";s:2:\"16\";}preferencias_globales|a:1:{s:4:\"pais\";i:0;}fechaActual|s:10:\"2009-08-03\";origenOrdenamiento|s:8:\"GESTCOCL\";sentidoOrdenamiento|s:3:\"ASC\";columnaOrdenamiento|s:17:\"NUMERO_COTIZACION\";'),('ee919758c6aea736697f1bb1bd3d3529',1248307231,'usuario|s:5:\"admin\";contrasena|s:32:\"21232f297a57a5a743894a0e4a801fc3\";sucursal|s:5:\"90000\";cliente|s:13:\"192.168.0.103\";perfil|b:0;id_usuario|s:4:\"0001\";conexion|i:26;menu|s:3495:\"<ul id=\"menuGeneral\" class=\"menu\">\n   <li id=\"MENUPRIN\" class=\"menuPrincipal\"><a href=\"/index.php?componente=MENUPRIN\">Inicio</a>\n   </li>\n   <li id=\"MENUCLIE\" class=\"menuPrincipal\">Clientes\n   <ul class=\"subMenu\">\n    <li id=\"SUBMCOSE\">Control de servicios\n     <ul>\n    <li id=\"GESTCLIE\"><a href=\"/index.php?componente=GESTCLIE\">Clientes</a>\n    </li>\n    <li id=\"GESTSEDE\"><a href=\"/index.php?componente=GESTSEDE\">Sedes clientes</a>\n    </li>\n    <li id=\"GESTRECL\"><a href=\"/index.php?componente=GESTRECL\">Requerimiento clientes</a>\n    </li>\n    <li id=\"GESTREVI\"><a href=\"/index.php?componente=GESTREVI\">Reporte visitas</a>\n    </li>\n    <li id=\"GESTCOCL\"><a href=\"/index.php?componente=GESTCOCL\">Cotizaciones</a>\n    </li>\n    <li id=\"GESTAPCO\"><a href=\"/index.php?componente=GESTAPCO\">Aprobación / Propuesta cliente</a>\n    </li>\n     </ul>\n    </li>\n   </ul>\n   </li>\n   <li id=\"MENUADMI\" class=\"menuPrincipal\">Administración\n   <ul class=\"subMenu\">\n    <li id=\"SUBMESTC\">Estructura corporativa\n     <ul>\n    <li id=\"GESTEMPR\"><a href=\"/index.php?componente=GESTEMPR\">Empresas</a>\n    </li>\n    <li id=\"GESTSUCU\"><a href=\"/index.php?componente=GESTSUCU\">Consorciados</a>\n    </li>\n    <li id=\"GESTBODE\"><a href=\"/index.php?componente=GESTBODE\">Bodegas</a>\n    </li>\n    <li id=\"GESTSECC\"><a href=\"/index.php?componente=GESTSECC\">Secciones</a>\n    </li>\n     </ul>\n    </li>\n    <li id=\"SUBMACCE\">Acceso\n     <ul>\n    <li id=\"GESTPERF\"><a href=\"/index.php?componente=GESTPERF\">Perfiles</a>\n    </li>\n    <li id=\"GESTUSUA\"><a href=\"/index.php?componente=GESTUSUA\">Usuarios</a>\n    </li>\n    <li id=\"GESTPRIV\"><a href=\"/index.php?componente=GESTPRIV\">Privilegios</a>\n    </li>\n    <li id=\"GESTPREF\"><a href=\"/index.php?componente=GESTPREF\">Preferencias</a>\n    </li>\n     </ul>\n    </li>\n    <li id=\"SUBMDISP\">Dispositivos\n     <ul>\n    <li id=\"GESTSRVD\"><a href=\"/index.php?componente=GESTSRVD\">Servidores</a>\n    </li>\n    <li id=\"GESTTERM\"><a href=\"/index.php?componente=GESTTERM\">Terminales</a>\n    </li>\n    <li id=\"GESTIMPR\"><a href=\"/index.php?componente=GESTIMPR\">Impresoras</a>\n    </li>\n     </ul>\n    </li>\n    <li id=\"SUBMSEGU\">Seguridad\n     <ul>\n    <li id=\"GESTBITA\"><a href=\"/index.php?componente=GESTBITA\">Registro de conexiones</a>\n    </li>\n     </ul>\n    </li>\n    <li id=\"SUBMDCAD\">Datos de control\n     <ul>\n    <li id=\"GESTAECO\"><a href=\"/index.php?componente=GESTAECO\">Actividades economicas</a>\n    </li>\n    <li id=\"GESTPROF\"><a href=\"/index.php?componente=GESTPROF\">Profesiones u oficios</a>\n    </li>\n    <li id=\"GESTTIBO\"><a href=\"/index.php?componente=GESTTIBO\">Tipos de bodegas</a>\n    </li>\n    <li id=\"GESTCARG\"><a href=\"/index.php?componente=GESTCARG\">Cargos</a>\n    </li>\n    <li id=\"GESTTIDI\"><a href=\"/index.php?componente=GESTTIDI\">Tipos de documentos de identidad</a>\n    </li>\n    <li id=\"SUBMUBIG\">Ubicación geográfica\n     <ul>\n    <li id=\"GESTPAIS\"><a href=\"/index.php?componente=GESTPAIS\">Paises</a>\n    </li>\n    <li id=\"GESTDEPA\"><a href=\"/index.php?componente=GESTDEPA\">Departamentos</a>\n    </li>\n    <li id=\"GESTMUNI\"><a href=\"/index.php?componente=GESTMUNI\">Municipios</a>\n    </li>\n    <li id=\"GESTCORR\"><a href=\"/index.php?componente=GESTCORR\">Corregimientos</a>\n    </li>\n    <li id=\"GESTBARR\"><a href=\"/index.php?componente=GESTBARR\">Barrios</a>\n    </li>\n     </ul>\n    </li>\n     </ul>\n    </li>\n   </ul>\n   </li>\n   <li id=\"MENUFINS\" class=\"menuPrincipal\"><a href=\"/index.php?componente=MENUFINS\">Finalizar sesión</a>\n   </li>\n</ul>\n\";fechaActual|s:10:\"2009-07-22\";'),('fec13a7f640d6a0cde2269a8a6c96220',1247608816,'usuario|s:5:\"admin\";contrasena|s:32:\"21232f297a57a5a743894a0e4a801fc3\";sucursal|s:5:\"90000\";cliente|s:13:\"192.168.0.113\";perfil|b:0;id_usuario|s:4:\"0001\";conexion|i:14;menu|s:3402:\"<ul id=\"menuGeneral\" class=\"menu\">\n   <li id=\"MENUPRIN\" class=\"menuPrincipal\"><a href=\"/index.php?componente=MENUPRIN\">Inicio</a>\n   </li>\n   <li id=\"MENUCLIE\" class=\"menuPrincipal\">Clientes\n   <ul class=\"subMenu\">\n    <li id=\"SUBMCOSE\">Control de servicios\n     <ul>\n    <li id=\"GESTCLIE\"><a href=\"/index.php?componente=GESTCLIE\">Clientes</a>\n    </li>\n    <li id=\"GESTSEDE\"><a href=\"/index.php?componente=GESTSEDE\">Sedes clientes</a>\n    </li>\n    <li id=\"GESTRECL\"><a href=\"/index.php?componente=GESTRECL\">Requerimiento clientes</a>\n    </li>\n    <li id=\"GESTCOCL\"><a href=\"/index.php?componente=GESTCOCL\">Cotizaciones</a>\n    </li>\n    <li id=\"GESTAPCO\"><a href=\"/index.php?componente=GESTAPCO\">Aprobación / Propuesta cliente</a>\n    </li>\n     </ul>\n    </li>\n   </ul>\n   </li>\n   <li id=\"MENUADMI\" class=\"menuPrincipal\">Administración\n   <ul class=\"subMenu\">\n    <li id=\"SUBMESTC\">Estructura corporativa\n     <ul>\n    <li id=\"GESTEMPR\"><a href=\"/index.php?componente=GESTEMPR\">Empresas</a>\n    </li>\n    <li id=\"GESTSUCU\"><a href=\"/index.php?componente=GESTSUCU\">Consorciados</a>\n    </li>\n    <li id=\"GESTBODE\"><a href=\"/index.php?componente=GESTBODE\">Bodegas</a>\n    </li>\n    <li id=\"GESTSECC\"><a href=\"/index.php?componente=GESTSECC\">Secciones</a>\n    </li>\n     </ul>\n    </li>\n    <li id=\"SUBMACCE\">Acceso\n     <ul>\n    <li id=\"GESTPERF\"><a href=\"/index.php?componente=GESTPERF\">Perfiles</a>\n    </li>\n    <li id=\"GESTUSUA\"><a href=\"/index.php?componente=GESTUSUA\">Usuarios</a>\n    </li>\n    <li id=\"GESTPRIV\"><a href=\"/index.php?componente=GESTPRIV\">Privilegios</a>\n    </li>\n    <li id=\"GESTPREF\"><a href=\"/index.php?componente=GESTPREF\">Preferencias</a>\n    </li>\n     </ul>\n    </li>\n    <li id=\"SUBMDISP\">Dispositivos\n     <ul>\n    <li id=\"GESTSRVD\"><a href=\"/index.php?componente=GESTSRVD\">Servidores</a>\n    </li>\n    <li id=\"GESTTERM\"><a href=\"/index.php?componente=GESTTERM\">Terminales</a>\n    </li>\n    <li id=\"GESTIMPR\"><a href=\"/index.php?componente=GESTIMPR\">Impresoras</a>\n    </li>\n     </ul>\n    </li>\n    <li id=\"SUBMSEGU\">Seguridad\n     <ul>\n    <li id=\"GESTBITA\"><a href=\"/index.php?componente=GESTBITA\">Registro de conexiones</a>\n    </li>\n     </ul>\n    </li>\n    <li id=\"SUBMDCAD\">Datos de control\n     <ul>\n    <li id=\"GESTAECO\"><a href=\"/index.php?componente=GESTAECO\">Actividades economicas</a>\n    </li>\n    <li id=\"GESTPROF\"><a href=\"/index.php?componente=GESTPROF\">Profesiones u oficios</a>\n    </li>\n    <li id=\"GESTTIBO\"><a href=\"/index.php?componente=GESTTIBO\">Tipos de bodegas</a>\n    </li>\n    <li id=\"GESTCARG\"><a href=\"/index.php?componente=GESTCARG\">Cargos</a>\n    </li>\n    <li id=\"GESTTIDI\"><a href=\"/index.php?componente=GESTTIDI\">Tipos de documentos de identidad</a>\n    </li>\n    <li id=\"SUBMUBIG\">Ubicación geográfica\n     <ul>\n    <li id=\"GESTPAIS\"><a href=\"/index.php?componente=GESTPAIS\">Paises</a>\n    </li>\n    <li id=\"GESTDEPA\"><a href=\"/index.php?componente=GESTDEPA\">Departamentos</a>\n    </li>\n    <li id=\"GESTMUNI\"><a href=\"/index.php?componente=GESTMUNI\">Municipios</a>\n    </li>\n    <li id=\"GESTCORR\"><a href=\"/index.php?componente=GESTCORR\">Corregimientos</a>\n    </li>\n    <li id=\"GESTBARR\"><a href=\"/index.php?componente=GESTBARR\">Barrios</a>\n    </li>\n     </ul>\n    </li>\n     </ul>\n    </li>\n   </ul>\n   </li>\n   <li id=\"MENUFINS\" class=\"menuPrincipal\"><a href=\"/index.php?componente=MENUFINS\">Finalizar sesión</a>\n   </li>\n</ul>\n\";fechaActual|s:10:\"2009-07-14\";origenOrdenamiento|s:8:\"GESTEMPR\";sentidoOrdenamiento|s:3:\"ASC\";columnaOrdenamiento|s:12:\"RAZON_SOCIAL\";'),('fgthtjjhlj89idv32vd2bvh4u4',1247597683,''),('g4lvcs7rnct0kubg0ms1ulr8q1',1249435081,''),('hqr0p1838v9c8er3k6qtmo53n0',1247577508,'usuario|s:5:\"admin\";contrasena|s:32:\"21232f297a57a5a743894a0e4a801fc3\";sucursal|s:5:\"90000\";cliente|s:9:\"127.0.0.1\";perfil|s:8:\"90000000\";id_usuario|s:4:\"0001\";conexion|i:7;menu|s:3908:\"<ul id=\"menuGeneral\" class=\"menu\">\n   <li id=\"MENUPRIN\" class=\"menuPrincipal\"><a href=\"/cimco/publico/index.php?componente=MENUPRIN\">Inicio</a>\n   </li>\n   <li id=\"MENUCLIE\" class=\"menuPrincipal\">Clientes\n   <ul class=\"subMenu\">\n    <li id=\"SUBMCOSE\">Control de servicios\n     <ul>\n    <li id=\"GESTCLIE\"><a href=\"/cimco/publico/index.php?componente=GESTCLIE\">Clientes</a>\n    </li>\n    <li id=\"GESTSEDE\"><a href=\"/cimco/publico/index.php?componente=GESTSEDE\">Sedes clientes</a>\n    </li>\n    <li id=\"GESTRECL\"><a href=\"/cimco/publico/index.php?componente=GESTRECL\">Requerimiento clientes</a>\n    </li>\n    <li id=\"GESTCOCL\"><a href=\"/cimco/publico/index.php?componente=GESTCOCL\">Cotizaciones</a>\n    </li>\n    <li id=\"GESTREVI\"><a href=\"/cimco/publico/index.php?componente=GESTREVI\">GESTREVI</a>\n    </li>\n    <li id=\"GESTAPCO\"><a href=\"/cimco/publico/index.php?componente=GESTAPCO\">Aprobación / Propuesta cliente</a>\n    </li>\n     </ul>\n    </li>\n   </ul>\n   </li>\n   <li id=\"MENUADMI\" class=\"menuPrincipal\">Administración\n   <ul class=\"subMenu\">\n    <li id=\"SUBMESTC\">Estructura corporativa\n     <ul>\n    <li id=\"GESTEMPR\"><a href=\"/cimco/publico/index.php?componente=GESTEMPR\">Empresas</a>\n    </li>\n    <li id=\"GESTSUCU\"><a href=\"/cimco/publico/index.php?componente=GESTSUCU\">Consorciados</a>\n    </li>\n    <li id=\"GESTBODE\"><a href=\"/cimco/publico/index.php?componente=GESTBODE\">Bodegas</a>\n    </li>\n    <li id=\"GESTSECC\"><a href=\"/cimco/publico/index.php?componente=GESTSECC\">Secciones</a>\n    </li>\n     </ul>\n    </li>\n    <li id=\"SUBMACCE\">Acceso\n     <ul>\n    <li id=\"GESTPERF\"><a href=\"/cimco/publico/index.php?componente=GESTPERF\">Perfiles</a>\n    </li>\n    <li id=\"GESTUSUA\"><a href=\"/cimco/publico/index.php?componente=GESTUSUA\">Usuarios</a>\n    </li>\n    <li id=\"GESTPRIV\"><a href=\"/cimco/publico/index.php?componente=GESTPRIV\">Privilegios</a>\n    </li>\n    <li id=\"GESTPREF\"><a href=\"/cimco/publico/index.php?componente=GESTPREF\">Preferencias</a>\n    </li>\n     </ul>\n    </li>\n    <li id=\"SUBMDISP\">Dispositivos\n     <ul>\n    <li id=\"GESTSRVD\"><a href=\"/cimco/publico/index.php?componente=GESTSRVD\">Servidores</a>\n    </li>\n    <li id=\"GESTTERM\"><a href=\"/cimco/publico/index.php?componente=GESTTERM\">Terminales</a>\n    </li>\n    <li id=\"GESTIMPR\"><a href=\"/cimco/publico/index.php?componente=GESTIMPR\">Impresoras</a>\n    </li>\n     </ul>\n    </li>\n    <li id=\"SUBMSEGU\">Seguridad\n     <ul>\n    <li id=\"GESTBITA\"><a href=\"/cimco/publico/index.php?componente=GESTBITA\">Registro de conexiones</a>\n    </li>\n     </ul>\n    </li>\n    <li id=\"SUBMDCAD\">Datos de control\n     <ul>\n    <li id=\"GESTAECO\"><a href=\"/cimco/publico/index.php?componente=GESTAECO\">Actividades economicas</a>\n    </li>\n    <li id=\"GESTPROF\"><a href=\"/cimco/publico/index.php?componente=GESTPROF\">Profesiones u oficios</a>\n    </li>\n    <li id=\"GESTTIBO\"><a href=\"/cimco/publico/index.php?componente=GESTTIBO\">Tipos de bodegas</a>\n    </li>\n    <li id=\"GESTCARG\"><a href=\"/cimco/publico/index.php?componente=GESTCARG\">Cargos</a>\n    </li>\n    <li id=\"GESTTIDI\"><a href=\"/cimco/publico/index.php?componente=GESTTIDI\">Tipos de documentos de identidad</a>\n    </li>\n    <li id=\"SUBMUBIG\">Ubicación geográfica\n     <ul>\n    <li id=\"GESTPAIS\"><a href=\"/cimco/publico/index.php?componente=GESTPAIS\">Paises</a>\n    </li>\n    <li id=\"GESTDEPA\"><a href=\"/cimco/publico/index.php?componente=GESTDEPA\">Departamentos</a>\n    </li>\n    <li id=\"GESTMUNI\"><a href=\"/cimco/publico/index.php?componente=GESTMUNI\">Municipios</a>\n    </li>\n    <li id=\"GESTCORR\"><a href=\"/cimco/publico/index.php?componente=GESTCORR\">Corregimientos</a>\n    </li>\n    <li id=\"GESTBARR\"><a href=\"/cimco/publico/index.php?componente=GESTBARR\">Barrios</a>\n    </li>\n     </ul>\n    </li>\n     </ul>\n    </li>\n   </ul>\n   </li>\n   <li id=\"MENUFINS\" class=\"menuPrincipal\"><a href=\"/cimco/publico/index.php?componente=MENUFINS\">Finalizar sesión</a>\n   </li>\n</ul>\n\";fechaActual|s:10:\"2009-07-14\";'),('kvhuhupvgu5frsfuc7si145l10',1249583255,'usuario|s:5:\"admin\";contrasena|s:32:\"21232f297a57a5a743894a0e4a801fc3\";sucursal|s:5:\"90000\";cliente|s:9:\"127.0.0.1\";perfil|b:0;id_usuario|s:4:\"0001\";conexion|i:140;menu|s:4295:\"<ul id=\"menuGeneral\" class=\"menu\">\n   <li id=\"MENUPRIN\" class=\"menuPrincipal\"><a href=\"/cimco/publico/index.php?componente=MENUPRIN\">Inicio</a>\n   </li>\n   <li id=\"MENUCLIE\" class=\"menuPrincipal\">Clientes\n   <ul class=\"subMenu\">\n    <li id=\"SUBMCOSE\">Control de servicios\n     <ul>\n    <li id=\"GESTCLIE\"><a href=\"/cimco/publico/index.php?componente=GESTCLIE\">Clientes</a>\n    </li>\n    <li id=\"GESTSEDE\"><a href=\"/cimco/publico/index.php?componente=GESTSEDE\">Sedes clientes</a>\n    </li>\n    <li id=\"GESTRECL\"><a href=\"/cimco/publico/index.php?componente=GESTRECL\">Requerimiento clientes</a>\n    </li>\n    <li id=\"GESTREVI\"><a href=\"/cimco/publico/index.php?componente=GESTREVI\">Reporte visitas</a>\n    </li>\n    <li id=\"GESTCOCL\"><a href=\"/cimco/publico/index.php?componente=GESTCOCL\">Cotizaciones</a>\n    </li>\n    <li id=\"GESTREOB\"><a href=\"/cimco/publico/index.php?componente=GESTREOB\">Registro avance obras</a>\n    </li>\n    <li id=\"GESTACTA\"><a href=\"/cimco/publico/index.php?componente=GESTACTA\">Mantenimiento actas</a>\n    </li>\n    <li id=\"GESTINEG\"><a href=\"/cimco/publico/index.php?componente=GESTINEG\">Registro ingresos-egresos</a>\n    </li>\n     </ul>\n    </li>\n   </ul>\n   </li>\n   <li id=\"MENUADMI\" class=\"menuPrincipal\">Administración\n   <ul class=\"subMenu\">\n    <li id=\"SUBMESTC\">Estructura corporativa\n     <ul>\n    <li id=\"GESTEMPR\"><a href=\"/cimco/publico/index.php?componente=GESTEMPR\">Empresas</a>\n    </li>\n    <li id=\"GESTSUCU\"><a href=\"/cimco/publico/index.php?componente=GESTSUCU\">Consorciados</a>\n    </li>\n    <li id=\"GESTBODE\"><a href=\"/cimco/publico/index.php?componente=GESTBODE\">Bodegas</a>\n    </li>\n    <li id=\"GESTSECC\"><a href=\"/cimco/publico/index.php?componente=GESTSECC\">Secciones</a>\n    </li>\n     </ul>\n    </li>\n    <li id=\"SUBMACCE\">Acceso\n     <ul>\n    <li id=\"GESTPERF\"><a href=\"/cimco/publico/index.php?componente=GESTPERF\">Perfiles</a>\n    </li>\n    <li id=\"GESTPREF\">Preferencias\n     <ul>\n    <li id=\"PREFGLOB\"><a href=\"/cimco/publico/index.php?componente=PREFGLOB\">Sucursal</a>\n    </li>\n    <li id=\"PREFUSUA\"><a href=\"/cimco/publico/index.php?componente=PREFUSUA\">Usuario</a>\n    </li>\n     </ul>\n    </li>\n    <li id=\"GESTUSUA\"><a href=\"/cimco/publico/index.php?componente=GESTUSUA\">Usuarios</a>\n    </li>\n    <li id=\"GESTPRIV\"><a href=\"/cimco/publico/index.php?componente=GESTPRIV\">Privilegios</a>\n    </li>\n     </ul>\n    </li>\n    <li id=\"SUBMDISP\">Dispositivos\n     <ul>\n    <li id=\"GESTSRVD\"><a href=\"/cimco/publico/index.php?componente=GESTSRVD\">Servidores</a>\n    </li>\n    <li id=\"GESTTERM\"><a href=\"/cimco/publico/index.php?componente=GESTTERM\">Terminales</a>\n    </li>\n    <li id=\"GESTIMPR\"><a href=\"/cimco/publico/index.php?componente=GESTIMPR\">Impresoras</a>\n    </li>\n     </ul>\n    </li>\n    <li id=\"SUBMSEGU\">Seguridad\n     <ul>\n    <li id=\"GESTBITA\"><a href=\"/cimco/publico/index.php?componente=GESTBITA\">Registro de conexiones</a>\n    </li>\n     </ul>\n    </li>\n    <li id=\"SUBMDCAD\">Datos de control\n     <ul>\n    <li id=\"GESTAECO\"><a href=\"/cimco/publico/index.php?componente=GESTAECO\">Actividades economicas</a>\n    </li>\n    <li id=\"GESTPROF\"><a href=\"/cimco/publico/index.php?componente=GESTPROF\">Profesiones u oficios</a>\n    </li>\n    <li id=\"GESTTIBO\"><a href=\"/cimco/publico/index.php?componente=GESTTIBO\">Tipos de bodegas</a>\n    </li>\n    <li id=\"GESTCARG\"><a href=\"/cimco/publico/index.php?componente=GESTCARG\">Cargos</a>\n    </li>\n    <li id=\"GESTTIDI\"><a href=\"/cimco/publico/index.php?componente=GESTTIDI\">Tipos de documentos de identidad</a>\n    </li>\n    <li id=\"SUBMUBIG\">Ubicación geográfica\n     <ul>\n    <li id=\"GESTPAIS\"><a href=\"/cimco/publico/index.php?componente=GESTPAIS\">Paises</a>\n    </li>\n    <li id=\"GESTDEPA\"><a href=\"/cimco/publico/index.php?componente=GESTDEPA\">Departamentos</a>\n    </li>\n    <li id=\"GESTMUNI\"><a href=\"/cimco/publico/index.php?componente=GESTMUNI\">Municipios</a>\n    </li>\n    <li id=\"GESTCORR\"><a href=\"/cimco/publico/index.php?componente=GESTCORR\">Corregimientos</a>\n    </li>\n    <li id=\"GESTBARR\"><a href=\"/cimco/publico/index.php?componente=GESTBARR\">Barrios</a>\n    </li>\n     </ul>\n    </li>\n     </ul>\n    </li>\n   </ul>\n   </li>\n   <li id=\"MENUFINS\" class=\"menuPrincipal\"><a href=\"/cimco/publico/index.php?componente=MENUFINS\">Finalizar sesión</a>\n   </li>\n</ul>\n\";preferencias_individuales|a:1:{s:8:\"impuesto\";s:2:\"16\";}preferencias_globales|a:1:{s:4:\"pais\";i:0;}fechaActual|s:9:\"CURDATE()\";'),('p3aloulun12o1d41htc345c564',1249447484,'usuario|s:5:\"admin\";contrasena|s:32:\"21232f297a57a5a743894a0e4a801fc3\";sucursal|s:5:\"90000\";cliente|s:9:\"127.0.0.1\";perfil|b:0;id_usuario|s:4:\"0001\";conexion|i:138;menu|s:4178:\"<ul id=\"menuGeneral\" class=\"menu\">\n   <li id=\"MENUPRIN\" class=\"menuPrincipal\"><a href=\"/cimco/publico/index.php?componente=MENUPRIN\">Inicio</a>\n   </li>\n   <li id=\"MENUCLIE\" class=\"menuPrincipal\">Clientes\n   <ul class=\"subMenu\">\n    <li id=\"SUBMCOSE\">Control de servicios\n     <ul>\n    <li id=\"GESTCLIE\"><a href=\"/cimco/publico/index.php?componente=GESTCLIE\">Clientes</a>\n    </li>\n    <li id=\"GESTSEDE\"><a href=\"/cimco/publico/index.php?componente=GESTSEDE\">Sedes clientes</a>\n    </li>\n    <li id=\"GESTRECL\"><a href=\"/cimco/publico/index.php?componente=GESTRECL\">Requerimiento clientes</a>\n    </li>\n    <li id=\"GESTREVI\"><a href=\"/cimco/publico/index.php?componente=GESTREVI\">Reporte visitas</a>\n    </li>\n    <li id=\"GESTCOCL\"><a href=\"/cimco/publico/index.php?componente=GESTCOCL\">Cotizaciones</a>\n    </li>\n    <li id=\"GESTREOB\"><a href=\"/cimco/publico/index.php?componente=GESTREOB\">Registro avance obras</a>\n    </li>\n    <li id=\"GESTACTA\"><a href=\"/cimco/publico/index.php?componente=GESTACTA\">Mantenimiento actas</a>\n    </li>\n     </ul>\n    </li>\n   </ul>\n   </li>\n   <li id=\"MENUADMI\" class=\"menuPrincipal\">Administración\n   <ul class=\"subMenu\">\n    <li id=\"SUBMESTC\">Estructura corporativa\n     <ul>\n    <li id=\"GESTEMPR\"><a href=\"/cimco/publico/index.php?componente=GESTEMPR\">Empresas</a>\n    </li>\n    <li id=\"GESTSUCU\"><a href=\"/cimco/publico/index.php?componente=GESTSUCU\">Consorciados</a>\n    </li>\n    <li id=\"GESTBODE\"><a href=\"/cimco/publico/index.php?componente=GESTBODE\">Bodegas</a>\n    </li>\n    <li id=\"GESTSECC\"><a href=\"/cimco/publico/index.php?componente=GESTSECC\">Secciones</a>\n    </li>\n     </ul>\n    </li>\n    <li id=\"SUBMACCE\">Acceso\n     <ul>\n    <li id=\"GESTPERF\"><a href=\"/cimco/publico/index.php?componente=GESTPERF\">Perfiles</a>\n    </li>\n    <li id=\"GESTPREF\">Preferencias\n     <ul>\n    <li id=\"PREFGLOB\"><a href=\"/cimco/publico/index.php?componente=PREFGLOB\">Sucursal</a>\n    </li>\n    <li id=\"PREFUSUA\"><a href=\"/cimco/publico/index.php?componente=PREFUSUA\">Usuario</a>\n    </li>\n     </ul>\n    </li>\n    <li id=\"GESTUSUA\"><a href=\"/cimco/publico/index.php?componente=GESTUSUA\">Usuarios</a>\n    </li>\n    <li id=\"GESTPRIV\"><a href=\"/cimco/publico/index.php?componente=GESTPRIV\">Privilegios</a>\n    </li>\n     </ul>\n    </li>\n    <li id=\"SUBMDISP\">Dispositivos\n     <ul>\n    <li id=\"GESTSRVD\"><a href=\"/cimco/publico/index.php?componente=GESTSRVD\">Servidores</a>\n    </li>\n    <li id=\"GESTTERM\"><a href=\"/cimco/publico/index.php?componente=GESTTERM\">Terminales</a>\n    </li>\n    <li id=\"GESTIMPR\"><a href=\"/cimco/publico/index.php?componente=GESTIMPR\">Impresoras</a>\n    </li>\n     </ul>\n    </li>\n    <li id=\"SUBMSEGU\">Seguridad\n     <ul>\n    <li id=\"GESTBITA\"><a href=\"/cimco/publico/index.php?componente=GESTBITA\">Registro de conexiones</a>\n    </li>\n     </ul>\n    </li>\n    <li id=\"SUBMDCAD\">Datos de control\n     <ul>\n    <li id=\"GESTAECO\"><a href=\"/cimco/publico/index.php?componente=GESTAECO\">Actividades economicas</a>\n    </li>\n    <li id=\"GESTPROF\"><a href=\"/cimco/publico/index.php?componente=GESTPROF\">Profesiones u oficios</a>\n    </li>\n    <li id=\"GESTTIBO\"><a href=\"/cimco/publico/index.php?componente=GESTTIBO\">Tipos de bodegas</a>\n    </li>\n    <li id=\"GESTCARG\"><a href=\"/cimco/publico/index.php?componente=GESTCARG\">Cargos</a>\n    </li>\n    <li id=\"GESTTIDI\"><a href=\"/cimco/publico/index.php?componente=GESTTIDI\">Tipos de documentos de identidad</a>\n    </li>\n    <li id=\"SUBMUBIG\">Ubicación geográfica\n     <ul>\n    <li id=\"GESTPAIS\"><a href=\"/cimco/publico/index.php?componente=GESTPAIS\">Paises</a>\n    </li>\n    <li id=\"GESTDEPA\"><a href=\"/cimco/publico/index.php?componente=GESTDEPA\">Departamentos</a>\n    </li>\n    <li id=\"GESTMUNI\"><a href=\"/cimco/publico/index.php?componente=GESTMUNI\">Municipios</a>\n    </li>\n    <li id=\"GESTCORR\"><a href=\"/cimco/publico/index.php?componente=GESTCORR\">Corregimientos</a>\n    </li>\n    <li id=\"GESTBARR\"><a href=\"/cimco/publico/index.php?componente=GESTBARR\">Barrios</a>\n    </li>\n     </ul>\n    </li>\n     </ul>\n    </li>\n   </ul>\n   </li>\n   <li id=\"MENUFINS\" class=\"menuPrincipal\"><a href=\"/cimco/publico/index.php?componente=MENUFINS\">Finalizar sesión</a>\n   </li>\n</ul>\n\";preferencias_individuales|a:1:{s:8:\"impuesto\";s:2:\"16\";}preferencias_globales|a:1:{s:4:\"pais\";i:0;}fechaActual|s:9:\"CURDATE()\";origenOrdenamiento|s:8:\"GESTCOCL\";sentidoOrdenamiento|s:4:\"DESC\";columnaOrdenamiento|s:6:\"ESTADO\";'),('u61ajfvvh3kirqtm8tub350vd6',1247550445,'');
/*!40000 ALTER TABLE `pance_sesiones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pance_sucursales`
--

DROP TABLE IF EXISTS `pance_sucursales`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `pance_sucursales` (
  `id` mediumint(5) unsigned zerofill NOT NULL auto_increment COMMENT 'Consecutivo interno de la base de datos',
  `codigo` smallint(3) unsigned zerofill NOT NULL COMMENT 'CÃ³digo interno asignado al almacen',
  `id_empresa` smallint(3) unsigned zerofill NOT NULL COMMENT 'CÃ³digo interno de la empresa con la que se relaciona el almacen',
  `nombre` varchar(60) NOT NULL COMMENT 'Nombre que identifica el almacen',
  `nombre_corto` char(10) NOT NULL COMMENT 'Nombre que identifica el almacen en consultas',
  `activo` enum('0','1') NOT NULL default '0' COMMENT 'Indicador de estado del almacen: 0=Inactiva, 1=Activa',
  `id_municipio` int(5) unsigned zerofill NOT NULL COMMENT 'Codigo interno del municipio donde se encuentra la persona o empresa',
  `direccion_residencia` varchar(60) NOT NULL COMMENT 'Direccion donde se encuentra la persona o empresa',
  `telefono_1` varchar(15) default NULL COMMENT 'Primer numero de telefono del lugar de residencia',
  `telefono_2` varchar(15) default NULL COMMENT 'Segundo numero de telefono del lugar de residencia',
  `celular` varchar(15) default NULL COMMENT 'Numero de telefono celular',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `codigo` (`codigo`),
  KEY `sucursal_empresa` (`id_empresa`),
  KEY `sucursal_municipio` (`id_municipio`),
  CONSTRAINT `sucursal_empresa` FOREIGN KEY (`id_empresa`) REFERENCES `pance_empresas` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `sucursal_municipio` FOREIGN KEY (`id_municipio`) REFERENCES `pance_municipios` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=90004 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `pance_sucursales`
--

LOCK TABLES `pance_sucursales` WRITE;
/*!40000 ALTER TABLE `pance_sucursales` DISABLE KEYS */;
INSERT INTO `pance_sucursales` VALUES (90000,002,901,'ANDINA S.A.','ANDINA','1',00513,'CARRERA 3 C No. 20-06','8948484',NULL,NULL),(90001,004,903,'ENERCON LTDA','ENERCON','1',00829,'CARRERA 12 CALLE 19 C.CIAL FIDUCENTRO LOCAL F207','3354801',NULL,NULL),(90002,001,900,'INCOEL LTDA','INCOEL','1',01002,'CALLE 13 No. 66 BIS - 57 C.CIAL LA FONTANA OF 227','6783532',NULL,NULL),(90003,003,902,'INGELCOR LTDA','INGELCOR','1',00427,'CALLE 61 No. 7 - 52','7854745',NULL,NULL);
/*!40000 ALTER TABLE `pance_sucursales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pance_terceros`
--

DROP TABLE IF EXISTS `pance_terceros`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `pance_terceros` (
  `id` int(8) unsigned zerofill NOT NULL auto_increment COMMENT 'Consecutivo interno para la base de datos',
  `documento_identidad` varchar(12) NOT NULL COMMENT 'NÃºmero del documento de identidad',
  `id_tipo_documento` smallint(3) unsigned zerofill NOT NULL COMMENT 'Consecutivo interno para la base de datos del tipo de documento de identidad',
  `id_municipio_documento` int(8) unsigned zerofill NOT NULL COMMENT 'Consecutivo interno para la base de datos del municipio de expediciÃ³n del documento de identidad',
  `tipo_persona` enum('1','2','3') NOT NULL default '1' COMMENT 'Tipo de persona: 1=Natural, 2=Juridica, 3=CÃ³digo interno',
  `primer_nombre` varchar(15) default NULL COMMENT 'Primer nombre (persona natural)',
  `segundo_nombre` varchar(15) default NULL COMMENT 'Segundo nombre (persona natural)',
  `primer_apellido` varchar(20) default NULL COMMENT 'Primer apellido (persona natural)',
  `segundo_apellido` varchar(20) default NULL COMMENT 'Segundo apellido (persona natural)',
  `razon_social` varchar(255) default NULL COMMENT 'Razon social (persona jurÃ­dica)',
  `nombre_comercial` varchar(255) default NULL COMMENT 'Nombre comercial (persona jurÃ­dica)',
  `fecha_nacimiento` date default NULL COMMENT 'Fecha de nacimiento de la persona Ã³ constituciÃ³n de la sociedad',
  `fecha_ingreso` date default NULL COMMENT 'Fecha en que se vinculo el tercero por primera vez con las empresas',
  `id_municipio_residencia` int(8) unsigned zerofill NOT NULL COMMENT 'Consecutivo interno para la base de datos del municipio de residencia',
  `direccion_principal` varchar(50) default NULL COMMENT 'DirecciÃ³n de residencia',
  `telefono_principal` varchar(15) default NULL COMMENT 'NÃºmero de telÃ©fono',
  `telefono_secundario` varchar(15) default NULL COMMENT 'NÃºmero de telÃ©fono secundario',
  `celular` varchar(20) default NULL COMMENT 'NÃºmero de celular',
  `fax` varchar(20) default NULL COMMENT 'NÃºmero de fax',
  `correo` varchar(255) default NULL COMMENT 'DirecciÃ³n de correo electrÃ³nico',
  `sitio_web` varchar(50) default NULL COMMENT 'DirecciÃ³n del sitio web',
  `genero` enum('M','F','N') NOT NULL default 'N' COMMENT 'GÃ©nero: M=Masculino, F=Femenino, N=No aplica',
  `activo` enum('0','1') NOT NULL default '1' COMMENT 'El tercero estÃ¡ activo 0=No, 1=Si',
  `cliente` enum('0','1') NOT NULL default '0' COMMENT 'Cliente 0=No, 1=Si',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `documento_identidad` (`documento_identidad`),
  UNIQUE KEY `razon_social` (`razon_social`),
  UNIQUE KEY `nombre_comercial` (`nombre_comercial`),
  KEY `tercero_tipo_documento` (`id_tipo_documento`),
  KEY `tercero_municipio_documento` (`id_municipio_documento`),
  KEY `tercero_municipio_residencia` (`id_municipio_residencia`),
  CONSTRAINT `tercero_municipio_documento` FOREIGN KEY (`id_municipio_documento`) REFERENCES `pance_municipios` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `tercero_municipio_residencia` FOREIGN KEY (`id_municipio_residencia`) REFERENCES `pance_localidades` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `tercero_tipo_documento` FOREIGN KEY (`id_tipo_documento`) REFERENCES `pance_tipos_documento_identidad` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=90000009 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `pance_terceros`
--

LOCK TABLES `pance_terceros` WRITE;
/*!40000 ALTER TABLE `pance_terceros` DISABLE KEYS */;
INSERT INTO `pance_terceros` VALUES (90000000,'891200487',901,00001002,'2',NULL,NULL,NULL,NULL,'INGENIERIA DE DISE;O Y CONSTRUCCIONES ELECTRICAS INCOEL LTDA','INCOEL LTDA',NULL,NULL,90000000,'CALLE 13 No 66Bis 57 Oficina 227','6783532',NULL,'312',NULL,NULL,NULL,'N','1','0'),(90000001,'900092131',901,00000513,'2',NULL,NULL,NULL,NULL,'EMPRESA ANDINA DE INGENIERIA S.A.','ANDINA',NULL,NULL,90000001,'CARRERA 3C No 20-06','8948484',NULL,NULL,NULL,NULL,NULL,'N','1','0'),(90000002,'812000053',901,00000427,'2',NULL,NULL,NULL,NULL,'INGENIEROS ELECTRICOS DE CORDOBA LTDA','INGELCOR LTDA',NULL,NULL,90000002,'CALLE 61 No. 7-52','7854745',NULL,NULL,NULL,NULL,NULL,'N','1','0'),(90000003,'900192661',901,00000829,'2',NULL,NULL,NULL,NULL,'ENERGIA ELECTRICA Y CONSTRUCCIONES LTDA','ENERCON LTDA',NULL,NULL,90000831,'CARRERA 12 CALLE 19 C.CIAL FIDUCENTRO LOCAL F207','3354801',NULL,NULL,NULL,NULL,NULL,'N','1','0'),(90000004,'860005224',901,00000149,'2',NULL,NULL,NULL,NULL,'BAVARIA S.A.','BAVARIA S.A.',NULL,'2009-02-01',90000151,'CALLE 94 No. 7A - 47','4249000',NULL,NULL,NULL,NULL,NULL,'N','1','1'),(90000005,'900136638',901,00001042,'2',NULL,NULL,NULL,NULL,'CERVECERIA DEL VALLE S.A.','CERVALLE',NULL,'2009-02-01',90001044,'KM 5 VIA AUTOPISTA CALI YUMBO','6919400',NULL,NULL,NULL,NULL,NULL,'N','1','1'),(90000006,'890900168',901,00000059,'2',NULL,NULL,NULL,NULL,'CERVECERIA UNION S.A.','CERVUNION',NULL,'2009-02-02',90000061,'CARRERA 50 No. 38-39','1',NULL,NULL,NULL,NULL,NULL,'N','1','1'),(90000007,'860528319',901,00000149,'2',NULL,NULL,NULL,NULL,'IMPRESORA DEL SUR S.A.','IMPRESUR S.A.',NULL,'2009-02-02',90000151,'CALLE 94 No.7A-47','1',NULL,NULL,NULL,NULL,NULL,'N','1','1'),(90000008,'830101107',901,00000149,'2',NULL,NULL,NULL,NULL,'MALTERIA TROPICAL S.A.','MALTERIA TROPICAL S.A.',NULL,'2009-02-02',90000151,'CALLE 94 No. 7A-47','1',NULL,NULL,NULL,NULL,NULL,'N','1','1');
/*!40000 ALTER TABLE `pance_terceros` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pance_terminales`
--

DROP TABLE IF EXISTS `pance_terminales`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `pance_terminales` (
  `id` smallint(3) unsigned zerofill NOT NULL auto_increment COMMENT 'Consecutivo interno de la base de datos',
  `id_servidor` smallint(3) unsigned zerofill NOT NULL COMMENT 'Consecutivo interno de la base de datos para el servidor al que pertenece',
  `ip` varchar(15) NOT NULL COMMENT 'DrirecciÃ³n IP de la terminal',
  `nombre_netbios` varchar(50) NOT NULL COMMENT 'Nombre NetBIOS',
  `nombre_tcpip` varchar(50) NOT NULL COMMENT 'Nombre TCP/IP',
  `descripcion` varchar(50) default NULL COMMENT 'DescripciÃ³n de la terminal',
  PRIMARY KEY  (`id`),
  KEY `terminal_servidor` (`id_servidor`),
  CONSTRAINT `terminal_servidor` FOREIGN KEY (`id_servidor`) REFERENCES `pance_servidores` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `pance_terminales`
--

LOCK TABLES `pance_terminales` WRITE;
/*!40000 ALTER TABLE `pance_terminales` DISABLE KEYS */;
/*!40000 ALTER TABLE `pance_terminales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pance_tipos_bodegas`
--

DROP TABLE IF EXISTS `pance_tipos_bodegas`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `pance_tipos_bodegas` (
  `id` smallint(3) unsigned zerofill NOT NULL auto_increment COMMENT 'Consecutivo interno de la base de datos',
  `nombre` varchar(60) NOT NULL COMMENT 'Nombre que identifica el tipo de bodega',
  `descripcion` varchar(60) NOT NULL COMMENT 'Nombre que describe el tipo de bodega',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `pance_tipos_bodegas`
--

LOCK TABLES `pance_tipos_bodegas` WRITE;
/*!40000 ALTER TABLE `pance_tipos_bodegas` DISABLE KEYS */;
/*!40000 ALTER TABLE `pance_tipos_bodegas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pance_tipos_documento_identidad`
--

DROP TABLE IF EXISTS `pance_tipos_documento_identidad`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `pance_tipos_documento_identidad` (
  `id` smallint(3) unsigned zerofill NOT NULL auto_increment COMMENT 'Consecutivo interno de la base de datos',
  `codigo_DIAN` smallint(3) unsigned zerofill NOT NULL COMMENT 'CÃ³digo manejo por la DIAN',
  `codigo_interno` smallint(3) unsigned zerofill NOT NULL COMMENT 'CÃ³digo asignado por el usuario',
  `descripcion` varchar(255) NOT NULL COMMENT 'Detalle que identifica el tipo de documento de identidad',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `codigo_DIAN` (`codigo_DIAN`),
  UNIQUE KEY `codigo_interno` (`codigo_interno`),
  UNIQUE KEY `descripcion` (`descripcion`)
) ENGINE=InnoDB AUTO_INCREMENT=902 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `pance_tipos_documento_identidad`
--

LOCK TABLES `pance_tipos_documento_identidad` WRITE;
/*!40000 ALTER TABLE `pance_tipos_documento_identidad` DISABLE KEYS */;
INSERT INTO `pance_tipos_documento_identidad` VALUES (900,001,001,'CEDULA'),(901,002,002,'NIT');
/*!40000 ALTER TABLE `pance_tipos_documento_identidad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pance_usuarios`
--

DROP TABLE IF EXISTS `pance_usuarios`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `pance_usuarios` (
  `id` smallint(4) unsigned zerofill NOT NULL auto_increment COMMENT 'Consecutivo interno para la base de datos',
  `usuario` varchar(12) NOT NULL COMMENT 'Nombre de acceso (login)',
  `contrasena` char(32) NOT NULL COMMENT 'ContraseÃ±a',
  `nombre` char(50) NOT NULL COMMENT 'Nombre completo',
  `correo` varchar(255) NOT NULL COMMENT 'DirecciÃ³n de correo electrÃ³nico',
  `cambiar_contrasena` enum('0','1') NOT NULL default '1' COMMENT 'Puede cambiar la contraseÃ±a: 0=No, 1=Si',
  `fecha_cambio_contrasena` datetime default NULL COMMENT 'Fecha del Ãºltimo cambio de contraseÃ±a',
  `cambio_contrasena_minimo` smallint(4) unsigned NOT NULL default '0' COMMENT 'MÃ­nimo nÃºmero de dÃ­as que deben transcurrir antes de cambiar la contraseÃ±a: 0=No aplica',
  `cambio_contrasena_maximo` smallint(4) unsigned NOT NULL default '0' COMMENT 'MÃ¡ximo nÃºmero de dÃ­as de que pueden transcurrir sin cambiar la contraseÃ±a: 0=No aplica',
  `fecha_expiracion` datetime default NULL COMMENT 'Fecha mÃ¡xima hasta la cual el usuario puede acceder a la aplicaciÃ³n: NULL = No aplica',
  `activo` enum('0','1') NOT NULL default '1' COMMENT 'El usuario se encuentra activo y puede acceder a la aplicaciÃ³n: 0 = No, 1= Si',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `usuario` (`usuario`),
  UNIQUE KEY `correo` (`correo`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `pance_usuarios`
--

LOCK TABLES `pance_usuarios` WRITE;
/*!40000 ALTER TABLE `pance_usuarios` DISABLE KEYS */;
INSERT INTO `pance_usuarios` VALUES (0001,'admin','21232f297a57a5a743894a0e4a801fc3','Administrador Principal','pance@linuxcali.com','1',NULL,0,0,NULL,'1');
/*!40000 ALTER TABLE `pance_usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Final view structure for view `pance_buscador_actas`
--

/*!50001 DROP TABLE `pance_buscador_actas`*/;
/*!50001 DROP VIEW IF EXISTS `pance_buscador_actas`*/;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `pance_buscador_actas` AS select `pance_registro_obras`.`id` AS `id`,`pance_registro_obras`.`fecha_entrega_acta` AS `FECHA_ENTREGA_ACTA`,`pance_registro_obras`.`valor_facturar` AS `VALOR_FACTURAR`,if((`pance_registro_obras`.`factura_consorciado` = _latin1'0'),_latin1'No realizada',_latin1'Realizada') AS `FACTURA_CONSORCIADO`,if((`pance_registro_obras`.`pago_cliente` = _latin1'0'),_latin1'Pendiente',_latin1'Pagada') AS `PAGO_CLIENTE`,if((`pance_registro_obras`.`pago_consorciado` = _latin1'0'),_latin1'Pendiente',_latin1'Pagada') AS `PAGO_CONSORCIADO`,`pance_registro_obras`.`porcentaje_mano_obra` AS `PORCENTAJE_MANO_OBRA`,`pance_registro_obras`.`porcentaje_materiales` AS `PORCENTAJE_MATERIALES` from ((`pance_registro_obras` join `pance_cotizaciones`) join `pance_requerimientos_clientes`) where ((`pance_registro_obras`.`id_cotizacion` = `pance_cotizaciones`.`id`) and (`pance_registro_obras`.`id_requerimiento` = `pance_requerimientos_clientes`.`id`)) */;

--
-- Final view structure for view `pance_buscador_actividades_economicas`
--

/*!50001 DROP TABLE `pance_buscador_actividades_economicas`*/;
/*!50001 DROP VIEW IF EXISTS `pance_buscador_actividades_economicas`*/;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`cimco`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `pance_buscador_actividades_economicas` AS select `pance_actividades_economicas`.`id` AS `id`,`pance_actividades_economicas`.`codigo_DIAN` AS `codigo_DIAN`,`pance_actividades_economicas`.`codigo_interno` AS `codigo_interno`,`pance_actividades_economicas`.`descripcion` AS `descripcion` from `pance_actividades_economicas` */;

--
-- Final view structure for view `pance_buscador_agenda`
--

/*!50001 DROP TABLE `pance_buscador_agenda`*/;
/*!50001 DROP VIEW IF EXISTS `pance_buscador_agenda`*/;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`cimco`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `pance_buscador_agenda` AS select `pance_agenda`.`id` AS `id`,`pance_agenda`.`fecha` AS `fecha`,`pance_agenda`.`hora_inicio` AS `hora_inicio`,`pance_agenda`.`titulo` AS `titulo` from `pance_agenda` */;

--
-- Final view structure for view `pance_buscador_barrios`
--

/*!50001 DROP TABLE `pance_buscador_barrios`*/;
/*!50001 DROP VIEW IF EXISTS `pance_buscador_barrios`*/;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`cimco`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `pance_buscador_barrios` AS select `pance_localidades`.`id` AS `id`,`pance_localidades`.`codigo_municipal` AS `codigo_municipal`,`pance_localidades`.`nombre` AS `nombre`,`pance_localidades`.`codigo_interno` AS `codigo_interno`,`pance_localidades`.`comuna` AS `comuna`,`pance_localidades`.`estrato` AS `estrato`,`pance_municipios`.`nombre` AS `municipio`,`pance_departamentos`.`nombre` AS `departamento`,`pance_paises`.`nombre` AS `pais` from (((`pance_localidades` join `pance_municipios`) join `pance_departamentos`) join `pance_paises`) where ((`pance_localidades`.`id_municipio` = `pance_municipios`.`id`) and (`pance_municipios`.`id_departamento` = `pance_departamentos`.`id`) and (`pance_departamentos`.`id_pais` = `pance_paises`.`id`) and (`pance_localidades`.`tipo` = _latin1'B')) */;

--
-- Final view structure for view `pance_buscador_bodegas`
--

/*!50001 DROP TABLE `pance_buscador_bodegas`*/;
/*!50001 DROP VIEW IF EXISTS `pance_buscador_bodegas`*/;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`cimco`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `pance_buscador_bodegas` AS select `pance_bodegas`.`id` AS `id`,`pance_bodegas`.`codigo` AS `codigo`,`pance_bodegas`.`id_sucursal` AS `codigo_sucursal`,`pance_bodegas`.`nombre` AS `nombre`,`pance_bodegas`.`descripcion` AS `descripcion`,`pance_bodegas`.`tipo_bodega` AS `tipo_bodega`,`pance_sucursales`.`nombre` AS `sucursal` from (`pance_bodegas` join `pance_sucursales`) where (`pance_bodegas`.`id_sucursal` = `pance_sucursales`.`id`) */;

--
-- Final view structure for view `pance_buscador_cargos`
--

/*!50001 DROP TABLE `pance_buscador_cargos`*/;
/*!50001 DROP VIEW IF EXISTS `pance_buscador_cargos`*/;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`cimco`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `pance_buscador_cargos` AS select `pance_cargos`.`id` AS `id`,`pance_cargos`.`codigo_interno` AS `codigo`,`pance_cargos`.`nombre` AS `nombre`,if((`pance_cargos`.`interno` = 0),_latin1'General',_latin1'Interno') AS `INTERNO` from `pance_cargos` */;

--
-- Final view structure for view `pance_buscador_clientes`
--

/*!50001 DROP TABLE `pance_buscador_clientes`*/;
/*!50001 DROP VIEW IF EXISTS `pance_buscador_clientes`*/;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `pance_buscador_clientes` AS select `pance_terceros`.`id` AS `id`,`pance_terceros`.`documento_identidad` AS `documento_identidad`,(case `pance_terceros`.`tipo_persona` when _latin1'1' then _latin1'Natural' when _latin1'2' then _latin1'Juridica' when _latin1'3' then _latin1'Interno' end) AS `tipo_persona`,`pance_terceros`.`id_tipo_documento` AS `id_tipo_documento`,`pance_terceros`.`id_municipio_documento` AS `id_municipio_documento`,`pance_terceros`.`id_municipio_residencia` AS `id_municipio_residencia`,`pance_terceros`.`primer_nombre` AS `primer_nombre`,`pance_terceros`.`segundo_nombre` AS `segundo_nombre`,`pance_terceros`.`primer_apellido` AS `primer_apellido`,`pance_terceros`.`segundo_apellido` AS `segundo_apellido`,`pance_terceros`.`razon_social` AS `razon_social`,`pance_terceros`.`nombre_comercial` AS `nombre_comercial`,`pance_terceros`.`id_tipo_documento` AS `genero`,`pance_terceros`.`direccion_principal` AS `direccion_principal`,`pance_terceros`.`telefono_principal` AS `telefono_principal`,concat(if((`pance_terceros`.`primer_nombre` is not null),`pance_terceros`.`primer_nombre`,_latin1''),_latin1' ',if((`pance_terceros`.`segundo_nombre` is not null),`pance_terceros`.`segundo_nombre`,_latin1''),_latin1' ',if((`pance_terceros`.`primer_apellido` is not null),`pance_terceros`.`primer_apellido`,_latin1''),_latin1' ',if((`pance_terceros`.`segundo_apellido` is not null),`pance_terceros`.`segundo_apellido`,_latin1''),_latin1' ',if((`pance_terceros`.`razon_social` is not null),`pance_terceros`.`razon_social`,_latin1'')) AS `nombre_completo`,`pance_terceros`.`fax` AS `fax`,`pance_terceros`.`celular` AS `celular`,`pance_terceros`.`correo` AS `correo`,`pance_terceros`.`sitio_web` AS `sitio_web` from (`pance_terceros` join `pance_tipos_documento_identidad`) where (`pance_terceros`.`cliente` = _latin1'1') */;

--
-- Final view structure for view `pance_buscador_conexiones`
--

/*!50001 DROP TABLE `pance_buscador_conexiones`*/;
/*!50001 DROP VIEW IF EXISTS `pance_buscador_conexiones`*/;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`cimco`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `pance_buscador_conexiones` AS select `pance_conexiones`.`id` AS `id`,`pance_conexiones`.`fecha` AS `FECHA`,`pance_usuarios`.`nombre` AS `USUARIO`,`pance_conexiones`.`ip` AS `IP`,`pance_conexiones`.`proxy` AS `PROXY` from (`pance_usuarios` join `pance_conexiones`) where (`pance_conexiones`.`id_usuario` = `pance_usuarios`.`id`) */;

--
-- Final view structure for view `pance_buscador_corregimientos`
--

/*!50001 DROP TABLE `pance_buscador_corregimientos`*/;
/*!50001 DROP VIEW IF EXISTS `pance_buscador_corregimientos`*/;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`cimco`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `pance_buscador_corregimientos` AS select `pance_localidades`.`id` AS `id`,concat(`pance_departamentos`.`codigo_dane`,`pance_municipios`.`codigo_dane`,`pance_localidades`.`codigo_dane`) AS `codigo_dane`,`pance_localidades`.`nombre` AS `nombre`,`pance_localidades`.`codigo_interno` AS `codigo_interno`,`pance_municipios`.`nombre` AS `municipio`,`pance_departamentos`.`nombre` AS `departamento`,`pance_paises`.`nombre` AS `pais` from (((`pance_localidades` join `pance_municipios`) join `pance_departamentos`) join `pance_paises`) where ((`pance_localidades`.`id_municipio` = `pance_municipios`.`id`) and (`pance_municipios`.`id_departamento` = `pance_departamentos`.`id`) and (`pance_departamentos`.`id_pais` = `pance_paises`.`id`) and (`pance_localidades`.`tipo` = _latin1'C')) */;

--
-- Final view structure for view `pance_buscador_cotizaciones`
--

/*!50001 DROP TABLE `pance_buscador_cotizaciones`*/;
/*!50001 DROP VIEW IF EXISTS `pance_buscador_cotizaciones`*/;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `pance_buscador_cotizaciones` AS select `pance_cotizaciones`.`id` AS `id`,concat(`pance_cotizaciones`.`numero_cotizacion`,_latin1'-',`pance_cotizaciones`.`consecutivo_cotizacion`) AS `numero_cotizacion`,`pance_cotizaciones`.`numero_cotizacion_consorciado` AS `numero_cotizacion_consorciado`,`pance_requerimientos_clientes`.`fecha_ingreso` AS `fecha_ingreso`,`pance_requerimientos_clientes`.`id_sede` AS `id_sede`,`pance_sedes_clientes`.`nombre_sede` AS `nombre_sede`,`pance_municipios`.`nombre` AS `municipio`,`pance_requerimientos_clientes`.`id_sucursal` AS `sucursal`,(case `pance_requerimientos_clientes`.`tipo_solicitud` when _latin1'M' then _latin1'Mantenimiento' when _latin1'E' then _latin1'Emergencia' when _latin1'S' then _latin1'Servicio por demanda' when _latin1'P' then _latin1'Proyecto' end) AS `tipo_solicitud`,`pance_requerimientos_clientes`.`descripcion` AS `descripcion`,`pance_requerimientos_clientes`.`nombre_contacto` AS `contacto`,if((`pance_cotizaciones`.`forma_pago` = _latin1'0'),_latin1'Pago parcial',_latin1'Contra-entrega') AS `forma_pago`,(case `pance_cotizaciones`.`estado` when _latin1'1' then _latin1'Pendiente' when _latin1'2' then _latin1'Aprobada' when _latin1'3' then _latin1'Anulada' when _latin1'4' then _latin1'Recotizada' when _latin1'5' then _latin1'Reemplazada' when _latin1'6' then _latin1'Cotizada' end) AS `estado` from ((((`pance_requerimientos_clientes` join `pance_sedes_clientes`) join `pance_sucursales`) join `pance_cotizaciones`) join `pance_municipios`) where ((`pance_cotizaciones`.`id_requerimiento` = `pance_requerimientos_clientes`.`id`) and (`pance_requerimientos_clientes`.`id_sede` = `pance_sedes_clientes`.`id`) and (`pance_requerimientos_clientes`.`id_sucursal` = `pance_sucursales`.`id`) and (`pance_municipios`.`id` = `pance_sedes_clientes`.`id_municipios`)) */;

--
-- Final view structure for view `pance_buscador_departamentos`
--

/*!50001 DROP TABLE `pance_buscador_departamentos`*/;
/*!50001 DROP VIEW IF EXISTS `pance_buscador_departamentos`*/;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`cimco`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `pance_buscador_departamentos` AS select `pance_departamentos`.`id` AS `id`,`pance_departamentos`.`codigo_dane` AS `codigo_dane`,`pance_departamentos`.`codigo_interno` AS `codigo_interno`,`pance_departamentos`.`nombre` AS `nombre`,`pance_paises`.`nombre` AS `pais` from (`pance_departamentos` join `pance_paises`) where (`pance_departamentos`.`id_pais` = `pance_paises`.`id`) */;

--
-- Final view structure for view `pance_buscador_empresas`
--

/*!50001 DROP TABLE `pance_buscador_empresas`*/;
/*!50001 DROP VIEW IF EXISTS `pance_buscador_empresas`*/;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`cimco`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `pance_buscador_empresas` AS select `pance_empresas`.`id` AS `id`,`pance_empresas`.`codigo` AS `codigo`,`pance_empresas`.`razon_social` AS `razon_social`,`pance_empresas`.`nombre_corto` AS `nombre_corto`,concat(if((`pance_terceros`.`primer_nombre` is not null),`pance_terceros`.`primer_nombre`,_latin1''),_latin1' ',if((`pance_terceros`.`segundo_nombre` is not null),`pance_terceros`.`segundo_nombre`,_latin1''),_latin1' ',if((`pance_terceros`.`primer_apellido` is not null),`pance_terceros`.`primer_apellido`,_latin1''),_latin1' ',if((`pance_terceros`.`segundo_apellido` is not null),`pance_terceros`.`segundo_apellido`,_latin1''),_latin1' ',if((`pance_terceros`.`razon_social` is not null),`pance_terceros`.`razon_social`,_latin1'')) AS `nombre_completo` from (`pance_empresas` join `pance_terceros`) where (`pance_empresas`.`id_tercero` = `pance_terceros`.`id`) */;

--
-- Final view structure for view `pance_buscador_impresoras`
--

/*!50001 DROP TABLE `pance_buscador_impresoras`*/;
/*!50001 DROP VIEW IF EXISTS `pance_buscador_impresoras`*/;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`cimco`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `pance_buscador_impresoras` AS select `pance_impresoras`.`id` AS `id`,`pance_impresoras`.`nombre_cola` AS `nombre_cola`,`pance_impresoras`.`descripcion` AS `descripcion` from `pance_impresoras` */;

--
-- Final view structure for view `pance_buscador_municipios`
--

/*!50001 DROP TABLE `pance_buscador_municipios`*/;
/*!50001 DROP VIEW IF EXISTS `pance_buscador_municipios`*/;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`cimco`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `pance_buscador_municipios` AS select `pance_municipios`.`id` AS `id`,concat(`pance_departamentos`.`codigo_dane`,`pance_municipios`.`codigo_dane`) AS `codigo_dane`,`pance_municipios`.`codigo_interno` AS `codigo_interno`,`pance_municipios`.`nombre` AS `nombre`,`pance_departamentos`.`nombre` AS `departamento`,`pance_paises`.`nombre` AS `pais` from ((`pance_municipios` join `pance_departamentos`) join `pance_paises`) where ((`pance_municipios`.`id_departamento` = `pance_departamentos`.`id`) and (`pance_departamentos`.`id_pais` = `pance_paises`.`id`)) order by `pance_municipios`.`nombre` */;

--
-- Final view structure for view `pance_buscador_paises`
--

/*!50001 DROP TABLE `pance_buscador_paises`*/;
/*!50001 DROP VIEW IF EXISTS `pance_buscador_paises`*/;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`cimco`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `pance_buscador_paises` AS select `pance_paises`.`id` AS `id`,`pance_paises`.`codigo_iso` AS `codigo_iso`,`pance_paises`.`codigo_interno` AS `codigo_interno`,`pance_paises`.`nombre` AS `nombre` from `pance_paises` */;

--
-- Final view structure for view `pance_buscador_perfiles`
--

/*!50001 DROP TABLE `pance_buscador_perfiles`*/;
/*!50001 DROP VIEW IF EXISTS `pance_buscador_perfiles`*/;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`cimco`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `pance_buscador_perfiles` AS select `pance_perfiles`.`id` AS `id`,`pance_perfiles`.`codigo` AS `codigo`,`pance_perfiles`.`nombre` AS `nombre` from `pance_perfiles` */;

--
-- Final view structure for view `pance_buscador_preferencias`
--

/*!50001 DROP TABLE `pance_buscador_preferencias`*/;
/*!50001 DROP VIEW IF EXISTS `pance_buscador_preferencias`*/;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`cimco`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `pance_buscador_preferencias` AS select `pance_usuarios`.`id` AS `id`,if((`pance_preferencias`.`tipo` = 1),_latin1'Global',_latin1'Individual') AS `TIPO`,`pance_preferencias`.`variable` AS `VARIABLE`,`pance_preferencias`.`valor` AS `VALOR`,if((`pance_preferencias`.`usuario` like _latin1''),_latin1'',(select `pance_usuarios`.`nombre` AS `nombre` from (`pance_usuarios` join `pance_preferencias`) where (`pance_preferencias`.`usuario` = `pance_usuarios`.`id`) group by `pance_preferencias`.`usuario`)) AS `USUARIO` from (`pance_preferencias` join `pance_usuarios`) */;

--
-- Final view structure for view `pance_buscador_privilegios`
--

/*!50001 DROP TABLE `pance_buscador_privilegios`*/;
/*!50001 DROP VIEW IF EXISTS `pance_buscador_privilegios`*/;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`cimco`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `pance_buscador_privilegios` AS select `pance_perfiles_usuario`.`id` AS `id`,`pance_usuarios`.`nombre` AS `usuario`,`pance_sucursales`.`nombre` AS `sucursal` from ((`pance_perfiles_usuario` join `pance_usuarios`) join `pance_sucursales`) where ((`pance_perfiles_usuario`.`id_usuario` = `pance_usuarios`.`id`) and (`pance_perfiles_usuario`.`id_sucursal` = `pance_sucursales`.`id`)) */;

--
-- Final view structure for view `pance_buscador_profesiones_oficios`
--

/*!50001 DROP TABLE `pance_buscador_profesiones_oficios`*/;
/*!50001 DROP VIEW IF EXISTS `pance_buscador_profesiones_oficios`*/;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`cimco`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `pance_buscador_profesiones_oficios` AS select `pance_profesiones_oficios`.`id` AS `id`,`pance_profesiones_oficios`.`descripcion` AS `descripcion` from `pance_profesiones_oficios` */;

--
-- Final view structure for view `pance_buscador_registro_obras`
--

/*!50001 DROP TABLE `pance_buscador_registro_obras`*/;
/*!50001 DROP VIEW IF EXISTS `pance_buscador_registro_obras`*/;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `pance_buscador_registro_obras` AS select `pance_cotizaciones`.`id` AS `id`,`pance_requerimientos_clientes`.`fecha_ingreso` AS `fecha_ingreso`,`pance_requerimientos_clientes`.`id_sede` AS `id_sede`,`pance_sedes_clientes`.`nombre_sede` AS `nombre_sede`,`pance_sedes_clientes`.`id_municipios` AS `municipio`,`pance_requerimientos_clientes`.`id_sucursal` AS `sucursal`,`pance_registro_obras`.`valor_facturar` AS `valor_facturar`,(case `pance_requerimientos_clientes`.`tipo_solicitud` when _latin1'M' then _latin1'Mantenimiento' when _latin1'E' then _latin1'Emergencia' when _latin1'S' then _latin1'Servicio por demanda' when _latin1'P' then _latin1'Proyecto' when _latin1'V' then _latin1'Visita' end) AS `tipo_solicitud`,`pance_requerimientos_clientes`.`descripcion` AS `descripcion` from (((((`pance_requerimientos_clientes` join `pance_sedes_clientes`) join `pance_sucursales`) join `pance_cotizaciones`) join `pance_municipios`) join `pance_registro_obras`) where ((`pance_cotizaciones`.`id_requerimiento` = `pance_requerimientos_clientes`.`id`) and (`pance_requerimientos_clientes`.`id_sede` = `pance_sedes_clientes`.`id`) and (`pance_requerimientos_clientes`.`id_sucursal` = `pance_sucursales`.`id`) and (`pance_municipios`.`id` = `pance_sedes_clientes`.`id_municipios`)) */;

--
-- Final view structure for view `pance_buscador_reporte_visitas`
--

/*!50001 DROP TABLE `pance_buscador_reporte_visitas`*/;
/*!50001 DROP VIEW IF EXISTS `pance_buscador_reporte_visitas`*/;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `pance_buscador_reporte_visitas` AS select `pance_requerimientos_clientes`.`id` AS `id`,`pance_requerimientos_clientes`.`fecha_ingreso` AS `fecha_ingreso`,`pance_sedes_clientes`.`nombre_sede` AS `nombre_sede`,`pance_municipios`.`nombre` AS `municipio`,`pance_requerimientos_clientes`.`id_sucursal` AS `sucursal`,(case `pance_requerimientos_clientes`.`tipo_solicitud` when _latin1'M' then _latin1'Mantenimiento' when _latin1'E' then _latin1'Emergencia' when _latin1'S' then _latin1'Servicio por demanda' when _latin1'P' then _latin1'Proyecto' when _latin1'V' then _latin1'Visita' end) AS `tipo_solicitud`,`pance_requerimientos_clientes`.`descripcion` AS `descripcion`,`pance_requerimientos_clientes`.`nombre_contacto` AS `contacto`,if((`pance_requerimientos_clientes`.`notificado` = _latin1'0'),_latin1'No notificado',_latin1'Notificado') AS `NOTIFICADO` from (((`pance_requerimientos_clientes` join `pance_sedes_clientes`) join `pance_sucursales`) join `pance_municipios`) where ((`pance_requerimientos_clientes`.`id_sede` = `pance_sedes_clientes`.`id`) and (`pance_sedes_clientes`.`id_sucursal` = `pance_sucursales`.`id`) and (`pance_sedes_clientes`.`id_municipios` = `pance_municipios`.`id`) and (`pance_requerimientos_clientes`.`estado_cotizacion` <> _latin1'7')) */;

--
-- Final view structure for view `pance_buscador_requerimientos_clientes`
--

/*!50001 DROP TABLE `pance_buscador_requerimientos_clientes`*/;
/*!50001 DROP VIEW IF EXISTS `pance_buscador_requerimientos_clientes`*/;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `pance_buscador_requerimientos_clientes` AS select `pance_requerimientos_clientes`.`id` AS `id`,`pance_sedes_clientes`.`nombre_sede` AS `nombre_sede`,`pance_sucursales`.`nombre` AS `sucursal`,`pance_municipios`.`nombre` AS `municipio`,(case `pance_requerimientos_clientes`.`tipo_solicitud` when _latin1'M' then _latin1'Mantenimiento' when _latin1'E' then _latin1'Emergencia' when _latin1'S' then _latin1'Servicio por demanda' when _latin1'P' then _latin1'Proyecto' when _latin1'V' then _latin1'Visita' end) AS `tipo_solicitud`,(case `pance_requerimientos_clientes`.`estado_cotizacion` when _latin1'1' then _latin1'Pendiente' when _latin1'2' then _latin1'Aprobada' when _latin1'3' then _latin1'Anulada' when _latin1'4' then _latin1'Recotizar' when _latin1'5' then _latin1'Reemplazada' when _latin1'6' then _latin1'No cotizada' when _latin1'7' then _latin1'No requiere' end) AS `estado_cotizacion`,`pance_requerimientos_clientes`.`nombre_contacto` AS `contacto` from (((`pance_requerimientos_clientes` join `pance_sedes_clientes`) join `pance_sucursales`) join `pance_municipios`) where ((`pance_requerimientos_clientes`.`id_sede` = `pance_sedes_clientes`.`id`) and (`pance_requerimientos_clientes`.`id_sucursal` = `pance_sucursales`.`id`) and (`pance_sedes_clientes`.`id_municipios` = `pance_municipios`.`id`)) */;

--
-- Final view structure for view `pance_buscador_secciones`
--

/*!50001 DROP TABLE `pance_buscador_secciones`*/;
/*!50001 DROP VIEW IF EXISTS `pance_buscador_secciones`*/;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`cimco`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `pance_buscador_secciones` AS select `pance_secciones`.`id` AS `id`,`pance_secciones`.`nombre` AS `nombre`,`pance_secciones`.`descripcion` AS `descripcion`,`pance_secciones`.`id_bodega` AS `codigo_bodega`,`pance_secciones`.`codigo` AS `codigo`,`pance_bodegas`.`nombre` AS `bodega` from (`pance_secciones` join `pance_bodegas`) where (`pance_secciones`.`id_bodega` = `pance_bodegas`.`id`) */;

--
-- Final view structure for view `pance_buscador_sedes_clientes`
--

/*!50001 DROP TABLE `pance_buscador_sedes_clientes`*/;
/*!50001 DROP VIEW IF EXISTS `pance_buscador_sedes_clientes`*/;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `pance_buscador_sedes_clientes` AS select `pance_sedes_clientes`.`id` AS `id`,concat(if((`pance_terceros`.`primer_nombre` is not null),`pance_terceros`.`primer_nombre`,_latin1''),_latin1' ',if((`pance_terceros`.`segundo_nombre` is not null),`pance_terceros`.`segundo_nombre`,_latin1''),_latin1' ',if((`pance_terceros`.`primer_apellido` is not null),`pance_terceros`.`primer_apellido`,_latin1''),_latin1' ',if((`pance_terceros`.`segundo_apellido` is not null),`pance_terceros`.`segundo_apellido`,_latin1''),_latin1' ',if((`pance_terceros`.`razon_social` is not null),`pance_terceros`.`razon_social`,_latin1'')) AS `id_cliente`,if((`pance_sucursales`.`nombre` is not null),`pance_sucursales`.`nombre`,_latin1'') AS `id_sucursal`,`pance_sedes_clientes`.`nombre_sede` AS `nombre_sede`,`pance_sedes_clientes`.`nombre_contacto` AS `nombre_contacto`,`pance_sedes_clientes`.`id_municipios` AS `id_municipios`,`pance_sedes_clientes`.`direccion` AS `direccion`,`pance_sedes_clientes`.`telefono_principal` AS `telefono_principal`,`pance_sedes_clientes`.`celular` AS `celular`,`pance_sedes_clientes`.`correo` AS `correo` from (((`pance_sedes_clientes` join `pance_sucursales`) join `pance_terceros`) join `pance_municipios`) where ((`pance_terceros`.`id` = `pance_sedes_clientes`.`id_cliente`) and (`pance_sedes_clientes`.`id_sucursal` = `pance_sucursales`.`id`)) */;

--
-- Final view structure for view `pance_buscador_servidores`
--

/*!50001 DROP TABLE `pance_buscador_servidores`*/;
/*!50001 DROP VIEW IF EXISTS `pance_buscador_servidores`*/;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`cimco`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `pance_buscador_servidores` AS select `pance_servidores`.`id` AS `id`,`pance_servidores`.`ip` AS `ip`,`pance_servidores`.`nombre_netbios` AS `nombre_netbios`,`pance_servidores`.`nombre_tcpip` AS `nombre_tcpip` from `pance_servidores` */;

--
-- Final view structure for view `pance_buscador_sucursales`
--

/*!50001 DROP TABLE `pance_buscador_sucursales`*/;
/*!50001 DROP VIEW IF EXISTS `pance_buscador_sucursales`*/;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`cimco`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `pance_buscador_sucursales` AS select `pance_sucursales`.`id` AS `id`,`pance_sucursales`.`codigo` AS `codigo`,`pance_sucursales`.`nombre` AS `nombre`,`pance_sucursales`.`nombre_corto` AS `nombre_corto`,`pance_empresas`.`razon_social` AS `empresa`,concat(if((`pance_terceros`.`primer_nombre` is not null),`pance_terceros`.`primer_nombre`,_latin1''),_latin1' ',if((`pance_terceros`.`segundo_nombre` is not null),`pance_terceros`.`segundo_nombre`,_latin1''),_latin1' ',if((`pance_terceros`.`primer_apellido` is not null),`pance_terceros`.`primer_apellido`,_latin1''),_latin1' ',if((`pance_terceros`.`segundo_apellido` is not null),`pance_terceros`.`segundo_apellido`,_latin1''),_latin1' ',if((`pance_terceros`.`razon_social` is not null),`pance_terceros`.`razon_social`,_latin1'')) AS `tercero` from ((`pance_sucursales` join `pance_terceros`) join `pance_empresas`) where ((`pance_sucursales`.`id_empresa` = `pance_empresas`.`id`) and (`pance_empresas`.`id_tercero` = `pance_terceros`.`id`)) */;

--
-- Final view structure for view `pance_buscador_terminales`
--

/*!50001 DROP TABLE `pance_buscador_terminales`*/;
/*!50001 DROP VIEW IF EXISTS `pance_buscador_terminales`*/;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`cimco`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `pance_buscador_terminales` AS select `pance_terminales`.`id` AS `id`,`pance_terminales`.`ip` AS `ip`,`pance_terminales`.`nombre_netbios` AS `nombre_netbios`,`pance_terminales`.`nombre_tcpip` AS `nombre_tcpip` from `pance_terminales` */;

--
-- Final view structure for view `pance_buscador_tipos_bodegas`
--

/*!50001 DROP TABLE `pance_buscador_tipos_bodegas`*/;
/*!50001 DROP VIEW IF EXISTS `pance_buscador_tipos_bodegas`*/;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`cimco`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `pance_buscador_tipos_bodegas` AS select `pance_tipos_bodegas`.`id` AS `id`,`pance_tipos_bodegas`.`nombre` AS `nombre`,`pance_tipos_bodegas`.`descripcion` AS `descripcion` from `pance_tipos_bodegas` */;

--
-- Final view structure for view `pance_buscador_tipos_documento_identidad`
--

/*!50001 DROP TABLE `pance_buscador_tipos_documento_identidad`*/;
/*!50001 DROP VIEW IF EXISTS `pance_buscador_tipos_documento_identidad`*/;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`cimco`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `pance_buscador_tipos_documento_identidad` AS select `pance_tipos_documento_identidad`.`id` AS `id`,`pance_tipos_documento_identidad`.`codigo_DIAN` AS `codigo_DIAN`,`pance_tipos_documento_identidad`.`codigo_interno` AS `codigo_interno`,`pance_tipos_documento_identidad`.`descripcion` AS `descripcion` from `pance_tipos_documento_identidad` */;

--
-- Final view structure for view `pance_buscador_usuarios`
--

/*!50001 DROP TABLE `pance_buscador_usuarios`*/;
/*!50001 DROP VIEW IF EXISTS `pance_buscador_usuarios`*/;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`cimco`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `pance_buscador_usuarios` AS select `pance_usuarios`.`id` AS `id`,`pance_usuarios`.`usuario` AS `usuario`,`pance_usuarios`.`nombre` AS `nombre` from `pance_usuarios` */;

--
-- Final view structure for view `pance_consulta_bitacora`
--

/*!50001 DROP TABLE `pance_consulta_bitacora`*/;
/*!50001 DROP VIEW IF EXISTS `pance_consulta_bitacora`*/;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`cimco`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `pance_consulta_bitacora` AS select `pance_bitacora`.`id_conexion` AS `id`,date_format(`pance_bitacora`.`fecha`,_latin1'%Y/%m/%d') AS `FECHA`,date_format(`pance_bitacora`.`fecha`,_latin1'%r') AS `HORA`,`pance_bitacora`.`componente` AS `COMPONENTE`,`pance_bitacora`.`consulta` AS `CONSULTA`,`pance_bitacora`.`mensaje` AS `MENSAJE` from `pance_bitacora` */;

--
-- Final view structure for view `pance_menu_actas`
--

/*!50001 DROP TABLE `pance_menu_actas`*/;
/*!50001 DROP VIEW IF EXISTS `pance_menu_actas`*/;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `pance_menu_actas` AS select `pance_registro_obras`.`id` AS `id`,(case `pance_registro_obras`.`tipo_acta` when _latin1'1' then _latin1'Inicio' when _latin1'2' then _latin1'Avance obra' when _latin1'3' then _latin1'Finalizaci?n' end) AS `TIPO_ACTA`,`pance_registro_obras`.`fecha_entrega_acta` AS `FECHA_ENTREGA_ACTA`,`pance_registro_obras`.`valor_facturar` AS `VALOR_FACTURAR`,if((`pance_registro_obras`.`factura_consorciado` = _latin1'0'),_latin1'No realizada',_latin1'Realizada') AS `FACTURA_CONSORCIADO`,if((`pance_registro_obras`.`pago_cliente` = _latin1'0'),_latin1'Pendiente',_latin1'Pagada') AS `PAGO_CLIENTE`,if((`pance_registro_obras`.`pago_consorciado` = _latin1'0'),_latin1'Pendiente',_latin1'Pagada') AS `PAGO_CONSORCIADO`,`pance_registro_obras`.`porcentaje_mano_obra` AS `PORCENTAJE_MANO_OBRA`,`pance_registro_obras`.`porcentaje_materiales` AS `PORCENTAJE_MATERIALES` from ((`pance_registro_obras` join `pance_cotizaciones`) join `pance_requerimientos_clientes`) where ((`pance_registro_obras`.`id_cotizacion` = `pance_cotizaciones`.`id`) and (`pance_registro_obras`.`id_requerimiento` = `pance_requerimientos_clientes`.`id`)) */;

--
-- Final view structure for view `pance_menu_actividades_economicas`
--

/*!50001 DROP TABLE `pance_menu_actividades_economicas`*/;
/*!50001 DROP VIEW IF EXISTS `pance_menu_actividades_economicas`*/;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`cimco`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `pance_menu_actividades_economicas` AS select `pance_actividades_economicas`.`id` AS `id`,`pance_actividades_economicas`.`codigo_DIAN` AS `CODIGO_DIAN`,`pance_actividades_economicas`.`codigo_interno` AS `CODIGO_INTERNO`,`pance_actividades_economicas`.`descripcion` AS `DESCRIPCION` from `pance_actividades_economicas` */;

--
-- Final view structure for view `pance_menu_agenda`
--

/*!50001 DROP TABLE `pance_menu_agenda`*/;
/*!50001 DROP VIEW IF EXISTS `pance_menu_agenda`*/;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `pance_menu_agenda` AS select `pance_agenda`.`id` AS `id`,`pance_agenda`.`hora_inicio` AS `HORA_INICIO`,`pance_agenda`.`titulo` AS `TITULO`,`pance_agenda`.`id_usuario` AS `id_usuario`,`pance_agenda`.`fecha` AS `id_fecha` from `pance_agenda` */;

--
-- Final view structure for view `pance_menu_barrios`
--

/*!50001 DROP TABLE `pance_menu_barrios`*/;
/*!50001 DROP VIEW IF EXISTS `pance_menu_barrios`*/;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`cimco`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `pance_menu_barrios` AS select `pance_localidades`.`id` AS `id`,`pance_localidades`.`nombre` AS `NOMBRE`,`pance_municipios`.`nombre` AS `MUNICIPIO`,`pance_departamentos`.`nombre` AS `DEPARTAMENTO`,`pance_paises`.`nombre` AS `PAIS` from (((`pance_localidades` join `pance_municipios`) join `pance_departamentos`) join `pance_paises`) where ((`pance_localidades`.`id_municipio` = `pance_municipios`.`id`) and (`pance_municipios`.`id_departamento` = `pance_departamentos`.`id`) and (`pance_departamentos`.`id_pais` = `pance_paises`.`id`) and (`pance_localidades`.`tipo` = _latin1'B')) */;

--
-- Final view structure for view `pance_menu_bodegas`
--

/*!50001 DROP TABLE `pance_menu_bodegas`*/;
/*!50001 DROP VIEW IF EXISTS `pance_menu_bodegas`*/;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`cimco`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `pance_menu_bodegas` AS select `pance_bodegas`.`id` AS `id`,`pance_bodegas`.`codigo` AS `CODIGO`,`pance_bodegas`.`nombre` AS `NOMBRE`,`pance_bodegas`.`descripcion` AS `DESCRIPCION`,`pance_sucursales`.`nombre` AS `SUCURSAL` from (`pance_bodegas` join `pance_sucursales`) where (`pance_bodegas`.`id_sucursal` = `pance_sucursales`.`id`) */;

--
-- Final view structure for view `pance_menu_cargos`
--

/*!50001 DROP TABLE `pance_menu_cargos`*/;
/*!50001 DROP VIEW IF EXISTS `pance_menu_cargos`*/;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`cimco`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `pance_menu_cargos` AS select `pance_cargos`.`id` AS `id`,`pance_cargos`.`codigo_interno` AS `CODIGO`,`pance_cargos`.`nombre` AS `NOMBRE`,if((`pance_cargos`.`interno` = 0),_latin1'General',_latin1'Interno') AS `INTERNO` from `pance_cargos` */;

--
-- Final view structure for view `pance_menu_clientes`
--

/*!50001 DROP TABLE `pance_menu_clientes`*/;
/*!50001 DROP VIEW IF EXISTS `pance_menu_clientes`*/;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `pance_menu_clientes` AS select `pance_terceros`.`id` AS `id`,`pance_terceros`.`documento_identidad` AS `DOCUMENTO_CLIENTE`,concat(if((`pance_terceros`.`primer_nombre` is not null),`pance_terceros`.`primer_nombre`,_latin1''),_latin1' ',if((`pance_terceros`.`segundo_nombre` is not null),`pance_terceros`.`segundo_nombre`,_latin1''),_latin1' ',if((`pance_terceros`.`primer_apellido` is not null),`pance_terceros`.`primer_apellido`,_latin1''),_latin1' ',if((`pance_terceros`.`segundo_apellido` is not null),`pance_terceros`.`segundo_apellido`,_latin1''),_latin1' ',if((`pance_terceros`.`razon_social` is not null),`pance_terceros`.`razon_social`,_latin1'')) AS `CLIENTE` from `pance_terceros` where (`pance_terceros`.`cliente` = _latin1'1') */;

--
-- Final view structure for view `pance_menu_conexiones`
--

/*!50001 DROP TABLE `pance_menu_conexiones`*/;
/*!50001 DROP VIEW IF EXISTS `pance_menu_conexiones`*/;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`cimco`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `pance_menu_conexiones` AS select `pance_conexiones`.`id` AS `id`,date_format(`pance_conexiones`.`fecha`,_latin1'%Y/%m/%d') AS `FECHA`,date_format(`pance_conexiones`.`fecha`,_latin1'%r') AS `HORA`,`pance_usuarios`.`nombre` AS `USUARIO`,`pance_conexiones`.`ip` AS `IP`,`pance_conexiones`.`proxy` AS `PROXY`,`pance_conexiones`.`fecha` AS `id_fecha` from (`pance_usuarios` join `pance_conexiones`) where (`pance_conexiones`.`id_usuario` = `pance_usuarios`.`id`) */;

--
-- Final view structure for view `pance_menu_corregimientos`
--

/*!50001 DROP TABLE `pance_menu_corregimientos`*/;
/*!50001 DROP VIEW IF EXISTS `pance_menu_corregimientos`*/;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`cimco`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `pance_menu_corregimientos` AS select `pance_localidades`.`id` AS `id`,`pance_localidades`.`nombre` AS `NOMBRE`,`pance_municipios`.`nombre` AS `MUNICIPIO`,`pance_departamentos`.`nombre` AS `DEPARTAMENTO`,`pance_paises`.`nombre` AS `PAIS` from (((`pance_localidades` join `pance_municipios`) join `pance_departamentos`) join `pance_paises`) where ((`pance_localidades`.`id_municipio` = `pance_municipios`.`id`) and (`pance_municipios`.`id_departamento` = `pance_departamentos`.`id`) and (`pance_departamentos`.`id_pais` = `pance_paises`.`id`) and (`pance_localidades`.`tipo` = _latin1'C')) */;

--
-- Final view structure for view `pance_menu_cotizaciones`
--

/*!50001 DROP TABLE `pance_menu_cotizaciones`*/;
/*!50001 DROP VIEW IF EXISTS `pance_menu_cotizaciones`*/;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `pance_menu_cotizaciones` AS select `pance_cotizaciones`.`id` AS `id`,concat(`pance_cotizaciones`.`numero_cotizacion`,_latin1'-',`pance_cotizaciones`.`consecutivo_cotizacion`) AS `NUMERO_COTIZACION`,`pance_cotizaciones`.`numero_cotizacion_consorciado` AS `NUMERO_COTIZACION_CONSORCIADO`,`pance_sedes_clientes`.`nombre_sede` AS `SEDE`,`pance_municipios`.`nombre` AS `MUNICIPIO`,`pance_sucursales`.`nombre` AS `SUCURSAL`,`pance_requerimientos_clientes`.`fecha_ingreso` AS `FECHA_INGRESO`,`pance_requerimientos_clientes`.`descripcion` AS `DESCRIPCION`,`pance_requerimientos_clientes`.`nombre_contacto` AS `CONTACTO`,(case `pance_cotizaciones`.`estado` when _latin1'1' then _latin1'Pendiente' when _latin1'2' then _latin1'Aprobada' when _latin1'3' then _latin1'Anulada' when _latin1'4' then _latin1'Recotizada' when _latin1'5' then _latin1'Reemplazada' when _latin1'6' then _latin1'Cotizada' end) AS `ESTADO` from ((((`pance_requerimientos_clientes` join `pance_sedes_clientes`) join `pance_municipios`) join `pance_cotizaciones`) join `pance_sucursales`) where ((`pance_cotizaciones`.`id_requerimiento` = `pance_requerimientos_clientes`.`id`) and (`pance_requerimientos_clientes`.`id_sede` = `pance_sedes_clientes`.`id`) and (`pance_requerimientos_clientes`.`id_sucursal` = `pance_sucursales`.`id`) and (`pance_municipios`.`id` = `pance_sedes_clientes`.`id_municipios`)) */;

--
-- Final view structure for view `pance_menu_departamentos`
--

/*!50001 DROP TABLE `pance_menu_departamentos`*/;
/*!50001 DROP VIEW IF EXISTS `pance_menu_departamentos`*/;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`cimco`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `pance_menu_departamentos` AS select `pance_departamentos`.`id` AS `id`,`pance_departamentos`.`codigo_dane` AS `CODIGO_DANE`,`pance_departamentos`.`nombre` AS `NOMBRE`,`pance_paises`.`nombre` AS `PAIS` from (`pance_departamentos` join `pance_paises`) where (`pance_departamentos`.`id_pais` = `pance_paises`.`id`) */;

--
-- Final view structure for view `pance_menu_empresas`
--

/*!50001 DROP TABLE `pance_menu_empresas`*/;
/*!50001 DROP VIEW IF EXISTS `pance_menu_empresas`*/;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`cimco`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `pance_menu_empresas` AS select `pance_empresas`.`id` AS `id`,`pance_empresas`.`codigo` AS `CODIGO_EMPRESA`,`pance_empresas`.`razon_social` AS `RAZON_SOCIAL`,if((`pance_empresas`.`activo` = 0),_latin1'Inactiva',_latin1'Activa') AS `ACTIVO`,if((`pance_empresas`.`regimen` = 1),_latin1'Comun',_latin1'Simplificado') AS `REGIMEN`,`pance_terceros`.`documento_identidad` AS `TERCERO` from (`pance_empresas` join `pance_terceros`) where (`pance_empresas`.`id_tercero` = `pance_terceros`.`id`) */;

--
-- Final view structure for view `pance_menu_impresoras`
--

/*!50001 DROP TABLE `pance_menu_impresoras`*/;
/*!50001 DROP VIEW IF EXISTS `pance_menu_impresoras`*/;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`cimco`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `pance_menu_impresoras` AS select `pance_impresoras`.`id` AS `id`,`pance_impresoras`.`nombre_cola` AS `NOMBRE_COLA`,`pance_impresoras`.`descripcion` AS `DESCRIPCION` from `pance_impresoras` */;

--
-- Final view structure for view `pance_menu_municipios`
--

/*!50001 DROP TABLE `pance_menu_municipios`*/;
/*!50001 DROP VIEW IF EXISTS `pance_menu_municipios`*/;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`cimco`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `pance_menu_municipios` AS select `pance_municipios`.`id` AS `id`,concat(`pance_departamentos`.`codigo_dane`,`pance_municipios`.`codigo_dane`) AS `CODIGO_DANE`,`pance_municipios`.`nombre` AS `NOMBRE`,`pance_departamentos`.`nombre` AS `DEPARTAMENTO`,`pance_paises`.`nombre` AS `PAIS` from ((`pance_municipios` join `pance_departamentos`) join `pance_paises`) where ((`pance_municipios`.`id_departamento` = `pance_departamentos`.`id`) and (`pance_departamentos`.`id_pais` = `pance_paises`.`id`)) order by `pance_municipios`.`nombre` */;

--
-- Final view structure for view `pance_menu_notas`
--

/*!50001 DROP TABLE `pance_menu_notas`*/;
/*!50001 DROP VIEW IF EXISTS `pance_menu_notas`*/;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`cimco`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `pance_menu_notas` AS select `pance_notas`.`id` AS `id`,`pance_notas`.`nota` AS `NOTAS` from `pance_notas` order by `pance_notas`.`fecha` */;

--
-- Final view structure for view `pance_menu_paises`
--

/*!50001 DROP TABLE `pance_menu_paises`*/;
/*!50001 DROP VIEW IF EXISTS `pance_menu_paises`*/;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`cimco`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `pance_menu_paises` AS select `pance_paises`.`id` AS `id`,`pance_paises`.`codigo_iso` AS `CODIGO_ISO`,`pance_paises`.`nombre` AS `NOMBRE` from `pance_paises` */;

--
-- Final view structure for view `pance_menu_perfiles`
--

/*!50001 DROP TABLE `pance_menu_perfiles`*/;
/*!50001 DROP VIEW IF EXISTS `pance_menu_perfiles`*/;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`cimco`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `pance_menu_perfiles` AS select `pance_perfiles`.`id` AS `id`,`pance_perfiles`.`codigo` AS `CODIGO`,`pance_perfiles`.`nombre` AS `NOMBRE` from `pance_perfiles` */;

--
-- Final view structure for view `pance_menu_preferencias`
--

/*!50001 DROP TABLE `pance_menu_preferencias`*/;
/*!50001 DROP VIEW IF EXISTS `pance_menu_preferencias`*/;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`cimco`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `pance_menu_preferencias` AS select `pance_preferencias`.`id` AS `id`,if((`pance_preferencias`.`tipo` = 1),_latin1'Global',_latin1'Individual') AS `TIPO`,if((`pance_preferencias`.`usuario` like _latin1''),_latin1'',(select `pance_usuarios`.`nombre` AS `nombre` from (`pance_usuarios` join `pance_preferencias`) where (`pance_preferencias`.`usuario` = `pance_usuarios`.`id`) group by `pance_preferencias`.`usuario`)) AS `USUARIO` from `pance_preferencias` group by `pance_preferencias`.`usuario` */;

--
-- Final view structure for view `pance_menu_preferencias_globales`
--

/*!50001 DROP TABLE `pance_menu_preferencias_globales`*/;
/*!50001 DROP VIEW IF EXISTS `pance_menu_preferencias_globales`*/;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`cimco`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `pance_menu_preferencias_globales` AS select `pance_menu_sucursales`.`id` AS `id`,`pance_menu_sucursales`.`CODIGO` AS `CODIGO`,`pance_menu_sucursales`.`NOMBRE` AS `NOMBRE` from `pance_menu_sucursales` */;

--
-- Final view structure for view `pance_menu_privilegios`
--

/*!50001 DROP TABLE `pance_menu_privilegios`*/;
/*!50001 DROP VIEW IF EXISTS `pance_menu_privilegios`*/;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`cimco`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `pance_menu_privilegios` AS select `pance_perfiles_usuario`.`id` AS `id`,`pance_usuarios`.`nombre` AS `USUARIO`,`pance_sucursales`.`nombre` AS `SUCURSAL` from ((`pance_perfiles_usuario` join `pance_usuarios`) join `pance_sucursales`) where ((`pance_perfiles_usuario`.`id_usuario` = `pance_usuarios`.`id`) and (`pance_perfiles_usuario`.`id_sucursal` = `pance_sucursales`.`id`)) */;

--
-- Final view structure for view `pance_menu_profesiones_oficios`
--

/*!50001 DROP TABLE `pance_menu_profesiones_oficios`*/;
/*!50001 DROP VIEW IF EXISTS `pance_menu_profesiones_oficios`*/;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`cimco`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `pance_menu_profesiones_oficios` AS select `pance_profesiones_oficios`.`id` AS `id`,`pance_profesiones_oficios`.`codigo_DANE` AS `CODIGO_DANE`,`pance_profesiones_oficios`.`codigo_interno` AS `CODIGO_INTERNO`,`pance_profesiones_oficios`.`descripcion` AS `DESCRIPCION` from `pance_profesiones_oficios` */;

--
-- Final view structure for view `pance_menu_registro_ingresos`
--

/*!50001 DROP TABLE `pance_menu_registro_ingresos`*/;
/*!50001 DROP VIEW IF EXISTS `pance_menu_registro_ingresos`*/;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `pance_menu_registro_ingresos` AS select `pance_requerimientos_clientes`.`id` AS `id`,`pance_requerimientos_clientes`.`fecha_ingreso` AS `FECHA_INGRESO`,`pance_cotizaciones`.`numero_cotizacion` AS `NUMERO_COTIZACION`,`pance_requerimientos_clientes`.`descripcion` AS `DESCRIPCION` from (`pance_requerimientos_clientes` join `pance_cotizaciones`) */;

--
-- Final view structure for view `pance_menu_registro_obras`
--

/*!50001 DROP TABLE `pance_menu_registro_obras`*/;
/*!50001 DROP VIEW IF EXISTS `pance_menu_registro_obras`*/;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `pance_menu_registro_obras` AS select `pance_cotizaciones`.`id` AS `id`,`pance_requerimientos_clientes`.`fecha_ingreso` AS `FECHA_INGRESO`,`pance_sedes_clientes`.`nombre_sede` AS `SEDE`,`pance_municipios`.`nombre` AS `MUNICIPIO`,`pance_requerimientos_clientes`.`descripcion` AS `DESCRIPCION`,`pance_sucursales`.`nombre` AS `SUCURSAL`,(case `pance_requerimientos_clientes`.`tipo_solicitud` when _latin1'M' then _latin1'Mantenimiento' when _latin1'E' then _latin1'Emergencia' when _latin1'S' then _latin1'Servicio por demanda' when _latin1'P' then _latin1'Proyecto' when _latin1'V' then _latin1'Visita' end) AS `TIPO_SOLICITUD` from ((((`pance_requerimientos_clientes` join `pance_sedes_clientes`) join `pance_sucursales`) join `pance_municipios`) join `pance_cotizaciones`) where ((`pance_requerimientos_clientes`.`id_sede` = `pance_sedes_clientes`.`id`) and (`pance_requerimientos_clientes`.`id_sucursal` = `pance_sucursales`.`id`) and (`pance_sedes_clientes`.`id_municipios` = `pance_municipios`.`id`) and (`pance_requerimientos_clientes`.`estado_aprobacion_requerimiento` = _latin1'1') and (`pance_requerimientos_clientes`.`id` = `pance_cotizaciones`.`id_requerimiento`) and (`pance_cotizaciones`.`estado` = _latin1'2')) */;

--
-- Final view structure for view `pance_menu_reporte_visitas`
--

/*!50001 DROP TABLE `pance_menu_reporte_visitas`*/;
/*!50001 DROP VIEW IF EXISTS `pance_menu_reporte_visitas`*/;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `pance_menu_reporte_visitas` AS select `pance_requerimientos_clientes`.`id` AS `id`,`pance_requerimientos_clientes`.`fecha_ingreso` AS `FECHA_INGRESO`,`pance_sedes_clientes`.`nombre_sede` AS `SEDE`,`pance_municipios`.`nombre` AS `MUNICIPIO`,`pance_requerimientos_clientes`.`descripcion` AS `DESCRIPCION`,`pance_sucursales`.`nombre` AS `SUCURSAL`,(case `pance_requerimientos_clientes`.`tipo_solicitud` when _latin1'M' then _latin1'Mantenimiento' when _latin1'E' then _latin1'Emergencia' when _latin1'S' then _latin1'Servicio por demanda' when _latin1'P' then _latin1'Proyecto' when _latin1'V' then _latin1'Visita' end) AS `TIPO_SOLICITUD`,if((`pance_requerimientos_clientes`.`notificado` = _latin1'0'),_latin1'No',_latin1'Si') AS `NOTIFICADO`,(case `pance_requerimientos_clientes`.`estado_cotizacion` when _latin1'1' then _latin1'Pendiente' when _latin1'2' then _latin1'Aprobada' when _latin1'3' then _latin1'Anulada' when _latin1'4' then _latin1'Recotizar' when _latin1'5' then _latin1'Reemplazada' when _latin1'6' then _latin1'No cotizada' when _latin1'7' then _latin1'No requiere' end) AS `ESTADO_COTIZACION` from (((`pance_requerimientos_clientes` join `pance_sedes_clientes`) join `pance_sucursales`) join `pance_municipios`) where ((`pance_requerimientos_clientes`.`id_sede` = `pance_sedes_clientes`.`id`) and (`pance_requerimientos_clientes`.`id_sucursal` = `pance_sucursales`.`id`) and (`pance_sedes_clientes`.`id_municipios` = `pance_municipios`.`id`) and (`pance_requerimientos_clientes`.`notificado` = _latin1'1') and (`pance_requerimientos_clientes`.`estado_aprobacion_requerimiento` = _latin1'0') and (`pance_requerimientos_clientes`.`estado_cotizacion` <> _latin1'7')) order by `pance_requerimientos_clientes`.`fecha_ingreso` desc */;

--
-- Final view structure for view `pance_menu_requerimientos_clientes`
--

/*!50001 DROP TABLE `pance_menu_requerimientos_clientes`*/;
/*!50001 DROP VIEW IF EXISTS `pance_menu_requerimientos_clientes`*/;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `pance_menu_requerimientos_clientes` AS select `pance_requerimientos_clientes`.`id` AS `id`,`pance_requerimientos_clientes`.`fecha_ingreso` AS `FECHA_INGRESO`,`pance_sedes_clientes`.`nombre_sede` AS `SEDE`,`pance_municipios`.`nombre` AS `MUNICIPIO`,`pance_requerimientos_clientes`.`descripcion` AS `DESCRIPCION`,`pance_sucursales`.`nombre` AS `SUCURSAL`,(case `pance_requerimientos_clientes`.`tipo_solicitud` when _latin1'M' then _latin1'Mantenimiento' when _latin1'E' then _latin1'Emergencia' when _latin1'S' then _latin1'Servicio por demanda' when _latin1'P' then _latin1'Proyecto' when _latin1'V' then _latin1'Visita' end) AS `TIPO_SOLICITUD`,if((`pance_requerimientos_clientes`.`notificado` = _latin1'0'),_latin1'No',_latin1'Si') AS `NOTIFICADO`,(case `pance_requerimientos_clientes`.`estado_cotizacion` when _latin1'1' then _latin1'Pendiente' when _latin1'2' then _latin1'Aprobada' when _latin1'3' then _latin1'Anulada' when _latin1'4' then _latin1'Recotizar' when _latin1'5' then _latin1'Reemplazada' when _latin1'6' then _latin1'No cotizada' when _latin1'7' then _latin1'No requiere' end) AS `ESTADO_COTIZACION` from (((`pance_requerimientos_clientes` join `pance_sedes_clientes`) join `pance_sucursales`) join `pance_municipios`) where ((`pance_requerimientos_clientes`.`id_sede` = `pance_sedes_clientes`.`id`) and (`pance_requerimientos_clientes`.`id_sucursal` = `pance_sucursales`.`id`) and (`pance_sedes_clientes`.`id_municipios` = `pance_municipios`.`id`)) order by `pance_requerimientos_clientes`.`fecha_ingreso` desc */;

--
-- Final view structure for view `pance_menu_secciones`
--

/*!50001 DROP TABLE `pance_menu_secciones`*/;
/*!50001 DROP VIEW IF EXISTS `pance_menu_secciones`*/;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`cimco`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `pance_menu_secciones` AS select `pance_secciones`.`id` AS `id`,`pance_secciones`.`codigo` AS `CODIGO`,`pance_secciones`.`nombre` AS `NOMBRE`,`pance_secciones`.`descripcion` AS `DESCRIPCION`,`pance_bodegas`.`nombre` AS `BODEGA` from (`pance_secciones` join `pance_bodegas`) where (`pance_secciones`.`id_bodega` = `pance_bodegas`.`id`) */;

--
-- Final view structure for view `pance_menu_sedes_clientes`
--

/*!50001 DROP TABLE `pance_menu_sedes_clientes`*/;
/*!50001 DROP VIEW IF EXISTS `pance_menu_sedes_clientes`*/;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `pance_menu_sedes_clientes` AS select `pance_sedes_clientes`.`id` AS `id`,concat(if((`pance_terceros`.`primer_nombre` is not null),`pance_terceros`.`primer_nombre`,_latin1''),_latin1' ',if((`pance_terceros`.`segundo_nombre` is not null),`pance_terceros`.`segundo_nombre`,_latin1''),_latin1' ',if((`pance_terceros`.`primer_apellido` is not null),`pance_terceros`.`primer_apellido`,_latin1''),_latin1' ',if((`pance_terceros`.`segundo_apellido` is not null),`pance_terceros`.`segundo_apellido`,_latin1''),_latin1' ',if((`pance_terceros`.`razon_social` is not null),`pance_terceros`.`razon_social`,_latin1'')) AS `CLIENTE`,`pance_sucursales`.`nombre` AS `CONSORCIADO`,`pance_sedes_clientes`.`nombre_sede` AS `SEDE`,`pance_sedes_clientes`.`nombre_contacto` AS `CONTACTO`,`pance_sedes_clientes`.`correo` AS `CORREO_ELECTRONICO` from ((`pance_sedes_clientes` join `pance_terceros`) join `pance_sucursales`) where ((`pance_sedes_clientes`.`id_cliente` = `pance_terceros`.`id`) and (`pance_sedes_clientes`.`id_sucursal` = `pance_sucursales`.`id`)) */;

--
-- Final view structure for view `pance_menu_servidores`
--

/*!50001 DROP TABLE `pance_menu_servidores`*/;
/*!50001 DROP VIEW IF EXISTS `pance_menu_servidores`*/;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`cimco`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `pance_menu_servidores` AS select `pance_servidores`.`id` AS `id`,`pance_servidores`.`ip` AS `IP`,`pance_servidores`.`nombre_netbios` AS `NOMBRE_NETBIOS`,`pance_servidores`.`nombre_tcpip` AS `NOMBRE_TCPIP` from `pance_servidores` */;

--
-- Final view structure for view `pance_menu_sucursales`
--

/*!50001 DROP TABLE `pance_menu_sucursales`*/;
/*!50001 DROP VIEW IF EXISTS `pance_menu_sucursales`*/;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`cimco`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `pance_menu_sucursales` AS select `pance_sucursales`.`id` AS `id`,`pance_sucursales`.`codigo` AS `CODIGO`,`pance_sucursales`.`nombre` AS `NOMBRE`,`pance_empresas`.`razon_social` AS `EMPRESA`,`pance_terceros`.`documento_identidad` AS `TERCERO` from ((`pance_sucursales` join `pance_empresas`) join `pance_terceros`) where ((`pance_sucursales`.`id_empresa` = `pance_empresas`.`id`) and (`pance_empresas`.`id_tercero` = `pance_terceros`.`id`)) */;

--
-- Final view structure for view `pance_menu_terceros`
--

/*!50001 DROP TABLE `pance_menu_terceros`*/;
/*!50001 DROP VIEW IF EXISTS `pance_menu_terceros`*/;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `pance_menu_terceros` AS select `pance_terceros`.`id` AS `id`,`pance_terceros`.`documento_identidad` AS `DOCUMENTO_IDENTIDAD`,`pance_terceros`.`primer_nombre` AS `PRIMER_NOMBRE`,`pance_terceros`.`segundo_nombre` AS `SEGUNDO_NOMBRE`,`pance_terceros`.`primer_apellido` AS `PRIMER_APELLIDO`,`pance_terceros`.`segundo_apellido` AS `SEGUNDO_APELLIDO`,concat(`pance_terceros`.`documento_identidad`,_latin1' ',if((`pance_terceros`.`primer_nombre` = _latin1' '),concat(`pance_terceros`.`segundo_nombre`,_latin1' ',`pance_terceros`.`segundo_nombre`,_latin1' ',`pance_terceros`.`primer_apellido`,_latin1' ',`pance_terceros`.`segundo_apellido`),`pance_terceros`.`razon_social`)) AS `NOMBRE_COMPLETO` from `pance_terceros` */;

--
-- Final view structure for view `pance_menu_terminales`
--

/*!50001 DROP TABLE `pance_menu_terminales`*/;
/*!50001 DROP VIEW IF EXISTS `pance_menu_terminales`*/;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`cimco`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `pance_menu_terminales` AS select `pance_terminales`.`id` AS `id`,`pance_terminales`.`ip` AS `IP`,`pance_terminales`.`nombre_netbios` AS `NOMBRE_NETBIOS`,`pance_terminales`.`nombre_tcpip` AS `NOMBRE_TCPIP` from `pance_terminales` */;

--
-- Final view structure for view `pance_menu_tipos_bodegas`
--

/*!50001 DROP TABLE `pance_menu_tipos_bodegas`*/;
/*!50001 DROP VIEW IF EXISTS `pance_menu_tipos_bodegas`*/;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`cimco`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `pance_menu_tipos_bodegas` AS select `pance_tipos_bodegas`.`id` AS `id`,`pance_tipos_bodegas`.`nombre` AS `NOMBRE`,`pance_tipos_bodegas`.`descripcion` AS `DESCRIPCION` from `pance_tipos_bodegas` */;

--
-- Final view structure for view `pance_menu_tipos_documento_identidad`
--

/*!50001 DROP TABLE `pance_menu_tipos_documento_identidad`*/;
/*!50001 DROP VIEW IF EXISTS `pance_menu_tipos_documento_identidad`*/;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`cimco`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `pance_menu_tipos_documento_identidad` AS select `pance_tipos_documento_identidad`.`id` AS `id`,`pance_tipos_documento_identidad`.`codigo_DIAN` AS `CODIGO_DIAN`,`pance_tipos_documento_identidad`.`codigo_interno` AS `CODIGO_INTERNO`,`pance_tipos_documento_identidad`.`descripcion` AS `DESCRIPCION` from `pance_tipos_documento_identidad` */;

--
-- Final view structure for view `pance_menu_usuarios`
--

/*!50001 DROP TABLE `pance_menu_usuarios`*/;
/*!50001 DROP VIEW IF EXISTS `pance_menu_usuarios`*/;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`cimco`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `pance_menu_usuarios` AS select `pance_usuarios`.`id` AS `id`,`pance_usuarios`.`usuario` AS `USUARIO`,`pance_usuarios`.`nombre` AS `NOMBRE` from `pance_usuarios` */;

--
-- Final view structure for view `pance_seleccion_clientes`
--

/*!50001 DROP TABLE `pance_seleccion_clientes`*/;
/*!50001 DROP VIEW IF EXISTS `pance_seleccion_clientes`*/;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `pance_seleccion_clientes` AS select `pance_terceros`.`id` AS `id`,concat(`pance_terceros`.`documento_identidad`,_latin1'-',if((`pance_terceros`.`primer_nombre` is not null),`pance_terceros`.`primer_nombre`,_latin1''),_latin1' ',if((`pance_terceros`.`segundo_nombre` is not null),`pance_terceros`.`segundo_nombre`,_latin1''),_latin1' ',if((`pance_terceros`.`primer_apellido` is not null),`pance_terceros`.`primer_apellido`,_latin1''),_latin1' ',if((`pance_terceros`.`segundo_apellido` is not null),`pance_terceros`.`segundo_apellido`,_latin1''),_latin1' ',if((`pance_terceros`.`razon_social` is not null),`pance_terceros`.`razon_social`,_latin1''),_latin1'|',`pance_terceros`.`id`) AS `nombre` from `pance_terceros` where (`pance_terceros`.`cliente` = _latin1'1') order by `pance_terceros`.`primer_nombre` */;

--
-- Final view structure for view `pance_seleccion_empresas`
--

/*!50001 DROP TABLE `pance_seleccion_empresas`*/;
/*!50001 DROP VIEW IF EXISTS `pance_seleccion_empresas`*/;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`cimco`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `pance_seleccion_empresas` AS select `pance_empresas`.`id` AS `id`,concat(`pance_empresas`.`razon_social`,_latin1'|',`pance_empresas`.`id`) AS `nombre` from `pance_empresas` order by `pance_empresas`.`razon_social` */;

--
-- Final view structure for view `pance_seleccion_localidades`
--

/*!50001 DROP TABLE `pance_seleccion_localidades`*/;
/*!50001 DROP VIEW IF EXISTS `pance_seleccion_localidades`*/;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`cimco`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `pance_seleccion_localidades` AS select `pance_localidades`.`id` AS `id`,concat(`pance_localidades`.`nombre`,_latin1', ',`pance_municipios`.`nombre`,_latin1', ',`pance_departamentos`.`nombre`,_latin1', ',`pance_paises`.`nombre`,_latin1'|',`pance_localidades`.`id`) AS `nombre` from (((`pance_localidades` join `pance_municipios`) join `pance_departamentos`) join `pance_paises`) where ((`pance_localidades`.`id_municipio` = `pance_municipios`.`id`) and (`pance_municipios`.`id_departamento` = `pance_departamentos`.`id`) and (`pance_departamentos`.`id_pais` = `pance_paises`.`id`)) order by `pance_municipios`.`nombre` */;

--
-- Final view structure for view `pance_seleccion_municipios`
--

/*!50001 DROP TABLE `pance_seleccion_municipios`*/;
/*!50001 DROP VIEW IF EXISTS `pance_seleccion_municipios`*/;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`cimco`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `pance_seleccion_municipios` AS select `pance_municipios`.`id` AS `id`,concat(`pance_municipios`.`nombre`,_latin1', ',`pance_departamentos`.`nombre`,_latin1', ',`pance_paises`.`nombre`,_latin1'|',`pance_municipios`.`id`) AS `nombre` from ((`pance_municipios` join `pance_departamentos`) join `pance_paises`) where ((`pance_municipios`.`id_departamento` = `pance_departamentos`.`id`) and (`pance_departamentos`.`id_pais` = `pance_paises`.`id`)) order by `pance_municipios`.`nombre` */;

--
-- Final view structure for view `pance_seleccion_registro_ingresos`
--

/*!50001 DROP TABLE `pance_seleccion_registro_ingresos`*/;
/*!50001 DROP VIEW IF EXISTS `pance_seleccion_registro_ingresos`*/;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `pance_seleccion_registro_ingresos` AS select `pance_requerimientos_clientes`.`id` AS `id`,`pance_cotizaciones`.`numero_cotizacion` AS `NUMERO_COTIZACION`,`pance_requerimientos_clientes`.`descripcion` AS `DESCRIPCION`,`pance_registro_ingresos`.`fecha_concepto` AS `FECHA_CONCEPTO`,if((`pance_registro_ingresos`.`concepto` = _latin1'1'),_latin1'Ingreso',_latin1'Egreso') AS `CONCEPTO`,`pance_registro_ingresos`.`valor_concepto` AS `VALOR_CONCEPTO` from ((`pance_requerimientos_clientes` join `pance_registro_ingresos`) join `pance_cotizaciones`) where (`pance_registro_ingresos`.`id_requerimiento` = `pance_requerimientos_clientes`.`id`) */;

--
-- Final view structure for view `pance_seleccion_registro_obras`
--

/*!50001 DROP TABLE `pance_seleccion_registro_obras`*/;
/*!50001 DROP VIEW IF EXISTS `pance_seleccion_registro_obras`*/;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `pance_seleccion_registro_obras` AS select `pance_registro_obras`.`id` AS `id`,`pance_registro_obras`.`id_cotizacion` AS `id_cotizacion`,`pance_cotizaciones`.`numero_cotizacion` AS `NUMEROCOTIZACION`,(case `pance_registro_obras`.`tipo_acta` when _utf8'1' then _utf8'Inicio' when _utf8'2' then _utf8'Avance obra' when _utf8'3' then _utf8'Finalizaci?n' end) AS `TIPOACTA`,`pance_registro_obras`.`fecha_entrega_acta` AS `FECHAENTREGA`,`pance_registro_obras`.`valor_facturar` AS `VALORFACTURAR`,if((`pance_registro_obras`.`factura_consorciado` = _latin1'0'),_utf8'No enviada',_utf8'Enviada') AS `FACTURACONSORCIADO`,if((`pance_registro_obras`.`pago_cliente` = _latin1'0'),_utf8'Pendiente',_utf8'Pagada') AS `PAGOCLIENTE`,if((`pance_registro_obras`.`pago_consorciado` = _latin1'0'),_utf8'Pendiente',_utf8'Pagada') AS `PAGOCONSORCIADO`,`pance_registro_obras`.`porcentaje_mano_obra` AS `PORCENTAJEMANOOBRA`,`pance_registro_obras`.`porcentaje_materiales` AS `PORCENTAJEMATERIALES` from ((`pance_registro_obras` join `pance_cotizaciones`) join `pance_requerimientos_clientes`) where ((`pance_registro_obras`.`id_cotizacion` = `pance_cotizaciones`.`id`) and (`pance_registro_obras`.`id_requerimiento` = `pance_requerimientos_clientes`.`id`)) */;

--
-- Final view structure for view `pance_seleccion_requerimientos_clientes`
--

/*!50001 DROP TABLE `pance_seleccion_requerimientos_clientes`*/;
/*!50001 DROP VIEW IF EXISTS `pance_seleccion_requerimientos_clientes`*/;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `pance_seleccion_requerimientos_clientes` AS select `pance_requerimientos_clientes`.`id` AS `id`,`pance_sedes_clientes`.`nombre_sede` AS `nombre_sede`,`pance_sucursales`.`nombre` AS `sucursal`,(case `pance_requerimientos_clientes`.`tipo_solicitud` when _latin1'M' then _latin1'Mantenimiento' when _latin1'E' then _latin1'Emergencia' when _latin1'S' then _latin1'Servicio por demanda' when _latin1'P' then _latin1'Proyecto' when _latin1'V' then _latin1'Visita' end) AS `tipo_solicitud` from ((`pance_requerimientos_clientes` join `pance_sedes_clientes`) join `pance_sucursales`) where ((`pance_requerimientos_clientes`.`id_sede` = `pance_sedes_clientes`.`id`) and (`pance_requerimientos_clientes`.`id_sucursal` = `pance_sucursales`.`id`)) */;

--
-- Final view structure for view `pance_seleccion_sedes_clientes`
--

/*!50001 DROP TABLE `pance_seleccion_sedes_clientes`*/;
/*!50001 DROP VIEW IF EXISTS `pance_seleccion_sedes_clientes`*/;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `pance_seleccion_sedes_clientes` AS select `pance_sedes_clientes`.`id` AS `id`,`pance_sedes_clientes`.`nombre_sede` AS `nombre_sede`,concat(if((`pance_terceros`.`primer_nombre` is not null),`pance_terceros`.`primer_nombre`,_latin1''),_latin1' ',if((`pance_terceros`.`segundo_nombre` is not null),`pance_terceros`.`segundo_nombre`,_latin1''),_latin1' ',if((`pance_terceros`.`primer_apellido` is not null),`pance_terceros`.`primer_apellido`,_latin1''),_latin1' ',if((`pance_terceros`.`segundo_apellido` is not null),`pance_terceros`.`segundo_apellido`,_latin1''),_latin1' ',if((`pance_terceros`.`razon_social` is not null),`pance_terceros`.`razon_social`,_latin1''),_latin1'|',`pance_sedes_clientes`.`id`) AS `id_cliente` from (`pance_sedes_clientes` join `pance_terceros`) where (`pance_terceros`.`id` = `pance_sedes_clientes`.`id_cliente`) */;

--
-- Final view structure for view `pance_seleccion_sucursales`
--

/*!50001 DROP TABLE `pance_seleccion_sucursales`*/;
/*!50001 DROP VIEW IF EXISTS `pance_seleccion_sucursales`*/;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`cimco`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `pance_seleccion_sucursales` AS select `pance_sucursales`.`id` AS `id`,concat(`pance_sucursales`.`nombre`,_latin1'|',`pance_sucursales`.`id`) AS `nombre` from `pance_sucursales` order by `pance_sucursales`.`nombre` */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2009-08-06 18:39:20
