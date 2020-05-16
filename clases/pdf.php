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

/*** Requiere libreria de terceros (FPDF - www.fpdf.org) ***/
require "fpdf/fpdf.php";

class PDF extends FPDF {

    var $textoCabecera;

    /*** Generar tabla ***/
    function generarCabeceraTabla($columnas, $anchoColumnas) {
        $this->SetFillColor(230, 230, 230);
        $this->SetTextColor(0);
        $this->SetDrawColor(0);
        $this->SetLineWidth(.1);
        $this->SetFont("", "B", "");

        for($i = 0 ; $i < count($columnas); $i++) {
            $this->Cell($anchoColumnas[$i], 4, $columnas[$i], 1, 0, "C", true);
        }
    }

    /*** Generar tabla ***/
    function generarContenidoTabla($filas, $anchoColumnas, $alineacionColumnas = "", $formatoColumnas = "") {
        $this->Ln(0);
        $this->SetFillColor(224,235,255);
        $this->SetTextColor(0);
        $this->SetFont("");

        $rellenar = true;

        foreach($filas as $fila) {
            $celdas = 0;

            foreach ($fila as $celda) {
                switch (strtoupper($alineacionColumnas[$celdas])) {
                    case "I" :
                        $alineacion = "L";
                        break;
                    case "D" :
                        $alineacion = "R";
                        break;
                    case "C" :
                        $alineacion = "C";
                        break;
                    default :
                        $alineacion = "L";
                        break;
                }

                $this->Cell($anchoColumnas[$celdas], 3, htmlspecialchars_decode($celda), "LRT", 0, $alineacion, $rellenar);
                $celdas++;
            }

            $this->Ln();
            $rellenar = !$rellenar;
        }

        $this->Cell(array_sum($anchoColumnas), 0, "", "T");
    }

    /*** Encabezado ***/
    function Header() {
        global $pance, $imagenesGlobales;

        $this->SetLineWidth(0.2);
        $this->SetFont("Arial", "B", 7);
        $this->SetXY(0,12);
        $this->MultiCell(0, 2.5, $this->textoCabecera, 0, "R");
        $this->Image($imagenesGlobales["logoClienteReportes"], 10, 10, 20);
        $this->SetXY(10, 22);
        $this->Cell(0, 3, $pance["nitCliente"], "B");
        $this->Ln(6);
        $this->SetLineWidth(0.1);
    }
}
?>