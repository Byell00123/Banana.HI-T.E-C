<?php
// controller/CadastroController.php
include_once(dirname(__FILE__) . '/../config.php');
include_once(dirname(__FILE__) . '/../models/VendedorModel.php'); 

function processarCadastroVendedor($dadosVendedor) {
    $userModel = new VendedorModel(); // Instancia a classe UserModel
    $userModel->cadastraVendedor($dadosVendedor); // Chama a função de cadastro
}
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    header("Location: " . TEMPLATE_URL . "cadastro-login/cadastro_v.php");
    exit();
} else if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar se as senhas coincidem
    if ($_POST['password1'] !== $_POST['password2']) {
        FlashMessages::addMessage('error', 'As senhas não coincidem.');
        header("Location: " . TEMPLATE_URL . "cadastro-login/cadastro_v.php");
        exit(); // Para o processamento se as senhas não coincidirem
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

    processarCadastroVendedor($dadosVendedor);
}
?>
