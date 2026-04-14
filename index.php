<?php
session_start();
include("Configuracion/Conexion.php");

$nombre = "";

if(isset($_SESSION['id_usuario'])){
    $id = $_SESSION['id_usuario'];

    $sql = "SELECT nombre FROM clientes WHERE id_usuario='$id'";
    $result = mysqli_query($Conexion, $sql);

    if($row = mysqli_fetch_assoc($result)){
        $nombre = $row['nombre'];
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Delicias Naturales</title>

<link rel="stylesheet" href="styles.css">
</head>

<body>

<!-- BOTONES DINÁMICOS -->
<div style="position:absolute; top:10px; right:20px; display:flex; gap:10px; align-items:center;">

<?php if(isset($_SESSION['correo'])): ?>

    <span style="font-weight:bold; color:#333;">
        Hola, <?php echo $nombre; ?>
    </span>
    <?php if($_SESSION['rol'] == 2 || $_SESSION['rol'] == 3): ?>
        <a href="admin.php" class="btn btn-warning btn-sm">
            Panel Admin
        </a>
    <?php endif; ?>

    <a href="logout.php" class="btn btn-outline-danger btn-sm">
        Cerrar sesión
    </a>

<?php else: ?>

    <a href="auth/login.php" class="btn btn-outline-primary btn-sm">
        Iniciar sesión
    </a>

    <a href="formulario/formulario.php" class="btn btn-primary btn-sm">
        Registrarse
    </a>

<?php endif; ?>

</div>

<!-- ====================================================== -->
<header>

<div class="logo">
  <img src="img/Logo.jpeg" alt="Logo Delicias Naturales" class="logo-img">
  <div>
    <h1>Delicias Naturales</h1>
    <p><strong>Sabor 100% Casero y Natural</strong></p>
    <p>Saborea lo hecho en casa</p>
  </div>
</div>

</header>

<nav>
  <div class="nav-buttons">
    <button onclick="mostrar('inicio')">Inicio</button>
    <button onclick="mostrar('productos')">Productos</button>
    <div style="position: relative; display: inline-block;">

    <button onclick="mostrar('carrito')">
        Carrito
    </button>

    <span id="contador">0</span>

</div>
    <button onclick="mostrar('historial')">Historial</button>
    <button onclick="mostrar('empresa')">Empresa</button>
    <button onclick="mostrar('contacto')">Contacto</button>
    <a href="productos.php" class="btn">Ver productos</a>
    <button onclick="toggleDarkMode()" id="darkBtn">🌙</button>
  </div>
</nav>



<!-- ======================================================
     SECCIÓN INICIO
====================================================== -->
<section id="inicio" class="page">

<h2>Bienvenidos</h2>

<p>
En Delicias Naturales creemos que una buena alimentación
es la base fundamental para una vida saludable.
Nuestro proyecto nace con el propósito de ofrecer productos
100% caseros elaborados con ingredientes naturales.
</p>

<p>
Cada uno de nuestros yogures y bolis es preparado
con frutas frescas conservando el auténtico sabor
hecho en casa.
</p>

<p>
Trabajamos con responsabilidad y compromiso
para brindar productos frescos y saludables.
</p>

<ul>
<li>Ingredientes naturales.</li>
<li>Sabores frescos.</li>
<li>Calidad artesanal.</li>
<li>Producción local.</li>
<li>Compromiso con la salud.</li>
</ul>

<h2>Servicios</h2>

<ul>
<li>Venta de yogures artesanales
naturales.</li>
<li>Venta de bolis artesanales
de diferentes sabores.</li>
<li>Elaboración de productos
por encargo.</li>
</ul>

</section>


<!-- ======================================================
     SECCIÓN PRODUCTOS
====================================================== -->
<section id="productos" class="page">

<h2>Productos</h2>

<!-- BUSCADOR -->
<input
type="text"
id="buscador"
placeholder="Buscar producto..."
onkeyup="filtrarProductos()"
class="buscador">

<!-- FILTROS -->
<div class="filtros">

<button onclick="filtrarCategoria('todos')">
Todos
</button>

<button onclick="filtrarCategoria('Yogur')">
Yogures
</button>

<button onclick="filtrarCategoria('Boli')">
Bolis
</button>

</div>

<!-- CONTENEDOR DINÁMICO -->
<div id="contenedorProductos"
class="productos"></div>

</section>


<!-- ======================================================
     SECCIÓN EMPRESA
====================================================== -->
<section id="empresa" class="page">

<h2>Nuestra Empresa</h2>

<h3>Misión</h3>
<p>
Delicias Naturales ofrece yogures y bolis artesanales elaborados
con ingredientes naturales y de calidad, brindando a nuestros clientes
productos saludables, frescos y deliciosos que aporten bienestar y
satisfacción en cada consumo.
</p>

<h3>Visión</h3>
<p>
Delicias Naturales es un emprendimiento reconocido a nivel local por la
calidad, el sabor y lo natural de nuestros yogures y bolis artesanales,
creciendo de manera sostenible y ganăndonos la preferencia de nuestros.
</p>

<h3>Objetivos</h3>
<p>
     Brindar productos artesanales naturales que satisfagan las
necesidades de los clientes, promoviendo una alimentación
măs saludable.
* Elaborar yogures y bolis artesanales con ingredientes naturales y frescos.
* Garantizar la calidad e higiene en cada proceso de producción.
Ofrecer variedad de sabores que se adapten al gusto de los clientes.
Fortalecer la confianza y fidelidad de los consumidores.
<p>

<h3>Principios y Valores</h3>

<ul>
<li>Responsabilidad</li>
<li>Calidad</li>
<li>Honestidad</li>
<li>Compromiso</li>
<li>Trabajo en equipo</li>
<li>Sostenibilidad</li>
<li>Higiene</li>
<li>Amor por lo natural</li>
</ul>

</section>


<!-- ======================================================
     CARRITO DE COMPRAS
====================================================== -->
<section id="carrito" class="page">

<h2>Carrito</h2>

<ul id="listaCarrito"></ul>

<h3 id="total"></h3>

<button
class="whatsapp-btn"
onclick="enviarPedido()">
Enviar Pedido por WhatsApp
</button>

<button onclick="vaciarCarrito()">
Vaciar carrito
</button>

</section>


<!-- ======================================================
     HISTORIAL DE PEDIDOS
====================================================== -->
<section id="historial" class="page">

<h2>Historial</h2>

<ul id="listaHistorial"></ul>

</section>


<!-- ======================================================
     CONTACTO
====================================================== -->
<section id="contacto" class="page">

<h2>Contacto</h2>

<p>📞 3234635361</p>
<p>📞 3102518502</p>
<p>Apartadó – Antioquia</p>

</section>


<!-- ======================================================
     FOOTER
====================================================== -->
<footer>

© 2026 Delicias Naturales

</footer>


<!-- ======================================================
     NOTIFICACIONES VISUALES
====================================================== -->
<div id="notificacion"></div>


<!-- ======================================================
     SCRIPT PRINCIPAL
====================================================== -->
<script src="script.js"></script>

</body>
</html>