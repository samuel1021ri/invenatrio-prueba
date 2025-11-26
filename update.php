<?php
include "conexion.php";

$sql = "UPDATE productos SET nombre=:n, precio=:p WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    'n' => $_POST['nombre'],
    'p' => $_POST['precio'],
    'id' => $_POST['id']
]);

header("Location: list.php");