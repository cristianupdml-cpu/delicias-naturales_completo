
<?php
session_start();
if(isset($_SESSION['usuario'])){
header("Location: ../index.php");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Login - Delicias Naturales</title>
<link rel="stylesheet" href="../styles.css">
<style>
body{display:flex;justify-content:center;align-items:center;height:100vh;background:#ffc1cc;font-family:Arial}
.login-box{background:white;padding:100px;border-radius:70px;box-shadow:0 0 100px rgba(0,0,0,0.2)}
input{display:block;margin-bottom:25px;padding:10px;width:250px}
button{padding:10px;width:100%;background:#e91e63;color:#000000;border:none;border-radius:5px}
</style>
</head>
<body>

<div class="login-box">
<h2>Iniciar Sesión</h2>

<form action="procesar_login.php" method="POST">
<input type="email" name="email" placeholder="Correo" required>
<input type="password" name="password" placeholder="Contraseña" required>
<button type="submit">Entrar</button>
</form>

</div>

</body>
</html>
