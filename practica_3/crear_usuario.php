<?php
session_start();

// Verificar que exista una sesión
if (!isset($_SESSION["id"])) {
    header("Location: index.php");
    exit();
}
// Verificar que el usuario sea administrador
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
    <title>Crear usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="admin.php">Panel Administrador</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="menu">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="admin.php">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="usuarios.php">Usuarios</a>
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
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Registrar nuevo usuario</h4>
                </div>
                <div class="card-body">
                    <form action="guardar_usuario.php" method="POST">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">
                                Nombre de usuario:
                            </label>
                            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingresa el nombre" required>
                        </div>
                        <div class="mb-3">
                            <label for="contraseña" class="form-label">
                                Contraseña:
                            </label>
                            <input type="password" class="form-control" id="contraseña" name="contraseña" placeholder="Ingresa la contraseña" required>
                        </div>
                        <div class="mb-3">
                            <label for="rol" class="form-label">
                                Seleccionar rol:
                            </label>
                            <select class="form-select" id="rol"name="rol" required>
                                <option value="">Selecciona un rol</option>
                                <option value="2">Maestro</option>
                                <option value="3">Alumno</option>
                            </select>
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="usuarios.php" class="btn btn-secondary">
                                Regresar
                            </a>
                            <button type="submit" class="btn btn-primary">
                                Guardar usuario
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>