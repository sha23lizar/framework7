<?php
/*
// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conectar a la base de datos
    $servername = "localhost";
    $username = "root"; // Reemplaza con tu nombre de usuario de MySQL
    $password = ""; // Reemplaza con tu contraseña de MySQL
    $dbname = "crud"; // Reemplaza con el nombre de tu base de datos

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Error en la conexión: " . $conn->connect_error);
    }

    // Obtener los datos del formulario
    $Rif = $_POST["Rif"];
    $Razonsocial = $_POST["Razonsocial"];
    $Direccion = $_POST["Direccion"];
    $Seudonimo = $_POST["Seudonimo"];
    $imagen_empresa = $_FILES["imagen_empresa"]["name"]; // Obtener el nombre del archivo de imagen

    // Ruta donde se guardarán las imágenes (asegúrate de que esta carpeta tenga permisos de escritura)
    $target_dir = "./img/";
    $target_file = $target_dir . basename($_FILES["imagen_empresa"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Permitir ciertos formatos de imagen
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Solo se permiten archivos JPG, JPEG, PNG y GIF.";
        $uploadOk = 0;
    }

    // Verificar si la imagen se subió correctamente
    if ($uploadOk == 0) {
        echo "Hubo un error al subir la imagen.";
    } else {
        if (move_uploaded_file($_FILES["imagen_empresa"]["tmp_name"], $target_file)) {
            echo "El archivo ". htmlspecialchars( basename( $_FILES["imagen_empresa"]["name"])). " ha sido subido.";
        } else {
            echo "Hubo un error al subir la imagen.";
        }
    }

    // Consulta SQL para insertar los datos en la tabla
    $sql = "INSERT INTO empresas (Rif, Razonsocial, Direccion, Seudonimo, imagen_empresa) VALUES ('$Rif', '$Razonsocial', '$Direccion', '$Seudonimo', '$imagen_empresa')";

    // Ejecutar la consulta
    if ($conn->query($sql) === TRUE) {
        echo "Datos almacenados correctamente en la base de datos.";
    } else {
        echo "Error al almacenar los datos en la base de datos: " . $conn->error;
    }

    // Cerrar la conexión
    $conn->close();
}
*/
?>

<?php

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conectar a la base de datos
    $servername = "localhost";
    $username = "root"; // Reemplaza con tu nombre de usuario de MySQL
    $password = ""; // Reemplaza con tu contraseña de MySQL
    $dbname = "login"; // Reemplaza con el nombre de tu base de datos

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Error en la conexión: " . $conn->connect_error);
    }

    // Obtener los datos del formulario
    $name = $_POST["name"];
    $email = $_POST["email"];
    $pregunta_seguridad = $_POST["pregunta_seguridad"];
    $respuesta_seguridad = $_POST["respuesta_seguridad "];

    // Consulta SQL para insertar los datos en la tabla
    $sql = "INSERT INTO users (name, email, pregunta_seguridad, respuesta_seguridad) VALUES ('$name', '$email', '$pregunta_seguridad', '$respuesta_seguridad')";

    // Ejecutar la consulta
    if ($conn->query($sql) === TRUE) {
        echo "Datos almacenados correctamente en la base de datos.";
    } else {
        echo "Error al almacenar los datos en la base de datos: " . $conn->error;
    }

    // Cerrar la conexión
    $conn->close();
}

?>



