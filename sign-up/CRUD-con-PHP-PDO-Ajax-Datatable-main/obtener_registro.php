<?php

    include("conexion.php");
    include("funciones.php");


    if(isset($_POST['id_usuarios'])) {
        $salida = array();
        $stmt = $conexion->prepare("SELECT * FROM users WHERE id = '".$_POST["id_usuarios"]."' LIMIT 1");
        $stmt->execute();
        $resultado = $stmt->fetchAll();
        foreach ($resultado as $row) {
            $salida["name"] = $row["name"];
            $salida["email"] = $row["email"];
            $salida["pregunta_seguridad"] = $row["pregunta_seguridad"];
            $salida["respuesta_seguridad"] = $row["respuesta_seguridad"];
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