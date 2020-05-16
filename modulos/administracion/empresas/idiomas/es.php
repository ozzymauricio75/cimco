<?php

/**
*
* Copyright (C) 2008 LinuxCali Ltda
* Francisco J. Lozano B. <pacho@linuxcali.com>
* Mauricio Oidor L. <ozzymauricio75@gmail.com>
*
* Este archivo es parte de:
* PANCE :: Plataforma para la Administraciï¿½n del Nexo Cliente-Empresa
*
* Este programa es software libre: usted puede redistribuirlo y/o
* modificarlo  bajo los tï¿½rminos de la Licencia Pï¿½blica General GNU
* publicada por la Fundaciï¿½n para el Software Libre, ya sea la versiï¿½n 3
* de la Licencia, o (a su elecciï¿½n) cualquier versiï¿½n posterior.
*
* Este programa se distribuye con la esperanza de que sea ï¿½til, pero
* SIN GARANTï¿½A ALGUNA; ni siquiera la garantï¿½a implï¿½cita MERCANTIL o
* de APTITUD PARA UN PROPï¿½SITO DETERMINADO. Consulte los detalles de
* la Licencia Pï¿½blica General GNU para obtener una informaciï¿½n mï¿½s
* detallada.
*
* Deberï¿½a haber recibido una copia de la Licencia Pï¿½blica General GNU
* junto a este programa. En caso contrario, consulte:
* <http://www.gnu.org/licenses/>.
*
**/

$textos = array(
    "GESTEMPR"                           => "Empresas",                                 
    "ADICEMPR"                           => "Adicionar empresas",                       
    "CONSEMPR"                           => "Consultar empresas",                       
    "MODIEMPR"                           => "Modificar empresas",                       
    "ELIMEMPR"                           => "Eliminar empresas",                        
    "ID"                                 => "Consecutivo base datos",                           
    "CODIGO"                             => "Código interno",                           
    "CODIGO_EMPRESA"                     => "Código",                           
    "RAZON_SOCIAL"                       => "Razón social",                             
    "NOMBRE_CORTO"                       => "Nombre corto",                             
    "FECHA_CIERRE"                       => "Fecha cierre",                             
    "ACTIVO"                             => "Estado",
    "CODIGO_TERCERO"                     => "Código tercero",                                   
    "TERCERO"                            => "Documento tercero",
    "NOMBRE_COMPLETO"                    => "Nombre",                                    
    "REGIMEN"                            => "Régimen",                                  
    "GRAN_CONTRIBUYENTE"                 => "Gran contribuyente",                       
    "RETENEDOR_FUENTE"                   => "Retenedor fuente",                         
    "RETENEDOR_ICA"                      => "Retenedor ica",                            
    "ACTIVIDAD_PRINCIPAL"                => "Actividad económica principal",                      
    "ACTIVIDAD_SECUNDARIA"               => "Actividad económica secundaria",
    "PAIS"                               => "País",
    "DEPARTAMENTO"                       => "Departamento",
    "MUNICIPIO"                          => "Municipio",
    "DOCUMENTO_TERCERO"                => "Documento de identidad",
    "TIPO_PERSONA"                       => "Tipo de persona",
    "PERSONA_NATURAL"                    => "Persona natural",
    "PERSONA_JURIDICA"                   => "Persona juridica",
    "CODIGO_INTERNO"                     => "Codigo interno",
    "NATURAL"                            => "Natural",
    "JURIDICA"                           => "Juridica",
    "INTERNO"                            => "Codigo interno",
    "TIPO_DOCUMENTO_IDENTIDAD"           => "Tipo de documento de identidad",
    "PRIMER_NOMBRE"                      => "Primer nombre",
    "SEGUNDO_NOMBRE"                     => "Segundo nombre",
    "PRIMER_APELLIDO"                    => "Primer apellido",
    "SEGUNDO_APELLIDO"                   => "Segundo apellido",
    "DATO_VACIO"                         => "",
    "NOMBRE_COMERCIAL"                   => "Nombre comercial",
    "RETIENE_FUENTE"                     => "Realiza retencion en la fuente",
    "AUTORETENEDOR"                      => "Es autoretenedor",
    "RETIENE_IVA"                        => "Retiene IVA",
    "RETIENE_ICA"                        => "Retiene ICA",
    "LOCALIDAD"                          => "Barrio o corregimiento",
    "DIRECCION"                          => "Direccion",
    "TELEFONO_PRINCIPAL"                 => "Telefono principal",
    "FAX"                                => "Fax",
    "CELULAR"                            => "Celular",
    "CORREO"                             => "Correo electronico",
    "SITIO_WEB"                          => "Pagina de internet(Web)",
    "NATURAL"                            => "Natural",
    "JURIDICA"                           => "Jurídica",
    "INTERNO"                            => "Código interno",
    "PESTANA_GENERAL"                    => "Información general",  
    "PESTANA_TRIBUTARIA"                 => "Información tributaria",
    "PESTANA_TERCERO"                    => "Información tercero",
    "PESTANA_UBICACION_TERCERO"          => "Ubicación tercero",
    "ESTADO_ACTIVA"                      => "Activa",                      
    "ESTADO_INACTIVA"                    => "Inactiva",                     
    "ESTADO_INACTIVA_GENERA"             => "Inactiva genera",
    "REGIMEN_SIMPLIFICADO"               => "Simplificado",
    "REGIMEN_COMUN"                      => "Común",
    "NO"                                 => "No",
    "SI"                                 => "Si",
    "AYUDA_TERCEROS"                     => "Tercero al que pertenece la empresa",
    "AYUDA_CODIGO"                       => "Código de la empresa",
    "AYUDA_ACTIVO"                       => "Estado actual de la empresa activa-inactiva",
    "AYUDA_RAZON_SOCIAL"                 => "Razón social o nombre de la empresa",
    "AYUDA_NOMBRE_CORTO"                 => "Nombre corto de la empresa",
    "AYUDA_FECHA_CIERRE"                 => "Fecha de cierre de la empresa",
    "AYUDA_REGIMEN"                      => "Tipo de régimen de la empresa",
    "AYUDA_GRAN_CONTRIBUYENTE"           => "La empresa es gran contribuyente o no",
    "AYUDA_ACTIVIDAD_PRINCIPAL"          => "Actividad económica principal a la cual se dedica la empresa",
    "AYUDA_ACTIVIDAD_SECUNDARIA"         => "Actividad económica secundaria a la cual se dedica la empresa",
    "AYUDA_TERCERO"                    => "Documento de identidad",
    "AYUDA_TIPO_PERSONA"                 => "Tipo de persona al que petenece",
    "AYUDA_DOCUMENTO"                    => "Tipo de documento de identidad",
    "AYUDA_PRIMER_NOMBRE"                => "Primer nombre",                                                                        
    "AYUDA_SEGUNDO_NOMBRE"               => "Segundo nombre",                                                                       
    "AYUDA_PRIMER_APELLIDO"              => "Primer apellido",                                                                      
    "AYUDA_SEGUNDO_APELLIDO"             => "Segundo apellido",                                                                                                                       
    "AYUDA_NOMBRE_COMERCIAL"             => "Nombre comercial utilizado por el tercero",                                          
    "AYUDA_DOCUMENTO_MUNICIPIO"          => "Municipio donde pertenece el documento de identidad del tercero",                      
    "AYUDA_RESIDENCIA_MUNICIPIO"         => "Municipio donde se ubica el tercero",                                                
    "AYUDA_LOCALIDAD"                    => "Seleccione el barrio o corregiemiento donde se ubica el tercero",                    
    "AYUDA_DIRECCION"                    => "Direccion donde se ubica el tercero",                                                
    "AYUDA_TELEFONO_PRINCIPAL"           => "Telefono principal, digite indicativo si lo requiere",                                 
    "AYUDA_FAX"                          => "Fax, si el tercero no tiene fax puede colocar otro numero de telefono",              
    "AYUDA_CELULAR"                      => "Numero de celular del tercero",                                                      
    "AYUDA_CORREO"                       => "Correo electronico del tercero, EJEMPLO: micorreo@gmail.com",                        
    "AYUDA_SITIO_WEB"                    => "Pagina web del tercero, EJEMPLO: www.mipagina.com", 
    "ERROR_EXISTE_DOCUMENTO"             => "Ya existe una tercera persona con ese documento de identidad",
    "ERROR_EXISTE_CODIGO"                => "Ya existe una empresa con ese código",                   
    "ERROR_EXISTE_NOMBRE"                => "Ya existe una empresa con ese nombre ",    
    "ERROR_EXISTE_RAZON_SOCIAL"          => "Ya existe una empresa con esa razón social",
    "ERROR_EXISTE_NOMBRE_CORTO"          => "Ya existe una empresa con esa abreviatura",
    "ERROR_EXISTE_FECHA_CIERRE"          => "Ya existe una empresa con esa fecha de cierre",
    "ERROR_EXISTE_ESTADO"                => "Ya existe una empresa con ese estado",
    "ERROR_EXISTE_TERCERO"               => "Ya existe una empresa con ese tercero",
    "ERROR_EXISTE_REGIMEN"               => "Ya existe una empresa con ese regimen",
    "ERROR_FORMATO_CODIGO"               => "El código debe contener solo numeros",
    "ERROR_FORMATO_CODIGO_INTERNO"       => "El código interno debe contener solo numeros",
    "ERROR_FORMATO_COMUNAS"              => "El numero de comunas es incorrrecto",
    "ERROR_EXISTE_GRAN_CONTRIBUYENTE"    => "Ya existe una empresa con ese indicador de gran contribuyente",
    "ERROR_EXISTE_RETENCION_FUENTE"      => "Ya existe una empresa con ese indicador de retencion fuente",
    "ERROR_EXISTE_RETENCION_ICA"         => "Ya existe una empresa con ese indicador de retencion ICA",
    "ERROR_EXISTE_ACTIVIDAD_PRINCIPAL"   => "Ya existe una empresa con ese tipo de actividad economica principal",
    "ERROR_EXISTE_ACTIVIDAD_SECUNDARIA"  => "Ya existe una empresa con ese tipo de actividad economica secundaria"
);
?>
