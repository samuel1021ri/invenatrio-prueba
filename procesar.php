<?php
$nombre = $_POST['nombre'] ?? '';
$precio = $_POST['precio'] ?? '';

if(!$nombre || !$precio){
    echo "Error: todos los campos son obligatorios";
    exit;
}

echo "Producto recibido: $nombre - $precio";