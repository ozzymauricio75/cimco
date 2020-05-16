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

/*** Generar el formulario para la captura de datos ***/
if (!empty($url_generar)) {

    $tipo_solicitud = array(
        "M" => $textos["MANTENIMIENTO"],
        "E" => $textos["EMERGENCIA"],
        "S" => $textos["SERVICIO"],
        "P" => $textos["PROYECTO"],
        "V" => $textos["VISITA"] 
    );
    
    $estado = array(
        "1" => $textos["NO_NOTIFICADO"],
        "2" => $textos["NOTIFICADO"]
    );
    
    /*** Verificar que se haya enviado el ID del elemento a modificar ***/
    if (empty($url_id)) {
        $error     = $textos["ERROR_MODIFICAR_VACIO"];
        $titulo    = "";
        $contenido = "";

    } else {
        $vistaConsulta      = "requerimientos_clientes";
        $condicion          = "id = '$url_id'";
        $columnas           = SQL::obtenerColumnas($vistaConsulta);
        $consulta           = SQL::seleccionar(array($vistaConsulta), $columnas, $condicion);
        $datos              = SQL::filaEnObjeto($consulta);
        $error              = "";
        $titulo             = $componente->nombre;
        
		/*** Obtener lista de sucursales para selección ***/
		$tablas     = array(
		    "a" => "perfiles_usuario",
		    "b" => "componentes_usuario",
		    "c" => "sucursales"
		);

		$columnas_sucursales = array(
		    "id"        => "c.id",
		    "nombre"    => "c.nombre_corto"
		);

		$condicion_sucursales = "c.id = a.id_sucursal AND a.id = b.id_perfil
		              AND a.id_usuario = '$sesion_id_usuario'
		              AND b.id_componente = '".$componente->id."'";

		$consulta_sucursales = SQL::seleccionar($tablas, $columnas_sucursales, $condicion_sucursales);

		/*** Verificar si el usuario tiene privilegios en las sucursales autorizadas para generar ordenes de compra ***/
		if (SQL::filasDevueltas($consulta_sucursales)) {

		    while ($datos_sucursales = SQL::filaEnObjeto($consulta_sucursales)) {
		        $sucursales[$datos_sucursales->id] = $datos_sucursales->nombre;
		        $sucursales_sedes[$datos_sucursales->id] = $datos_sucursales->id;
		    }
		
            $sedes = HTML::generarDatosLista("sedes_clientes", "id", "nombre_sede","id_sucursal IN (".implode(",", $sucursales_sedes).")");    
		
			if($sedes){
				/*** Definición de pestañas general ***/
				$formularios["PESTANA_GENERAL"] = array(
				    array(
				        HTML::listaSeleccionSimple("*id_sede", $textos["SEDE"], $sedes, $datos->id_sede, array("title" => $textos["AYUDA_SEDE"], "onchange" => "cargarConsorciado()"))
				    ),
				    array(
				        HTML::listaSeleccionSimple("*id_sucursal", $textos["SUCURSAL"], $sucursales, $datos->id_sucursal, array("title" => $textos["AYUDA_SUCURSAL"])),
				        HTML::campoTextoCorto("fecha_limite_visita", $textos["FECHA_LIMITE_VISITA"], 10, 10, substr($datos->fecha_limite_visita, 0, 10), array("class" => "selectorFecha"), array("title" => $textos["AYUDA_FECHA_LIMITE_VISITA"],"onBlur" => "validarItem(this);")),
				    ),
				    array(
				        HTML::listaSeleccionSimple("*tipo_solicitud", $textos["TIPO_SOLICITUD"], $tipo_solicitud, $datos->tipo_solicitud, array("title" => $textos["AYUDA_TIPO_SOLICITUD"],"onBlur" => "validarItem(this);")),
				        HTML::campoTextoCorto("fecha_ingreso", $textos["FECHA_INGRESO"], 10, 10, substr($datos->fecha_ingreso, 0, 10), array("class" => "selectorFecha"), array("title" => $textos["AYUDA_FECHA_INGRESO"],"onBlur" => "validarItem(this);")),
				        HTML::campoTextoCorto("codigo_contable", $textos["CODIGO_CONTABLE"], 15, 15, $datos->codigo_contable, array("title" => $textos["AYUDA_CODIGO_CONTABLE"]))
				    ),
				    array(
				        HTML::campoTextoLargo("*descripcion", $textos["DESCRIPCION"], 10, 60, $datos->descripcion, array("title" => $textos["AYUDA_DESCRIPCION"],"onBlur" => "validarItem(this);"))
				    ),
				    array(
					    HTML::campoTextoCorto("observaciones", $textos["OBSERVACIONES"], 60, 255, $datos->observaciones, array("title" => $textos["AYUDA_OBSERVACIONES"]))
				    )
				);

				$formularios["PESTANA_CONTACTO"] = array(
				    array(
				        HTML::campoTextoCorto("nombre_contacto", $textos["CONTACTO"], 40, 255, $datos->nombre_contacto, array("title" => $textos["AYUDA_CONTACTO"]))
				    ),
				    array(
				        HTML::campoTextoCorto("telefono_contacto", $textos["TELEFONO_CONTACTO"], 15, 255, $datos->telefono_contacto, array("title" => $textos["AYUDA_TELEFONO_CONTACTO"]))
				    ),
				    array(
				        HTML::campoTextoCorto("persona_recibe", $textos["PERSONA_RECIBE"], 40, 255, $datos->persona_recibe, array("title" => $textos["AYUDA_PERSONA_RECIBE"]))
				    ),
				    array(
				        HTML::campoTextoCorto("medio_recibo", $textos["MEDIO_RECIBO"], 40, 255, $datos->medio_recibo, array("title" => $textos["AYUDA_MEDIO_RECIBO"]))
				    )
				);
				/*** Definición de botones ***/
				$botones = array(
				    HTML::boton("botonAceptar", $textos["ACEPTAR"], "modificarItem('$url_id');", "aceptar")
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
 
    
    $datos = array(
            "id_sede"               => $forma_id_sede,
            "tipo_solicitud"        => $forma_tipo_solicitud,
            "fecha_ingreso"         => $forma_fecha_ingreso,
            "fecha_limite_visita"   => $forma_fecha_limite_visita,
            "descripcion"           => $forma_descripcion,
            "id_sucursal"           => $forma_id_sucursal,
            "observaciones"         => $forma_observaciones,
            "nombre_contacto"       => $forma_nombre_contacto,
            "telefono_contacto"     => $forma_telefono_contacto,
            "persona_recibe"        => $forma_persona_recibe,
            "medio_recibo"          => $forma_medio_recibo,
            "codigo_contable"       => $forma_codigo_contable
        );
    $consulta = SQL::modificar("requerimientos_clientes", $datos, "id = '$forma_id'");

    if ($consulta) {
        $error   = false;
        $mensaje = $textos["ITEM_MODIFICADO"];
    
    } else {
        $error   = true;
        $mensaje = $textos["ERROR_MODIFICAR_ITEM"];
    }
    
    
    /*** Enviar datos con la respuesta del proceso al script que originó la petición ***/
    $respuesta    = array();
    $respuesta[0] = $error;
    $respuesta[1] = $mensaje;
    HTTP::enviarJSON($respuesta);
}
?>
