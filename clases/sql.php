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

class SQL {

	public static $servidor;
	public static $usuario;
	public static $contrasena;
	public static $baseDatos;
	public static $prefijoTabla;
	public static $conexion;
	public static $filasPorConsulta;
	public static $ultimoId;

	/*** Tablas excluidas de registro en bitácora, obtención de último ID y otras operaciones ***/
	public static $tablasExcluidas = array(
        "sesiones",
        "bitacora",
        "actualizaciones_almacen",
        "actualizaciones_servidor"
        );

        /*** Abrir una conexión a la base de datos ***/
        public static function abrirConexion($baseDatos = "") {
        	global $accesoBaseDatos;

        	self::$servidor         = $accesoBaseDatos["servidor"];
        	self::$usuario          = $accesoBaseDatos["usuario"];
        	self::$contrasena       = $accesoBaseDatos["contrasena"];
        	self::$baseDatos        = $accesoBaseDatos["nombre"];
        	self::$filasPorConsulta = $accesoBaseDatos["filasPorConsulta"];

        	if (empty($accesoBaseDatos["prefijoTabla"])) {
        		self::$prefijoTabla = "";
        	} else {
        		self::$prefijoTabla = $accesoBaseDatos["prefijoTabla"]."_";
        	}

        	if (empty($baseDatos)) {
        		$baseDatos = self::$baseDatos;
        	}

        	$conexion       = mysql_connect(self::$servidor, self::$usuario, self::$contrasena);
        	$resultado      = mysql_select_db(self::$baseDatos);
        	self::$conexion = $conexion;
        }

        /*** Cerrar una conexión establecida con la base de datos ***/
        public static function cerrarConexion() {
        	$cierre = mysql_close(self::$conexion);
        	return $cierre;
        }

        /*** Ejecutar una consulta en la base de datos ***/
        public static function correrConsulta($consulta) {
        	$resultado = mysql_query($consulta);

        	if (mysql_errno()) {
        		$log = syslog(LOG_ERR, $consulta);
        		$log = syslog(LOG_ERR, mysql_error());
        	}

        	return $resultado;
        }

        /*** Retornar el numero de filas devueltas por la consulta dada ***/
        public static function filasDevueltas($resultado) {
        	$filas = mysql_num_rows($resultado);
        	return $filas;
        }

        /*** Retornar el numero de filas afectadas por la consulta dada ***/
        public static function filasAfectadas() {
        	$filas = mysql_affected_rows(self::$conexion);
        	return $filas;
        }

        /*** Convertir los datos de una fila resultado de una consulta en objeto ***/
        public static function filaEnObjeto($resultado) {
        	$fila = mysql_fetch_object($resultado);
        	return $fila;
        }

        /*** Convertir los datos de una fila resultado de una consulta en arreglo ***/
        public static function filaEnArreglo($resultado) {
        	$fila = mysql_fetch_array($resultado, MYSQL_NUM);
        	return $fila;
        }

        /*** Obtener un arreglo con los nombres de los campos de una tabla o vista ***/
        public static function obtenerColumnas($tabla) {
        	$tabla     = self::$prefijoTabla.$tabla;
        	$columnas  = array();
        	$resultado = self::correrConsulta("SHOW COLUMNS FROM $tabla");

        	while ($datos = self::filaEnArreglo($resultado)) {
        		$columnas[] = $datos[0];
        	}

        	return $columnas;
        }

        /*** Obtener datos de la(s) tabla(s) o vista(s) que cumplan con una condicion ***/
        public static function seleccionar($tablas, $columnas, $condicion="", $agrupamiento="", $ordenamiento="", $filaInicial=NULL, $numeroFilas=NULL) {
        	global $depurar;

        	$listaColumnas = array();
        	$listaTablas   = array();
        	$limite        = "";

        	foreach ($columnas as $alias => $columna) {

        		if (eregi("(^[a-zA-z]+[a-zA-Z0-9]*)",$alias)) {
        			$alias = " AS $alias";
        		} else {
        			$alias = "";
        		}

        		$listaColumnas[] = $columna.$alias;
        	}

        	$columnas = implode(", ", $listaColumnas);

        	foreach ($tablas as $alias => $tabla) {

        		if (eregi("(^[a-zA-z]+[a-zA-Z0-9]*)",$alias)) {
        			$alias = " AS $alias";
        		} else {
        			$alias = "";
        		}

        		$tabla = self::$prefijoTabla.$tabla;
        		$listaTablas[] = $tabla.$alias;
        	}

        	$tablas = implode(", ", $listaTablas);

        	if (!empty($condicion)) {
        		$condicion = " WHERE $condicion";
        	}

        	if (!empty($agrupamiento)) {
        		$agrupamiento = " GROUP BY $agrupamiento";
        	}

        	if (!empty($ordenamiento)) {
        		$ordenamiento = " ORDER BY $ordenamiento";
        	}

        	if (isset($filaInicial)) {
        		$limite = " LIMIT $filaInicial";

        		if (!empty($numeroFilas)) {
        			$limite .= ", $numeroFilas";
        		}
        	}

        	$tablas    = implode(", ", $listaTablas);
        	$sentencia = "SELECT $columnas FROM $tablas".$condicion.$agrupamiento.$ordenamiento.$limite;

        	if ($depurar) {
        		$registro = syslog(LOG_ERR, $sentencia);
        		$depurar  = false;
        	}

        	return self::correrConsulta($sentencia);
        }

        /*** Insertar datos en la tabla ***/
        public static function insertar($tabla, $datos) {

        	global $tablasGenerales;

        	$registrar   = true;
        	$nombreTabla = "";

        	if (in_array($tabla, self::$tablasExcluidas)) {
        		$nombreTabla = $tabla;
        		$registrar   = false;
        	}

        	/*** Establecer ID de gran tamaño (temporal) para los registros actualizables al servidor ***/
        	if (in_array($tabla, $tablasGenerales)) {
        		$consulta   = "SHOW FULL COLUMNS FROM ".self::$prefijoTabla.$tabla." LIKE 'id'";
        		$resultado  = self::correrConsulta($consulta);
        		$registros  = self::filaEnArreglo($resultado);
        		$busqueda   = preg_match("/^[a-zA-Z]+\(([0-9]){0,2}\)/", $registros[1], $longitud);
        		if (!empty($longitud)){
        			$idTemporal = (str_repeat("9", $longitud[1])+1) * 0.9;

        			while (self::existeItem($tabla, "id", $idTemporal)) {
        				$idTemporal++;
        			}
        		}
        	}

        	$tabla = self::$prefijoTabla.$tabla;

        	if (is_array($datos) && count($datos) > 0) {

        		if (isset($idTemporal)) {
        			$consulta   = "ALTER TABLE $tabla AUTO_INCREMENT = $idTemporal";
        			$resultado  = self::correrConsulta($consulta);
        		} else {
        			$campos    = array();
        			$valores   = array();
        		}

        		foreach ($datos as $campo => $valor) {

        			if ($valor != "") {
        				$campos[]  = $campo;
        				$valor     = str_replace("&", "&amp;", $valor);
        				$valor     = str_replace("<", "&lt;", $valor);
        				$valor     = str_replace(">", "&gt;", $valor);

        				if (Cadena::contieneUTF8($valor)) {
        					$valor = addslashes(utf8_decode($valor));
        				}

        				$valores[] = "'$valor'";
        			}
        		}

        		$campos    = implode(",", $campos);
        		$valores   = implode(",", $valores);
        		$sentencia = "INSERT INTO $tabla ($campos) VALUES ($valores)";
        	}

        	$resultado = self::correrConsulta($sentencia);

        	if (!in_array($nombreTabla, self::$tablasExcluidas)) {
        		self::$ultimoId = @mysql_insert_id(self::$conexion);
        	}

        	if (isset($idTemporal) && !(@mysql_errno())) {
        		$columnas = array(
                "fecha"       => date("Y-m-d H:i:s"),
                "instruccion" => "I",
                "tabla"       => $tabla,
                "columnas"    => $campos,
                "valores"     => addslashes(utf8_encode($valores)),
                "id_asignado" => $idTemporal
        		);

        		$consulta = self::insertar("actualizaciones_almacen", $columnas);
        	}

        	if ($registrar) {

        		if (@mysql_errno()) {
        			$mensaje = @mysql_error();
        		} else {
        			$mensaje = "";
        		}

        		self::actualizarBitacora($sentencia, $mensaje);
        	}

        	return $resultado;
        }

        /*** Reemplazar datos existentes en la tabla o insertarlos si no existen ***/
        public static function reemplazar($tabla, $datos) {

        	$registrar = true;

        	if (in_array($tabla, self::$tablasExcluidas)) {
        		$registrar = false;
        	}

        	$tabla = self::$prefijoTabla.$tabla;

        	if (is_array($datos) && count($datos) > 0) {
        		$campos    = array();
        		$valores   = array();

        		foreach ($datos as $campo => $valor) {
        			$campos[]  = $campo;

        			if (Cadena::contieneUTF8($valor)) {
        				$valor = addslashes(utf8_decode($valor));
        			}

        			$valores[] = "'$valor'";
        		}

        		$campos    = implode(", ", $campos);
        		$valores   = implode(", ", $valores);
        		$sentencia = "REPLACE INTO $tabla ($campos) VALUES ($valores)";
        	}

        	$resultado = self::correrConsulta($sentencia);

        	if ($registrar) {

        		if (@mysql_errno()) {
        			$mensaje = @mysql_error();
        		} else {
        			$mensaje = "";
        		}

        		self::actualizarBitacora($sentencia, $mensaje);
        	}

        	return $resultado;
        }

        /*** Modificar datos existentes en la tabla de acuerdo con una condición ***/
        public static function modificar($tabla, $datos, $condicion) {

        	global $tablasGenerales, $forma_id;

        	$registrar  = true;
        	$actualizar = false;

        	if (in_array($tabla, self::$tablasExcluidas)) {
        		$registrar = false;
        	}

        	if (in_array($tabla, $tablasGenerales)) {
        		$actualizar = true;
        	}

        	$tabla = self::$prefijoTabla.$tabla;

        	if (is_array($datos) && count($datos) > 0) {
        		$campos  = array();
        		$valores = array();

        		foreach ($datos as $campo => $valor) {

        			if ($valor != "") {
        				$valor            = str_replace("&", "&amp;", $valor);
        				$valor            = str_replace("<", "&lt;", $valor);
        				$valor            = str_replace(">", "&gt;", $valor);

        				if (Cadena::contieneUTF8($valor)) {
        					$valor = addslashes(utf8_decode($valor));
        				}

        				$valores[]        = "$campo='".$valor."'";
        				$campos["$campo"] = "'$valor'";

        			} else {
        				$valores[]        = "$campo=NULL";
        				$campos["$campo"] = "NULL";
        			}

        		}

        		$valores   = implode(", ", $valores);
        		$sentencia = "UPDATE $tabla SET $valores WHERE $condicion";
        	}

        	$resultado = self::correrConsulta($sentencia);

        	if ($registrar) {

        		if (@mysql_errno()) {
        			$mensaje = @mysql_error();
        		} else {
        			$mensaje = "";
        		}

        		self::actualizarBitacora($sentencia, $mensaje);
        	}

        	if ($actualizar && !(@mysql_errno())) {
        		$columnas = array(
                "fecha"       => date("Y-m-d H:i:s"),
                "instruccion" => "U",
                "tabla"       => $tabla,
                "columnas"    => implode(",", array_keys($campos)),
                "valores"     => addslashes(implode(",", array_values($campos))),
                "id_asignado" => $forma_id
        		);

        		$consulta = self::insertar("actualizaciones_almacen", $columnas);
        	}

        	return $resultado;
        }

        /*** Eliminar datos de una tabla que coincidan con una condición  ***/
        public static function eliminar($tabla, $condicion) {

        	global $tablasGenerales, $forma_id;

        	$registrar = true;
        	$actualizar = false;

        	if (in_array($tabla, self::$tablasExcluidas)) {
        		$registrar = false;
        	}

        	if (in_array($tabla, $tablasGenerales)) {
        		$actualizar = true;
        	}

        	$tabla     = self::$prefijoTabla.$tabla;
        	$sentencia = "DELETE FROM $tabla WHERE $condicion";

        	$resultado = self::correrConsulta($sentencia);

        	if ($registrar) {

        		if (@mysql_errno()) {
        			$mensaje = @mysql_error();
        		} else {
        			$mensaje = "";
        		}

        		self::actualizarBitacora($sentencia, $mensaje);
        	}

        	if ($actualizar && !(@mysql_errno())) {
        		$columnas = array(
                "fecha"       => date("Y-m-d H:i:s"),
                "instruccion" => "D",
                "tabla"       => $tabla,
                "id_asignado" => $forma_id
        		);

        		$consulta = self::insertar("actualizaciones_almacen", $columnas);
        	}

        	return $resultado;
        }

        /*** Insertar datos en la tabla de imágenes o de archivos adjuntos ***/
        public static function insertarArchivo($tabla, $datos) {

        	$tabla = self::$prefijoTabla.$tabla;

        	if (is_array($datos) && count($datos) > 0) {

        		foreach ($datos as $campo => $valor) {

        			if ($valor != "") {
        				$campos[]  = $campo;
        				$valores[] = "'".mysql_real_escape_string($valor)."'";
        			}
        		}

        		$campos    = implode(",", $campos);
        		$valores   = implode(",", $valores);
        		$sentencia = "INSERT INTO $tabla ($campos) VALUES ($valores)";
        	}

        	$resultado = self::correrConsulta($sentencia);

        	return $resultado;
        }

        /*** Registrar operaciones realizadas por el usuario ***/
        private function actualizarBitacora($contenido, $mensaje) {
        	global $sesion_conexion, $componente;

        	$error = false;
        	$datos = array(
            "id_conexion" => $sesion_conexion,
            "fecha"       => date("Y-m-d H:i:s"),
            "componente"  => utf8_encode($componente->nombre),
            "consulta"    => addslashes(utf8_encode($contenido)),
            "mensaje"     => addslashes(utf8_encode($mensaje))
        	);

        	self::insertar("bitacora", $datos);
        }

        /*** Verificar si un registro con un valor específico existe en una tabla ***/
        public static function existeItem($tabla, $columna, $valor, $condicionExtra="") {
        	$tablas    = array($tabla);
        	$columnas  = array($columna);
        	$condicion = "$columna = '$valor'";

        	if (!empty($condicionExtra)) {
        		$condicion .= " AND $condicionExtra";
        	}

        	$resultado = self::seleccionar($tablas, $columnas, $condicion);

        	if (self::filasDevueltas($resultado)) {
        		return TRUE;
        	} else {
        		return FALSE;
        	}
        }

        /*** Obtener el valor de un campo en una tabla cuyo registro (único) coincida con una condición dada ***/
        public static function obtenerValor($tabla, $columna, $condicion) {
        	$tablas    = array($tabla);
        	$columnas  = array($columna);

        	$resultado = self::seleccionar($tablas, $columnas, $condicion);

        	if (self::filasDevueltas($resultado) == 1) {
        		$datos = self::filaEnObjeto($resultado);
        		$valor = $datos->$columna;
        		return $valor;
        	} else {
        		return FALSE;
        	}
        }

        /*** Realizar búsqueda y devolver filas coincidentes ***/
        public static function evaluarBusqueda($vistaBuscador, $vistaMenu) {
        	global $componente, $url_buscar, $url_expresion, $sesion_expresion, $sesion_origenExpresion;

        	$tabla          = self::$prefijoTabla.$vistaBuscador;
        	$camposBuscador = self::obtenerColumnas($vistaBuscador);
        	$camposMenu     = self::obtenerColumnas($vistaMenu);
        	$campoClave     = $camposMenu[0];
        	$condicionFinal = "$campoClave IS NOT NULL";

        	/*** Verificar si la solicitud proviene del formulario de búsqueda ***/
        	if (isset($url_buscar)) {
        		if (!empty($url_expresion)) {
        			Sesion::registrar("expresion", $url_expresion);
        			Sesion::registrar("origenExpresion", $componente->id);
        		} else {
        			Sesion::borrar("expresion");
        			unset($sesion_expresion);
        			Sesion::borrar("origenExpresion");
        			unset($sesion_origenExpresion);
        		}
        	} else {
        		$condicion = "";
        	}

        	/*** Verificar si se está en medio de de una búusqueda ***/
        	if (!empty($sesion_expresion) && ($sesion_origenExpresion == $componente->id)) {
        		$expresion    = Cadena::expresionRegular($sesion_expresion);
        		$campoInicial = true;
        		$listaCampos  = array();

        		foreach ($camposBuscador as $campo) {
        			if (!$campoInicial) {
        				$listaCampos[] = "$tabla.$campo REGEXP '$expresion'";
        			}

        			$campoInicial = false;
        		}

        		$condicion = "(".implode(" OR ", $listaCampos).")";
        		$tablas    = array($vistaBuscador);
        		$columnas  = array($camposBuscador[0]);
        		$consulta  = self::seleccionar($tablas, $columnas, $condicion);

        		if (self::filasDevueltas($consulta)) {
        			$lista = array();

        			while ($datos = self::filaEnObjeto($consulta)) {
        				$lista[] = $datos->id;
        			}

        			$condicionFinal = "$campoClave IN (".implode(",",$lista).")";

        		} else {
        			$condicionFinal = "$campoClave IN (NULL)";
        		}

        	} else {
        		Sesion::borrar("expresion");
        		unset($sesion_expresion);
        		Sesion::borrar("origenExpresion");
        		unset($sesion_origenExpresion);
        	}

        	return $condicionFinal;
        }

        /*** Devolver lista de elementos que coincidan con la búsqueda parcial del usuario para autocompletar ***/
        public static function datosAutoCompletar($tabla, $patron) {
        	$columnas = self::obtenerColumnas($tabla);
        	$primera  = true;
        	$lista    = array();
        	$patron   = Cadena::expresionRegular($patron, false);

        	foreach ($columnas as $columna) {

        		if ($primera) {
        			$primera = false;
        			continue;
        		}

        		$consulta = self::seleccionar(array($tabla), array($columna), "CAST($columna AS CHAR) REGEXP '$patron'");

        		while ($datos = self::filaEnArreglo($consulta)) {
        			$lista[] = $datos[0];
        		}

        	}
        	natsort($lista);
        	$lista = implode("\n", array_unique($lista));
        	return $lista;
        }

        /*** Devuelve una condicion para el orden de presentacion de los datos ***/
        public static function ordenColumnas($columna = "") {
        	global $url_orden, $sesion_columnaOrdenamiento, $sesion_origenOrdenamiento, $sesion_sentidoOrdenamiento, $componente;

        	if (empty($columna)) {
        		$columna = "id";
        	}

        	$ordenamiento = "";

        	if (!empty($url_orden)) {

        		if (empty($sesion_origenOrdenamiento) || ($sesion_origenOrdenamiento != $componente->id)) {
        			Sesion::registrar("origenOrdenamiento", $componente->id);
        		}

        		if (empty($sesion_sentidoOrdenamiento)) {
        			Sesion::registrar("sentidoOrdenamiento", "DESC");
        		}

        		if ($sesion_sentidoOrdenamiento == "DESC") {
        			Sesion::registrar("sentidoOrdenamiento", "ASC");
        		} else {
        			Sesion::registrar("sentidoOrdenamiento", "DESC");
        		}

        		Sesion::registrar("columnaOrdenamiento", $url_orden);
        		$ordenamiento = "$sesion_columnaOrdenamiento $sesion_sentidoOrdenamiento";

        	} else {
        		if (empty($sesion_origenOrdenamiento) || ($sesion_origenOrdenamiento != $componente->id)) {
        			$ordenamiento = "$columna";
        		} else {
        			if (empty($sesion_columnaOrdenamiento)) {
        				$ordenamiento = "$columna";
        			} else {
        				$ordenamiento = "$sesion_columnaOrdenamiento $sesion_sentidoOrdenamiento";
        			}
        		}
        	}

        	return $ordenamiento;
        }
}
?>
