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
        <h2>Panel de Control</h2>
        <div class="dashboard-links">
            <a href="index.php?controller=estudiante&action=gestion" class="dashboard-link">
                <i class="icon">📋</i> Estudiantes
            </a>
            <a href="index.php?controller=semestre&action=gestion" class="dashboard-link">
                <i class="icon">📅</i> Semestres
            </a>
            <a href="index.php?controller=programa&action=gestion" class="dashboard-link">
                <i class="icon">📖</i> Programas de Estudio
            </a>
        </div>
    </main>
    <?php include __DIR__ . '/footer.php'; ?>
</body>
</html>