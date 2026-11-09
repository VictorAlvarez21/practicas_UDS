<?php
session_start();

if (!isset($_SESSION["id"])) {
    header("Location: index.php");
    exit();
}

if ($_SESSION["rol"] != 2) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Maestro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <h1>Bienvenido Maestro</h1>
    <h2>Hola, <?php echo htmlspecialchars($_SESSION["nombre"]); ?></h2>
    <p>Has iniciado sesión correctamente.</p>
    <a href="logout.php">
        <button>Cerrar sesión</button>
    </a>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
