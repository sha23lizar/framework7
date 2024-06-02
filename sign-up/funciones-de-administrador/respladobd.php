<?php
session_start();
// Verificar si la sesión no está activa
if (!isset($_SESSION['SESSION_EMAIL'])) {
  // Redireccionar al usuario a la página de inicio de sesión
  header("Location: index.php");
  exit(); // Detener la ejecución del script
}

// Verificar el rol del usuario
if ($_SESSION['ROLE'] != 'administrador') {
  // Redireccionar al usuario a la página principal si no es administrador
  header("Location: index.php");
  exit(); // Detener la ejecución del script
}



include '../config.php';

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
    <link rel="stylesheet" href="../css/main2.css">
	  <link id="mystylesheet" rel="stylesheet" type="text/css" href="light.css">
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

  form .btn .btn-primary .pull-right{
    
    margin: auto;
    padding: auto;
    display: flex;
    width: 100%;
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
            <i class=""><img src="../iconos/bx-home-alt-2.svg" alt=""></i>
            <span class="title">Inicio</span>
          </a>
          <span class="tooltip">Inicio</span>
        </li>
        <li>
          <a href="diseños-creados.php">
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
    <h4>Respaldo<br></h4>
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
                                        <div class="text-center">Lista de Base de Datos</div>
                                        <div class="col-sm-12 col-md-6">
                                            <form action="codigoDeRespaldoDeBaseDeDatos.php" method="post">
                                                <button class="btn btn-primary pull-right" type="submit" data-toggle="tooltip" title="Respaldar base de datos">Respaldar base de datos</button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="table-responsive p-2">
                                        <table id="tabla" class="align-middle mb-0 table table-borderless table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">id</th>
                                                    <th class="text-center">Nombre</th>
                                                    <th class="text-center">Fecha</th>
                                                    <th class="text-center">Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                require '../config.php';
                                                $sql = "SELECT * from respaldos";
                                                $result = mysqli_query($conn, $sql);
                                                while ($mostrar = mysqli_fetch_array($result)) {
                                                ?>
                                                    <tr>
                                                        <td class="text-center"><?php echo $mostrar['idr']; ?></td>
                                                        <td class="text-center"><?php echo $mostrar['nombre']; ?></td>
                                                        <td class="text-center"><?php echo date("d/m/Y g:i a", strtotime($mostrar['fecha'])); ?></td>
                                                        <td class="text-center">
                                                            <div class="row">

                                            
                                                                <form class="form col-sm" action="descargarBaseDeDatos.php" method="post">
                                                                    <input type="hidden" name="idr" value="<?php echo $mostrar['idr']; ?>">
                                                                    <button class="btn btn-success btn-lg" type="submit" name="descargar" data-toggle="tooltip" data-placement="left" title="Descargar"><i class='bx bx-download'></i></i>
                                                                    </button>
                                                                </form>
                                                                <form class="form col-sm" action="restaurarbd.php" method="post">
                                                                    <input type="hidden" name="idr" value="<?php echo $mostrar['idr']; ?>">
                                                                    <button class="btn btn-info btn-lg" type="submit" name="restaurar" data-toggle="tooltip" data-placement="left" title="Restaurar respaldo"><i class='bx bx-data'></i></i>
                                                                    </button>
                                                                </form>
                                                                <form class="form col-sm" action="eliminarbd.php" method="post">
                                                                    <input type="hidden" name="idr" value="<?php echo $mostrar['idr']; ?>">
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
