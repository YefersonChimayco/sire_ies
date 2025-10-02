<?php
require_once __DIR__ . '/../config/config.php';

class TokenModel {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
    }

    // Crear un token
    public function createToken($id_client_api, $token, $fecha_reg, $estado = 1) {
        $stmt = $this->db->prepare("
            INSERT INTO Tokens (id_client_api, token, fecha_reg, estado) 
            VALUES (:id_client_api, :token, :fecha_reg, :estado)
        ");
        $stmt->bindParam(':id_client_api', $id_client_api, PDO::PARAM_INT);
        $stmt->bindParam(':token', $token);
        $stmt->bindParam(':fecha_reg', $fecha_reg);
        $stmt->bindParam(':estado', $estado, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Obtener todos los tokens
    public function getAllTokens() {
        $stmt = $this->db->prepare("SELECT * FROM Tokens");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener un token por ID
    public function getTokenById($id) {
        $stmt = $this->db->prepare("SELECT * FROM Tokens WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Actualizar un token
    public function updateToken($id, $id_client_api, $token, $fecha_reg, $estado) {
        $stmt = $this->db->prepare("
            UPDATE Tokens 
            SET id_client_api = :id_client_api, token = :token, fecha_reg = :fecha_reg, estado = :estado
            WHERE id = :id
        ");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':id_client_api', $id_client_api, PDO::PARAM_INT);
        $stmt->bindParam(':token', $token);
        $stmt->bindParam(':fecha_reg', $fecha_reg);
        $stmt->bindParam(':estado', $estado, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Eliminar un token
    public function deleteToken($id) {
        $stmt = $this->db->prepare("DELETE FROM Tokens WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Obtener lista de clientes (para el select)
    public function getAllClientes() {
        $stmt = $this->db->prepare("SELECT id, razon_social FROM Client_API");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
