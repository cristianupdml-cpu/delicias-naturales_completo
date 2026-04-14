<?php
session_start();
require(__DIR__ . "/../Configuracion/Conexion.php");

$correo = $_POST['email'];
$password = $_POST['password'];

// 🔐 CONSULTA
$sql = "SELECT * FROM usuarios WHERE correo='$correo'";
$result = mysqli_query($Conexion, $sql);

if(mysqli_num_rows($result) > 0){

    $user = mysqli_fetch_assoc($result);

    // 🔐 VERIFICAR CONTRASEÑA
    if(password_verify($password, $user['password'])){

        // ✅ CREAR SESIÓN
        $_SESSION['id_usuario'] = $user['id'];
        $_SESSION['correo'] = $user['correo'];
        $_SESSION['rol'] = $user['id_rol'];

        // 🔀 REDIRECCIÓN CORRECTA SEGÚN ROL
        if($user['id_rol'] == 2 || $user['id_rol'] == 3){
            header("Location: ../index.php");
        } else {
            header("Location: ../index.php");
        }
        exit();

    } else {
        echo "Contraseña incorrecta";
    }

} else {
    echo "Usuario no encontrado";
}
?>