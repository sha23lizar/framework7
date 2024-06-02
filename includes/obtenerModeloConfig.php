<?php
include("conexion.php");

// Verificar la conexión
if ($conexionMysqli->connect_error) {
    die("Error en la conexión: " . $conexionMysqli->connect_error);
}
// Consulta SQL para seleccionar los datos de los usuarios
$sql = "SELECT configuracion FROM modelos WHERE id = 1";
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
    echo "No se encontraron proveedores.";
}


// Cerrar la conexión
$conexionMysqli->close();
