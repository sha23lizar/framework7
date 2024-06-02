<?php
// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require './vendor/phpmailer/phpmailer/src/exception.php';
require './vendor/phpmailer/phpmailer/src/oauth.php';
require './vendor/phpmailer/phpmailer/src/smtp.php';

session_start();
if (isset($_SESSION['SESSION_EMAIL'])) {
    if ($_SESSION['ROLE'] == 'usuario') {
        header("Location: welcome-user.php");
        exit();
    } elseif ($_SESSION['ROLE'] == 'administrador') {
        header("Location: welcome.php");
        exit();
    }
}

// Load Composer's autoloader
require './vendor/autoload.php';

include 'config.php';
$msg = "";

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm-password']);
    $pregunta_seguridad = mysqli_real_escape_string($conn, $_POST['pregunta_seguridad']);
    $respuesta_seguridad = mysqli_real_escape_string($conn, $_POST['respuesta_seguridad']);
    $code = mysqli_real_escape_string($conn, md5(rand()));
    
    // Validación de la contraseña
    $password_pattern = '/^(?=.*[A-Z])(?=.*[0-9]).{6,}$/';
    if (!preg_match($password_pattern, $password)) {
        $msg = "<div class='alert alert-danger'>La contraseña debe tener al menos 6 caracteres con al menos una letra mayúscula y un numero.</div>";
    } elseif ($password !== $confirm_password) {
        $msg = "<div class='alert alert-danger'>Las contraseñas no coinciden.</div>";
    } elseif (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE email='{$email}'")) > 0) {
        $msg = "<div class='alert alert-danger'>{$email} - Esta dirección de correo electrónico ya existe.</div>";
    } else {
        // Si la contraseña es válida y el correo no existe, procede a enviar el correo y registrar al usuario
        $password = md5($password);
        $mail = new PHPMailer(true);
        try {
            $mail->SMTPDebug = SMTP::DEBUG_OFF; //Disable debug output
            $mail->isSMTP(); //Send using SMTP
            $mail->Host       = 'smtp.gmail.com'; //Set the SMTP server to send through
            $mail->SMTPAuth   = true; //Enable SMTP authentication
            $mail->Username   = 'piensasyhablas@gmail.com'; //SMTP username
            $mail->Password   = 'xyqtxrxzjztblpzm'; //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; //Enable implicit TLS encryption
            $mail->Port       = 465; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('piensasyhablas@gmail.com');
            $mail->addAddress($email);

            //Content
            $mail->isHTML(true); //Set email format to HTML
            $mail->Subject = 'no reply';
            $mail->Body    = 'Aquí está el enlace de verificación. <b><a href="http://localhost/ShallomCreativeDesign2.0/Sign-up/?verification='.$code.'">Verificar Cuenta</a></b>';

            $mail->send();
            echo '';

            // Si el correo se envía con éxito, registra al usuario en la base de datos
            $sql = "INSERT INTO users (name, email, password, code, pregunta_seguridad, respuesta_seguridad, role) VALUES ('{$name}', '{$email}', '{$password}', '{$code}', '{$pregunta_seguridad}', '{$respuesta_seguridad}', 'usuario')";

            $result = mysqli_query($conn, $sql);


            if ($result) {
                $msg = "<div class='alert alert-info'>Le hemos enviado un enlace de verificación a su dirección de correo electrónico.</div>";
            } else {
                $msg = "<div class='alert alert-danger'>Algo salió mal al intentar crear su cuenta.</div>";
            }
        } catch (Exception $e) {
            $msg = "<div class='alert alert-danger'>No se pudo enviar el correo de verificación. Por favor, inténtelo de nuevo. </div>";
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
                            <img src="./images/Neutral Minimalist Social Media Digital Product Carousel Instagram Post.png" alt="">
                            <?php echo $msg; ?>
                        </div>
                    </div>
                    <div class="content-wthree">
                        <h2>Registrarse</h2>
                        <form action="" method="POST">
                            <input type="text" class="name" name="name" placeholder="Ingresa tu nombre" value="<?php if (isset($_POST['submit'])) { echo $name; } ?>" required>
                            <input type="email" class="email" name="email" placeholder="Ingresa tu correo" value="<?php if (isset($_POST['submit'])) { echo $email; } ?>" required>
                            <input type="password" class="password" name="password" placeholder="Ingresa tu contraseña" required>
                            <input type="password" class="confirm-password" name="confirm-password" placeholder="Confirma tu contraseña" required>
                            <input type="text" class="pregunta_seguridad" name="pregunta_seguridad" placeholder="Ingresa tu pregunta de seguridad" value="<?php if (isset($_POST['submit'])) { echo $pregunta_seguridad; } ?>" required>
                            <input type="text" class="respuesta_seguridad" name="respuesta_seguridad" placeholder="Ingresa tu respuesta" value="<?php if (isset($_POST['submit'])) { echo $respuesta_seguridad; } ?>" required>
                            <button name="submit" class="btn" type="submit">Registrarse</button>
                        </form>
                        <div class="social-icons">    
                            <p>Registrerse sin conexion! <a href="login.php">aqui</a> / <a href="index.php">Volver a login</a></p>
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
            $('.alert-close').on('click', function (c) {
                $('.main-mockup').fadeOut('slow', function (c) {
                    $('.main-mockup').remove();
                });
            });
        });
    </script>

</body>

</html>