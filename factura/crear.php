<style>
    /* Estilos para el formulario */
form {
    max-width: 400px;
    margin: 50px auto;
    padding: 40px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 20px;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
}

h1 {
    color: white;
    text-align: center;
    margin: 0 0 30px 0;
    font-size: 28px;
    font-weight: 600;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
}

select {
    width: 100%;
    padding: 15px;
    font-size: 16px;
    border: none;
    border-radius: 10px;
    background: white;
    color: #333;
    cursor: pointer;
    margin-bottom: 20px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
}

select:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
}

select:focus {
    outline: none;
    box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.3);
}

option {
    padding: 10px;
}

button {
    width: 100%;
    padding: 15px;
    font-size: 18px;
    font-weight: 600;
    color: #667eea;
    background: white;
    border: none;
    border-radius: 10px;
    cursor: pointer;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
}

button:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 25px rgba(0, 0, 0, 0.2);
    background: #f8f9ff;
}

button:active {
    transform: translateY(0);
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

/* Estilos generales del body */
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: linear-gradient(to bottom right, #e0e7ff, #fce7f3);
    min-height: 100vh;
    margin: 0;
    padding: 20px;
}
</style>
<form action="store.php" method="POST">
    <select name="id_cliente">
        <option value="1">Pepito</option>
        <option value="2">Juan</option>
    </select>
    <button type="submit">Crear factura</button>
</form>
