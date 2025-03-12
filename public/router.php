<?php
/**
 * Enrutador para manejar peticiones ajax
 */

$controller = isset($_GET['controller']) ? $_GET['controller'] : 'equipo';
$action = isset($_GET['action']) ? $_GET['action'] : 'list';

$controllerFile = "../app/controllers/" . ucfirst($controller) . "Controller.php"; 

if (file_exists($controllerFile)) {
    require_once $controllerFile;
    $controllerClass = ucfirst($controller) . 'Controller'; 
    $controllerObject = new $controllerClass();

    //Valido las acciones para metodos POST
    $accionesPost = ['create', 'delete'];
    if (in_array($action, $accionesPost) && $_SERVER['REQUEST_METHOD'] !== 'POST'){
        echo json_encode(["success" => false, "error" => "Método no permitido"]);
        exit;
    }

    if (method_exists($controllerObject, $action)) {
        $controllerObject->$action();
    } else {
        echo "Error: Acción no encontrada.";
    }
} else {
    echo "Error: Controlador no encontrado.";
}