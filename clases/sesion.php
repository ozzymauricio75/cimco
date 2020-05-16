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

class Sesion {
    public static $id;

    /*** Iniciar la sesión ***/
    public static function iniciar() {
        session_set_save_handler(
            array(__CLASS__,"abrir"),
            array(__CLASS__,"cerrar"),
            array(__CLASS__,"leer"),
            array(__CLASS__,"escribir"),
            array(__CLASS__,"terminar"),
            array(__CLASS__,"limpiar")
        );

        Sesion::limpiar();

        if (self::$id == "") {
            session_start();
        }

        self::$id = session_id();

        foreach ($_SESSION as $variable => $valor) {
            $nombre  = "sesion_".$variable;
            global $$nombre;
            $$nombre = $valor;
        }
    }

    /*** Finalizar la sesión ***/
    public static function terminar() {
        self::destruir(self::$id);
    }

    /*** Abrir una sesión ***/
    public static function abrir() {
        return TRUE;
    }

    /*** Cerrar una sesión ***/
    public static function cerrar() {
        return TRUE;
    }

    /*** Registrar una variable en la sesión ***/
    public static function registrar($variable, $valor = "") {
        global $$variable;

        if (isset($valor)) {
            $$variable = $valor;
        }

        $nombre = "sesion_".$variable;

        if (isset($$variable)) {
            global $$nombre;

            $$nombre               = $$variable;
            $_SESSION["$variable"] = $$variable;
        } else {
            $_SESSION["$variable"] = NULL;
        }
    }

    /*** Eliminar una variable de sesión ***/
    public static function borrar($variable) {
        $nombre = "sesion_".$variable;

        global $$nombre;

        if (isset($$nombre)) {
            unset($$nombre);
            unset($_SESSION["$variable"]);
        }
    }

    /*** Leer los datos una sesión ***/
    public static function leer($id) {
        $fecha     = time();
        $columnas  = array("contenido");
        $tablas    = array("sesiones");
        $resultado = SQL::seleccionar($tablas, $columnas, "id = '$id' AND expiracion > '$fecha'");

        if (SQL::filasDevueltas($resultado)) {
            $datos = SQL::filaEnObjeto($resultado);
            return $datos->contenido;

        } else {
            return FALSE;
        }
    }

    /*** Escribir los datos de una sesión ***/
    public static function escribir($id, $contenido) {
        $contenido  = addslashes($contenido);
        $expiracion = time() + get_cfg_var("session.gc_maxlifetime");
        $datos      = array("id" => "$id", "expiracion" => "$expiracion", "contenido"  => "$contenido");
        $resultado  = SQL::reemplazar("sesiones", $datos);
        return $resultado;
    }

    /*** Destruir una sesión ***/
    public static function destruir($id) {
        $resultado  = SQL::eliminar("sesiones","id='$id'");
        return $resultado;
    }

    /*** Eliminar las sesiones expiradas ***/
    public static function limpiar() {
/*        $fecha      = time();
        $resultado  = SQL::eliminar("sesiones","expiracion < '$fecha'");
        return $resultado;*/
    }
}

?>