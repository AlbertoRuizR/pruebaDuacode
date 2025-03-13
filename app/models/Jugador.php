<?php

/**
 * Modelo de Jugadores
 * Contiene todas las consultas y configuraciones de la tabla jugadores
 */
require_once __DIR__ . '/../../config/database.php';

class Jugador
{
    private $db;
    private $conn;
    private $data = [];

    public function __construct()
    {
        $this->db = new Database();
        $this->conn = $this->db->connect();
    }

    /**
     * Función para simplificar el metodo setter en la creación/edición
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * Crear un jugador
     * @return bool
     */
    public function create()
    {
        $query = "INSERT INTO jugadores (nombre, numero, equipo_id, capitan) VALUES (:nombre, :numero, :equipo_id, :capitan)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute($this->data);
    }

    /**
     * Obtener todos los jugadores
     * @param $equipoId
     * @return array
     */
    public function getAllByEquipo($equipoId)
    {
        $query = "SELECT * FROM jugadores WHERE equipo_id = :equipoId";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':equipoId', $equipoId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Obtener capitán/es
     * Puede haber varios capitanes por equipo
     * @param $equipoId
     * @return array
     */
    public function getCapitanByEquipo($equipoId)
    {
        $query = "SELECT * FROM jugadores WHERE equipo_id = :equipoId and capitan = 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':equipoId', $equipoId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Actualizar jugador
     * @return bool
     */
    public function update()
    {
        $query = "UPDATE jugadores SET nombre = :nombre, numero = :numero, capitan = :capitan WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute($this->data);
    }

    /**
     * Eliminar Jugador
     * @return bool
     */
    public function delete($id)
    {
        $query = "DELETE FROM jugadores WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
