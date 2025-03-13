<?php

/**
 * Controlador de Jugadores
 */
require_once __DIR__ . '/../models/Jugador.php';

class JugadorController
{
    private $jugador;

    public function __construct()
    {
        $this->jugador = new Jugador();
    }

    /**
     * Crear un jugador
     * Llamado desde ajax
     * @return string
     */
    public function create()
    {
        $nombre = trim($_POST['nombre']);
        $numero = trim($_POST['numero']);
        $equipo_id = $_POST['equipo_id'];
        $capitan = isset($_POST['capitan']) ? 1 : 0;
        $errores = [];

        if (empty($nombre)) $errores[] = "El nombre es obligatorio.";
        if (empty($numero)) $errores[] = "El número es obligatorio.";
        if (empty($equipo_id)) $errores[] = "El equipo es obligatorio.";

        if (!empty($errores)) {
            echo json_encode(["success" => false, "error" => implode("<br>", $errores)]);
            return;
        }

        $this->jugador->setData([
            'nombre' => $nombre,
            'numero' => $numero,
            'equipo_id' => $equipo_id,
            'capitan' => $capitan
        ]);

        if ($this->jugador->create()) {
            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["success" => false, "error" => "Error al insertar en la base de datos."]);
        }
    }

    /**
     * Obtener todos los jugadores por equipo
     * @param $equipoId
     * @return string
     */
    public function list()
    {
        $idEquipo = $_GET['id'];
        $jugadores = $this->jugador->getAllByEquipo($idEquipo);
        include __DIR__ . '/../views/jugadores/tabla.php';
    }

    /**
     * Obtener el/los capitán/es por equipo
     * @param $equipoId
     * @return string
     */
    public function getCapitan()
    {
        $idEquipo = $_GET['id'];
        $jugadores = $this->jugador->getCapitanByEquipo($idEquipo);
        include __DIR__ . '/../views/jugadores/tabla.php';
    }

    /**
     * Editar un jugador
     * Llamado desde ajax
     * @return string
     */
    public function update()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $id = $_POST['id'];
            $nombre = trim($_POST['nombre']);
            $numero = trim($_POST['numero']);
            $capitan = isset($_POST['capitan']) ? 1 : 0;
            $errores = [];

            if (empty($nombre)) $errores[] = "El nombre es obligatorio.";
            if (empty($numero)) $errores[] = "El número es obligatorio.";

            if (!empty($errores)) {
                echo json_encode(["success" => false, "error" => implode("<br>", $errores)]);
                return;
            }

            $this->jugador->setData([
                'id' => $id,
                'nombre' => $nombre,
                'numero' => $numero,
                'capitan' => $capitan
            ]);

            if ($this->jugador->update()) {
                echo json_encode(["success" => true]);
            } else {
                echo json_encode(["success" => false, "error" => "Error al actualizar."]);
            }
        }
    }

    /**
     * Eliminar jugador
     * @return bool
     */
    public function delete()
    {
        $id = $_POST['id'];

        if ($this->jugador->delete($id)) {
            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["success" => false, "error" => "No se pudo eliminar el jugador."]);
        }
    }
}
