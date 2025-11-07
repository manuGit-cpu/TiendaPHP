<?php 

    $aviso = "";
    session_start();
    require_once './conexion/conexionDB.php';
    
    if ($_SERVER['REQUEST_METHOD'] === "POST" ) {
        $usuario = $_POST['usuario'];
        $contrasena = $_POST['contrasena'];

        $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE usuario = ?");

        $stmt->bindParam(1,$usuario);

        $stmt->execute();

        $fila = $stmt->fetch(PDO::FETCH_ASSOC);

        if($fila && password_verify($contrasena,$fila['password'])){
            $_SESSION['id'] = $fila['id']; 
            $_SESSION['usuario'] = $fila['usuario'];
            $_SESSION['rol'] = $fila['rol'];
            header('Location: ./mainPage.php', true, 303);
            exit;
        }else{
            $aviso = "Se ha introducido mal los credenciales";
        }
    }
?>