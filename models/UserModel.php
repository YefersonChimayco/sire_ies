<?php
require_once __DIR__ . '/../config/config.php';

class UserModel {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
    }

    public function login($username, $password) {
        $stmt = $this->db->prepare("SELECT id, username, password FROM usuarios WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user && $user['password'] === $password) { // Comparación en texto plano temporal
            return $user;
        }
        return false;
    }
}
?>