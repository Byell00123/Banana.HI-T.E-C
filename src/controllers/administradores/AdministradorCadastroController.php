<?php
// controller/CadastroController.php
include_once(dirname(__FILE__) . '/../config.php');

include_once(dirname(__FILE__) . '/../models/AdministradoresModel.php');

include_once(dirname(__FILE__) . '/../utils/FlashMessages.php');

function processarCadastroAdministrador($dadosAdministrador) {
    $userModel = new AdministradorModel(); // Instancia a classe UserModel
    $userModel->cadastraAdministrador($dadosAdministrador); // Chama a função de cadastro
}
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    header("Location: " . TEMPLATE_URL . "administradores/cadastro_adm.php");
    exit();
} else if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar se as senhas coincidem
    if ($_POST['password1'] !== $_POST['password2']) {
        FlashMessages::addMessage('error', 'As senhas não coincidem.');
        header("Location: " . TEMPLATE_URL . "administradores/cadastro_adm.php");
        exit(); // Para o processamento se as senhas não coincidirem
    }

    // Coletar dados do usuário
    $dadosAdministrador = [
        'codenome' => $_POST['username'],
        'password1' => $_POST['password1'],
        'id_adm' =>  $_POST['id_adm'],
        'data_engressou' => date('Y-m-d H:i:s') // Adicionando a data de registro
    ];

    processarCadastroAdministrador($dadosAdministrador);
}
?>
