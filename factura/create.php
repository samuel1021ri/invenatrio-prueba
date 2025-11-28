<?php
include "../config/conexion.php";
$clientes = $pdo->query("SELECT id, nombre FROM clientes")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Factura</title>
</head>
<style>

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    min-height: 100vh;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
}


div {
    width: 100%;
    max-width: 420px;
    padding: 50px 40px;
    background: white;
    border-radius: 25px;
    box-shadow: 0 25px 70px rgba(0, 0, 0, 0.3);
}


form {
    width: 100%;
}

h1 {
    color: #667eea;
    text-align: center;
    margin: 0 0 35px 0;
    font-size: 32px;
    font-weight: 700;
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
}

button:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 30px rgba(102, 126, 234, 0.5);
}

button:active {
    transform: translateY(-1px);
    box-shadow: 0 6px 15px rgba(102, 126, 234, 0.4);
}
    
</style>


<body>
<div>
<h2>Crear Factura</h2>

<form action="store.php" method="POST">
    <label>Cliente:</label>
    <select name="id_cliente" required>
        <option value="" disabled selected>Selecciona un cliente</option>
        <?php foreach ($clientes as $c): ?>
            <option value="<?= $c['id'] ?>"><?= $c['nombre'] ?></option>
        <?php endforeach; ?>
    </select>

    <button type="submit">Crear Factura</button>
</form>
</div>

</body>
</html>
