<?php
session_start();

// Verificar que exista una sesión
if (!isset($_SESSION["id"])) {
    header("Location: index.php");
    exit();
}

// Verificar que sea alumno
if ($_SESSION["rol"] != 3) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Alumno</title>
    <!-- Bootstrap 5.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <!-- Barra de navegación -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">
        <div class="container">
            <a class="navbar-brand fw-bold" href="alumno.php">
                Panel Alumno
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="menu">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="alumno.php">
                            Inicio
                        </a>
                    </li>
                </ul>
                <span class="navbar-text text-white me-3">
                    <?php echo htmlspecialchars($_SESSION["nombre"]); ?>
                </span>
                <a href="logout.php" class="btn btn-outline-light btn-sm">
                    Cerrar sesión
                </a>
            </div>
        </div>
    </nav>
    <!-- Contenido principal -->
    <div class="container mt-5">
        <div class="card shadow border-0">
            <div class="card-header bg-dark text-white">
                <h4 class="mb-0">Inicio</h4>
            </div>
            <div class="card-body p-4">
                <h3 class="mb-3">
                    ¡Bienvenido, Alumno!
                </h3>
                <p class="text-secondary">
                    Hola, <strong><?php echo htmlspecialchars($_SESSION["nombre"]); ?></strong>.
                </p>
                <p>
                    Has iniciado sesión correctamente en el sistema.
                </p>
                <div class="alert alert-info mb-0">
                    <strong>Rol:</strong> Alumno
                    <br>
                    Tienes acceso al panel correspondiente a tu tipo de usuario.
                </div>
            </div>
        </div>
    </div>
    <!-- JavaScript Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>