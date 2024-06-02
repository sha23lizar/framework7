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

    <link rel="stylesheet" href="../css/main2.css">
    <link rel="stylesheet" href="../css/profile.css">

  </head>
  <style>
         .row {
        width: 100% !important;
        min-width: 100%;
      }

  .container-bd{
      min-width: 95% !important;
      height: auto;
      margin: auto;
      padding: auto;
      top: 0;
      border-radius: 5px;
      text-align: center;
      justify-content: center;
      padding: 20px;
      background-color: var(--color-white);
      display:flex;
      margin-bottom: 15px;
     
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
          <a href="../welcome.php">
            <i class=""><img src="../iconos/bx-home-alt-2.svg" alt=""></i>
            <span class="title">Inicio</span>
          </a>
          <span class="tooltip">Inicio</span>
        </li>
        <li>
          <a href="#">
            <i class=''><img src="../iconos/bx-brush.svg" alt=""></i>
            <span class="title">Diseños Creados</span>
          </a>
          <span class="tooltip">Diseños Creados</span>
        </li>
        <li>
          <a href="usuarios registrados.php">
            <i class=''><img src="../iconos/bx-user.svg" alt=""></i>
            <span class="title">Usuarios registrados</span>
          </a>
          <span class="tooltip">Usuarios registrados</span>
        </li>
        <li>
          <a href="pedidos.php">
            <i class=""><img src="../iconos/bx-cart-add.svg" alt=""></i>
            <span class="title">Pedidos</span>
          </a>
          <span class="tooltip">Pedidos</span>
        </li>
        <li>
          <a href="#">
          <i class='' ><img src="../iconos/bxs-data.svg" alt=""></i>
            <span class="title">Resplado</span>
          </a>
          <span class="tooltip">Resplado</span>
        </li>
        <li style="display: none;">
          <a href="#">
            <i class="bx bxs-devices"></i>
            <span class="title">Devices</span>
          </a>
          <span class="tooltip">Devices</span>
        </li>
        <li>
          <a href="configuracion-admin.php">
            <i class=""><img src="../iconos/bx-cog.svg" alt=""></i>
            <span class="title">Configuracion</span>
          </a>
          <span class="tooltip">Configuracion</span>
        </li>
        <li>
          <a href="../logout.php" onclick="return confirm('¿Esta seguro de cerrar la sesion?');">
          <i class=''><img src="../iconos/bx-log-out.svg" alt=""></i>
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
    <h4>Diseños Creados<br></h4>
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



    <div class="container container-bd" style="background-color: transparent;">
<div class="row">
                            <div class="col-md-12">
                                <div class="main-card mb-3 card">
                                    <div class="card-header">
                                        <div class="text-center">Lista de diseños creados</div>
                                        <div class="col-sm-12 col-md-6" style="display: none;">
                                            <form action="codigoDeRespaldoDeBaseDeDatos.php">
                                                <button class="btn btn-primary pull-right" type="submit" data-toggle="tooltip" title="Respaldar base de datos">Respaldar base de datos
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="table-responsive p-2">
                                        <table id="tabla" class="align-middle mb-0 table table-borderless table-striped table-hover">
                                            <thead>
                                                <tr>
                                                  <th>Nombre</th>
                                                  <th>Email</th>
                                                  <th>Pregunta de Seguridad</th>
                                                  <th>Respuesta de Seguridad</th>
                                                  <th>Acciones</th>
                                                </tr>
                                                
                                            </thead>
                                            <tbody>
                                            <?php
                                                require '../config.php';
                                                $sql = "SELECT * from users";
                                                $result = mysqli_query($conn, $sql);
                                                while ($mostrar = mysqli_fetch_array($result)) {
                                                ?>
                                                    <tr>
                                                        <td class="text-center"><?php echo $mostrar['id']; ?></td>
                                                        <td class="text-center"><?php echo $mostrar['name']; ?></td>
                                                        <td class="text-center"><?php echo $mostrar['email']; ?></td>
                                                        <td class="text-center"><?php echo $mostrar['pregunta_seguridad']; ?></td>
                                                        <td class="text-center"><?php echo $mostrar['respuesta_seguridad']; ?></td>
                                                        <td class="text-center">
                                                            <div class="row">
                                                                <form class="form col-sm" action="eliminarbd.php" method="post">
                                                                    <input type="hidden" name="idr" value="<?php echo $mostrar['id']; ?>">
                                                                    <button class="btn btn-danger btn-lg" type="submit" name="eliminar" data-toggle="tooltip" data-placement="left" title="Eliminar respaldo" onclick="return confirm('¿Esta seguro que quiere Eliminar este respaldo?');"><i class='bx bx-trash'></i>
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="d-block text-center card-footer">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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