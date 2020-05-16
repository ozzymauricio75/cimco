<style>
    .error {
        color: #990000;
    }
</style>
<pre>
<?php

/**
*
* Copyright (C) 2020 Raul Mauricio Oidor Lozano
* Raul Mauricio Oidor Lozano. <ozzymauricio75@gmail.com>
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

/*** Incluir archivo de configuración principal ***/
require "../configuracion/global.php";

/*** Incluir archivos de clases ***/
require_once $rutasGlobales["clases"]."/sql.php";

SQL::abrirConexion();

$rutaModulos    = realpath($rutasGlobales["modulos"]);
$archivoEsquema = $archivosGlobales["esquemaSQL"];
$prefijoTabla   = SQL::$prefijoTabla;

/*** Obtener el contenido de la carpeta de módulos ***/
if ($listaModulos = opendir($rutaModulos)) {

    /*** Obtener lista de carpetas de módulos ***/
    while (false !== ($modulo = readdir($listaModulos))) {

        /*** Procesar carpetas de módulos ***/
        if ($modulo != "." && $modulo != "..") {
            $modulo = "$rutaModulos/$modulo";

            /*** Obtener el contenido de la carpeta del módulo actual ***/
            if ($listaComponentes = opendir($modulo)) {

                /*** Obtener lista de carpetas de componentes del módulo actual ***/
                while (false !== ($componente = readdir($listaComponentes))) {
                    unset($tablas, $llaves, $registros, $vistas);

                    /*** Procesar carpetas de componentes ***/
                    if ($componente != "." && $componente != "..") {
                        $componente = "$modulo/$componente";

                        /*** Procesar sólo si se trata de un directorio ***/
                        if (is_dir($componente)) {
                            $esquema = "$componente/$archivoEsquema";

                            /*** Buscar el archivo de definición del esquema SQL ***/
                            if (file_exists($esquema) && is_readable($esquema)) {
                                include $esquema;
                                $sentenciaFKC0 = "SET FOREIGN_KEY_CHECKS = 0;";
                                $sentenciaFKC1 = "SET FOREIGN_KEY_CHECKS = 1;";

                                $sentenciaCrear    = "";
                                $sentenciaInsertar = "";

                                /*** Crear nuevas tablas ***/
                                if (!empty($tablas)) {

                                    foreach ($tablas as $tabla => $columnas) {
                                        $sentenciaBorrar = "DROP TABLE IF EXISTS ".$prefijoTabla.$tabla."\n";
                                        $sentenciaCrear  = "CREATE TABLE IF NOT EXISTS ".$prefijoTabla.$tabla." (\n";

                                        $listaColumnas = array();

                                        foreach ($columnas as $columna => $tipoDatos) {
                                            $listaColumnas[] = "  $columna $tipoDatos";
                                        }

                                        /*** Adicionar código para definición llaves y campos únicos ***/
                                        if (!empty($llavesPrimarias[$tabla])) {
                                            $listaColumnas[]="  PRIMARY KEY ($llavesPrimarias[$tabla])";

                                        }

                                        if (!empty($llavesUnicas[$tabla])) {
                                            foreach ($llavesUnicas[$tabla] as $llave){
                                                $listaColumnas[]="  UNIQUE ($llave)";
                                            }
                                        }

                                        if (!empty($llavesForaneas[$tabla])) {
                                            foreach ($llavesForaneas[$tabla] as $elementoFK) {
                                            $listaColumnas[]="  CONSTRAINT ".$elementoFK[0]." FOREIGN KEY (".$elementoFK[1].") REFERENCES ".$prefijoTabla.$elementoFK[2]."(".$elementoFK[3].") ON UPDATE CASCADE ON DELETE RESTRICT";

                                            }
                                        }
                                        $sentenciaCrear .= implode(",\n", $listaColumnas);
                                        $sentenciaCrear .= "\n) ENGINE=InnoDB DEFAULT CHARSET=latin1;\n";
                                        $sentenciaAI     = "SET INSERT_ID = 0;\n";

                                        $resultado = SQL::correrConsulta($sentenciaFKC0);

                                        if ($borrarSiempre) {
                                            $resultado = SQL::correrConsulta($sentenciaBorrar);
                                            if (mysql_error()) {echo "<span class='error'><b>Error: </b>".mysql_error().":</span><br>".$sentenciaBorrar."<br>";}
                                            $borrarSiempre = false;
                                        }

                                        $resultado = SQL::correrConsulta($sentenciaCrear);
                                        if (mysql_error()) {echo "<span class='error'><b>Error: </b>".mysql_error().":</span><br>".$sentenciaCrear."<br>";}
                                        $resultado = SQL::correrConsulta($sentenciaAI);
                                        $resultado = SQL::correrConsulta($sentenciaFKC1);
                                    }
                                    unset($llavesForaneas, $llavesUnicas, $llavesPrimarias);
                                }

                                /*** Insertar datos iniciales ***/
                                if (!empty($registros)) {
                                    foreach($registros as $nombreTabla => $arregloA){
                                        $listaCampos = array();
                                        $listaValores = array();
                                        foreach($arregloA as $arregloB => $campos){
                                            foreach($campos as $campo => $valor){
                                                $listaCampos[]  = $campo;
                                                if (strtolower($valor) == "null"){
                                                    $listaValores[] = "$valor";
                                                }else{
                                                    $listaValores[] = "'$valor'";
                                                }
                                            }
                                            $indices           = implode(",", $listaCampos);
                                            $valores           = implode(",", $listaValores);
                                            $sentenciaInsertar = "REPLACE INTO ".$prefijoTabla.$nombreTabla." ($indices)\n    VALUES($valores);\n";
                                            $resultado         = SQL::correrConsulta($sentenciaFKC0);
                                            $resultado         = SQL::correrConsulta($sentenciaInsertar);
                                            if (mysql_error()) {echo "<span class='error'><b>Error: </b>".mysql_error().":</span><br>".$sentenciaInsertar."<br>";}
                                            $resultado         = SQL::correrConsulta($sentenciaFKC1);
                                            unset($listaCampos, $listaValores);
                                        }
                                    }
                                }

                                /*** Insertar vistas ***/
                                if (!empty($vistas)) {

                                    foreach ($vistas as $tabla => $registros) {
                                        $contenidoTablas=$contenidoColumnas=array();

                                        foreach($vistas[$tabla]['tablas'] as $nombreTabla => $nombreCortoTabla){
                                            $contenidoTablas[]=" $prefijoTabla$nombreTabla AS $nombreCortoTabla ";
                                        }

                                        foreach($vistas[$tabla]['columnas'] as $nombreColumna => $nombreCortoColumna){
                                            $contenidoColumnas[]="  $nombreCortoColumna AS $nombreColumna";
                                        }

                                        $contenidoTablas      = implode(",\n", $contenidoTablas);
                                        $contenidoColumnas    = implode(",\n", $contenidoColumnas);
                                        $contenidoCondiciones = $vistas[$tabla]['condiciones'];
                                        $sentenciaVistas      = "CREATE OR REPLACE VIEW  $prefijoTabla$tabla \n AS \n
                                                                 SELECT\n $contenidoColumnas \nFROM\n $contenidoTablas\n
                                                                 WHERE\n $contenidoCondiciones";
                                        $resultado            = SQL::correrConsulta($sentenciaFKC0);
                                        $resultado            = SQL::correrConsulta($sentenciaVistas);
                                        if (mysql_error()) {
                                            echo "<span class='error'><b>Error: </b>".mysql_error().":</span><br>".$sentenciaVistas."<br>";
                                        }
                                        $resultado = SQL::correrConsulta($sentenciaFKC1);
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}

closedir($listaComponentes);
closedir($listaModulos);

SQL::cerrarConexion();

?>
</pre>
