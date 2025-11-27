<?php
include "../config/conexion.php";
$stmt = $pdo->query("SELECT * FROM productos");
$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
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
            padding: 40px 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            padding: 40px;
        }

        h1 {
            color: #333;
            margin-bottom: 30px;
            font-size: 2.5em;
            text-align: center;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .btn-nuevo {
            display: inline-block;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 25px;
            font-weight: 600;
            margin-bottom: 30px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }

        .btn-nuevo:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.6);
        }

        ul {
            list-style: none;
        }

        li {
            background: #f8f9fa;
            margin-bottom: 15px;
            padding: 20px;
            border-radius: 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: all 0.3s ease;
            border-left: 4px solid #667eea;
        }

        li:hover {
            transform: translateX(5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .producto-info {
            flex: 1;
            font-size: 1.1em;
            color: #333;
        }

        .producto-nombre {
            font-weight: 600;
            color: #667eea;
        }

        .producto-precio {
            color: #28a745;
            font-weight: 700;
            margin-left: 10px;
        }

        .acciones {
            display: flex;
            gap: 10px;
        }

        .btn {
            padding: 8px 20px;
            text-decoration: none;
            border-radius: 20px;
            font-size: 0.9em;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-editar {
            background: #ffc107;
            color: #333;
        }

        .btn-editar:hover {
            background: #ffb300;
            transform: scale(1.05);
        }

        .btn-eliminar {
            background: #dc3545;
            color: white;
        }

        .btn-eliminar:hover {
            background: #c82333;
            transform: scale(1.05);
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #999;
        }

        .empty-state svg {
            width: 100px;
            height: 100px;
            margin-bottom: 20px;
            opacity: 0.5;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Productos</h1>
        <a href="create.php" class="btn-nuevo">+ Nuevo Producto</a>
        
        <?php if(count($productos) > 0): ?>
            <ul>
            <?php foreach($productos as $p): ?>
            <li>
                <div class="producto-info">
                    <span class="producto-nombre"><?php echo htmlspecialchars($p["nombre"]); ?></span>
                    <span class="producto-precio">$<?php echo number_format($p["precio"], 2); ?></span>
                </div>
                <div class="acciones">
                    <a href="edit.php?id=<?php echo $p["id"]; ?>" class="btn btn-editar">Editar</a>
                    <a href="delete.php?id=<?php echo $p["id"]; ?>" class="btn btn-eliminar" onclick="return confirm('¿Estás seguro de eliminar este producto?')">Eliminar</a>
                </div>
            </li>
            <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <div class="empty-state">
                <p>No hay productos disponibles</p>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>