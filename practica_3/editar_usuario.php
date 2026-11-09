<?php
session_start();
require_once "conexion.php";

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

// Obtener el ID enviado por GET
$id = $_GET["id"] ?? "";

// Validar que el ID sea un número entero positivo
$id = filter_var($id, FILTER_VALIDATE_INT);

if ($id === false || $id === null || $id < 1) {
    header("Location: usuarios.php");
    exit();
}

// Consultar los datos del usuario
$sql = "SELECT id, nombre, rol FROM usuarios WHERE id = ?";

$stmt = mysqli_prepare($conexion, $sql);

mysqli_stmt_bind_param($stmt, "i", $id);

mysqli_stmt_execute($stmt);

$resultado = mysqli_stmt_get_result($stmt);

// Verificar si existe el usuario
if (!$usuario = mysqli_fetch_assoc($resultado)) {
    mysqli_stmt_close($stmt);
    header("Location: usuarios.php");
    exit();
}

mysqli_stmt_close($stmt);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar usuario</title>
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
                        <a class="nav-link" href="admin.php">
                            Inicio
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="usuarios.php">
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
    <!-- FORMULARIO DE EDICION -->
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header bg-warning">
                        <h4 class="mb-0">Editar usuario</h4>
                    </div>
                    <div class="card-body">
                        <form action="actualizar_usuario.php" method="POST">
                            <!-- ID DEL USUARIO -->
                            <input type="hidden" name="id" value="<?php echo $usuario["id"]; ?>">
                            <!-- NOMBRE -->
                            <div class="mb-3">
                                <label for="nombre" class="form-label">
                                    Nombre de usuario:
                                </label>
                                <input type="text" class="form-control" id="nombre" name="nombre"
                                    value="<?php echo htmlspecialchars($usuario["nombre"]); ?>" required>
                            </div>
                            <!-- ROL -->
                            <div class="mb-3">
                                <label for="rol" class="form-label">
                                    Seleccionar rol:
                                </label>
                                <select class="form-select" id="rol" name="rol" required>
                                    <option value="1" <?php echo ($usuario["rol"] == 1) ? "selected" : ""; ?>>
                                        Administrador
                                    </option>
                                    <option value="2" <?php echo ($usuario["rol"] == 2) ? "selected" : ""; ?>>
                                        Maestro
                                    </option>
                                    <option value="3" <?php echo ($usuario["rol"] == 3) ? "selected" : ""; ?>>
                                        Alumno
                                    </option>
                                </select>
                            </div>
                            <!-- BOTONES -->
                            <div class="d-flex justify-content-between">
                                <a href="usuarios.php" class="btn btn-secondary">
                                    Cancelar
                                </a>
                                <button type="submit" class="btn btn-warning">
                                    Actualizar usuario
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