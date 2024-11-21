<?php
// src/controller/administradores/AdministradorCadastroController.php
include_once(dirname(__FILE__) . '/../../config.php');
include_once(dirname(__FILE__) . '/../../models/administradores/AdministradorModel.php');
include_once(dirname(__FILE__) . '/../../utils/FlashMessages.php');
$flash_messages = FlashMessages::getMessages();

function processarCadastroAdministrador($dadosAdministrador) {
    $modelA = new AdministradorModel();
    $modelA->cadastraAdministrador($dadosAdministrador);
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    header("Location: " . TEMPLATE_URL . "administradores/cadastro_adm.php");
    exit();
} else if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $modelA = new AdministradorModel();

    // Capturar o token enviado via POST
    $token = $_POST['token'];

    // Verificar se o token está disponível
    $TokenDisponivel = $modelA->verificaTokenDisponivel($token);

    // Exibir mensagem de sucesso ou erro com base na disponibilidade do token
    if ($TokenDisponivel) {
        FlashMessages::addMessage('success', 'Token disponível! Pode continuar com o cadastro.');

        // Verificar se as senhas coincidem
        if ($_POST['password1'] !== $_POST['password2']) {
            FlashMessages::addMessage('error', 'As senhas não coincidem.');
            header("Location: " . TEMPLATE_URL . "administradores/cadastro_adm.php");
            exit();
        }

        // Coletar dados do administrador
        $dadosAdministrador = [
            'id_adm' => $_POST['id_adm'],
            'codenome' => $_POST['codenome'],
            'password1' => $_POST['password1'],
            'data_engressou' => date('Y-m-d H:i:s'),
            'token' => $_POST['token'],
        ];

        // Processar o cadastro
        processarCadastroAdministrador($dadosAdministrador);

        // Redirecionar com mensagem de sucesso
        FlashMessages::addMessage('success', 'Administrador cadastrado com sucesso.');
        //header("Location: " . TEMPLATE_URL . "administradores/login_adm.php");
        exit();
    } else {
        // Exibir mensagem de erro se o token não estiver disponível
        FlashMessages::addMessage('error', 'Token inválido ou já em uso.');
        header("Location: " . TEMPLATE_URL . "administradores/cadastro_adm.php");
        exit();
    }
}