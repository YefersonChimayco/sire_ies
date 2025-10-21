<?php
require_once __DIR__ . '/../models/EstudianteModel.php';

class ApiEstudianteController {
    private $modeloEstudiante;

    public function __construct() {
        $this->modeloEstudiante = new EstudianteModel();
    }

    public function buscar() {
        // Token fijo
        $tokenValido = "asdasfgfdadfsghjkljhdgsdfas";
        
        // Obtener parámetros de búsqueda
        $dni = isset($_GET['dni']) ? trim($_GET['dni']) : '';
        $nombre = isset($_GET['nombre']) ? trim($_GET['nombre']) : '';
        $apellido = isset($_GET['apellido']) ? trim($_GET['apellido']) : '';

        // Buscar estudiantes
        $estudiantes = $this->modeloEstudiante->buscarEstudiantesAPI($dni, $nombre, $apellido, 50);

        // Enviar respuesta JSON
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode([
            'exito' => true,
            'total' => count($estudiantes),
            'datos' => $estudiantes
        ], JSON_UNESCAPED_UNICODE);
    }

    // Para mostrar la interfaz de búsqueda
    public function interfaz() {
        require_once __DIR__ . '/../views/buscador_api.php';
    }
}
?>