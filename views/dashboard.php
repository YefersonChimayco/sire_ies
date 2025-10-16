<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Simulación de login (quitar si ya tienes sesión real)
if (!isset($_SESSION['username'])) {
    $_SESSION['username'] = "AdminDemo";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Control - SIRE IESHUANTA</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f6f9;
        }
        .header {
            background: #1a237e;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 25px;
        }
        .header .logo {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .header .logo img {
            height: 40px;
        }
        .user-nav {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        .user-name {
            font-weight: bold;
        }
        .logout-btn {
            background: #e53935;
            color: white;
            text-decoration: none;
            padding: 8px 14px;
            border-radius: 6px;
            transition: 0.3s;
        }
        .logout-btn:hover {
            background: #b71c1c;
        }
        .dashboard-container {
            padding: 25px;
        }
        .dashboard-title {
            margin-bottom: 20px;
            color: #333;
        }
        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
        }
        .dashboard-card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            text-decoration: none;
            color: #333;
            box-shadow: 0px 2px 6px rgba(0,0,0,0.1);
            transition: 0.3s;
        }
        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0px 4px 12px rgba(0,0,0,0.2);
        }
        .card-icon {
            font-size: 2em;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="logo">
            <img src="assets/logo.png" alt="Logo" class="logo-img">
            <h1>SIRE IESHUANTA</h1>
        </div>
        <?php if (isset($_SESSION['username'])): ?>
            <nav class="user-nav">
                <span class="user-name">👤 <?php echo htmlspecialchars($_SESSION['username']); ?></span>
                <a href="index.php?controller=auth&action=logout" class="logout-btn">🚪 Salir</a>
            </nav>
        <?php endif; ?>
    </header>

    <main class="dashboard-container">
        <h2 class="dashboard-title">Panel de Control</h2>
        <div class="dashboard-grid">
            <a href="index.php?controller=estudiante&action=gestion" class="dashboard-card">
                <div class="card-icon">📋</div>
                <h3>Estudiantes</h3>
                <p>Gestión completa de estudiantes registrados</p>
            </a>

            <a href="index.php?controller=semestre&action=gestion" class="dashboard-card">
                <div class="card-icon">📅</div>
                <h3>Semestres</h3>
                <p>Administrar semestres académicos</p>
            </a>

            <a href="index.php?controller=programa&action=gestion" class="dashboard-card">
                <div class="card-icon">📖</div>
                <h3>Programas de Estudio</h3>
                <p>Organizar los programas y carreras</p>
            </a>

            <a href="index.php?controller=auth&action=gestion" class="dashboard-card">
                <div class="card-icon">👤</div>
                <h3>Usuarios</h3>
                <p>Administrar usuarios del sistema</p>
            </a>
           <a href="index.php?controller=api&action=test" class="dashboard-card">
    <div class="card-icon">🔍</div>
    <h3>API Estudiantes</h3>
    <p>Probar API de búsqueda de estudiantes</p>
</a>

<a href="index.php?controller=auth&action=gestion" class="dashboard-card">
    <div class="card-icon">shm_detach</div>
    <h3>Usuarios</h3>
    <p>Administrar usuarios del sistema</p>
</a>

            <a href="index.php?controller=token&action=gestion" class="dashboard-card">
                <div class="card-icon">🔑</div>
                <h3>Tokens</h3>
                <p>Gestión de tokens</p>
            </a>

            <a href="index.php?controller=cliente&action=gestion" class="dashboard-card">
                <div class="card-icon">🏢</div>
                <h3>Clientes</h3>
                <p>Gestión de clientes</p>
            </a>
        </div>
    </main>
</body>
</html>
