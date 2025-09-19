<?php
require_once __DIR__ . '/../config/config.php';

class ClienteModel {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
    }

    // Crear un cliente
    public function createCliente($ruc, $razon_social, $telefono, $correo, $fecha_registro, $estado = 1) {
        $stmt = $this->db->prepare("
            INSERT INTO Client_API (ruc, razon_social, telefono, correo, fecha_registro, estado) 
            VALUES (:ruc, :razon_social, :telefono, :correo, :fecha_registro, :estado)
        ");
        $stmt->bindParam(':ruc', $ruc);
        $stmt->bindParam(':razon_social', $razon_social);
        $stmt->bindParam(':telefono', $telefono);
        $stmt->bindParam(':correo', $correo);
        $stmt->bindParam(':fecha_registro', $fecha_registro);
        $stmt->bindParam(':estado', $estado, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Obtener todos los clientes
    public function getAllClientes() {
        $stmt = $this->db->prepare("SELECT * FROM Client_API");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener un cliente por ID
    public function getClienteById($id) {
        $stmt = $this->db->prepare("SELECT * FROM Client_API WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Actualizar un cliente
    public function updateCliente($id, $ruc, $razon_social, $telefono, $correo, $fecha_registro, $estado) {
        $stmt = $this->db->prepare("
            UPDATE Client_API 
            SET ruc = :ruc, razon_social = :razon_social, telefono = :telefono, 
                correo = :correo, fecha_registro = :fecha_registro, estado = :estado
            WHERE id = :id
        ");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':ruc', $ruc);
        $stmt->bindParam(':razon_social', $razon_social);
        $stmt->bindParam(':telefono', $telefono);
        $stmt->bindParam(':correo', $correo);
        $stmt->bindParam(':fecha_registro', $fecha_registro);
        $stmt->bindParam(':estado', $estado, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Eliminar un cliente
    public function deleteCliente($id) {
        $stmt = $this->db->prepare("DELETE FROM Client_API WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
