<?php
include "../config/conexion.php";

$id_cliente = $_POST['id_cliente'] ?? null;

if (!$id_cliente) die("Cliente inválido.");

$stmt = $pdo->prepare("
    INSERT INTO factura (cliente_id, fecha, total)
    VALUES (:cliente, NOW(), 0)
");

$stmt->execute([
    'cliente' => $id_cliente
]);

$id_factura = $pdo->lastInsertId();

header("Location: add_producto.php?id=$id_factura");
exit;
