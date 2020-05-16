<?php

/**
*
* Copyright (C) 2009 FELINUX Ltda
* Francisco J. Lozano B. <fjlozano@felinux.com.co>
* Mauricio Oidor L. <ozzymauricio75@gmail.com>
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

$textos = array(
    "GESTINEG"                             => "Registro ingresos-egresos",                  
    "ADICINEG"                             => "Adicionar movimiento",                 
    "CONSINEG"                             => "Consultar movimiento",                                  
    "ELIMINEG"                             => "Eliminar movimiento",         
    "FECHA_INGRESO"                        => "Fecha ingreso",  
    "NUMERO_COTIZACION"                    => "Numero_cotizacion", 
    "DESCRIPCION"                          => "Descripcion",
    "FECHA_CONCEPTO"                       => "Fecha concepto",   
    "INGRESO"                              => "Ingreso",
    "EGRESO"                               => "Egreso",    
    "SEDE"                                 => "Sede",
    "DESCRIPCION"                          => "Descripci�n ", 
    "CONTACTO"                             => "Contacto",
    "DESCRIPCION"                          => "Descripci�n ",                    
    "CONCEPTO"                             => "Concepto",   
    "VALOR_CONCEPTO"                       => "Valor concepto",
    "ESTADO_COTIZACION"                    => "Estado cotizaci�n",     
    "ESTADO"                               => "Estado",
    "MUNICIPIO"                            => "Ubicaci�n sede",        
    "SUCURSAL"                             => "Consorciado",           
    "ACTA_INICIO"                          => "Acta inicio", 
    "ACTA_AVANCE_OBRA"                     => "Acta avance obra",
    "ACTA_FINALIZACION"                    => "Acta finalizaci�n",
    "ESTADO_REQUERIMIENTO"                 => "Estado requerimiento",
    "FACTURA_CONSORCIADO"                  => "Factura consorciado",
    "PAGO_CLIENTE"                         => "Pago cliente",
    "PAGO_CONSORCIADO"                     => "Pago consorciado",
    "PESTANA_COTIZACION"                   => "Datos cotizaci�n",                                       
    "PESTANA_REQUERIMIENTO"                => "Informaci�n requerimiento",                                 
    "PESTANA_DATOS_CONTROL"                => "Datos control",
    "PESTANA_MOVIMIENTO"                   => "Movimiento",
    "OBSERVACIONES"                        => "Observaciones",
    "OBSERVACIONES"                        => "Observaciones generadas por el cliente",                    
    "OBSERVACIONES_VISITA"                 => "Observaciones visita",    
    "OBSERVACIONES_APROBACION"             => "Observaciones aprobaci�n",
    "NUMERO_COTIZACION"                    => "Numero cotizaci�n",  
    "NUMERO_COTIZACION_CONSORCIADO"        => "Numero cotizaci�n consorciado",
    "VALOR_REQUERIMIENTO"                  => "Valor requerimiento",                      
    "VALOR_MANO_OBRA_COTIZACION"           => "Valor mano de obra",                                              
    "VALOR_MANO_OBRA_MODIFICADA"           => "Valor mano de obra propuesto",                                    
    "VALOR_MATERIALES_COTIZACION"          => "Valor materiales",                                                
    "VALOR_MATERIALES_MODIFICADO"          => "Valor materiales propuesto",               
    "VALOR_ADMINISTRACION_COTIZACION"      => "Valor administraci�n",                     
    "VALOR_IMPREVISTOS_COTIZACION"         => "Valor imprevistos",                        
    "VALOR_UTILIDAD"                       => "Valor utilidad",                           
    "VALOR_IMPUESTO"                       => "Valor impuesto",                           
    "VALOR_ANTICIPO"                       => "Valor anticipo", 
    "VALOR_FACTURAR"                       => "Valor facturar",
    "VALOR_FACTURAR_MODIFICADO"            => "Valor facturado",
    "FALTA_FACTURAR"                       => "Para esta cotizaci�n solo puede facturar: $",
    "SUB_TOTAL"                            => "Sub-Total",                                
    "TOTAL_GENERAL"                        => "Total general", 
    "ACUMULADO"                            => "Acumulado actas",
    "PORCENTAJE_ADMINISTRACION_COTIZACION" => "Porcentaje admin",                          
    "PORCENTAJE_ADMINISTRACION_MODIFICADO" => "Porcentaje admin propuesto",               
    "PORCENTAJE_IMPREVISTOS_COTIZACION"    => "Porcentaje imprev",                        
    "PORCENTAJE_IMPREVISTOS_MODIFICADO"    => "Porcentaje imprev propuesto",              
    "COSTO_DIRECTO"                        => "Costo directo",                            
    "COSTO_DIRECTO_MODIFICADO"             => "Costo directo propuesto",                  
    "PORCENTAJE_UTILIDAD"                  => "Porcentaje utilidad",                      
    "PORCENTAJE_UTILIDAD_MODIFICADA"       => "Porcentaje utilidad propuesto",            
    "IMPUESTO"                             => "Impuesto",                                 
    "IMPUESTO_MODIFICADO"                  => "Impuesto propuesto",                       
    "FORMA_PAGO"                           => "Forma de pago",                                                   
    "FORMA_PAGO_MODIFICADO"                => "Forma de pago propuesta",                                         
    "PORCENTAJE_ANTICIPO"                  => "Porcentaje anticipo",                                             
    "PORCENTAJE_ANTICIPO_MODIFICADO"       => "Porcentaje anticipo propuesto",                                   
    "PORCENTAJE_MANO_OBRA"                 => "Porcentaje mano obra",                                            
    "PORCENTAJE_MANO_OBRA_MODIFICADO"      => "Porcentaje mano obra propuesto",                                  
    "PORCENTAJE_MATERIALES"                => "Porcentaje materiales",                                           
    "PORCENTAJE_MATERIALES_MODIFICADO"     => "Porcentaje materiales propuesto",
	"NUMEROCOTIZACION"                     => "Numero cotizaci�n",
  	"TIPO_ACTA"                            => "Tipo acta",
    "TIPO_SOLICITUD"                       => "Tipo solicitud",
  	"FECHAENTREGA"                         => "Fecha entrega",
  	"VALORFACTURAR"                        => "Valor facturado",
  	"FACTURACONSORCIADO"                   => "Factura consorciado",
  	"PAGOCLIENTE"                          => "Pago cliente",
  	"PAGOCONSORCIADO"                      => "Pago consorciado",
    "PORCENTAJEMANOOBRA"                   => "Porcentaje mano obra",
    "PORCENTAJEMATERIALES"                 => "Porcentaje materiales",
    "AYUDA_FECHA_CONCEPTO"                 => "Fecha en que se realiza el ingreso o egreso",
    "AYUDA_VALOR_CONCEPTO"                 => "Valor del concepto",
    "AYUDA_PORCENTAJE_MANO_OBRA"           => "Porcentaje mano de obra",
    "AYUDA_PORCENTAJE_MATERIALES"          => "porcentaje materiales",
    "ERROR_EXISTE_MOVIMIENTO"              => "Ya existe un movimiento con ese numero",
    "ERROR_COMPLETO_OBRA"                  => "El acumulado de las actas ya excedi� el valor total de la cotizaci�n",
    "ERROR_FORMATO_VALOR_FACTURAR"         => "El campo valor facturar debe contener solo n�meros",
    "ERROR_FORMATO_PORCENTAJE_MANO_OBRA"   => "El campo porcentaje de la mano de obra debe contener solo n�meros",
    "ERROR_FORMATO_PORCENTAJE_MATERIALES"  => "El campo porcentaje materiales debe contener solo n�meros"           
);                                                                                                             
?>
