<?php


/*
session_start();
if (isset($_SESSION['SESSION_EMAIL'])) {
    header("Location: welcome.php");
    die();
}

include 'config.php';
$msg = "";

if (isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    // Corrige las variables para preguntas y respuestas de seguridad
    $pregunta_seguridad = mysqli_real_escape_string($conn, $_POST['pregunta_seguridad']);
    $respuesta_seguridad = mysqli_real_escape_string($conn, $_POST['respuesta_seguridad']);
    $code = mysqli_real_escape_string($conn, md5(rand()));

    // Asegúrate de que la consulta busque tanto por email, nombre y también verifique la pregunta y respuesta de seguridad
    $query = mysqli_query($conn, "SELECT * FROM users WHERE email='{$email}' AND name='{$name}' AND pregunta_seguridad='{$pregunta_seguridad}'");

    if (mysqli_num_rows($query) > 0) {
        // Verifica que la respuesta de seguridad coincida
        $user = mysqli_fetch_assoc($query);
        if ($user['respuesta_seguridad'] === $respuesta_seguridad) {
            $updateQuery = mysqli_query($conn, "UPDATE users SET code='{$code}' WHERE email='{$email}' AND name='{$name}' AND pregunta_seguridad='{$pregunta_seguridad}'");
            
            if ($updateQuery) {
                $_SESSION['ALLOWED'] = true;
                    $msg = "<div class='alert alert-success'>los datos introducidos son correctos.</div>";
                    
                    $redirect_url = "change-password.php?reset=$code";
                    
                    $redirect_delay = 1; // segundos

                    echo "<meta http-equiv='refresh' content='{$redirect_delay};url={$redirect_url}'>";
                } else {
                    $msg = "<div class='alert alert-danger'>Hubo un error al cambiar la contraseña.</div>";
                }
        } else {
            $msg = "<div class='alert alert-danger'>La respuesta a la pregunta de seguridad no coincide.</div>";
        }
    } else {
        $msg = "<div class='alert alert-warning'>No existe un usuario con ese correo, nombre y pregunta de seguridad.</div>";
    }
}
*/


session_start();


include 'config.php'; // Adjust the path if necessary

// Inicializar variables
$msg = '';
$email = '';
$name = '';
$pregunta_seguridad = '';
$respuesta_seguridad = '';

if (isset($_POST['submit_step1'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);

    // Consulta para obtener la pregunta de seguridad
    $query = mysqli_query($conn, "SELECT pregunta_seguridad FROM users WHERE email='{$email}' AND name='{$name}'");

    if (mysqli_num_rows($query) > 0) {
        $user = mysqli_fetch_assoc($query);
        $pregunta_seguridad = $user['pregunta_seguridad'];
        $_SESSION['email'] = $email;
        $_SESSION['name'] = $name;
    } else {
        $msg = "<div class='alert alert-warning'>No existe un usuario con ese correo y nombre.</div>";
    }
}

if (isset($_POST['submit_step2'])) {
    $email = $_SESSION['email'];
    $name = $_SESSION['name'];
    $respuesta_seguridad = mysqli_real_escape_string($conn, $_POST['respuesta_seguridad']);
    $code = mysqli_real_escape_string($conn, md5(rand()));

    // Consulta para verificar la respuesta de seguridad
    $query = mysqli_query($conn, "SELECT * FROM users WHERE email='{$email}' AND name='{$name}'");

    if (mysqli_num_rows($query) > 0) {
        $user = mysqli_fetch_assoc($query);
        if ($user['respuesta_seguridad'] === $respuesta_seguridad) {
            $updateQuery = mysqli_query($conn, "UPDATE users SET code='{$code}' WHERE email='{$email}' AND name='{$name}'");
            
            if ($updateQuery) {
                $_SESSION['ALLOWED'] = true;
                $msg = "<div class='alert alert-success'>Los datos introducidos son correctos.</div>";
                    
                $redirect_url = "change-password.php?reset=$code";
                    
                $redirect_delay = 0.5; // segundos

                echo "<meta http-equiv='refresh' content='{$redirect_delay};url={$redirect_url}'>";
                exit();
            } else {
                $msg = "<div class='alert alert-danger'>Hubo un error al cambiar la contraseña.</div>";
            }
        } else {
            $msg = "<div class='alert alert-danger'>La respuesta a la pregunta de seguridad no coincide.</div>";
        }
    } else {
        $msg = "<div class='alert alert-warning'>No existe un usuario con ese correo y nombre.</div>";
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
    <link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
    <!--//Style-CSS -->

    <script src="https://kit.fontawesome.com/af562a2a63.js" crossorigin="anonymous"></script>

</head>

<body>

    <!-- form section start -->
    <section class="w3l-mockup-form">
        <div class="container">
            <!-- /form -->
            <div class="workinghny-form-grid">
                <div class="main-mockup">
                    <div class="w3l_form align-self">
                        <div class="left_grid_info">
                        <a href="../index.php">
                                <img src="./images/logo.png" style="width: 150px; position: absolute; top: 60px; left: 40px;" alt="">
                            </a>
                            <img src="images/image3.svg" alt="">
                            <?php echo $msg; ?>
                      
                        </div>
                    </div>
                    <div class="content-wthree">
                        <h2>¿Olvidaste tu contraseña?</h2>
                        <p>Ingresa tus datos para recuperarla. </p>
                    <form action="" method="post">
                        <?php if (empty($pregunta_seguridad)) { ?>
                            <!-- Paso 1: Ingresar correo electrónico y nombre -->
                            <input type="email" class="email" name="email" placeholder="Introduce tu correo electrónico" required autocomplete="off">
                            <input type="text" class="name" name="name" placeholder="Ingresa tu nombre" required autocomplete="off">
                            <button name="submit_step1" class="btn" type="submit">Verificar</button>
                        <?php } else { ?>
                            <!-- Paso 2: Mostrar pregunta de seguridad y obtener la respuesta -->
                            <p><?php echo htmlspecialchars($pregunta_seguridad); ?></p>
                            <br>
                            <input type="text" class="respuesta_seguridad" name="respuesta_seguridad" placeholder="Ingresa tu respuesta" required autocomplete="off">
                            <button name="submit_step2" class="btn" type="submit">Enviar enlace de reinicio</button>
                        <?php } ?>
                    </form>
                        
                        <div class="social-icons">
                            <p>Regresar al <a href="index.php">inicio de sesion</a>.</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- //form -->
        </div>
    </section>
    <!-- //form section start -->

    <script src="js/jquery.min.js"></script>
    <script>
        $(document).ready(function (c) {
            history.replaceState(null, null, location.pathname);
            $('.alert-close').on('click', function (c) {
                $('.main-mockup').fadeOut('slow', function (c) {
                    $('.main-mockup').remove();
                });
            });
        });
    </script>

</body>

</html>