<?php
require_once './perfil/funcionesPerfil.php';
$perfil = obtenerPerfil();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./perfil/css/style.css">
</head>

<body>
    <form action="" method="post">
        <label for="usuario">Usuario:</label>
        <input type="text" id="usuario" name="usuario" value="<?= htmlspecialchars($perfil['usuario'] ?? '') ?>"
            required>

        <label for="contraseña">Nueva Contraseña:</label>
        <input type="password" id="contraseña" name="contraseña" placeholder="Introduce una nueva contraseña">


        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?= htmlspecialchars($perfil['email'] ?? '') ?>" required>

        <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
        <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" value="<?= htmlspecialchars(
            isset($perfil['fecha_nacimiento'])
            ? date('Y-m-d', strtotime($perfil['fecha_nacimiento']))
            : ''
        ) ?>" required>


        <input type="submit" value="Actualizar Perfil">
    </form>
</body>

</html>