<?php
session_start();

// Verificar que exista una sesión
if (!isset($_SESSION["id"])) {
    header("Location: index.php");
    exit();
}
// Verificar que sea administrador
if ($_SESSION["rol"] != 1) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Administrador</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <!-- MENU DE NAVEGACION -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="admin.php">
                Panel Administrador
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="menu">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="admin.php">
                            Inicio
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="usuarios.php">
                            Usuarios
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
    <!-- CONTENIDO PRINCIPAL -->
    <div class="container mt-5">
        <div class="card shadow-sm border-0">
            <div class="card-body p-5">
                <h1 class="text-primary">
                    ¡Bienvenido, <?php echo htmlspecialchars($_SESSION["nombre"]); ?>!
                </h1>
                <p class="lead">
                    Has iniciado sesión correctamente como administrador.
                </p>
                <hr>
                <p>
                    Desde este panel podrás administrar los usuarios del sistema.
                </p>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
