<?php
session_start();

if (!isset($_SESSION['SESSION_EMAIL'])) {
    header("Location: ../index.php");
    exit();
}

if (!isset($_POST['order_id'])) {
    die("ID de pedido no proporcionado.");
}

include '../config.php'; // Adjust the path if necessary
require('fpdf.php'); // Include the FPDF library

class PDF extends FPDF
{
    // Page header
    function Header()
    {
        $this->SetFont('Arial', 'B', 12);
        $this->Ln(5);
        $this->Cell(80);
        $this->Cell(30, 10, 'Shalom Creative Design', 0, 0, 'C');
        $this->Ln(5);
        $this->Cell(80);
        $this->Cell(30, 10, 'Empresa de timbrado de camisetas', 0, 0, 'C');
        $this->Ln(5);
        $this->Cell(80);
        $this->Cell(30, 10, 'Ubicada En Ciudad Bolivar Estado Bolivar', 0, 0, 'C');
        $this->Ln(5);
        $this->Cell(80);
        $this->Cell(30, 10, 'RIF J-09513933-6', 0, 0, 'C');
        $this->Ln(20);
        $this->Cell(80);
        $this->Cell(30, 10, 'Reporte de Pedido', 0, 1, 'C');
        $this->Ln(10);
        

        $this->SetFont('Arial', 'B', 8);
        $this->Cell(40, 10, 'Nombre', 1, 0);
        $this->Cell(50, 10, 'Email', 1, 0);
        $this->Cell(15, 10, 'Genero', 1, 0, 'C');
        $this->Cell(10, 10, 'XS', 1, 0, 'C');
        $this->Cell(10, 10, 'S', 1, 0, 'C');
        $this->Cell(10, 10, 'M', 1, 0, 'C');
        $this->Cell(10, 10, 'L', 1, 0, 'C');
        $this->Cell(10, 10, 'XL', 1, 0, 'C');
        $this->Cell(30, 10, 'Fecha', 1, 0);
        $this->Ln();
    
     
    }

    // Page footer
    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');
    }
}

// Database connection
$conn = mysqli_connect("localhost", "root", "", "login");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$order_id = $_POST['order_id'];
$email = isset($_SESSION['SESSION_EMAIL']) ? $_SESSION['SESSION_EMAIL'] : null;

if (!$email) {
    die("Email de usuario no definido.");
}

$sql = "SELECT * FROM orders WHERE id = '$order_id' AND email = '$email'";
$result = mysqli_query($conn, $sql);

if (!$result || mysqli_num_rows($result) == 0) {
    die("Error al consultar la base de datos o pedido no encontrado: " . mysqli_error($conn));
}

$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 8);
$row = mysqli_fetch_assoc($result);
$pdf->Cell(40, 10, utf8_decode($row['name']), 1, 0);
$pdf->Cell(50, 10, $row['email'], 1, 0);
$pdf->Cell(15, 10, utf8_decode($row['genero']), 1, 0, 'C');
$pdf->Cell(10, 10, $row['xs'], 1, 0, 'C');
$pdf->Cell(10, 10, $row['s'], 1, 0, 'C');
$pdf->Cell(10, 10, $row['m'], 1, 0, 'C');
$pdf->Cell(10, 10, $row['l'], 1, 0, 'C');
$pdf->Cell(10, 10, $row['xl'], 1, 0, 'C');
$pdf->Cell(30, 10, $row['order_date'], 1, 0);
$pdf->Ln();
$pdf->Cell(13);
$pdf->Cell(160, 10, 'Numero de pedido: ' . $order_id, 1, 0, 'C');


// Código para generar el PDF...
$pdf_filename = 'reporte_pedido_' . $_POST['order_id'] . '.pdf';
$pdf->Output('D', $pdf_filename);

// Leer el contenido del PDF generado
$pdf_content = file_get_contents($pdf_filename);

// Encabezados para indicar que el contenido es un PDF
header("Content-type: application/pdf");
header("Content-Disposition: inline; filename='$pdf_filename'");
header('Content-Length: ' . strlen($pdf_content));

// Devolver el contenido del PDF como respuesta
echo $pdf_content;

?>



