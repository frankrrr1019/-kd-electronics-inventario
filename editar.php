<?php
require_once '../includes/conexion.php';

// Consultar el producto en la base de datos
$stmt = $conn->prepare("SELECT * FROM productos WHERE codigo = ?");
$stmt->bind_param("s", $codigo);
$stmt->execute();
$result = $stmt->get_result();
$producto = $result->fetch_assoc();

// Verificar si el producto existe
if (!isset($_GET['id'])) {
    die("❌ Error: ID de producto no proporcionado.");
}
$id = $_GET['id'];

?>
<form method="POST" action="editar.php">
    <input type="hidden" name="codigo" value="<?php echo htmlspecialchars($producto['codigo'] ?? ''); ?>">
    
    <label>Nombre:</label>
    <input type="text" name="nombre" value="<?php echo htmlspecialchars($producto['nombre'] ?? ''); ?>">

    <label>Descripción:</label>
    <textarea name="descripcion"><?php echo htmlspecialchars($producto['descripcion'] ?? ''); ?></textarea>

    <label>Precio Base:</label>
    <input type="number" step="0.01" name="precio_base" value="<?php echo $producto['precio_base'] ?? ''; ?>">

    <label>Precio Venta:</label>
    <input type="number" step="0.01" name="precio_venta" value="<?php echo $producto['precio_venta'] ?? ''; ?>">

    <label>Cantidad:</label>
    <input type="number" name="cantidad" value="<?php echo $producto['cantidad'] ?? ''; ?>">

    <button type="submit">✅ Guardar Cambios</button>
</form>
