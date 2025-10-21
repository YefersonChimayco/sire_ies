<?php
require_once __DIR__ . '/../models/ApiModelo.php';
require_once __DIR__ . '/../models/TokenModel.php';

class ApiController {
    private $modelo;
    private $modeloToken;

    public function __construct() {
        $this->modelo = new ApiModelo();
        $this->modeloToken = new TokenModel();
    }

    public function buscarEstudiante() {
        // Validar token
        $token = $this->obtenerToken();
        
        if (!$this->validarToken($token)) {
            http_response_code(401);
            echo json_encode([
                'exito' => false,
                'mensaje' => 'Token inválido o expirado'
            ]);
            return;
        }

        // Obtener parámetros de búsqueda
        $dni = isset($_GET['dni']) ? trim($_GET['dni']) : '';
        $nombre = isset($_GET['nombre']) ? trim($_GET['nombre']) : '';
        $apellido = isset($_GET['apellido']) ? trim($_GET['apellido']) : '';
        $limite = isset($_GET['limite']) ? (int)$_GET['limite'] : 50;

        // Realizar búsqueda
        $estudiantes = $this->modelo->buscarEstudiantesAPI($dni, $nombre, $apellido, $limite);

        // Registrar la solicitud en el contador
        $this->registrarSolicitud($token);

        // Devolver resultados
        echo json_encode([
            'exito' => true,
            'total' => count($estudiantes),
            'datos' => $estudiantes
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    private function obtenerToken() {
        $headers = getallheaders();
        
        // Buscar token en Authorization header
        if (isset($headers['Authorization'])) {
            return str_replace('Bearer ', '', $headers['Authorization']);
        }
        
        // Buscar token en parámetro GET
        if (isset($_GET['token'])) {
            return $_GET['token'];
        }
        
        return '';
    }

    private function validarToken($token) {
        if (empty($token)) {
            return false;
        }

        // Usar el modelo de Token existente para validar
        $cliente = $this->modeloToken->validarToken($token);
        return $cliente !== false;
    }

    private function registrarSolicitud($token) {
        // Obtener ID del token para registrar en Count_request
        $infoToken = $this->modeloToken->obtenerTokenPorToken($token);
        if ($infoToken) {
            $this->modeloToken->registrarSolicitud($infoToken['id'], 'busqueda_api');
        }
    }
}
?>