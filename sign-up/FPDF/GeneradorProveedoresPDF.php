<?php
require('fpdf.php');

$Conexion=new mysqli("localhost","root","","feb","3306");
$Conexion->set_charset("utf8");


class PDF extends FPDF
{
// Cabecera de página

function Header()
{
    // Logo
    $this->Image('Logo.jpg',10,8,30);
    // Arial bold 15
    $this->SetFont('Arial','',10);

    // INICIO - TITULO   
    $this->Cell(80);
    $this->Cell(30,10,'Shalom Creative Design"',0,0,'C');
    $this->Ln(5);

    $this->Cell(80);
    $this->Cell(30,10,'LO MEJOR EN EDUCACION.',0,0,'C');
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

}

function Footer(){
    $this->SetFont('Arial','',10);
    $this->Ln(10);
    $this->Cell(80);
    $this->Cell(30,10,'________________________',0,0,'C');
    $this->Ln(10);
    $this->Cell(80);
    $this->Cell(30,10,'FIRMA Y SELLO DEL AGENTE DE RETENCION',0,0,'C');
    $this->SetFont('Arial','',5);
    $this->Ln(10);
    $this->Cell(80);
    $this->Cell(30,10,'ESTE COMPROBANTE SE EMITE EN FUNCION A LO ESTABLECIDO EN EL ATICULO 10 DE LA PROVIDENCIA ADMINISTRATIVA No SNAT/2015/0049 DE FECHA 10/08/2.015',0,0,'C');
}

}

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

    // INICIO - DATOS DE LA INSTITUCION

    $pdf->Cell(65);
    $pdf->SetFont('Arial', 'B', 20);
    $pdf->Cell(63,15,"Pedidos", 0, 0,'C', 0);
    $pdf->Ln(20);

    $pdf->SetFont('Arial', 'B', 3);
    $pdf->Cell(10,5,"OPERACION", 1, 0,'C', 0);
    $pdf->Cell(20,5,"FECHA FACTURA", 1, 0,'C', 0);
    $pdf->Cell(10,5,'No FACTURA',1, 0,'C', 0);
    $pdf->Cell(30,5,'No CONTROL FECHA y/ Maquina Fiscal',1, 0,'C', 0);
    $pdf->SetFont('Arial', 'B', 2.8);
    $pdf->Cell(20,5,'TOTAL FACTURADO INCLUYENDO IVA',1, 0,'C', 0);
    $pdf->Cell(20,5,"BASE IMPONIBLE", 1, 0,'C', 0);
    $pdf->Cell(20,5,"% ALIC.", 1, 0,'C', 0);
    $pdf->Cell(20,5,"IMPUSTO IVA",1, 0,'C', 0);
    $pdf->Cell(20,5,"% RETENIDO",1, 0,'C', 0);
    $pdf->Cell(19,5,"IVA RETENIDO",1, 0,'C', 0);
    $pdf->Ln(5);

    // ACA SE DEBE INCLUIR UN CICLO WHILE, DONDE SE CARGAN LOS DATOS

    $Datos = "SELECT * FROM comprobante";

$ResultDatos = mysqli_query($Conexion, $Datos);

while($Filas = $ResultDatos->fetch_assoc()){

    $pdf->Cell(10,5, $Filas['id'], 1, 0,'C', 0);
    $pdf->Cell(20,5, $Filas['fFactura'], 1, 0,'C', 0);
    $pdf->Cell(10,5,'000000', 1, 0,'C', 0);
    $pdf->Cell(30,5, $Filas['nroControl'], 1, 0,'C', 0);
    $pdf->Cell(20,5, $Filas['totalFacturado'], 1, 0,'C', 0);
    $pdf->Cell(20,5, $Filas['baseImponible'], 1, 0,'C', 0);
    $pdf->Cell(20,5, '%16', 1, 0,'C', 0);
    $pdf->Cell(20,5, $Filas['impuestoIva'], 1, 0,'C', 0);
    $pdf->Cell(20,5, '%75', 1, 0,'C', 0);
    $pdf->Cell(19,5, $Filas['ivaRetenido'], 1, 0,'C', 0);
    $pdf->Ln(5);
}

$pdf->Output('PDF.pdf', 'I');

?>
