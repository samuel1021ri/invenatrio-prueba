<!-- create.php -->
<?php
include "../config/conexion.php";

$errores = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre']);
    $descripcion = trim($_POST['descripcion']);
    
    if (empty($nombre)) {
        $errores[] = "El nombre es obligatorio";
    }
    
    if (empty($errores)) {
        $sql = "INSERT INTO categorias (nombre, descripcion) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $nombre, $descripcion);
        
        if ($stmt->execute()) {
            header("Location: list.php");
            exit;
        } else {
            $errores[] = "Error al guardar la categoría";
        }
    }
}
?>

<h2>Agregar Categoría</h2>
<?php foreach ($errores as $e) echo "<p style='color:red;'>$e</p>"; ?>
<form method="POST">
    <input type="text" name="nombre" placeholder="Nombre de la categoría" required>
    <textarea name="descripcion" placeholder="Descripción" rows="4"></textarea>
    <button type="submit">Guardar</button>
</form>
<a href="list.php">← Volver a la lista</a>