<?php
include "../config/conexion.php";

$clientes = $pdo->query("SELECT * FROM clientes ORDER BY nombre")->fetchAll();
?>
<style>
    body {
    font-family: Arial, sans-serif;
    background: #f5f5f5;
    margin: 0;
    padding: 20px;
}

table {
    width: 100%;
    max-width: 1200px;
    margin: 20px auto;
    background: white;
    border-collapse: collapse;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

th {
    background: #3498db;
    color: white;
    padding: 15px;
    text-align: left;
    font-weight: bold;
    font-size: 14px;
}

td {
    padding: 12px 15px;
    border-bottom: 1px solid #eee;
    font-size: 14px;
    color: #2c3e50;
}

tr:hover {
    background: #f8f9fa;
}

tr:last-child td {
    border-bottom: none;
}

td a {
    color: #3498db;
    text-decoration: none;
    font-weight: 500;
    transition: color 0.3s;
}

td a:hover {
    color: #2980b9;
    text-decoration: underline;
}

a[href*="delete"] {
    color: #e74c3c;
}

a[href*="delete"]:hover {
    color: #c0392b;
}

body > a {
    display: inline-block;
    margin: 20px auto;
    padding: 12px 24px;
    background: #27ae60;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    font-weight: bold;
    transition: background 0.3s;
    text-align: center;
}

body > a:hover {
    background: #229954;
}

/* Centrar el botón de agregar */
body {
    text-align: center;
}

table {
    text-align: left;
}
</style>
<table border="1">
    <tr>
        <th>Nombre</th>
        <th>Email</th>
        <th>Teléfono</th>
        <th>Dirección</th>
        <th>Acciones</th>
    </tr>
    <?php foreach($clientes as $c): ?>
    <tr>
        <td><?php echo htmlspecialchars($c['nombre']); ?></td>
        <td><?php echo htmlspecialchars($c['email']); ?></td>
        <td><?php echo htmlspecialchars($c['telefono']); ?></td>
        <td><?php echo htmlspecialchars($c['direccion']); ?></td>
        <td>
            <a href="edit.php?id=<?php echo $c['id']; ?>">Editar</a> |
            <a href="delete.php?id=<?php echo $c['id']; ?>" onclick="return confirm('¿Eliminar este cliente?');">Eliminar</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<a href="create.php">Agregar Cliente</a>
