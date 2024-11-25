<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
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

    public function editById($id_Tarea, $titulo, $descripcion, $estado) {
        $tarea = new Tarea($this->db);
        return $tarea->editById($id_Tarea, $titulo, $descripcion, $estado);
    }

    public function getTareaById($id_Tarea) {
        $tarea = new Tarea($this->db);
        return $tarea->getById($id_Tarea); // Asume que el método getById existe en la capa de datos
    }

    public function deleteById($id_Tarea) {
        $tarea = new Tarea($this->db);
        return $tarea->deleteById($id_Tarea);
    }

    public function createTarea($titulo, $descripcion, $date_asig, $estado, $user_id) {
        $tarea = new Tarea($this->db);
        return $tarea->create($titulo, $descripcion, $date_asig, $estado, $user_id);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_GET['action']) && $_GET['action'] === 'editar_tarea') {
        $id_Tarea = $_POST['id_Tarea'];
        $titulo = $_POST['titulo'];
        $descripcion = $_POST['descripcion'];
        $estado = $_POST['estado'];

        $tareasController = new TareasController();
        $result = $tareasController->editById($id_Tarea, $titulo, $descripcion, $estado);

        if ($result) {
            header("Location: ../capa_presentacion/home.php");
        } else {
            echo "Error al actualizar la tarea.";
        }
    } elseif (isset($_GET['action']) && $_GET['action'] === 'eliminar_tarea') {
        $id_Tarea = $_POST['id_Tarea'];

        $tareasController = new TareasController();
        $result = $tareasController->deleteById($id_Tarea);

        if ($result) {
            header("Location: ../capa_presentacion/home.php");
        } else {
            echo "Error al eliminar la tarea.";
        }
    } elseif (isset($_GET['action']) && $_GET['action'] === 'crear_tarea') {
        $titulo = $_POST['titulo'];
        $descripcion = $_POST['descripcion'];
        $date_asig = $_POST['date_asig'];
        $estado = $_POST['estado'];
        $user_id = $_SESSION['user_id']; // Asegúrate de que 'user_id' esté en la sesión

        $tareasController = new TareasController();
        $result = $tareasController->createTarea($titulo, $descripcion, $date_asig, $estado, $user_id);

        if ($result) {
            header("Location: ../capa_presentacion/home.php");
        } else {
            echo "Error al crear la tarea.";
        }
    }
}

?>