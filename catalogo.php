<?php
require_once "./mainPage/funcionesMainPage.php";
require_once "./catalogo/funcionesCatalogo.php";
$productos = obtenerProductos();
$codigoEditando = $_POST['codigo'] ?? null;
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
                        <?php if ($codigoEditando === $fila['codigo']): ?>
                            <form method="POST" action="">
                                <td>
                                    <input type="text" name="codigo" value="<?= htmlspecialchars($fila['codigo']); ?>" readonly>
                                </td>
                                <td>
                                    <input type="text" name="descripcion"
                                        value="<?= htmlspecialchars($fila['descripcion']); ?>">
                                </td>
                                <td>
                                    <input type="number" step="0.01" name="precio"
                                        value="<?= htmlspecialchars($fila['precio']); ?>">
                                </td>
                                <td>
                                    <input type="number" name="stock" value="<?= htmlspecialchars($fila['stock']); ?>">
                                </td>
                                <td>
                                    <button type="submit" name="btn-guardar" class="btn-guardar">Guardar</button>
                                    <button type="submit" name="btn-cancelar" class="btn-cancelar">Cancelar</button>
                                </td>
                            </form>
                        <?php else: ?>
                            <td><?= htmlspecialchars($fila['codigo']); ?></td>
                            <td><?= htmlspecialchars($fila['descripcion']); ?></td>
                            <td><?= number_format($fila['precio'], 2, ',', '.'); ?> €</td>
                            <td><?= htmlspecialchars($fila['stock']); ?></td>
                            <td>
                                <form method="POST" action="">
                                    <input type="hidden" name="codigo" value="<?= htmlspecialchars($fila['codigo']); ?>">
                                    <button type="submit" name="btn-editar" class="btn-editar">Editar</button>
                                    <button type="submit" name="btn-borrar" class="btn-borrar">Eliminar</button>
                                </form>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
</body>

</html>