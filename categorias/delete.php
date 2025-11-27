<?php
include "../config/conexion.php";

$id = $_GET['id'] ?? null;
if (!$id) die("ID no especificado");

try {
    $stmt = $pdo->prepare("DELETE FROM categorias WHERE id=:id");
    $stmt->execute(['id' => $id]);
    header("Location: list.php");
    exit;
} catch (PDOException $e) {
    die("Error al eliminar categoría: " . $e->getMessage());
}
?>
