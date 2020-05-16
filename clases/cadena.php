<?php

/**
*
* Copyright (C) 2009 FELINUX Ltda
* Francisco J. Lozano B. <fjlozano@felinux.com.co>
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

class Cadena {

	/*** Validar una cadena de texto para que tenga el formato correcto de direcci�n IP ***/
	public static function validarDireccionIP($direccion) {

		if(preg_match("/^(\d{1,3})\.(\d{1,3})\.(\d{1,3})\.(\d{1,3})$/",$direccion)) {
			$segmentos = explode(".",$direccion);

			foreach($segmentos as $segmento) {
				if(intval($segmento) > 255 || intval($segmento) < 0) {
					return false;
				}
			}

            return true;

		} else {
			return false;
		}
	}

    /*** Validar que una cadena de texto solo tenga letras may�sculas a excepci�n de algunos caracteres permitidos ***/
    public static function validarContrasena($cadena, $debil = false, $insensible = false) {

        if (preg_match("/^([a-zA-Z0-9\.\-])@([a-zA-Z0-9\.\-]+)\.([a-z]{2,4})$/", $cadena)) {
            return true;
        } else {
            return false;
        }
    }

    /*** Validar que una cadena de texto solo tenga letras may�sculas a excepci�n de algunos caracteres permitidos ***/
    public static function validarCorreo($cadena) {

        if (preg_match("/^([a-z0-9])(([-a-z0-9._])*([a-z0-9]))*\@([a-z0-9])([-a-z0-9_])+([a-z0-9])*(\.([a-z0-9])([-a-z0-9_-])([a-z0-9])+)*$/i", $cadena)) {
            return true;
        } else {
            return false;
        }
    }

    /*** Validar que una cadena de texto solo tenga letras may�sculas a excepci�n de algunos caracteres permitidos ***/
    public static function validarMayusculas($cadena, $longitudMinima = 0, $longitudMaxima = 0, $permitidos = "") {

        if (!$longitudMaxima) {
            $longitudMaxima = strlen($cadena);
        }

        $longitud = "{".$longitudMinima.",".$longitudMaxima."}";

        if (preg_match("/^([A-Z".$permitidos."]".$longitud.")$/", $cadena)) {
            return true;
        } else {
            return false;
        }
    }

    /*** Validar que una cadena de texto solo tenga letras min�sculas a excepci�n de algunos caracteres permitidos ***/
    public static function validarMinusculas($cadena, $longitudMinima = 0, $longitudMaxima = 0, $permitidos = "") {

        if (!$longitudMaxima) {
            $longitudMaxima = strlen($cadena);
        }

        $longitud = "{".$longitudMinima.",".$longitudMaxima."}";

        if (preg_match("/^([a-z".$permitidos."]".$longitud.")$/", $cadena)) {
            return true;
        } else {
            return false;
        }
    }

    /*** Validar que una cadena de texto solo tenga numeros a excepci�n de algunos caracteres permitidos ***/
    public static function validarNumeros($cadena, $longitudMinima = 0, $longitudMaxima = 0, $permitidos = "") {

        if (!$longitudMaxima) {
            $longitudMaxima = strlen($cadena);
        }

        $longitud = "{".$longitudMinima.",".$longitudMaxima."}";

        if (preg_match("/^([0-9".$permitidos."]".$longitud.")$/", $cadena)) {
            return true;
        } else {
            return false;
        }
    }

    /*** Generar una expresi�n regular a partir de una cadena de texto dada para realizar b�squedas ***/
    public static function expresionRegular($cadena, $completa = true) {
        $cadena = utf8_decode($cadena);

        if (strlen($cadena) <= 2) {
            return "[[:<:]]".$cadena."[[:>:]]";
        }

        /*** Eliminar espacios en blanco duplicados ***/
        while (strpos($cadena, "  ")) {
            $cadena = str_replace("  ", " ", $cadena);
        }

        $palabras = array();

        /*** Verificar si se debe buscar la cadena o una subcadena ***/
        if ($completa) {
            /*** Verificar si se debe buscar cualquier palabra o la frase exacta ***/
            if (ereg("([^\"])*([\"$])", $cadena)) {
                $cadena      = str_replace("\\\"", "", $cadena);
                $palabras[0] = $cadena;
            } else {
                $palabras = explode(" ", $cadena);
            }
        } else {
            $palabras[0] = $cadena;
        }

        $palabrasExpReg = array();

        foreach ($palabras as $palabra) {
            $palabra = strtolower($palabra);
            $palabra = ereg_replace("ce|c�|c�|se|s�|s�|ze|z�|z�", "[cszx]e", $palabra);
            $palabra = ereg_replace("ci|c�|c�|si|s�|s�|zi|z�|z�", "[cszx]i", $palabra);
            $palabra = ereg_replace("sa|s�|s�|za|z�|z�", "[szx]a", $palabra);
            $palabra = ereg_replace("so|s�|s�|zo|z�|z�", "[szx]o", $palabra);
            $palabra = ereg_replace("su|s�|s�|zu|z�|z�", "[szx]u", $palabra);
            $palabra = ereg_replace("ca|c�|c�|ka|k�|k�", "[ck]a", $palabra);
            $palabra = ereg_replace("co|c�|c�|ko|k�|k�", "[ck]o", $palabra);
            $palabra = ereg_replace("cu|c�|c�|ku|k�|k�", "[ck]u", $palabra);
            $palabra = ereg_replace("je|j�|j�|ge|g�|g�", "[jg]e", $palabra);
            $palabra = ereg_replace("ji|j�|j�|gi|g�|g�", "[jg]i", $palabra);
            $palabra = ereg_replace("que|qu�|qu�|ke|k�|k�", "(qu|k)e", $palabra);
            $palabra = ereg_replace("qui|qu�|qu�|ki|k�|k�", "(qu|k)i", $palabra);
            $palabra = ereg_replace("cl|kl|cr|kr", "(cl|kl|cr|kr)", $palabra);
            $palabra = ereg_replace("h", "h?", $palabra);
            $palabra = ereg_replace("[vb]", "[vb]", $palabra);
            $palabra = ereg_replace("y|ll", "(y|ll)", $palabra);
            $palabra = ereg_replace("s |z ", "[szx] ", $palabra);
            $palabra = ereg_replace("s$|z$", "[szx]?", $palabra);
            $palabra = ereg_replace("[a]$", "a[s]?", $palabra);
            $palabra = ereg_replace("[e]$", "e[s]?", $palabra);
            $palabra = ereg_replace("[i]$", "i[s]?", $palabra);
            $palabra = ereg_replace("[o]$", "o[s]?", $palabra);
            $palabra = ereg_replace("[u]$", "u[s]?", $palabra);
            $palabra = ereg_replace("[a��]", "h?[a��]", $palabra);
            $palabra = ereg_replace("[e��]", "h?[e��]", $palabra);
            $palabra = ereg_replace("[yi��]", "h?[i��y]", $palabra);
            $palabra = ereg_replace("[o��]", "h?[o��]", $palabra);
            $palabra = ereg_replace("[u��]", "h?[u��]", $palabra);
            $palabra = ereg_replace("[n��]", "[n��]", $palabra);
            $palabra = ereg_replace("\.", "[\.]?", $palabra);

            if ($completa) {
                $palabra = "[[:<:]]".$palabra."[[:>:]]";
            }

            $palabrasExpReg[] = $palabra;
        }

        $cadena = implode("|", $palabrasExpReg);
        return $cadena;
    }

    /*** Determinar si una cadena contiene o no caracteres en UTF-8 ***/
    public static function contieneUTF8($cadena) {

        // Basada en http://w3.org/International/questions/qa-forms-utf-8.html
        return preg_match('%^(?:
            [\x09\x0A\x0D\x20-\x7E]              # ASCII
            | [\xC2-\xDF][\x80-\xBF]             # non-overlong 2-byte
            |  \xE0[\xA0-\xBF][\x80-\xBF]        # excluding overlongs
            | [\xE1-\xEC\xEE\xEF][\x80-\xBF]{2}  # straight 3-byte
            |  \xED[\x80-\x9F][\x80-\xBF]        # excluding surrogates
            |  \xF0[\x90-\xBF][\x80-\xBF]{2}     # planes 1-3
            | [\xF1-\xF3][\x80-\xBF]{3}          # planes 4-15
            |  \xF4[\x80-\x8F][\x80-\xBF]{2}     # plane 16
        )*$%xs', $cadena);
    }
    
}
?>
