<?php
// src/utils/VendedorLogado.php
include_once(dirname(__FILE__) . '/../utils/session_start.php');

// Função para verificar se o vendedor está logado
function VendedorLogado() {
    return isset($_SESSION['user_cnpj']); // chave que usada para armazenar o login do vendedor
}
?>
