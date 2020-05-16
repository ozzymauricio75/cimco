<?php

/**
*
* Copyright (C) 2009 FELINUX Ltda
* Francisco J. Lozano B. <fjlozano@felinux.com.co>
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

/*** Procesar los datos provenientes del formulario ***/
if (isset($forma_botonAceptar)) {

    /*** Validar el ingreso de datos requeridos ***/
    if (empty($forma_usuario) && empty($forma_contrasena)) {
        echo $textos["ERROR_DATOS_INSUFICIENTES"];

    /*** Validar el nombre de usuario y la contrase�a ingresados ***/
    } elseif (SQL::existeItem("usuarios", "usuario", $forma_usuario, "contrasena = MD5('$forma_contrasena')")) {
        
        $columnas = array(
            "cambiar_contrasena",
            "fecha_cambio_contrasena",
            "cambio_contrasena_minimo",
            "cambio_contrasena_maximo",
            "fecha_expiracion",
            "activo"
        );

        /*** Obtener datos adicionales del usuario para validar su ingreso ***/
        $consulta = SQL::seleccionar(array("usuarios"), $columnas, "usuario = '$forma_usuario'");
        $datos    = SQL::filaEnObjeto($consulta);

        /*** Verificar si el usuario se encuentra activo ***/
        if (!$datos->activo) {
            echo $textos["ERROR_USUARIO_INACTIVO"];

        /*** Validar la fecha de expiraci�n del usuario ***/
        } elseif ($datos->fecha_expiracion && ($datos->fecha_expiracion <= date("Y-m-d H:i:s"))) {
            echo $textos["ERROR_USUARIO_EXPIRADO"];

        /*** El usuario puede acceder ***/
        } else {
            Sesion::registrar("usuario", $forma_usuario);
            Sesion::registrar("contrasena", md5($forma_contrasena));
            Sesion::registrar("sucursal", $forma_sucursal);
            Sesion::registrar("cliente", HTTP::$cliente);

            $usuario = SQL::obtenerValor("usuarios", "id", "usuario = '$forma_usuario'");            
            $perfil  = SQL::obtenerValor("perfiles_usuario", "id", "id_sucursal = '$forma_sucursal' AND id_usuario = '$usuario'");

            $datos   = array(
                "fecha"      => date("Y-m-d H:i:s"),
                "id_usuario" => $usuario,
                "ip"         => HTTP::$cliente,
                "proxy"      => HTTP::$proxy
            );

            $insertar = SQL::insertar("conexiones", $datos);
            $conexion = SQL::$ultimoId;

            Sesion::registrar("perfil", $perfil);
            Sesion::registrar("id_usuario", $usuario);
            Sesion::registrar("conexion", $conexion);
            Sesion::registrar("menu", HTML::arbolComponentes());
            
            $vector_variables = array();
            $vector_variables[] = "impuesto";

            $preferencias_individuales = array();
            foreach($vector_variables AS $id_preferencias_individuales){
                $consulta = SQL::obtenerValor("preferencias",
                      "valor","usuario = '$usuario' AND tipo = '2' AND variable LIKE '$id_preferencias_individuales'");
                $valor = $consulta;
                if($valor){
                    $valor_preferencia_individual = $valor;
                }else{
                    $valor_preferencia_individual = 0;
                }

                $preferencias_individuales[$id_preferencias_individuales] = $valor_preferencia_individual;

            }
            Sesion::registrar("preferencias_individuales", $preferencias_individuales);

            $vector_variables_2 = array();
            $vector_variables_2[] = "pais";

            $preferencias_globales = array();
            foreach($vector_variables_2 AS $id_preferencias_globales){
                $consulta = SQL::obtenerValor("preferencias",
                      "valor","sucursal = '$forma_sucursal' AND tipo = '1' AND variable LIKE '$id_preferencias_globales'");
                $valor = $consulta;
                if($valor){
                    $valor_preferencia_global = $valor;
                }else{
                    $valor_preferencia_global = 0;
                }
                $preferencias_globales[$id_preferencias_globales] = $valor_preferencia_global;
            }
            Sesion::registrar("preferencias_globales", $preferencias_globales);


            setcookie("usuario_maquina", $forma_usuario, time() + 31536000);
            setcookie("sede_maquina", $forma_sucursal, time() + 31536000);
        }

    /*** El nombre de usuario y la contrase�a ingresados son incorrectos ***/
    } else {
        echo $textos["ERROR_USUARIO_CONTRASENA"];
    }

/*** Generar el formulario ***/
} else {
    $sucursales  = HTML::generarDatosLista("sucursales", "id", "nombre");
    $formulario  = HTML::campoOculto("URL1", HTTP::generarURL($datosGlobales["componenteInicioSesion"]));
    $formulario .= HTML::campoOculto("URL2", HTTP::generarURL($datosGlobales["componentePaginaInicio"]));

    $filas = array(
        array(
            HTML::campoTextoCorto("usuario", $textos["USUARIO"], 12, 12),
        ),
        array(
            HTML::campoTextoClave("contrasena", $textos["CONTRASENA"], 12, 12)
        ),
        array(
            HTML::listaSeleccionSimple("sucursal", $textos["SUCURSAL"], $sucursales, "", array("title" => $textos["AYUDA_SUCURSAL"]))
        )
    );

    foreach ($filas as $fila) {
        $formulario .= HTML::filaFormulario($fila);
    }

    $botones  = HTML::boton("botonRestaurar", $textos["RESTAURAR"], "restaurarFormulario();", "restaurar");
    $botones .= HTML::boton("botonAceptar", $textos["ACEPTAR"], "procesarFormulario();", "aceptar");

    $formulario .= HTML::filaFormulario(array($botones), "C");
    $formulario  = HTML::formulario(HTTP::generarURL($componente->id),"POST",$formulario,"formularioPrincipal");
    $formulario  = HTML::contenedor($formulario, array("id" => "inicioSesion"));



    Plantilla::iniciar();
    Plantilla::sustituir("menu");
    Plantilla::sustituir("buscador");
    Plantilla::sustituir("botones");
    Plantilla::sustituir("paginador");
    Plantilla::sustituir("registros");
    Plantilla::sustituir("mensaje");
    Plantilla::sustituir("registros");
    Plantilla::sustituir("bloqueDerecho");
    Plantilla::sustituir("bloqueIzquierdo", $formulario);
    Plantilla::sustituir("cuadroDialogo");
    Plantilla::enviarCodigo();
}

?>
