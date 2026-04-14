<?php

include("../Configuracion/Conexion.php");

// Datos del formulario
$nombre = $_POST['nombre'];
$correo = $_POST['email'];
$password = $_POST['password'];
$telefono = $_POST['telefono'];
$direccion = $_POST['direccion'];

// Encriptar contraseña
$passwordHash = password_hash($password, PASSWORD_DEFAULT);

// 1. Insertar en usuarios
$sqlUsuario = "INSERT INTO usuarios (correo, password, id_rol) 
VALUES ('$correo', '$passwordHash', 2)";

$resultUsuario = mysqli_query($Conexion, $sqlUsuario);

if ($resultUsuario) {

    // 🔥 OBTENER ID DEL USUARIO
    $id_usuario = mysqli_insert_id($Conexion);

    // 2. Insertar en cliente (AQUÍ ESTABA EL ERROR)
    $sqlCliente = "INSERT INTO clientes (id_usuario, nombre, telefono, direccion) 
    VALUES ('$id_usuario', '$nombre', '$telefono', '$direccion')";

    $resultCliente = mysqli_query($Conexion, $sqlCliente);

    if ($resultCliente) {
        header("Location: ../index.php");
        exit();
    } else {
        echo "Error cliente: " . mysqli_error($Conexion);
    }

} else {
    echo "Error usuario: " . mysqli_error($Conexion);
}