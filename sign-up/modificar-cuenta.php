<?php
/*
session_start();

include 'config.php';

$msg = "";

if (isset($_POST['submit'])) {
    // Verifica si el correo electrónico enviado es válido
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $msg = "<div class='alert alert-danger'>¡El correo electrónico proporcionado no es válido!</div>";
    } else {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        
        // Actualiza la dirección de correo electrónico en la base de datos
        $update_query = mysqli_query($conn, "UPDATE users SET email='$email'");


        if ($update_query) {
            $msg = "<div class='alert alert-success'>¡El correo electrónico de ha sido actualizado correctamente!</div>";
        } else {
            $msg = "<div class='alert alert-danger'>¡Hubo un error al actualizar el correo electrónico de  " . mysqli_error($conn) . "!</div>";
        }
    }
}
*/


$msg = "";
include 'config.php';

if (isset($_GET['reset'])) {
    if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE code='{$_GET['reset']}'")) > 0) {
        if (isset($_GET['no-change'])) {
            // Lógica para eliminar el token 'code' ...
            $query = mysqli_query($conn, "UPDATE users SET code=''  WHERE code='{$_GET['reset']}'");
            if ($query) {
                $msg = "<div class='alert alert-success'>Token 'code' eliminado correctamente.</div>";
                // Redirigir al usuario a una página específica después de eliminar el token
                header("Location: index.php?token_deleted=true");
                exit(); // Detener la ejecución del script después de la redirección
            } else {
                $msg = "<div class='alert alert-danger'>Hubo un error al eliminar el token 'code'.</div>";
            }
        }
    } else {
        $msg = "<div class='alert alert-danger'>El enlace de restablecimiento no coincide.</div>";
    }
} else {
    header("Location: index.php");
    exit(); // Detener la ejecución del script después de la redirección
}














