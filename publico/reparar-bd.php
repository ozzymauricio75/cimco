<?php

/**
*
* Copyright (C) 2009 FELINUX Ltda
* Francisco J. Lozano B. <fjlozano@felinux.com.co>
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

/*** Variables para la conexi�n a la base de datos ***/
$baseDatos["servidor"]   = "db2026.perfora.net";
$baseDatos["nombre"]     = "db296337400";
$baseDatos["usuario"]    = "dbo296337400";
$baseDatos["contrasena"] = "dAfq9jdC";

$baseDatos["servidor"]   = "localhost";
$baseDatos["nombre"]     = "sunnybeachvacations";
$baseDatos["usuario"]    = "dbosunny";
$baseDatos["contrasena"] = "v4c4ti0n";

/*** Establecer conexi�n con el motor de bases de datos y abrir la base de datos requerida ***/
$conexion  = mysql_connect($baseDatos["servidor"], $baseDatos["usuario"], $baseDatos["contrasena"])
             or die("Imposible conectar: ".mysql_error());
$apertura  = mysql_select_db($baseDatos["nombre"])
             or die("Imposible abrir la base de datos ".$baseDatos["nombre"].".");
$consulta1 = mysql_query("SHOW TABLES")
             or die("Imposible obtener lista de tablas");

while ($tabla = mysql_fetch_array($consulta1)) {
    echo "<br><b>Reparando la tabla {$tabla[0]} ...</b>";
    $consulta2 = mysql_query("SHOW COLUMNS FROM {$tabla[0]}")
    or die("Imposible obtener lista de columnas de la tabla {$tabla[0]}");

    while($columna = mysql_fetch_array($consulta2)) {

        if (preg_match("/(char|text)/", strtolower($columna[1]))) {
            echo "<br> - Reparando la columna {$columna[0]}";
/*
            $consulta3 = mysql_query("UPDATE {$tabla[0]} SET {$columna[0]}=CONVERT({$columna[0]} USING latin1)")
            or die("Imposible reparar {$columna[0]}!");
*/
        }
    }
}
?>
  </body>
</html>
