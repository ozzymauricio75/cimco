<?php

/**
*
* Copyright (C) 2020 Raul Mauricio Oidor Lozano
* Raul Mauricio Oidor Lozano <ozzymauricio75@gmail.com>
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
        $vistaConsulta = "plazos_pago_proveedores";
        $columnas      = SQL::obtenerColumnas($vistaConsulta);
        $consulta      = SQL::seleccionar(array($vistaConsulta), $columnas, "id = '$url_id'");
        $datos         = SQL::filaEnObjeto($consulta);

        $error         = "";
        $titulo        = $componente->nombre;
        $contenido = "";

        $cuotas = array(
	       "1"	 => "1",
	       "30"	 => "30", 
	       "60"	 => "60", 
	       "90"	 => "90",
	       "120" => "120",
	       "150" => "150",
	       "180" => "180",
	       "210" => "210",
	       "240" => "240",
	       "270" => "270",
	       "300" => "300",
	       "330" => "330",
	       "360" => "360"
        );

	/*** Definici�n de pesta�as ***/
	$formularios["PESTANA_GENERAL"] = array(
	    array(
		HTML::campoTextoCorto("*nombre", $textos["NOMBRE"], 15, 15, $datos->nombre, array("title" => $textos["AYUDA_NOMBRE"], "onBlur" => "validarItem(this);"))
	    ),
	    array(
		HTML::campoTextoCorto("*descripcion", $textos["DESCRIPCION"], 50, 255, $datos->descripcion, array("title" => $textos["AYUDA_DESCRIPCION"]))
	    ),
	    array(            
		HTML::listaSeleccionSimple("*inicial", $textos["INICIAL"], $cuotas, $datos->inicial, array("title" => $textos["AYUDA_INICIAL"], "onchange" => "recargarPlazo();")),
		HTML::listaSeleccionSimple("*final", $textos["FINAL"], $cuotas, $datos->final , array("title" => $textos["AYUDA_FINAL"]))
	    ),
	    array(
		HTML::campoTextoCorto("*periodo", $textos["PERIODO"], 2, 2, $datos->periodo, array("title" => $textos["AYUDA_PERIODO"]))
	    )
	);
	
	/*** Definici�n de botones ***/
        $botones = array(
            HTML::boton("botonAceptar", $textos["ACEPTAR"], "modificarItem('$url_id');", "aceptar")
        );

        $contenido = HTML::generarPestanas($formularios, $botones);
    }

    /*** Enviar datos para la generaci�n del formulario al script que origin� la petici�n ***/
    $respuesta    = array();
    $respuesta[0] = $error;
    $respuesta[1] = $titulo;
    $respuesta[2] = $contenido;
    HTTP::enviarJSON($respuesta);

/*** Validar los datos provenientes del formulario ***/
} elseif (!empty($url_validar)) {
    /*** Validar nombre ***/
    if ($url_item == "nombre") {
        $existe = SQL::existeItem("plazos_pago_provedores", "nombre", $url_valor, "id !='$url_id'");

        if ($existe) {
            HTTP::enviarJSON($textos["ERROR_EXISTE_NOMBRE"]);
        }
    }

/*** Modificar el elemento seleccionado ***/
} elseif (!empty($forma_procesar)) {
    /*** Asumir por defecto que no hubo error ***/
    $error   = false;
    $mensaje = $textos["ITEM_MODIFICADO"];
    
    if (empty($forma_nombre) || empty($forma_descripcion)|| empty($forma_periodo) || ($forma_periodo==0)){
        $error   = true;
        $mensaje = $textos["ERROR_DATOS_INCOMPLETOS"];
    }else {

        $datos = array(
	  "nombre"		=> $forma_nombre,
	  "descripcion"		=> $forma_descripcion,
	  "periodo"		=> $forma_periodo,
	  "inicial"		=> $forma_inicial,
	  "final"		=> $forma_final
        );

        $consulta = SQL::modificar("plazos_pago_proveedores", $datos, "id = '$forma_id'");

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
