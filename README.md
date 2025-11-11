# 🧾 Base de datos del proyecto Tienda PHP

Este proyecto utiliza una base de datos MySQL que gestiona usuarios, productos, ventas y albaranes.  
A continuación se detallan las estructuras de cada tabla y sus relaciones.  

---

## 🧑‍💻 Tabla **usuarios**

Guarda la información de todos los usuarios del sistema, incluyendo su rol.  

```sql
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL,
    fecha_nacimiento DATE NOT NULL,
    rol ENUM('administrador', 'moderador', 'usuario') DEFAULT 'usuario',
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

### 👥 Inserción de usuarios iniciales

Incluye tres cuentas base con contraseñas cifradas mediante `password_hash()`:

```sql
INSERT INTO usuarios (usuario, password, email, fecha_nacimiento, rol) VALUES
('admin', '<hash de admin123>', 'admin@example.com', '1990-01-01', 'administrador'),
('moderador', '<hash de mod123>', 'mod@example.com', '1992-02-02', 'moderador'),
('usuario', '<hash de user123>', 'user@example.com', '1995-03-03', 'usuario');
```

- **Administrador**: acceso total (puede crear y eliminar productos).  
- **Moderador**: puede aumentar stock y gestionar productos.  
- **Usuario**: solo puede comprar productos.  

---

## 🛍️ Tabla **productos**

Almacena los productos disponibles en el catálogo, con su código, descripción, precio y stock actual.  

```sql
CREATE TABLE productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    codigo VARCHAR(20) NOT NULL UNIQUE,
    descripcion VARCHAR(255) NOT NULL,
    precio DECIMAL(10,2) NOT NULL,
    stock INT DEFAULT 0
);
```

### 🧾 Datos iniciales de productos

```sql
INSERT INTO productos (codigo, descripcion, precio, stock) VALUES
('P001', 'Camiseta básica blanca', 19.99, 25),
('P002', 'Pantalón vaquero azul', 39.95, 30),
('P003', 'Sudadera con capucha negra', 29.95, 18);
```

---

## 💳 Tabla **ventas**

Registra cada compra realizada por un usuario, guardando la fecha, producto y cantidad comprada.  

```sql
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
```

### 🧩 Relaciones

- Cada venta está **asociada a un usuario** (cliente).  
- Cada venta hace referencia a un **producto existente** en el catálogo.  

---

## 🚚 Tabla **albaranes**

Los albaranes registran todas las operaciones de entrada de productos al almacén (es decir, cuando se insertan o aumenta el stock).  

```sql
CREATE TABLE albaranes (
    id_albaran INT AUTO_INCREMENT PRIMARY KEY,
    fecha_albaran DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    cod_producto VARCHAR(50) NOT NULL,
    cantidad INT NOT NULL,
    precio_total DECIMAL(10,2) NOT NULL,
    usuario VARCHAR(50) NOT NULL,
    FOREIGN KEY (cod_producto) REFERENCES productos(codigo)
);
```

### 📦 Descripción

- **cod_producto** → código del producto modificado.  
- **cantidad** → unidades añadidas.  
- **precio_total** → total del valor añadido.  
- **usuario** → quién realizó la operación (administrador o moderador).  

---

## 🔗 Relaciones entre tablas

| Tabla | Relación | Descripción |
|--------|-----------|-------------|
| `usuarios` ↔ `ventas` | 1:N | un usuario puede realizar muchas ventas |
| `productos` ↔ `ventas` | 1:N | un producto puede estar en varias ventas |
| `productos` ↔ `albaranes` | 1:N | un producto puede aparecer en múltiples entradas de stock |

---

## 🧱 Orden de creación recomendado

1. `usuarios`  
2. `productos`  
3. `ventas`  
4. `albaranes`  