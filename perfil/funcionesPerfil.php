<?php
require_once "./conexion/conexionDB.php";
session_start();

function obtenerPerfil()
{

    global $conexion;

    if (!isset($_SESSION['id'])) {
        header('Location: ./index.php', true, 303);
    }

    $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE id = ?");

    $stmt->bindParam(1, $_SESSION['id']);

    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function actualizarPerfil(){
    global $conexion;

    if (!isset($_SESSION['id'])) {
        header('Location: ./index.php', true, 303);
    }

    if($_POST['usuario'] == '') {
        $_POST['usuario'] = null;
    }

    if($_POST['contraseña'] == '') {
        $_POST['contraseña'] = null;
    }else{
        $hash = password_hash($_POST["contraseña"], PASSWORD_DEFAULT);
    }

    if($_POST['email'] == '') {
        $_POST['email'] = null;
    }

    if($_POST['fecha_nacimiento'] == '') {
        $_POST['fecha_nacimiento'] = null;
    }

    $sql = "
    UPDATE usuarios
    SET 
        usuario = COALESCE(?, usuario),
        password = COALESCE(?, password),
        email = COALESCE(?, email),
        fecha_nacimiento = COALESCE(?, fecha_nacimiento)
    WHERE id = ?";

    $stmt = $conexion->prepare($sql);

    $stmt->bindParam(1, $_POST['usuario']);
    $stmt->bindParam(2, $hash);
    $stmt->bindParam(3, $_POST['email']);
    $stmt->bindParam(4, $_POST['fecha_nacimiento']);
    $stmt->bindParam(5, $_SESSION['id']);

    $stmt->execute();

}

if (isset($_POST['actualizarPerfil'])) {
    actualizarPerfil();
}

?>