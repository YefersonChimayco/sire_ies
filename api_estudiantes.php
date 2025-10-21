<?php
// Archivo público - No requiere sesión pero sí token válido
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/models/EstudianteModel.php';
require_once __DIR__ . '/models/TokenModel.php';

// Headers para CORS y JSON
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: Authorization, Content-Type');

// Tokens válidos (ocultos en el código)
$tokensValidos = [
    'cd2de76a3fc6a818fbd0fb1a97e94961-2',
    '676e825340db2c338f23bcf57882f347-1'
];

// Función para validar token
function validarToken($token, $tokensValidos) {
    if (empty($token)) {
        return false;
    }
    
    // Validar contra tokens hardcodeados
    if (in_array($token, $tokensValidos)) {
        return true;
    }
    
    // También validar contra base de datos por si acaso
    $modeloToken = new TokenModel();
    $cliente = $modeloToken->validarToken($token);
    return $cliente !== false;
}

// Función para obtener token de la solicitud
function obtenerToken() {
    // Buscar en headers
    $headers = getallheaders();
    if (isset($headers['Authorization'])) {
        return str_replace('Bearer ', '', $headers['Authorization']);
    }
    
    // Buscar en parámetros GET
    if (isset($_GET['token'])) {
        return $_GET['token'];
    }
    
    // Buscar en POST
    if (isset($_POST['token'])) {
        return $_POST['token'];
    }
    
    return '';
}

// Función para buscar estudiantes
function buscarEstudiantes($tokensValidos) {
    // Validar token primero
    $token = obtenerToken();
    
    if (!validarToken($token, $tokensValidos)) {
        http_response_code(401);
        return [
            'exito' => false,
            'error' => 'Token inválido o expirado'
        ];
    }
    
    $modelo = new EstudianteModel();
    $modeloToken = new TokenModel();
    
    // Obtener parámetros de búsqueda
    $dni = isset($_GET['dni']) ? trim($_GET['dni']) : '';
    $nombre = isset($_GET['nombre']) ? trim($_GET['nombre']) : '';
    $apellido = isset($_GET['apellido']) ? trim($_GET['apellido']) : '';
    $limite = isset($_GET['limite']) ? (int)$_GET['limite'] : 50;

    // Buscar estudiantes
    $estudiantes = $modelo->buscarEstudiantesAPI($dni, $nombre, $apellido, $limite);

    // Registrar la solicitud en el contador (si existe en BD)
    $infoToken = $modeloToken->obtenerTokenPorToken($token);
    if ($infoToken) {
        $modeloToken->registrarSolicitud($infoToken['id'], 'busqueda_api');
    }

    return [
        'exito' => true,
        'total' => count($estudiantes),
        'datos' => $estudiantes
    ];
}

// Manejar la solicitud
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $resultado = buscarEstudiantes($tokensValidos);
    echo json_encode($resultado, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
} else {
    http_response_code(405);
    echo json_encode(['exito' => false, 'error' => 'Método no permitido']);
}
?>