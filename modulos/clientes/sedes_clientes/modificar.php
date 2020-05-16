<?php

/**
*
* Copyright (C) 2009 FELINUX Ltda
* Francisco J. Lozano B. <fjlozano@felinux.com.co>
* Mauricio Oidor L. <ozzymauricio75@gmail.com>
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
if (isset($url_completar)) {

    if (($url_item) == "selector1") {
        echo SQL::datosAutoCompletar("seleccion_clientes", $url_q);
    }
    if (($url_item) == "selector2") {
        echo SQL::datosAutoCompletar("seleccion_municipios", $url_q);
    }
    exit;
}
/*** Generar el formulario para la captura de datos ***/
if (!empty($url_generar)) {

    /*** Verificar que se haya enviado el ID del elemento a modificar ***/
    if (empty($url_id)) {
        $error     = $textos["ERROR_MODIFICAR_VACIO"];
        $titulo    = "";
        $contenido = "";

    } else {
		/*** Obtener lista de sucursales para selección ***/
		$tablas     = array(
		    "a" => "perfiles_usuario",
		    "b" => "componentes_usuario",
		    "c" => "sucursales"
		);

		$columnas = array(
		    "id"        => "c.id",
		    "nombre"    => "c.nombre_corto"
		);

		$condicion = "c.id = a.id_sucursal AND a.id = b.id_perfil
		              AND a.id_usuario = '$sesion_id_usuario'
		              AND b.id_componente = '".$componente->id."'";

		$consulta = SQL::seleccionar($tablas, $columnas, $condicion);

		/*** Verificar si el usuario tiene privilegios en las sucursales autorizadas para generar ordenes de compra ***/
		if (SQL::filasDevueltas($consulta)) { 
		   
			while ($datos = SQL::filaEnObjeto($consulta)) {
		        $sucursales[$datos->id] = $datos->nombre;
		    }
		    
		    $vistaConsulta = "sedes_clientes";
		    $condicion     = "id = '$url_id'";
		    $columnas      = SQL::obtenerColumnas($vistaConsulta);
		    $consulta      = SQL::seleccionar(array($vistaConsulta), $columnas, $condicion);
		    $datos         = SQL::filaEnObjeto($consulta);
		    $error         = "";
		    $titulo        = $componente->nombre;
		    
		    $tercero = SQL::obtenervalor("seleccion_clientes","nombre","id = '$datos->id_cliente'");
		    $tercero = explode("|", $tercero);
		    $tercero = $tercero[0];

		    $municipio = SQL::obtenervalor("seleccion_municipios","nombre","id = '$datos->id_municipios'");
		    $municipio = explode("|", $municipio);
		    $municipio = $municipio[0];

		    /*** Definición de pestañas ***/
		    $formularios["PESTANA_GENERAL"] = array(
		        array(    
		            HTML::campoTextoCorto("*selector1", $textos["CLIENTE"], 40, 255, $tercero, array("title" => $textos["AYUDA_CLIENTE"], "class" => "autocompletable")).HTML::campoOculto("id_cliente", $datos->id_cliente)
		        ),
		        array(
		            HTML::listaSeleccionSimple("*id_sucursal", $textos["SUCURSAL"], $sucursales, SQL::obtenerValor("sedes_clientes", "id_sucursal", $condicion), array("title" => $textos["AYUDA_SUCURSAL"]))
		        ),
		        array(
		            HTML::campoTextoCorto("*nombre_sede", $textos["NOMBRE_SEDE"], 40, 255, $datos->nombre_sede, array("title" => $textos["AYUDA_SEDE"]))
		        ),
		        array(
		            HTML::campoTextoCorto("*selector2", $textos["MUNICIPIO"], 40, 255, $municipio, array("title" => $textos["AYUDA_CLIENTE"], "class" => "autocompletable")).HTML::campoOculto("id_municipio", $datos->id_municipios)
		        ),
		        array(
		             HTML::campoTextoCorto("*direccion", $textos["DIRECCION"], 40, 50, $datos->direccion, array("title" => $textos["AYUDA_DIRECCION"])),
		        ),
		        array(
		             HTML::campoTextoCorto("*nombre_contacto", $textos["CONTACTO"], 40, 255, $datos->nombre_contacto, array("title" => $textos["AYUDA_CONTACTO"])),
		             HTML::listaSeleccionSimple("*id_cargo", $textos["CARGO"], HTML::generarDatosLista("cargos", "id", "nombre"), SQL::obtenerValor("sedes_clientes", "id_cargo", $condicion), array("title" => $textos["AYUDA_CARGO"]))
		        ),
		        array(
		            HTML::campoTextoCorto("*telefono_principal", $textos["TELEFONO_PRINCIPAL"], 15, 15, $datos->telefono_principal, array("title" => $textos["AYUDA_TELEFONO_PRINCIPAL"])),
		            HTML::campoTextoCorto("celular", $textos["CELULAR"], 15, 15, $datos->celular, array("title" => $textos["AYUDA_CELULAR"]))
		        ),
		        array(
		            HTML::campoTextoCorto("correo", $textos["CORREO_ELECTRONICO"], 40, 100, $datos->correo, array("title" => $textos["AYUDA_CORREO"]))
		        )
		    );

		    /*** Definición de botones ***/
		    $botones = array(
		        HTML::boton("botonAceptar", $textos["ACEPTAR"], "modificarItem('$url_id');", "aceptar")
		    );

		    $contenido = HTML::generarPestanas($formularios, $botones);
		} else {
		    $error      = $textos["ERROR_PRIVILEGIOS_USUARIO"];
		    $titulo     = "";
		    $contenido  = "";
        }
	}

    /*** Enviar datos para la generación del formulario al script que originó la petición ***/
    $respuesta    = array();
    $respuesta[0] = $error;
    $respuesta[1] = $titulo;
    $respuesta[2] = $contenido;
    HTTP::enviarJSON($respuesta);

/*** Modificar el elemento seleccionado ***/
} elseif (!empty($forma_procesar)) {

    /*** Asumir por defecto que no hubo error ***/
    $error   = false;
    $mensaje = $textos["ITEM_MODIFICADO"];

    /*** Validar el ingreso de los datos requeridos ***/
    if (empty($forma_id_cliente) ||
        empty($forma_nombre_contacto) ||
        empty($forma_nombre_sede) ||
        empty($forma_id_cargo) ||
        empty($forma_id_municipio) ||
        empty($forma_direccion) ||
        empty($forma_telefono_principal)) {
        $error   = true;
        $mensaje = $textos["ERROR_DATOS_INCOMPLETOS"];

    } else {

        $datos = array(
            "id_cliente"         => $forma_id_cliente,
            "id_sucursal"        => $forma_id_sucursal,
            "nombre_sede"        => $forma_nombre_sede,
            "nombre_contacto"    => $forma_nombre_contacto,
            "id_cargo"           => $forma_id_cargo,
            "id_municipios"      => $forma_id_municipio,
            "direccion"          => $forma_direccion,
            "telefono_principal" => $forma_telefono_principal,
            "celular"            => $forma_celular,
            "correo"             => $forma_correo
        );

        $consulta = SQL::modificar("sedes_clientes", $datos, "id = '$forma_id'");

        if ($consulta) {
            $error   = false;
            $mensaje = $textos["ITEM_MODIFICADO"];
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
}
?>
