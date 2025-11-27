
<?php
include "../config/conexion.php";

$errores = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre']);
    $email = trim($_POST['email']);
    $telefono = trim($_POST['telefono']);
    $direccion = trim($_POST['direccion']);

    // Validaciones básicas
    if (!$nombre) $errores[] = "El nombre es obligatorio.";
    if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errores[] = "Email inválido.";

    // Email único
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM clientes WHERE email = :email");
    $stmt->execute(['email' => $email]);
    if ($stmt->fetchColumn() > 0) $errores[] = "El correo ya está registrado.";

    if (empty($errores)) {
        $stmt = $pdo->prepare("INSERT INTO clientes (nombre, email, telefono, direccion) VALUES (:nombre, :email, :telefono, :direccion)");
        $stmt->execute(compact('nombre','email','telefono','direccion'));
        header("Location: list.php");
        exit;
    }
}
?>
<style>
    body {
    font-family: Arial, sans-serif;
    background: #f5f5f5;
    margin: 0;
    padding: 20px;
}

h2 {
    color: #2c3e50;
    text-align: center;
    margin-bottom: 30px;
}

p {
    color: #e74c3c;
    background: #fadbd8;
    padding: 12px;
    border-radius: 5px;
    margin: 10px auto;
    font-size: 14px;
    max-width: 500px;
}

form {
    max-width: 500px;
    margin: 0 auto;
    padding: 30px;
    background: #f8f9fa;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

input {
    width: 100%;
    padding: 12px;
    margin-bottom: 15px;
    border: 2px solid #ddd;
    border-radius: 5px;
    font-size: 14px;
    box-sizing: border-box;
    transition: border-color 0.3s;
}

input:focus {
    outline: none;
    border-color: #3498db;
}

button {
    width: 100%;
    padding: 14px;
    background: #3498db;
    color: white;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    font-weight: bold;
    cursor: pointer;
    transition: background 0.3s;
}

button:hover {
    background: #2980b9;
}

a {
    display: block;
    text-align: center;
    margin-top: 20px;
    color: #3498db;
    text-decoration: none;
    font-size: 14px;
}

a:hover {
    text-decoration: underline;
}
</style>
<h2>Agregar Cliente</h2>
<?php foreach ($errores as $e) echo "<p style='color:red;'>$e</p>"; ?>
<form method="POST">
    <input type="text" name="nombre" placeholder="Nombre" required>
    <input type="email" name="email" placeholder="Correo" required>
    <input type="text" name="telefono" placeholder="Teléfono">
    <input type="text" name="direccion" placeholder="Dirección">
    <button type="submit">Guardar</button>
</form>
<a href="list.php">← Volver a la lista</a>
