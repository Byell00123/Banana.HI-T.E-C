<?php
// src/controller/VendedorLoginController.php
include_once(dirname(__FILE__) . '/../config.php');
include_once(dirname(__FILE__) . '/../models/VendedorModel.php');
include_once(dirname(__FILE__) . '/../utils/FlashMessages.php');
$flash_messages = FlashMessages::getMessages();
$ProdutoModel = new ProdutoModel;

// Verifica se o vendedor está logado
if ($ProdutoModel->isVendedorLogado()) {
    // Se o vendedor estiver logado, redireciona para a página de login
    FlashMessages::addMessage('error', "Você já está logado como vendedor.");
    header("Location: " . TEMPLATE_URL . "home/home_v.php?marca=" . $_SESSION["user_nome_fantasia"]);
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    header("Location: " . TEMPLATE_URL . "cadastro-login/login_v.php");
    exit();
}

elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifique se as chaves existem
    $cnpj = isset($_POST['cnpj']) ? $_POST['cnpj'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    
    // Debug: Exibir os valores recebidos
    // FlashMessages::addMessage('erro', "cnpj: $cnpj");
    // FlashMessages::addMessage('erro', "Password: $password");

    $VendedorModel = new VendedorModel();
    if ($VendedorModel->loginVendedor($cnpj, $password)) {
        FlashMessages::addMessage('success', 'Login realizado com sucesso!');
        $VendedorModel->atualizarUltimoLogin2($cnpj);
        header("Location: " . TEMPLATE_URL . "home/home_v.php?marca=" . urlencode($_SESSION['user_nome_fantasia']));
        exit();
       
    } 
    else {
        FlashMessages::addMessage('error', 'Nome do vendedor ou senha incorretos.');
        header("Location: " . TEMPLATE_URL . "cadastro-login/login_v.php");
        exit();
    }
} 
else {
    FlashMessages::addMessage('error', 'Método de requisição inválido.');
    header("Location: " . TEMPLATE_URL . "cadastro-login/login_v.php");
    exit();
}
?>
