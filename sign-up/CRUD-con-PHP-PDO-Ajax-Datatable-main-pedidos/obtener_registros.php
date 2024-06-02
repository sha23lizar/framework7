<?php

    include("conexion.php");
    include("funciones.php");

    $query = '';
    $salida = array();
    $query = "SELECT * FROM orders ";
    
    if(isset($_POST['search']['value'])) {
        $query .= "WHERE name LIKE '%".$_POST['search']['value']."%'";
        $query .= "OR email LIKE '%".$_POST['search']['value']."%'";
    }

    if (isset($_POST['order'])) {
        $query .= "ORDER BY " . $_POST['order']['0']['column'] . " " . $_POST['order']['0']['dir'] . " ";
    } else {
        $query .= "ORDER BY id DESC ";
    }

    if ($_POST['length'] != -1) {
        $query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
    }

    
    $stmt = $conexion->prepare($query);
    $stmt->execute();
    $resultado = $stmt->fetchAll();
    $datos = array();
    $filtered_rows = $stmt->rowCount();
    foreach($resultado as $row){
        $sub_array = array();
        $sub_array[] = $row['name'];
        $sub_array[] = $row['email'];
        $sub_array[] = $row['genero'];
        $sub_array[] = $row['xs'];
        $sub_array[] = $row['s'];
        $sub_array[] = $row['m'];
        $sub_array[] = $row['l'];
        $sub_array[] = $row['xl'];
        $sub_array[] = $row['order_date'];
        $sub_array[] = $row['estado'];
        $sub_array[] = '<button type="button" name="aprobar" id="'.$row["id"].'" class="btn btn-danger btn-xs aprobar" style="background:#3ac47d; border:#3ac47d;">Aprobar</button>';
        $sub_array[] = '<button type="button" name="borrar" id="'.$row["id"].'" class="btn btn-danger btn-xs borrar"><i class="bx bx-trash"></button>';
        $datos[] = $sub_array;
    }

    $salida = array(
        "draw" => intval($_POST["draw"]),
        "recordsTotal" => $filtered_rows,
        "recordsFiltered" => obtener_todos_registros(),
        "data" => $datos
    );
    echo json_encode($salida);


