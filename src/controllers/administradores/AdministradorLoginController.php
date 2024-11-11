<?php
// controller/LoginController.php
include_once(dirname(__FILE__) . '/../../config.php');
include_once(dirname(__FILE__) . '/../../models/administradores/AdministradorModel.php');
include_once(dirname(__FILE__) . '/../../utils/FlashMessages.php');
$flash_messages = FlashMessages::getMessages();


// Inicie a sessão se ainda não estiver ativa
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    header("Location: " . TEMPLATE_URL . "administradores/login_adm.php");
    exit();
} else if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifique se as chaves existem

    $codenome = isset($_POST['codenome']) ? $_POST['codenome'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $tokens = isset($_POST['token']) ? $_POST['token'] : '';

    // Debug: Exibir os valores recebidos
    // FlashMessages::addMessage('erro', "codenome: $codenome");
    //FlashMessages::addMessage('erro', "Password: $password");

    $userModel = new AdministradorModel();
    if ($userModel->loginAdministrador($codenome, $password, $tokens)) {
        // Defina a variável de sessão após o login bem-sucedido
        $_SESSION['codenome'] = $codenome; // Armazene o nome de usuário na sessão
        $userModel->atualizarUltimoLogin3($codenome);
        
        FlashMessages::addMessage('success', 'Login realizado com sucesso!');
        header("Location: " . TEMPLATE_URL . "administradores/home_adm.php");
        exit();
    } else {
        FlashMessages::addMessage('error', 'Nome de adm ou senha incorretos.');
        header("Location: " . TEMPLATE_URL . "administradores/login_adm.php");
        exit();
    }
} else {
    FlashMessages::addMessage('error', 'Método de requisição inválido.');
    header("Location: " . TEMPLATE_URL . "administradores/login_adm.php");
}
?>
