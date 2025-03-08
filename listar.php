<?php
require_once '../includes/conexion.php';

// 🚀 Asegurar que solo se muestren productos activos (eliminado = 0)
$result = $conn->query("SELECT * FROM productos WHERE eliminado = 0 ORDER BY nombre ASC");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>📋 Lista de Productos</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <div class="container">
        <h1>📋 Lista de Productos</h1>

        <table border="1">
            <tr>
                <th>📌 Código</th>
                <th>📄 Nombre</th>
                <th>💬 Descripción</th>
                <th>💰 Precio Base</th>
                <th>💲 Precio Venta</th>
                <th>📦 Cantidad</th>
                <th>⚙️ Acciones</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()) : ?>
                <tr>
                    <td><?= htmlspecialchars($row['codigo']) ?></td>
                    <td><?= htmlspecialchars($row['nombre']) ?></td>
                    <td><?= htmlspecialchars($row['descripcion']) ?></td>
                    <td>$<?= number_format($row['precio_base'], 2) ?></td>
                    <td>$<?= number_format($row['precio_venta'], 2) ?></td>
                    <td><?= htmlspecialchars($row['cantidad']) ?></td>
                    <td>
                        <a href="editar.php?id=<?php echo $row['id']; ?>">✏️ Editar</a>
                        <a href="eliminar.php?codigo=<?= $row['codigo'] ?>" onclick="return confirm('¿Seguro que deseas eliminar este producto?')">🗑️ Eliminar</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>

        <a href="agregar.php" class="btn">➕ Agregar Producto</a>
    </div>
</body>
</html>



