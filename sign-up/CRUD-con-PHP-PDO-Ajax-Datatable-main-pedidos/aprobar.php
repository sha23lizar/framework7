<?php
// Verificar si se recibió el ID del pedido
if (isset($_POST["id_pedidos"])) {
    // Incluir el archivo de conexión a la base de datos
    include("conexion.php");

    // Obtener el ID del pedido desde la solicitud POST
    $id_pedido = $_POST["id_pedidos"];

    // Preparar la consulta para actualizar el estado del pedido a aprobado
    $stmt = $conexion->prepare("UPDATE orders SET estado = 'Aprobado' WHERE id = :id");

    // Ejecutar la consulta con el ID del pedido proporcionado
    $resultado = $stmt->execute(array(":id" => $id_pedido));

    // Verificar si la consulta se ejecutó correctamente
    if ($resultado) {
        echo "El pedido con ID " . $id_pedido . " ha sido aprobado correctamente.";
    } else {
        echo "Hubo un error al aprobar el pedido.";
    }
} else {
    echo "No se proporcionó un ID de pedido válido.";
}
?>

