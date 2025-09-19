<?php
require_once __DIR__ . '/../config/config.php';

class EstudianteModel {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
    }

    public function createEstudiante($dni, $nombres, $apellido_paterno, $apellido_materno, $estado, $semestre, $programa_id, $fecha_matricula) {
        $stmt = $this->db->prepare("INSERT INTO estudiantes (dni, nombres, apellido_paterno, apellido_materno, estado, semestre, programa_id, fecha_matricula) VALUES (:dni, :nombres, :apellido_paterno, :apellido_materno, :estado, :semestre, :programa_id, :fecha_matricula)");
        $stmt->bindParam(':dni', $dni);
        $stmt->bindParam(':nombres', $nombres);
        $stmt->bindParam(':apellido_paterno', $apellido_paterno);
        $stmt->bindParam(':apellido_materno', $apellido_materno);
        $stmt->bindParam(':estado', $estado);
        $stmt->bindParam(':semestre', $semestre, PDO::PARAM_INT);
        $stmt->bindParam(':programa_id', $programa_id, PDO::PARAM_INT);
        $stmt->bindParam(':fecha_matricula', $fecha_matricula);
        return $stmt->execute();
    }

    public function getAllEstudiantes() {
        $stmt = $this->db->prepare("SELECT * FROM estudiantes ORDER BY apellido_paterno, apellido_materno, nombres");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getEstudianteByDni($dni) {
        $stmt = $this->db->prepare("SELECT * FROM estudiantes WHERE dni = :dni");
        $stmt->bindParam(':dni', $dni);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateEstudiante($dni, $nombres, $apellido_paterno, $apellido_materno, $estado, $semestre, $programa_id, $fecha_matricula) {
        $stmt = $this->db->prepare("UPDATE estudiantes SET nombres = :nombres, apellido_paterno = :apellido_paterno, apellido_materno = :apellido_materno, estado = :estado, semestre = :semestre, programa_id = :programa_id, fecha_matricula = :fecha_matricula WHERE dni = :dni");
        $stmt->bindParam(':dni', $dni);
        $stmt->bindParam(':nombres', $nombres);
        $stmt->bindParam(':apellido_paterno', $apellido_paterno);
        $stmt->bindParam(':apellido_materno', $apellido_materno);
        $stmt->bindParam(':estado', $estado);
        $stmt->bindParam(':semestre', $semestre, PDO::PARAM_INT);
        $stmt->bindParam(':programa_id', $programa_id, PDO::PARAM_INT);
        $stmt->bindParam(':fecha_matricula', $fecha_matricula);
        return $stmt->execute();
    }

    public function deleteEstudiante($dni) {
        $stmt = $this->db->prepare("DELETE FROM estudiantes WHERE dni = :dni");
        $stmt->bindParam(':dni', $dni);
        return $stmt->execute();
    }

    // Nuevos métodos para búsqueda
    public function buscarPorDni($dni) {
        $stmt = $this->db->prepare("SELECT * FROM estudiantes WHERE dni LIKE :dni ORDER BY apellido_paterno, apellido_materno, nombres");
        $search_term = "%$dni%";
        $stmt->bindParam(':dni', $search_term);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorNombre($nombre) {
        $stmt = $this->db->prepare("SELECT * FROM estudiantes WHERE nombres LIKE :nombre OR apellido_paterno LIKE :nombre OR apellido_materno LIKE :nombre ORDER BY apellido_paterno, apellido_materno, nombres");
        $search_term = "%$nombre%";
        $stmt->bindParam(':nombre', $search_term);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>