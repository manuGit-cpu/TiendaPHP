<?php
require_once "./conexion/conexionDB.php";

function obtenerProductos()
{
    global $conexion;

    $stmt = $conexion->prepare("SELECT * FROM productos");

    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function comprarProducto()
{
    global $conexion;

    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $codigo = $_POST['codigo'];
        $cantidad = $_POST['cantidad'];

        $stmt = $conexion->prepare("SELECT * FROM productos WHERE codigo = ?");

        $stmt->execute([$codigo]);

        $producto= $stmt->fetch(PDO::FETCH_ASSOC);


    }
}

?>