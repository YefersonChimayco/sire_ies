<?php
require_once __DIR__ . '/../config/config.php';

class SemestreModel {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
    }

    public function createSemestre($descripcion) {
        $stmt = $this->db->prepare("INSERT INTO semestres_lista (descripcion) VALUES (:descripcion)");
        $stmt->bindParam(':descripcion', $descripcion);
        return $stmt->execute();
    }

    public function getAllSemestres() {
        $stmt = $this->db->prepare("SELECT * FROM semestres_lista");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getSemestreById($id) {
        $stmt = $this->db->prepare("SELECT * FROM semestres_lista WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateSemestre($id, $descripcion) {
        $stmt = $this->db->prepare("UPDATE semestres_lista SET descripcion = :descripcion WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':descripcion', $descripcion);
        return $stmt->execute();
    }

    public function deleteSemestre($id) {
        $stmt = $this->db->prepare("DELETE FROM semestres_lista WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>