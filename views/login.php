<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIRE IESHUANTA - Iniciar Sesión</title>
    <link rel="stylesheet" href="./css/styles.css">
    <script defer src="./js/login.js"></script>
</head>
<body>
    <main class="login-container">
        <div class="login-card">
            <!-- LOGO -->
            <div class="logo">
                <img src="assets/logo.png" alt="Logo Sistema">
            </div>

            <!-- NOMBRE DEL SISTEMA -->
            <h2 class="system-name">SIRE IESHUANTA</h2>
            <p class="system-subtitle">Sistema de Gestión de Estudiantes</p>

            <!-- MENSAJE DE ERROR -->
            <?php if (!empty($error)): ?>
                <p class="error"><?php echo htmlspecialchars($error); ?></p>
            <?php endif; ?>

            <!-- FORMULARIO -->
            <form method="POST" action="index.php?controller=auth&action=login">
                <div class="form-group">
                    <label for="username">Usuario</label>
                    <div class="input-container">
                        <span class="icon">👤</span>
                        <input type="text" id="username" name="username" placeholder="Ingresa tu usuario" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <div class="input-container">
                        <span class="icon">🔒</span>
                        <input type="password" id="password" name="password" placeholder="********" required>
                        <button type="button" class="toggle-password" onclick="togglePassword()">👁</button>
                    </div>
                </div>

                <button type="submit" class="login-btn">Iniciar Sesión</button>
            </form>

            <p class="register-link">
                ¿No tienes cuenta? <a href="index.php?controller=auth&action=register">Regístrate aquí</a>
            </p>
        </div>
    </main>
</body>
</html>
