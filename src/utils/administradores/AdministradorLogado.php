<?php
// src/utils/VendedorLogado.php
include_once(dirname(__FILE__) . '/../../utils/session_start.php');

// Função para verificar se o ADM está logado
function AdministradorLogado() {
    return isset($_SESSION['user_codenome']); // chave que usada para armazenar o login do ADM
}
?>
