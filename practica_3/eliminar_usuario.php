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

// Verificar que los datos se envíen mediante POST
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: usuarios.php");
    exit();
}

// Obtener el ID del usuario
$id = $_POST["id"] ?? "";

// Validar el ID
$id = filter_var($id, FILTER_VALIDATE_INT);

if ($id === false || $id === null || $id < 1) {
    header("Location: usuarios.php");
    exit();
}

// Evitar que el administrador elimine su propia cuenta
if ($id == $_SESSION["id"]) {
    die("No puedes eliminar tu propia cuenta. <a href='usuarios.php'>Regresar</a>");
}

// Eliminar el usuario
$sql = "DELETE FROM usuarios WHERE id = ?";

$stmt = mysqli_prepare($conexion, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);

if (mysqli_stmt_execute($stmt)) {
    mysqli_stmt_close($stmt);
    header("Location: usuarios.php");
    exit();
} else {
    echo "Error al eliminar el usuario: " . mysqli_error($conexion);
}

mysqli_stmt_close($stmt);
?>