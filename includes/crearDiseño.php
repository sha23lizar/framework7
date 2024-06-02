<?php
include("conexion.php");

// Verificar la conexión
if ($conexionMysqli->connect_error) {
    die("Error en la conexión: " . $conexionMysqli->connect_error);
}
$nombre = $_POST['nombre'];
$color = $_POST['color'];
$personalizaciones = $_POST['personalizaciones'];
$sql = "INSERT INTO diseños (nombre, color, personalizaciones) VALUES ('$nombre', '$color', '$personalizaciones')";
// Consulta SQL para seleccionar los datos de los usuarios
$result = $conexionMysqli->query($sql);

echo $result;

// Cerrar la conexión
$conexionMysqli->close();
