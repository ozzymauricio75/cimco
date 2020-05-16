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

/*** Definición de datos propios de la aplicación ***/
$pance["nombreCliente"] = "GLOBAL SERVICE WORLD S.A.S";
$pance["nitCliente"]    = "NIT 900.502.473-1";
$pance["nombre"]        = "PANCE";
$pance["descripcion"]   = "Plataforma para la administración del nexo cliente-empresa";
$pance["version"]       = "0.0.1";
//$pance["url"]           = "http://cimco.redirectme.net";
//$pance["url"]           = "http://192.168.0.150";
//$pance["url"]           = "http://cimco.felinux.lan";
$pance["url"]           = "http://localhost/cimco/publico";
$pance["creador"]       = "Raul Mauricio Oidor Lozano";
$pance["urlCreador"]    = "http://www.rmoidor.com";
$pance["correoCreador"] = "ozzymauricio75@gmail.com";

/* Definición de datos para el acceso a la base datos */
$accesoBaseDatos["servidor"]         = "localhost";
$accesoBaseDatos["nombre"]           = "cimco";
$accesoBaseDatos["usuario"]          = "cimco";
$accesoBaseDatos["contrasena"]       = "cimco";
$accesoBaseDatos["prefijoTabla"]     = "pance";
$accesoBaseDatos["filasPorConsulta"] = 20;

/*** Definición de otros datos globales ***/
$datosGlobales["usuarioMaestro"]         = "admin";
$datosGlobales["componenteInicioSesion"] = "MENUINSE";
$datosGlobales["componentePaginaInicio"] = "MENUPRIN";
$datosGlobales["variableComponente"]     = "componente";
$datosGlobales["idioma"]                 = "es";

/*** Definición de rutas de los principales directorios ***/
$rutasGlobales["modulos"]     = "../modulos";
$rutasGlobales["extensiones"] = $rutasGlobales["modulos"] ."/extensiones";
$rutasGlobales["idiomas"]     = "../idiomas";
$rutasGlobales["clases"]      = "../clases";
$rutasGlobales["plantillas"]  = "../plantillas";
$rutasGlobales["temporal"]    = "../temporal";
$rutasGlobales["javascript"]  = "javascript";
$rutasGlobales["imagenes"]    = "imagenes";
$rutasGlobales["estilos"]     = "css";
$rutasGlobales["archivos"]    = "archivos";

/*** Definición de directorios por módulo ó componente ***/
$rutasComponente["idiomas"]    = "idiomas";
$rutasComponente["clases"]     = "clases";
$rutasComponente["javascript"] = "javascript";
$rutasComponente["sql"]        = "sql";

/*** Archivos de JavaScript ***/
$rutasJavaScript["global"]        = $rutasGlobales["javascript"]."/global.js";
$rutasJavaScript["principal"]     = $rutasGlobales["javascript"]."/jquery.js";
$rutasJavaScript["interfaz"]      = $rutasGlobales["javascript"]."/jquery.ui.js";
$rutasJavaScript["tablas"]        = $rutasGlobales["javascript"]."/jquery.tablesorter.js";
$rutasJavaScript["marcafila"]     = $rutasGlobales["javascript"]."/jquery.tablehover.js";
$rutasJavaScript["formularios"]   = $rutasGlobales["javascript"]."/jquery.form.js";
$rutasJavaScript["menu"]          = $rutasGlobales["javascript"]."/jquery.menu.js";
$rutasJavaScript["tips"]          = $rutasGlobales["javascript"]."/jquery.tooltip.js";
$rutasJavaScript["bloqueador"]    = $rutasGlobales["javascript"]."/jquery.blockui.js";
$rutasJavaScript["completar"]     = $rutasGlobales["javascript"]."/jquery.autocomplete.js";
$rutasJavaScript["dimension"]     = $rutasGlobales["javascript"]."/jquery.dimensions.js";
$rutasJavaScript["arbolSimple"]   = $rutasGlobales["javascript"]."/jquery.treeview.js";
$rutasJavaScript["arbolMultiple"] = $rutasGlobales["javascript"]."/jquery.checkboxtree.js";
$rutasJavaScript["media"]         = $rutasGlobales["javascript"]."/jquery.media.js";
$rutasJavaScript["metadata"]      = $rutasGlobales["javascript"]."/jquery.metadata.js";
$rutasJavaScript["hotkeys"]       = $rutasGlobales["javascript"]."/jquery.hotkeys.js";
$rutasJavaScript["png"]           = $rutasGlobales["javascript"]."/jquery.fixpng.js";
$rutasJavaScript["idiomaFecha"]   = $rutasGlobales["javascript"]."/i18n/ui.datepicker-".$datosGlobales["idioma"].".js";
$rutasJavaScript["numero"]        = $rutasGlobales["javascript"]."/jquery.price_format.1.3.js";


/*** Definición de archivos globales ***/
$archivosGlobales["cssGeneral"]   = $rutasGlobales["estilos"]."/celeste/global.css";
$archivosGlobales["cssExplorer6"] = $rutasGlobales["estilos"]."/celeste/explorer6.css";
$archivosGlobales["cssExplorer7"] = $rutasGlobales["estilos"]."/celeste/explorer7.css";
$archivosGlobales["esquemaSQL"]   = $rutasComponente["sql"]."/esquema.php";

/*** Definición de rutas de imagenes ****/
$imagenesGlobales["logoAplicacion"]      = $rutasGlobales["imagenes"]."/logo-aplicacion.png";
$imagenesGlobales["logoCliente"]         = $rutasGlobales["imagenes"]."/logo-cliente.gif";
$imagenesGlobales["logoClienteReportes"] = $rutasGlobales["imagenes"]."/logo-cliente-reportes.jpg";
$imagenesGlobales["inicioSesion"]        = $rutasGlobales["imagenes"]."/llaves.png";
$imagenesGlobales["cargando"]            = $rutasGlobales["imagenes"]."/cargando.png";
$imagenesGlobales["buscar"]              = $rutasGlobales["imagenes"]."/buscar.png";
$imagenesGlobales["restaurar"]           = $rutasGlobales["imagenes"]."/restaurar.png";
$imagenesGlobales["cotizar"]             = $rutasGlobales["imagenes"]."/cotizar.png";
$imagenesGlobales["aprobar"]             = $rutasGlobales["imagenes"]."/aceptar.png";
$imagenesGlobales["reemplazar"]          = $rutasGlobales["imagenes"]."/reemplazar.png";
$imagenesGlobales["recotizar"]           = $rutasGlobales["imagenes"]."/cotizar.png";
$imagenesGlobales["ejecutar"]            = $rutasGlobales["imagenes"]."/ejecutar.png";
$imagenesGlobales["visitar"]             = $rutasGlobales["imagenes"]."/visitar.png";
$imagenesGlobales["adicionar"]           = $rutasGlobales["imagenes"]."/adicionar.png";
$imagenesGlobales["consultar"]           = $rutasGlobales["imagenes"]."/consultar.png";
$imagenesGlobales["modificar"]           = $rutasGlobales["imagenes"]."/modificar.png";
$imagenesGlobales["eliminar"]            = $rutasGlobales["imagenes"]."/eliminar.png";
$imagenesGlobales["anular"]              = $rutasGlobales["imagenes"]."/anular.png";
$imagenesGlobales["enviar"]              = $rutasGlobales["imagenes"]."/enviar.png";
$imagenesGlobales["guardar"]             = $rutasGlobales["imagenes"]."/guardar.png";
$imagenesGlobales["aceptar"]             = $rutasGlobales["imagenes"]."/aceptar.png";
$imagenesGlobales["cancelar"]            = $rutasGlobales["imagenes"]."/cancelar.png";
$imagenesGlobales["regresar"]            = $rutasGlobales["imagenes"]."/regresar.png";
$imagenesGlobales["exportar"]            = $rutasGlobales["imagenes"]."/exportar.png";
$imagenesGlobales["reporte"]             = $rutasGlobales["imagenes"]."/exportar.png";
$imagenesGlobales["anterior"]            = $rutasGlobales["imagenes"]."/anterior.png";
$imagenesGlobales["ultima"]              = $rutasGlobales["imagenes"]."/ultima.png";
$imagenesGlobales["siguiente"]           = $rutasGlobales["imagenes"]."/siguiente.png";
$imagenesGlobales["primera"]             = $rutasGlobales["imagenes"]."/primera.png";
$imagenesGlobales["requerido"]           = $rutasGlobales["imagenes"]."/requerido.png";

/*** Rutas ***/
$plantillaGlobal["ruta"]         = $rutasGlobales["plantillas"]."/original.htm";
$plantillaGlobal["codificacion"] = "ISO8859-1";

/*** Definición de parámetros propios del lenguaje y/o del servidor web ***/
ini_set("display_errors", "1");
ini_set("default_charset", $plantillaGlobal["codificacion"]);
ini_set("session.auto_start", "0");
ini_set("session.name", "ISP");
ini_set("session.save_path", $rutasGlobales["temporal"]."/sesiones");
ini_set("session.use_trans_sid", "0");
ini_set("session.gc_maxlifetime", "86400");

?>
