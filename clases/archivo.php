<?php

/**
*
* Copyright (C) 2009 FELINUX Ltda
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

class Archivo {

    public static $archivos;

    /*** Almacenar archivo ***/
    public static function guardarArchivo($archivo, $tabla) {
        global $rutasGlobales;
        $tabla = SQL::$prefijoTabla.$tabla;

        if (empty(self::$archivos)) {
            self::$archivos = $rutasGlobales["archivos"];
        }

        $ruta  = self::$archivos."/".$tabla;

        if (!file_exists($ruta)) {
            $creacion = mkdir($ruta, 0755);
        } elseif (!is_dir($ruta)) {
            return false;
        }
    }
}
?>