<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIRE IESHUANTA - Gestión de Programas</title>
    <link rel="stylesheet" href="/sire_ies/css/styles.css">
</head>
<body>
    <?php include __DIR__ . '/header.php'; ?>
    <main class="dashboard-container">
        <h2>Gestión de Programas</h2>
        <a href="index.php?controller=auth&action=dashboard" class="back-btn">Regresar al Dashboard</a>
        <?php if (isset($message)): ?>
            <p class="message"><?php echo htmlspecialchars($message); ?></p>
        <?php endif; ?>
        <form method="POST" action="index.php?controller=programa&action=gestion" class="form-container" id="create-form">
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" required>
            </div>
            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea id="descripcion" name="descripcion"></textarea>
            </div>
            <button type="submit" class="login-btn">Registrar Programa</button>
        </form>
        <?php if (isset($programa) && is_array($programa)): ?>
            <form method="POST" action="index.php?controller=programa&action=updatePrograma&id=<?php echo urlencode($programa['id']); ?>" class="form-container" id="update-form" style="display: block;">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($programa['id']); ?>">
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($programa['nombre']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <textarea id="descripcion" name="descripcion"><?php echo htmlspecialchars($programa['descripcion'] ?? ''); ?></textarea>
                </div>
                <button type="submit" class="login-btn">Guardar Cambios</button>
            </form>
        <?php endif; ?>
        <h3>Lista de Programas</h3>
        <table class="student-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($programas as $programa): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($programa['id']); ?></td>
                        <td><?php echo htmlspecialchars($programa['nombre']); ?></td>
                        <td><?php echo htmlspecialchars($programa['descripcion'] ?? 'N/A'); ?></td>
                        <td>
                            <a href="index.php?controller=programa&action=updatePrograma&id=<?php echo urlencode($programa['id']); ?>" class="action-btn edit">Actualizar</a>
                            <a href="index.php?controller=programa&action=deletePrograma&id=<?php echo urlencode($programa['id']); ?>" class="action-btn delete" onclick="return confirm('¿Estás seguro de eliminar este programa?');">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
    <?php include __DIR__ . '/footer.php'; ?>
</body>
</html>