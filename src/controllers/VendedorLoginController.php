<?php
// src/controllers/VendedorLoginController.php
include_once(dirname(__FILE__) . '/../config.php');
include_once(dirname(__FILE__) . '/../models/VendedorModel.php');
include_once(dirname(__FILE__) . '/../utils/FlashMessages.php');

class VendedorLoginController {
    private $model;

    public function __construct() {
        $this->model = new VendedorModel();
    }

    public function handleRequest() {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $this->MetodoGET();
        } elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->MetodoPost();
        }
    }

    private function MetodoGET() {
        // Verifica se o vendedor está logado
        if ($this->model->isVendedorLogado()) {
            FlashMessages::addMessage('error', "Você já está logado como vendedor.");
            header("Location: " . TEMPLATE_URL . "home/home_v.php?marca=" . urlencode($_SESSION["user_nome_fantasia"]));
            exit();
        }
    }

    private function MetodoPost() {
        // Verifique se as chaves existem
        $cnpj = isset($_POST['cnpj']) ? $_POST['cnpj'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';

        if ($this->model->loginVendedor($cnpj, $password)) {
            FlashMessages::addMessage('success', 'Login realizado com sucesso!');
            $this->model->atualizarUltimoLogin2($cnpj);
            header("Location: " . TEMPLATE_URL . "home/home_v.php?marca=" . urlencode($_SESSION['user_nome_fantasia']));
            exit();
        } else {
            FlashMessages::addMessage('error', 'Nome do vendedor ou senha incorretos.');
            $this->redirectBack();
        }
    }

    private function redirectBack() {
        header("Location: " . TEMPLATE_URL . "cadastro-login/login_v.php");
        exit();
    }
}

$controller = new VendedorLoginController();
$controller->handleRequest();
?>
