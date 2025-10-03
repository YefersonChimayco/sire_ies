<?php
require_once __DIR__ . '/../models/TokenModel.php';

class TokenController {
    private $model;

    public function __construct() {
        $this->model = new TokenModel();
    }

    // Gestión de tokens (listar y crear)
    public function gestion() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id_client_api = intval($_POST['id_client_api'] ?? 0);
            $token = bin2hex(random_bytes(16)).'-'.$id_client_api;
            $fecha_registro = trim($_POST['fecha_reg'] ?? date("Y-m-d"));
            $estado = intval($_POST['estado'] ?? 1);

            if ($this->model->createToken($id_client_api, $token, $fecha_registro, $estado)) {
                $message = "Token registrado exitosamente.";
            } else {
                $message = "Error al registrar token.";
            }
        } else {
            $message = '';
        }

        $tokens = $this->model->getAllTokens();
        $clientes = $this->model->getAllClientes(); // ✅ corregido
        require_once __DIR__ . '/../views/tokens.php';
    }

    // Actualizar token
    public function updateToken($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id_client_api = intval($_POST['id_client_api'] ?? 0);
            $token = bin2hex(random_bytes(16)).'-'.$id_client_api;
            $fecha_registro = trim($_POST['fecha_reg'] ?? date("Y-m-d"));
            $estado = intval($_POST['estado'] ?? 1);

            if ($this->model->updateToken($id, $id_client_api, $token, $fecha_registro, $estado)) {
                $message = "Token actualizado exitosamente.";
                header('Location: index.php?controller=token&action=gestion');
                exit;
            } else {
                $message = "Error al actualizar token.";
            }
        }

        $tokenData = $this->model->getTokenById($id);
        $clientes = $this->model->getAllClientes(); // ✅ corregido
        require_once __DIR__ . '/../views/tokens.php';
    }

    // Eliminar token
    public function deleteToken($id) {
        if ($this->model->deleteToken($id)) {
            $message = "Token eliminado exitosamente.";
            header('Location: index.php?controller=token&action=gestion');
            exit;
        }
    }
}
// buscar estudiante
if ($tipo="verEs(tudianteByNombre") {
$token= explode ("-", $token);
$id_client_api = $token_arr[1];
$arr_Cliente = $objApi->buscarEstudianteById($id_estudiante) ;
if ($arr_Cliente->estado) {
    $data=$_POST['data'];
    $arr_estudiantes = $objApi->
} else {
    # code...
}

}
?>
