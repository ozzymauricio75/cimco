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

$borrarSiempre   = false;

$tablas["preferencias"]   = array(
    "id"          => "INT(8) UNSIGNED ZEROFILL AUTO_INCREMENT NOT NULL COMMENT 'Consecutivo interno de la base de datos'",
    "tipo"  	  => "enum('1','2') NOT NULL default '1' COMMENT '1 Global - 2 Individual'",
    "variable" 	  => "VARCHAR(255) NOT NULL COMMENT 'Nombre del componente al cual se aplica la preferencia'",
    "valor" 	  => "VARCHAR(255) NOT NULL COMMENT 'Valor que se aplica para la variable'",
    "usuario" 	  => "VARCHAR(255) NULL COMMENT 'Usuario en caso de que la prefernecia sea individual'",
    "sucursal"	  => "VARCHAR(255) NULL COMMENT 'Sucursal en caso de que la prefernecia sea global'"
);

/*** Definición de llaves primarias ***/
$llavesPrimarias["preferencias"]    = "id";

/*** Definición de llaves únicas ***/
/*$llavesUnicas["preferencias"] = array(
    "id_usuario"
);*/

/*$llavesForaneas["preferencias"] = array(
    array(
        /*** Nombre de la llave ***/
        /*"perfiles_usuario_usuario",
        /*** Nombre del campo clave de la tabla local ***/
        /*"id_usuario",
        /*** Nombre de la tabla relacionada ***/
        /*"usuarios",
        /*** Nombre del campo clave en la tabla relacionada ***/
        /*"id"
    )
);*/

/*** Inserción de datos iniciales ***/
$registros["componentes"] = array(
    array(
        "id"        => "GESTPREF",
        "padre"     => "SUBMACCE",
        "id_modulo" => "ADMINISTRACION",
        "orden"     => "100",
        "carpeta"   => "principal"        
    ),
    array(
        "id"        => "PREFUSUA",
        "padre"     => "GESTPREF",
        "id_modulo" => "ADMINISTRACION",
        "orden"     => "200",
        "carpeta"   => "preferencias_individuales",
        "archivo"   => "menu"
    ),
    /*array(
        "id"        => "ADICPREF",
        "padre"     => "GESTPREF",
        "id_modulo" => "ADMINISTRACION",
        "visible"   => "0",
        "orden"     => "0005",
        "carpeta"   => "preferencias_individuales",
        "archivo"   => "adicionar"
    ),
    array(
        "id"        => "CONSPREF",
        "padre"     => "GESTPREF",
        "id_modulo" => "ADMINISTRACION",
        "visible"   => "0",
        "orden"     => "0010",
        "carpeta"   => "preferencias_individuales",
        "archivo"   => "consultar"
    ),*/
    array(
        "id"        => "MODIPREF",
        "padre"     => "PREFUSUA",
        "id_modulo" => "ADMINISTRACION",
        "visible"   => "0",
        "orden"     => "0015",
        "carpeta"   => "preferencias_individuales",
        "archivo"   => "modificar"
    )/*,
    array(
        "id"        => "ELIMPREF",
        "padre"     => "GESTPREF",
        "id_modulo" => "ADMINISTRACION",
        "visible"   => "0",
        "orden"     => "0020",
        "carpeta"   => "preferencias_individuales",
        "archivo"   => "eliminar"
    )*/
);



/*** Sentencias para la creación de las vistas requeridas (NOTA: ESTÁN COMO REGISTRO, PERO NO SE USAN.....)

    CREATE OR REPLACE VIEW pance_menu_preferencias  AS
    SELECT 
	  pance_preferencias.id AS id, 
	  IF(pance_preferencias.tipo=1, 'Global', 'Individual') AS TIPO, 
	  IF(pance_preferencias.usuario LIKE '',
		'',
		(SELECT pance_usuarios.nombre AS nombre
		FROM pance_usuarios, pance_preferencias 
		WHERE pance_preferencias.usuario = pance_usuarios.id
		GROUP BY pance_preferencias.usuario) 	
	  ) AS USUARIO
    FROM 
	  pance_preferencias
    GROUP BY
	  pance_preferencias.usuario

    CREATE OR REPLACE VIEW pance_buscador_preferencias  AS
    SELECT 
	  pance_usuarios.id AS id, 
	  IF(pance_preferencias.tipo=1, 'Global', 'Individual') AS TIPO, 
	  pance_preferencias.variable AS VARIABLE, 
	  pance_preferencias.valor AS VALOR, 
	  IF(pance_preferencias.usuario LIKE '',
		'',
		(SELECT pance_usuarios.nombre AS nombre
		FROM pance_usuarios, pance_preferencias 
		WHERE pance_preferencias.usuario = pance_usuarios.id
		GROUP BY pance_preferencias.usuario) 
	  ) AS USUARIO
    FROM 
	  pance_preferencias, pance_usuarios;

***/

?>