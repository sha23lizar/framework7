<?php
// Verificar si se han enviado datos mediante el método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si el campo de archivo no está vacío
    if (!empty($_FILES["file-agregar-file"]["name"]) && !empty($_POST["textoAgregado"])) {
        // Conectar a la base de datos
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "login";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verificar la conexión
        if ($conn->connect_error) {
            die("Error en la conexión: " . $conn->connect_error);
        }

        // Preparar los datos para insertar en la base de datos
        $texto = $_POST["textoAgregado"];
        $archivo = $_FILES["file-agregar-file"]["name"];

        // Consulta SQL para insertar los datos en la tabla
        $sql = "INSERT INTO franel (texto, archivo) VALUES ('$texto', '$archivo')";

        // Ejecutar la consulta
        if ($conn->query($sql) === TRUE) {
            echo "Datos almacenados correctamente en la base de datos.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Cerrar la conexión
        $conn->close();
    } else {
        echo "Por favor, complete todos los campos.";
    }
}
?>
