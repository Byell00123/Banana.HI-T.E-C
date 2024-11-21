<?php
// src/controllers/VendedorCadastroController.php
include_once(dirname(__FILE__) . '/../config.php');
include_once(dirname(__FILE__) . '/../models/VendedorModel.php');
include_once(dirname(__FILE__) . '/../utils/FlashMessages.php');

class VendedorCadastroController {
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
        // Verificar se as senhas coincidem
        if ($_POST['password1'] !== $_POST['password2']) {
            FlashMessages::addMessage('error', 'As senhas não coincidem.');
            $this->redirectBack();
        }
        if( $senha = $_POST['password1']){;
            // Função de validação usando regex
        if (!preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@*_-]).{8,}$/', $senha)) {
            FlashMessages::addMessage('error', 'A senha deve ter no mínimo 8 caracteres, incluir pelo menos uma letra maiúscula, um número e um caractere especial.');
            $this->redirectBack();
            }
        }

        // Coletar dados do vendedor
        $dadosVendedor = [
            'cnpj' => $_POST['cnpj'],
            'nome_fantasia' => $_POST['nome_fantasia'],
            'password1' => $_POST['password1'],
            'email' => $_POST['email'],
            'telefone' => $_POST['telefone'],
            'data_engressou' => date('Y-m-d H:i:s') // Adicionando a data de registro
        ];

        $this->processarCadastroVendedor($dadosVendedor);
    }

    private function processarCadastroVendedor($dadosVendedor) {
        $this->model->cadastraVendedor($dadosVendedor); // Chama a função de cadastro
        FlashMessages::addMessage('success', 'Vendedor cadastrado com sucesso!');
        header("Location: " . TEMPLATE_URL . "home/home_v.php"); // Redireciona para a home do vendedor
        exit();
    }

    private function redirectBack() {
        header("Location: " . TEMPLATE_URL . "cadastro-login/cadastro_v.php");
        exit();
    }
}

$controller = new VendedorCadastroController();
$controller->handleRequest();
?>
