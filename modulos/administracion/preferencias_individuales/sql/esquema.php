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

$borrarSiempre   = false;

$tablas["preferencias"]   = array(
    "id"          => "INT(8) UNSIGNED ZEROFILL AUTO_INCREMENT NOT NULL COMMENT 'Consecutivo interno de la base de datos'",
    "tipo"  	  => "enum('1','2') NOT NULL default '1' COMMENT '1 Global - 2 Individual'",
    "variable" 	  => "VARCHAR(255) NOT NULL COMMENT 'Nombre del componente al cual se aplica la preferencia'",
    "valor" 	  => "VARCHAR(255) NOT NULL COMMENT 'Valor que se aplica para la variable'",
    "usuario" 	  => "VARCHAR(255) NULL COMMENT 'Usuario en caso de que la prefernecia sea individual'",
    "sucursal"	  => "VARCHAR(255) NULL COMMENT 'Sucursal en caso de que la prefernecia sea global'"
);

/*** Definici�n de llaves primarias ***/
$llavesPrimarias["preferencias"]    = "id";

/*** Definici�n de llaves �nicas ***/
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

/*** Inserci�n de datos iniciales ***/
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



/*** Sentencias para la creaci�n de las vistas requeridas (NOTA: EST�N COMO REGISTRO, PERO NO SE USAN.....)

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