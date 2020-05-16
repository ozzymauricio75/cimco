<?php

/**
*
* Copyright (C) 2020 Raul Mauricio Oidor Lozano
* Mauricio Oidor L. <ozzymauricio75@gmail.com>
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

$textos = array(
    "GESTPROV"                      => "Creacion de Proveedores",
    "ADICPROV"                      => "Adicionar Proveedores",
    "CONSPROV"                      => "Consultar Proveedores",
    "MODIPROV"                      => "Modificar Proveedores",
    "ELIMPROV"                      => "Eliminar Proveedores",
    "PESTANA_CLIENTE"               => "Informacion cliente",
    "PESTANA_TRIBUTARIA"            => "Informacion tributaria",
    "GESTCLIE"                      => "Clientes",
    "ADICCLIE"                      => "Adicionar clientes",
    "CONSCLIE"                      => "Consultar clientes",
    "MODICLIE"                      => "Modificar clientes",
    "ELIMCLIE"                      => "Eliminar clientes",
    "DOCUMENTO_PROVEEDOR"           => "Documento de identidad",
    "PROVEEDOR"                     => "Proveedor",
    "CLIENTE"                       => "Nombre o razon social",
    "FECHA_NACIMIENTO"              => "Fecha nacimiento",
    "FECHA_INGRESO"                 => "Fecha ingreso",
    "TIPO_DOCUMENTO_IDENTIDAD"      => "Tipo de documento de identidad",
    "TIPO_PERSONA"                  => "Tipo de persona",
    "PERSONA_NATURAL"               => "Persona natural",
    "PERSONA_JURIDICA"              => "Persona juridica",
    "CODIGO_INTERNO"                => "Codigo interno",
    "PRIMER_NOMBRE"                 => "Primer nombre",
    "SEGUNDO_NOMBRE"                => "Segundo nombre",
    "PRIMER_APELLIDO"               => "Primer apellido",
    "SEGUNDO_APELLIDO"              => "Segundo apellido",
    "GENERO"                        => "Genero",
    "AYUDA_GENERO"                  => "Seleccione el genero",
    "MASCULINO"                     => "Masculino",
    "FEMENINO"                      => "Femenino",
    "ACTIVO"                        => "Activo",
    "INACTIVO"                      => "Inactivo",
    "RAZON_SOCIAL"                  => "Razon social",
    "NOMBRE_COMERCIAL"              => "Nombre comercial",
    "REGIMEN"                       => "Regimen",
    "REGIMEN_COMUN"                 => "Regimen común",
    "REGIMEN_SIMPLIFICADO"          => "Regimen simplificado",
    "RETIENE_FUENTE"                => "Realiza retencion en la fuente",
    "AUTORETENEDOR"                 => "Es autoretenedor",
    "RETIENE_IVA"                   => "Retiene IVA",
    "RETIENE_ICA"                   => "Retiene ICA",
    "GRAN_CONTRIBUYENTE"            => "Gran contribuyente",
    "PAIS"                          => "Pais",
    "DEPARTAMENTO"                  => "Departamento",
    "MUNICIPIO"                     => "Municipio",
    "PESTANA_UBICACION_PROVEEDOR"   => "Ubicacion proveedor",
    "LOCALIDAD"                     => "Barrio o corregimiento",
    "DIRECCION"                     => "Direccion",
    "TELEFONO_PRINCIPAL"            => "Telefono principal",
    "TELEFONO_SECUNDARIO"           => "Telefono secundario",
    "FAX"                           => "Fax",
    "CELULAR"                       => "Celular",
    "CORREO"                        => "Correo electronico",
    "SITIO_WEB"                     => "Pagina de internet(Web)",
    "PESTANA_PROVEEDOR"             => "Datos operativos",
    "ACTIVIDAD_PRINCIPAL"           => "Actividad economica principal",
    "ACTIVIDAD_SECUNDARIA"          => "Actividad economica secundaria",
    "FABRICANTE"                    => "Fabrica la mercancia",
    "DISTRIBUIDOR"                  => "Comercializa varias marcas",
    "SERVICIOS_TECNICOS"            => "Proveedor de servicios tecnicos",
    "TRANSPORTE"                    => "Proveedor de transporte",
    "PUBLICIDAD"                    => "Proveedor de publicidad",
    "SERVICIOS_ESPECIALES"          => "Proveedor de servicios especiales",
    "TIPO_SERVICIO"                 => "Tipo de servicio",
    "FECHA_INICIO_COBRO"            => "Fecha de inicio de cobro",
    "MAX_CUOTAS_CONTADO"            => "Maximo cuotas de contado",
    "TASA_PAGO_CONTADO"             => "Tasa para pago de contado",
    "MAX_CUOTAS_CREDITO"            => "Maximo de cuotas credito",
    "TASA_PAGO_CREDITO"             => "Tasa de pago credito",
    "PRIMERA_CUOTA"                 => "Primera cuota de % por vencimiento",
    "ULTIMA_CUOTA"                  => "Ultima cuota de % por vencimiento",
    "PAGOS_ANTICIPADOS"             => "Autoriza pagos anticipados",
    "PAGOS_EFECTIVOS"               => "Autoriza pagos efectivos",
    "TRANSFERENCIA_ELECTRONICA"     => "Autoriza transferencia electronica",
    "TARJETA_CREDITO"               => "Autoriza pagos tarjeta credito",
    "TRIANGULACION_BANCARIA"        => "Autoriza pagos triangulacion bancaria",
    "TIEMPO_RESPUESTA"              => "Tiempo de respuesta en dias",
    "PORCENTAJE_FLETE"              => "Porcentaje flete",
    "VALOR_FLETE"                   => "Valor flete",
    "PORCENTAJE_SEGURO"             => "Porcentaje seguro",
    "VALOR_SEGURO"                  => "Valor seguro",
    "ERROR_EXISTE_CODIGO"           => "Ya existe un cliente con ese codigo ",
    "NATURAL"                       => "Natural",
    "JURIDICA"                      => "Juridica",
    "INTERNO"                       => "Codigo interno",
    "NO_FABRICA"                    => "No fabrica mercancia",
    "FABRICA"                       => "Fabrica mercancia",
    "UNA_MARCA"                     => "Comercializa solo una marca",
    "VARIAS_MARCAS"                 => "Comercializa varias marcas",
    "FECHA_FACTURA"                 => "Fecha de la factura",
    "FECHA_RECIBO"                  => "Fecha de recibida la mercancia",
    "AYUDA_DOCUMENTO_PROVEEDOR"     => "Documento de identidad",
    "AYUDA_ACTIVO"                  => "Activo o Inactivo",
    "AYUDA_FECHA_NACIMIENTO"        => "Fecha nacimiento",
    "AYUDA_FECHA_INGRESO"           => "Fecha ingreso",
    "AYUDA_PRIMER_NOMBRE"           => "Primer nombre",
    "AYUDA_SEGUNDO_NOMBRE"          => "Segundo nombre",
    "AYUDA_PRIMER_APELLIDO"         => "Primer apellido",
    "AYUDA_SEGUNDO_APELLIDO"        => "Segundo apellido",
    "AYUDA_RAZON_SOCIAL"            => "Razon social o nombre de la empresa",
    "AYUDA_NOMBRE_COMERCIAL"        => "Nombre comercial utilizado por el cliente",
    "AYUDA_DOCUMENTO_PAIS"          => "Pais donde pertenece el documento de identidad del cliente",
    "AYUDA_DOCUMENTO_DEPARTAMENTO"  => "Departamento donde pertenece el documento de identidad del cliente",
    "AYUDA_DOCUMENTO_MUNICIPIO"     => "Barrio o corregimiento",
    "AYUDA_RESIDENCIA_PAIS"         => "Pais donde se ubica el cliente",
    "AYUDA_RESIDENCIA_DEPARTAMENTO" => "Departamento donde se ubica el cliente",
    "AYUDA_RESIDENCIA_MUNICIPIO"    => "Municipio donde se ubica el cliente",
    "AYUDA_LOCALIDAD"               => "Seleccione el barrio o corregiemiento donde se ubica el cliente",
    "AYUDA_DIRECCION"               => "Direccion donde se ubica el cliente",
    "AYUDA_TELEFONO_PRINCIPAL"      => "Teléfono principal, digite indicativo si lo requiere",
    "AYUDA_TELEFONO_SECUNDARIO"     => "Teléfono secundario, digite indicativo si lo requiere",
    "AYUDA_FAX"                     => "Fax, si el cliente no tiene fax puede colocar otro numero de teléfono",
    "AYUDA_CELULAR"                 => "Numero de celular del cliente",
    "AYUDA_CORREO"                  => "Correo electronico del cliente, EJEPMLO: micorreo@gmail.com",
    "AYUDA_SITIO_WEB"               => "Pagina web del cliente, EJEMPLO: www.mipagina.com",
    "AYUDA_ACTIVIDAD_PRINCIPAL"     => "Actividad económica principal",
    "AYUDA_ACTIVIDAD_SECUNDARIA"    => "Actividad económica secundaria",
    "AYUDA_MAX_CUOTAS_CONTADO"      => "Numero máximo de cuotas dadas por el cliente para pago de contado",
    "AYUDA_TASA_PAGO_CONTADO"       => "Tasa de interés que cobra el cliente para pagos de contado",
    "AYUDA_MAX_CUOTAS_CREDITO"      => "Numero máximo de cuotas dado por el cliente para pago a crédito",
    "AYUDA_TASA_CUOTAS_CREDITO"     => "Tasa de interés que cobra el proveedor para pagos a crédito",
    "AYUDA_TIEMPO_RESPUESTA"        => "Numero de días que tarda para enviar una mercancía o prestar un servicio",
    "AYUDA_PORCENTAJE_FLETE"        => "Porcentaje sobre la compra",
    "AYUDA_VALOR_FLETE"             => "Digite el valor flete si el cliente lo cobra en la factura",
    "AYUDA_PORCENTAJE_SEGURO"       => "Porcentaje sobre la compra",
    "AYUDA_VALOR_SEGURO"            => "Digite el valor del seguro si el cliente lo cobra en la factura",
    "AYUDA_PRIMERA_CUOTA"           => "Digite el porcentaje de la primera cuota por vencimiento",
    "AYUDA_ULTIMA_CUOTA"            => "Digite el porcentaje de la ultima cuota por vencimiento",
    "ERROR_EXISTE_TERCERO"          => "Ya existe un cliente con ese documento",
    "DATO_VACIO"                    => ""
/*
    "PESTANA_CLIENTE"               => "Información cliente",
    "PESTANA_TRIBUTARIA"            => "Información tributaria",
    "GESTCLIE"                      => "Clientes",
    "ADICCLIE"                      => "Adicionar clientes",
    "CONSCLIE"                      => "Consultar clientes",
    "MODICLIE"                      => "Modificar clientes",
    "ELIMCLIE"                      => "Eliminar clientes",
    "PRIMER_NOMBRE"                 => "Primer nombre",
    "SEGUNDO_NOMBRE"                => "Segundo nombre",
    "PRIMER_APELLIDO"               => "Primer apellido",
    "SEGUNDO_APELLIDO"              => "Segundo apellido",
    "CLIENTE"                       => "Nombre ó razón social",
    "DOCUMENTO_CLIENTE"             => "Docuemnto cliente",
    "NOMBRE_SEDE"                   => "Nombre sede",
    "SUCURSAL"                      => "Consorciado",
    "CONTACTO"                      => "Contacto",
    "CARGO"                         => "Municipio",
    "DIRECCION"                     => "Telfono principal",
    "TELEFONO_PRINCIPAL"            => "Telefono principal",
    "FAX"                           => "Fax",
    "CELULAR"                       => "Celular",
    "CORREO"                        => "Correo electronico",
    "CORREO_ELECTRONICO"            => "Correo electronico",
    "PAIS"                          => "Pais",
    "DEPARTAMENTO"                  => "Departamento",
    "MUNICIPIO"                     => "Municipio",
    "REGIMEN"                       => "Régimen",
    "REGIMEN_COMUN"                 => "Régimen común",
    "REGIMEN_SIMPLIFICADO"          => "Régimen simplificado",
    "RETIENE_FUENTE"                => "Realiza retencion en la fuente",
    "AUTORETENEDOR"                 => "Es autoretenedor",
    "RETIENE_IVA"                   => "Retiene IVA",
    "RETIENE_ICA"                   => "Retiene ICA",
    "GRAN_CONTRIBUYENTE"            => "Gran contribuyente",
    "NATURAL"                       => "Natural",
    "JURIDICA"                      => "Juridica",
    "INTERNO"                       => "Codigo interno",    
    "AYUDA_CLIENTE"                 => "Digite cliente",
    "AYUDA_ACTIVO"                  => "Activo o Inactivo",
    "AYUDA_NOMBRE_SEDE"             => "Nombre de la sede",
    "AYUDA_SUCURSAL"                => "Seleccione consorciado",
    "AYUDA_CONTACTO"                => "Digite nombre del Contacto",
    "AYUDA_CARGO"                   => "Cargo que desempeña el contacto",
    "AYUDA_DIRECCION"               => "Direccion donde se ubica la sede",
    "AYUDA_MUNICIPIO"               => "Municipio donde se encuentra la sede",
    "AYUDA_TELEFONO_PRINCIPAL"      => "Teléfono principal, digite indicativo si lo requiere",
    "AYUDA_CELULAR"                 => "Numero de celular del cliente",
    "AYUDA_CORREO"                  => "Correo electronico del cliente, EJEPMLO: micorreo@gmail.com",
    "ERROR_EXISTE_TERCERO"          => "Ya existe un cliente con ese documento",
    "DATO_VACIO"                    => ""*/
);
?>