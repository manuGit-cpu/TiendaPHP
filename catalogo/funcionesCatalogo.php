<?php
require_once "./conexion/conexionDB.php";
function borrarProducto()
{
    global $conexion;

    $stmt = $conexion->prepare("DELETE FROM productos WHERE codigo = ?");

    $stmt->bindParam(1, $_POST['codigo']);

    $stmt->execute();
}
;

function editarProducto()
{
    return $_POST['codigo'];
}

function actualizarProducto()
{
    global $conexion;

    $stmt = $conexion->prepare("UPDATE productos SET descripcion = ?, precio = ?, stock = ? WHERE codigo = ?");
    $stmt->bindParam(1, $_POST['descripcion']);
    $stmt->bindParam(2, $_POST['precio']);
    $stmt->bindParam(3, $_POST['stock']);
    $stmt->bindParam(4, $_POST['codigo']);
    $stmt->execute();
}
;


function insertarProducto()
{
    session_start();
    global $conexion;
    $mensaje = "No tienes permisos para realizar esta operación";
    $codigo = $_POST['codigo'];
    $stock = $_POST['cantidad'];

    $stmt = $conexion->prepare("SELECT * FROM productos WHERE codigo = ?");
    $stmt->execute([$codigo]);

    $fila = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($fila == null && $_SESSION['rol'] == 'administrador') {

        $stmt = $conexion->prepare("INSERT INTO productos (codigo,stock) VALUES (?,?)");

        $stmt->bindParam(1, $codigo);
        $stmt->bindParam(2, $stock);

        $stmt->execute();
        header("Location: " . $_SERVER['PHP_SELF']);

        $mensaje = "Producto insertado";

    }
    if ($fila != null) {
        global $conexion;

        $stmt = $conexion->prepare("UPDATE productos SET stock = stock + ? WHERE codigo = ?");

        $stmt->bindParam(1, $_POST['cantidad']);
        $stmt->bindParam(2, $_POST['codigo']);

        $stmt->execute();

        $mensaje = "Stock Añadido";

    }
    return $mensaje;
}



switch (true) {
    case isset($_POST['btn-borrar']):
        borrarProducto();
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    case isset($_POST['btn-editar']):
        $codigoEditando = editarProducto();
        break;
    case isset($_POST['btn-guardar']):
        actualizarProducto();
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    case isset($_POST['btn-cancelar']):
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    case isset($_POST['btn-insertar']):
        $mensaje = insertarProducto();
        $_POST = [];
        break;
    default:
        $codigoEditando = null;
        break;
}


?>