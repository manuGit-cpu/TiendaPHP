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
        $cantidad = (int) $_POST['cantidad'];

        $stmt = $conexion->prepare("UPDATE productos SET stock = stock - ? WHERE codigo = ? ");

        $stmt->bindParam(1, $cantidad);
        $stmt->bindParam(2, $codigo);

        $stmt->execute();


    }
}

function añadirVenta()
{
    global $conexion;

    try {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            session_start();

            $id = $_SESSION['id'];
            $codigo = $_POST['codigo'];
            $precio = $_POST['precio'];
            $cantidad = (int) $_POST['cantidad'];
            $precioTotal = $cantidad * $precio;

            $stmt = $conexion->prepare("INSERT INTO ventas (usuario_id, codigo_producto, cantidad, precio_total) VALUES (?,?,?,?)");

            $stmt->bindParam(1, $id);
            $stmt->bindParam(2, $codigo);
            $stmt->bindParam(3, $cantidad);
            $stmt->bindParam(4, $precioTotal);

            $stmt->execute();

        }
    } catch (\Throwable $th) {
        die();
    }


}


if (isset($_POST["btn-compra"])) {
    añadirVenta();
    comprarProducto();
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

?>