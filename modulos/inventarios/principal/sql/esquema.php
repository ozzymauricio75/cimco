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
* de APTITUD PARA UN PROPÓSITO DETERMINADO. Consulte los detalles de
* la Licencia Pública General GNU para obtener una información más
* detallada.
*
* Debería haber recibido una copia de la Licencia Pública General GNU
* junto a este programa. En caso contrario, consulte:
* <http://www.gnu.org/licenses/>.
*
**/

$registros["modulos"] = array(
    array(
        "id"          => "INVENTARIO",
        "nombre"      => "Inventario",
        "descripcion" => "Operaciones y datos de control relacionados con el inventario",
        "carpeta"     => "inventarios"
    )
);

$registros["componentes"] = array(
    array(
        "id"        => "MENUINVE",
        "padre"     => "NULL",
        "id_modulo" => "INVENTARIO",
        "visible"   => "1",
        "orden"     => "4700",
        "carpeta"   => "principal",
        "archivo"   => "NULL",
        "global"    => "0"
    )
);
?>
