<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIRE IESHUANTA - Gestión de Estudiantes</title>
    <link rel="stylesheet" href="/sire_ies/css/styles.css">
    <style>
        .search-container {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .search-form {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            align-items: end;
        }
        
        .search-group {
            flex: 1;
            min-width: 200px;
        }
        
        .search-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #2c3e50;
        }
        
        .search-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }
        
        .search-btn {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        
        .search-btn:hover {
            background-color: #2980b9;
        }
        
        .clear-btn {
            background-color: #e74c3c;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        
        .clear-btn:hover {
            background-color: #c0392b;
        }
        
        .no-results {
            text-align: center;
            padding: 20px;
            font-style: italic;
            color: #7f8c8d;
            background-color: #fff3cd;
            border: 1px solid #ffeaa7;
            border-radius: 5px;
            margin: 20px 0;
        }
        
        .add-student-btn {
            background-color: #27ae60;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-bottom: 20px;
            transition: background-color 0.3s;
        }
        
        .add-student-btn:hover {
            background-color: #219653;
        }
        
        .form-container {
            display: none;
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .form-container.visible {
            display: block;
        }
        
        @media (max-width: 768px) {
            .search-form {
                flex-direction: column;
            }
            
            .search-group {
                width: 100%;
            }
            
            .button-group {
                display: flex;
                gap: 10px;
                width: 100%;
            }
            
            .search-btn, .clear-btn {
                flex: 1;
            }
        }
    </style>
</head>
<body>
    <?php include __DIR__ . '/header.php'; ?>
    <main class="dashboard-container">
        <h2>Gestión de Estudiantes</h2>
        <a href="index.php?controller=auth&action=dashboard" class="back-btn">Regresar al Inicio</a>
        
        <!-- Botón para mostrar formulario de agregar estudiante -->
        <button class="add-student-btn" onclick="toggleForm()">+ Agregar Estudiante</button>
        
        <!-- Formulario de creación de estudiantes (oculto inicialmente) -->
        <form method="POST" action="index.php?controller=estudiante&action=gestion" class="form-container" id="create-form">
            <h3>Registrar Nuevo Estudiante</h3>
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
            <button type="button" class="clear-btn" onclick="toggleForm()">Cancelar</button>
        </form>
        
        <!-- Buscador de estudiantes -->
        <div class="search-container">
            <h3>Buscar Estudiantes</h3>
            <form method="GET" action="index.php" class="search-form" id="search-form">
                <input type="hidden" name="controller" value="estudiante">
                <input type="hidden" name="action" value="gestion">
                
                <div class="search-group">
                    <label for="search_dni">Buscar por DNI</label>
                    <input type="text" id="search_dni" name="search_dni" 
                           value="<?php echo isset($_GET['search_dni']) ? htmlspecialchars($_GET['search_dni']) : ''; ?>" 
                           placeholder="Ingrese DNI">
                </div>
                
                <div class="search-group">
                    <label for="search_nombre">Buscar por Nombre</label>
                    <input type="text" id="search_nombre" name="search_nombre" 
                           value="<?php echo isset($_GET['search_nombre']) ? htmlspecialchars($_GET['search_nombre']) : ''; ?>" 
                           placeholder="Ingrese nombre o apellido">
                </div>
                
                <div class="button-group">
                    <button type="submit" class="search-btn">Buscar</button>
                    <a href="index.php?controller=estudiante&action=gestion" class="clear-btn">Limpiar</a>
                </div>
            </form>
        </div>
        
        <?php if (isset($message)): ?>
            <p class="message"><?php echo htmlspecialchars($message); ?></p>
        <?php endif; ?>
        
        <?php if (isset($estudiante) && is_array($estudiante)): ?>
            <form method="POST" action="index.php?controller=estudiante&action=updateEstudiante&dni=<?php echo urlencode($estudiante['dni']); ?>" class="form-container" id="update-form" style="display: block;">
                <h3>Editar Estudiante</h3>
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
                <a href="index.php?controller=estudiante&action=gestion" class="clear-btn">Cancelar</a>
            </form>
        <?php endif; ?>
        
        <h3>Lista de Estudiantes</h3>
        
        <?php 
        // Verificar si se realizó una búsqueda
        $search_performed = (isset($_GET['search_dni']) && !empty(trim($_GET['search_dni']))) || 
                           (isset($_GET['search_nombre']) && !empty(trim($_GET['search_nombre'])));
        
        if (empty($estudiantes) && $search_performed): 
        ?>
            <div class="no-results">
                <p>❌ No se encontraron estudiantes con los criterios de búsqueda.</p>
                <p>Por favor, verifique el DNI o nombre ingresado.</p>
            </div>
        <?php elseif (empty($estudiantes)): ?>
            <div class="no-results">
                <p>No hay estudiantes registrados en el sistema.</p>
            </div>
        <?php else: ?>
            <?php if ($search_performed): ?>
                <p class="message">Mostrando <?php echo count($estudiantes); ?> resultado(s) de búsqueda</p>
            <?php else: ?>
                <p class="message">Mostrando todos los estudiantes registrados (<?php echo count($estudiantes); ?>)</p>
            <?php endif; ?>
            
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
                    <?php foreach ($estudiantes as $est): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($est['dni']); ?></td>
                            <td><?php echo htmlspecialchars($est['nombres']); ?></td>
                            <td><?php echo htmlspecialchars($est['apellido_paterno']); ?></td>
                            <td><?php echo htmlspecialchars($est['apellido_materno']); ?></td>
                            <td><?php echo htmlspecialchars($est['estado']); ?></td>
                            <td><?php echo htmlspecialchars($semestres[$est['semestre']]); ?></td>
                            <td><?php echo htmlspecialchars($programas[$est['programa_id']]); ?></td>
                            <td><?php echo htmlspecialchars($est['fecha_matricula'] ?? 'N/A'); ?></td>
                            <td>
                                <a href="index.php?controller=estudiante&action=updateEstudiante&dni=<?php echo urlencode($est['dni']); ?>" class="action-btn edit">Actualizar</a>
                                <a href="index.php?controller=estudiante&action=deleteEstudiante&dni=<?php echo urlencode($est['dni']); ?>" class="action-btn delete" onclick="return confirm('¿Estás seguro de eliminar este estudiante?');">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </main>
    <?php include __DIR__ . '/footer.php'; ?>
    
    <script>
        // Función para mostrar/ocultar el formulario de agregar estudiante
        function toggleForm() {
            const form = document.getElementById('create-form');
            form.classList.toggle('visible');
        }
        
        // Mostrar mensaje de alerta si hay parámetros de búsqueda pero no resultados
        <?php if ($search_performed && empty($estudiantes)): ?>
            setTimeout(() => {
                alert('⚠️ No se encontraron estudiantes con los criterios de búsqueda.\nPor favor, verifique el DNI o nombre ingresado.');
            }, 300);
        <?php endif; ?>
        
        // Validar que solo se ingrese un criterio de búsqueda a la vez
        document.getElementById('search-form').addEventListener('submit', function(e) {
            const dni = document.getElementById('search_dni').value.trim();
            const nombre = document.getElementById('search_nombre').value.trim();
            
            if (dni && nombre) {
                e.preventDefault();
                alert('Por favor, ingrese solo un criterio de búsqueda a la vez (DNI o Nombre).');
                document.getElementById('search_nombre').value = '';
            }
        });
    </script>
</body>
</html>