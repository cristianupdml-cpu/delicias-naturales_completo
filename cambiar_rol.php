<?php
session_start();
require("Configuracion/Conexion.php");

// 🔐 SOLO ADMIN
if($_SESSION['rol'] != 2 && $_SESSION['rol'] != 3){
    echo "No autorizado";
    exit();
}

$id = $_POST['id'];
$rol = $_POST['rol'];

$sql = "UPDATE usuarios SET id_rol=? WHERE id=?";
$stmt = $Conexion->prepare($sql);
$stmt->bind_param("ii", $rol, $id);
$stmt->execute();

header("Location: admin.php");
exit();
?>