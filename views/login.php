<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIRE IESHUANTA - Iniciar Sesión</title>
    <link rel="stylesheet" href="/sire_ies/css/styles.css">
</head>
<body>
    <main class="login-container">
        <h2>Iniciar Sesión</h2>
        <?php if (isset($error)): ?>
            <p class="error"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>
        <form method="POST" action="index.php?controller=auth&action=login">
            <div class="form-group">
                <label for="username">Usuario</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="login-btn">Iniciar Sesión</button>
        </form>
    </main>
</body>
</html>