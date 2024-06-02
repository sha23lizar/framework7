<?php
session_start();
if (isset($_SESSION['SESSION_EMAIL'])) {
  if ($_SESSION['ROLE'] == 'usuario') {
      header("Location: index.php");
    die();
  }
}

include '../config.php';

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

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Side Navbar</title>
    <link rel="stylesheet" href="styles.css" />
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
	  <link id="mystylesheet" rel="stylesheet" type="text/css" href="light.css">
    <link rel="stylesheet" href="../css/profile.css">

  </head>
  <style>
        table{
          width: 100%;
        }
        table, th, td {
            border: transparent;
            border-collapse: collapse;
            margin: auto;
            justify-content: center;
        }
        th, td {
            padding: 10px;
        }

        button {
          background-color: red;
          color: white;
          border-radius: 10px;
          border: transparent;
          padding: 10px;
          width: 50px;
        }

        h1 {
            text-align: center;
        }
    </style>
  <body>
    <section class="sidebar">
      <div class="nav-header">
        <p class="logo">Administrador</p>
        <i class="bx bx-menu btn-menu"></i>
      </div>
      <ul class="nav-links">
        <li>
          <a href="../index.php">
            <i class="bx bx-home-alt-2"></i>
            <span class="title">Inicio</span>
          </a>
          <span class="tooltip">Inicio</span>
        </li>
        <li>
          <a href="../funciones-de-administrador/diseños-creados.php">
            <i class='bx bx-brush'></i>
            <span class="title">Diseños Creados</span>
          </a>
          <span class="tooltip">Diseños Creados</span>
        </li>
        <li>
          <a href="#">
            <i class='bx bx-user'></i>
            <span class="title">Usuarios registrados</span>
          </a>
          <span class="tooltip">Usuarios registrados</span>
        </li>
        <li>
          <a href="#" style="display: none;">
            <i class="bx bx-wallet-alt"></i>
            <span class="title">Cambiar contraseña</span>
          </a>
          <span class="tooltip">Canbiar contraseña</span>
        </li>
        <li style="display: none;">
          <a href="#">
            <i class="bx bxs-devices"></i>
            <span class="title">Devices</span>
          </a>
          <span class="tooltip">Devices</span>
        </li>
        <li style="display: none;">
          <a href="#">
            <i class="bx bx-cog"></i>
            <span class="title">Setting</span>
          </a>
          <span class="tooltip">Setting</span>
        </li>
        <li>
          <a href="./logout.php">
            <i class='bx bx-arrow-back'></i>
            <span class="title">Cerrar sesion</span>
          </a>
        </li>
      </ul>
      <div class="theme-wrapper">
        <i class="bx bxs-moon theme-icon"></i>
        <p>Dark Theme</p>
        <div class="theme-btn">
          <span class="theme-ball"></span>
        </div>
      </div>
    </section>

    
<section class="home">

  
<div class="container-box">
 
<div id="box"  style="background-color: transparent;">
  <div class="box-user">
  
  <div class="info">
    <h4>Usuarios registrados<br></h4>
  </div>


<div class="container-verified">
  <div class="verified">
    <ul  class="nav-links" style="margin-top: -8px;"> 
        <li>
          <a href="#" class="link-bxr">
           <i class='bx bx-check-square bxr'></i>
           <p class="bio-usuario">verificado</p>
          </a>
          <span class="tooltip">Devices</span>
        </li>
      </ul>
     </div>
  </div>
  
  </div>
    <hr>
</div>
</div>  

    <div class="grid" style="display: none;">
    <div class="grid-container"></div>
    <div class="grid-container"></div>
    <div class="grid-container"></div>
    </div>



<div class="container">
<table>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Email</th>
        <th>Pregunta de Seguridad</th>
        <th>Respuesta de Seguridad</th>
        <th>Acciones</th>
    </tr>
    <?php
    if ($result->num_rows > 0) {
        // Salida de datos de cada fila
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>".$row["id"]."</td>
                    <td>".htmlspecialchars($row["name"], ENT_QUOTES, 'UTF-8')."</td>
                    <td>".htmlspecialchars($row["email"], ENT_QUOTES, 'UTF-8')."</td>
                    <td>".htmlspecialchars($row["pregunta_seguridad"], ENT_QUOTES, 'UTF-8')."</td>
                    <td>".htmlspecialchars($row["respuesta_seguridad"], ENT_QUOTES, 'UTF-8')."</td>
                    <td>
                      <form action='eliminar_usuario.php' method='post'>
                        <input type='hidden' name='user_id' value='".$row["id"]."'>
                        <button type='submit' name='eliminar_usuario'><i class='bx bx-trash'></i></button>
                      </form>
                   </td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='5'>No se encontraron usuarios</td></tr>";
    }
    $conn->close(); // Cerrar conexión
    ?>
</table>
</div>

    
    <script>
      const btn_menu = document.querySelector(".btn-menu");
      const side_bar = document.querySelector(".sidebar");

      btn_menu.addEventListener("click", function () {
        side_bar.classList.toggle("expand");
        changebtn();
      });

      function changebtn() {
        if (side_bar.classList.contains("expand")) {
          btn_menu.classList.replace("bx-menu", "bx-menu-alt-right");
        } else {
          btn_menu.classList.replace("bx-menu-alt-right", "bx-menu");
        }
      }

      const btn_theme = document.querySelector(".theme-btn");
      const theme_ball = document.querySelector(".theme-ball");

      const localData = localStorage.getItem("theme");

      if (localData == null) {
        localStorage.setItem("theme", "light");
      }

      if (localData == "dark") {
        document.body.classList.add("dark-mode");
        theme_ball.classList.add("dark");
      } else if (localData == "light") {
        document.body.classList.remove("dark-mode");
        theme_ball.classList.remove("dark");
      }

      btn_theme.addEventListener("click", function () {
        document.body.classList.toggle("dark-mode");
        theme_ball.classList.toggle("dark");
        if (document.body.classList.contains("dark-mode")) {
          localStorage.setItem("theme", "dark");
        } else {
          localStorage.setItem("theme", "light");
        }
      });

    
      function loadImage(event) {
        const image = document.getElementById('profile_pic');
        const input = event.target;
        const reader = new FileReader();
    
        reader.onload = function() {
            const dataURL = reader.result;
            image.src = dataURL;
    
            // Almacenar la imagen en el localStorage
            localStorage.setItem('profileImage', dataURL);
        };
    
        reader.readAsDataURL(input.files[0]);
    }
    
    // Para cargar la imagen almacenada en localStorage al cargar la página
    window.addEventListener('DOMContentLoaded', () => {
        const storedImage = localStorage.getItem('profileImage');
        const image = document.getElementById('profile_pic');
    
        if (storedImage) {
            image.src = storedImage;
        }
    });
    
    const selectBtns = document.querySelectorAll(".select-btn");
    
    selectBtns.forEach(selectBtn => {
        selectBtn.addEventListener("click", () => {
            selectBtn.classList.toggle("open");
        });
    });
    
</script>
</body>
</html>
