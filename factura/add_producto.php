<?php
include "../config/conexion.php";

$id_factura = $_GET['id'] ?? null;
if (!$id_factura) die("Factura no encontrada.");

$factura = $pdo->prepare("
    SELECT f.id, c.nombre 
    FROM factura f 
    JOIN clientes c ON c.id = f.cliente_id
    WHERE f.id = ?
");
$factura->execute([$id_factura]);
$factura = $factura->fetch(PDO::FETCH_ASSOC);

$productos = $pdo->query("SELECT id, nombre, precio FROM productos")->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['finalizar'])) {
        header("Location: ver.php?id=$id_factura");
        exit;
    }

    $id_producto = $_POST['id_producto'];
    $cantidad = $_POST['cantidad'];

    $stmt = $pdo->prepare("SELECT precio FROM productos WHERE id = ?");
    $stmt->execute([$id_producto]);
    $precio = $stmt->fetchColumn();

    $subtotal = $precio * $cantidad;

    $stmt = $pdo->prepare("
        INSERT INTO detalle_factura (factura_id, producto_id, cantidad, subtotal)
        VALUES (:factura, :producto, :cantidad, :subtotal)
    ");
    $stmt->execute([
        'factura' => $id_factura,
        'producto' => $id_producto,
        'cantidad' => $cantidad,
        'subtotal' => $subtotal
    ]);

    $pdo->prepare("UPDATE factura SET total = total + :sub WHERE id = :idf")
        ->execute(['sub' => $subtotal, 'idf' => $id_factura]);

    header("Location: add_producto.php?id=$id_factura");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar productos</title>
</head>
<style>
  
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    min-height: 100vh;
    margin: 0;
    padding: 20px;
    display: flex;
    justify-content: center;
    align-items: center;
}


div {
    width: 100%;
    max-width: 500px;
    padding: 50px 40px;
    background: white;
    border-radius: 25px;
    box-shadow: 0 25px 70px rgba(0, 0, 0, 0.3);
}

form {
    width: 100%;
}

h2 {
    color: #667eea;
    text-align: center;
    margin: 0 0 35px 0;
    font-size: 24px;
    font-weight: 700;
    line-height: 1.4;
}

label {
    display: block;
    color: #333;
    font-size: 16px;
    font-weight: 600;
    margin-bottom: 8px;
}

select {
    width: 100%;
    padding: 18px 15px;
    font-size: 17px;
    border: 2px solid #e0e7ff;
    border-radius: 12px;
    background: #fafbff;
    color: #333;
    cursor: pointer;
    margin-bottom: 25px;
    transition: all 0.3s ease;
    font-family: inherit;
}

select:hover {
    border-color: #667eea;
    background: white;
}

select:focus {
    outline: none;
    border-color: #667eea;
    box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
    background: white;
}

option {
    padding: 12px;
}

input {
    width: 100%;
    padding: 18px 15px;
    font-size: 17px;
    border: 2px solid #e0e7ff;
    border-radius: 12px;
    background: #fafbff;
    color: #333;
    margin-bottom: 25px;
    transition: all 0.3s ease;
    font-family: inherit;
    box-sizing: border-box;
}

input:hover {
    border-color: #667eea;
    background: white;
}

input:focus {
    outline: none;
    border-color: #667eea;
    box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
    background: white;
}

button {
    width: 100%;
    padding: 18px;
    font-size: 18px;
    font-weight: 700;
    color: white;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border: none;
    border-radius: 12px;
    cursor: pointer;
    box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
    transition: all 0.3s ease;
    font-family: inherit;
    margin-bottom: 15px;
}

button:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 30px rgba(102, 126, 234, 0.5);
}

button:active {
    transform: translateY(-1px);
    box-shadow: 0 6px 15px rgba(102, 126, 234, 0.4);
}

button:last-child {
    margin-bottom: 0;
}

br {
    display: none;
}

</style>
<body>
<div>
<h2>Factura #<?= $factura['id'] ?> - Cliente: <?= $factura['nombre'] ?></h2>

<form method="POST">

    <label>Producto:</label>
    <select name="id_producto" required>
        <option value="">Seleccione...</option>
        <?php foreach ($productos as $p): ?>
            <option value="<?= $p['id'] ?>"><?= $p['nombre'] ?> - $<?= $p['precio'] ?></option>
        <?php endforeach; ?>
    </select>

    <br><br>

    <label>Cantidad:</label>
    <input type="number" name="cantidad" required min="1">

    <br><br>

  
    <button type="submit" name="agregar">Agregar producto</button>


    <button type="submit" name="finalizar">Finalizar factura</button>

</form>
</div>

</body>
</html>
