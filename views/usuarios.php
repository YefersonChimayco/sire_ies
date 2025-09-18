<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIRE IESHUANTA - Gestión de Usuarios</title>
    <link rel="stylesheet" href="/sire_ies/css/styles.css">
</head>
<body>
    <?php include __DIR__ . '/../header.php'; ?>

    <main class="dashboard-container">
        <h2>Gestión de Usuarios</h2>
        <a href="index.php?controller=auth&action=dashboard" class="back-btn">Regresar al Inicio</a>

        <h3>Lista de Usuarios</h3>
        <table class="student-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Usuario</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($usuarios)): ?>
                    <?php foreach ($usuarios as $usuario): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($usuario['id']); ?></td>
                            <td><?php echo htmlspecialchars($usuario['username']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="2">No hay usuarios registrados</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </main>

    <?php include __DIR__ . '/../footer.php'; ?>
</body>
</html>
