<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Clientes</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 20px;
            background: #f4f7fb;
            color: #333;
        }
        h2 {
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
            width: 450px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        form label {
            display: block;
            margin-top: 12px;
            font-weight: 600;
        }
        form input[type="text"], 
        form input[type="email"], 
        form input[type="date"], 
        form select {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-sizing: border-box;
            transition: border 0.3s;
        }
        form input:focus, form select:focus {
            border: 1px solid #007BFF;
            outline: none;
        }
        form button {
            margin-top: 15px;
            padding: 10px 18px;
            cursor: pointer;
            background: #007BFF;
            color: white;
            border: none;
            border-radius: 6px;
            transition: background 0.3s;
            width: 100%;
            font-weight: bold;
        }
        form button:hover {
            background: #0056b3;
        }
        .btn {
            padding: 8px 15px;
            cursor: pointer;
            background: #007BFF;
            color: white;
            border: none;
            border-radius: 6px;
            text-decoration: none;
            display: inline-block;
            transition: background 0.3s;
        }
        .btn:hover { background: #0056b3; }
        .btn-danger { background: #dc3545; }
        .btn-danger:hover { background: #a71d2a; }
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

    <h2>Gestión de Clientes</h2>

    <!-- Botón regresar -->
    <div style="text-align:center;">
        <a class="btn btn-dashboard" href="index.php?controller=auth&action=dashboard">⬅ Regresar al Dashboard</a>
    </div>

    <!-- Mensaje -->
    <?php if (!empty($message)): ?>
        <p class="message"><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>

    <!-- Formulario -->
    <form method="POST">
        <label>RUC:</label>
        <input type="text" name="ruc" required>

        <label>Razón Social:</label>
        <input type="text" name="razon_social" required>

        <label>Teléfono:</label>
        <input type="text" name="telefono">

        <label>Correo:</label>
        <input type="email" name="correo">

        <label>Fecha Registro:</label>
        <input type="date" name="fecha_registro" value="<?= date('Y-m-d'); ?>">

        <label>Estado:</label>
        <select name="estado">
            <option value="1">Activo</option>
            <option value="0">Inactivo</option>
        </select>

        <button type="submit">💾 Guardar Cliente</button>
    </form>

    <!-- Tabla -->
    <h3>Listado de Clientes</h3>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>RUC</th>
                <th>Razón Social</th>
                <th>Teléfono</th>
                <th>Correo</th>
                <th>Fecha Registro</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php if (!empty($clientes)): ?>
            <?php foreach ($clientes as $cli): ?>
                <tr>
                    <td><?= htmlspecialchars($cli['id']) ?></td>
                    <td><?= htmlspecialchars($cli['ruc']) ?></td>
                    <td><?= htmlspecialchars($cli['razon_social']) ?></td>
                    <td><?= htmlspecialchars($cli['telefono']) ?></td>
                    <td><?= htmlspecialchars($cli['correo']) ?></td>
                    <td><?= htmlspecialchars($cli['fecha_registro']) ?></td>
                    <td><?= $cli['estado'] ? '✅ Activo' : '❌ Inactivo' ?></td>
                    <td>
                        <a class="btn" href="index.php?controller=cliente&action=updateCliente&id=<?= $cli['id'] ?>">✏ Editar</a>
                        <a class="btn btn-danger" href="index.php?controller=cliente&action=deleteCliente&id=<?= $cli['id'] ?>" onclick="return confirm('¿Seguro de eliminar este cliente?')">🗑 Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="8" style="text-align:center;">No hay clientes registrados.</td></tr>
        <?php endif; ?>
        </tbody>
    </table>

</body>
</html>
