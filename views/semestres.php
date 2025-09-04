<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIRE IESHUANTA - Gestión de Semestres</title>
    <link rel="stylesheet" href="/sire_ies/css/styles.css">
</head>
<body>
    <?php include __DIR__ . '/header.php'; ?>
    <main class="dashboard-container">
        <h2>Gestión de Semestres</h2>
        <a href="index.php?controller=auth&action=dashboard" class="back-btn">Regresar al Dashboard</a>
        <?php if (isset($message)): ?>
            <p class="message"><?php echo htmlspecialchars($message); ?></p>
        <?php endif; ?>
        <form method="POST" action="index.php?controller=semestre&action=gestion" class="form-container" id="create-form">
            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <input type="text" id="descripcion" name="descripcion" required>
            </div>
            <button type="submit" class="login-btn">Registrar Semestre</button>
        </form>
        <?php if (isset($semestre) && is_array($semestre)): ?>
            <form method="POST" action="index.php?controller=semestre&action=updateSemestre&id=<?php echo urlencode($semestre['id']); ?>" class="form-container" id="update-form" style="display: block;">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($semestre['id']); ?>">
                <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <input type="text" id="descripcion" name="descripcion" value="<?php echo htmlspecialchars($semestre['descripcion']); ?>" required>
                </div>
                <button type="submit" class="login-btn">Guardar Cambios</button>
            </form>
        <?php endif; ?>
        <h3>Lista de Semestres</h3>
        <table class="student-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Descripción</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($semestres as $semestre): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($semestre['id']); ?></td>
                        <td><?php echo htmlspecialchars($semestre['descripcion']); ?></td>
                        <td>
                            <a href="index.php?controller=semestre&action=updateSemestre&id=<?php echo urlencode($semestre['id']); ?>" class="action-btn edit">Actualizar</a>
                            <a href="index.php?controller=semestre&action=deleteSemestre&id=<?php echo urlencode($semestre['id']); ?>" class="action-btn delete" onclick="return confirm('¿Estás seguro de eliminar este semestre?');">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
    <?php include __DIR__ . '/footer.php'; ?>
</body>
</html>