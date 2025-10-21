<?php
require_once __DIR__ . '/../config/config.php';

class ApiModelo {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
    }

    public function buscarEstudiantesAPI($dni = '', $nombre = '', $apellido = '', $limite = 50) {
        $sql = "SELECT 
                    e.dni,
                    e.nombres,
                    e.apellido_paterno,
                    e.apellido_materno,
                    e.estado,
                    e.semestre,
                    e.programa_id,
                    e.fecha_matricula,
                    p.nombre as programa_nombre,
                    s.descripcion as semestre_nombre
                FROM estudiantes e
                LEFT JOIN programas_estudio p ON e.programa_id = p.id
                LEFT JOIN semestres_lista s ON e.semestre = s.id
                WHERE 1=1";
        
        $parametros = [];
        
        // Búsqueda por DNI exacto
        if (!empty($dni)) {
            $sql .= " AND e.dni = :dni";
            $parametros[':dni'] = $dni;
        }
        
        // Búsqueda por nombre (en nombres, apellido paterno o materno)
        if (!empty($nombre)) {
            $sql .= " AND (e.nombres LIKE :nombre OR e.apellido_paterno LIKE :nombre OR e.apellido_materno LIKE :nombre)";
            $parametros[':nombre'] = '%' . $nombre . '%';
        }
        
        // Búsqueda por apellido (en paterno o materno)
        if (!empty($apellido)) {
            $sql .= " AND (e.apellido_paterno LIKE :apellido OR e.apellido_materno LIKE :apellido)";
            $parametros[':apellido'] = '%' . $apellido . '%';
        }
        
        // Orden y límite
        $sql .= " ORDER BY e.apellido_paterno, e.apellido_materno, e.nombres";
        $sql .= " LIMIT :limite";
        $parametros[':limite'] = $limite;
        
        try {
            $stmt = $this->db->prepare($sql);
            
            // Vincular parámetros
            foreach ($parametros as $clave => $valor) {
                if ($clave === ':limite') {
                    $stmt->bindValue($clave, (int)$valor, PDO::PARAM_INT);
                } else {
                    $stmt->bindValue($clave, $valor);
                }
            }
            
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
            
        } catch (PDOException $e) {
            error_log("Error en buscarEstudiantesAPI: " . $e->getMessage());
            return [];
        }
    }

    public function validarClienteAPI($token) {
        $stmt = $this->db->prepare("
            SELECT c.*, t.id as token_id 
            FROM Client_API c
            INNER JOIN Tokens t ON c.id = t.id_client_api
            WHERE t.token = :token AND t.estado = 1 AND c.estado = 1
        ");
        
        $stmt->bindParam(":token", $token);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>