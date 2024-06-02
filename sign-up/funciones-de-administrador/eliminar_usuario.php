<?php
session_start();

include '../config.php';

// Verificar si se ha enviado el formulario para eliminar un usuario
if (isset($_POST['eliminar_usuario'])) {
    // Obtener el ID del usuario a eliminar
    $user_id = $_POST['user_id'];

    // Verificar el rol del usuario antes de eliminarlo
    $role_query = "SELECT role FROM users WHERE id = ?";
    $stmt = $conn->prepare($role_query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($role);
        $stmt->fetch();
        
        // Verificar si el usuario tiene el rol de administrador
        if ($role !== 'administrador') {
            // Preparar la consulta SQL para eliminar el usuario
            $delete_query = "DELETE FROM users WHERE id = ?";
            $stmt = $conn->prepare($delete_query);
            $stmt->bind_param("i", $user_id);

            // Ejecutar la consulta
            if ($stmt->execute()) {
                // Redireccionar de vuelta a la página de administrador con un mensaje de éxito
                header("Location: usuarios_registrados.php.php?delete_success=true");
                exit();
            } else {
                // Si hay un error en la ejecución de la consulta, mostrar un mensaje de error
                echo "Error al eliminar el usuario.";
            }
        } else {
            echo "No puedes eliminar a un administrador.";
        }
    } else {
        echo "Usuario no encontrado.";
    }
} else {
    // Si no se ha enviado el formulario de eliminación, redireccionar a la página de inicio
    header("Location: ../index.php");
    exit();
}
?>