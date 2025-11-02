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
<header class="navbar">
  <a href="index.php" class="brand" aria-label="Ir al inicio">
    <span class="brand-mark">🛍️</span> Mi Tienda
  </a>

  <button class="nav-toggle" aria-expanded="false" aria-label="Abrir menú">
    <!-- Ícono hamburguesa -->
    <svg width="24" height="24" viewBox="0 0 24 24" aria-hidden="true">
      <path d="M3 6h18M3 12h18M3 18h18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
    </svg>
  </button>

  <nav class="nav-menu" data-state="closed">
    <a href="index.php">Inicio</a>
    <a href="catalogo.php" aria-current="page">Catálogo</a>
    <a href="ofertas.php">Ofertas</a>
    <a href="contacto.php">Contacto</a>
  </nav>

  <a href="perfil.php" class="profile-link" aria-label="Ir a tu perfil">
    <!-- Ícono de perfil -->
    <svg class="avatar" viewBox="0 0 24 24" aria-hidden="true">
      <circle cx="12" cy="8" r="4"></circle>
      <path d="M4 20c0-4 4-6 8-6s8 2 8 6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
    </svg>
  </a>
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
