<?php

/**
*
* Copyright (C) 2020 Raul Mauricio Oidor Lozano
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

/*** Inserci�n de datos iniciales ***/
$registros["componentes"] = array(
    /*array(
        "id"        => "SUBMMAYO",
        "padre"     => "MENUCLIE",
        "id_modulo" => "CLIENTES",
        "visible"   => "1",
        "orden"     => "2000",
        "carpeta"   => "principal",
        "archivo"   => "NULL"
    ),
    array(
        "id"        => "SUBMMINO",
        "padre"     => "MENUCLIE",
        "id_modulo" => "CLIENTES",
        "visible"   => "1",
        "orden"     => "5000",
        "carpeta"   => "principal",
        "archivo"   => "NULL"
    ),*/
    array(
        "id"        => "GESTPROV",
        "padre"     => "MENUPROV",
        "id_modulo" => "PROVEEDORES",
        "orden"     => "0005",
        "carpeta"   => "proveedores",
        "archivo"   => "menu"
    ),
    array(
        "id"        => "ADICPROV",
        "padre"     => "MENUPROV",
        "id_modulo" => "PROVEEDORES",
        "visible"   => "0",
        "orden"     => "00010",
        "carpeta"   => "proveedores",
        "archivo"   => "adicionar"
    ),
    array(
        "id"        => "CONSPROV",
        "padre"     => "MENUPROV",
        "id_modulo" => "PROVEEDORES",
        "visible"   => "0",
        "orden"     => "0012",
        "carpeta"   => "proveedores",
        "archivo"   => "consultar"
    ),
    array(
        "id"        => "MODIPROV",
        "padre"     => "MENUPROV",
        "id_modulo" => "PROVEEDORES",
        "visible"   => "0",
        "orden"     => "0014",
        "carpeta"   => "proveedores",
        "archivo"   => "modificar"
    ),
    array(
        "id"        => "ELIMPROV",
        "padre"     => "MENUPROV",
        "id_modulo" => "PROVEEDORES",
        "visible"   => "0",
        "orden"     => "0016",
        "carpeta"   => "proveedores",
        "archivo"   => "eliminar"
    )
    /*
    array(
        "id"        => "SUBMVEMA",
        "padre"     => "SUBMMAYO",
        "id_modulo" => "CLIENTES",
        "visible"   => "1",
        "orden"     => "0005",
        "carpeta"   => "principal",
        "archivo"   => "NULL"
    ),
    array(
        "id"        => "SUBMCOMA",
        "padre"     => "SUBMMAYO",
        "id_modulo" => "CLIENTES",
        "visible"   => "1",
        "orden"     => "0010",
        "carpeta"   => "principal",
        "archivo"   => "NULL"
    ),
    array(
        "id"        => "SUBMDCMA",
        "padre"     => "SUBMMAYO",
        "id_modulo" => "CLIENTES",
        "visible"   => "1",
        "orden"     => "0015",
        "carpeta"   => "principal",
        "archivo"   => "NULL"
    ),
    array(
        "id"        => "GESTCLMA",
        "padre"     => "SUBMDCMA",
        "id_modulo" => "CLIENTES",
        "orden"     => "0005",
        "carpeta"   => "clientes_mayoristas",
        "archivo"   => "menu"
    ),
    array(
        "id"        => "GESTSUMA",
        "padre"     => "SUBMDCMA",
        "id_modulo" => "CLIENTES",
        "orden"     => "0010",
        "carpeta"   => "sucursales_mayoristas",
        "archivo"   => "menu"
    ),
    array(
        "id"        => "GESTCOMA",
        "padre"     => "SUBMDCMA",
        "id_modulo" => "CLIENTES",
        "orden"     => "0012",
        "carpeta"   => "contactos_mayoristas",
        "archivo"   => "menu"
    ),
    array(
        "id"        => "GESTVECO",
        "padre"     => "SUBMDCMA",
        "id_modulo" => "CLIENTES",
        "orden"     => "0015",
        "carpeta"   => "vendedores_cobradores",
        "archivo"   => "menu"
    ),
    array(
        "id"        => "GESTZOVM",
        "padre"     => "SUBMDCMA",
        "id_modulo" => "CLIENTES",
        "orden"     => "0020",
        "carpeta"   => "zona_ventas_mayoristas",
        "archivo"   => "menu"
    ),
    array(
        "id"        => "GESTCMMY",
        "padre"     => "SUBMDCMA",
        "id_modulo" => "CLIENTES",
        "orden"     => "0025",
        "carpeta"   => "comisiones_mayoristas",
        "archivo"   => "menu"
    ),
    array(
        "id"        => "GESTTRMA",
        "padre"     => "SUBMDCMA",
        "id_modulo" => "CLIENTES",
        "orden"     => "0090",
        "carpeta"   => "transacciones_clientes_mayoristas",
        "archivo"   => "menu"
    )*/
);
?>
