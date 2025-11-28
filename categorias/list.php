<?php
include "../config/conexion.php"; // Aquí ya defines $pdo

try {
    $stmt = $pdo->query("SELECT * FROM categorias");
    $categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error al obtener categorías: " . $e->getMessage());
}
?>
<style>
div {
    max-width: 900px;
    margin: 50px auto;
    padding: 30px;
    background: #f9f9f9;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    font-family: Arial, sans-serif;
}

h2 {
    text-align: center;
    color: #333;
    margin-bottom: 25px;
    font-size: 28px;
}

a[href="create.php"] {
    display: inline-block;
    padding: 10px 20px;
    background: #3498db;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    font-weight: bold;
    transition: background 0.3s;
}

a[href="create.php"]:hover {
    background: #2980b9;
}

table {
    width: 100%;
    border-collapse: collapse;
    background: white;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
}

th {
    background: #34495e;
    color: white;
    padding: 15px;
    text-align: left;
    font-weight: bold;
}

th:last-child {
    text-align: center;
}

td {
    padding: 15px;
    border-bottom: 1px solid #ecf0f1;
}

tr:last-child td {
    border-bottom: none;
}

td:nth-child(2) {
    font-weight: 500;
}

td:nth-child(3) {
    color: #7f8c8d;
}

td:last-child {
    text-align: center;
}

td a {
    text-decoration: none;
    font-weight: bold;
    transition: color 0.3s;
}

td a[href*="edit.php"] {
    color: #27ae60;
    margin-right: 10px;
}

td a[href*="edit.php"]:hover {
    color: #229954;
}

td a[href*="delete.php"] {
    color: #e74c3c;
    margin-left: 10px;
}

td a[href*="delete.php"]:hover {
    color: #c0392b;
}

td span {
    color: #bdc3c7;
}
</style>
<div>
<h2>Lista de Categorías</h2>
<a href="create.php">+ Agregar Categoría</a>
<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Descripción</th>
        <th>Acciones</th>
    </tr>
    <?php foreach ($categorias as $categoria): ?>
    <tr>
        <td><?= $categoria['id'] ?></td>
        <td><?= htmlspecialchars($categoria['nombre']) ?></td>
        <td><?= htmlspecialchars($categoria['descripcion']) ?></td>
        <td>
            <a href="edit.php?id=<?= $categoria['id'] ?>">Editar</a> | 
            <a href="delete.php?id=<?= $categoria['id'] ?>" onclick="return confirm('¿Eliminar esta categoría?')">Eliminar</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
</div>
