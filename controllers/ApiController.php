<?php
require_once __DIR__ . '/../models/EstudianteModel.php';

class ApiController {
    private $model;

    public function __construct() {
        $this->model = new EstudianteModel();
    }

    /**
     * Interfaz de prueba del API
     */
    public function test() {
        // Mostrar la vista de prueba
        include __DIR__ . '/../views/api_test.php';
        exit;
    }

    /**
     * Buscar estudiantes - API JSON
     */
    public function buscarEstudiantes() {
        // Configurar JSON
        header('Content-Type: application/json; charset=utf-8');
        header('Access-Control-Allow-Origin: *');
        
        // Solo GET
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            echo json_encode([
                'success' => false,
                'message' => 'Solo método GET permitido'
            ]);
            exit;
        }

        try {
            // Parámetros simples
            $dni = trim($_GET['dni'] ?? '');
            $nombre = trim($_GET['nombre'] ?? '');
            $apellido = trim($_GET['apellido'] ?? '');
            $limit = (int)($_GET['limit'] ?? 50);

            // Validar límite
            $limit = max(1, min(100, $limit));

            // Buscar en el modelo
            $estudiantes = $this->model->buscarEstudiantesAPI($dni, $nombre, $apellido, $limit);

            // Respuesta JSON
            echo json_encode([
                'success' => true,
                'data' => $estudiantes,
                'total' => count($estudiantes),
                'filtros' => [
                    'dni' => $dni,
                    'nombre' => $nombre,
                    'apellido' => $apellido,
                    'limit' => $limit
                ]
            ], JSON_UNESCAPED_UNICODE);

        } catch (Exception $e) {
            echo json_encode([
                'success' => false,
                'message' => 'Error interno',
                'error' => $e->getMessage()
            ]);
        }
        exit;
    }

    /**
     * Obtener estudiante por DNI
     */
    public function getEstudiante() {
        header('Content-Type: application/json; charset=utf-8');
        header('Access-Control-Allow-Origin: *');

        $dni = $_GET['dni'] ?? '';
        
        // Validar DNI
        if (!preg_match('/^\d{8}$/', $dni)) {
            echo json_encode([
                'success' => false,
                'message' => 'DNI debe tener 8 dígitos'
            ]);
            exit;
        }

        try {
            $estudiante = $this->model->getEstudianteByDni($dni);

            if ($estudiante) {
                echo json_encode([
                    'success' => true,
                    'data' => $estudiante
                ], JSON_UNESCAPED_UNICODE);
            } else {
                echo json_encode([
                    'success' => false,
                    'message' => 'Estudiante no encontrado'
                ]);
            }

        } catch (Exception $e) {
            echo json_encode([
                'success' => false,
                'message' => 'Error interno',
                'error' => $e->getMessage()
            ]);
        }
        exit;
    }
}
?>