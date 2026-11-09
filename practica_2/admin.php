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
    <title>Administrador</title>
</head>
<body>
    <h1>Bienvenido Administrador</h1>
    <h2>Hola, <?php echo htmlspecialchars($_SESSION["nombre"]); ?></h2>
    <p>Has iniciado sesión correctamente.</p>
    <a href="logout.php">
        <button>Cerrar sesión</button>
    </a>
</body>
</html>
