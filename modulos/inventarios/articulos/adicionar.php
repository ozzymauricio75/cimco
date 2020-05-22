<?php

/**
*
* Copyright (C) 2020 Raul Mauricio Oidor Lozano
* Raul Mauricio Oidor Lozano <ozzymauricio75@gmail.com>
*
* Este archivo es parte de:
* PANCE :: Software empresarial a la medida
*
* Este programa es software libre: usted puede redistribuirlo y/o
* modificarlo  bajo los términos de la Licencia Pública General GNU
* publicada por la Fundación para el Software Libre, ya sea la versión 3
* de la Licencia, o (a su elección) cualquier versión posterior.
*
* Este programa se distribuye con la esperanza de que sea útil, pero
* SIN GARANTÍA ALGUNA; ni siquiera la garantía implícita MERCANTIL o
* de APTITUD PARA UN PROPÓITO DETERMINADO. Consulte los detalles de
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
    if (($url_item) == "selector3") {
        echo SQL::datosAutoCompletar("seleccion_proveedores", $url_q);
    }
    exit;

}

$tabla = "usuarios";
$columnas                   = SQL::obtenerColumnas($tabla);
$consulta                   = SQL::seleccionar(array($tabla), $columnas, "usuario = '$sesion_usuario'");
$datos                      = SQL::filaEnObjeto($consulta);
$sesion_id_usuario_ingreso  = $datos->id;

if(!empty($url_recargarPais)){
    $id_proveedor = $url_id_proveedor;

    $consulta        = SQL::obtenerValor("proveedores","id_tercero","id = '$id_proveedor'");
    $id_tercero      = $consulta;
    $consulta        = SQL::obtenerValor("terceros","id_municipio_documento","id = '$id_tercero'");
    $id_ciudad       = $consulta;
    $consulta        = SQL::obtenerValor("municipios","id_departamento","id = '$id_ciudad'");
    $id_departamento = $consulta;
    $consulta        = SQL::obtenerValor("departamentos","id_pais","id = '$id_departamento'");
    $id_pais         = $consulta;

    $elementos[0] = $id_pais;
    
    HTTP::enviarJSON($elementos);
    exit;
}

/*** Devolver datos para recargar los elementos del formulario relacionados con el artículo seleccionado ***/
if (isset($url_recargar)) {
    if (!empty($url_id)) {
        if ($url_elemento == 'proveedor') {
            $consulta = SQL::seleccionar(array("proveedores"), array("id_tercero"), "id='$url_id'");
            if (SQL::filasDevueltas($consulta)) {
                $datos           = SQL::filaEnObjeto($consulta);
                $id_tercero_proveedor = $datos->id_tercero;
                //$contado         = $datos->id_forma_pago_contado;
                //$credito         = $datos->id_forma_pago_credito;
                //$iva             = $datos->forma_iva;
                $datos_proveedor = $id_tercero_proveedor;
            }
            HTTP::enviarJSON($datos_proveedor);
            exit;
        }
    }
    //exit;
}    

/*** Generar el formulario para la captura de datos ***/
if (!empty($url_generar)) {

    $genero = array(
        "M" => $textos["MASCULINO"],
        "F" => $textos["FEMENINO"],
        "N" => $textos["NO_APLICA"],
    );
    
    $tipo_inventario = array(
        "1" => $textos["MATERIA_PRIMA"],
        "2" => $textos["SUMINISTRO"]
    );

    $activo= array(
        "0" => $textos["INACTIVO"],
        "1" => $textos["ACTIVO"]
    );

    $error  = "";
    $titulo = $componente->nombre;

    $consulta = SQL::seleccionar(array("terceros"),array("*"),"id > 0 AND proveedor='1'");
    if (SQL::filasDevueltas($consulta)){

        while ($datos = SQL::filaEnObjeto($consulta)) {
            if($datos->tipo_persona==1){
                $nombre_proveedor;
            }    
        }
    
    //$sedes = HTML::generarDatosLista("sedes_clientes", "id", "nombre_sede","id_sucursal IN (".implode(",", $sucursales_sedes).")");
        /*$datos_tercero = SQL::filaEnObjeto($consulta);
        $datos = array(                                                                                                                                                                                                                                                   
            $datos_tercero->primer_nombre,
            $datos_tercero->segundo_nombre,
            $datos_tercero->primer_apellido,
            $datos_tercero->segundo_apellido,
            $datos_tercero->razon_social,
            $datos_tercero->tipo_persona     
        );*/
    }
    if ($datos[5]==1){
        $nombre_proveedor = $datos_tercero[0]." ".$datos_tercero[1]." ".$datos_tercero[2]." ".$datos_tercero[3];
    }elseif ($datos[5]==2){
            $nombre_proveedor = $razon_social;
    }
    
    /*** Obtener lista de sucursales para selección ***/
    /*$tablas     = array(
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

    /*** Verificar si el usuario tiene privilegios en las sucursales autorizadas ***/
    /*if (SQL::filasDevueltas($consulta)) { 
       
        while ($datos = SQL::filaEnObjeto($consulta)) {
            $sucursales[$datos->id] = $datos->nombre;
        }
    }/*
    
    /*** Definición de pestañas general ***/
    $formularios["PESTANA_GENERAL"] = array(
        array(
            HTML::campoTextoCorto("*selector3", $textos["PROVEEDOR"], 40, 255, "", array("title" => $textos["AYUDA_PROVEEDOR"], "class" => "autocompletable"))
            .HTML::campoOculto("id_proveedor", "")
        ),
        array(
            HTML::listaSeleccionSimple("*id_sucursal", $textos["SUCURSAL"],HTML::generarDatosLista("sucursales", "id", "nombre"), "", array("title" => $textos["AYUDA_SUCURSALES"],"onBlur" => "validarItem(this);"))
        ),
        array(
            HTML::campoTextoCorto("*codigo", $textos["CODIGO"], 30, 255, "", array("title" => $textos["AYUDA_CODIGO"],"onBlur" => "validarItem(this);"))
        ),
        array(
            HTML::campoTextoCorto("*detalle", $textos["DETALLE"], 30, 255, "", array("title" => $textos["AYUDA_DETALLE"],"onBlur" => "validarItem(this);"))
        ),
        array(
            HTML::campoTextoCorto("*referencia", $textos["REFERENCIA"], 30, 255, "", array("title" => $textos["AYUDA_REFERENCIA"],"onBlur" => "validarItem(this);"))
        ),
        array(
            HTML::campoTextoCorto("*precio", $textos["COSTO"], 12, 12, "", array("title" => $textos["AYUDA_COSTO"], "class" => "numero", "onblur" => "validarItem(this);"))
        ),
        array(
            HTML::listaSeleccionSimple("*tipo_inventario", $textos["TIPO_INVENTARIO"], $tipo_inventario, "", array("title" => $textos["AYUDA_TIPO_INVENTARIO"]))
        ),
        array(
            HTML::listaSeleccionSimple("*tasa", $textos["TASA_IMPUESTO"], HTML::generarDatosLista("tasas", "id", "descripcion"), "", array("title" => $textos["AYUDA_TASA_IMPUESTO"],"onBlur" => "validarItem(this);"))
        ),
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
    exit();

/*** Adicionar los datos provenientes del formulario ***/
} elseif (!empty($forma_procesar)) {
    /*** Asumir por defecto que no hubo error ***/
    $error   = false;
    $mensaje = $textos["ITEM_ADICIONADO"];

    if(empty($forma_codigo)){
        $error   = true;
        $mensaje = $textos["CODIGO_VACIO"];

    }elseif(empty($forma_detalle)){
        $error   = true;
        $mensaje = $textos["DETALLE_VACIO"];

    }elseif(empty($forma_referencia)){
        $error   = true;
        $mensaje = $textos["DESCRIPCION_VACIO"];  

    }elseif(empty($forma_precio)){
        $error   = true;
        $mensaje = $textos["PRECIO_VACIO"];

    }elseif(empty($forma_tipo_inventario)){
        $error   = true;
        $mensaje = $textos["TIPO_INVENTARIO_VACIO"];     

    }elseif(empty($forma_tasa)){
        $error   = true;
        $mensaje = $textos["TASA_VACIO"];  
    }elseif (empty($forma_id_proveedor)) {
        $error   = true;
        $mensaje = $textos["ERROR_DATOS_INCOMPLETOS"];   
    }else {
        /*** Insertar datos ***/
        $datos = array(
            "id_sucursal"         => $forma_id_sucursal,
            "id_proveedor"        => $forma_id_proveedor,
            "codigo"              => $forma_codigo,
            "detalle"             => $forma_detalle,
            "referencia"          => $forma_referencia,
            "tipo_inventario"     => $forma_tipo_inventario,
            "estado"              => 1,
            "precio"              => $forma_precio,
            "id_tasa"             => $forma_tasa,
            "id_usuario_registra" => $sesion_id_usuario_ingreso,
            "fecha_registra"      => date("Y-m-d H:i:s"),
            "fecha_modificacion"  => date("Y-m-d H:i:s")
        );

        $insertar = SQL::insertar("articulos", $datos);

        /*** Error de inserción ***/
        if (!$insertar) {
            $error   = true;
            $mensaje = $textos["ERROR_ADICIONAR_ITEM"];
        }else{
            $error   = false;
            $mensaje = $textos["ITEM_ADICIONADO"];
        }
    }
    /*** Enviar datos con la respuesta del proceso al script que originó la petición ***/
    $respuesta    = array();
    $respuesta[0] = $error;
    $respuesta[1] = $mensaje;
    HTTP::enviarJSON($respuesta);
}
?>