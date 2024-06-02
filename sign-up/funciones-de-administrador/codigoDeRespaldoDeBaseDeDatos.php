<?php
// Datos de conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$database = "login";


date_default_timezone_set('America/Caracas');

// Conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Nombre del archivo de respaldo
$backup_file = 'respaldos_' . date('Y-m-d_H-i-s') . '.sql';

// Ruta del directorio donde se almacenarán los respaldos
$backup_folder = '../Respaldo/respaldos/';

// Verificar si el directorio de respaldos existe, si no, crearlo
if (!file_exists($backup_folder)) {
    mkdir($backup_folder, 0777, true);
}

// Ruta completa para el archivo de respaldo
$backup_path = $backup_folder . $backup_file;

// Abre el archivo de respaldo en modo escritura
$backup_handle = fopen($backup_path, 'w');

// Consulta para obtener la estructura de las tablas
$tables_query = "SHOW TABLES";
$tables_result = $conn->query($tables_query);

// Genera el contenido del archivo SQL
fwrite($backup_handle, "-- Respaldo de la base de datos " . $database . "\n\n");
while ($table_row = $tables_result->fetch_row()) {
    $table_name = $table_row[0];
    fwrite($backup_handle, "-- Respaldo de la tabla " . $table_name . "\n");

    // Obtiene la estructura de la tabla
    $create_table_query = "SHOW CREATE TABLE $table_name";
    $create_table_result = $conn->query($create_table_query);
    $create_table_row = $create_table_result->fetch_row();
    fwrite($backup_handle, $create_table_row[1] . ";\n\n");

    // Obtiene los datos de la tabla
    $select_table_query = "SELECT * FROM $table_name";
    $select_table_result = $conn->query($select_table_query);
    while ($row = $select_table_result->fetch_assoc()) {
        $row_values = array_map([$conn, 'real_escape_string'], array_values($row));
        $insert_values = implode("','", $row_values);
        fwrite($backup_handle, "INSERT INTO $table_name VALUES ('$insert_values');\n");
    }
    fwrite($backup_handle, "\n");
}

// Cierra el archivo de respaldo
fclose($backup_handle);

// Escapar el contenido del respaldo
$sql_content_escaped = $conn->real_escape_string(file_get_contents($backup_path));

// Construir la consulta SQL para insertar el respaldo en la tabla respaldos
$sql_insert = "INSERT INTO respaldos (nombre, contenido) VALUES ('$backup_file', '$sql_content_escaped')";

// Ejecutar la consulta SQL para insertar el respaldo en la tabla respaldos
if ($conn->query($sql_insert) === TRUE) {
    // Redireccionar a otra página después de 0.3 segundos
    header("refresh:0.3;url=preloader.php");
} else {
    echo "Error al insertar el respaldo en la tabla: " . $conn->error;
}
// Cerrar la conexión a la base de datos
$conn->close();