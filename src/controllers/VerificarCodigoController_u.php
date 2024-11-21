<?php
include_once(dirname(__FILE__) . '/../config.php');

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codigoEmail = $_POST['codigo_email'];
    $codigoTelefone = $_POST['codigo_telefone'];

    // Validar os códigos armazenados na sessão
    if (
        $codigoEmail == $_SESSION['codigo_email'] &&
        $codigoTelefone == $_SESSION['codigo_telefone']
    ) {
        // Redirecionar para a redefinição de senha
        header("Location: " . TEMPLATE_URL . "cadastro-login/redefinir_senha_u.php");
        exit;
    } else {
        echo "Os códigos não correspondem. Por favor, tente novamente.";
        exit;
    }
}
?>