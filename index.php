<?php
// ======================================
// INDEX PRINCIPAL - SIRE IESHUANTA
// ======================================

// Iniciar sesión solo si no está activa
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// -------------------------------
// Parámetros recibidos por GET
// -------------------------------
$controller = $_GET['controller'] ?? 'auth';  // Por defecto: autenticación
$action     = $_GET['action'] ?? 'login';     // Por defecto: login

// Posibles parámetros adicionales
$id  = $_GET['id']  ?? null;   // Para programas, semestres, tokens
$dni = $_GET['dni'] ?? null;   // Para estudiantes
$uid = $_GET['uid'] ?? null;   // Para usuarios

// -------------------------------
// Definir archivo y clase de controlador
// -------------------------------
$controllerFile  = __DIR__ . '/controllers/' . ucfirst($controller) . 'Controller.php';
$controllerClass = ucfirst($controller) . 'Controller';

// -------------------------------
// Cargar controlador si existe
// -------------------------------
if (file_exists($controllerFile)) {
    require_once $controllerFile;

    if (class_exists($controllerClass)) {
        $controllerObj = new $controllerClass();

        if (method_exists($controllerObj, $action)) {
            // --- Manejo de parámetros según acción ---
            if ($dni && in_array($action, ['updateEstudiante', 'deleteEstudiante'])) {
                $controllerObj->$action($dni);

            } elseif ($id && in_array($action, [
                'updatePrograma', 'deletePrograma',
                'updateSemestre', 'deleteSemestre',
                'updateToken', 'deleteToken' ,
    'updateCliente', 'deleteCliente'  //
            ])) {
                $controllerObj->$action($id);

            } elseif ($uid && in_array($action, ['updateUser', 'deleteUser'])) {
                $controllerObj->$action($uid);

            } else {
                $controllerObj->$action();
            }

        } else {
            // Acción no encontrada → cargar gestion si existe
            if (method_exists($controllerObj, 'gestion')) {
                $controllerObj->gestion();
            } else {
                http_response_code(404);
                echo "<h3>❌ Acción '$action' no encontrada en $controllerClass.</h3>";
            }
        }
    } else {
        http_response_code(404);
        echo "<h3>❌ Clase '$controllerClass' no encontrada.</h3>";
    }
} else {
    http_response_code(404);
    echo "<h3>❌ Archivo '$controllerFile' no existe.</h3>";
}
// === AGREGAR ESTAS LÍNEAS AL ROUTER PRINCIPAL ===

// === RUTAS API ESTUDIANTES ===
if ($controller === 'apiestudiante') {
    require_once __DIR__ . '/controllers/ApiEstudianteController.php';
    $apiController = new ApiEstudianteController();
    
    if ($action === 'buscar') {
        $apiController->buscar();
    } 
    elseif ($action === 'get' && isset($_GET['dni'])) {
        $apiController->get($_GET['dni']);
    }
}