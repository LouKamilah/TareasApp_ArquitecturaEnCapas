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
            session_start();
            $_SESSION['login_error'] = true;
            header("Location: ../capa_presentacion/index.php");
            exit();
        }
    }

    public function register($username, $email, $password) {
        if ($this->user->register($username, $email, $password)) {
            session_start();
            $_SESSION['register_success'] = true;
            header("Location: ../capa_presentacion/register.php");
            exit();
        } else {
            echo "Registro fallido";
            return false;
        }
    }
}

//Pasar a las funciones los datos recibidos por POST
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
            $controller->register($username, $email, $password);
        }
    } else {
        echo "Acción no definida";
    }
}

?>