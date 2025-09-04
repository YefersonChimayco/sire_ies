<?php
require_once __DIR__ . '/../models/UserModel.php';

class AuthController {
    private $model;

    public function __construct() {
        $this->model = new UserModel();
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = trim($_POST['username'] ?? '');
            $password = trim($_POST['password'] ?? '');
            $user = $this->model->login($username, $password);
            if ($user) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                header('Location: index.php?controller=auth&action=dashboard');
                exit;
            } else {
                $error = "Usuario o contraseña incorrectos.";
                require_once __DIR__ . '/../views/login.php';
            }
        } else {
            $error = '';
            require_once __DIR__ . '/../views/login.php';
        }
    }

    public function dashboard() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?controller=auth&action=login');
            exit;
        }
        require_once __DIR__ . '/../views/dashboard.php';
    }

    public function logout() {
        session_destroy();
        header('Location: index.php?controller=auth&action=login');
        exit;
    }
}
?>