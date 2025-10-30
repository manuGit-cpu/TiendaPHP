<?php
    $usuario = "root";
    $contraseña = "T9z!XVbMHCXrK7QF";
    $baseDeDatos="mysql:host=localhost;dbname=tienda";

    try {
        $conexion = new PDO($baseDeDatos,$usuario,$contraseña);

        $conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        
    } catch (\Throwable $th) {
        //throw $th;
    }

?>