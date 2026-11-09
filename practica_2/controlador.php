<?php

session_start();
require_once "conexion.php";

// Recibir los datos del formulario
$nombre = $_POST["usuario"] ?? "";
$contraseña = $_POST["password"] ?? "";

// Verificar que los campos no estén vacíos
if (empty($nombre) || empty($contraseña)) {
    die("ERROR: Debes ingresar usuario y contraseña.");
}

// Convertir la contraseña a MD5
$contraseñaMD5 = md5($contraseña);

// Preparar la consulta SQL
$sql = "SELECT id, nombre, rol FROM usuarios
        WHERE nombre = ? AND contraseña = ?";

$stmt = mysqli_prepare($conexion, $sql);

// Enviar los valores a la consulta
mysqli_stmt_bind_param($stmt, "ss", $nombre, $contraseñaMD5);

// Ejecutar la consulta
mysqli_stmt_execute($stmt);

// Obtener los resultados
$resultado = mysqli_stmt_get_result($stmt);

// Verificar si existe el usuario
if ($usuario = mysqli_fetch_assoc($resultado)) {

    session_regenerate_id(true);

    // Guardar los datos en la sesión
    $_SESSION["id"] = $usuario["id"];
    $_SESSION["nombre"] = $usuario["nombre"];
    $_SESSION["rol"] = $usuario["rol"];

    // Redireccionar según el rol
    switch ($usuario["rol"]) {

        case 1:
            header("Location: admin.php");
            break;

        case 2:
            header("Location: maestro.php");
            break;

        case 3:
            header("Location: alumno.php");
            break;

        default:
            header("Location: index.php");
            break;
    }

    exit();

} else {

    echo "Usuario y/o contraseña incorrectos.";

}
mysqli_stmt_close($stmt);
?>