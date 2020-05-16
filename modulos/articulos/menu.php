<?php

/**
*
* Copyright (C) 2020 Raul Mauricio Oidor Lozano
* Raul Mauricio Oidor Lozano <ozzymauricio75@gmail.com>
*
* Este archivo es parte de:
* SEM :: Software empresarial a la medida
*
* Este programa es software libre: usted puede redistribuirlo y/o
* modificarlo  bajo los términos de la Licencia Pública General GNU
* publicada por la Fundación para el Software Libre, ya sea la versión 3
* de la Licencia, o (a su elección) cualquier versión posterior.
*
* Este programa se distribuye con la esperanza de que sea útil, pero
* SIN GARANTÍA ALGUNA; ni siquiera la garantía implícita MERCANTIL o
* de APTITUD PARA UN PROPÓITO DETERMINADO. Consulte los detalles de
* la Licencia Pública General GNU para obtener una información más
* detallada.
*
* Debería haber recibido una copia de la Licencia Pública General GNU
* junto a este programa. En caso contrario, consulte:
* <http://www.gnu.org/licenses/>.
*
**/
/*
$consulta_pedido = SQL::seleccionar(array("movimiento_propuesta_pedidos"),array("id_articulo","referencia"),"id_articulo>0","id_articulo,referencia");
if (SQL::filasDevueltas($consulta_pedido)){

    while ($datos_pedido = SQL::filaEnObjeto($consulta_pedido)){

        $columnas = array(
            "id",
            "id_tercero",
            "referencia",
            "id_marca",
            "id_estructura_grupo",
            "codigo",
            "ruta_foto_principal",
            "nombre_archivo_foto_principal"
        );
        //$consulta_articulos = SQL::seleccionar(array("articulos"),$columnas,"id>0 AND ruta_foto_principal!='' AND nombre_archivo_foto_principal!=''"    );
        $consulta_articulos = SQL::seleccionar(array("articulos"),$columnas,"id='$datos_pedido->id_articulo' AND ruta_foto_principal!='' AND nombre_archivo_foto_principal!=''");
        if (SQL::filasDevueltas($consulta_articulos)){
            //while ($datos_articulos = SQL::filaEnObjeto($consulta_articulos)){

                $datos_articulos = SQL::filaEnObjeto($consulta_articulos);
                $ruta_foto = trim($datos_articulos->ruta_foto_principal);
                $nombre_foto = trim($datos_articulos->nombre_archivo_foto_principal);
                $extension = explode(".",$nombre_foto);
                $extension = $extension[1];
                if ($ruta_foto!="" && $nombre_foto!="" && $datos_articulos->referencia != $datos_pedido->referencia){
                    $nombreArchivo = $ruta_foto."/".$nombre_foto;
                    if (file_exists($nombreArchivo)){
                        if (($archivo = fopen($nombreArchivo, "r")) !== FALSE){

                            if (!isset($grupo1[$datos_articulos->id_estructura_grupo])){
                                $categoria[$datos_articulos->id_estructura_grupo] = SQL::obtenerValor("estructura_grupos","id_categoria","id='$datos_articulos->id_estructura_grupo'");
                                $grupo1[$datos_articulos->id_estructura_grupo] = SQL::obtenerValor("estructura_grupos","id_grupo1","id='$datos_articulos->id_estructura_grupo'");
                                $grupo2[$datos_articulos->id_estructura_grupo] = SQL::obtenerValor("estructura_grupos","id_grupo2","id='$datos_articulos->id_estructura_grupo'");
                            }
                            //$referencia = str_replace("/"," ",$datos_articulos->referencia);
                            $referencia = str_replace("/"," ",$datos_pedido->referencia);
                            $referencia = str_replace(".","-",$referencia);
                            $referencia = trim($datos_articulos->codigo)."_".trim($referencia);
                            $nombreArchivoReferencia  = $ruta_foto."/".$referencia.".".$extension;
                            copy($nombreArchivo, $nombreArchivoReferencia);
                            $datos_reemplazar = array(
                                "id_articulo"         => $datos_articulos->id,
                                "id_tercero"          => $datos_articulos->id_tercero,
                                "referencia"          => $datos_pedido->referencia,
                                "id_categoria"        => $categoria[$datos_articulos->id_estructura_grupo],
                                "id_grupo1"           => $grupo1[$datos_articulos->id_estructura_grupo],
                                "id_grupo2"           => $grupo2[$datos_articulos->id_estructura_grupo],
                                "id_marca"            => $datos_articulos->id_marca,
                                "ruta_foto"           => $ruta_foto,
                                "nombre_archivo"      => $referencia.".".$extension,
                                "id_usuario_registra" => $sesion_id_usuario_ingreso,
                                "fecha_registra"      => date("Y-m-d H:i:s")
                            );
                            $condicion_reemplazar = "id_articulo='$datos_articulos->id' AND id_tercero='$datos_articulos->id_tercero' AND ";
                            $condicion_reemplazar .= "referencia='$datos_pedido->referencia' AND ";
                            $condicion_reemplazar .= "id_categoria='".$categoria[$datos_articulos->id_estructura_grupo]."' AND ";
                            $condicion_reemplazar .= "id_grupo1='".$grupo1[$datos_articulos->id_estructura_grupo]."' AND ";
                            $condicion_reemplazar .= "id_grupo2='".$grupo2[$datos_articulos->id_estructura_grupo]."' AND ";
                            $condicion_reemplazar .= "id_marca='$datos_articulos->id_marca'";
                            $id_referencia = SQL::obtenerValor("referencias_articulos","id",$condicion_reemplazar." LIMIT 0,1");
                            if ($id_referencia){
                                $modificar = SQL::modificar("referencias_articulos",$datos_reemplazar,$condicion_reemplazar, false, false);
                            } else {
                                $modificar = SQL::insertar("referencias_articulos",$datos_reemplazar,false, false, false);
                            }
                            //$datos_modificar = array(
                            //    "nombre_archivo_foto_principal" => $referencia.".".$extension
                            //);
                            //$modificar = SQL::modificar("articulos",$datos_modificar,"id='$datos_articulos->id'", false, false);
                        }
                    }
                }
            //}
        }
    }
}*/


/*** Nombre de la vista a partir de la cual se genera la tabla ***/
$vistaMenu     = "menu_articulos";
$vistaBuscador = "buscador_articulos";
$alineacion    = array("I","I","I");

/*** Devolver datos para autocompletar la búsqueda ***/
if (isset($url_completar)) {
    echo SQL::datosAutoCompletar($vistaBuscador, $url_q);
    exit;
}

/*** Generar botones de comandos ***/
//$botones  = HTML::boton("ADICARTI",$textos["ADICIONAR"],"ejecutarComando(this,700,600);","adicionar");
$botones = HTML::boton("CONSARTI",$textos["CONSULTAR"],"ejecutarComando(this,700,600);","consultar");
$botones .= HTML::boton("MODIARTI",$textos["MODIFICAR"],"ejecutarComando(this,700,600);","modificar");
//$botones .= HTML::boton("ELIMARTI",$textos["ELIMINAR"],"ejecutarComando(this,700,600);","eliminar");
$botones .= HTML::boton("LISTARTI",$textos["EXPORTAR"],"ejecutarComando(this,700,600);","imprimir");

/*** Obtener el número de la página actual ***/
if (empty($url_pagina)) {
    $paginaActual = 1;
} else {
    $paginaActual = intval($url_pagina);
}

/*** Datos por defecto para realizar la consulta ***/
$condicion      = SQL::evaluarBusqueda($vistaBuscador, $vistaMenu);
$agrupamiento   = "";
$ordenamiento   = SQL::ordenColumnas();
$numeroFilas    = SQL::$filasPorConsulta;
$columnas       = SQL::obtenerColumnas($vistaMenu);
$totalRegistros = SQL::filasDevueltas(SQL::seleccionar(array($vistaMenu), $columnas, $condicion, $agrupamiento, $ordenamiento));
$paginador      = HTML::insertarPaginador($totalRegistros, $paginaActual, $numeroFilas);
$registros      = HTML::imprimirRegistros($totalRegistros, $paginaActual, $numeroFilas);

/*** Ejecutar la consulta y generar tabla a partir de los resultados ***/
$consulta     = SQL::seleccionar(array($vistaMenu), $columnas, $condicion, $agrupamiento, $ordenamiento, $paginaActual, $numeroFilas);
$tabla        = HTML::generarTabla($columnas, $consulta, $alineacion);

/*** Generar y enviar plantilla completa si la petición no se realiza vía AJAX ***/

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
    /*** Devolver sólo datos en formato JSON para las consultas vía AJAX ***/
    $datos[0] = $tabla;
    $datos[1] = $paginador;
    $datos[2] = $registros;
    $datos[3] = $botones;
    HTTP::enviarJSON($datos);
}
?>
