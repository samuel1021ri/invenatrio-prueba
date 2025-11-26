<?php
include "conexion.php";
$stmt = $pdo->query("SELECT * FROM productos");
$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<h1>Productos</h1>
<a href="create.php">Nuevo</a>
<ul>
<?php foreach($productos as $p): ?>
<li>
    <?php echo $p["nombre"]; ?> - <?php echo $p["precio"]; ?>
    <a href="edit.php?id=<?php echo $p["id"]; ?>">Editar</a>
    <a href="delete.php?id=<?php echo $p["id"]; ?>">Eliminar</a>
</li>
<?php endforeach; ?>
</ul>