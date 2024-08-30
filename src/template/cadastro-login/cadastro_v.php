<?php
include($_SERVER['DOCUMENT_ROOT'] . '/Banana.Hi-T.E-C/src/config.php');
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banana.Hi-T.E-C</title>
    <link rel="shortcut icon" href="<?php echo STATIC_URL; ?>icon/favicon/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo STATIC_URL; ?>css/base/base.css">
    <link rel="stylesheet" href="<?php echo STATIC_URL; ?>css/cadastro-login/cadastro-login.css">
</head>
<body>

    <?php include($_SERVER['DOCUMENT_ROOT'] . TEMPLATE_URL . 'partials/navbar_v.php'); ?>

    <div class="conteudo">
        <div class="formulario">
            <form action="#" class="cadastro-form">
                <h2>Cadastro de Vendedor</h2>
                <div class="form-group">
                    <label for="username"class="texto-informacao">Nome Fantasia:</label>
                    <input type="txt" class="username" name="nome_fantasia" placeholder="exemplo: Joãozinho123">
                </div>
                <div class="form-group">
                    <label for="cpf"class="texto-informacao">CNPJ:</label>
                    <input type="number" class="cpf" name="cnpj" placeholder="exemplo: 000.000.000-00">
                </div>
                <div class="form-group">
                    <label for="password"class="texto-informacao">Senha:</label>
                    <input type="password" class="password1" name="password1" placeholder="Digite a senha">
                </div>
                <div class="form-group">
                    <label for="password"class="texto-informacao">Senha(novamente):</label>
                    <input type="password" class="password2" name="password2" placeholder="Digite a senha(novamente)">
                </div>
                <div class="form-group">
                    <label for="email"class="texto-informacao">E-mail:</label>
                    <input type="email" class="email" name="email" placeholder="exemplo: joãozinho123@gmail.com">
                </div>
                <div class="form-group">
                    <label for="telefone"class="texto-informacao">Telefone:</label>
                    <input type="number" class="telefone" name="telefone" placeholder="exemplo: (00) 90000-0000">
                </div>
                <div class="form-group">
                    <div class="links-auxiliares">
                        <a class="link-auxiliar" href="http://localhost/Banana.Hi-T.E-C/src/template/cadastro-login/login_u.php" target="_blank">Ja tenho uma conta</a>
                    </div>
                </div>
                <button type="submit" class="botao-form">Cadastrar</button>
            </form>
        </div>
    </div>

    <?php include($_SERVER['DOCUMENT_ROOT'] . TEMPLATE_URL . 'partials/rodape.php') ?>

</body>
</html>