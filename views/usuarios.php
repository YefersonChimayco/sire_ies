<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIRE IESHUANTA - Usuarios</title>
    <link rel="stylesheet" href="/sire_ies/css/styles.css">
</head>
<body>
    <?php include __DIR__ . '/header.php'; ?>

    <main class="dashboard-container">
        <h2>Gestión de Usuarios</h2>
        <a href="index.php?controller=auth&action=dashboard" class="back-btn">Regresar al Inicio</a>

        <table class="student-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Usuario</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $usuario): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($usuario['id']); ?></td>
                        <td><?php echo htmlspecialchars($usuario['username']); ?></td>
                        <td>
                            <a href="index.php?controller=auth&action=deleteUser&uid=<?php echo urlencode($usuario['id']); ?>" 
                               class="action-btn delete" 
                               onclick="return confirm('¿Seguro que quieres eliminar este usuario?');">
                                Eliminar
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>

    <?php include __DIR__ . '/footer.php'; ?>
</body>
</html>
