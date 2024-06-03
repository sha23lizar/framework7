<?php
include("conexion.php");

// Verificar la conexión
if ($conexionMysqli->connect_error) {
    die("Error en la conexión: " . $conexionMysqli->connect_error);
}
$nombre = $_POST['nombre'];
$color = $_POST['color'];
$preview = $_POST['preview'];
$personalizaciones = $_POST['personalizaciones'];
$user_id = $_POST['user_id'];

$sql = "INSERT INTO diseños(nombre, color, preview, personalizaciones, user_id) VALUES ('$nombre', '$color', '$preview', '$personalizaciones', '$user_id')";

// Consulta SQL para seleccionar los datos de los usuarios
$result = $conexionMysqli->query($sql);

echo $result;

// Cerrar la conexión
$conexionMysqli->close();
