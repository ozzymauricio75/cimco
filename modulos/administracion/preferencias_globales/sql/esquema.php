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



/*** Sentencias para la creación de las vistas requeridas

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