<?php
session_start();
require(__DIR__ . "/Configuracion/Conexion.php");

// 🔐 PROTECCIÓN CORREGIDA
if(!isset($_SESSION['correo'])){
    header("Location: ../auth/login.php");
    exit();
}

// 🔐 VALIDACIÓN DE ROL
if($_SESSION['rol'] != 2 && $_SESSION['rol'] != 3){
    echo "No tienes permisos para acceder";
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Panel Admin</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background: #1e1e2f; color: white;">

<div class="container mt-5">

    <div class="card p-4 shadow-lg" style="background:#C0C0C0; border-radius:15px;">
        
        <h2 class="text-center mb-3">⚙️ Panel de Administración</h2>
        
        <!-- ✅ CAMBIO AQUÍ -->
        <p class="text-center">
            Bienvenido, <?php echo $_SESSION['correo']; ?> 👋
        </p>

        <hr style="border-color:#555;">

        <h4 class="mb-3">Usuarios registrados</h4>

        <div class="table-responsive">
            <table class="table table-dark table-hover align-middle text-center">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Correo</th>
                        <th>Rol</th>
                        <th>Acción</th>
                    </tr>
                </thead>

                <tbody>

                <?php
                $sql = "SELECT * FROM usuarios";
                $result = mysqli_query($Conexion, $sql);

                while($row = mysqli_fetch_assoc($result)){
                ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['correo']; ?></td>
                    <td>
                        <?php 
                        if($row['id_rol'] == 1) echo "Cliente";
                        if($row['id_rol'] == 2) echo "Administrativo";
                        if($row['id_rol'] == 3) echo "Directivo";
                        ?>
                    </td>
                    <td>
                        <form action="cambiar_rol.php" method="POST">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

                            <select name="rol" class="form-select form-select-sm mb-1">
                                <option value="1">Cliente</option>
                                <option value="2">Administrativo</option>
                                <option value="3">Directivo</option>
                            </select>

                            <button class="btn btn-warning btn-sm w-100">
                                Actualizar
                            </button>
                        </form>
                    </td>
                </tr>
                <?php } ?>

                </tbody>
            </table>
        </div>

        <div class="text-center mt-3">
            <a href="index.php" class="btn btn-dark">
                ⬅ Volver
            </a>
        </div>

    </div>

</div>

</body>
</html>