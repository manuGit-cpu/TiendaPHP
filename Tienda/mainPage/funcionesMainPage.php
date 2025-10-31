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
        $cantidad = (int)$_POST['cantidad'];

        $stmt = $conexion->prepare("UPDATE productos SET stock = stock - ? WHERE codigo = ? ");

        $stmt->bindParam(1,$cantidad);
        $stmt->bindParam(2,$codigo);

        $stmt->execute();

        header("Location: ".$_SERVER['PHP_SELF']);
        exit;
    }
}


if (isset($_POST["btn-compra"])) {
    comprarProducto();
}

?>