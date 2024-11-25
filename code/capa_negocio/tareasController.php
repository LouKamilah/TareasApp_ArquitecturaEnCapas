<?php
require_once '../capa_datos/conexion.php';
require_once '../capa_Datos/Tarea.php';
require_once '../capa_Datos/User.php';


class TareasController {
    private $db;

    // ojo con el constructor ¡¡NO OLVIDAR!! 👁️
    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function getTareasByUserId($user_id) {
        $tarea = new Tarea($this->db);
        return $tarea->getTareasByUserId($user_id);
    }

    public function editById($id_Tarea) {
        $tarea = new Tarea($this->db);
        return $tarea->editById($id_Tarea);
    }

    public function deleteById($id_Tarea) {
        $tarea = new Tarea($this->db);
        return $tarea->deleteById($id_Tarea);
    }
}

?>