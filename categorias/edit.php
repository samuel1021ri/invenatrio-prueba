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
<style>
div {
    max-width: 500px;
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

p {
    color: #e74c3c;
    background: #fadbd8;
    padding: 12px;
    border-radius: 5px;
    margin-bottom: 15px;
    text-align: center;
    border-left: 4px solid #e74c3c;
}

form {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

input[type="text"] {
    padding: 12px 15px;
    border: 2px solid #ddd;
    border-radius: 5px;
    font-size: 16px;
    transition: border-color 0.3s;
    outline: none;
}

input[type="text"]:focus {
    border-color: #3498db;
}

textarea {
    padding: 12px 15px;
    border: 2px solid #ddd;
    border-radius: 5px;
    font-size: 16px;
    resize: vertical;
    font-family: Arial, sans-serif;
    transition: border-color 0.3s;
    outline: none;
}

textarea:focus {
    border-color: #3498db;
}

button[type="submit"] {
    padding: 12px 20px;
    background: #27ae60;
    color: white;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    font-weight: bold;
    cursor: pointer;
    transition: background 0.3s;
}

button[type="submit"]:hover {
    background: #229954;
}

a {
    display: block;
    text-align: center;
    margin-top: 20px;
    color: #7f8c8d;
    text-decoration: none;
    font-size: 14px;
    transition: color 0.3s;
}

a:hover {
    color: #3498db;
}
</style>
<div>
<h2>Editar Categoría</h2>
<?php foreach ($errores as $e) echo "<p style='color:red;'>$e</p>"; ?>
<form method="POST">
    <input type="text" name="nombre" value="<?= htmlspecialchars($categoria['nombre']) ?>" required>
    <textarea name="descripcion" rows="4"><?= htmlspecialchars($categoria['descripcion']) ?></textarea>
    <button type="submit">Actualizar</button>
</form>
<a href="list.php">← Volver a la lista</a>
</div>