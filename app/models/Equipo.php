<?php

/**
 * Modelo de Equipos
 * Contiene todas las consultas y configuraciones de la tabla equipos
 */
require_once __DIR__ . '/../../config/database.php';

class Equipo
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
     * Función para simplificar el metodo setter en la creación
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * Creacción de equipos
     * @return bool
     */
    public function create()
    {
        $query = "INSERT INTO equipos (nombre, ciudad, deporte, fecha_fundacion) VALUES (:nombre, :ciudad, :deporte, :fechaFundacion)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute($this->data);
    }

    /**
     * Obtener 1 o todos los equipos
     * Depende de si la variable llega a null o no
     * @param $id
     * @return array
     */
    public function get($id = null)
    {
        $query = "SELECT * FROM equipos";

        //Añadir where si llega un id
        if ($id) {
            $query .= " WHERE id = :id";
        }

        $stmt = $this->conn->prepare($query);

        if ($id) {
            $stmt->bindParam(':id', $id);
        }

        $stmt->execute();

        //Si hay varios resultados devolver un array
        return $id ? $stmt->fetch(PDO::FETCH_ASSOC) : $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Eliminar un equipo
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        $query = "DELETE FROM equipos WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
