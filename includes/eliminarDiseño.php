<?php

    include ("conexion.php");

    if(isset($_GET['id'])){

    $id=$_GET['id'];
    $sql = "DELETE FROM diseños WHERE id='$id'";
    mysqli_query($conexionMysqli,$sql);

     if($sql==true){
         header('Location: ' . $_SERVER['HTTP_REFERER']);
         exit();
         }

     }else {
         header('Location: ' . $_SERVER['HTTP_REFERER']);
         exit();
    }
?>