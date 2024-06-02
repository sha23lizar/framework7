<?php
/*
// Recibir el ID del pedido de la URL
if (!isset($_GET['order_id'])) {
    die("ID de pedido no proporcionado.");
}

$order_id = $_GET['order_id'];

// Mostrar el PDF
echo "<embed src='reporte_pedido_$order_id.pdf' type='application/pdf' width='100%' margin height='750px' />";
*/
?>

<?php
// Recibir el nombre del archivo PDF de la URL
if (!isset($_GET['pdf_filename'])) {
    die("Nombre del archivo PDF no proporcionado.");
}

$pdf_filename = $_GET['pdf_filename'];

// Mostrar el PDF sin márgenes y que ocupe toda la página
echo "<iframe src='$pdf_filename' style='border: none; width: 100%; height: 100vh;'></iframe>";
?>


