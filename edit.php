<?php
include "conexion.php";
$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM productos WHERE id = :id");
$stmt->execute(['id' => $id]);
$p = $stmt->fetch();
?>
<form action="update.php" method="POST">
    <input type="hidden" name="id" value="<?php echo $p["id"]; ?>">
    <input type="text" name="nombre" value="<?php echo $p["nombre"]; ?>">
    <input type="number" name="precio" value="<?php echo $p["precio"]; ?>">
    <button>Actualizar</button>
</form>