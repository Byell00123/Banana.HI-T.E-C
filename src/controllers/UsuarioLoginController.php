<?php
// src/controllers/UsuarioLoginController.php
include_once(dirname(__FILE__) . '/../config.php');
include_once(dirname(__FILE__) . '/../models/UsuarioModel.php');
include_once(dirname(__FILE__) . '/../utils/FlashMessages.php');

class UsuarioLoginController {
    private $model;

    public function __construct() {
        $this->model = new UsuarioModel();
    }

    public function handleRequest() {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $this->MetodoGET();
        } elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->MetodoPost();
        }
    }

    private function MetodoGET() {
        // Verifica se o usuario está logado
        if ($this->model->isUsuarioLogado()) {
            FlashMessages::addMessage('error', "Você já está logado como usuario.");
            header("Location: " . TEMPLATE_URL . "home/home_u.php");
            exit();
        }
    }

    private function MetodoPost() {
        // Verifique se as chaves existem
        $apelido = isset($_POST['apelido']) ? $_POST['apelido'] : '';
        $senha = isset($_POST['senha']) ? $_POST['senha'] : '';

        if ($this->model->loginUsuario($apelido, $senha)) {
            FlashMessages::addMessage('success', 'Login realizado com sucesso!');
            $this->model->atualizarUltimoLogin($_SESSION['user_apelido'],$_SESSION['user_email']);
            header("Location: " . TEMPLATE_URL . "home/home_u.php");
            exit();
        } else {
            FlashMessages::addMessage('error', 'Nome de usuário ou senha incorretos.');
            $this->redirectBack();
        }
    }

    private function redirectBack() {
        header("Location: " . TEMPLATE_URL . "cadastro-login/login_u.php");
        exit();
    }
}

$controller = new UsuarioLoginController();
$controller->handleRequest();
?>