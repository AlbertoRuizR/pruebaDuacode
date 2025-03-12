<?php
/**
 * Configuración y conexión de la base de datos
 */
class Database {
    private $host = 'localhost';
    private $user = 'root';
    private $pass = '';
    private $db = 'duacode';
    private $conn;

    public function connect() {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db . ";charset=utf8", $this->user, $this->pass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            die("Error de conexión: " . $exception->getMessage());
        }

        return $this->conn;
    }
}