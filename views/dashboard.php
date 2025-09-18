<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIRE IESHUANTA - Dashboard</title>
    <link rel="stylesheet" href="/sire_ies/css/styles.css">
</head>
<body>
    <?php include __DIR__ . '/header.php'; ?>

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

            <!-- Nueva tarjeta para Usuarios -->
            <a href="index.php?controller=user&action=gestion" class="dashboard-card">
                <div class="card-icon">👤</div>
                <h3>Usuarios</h3>
                <p>Administrar usuarios del sistema</p>
            </a>
        </div>
    </main>

    <?php include __DIR__ . '/footer.php'; ?>
</body>
</html>
