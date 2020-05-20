<?php

/**
*
* Copyright (C) 2020 Raul Mauricio Oidor Lozano
* Raul Mauricio Oidor Lozano <ozzymauricio75@gmail.com>
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

/*** Generar el formulario para la captura de datos ***/
if (!empty($url_generar)) {
    $error  = "";
    $titulo = $componente->nombre;

    $cuotas = array(
        "1"	    => "1",
        "30"	=> "30",
        "60"	=> "60",
        "90"	=> "90",
        "120"	=> "120",
        "150"	=> "150",
        "180"	=> "180",
        "210"	=> "210",
        "240"	=> "240",
        "270"	=> "270",
        "300"	=> "300",
        "330"	=> "330",
        "360"	=> "360"
    );


    /*** Definición de pestañas ***/
    $formularios["PESTANA_GENERAL"] = array(
        array(
            HTML::campoTextoCorto("*nombre", $textos["NOMBRE"], 15, 15, "", array("title" => $textos["AYUDA_NOMBRE"], "onBlur" => "validarItem(this);"))
        ),
	array(
            HTML::campoTextoCorto("*descripcion", $textos["DESCRIPCION"], 50, 255, "", array("title" => $textos["AYUDA_DESCRIPCION"]))
        ),
	array(            
	    HTML::listaSeleccionSimple("*inicial", $textos["INICIAL"], $cuotas, 1, array("title" => $textos["AYUDA_INICIAL"], "onchange" => "recargarPlazo();")),
	    HTML::listaSeleccionSimple("*final", $textos["FINAL"], $cuotas, 1, array("title" => $textos["AYUDA_FINAL"]))
        ),
	array(
            HTML::campoTextoCorto("*periodo", $textos["PERIODO"], 2, 2, "1", array("title" => $textos["AYUDA_PERIODO"]))
        )
    );

    /*** Definición de botones ***/
    $botones = array(
        HTML::boton("botonAceptar", $textos["ACEPTAR"], "adicionarItem();", "aceptar")
    );

    $contenido = HTML::generarPestanas($formularios, $botones);

    /*** Enviar datos para la generación del formulario al script que originó la petición ***/
    $respuesta[0] = $error;
    $respuesta[1] = $titulo;
    $respuesta[2] = $contenido;
    HTTP::enviarJSON($respuesta);

/*** Validar los datos provenientes del formulario ***/
} elseif (!empty($url_validar)) {

    /*** Validar código***/
    if ($url_item == "nombre") {
        $existe = SQL::existeItem("plazos_pago_proveedores", "nombre", $url_valor);
        if ($existe) {
            HTTP::enviarJSON($textos["ERROR_EXISTE_NOMBRE"]);
        }
    }

/*** Adicionar los datos provenientes del formulario ***/
} elseif (!empty($forma_procesar)) {
    /*** Asumir por defecto que no hubo error ***/
    $error   = false;
    $mensaje = $textos["ITEM_ADICIONADO"];
    
    if (empty($forma_nombre) || empty($forma_descripcion) || empty($forma_periodo) || ($forma_periodo==0)){
        $error   = true;
        $mensaje = $textos["ERROR_DATOS_INCOMPLETOS"];
    }else {
        $datos = array(
	  "nombre"		=> $forma_nombre,
	  "descripcion"	=> $forma_descripcion,
	  "periodo"		=> $forma_periodo,
	  "inicial"		=> $forma_inicial,
	  "final"		=> $forma_final
        );
        $insertar = SQL::insertar("plazos_pago_proveedores", $datos);

        /*** Error de inserción ***/
        if (!$insertar) {
            $error   = true;
            $mensaje = $textos["ERROR_ADICIONAR_ITEM"];
        }
    }
          
    /*** Enviar datos con la respuesta del proceso al script que originï¿½ la peticiï¿½n ***/
    $respuesta    = array();
    $respuesta[0] = $error;
    $respuesta[1] = $mensaje;
    HTTP::enviarJSON($respuesta);
}
?>
