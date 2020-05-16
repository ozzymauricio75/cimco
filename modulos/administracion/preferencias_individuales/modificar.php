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

        $error         = "";
        $idActual      = $componente->id;
        $titulo        = $componente->nombre;

	    $vector_variables = array();
	    $vector_variables[] = "impuesto";
      
	    foreach($vector_variables AS $id_vector){

            $consulta = SQL::obtenerValor("preferencias","valor",
				      "usuario = '$url_id' AND tipo = '2' AND variable LIKE '$id_vector'");

		    $nombre_usuario = SQL::obtenerValor("usuarios","usuario","id = '$url_id'");
        $valor = $consulta;

		    if($valor){
		        $id_preferencia = $valor;
		    }else{
		        $id_preferencia = 0;
		    }
	  
		    $nombre_preferencia = $id_vector;
		    $texto_preferencia = strtoupper($id_vector);

		    $texto = explode("_",$nombre_preferencia);
		    $cadena_texto = $texto[0];

		    if(stristr($cadena_texto,"tipo")==true)
			    $lista = $tipo_articulo;

		    if(stristr($cadena_texto,"unidad")==true)
			    $lista = $unidades;

		    $preferencias[] = array(
		        HTML::campoTextoCorto("usuario", $textos["USUARIO"], 5, 5, $nombre_usuario, array("readOnly" => "true")),
		        HTML::campoTextoCorto($nombre_preferencia, $textos[$texto_preferencia], 5, 5, $id_preferencia)
		    );
        }
        $formularios["PREFERENCIA_USUARIO"] = array();
	      $formularios["PREFERENCIA_USUARIO"] = array_merge($formularios["PREFERENCIA_USUARIO"], $preferencias);

        /*** Definición de botones ***/
        $botones = array(
            HTML::boton("botonAceptar", $textos["ACEPTAR"], "modificarItem('$url_id');", "aceptar")
        );

        $componente = new Componente($idActual);
        $contenido  = HTML::generarPestanas($formularios, $botones);
    }

    /*** Enviar datos para la generación del formulario al script que originó la petición ***/
    $respuesta    = array();
    $respuesta[0] = $error;
    $respuesta[1] = $titulo;
    $respuesta[2] = $contenido;
    HTTP::enviarJSON($respuesta);
/*** Modificar el elemento seleccionado ***/
} elseif (!empty($forma_procesar)) {

    $id_usuario = $forma_id;
    
    /*** Asumir por defecto que no hubo error ***/
    $error   = false;
    $mensaje = $textos["ITEM_MODIFICADO"];


	$vector_variables = array();
	$vector_variables[] = "impuesto";
      
	$i=0;
	foreach($vector_variables AS $id_vector){

        switch($i){
            case 0: $var = $forma_impuesto;
                break;
	    }
	
	    $datos = array(
            "tipo"      => "2",
			"variable"  => $id_vector,
			"valor"     => $var,
			"usuario"   => $id_usuario
	    );
	    
	    $consulta = SQL::obtenerValor("preferencias","id","usuario = '$id_usuario' AND variable LIKE '$id_vector'");
	    if($consulta){
		    $modificar = SQL::modificar("preferencias", $datos, "usuario = '$id_usuario' AND variable LIKE '$id_vector'");
	    }else{
		    $insertar = SQL::insertar("preferencias", $datos);
	    }
	    $i++;
	}	
	$preferencias_individuales = array();
	foreach($vector_variables AS $id_preferencias_individuales){
		$consulta = SQL::obtenerValor("preferencias",
			      "valor","usuario = '$id_usuario' AND tipo = '2' AND variable LIKE '$id_preferencias_individuales'");
		$valor = $consulta;
		if($valor){
            $valor_preferencia_individual = $valor;
		}else{
		    $valor_preferencia_individual = 0;
		}
  
		$preferencias_individuales[$id_preferencias_individuales] = $valor_preferencia_individual;
	}
	Sesion::registrar("preferencias_individuales", $preferencias_individuales);

    /*** Enviar datos con la respuesta del proceso al script que originó la petición ***/
    $respuesta    = array();
    $respuesta[0] = $error;
    $respuesta[1] = $mensaje;
    HTTP::enviarJSON($respuesta);
}
?>
