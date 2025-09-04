<?php
// Iniciar sesión solo si no está activa
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Router simple basado en GET parameters
$controller = $_GET['controller'] ?? 'auth';
$action = $_GET['action'] ?? 'login';
$id = $_GET['id'] ?? null; // Para programas y semestres
$dni = $_GET['dni'] ?? null; // Para estudiantes

$controllerFile = __DIR__ . '/controllers/' . ucfirst($controller) . 'Controller.php';
if (file_exists($controllerFile)) {
    require_once $controllerFile;
    $controllerClass = ucfirst($controller) . 'Controller';
    if (class_exists($controllerClass)) {
        $controllerObj = new $controllerClass();
        if (method_exists($controllerObj, $action)) {
            if ($dni && in_array($action, ['updateEstudiante', 'deleteEstudiante'])) {
                $controllerObj->$action($dni);
            } elseif ($id && in_array($action, ['updatePrograma', 'deletePrograma', 'updateSemestre', 'deleteSemestre'])) {
                $controllerObj->$action($id);
            } else {
                $controllerObj->$action();
            }
        } else {
            // Redirigir a la acción por defecto si existe
            if (method_exists($controllerObj, 'gestion')) {
                $controllerObj->gestion();
            } else {
                http_response_code(404);
                echo "Acción no encontrada.";
            }
        }
    } else {
        http_response_code(404);
        echo "Controlador no encontrado.";
    }
} else {
    http_response_code(404);
    echo "Archivo de controlador no encontrado.";
}
?>