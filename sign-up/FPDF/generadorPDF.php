<?php
require('fpdf.php');

include('../config.php');
include("../funciones.php");

$conn->set_charset("utf8");



// $id = $_POST['id'];
$id = $_GET['id'];
$Datos = "SELECT * FROM orders WHERE id = $id ";
// if (!mysqli_set_charset($conn,"utf8")){
//     echo "error de codificacion";
//     return true;
// }

$ResultDatos = mysqli_query($conn, $Datos);

class PDF extends FPDF
{
// Cabecera de página

function Header()
{
    // Logo
    $this->Image('./Logo.jpg',10,8,30);
    // Arial bold 15
    $this->SetFont('Arial','',10);

    // INICIO - TITULO   
    $this->Cell(80);
    $this->Cell(30,10,'UNIDAD EDUCATIVA "SION"',0,0,'C');
    $this->Ln(5);

    $this->Cell(80);
    $this->Cell(30,10,'LO MEJOR EN EDUCACI'.utf8_decode("Ó").'N.',0,0,'C');
    $this->Ln(5);

    $this->Cell(80);
    $this->Cell(30,10,'"Mejor es adquirir sabiduria que oro preciado y adquirir',0,0,'C');
    $this->Ln(5);
    $this->Cell(80);
    $this->Cell(30,10,'inteligencia vale mas que la plata." Prov.16:16.',0,0,'C');
    $this->Ln(5);
    $this->Cell(80);
    $this->Cell(30,10,'RIF J-09513933-6',0,0,'C');
    $this->Ln(20);
    // FINAL - TITULO

    // INICIO - COMPROBANTE
    $this->SetFont('Arial','B',10);
    $this->Cell(80);
    $this->Cell(30,10,'COMPROBANTE DE RETENCI'.utf8_decode("Ó").'N',0,0,'C');
    $this->Ln(5);
    $this->Cell(80);
    $this->Cell(30,10,'IMPUESTO AL VALOR AGREGADO (IVA)',0,0,'C');
    $this->Ln(5);
    $this->Cell(80);
    $this->SetFont('Arial','',10);
    $this->Cell(30,10,'Providencia Administrativa N'.utf8_decode("º").' SNAT/2015/0049 del 10/08/2.015',0,0,'C');
    $this->Ln(20);
    // FINAL - COMPROBANTE
}

function Footer(){
    $this->SetFont('Arial','',10);
    $this->Ln(10);
    $this->Cell(80);
    $this->Cell(30,10,'________________________',0,0,'C');
    $this->Ln(10);
    $this->Cell(80);
    $this->Cell(30,10,'FIRMA Y SELLO DEL AGENTE DE RETENCI'.utf8_decode("Ó").'N',0,0,'C');
    $this->SetFont('Arial','',5);
    $this->Ln(10);
    $this->Cell(80);
    $this->Cell(30,10,'ESTE COMPROBANTE SE EMITE EN FUNCI'.utf8_decode("Ó").'N A LO ESTABLECIDO EN EL ATICULO 10 DE LA PROVIDENCIA ADMINISTRATIVA N'.utf8_decode("º").' SNAT/2015/0049 DE FECHA 10/08/2.015',0,0,'C');
}

}

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

// $ProveedorSeleccionado = isset($_POST['proveedor_id']) ? $_POST['proveedor_id'] : null;
while($Filas = $ResultDatos->fetch_assoc()){

    
    if (true) {
// if ($Filas['id'] === $ProveedorSeleccionado) {

// INICIO - DATOS DE LA INSTITUCION

    $pdf->SetFont('Arial', 'B', 6);
    $pdf->Cell(63,15,"NOMBRE O RAZON SOCIAL DEL AGENTE DE RETENCIN", 1, 0,'C', 0);
    $pdf->Cell(63,15,"RIF. DEL AGENTE DE RETENCION", 1, 0,'C', 0);
    $pdf->Cell(63,15, 'N'.utf8_decode("º").' DE COMPROBANTE',1, 0,'C', 0);
    $pdf->Ln(5);

    $pdf->SetFont('Arial','',5);
    $pdf->Cell(63,10,"ASOCIACION CIVIL UNIDAD EDUCATIVA COLEGIO SION", 0, 0,'C', 0);
    $pdf->Cell(63,10,"J-09513933-6", 0, 0,'C', 0);
    $pdf->Cell(63,10,$Filas['nroComprobante'], 0, 0,'C', 0);
    $pdf->Ln(10);

    // FINAL - DATOS DE LA INSTITUCION

    // INICIO - DATOS DEL AGENTE DE RETENCION

    $pdf->SetFont('Arial', 'B', 7);
    $pdf->Cell(100,15,"DIRECCION FISCAL DEL AGENTE DE RETENCION", 1, 0,'C', 0);
    $pdf->SetFont('Arial', 'B', 5.5);
    $pdf->Cell(44.5,15,"F. EMISION", 1, 0,'C', 0);
    $pdf->Cell(44.5,15, 'F. ENTREGA',1, 0,'C', 0);
    $pdf->Ln(5);

    $pdf->SetFont('Arial', '', 5);
    $pdf->Cell(100,10,"Calle San Felix s/n La Sabanita, telefono: (0285) 6515986, Ciudad Bolivar - Estado Bolivar.", 0, 0,'C', 0);
    $pdf->Cell(44.5,10,revertirFecha($Filas['fEmision']), 0, 0,'C', 0);
    $pdf->Cell(44.5,10,revertirFecha($Filas['fEntrega']),0, 0,'C', 0);
    $pdf->Ln(10);

    //  FINAL - DATOS DEL AGENTE DE RETENCION

    $pdf->SetFont('Arial', 'B', 6);
    $pdf->Cell(63,15,"NOMBRE O RAZON SOCIAL DEL SUJETO RETENIDO", 1, 0,'C', 0);
    $pdf->Cell(63,15,"RIF. DEL SUJETO DE RETENCION", 1, 0,'C', 0);
    $pdf->Cell(63,15,"PERIODO FISCAL",1, 0,'C', 0);
    $pdf->Ln(5);

    $pdf->SetFont('Arial', '', 5);
    $pdf->Cell(63,10,$Filas['proveedor'], 0, 0,'C', 0);
    $pdf->Cell(63,10,$Filas['rifProveedor'], 0, 0,'C', 0);
    $pdf->SetFont('Arial', 'B', 5);
    $pdf->Cell(31,10,"A".utf8_decode("Ñ")."O: ".substr($Filas['nroComprobante'],0,4),0, 0,'C', 0);
    $pdf->Cell(31,10,"MES: ".substr($Filas['nroComprobante'],4,2),0, 0,'C', 0);
    $pdf->Ln(10);

    $pdf->SetFont('Arial', 'B', 3);
    $pdf->Cell(10,5,"OPERACION N".utf8_decode("º"), 1, 0,'C', 0);
    $pdf->Cell(20,5,"FECHA FACTURA", 1, 0,'C', 0);
    $pdf->Cell(10,5,'N'.utf8_decode("º").' FACTURA',1, 0,'C', 0);
    $pdf->Cell(25,5,'N'.utf8_decode("º").' CONTROL FACTURA y/ Maquina Fiscal',1, 0,'C', 0);
    $pdf->Cell(25,5,'TOTAL FACTURADO INCLUYENDO IVA',1, 0,'C', 0);
    $pdf->Cell(20,5,"BASE IMPONIBLE", 1, 0,'C', 0);
    $pdf->Cell(20,5,"% ALIC.", 1, 0,'C', 0);
    $pdf->Cell(20,5,"IMPUSTO IVA",1, 0,'C', 0);
    $pdf->Cell(20,5,"% RETENIDO",1, 0,'C', 0);
    $pdf->Cell(19,5,"IVA RETENIDO",1, 0,'C', 0);
    $pdf->Ln(5);

    // PROVEEDOR

            $pdf->Cell(10,5, "01", 1, 0,'C', 0);
            $pdf->Cell(20,5, revertirFecha($Filas['fFactura']), 1.2, 0,'C', 0);
            $pdf->Cell(10,5, $Filas['nroFactura'], 1.2, 0,'C', 0);
            $pdf->Cell(25,5, $Filas['nroControl'], 1.2, 0,'C', 0);
            $pdf->Cell(25,5, $Filas['totalFacturado'], 1.2, 0,'C', 0);
            $pdf->Cell(20,5, $Filas['baseImponible'], 1.2, 0,'C', 0);
            $pdf->Cell(20,5, '%16', 1.2, 0,'C', 0);
            $pdf->Cell(20,5, $Filas['impuestoIva'], 1.2, 0,'C', 0);
            $pdf->Cell(20,5, '%75', 1.2, 0,'C', 0);
            $pdf->Cell(19,5, $Filas['ivaRetenido'], 1.2, 0,'C', 0);
            $pdf->Ln(5);
        }
    }

$pdf->Output('PDF.pdf', 'I');

?>



