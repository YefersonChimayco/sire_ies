<?php
require_once __DIR__ . '/../config/config.php';

class ProgramaModel {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
    }

    public function createPrograma($nombre, $descripcion) {
        $stmt = $this->db->prepare("INSERT INTO programas_estudio (nombre, descripcion) VALUES (:nombre, :descripcion)");
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':descripcion', $descripcion);
        return $stmt->execute();
    }

    public function getAllProgramas() {
        $stmt = $this->db->prepare("SELECT * FROM programas_estudio");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProgramaById($id) {
        $stmt = $this->db->prepare("SELECT * FROM programas_estudio WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updatePrograma($id, $nombre, $descripcion) {
        $stmt = $this->db->prepare("UPDATE programas_estudio SET nombre = :nombre, descripcion = :descripcion WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':descripcion', $descripcion);
        return $stmt->execute();
    }

    public function deletePrograma($id) {
        $stmt = $this->db->prepare("DELETE FROM programas_estudio WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>