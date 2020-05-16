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

class Cadena {

	/*** Validar una cadena de texto para que tenga el formato correcto de dirección IP ***/
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

    /*** Validar que una cadena de texto solo tenga letras mayúsculas a excepción de algunos caracteres permitidos ***/
    public static function validarContrasena($cadena, $debil = false, $insensible = false) {

        if (preg_match("/^([a-zA-Z0-9\.\-])@([a-zA-Z0-9\.\-]+)\.([a-z]{2,4})$/", $cadena)) {
            return true;
        } else {
            return false;
        }
    }

    /*** Validar que una cadena de texto solo tenga letras mayúsculas a excepción de algunos caracteres permitidos ***/
    public static function validarCorreo($cadena) {

        if (preg_match("/^([a-z0-9])(([-a-z0-9._])*([a-z0-9]))*\@([a-z0-9])([-a-z0-9_])+([a-z0-9])*(\.([a-z0-9])([-a-z0-9_-])([a-z0-9])+)*$/i", $cadena)) {
            return true;
        } else {
            return false;
        }
    }

    /*** Validar que una cadena de texto solo tenga letras mayúsculas a excepción de algunos caracteres permitidos ***/
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

    /*** Validar que una cadena de texto solo tenga letras minúsculas a excepción de algunos caracteres permitidos ***/
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

    /*** Validar que una cadena de texto solo tenga numeros a excepción de algunos caracteres permitidos ***/
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

    /*** Generar una expresión regular a partir de una cadena de texto dada para realizar búsquedas ***/
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
            $palabra = ereg_replace("ce|cé|cÉ|se|sé|sÉ|ze|zé|zÉ", "[cszx]e", $palabra);
            $palabra = ereg_replace("ci|cí|cÍ|si|sí|sÍ|zi|zí|zÍ", "[cszx]i", $palabra);
            $palabra = ereg_replace("sa|sá|sÁ|za|zá|zÁ", "[szx]a", $palabra);
            $palabra = ereg_replace("so|só|sÓ|zo|zó|zÓ", "[szx]o", $palabra);
            $palabra = ereg_replace("su|sú|sÚ|zu|zú|zÚ", "[szx]u", $palabra);
            $palabra = ereg_replace("ca|cá|cÁ|ka|ká|kÁ", "[ck]a", $palabra);
            $palabra = ereg_replace("co|có|cÓ|ko|kó|kÓ", "[ck]o", $palabra);
            $palabra = ereg_replace("cu|cú|cÚ|ku|kú|kÚ", "[ck]u", $palabra);
            $palabra = ereg_replace("je|jé|jÉ|ge|gé|gÉ", "[jg]e", $palabra);
            $palabra = ereg_replace("ji|jí|jÍ|gi|gí|gÍ", "[jg]i", $palabra);
            $palabra = ereg_replace("que|qué|quÉ|ke|ké|kÉ", "(qu|k)e", $palabra);
            $palabra = ereg_replace("qui|quí|quÍ|ki|kí|kÍ", "(qu|k)i", $palabra);
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
            $palabra = ereg_replace("[aáÁ]", "h?[aáÁ]", $palabra);
            $palabra = ereg_replace("[eéÉ]", "h?[eéÉ]", $palabra);
            $palabra = ereg_replace("[yiíÍ]", "h?[iíÍy]", $palabra);
            $palabra = ereg_replace("[oóÓ]", "h?[oóÓ]", $palabra);
            $palabra = ereg_replace("[uúÚ]", "h?[uúÚ]", $palabra);
            $palabra = ereg_replace("[nñÑ]", "[nñÑ]", $palabra);
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
