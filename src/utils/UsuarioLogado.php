<?php
// src/utils/UsuarioLogado.php
include_once(dirname(__FILE__) . '/../utils/session_start.php');// Incluir a sessão, necessário para verificar se o usuário está logado

// Função para verificar se o usuário está logado
function UsuarioLogado() {
    // Verifique se a sessão do usuário está ativa
    return isset($_SESSION['user_apelido']); // ou a chave que você usa para armazenar o login do usuário
}
?>
