
<?php
session_start();

if (!isset($_SESSION["id"])) {
    header("Location: index.php");
    exit();
}

if ($_SESSION["rol"] != 3) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Alumno</title>
</head>
<body>
    <h1>Bienvenido Alumno</h1>
    <h2>Hola, <?php echo htmlspecialchars($_SESSION["nombre"]); ?></h2>
    <p>Has iniciado sesión correctamente.</p>
    <a href="logout.php">
        <button>Cerrar sesión</button>
    </a>
</body>
</html>
