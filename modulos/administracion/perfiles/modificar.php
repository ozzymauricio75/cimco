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

/*** Generar el formulario para la captura de datos ***/
if (!empty($url_generar)) {

	/*** Verificar que se haya enviado el ID del elemento a modificar ***/
	if (empty($url_id)) {
		$error     = $textos["ERROR_MODIFICAR_VACIO"];
		$titulo    = "";
		$contenido = "";

	} else {
		$vistaConsulta = "perfiles";
		$condicion     = "id = '$url_id'";
		$columnas      = SQL::obtenerColumnas($vistaConsulta);
		$consulta      = SQL::seleccionar(array($vistaConsulta), $columnas, $condicion);
		$datos         = SQL::filaEnObjeto($consulta);
		$error         = "";
		$idActual      = $componente->id;
		$titulo        = $componente->nombre;

		/*** Definici�n de pesta�as ***/
		$formularios["PESTANA_GENERAL"] = array(
		array(
		HTML::campoTextoCorto("*codigo", $textos["CODIGO"], 4, 4, $datos->codigo, array("title" => $textos["AYUDA_CODIGO"]))
		),
		array(
		HTML::campoTextoCorto("*nombre", $textos["NOMBRE"], 30, 255, $datos->nombre, array("title" => $textos["AYUDA_NOMBRE"]))
		),
		array(
		HTML::marcaChequeo("cambiar", $textos["CAMBIAR"], 1, false)
		)
		);

		$formularios["PESTANA_COMPONENTES"] = array(
		array(
		HTML::arbolPerfiles("componentes_perfil", $url_id)
		)
		);

		/*** Definici�n de botones ***/
		$botones = array(
		HTML::boton("botonAceptar", $textos["ACEPTAR"], "modificarItem('$url_id');", "aceptar")
		);

		$componente = new Componente($idActual);
		$contenido  = HTML::generarPestanas($formularios, $botones);
	}

	/*** Enviar datos para la generaci�n del formulario al script que origin� la petici�n ***/
	$respuesta    = array();
	$respuesta[0] = $error;
	$respuesta[1] = $titulo;
	$respuesta[2] = $contenido;
	HTTP::enviarJSON($respuesta);

	/*** Validar los datos provenientes del formulario ***/
} elseif (!empty($url_validar)) {

	$respuesta = "";

	if ($url_item == "nombre" && $url_valor) {
		$existe = SQL::existeItem("perfiles", "nombre", $url_valor, "id != $url_id");

		if ($existe) {
			$respuesta =  $textos["ERROR_EXISTE_NOMBRE"];
		}
	}

	HTTP::enviarJSON($respuesta);

	/*** Modificar el elemento seleccionado ***/
} elseif (!empty($forma_procesar)) {

	/*** Asumir por defecto que no hubo error ***/
	$error   = false;
	$mensaje = $textos["ITEM_ADICIONADO"];

	/*** Validar el ingreso de los datos requeridos ***/
	if (empty($forma_nombre)) {
		$error   = true;
		$mensaje = $textos["ERROR_DATOS_INCOMPLETOS"];

	} elseif (SQL::existeItem("perfiles", "nombre", $forma_nombre, "id != $forma_id")) {
		$error   = true;
		$mensaje =  $textos["ERROR_EXISTE_NOMBRE"];

	} elseif (!isset($forma_privilegios)) {
		$error   = true;
		$mensaje =  $textos["ERROR_COMPONENTES"];

	} else {

		$datos = array(
            "codigo" => $forma_codigo,
            "nombre" => $forma_nombre
		);

		$consulta = SQL::modificar("perfiles", $datos, "id = '$forma_id'");
		$consulta = SQL::eliminar("componentes_perfil", "id_perfil = '$forma_id'");

		foreach ($forma_privilegios as $privilegio => $valor) {
			$datos = array(
                "id_perfil"     => $forma_id,
                "id_componente" => $privilegio
			);

			$insertar = SQL::insertar("componentes_perfil", $datos);

			/*** Error de inserci�n ***/
			if (!$insertar) {
				$error   = true;
				$mensaje = $textos["ERROR_ADICIONAR_ITEM"];
			}
		}

		if(isset($forma_cambiar)){
			/* Consulta el id del perfil en la tabla perfiles_usuario */
			$consulta2 = SQL::seleccionar(array("perfiles_usuario"), array("id"), "id_perfil = '$forma_id'");

			$datos2 = SQL::filaEnObjeto($consulta2);
			$id_perfil_usuario = $datos2->id;

			/* Elimina todos los componentes del perfil actual */
			$consulta = SQL::eliminar("componentes_usuario", "id_perfil = '$id_perfil_usuario'");

			/* Inserta nuevos componentes */
				
			foreach ($forma_privilegios as $privilegio => $valor) {
				$datos = array(
        	        "id_perfil"     => $id_perfil_usuario,
            	    "id_componente" => $privilegio
				);

				$insertar = SQL::insertar("componentes_usuario", $datos);

				/*** Error de inserci�n ***/
				if (!$insertar) {
					$error   = true;
					$mensaje = $textos["ERROR_ADICIONAR_ITEM"];
				}
			}
		}

		if ($consulta) {
			$error   = false;
			$mensaje = $textos["ITEM_MODIFICADO"];
		} else {
			$error   = true;
			$mensaje = $textos["ERROR_MODIFICAR_ITEM"];
		}
	}

	/*** Enviar datos con la respuesta del proceso al script que origin� la petici�n ***/
	$respuesta    = array();
	$respuesta[0] = $error;
	$respuesta[1] = $mensaje;
	HTTP::enviarJSON($respuesta);
}
?>