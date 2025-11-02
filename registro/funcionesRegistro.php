<?php
require_once './conexion/conexionDB.php';
$echo = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'] ?? '';
    $contrasena = $_POST['contrasena'] ?? '';
    $contrasena_repetida = $_POST['contrasena_repetida'] ?? '';
    $email = $_POST['email'] ?? '';
    $fecha_nacimiento = $_POST['fecha_nacimiento'] ?? '';

    if ($contrasena !== $contrasena_repetida) {
        $echo = " Las contraseñas no coinciden.";
        return;
    }    
    if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8,}[A-Za-z\d]$/", $contrasena)) {
        $echo = "La contraseña debe tener al menos 8 caracteres, incluir una mayúscula, una minúscula y un número, y terminar con una letra o número.";
        return;
    } 

    $stmt = $conexion->prepare("SELECT 1 FROM usuarios WHERE usuario = ?");
    $stmt->bindParam(1, $usuario);
    $stmt->execute();

    if ($stmt->fetchColumn()) {
        $echo = " El usuario ya existe.";
        return;
    }

    $hash = password_hash($contrasena, PASSWORD_DEFAULT);

    $stmt = $conexion->prepare("
        INSERT INTO usuarios (usuario, password, email, fecha_nacimiento)
        VALUES (?, ?, ?, ?)
    ");
    $stmt->bindParam(1, $usuario);
    $stmt->bindParam(2, $hash);
    $stmt->bindParam(3, $email);
    $stmt->bindParam(4, $fecha_nacimiento);

    if ($stmt->execute()) {
        $echo = " Usuario registrado correctamente.";
    } else {
        $echo = " Error al registrar el usuario.";
    }
}
?>
