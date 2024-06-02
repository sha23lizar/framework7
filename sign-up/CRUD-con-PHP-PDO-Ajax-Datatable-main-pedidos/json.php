<?php
// Conectar a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login"; // Reemplaza con el nombre de tu base de datos

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}

// Consulta SQL para seleccionar los datos de los usuarios
$sql = "SELECT * FROM orders";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Array para almacenar los datos de los usuarios
    $orders = array();

    // Recorrer los resultados y almacenarlos en el array
    while ($row = $result->fetch_assoc()) {
        $orders[] = $row;
    }

    // Convertir el array en formato JSON
    $json_data = json_encode($orders);

    // Devolver el JSON como respuesta
    echo $json_data;
} else {
    echo "No se encontraron usuarios.";
}

// Cerrar la conexión
$conn->close();
?>