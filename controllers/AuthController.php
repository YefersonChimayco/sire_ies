<?php
require_once __DIR__ . '/../models/UserModel.php';

class AuthController {
    private $model;

    public function __construct() {
        $this->model = new UserModel();
    }

    // ---- LOGIN ----
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
public function gestion() {
        $usuarios = $this->model->getAllUsers();
        include __DIR__ . '/../views/usuarios.php';
    }
    // ---- REGISTRO ----
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = trim($_POST['username'] ?? '');
            $password = trim($_POST['password'] ?? '');

            if ($this->model->register($username, $password)) {
                header('Location: index.php?controller=auth&action=login');
                exit;
            } else {
                $error = "Error al registrar usuario.";
                require_once __DIR__ . '/../views/register.php';
            }
        } else {
            $error = '';
            require_once __DIR__ . '/../views/register.php';
        }
    }

    // ---- DASHBOARD ----
    public function dashboard() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?controller=auth&action=login');
            exit;
        }
        require_once __DIR__ . '/../views/dashboard.php';
    }

    // ---- LOGOUT ----
    public function logout() {
        session_destroy();
        header('Location: index.php?controller=auth&action=login');
        exit;
    }
}
