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
if (isset($url_recargar)) {

    if (!empty($url_id_carga)) {
    
        $consulta = SQL::seleccionar(array("sedes_clientes"), array("*"), "id = '$url_id_carga'", "", "id_sucursal", 1);
        $tabla    = array();
        if (SQL::filasDevueltas($consulta)) {
            $datos = SQL::filaEnObjeto($consulta);
            $tabla = array(
                $datos->id_sucursal,
                $datos->nombre_contacto
            );            
        } else {
            $tabla[] = "";
        }
        HTTP::enviarJSON($tabla);
    }
    exit;
}
/*** Generar el formulario para la captura de datos ***/
if (!empty($url_generar)) {
    $error      = "";
    $titulo     = $componente->nombre;

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
                  AND b.id_componente = '$componente->id'";

    $consulta = SQL::seleccionar($tablas, $columnas, $condicion);

    /*** Verificar si el usuario tiene privilegios en las sucursales autorizadas para generar ordenes de compra ***/
    if (SQL::filasDevueltas($consulta)) {

        while ($datos = SQL::filaEnObjeto($consulta)) {
            $sucursales[$datos->id] = $datos->nombre;
            $sucursales_sedes[$datos->id] = $datos->id;
        }
    
		$sedes = HTML::generarDatosLista("sedes_clientes", "id", "nombre_sede","id_sucursal IN (".implode(",", $sucursales_sedes).")");    
		
		if($sedes){
    
			$datos_sedes = SQL::seleccionar(array("sedes_clientes"), array("*"), "", "", "",1,0);
			if (SQL::filasDevueltas($datos_sedes)) {
				$datos               = SQL::filaEnObjeto($datos_sedes);
				$id_sede             = $datos->id;
				$id_sucursal_inicial = $datos->id_sucursal;
				$nombre_contacto     = $datos->nombre_contacto;
			}
		
			$tipo_solicitud = array(
				"M" => $textos["MANTENIMIENTO"],
				"E" => $textos["EMERGENCIA"],
				"S" => $textos["SERVICIO"],
				"P" => $textos["PROYECTO"],
				"V" => $textos["VISITA"]
			);
		
			   
			/*** Definición de pestañas general ***/
			$formularios["PESTANA_GENERAL"] = array(
				array(
				    HTML::listaSeleccionSimple("*id_sede", $textos["SEDE"], $sedes, $id_sede, array("title" => $textos["AYUDA_SEDE"], "onchange" => "cargarConsorciado()"))            
				),
				array(
				    HTML::listaSeleccionSimple("*id_sucursal", $textos["SUCURSAL"], $sucursales, $id_sucursal_inicial, array("title" => $textos["AYUDA_SUCURSAL"])),
				    HTML::campoTextoCorto("fecha_limite_visita", $textos["FECHA_LIMITE_VISITA"], 10, 10, date("Y-m-d"), array("class" => "selectorFecha"), array("title" => $textos["AYUDA_FECHA_LIMITE_VISITA"],"onBlur" => "validarItem(this);")),
				),
				array(    
				    HTML::listaSeleccionSimple("*tipo_solicitud", $textos["TIPO_SOLICITUD"], $tipo_solicitud, "", array("title" => $textos["AYUDA_TIPO_SOLICITUD"],"onBlur" => "validarItem(this);")),
				    HTML::campoTextoCorto("fecha_ingreso", $textos["FECHA_INGRESO"], 10, 10, date("Y-m-d"), array("class" => "selectorFecha"), array("title" => $textos["AYUDA_FECHA_INGRESO"],"onBlur" => "validarItem(this);")),
				HTML::campoTextoCorto("codigo_contable", $textos["CODIGO_CONTABLE"], 15, 15, "", array("title" => $textos["AYUDA_CODIGO_CONTABLE"],"onBlur" => "validarItem(this);"))
				),
				array(
				    HTML::campoTextoLargo("*descripcion", $textos["DESCRIPCION"], 10, 60, "", array("title" => $textos["AYUDA_DESCRIPCION"],"onBlur" => "validarItem(this);"))
				),
				array(
				HTML::campoTextoCorto("observaciones", $textos["OBSERVACIONES"], 60, 255, "", array("title" => $textos["AYUDA_OBSERVACIONES"]))
				)
			);

			/*** Definición de pestañas general ***/
			$formularios["PESTANA_CONTACTO"] = array(
				array(
				    HTML::campoTextoCorto("nombre_contacto", $textos["CONTACTO"], 40, 255, $nombre_contacto, array("title" => $textos["AYUDA_CONTACTO"]))
				),
				array(
				    HTML::campoTextoCorto("telefono_contacto", $textos["TELEFONO_CONTACTO"], 15, 255, "", array("title" => $textos["AYUDA_TELEFONO_CONTACTO"]))
				),
				array(
				    HTML::campoTextoCorto("persona_recibe", $textos["PERSONA_RECIBE"], 40, 255, "", array("title" => $textos["AYUDA_PERSONA_RECIBE"]))
				),
				array(
				    HTML::campoTextoCorto("medio_recibo", $textos["MEDIO_RECIBO"], 40, 255, "", array("title" => $textos["AYUDA_MEDIO_RECIBO"]))
				)        
			);
		  
			/*** Definicion de botones ***/
			$botones = array(
				HTML::boton("botonAceptar", $textos["ACEPTAR"], "adicionarItem();", "aceptar")
			);

			$contenido = HTML::generarPestanas($formularios, $botones);
		} else {
	 		$error      = $textos["ERROR_PRIVILEGIOS_SEDES"];
		    $titulo     = "";
		    $contenido  = "";			
		}
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
    
    /*** Validar codigo del requerimiento***/
    if ($url_item == "id" && $url_valor) {
        $existe = SQL::existeItem("requerimientos_clientes", "id", $url_valor);

        if ($existe) {
            $respuesta = $textos["ERROR_EXISTE_CODIGO"];
        }
    }
    
    HTTP::enviarJSON($respuesta);

/*** Adicionar los datos provenientes del formulario ***/
} elseif (!empty($forma_procesar)) {

    /*** Asumir por defecto que no hubo error ***/
    $error   = false;
    $mensaje = $textos["ITEM_ADICIONADO"];

    /*** Validar el ingreso de los datos requeridos ***/
    if (empty($forma_id_sede) || 
        empty($forma_tipo_solicitud) || 
        empty($forma_fecha_ingreso) || 
        empty($forma_descripcion) || 
        empty($forma_id_sucursal)) {
        $error   = true;
        $mensaje = $textos["ERROR_DATOS_INCOMPLETOS"];
    
    } else {
    
        $forma_fecha_ingreso_sistema = date("Y-m-d H:m:s");            
        $datos = array(
            "id_sede"               => $forma_id_sede,
            "tipo_solicitud"        => $forma_tipo_solicitud,
            "fecha_ingreso"         => $forma_fecha_ingreso,
            "fecha_ingreso_sistema" => $forma_fecha_ingreso_sistema,
            "fecha_limite_visita"   => $forma_fecha_limite_visita,
            "descripcion"           => $forma_descripcion,
            "id_sucursal"           => $forma_id_sucursal,  
            "observaciones"         => $forma_observaciones,
            "nombre_contacto"       => $forma_nombre_contacto,
            "telefono_contacto"     => $forma_telefono_contacto,
            "persona_recibe"        => $forma_persona_recibe,
            "medio_recibo"          => $forma_medio_recibo,
            "codigo_contable"       => $forma_codigo_contable,
            "notificado"            => '0'
        );
    
            $insertar = SQL::insertar("requerimientos_clientes", $datos);
    
            /*** Error de insercion ***/
            if (!$insertar) {
                $error   = true;
                $mensaje = $textos["ERROR_ADICIONAR_ITEM"];
            }
    }    

    /*** Enviar datos con la respuesta del proceso al script que originó la petición ***/
    $respuesta    = array();
    $respuesta[0] = $error;
    $respuesta[1] = $mensaje;
    $respuesta[2] = $mensaje;
    HTTP::enviarJSON($respuesta);
}
?>
