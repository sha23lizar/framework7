<?php

session_start();

// Verificar si la sesión no está activa
if (!isset($_SESSION['SESSION_EMAIL'])) {
    // Redireccionar al usuario a la página de inicio de sesión
    header("Location: index.php");
    exit(); // Detener la ejecución del script
}

// Verificar el rol del usuario
if ($_SESSION['ROLE'] == 'administrador') {
    // Redireccionar al usuario a la página principal si intenta acceder al panel de usuario
    header("Location: index.php");
    exit(); // Detener la ejecución del script
}


include 'config.php';

if (isset($_POST['upload_image'])) {
    $name = $_SESSION['SESSION_EMAIL'];
    $image = $_FILES['profile_image']['tmp_name'];
    $image_data = file_get_contents($image);

    $update_query = "UPDATE users SET profile_image = ? WHERE email = ?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param("bs", $image_data, $name);

    if ($stmt->execute()) {
        echo "Imagen de perfil guardada correctamente.";
    } else {
        echo "Error al guardar la imagen de perfil.";
    }
}

$query = mysqli_query($conn, "SELECT * FROM users WHERE email='{$_SESSION['SESSION_EMAIL']}'");

if (mysqli_num_rows($query) > 0) {
    $row = mysqli_fetch_assoc($query);
    $name = $row['name'];
    $email = $row['email'];
}

$sql = "SELECT id, name, email, pregunta_seguridad, respuesta_seguridad FROM users"; // Consulta SQL
$result = $conn->query($sql); // Ejecutar consulta

header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $genero = mysqli_real_escape_string($conn, $_POST['genero']);
    $xs = mysqli_real_escape_string($conn, $_POST['xs']);
    $s = mysqli_real_escape_string($conn, $_POST['s']);
    $m = mysqli_real_escape_string($conn, $_POST['m']);
    $l = mysqli_real_escape_string($conn, $_POST['l']);
    $xl = mysqli_real_escape_string($conn, $_POST['xl']);

    // Asegurarse de que las variables $name y $email están definidas antes de usarlas
    if ($name && $email) {
        $sql = "INSERT INTO orders (name, email, genero, xs, s, m, l, xl) VALUES ('{$name}', '{$email}', '{$genero}', '{$xs}', '{$s}', '{$m}', '{$l}', '{$xl}')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            header("Location: formulario.php");
            exit();
        } else {
            $msg = "<div class='alert alert-danger'>Algo salió mal al intentar registrar su pedido.</div>";
        }
    } else {
        $msg = "<div class='alert alert-danger'>Error: Datos del usuario no encontrados.</div>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet"/>
    <title>Document</title>
</head>
<style>
    body.dark-overlay {
        background-color: rgba(0, 0, 0, 0.5);
        transition: background-color 0.5s ease;
        font-family: sans-serif;
    }
    .shirt-sizes {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        width: 400px;
        transform: translate(-50%, -50%);
        background: #fff;
        padding: 20px;
        border-radius: 10px;
        z-index: 1000;
    }
    .visible {
        display: flex;
        flex-direction: column;
    }
    #overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 999;
    }
    .shirt-size, label{
        display: flex;
        align-items: center;
        margin-bottom: 15px;
    }
    
    label {
        margin-right: 10px;
        padding-left: 12px;
    }

    .shirt-size .boton {
        display: flex;
        justify-content:flex-end;
        width: 100%;
        margin-bottom: 10px;
        position: relative;
        left: -10px;
    }

    .bx-male-sign {
        color: blue;
    }

    .bx-female-sign {
        color: pink;
    }
    
    
    input {
        width: 60px;
        height: 36.5px;
        border: solid 2px;
        text-align: center;
        border-left: transparent;
        border-right: transparent;
        display: flex;
        padding-left: 15px;
    }

    h1, .shirt-size:not(:last-child) {
        border-bottom: 2px solid gray;
        width: 100%;
        padding-bottom: 5px;
        margin-bottom: 15px;
    }
    
    
    .btn-minus,
    .btn-plus {
        width: 43px;
        height: 42px;
        font-size: 16px;
        border: none;
        background-color: #f0f0f0;
        cursor: pointer;
    }

    .btn-female, .btn-male {
        width: 43px;
        height: 42px;
        font-size: 16px;
        border: none;
        background-color: #f0f0f0;
        cursor: pointer;
    }
    
    .btn-minus:hover,
    .btn-plus:hover {
        background-color: #ccc;
    }
    
    .btn-minus {
        border-radius: 5px 0px 0px 5px;
        border: solid 2px;
    }
    
    .btn-plus {
        border-radius: 0px 5px 5px 0px;
        border: solid 2px;
    }

    .boton-sep {
        display: flex;
        gap: 10px;
        margin: auto;
        padding: auto;
        justify-content: center;
        width: 100%;
    }

    .button-pev {
        padding: 20px;
        background-color: rgb(60, 251, 57);
        color: white;
        border: transparent;
        font-weight: bold;
        width: 100%;
        margin-top: -16.5px;

    }


        .hidden {
            display: none;
        }
        .error {
            color: red;
            margin-top: 10px;
            padding: 20px;
        }
        .selected {
            background-color: lightgray;
        }
       
    
</style>
<body>
<div class="info">
    <h4><?php echo $name; ?></h4>
    <p id="email" class="bio-usuario"><?php echo $email; ?></p>
  </div>

<button id="showFormBtn">Mostrar Formulario</button>  

<button>
<a href="FPDF/generador_de_pdf.php">genrar pdf</a>
</button>

<div id="overlay"></div>

<div class="shirt-sizes" id="shirtSizesForm">
    <h1>Seleccione</h1>
    <form id="orderForm" action="" method="POST">
        <div class="shirt-size">
            <label for="genero">Genero</label>
            <div class="boton">
                <button type="button" class="btn-male" style="border-radius: 5px;"><i class='bx bx-male-sign'></i></button>
                <input type="hidden" id="genero" name="genero" value="">
                <button type="button" class="btn-female" style="border-radius: 5px;"><i class='bx bx-female-sign'></i></button>
            </div>
        </div>
        <div class="shirt-size">
            <label for="xs">XS</label>
            <div class="boton">
                <button type="button" class="btn-minus">-</button>
                <input type="number" id="xs" name="xs" value="0" min="0">
                <button type="button" class="btn-plus">+</button>
            </div>
        </div>
        <div class="shirt-size">
            <label for="s">S</label>
            <div class="boton">
                <button type="button" class="btn-minus">-</button>
                <input type="number" id="s" name="s" value="0" min="0">
                <button type="button" class="btn-plus">+</button>
            </div>
        </div>
        <div class="shirt-size">
            <label for="m">M</label>
            <div class="boton">
                <button type="button" class="btn-minus">-</button>
                <input type="number" id="m" name="m" value="0" min="0">
                <button type="button" class="btn-plus">+</button>
            </div>
        </div>
        <div class="shirt-size">
            <label for="l">L</label>
            <div class="boton">
                <button type="button" class="btn-minus">-</button>
                <input type="number" id="l" name="l" value="0" min="0">
                <button type="button" class="btn-plus">+</button>
            </div>
        </div>
        <div class="shirt-size">
            <label for="xl">XL</label>
            <div class="boton">
                <button type="button" class="btn-minus">-</button>
                <input type="number" id="xl" name="xl" value="0" min="0">
                <button type="button" class="btn-plus">+</button>
            </div>
        </div>
        <button type="submit" class="button-pev">Realizar pedido</button>
        <div id="error-message" class="error hidden">Por favor, seleccione el género y al menos una cantidad de camisetas.</div>
    </form>
</div>


    <script>

         document.getElementById('showFormBtn').addEventListener('click', function() {
            document.getElementById('overlay').style.display = 'block';
            document.getElementById('shirtSizesForm').classList.add('visible');
            document.body.classList.add('dark-overlay');
        });

        document.getElementById('overlay').addEventListener('click', function() {
            document.getElementById('overlay').style.display = 'none';
            document.getElementById('shirtSizesForm').classList.remove('visible');
            document.body.classList.remove('dark-overlay');
        });


        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('orderForm');
            const generoInput = document.getElementById('genero');
            const xsInput = document.getElementById('xs');
            const sInput = document.getElementById('s');
            const mInput = document.getElementById('m');
            const lInput = document.getElementById('l');
            const xlInput = document.getElementById('xl');
            const errorMessage = document.getElementById('error-message');

            const maleButton = document.querySelector('.btn-male');
            const femaleButton = document.querySelector('.btn-female');

            maleButton.addEventListener('click', function() {
                generoInput.value = 'M';
                maleButton.classList.add('selected');
                femaleButton.classList.remove('selected');
            });

            femaleButton.addEventListener('click', function() {
                generoInput.value = 'F';
                femaleButton.classList.add('selected');
                maleButton.classList.remove('selected');
            });

            form.addEventListener('submit', function(event) {
                errorMessage.classList.add('hidden');

                const totalShirts = parseInt(xsInput.value) + parseInt(sInput.value) +
                                    parseInt(mInput.value) + parseInt(lInput.value) +
                                    parseInt(xlInput.value);

                if (generoInput.value === '' || totalShirts === 0) {
                    event.preventDefault();
                    errorMessage.classList.remove('hidden');
                }
            });

            const buttonsMinus = document.querySelectorAll('.btn-minus');
            const buttonsPlus = document.querySelectorAll('.btn-plus');

            buttonsMinus.forEach(button => {
                button.addEventListener('click', function() {
                    const input = this.nextElementSibling;
                    if (input.value > 0) {
                        input.value--;
                    }
                });
            });

            buttonsPlus.forEach(button => {
                button.addEventListener('click', function() {
                    const input = this.previousElementSibling;
                    input.value++;
                });
            });
        });
    </script>
    
</body>
</html>