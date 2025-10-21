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
    // Agregar estos métodos a tu TokenModel existente:

public function validarToken($token) {
    $stmt = $this->db->prepare("
        SELECT t.*, c.razon_social 
        FROM Tokens t
        INNER JOIN Client_API c ON t.id_client_api = c.id
        WHERE t.token = :token AND t.estado = 1 AND c.estado = 1
    ");
    
    $stmt->bindParam(":token", $token);
    $stmt->execute();
    
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

public function obtenerTokenPorToken($token) {
    $stmt = $this->db->prepare("SELECT * FROM Tokens WHERE token = :token");
    $stmt->bindParam(":token", $token);
    $stmt->execute();
    
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

public function registrarSolicitud($id_token, $tipo = 'busqueda_api') {
    // Primero intentar actualizar si ya existe registro para hoy
    $stmt = $this->db->prepare("
        UPDATE Count_request 
        SET contador = contador + 1 
        WHERE id_token = :id_token AND fecha = CURDATE() AND tipo = :tipo
    ");
    
    $stmt->bindParam(":id_token", $id_token, PDO::PARAM_INT);
    $stmt->bindParam(":tipo", $tipo);
    $stmt->execute();
    
    // Si no se actualizó ninguna fila, insertar nuevo registro
    if ($stmt->rowCount() == 0) {
        $stmt = $this->db->prepare("
            INSERT INTO Count_request (id_token, contador, tipo, fecha) 
            VALUES (:id_token, 1, :tipo, CURDATE())
        ");
        
        $stmt->bindParam(":id_token", $id_token, PDO::PARAM_INT);
        $stmt->bindParam(":tipo", $tipo);
        $stmt->execute();
    }
    
    return true;
}
}
?>
