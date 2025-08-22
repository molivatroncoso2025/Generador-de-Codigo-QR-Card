<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generador de QR vCard</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; margin: 0; padding: 0; }
        .container { max-width: 900px; margin: 40px auto; background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
        .flex-container { display: flex; flex-direction: row; gap: 40px; align-items: flex-start; justify-content: center; }
        .form-section { flex: 1; min-width: 300px; }
        h2 { text-align: center; }
        label { display: block; margin-top: 15px; }
        input, textarea { width: 100%; padding: 8px; margin-top: 5px; border-radius: 4px; border: 1px solid #ccc; }
        button { margin-top: 20px; width: 100%; padding: 10px; background: #0078d7; color: #fff; border: none; border-radius: 4px; font-size: 16px; cursor: pointer; }
        button:hover { background: #005fa3; }
        .qr-result { flex: 1; min-width: 250px; text-align: center; margin-top: 0; }
        .qr-result img { max-width: 100%; height: auto; }
    </style>
</head>
<body>
    <div class="container flex-container">
        <div class="form-section">
        <h2>Generador de Código QR vCard</h2>
        <form action="generar_qr.php" method="POST">
            <label>Nombre:</label>
            <input type="text" name="nombre" required>
            <label>Apellido:</label>
            <input type="text" name="apellido" required>
            <label>Empresa:</label>
            <input type="text" name="empresa">
            <label>Cargo:</label>
            <input type="text" name="cargo">
            <label>Teléfono móvil:</label>
            <input type="text" name="telefono">
            <label>Correo electrónico:</label>
            <input type="email" name="email">
            <label>Dirección:</label>
            <textarea name="direccion"></textarea>
            <label>Página web:</label>
            <input type="url" name="web">
            <button type="submit">Generar QR</button>
        </form>
        </div>
        <div class="qr-result">
            <?php if (isset($_GET['qr'])): ?>
                <h3>Tu código QR:</h3>
                <img src="<?php echo htmlspecialchars($_GET['qr']); ?>" alt="QR vCard">
                <br><a href="<?php echo htmlspecialchars($_GET['qr']); ?>" download="vcard_qr.png">Descargar QR</a>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
