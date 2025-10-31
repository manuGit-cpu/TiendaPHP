<?php require_once "./mainPage/funcionesMainPage.php";
$productos = obtenerProductos();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./mainPage/css/style.css">
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
                        <td><?= number_format($fila['precio'], 2, ',', '.'); ?></td>
                        <td><?= htmlspecialchars($fila['stock']); ?></td>
                        <td>
                            <input type="number" name="cantidad_<?= htmlspecialchars($fila['codigo']); ?>" min="1"
                                max="<?= htmlspecialchars($fila['stock']); ?>" value="1" class="input-cantidad">
                        </td>
                        <td>
                            <form method="POST" action="" >
                                <input type="hidden" name="codigo" value="<?= htmlspecialchars($fila['codigo']); ?>">
                                <input type="hidden" name="precio" value="<?= htmlspecialchars($fila['precio']); ?>">
                                <input type="number" hidden name="cantidad" min="1" max="<?= htmlspecialchars($fila['stock']); ?>"
                                    value="1" class="input-cantidad">
                                <button type="submit" class="btn-comprar">Comprar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
</body>

</html>