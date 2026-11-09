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
// Verificar que los datos se hayan enviado mediante POST
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: usuarios.php");
    exit();
}
// Obtener los datos del formulario
$id = $_POST["id"] ?? "";
$nombre = trim($_POST["nombre"] ?? "");
$rol = $_POST["rol"] ?? "";

// Validar el ID
$id = filter_var($id, FILTER_VALIDATE_INT);

// Validar los datos
if ($id === false || $id === null || $id < 1 || $nombre === "" || !in_array($rol, ["1", "2", "3"], true)) {
    die("Los datos ingresados no son válidos.");
}

// Comprobar que el nombre no esté registrado en otro usuario
$sql = "SELECT id FROM usuarios WHERE nombre = ? AND id <> ?";

$stmt = mysqli_prepare($conexion, $sql);
mysqli_stmt_bind_param($stmt, "si", $nombre, $id);
mysqli_stmt_execute($stmt);

$resultado = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($resultado) > 0) {
    mysqli_stmt_close($stmt);
    die("El nombre de usuario ya está registrado. <a href='usuarios.php'>Regresar</a>");
}

mysqli_stmt_close($stmt);

// Actualizar el usuario
$sql = "UPDATE usuarios SET nombre = ?, rol = ? WHERE id = ?";

$stmt = mysqli_prepare($conexion, $sql);
mysqli_stmt_bind_param($stmt, "sii", $nombre, $rol, $id);

if (mysqli_stmt_execute($stmt)) {
    mysqli_stmt_close($stmt);
    header("Location: usuarios.php");
    exit();
} else {
    echo "Error al actualizar el usuario: " . mysqli_error($conexion);
}

mysqli_stmt_close($stmt);
?>