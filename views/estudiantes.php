<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIRE IESHUANTA - Gestión de Estudiantes</title>
    <link rel="stylesheet" href="/sire_ies/css/styles.css">
</head>
<body>
    <?php include __DIR__ . '/header.php'; ?>
    <main class="dashboard-container">
        <h2>Gestión de Estudiantes</h2>
        <a href="index.php?controller=auth&action=dashboard" class="back-btn">Regresar al Dashboard</a>
        <?php if (isset($message)): ?>
            <p class="message"><?php echo htmlspecialchars($message); ?></p>
        <?php endif; ?>
        <form method="POST" action="index.php?controller=estudiante&action=gestion" class="form-container" id="create-form">
            <div class="form-group">
                <label for="dni">DNI</label>
                <input type="text" id="dni" name="dni" required maxlength="8">
            </div>
            <div class="form-group">
                <label for="nombres">Nombres</label>
                <input type="text" id="nombres" name="nombres" required>
            </div>
            <div class="form-group">
                <label for="apellido_paterno">Apellido Paterno</label>
                <input type="text" id="apellido_paterno" name="apellido_paterno" required>
            </div>
            <div class="form-group">
                <label for="apellido_materno">Apellido Materno</label>
                <input type="text" id="apellido_materno" name="apellido_materno" required>
            </div>
            <div class="form-group">
                <label for="estado">Estado</label>
                <select id="estado" name="estado">
                    <option value="activo">Activo</option>
                    <option value="inactivo">Inactivo</option>
                    <option value="graduado">Graduado</option>
                    <option value="suspendido">Suspendido</option>
                </select>
            </div>
            <div class="form-group">
                <label for="semestre">Semestre</label>
                <select id="semestre" name="semestre" required>
                    <?php
                    $semestres = [1 => 'Primer Semestre', 2 => 'Segundo Semestre', 3 => 'Tercer Semestre',
                                  4 => 'Cuarto Semestre', 5 => 'Quinto Semestre', 6 => 'Sexto Semestre',
                                  7 => 'Séptimo Semestre', 8 => 'Octavo Semestre', 9 => 'Noveno Semestre',
                                  10 => 'Décimo Semestre', 11 => 'Undécimo Semestre', 12 => 'Duodécimo Semestre'];
                    foreach ($semestres as $id => $desc) {
                        echo "<option value='$id'>$desc</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="programa_id">Programa</label>
                <select id="programa_id" name="programa_id" required>
                    <?php
                    $programas = [1 => 'Diseño y Programación Web', 2 => 'Enfermería Técnica',
                                  3 => 'Mecánica Automotriz', 4 => 'Producción Agropecuaria',
                                  5 => 'Industrias de Alimentos y Bebidas'];
                    foreach ($programas as $id => $nombre) {
                        echo "<option value='$id'>$nombre</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="fecha_matricula">Fecha de Matrícula</label>
                <input type="date" id="fecha_matricula" name="fecha_matricula">
            </div>
            <button type="submit" class="login-btn">Registrar Estudiante</button>
        </form>
        <?php if (isset($estudiante) && is_array($estudiante)): ?>
            <form method="POST" action="index.php?controller=estudiante&action=updateEstudiante&dni=<?php echo urlencode($estudiante['dni']); ?>" class="form-container" id="update-form" style="display: block;">
                <input type="hidden" name="dni" value="<?php echo htmlspecialchars($estudiante['dni']); ?>">
                <div class="form-group">
                    <label for="nombres">Nombres</label>
                    <input type="text" id="nombres" name="nombres" value="<?php echo htmlspecialchars($estudiante['nombres']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="apellido_paterno">Apellido Paterno</label>
                    <input type="text" id="apellido_paterno" name="apellido_paterno" value="<?php echo htmlspecialchars($estudiante['apellido_paterno']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="apellido_materno">Apellido Materno</label>
                    <input type="text" id="apellido_materno" name="apellido_materno" value="<?php echo htmlspecialchars($estudiante['apellido_materno']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="estado">Estado</label>
                    <select id="estado" name="estado">
                        <option value="activo" <?php echo $estudiante['estado'] === 'activo' ? 'selected' : ''; ?>>Activo</option>
                        <option value="inactivo" <?php echo $estudiante['estado'] === 'inactivo' ? 'selected' : ''; ?>>Inactivo</option>
                        <option value="graduado" <?php echo $estudiante['estado'] === 'graduado' ? 'selected' : ''; ?>>Graduado</option>
                        <option value="suspendido" <?php echo $estudiante['estado'] === 'suspendido' ? 'selected' : ''; ?>>Suspendido</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="semestre">Semestre</label>
                    <select id="semestre" name="semestre" required>
                        <?php foreach ($semestres as $id => $desc): ?>
                            <option value="<?php echo $id; ?>" <?php echo $estudiante['semestre'] == $id ? 'selected' : ''; ?>><?php echo $desc; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="programa_id">Programa</label>
                    <select id="programa_id" name="programa_id" required>
                        <?php foreach ($programas as $id => $nombre): ?>
                            <option value="<?php echo $id; ?>" <?php echo $estudiante['programa_id'] == $id ? 'selected' : ''; ?>><?php echo $nombre; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="fecha_matricula">Fecha de Matrícula</label>
                    <input type="date" id="fecha_matricula" name="fecha_matricula" value="<?php echo htmlspecialchars($estudiante['fecha_matricula'] ?? ''); ?>">
                </div>
                <button type="submit" class="login-btn">Guardar Cambios</button>
            </form>
        <?php endif; ?>
        <h3>Lista de Estudiantes</h3>
        <table class="student-table">
            <thead>
                <tr>
                    <th>DNI</th>
                    <th>Nombres</th>
                    <th>Apellido Paterno</th>
                    <th>Apellido Materno</th>
                    <th>Estado</th>
                    <th>Semestre</th>
                    <th>Programa</th>
                    <th>Fecha Matrícula</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($estudiantes as $estudiante): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($estudiante['dni']); ?></td>
                        <td><?php echo htmlspecialchars($estudiante['nombres']); ?></td>
                        <td><?php echo htmlspecialchars($estudiante['apellido_paterno']); ?></td>
                        <td><?php echo htmlspecialchars($estudiante['apellido_materno']); ?></td>
                        <td><?php echo htmlspecialchars($estudiante['estado']); ?></td>
                        <td><?php echo htmlspecialchars($semestres[$estudiante['semestre']]); ?></td>
                        <td><?php echo htmlspecialchars($programas[$estudiante['programa_id']]); ?></td>
                        <td><?php echo htmlspecialchars($estudiante['fecha_matricula'] ?? 'N/A'); ?></td>
                        <td>
                            <a href="index.php?controller=estudiante&action=updateEstudiante&dni=<?php echo urlencode($estudiante['dni']); ?>" class="action-btn edit">Actualizar</a>
                            <a href="index.php?controller=estudiante&action=deleteEstudiante&dni=<?php echo urlencode($estudiante['dni']); ?>" class="action-btn delete" onclick="return confirm('¿Estás seguro de eliminar este estudiante?');">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
    <?php include __DIR__ . '/footer.php'; ?>
</body>
</html>