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

/*** Incluir archivo de configuraci�n principal ***/
require "../configuracion/global.php";

/*** Incluir archivos de clases ***/
require_once $rutasGlobales["clases"]."/sql.php";

SQL::abrirConexion();

$rutaModulos    = realpath($rutasGlobales["modulos"]);
$archivoEsquema = $archivosGlobales["esquemaSQL"];
$prefijoTabla   = SQL::$prefijoTabla;

/*** Obtener el contenido de la carpeta de m�dulos ***/
if ($listaModulos = opendir($rutaModulos)) {

    /*** Obtener lista de carpetas de m�dulos ***/
    while (false !== ($modulo = readdir($listaModulos))) {

        /*** Procesar carpetas de m�dulos ***/
        if ($modulo != "." && $modulo != "..") {
            $modulo = "$rutaModulos/$modulo";

            /*** Obtener el contenido de la carpeta del m�dulo actual ***/
            if ($listaComponentes = opendir($modulo)) {

                /*** Obtener lista de carpetas de componentes del m�dulo actual ***/
                while (false !== ($componente = readdir($listaComponentes))) {
                    unset($tablas, $llaves, $registros, $vistas);

                    /*** Procesar carpetas de componentes ***/
                    if ($componente != "." && $componente != "..") {
                        $componente = "$modulo/$componente";

                        /*** Procesar s�lo si se trata de un directorio ***/
                        if (is_dir($componente)) {
                            $esquema = "$componente/$archivoEsquema";

                            /*** Buscar el archivo de definici�n del esquema SQL ***/
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

                                        /*** Adicionar c�digo para definici�n llaves y campos �nicos ***/
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
