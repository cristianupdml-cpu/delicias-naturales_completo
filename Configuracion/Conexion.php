<?php

$host = "localhost";
$user = "root";
$pass = "";
$db = "delicias_naturales";

$Conexion = new mysqli($host, $user, $pass, $db);
if($Conexion->connect_error){
    die("Error de conexión: " . $Conexion->connect_error);
}
