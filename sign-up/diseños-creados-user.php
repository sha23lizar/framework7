<?php

session_start();
/*
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
*/

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
$id;
if (mysqli_num_rows($query) > 0) {
  $row = mysqli_fetch_assoc($query);
  $name = $row['name'];
  $email = $row['email'];
  $id = $row['id'];
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
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
  <link id="mystylesheet" rel="stylesheet" type="text/css" href="light.css">
  <link rel="stylesheet" href="./css/profile.css">

  <link href="./CRUD-con-PHP-PDO-Ajax-Datatable-main/bootstrap/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="./CRUD-con-PHP-PDO-Ajax-Datatable-main/bootstrap/icon/font/bootstrap-icons.min.css" />
  <link rel="stylesheet" href="./CRUD-con-PHP-PDO-Ajax-Datatable-main/DataTables/datatables.css" />
  <link rel="stylesheet" href="./CRUD-con-PHP-PDO-Ajax-Datatable-main/css/styles.css" />

</head>

<style>
  .row {
    width: 93.7% !important;
    min-width: 93.7%;
    margin: auto;
  }

  .container-bd {
    min-width: 100% !important;
    height: auto;
    margin: auto;
    padding: auto;
    top: 0;
    border-radius: 5px;
    text-align: center;
    justify-content: center;
    padding: 20px;
    background-color: var(--color-white);
    display: flex;
    margin-bottom: 15px;

  }

  .text-center {
    text-align: center !important;
  }

  ol,
  ul {
    padding-left: 0rem;
  }

  .fondo {
    width: auto;
    min-width: 95% !important;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin-top: 25px;
    background-color: white;
    margin: auto;
    justify-content: center;
  }

  .container {
    width: 92%;
    max-width: 1374px;
  }
</style>

<body>

  <div hidden id="id_user" data-id="<?php echo $id; ?>"></div>


  <?php include '../includes/component/slider.php'; ?>




  <section class="home">


    <div class="container-box">

      <div id="box" style="background-color: transparent;">
        <div class="box-user">
          <div class="image-container">
            <img id="profile_pic" src="../imagenes/fotos/usuario.png" class="profile-img">
            <input type="file" id="fileInput" onchange="loadImage(event)">
            <label for="fileInput" id="uploadButton">Cargar Imagen</label>
          </div>

          <div class="info">
            <h4><?php echo $name; ?></h4>
            <p id="email" class="bio-usuario"><?php echo $email; ?></p>
          </div>

          <div class="container-verified">
            <div class="verified">
              <ul class="nav-links" style="margin-top: -8px;">
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
      <h1>Diseños Creados</h1>
      <div class="row">
        <div class="col-md-4">
          <div class="card mb-4 shadow-sm">
          <a href="disgn-user.php" class="stretched-link text-secondary">
              <div class="card-body d-flex flex-column p-5 align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="70%" height="70%" fill="currentColor" class="bi bi-plus-square mb-4" viewBox="0 0 16 16">
                  <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z" />
                  <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                </svg>
                <h2 class="mt-5">Agregar</h2>
              </div>
            </a>
            </div>
        </div>
        <?php
        require("../includes/conexion.php");

        $sql = $conexionMysqli->query("SELECT * FROM diseños WHERE user_id = '$id'");

        while ($resultado = $sql->fetch_assoc()) {
        ?>
          <!-- <th scope="row"><?php echo $resultado['IdProducto'] ?></th> -->
          <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
              <img src="<?php echo $resultado['preview']; ?>" alt="" srcset="">

              <div class="card-body">
                <h2><?php echo $resultado['nombre']; ?></h2>
                <div class="d-flex justify-content-between align-items-center">
                  <div class="btn-group">
                    <a href="disgn-user.php?id=<?php echo $resultado['id']; ?>" class="btn btn-sm btn btn-outline-secondary">editar</a>
                  </div>
                  <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-outline-danger" data-link="../includes/eliminarDiseño.php?id=<?php echo $resultado['id']; ?>" onclick="confirmDelete(this);">eliminar</button>
                  </div>
                  <!-- <small class="text-muted"><?php echo $id; ?></small> -->
                </div>
              </div>
            </div>
          </div>

        <?php
        }
        ?>
      </div>
    </div>
  </section>
<?php include '../includes/component/script-slider.php'; ?>

  <script>
    //***** */
    const btn_menu = document.querySelector(".btn-menu");
    const side_bar = document.querySelector(".sidebar");

    btn_menu.addEventListener("click", function() {
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

    btn_theme.addEventListener("click", function() {
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

    function confirmDelete(element) {
      const link = element.getAttribute("data-link");
      swal({
          title: "Estas seguro de eliminar este diseño?",
          text: "Una vez eliminado, no podra recuperar este archivo!",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            window.location.href = link;

          } else {
            swal("Tu archivo no ha sido eliminado!");
          }
        });

    }
  </script>
</body>

</html>