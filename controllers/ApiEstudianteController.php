<?php
require_once __DIR__ . '/../models/EstudianteModel.php';

class ApiEstudianteController {
    private $model;

    public function __construct() {
        $this->model = new EstudianteModel();
    }

    /**
     * Buscar estudiantes y devolver resultados en JSON
     */
    public function buscarEstudiantes() {
        // Configurar headers para API JSON
        header('Content-Type: application/json; charset=utf-8');
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type, Authorization');

        // Manejar preflight CORS
        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            http_response_code(200);
            exit();
        }

        // Solo permitir método GET
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            $this->sendResponse(405, [
                'success' => false,
                'message' => 'Método no permitido. Use GET.'
            ]);
            return;
        }

        try {
            // Obtener parámetros de búsqueda
            $filters = [
                'dni' => $_GET['dni'] ?? '',
                'nombres' => $_GET['nombres'] ?? '',
                'apellido_paterno' => $_GET['apellido_paterno'] ?? '',
                'apellido_materno' => $_GET['apellido_materno'] ?? '',
                'q' => $_GET['q'] ?? '', // Búsqueda general
                'estado' => $_GET['estado'] ?? '',
                'limit' => $_GET['limit'] ?? 50
            ];

            // Validar y limpiar parámetros
            $filters = $this->sanitizeFilters($filters);

            // Buscar estudiantes
            $estudiantes = $this->model->buscarEstudiantesAvanzado($filters);

            // Formatear respuesta
            $response = [
                'success' => true,
                'data' => $estudiantes,
                'total' => count($estudiantes),
                'filters_applied' => $filters,
                'timestamp' => date('Y-m-d H:i:s')
            ];

            $this->sendResponse(200, $response);

        } catch (Exception $e) {
            $this->sendResponse(500, [
                'success' => false,
                'message' => 'Error interno del servidor',
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Obtener estudiante específico por DNI
     */
    public function getEstudiante($dni) {
        // Configurar headers para API JSON
        header('Content-Type: application/json; charset=utf-8');
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type, Authorization');

        // Manejar preflight CORS
        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            http_response_code(200);
            exit();
        }

        // Solo permitir método GET
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            $this->sendResponse(405, [
                'success' => false,
                'message' => 'Método no permitido. Use GET.'
            ]);
            return;
        }

        try {
            // Validar DNI
            if (!preg_match('/^\d{8}$/', $dni)) {
                $this->sendResponse(400, [
                    'success' => false,
                    'message' => 'Formato de DNI inválido. Debe contener 8 dígitos.'
                ]);
                return;
            }

            $estudiante = $this->model->getEstudianteByDni($dni);

            if ($estudiante) {
                $this->sendResponse(200, [
                    'success' => true,
                    'data' => $estudiante
                ]);
            } else {
                $this->sendResponse(404, [
                    'success' => false,
                    'message' => 'Estudiante no encontrado'
                ]);
            }

        } catch (Exception $e) {
            $this->sendResponse(500, [
                'success' => false,
                'message' => 'Error interno del servidor',
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Sanitizar y validar filtros de búsqueda
     */
    private function sanitizeFilters($filters) {
        $sanitized = [];

        // DNI: solo números, máximo 8 dígitos
        $sanitized['dni'] = preg_replace('/[^0-9]/', '', $filters['dni']);
        $sanitized['dni'] = substr($sanitized['dni'], 0, 8);

        // Nombres y apellidos: limpiar y limitar longitud
        $sanitized['nombres'] = trim(substr($filters['nombres'], 0, 100));
        $sanitized['apellido_paterno'] = trim(substr($filters['apellido_paterno'], 0, 50));
        $sanitized['apellido_materno'] = trim(substr($filters['apellido_materno'], 0, 50));
        
        // Búsqueda general
        $sanitized['q'] = trim(substr($filters['q'], 0, 100));

        // Estado: validar valores permitidos
        $estadosPermitidos = ['activo', 'inactivo', 'graduado', 'suspendido'];
        $sanitized['estado'] = in_array($filters['estado'], $estadosPermitidos) ? $filters['estado'] : '';

        // Límite: entre 1 y 100
        $sanitized['limit'] = max(1, min(100, (int)$filters['limit']));

        return $sanitized;
    }

    /**
     * Enviar respuesta JSON
     */
    private function sendResponse($statusCode, $data) {
        http_response_code($statusCode);
        echo json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        exit;
    }

    /**
     * Documentación de la API
     */
    public function documentacion() {
        header('Content-Type: application/json; charset=utf-8');
        
        $doc = [
            'api_name' => 'SIRE IESHUANTA - API de Estudiantes',
            'version' => '1.0',
            'endpoints' => [
                [
                    'method' => 'GET',
                    'endpoint' => '/api/estudiantes/buscar',
                    'description' => 'Buscar estudiantes con filtros',
                    'parameters' => [
                        'dni' => 'Búsqueda exacta por DNI (8 dígitos)',
                        'nombres' => 'Búsqueda por nombres (like)',
                        'apellido_paterno' => 'Búsqueda por apellido paterno (like)',
                        'apellido_materno' => 'Búsqueda por apellido materno (like)',
                        'q' => 'Búsqueda general en nombres y apellidos',
                        'estado' => 'Filtrar por estado (activo, inactivo, graduado, suspendido)',
                        'limit' => 'Límite de resultados (1-100, default: 50)'
                    ],
                    'example' => '/api/estudiantes/buscar?dni=41664487&limit=10'
                ],
                [
                    'method' => 'GET',
                    'endpoint' => '/api/estudiantes/{dni}',
                    'description' => 'Obtener estudiante específico por DNI',
                    'parameters' => [
                        'dni' => 'DNI del estudiante (8 dígitos)'
                    ],
                    'example' => '/api/estudiantes/41664487'
                ]
            ],
            'response_format' => [
                'success' => 'boolean',
                'data' => 'array de estudiantes',
                'total' => 'número de resultados',
                'filters_applied' => 'filtros utilizados',
                'timestamp' => 'fecha y hora de la consulta'
            ]
        ];

        echo json_encode($doc, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        exit;
    }
}
?>