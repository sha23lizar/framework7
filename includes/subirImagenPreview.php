<?php

include("conexion.php");

function subir_imagen(){
    $urlImg = "";
    echo "holaaaa";
    if (true) {
        echo "111111";
        $permitidos = array("image/jpg", "image/jpeg", "image/png");
        if (true) {
            echo "2222222";
            
            $dir = "../users/" . "7" . "/img";
            if (!is_dir($dir)) {
                // Intenta crear el directorio si no existe
                if (!mkdir($dir, 0777, true)) {
                    die('Fallo al crear las carpetas...');
                }
            }
            $new_name = rand();
            // $info_imgens = pathinfo($_FILES['imgens']['name']);
            // $info_imgens['extension'];
            
            $urlImg = $dir . '/' . $new_name . '.png';
            
            if (!file_exists($dir)) {
                mkdir($dir, 0777);
            }
            
            if (!move_uploaded_file($_FILES['imgens']['tmp_name'], $urlImg)) {
                $_SESSION['color'] = "danger";
                $_SESSION['msg'] .= "<br>Error al guardar imagen";
            } else {
                echo "listo";
            }
        } else {
            echo "<br>Formato de imágen no permitido</br>";
            echo $_FILES['imgens']['type'];
        }
    }
    if ($urlImg != "") {
        return $urlImg;
    }
}
$imagenUrl = "";


if(isset($_FILES['imgens'])) {
    $imagenUrl = subir_imagen();

    // $stmt = $conexion->prepare("INSERT INTO imagenes(id_user, nameImg, urlImg, statusImg )VALUES (:id_user, :nameImg, :urlImg, 'active')");

    // $resultado = $stmt->execute(
    //     array(
    //         // ":id_user" => $_POST["id_user"],
    //         ":nameImg" => $_FILES['imgens']['name'],
    //         ":urlImg" => $imagenUrl
    //     )
    // );

    // if (!empty($resultado)) {
    //     // Crear un arreglo con los valores relevantes
    //     $response = array(
    //         "id_user" => $_POST["id_user"],
    //         "nameImg" => $_FILES['imgens']['name'],
    //         "urlImg" => $imagenUrl
    //     );

    //     // Convertir el arreglo a JSON
    //     $jsonResponse = json_encode($response);

    //     // Imprimir o devolver la respuesta JSON
    //     echo $jsonResponse;
    // } else {
    //     echo "Algo salió mal";
    // }
        echo $imagenUrl;


    
} else {
    echo "No lo reconozco XD";
}
