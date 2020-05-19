<?php

/**
*
* Copyright (C) 2020 Raul Mauricio Oidor Lozano
* Raul Mauricio Oidor Lozano <ozzymauricio75@gmail.com>
*
* Este archivo es parte de:
* PANCE :: Software empresarial a la medida
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

    $error  = "";
    $titulo = $componente->nombre;

    $ordenamiento = array(
        "id"          => $textos["CODIGO"],
        "descripcion" => $textos["DESCRIPCION"]
    );
    $tipo_listado = array(
        "1" => $textos["PDF"],
        "2" => $textos["PLANO"]
    );

    /*** Definición de pestaña general ***/
    $formularios["PESTANA_GENERAL"] = array(
        array(
            HTML::listaSeleccionSimple("ordenamientos", $textos["ORDENAMIENTO"], $ordenamiento, "")
        ),
        array(
            HTML::listaSeleccionSimple("tipo_listado", $textos["TIPO_LISTADO"], $tipo_listado, "")
        )
    );

    $botones = array (
        HTML::boton("botonAceptar", $textos["ACEPTAR"], "imprimirItem('1');", "aceptar")
    );

    $contenido = HTML::generarPestanas($formularios, $botones);

    /*** Enviar datos para la generación del formulario al script que originó la petición ***/
    $respuesta    = array();
    $respuesta[0] = $error;
    $respuesta[1] = $titulo;
    $respuesta[2] = $contenido;
    HTTP::enviarJSON($respuesta);

/*** Exportar los datos***/
} elseif (!empty($forma_procesar)) {

    $error          = false;
    $mensaje        = $textos["ITEM_ADICIONADO"];
    $ruta_archivo   = "";

    $nombre         = "";
    $nombreArchivo  = "";
    $i=0;
    $consulta = SQL::seleccionar(array("tasas"), array("id","descripcion"),"id > 0","","$forma_ordenamientos ASC");
    if (SQL::filasDevueltas($consulta)) {

        do {
            $cadena         = Cadena::generarCadenaAleatoria(8);
            $nombre = (int)$sesion_id_usuario_ingreso.$cadena;
            if ($forma_tipo_listado == 1){
                $nombre = $nombre.".pdf";
            } else {
                $nombre = $nombre.".csv";
            }
            $nombreArchivo  = $rutasGlobales["temp"]."/".$nombre;
        } while (is_file($nombreArchivo));

        if ($forma_tipo_listado == 1){

            $archivo                = new PDF("P","mm","Letter");
            //$archivo->textoTitulo   = $textos["LISTADO_TASAS"];
            //$archivo->textoCabecera = $textos["FECHA"].": ".date("Y-m-d");
            $archivo->textoPiePagina = $textos["ELABORADO_POR"].": ".SQL::obtenerValor("usuarios","nombre","id = '".$sesion_id_usuario_ingreso."'");
            $archivo->AddPage("","",false,true);

            $archivo->SetFont('Arial','B',7);
            $archivo->Cell(25, 4, $textos["LISTADO_TASAS"], 0, 0, "L");
            $archivo->Ln(4);
            $archivo->SetFont('Arial','B',6);
            $tituloColumnas = array($textos["CODIGO"], $textos["DESCRIPCION"]);
            $anchoColumnas  = array(20,150);
            $archivo->generarCabeceraTabla($tituloColumnas, $anchoColumnas);
            $archivo->Ln(4);
        } else {
            $archivo = fopen($nombreArchivo,"a+");
            $titulos_plano = "\"".$textos["CODIGO"]."\";\"".$textos["DESCRIPCION"]."\"\n";
            fwrite($archivo, $titulos_plano);
        }
        while($datos = SQL::filaEnObjeto($consulta)) {

            if ($forma_tipo_listado == 1){
                if($archivo->breakCell(5)){
                    $archivo->AddPage("","",false,true);
                    $archivo->SetFont('Arial','B',7);
                    $archivo->Cell(25, 4, $textos["LISTADO_TASAS"], 0, 0, "L");
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

                $archivo->SetFont('Arial',"",6);
                $archivo->Cell(20, 4, (int)$datos->id, 1, 0, "L", true);
                $archivo->Cell(150, 4, $datos->descripcion, 1, 0, "L", true,"",true);
                $archivo->Ln(4);
            } else {
                $descripcion = str_replace(";"," ",$datos->descripcion);
                $titulos_plano = "\"".(int)$datos->id."\";\"".$descripcion."\"\n";
                fwrite($archivo, $titulos_plano);
            }

            $i++;
        }
    }
    $cargaPdf = 0;
    if($i>0) {
        if ($forma_tipo_listado == 1){
            $archivo->Output($nombreArchivo, "F");
        } else {
            fclose($archivo);
        }
        $ruta_archivo = HTTP::generarURL("DESCARCH")."&temporal=1&nombre_archivo=".$nombre;
        $cargaPdf = 1;
    }

    /*** Enviar datos con la respuesta del proceso al script que originó la petición ***/
    $respuesta    = array();
    if ($cargaPdf == 1) {
        $respuesta[0] = false;
        $respuesta[1] = $textos["MENSAJE_EXITO"];
        $respuesta[2] = $ruta_archivo;
    } else{
        $respuesta[0] = true;
        $respuesta[1] = $textos["MENSAJE_ERROR"];
        $respuesta[2] = "";
    }


    HTTP::enviarJSON($respuesta);
}
?>
