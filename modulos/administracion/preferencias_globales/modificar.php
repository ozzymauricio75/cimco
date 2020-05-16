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

        $paises = HTML::generarDatosLista("paises", "id", "nombre");
	    
    	$vector_variables = array();
        $vector_variables[] = "pais";

      	foreach($vector_variables AS $id_vector){

		$consulta = SQL::obtenerValor("preferencias",
				      "valor",
				      "sucursal = '$url_id' AND tipo = '1' AND variable LIKE '$id_vector'");
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

		  if(stristr($nombre_preferencia,"pais")==true)
			  $lista = $paises;


		  $preferencias[] = array(
		       HTML::listaSeleccionSimple($nombre_preferencia, $textos[$texto_preferencia], $lista, $id_preferencia)
		  );
	   }

        $formularios["PESTANA_ARTICULOS"] = array();
        $formularios["PESTANA_ARTICULOS"] = array_merge($formularios["PESTANA_ARTICULOS"], $preferencias);

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

    /*** Asumir por defecto que no hubo error ***/
    $error   = false;
    $mensaje = $textos["ITEM_MODIFICADO"];

	$id_sucursal = $forma_id;


	$vector_variables = array();
	$vector_variables[] = "pais";

	$i=0;
	foreach($vector_variables AS $id_vector){
        switch($i){
		  case 0: $var = $forma_pais;
			  break;		  
	    }
	
        $datos = array(
            "tipo"      => "1",
		    "variable"  => $id_vector,
		    "valor"     => $var,
		    "sucursal"  => $id_sucursal
	    );
	    
	    $consulta = SQL::obtenerValor("preferencias","id","sucursal = '$id_sucursal' AND variable LIKE '$id_vector'");
	    if($consulta){
		    $modificar = SQL::modificar("preferencias", $datos, "sucursal = '$id_sucursal' AND variable LIKE '$id_vector'");
	    }else{
		    $insertar = SQL::insertar("preferencias", $datos);
	    }
	    $i++;
	}	
	
	$preferencias_globales = array();
	foreach($vector_variables AS $id_preferencias_globales){
        $consulta = SQL::obtenerValor("preferencias",
				      "valor","sucursal = '$id_sucursal' AND tipo = '1' AND variable LIKE '$id_preferencias_globales'");
        $valor = $consulta;
		if($valor){
            $valor_preferencia_global = $valor;
		}else{
		    $valor_preferencia_global = 0;
		}
		$preferencias_globales[$id_preferencias_globales] = $valor_preferencia_global;
	}
	Sesion::registrar("preferencias_globales", $preferencias_globales);
       

    /*** Enviar datos con la respuesta del proceso al script que originó la petición ***/
    $respuesta    = array();
    $respuesta[0] = $error;
    $respuesta[1] = $mensaje;
    HTTP::enviarJSON($respuesta);
}
?>