<?php
/**
 * Controlador de Equipos
 */
require_once __DIR__ . '/../models/Equipo.php';

class EquipoController {
    private $equipo;

    public function __construct() {
        $this->equipo = new Equipo();
    }

    /**
     * Crear un equipo
     * Llamado desde ajax
     * @return
     */
    public function create() {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $nombre = trim($_POST['nombre']);
            $ciudad = trim($_POST['ciudad']);
            $deporte = $_POST['deporte'];
            $fechaFundacion = $_POST['fecha'];
            $errores = [];
    
            // Validaciones
            if (empty($nombre)) $errores[] = "El nombre es obligatorio.";
            if (empty($ciudad)) $errores[] = "La ciudad es obligatoria.";
            if (empty($deporte)) $errores[] = "El deporte es obligatorio.";
            if (empty($fechaFundacion)) $errores[] = "La fecha de fundación es obligatoria.";
    
            if (!empty($errores)) {
                echo json_encode(["success" => false, "error" => implode("<br>", $errores)]);
                return;
            }
    
            $this->equipo->setData([
                'nombre' =>$nombre,
                'ciudad' =>$ciudad,
                'deporte' =>$deporte,
                'fechaFundacion' =>$fechaFundacion
            ]);
    
            if ($this->equipo->create()) {
                echo json_encode(["success" => true]);
            } else {
                echo json_encode(["success" => false, "error" => "Error al insertar en la base de datos."]);
            }
        }
    }

    /**
     * Mostrar todos los equipos
     * @return string
     */
    public function list() {
        $equipos = $this->equipo->get();

        //Inlcuyo la vista de la tabla
        include __DIR__ . '/../views/equipos/tabla.php';
    }

    /**
     * Eliminar un equipo
     * @param $id
     * @return bool
     */
    public function delete(){
        $id = intval($_POST['id']);

        if ($this->equipo->delete($id)) {
            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["success" => false, "error" => "No se pudo eliminar el equipo."]);
        }
    }

    /**
     * Obtener los datos de un equipo
     */
    public function info(){
        $id = isset($_GET['id']) ? $_GET['id'] : null;

        if ($id) {
            $equipo = $this->equipo->get($id);

            include __DIR__ . '/../views/equipos/info.php';
        }
    }
}