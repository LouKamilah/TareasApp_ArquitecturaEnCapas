<?php
require_once '../capa_datos/conexion.php';
require_once '../capa_Datos/User.php';

class LoginController {
    private $user;

    // ojo con el constructor ¡¡NO OLVIDAR!! 👁️
    public function __construct() {
        $database = new Database();
        $db = $database->getConnection();
        $this->user = new User($db);
    }

    public function login($email, $password) {
        $user = $this->user->login($email, $password);
        if ($user) {
            session_start();
            $_SESSION['user_id'] = $user['id']; // Almacena el user_id en la sesión
            header("Location: ../capa_presentacion/home.php");
            exit();
        } else {
            echo "Login fallido";
        }
    }

    public function register($username, $email, $password) {
        if ($this->user->register($username, $email, $password)) {
            echo "Registro exitoso";
        } else {
            echo "Registro fallido";
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $controller = new LoginController();

    $action = $_POST['action'];
    if ($action == 'login') {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $controller->login($email, $password);
    }
}

//$controller = new LoginController();


?>