
<?php
/*
include 'config.php';
$msg = "";

session_start();
if (isset($_SESSION['SESSION_EMAIL'])) {
    if ($_SESSION['ROLE'] == 'usuario') {
        header("Location: welcome-user.php");
        exit();
    } else if ($_SESSION['ROLE'] == 'administrador') {
        header("Location: welcome.php");
        exit();
    }
}

// Evitar que la página se almacene en caché por el navegador
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

if (isset($_GET['verification'])) {
    if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE code='{$_GET['verification']}'")) > 0) {
        $query = mysqli_query($conn, "UPDATE users SET code='' WHERE code='{$_GET['verification']}'");
        
        if ($query) {
            $msg = "<div class='alert alert-success'>La verificación de la cuenta se ha completado con éxito.</div>";
        }
    } else {
        header("Location: index.php");
    }
}

if (isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, md5($_POST['password']));

    $sql = "SELECT * FROM users WHERE email='{$email}' AND password='{$password}'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);

        if (empty($row['code'])) {
            $_SESSION['SESSION_EMAIL'] = $email;
            $_SESSION['ROLE'] = $row['role']; // Guardar el rol en la sesión

            // Depuración: imprimir el rol
            echo "Rol: " . $row['role'];

            // Redirigir al usuario a la página correspondiente según su rol
            if ($row['role'] == 'usuario') {
                header("Location: welcome-user.php");
                exit();
            } else if ($row['role'] == 'administrador') {
                header("Location: welcome.php");
                exit();
            }
        } else {
            $msg = "<div class='alert alert-info'>Tienes un proceso de cambio de contraseña pendiente. Por favor, completa el cambio de contraseña.</div>";
        }
    } else {
        $msg = "<div class='alert alert-danger'>El correo electrónico o la contraseña no son correctos.</div>";
    }
}
*/


include 'config.php';
$msg = "";

session_start();
if (isset($_SESSION['SESSION_EMAIL'])) {
    if ($_SESSION['ROLE'] == 'usuario') {
        header("Location: welcome-user.php");
        exit();
    } else if ($_SESSION['ROLE'] == 'administrador') {
        header("Location: welcome.php");
        exit();
    }
}

// Evitar que la página se almacene en caché por el navegador
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

if (isset($_GET['verification'])) {
    if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE code='{$_GET['verification']}'")) > 0) {
        $query = mysqli_query($conn, "UPDATE users SET code='' WHERE code='{$_GET['verification']}'");
        
        if ($query) {
            $msg = "<div class='alert alert-success'>La verificación de la cuenta se ha completado con éxito.</div>";
        }
    } else {
        header("Location: index.php");
    }
}

if (isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, md5($_POST['password']));

    $sql = "SELECT * FROM users WHERE email='{$email}' AND password='{$password}'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);

        if (empty($row['code'])) {
            $_SESSION['SESSION_EMAIL'] = $email;
            $_SESSION['ROLE'] = $row['role']; // Guardar el rol en la sesión

            // Depuración: imprimir el rol
            echo "Rol: " . $row['role'];

            // Redirigir al usuario a la página correspondiente según su rol
            if ($row['role'] == 'usuario') {
                header("Location: welcome-user.php");
                exit();
            } else if ($row['role'] == 'administrador') {
                header("Location: welcome.php");
                exit();
            }
        } else {
            $msg = "<div class='alert alert-info'>Tienes un proceso de cambio de contraseña pendiente. Por favor, completa el cambio de contraseña.</div>";

            // Redirigir a la página de cambio de contraseña después de 3 segundos
            echo "<script>
                setTimeout(function() {
                    window.location.href = 'change-password.php?reset=" . $row['code'] . "';
                }, 3000);
            </script>";
        }
    } else {
        $msg = "<div class='alert alert-danger'>El correo electrónico o la contraseña no son correctos.</div>";
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
<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Nunito Sans', sans-serif;
    background: gainsboro;
}

.container {
    max-width: 880px;
    margin: auto;
    height: 83vh;
}

.w3l_form {
    padding: 0px;
    flex-basis: 50%;
    -webkit-flex-basis: 50%;
    background: #00c16e;
    padding: 100px 50px;
    border-top-left-radius: 8px;
    border-bottom-left-radius: 8px;
    display: flex;
    justify-content: center;
    align-items: center;
}

.input-google {
    display: flex;
    width: 100%;
} 

.input-google .g-signin2 {
    display: flex;
    height: 50px !important;
    min-height: auto; 
    width: auto !important;  /* Ancho personalizado */
    padding: auto;
    border: solid 2px black;
    cursor: pointer;
    background-color: transparent;
    justify-content:center;
}

.input-google img {
    display: flex;
    width: 100%;
    min-width: 100%;
    object-fit: cover;
    border-radius: 5px;
    border: solid 2px black;
    margin: 5px auto;
    max-width: 100%;
    height: auto;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    margin-bottom: 15px;
}

.social-icons{
    display: flex;
    flex-direction: column;
    margin: auto;
    padding: auto;
    gap: 10px;
    width: 100%;
    height: auto;
}
</style>
<body>

    <!-- form section start -->
    <section class="w3l-mockup-form">
        <div class="container">
            <!-- /form -->
            <div class="workinghny-form-grid">
                <div class="main-mockup">
                    <div class="w3l_form align-self">
                        <div class="left_grid_info">
                            <img src="images/image.svg" alt="">
                            <?php echo $msg; ?>
                        </div>
                    </div>
                    <div class="content-wthree">
                        <br>
                        <br>
                        <h2>Iniciar Sesion</h2>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. </p>
                        <form action="" method="post"> 
                    <div class="input-google" value="Continue with Google" id="custom-google-button" data-onsuccess="onSignIn" style="display: none;">
                        <img src="../imagenes/fotos/google Log In (1).png" alt="Google Logo" value="Continue with Google" id="custom-google-button" class="g-signin2" data-onsuccess="onSignIn">
                    </div>
                            <input type="email" class="email" name="email" placeholder="Ingresa tu correo" required>
                            <input type="password" class="password" name="password" placeholder="Ingresa tu contraseña" required>
                            <p style="text-align: end;"><a href="forgot-password.php">Olvidaste tu contraseña?</a></p><br>
                            <button name="submit" name="submit" class="btn" type="submit">Login</button>
                        </form>
                        <div class="social-icons">
                            <p>Create una cuenta! <a href="login.php">Registrarse</a>.</p>
                            <p><a href="../index.php">Return</a></p>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
            <!-- //form -->
        </div>
    </section>
    <!-- //form section start -->
    <script src="js/main.js"></script>
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