<table class="table">
<?php
session_start();
include("Configuracion/Conexion.php");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <!-- Bootstrap CSS para tabla estilizada -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Tu CSS personalizado -->
    <link rel="stylesheet" href="styles.css">

<style>
/* ===== ESTILO FEMENINO / ELEGANTE ===== */

/* FONDO */
body {
  background: linear-gradient(135deg, #f8bbd0, #f48fb1);
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
    transform: translateY(30px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

/* TITULO */
h2 {
  font-weight: bold;
  color: #ad1457;
  text-transform: uppercase;
  letter-spacing: 2px;
}

/* TABLA */
.table {
  border-radius: 15px;
  overflow: hidden;
  box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

/* ENCABEZADO */
.table thead {
  background: linear-gradient(45deg, #ec407a, #f06292);
  color: white;
  font-size: 15px;
}

/* FILAS */
.table tbody tr {
  transition: all 0.3s ease;
}

/* HOVER SUAVE */
.table tbody tr:hover {
  background-color: #fce4ec;
  transform: scale(1.01);
}

/* CELDAS */
.table td, .table th {
  text-align: center;
  vertical-align: middle;
}

/* BOTONES */
.btn {
  border-radius: 20px;
  padding: 10px 25px;
  font-weight: bold;
  transition: all 0.3s ease;
  border: none;
}

/* BOTON AGREGAR */
.btn-success {
  background: linear-gradient(45deg, #ec407a, #f06292);
  color: white;
}

.btn-success:hover {
  transform: scale(1.08);
  background: #ad1457;
}

/* BOTON VOLVER */
.btn-primary {
  background: linear-gradient(45deg, #ba68c8, #ce93d8);
  color: white;
}

.btn-primary:hover {
  transform: scale(1.08);
  background: #6a1b9a;
}

/* EFECTO SUAVE EN TABLA */
.table tbody tr:nth-child(even) {
  background-color: #fce4ec;
}
</style>

</head>

<body>
<body style="background: linear-gradient(135deg, #e91e63, #e91e63;">

<div class="container mt-5">
    <h2 class="mb-4 text-center">Lista de Productos</h2>

    <table class="table table-striped table-hover">
        <thead class="table-success">
            <tr>
                <th scope="col">ID Producto</th>
                <th scope="col">nombre</th>
                <th scope="col">Descripción</th>
                <th scope="col">Stock</th>
                <th scope="col">Precio</th>
                <th scope="col">ID Categoría</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Consulta para traer todos los productos
            $sql = "SELECT * FROM productos";
            $resultado = $Conexion->query($sql);

            if ($resultado->num_rows > 0) {
                while($row = $resultado->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>".$row['id_producto']."</td>";
                    echo "<td>".$row['nombre']."</td>";
                    echo "<td>".$row['descripcion']."</td>";
                    echo "<td>".$row['stock']."</td>";
                    echo "<td>".$row['precio']."</td>";
                    echo "<td>".$row['id_categoria']."</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6' class='text-center'>No hay productos</td></tr>";
            }

            // Cerrar conexión
            $Conexion->close();
            ?>
        </tbody>
    </table>

    <!-- Botones para volver o agregar productos -->
    <div class="text-center mt-4">
        <?php if(isset($_SESSION['rol']) && ($_SESSION['rol'] == 2 || $_SESSION['rol'] == 3)): ?>

    <a href="formulario/productos1.php" class="btn btn-success">
        Agregar Producto
    </a>

<?php endif; ?>
        <a href="index.php" class="btn btn-primary">Volver</a>
    </div>

</div>

</body>
</html>