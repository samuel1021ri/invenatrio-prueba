<?php
$dsn = 'mysql:host=localhost;dbname=inventario;charset=utf8';
$usuario = 'root';
$contrasena = '';

try {
    $pdo = new PDO($dsn, $usuario, $contrasena);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e){
    die("Error en la conexión: " . $e->getMessage());
}