<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario</title>
    <link rel="stylesheet" href="../styles/create.css">
</head>
<body>

<div class="form-container">
    <h2>Registrar Producto</h2>
    
    <form action="store.php" method="POST">
        <div class="form-control">
            <input type="text" name="nombre" placeholder="Nombre del producto" required>
        </div>
        <div class="form-control">
            <input type="number" step="0.01" name="precio" placeholder="Precio" required>
        </div>
        <button type="submit">Guardar</button>
    </form>
</div>

</body>
</html>
