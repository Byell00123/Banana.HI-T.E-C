<?php
// controller/CadastroController.php
include_once(dirname(__FILE__) . '/../config.php');
include_once(dirname(__FILE__) . '/../models/UsuarioModel.php');
include_once(dirname(__FILE__) . '/../utils/FlashMessages.php');
$flash_messages = FlashMessages::getMessages();

function processarCadastroUsuario($dadosUsuario) {
    $userModel = new UserModel(); // Instancia a classe UserModel
    $userModel->cadastraUsuario($dadosUsuario); // Chama a função de cadastro
}
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    header("Location: " . TEMPLATE_URL . "cadastro-login/cadastro_u.php");
    exit();
} else if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar se as senhas coincidem
    if ($_POST['password1'] !== $_POST['password2']) {
        FlashMessages::addMessage('error', 'As senhas não coincidem.');
        header("Location: " . TEMPLATE_URL . "cadastro-login/cadastro_u.php");
        exit(); // Para o processamento se as senhas não coincidirem
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

    processarCadastroUsuario($dadosUsuario);
}
?>
