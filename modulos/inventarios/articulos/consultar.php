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

/*** Generar el formulario para la captura de datos ***/
if (!empty($url_generar)) {

    /*** Verificar que se haya enviado el ID del elemento a consultar ***/
    if (empty($url_id)) {
        $error     = $textos["ERROR_CONSULTAR_VACIO"];
        $titulo    = "";
        $contenido = "";

    } else {
        $vistaConsulta = "articulos";
        $columnas      = SQL::obtenerColumnas($vistaConsulta);
        $consulta      = SQL::seleccionar(array($vistaConsulta), $columnas, "id = '$url_id'");
        $datos         = SQL::filaEnObjeto($consulta);

        $error         = "";
        $titulo        = $componente->nombre;
        $id_sucursal      = SQL::obtenerValor("sucursales","nombre","id='$datos->id_sucursal'");
        
        $id_tercero_comprador = SQL::obtenerValor("compradores","id_tercero","id='$datos->id_comprador'");
        $nombre_comprador = SQL::obtenerValor("menu_terceros","NOMBRE_COMPLETO","id='$id_tercero_comprador'");
        $tercero = SQL::obtenerValor("menu_terceros","NOMBRE_COMPLETO","id='$datos->id_tercero'");
        $tipo_inventario = array(
            "0" => $textos["MERCANCIA"],
            "1" => $textos["MATERIA_PRIMA"],
            "2" => $textos["SUMINISTRO"],
            "3" => $textos["OBSEQUIO"],
        );
        
        $encabezado["PESTANA_GENERAL"] = array(
            $foto_articulo_principal,
            array(
                HTML::mostrarDato("codigo",$textos["CODIGO"],$datos->codigo),
                HTML::mostrarDato("detalle",$textos["DETALLE"],$datos->detalle)
            ),
            array(
                HTML::mostrarDato("proveedor",$textos["PROVEEDOR_PRINCIPAL"],$tercero)
            ),
            array(
                HTML::mostrarDato("referencia",$textos["REFERENCIA_PRINCIPAL"],$datos->referencia)
            )
        );
        if ($nombre_comprador != ""){
            $comprador[] = array(
                HTML::mostrarDato("comprador",$textos["COMPRADOR"],$nombre_comprador)
            );
        } else {
            $comprador[] = array(
                HTML::mostrarDato("comprador",$textos["COMPRADOR"],$textos["NO_DEFINIDO"])
            );
        }
        $encabezado["PESTANA_GENERAL"] = array_merge($encabezado["PESTANA_GENERAL"], $comprador);
        if ($categoria != ""){
            $categoria = HTML::mostrarDato("categoria",$textos["CATEGORIA"],$categoria);
        } else {
            $categoria = HTML::campoOculto("categoria",$categoria);
        }
        if ($grupo1 != ""){
            $grupo1 = HTML::mostrarDato("grupo1",$textos["GRUPO1"],$grupo1);
        } else {
            $grupo1 = HTML::campoOculto("grupo1",$grupo1);
        }
        if ($grupo2 != ""){
            $grupo2 = HTML::mostrarDato("grupo2",$textos["GRUPO2"],$grupo2);
        } else {
            $grupo2 = HTML::campoOculto("grupo2",$grupo2);
        }
        if ($grupo3 != ""){
            $grupo3 = HTML::mostrarDato("grupo3",$textos["GRUPO3"],$grupo3);
        } else {
            $grupo3 = HTML::campoOculto("grupo3",$grupo3);
        }
        if ($grupo4 != ""){
            $grupo4 = HTML::mostrarDato("grupo4",$textos["GRUPO4"],$grupo4);
        } else {
            $grupo4 = HTML::campoOculto("grupo4",$grupo4);
        }
        if ($grupo5 != ""){
            $grupo5 = HTML::mostrarDato("grupo5",$textos["GRUPO5"],$grupo5);
        } else {
            $grupo5 = HTML::campoOculto("grupo5",$grupo5);
        }
        if ($grupo6 != ""){
            $grupo6 = HTML::mostrarDato("grupo6",$textos["GRUPO6"],$grupo6);
        } else {
            $grupo6 = HTML::campoOculto("grupo1",$grupo6);
        }

        if ($criterio_subnivel_articulo != ""){

            $subnivel_articulo = array(
                HTML::agrupador(
                    array(
                        array(
                            HTML::mostrarDato("subnivel",$textos["SUBNIVEL"],$subnivel_articulo),
                            HTML::mostrarDato("criterio",$textos["CRITERIO"],$criterio_subnivel_articulo)
                        ),
                    ),
                    $textos["TALLAS"]
                )
            );
        } else {
            $subnivel_articulo = array(
                HTML::campoOculto("subnivel","")
            );
        }

        /*** Definición de pestañas ***/
        $formularios["PESTANA_DATOS_GENREALES"] = array(
            $foto_articulo_principal,
            array(
                HTML::mostrarDato("codigo",$textos["CODIGO"],$datos->codigo),
                HTML::mostrarDato("referencia",$textos["REFERENCIA_PRINCIPAL"],$datos->referencia),
                HTML::mostrarDato("detalle",$textos["DETALLE"],$datos->detalle)
            ),
            array(
                HTML::mostrarDato("proveedor",$textos["PROVEEDOR_PRINCIPAL"],$tercero)
            ),
            array(
                HTML::mostrarDato("marca",$textos["MARCA"],$marca),
                HTML::mostrarDato("procedencia",$textos["PROCEDENCIA"],$pais_procedencia),
                HTML::mostrarDato("tipo_inventario",$textos["TIPO_INVENTARIO"],$tipo_inventario[$datos->tipo_inventario]),
            ),
            array(
                HTML::mostrarDato("control_existencia",$textos["CONTROL_EXISTENCIA"],$control_existencia[$datos->control_existencia]),
                HTML::mostrarDato("nivel_precio_publico",$textos["NIVEL_PRECIO_PUBLICO"],$nivel_precio_publico[$datos->nivel_precio_publico]),
                HTML::mostrarDato("maneja_color",$textos["MANEJA_COLOR"],$textos["SI_NO_".$datos->maneja_color]),
            ),
            $subnivel_articulo,
            $combo_kit,
            array(
                HTML::agrupador(
                    array(
                        array(
                            HTML::mostrarDato("estructura",$textos["DESCRIPCION"],$estructura_grupo)
                        ),
                        array(
                            $categoria
                        ),
                        array(
                            $grupo1,
                            $grupo2,
                            $grupo3
                        ),
                        array(
                            $grupo4,
                            $grupo5,
                            $grupo6
                        )
                    ),
                    $textos["ESTRUCTURA_GRUPO"]
                )
            ),
            array(
                HTML::agrupador(
                    array(
                        array(
                            HTML::mostrarDato("unidad_compra",$textos["UNIDAD_COMPRA"],$unidad_compra),
                            HTML::mostrarDato("unidad_presentacion",$textos["UNIDAD_PRESENTACION"],$unidad_presentacion),
                            HTML::mostrarDato("unidad_publico",$textos["UNIDAD_PUBLICO"],$unidad_venta_publico)
                        ),
                    ),
                    $textos["UNIDADES"]
                )
            )
        );

        $consulta_fotos = SQL::seleccionar(array("fotos_articulos"),array("ruta_foto","nombre_archivo"),"id_articulo='$datos->id'");
        if (SQL::filasDevueltas($consulta_fotos)){
            while($datos_fotos = SQL::filaEnObjeto($consulta_fotos)){
                $ruta_foto = trim($datos_fotos->ruta_foto);
                $nombre_foto = trim($datos_fotos->nombre_archivo);
                if ($ruta_foto!="" && $nombre_foto!=""){
                    $nombreArchivo = $ruta_foto."/".$nombre_foto;
                    if (file_exists($nombreArchivo)){
                        if (($archivo = fopen($nombreArchivo, "r")) !== FALSE){

                            list($ancho, $alto, $tipo) = getimagesize($nombreArchivo);
                            $altura_base = 300;
                            $porcentaje_medidas =  $altura_base * 100 / $alto;
                            $ancho_base = $ancho * $porcentaje_medidas / 100;
                            $extension  = strtolower(substr($nombreArchivo, (strrpos($nombreArchivo, ".") - strlen($nombreArchivo)) + 1));

                            $imagen_nueva = imagecreatetruecolor($ancho_base, $altura_base);
                            if ($extension == "jpg"){
                                $imagen = imagecreatefromjpeg($nombreArchivo);
                            } else if ($extension == "png"){
                                $imagen = imagecreatefrompng($nombreArchivo);
                            } else if ($extension == "gif"){
                                $imagen = imagecreatefromgif($nombreArchivo);
                            }
                            imagecopyresampled($imagen_nueva, $imagen, 0, 0, 0, 0, $ancho_base, $altura_base, $ancho, $alto);
                            $nombre_foto_temp = explode(".",$nombre_foto);
                            $nombre_foto_temp = $nombre_foto_temp[0];
                            $nombreArchivoMuestraPeq  = $rutasGlobales["temp"]."/".$nombre_foto_temp."_".date("Y-m-d-H-i-s").".".$extension;

                            if ($extension == "jpg"){
                                imagejpeg($imagen_nueva, $nombreArchivoMuestraPeq);
                            } else if ($extension == "png"){
                                $negro = imagecolorallocate($imagen_nueva, 0, 0, 0);
                                $blanco = imagecolorallocate($imagen_nueva, 255, 255, 255);
                                imagecolortransparent($imagen_nueva, $negro);
                                imagefilledrectangle($imagen_nueva, 0, 0, 0, 0, $blanco);
                                imagepng($imagen_nueva, $nombreArchivoMuestraPeq);
                                imagepng($imagen_nueva, $nombreArchivoMuestraPeq);
                            } else if ($extension == "gif"){
                                imagegif($imagen_nueva, $nombreArchivoMuestraPeq);
                            }

                            $nombreArchivoMuestra  = $rutasGlobales["temp"]."/".$nombre_foto;
                            copy($nombreArchivo, $nombreArchivoMuestra);
                            $fotos_articulo[] = array(
                                HTML::imagen($nombreArchivoMuestraPeq),
                                HTML::enlazarPagina($textos["DESCARGAR"],$nombreArchivoMuestra)
                            );
                        }
                    }
                }
            }
            if (isset($fotos_articulo)){
                $formularios["PESTANA_FOTO"] = array(
                    array(
                        HTML::mostrarDato("codigo",$textos["CODIGO"],$datos->codigo),
                        HTML::mostrarDato("referencia",$textos["REFERENCIA_PRINCIPAL"],$datos->referencia),
                        HTML::mostrarDato("detalle",$textos["DETALLE"],$datos->detalle)
                    )
                );
                $formularios["PESTANA_FOTO"] = array_merge($formularios["PESTANA_FOTO"],$fotos_articulo);
            }
        }

        $condicion = "id_articulo='$datos->id' AND referencia!='$datos->referencia' AND id_tercero='$datos->id_tercero'";
        $condicion .= " AND id_categoria='$id_categoria' AND id_grupo1 !='$id_grupo1' AND id_grupo2!='$id_grupo2'";
        $condicion .= " AND id_marca='$datos->id_marca'";
        $consulta_referencias = SQL::seleccionar(array("referencias_articulos"),array("id","id_tercero","referencia","id_marca"),$condicion,"","id_tercero ASC, id_marca ASC, referencia ASC");
        if (SQL::filasDevueltas($consulta_referencias)){
            while($datos_referencia = SQL::filaEnObjeto($consulta_referencias)){
                if (!isset($proveedor[$datos_referencia->id_tercero])){
                   $proveedor[$datos_referencia->id_tercero] = SQL::obtenerValor("menu_terceros","NOMBRE_COMPLETO","id='$datos_referencia->id_tercero'");
                }
                if (!isset($marca[$datos_referencia->id_marca])){
                   $marca[$datos_referencia->id_marca] = SQL::obtenerValor("marcas","descripcion","id='$datos_referencia->id_marca'");
                }
                $items_referencia[] = array(
                    $datos_referencia->id,
                    $proveedor[$datos_referencia->id_tercero],
                    $datos_referencia->referencia,
                    $marca[$datos_referencia->id_marca]
                );
            }
            $formularios["PESTANA_REFERENCIAS"] = array(
                array(
                    HTML::mostrarDato("codigo",$textos["CODIGO"],$datos->codigo),
                    HTML::mostrarDato("referencia",$textos["REFERENCIA_PRINCIPAL"],$datos->referencia),
                    HTML::mostrarDato("detalle",$textos["DETALLE"],$datos->detalle)
                ),
                array(
                    HTML::generarTabla(
                        array("id","PROVEEDOR","REFERENCIA","MARCA"),
                        $items_referencia,
                        array("I","I","I"),
                        "listaRefrencia",
                        false
                    )
                )
            );

        }
        $contenido = HTML::generarPestanas($formularios);
    }

    /*** Enviar datos para la generación del formulario al script que originó la petición ***/
    $respuesta    = array();
    $respuesta[0] = $error;
    $respuesta[1] = $titulo;
    $respuesta[2] = $contenido;
    HTTP::enviarJSON($respuesta);
}
?>
