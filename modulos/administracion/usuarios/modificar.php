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

/*** Generar el formulario para la captura de datos ***/
if (!empty($url_generar)) {

    /*** Verificar que se haya enviado el ID del elemento a modificar ***/
    if (empty($url_id)) {
        $error     = $textos["ERROR_MODIFICAR_VACIO"];
        $titulo    = "";
        $contenido = "";

    } else {
        $vistaConsulta = "usuarios";
        $condicion     = "id = '$url_id'";
        $columnas      = SQL::obtenerColumnas($vistaConsulta);
        $consulta      = SQL::seleccionar(array($vistaConsulta), $columnas, $condicion);
        $datos         = SQL::filaEnObjeto($consulta);
        $error         = "";
        $titulo        = $componente->nombre;
        $consulta      = SQL::seleccionar(array("imagenes"), array("id","ancho","alto"), "id_asociado = '$url_id' AND categoria = '1'");
        $imagen        = SQL::filaEnObjeto($consulta);

        if ($imagen) {
            $imagen = HTML::imagen(HTTP::generarURL("VISUIMAG")."&id=".$imagen->id, array("width" => $imagen->ancho, "height" => $imagen->alto));
        } else {
            $imagen = "";
        }

        /*** Definición de pestañas ***/
        $formularios["PESTANA_GENERAL"] = array(
            array(
            HTML::campoTextoCorto("*nombre", $textos["NOMBRE"], 30, 50, $datos->nombre, array("title" => $textos["AYUDA_NOMBRE"])).
            HTML::campoOculto("id", $datos->id)
            ),
            array(
                HTML::campoTextoCorto("*correo", $textos["CORREO"], 30, 255, $datos->correo, array("title" => $textos["AYUDA_CORREO"], "onBlur" => "validarItem(this);"))
            ),
            array(
                HTML::campoTextoCorto("*usuario", $textos["USUARIO"], 12, 12, $datos->usuario, array("title" => $textos["AYUDA_USUARIO"], "onBlur" => "validarItem(this);"))
            ),
            array(
                HTML::campoTextoClave("*contrasena1", $textos["CONTRASENA"], 12, 12, "", array("title" => $textos["AYUDA_CONTRASENA1"], "onBlur" => "validarItem(this);"))
            ),
            array(
                HTML::campoTextoClave("*contrasena2", $textos["VERIFICAR_CONTRASENA"], 12, 12, "", array("title" => $textos["AYUDA_CONTRASENA2"], "onBlur" => "validarItem(this);"))
            )
        );

        $formularios["PESTANA_ACCESO"] = array(
            array(
                HTML::marcaChequeo("cambiar_contrasena", $textos["CAMBIAR_CONTRASENA"], 1, $datos->cambiar_contrasena)
            ),
            array(
                HTML::campoTextoCorto("cambio_contrasena_minimo", $textos["CAMBIO_CONTRASENA_MINIMO"], 3, 3, $datos->cambio_contrasena_minimo)
            ),
            array(
                HTML::campoTextoCorto("cambio_contrasena_maximo", $textos["CAMBIO_CONTRASENA_MAXIMO"], 3, 3, $datos->cambio_contrasena_maximo)
            ),
            array(
                HTML::campoTextoCorto("fecha_expiracion", $textos["FECHA_EXPIRACION"], 10, 10, substr($datos->fecha_expiracion, 0, 10), array("class" => "selectorFecha"))
            )
        );

        $formularios["PESTANA_IMAGEN"] = array(
            array(
                HTML::selectorArchivo("imagen", $textos["IMAGEN"], array("title" => $textos["AYUDA_IMAGEN"]))
            ),
            array(
                HTML::mostrarDato("imagen_actual", "", $imagen)
            )
        );

        /*** Definición de botones ***/
        $botones = array(
            HTML::boton("botonAceptar", $textos["ACEPTAR"], "modificarItem('$url_id');", "aceptar")
        );

        $contenido = HTML::generarPestanas($formularios, $botones);
    }

    /*** Enviar datos para la generación del formulario al script que originó la petición ***/
    $respuesta    = array();
    $respuesta[0] = $error;
    $respuesta[1] = $titulo;
    $respuesta[2] = $contenido;
    HTTP::enviarJSON($respuesta);
    exit();

/*** Validar los datos provenientes del formulario ***/
} elseif (!empty($url_validar)) {

    /*** Validar datos ***/
    if ($url_item == "usuario") {
        $existe = SQL::existeItem("usuarios", "usuario", $url_usuario);

        if ($existe) {
            HTTP::enviarJSON($textos["ERROR_EXISTE_USUARIO"]);
        }
    }

    if ($url_item == "correo") {
        $existe = SQL::existeItem("usuarios", "correo", $url_usuario);

        if ($existe) {
            HTTP::enviarJSON($textos["ERROR_EXISTE_CORREO"]);
        }
    }

    exit();

/*** Modificar el elemento seleccionado ***/
}

/*** Validar el ingreso de los datos requeridos ***/
if (empty($forma_usuario) || empty($forma_nombre)) {
    $error   = true;
    $mensaje = $textos["ERROR_DATOS_INCOMPLETOS"];

} elseif (SQL::existeItem("usuarios", "usuario", $forma_usuario, "id != '$forma_id'")) {
    $error   = true;
    $mensaje =  $textos["ERROR_EXISTE_USUARIO"];

} else {

    $datos = array(
        "nombre"                   => $forma_nombre,
        "usuario"                  => $forma_usuario,
        "contrasena"               => md5($forma_contrasena1),
        "correo"                   => $forma_correo,
        "cambiar_contrasena"       => $forma_cambiar_contrasena,
        "cambio_contrasena_minimo" => $forma_cambio_contrasena_minimo,
        "cambio_contrasena_maximo" => $forma_cambio_contrasena_maximo,
        "fecha_expiracion"         => $forma_fecha_expiracion
    );

    $consulta = SQL::modificar("usuarios", $datos, "id = '$forma_id'");

    if ($consulta) {
        $error   = false;
        $mensaje = $textos["ITEM_MODIFICADO"];

        if (!empty($_FILES["imagen"])) {
            $original   = $_FILES["imagen"]["name"];
            $temporal   = $_FILES["imagen"]["tmp_name"];
            $extension  = strtolower(substr($original, (strrpos($original, ".") - strlen($original)) + 1));

            if (strtolower($extension) != "png" && strtolower($extension) != "jpg" && strtolower($extension) != "gif") {
                $error   = true;
                $mensaje = $textos["ERROR_FORMATO_IMAGEN"];

            } else {
                list($ancho, $alto, $tipo) = getimagesize($temporal);

                $datos   = array(
                    "categoria"   => 1,
                    "id_asociado" => $forma_id,
                    "contenido"   => file_get_contents($temporal),
                    "tipo"        => $tipo,
                    "extension"   => $extension,
                    "ancho"       => $ancho,
                    "alto"        => $alto
                );

                $consulta = SQL::eliminar("imagenes", "categoria = '1' AND id_asociado = '$forma_id'");
                $insertar = SQL::insertarArchivo("imagenes", $datos);
            }
        }

    } else {
        $error   = true;
        $mensaje = $textos["ERROR_MODIFICAR_ITEM"];
    }
}

/*** Enviar datos con la respuesta del proceso al script que originó la petición ***/
$respuesta    = array();
$respuesta[0] = $error;
$respuesta[1] = $mensaje;
HTTP::enviarJSON($respuesta);
?>