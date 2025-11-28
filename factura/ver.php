<?php
include "../config/conexion.php";

$id_factura = $_GET['id'] ?? null;
if (!$id_factura) die("Factura no encontrada.");

// Obtener datos de la factura (cliente)
$f = $pdo->prepare("
    SELECT f.id, f.fecha, f.total, c.nombre AS cliente
    FROM factura f
    JOIN clientes c ON c.id = f.cliente_id
    WHERE f.id = ?
");
$f->execute([$id_factura]);
$factura = $f->fetch(PDO::FETCH_ASSOC);

if (!$factura) {
    die("Factura no encontrada en BD.");
}


$det = $pdo->prepare("
    SELECT d.cantidad, d.subtotal, 
           p.nombre AS producto, 
           p.precio AS precio_unitario
    FROM detalle_factura d
    JOIN productos p ON p.id = d.producto_id
    WHERE d.factura_id = ?
");
$det->execute([$id_factura]);
$detalles = $det->fetchAll(PDO::FETCH_ASSOC);


$total_calculado = 0;
foreach ($detalles as $row) {
    $total_calculado += (float)$row['subtotal'];
}


$valor_en_factura = (float)$factura['total'];
$mostrar_total = $total_calculado; 

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Factura #<?= htmlspecialchars($factura['id']) ?></title>
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
    max-width: 700px;
    padding: 50px 40px;
    background: white;
    border-radius: 25px;
    box-shadow: 0 25px 70px rgba(0, 0, 0, 0.3);
}

h2 {
    color: #667eea;
    text-align: center;
    margin: 0 0 25px 0;
    font-size: 32px;
    font-weight: 700;
}

p {
    color: #333;
    font-size: 17px;
    margin: 10px 0;
    padding: 12px 20px;
    background: #f8f9ff;
    border-radius: 10px;
    border-left: 4px solid #667eea;
}

table {
    width: 100%;
    margin-top: 30px;
    border-collapse: collapse;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
}

thead {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

th {
    color: white;
    padding: 18px;
    text-align: left;
    font-size: 16px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

td {
    padding: 16px 18px;
    color: #333;
    font-size: 16px;
    border-bottom: 1px solid #e0e7ff;
}

tbody tr {
    transition: all 0.3s ease;
}

tbody tr:hover {
    background: #f8f9ff;
    transform: scale(1.01);
}

tbody tr:last-child td {
    border-bottom: none;
}

tbody tr td:last-child {
    font-weight: 700;
    color: #667eea;
}
    </style>
</head>
<body>
    <div>

<h2>Factura #<?= htmlspecialchars($factura['id']) ?></h2>
<p>Cliente: <?= htmlspecialchars($factura['cliente']) ?></p>
<p>Fecha: <?= htmlspecialchars($factura['fecha']) ?></p>

<table>
    <thead>
        <tr>
            <th>Producto</th>
            <th>Precio unitario</th>
            <th>Cantidad</th>
            <th>Subtotal</th>
        </tr>
    </thead>
    <tbody>
        <?php if (count($detalles) === 0): ?>
            <tr><td colspan="4">No hay productos agregados.</td></tr>
        <?php else: ?>
            <?php foreach ($detalles as $d): ?>
            <tr>
                <td><?= htmlspecialchars($d['producto']) ?></td>
                <td>$<?= number_format($d['precio_unitario'], 2) ?></td>
                <td><?= (int)$d['cantidad'] ?></td>
                <td>$<?= number_format($d['subtotal'], 2) ?></td>
            </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="3" style="text-align:right">Total (calculado):</td>
            <td>$<?= number_format($mostrar_total, 2) ?></td>
        </tr>
        <tr>
            <td colspan="3" style="text-align:right">Total guardado en factura (BD):</td>
            <td>$<?= number_format($valor_en_factura, 2) ?></td>
        </tr>
    </tfoot>
</table>


<?php if ($valor_en_factura != $total_calculado): ?>
    <p class="note">Nota: el total almacenado en la tabla <code>factura.total</code> difiere del total calculado desde los detalles. Si quieres, puedo darte el SQL para sincronizarlos.</p>
<?php endif; ?>
</div>
</body>
</html>
