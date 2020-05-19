<?php
/**
*
* Copyright (C) 2020 Raul Mauricio Oidor Lozano
* Walter Andres Marquez Gutierrez <walteramg@hotmail.com>
*
* Este archivo es parte de:
* PANCE :: Software empresarial a la medida
*
* Este programa es software libre: usted puede redistribuirlo y/o
* modificarlo  bajo los terminos de la Licencia Publica General GNU
* publicada por la Fundacion para el Software Libre, ya sea la version 3
* de la Licencia, o (a su eleccion) cualquier version posterior.
*
* Este programa se distribuye con la esperanza de que sea util, pero
* SIN GARANTIA ALGUNA; ni siquiera la garantia implicita MERCANTIL o
* de APTITUD PARA UN PROPOSITO DETERMINADO. Consulte los detalles de
* la Licencia Publica General GNU para obtener una informacion mas
* detallada.
*
* Deberia haber recibido una copia de la Licencia Publica General GNU
* junto a este programa. En caso contrario, consulte:
* <http://www.gnu.org/licenses/>.
*
**/

// Generar el formulario para la captura de datos
if (!empty($url_generar)) {
    $error  = "";
    $titulo = $componente->nombre;

    $tipo_listado = array(
        "1" => $textos["ARCHIVO_PDF"],
        "2" => $textos["ARCHIVO_PLANO"]
    );


    // Definicion de pestana general
    $formularios["PESTANA_GENERAL"] = array(
        array(
            HTML::listaSeleccionSimple("tipo_listado",$textos["TIPO_LISTADO"],$tipo_listado,"",array("title"=>$textos["AYUDA_TIPO_LISTADO"]))
        )
    );

    $botones = array(
        HTML::boton("botonAceptar", $textos["EXPORTAR"], "imprimirItem(1);", "aceptar")
    );

    $contenido = HTML::generarPestanas($formularios,$botones);
    // Enviar datos para la generacion del formulario al script que origino la peticion
    $respuesta    = array();
    $respuesta[0] = $error;
    $respuesta[1] = $titulo;
    $respuesta[2] = $contenido;
    HTTP::enviarJSON($respuesta);

// Exportar los datos
} elseif (!empty($forma_procesar)) {
    // Asumir por defecto que no hubo error
    $error        = false;
    $mensaje      = $textos["ARCHIVO_GENERADO"];
    $ruta_archivo = "";

    $nombre         = "";
    $nombreArchivo  = "";
    $tipo_listado = 2;

    $consulta = SQL::seleccionar(array("articulos"),array("*"),"id>0","","id_estructura_grupo ASC,codigo ASC");
    $i = 0;
    $contador = 0;
    if(SQL::filasDevueltas($consulta)){

        do {
            $cadena         = Cadena::generarCadenaAleatoria(8);
            if ($tipo_listado == 1){
                $nombre = (int)$sesion_id_usuario_ingreso.$cadena.".pdf";
            } else {
                $nombre = (int)$sesion_id_usuario_ingreso.$cadena.".csv";
            }
            $nombreArchivo  = $rutasGlobales["temp"]."/".$nombre;
        } while (is_file($nombreArchivo));

        if ($tipo_listado == 1){

            $archivo                 = new PDF("P","mm","Letter");
            $archivo->textoCabecera  = $textos["FECHA"].": ".date("Y-m-d");
            $archivo->textoTitulo    = $textos["LISTMARC"];
            $archivo->textoPiePagina = $textos["ELABORADO_POR"].": ".SQL::obtenerValor("usuarios","nombre","id = '".$sesion_id_usuario_ingreso."'");
            $archivo->AddPage("","",false,true);

            $tituloColumnas = array($textos["DESCRIPCION"]);
            $anchoColumnas  = array(50,30);
            $archivo->SetFont('Arial','B',8);
            $archivo->Cell(25, 4, $textos["LISTMARC"], 0, 0, "L");
            $archivo->Ln(4);
        } else {
            $archivo       = fopen($nombreArchivo,"a+");
            $titulos_plano = "\"".$textos["CODIGO"]."\";\"".$textos["DETALLE"];
            $titulos_plano .= "\";\"".$textos["CATEGORIA"]."\";\"".$textos["GRUPO1"]."\";\"".$textos["GRUPO2"];
            $titulos_plano .= "\";\"".$textos["GRUPO3"]."\";\"".$textos["GRUPO4"]."\";\"".$textos["GRUPO5"];
            $titulos_plano .= "\";\"".$textos["GRUPO6"]."\";\"".$textos["EXISTE_INCOMPLETA"]."\"\n";
            fwrite($archivo, $titulos_plano);
        }
        $caracteristica_anterior = "";
        while($datos = SQL::filaEnObjeto($consulta)){

            if($tipo_listado == 1){

                if ($datos->caracteristica != $caracteristica_anterior){
                    $archivo->SetFont('Arial','B',8);
                    $archivo->Cell(100, 4, $textos["CARACTERISTICA"].": ".$caracteristica[$datos->caracteristica], 0, 0, "L");
                    $archivo->Ln(4);
                    $archivo->generarCabeceraTabla($tituloColumnas, $anchoColumnas);
                    $archivo->Ln(4);
                    $caracteristica_anterior = $datos->caracteristica;
                }
                if($archivo->breakCell(5)){
                    $archivo->AddPage("","",false,true);
                    $archivo->SetFont('Arial','B',8);
                    $archivo->Cell(25, 4, $textos["LISTMARC"], 0, 0, "L");
                    $archivo->Ln(4);
                    $archivo->Cell(100, 4, $textos["CARACTERISTICA"].": ".$caracteristica[$datos->caracteristica], 0, 0, "L");
                    $archivo->Ln(4);
                    $archivo->SetFont('Arial','B',6);
                    $archivo->generarCabeceraTabla($tituloColumnas, $anchoColumnas);
                    $archivo->Ln(4);
                }

                if($archivo->FillColor != sprintf('%.3F %.3F %.3F rg',1,1,1)){
                    $archivo->SetFillColor(255,255,255);
                }else{
                    $archivo->SetFillColor(240,240,240);
                }

                $archivo->SetFont('Arial','',6);
                $archivo->Cell(50, 4, $datos->descripcion, 1, 0, "L",true,"",true);
                $archivo->Ln(4);
            }else{

                $detalle = str_replace("\"","",$datos->detalle);
                $detalle = str_replace("\'","",$detalle);
                $detalle = addslashes($detalle);
                if ((int)$datos->id_estructura_grupo <= 0){
                    $contador++;
                    $titulos_plano = "\"".$datos->codigo."\";\"".$detalle."\";";
                    $titulos_plano .= "0;0;0;0;0;0;0;\"No tiene estructura asignada\"\n";
                    fwrite($archivo, $titulos_plano);
                } else {
                    if (!isset($estructura[$datos->id_estructura_grupo])){
                        $consulta_estructura = SQL::seleccionar(array("estructura_grupos"),array("*"),"id='$datos->id_estructura_grupo'");
                        $datos_estructura = SQL::filaEnObjeto($consulta_estructura);
                        $categoria[$datos->id_estructura_grupo] = $datos_estructura->id_categoria;
                        $grupo1[$datos->id_estructura_grupo] = $datos_estructura->id_grupo1;
                        $grupo2[$datos->id_estructura_grupo] = $datos_estructura->id_grupo2;
                        $grupo3[$datos->id_estructura_grupo] = $datos_estructura->id_grupo3;
                        $grupo4[$datos->id_estructura_grupo] = $datos_estructura->id_grupo4;
                        $grupo5[$datos->id_estructura_grupo] = $datos_estructura->id_grupo5;
                        $grupo6[$datos->id_estructura_grupo] = $datos_estructura->id_grupo6;
                        $estructura[$datos->id_estructura_grupo] = $datos_estructura->descripcion;
                    }
                    $nivel = 0;
                    $condicion = "id_categoria > 0";

                    if ($categoria[$datos->id_estructura_grupo] > 0){
                        $nivel = 1;
                        $condicion = "id_categoria=".$categoria[$datos->id_estructura_grupo]." AND ";
                        $condicion .= "id_grupo1>0";
                        if ($grupo1[$datos->id_estructura_grupo] > 0){
                            $nivel = 2;
                            $condicion = "id_categoria=".$categoria[$datos->id_estructura_grupo]." AND ";
                            $condicion .= "id_grupo1=".$grupo1[$datos->id_estructura_grupo]." AND ";
                            $condicion .= "id_grupo2 > 0";
                            if ($grupo2[$datos->id_estructura_grupo] > 0){
                                $nivel = 3;
                                $condicion = "id_categoria=".$categoria[$datos->id_estructura_grupo]." AND ";
                                $condicion .= "id_grupo1=".$grupo1[$datos->id_estructura_grupo]." AND ";
                                $condicion .= "id_grupo2=".$grupo2[$datos->id_estructura_grupo]." AND ";
                                $condicion .= "id_grupo3 > 0";
                                if ($grupo3[$datos->id_estructura_grupo] > 0){
                                    $nivel = 4;
                                    $condicion = "id_categoria=".$categoria[$datos->id_estructura_grupo]." AND ";
                                    $condicion .= "id_grupo1=".$grupo1[$datos->id_estructura_grupo]." AND ";
                                    $condicion .= "id_grupo2=".$grupo2[$datos->id_estructura_grupo]." AND ";
                                    $condicion .= "id_grupo3=".$grupo3[$datos->id_estructura_grupo]." AND ";
                                    $condicion .= "id_grupo4 > 0";
                                    if ($grupo4[$datos->id_estructura_grupo] > 0){
                                        $nivel = 5;
                                        $condicion = "id_categoria=".$categoria[$datos->id_estructura_grupo]." AND ";
                                        $condicion .= "id_grupo1=".$grupo1[$datos->id_estructura_grupo]." AND ";
                                        $condicion .= "id_grupo2=".$grupo2[$datos->id_estructura_grupo]." AND ";
                                        $condicion .= "id_grupo3=".$grupo3[$datos->id_estructura_grupo]." AND ";
                                        $condicion .= "id_grupo4=".$grupo4[$datos->id_estructura_grupo]." AND ";
                                        $condicion .= "id_grupo5 > 0";
                                        if ($grupo5[$datos->id_estructura_grupo] > 0){
                                            $nivel = 6;
                                            $condicion = "id_categoria=".$categoria[$datos->id_estructura_grupo]." AND ";
                                            $condicion .= "id_grupo1=".$grupo1[$datos->id_estructura_grupo]." AND ";
                                            $condicion .= "id_grupo2=".$grupo2[$datos->id_estructura_grupo]." AND ";
                                            $condicion .= "id_grupo3=".$grupo3[$datos->id_estructura_grupo]." AND ";
                                            $condicion .= "id_grupo4=".$grupo4[$datos->id_estructura_grupo]." AND ";
                                            $condicion .= "id_grupo5=".$grupo5[$datos->id_estructura_grupo]." AND ";
                                            $condicion .= "id_grupo6 > 0";
                                            if ($grupo6[$datos->id_estructura_grupo] > 0){
                                                $nivel = 7;
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    } else {
                        $titulos_plano = "\"".$datos->codigo."\";\"".$detalle."\";";
                        $titulos_plano .= "0;0;0;0;0;0;0;\"Categoria igual a cero(0))\"\n";
                        fwrite($archivo, $titulos_plano);
                        $nivel = 7;
                    }
                    if ($nivel < 7){
                        $existe_estructura = SQL::obtenerValor("estructura_grupos","id", $condicion." LIMIT 0,1");
                        if ($existe_estructura){
                            $titulos_plano = "\"".$datos->codigo."\";\"".$detalle."\";\"";
                            $titulos_plano .= $categoria[$datos->id_estructura_grupo]."\";\"".$grupo1[$datos->id_estructura_grupo]."\";\"";
                            $titulos_plano .= $grupo2[$datos->id_estructura_grupo]."\";\"".$grupo3[$datos->id_estructura_grupo]."\";\"";
                            $titulos_plano .= $grupo4[$datos->id_estructura_grupo]."\";\"".$grupo5[$datos->id_estructura_grupo]."\";\"";
                            $titulos_plano .= $grupo6[$datos->id_estructura_grupo]."\";\"".$estructura[$datos->id_estructura_grupo].". La estructura asignada no esta hasta su ultimo nivel\"\n";
                            fwrite($archivo, $titulos_plano);
                        }
                    }
                }
            }
            $i++;
        }
    }

    if($i > 0 && !$error){
        if($tipo_listado == 1){
            $archivo->Output($nombreArchivo, "F");
        }else{
            $titulos_plano = "\";\"".$contador."\"\n";
            fwrite($archivo, $titulos_plano);
            fclose($archivo);
        }

        /*$consecutivo = SQL::obtenerValor("archivos","MAX(consecutivo)","id_sucursal='".$sesion_sucursal_ingreso."'");
        if ($consecutivo){
            $consecutivo++;
        } else {
            $consecutivo = 1;
        }
        $consecutivo = (int)$consecutivo;
        $fecha = date("Y-m-d");

        $datos_archivo = array(
            "id_sucursal" => $sesion_sucursal_ingreso,
            "fecha"       => $fecha,
            "consecutivo" => $consecutivo,
            "nombre"      => $nombre
        );
        SQL::insertar("archivos", $datos_archivo);
        $id_archivo   = $sesion_sucursal_ingreso."|".$fecha."|".$consecutivo;*/
        $ruta_archivo = HTTP::generarURL("DESCARCH")."&temporal=0&nombre_archivo=".$nombre;
    }else if(!$error){
        $error        = true;
        $mensaje      = $textos["ERROR_GENERAR_ARCHIVO"];
        $ruta_archivo = "";
    }

    $respuesta    = array();
    $respuesta[0] = $error;
    $respuesta[1] = $mensaje;
    $respuesta[2] = $ruta_archivo;

    HTTP::enviarJSON($respuesta);
}
?>

