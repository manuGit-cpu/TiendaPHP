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


?>