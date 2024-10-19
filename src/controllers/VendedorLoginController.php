<?php
// controller/VendedorLoginController.php
include_once(dirname(__FILE__) . '/../config.php');
include_once(dirname(__FILE__) . '/../models/VendedorModel.php');

// TODO: Tocar aqui por isVendedorLogado()
// Inicie a sessão se ainda não estiver ativa
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    header("Location: " . TEMPLATE_URL . "cadastro-login/login_v.php");
    exit();
} else if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifique se as chaves existem
    $cnpj = isset($_POST['cnpj']) ? $_POST['cnpj'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // Debug: Exibir os valores recebidos
    // FlashMessages::addMessage('erro', "cnpj: $cnpj");
    // FlashMessages::addMessage('erro', "Password: $password");

    $VendedorModel = new VendedorModel();
    if ($VendedorModel->loginVendedor($cnpj, $password)) {
        FlashMessages::addMessage('success', 'Login realizado com sucesso!');
        header("Location: " . TEMPLATE_URL . "home/home_v.php?marca=" . $_SESSION["user_nome_fantasia"]);
        exit();
    } else {
        FlashMessages::addMessage('error', 'Nome do vendedor ou senha incorretos.');
        header("Location: " . TEMPLATE_URL . "cadastro-login/login_v.php");
        exit();
    }
} else {
    FlashMessages::addMessage('error', 'Método de requisição inválido.');
    header("Location: " . TEMPLATE_URL . "cadastro-login/login_v.php");
}
?>
