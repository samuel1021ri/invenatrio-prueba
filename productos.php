<?php
$productos = [
    ["nombre" => "Teclado", "precio" => 50000],
    ["nombre" => "Mouse", "precio" => 30000]
];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Productos</title>
</head>
<body>
<h1>Lista de productos</h1>

<?php foreach($productos as $p): ?>
    <div>
        <h3><?php echo $p["nombre"]; ?></h3>
        <p>Precio: <?php echo $p["precio"]; ?></p>
    </div>
<?php endforeach; ?>

</body>
</html>

