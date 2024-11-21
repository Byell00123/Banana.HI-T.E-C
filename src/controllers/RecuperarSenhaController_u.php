<?php
require_once(dirname(__FILE__) . '/../config.php');
require_once(dirname(__FILE__) . '/../models/UsuarioModel.php');
require_once(dirname(__FILE__) . '/../utils/FlashMessages.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];

    // Validação básica
    if (empty($email) || empty($telefone)) {
        echo "E-mail e telefone são obrigatórios.";
        exit;
    }

    $userModel = new UsuarioModel();
    $usuario = $userModel->buscarPorEmailETelefone($email, $telefone);

    if (!$usuario) {
        echo "Usuário não encontrado.";
        exit;
    }

    // Gerar códigos aleatórios
    $codigoEmail = rand(100000, 999999);
    $codigoTelefone = rand(100000, 999999);

    // Armazenar na sessão
    $_SESSION['user_id'] = $usuario['id_usuario'];
    $_SESSION['codigo_email'] = $codigoEmail;
    $_SESSION['codigo_telefone'] = $codigoTelefone;

    // "Enviar" os códigos (para fins de demonstração, apenas exibe)
    print "Código enviado para o e-mail: $codigoEmail\n";
    print "Código enviado para o telefone: $codigoTelefone\n";
    exit;
}
?>