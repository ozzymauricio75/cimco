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
/*** Devolver datos para autocompletar la búsqueda ***/
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
    $error    = "";
    $titulo   = $componente->nombre;

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
        
		/*** Definición de pestañas general ***/
		$formularios["PESTANA_GENERAL"] = array(
		    array(
		        HTML::campoTextoCorto("*selector1", $textos["CLIENTE"], 40, 255, "", array("title" => $textos["AYUDA_CLIENTE"], "class" => "autocompletable")).HTML::campoOculto("id_cliente", "")
		    ),
		    array(
		         HTML::campoTextoCorto("*nombre_sede", $textos["NOMBRE_SEDE"], 40, 60, "",  array("title" => $textos["AYUDA_NOMBRE_SEDE"],"onBlur" => "validarItem(this);"))
		    ),
		    array(
		        HTML::listaSeleccionSimple("*id_sucursal", $textos["SUCURSAL"], $sucursales, "", array("title" => $textos["AYUDA_SUCURSAL"],"onBlur" => "validarItem(this);"))
		    ),
		    array(
		        HTML::campoTextoCorto("*nombre_contacto", $textos["CONTACTO"], 40, 60, "", array("title" => $textos["AYUDA_CONTACTO"],"onBlur" => "validarItem(this);"))
		    ),
		    array(
		        HTML::listaSeleccionSimple("*id_cargo", $textos["CARGO"], HTML::generarDatosLista("cargos", "id", "nombre"), "", array("title" => $textos["AYUDA_CARGO"],"onBlur" => "validarItem(this);")),
		        HTML::campoTextoCorto("*selector2", $textos["MUNICIPIO"], 40, 255, "", array("title" => $textos["AYUDA_MUNICIPIO"], "class" => "autocompletable")).HTML::campoOculto("id_municipio", "")
		    ),
		    array(
		        HTML::campoTextoCorto("*direccion", $textos["DIRECCION"], 40, 50, "", array("title" => $textos["AYUDA_DIRECCION"],"onBlur" => "validarItem(this);"))
		    ),
		    array(
		        HTML::campoTextoCorto("*telefono_principal", $textos["TELEFONO_PRINCIPAL"], 15, 15, "", array("title" => $textos["AYUDA_TELEFONO_PRINCIPAL"],"onBlur" => "validarItem(this);")),
		        HTML::campoTextoCorto("celular", $textos["CELULAR"], 15, 15, "", array("title" => $textos["AYUDA_CELULAR"],"onBlur" => "validarItem(this);"))
		    ),
		    array(
		        HTML::campoTextoCorto("correo", $textos["CORREO_ELECTRONICO"], 40, 100, "", array("title" => $textos["AYUDA_CORREO"],"onBlur" => "validarItem(this);"))
		    )
		);

		/*** Definicion de botones ***/
		$botones = array(
		    HTML::boton("botonAceptar", $textos["ACEPTAR"], "adicionarItem();", "aceptar")
		);

		$contenido = HTML::generarPestanas($formularios, $botones);
	} else {
        $error      = $textos["ERROR_PRIVILEGIOS_USUARIO"];
        $titulo     = "";
        $contenido  = "";
	}

    /*** Enviar datos para la generacion del formulario al script que origino la peticion ***/
    $respuesta[0] = $error;
    $respuesta[1] = $titulo;
    $respuesta[2] = $contenido;
    HTTP::enviarJSON($respuesta);

/*** Validar los datos provenientes del formulario ***/
} elseif (!empty($url_validar)) {

    $respuesta = "";
    
    /*** Validar nombre de la sede***/
    if ($url_item == "nombre_sede" && $url_valor) {
        $existe = SQL::existeItem("sedes_clientes", "nombre_sede", $url_valor);

        if ($existe) {
            $respuesta = $textos["ERROR_EXISTE_NOMBRE"];
        }
    }
    
    HTTP::enviarJSON($respuesta);

/*** Adicionar los datos provenientes del formulario ***/
} elseif (!empty($forma_procesar)) {

    /*** Asumir por defecto que no hubo error ***/
    $error   = false;
    $mensaje = $textos["ITEM_ADICIONADO"];

    /*** Validar el ingreso de los datos requeridos ***/
    if (empty($forma_id_cliente) ||
        empty($forma_nombre_sede) ||
        empty($forma_id_sucursal) ||
        empty($forma_nombre_contacto) ||
        empty($forma_id_cargo) ||
        empty($forma_id_municipio) ||
        empty($forma_direccion) ||
        empty($forma_telefono_principal)
       ){
        $error   = true;
        $mensaje = $textos["ERROR_DATOS_INCOMPLETOS"];

    } elseif (SQL::existeItem("sedes_clientes", "nombre_sede", $forma_nombre_sede, "nombre_sede = '$forma_nombre_sede'")) {
        $error   = true;
        $mensaje =  $textos["ERROR_EXISTE_SEDE"];
    
    } else {
        $datos = array(
            "id_cliente"         => $forma_id_cliente,
            "nombre_sede"        => $forma_nombre_sede,
            "id_sucursal"        => $forma_id_sucursal,
            "nombre_contacto"    => $forma_nombre_contacto,
            "id_cargo"           => $forma_id_cargo,  
            "id_municipios"      => $forma_id_municipio,
            "direccion"          => $forma_direccion,
            "telefono_principal" => $forma_telefono_principal,
            "celular"            => $forma_celular,
            "correo"             => $forma_correo
        );

        $insertar = SQL::insertar("sedes_clientes", $datos);

        /*** Error de insercion ***/
        if (!$insertar) {
            $error   = true;
            $mensaje = $textos["ERROR_ADICIONAR_ITEM"];
        }
    }    

    /*** Enviar datos con la respuesta del proceso al script que origin? la petici?n ***/
    $respuesta    = array();
    $respuesta[0] = $error;
    $respuesta[1] = $mensaje;
    HTTP::enviarJSON($respuesta);
}
?>
