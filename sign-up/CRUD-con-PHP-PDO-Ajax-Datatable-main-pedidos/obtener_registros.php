<?php

include("conexion.php");
include("funciones.php");

$query = '';
$salida = array();
$query = "SELECT  
                o.*,
                u.name AS user_name,
                u.email,
                d.preview AS img
            FROM 
                orders o
            INNER JOIN 
                users u ON o.id_user = u.id 
INNER JOIN 
                diseños d ON o.id_disign = d.id
                WHERE o.estado != 'cancelado'";

if(isset($_POST['search']['value'])) {
    //  $query .= "WHERE id LIKE '%".$_POST['search']['value']."%'";
    //  $query .= "OR email LIKE '%".$_POST['search']['value']."%'";
    //  $query .= "OR user_name LIKE '%".$_POST['search']['value']."%'";
    //  $query .= "OR email LIKE '%".$_POST['search']['value']."%'";
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
foreach ($resultado as $row) {
    $sub_array = array();
    $sub_array[] = $row['id'];
    $sub_array[] = "<img style='width:100%' src='../" . $row["img"] . "' alt=''>";
    $sub_array[] = $row['user_name'];
    $sub_array[] = $row['email'];
    $sub_array[] = $row['genero'];
    $sub_array[] = $row['xs'];
    $sub_array[] = $row['s'];
    $sub_array[] = $row['m'];
    $sub_array[] = $row['l'];
    $sub_array[] = $row['xl'];
    $sub_array[] = substr($row['order_date'], 0, 10);
    $sub_array[] = $row['estado'];
    $sub_array[] = '<form class="form col-sm" action="../FPDF/generador_de_pdf.php" method="post" target="_blank">
                              <input type="hidden" name="order_id" value="' . $row["id"] . '">
                              <input type="hidden" name="email" value="' . $row["id"] . '">
                              <button class="btn btn-danger" type="submit" style=" border: transparent;" name="PDF" data-toggle="tooltip" data-placement="left" title="PDF" onclick="openPDFInNewTab(`' . $row["id"] . '`)">PDF
                              </button>
                            </form>';
    $btns = '<div style="display: flex;">';

    if ($row['estado'] == 'pendiente') {
            $btns .=
            '<form class="form col-sm" action="" method="post">
                              <input type="hidden" name="id" value="' . $row["id"] . '">
                              <button class="btn btn-success" style=" border: transparent;" type="submit" name="aprobar" data-toggle="tooltip" data-placement="left" title="Eliminar pedido" onclick="return confirm(`¿Esta seguro que quiere cancelar este pedido?`);">Aprobar
                              </button>
                            </form>'
            .
            '<form class="form col-sm" action="" method="post">
                              <input type="hidden" name="id" value="' . $row["id"] . '">
                              <button class="btn btn-danger" style="background-color:orange; border: transparent;" type="submit" name="rechazar" data-toggle="tooltip" data-placement="left" title="Eliminar pedido" onclick="return confirm(`¿Esta seguro que quiere cancelar este pedido?`);">Rechazar
                              </button>
                            </form>';
    } else if ($row['estado'] == 'cancelado') {
        $btns .=
            '<form class="form col-sm" action="" method="post">
                              <input type="hidden" name="id" value="' . $row["id"] . '">
                              <button class="btn btn-success" style=" border: transparent;" type="submit" name="rechazar" data-toggle="tooltip" data-placement="left" title="Eliminar pedido" onclick="return confirm(`¿Esta seguro que quiere cancelar este pedido?`);">Aprobar
                              </button>
                            </form>';
    } else if ($row['estado'] == 'rechazado') {
        $btns .=
            '<form class="form col-sm" action="" method="post">
                              <input type="hidden" name="id" value="' . $row["id"] . '">
                              <button class="btn btn-success" style=" border: transparent;" type="submit" name="aprobar" data-toggle="tooltip" data-placement="left" title="Eliminar pedido" onclick="return confirm(`¿Esta seguro que quiere cancelar este pedido?`);">Aprobar
                              </button>
                            </form>';
    } else if ($row['estado'] == 'Aprobado') {
        $btns .= '<form class="form col-sm" action="" method="post">
                              <input type="hidden" name="id" value="' . $row["id"] . '">
                              <button class="btn btn-danger" style="background-color:orange; border: transparent;" type="submit" name="rechazar" data-toggle="tooltip" data-placement="left" title="Eliminar pedido" onclick="return confirm(`¿Esta seguro que quiere cancelar este pedido?`);">Rechazar
                              </button>
                            </form>';
    }

    $btns .= '</div>';
    $sub_array[] = $btns;
    $datos[] = $sub_array;
}

$salida = array(
    "draw" => intval($_POST["draw"]),
    "recordsTotal" => $filtered_rows,
    "recordsFiltered" => obtener_todos_registros(),
    "data" => $datos
);
echo json_encode($salida);
