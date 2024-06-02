<?php
include("conexion.php");

// Verificar la conexión
if ($conexionMysqli->connect_error) {
    die("Error en la conexión: " . $conexionMysqli->connect_error);
}
$id = $_POST['id'];
$nombre = $_POST['nombre'];
$color = $_POST['color'];
$personalizaciones = $_POST['personalizaciones'];

$sql = "UPDATE diseños SET nombre = '$nombre', color = '$color', personalizaciones = '$personalizaciones' WHERE id = '$id'";

// Consulta SQL para seleccionar los datos de los usuarios
$result = $conexionMysqli->query($sql);

echo $result;

// Cerrar la conexión
$conexionMysqli->close();
