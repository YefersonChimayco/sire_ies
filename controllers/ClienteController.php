<?php
require_once __DIR__ . '/../models/ClienteModel.php';

class ClienteController {
    private $model;

    public function __construct() {
        $this->model = new ClienteModel();
    }

    // Listado + creación
    public function gestion() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $ruc            = trim($_POST['ruc'] ?? '');
            $razon_social   = trim($_POST['razon_social'] ?? '');
            $telefono       = trim($_POST['telefono'] ?? null);
            $correo         = trim($_POST['correo'] ?? null);
            $fecha_registro = trim($_POST['fecha_registro'] ?? date('Y-m-d'));
            $estado         = isset($_POST['estado']) ? (int)$_POST['estado'] : 1;

            if ($this->model->createCliente($ruc, $razon_social, $telefono, $correo, $fecha_registro, $estado)) {
                $message = "✅ Cliente registrado exitosamente.";
            } else {
                $message = "❌ Error al registrar cliente.";
            }
        } else {
            $message = '';
        }

        $clientes = $this->model->getAllClientes();
        require_once __DIR__ . '/../views/clientes.php';
    }

    // Actualizar cliente
    public function updateCliente($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $ruc            = trim($_POST['ruc'] ?? '');
            $razon_social   = trim($_POST['razon_social'] ?? '');
            $telefono       = trim($_POST['telefono'] ?? null);
            $correo         = trim($_POST['correo'] ?? null);
            $fecha_registro = trim($_POST['fecha_registro'] ?? date('Y-m-d'));
            $estado         = isset($_POST['estado']) ? (int)$_POST['estado'] : 1;

            if ($this->model->updateCliente($id, $ruc, $razon_social, $telefono, $correo, $fecha_registro, $estado)) {
                header('Location: index.php?controller=cliente&action=gestion');
                exit;
            } else {
                $message = "❌ Error al actualizar cliente.";
            }
        }
        $cliente = $this->model->getClienteById($id);
        require_once __DIR__ . '/../views/clientes.php';
    }

    // Eliminar cliente
    public function deleteCliente($id) {
        if ($this->model->deleteCliente($id)) {
            header('Location: index.php?controller=cliente&action=gestion');
            exit;
        }
    }
}
