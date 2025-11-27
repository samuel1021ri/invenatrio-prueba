<?php
include "../config/conexion.php";
$id = $_GET['id'];

// Obtener el producto
$stmt = $pdo->prepare("SELECT * FROM productos WHERE id = :id");
$stmt->execute(['id' => $id]);
$p = $stmt->fetch();

// Obtener todas las categorías
$stmtCat = $pdo->query("SELECT * FROM categorias ORDER BY nombre");
$categorias = $stmtCat->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        form {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            padding: 40px;
            width: 100%;
            max-width: 500px;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        h2 {
            text-align: center;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 10px;
        }

        input[type="text"],
        input[type="number"],
        select {
            padding: 15px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 1em;
            transition: all 0.3s ease;
            font-family: inherit;
        }

        input[type="text"]:focus,
        input[type="number"]:focus,
        select:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        input[type="text"]:hover,
        input[type="number"]:hover,
        select:hover {
            border-color: #667eea;
        }

        select {
            cursor: pointer;
            background-color: white;
        }

        button {
            padding: 15px;
            border: none;
            border-radius: 10px;
            font-size: 1em;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: inherit;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }

        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.6);
        }

        button:active {
            transform: translateY(0);
        }

        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

      

        .btn-volver {
            display: inline-block;
            color: white;
            text-decoration: none;
            font-size: 0.9em;
            margin-bottom: 10px;
            transition: all 0.3s ease;
            text-align: center;
        }

        .btn-volver:hover {
            transform: translateX(-3px);
        }

        .btn-volver::before {
            content: "← ";
        }
    </style>
</head>
<body>
    <form action="update.php" method="POST">
        <a href="list.php" class="btn-volver">Volver a la lista</a>
        <h2>Editar Producto</h2>
        
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($p["id"]); ?>">
        <input type="text" name="nombre" value="<?php echo htmlspecialchars($p["nombre"]); ?>" placeholder="Nombre del producto" required>
        <input type="number" name="precio" value="<?php echo htmlspecialchars($p["precio"]); ?>" step="0.01" placeholder="Precio" required>
        
        <select name="categoria_id" required>
            <option value="">Seleccionar categoría</option>
            <?php foreach($categorias as $cat): ?>
                <option value="<?php echo $cat['id']; ?>" <?php echo ($p['categoria_id'] == $cat['id']) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($cat['nombre']); ?>
                </option>
            <?php endforeach; ?>
        </select>
        
        <button type="submit">Actualizar</button>
    </form>
</body>
</html>
```

