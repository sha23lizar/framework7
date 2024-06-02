<?php

    include ("../config.php");

    if(isset($_REQUEST['eliminar'])){

    $idr=$_REQUEST['idr'];
    $sql = "DELETE FROM respaldos WHERE idr='$idr'";
    mysqli_query($conn,$sql);

    if($sql==true){
        header("Location: ./preloader.php");
        exit();
        }

    }else {
        header("Location: ./preloaderError.php");
        exit();
    }
?>
