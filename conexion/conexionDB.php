<?php
    $usuario = "root";
    $contraseña = "admin";
    $baseDeDatos="mysql:host=localhost;dbname=tienda";

    try {
        $conexion = new PDO($baseDeDatos,$usuario,$contraseña);

        $conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        
    } catch (\Throwable $th) {
        //throw $th;
    }

?>