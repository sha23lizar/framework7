<?php

include 'config.php';

session_start();

// Verificar si la sesión no está activa
if (!isset($_SESSION['SESSION_EMAIL'])) {
    // Redireccionar al usuario a la página de inicio de sesión
    header("Location: index.php");
    exit(); // Detener la ejecución del script
  }
  
  // Verificar el rol del usuario
  if ($_SESSION['ROLE'] != 'usuario') {
    // Redireccionar al usuario a la página principal si no es administrador
    header("Location: index.php");
    exit(); // Detener la ejecución del script
  }
  
$current_email = $_SESSION['SESSION_EMAIL'];

$msg = "";

// Verificar si se envió el formulario para cambiar el nombre de usuario
if (isset($_POST['name'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);

    // Actualiza el nombre de usuario en la base de datos
    $sql = "UPDATE users SET name = '$name' WHERE email = '$current_email'";
    if (mysqli_query($conn, $sql)) {
        $_SESSION['SESSION_NAME'] = $name; // Si también estás almacenando el nombre en la sesión
        header("Location: preloader.php.");
        exit();
    } else {
        $msg = "<div class='alert alert-danger'>Error al actualizar el nombre de usuario.</div>";
    }
}

// Verificar si se envió el formulario para cambiar el correo electrónico
if (isset($_POST['email'])) {
    $new_email = mysqli_real_escape_string($conn, $_POST['email']);

    // Actualiza el correo electrónico en la base de datos
    $sql = "UPDATE users SET email = '$new_email' WHERE email = '$current_email'";
    if (mysqli_query($conn, $sql)) {
        // Actualiza la sesión con el nuevo correo electrónico
        $_SESSION['SESSION_EMAIL'] = $new_email;
        header("Location: preloader.php"); // Redirigir a una página de cierre de sesión para que el usuario vuelva a iniciar sesión con el nuevo correo
        exit();
    } else {
        $msg = "<div class='alert alert-danger'>Error al actualizar el correo electrónico.</div>";
    }
}

// Verificar si se envió el formulario para cambiar la pregunta de seguridad
if (isset($_POST['pregunta_seguridad'])) {
    $new_question = mysqli_real_escape_string($conn, $_POST['pregunta_seguridad']);

    // Actualizar la pregunta de seguridad en la base de datos
    $sql = "UPDATE users SET pregunta_seguridad = '$new_question' WHERE email = '$current_email'";
    if (mysqli_query($conn, $sql)) {
        header("Location: preloader.php.");
        exit();
    } else {
        $msg = "<div class='alert alert-danger'>Error al actualizar la pregunta de seguridad.</div>";
    }
}

// Verificar si se envió el formulario para cambiar la respuesta de seguridad
if (isset($_POST['respuesta_seguridad'])) {
    $new_res = mysqli_real_escape_string($conn, $_POST['respuesta_seguridad']);

    // Actualizar la respuesta de seguridad en la base de datos
    $sql = "UPDATE users SET respuesta_seguridad = '$new_res' WHERE email = '$current_email'";
    if (mysqli_query($conn, $sql)) {
        header("Location: preloader.php.");
        exit();
    } else {
        $msg = "<div class='alert alert-danger'>Error al actualizar la respuesta de seguridad.</div>";
    }
}