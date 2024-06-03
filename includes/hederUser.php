<?php
session_start();

// Verificar si la sesión no está activa
// if (!isset($_SESSION['SESSION_EMAIL'])) {
if (true) {
    // Redireccionar al usuario a la página de inicio de sesión
    ?>
  <div class="header__register">
                  <a href="./Sign-up/index.php" class="link"><img src="../imagenes/fotos/usuario.png" alt="" class="icon" style="display:none;"></a>
                  <input type="button" class="btn__header-register" onclick="redireccionar2()" style="font-weight: bold; color:black; border:solid 1px black; background:transparent;" value="Iniciar sesion">
                  <input type="button" class="btn__header-register" onclick="redireccionar()" style="font-weight: bold;" value="Registrarse">
              </div>
    <?php
} else {

include '../includes/conexion.php';


$query = mysqli_query($conn, "SELECT * FROM users WHERE email='{$_SESSION['SESSION_EMAIL']}'");

if (mysqli_num_rows($query) > 0) {
    $row = mysqli_fetch_assoc($query);
    $name = $row['name'];
    $email = $row['email'];
    ?>
    
    <?php 
}

$sql = "SELECT id, name, email, pregunta_seguridad, respuesta_seguridad FROM users"; // Consulta SQL
$result = $conn->query($sql); // Ejecutar consulta
}
?>

