<?php
require_once __DIR__ . '/../config/config.php';

class UserModel {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
    }

    // ---- LOGIN ----
    public function login($username, $password) {
        $stmt = $this->db->prepare("SELECT id, username, password FROM usuarios WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verificación segura
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }

    // ---- REGISTRO ----
    public function register($username, $password) {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        $stmt = $this->db->prepare("INSERT INTO usuarios (username, password) VALUES (:username, :password)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $hashedPassword);

        return $stmt->execute();
    }
}
