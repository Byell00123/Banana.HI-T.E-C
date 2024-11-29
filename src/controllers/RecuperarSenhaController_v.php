<?php
require_once(dirname(__FILE__) . '/../config.php');
require_once(dirname(__FILE__) . '/../models/VendedorModel.php');
require_once(dirname(__FILE__) . '/../utils/FlashMessages.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];

    // Validação básica
    if (empty($email) || empty($telefone)) {
        echo "E-mail e telefone são obrigatórios.";
        exit;
    }

    $userModel = new VendedorModel();
    $usuario = $userModel->buscarPorEmailETelefone($email, $telefone);

    if (!$usuario) {
        echo "Vendedor não encontrado.";
        exit;
    }

    // Gerar códigos aleatórios
    $codigoEmail = rand(100000, 999999);
    $codigoTelefone = rand(100000, 999999);

    // Armazenar na sessão
    $_SESSION['user_cnpj'] = $vendedor['cnpj'];
    $_SESSION['codigo_email'] = $codigoEmail;
    $_SESSION['codigo_telefone'] = $codigoTelefone;

    // "Enviar" os códigos (para fins de demonstração, apenas exibe)
    //print "Código enviado para o e-mail: $codigoEmail\n";
    //print "Código enviado para o telefone: $codigoTelefone\n";
    
    header("Location: " .   TEMPLATE_URL . "cadastro-login/verificar_codigo_v.php");
    exit;
}
?>