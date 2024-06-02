<?php

    $usuario = "root";
    $password = "";
    $dbname = "login";
    $host  = "localhost";
    $conexion = new PDO("mysql:host=".$host.";dbname=".$dbname."", $usuario, $password);
    $conexionMysqli =new mysqli($host,$usuario,$password,$dbname);
