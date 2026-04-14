<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registro de Usuario</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background: linear-gradient(135deg, #ff9eb5, #ffc1cc);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: 'Segoe UI', sans-serif;
    }

    .card {
      border-radius: 20px;
      border: none;
      box-shadow: 0 10px 30px rgba(0,0,0,0.2);
      animation: aparecer 0.6s ease;
    }

    h3 {
      color: #e91e63;
      font-weight: bold;
    }

    .form-control {
      border-radius: 15px;
      padding: 10px;
      transition: 0.3s;
    }

    .form-control:focus {
      border-color: #e91e63;
      box-shadow: 0 0 10px rgba(233,30,99,0.3);
    }

    .btn-success {
      background: linear-gradient(135deg, #ff4081, #f06292);
      border: none;
      border-radius: 25px;
      font-weight: bold;
      padding: 10px;
      transition: 0.3s;
    }

    .btn-success:hover {
      transform: scale(1.05);
      box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }

    .form-check-label {
      color: #555;
    }

    #mensaje {
      font-weight: bold;
    }

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
  </style>

</head>

<body>

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-5">

      <form id="registroForm" action="../Insertar/Agg.php" method="POST">
        <div class="card p-4">

          <h3 class="text-center mb-4">Registro de Usuario</h3>

          <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" class="form-control" name="nombre" placeholder="Ingresa tu nombre" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Correo electrónico</label>
            <input type="email" id="email" class="form-control" name="email" placeholder="Ingresa tu correo" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Contraseña</label>
            <input type="password" id="password" class="form-control" name="password" placeholder="Ingresa tu contraseña" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Confirmar Contraseña</label>
            <input type="password" id="confirmPassword" class="form-control" name="confirmPassword" placeholder="Confirma tu contraseña" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Teléfono</label>
            <input type="tel" id="telefono" class="form-control" name="telefono" placeholder="Ingresa tu número" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Dirección</label>
            <input type="text" class="form-control" name="direccion" placeholder="Ingresa tu dirección" required>
          </div>

          <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="check" required>
            <label class="form-check-label">Acepto los términos y condiciones</label>
          </div>

          <button type="submit" class="btn btn-success w-100">Registrarse</button>

          <div id="mensaje" class="mt-3 text-center"></div>

        </div>
      </form>

    </div>
  </div>
</div>

<script>
document.getElementById("registroForm").addEventListener("submit", function(e) {
    if (password !== confirmPassword) {
    e.preventDefault();

    let email = document.getElementById("email").value;
    let telefono = document.getElementById("telefono").value;
    let password = document.getElementById("password").value;
    let confirmPassword = document.getElementById("confirmPassword").value;

    if (password !== confirmPassword) {
        document.getElementById("confirmPassword").classList.add("is-invalid");

        document.getElementById("mensaje").innerHTML = 
            "<span class='text-danger'>Las contraseñas no coinciden</span>";
        return;
    } else {
        document.getElementById("confirmPassword").classList.remove("is-invalid");
    }

    let usuario = {
        email: email,
        telefono: telefono,
        password: password
    };


    usuarios.push(usuario);
    localStorage.setItem("usuarios", JSON.stringify(usuarios));

    document.getElementById("mensaje").innerHTML = 
        "<span class='text-success'>Usuario registrado correctamente 💖</span>";

    document.getElementById("registroForm").reset();
});
</script>

</body>
</html>