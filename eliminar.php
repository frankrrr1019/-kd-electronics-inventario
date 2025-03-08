<?php
require_once '../includes/conexion.php';

if (!isset($_GET['codigo'])) {
    die("❌ Error: Código de producto no proporcionado.");
}

$codigo = $_GET['codigo'];

// 🔍 Verificar si el producto existe antes de eliminar
$check_stmt = $conn->prepare("SELECT id FROM productos WHERE codigo = ?");
$check_stmt->bind_param("s", $codigo);
$check_stmt->execute();
$check_stmt->store_result();

if ($check_stmt->num_rows === 0) {
    die("❌ Error: El producto con código '$codigo' no existe.");
}

// 🚀 Eliminar el producto completamente de la base de datos
$stmt = $conn->prepare("DELETE FROM productos WHERE codigo = ?");
$stmt->bind_param("s", $codigo);

if ($stmt->execute()) {
    header("Location: listar.php?mensaje=Producto eliminado correctamente");
    exit();
} else {
    die("❌ Error al eliminar el producto: " . $stmt->error);
}
?>

