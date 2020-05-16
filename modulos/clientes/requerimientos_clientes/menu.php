<?php

/**
*
* Copyright (C) 2009 FELINUX Ltda
* Francisco J. Lozano B. <fjlozano@felinux.com.co>
* Mauricio Oidor L. <ozzymauricio75@gmail.com>
*
* Este archivo es parte de:
* PANCE :: Plataforma para la Administraci�n del Nexo Cliente-Empresa
*
* Este programa es software libre: usted puede redistribuirlo y/o
* modificarlo  bajo los t�rminos de la Licencia P�blica General GNU
* publicada por la Fundaci�n para el Software Libre, ya sea la versi�n 3
* de la Licencia, o (a su elecci�n) cualquier versi�n posterior.
*
* Este programa se distribuye con la esperanza de que sea �til, pero
* SIN GARANT�A ALGUNA; ni siquiera la garant�a impl�cita MERCANTIL o
* de APTITUD PARA UN PROP�SITO DETERMINADO. Consulte los detalles de
* la Licencia P�blica General GNU para obtener una informaci�n m�s
* detallada.
*
* Deber�a haber recibido una copia de la Licencia P�blica General GNU
* junto a este programa. En caso contrario, consulte:
* <http://www.gnu.org/licenses/>.
*
**/

$idSucursales = array();

/*** Obtener lista de sucursales a las cuales tiene acceso el usuario actual ***/
$tablas     = array(
    "a" => "perfiles_usuario",
    "b" => "componentes_usuario",
    "c" => "sucursales"
);

$columnas = array(
    "id"     => "a.id_sucursal",
    "nombre" => "c.nombre"
);

$condicion = "c.id = a.id_sucursal AND a.id = b.id_perfil
              AND a.id_usuario = '$sesion_id_usuario' AND b.id_componente = '".$componente->id."'";

$consulta  = SQL::seleccionar($tablas, $columnas, $condicion);
if (SQL::filasDevueltas($consulta)) {
    $sucursales = array();
    while ($datos = SQL::filaEnObjeto($consulta)) {
        $sucursales[]    = $datos->id;
	    $idSucursales[]  = $datos->id;
    }
    $sucursales = "id_sucursal IN (".implode(",", $sucursales).")";
} else {
    $sucursales = "id_sucursal IS NULL";
}

$agrupamiento = '';
$ordenamiento = '';

/*** Nombre de la vista a partir de la cual se genera la tabla ***/
$vistaMenu     = "menu_requerimientos_clientes";
$vistaBuscador = "buscador_requerimientos_clientes";
$alineacion    = array("C","C","I","I","I","I","I","I","C","I");

/*** Devolver datos para autocompletar la busqueda ***/
if (isset($url_completar)) {
    echo SQL::datosAutoCompletar($vistaBuscador, $url_q);
    exit;
}

/*** Generar botones de comandos ***/
$botones  = HTML::boton("ADICRECL",$textos["ADICIONAR"],"ejecutarComando(this, 620, 570);","adicionar");
$botones .= HTML::boton("CONSRECL",$textos["CONSULTAR"],"ejecutarComando(this, 1000, 500);","consultar");
$botones .= HTML::boton("MODIRECL",$textos["MODIFICAR"],"ejecutarComando(this, 620, 650);","modificar");
$botones .= HTML::boton("ELIMRECL",$textos["ELIMINAR"],"ejecutarComando(this, 450, 500);","eliminar");
$botones .= HTML::boton("NOTIRECL",$textos["NOTIFICAR"],"ejecutarComando(this, 450, 500);","aceptar");
$botones .= HTML::boton("REPORECL",$textos["REPORTE"],"ejecutarComando(this, 600, 500);","reporte");

/*** Obtener el n�mero de la p�gina actual ***/
if (empty($url_pagina)) {
    $paginaActual = 1;
} else {
    $paginaActual = intval($url_pagina);
}


$consulta_sucursales="";
foreach($idSucursales AS $id_sucursal){
    $texto = SQL::obtenerValor("sucursales","nombre",$id_sucursal);
    $consulta_sucursales.="SUCURSAL LIKE '$texto' OR ";
}
$consulta_sucursales = rtrim($consulta_sucursales," OR ");
//echo var_dump($idSucursales);exit();
/*** Datos por defecto para realizar la consulta ***/
$condicion      = SQL::evaluarBusqueda($vistaBuscador, $vistaMenu);
$agrupamiento   = "";
$ordenamiento   = SQL::ordenColumnas("FECHA_INGRESO DESC");
$numeroFilas    = SQL::$filasPorConsulta;
$columnas       = SQL::obtenerColumnas($vistaMenu);
$totalRegistros = SQL::filasDevueltas(SQL::seleccionar(array($vistaMenu), $columnas, $condicion." AND ".$sucursales, $agrupamiento, $ordenamiento));
$paginador      = HTML::insertarPaginador($totalRegistros, $paginaActual, $numeroFilas);
$registros      = HTML::imprimirRegistros($totalRegistros, $paginaActual, $numeroFilas);

/*** Ejecutar la consulta y generar tabla a partir de los resultados ***/
$consulta     = SQL::seleccionar(array($vistaMenu), $columnas, $condicion." AND ".$sucursales, $agrupamiento, $ordenamiento, $paginaActual, $numeroFilas);
$tabla        = HTML::generarTabla($columnas, $consulta, $alineacion);

/*** Generar y enviar plantilla completa si la petici�n no se realiza v�a AJAX ***/
if (empty($url_origen) || ($url_origen != "ajax")) {
    Plantilla::iniciar();
    Plantilla::sustituir("menu", $sesion_menu);
    Plantilla::sustituir("buscador", HTML::insertarBuscador());
    Plantilla::sustituir("botones", $botones);
    Plantilla::sustituir("paginador", $paginador);
    Plantilla::sustituir("registros", $registros);
    Plantilla::sustituir("mensaje");
    Plantilla::sustituir("bloqueDerecho");
    Plantilla::sustituir("bloqueIzquierdo", $tabla);
    Plantilla::sustituir("cuadroDialogo");
    Plantilla::enviarCodigo();
} else {
    /*** Devolver s�lo datos en formato JSON para las consultas v�a AJAX ***/
    $datos[0] = $tabla;
    $datos[1] = $paginador;
    $datos[2] = $registros;
    $datos[3] = $botones;
    HTTP::enviarJSON($datos);
}
?>
