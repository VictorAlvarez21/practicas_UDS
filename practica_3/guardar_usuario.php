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
// Verificar que los datos se reciban mediante POST
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: crear_usuario.php");
    exit();
}
// Recibir los datos del formulario
$nombre = trim($_POST["nombre"] ?? "");
$contraseña = $_POST["contraseña"] ?? "";
$rol = $_POST["rol"] ?? "";
// Validar que los campos no estén vacíos
if ($nombre === "" || $contraseña === "" || $rol === "") {
    die("Todos los campos son obligatorios.");
}
// Validar que el rol sea válido
if (!in_array($rol, ["1", "2", "3"], true)) {
    die("El rol seleccionado no es válido.");
}
// Comprobar si el usuario ya existe
$sql = "SELECT id FROM usuarios WHERE nombre = ?";
$stmt = mysqli_prepare($conexion, $sql);
mysqli_stmt_bind_param($stmt, "s", $nombre);
mysqli_stmt_execute($stmt);
$resultado = mysqli_stmt_get_result($stmt);
if (mysqli_num_rows($resultado) > 0) {
    die("El nombre de usuario ya está registrado.");
}

mysqli_stmt_close($stmt);
// Convertir la contraseña a MD5
$contraseñaMD5 = md5($contraseña);
// Insertar el nuevo usuario
$sql = "INSERT INTO usuarios (nombre, contraseña, rol) VALUES (?, ?, ?)";
$stmt = mysqli_prepare($conexion, $sql);
$rol = (int) $rol;

mysqli_stmt_bind_param($stmt, "ssi", $nombre, $contraseñaMD5, $rol);

// Ejecutar el INSERT
if (mysqli_stmt_execute($stmt)) {
    mysqli_stmt_close($stmt);
    header("Location: usuarios.php");
    exit();
} else {
    echo "Error al registrar el usuario: " . mysqli_stmt_error($stmt);
}
?>