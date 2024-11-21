<?php
// src/controllers/CadastroController.php
include_once(dirname(__FILE__) . '/../config.php');
include_once(dirname(__FILE__) . '/../models/UsuarioModel.php');
include_once(dirname(__FILE__) . '/../utils/FlashMessages.php');

class UsuarioCadastroController {
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

        // Coletar dados do usuário
        $dadosUsuario = [
            'apelido' => $_POST['username'],
            'password1' => $_POST['password1'],
            'primeiro_nome' => $_POST['primeiro_nome'],
            'sobrenome' => $_POST['sobrenome'],
            'nascimento' => $_POST['nascimento'],
            'email' => $_POST['email'],
            'telefone' => $_POST['telefone'],
            'sexo' => $_POST['sexo'],
            'cpf' => $_POST['cpf'],
            'data_engressou' => date('Y-m-d H:i:s') // Adicionando a data de registro
        ];

        $this->processarCadastroUsuario($dadosUsuario);
    }

    private function processarCadastroUsuario($dadosUsuario) {
        $this->model->cadastraUsuario($dadosUsuario); // Chama a função de cadastro
        FlashMessages::addMessage('success', 'Usuário cadastrado com sucesso!');
        header("Location: " . TEMPLATE_URL . "home/home_u.php"); // Redireciona para a home do usuário
        exit();
    }

    private function redirectBack() {
        header("Location: " . TEMPLATE_URL . "cadastro-login/cadastro_u.php");
        exit();
    }
}

$controller = new UsuarioCadastroController();
$controller->handleRequest();
?>
