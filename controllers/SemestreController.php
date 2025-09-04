<?php
require_once __DIR__ . '/../models/SemestreModel.php';

class SemestreController {
    private $model;

    public function __construct() {
        $this->model = new SemestreModel();
    }

    public function gestion() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $descripcion = trim($_POST['descripcion'] ?? '');

            if ($this->model->createSemestre($descripcion)) {
                $message = "Semestre registrado exitosamente.";
            } else {
                $message = "Error al registrar semestre.";
            }
        } else {
            $message = '';
        }

        $semestres = $this->model->getAllSemestres();
        require_once __DIR__ . '/../views/semestres.php';
    }

    public function updateSemestre($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $descripcion = trim($_POST['descripcion'] ?? '');

            if ($this->model->updateSemestre($id, $descripcion)) {
                $message = "Semestre actualizado exitosamente.";
                header('Location: index.php?controller=semestre&action=gestion');
                exit;
            } else {
                $message = "Error al actualizar semestre.";
            }
        }
        $semestre = $this->model->getSemestreById($id);
        require_once __DIR__ . '/../views/semestres.php';
    }

    public function deleteSemestre($id) {
        if ($this->model->deleteSemestre($id)) {
            $message = "Semestre eliminado exitosamente.";
            header('Location: index.php?controller=semestre&action=gestion');
            exit;
        }
    }
}
?>