<?php
require_once '../includes/conexion.php';

$mensaje = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $codigo = $_POST['codigo'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio_base = $_POST['precio_base'];
    $precio_venta = $_POST['precio_venta'];
    $cantidad = $_POST['cantidad'];

    // Validar que los campos no estén vacíos
    if (!empty($codigo) && !empty($nombre) && !empty($descripcion) && !empty($precio_base) && !empty($precio_venta) && !empty($cantidad)) {
        
        // 🚀 Verificar si el código ya existe
        $check_stmt = $conn->prepare("SELECT id FROM productos WHERE codigo = ?");
        $check_stmt->bind_param("s", $codigo);
        $check_stmt->execute();
        $check_stmt->store_result();

        if ($check_stmt->num_rows > 0) {
            $mensaje = "⚠️ El código '$codigo' ya está registrado. Usa otro código.";
        } else {
            // Insertar el producto solo si el código no existe
            $stmt = $conn->prepare("INSERT INTO productos (codigo, nombre, descripcion, precio_base, precio_venta, cantidad, eliminado) VALUES (?, ?, ?, ?, ?, ?, 0)");
            $stmt->bind_param("sssddi", $codigo, $nombre, $descripcion, $precio_base, $precio_venta, $cantidad);

            if ($stmt->execute()) {
                $mensaje = "✅ Producto agregado correctamente";
            } else {
                $mensaje = "❌ Error al agregar producto: " . $stmt->error;
            }
        }
    } else {
        $mensaje = "⚠️ Todos los campos son obligatorios.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>➕ Agregar Producto</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <div class="container">
        <h1>➕ Agregar Nuevo Producto</h1>

        <?php if ($mensaje): ?>
            <p class="mensaje"><?= $mensaje ?></p>
        <?php endif; ?>

        <form action="agregar.php" method="POST">
            <label>📌 Código:</label>
            <input type="text" name="codigo" required>

            <label>📄 Nombre:</label>
            <input type="text" name="nombre" required>

            <label>💬 Descripción:</label>
            <textarea name="descripcion" required></textarea>

            <label>💰 Precio Base:</label>
            <input type="number" name="precio_base" step="0.01" required>

            <label>💲 Precio Venta:</label>
            <input type="number" name="precio_venta" step="0.01" required>

            <label>📦 Cantidad:</label>
            <input type="number" name="cantidad" required>

            <button type="submit">✅ Agregar Producto</button>
        </form>

        <a href="listar.php" class="btn-volver">⬅️ Volver a la lista</a>
    </div>
</body>
</html>


