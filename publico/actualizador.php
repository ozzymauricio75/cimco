<?php

/**
*
* Copyright (C) 2009 FELINUX Ltda <http://www.linuxcali.com>
* Francisco J. Lozano B. <fjlozano@felinux.com.co>
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

$idServidorPrincipal        = 1;
$accesoRemoto["usuario"]    = "actualizador";
$accesoRemoto["contrasena"] = "actualizador";

/*** Incluir archivo de configuración principal ***/
require "../configuracion/global.php";
require "../configuracion/sincronizacion.php";

/*** Incluir archivos de clases globales ***/
require_once $rutasGlobales["clases"]."/sql.php";
require_once $rutasGlobales["clases"]."/http.php";
require_once $rutasGlobales["clases"]."/sesion.php";
require_once $rutasGlobales["clases"]."/componente.php";
require_once $rutasGlobales["clases"]."/plantilla.php";
require_once $rutasGlobales["clases"]."/codigohtml.php";
require_once $rutasGlobales["clases"]."/cadena.php";
require_once $rutasGlobales["clases"]."/archivo.php";
require_once $rutasGlobales["clases"]."/arreglo.php";
require_once $rutasGlobales["clases"]."/pdf.php";

HTTP::iniciar();
HTTP::evitarCache();
HTTP::exportarVariables();
SQL::abrirConexion();
Sesion::iniciar();

$consulta = SQL::seleccionar(array("servidores"), array("id", "ip"));

while ($datos = SQL::filaEnObjeto($consulta)) {
    $ipServidor = $datos->ip;
    $idServidor = $datos->id;

    if ($idServidor != $idServidorPrincipal) {
        $conexion  = @mysql_connect($ipServidor, $accesoRemoto["usuario"], $accesoRemoto["contrasena"]);
        if (!$conexion) {
            echo "<br>ERROR|".date("Y-m-d H:i:s")."|Error conectando a $ipServidor<br>";
        } else {
            echo "<br>OK|".date("Y-m-d H:i:s")."|Conexión establecida con $ipServidor";
            $baseDatos = @mysql_select_db(SQL::$baseDatos);
            $resultado  = @mysql_query("SELECT * FROM ".SQL::$prefijoTabla."actualizaciones_almacen ORDER BY FECHA ASC");

            while ($registros = @mysql_fetch_object($resultado)) {
                $idActualizacion = $registros->id;
                $fechaOperacion  = $registros->fecha;
                $instruccion     = $registros->instruccion;
                $tablaAfectada   = $registros->tabla;
                $columnas        = $registros->columnas;
                $valores         = $registros->valores;
                $idAfectado      = $registros->id_asignado;

                switch ($instruccion) {
                    case "I" :  $columnas = explode(",", $columnas);
                                $valores  = preg_split("/,(?!(?:[^\\\',]|[^\\\'],[^\\\'])+\\\')/", $valores);
                                $campos   = array();

                                for ($i = 0; $i < count($columnas); $i++) {
                                    $campos[] = trim($columnas[$i])."=".trim($valores[$i]);
                                }

                                $condicion = implode(" AND ", $campos);

                                $verificacion = @mysql_query("SELECT id FROM ".SQL::$prefijoTabla.$tablaAfectada." WHERE $condicion");
                                $filas        = @mysql_num_rows($verificacion);

                                if ($filas > 1) {
                                    echo "<br>ERROR|".date("Y-m-d H:i:s")."|Existen varios registros en la tabla ".SQL::$prefijoTabla.$tablaAfectada." que coinciden con <code>$condicion</code>";
                                } elseif ($filas == 1) {
                                    $fila     = @mysql_fetch_object($verificacion);
                                    $idActual = $fila->id;
                                    echo "<br>ID: $id";
                                } else {
                                }

                                break;
                    case "U" :  echo "<br>Modificando ...";
                                break;
                    case "D" :  echo "<br>Eliminando ...";
                                break;
                }
            }
        }
    }
}

?>