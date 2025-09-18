<?php
// debug_password.php  -> poner en la raíz del proyecto (junto a index.php)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// probar rutas comunes a config.php
$paths = [
    __DIR__ . '/config/config.php',
    __DIR__ . '/../config/config.php',
    __DIR__ . '/src/config/config.php'
];

$configFound = false;
foreach ($paths as $p) {
    if (file_exists($p)) {
        require_once $p;
        $configFound = true;
        break;
    }
}

if (!$configFound) {
    echo "ERROR: No encontré config/config.php en las rutas probadas:\n" . implode("\n", $paths);
    exit;
}

try {
    $database = new Database();
    $db = $database->connect();
} catch (Exception $e) {
    echo "ERROR: No pude conectar a la DB: " . $e->getMessage();
    exit;
}

$username = $_GET['user'] ?? 'admin';        // prueba: ?user=admin
$plain    = $_GET['pass'] ?? 'admin2025';    // prueba: ?pass=admin2025

$stmt = $db->prepare("SELECT id, username, password FROM usuarios WHERE username = :username LIMIT 1");
$stmt->bindParam(':username', $username);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

echo "<pre>";
if (!$user) {
    echo "Usuario '$username' NO encontrado en la tabla usuarios.\n";
    echo "Ejecuta en phpMyAdmin: SELECT * FROM usuarios;\n";
    exit;
}

echo "Usuario encontrado: " . $user['username'] . "\n";
echo "Hash guardado en BD:\n" . $user['password'] . "\n\n";

$ok = password_verify($plain, $user['password']);
echo "password_verify('$plain', hash) => " . ($ok ? "TRUE (coincide)\n" : "FALSE (no coincide)\n");

echo "\nINSTRUCCIONES RÁPIDAS:\n";
echo "- Si password_verify => TRUE  -> la verificación funciona: problema es otro (reemplazo de archivos, session, rutas).\n";
echo "- Si password_verify => FALSE -> el hash en BD no corresponde al texto que usas (o no es un hash válido).\n";
echo "</pre>";
