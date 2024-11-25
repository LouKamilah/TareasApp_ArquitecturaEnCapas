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
        if ($this->user->login($email, $password)) {
            header("Location: ../capa_presentacion/home.php");
            exit();
        } else {
            echo "Login fallido";
        }
    }

    public function register($username, $email, $password) {
        if ($this->user->register($username, $email, $password)) {
            echo "Registro exitoso";
            return true;
        } else {
            echo "Registro fallido";
            return false;
        }
    }
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $controller = new LoginController();

    if (isset($_GET['action'])) {
        $action = $_GET['action'];

        if ($action == 'login') {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $controller->login($email, $password);

        } elseif ($action == 'register') {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            if ($controller->register($username, $email, $password)) {
                header("Location: ../capa_presentacion/index.php");
                exit();
            } else {
                echo "Registro fallido";
            }
        }
    } else {
        echo "Acción no definida";
    }
}

?>