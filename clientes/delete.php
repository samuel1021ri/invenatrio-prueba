<?php
include "../config/conexion.php";

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$stmt = $pdo->prepare("DELETE FROM clientes WHERE id = :id");
$stmt->execute(['id'=>$id]);

header("Location: list.php");
exit;
