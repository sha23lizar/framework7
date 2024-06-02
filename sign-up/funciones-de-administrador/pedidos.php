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
    

    <link rel="stylesheet" href="../css/main2.css">
    <link rel="stylesheet" href="../css/profile.css">

  <link href="../CRUD-con-PHP-PDO-Ajax-Datatable-main-pedidos/bootstrap/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="../CRUD-con-PHP-PDO-Ajax-Datatable-main-pedidos/bootstrap/icon/font/bootstrap-icons.min.css" />
  <link rel="stylesheet" href="../CRUD-con-PHP-PDO-Ajax-Datatable-main-pedidos/DataTables/datatables.css" />
  <link rel="stylesheet" href="../CRUD-con-PHP-PDO-Ajax-Datatable-main-pedidos/css/styles.css" />
</head>
  <style>
   /*
        .row {
        width: 100% !important;
        min-width: 100%;
       }
  */
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

.dt-column-order::after::before {
  display: none;
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
          <a href="#">
            <i class=""><img src="../iconos/bx-cart-add.svg" alt=""></i>
            <span class="title">Pedidos</span>
          </a>
          <span class="tooltip">Pedidos</span>
        </li>
        <li>
          <a href="respladobd.php">
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
          <a href="../configuracion-user.php">
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
    <h4>Pedidos<br></h4>
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
<div class="container fondo">
    <div class="row">
    <div class="text-center">Lista de pedidos</div>
    </div>
    <hr>
    <div class="table-responsive">
      <table id="datos-Pedidos" class="table table-striped table-bordered">
        <thead>
          <tr>
          <th>Nombre</th>
          <th>Email</th>
          <th>Genero</th>
          <th>XS</th>
          <th>S</th>
          <th>M</th>
          <th>L</th>
          <th>XL</th>
          <th>Fecha</th>
          <th>Estado</th>
          <th>Aprobar</th>
          <th>Borrar</th>
          </tr>
        </thead>

      </table>
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

  <!-- JQuery (Tiene que estar antes que datatables por que esta la necesita) -->
  <script src="../CRUD-con-PHP-PDO-Ajax-Datatable-main-pedidos/js/jquery-3.7.1.min.js"></script>
  <!-- datatables -->
  <script src="../CRUD-con-PHP-PDO-Ajax-Datatable-main-pedidos/DataTables/datatables.js"></script>
  <!-- Bootstrap JS -->
  <script src="../CRUD-con-PHP-PDO-Ajax-Datatable-main-pedidos/bootstrap/js/bootstrap.bundle.min.js"></script>

  <script src="../CRUD-con-PHP-PDO-Ajax-Datatable-main-pedidos/almacenacientoJSON.js"></script>

  <!-- Script -->

  <script type="text/javascript">
    $(document).ready(function() {
      var dataTable = $("#datos-Pedidos").DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
          url: "../CRUD-con-PHP-PDO-Ajax-Datatable-main-pedidos/obtener_registros.php",
          type: "POST"
        },
        "columnsDefs": [{
          "targets": [0, 3, 4],
          "orderable": false,
        }, ],
        "language": {
          "decimal": "",
          "emptyTable": "No hay datos disponibles en la tabla",
          "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
          "infoEmpty": "Mostrando 0 a 0 de 0 Entradas",
          "infoFiltered": "(Filtrado de _MAX_ total entradas)",
          "infoPostFix": "",
          "thousands": ",",
          "lengthMenu": "Mostrar _MENU_ Entradas",
          "loadingRecords": "Cargando...",
          "processing": "Procesando...",
          "search": "Buscar:",
          "zeroRecords": "Sin resultados encontrados",
          "paginate": {
            "first": "Primero",
            "last": "Ultimo",
            "next": "Siguiente",
            "previous": "Anterior"
          }
          
        }
      });

    $(document).on("submit", "#form-Pedidos", function(e) {
    e.preventDefault();
    var name = $("#name").val();
    var email = $("#email").val();
    var genero= $("#genero").val();
    var xs = $("#xs").val();
    var s = $("#s").val();
    var m = $("#m").val();
    var l = $("#l").val();
    var xl = $("#xl").val();
    var order_date = $("#order_date").val();
    var estado = $("#estado").val();
    
    if (name!= '' && email != '' && genero != '' && xs  != '' && s  != '' && m  != '' && l  != '' && xl  != '' && order_Date  != '' && estado != '') {
        $.ajax({
            url: "../CRUD-con-PHP-PDO-Ajax-Datatable-main-pedidos/crear.php",
            method: "POST",
            data: {
                name: name,
                email: email,
                genro: genero,
                xs: xs,
                s: s,
                m: m,
                l: l,
                xl: xl,
                order_date: order_date,
                estado: estado,
                operacion: $("#operacion").val(),
                id_pedidos: $("#id_pedidos").val()
            },
            success: function(data) {
                alert(data);
                $("#form-Pedidos")[0].reset();
                $("#modalPedidos").modal('hide');
                dataTable.ajax.reload();
            }
        });
    } else {
        alert('Todos los campos son requeridos');
       }
    });


      // Funcionalidad editar
$(document).on("click", ".editar", function(e) {
    var id_pedidos = e.target.id;
    $.ajax({
        url: "../CRUD-con-PHP-PDO-Ajax-Datatable-main-pedidos/obtener_registro.php",
        method: "POST",
        data: {
            id_pedidos: id_pedidos
        },
        dataType: "json",
        success: function(data) {
            $("#modalPedidos").modal("show");
            $("#name").val(data.name);
            $("#email").val(data.email);
            $("#genero").val(data.genero);
            $("#xs").val(data.xs);
            $("#s").val(data.s);
            $("#m").val(data.m);
            $("#l").val(data.l);
            $("#xl").val(data.xl);
            $("#order_date").val(data.order_date);
            $("#estado").val(data.estado);
            $("#id_pedidos").val(id_pedidos); // Asegúrate de que el ID se esté enviando
            $("#action").val("editar");
            $("#operacion").val("editar");
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    })
})

      // Funcionalidad Borrar
      $(document).on("click", ".borrar", function(e) {
        var id_pedidos= e.target.id;
        if (confirm("¿Desea borrar el registro nro: "+ id_pedidos+"?")) {
          $.ajax({
            url: "../CRUD-con-PHP-PDO-Ajax-Datatable-main-pedidos/borrar.php",
            method: "POST",
            data: {
              id_pedidos: id_pedidos
            },
            success: function(data) {
              alert(data);
              dataTable.ajax.reload();
            }
          })
        }
      })


       // Funcionalidad de aprobar
       $(document).on("click", ".aprobar", function(e) {
        var id_pedidos= e.target.id;
        if (confirm("¿Desea aprobar este pedido?: "+ id_pedidos+"?")) {
          $.ajax({
            url: "../CRUD-con-PHP-PDO-Ajax-Datatable-main-pedidos/aprobar.php",
            method: "POST",
            data: {
              id_pedidos: id_pedidos
            },
            success: function(data) {
              alert(data);
              dataTable.ajax.reload();
            }
          })
        }
      })
      // Final scritp
    })

         


   
  </script>

</body>
</html>
