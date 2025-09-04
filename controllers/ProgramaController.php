<?php
require_once __DIR__ . '/../models/ProgramaModel.php';

class ProgramaController {
    private $model;

    public function __construct() {
        $this->model = new ProgramaModel();
    }

    public function gestion() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombre = trim($_POST['nombre'] ?? '');
            $descripcion = trim($_POST['descripcion'] ?? null);

            if ($this->model->createPrograma($nombre, $descripcion)) {
                $message = "Programa registrado exitosamente.";
            } else {
                $message = "Error al registrar programa.";
            }
        } else {
            $message = '';
        }

        $programas = $this->model->getAllProgramas();
        require_once __DIR__ . '/../views/programas.php';
    }

    public function updatePrograma($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombre = trim($_POST['nombre'] ?? '');
            $descripcion = trim($_POST['descripcion'] ?? null);

            if ($this->model->updatePrograma($id, $nombre, $descripcion)) {
                $message = "Programa actualizado exitosamente.";
                header('Location: index.php?controller=programa&action=gestion');
                exit;
            } else {
                $message = "Error al actualizar programa.";
            }
        }
        $programa = $this->model->getProgramaById($id);
        require_once __DIR__ . '/../views/programas.php';
    }

    public function deletePrograma($id) {
        if ($this->model->deletePrograma($id)) {
            $message = "Programa eliminado exitosamente.";
            header('Location: index.php?controller=programa&action=gestion');
            exit;
        }
    }
}
?>