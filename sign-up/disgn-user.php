<?php


session_start();

if (!isset($_SESSION['SESSION_EMAIL'])) {
  header("Location: index.php");
  exit();
}

if ($_SESSION['ROLE'] == 'administrador') {
  header("Location: index.php");
  exit();
}

include 'config.php';

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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $genero = mysqli_real_escape_string($conn, $_POST['genero']);
  $xs = mysqli_real_escape_string($conn, $_POST['xs']);
  $s = mysqli_real_escape_string($conn, $_POST['s']);
  $m = mysqli_real_escape_string($conn, $_POST['m']);
  $l = mysqli_real_escape_string($conn, $_POST['l']);
  $xl = mysqli_real_escape_string($conn, $_POST['xl']);
  $id_user = mysqli_real_escape_string($conn, $_POST['id_user']);
  $id_disign = mysqli_real_escape_string($conn, $_POST['id_disign']);

  // Asegurarse de que las variables $name y $email están definidas antes de usarlas
  if ($name && $email) {
    $sql = "INSERT INTO orders (id_disign, id_user, genero, xs, s, m, l, xl) VALUES ('{$id_disign}', '{$id_user}', '{$genero}', '{$xs}', '{$s}', '{$m}', '{$l}', '{$xl}')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
      echo "<script>window.location.href = 'welcome-user.php';</script>";
      // header('Location: ' . $_SERVER['HTTP_REFERER']);
      exit();
    } else {
      $msg = "<div class='alert alert-danger'>Algo salió mal al intentar registrar su pedido.</div>";
    }
  } else {
    $msg = "<div class='alert alert-danger'>Error: Datos del usuario no encontrados.</div>";
  }
  header('Location: ' . $_SERVER['HTTP_REFERER']);
  exit();
}

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
  <link rel="stylesheet" href="../css/estilos2.css">
  <link rel="stylesheet" type="text/css" href="../css/toastify.css">


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
    overflow-x: hidden;
    overflow-y: scroll;
    width: 500px;
    height: 80%;
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

  .shirt-size,
  label {
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
    justify-content: flex-end;
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
    height: 42px;
    border: solid 2px;
    text-align: center;
    border-left: transparent;
    border-right: transparent;
    display: flex;
    padding-left: 15px;
  }

  h1,
  .shirt-size:not(:last-child) {
    /*border-bottom: 2px solid gray;*/
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

  .btn-female,
  .btn-male {
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

  #orderForm {
    justify-items: center;

  }

  .button-pev {
    padding: 10px;
    background-color: rgb(60, 251, 57);
    color: white;
    border: transparent;
    font-weight: bold;
    width: 80%;
    border-radius: 10px;
    margin-top: -16.5px;

  }


  .hidden {
    display: none;
  }

  .error {
    color: red;
    padding: 20px;
    padding-top: 0px;
  }

  .selected {
    background-color: lightgray;
  }
</style>

<body>

  <div hidden id="id_user" data-id="<?php echo $id; ?>"></div>


  <?php include '../includes/component/slider.php'; ?>



  <section class="home">


    <div class="container-box">

      <div id="disign-content" style="background-color: transparent;">
        <h1 class="title-Disign">Diseñar</h1>

        <div class="grid" style="display: none;">
          <div class="grid-container"></div>
          <div class="grid-container"></div>
          <div class="grid-container"></div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <main class="editor">
              <div id="content-editor" class="content-Editor">

              </div>
              <div class="content-opciones-pc">
                <div class="extas-funcions">
                  <!-- <button id="btn-share" class="btn-Extra-funcions">
                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-share" viewBox="0 0 16 16">
                        <path d="M13.5 1a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3M11 2.5a2.5 2.5 0 1 1 .603 1.628l-6.718 3.12a2.5 2.5 0 0 1 0 1.504l6.718 3.12a2.5 2.5 0 1 1-.488.876l-6.718-3.12a2.5 2.5 0 1 1 0-3.256l6.718-3.12A2.5 2.5 0 0 1 11 2.5m-8.5 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3m11 5.5a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3" />
                    </svg>
                    <p>Compartir</p>
                </button> -->
                  <button class="btn-save btn-Extra-funcions">
                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-floppy" viewBox="0 0 16 16">
                      <path d="M11 2H9v3h2z" />
                      <path d="M1.5 0h11.586a1.5 1.5 0 0 1 1.06.44l1.415 1.414A1.5 1.5 0 0 1 16 2.914V14.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 14.5v-13A1.5 1.5 0 0 1 1.5 0M1 1.5v13a.5.5 0 0 0 .5.5H2v-4.5A1.5 1.5 0 0 1 3.5 9h9a1.5 1.5 0 0 1 1.5 1.5V15h.5a.5.5 0 0 0 .5-.5V2.914a.5.5 0 0 0-.146-.353l-1.415-1.415A.5.5 0 0 0 13.086 1H13v4.5A1.5 1.5 0 0 1 11.5 7h-7A1.5 1.5 0 0 1 3 5.5V1H1.5a.5.5 0 0 0-.5.5m3 4a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 .5-.5V1H4zM3 15h10v-4.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5z" />
                    </svg>
                    <p>guardar</p>
                  </button>

                  <button class="btn-download btn-Extra-funcions">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                      <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5" />
                      <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708z" />
                    </svg>
                    <p>descargar</p>
                  </button>

                  <button class="btn-Extra-funcions btn-reducir">
                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-arrows-angle-contract" viewBox="0 0 16 16">
                      <path fill-rule="evenodd" d="M.172 15.828a.5.5 0 0 0 .707 0l4.096-4.096V14.5a.5.5 0 1 0 1 0v-3.975a.5.5 0 0 0-.5-.5H1.5a.5.5 0 0 0 0 1h2.768L.172 15.121a.5.5 0 0 0 0 .707M15.828.172a.5.5 0 0 0-.707 0l-4.096 4.096V1.5a.5.5 0 1 0-1 0v3.975a.5.5 0 0 0 .5.5H14.5a.5.5 0 0 0 0-1h-2.768L15.828.879a.5.5 0 0 0 0-.707" />
                    </svg>
                    <p>Reducir</p>
                  </button>
                  <button class="btn-Extra-funcions btn-expander">
                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-arrows-angle-expand" viewBox="0 0 16 16">
                      <path fill-rule="evenodd" d="M5.828 10.172a.5.5 0 0 0-.707 0l-4.096 4.096V11.5a.5.5 0 0 0-1 0v3.975a.5.5 0 0 0 .5.5H4.5a.5.5 0 0 0 0-1H1.732l4.096-4.096a.5.5 0 0 0 0-.707m4.344-4.344a.5.5 0 0 0 .707 0l4.096-4.096V4.5a.5.5 0 1 0 1 0V.525a.5.5 0 0 0-.5-.5H11.5a.5.5 0 0 0 0 1h2.768l-4.096 4.096a.5.5 0 0 0 0 .707" />
                    </svg>
                    <p>Expandir</p>
                  </button>

                </div>
                <div id="options-edit" class="options-edit">
                  <div data-toggle="head" class="header-options-edit">
                    <button data-head="Producto" id="btn-header-opcion-producto" class="btn-header-options-edit active">
                      <span>Producto</span>
                    </button>
                    <button data-head="Personalizaciones" id="btn-header-opcion-personalizado" class="btn-header-options-edit">
                      <span>Personalizacion</span>
                    </button>
                  </div>

                  <div data-toggle="content" class="content-opcions ">
                    <div data-content="Producto" class="contenedor-opciones-producto active">
                      <h3 class="texto-tipo-producto">Franela Normal</h3>
                      <div class="contenedor-nombre-diseño">
                        <?php
                        include("../includes/conexion.php");
                        if (isset($_GET['id'])) {
                          $id_disign = $_GET['id'];
                          $sql = "SELECT nombre FROM diseños  WHERE id= '$id_disign'";
                          $result = mysqli_query($conexionMysqli, $sql);
                          while ($mostrar = mysqli_fetch_array($result)) {
                        ?>
                            <h4 class="texto-nombre-diseño"><?php echo $mostrar['nombre'] ?? 'Nuevo Diseño'; ?></h4>

                        <?php

                          }
                        } else {
                          echo "<h4 class='texto-nombre-diseño'>Nuevo Diseño</h4>";
                        } ?>

                        <div class="btn-editar-nombre">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                            <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z" />
                          </svg>
                        </div>

                      </div>

                      <h3 class="texto-color">Color de Franela:</h3>
                      <div class="content-colors"></div>
                    </div>
                    <div data-content="Personalizaciones" class="contenedor-opciones-personalizacion ">
                      <div class="content-personalizaciones active">
                      </div>

                    </div>
                  </div>
                </div>
                <button class="btn-buy" id="showFormBtn">
                  Pedir Diseño
                </button>
              </div>
            </main>



            <div id="overlay"></div>

            <div class="shirt-sizes" id="shirtSizesForm" class="content-formulario-Pedidos">
              <h1>Seleccione</h1>
              <form id="orderForm" action="" method="POST" enctype="multipart/form-data">
                <div class="shirt-size">
                  <label for="genero">Genero</label>
                  <div class="boton">
                    <button type="button" class="btn-male" style="border-radius: 5px;">M</button>
                    <input type="hidden" id="genero" name="genero" value="">
                    <button type="button" class="btn-female" style="border-radius: 5px;">F</button>
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
                <!-- 
                  <div class="shirt-size">
                    <label for="image_path">Imagen para el pedido</label>
                    
                    <input type="file" id="image_path" name="image_path" style="border-bottom: transparent; border-top: transparent; width: 400px;" accept="image/*" required>
                    
                  </div> -->

                <div id="error-message" class="error hidden">Por favor, seleccione el género y al menos una cantidad de camisetas.</div>
                <button type="submit" class="button-pev">Realizar pedido</button>
                <input type="text" class="input_id_user" name="id_user" value="<?php echo $id; ?>" hidden>
                <input type="text" id="input_id_disign" name="id_disign" value="<?php echo isset($_GET['id']) ? $_GET['id'] : 'none'; ?>" hidden>
              </form>
            </div>



            <div class="conteiner-agregar-personalizaciones">
              <button class="btn-cerrar-modal">
                <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="white" class="bi bi-x" viewBox="0 0 16 16">
                  <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
                </svg>
              </button>
              <div class="content-agregar-personalizaciones">
                <h3>Que Quieres Agregar</h3>
                <div class="opciones-agregar">
                  <form method="POST" action="../includes/subirImagen.php" class="form-agregar-imagen" style="display: none;">
                    <input type="file" name="imgens" id="file-agregar-file" hidden>
                    <input type="text" name="id_user" value="<?php echo $id; ?>" hidden>
                    <input class="btn-submit" type="submit" value="" hidden>
                  </form>
                  <button class="btn-agregar-imagen">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-image" viewBox="0 0 16 16">
                      <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0" />
                      <path d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1z" />
                    </svg>
                    <h4>
                      Subir Imagen
                    </h4>
                  </button>
                  <div class="btns-content-user-img" id="10" data-url="../users/7/img/1038698563.jpg" data-name="TU NOMBRE (1920 x 522 px).png">
                    <div>
                      <img src="..\assets\img\name.jpg" alt="">
                    </div>
                    <p class="title">TU NOMBRE</p>
                  </div>
                  <?php
                  require("../includes/Conexion.php");
                  // $id_user = 7;
                  $sql = $conexionMysqli->query("SELECT * FROM imagenes
                    WHERE id_user = $id
                    ");

                  while ($resultado = $sql->fetch_assoc()) {
                  ?>
                    <div class="btns-content-user-img" id="<?php echo $resultado['id_img'] ?>" data-url="<?php echo $resultado['urlImg'] ?>" data-name="<?php echo $resultado['nameImg'] ?>">
                      <!-- <button type="button" class="btn btn-outline-danger btn-delete-img">
                        <svg xmlns="http://www.w3.org/2000/svg" width="80%" height="80%" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                          <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                          <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                        </svg>
                      </button> -->
                      <div>
                        <img src="<?php echo $resultado['urlImg'] ?>" alt="">
                      </div>
                      <p class="title"><?php echo $resultado['nameImg'] ?></p>
                    </div>
                  <?php
                  }
                  ?>

                </div>
              </div>
              <div class="container-confirm-img-loader">
                <div class="content-img-loader">
                  <h4>Quieres Subir Esta Imagen</h4>
                  <div>
                    <div class="content-img fondo-transparent">
                      <div class="img"></div>
                    </div>
                    <p></p>
                    <div class="options">
                      <div class="btn-aceptar-imgagen ">
                        <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-check-lg" viewBox="0 0 16 16">
                          <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425z" />
                        </svg>
                        <h5>Aceptar</h5>
                      </div>
                      <div class="btn-rechazar-imagen">
                        <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-x" viewBox="0 0 16 16">
                          <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
                        </svg>
                        <h5>Cancelar</h5>
                      </div>
                    </div>
                  </div>
                </div>
              </div>


            </div>
            <div class="container-edit-position">
              <button class="btn-cerrar-modal">
                <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="white" class="bi bi-x" viewBox="0 0 16 16">
                  <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
                </svg>
              </button>
              <div class="content-edit-position">
                <h3>Editar Posicion</h3>
                <div class="sub-content-edit-position">
                  <div class="content-img">
                    <img src="../assets/models/preview/frontal-shirt.png" alt="" class=" transparent img-model">
                    <div class="img-edit-position"></div>
                  </div>
                  <div class="content-options-edit-position">
                    <div class="selector-tamaño">
                      <div id="numberSize">0</div>
                      <input type="range" id="input-tamaño" min="25" max="150" step="1" value="50" />
                    </div>
                  </div>
                </div>
                <div class="btns">
                  <button class="btn-cancelar">Cancelar</button>
                  <button class="btn-aplicar">Aplicar</button>
                </div>

              </div>
            </div>

          </div>
        </div>
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
  </script>
  <script type="importmap">
    {
            "imports": {
                "three": "../build/three.module.js",
                "three/addons/": "../build/jsm/"
            }
        }
    </script>
  <!-- <script src="../js/sweetalert.min.js"></script> -->
  <script src="../js/jquery-3.7.1.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
  <script type="module" src="..\js\formularioPedido.js"></script>
  <script type="text/javascript" src="../js/toastify.js"></script>
  <script type="module" src="..\camisa\script.js"></script>
  <!--Script Notificaciones -->
</body>

</html>