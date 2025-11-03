🗃️ Crear la base de datos

CREATE DATABASE tienda;
USE tienda;

🧑‍💻 Tabla usuarios

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL,
    fecha_nacimiento DATE NOT NULL,
    rol ENUM('administrador', 'moderador', 'usuario') DEFAULT 'usuario',
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

🛍️ Tabla productos

CREATE TABLE productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    codigo VARCHAR(20) NOT NULL UNIQUE,
    descripcion VARCHAR(255) NOT NULL,
    precio DECIMAL(10,2) NOT NULL,
    stock INT DEFAULT 0
);

INSERT INTO productos (codigo, descripcion, precio, stock) VALUES
('P001', 'Camiseta básica blanca', 19.99, 25),
('P002', 'Pantalón vaquero azul', 39.95, 30),
('P003', 'Sudadera con capucha negra', 29.95, 18),
('P004', 'Chaqueta de cuero', 89.90, 10),
('P005', 'Zapatillas deportivas', 59.99, 20),
('P006', 'Gorra ajustable', 14.50, 40),
('P007', 'Calcetines (pack de 3)', 9.99, 50),
('P008', 'Cinturón de piel', 24.95, 15),
('P009', 'Camisa formal blanca', 34.90, 12),
('P010', 'Reloj digital', 49.99, 8);

💳 Tabla ventas

CREATE TABLE ventas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    fecha_compra DATETIME DEFAULT CURRENT_TIMESTAMP,
    codigo_producto VARCHAR(20) NOT NULL,
    cantidad INT NOT NULL CHECK (cantidad > 0),
    precio_total DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE,
    FOREIGN KEY (codigo_producto) REFERENCES productos(codigo) ON DELETE CASCADE
);












