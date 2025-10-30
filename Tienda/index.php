<?php require_once './index/funcionesIndex.php' ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./index/css/style.css">
</head>

<body>
    <div id="container">
        <form action="" method="POST">
            <input type="text" name="usuario" placeholder="Usuario" required>
            <input type="password" name="contrasena" placeholder="Contraseña" required>
            <button type="submit">Iniciar Sesión</button>
            <button onclick="window.location.href='./registro.php'">Registrarse</button>
            <?php
            echo $aviso;
            ?>
        </form>
    </div>
</body>

</html>