<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = 'root';
    $contrasena = 'admin';
    $bbdd = 'mysql:host=localhost';

    try {
        $conexion = new PDO($bbdd, $usuario, $contrasena);

        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "CREATE DATABASE tienda";

        $stmt = $conexion->prepare($sql);
        $stmt->execute();

        $conexion = new PDO('mysql:host=localhost;dbname=tienda', $usuario, $contrasena);


        $sql = "CREATE TABLE usuarios ( id INT AUTO_INCREMENT PRIMARY KEY, usuario VARCHAR(50) NOT NULL UNIQUE, password VARCHAR(255) NOT NULL, email VARCHAR(100) NOT NULL, fecha_nacimiento DATE NOT NULL, rol ENUM('administrador', 'moderador', 'usuario') DEFAULT 'usuario', fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP );";

        $sql .= "INSERT INTO usuarios (usuario, password, email, fecha_nacimiento, rol) VALUES 
        ('admin', '" . password_hash("admin123", PASSWORD_DEFAULT) . "', 'admin@example.com', '1990-01-01', 'administrador'), 
        ('moderador', '" . password_hash("mod123", PASSWORD_DEFAULT) . "', 'mod@example.com', '1992-02-02', 'moderador'), 
        ('usuario', '" . password_hash("user123", PASSWORD_DEFAULT) . "', 'user@example.com', '1995-03-03', 'usuario');";

        $sql .= "CREATE TABLE productos ( id INT AUTO_INCREMENT PRIMARY KEY, codigo VARCHAR(20) NOT NULL UNIQUE, descripcion VARCHAR(255) NOT NULL, precio DECIMAL(10,2) NOT NULL, stock INT DEFAULT 0 );";

        $sql .= "INSERT INTO productos (codigo, descripcion, precio, stock) 
        VALUES ('P001', 'Camiseta básica blanca', 19.99, 25), ('P002', 'Pantalón vaquero azul', 39.95, 30), ('P003', 'Sudadera con capucha negra', 29.95, 18);";

        $sql .= "CREATE TABLE ventas ( id INT AUTO_INCREMENT PRIMARY KEY, usuario_id INT NOT NULL, fecha_compra DATETIME DEFAULT CURRENT_TIMESTAMP, codigo_producto VARCHAR(20) NOT NULL, cantidad INT NOT NULL CHECK (cantidad > 0), precio_total DECIMAL(10,2) NOT NULL, FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE, FOREIGN KEY (codigo_producto) REFERENCES productos(codigo) ON DELETE CASCADE );";

        $sql .= "CREATE TABLE albaranes (id_albaran int NOT NULL, fecha_albaran datetime NOT NULL DEFAULT CURRENT_TIMESTAMP, cod_producto varchar(50) NOT NULL, cantidad int NOT NULL, precio_total decimal(10,2) NOT NULL, usuario varchar(50) NOT NULL)";

        $stmt = $conexion->prepare($sql);

        $stmt->execute();

        header("Location: ./index.php");


    } catch (\Throwable $th) {
        die();
    }


}

?>