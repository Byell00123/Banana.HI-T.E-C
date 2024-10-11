<?php
// controller/LoginController.php
include_once(dirname(__FILE__) . '/../config.php');
include_once(dirname(__FILE__) . '/../models/AdministradoresModel.php');


// Inicie a sessão se ainda não estiver ativa
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    header("Location: " . TEMPLATE_URL . "cadastro-login/login_adm.php");
    exit();
} else if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifique se as chaves existem
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // Debug: Exibir os valores recebidos
    // FlashMessages::addMessage('erro', "Username: $username");
    // FlashMessages::addMessage('erro', "Password: $password");

    $userModel = new AdministradorModel();
    if ($userModel->loginAdministrador($username, $password)) {
        // Defina a variável de sessão após o login bem-sucedido
        $_SESSION['username'] = $username; // Armazene o nome de usuário na sessão
        
        FlashMessages::addMessage('success', 'Login realizado com sucesso!');
        header("Location: " . TEMPLATE_URL . "home/home_adm.php");
        exit();
    } else {
        FlashMessages::addMessage('error', 'Nome de usuário ou senha incorretos.');
        header("Location: " . TEMPLATE_URL . "cadastro-login/login_adm.php");
        exit();
    }
} else {
    FlashMessages::addMessage('error', 'Método de requisição inválido.');
    header("Location: " . TEMPLATE_URL . "cadastro-login/login_adm.php");
}
?>
