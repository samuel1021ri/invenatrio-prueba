<?php
include "../config/conexion.php";

$errores = [];
$id = $_GET['id'] ?? null;
if (!$id) die("ID no especificado");

// Obtener la categoría
try {
    $stmt = $pdo->prepare("SELECT * FROM categorias WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $categoria = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$categoria) die("Categoría no encontrada");
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}

// Actualizar
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre']);
    $descripcion = trim($_POST['descripcion']);

    if (empty($nombre)) $errores[] = "El nombre es obligatorio";

    if (empty($errores)) {
        try {
            $sql = "UPDATE categorias SET nombre=:nombre, descripcion=:descripcion WHERE id=:id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                'nombre' => $nombre,
                'descripcion' => $descripcion,
                'id' => $id
            ]);
            header("Location: list.php");
            exit;
        } catch (PDOException $e) {
            $errores[] = "Error al actualizar la categoría: " . $e->getMessage();
        }
    }
}
?>

<h2>Editar Categoría</h2>
<?php foreach ($errores as $e) echo "<p style='color:red;'>$e</p>"; ?>
<form method="POST">
    <input type="text" name="nombre" value="<?= htmlspecialchars($categoria['nombre']) ?>" required>
    <textarea name="descripcion" rows="4"><?= htmlspecialchars($categoria['descripcion']) ?></textarea>
    <button type="submit">Actualizar</button>
</form>
<a href="list.php">← Volver a la lista</a>
