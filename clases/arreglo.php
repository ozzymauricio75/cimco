<?php

/**
*
* Copyright (C) 2009 FELINUX Ltda
* Francisco J. Lozano B. <fjlozano@felinux.com.co>
* Edier Andr�s Villaneda N. <eandres164@gmail.com>
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

class Arreglo {

	/*** Generar lista numerica***/
	public static function generarListaNumerica($inicio, $fin, $incremento = 1, $longitud = 0) {
		for ($i = $inicio; $i<= $fin; $i+= $incremento){
			$n = $i;

			if ($longitud){
				$n = str_pad($i, 2, "0", STR_PAD_LEFT);
			}
			
			$respuesta[$n] = $n;
		}
		return $respuesta;
	}

}
?>