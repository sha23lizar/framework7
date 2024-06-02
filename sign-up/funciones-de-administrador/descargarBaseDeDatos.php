<?php
/*
// Ruta del archivo de respaldo
$archivo_respaldo = '../Respaldo/respaldos/';

// Verificar si el archivo existe
if (file_exists($archivo_respaldo)) {
    // Establecer encabezados para la descarga
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . basename($archivo_respaldo) . '"');
    header('Content-Length: ' . filesize($archivo_respaldo));
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Expires: 0');
    // Leer el archivo y enviarlo al cliente
    readfile($archivo_respaldo);
    exit;
} else {
    // Si el archivo no existe, mostrar un mensaje de error
    echo "El archivo de respaldo no existe.";
}
*/
?>

<?php

/*
date_default_timezone_set('America/Caracas');
// Obtener el nombre del archivo de respaldo seleccionado
$idr = 'respaldo_' . date('Y-m-d_H-i-s')  . '_' . $parts[1];

// Extraer la fecha del nombre del archivo
$parts = explode('_', $nombre_archivo);
$fecha_archivo = $parts[1]; // Aquí asumimos que la fecha está en el segundo segmento del nombre del archivo

// Consultar la fecha de respaldo en la base de datos
$sql = "SELECT contenido FROM nombre WHERE fecha = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $idr);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$fecha_bd = $row['fecha']; // Obtener la fecha de la base de datos

// Comparar las fechas
if ($idr == $fecha_bd) {
    // Las fechas coinciden, procede con la descarga
    $ruta_archivo = '../Respaldo/respaldos/' . $nombre_archivo;

    // Establecer encabezados para la descarga
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . basename($ruta_archivo) . '"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($ruta_archivo));

    // Leer y enviar el archivo al cliente
    readfile($ruta_archivo);
    exit;
} else {
    // Las fechas no coinciden, mostrar un mensaje de error
    echo "La fecha del archivo de respaldo no coincide con la fecha en la base de datos.";
}
*/
?>
<?php
/*
include("bd.inc.php");

if(isset($_REQUEST['descargar'])) {
    // Obtener el idr desde la solicitud
    $idr = $_REQUEST['idr'];
    
    // Construir la ruta del archivo
    $rutaArchivo = '../Respaldo/respaldos/' . $idr . '.sql';

    // Verificar si el archivo existe
    if(file_exists($rutaArchivo)) {
        // Descargar el archivo
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.basename($rutaArchivo).'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($rutaArchivo));
        readfile($rutaArchivo);
        exit();
    } else {
        // El archivo no existe
        echo "El archivo no existe";
    }
} else {
    // Si 'descargar' no está presente en la solicitud, redirigir a una página de error
    header("Location: ./preloaderError.php");
    exit();
}
*/
?>

<?php

include("../config.php");

// Verificar si se ha solicitado una descarga
if(isset($_REQUEST['descargar'])) {
    // Obtener el idr desde la solicitud
    $idr = $_REQUEST['idr'];
    
    // Consultar la base de datos para obtener la ruta del archivo asociado a ese idr
    $sql = "SELECT nombre FROM respaldos WHERE idr='$idr'";
    $resultado = mysqli_query($conn, $sql);

    // Verificar si se encontró un resultado
    if($resultado && mysqli_num_rows($resultado) > 0) {
        // Obtener la fila asociada al idr
        $fila = mysqli_fetch_assoc($resultado);
        // Obtener el nombre del archivo
        $nombreArchivo = $fila['nombre'];
        // Ruta donde se encuentra el archivo
        $rutaArchivo = '../Respaldo/respaldos/' . $nombreArchivo;

        // Verificar si el archivo existe
        if(file_exists($rutaArchivo)) {
            // Descargar el archivo
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="'.basename($rutaArchivo).'"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($rutaArchivo));
            readfile($rutaArchivo);
            exit();
        } else {
            // El archivo no existe
            echo "El archivo no existe";
        }
    } else {
        // Si no se encontró un archivo asociado al idr, mostrar un mensaje de error
        echo "No se encontró ningún archivo asociado al ID de respaldo proporcionado.";
    }
} else {
    // Si 'descargar' no está presente en la solicitud, redirigir a una página de error
    header("Location: ./preloaderError.php");
    exit();
}

?>














