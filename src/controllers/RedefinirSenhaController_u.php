<?php
session_start();
require_once(dirname(__FILE__) . '/../models/UsuarioModel.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $novaSenha = $_POST['nova_senha'];
    $confirmarSenha = $_POST['confirmar_senha'];

    if ($novaSenha !== $confirmarSenha) {
        echo "As senhas não coincidem.";
        exit;
    }

    $userId = $_SESSION['user_id'];
    if (!$userId) {
        echo "Erro: sessão inválida.";
        exit;
    }

    $userModel = new UsuarioModel();
    $userModel->atualizarSenha($userId, $novaSenha);

    echo "Senha redefinida com sucesso!";
    header("Location: " . TEMPLATE_URL . "cadastro-login/login_u.php");
    exit;
}
?>