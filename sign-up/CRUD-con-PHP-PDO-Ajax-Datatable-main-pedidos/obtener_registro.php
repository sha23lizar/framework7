<?php

    include("conexion.php");
    include("funciones.php");


    if(isset($_POST['id_pedidos'])) {
        $salida = array();
        $stmt = $conexion->prepare("SELECT * FROM orders WHERE id = '".$_POST["id_pedidos"]."' LIMIT 1");
        $stmt->execute();
        $resultado = $stmt->fetchAll();
        foreach ($resultado as $row) {
            $salida["name"] = $row["name"];
            $salida["email"] = $row["email"];
            $salida["genero"] = $row["genero"];
            $salida["xs"] = $row["xs"];
            $salida["s"] = $row["s"];
            $salida["m"] = $row["m"];
            $salida["l"] = $row["l"];
            $salida["xl"] = $row["xl"];
            $salida["order_date"] = $row["order_date"];
            /*
            if($row["imagen"] != "") {
                $salida["imagen_empresa"] = '<img src="'.$row["imagen"].'" class="img-thumbnail" width="100" height="50" /><input type="hidden" name="imagen_usuario_oculta" value="'.$row["imagen"].'" />';
            } else {
                $salida["imagen_empresa"] = '<input type="hidden" name="imagen_empresa_oculta" value="'.$row["imagen"].'" />';
            }
            */
        }
        echo json_encode($salida);
    }