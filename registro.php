<?php require_once './registro/funcionesRegistro.php'; ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./registro/css/style.css">
</head>

<body>
    <div>
        <form action="" method="POST">
            <label for="usuario">Usuario:</label>
            <input type="text" id="usuario" name="usuario" required>

            <label for="contrasena">Contraseña:</label>
            <input type="password" id="contrasena" name="contrasena" required>

            <label for="contrasena_repetida">Repita su contraseña:</label>
            <input type="password" id="contrasena_repetida" name="contrasena_repetida" required>

            <label for="email">Correo Electrónico:</label>
            <input type="email" id="email" name="email" required>

            <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" required>

            <button type="submit">Registrarse</button>
            <button type="button" onclick="window.location.href='./index.php';">Volver</button>
            <?php
                echo $echo;
            ?>
        </form>
    </div>
</body>

</html>