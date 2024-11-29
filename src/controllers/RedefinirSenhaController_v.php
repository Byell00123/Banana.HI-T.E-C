<?php
session_start();
require_once(dirname(__FILE__) . '/../models/VendedorModel.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $novaSenha = $_POST['nova_senha'];
    $confirmarSenha = $_POST['confirmar_senha'];

    if ($novaSenha !== $confirmarSenha) {
        echo "As senhas não coincidem.";
        exit;
    }

    $cnpj = $_SESSION['user_cnpj'];
    if (!$cnpj) {
        echo "Erro: sessão inválida.";
        exit;
    }

    $vendModel = new VendedorModel();
    $vendModel->atualizarSenha($cnpj, $novaSenha);

    echo "Senha redefinida com sucesso!";
    header("Location: " . TEMPLATE_URL . "cadastro-login/login_v.php");
    exit;
}
?>