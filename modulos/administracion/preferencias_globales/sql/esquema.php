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
        "id"        => "PREFGLOB",
        "padre"     => "GESTPREF",
        "id_modulo" => "ADMINISTRACION",
        "orden"     => "200",
        "carpeta"   => "preferencias_globales",
        "archivo"   => "menu"
    ),
    /*array(
        "id"        => "ADICPRGB",
        "padre"     => "PREFGLOB",
        "id_modulo" => "ADMINISTRACION",
        "visible"   => "0",
        "orden"     => "0005",
        "carpeta"   => "preferencias_globales",
        "archivo"   => "adicionar"
    ),
    array(
        "id"        => "CONSPRGB",
        "padre"     => "PREFGLOB",
        "id_modulo" => "ADMINISTRACION",
        "visible"   => "0",
        "orden"     => "0010",
        "carpeta"   => "preferencias_globales",
        "archivo"   => "consultar"
    ),*/
    array(
        "id"        => "MODIPRGB",
        "padre"     => "PREFGLOB",
        "id_modulo" => "ADMINISTRACION",
        "visible"   => "0",
        "orden"     => "0015",
        "carpeta"   => "preferencias_globales",
        "archivo"   => "modificar"
    )/*,
    array(
        "id"        => "ELIMPRGB",
        "padre"     => "PREFGLOB",
        "id_modulo" => "ADMINISTRACION",
        "visible"   => "0",
        "orden"     => "0020",
        "carpeta"   => "preferencias_globales",
        "archivo"   => "eliminar"
    )*/
);



/*** Sentencias para la creaci�n de las vistas requeridas

    CREATE OR REPLACE VIEW pance_menu_preferencias_globales  AS
    SELECT id, CODIGO, NOMBRE
    FROM pance_menu_sucursales
    
    INSERT INTO pance_componentes (id, padre, id_modulo, global, visible, orden, carpeta, archivo) VALUES
    ('ADICPRGB', 'PREFGLOB', 'ADMINISTRACION', '0', '0', 0005, 'preferencias_globales', 'adicionar'),
    ('CONSPRGB', 'PREFGLOB', 'ADMINISTRACION', '0', '0', 0010, 'preferencias_globales', 'consultar'),
    ('ELIMPRGB', 'PREFGLOB', 'ADMINISTRACION', '0', '0', 0020, 'preferencias_globales', 'eliminar'),
    ('MODIPRGB', 'PREFGLOB', 'ADMINISTRACION', '0', '0', 0015, 'preferencias_globales', 'modificar');

***/

?>