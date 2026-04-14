<?php
session_start();

if(!isset($_SESSION['rol']) || ($_SESSION['rol'] != 2 && $_SESSION['rol'] != 3)){
    header("Location: ../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Agregar Producto</title>

<link rel="stylesheet" href="../styles.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
/* ===== ESTILO FEMENINO FORMULARIO ===== */

/* FONDO */
body {
  background: linear-gradient(135deg, #f8bbd0, #f06292);
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

/* CONTENEDOR */
.container {
  background: rgba(255, 255, 255, 0.95);
  padding: 35px;
  border-radius: 20px;
  box-shadow: 0 15px 40px rgba(0,0,0,0.2);
  animation: aparecer 0.6s ease;
}

/* ANIMACIÓN */
@keyframes aparecer {
  from {
    opacity: 0;
    transform: translateY(25px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

/* TITULO */
h2 {
  color: #ad1457 !important;
  font-weight: bold;
  letter-spacing: 1px;
}

/* TARJETAS */
.card {
  border: none;
  background: #fff0f5;
  margin-bottom: 15px;
}

/* LABELS */
label {
  font-weight: bold;
  color: #880e4f;
}

/* INPUTS Y TEXTAREA */
input, textarea {
  width: 100%;
  padding: 8px;
  border-radius: 10px;
  border: 1px solid #f48fb1;
  outline: none;
  transition: 0.3s;
}

/* EFECTO FOCUS */
input:focus, textarea:focus {
  border-color: #ec407a;
  box-shadow: 0 0 5px #f06292;
}

/* BOTON */
.btn-success {
  width: 100%;
  margin-top: 15px;
  border-radius: 20px;
  background: linear-gradient(45deg, #ec407a, #f06292);
  border: none;
  font-weight: bold;
  transition: 0.3s;
}

/* HOVER BOTON */
.btn-success:hover {
  transform: scale(1.05);
  background: #ad1457;
}
</style>

</head>

<body>
<body style="background: linear-gradient(135deg, #e30052, #e30052);">

<div class="container mt-5">
<h2 class="text-center mb-4 text-success">Agregar Producto</h2>

<form action="productos_guardar.php" method="POST">

    <div>
        <div class="card p-1 shadow" style="border-radius: 15px;">
        <label>Nombre del producto:</label>
        <input type="text" name="nombres" required>
    </div>

    <div>
        <div class="card p-1 shadow" style="border-radius: 15px;">
        <label>Descripción:</label>
        <textarea name="descripcion" required></textarea>
    </div>

    <div>
        <div class="card p-1 shadow" style="border-radius: 15px;">
        <label>Stock:</label>
        <input type="number" name="stock" required>
    </div>

    <div>
        <div class="card p-1 shadow" style="border-radius: 15px;">
        <label>Precio:</label>
        <input type="number" name="precio" step="0.01" required>
    </div>

    <div>
        <div class="card p-1 shadow" style="border-radius: 15px;">
        <label>Categoría:</label>
<select name="id_categoria" class="form-control" required>

    <option value="">Seleccione una categoría</option>

    <?php
    require("../Configuracion/Conexion.php");

    $sql = "SELECT * FROM categorias";
    $resultado = $Conexion->query($sql);

    while($row = $resultado->fetch_assoc()){
        echo "<option value='".$row['id_categoria']."'>".$row['nombre']."</option>";
    }
    ?>

</select>
    </div>

   <button type="submit" class="btn btn-success">Guardar Producto</button>

</form>
</div>

</body>
</html>