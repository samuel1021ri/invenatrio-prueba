<?php
include "conexion.php";

$sql = "INSERT INTO productos (nombre, precio) VALUES (:n, :p)";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    'n' => $_POST['nombre'],
    'p' => $_POST['precio']
]);

header("Location: list.php");