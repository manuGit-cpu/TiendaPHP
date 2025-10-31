<?php
require_once "./conexion/conexionDB.php";

function obtenerProductos()
{
    global $conexion;

    $stmt = $conexion->prepare("SELECT * FROM productos");

    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

    // function comprarProducto(){
    //     if () {
    //         # code...
    //     }
    // }

?>