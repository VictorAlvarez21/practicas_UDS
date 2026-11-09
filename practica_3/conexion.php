<?php

$conexion = mysqli_connect(
    "localhost", "root", "", "usuarios"
);

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}
?>