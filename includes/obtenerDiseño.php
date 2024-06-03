<?php
include("conexion.php");

// Verificar la conexión
if ($conexionMysqli->connect_error) {
    die("Error en la conexión: " . $conexionMysqli->connect_error);
}
if (!isset($_GET["id"])) {
    echo json_encode(array());
    return;
}
$id = $_GET["id"];

// Consulta SQL para seleccionar los datos de los usuarios
$sql = "SELECT * FROM diseños WHERE id = '$id'";
$result = $conexionMysqli->query($sql);

if ($result->num_rows > 0) {
    // Array para almacenar los datos de los usuarios
    $comprobante = array();

    // Recorrer los resultados y almacenarlos en el array
    while ($row = $result->fetch_assoc()) {
        $comprobante[] = $row;
    }

    // Convertir el array en formato JSON
    $json_data = json_encode($comprobante);

    // Devolver el JSON como respuesta
    echo $json_data;
} else {
    echo json_encode(array());
}


// Cerrar la conexión
$conexionMysqli->close();
