<?php
require_once "./mainPage/funcionesMainPage.php";
$productos = obtenerProductos();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de productos</title>
    <link rel="stylesheet" href="mainPage/css/style.css">
</head>

<body>
    <header>
        <h1>Catálogo de productos</h1>
    </header>

    <main>
        <table class="tabla-productos">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Descripción</th>
                    <th>Precio (€)</th>
                    <th>Stock</th>
                    <th>Cantidad</th>
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

                        <!-- COLUMNA DE CANTIDAD -->
                        <td>
                            <form method="POST" action="">
                                <input type="hidden" name="codigo" value="<?= htmlspecialchars($fila['codigo']); ?>">
                                <input type="hidden" name="precio" value="<?= htmlspecialchars($fila['precio']); ?>">
                                <input type="number"
                                    name="cantidad"
                                    min="1"
                                    max="<?= htmlspecialchars($fila['stock']); ?>"
                                    value="1"
                                    class="input-cantidad"
                                    required>
                        </td>

                        <!-- COLUMNA DE BOTÓN -->
                        <td>
                                <button type="submit" class="btn-comprar" name="btn-compra">Comprar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
</body>

</html>
