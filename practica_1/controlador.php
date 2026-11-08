<?php
$usuario = $_POST["usuario"];
$password = $_POST["password"];
$rol = $_POST["rol"];
// VALIDAR CAMPOS VACIOS
if ($usuario == "" || $password == "" || $rol == "") {
    header("Location: index.php");
    exit();
// USUARIO ADMINISTRADOR
} else if ($usuario == "admin" && $password == "12345") {
    switch ($rol) {
        case "admin":
            header("Location: administrador.php");
            break;
        default:
            header("Location: index.php");
            break;
    }
// USUARIO MAESTRO
} else if ($usuario == "maestro" && $password == "12345") {
    switch ($rol) {
        case "maestro":
            header("Location: maestro.php");
            break;
        default:
            header("Location: index.php");
            break;
    }
// USUARIO ALUMNO
} else if ($usuario == "alumno" && $password == "12345") {
    switch ($rol) {
        case "alumno":
            header("Location: alumno.php");
            break;
        default:
            header("Location: index.php");
            break;
    }
// CREDENCIALES INCORRECTAS
} else {
    header("Location: index.php");
    exit();
}
?>