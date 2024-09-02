<?php
// src/controllers/logoutController.php
include_once $_SERVER['DOCUMENT_ROOT'] . '/Banana.HI-T.E-C/src/config.php';
// Incluir a sessão, necessário para verificar se o usuário está logado
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Verifique se a ação de logout foi solicitada
if (isset($_POST['action']) && $_POST['action'] === 'logout') {
    // Chame a função de logout
    logoutUsuario();
}

// Função para realizar o logout do usuário
function logoutUsuario() {
    // Destruir as variáveis da sessão
    session_unset();
    session_destroy();

    // Redirecionar para a página inicial
    header("Location: " . TEMPLATE_URL . "home/home_u.php");
    exit();
}
?>
