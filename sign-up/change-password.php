<?php

$msg = "";

include 'config.php';
/*
if (isset($_GET['reset'])) {
    if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE code='{$_GET['reset']}'")) > 0) {
        if (isset($_POST['submit'])) {
            $password = mysqli_real_escape_string($conn, md5($_POST['password']));
            $confirm_password = mysqli_real_escape_string($conn, md5($_POST['confirm-password']));
            
            // Añadir la validación de la contraseña aquí
            $password_pattern = '/^(?=.*[A-Z])(?=.*[0-9]).{6,}$/';
            if (!preg_match($password_pattern, $_POST['password'])) {
                $msg = "<div class='alert alert-danger'>La contraseña debe tener al menos 6 caracteres con al menos una letra mayúscula y un número.</div>";
            } elseif ($password !== $confirm_password) {
                $msg = "<div class='alert alert-danger'>Las contraseñas no coinciden.</div>";
            } else {
                $query = mysqli_query($conn, "UPDATE users SET password='{$password}', code='' WHERE code='{$_GET['reset']}'");
                
                if ($query) {
                    $msg = "<div class='alert alert-success'>Su contraseña ha sido cambiada correctamente.</div>";
                    $redirect_url = 'index.php';
                    $redirect_delay = 3; // segundos

                    echo "<meta http-equiv='refresh' content='{$redirect_delay};url={$redirect_url}'>";
                } else {
                    $msg = "<div class='alert alert-danger'>Hubo un error al cambiar la contraseña.</div>";
                }
            }
        }
    } else {
        $msg = "<div class='alert alert-danger'>Restablecer enlace no coincide.</div>";
    }
} else {
    header("Location: forgot-password.php");
}

echo '<script>
window.onbeforeunload = function() {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "remove-code.php?code=' . $_GET['reset'] . '", true);
    xhr.send();
};
</script>';
*/

/*
if (isset($_GET['reset'])) {
    if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE code='{$_GET['reset']}'")) > 0) {
        if (isset($_POST['submit'])) {
            $password = mysqli_real_escape_string($conn, md5($_POST['password']));
            $confirm_password = mysqli_real_escape_string($conn, md5($_POST['confirm-password']));
            
            // Añadir la validación de la contraseña aquí
            $password_pattern = '/^(?=.*[A-Z])(?=.*[0-9]).{6,}$/';
            if (!preg_match($password_pattern, $_POST['password'])) {
                $msg = "<div class='alert alert-danger'>La contraseña debe tener al menos 6 caracteres con al menos una letra mayúscula y un número.</div>";
            } elseif ($password !== $confirm_password) {
                $msg = "<div class='alert alert-danger'>Las contraseñas no coinciden.</div>";
            } else {
                $query = mysqli_query($conn, "UPDATE users SET password='{$password}', code='' WHERE code='{$_GET['reset']}'");
                
                if ($query) {
                    $msg = "<div class='alert alert-success'>Su contraseña ha sido cambiada correctamente.</div>";
                    $redirect_url = 'index.php';
                    $redirect_delay = 3; // segundos

                    echo "<meta http-equiv='refresh' content='{$redirect_delay};url={$redirect_url}'>";
                } else {
                    $msg = "<div class='alert alert-danger'>Hubo un error al cambiar la contraseña.</div>";
                }
            }
        }
    } else {
        $msg = "<div class='alert alert-danger'>Restablecer enlace no coincide.</div>";
    }
} else {
    header("Location: forgot-password.php");
}

// Solo se ejecutará si la página se cierra o se cambia a otra
echo '<script>
window.addEventListener("unload", function() {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "remove-code.php?code=' . $_GET['reset'] . '", true);
    xhr.send();
});

// Impedir que el usuario retroceda con los botones del navegador
history.pushState(null, null, location.href);
window.addEventListener("popstate", function(event) {
    history.pushState(null, null, location.href);
});
</script>';
*/



if (isset($_GET['reset'])) {
    if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE code='{$_GET['reset']}'")) > 0) {
        if (isset($_POST['submit'])) {
            $password = mysqli_real_escape_string($conn, md5($_POST['password']));
            $confirm_password = mysqli_real_escape_string($conn, md5($_POST['confirm-password']));

            // Añadir la validación de la contraseña aquí
            $password_pattern = '/^(?=.*[A-Z])(?=.*[0-9]).{6,}$/';
            if (!preg_match($password_pattern, $_POST['password'])) {
                $msg = "<div class='alert alert-danger'>La contraseña debe tener al menos 6 caracteres con al menos una letra mayúscula y un número.</div>";
            } elseif ($password !== $confirm_password) {
                $msg = "<div class='alert alert-danger'>Las contraseñas no coinciden.</div>";
            } else {
                $query = mysqli_query($conn, "UPDATE users SET password='{$password}', code='' WHERE code='{$_GET['reset']}'");

                if ($query) {
                    $msg = "<div class='alert alert-success'>Su contraseña ha sido cambiada correctamente.</div>";
                    $redirect_url = 'index.php';
                    $redirect_delay = 3; // segundos

                    echo "<meta http-equiv='refresh' content='{$redirect_delay};url={$redirect_url}'>";
                } else {
                    $msg = "<div class='alert alert-danger'>Hubo un error al cambiar la contraseña.</div>";
                }
            }
        }
    } else {
        $msg = "<div class='alert alert-danger'>Restablecer enlace no coincide.</div>";
    }
} else {
    header("Location: forgot-password.php");
    exit();
}

// Solo se ejecutará si la página se cierra o se cambia a otra
echo '<script>
window.addEventListener("unload", function() {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "remove-code.php?code=' . $_GET['reset'] . '", true);
    xhr.send();
});

// Impedir que el usuario retroceda con los botones del navegador
history.pushState(null, null, location.href);
window.addEventListener("popstate", function(event) {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "remove-code.php?code=' . $_GET['reset'] . '", true);
    xhr.send();
    window.location.href = "forgot-password.php"; // Redirige al formulario de restablecimiento de contraseña
});
</script>';

?>


<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>Login Form</title>
    <!-- Meta tag Keywords -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8" />
    <meta name="keywords" content="Login Form" />
    <!-- //Meta tag Keywords -->

    <link href="//fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!--/Style-CSS -->
    <link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
    <!--//Style-CSS -->

    <script src="https://kit.fontawesome.com/af562a2a63.js" crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>
<style>
    /* Modal CSS */
    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.5);
        /* Transparencia para oscurecer la página */
    }

    .modal-content {
        background-color: white;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        padding: 20px;
        border: 1px solid #888;
        text-align: center;
    }

    /* Estilos adicionales para botones */
    #confirmBtn,
    #cancelBtn {
        margin: 5px;
        padding: 10px 20px;
        cursor: pointer;
    }

    #confirmBtn {
        background-color: #4CAF50;
        /* Color verde */
        color: white;
        border: none;
    }

    #cancelBtn {
        background-color: #f44336;
        /* Color rojo */
        color: white;
        border: none;
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
                            <a href="../index.php">
                                <img src="./images/logo.png" style="width: 150px; position: absolute; top: 60px; left: 40px;" alt="">
                            </a>
                            <img src="images/image3.svg" alt="">
                            <?php echo $msg; ?>
                        </div>
                    </div>
                    <div class="content-wthree">
                        <h2>Cambiar la contraseña</h2>
                        <p>Ingresa la nueva contraseña. </p>
                        <form action="" method="post">
                            <input type="password" class="password" name="password" placeholder="Ingrese su contraseña" required>
                            <input type="password" class="confirm-password" name="confirm-password" placeholder="Ingrese su contraseña de confirmación" required>
                            <button name="submit" class="btn" type="submit">Cambiar la contraseña</button>
                        </form>
                        <div class="social-icons">
                            <p><a onclick="return confirm('¿Esta seguro de no cambiar la contraseña?, porque eliminares el token que genramos para restablecer la contraseña.');" href="modificar-cuenta.php?reset=<?php echo $_GET['reset']; ?>&no-change=true">conservar la misma contraseña</a>.</p>
                        </div>
                        <!-- Modal HTML -->
                        <br><br><br><br><br><br>
                    </div>
                </div>
            </div>
        </div>

        <div id="confirmModal" class="modal">
            <div class="modal-content">
                <p>¿Estás seguro de que deseas salir? Esto eliminará tu token.</p>
                <br>
                <button id="confirmBtn"><a style="color:white;" href="modificar-cuenta.php?reset=<?php echo $_GET['reset']; ?>">aceptar</a></button>
                <button id="cancelBtn">Cancelar</button>
            </div>
        </div>
    </section>
    <!-- //form section start -->
    <script src="js/jquery.min.js"></script>
    <script>
        $(document).ready(function(c) {
            history.replaceState(null, null, location.pathname);
            $('.alert-close').on('click', function(c) {
                $('.main-mockup').fadeOut('slow', function(c) {
                    $('.main-mockup').remove();
                });
            });
        });
    </script>
</body>

</html>