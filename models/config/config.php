<?php

const BD_HOST     = 'localhost';
const BD_NAME     = 'sire';
const BD_USER     = 'root';
const BD_PASSWORD = '';
const BD_CHARSET  = 'utf8mb4';


const BASE_URL        = 'http://localhost/sire/';
const BASE_URL_SERVER = 'http://localhost/sire/';


// CONEXIÓN 

class Database {
    private $conn;

    public function connect() {
        try {
            $dsn = "mysql:host=" . BD_HOST . ";dbname=" . BD_NAME . ";charset=" . BD_CHARSET;
            $this->conn = new PDO($dsn, BD_USER, BD_PASSWORD);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
        return $this->conn;
    }
}
?>
