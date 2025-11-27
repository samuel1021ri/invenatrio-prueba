<?php
include "../config/conexion.php"; // Aquí ya defines $pdo

try {
    $stmt = $pdo->query("SELECT * FROM categorias");
    $categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error al obtener categorías: " . $e->getMessage());
}
?>

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

