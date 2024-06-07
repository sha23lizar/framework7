<?php
/*
session_start();
if (isset($_SESSION['SESSION_EMAIL'])) {
    header("Location: welcome.php");
    die();
}

require './vendor/autoload.php'; // Asegúrate de que este path sea correcto para cargar las librerías de Composer si es necesario.
include 'config.php'; // Asegúrate de que este path sea correcto para incluir tu configuración de la base de datos.
$msg = "";

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm-password']);
    $pregunta_seguridad = mysqli_real_escape_string($conn, $_POST['pregunta_seguridad']);
    $respuesta_seguridad = mysqli_real_escape_string($conn, $_POST['respuesta_seguridad']);

    // Validación de la contraseña
    $password_pattern = '/^(?=.*[A-Z])(?=.*[0-9]).{6,}$/';
    if (!preg_match($password_pattern, $password)) {
        $msg = "<div class='alert alert-danger'>La contraseña debe tener al menos 6 caracteres con al menos una letra mayúscula y un numero.</div>";
    } elseif ($password !== $confirm_password) {
        $msg = "<div class='alert alert-danger'>Las contraseñas no coinciden.</div>";
    } elseif (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE email='{$email}'")) > 0) {
        $msg = "<div class='alert alert-danger'>{$email} - Esta dirección de correo electrónico ya existe.</div>";
    } else {
        // Si la contraseña es válida y el correo no existe, procede a registrar al usuario
        $password = md5($password); // Hash de la contraseña para almacenarla de manera segura
        
        $sql = "INSERT INTO users (name, email, password, pregunta_seguridad, respuesta_seguridad, role) VALUES ('{$name}', '{$email}', '{$password}', '{$pregunta_seguridad}', '{$respuesta_seguridad}', 'usuario')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $msg = "<div class='alert alert-success'>Registro exitoso. Ahora puedes <a href='index.php' class'alert alert-success'>iniciar sesión</a>.</div>";
        } else {
            $msg = "<div class='alert alert-danger'>Algo salió mal al intentar crear su cuenta.</div>";
        }
    }
}
*/




session_start();
if (isset($_SESSION['SESSION_EMAIL'])) {
    header("Location: welcome.php");
    die();
}

require './vendor/autoload.php'; // Asegúrate de que este path sea correcto para cargar las librerías de Composer si es necesario.
include 'config.php'; // Asegúrate de que este path sea correcto para incluir tu configuración de la base de datos.
$msg = "";

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm-password']);
    $pregunta_seguridad = mysqli_real_escape_string($conn, $_POST['pregunta_seguridad']);
    $respuesta_seguridad = mysqli_real_escape_string($conn, $_POST['respuesta_seguridad']);

    // Validación de la contraseña
    $password_pattern = '/^(?=.*[A-Z])(?=.*[0-9]).{6,}$/';
    if (!preg_match($password_pattern, $password)) {
        $msg = "<div class='alert alert-danger'>La contraseña debe tener al menos 6 caracteres con al menos una letra mayúscula y un número.</div>";
    } elseif ($password !== $confirm_password) {
        $msg = "<div class='alert alert-danger'>Las contraseñas no coinciden.</div>";
    } elseif (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE email='{$email}'")) > 0) {
        $msg = "<div class='alert alert-danger'>{$email} - Esta dirección de correo electrónico ya existe.</div>";
    } else {
        // Si la contraseña es válida y el correo no existe, procede a registrar al usuario
        $password = md5($password); // Hash de la contraseña para almacenarla de manera segura
        
        $sql = "INSERT INTO users (name, email, password, pregunta_seguridad, respuesta_seguridad, role) VALUES ('{$name}', '{$email}', '{$password}', '{$pregunta_seguridad}', '{$respuesta_seguridad}', 'usuario')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            // Redirigir a una página después del registro exitoso
            header("Location: preloader.php");
            exit();
        } else {
            $msg = "<div class='alert alert-danger'>Algo salió mal al intentar crear su cuenta.</div>";
        }
    }
}




?>


<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>Login Form</title>
    <!-- Meta tag Keywords -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8" />
    <meta name="keywords"
        content="Login Form" />
    <!-- //Meta tag Keywords -->

    <link href="//fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!--/Style-CSS -->
    <link rel="stylesheet" href="css/style.css"/>
    <!--//Style-CSS -->
    <link rel="stylesheet" type="text/css" href="../css/toastify.css">

    <script src="https://kit.fontawesome.com/af562a2a63.js" crossorigin="anonymous"></script>

</head>
<style>
    * {
       margin: 0;
       padding: 0;
       box-sizing: border-box;
    }

    .container {
    max-width: 880px;
    margin: auto;
    height: 83vh;
    }  



    input {
        height: 56.5px;
    }

    .boton {
        color: red;
        height: 40px;
        width: auto;
        padding: 20px;
    }

</style>
<body>

  <!-- form section start -->
  <section class="w3l-mockup-form" style="margin-bottom:5em">
        <div class="container">
            <!-- /form -->
            <div class="workinghny-form-grid">
                <div class="main-mockup">
                    
                    <div class="w3l_form align-self">
                        <div class="left_grid_info" >
                            <img src="./images/login.png" alt="">
                            <?php echo $msg; ?>
                        </div>
                    </div>
                    <div class="content-wthree">
                        <h2>Registrarse</h2>
                        <form action="" method="POST">
                        
                            <input type="text" class="name" name="name" placeholder="Ingresa tu nombre" value="<?php if (isset($_POST['submit'])) { echo $name; } ?>" required>
                            <input type="email" class="email" name="email" placeholder="Ingresa tu correo" value="<?php if (isset($_POST['submit'])) { echo $email; } ?>" required>
                            <input type="password" class="password" name="password" placeholder="Ingresa tu contraseña" value="<?php if (isset($_POST['submit'])) { echo $password; } ?>" required>
                            <input type="password" class="confirm-password" name="confirm-password" value="<?php if (isset($_POST['submit'])) { echo $confirm_password; } ?>" placeholder="Confirma tu contraseña" required>
    

                        

                            <input  type="text" class="pregunta_seguridad" name="pregunta_seguridad" value="<?php if (isset($_POST['submit'])) { echo $pregunta_seguridad; } ?>" placeholder="Ingresa tu pregunta de seguridad" required>
                            <input  type="text" class="respuesta_seguridad" name="respuesta_seguridad" value="<?php if (isset($_POST['submit'])) { echo $respuesta_seguridad; } ?>" placeholder="Ingresa tu respuesta" required>
                            <button name="submit" id="boton" class="btn" type="submit">Avanzar</button>
                        </form>

                        <div class="social-icons">    
                            <p> <a href="index.php">Volver a login</a></p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- //form -->
        </div>
    </section>

<script type="text/javascript" src="../js/toastify.js"></script>

<script>

document.addEventListener('DOMContentLoaded', function() {
        // Obtener los campos de pregunta y respuesta
        const name = document.querySelector('.name');
        const email = document.querySelector('.email');
        const password = document.querySelector('.password');
        const confirmPassword = document.querySelector('.confirm-password');
        const preguntaSeguridad = document.querySelector('.pregunta_seguridad');
        const respuestaSeguridad = document.querySelector('.respuesta_seguridad');

        // Ocultar los campos inicialmente
        preguntaSeguridad.style.display = 'none';
        respuestaSeguridad.style.display = 'none';

        // Mostrar los campos después de enviar el formulario principal
        const submitButton = document.querySelector('[name="submit"]');
        submitButton.addEventListener('click', function() {
            if (password.value !== confirmPassword.value) {
                Toastify({
                        text: "La contraseñas no coinciden.",
                        duration: 4000,
                        close: 3 % 3 ? true : false,
                        style: {
                            background: "linear-gradient(to right, #ff5f6d, #ff9800)",
                        }
                    }).showToast();
                return;
            }
            name.style.display = 'none';
            email.style.display = 'none';
            password.style.display = 'none';
            confirmPassword.style.display = 'none';
            preguntaSeguridad.style.display = 'block';
            respuestaSeguridad.style.display = 'block';
        });
    });
</script>






    <script src="js/jquery.min.js"></script>
    <script>
        $(document).ready(function (c) {
            $('.alert-close').on('click', function (c) {
                $('.main-mockup').fadeOut('slow', function (c) {
                    $('.main-mockup').remove();
                });
            });
        });
    </script>

</body>

</html>