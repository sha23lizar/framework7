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
if ($_SESSION['ROLE'] == 'usuario') {
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
if ($_SESSION['ROLE'] != 'administrador') {
    // Redireccionar al usuario a la página principal si no es administrador
    header("Location: index.php");
    exit(); // Detener la ejecución del script
}



include 'config.php';

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
    <link rel="stylesheet" href="./css/profile.css">

    <link href="./CRUD-con-PHP-PDO-Ajax-Datatable-main/bootstrap/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./CRUD-con-PHP-PDO-Ajax-Datatable-main/bootstrap/icon/font/bootstrap-icons.min.css" />
    <link rel="stylesheet" href="./CRUD-con-PHP-PDO-Ajax-Datatable-main/DataTables/datatables.css" />
    <link rel="stylesheet" href="./CRUD-con-PHP-PDO-Ajax-Datatable-main/css/styles.css" />

  </head>
  <style>
        table{
          width: 100%;
        }
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            margin: auto;
            justify-content: center;
        }
        th, td {
            padding: 10px;
        }

        .nro-de-usuarios {
          display: flex;
          width: 90%;
          margin: auto;
          padding: auto;
          justify-content: left;
        }

        .container-user {
          margin-bottom: 15px;
         min-width: 200px;
        }

        .row {
        width: 93.7% !important;
        min-width: 93.7%;
        margin: auto;
       }
  
  .container-bd{
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
      display:flex;
      margin-bottom: 15px;
     
  }

  .text-center {
    text-align: center !important;
  }

ol, ul {
    padding-left: 0rem;
}

.fondo{
    width: auto;
    min-width: 95%!important;
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
  <section class="sidebar">
      <div class="nav-header">
        <p class="logo">Administrador</p>
        <i class="bx bx-menu btn-menu"></i>
      </div>
      <ul class="nav-links">
        <li>
          <a href="../index.php">
            <i class=""><img src="./iconos/bx-home-alt-2.svg" alt=""></i>
            <span class="title">Inicio</span>
          </a>
          <span class="tooltip">Inicio</span>
        </li>
        <li>
          <a href="funciones-de-administrador/diseños-creados.php">
            <i class=''><img src="./iconos/bx-brush.svg" alt=""></i>
            <span class="title">Diseños Creados</span>
          </a>
          <span class="tooltip">Diseños Creados</span>
        </li>
        <li>
          <a href="funciones-de-administrador/usuarios registrados.php">
            <i class=''><img src="./iconos/bx-user.svg" alt=""></i>
            <span class="title">Usuarios registrados</span>
          </a>
          <span class="tooltip">Usuarios registrados</span>
        </li>
        <li>
          <a href="funciones-de-administrador/pedidos.php">
            <i class=""><img src="./iconos/bx-cart-add.svg" alt=""></i>
            <span class="title">Pedidos</span>
          </a>
          <span class="tooltip">Pedidos</span>
        </li>
        <li>
          <a href="funciones-de-administrador/respladobd.php">
          <i class='' ><img src="./iconos/bxs-data.svg" alt=""></i>
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
          <a href="funciones-de-administrador/configuracion-admin.php">
            <i class=""><img src="./iconos/bx-cog.svg" alt=""></i>
            <span class="title">Configuracion</span>
          </a>
          <span class="tooltip">Configuracion</span>
        </li>
        <li>
          <a href="./logout.php" onclick="return confirm('¿Esta seguro de cerrar la sesion?');">
          <i class=''><img src="./iconos/bx-log-out.svg" alt=""></i>
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
    <div class="image-container">
        <img id="profile_pic" src="../imagenes/fotos/usuario.png" class="profile-img">
        <input type="file" id="fileInput" onchange="loadImage(event)">
        <label for="fileInput" id="uploadButton">Cargar Imagen</label>
    </div>
    
  <div class="info">
    <h4><?php echo $name; ?><br></h4>
    <p id="email" class="bio-usuario"><?php echo $email; ?></p>
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



<div class="container" style="display: none">
       <h1>Usuarios registrados</h1>
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
                        <button type='submit' name='eliminar_usuario'>Eliminar</button>
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

    <div class="container">
            <div class="select-btn">
                <span class="btn-text">Privacidad</span>
                <span class="arrow-dwn">
                    <i class="fa-solid fa-chevron-down"></i>
                </span>
            </div>
            <ul class="list-items">
                <p class="text-justify">
                  At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos 
                  dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt 
                  mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, 
                  cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas 
                  assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe 
                  eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, 
                  ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.
                </p>
            </ul>
        </div>

        <div class="container">
            <div class="select-btn">
                <span class="btn-text">Condiciones de uso</span>
                <span class="arrow-dwn">
                    <i class="fa-solid fa-chevron-down"></i>
                </span>
            </div>
            <ul class="list-items">
              <p class="text-justify">
                At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos 
                dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt 
                mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, 
                cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas 
                assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe 
                eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, 
                ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.
              </p>
            </ul>
        </div>

        <div class="container">
          <div class="select-btn">
              <span class="btn-text">Politicas de cookies</span>
              <span class="arrow-dwn">
                  <i class="fa-solid fa-chevron-down"></i>
              </span>
          </div>
          <ul class="list-items">
            <p class="text-justify">
              At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos 
              dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt 
              mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, 
              cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas 
              assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe 
              eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, 
              ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.
            </p>
          </ul>
      </div>

      <div class="container" style="display: none;">
        <div class="select-btn">
            <span class="btn-text">Politicas de cookies</span>
            <span class="arrow-dwn">
                <i class="fa-solid fa-chevron-down"></i>
            </span>
        </div>
        <ul class="list-items">
            <li class="item">
                <span class="checkbox">
                    <i class="fa-solid fa-check check-icon"></i>
                </span>
                <span class="item-text">HTML & CSS</span>
            </li>
            <li class="item">
                <span class="checkbox">
                    <i class="fa-solid fa-check check-icon"></i>
                </span>
                <span class="item-text">Bootstrap</span>
            </li>
            <li class="item">
                <span class="checkbox">
                    <i class="fa-solid fa-check check-icon"></i>
                </span>
                <span class="item-text">JavaScript</span>
            </li>
            <li class="item">
                <span class="checkbox">
                    <i class="fa-solid fa-check check-icon"></i>
                </span>
                <span class="item-text">Node.Js</span>
            </li>
            <li class="item">
                <span class="checkbox">
                    <i class="fa-solid fa-check check-icon"></i>
                </span>
                <span class="item-text">React JS</span>
            </li>
            <li class="item">
                <span class="checkbox">
                    <i class="fa-solid fa-check check-icon"></i>
                </span>
                <span class="item-text">Mango DB</span>
            </li>
        </ul>
    </div>
</section>

    <script src="node_modules/boxicons/src/box-icon-element.js"></script>
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


