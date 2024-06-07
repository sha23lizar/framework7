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

$query = mysqli_query($conn, "SELECT * FROM users WHERE email='{$_SESSION['SESSION_EMAIL']}'");

if (mysqli_num_rows($query) > 0) {
    $row = mysqli_fetch_assoc($query);
    $name = $row['name'];
    $email = $row['email'];
    $pregunta_seguridad = $row['pregunta_seguridad'];
    $respuesta_seguridad = $row['respuesta_seguridad'];
}

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

        input {
            padding: 10px;
            border-radius: 10px 0px 0px 10px;
            width: 400px !important;
        }

        button {
            padding: 10px;
            background-color: #00c16e;
            color: white;
            border-radius: 0px 10px 10px 0px;
            font-size: 18px;
            color: #fff;
            background: #00c16e;
            border: none;
            font-weight: 500;
            transition: .3s ease;
            -webkit-transition: .3s ease
            
        }

        .center label{
            display: flex;
            width: 100%;
            justify-content: space-between;
            margin: auto;
            padding: auto;
        }

        form {
            display: flex;
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

@media (max-width: 780px) {
    form {
      display: block;
    }

    input {
      padding: 10px;
      border-radius: 10px 10px 0px 0px;
      width: 100% !important;
    }

    .center label{
      display: block;
      width: 100%;
      margin-bottom: 10px;
    }


    button {
            padding: 10px;
            background-color: #00c16e;
            color: white;
            border-radius: 0px 0px 10px 10px;
            font-size: 18px;
            color: #fff;
            background: #00c16e;
            border: none;
            width: 100%;
            font-weight: 500;
            transition: .3s ease;
            -webkit-transition: .3s ease
            
        }
}

</style>
  <body>
  <?php include '../includes/component/slider.php'; ?>
    

    
<section class="home">

  
<div class="container-box">
 
<div id="box"  style="background-color: transparent;">
  <div class="box-user">
   
    
  <div class="info">
    <h4>Configuracion</h4>
  </div>

<div class="container-verified">
  <div class="verified">
    <ul  class="nav-links" style="margin-top: -8px;"> 
        <li>
          <a href="#" class="link-bxr">
           <i class='bx bx-check-square bxr'></i>
           <p class="bio-usuario">verificado</p>
          </a>
          <span class="tooltip">verificado</span>
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
        <div class="select-btn">
            <span class="btn-text">Cuenta</span>
            <span class="arrow-dwn">
                <i class="fa-solid fa-chevron-down"></i>
            </span>
        </div>
        <ul class="list-items">
            <li class="item">
                <span class="item-text">Nombre de usuario: <?php echo $name; ?></span>
            </li>
            <li class="item">
                <span class="item-text">Correo: <?php echo $email; ?></span>
            </li>
            <li class="item">
                <span class="item-text">Pregunta de seguridad: <?php echo $pregunta_seguridad; ?></span>
            </li>
            <li class="item">
                <span class="item-text">Respuesta de seguridad: <?php echo $respuesta_seguridad; ?></span>
            </li>
        </ul>
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

      <div class="container">
          <div class="select-btn">
              <span class="btn-text">Modificar cuenta</span>
              <span class="arrow-dwn">
                  <i class="fa-solid fa-chevron-down"></i>
              </span>
          </div>


          <ul class="list-items item-list">
    <li style="list-style: none;" class="center">
        <form action="modificar-datos-usuarios.php" method="post">
            <label for="name">Nuevo nombre de usuario:</label>
            <input type="text" id="name" name="name" placeholder="nombre" required>
            <button type="submit">Guardar</button>
        </form>
    </li>
    <br>
    
    <li style="list-style: none;" class="center">
            <form action="modificar-datos-usuarios.php" method="POST">
                <label for="email">Nuevo correo electrónico:</label>
                <input type="email" id="email" name="email" placeholder="email" required>
                <button type="submit" name="submit">Guardar</button>
            </form>
    </li>
    <br>

    <li style="list-style: none;" class="center">
            <form action="modificar-datos-usuarios.php" method="POST">
                <label for="pregunta_seguridad">Pregunta de Seguridad</label>
                <input type="text" id="pregunta_seguridad" name="pregunta_seguridad" placeholder="pregunta de seguridad" required>
                <button type="submit" name="submit">Guardar</button>
            </form>
    </li>

    <br>
    <li style="list-style: none;" class="center">
            <form action="modificar-datos-usuarios.php" method="POST">
                <label for="respuesta_seguridad">Pregunta de Seguridad</label>
                <input type="text" id="respuesta_seguridad" name="respuesta_seguridad" placeholder="respuesta de seguridad" required>
                <button type="submit" name="submit">Guardar</button>
            </form>
    </li>
    <!-- Otros elementos del panel -->
  </ul>

      </div>
</section>
    
<?php include '../includes/component/script-slider.php'; ?>
    
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


