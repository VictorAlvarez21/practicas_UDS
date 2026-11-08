<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form action="controlador.php" method="post">
        <label for="Usuario">Usuario:</label> 
        <input type="text" id="usuario" name="usuario" placeholder="Ingresa tu usuario"> <br><br>
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" placeholder="Ingresa tu contraseña"> <br><br>
        
        <label for="rol">Selecciona tu rol:</label>
        
        <select id="rol" name="rol">
            <option value="">Selecciona una opcion</option>
            <option value="admin">Administrador</option>
            <option value="maestro">Maestro</option>
            <option value="alumno">Alumno</option>
        </select><br><br>
    <button type="submit">Iniciar Sesion</button>
    </form>
</body>
</html>
