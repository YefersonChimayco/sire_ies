<?php
require_once __DIR__ . '/../models/EstudianteModel.php';

class EstudianteController {
    private $model;

    public function __construct() {
        $this->model = new EstudianteModel();
    }

    public function gestion() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $dni = trim($_POST['dni'] ?? '');
        $nombres = trim($_POST['nombres'] ?? '');
        $apellido_paterno = trim($_POST['apellido_paterno'] ?? '');
        $apellido_materno = trim($_POST['apellido_materno'] ?? '');
        $estado = trim($_POST['estado'] ?? 'activo');
        $semestre = (int)($_POST['semestre'] ?? 1);
        $programa_id = (int)($_POST['programa_id'] ?? 1);
        $fecha_matricula = trim($_POST['fecha_matricula'] ?? null);

        if ($this->model->createEstudiante($dni, $nombres, $apellido_paterno, $apellido_materno, $estado, $semestre, $programa_id, $fecha_matricula)) {
            $message = "Estudiante registrado exitosamente.";
        } else {
            $message = "Error al registrar estudiante.";
        }
    } else {
        $message = '';
    }

    // Obtener parámetros de búsqueda
    $search_dni = isset($_GET['search_dni']) ? trim($_GET['search_dni']) : '';
    $search_nombre = isset($_GET['search_nombre']) ? trim($_GET['search_nombre']) : '';
    
    // Obtener estudiantes según criterios de búsqueda
    if (!empty($search_dni)) {
        $estudiantes = $this->model->buscarPorDni($search_dni);
    } elseif (!empty($search_nombre)) {
        $estudiantes = $this->model->buscarPorNombre($search_nombre);
    } else {
        // Mostrar TODOS los estudiantes si no hay búsqueda
        $estudiantes = $this->model->getAllEstudiantes();
    }
    
    require_once __DIR__ . '/../views/estudiantes.php';
}
    public function updateEstudiante($dni) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombres = trim($_POST['nombres'] ?? '');
            $apellido_paterno = trim($_POST['apellido_paterno'] ?? '');
            $apellido_materno = trim($_POST['apellido_materno'] ?? '');
            $estado = trim($_POST['estado'] ?? 'activo');
            $semestre = (int)($_POST['semestre'] ?? 1);
            $programa_id = (int)($_POST['programa_id'] ?? 1);
            $fecha_matricula = trim($_POST['fecha_matricula'] ?? null);

            if ($this->model->updateEstudiante($dni, $nombres, $apellido_paterno, $apellido_materno, $estado, $semestre, $programa_id, $fecha_matricula)) {
                header('Location: index.php?controller=estudiante&action=gestion');
                exit;
            }
        }
        $estudiante = $this->model->getEstudianteByDni($dni);
        require_once __DIR__ . '/../views/estudiantes.php';
    }

    public function deleteEstudiante($dni) {
        if ($this->model->deleteEstudiante($dni)) {
            header('Location: index.php?controller=estudiante&action=gestion');
            exit;
        }
    }
}
?>