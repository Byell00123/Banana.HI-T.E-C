<?php
// src/utils/isLogado.php

// Incluir a sessão, necessário para verificar se o usuário está logado
include_once 'session_start.php';

// Função para verificar se o usuário está logado
function isLogado() {
    // Verifique se a sessão do usuário está ativa
    return isset($_SESSION['apelido']); // ou a chave que você usa para armazenar o login do usuário
}
?>
