<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Tokens</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 20px;
            background: #f4f7fb;
            color: #333;
        }
        h1 {
            color: #007BFF;
            text-align: center;
            margin-bottom: 25px;
        }
        form {
            margin: 0 auto 30px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            background: #fff;
            width: 420px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        form h3 {
            margin-bottom: 15px;
            color: #444;
        }
        label {
            display: block;
            margin-top: 12px;
            font-weight: 600;
        }
        input[type="text"], input[type="date"], input[type="number"], select {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-sizing: border-box;
            transition: border 0.3s;
        }
        input[type="submit"], .btn {
            margin-top: 15px;
            padding: 10px 18px;
            cursor: pointer;
            background: #007BFF;
            color: white;
            border: none;
            border-radius: 6px;
            transition: background 0.3s;
            text-decoration: none;
            display: inline-block;
        }
        input[type="submit"]:hover, .btn:hover {
            background: #0056b3;
        }
        .btn-danger {
            background: #dc3545;
        }
        .btn-danger:hover {
            background: #a71d2a;
        }
        .btn-dashboard {
            background: #28a745;
            margin-bottom: 20px;
        }
        .btn-dashboard:hover {
            background: #1e7e34;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        table th {
            background: #007BFF;
            color: white;
            padding: 12px;
            text-align: left;
        }
        table td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }
        table tr:nth-child(even) {
            background: #f9f9f9;
        }
        .message {
            color: green;
            font-weight: bold;
            margin-bottom: 15px;
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Gestión de Tokens</h1>

    <div style="text-align:center;">
        <a class="btn btn-dashboard" href="index.php?controller=auth&action=dashboard">⬅ Regresar al Dashboard</a>
    </div>

    <?php if (!empty($message)): ?>
        <p class="message"><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>

    <!-- Formulario para registrar/editar token -->
    <form method="POST" action="">
        <h3>Registrar Token</h3>

     <label for="id_client_api">Cliente API:</label>
<select name="id_client_api" id="id_client_api" required>
    <option value="">-- Selecciona un cliente --</option>
    <?php foreach ($clientes as $c): ?>
        <option value="<?= $c['id'] ?>">
            <?= htmlspecialchars($c['id'] . " - " . $c['razon_social']) ?>
        </option>
    <?php endforeach; ?>
</select>


        <label for="token">Token:</label>
        <input type="text" name="token" id="token" required>

        <label for="fecha_reg">Fecha Registro:</label>
        <input type="date" name="fecha_reg" id="fecha_reg" value="<?= date('Y-m-d') ?>" required>

        <label for="estado">Estado:</label>
        <select name="estado" id="estado">
            <option value="1">Activo</option>
            <option value="0">Inactivo</option>
        </select>

        <input type="submit" value="Guardar Token">
    </form>

    <!-- Tabla de tokens -->
    <h3>Listado de Tokens</h3>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>ID Cliente API</th>
                <th>Token</th>
                <th>Fecha Registro</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php if (!empty($tokens)): ?>
            <?php foreach ($tokens as $t): ?>
                <tr>
                    <td><?= htmlspecialchars($t['id']) ?></td>
                    <td><?= htmlspecialchars($t['id_client_api']) ?></td>
                    <td><?= htmlspecialchars($t['token']) ?></td>
                    <td><?= htmlspecialchars($t['fecha_reg']) ?></td>
                    <td><?= $t['estado'] ? '✅ Activo' : '❌ Inactivo' ?></td>
                    <td>
                        <a class="btn" href="index.php?controller=token&action=updateToken&id=<?= $t['id'] ?>">✏ Editar</a>
                        <a class="btn btn-danger" href="index.php?controller=token&action=deleteToken&id=<?= $t['id'] ?>" onclick="return confirm('¿Seguro que deseas eliminar este token?')">🗑 Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="6" style="text-align:center;">No hay tokens registrados.</td></tr>
        <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
