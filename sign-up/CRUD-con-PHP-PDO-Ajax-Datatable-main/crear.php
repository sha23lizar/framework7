<?php

include("conexion.php");
include("funciones.php");

if ($_POST["operacion"] == "crear") {
    // Verificar si ya existe un registro con el mismo RIF
    $stmt_check_rif = $conexion->prepare("SELECT COUNT(*) FROM users WHERE email = :email");
    $stmt_check_rif->execute(array(":rifProveedor" => $_POST["rifProveedor"]));
    $rif_existente = $stmt_check_rif->fetchColumn();

    if ($rif_existente > 0) {
        echo "Ya existe otro registro con este RIF.";
    } else {
        // Si no existe, proceder con la inserción del nuevo registro
        $stmt = $conexion->prepare("INSERT INTO users(name, email, pregunta_seguridad, respuesta_seguridad) VALUES (:name, :email, :pregunta_seguridad, :respuesta_seguridad)");

        $resultado = $stmt->execute(
            array(
                ":name" => $_POST["name"],
                ":email" => $_POST["email"],
                ":pregunta_seguridad" => $_POST["pregunta_seguridad"],
                ":respuesta_seguridad" => $_POST["respuesta_seguridad"]
            )
        );

        if (!empty($resultado)) {
            echo "Registro exitoso";
        }  else {
            echo "Algo salió mal";
        }
    }
}

/*
if ($_POST["operacion"] == "crear") {
    
    $imagen = "";
    if ($_FILES['imagen_empresa']['name'] != "") {
        $imagen = subir_imagen();
    }
    

    $stmt = $conexion->prepare("INSERT INTO empresas(Rif, Razonsocial, Direccion, Seudonimo)VALUES (:Rif, :Razonsocial, :Direccion, :Seudonimo)");

    $resultado = $stmt->execute(
        array(
            ":Rif" => $_POST["Rif"],
            ":Razonsocial" => $_POST["Razonsocial"],
            ":Direccion" => $_POST["Direccion"],
            ":Seudonimo" => $_POST["Seudonimo"],
            
            ":imagen" => $imagen
            
        )
    );

    if (!empty($resultado)) {
        echo "registro exitoso";
    }  else {
        echo "Algo salio mal";
    }
    // $stmt->bindParam(":Rif", $_POST["Rif"]);
    // $stmt->bindParam(":Razonsocial", $_POST["Razonsocial"]);
    // $stmt->bindParam(":Direccion", $_POST["Direccion"]);
    // $stmt->bindParam(":Seudonimo", $_POST["Seudonimo"]);
    // $stmt->bindParam(":imagen", $imagen);
    // $stmt->execute();
} 

*/


if ($_POST["operacion"] == "editar") {

    /*
    $imagen = "";
    if ($_FILES['imagen_usuario']['name'] != "") {
        $imagen = subir_imagen();
    }else {
        $imagen = $_POST["imagen_usuario_oculta"];
    }
    */

    $stmt = $conexion->prepare("UPDATE proveedor SET nombreProveedor = :nombreProveedor, rifProveedor = :rifProveedor, direccionProveedor = :direccionProveedor, seudonimo = :seudonimo WHERE id = :id");

    $resultado = $stmt->execute(
        array(
            ":nombreProveedor" => $_POST["nombreProveedor"],
            ":rifProveedor" => $_POST["rifProveedor"],
            ":direccionProveedor" => $_POST["direccionProveedor"],
            ":seudonimo" => $_POST["seudonimo"],
            ":id" => $_POST["id_proveedor"]
        )
    );

    if (!empty($resultado)) {
        echo "registro Actualizado";
    }  else {
        echo "Algo salio mal";
    }
    // $stmt->bindParam(":Rif", $_POST["Rif"]);
    // $stmt->bindParam(":Razonsocial", $_POST["Razonsocial"]);
    // $stmt->bindParam(":Direccion", $_POST["Direccion"]);
    // $stmt->bindParam(":Seudonimo", $_POST["Seudonimo"]);
    // $stmt->bindParam(":imagen", $imagen);
    // $stmt->execute();
} 


/* codido de editar
if ($_POST["operacion"] == "editar") {
    $stmt = $conexion->prepare("UPDATE empresas SET Rif = :Rif, Razonsocial = :Razonsocial, Direccion = :Direccion, Seudonimo = :Seudonimo WHERE id = :id");

    $resultado = $stmt->execute(
        array(
            ":Rif" => $_POST["Rif"],
            ":Razonsocial" => $_POST["Razonsocial"],
            ":Direccion" => $_POST["Direccion"],
            ":Seudonimo" => $_POST["Seudonimo"],
            ":id" => $_POST["id_empresa"]
        )
    );

    if (!empty($resultado)) {
        echo "Registro actualizado correctamente";
    } else {
        echo "Algo salió mal al actualizar el registro";
    }
}
*/
 /*
$stmt_check_rif = $conexion->prepare("SELECT COUNT(*) FROM empresas WHERE Rif = :rif");
$stmt_check_rif->execute(array(":rif" => $_POST["Rif"]));
$rif_existente = $stmt_check_rif->fetchColumn();

if ($rif_existente > 0) {
    echo "Ya existe otro registro con este RIF.";
} else {
    // Si el RIF no existe, continuar con la operación de edición o inserción
    if ($_POST["operacion"] == "editar") {
        // Obtener el ID del registro a editar
        $id_empresa = $_POST["id_empresa"];

        // Preparar la consulta SQL para actualizar los datos
        $stmt = $conexion->prepare("UPDATE empresas SET Rif = :Rif, Razonsocial = :Razonsocial, Direccion = :Direccion, Seudonimo = :Seudonimo WHERE id = :id");

        // Ejecutar la consulta con los datos actualizados
        $resultado = $stmt->execute(
            array(
                ":Rif" => $_POST["Rif"],
                ":Razonsocial" => $_POST["Razonsocial"],
                ":Direccion" => $_POST["Direccion"],
                ":Seudonimo" => $_POST["Seudonimo"],
                ":id" => $id_empresa
            )
        );

        // Verificar si la actualización fue exitosa
        if (!empty($resultado)) {
            echo "Registro actualizado correctamente";
        } else {
            echo "Algo salió mal al actualizar el registro";
        }
    } else {
        // Si la operación no es de edición, es una inserción
        // Aquí colocarías el código para insertar el nuevo registro en la base de datos
    }
}
*/








