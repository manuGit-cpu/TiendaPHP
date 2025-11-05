<?php 
require_once "./mainPage/funcionesMainPage.php";
require_once "./catalogo/funcionesCatalogo.php";
$productos = obtenerProductos();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./catalogo/css/style.css">
</head>
<body>
        <main>
        <table class="tabla-productos">
            <thead>
            <tr>
                    <th>Código</th>
                    <th>Descripción</th>
                    <th>Precio (€)</th>
                    <th>Stock</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($productos as $fila): ?>
                    <tr>
                        <td><?= htmlspecialchars($fila['codigo']); ?></td>
                        <td><?= htmlspecialchars($fila['descripcion']); ?></td>
                        <td><?= number_format($fila['precio'], 2, ',', '.'); ?> €</td>
                        <td><?= htmlspecialchars($fila['stock']); ?></td>

                        <!-- COLUMNA DE BOTÓN -->
                        <td>
                            <button type="submit" class="btn-editar" name="btn-editar">Editar</button>
                            <button type="submit" class="btn-borrar" name="btn-borrar">Borrar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </tabl>
    </main>
</body>
</html>