<?php 
// src/template/adiministradores/editar_u_adm.php
include_once(dirname(__FILE__) . '/../../config.php');
include_once(dirname(__FILE__) . '/../../models/administradores/AdministradorModel.php');
$modelU =  new AdministradorModel;


/*
// Verifica se o administrador está logado. Por enquanto não vamos deixar isso ativo, para facilita os teste da pagina
if (!isUsuarioLogado()) {
    // Se não estiver logado, redireciona para a página de login
    FlashMessages::addMessage('error', "Faça login como administrador para acessar esta área.");
    header("Location: " . TEMPLATE_URL . "cadastro-login/login_u.php");
    exit();
}
*/

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Verifica se o ID do usuário foi passado pela URL
    if (isset($_GET['id_usuario'])) {
        $id_usuario = intval($_GET['id_usuario']);
        $usuario = $modelU->getUsuarioPorId($id_usuario); // Obtém o usuário a partir do banco de dados

        if (!$usuario) {
            // Se o usuário não for encontrado, redireciona
            FlashMessages::addMessage('error', "Usuário não encontrado.");
            header("Location: " . TEMPLATE_URL . "home/home_adm.php");
            exit();
        }
    } else {
        // Redireciona se o ID do usuário não for fornecido
        FlashMessages::addMessage('error', "ID do usuário não especificado.");
        header("Location: " . TEMPLATE_URL . "home/home_adm.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banana.HI-T.E-C</title>
    <link rel="shortcut icon" href="<?php echo STATIC_URL; ?>icon/favicon/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo STATIC_URL; ?>css/cadastro-login/cadastro-login.css">
</head>
<body>

    <?php include(dirname(__FILE__) . '/../partials/administradores/navbar_adm.php'); ?>

    <div class="conteudo">
        <div class="formulario">
            <form action="../../controllers/administradores/AdministradorEditar_u_Controller.php" method="POST" class="form cadastro">
                <h2>Editar Usuário</h2>

                <?php include(dirname(__FILE__) . '/../partials/mensagens.php'); ?>

                <table border="1" cellpadding="10">
                    <tr>
                        <input type="hidden" name="id_usuario" value="<?php echo $usuario['id_usuario']; ?>">
                        <td><label for="apelido">Nome de Usuário:</label></td>
                        <td><input type="text" name="apelido" value="<?php echo htmlspecialchars($usuario['nome_usuario']); ?>" required></td>
                    </tr>
                    <tr>
                        <td><label for="primeiro_nome">Primeiro Nome:</label></td>
                        <td><input type="text" name="primeiro_nome" value="<?php echo htmlspecialchars($usuario['primeiro_nome']); ?>" required></td>
                    </tr>
                    <tr>
                        <td><label for="sobrenome">Sobrenome:</label></td>
                        <td><input type="text" name="sobrenome" value="<?php echo htmlspecialchars($usuario['sobrenome']); ?>" required></td>
                    </tr>
                    <tr>
                        <td><label for="nascimento">Data de Nascimento:</label></td>
                        <td><input type="date" name="nascimento" value="<?php echo htmlspecialchars($usuario['data_nascimento']); ?>" required></td>
                    </tr>
                    <tr>
                        <td><label for="email">E-mail:</label></td>
                        <td><input type="email" name="email" value="<?php echo htmlspecialchars($usuario['email']); ?>" required></td>
                    </tr>
                    <tr>
                        <td><label for="telefone">Telefone:</label></td>
                        <td><input type="text" name="telefone" value="<?php echo htmlspecialchars($usuario['telefone']); ?>" required></td>
                    </tr>
                    <tr>
                        <td><label for="sexo">Gênero:</label></td>
                        <td>
                            <input type="radio" name="sexo" value="f" <?php echo ($usuario['sexo'] == 'f') ? 'checked' : ''; ?>> Feminino
                            <input type="radio" name="sexo" value="m" <?php echo ($usuario['sexo'] == 'm') ? 'checked' : ''; ?>> Masculino
                        </td>
                    </tr>
                    <tr>
                        <td><label for="cpf">CPF:</label></td>
                        <td><input type="text" name="cpf" value="<?php echo htmlspecialchars($usuario['cpf']); ?>" required></td>
                    </tr>
                </table>

                <div class="form-group link-botao">
                    <button type="submit" class="botao-form">Atualizar Usuário</button>
                </div>
            </form>
        </div>
    </div>

    <?php include(dirname(__FILE__) . '/../partials/rodape.php'); ?>

</body>
</html>
