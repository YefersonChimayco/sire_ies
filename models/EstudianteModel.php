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

 // Agregar este método a la clase EstudianteModel
public function buscarEstudiantesAPI($dni = '', $nombre = '', $apellido = '', $limit = 50) {
    $sql = "SELECT 
                e.dni,
                e.nombres,
                e.apellido_paterno,
                e.apellido_materno,
                e.estado,
                e.semestre,
                e.programa_id,
                e.fecha_matricula,
                p.nombre as programa_nombre
            FROM estudiantes e
            LEFT JOIN programas_estudio p ON e.programa_id = p.id
            WHERE 1=1";
    
    $params = [];
    
    // Búsqueda por DNI exacto
    if (!empty($dni)) {
        $sql .= " AND e.dni = :dni";
        $params[':dni'] = $dni;
    }
    
    // Búsqueda por nombre (en nombres, apellido paterno o materno)
    if (!empty($nombre)) {
        $sql .= " AND (e.nombres LIKE :nombre OR e.apellido_paterno LIKE :nombre OR e.apellido_materno LIKE :nombre)";
        $params[':nombre'] = '%' . $nombre . '%';
    }
    
    // Búsqueda por apellido (en paterno o materno)
    if (!empty($apellido)) {
        $sql .= " AND (e.apellido_paterno LIKE :apellido OR e.apellido_materno LIKE :apellido)";
        $params[':apellido'] = '%' . $apellido . '%';
    }
    
    // Orden y límite
    $sql .= " ORDER BY e.apellido_paterno, e.apellido_materno, e.nombres";
    $sql .= " LIMIT :limit";
    $params[':limit'] = $limit;
    
    try {
        $stmt = $this->db->prepare($sql);
        
        // Bind parameters
        foreach ($params as $key => $value) {
            if ($key === ':limit') {
                $stmt->bindValue($key, (int)$value, PDO::PARAM_INT);
            } else {
                $stmt->bindValue($key, $value);
            }
        }
        
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        
    } catch (PDOException $e) {
        error_log("Error en buscarEstudiantesAPI: " . $e->getMessage());
        return [];
    }
}
}
?>