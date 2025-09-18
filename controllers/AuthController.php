<?php
require_once __DIR__ . '/../models/UserModel.php';

class AuthController {
    private $model;

    public function __construct() {
        $this->model = new UserModel();
    }

    // ---- LOGIN ----
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            $user = $this->model->login($username, $password);

            if ($user) {
                $_SESSION['user'] = $user;
                header("Location: index.php?controller=auth&action=dashboard");
                exit;
            } else {
                $message = "❌ Usuario o contraseña incorrectos";
                include __DIR__ . '/../views/login.php';
            }
        } else {
            include __DIR__ . '/../views/login.php';
        }
    }

    // ---- LOGOUT ----
    public function logout() {
        session_destroy();
        header("Location: index.php?controller=auth&action=login");
        exit;
    }

    // ---- DASHBOARD ----
    public function dashboard() {
        if (!isset($_SESSION['user'])) {
            header("Location: index.php?controller=auth&action=login");
            exit;
        }
        include __DIR__ . '/../views/dashboard.php';
    }

    // ---- LISTA DE USUARIOS ----
    public function gestion() {
        if (!isset($_SESSION['user'])) {
            header("Location: index.php?controller=auth&action=login");
            exit;
        }

        $usuarios = $this->model->getAllUsers();
        include __DIR__ . '/../views/usuarios.php';
    }

    // ---- ELIMINAR USUARIO ----
    public function deleteUser($id) {
        if (!isset($_SESSION['user'])) {
            header("Location: index.php?controller=auth&action=login");
            exit;
        }

        $this->model->deleteUser($id);
        header("Location: index.php?controller=auth&action=gestion");
        exit;
    }
}
