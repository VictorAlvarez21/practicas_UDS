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

// Consultar los usuarios de la base de datos
$sql = "SELECT id, nombre, rol FROM usuarios ORDER BY id ASC";

$resultado = mysqli_query($conexion, $sql);

if (!$resultado) {
    die("Error al consultar usuarios: " . mysqli_error($conexion));
}

// Obtener el total de usuarios
$totalUsuarios = mysqli_num_rows($resultado);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar usuarios</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <!-- Barra de navegación -->
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
    <!-- Contenido principal -->
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Administración de usuarios</h2>
            <a href="crear_usuario.php" class="btn btn-primary">
                Crear usuario
            </a>
        </div>
        <!-- Total de usuarios -->
        <div class="alert alert-info">
            Total de usuarios registrados:
            <strong><?php echo $totalUsuarios; ?></strong>
        </div>
        <!-- Tabla de usuarios -->
        <div class="card shadow">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">Lista de usuarios</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Rol</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($usuario = mysqli_fetch_assoc($resultado)) { ?>
                                <tr>
                                    <td>
                                        <?php echo $usuario["id"]; ?>
                                    </td>
                                    <td>
                                        <?php echo htmlspecialchars($usuario["nombre"]); ?>
                                    </td>
                                    <td>
                                        <?php
                                        switch ($usuario["rol"]) {

                                            case 1:
                                                echo '<span class="badge bg-danger">Administrador</span>';
                                                break;

                                            case 2:
                                                echo '<span class="badge bg-primary">Maestro</span>';
                                                break;

                                            case 3:
                                                echo '<span class="badge bg-success">Alumno</span>';
                                                break;

                                            default:
                                                echo '<span class="badge bg-secondary">Sin rol</span>';
                                                break;
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <!-- Botón editar -->
                                        <a href="editar_usuario.php?id=<?php echo $usuario["id"]; ?>"
                                            class="btn btn-warning btn-sm">
                                            Editar
                                        </a>
                                        <!-- Botón eliminar -->
                                        <form action="eliminar_usuario.php" method="POST" class="d-inline"
                                            onsubmit="return confirm('¿Estás seguro de eliminar este usuario?');">
                                            <input type="hidden" name="id"
                                                value="<?php echo $usuario["id"]; ?>">
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                Eliminar
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php } ?>
                            <?php if ($totalUsuarios == 0) { ?>
                                <tr>
                                    <td colspan="4" class="text-center">
                                        No hay usuarios registrados.
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="mt-3">
            <a href="admin.php" class="btn btn-secondary">
                Regresar al inicio
            </a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
mysqli_free_result($resultado);
mysqli_close($conexion);
?>