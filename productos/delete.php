<?php
include "../config/conexion.php";

$id = $_GET['id'];

$stmt = $pdo->prepare("DELETE FROM productos WHERE id = :id");
$stmt->execute(['id' => $id]);

header("Location: list.php");
exit();
?>