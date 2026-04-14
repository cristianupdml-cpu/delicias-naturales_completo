<?php
require("../Configuracion/Conexion.php");


    $nombres = $_POST['nombres'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    $id_categoria = $_POST['id_categoria'];

    $sql = "INSERT INTO productos (nombre, descripcion, precio,stock,  id_categoria)
            VALUES ('$nombres', '$descripcion', '$precio','$stock',  '$id_categoria')";

     $resultados = mysqli_query($Conexion, $sql);

    if ($resultados== TRUE){
        header("location:../index.php");

    }else{
        echo "Datos no Insertados";
    }

    