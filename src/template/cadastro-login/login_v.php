<?php include($_SERVER['DOCUMENT_ROOT'] . '/Banana.HI-T.E-C/src/config.php');?>
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

    <?php include(TEMPLATE_PATH . 'partials/navbar_v.php'); ?>

    <div class="conteudo">
        <div class="formulario">
            <form action="#" class="form login">
                <h2>Login do Vendedor</h2>
                <div class="form-group">
                    <label for="cnpj">CNPJ:</label>
                    <input type="text" class="input username" name="cnpj" placeholder="Nome Fantasia ou CNPJ">
                </div>
                <div class="form-group">
                    <label for="password">Senha:</label>
                    <input type="password" class="input password" name="password" placeholder="Digite a senha">
                </div>
                <div class="form-group link-botao">
                    <div class="links-auxiliares">
                        <a class="link-auxiliar l1" href="<?php echo TEMPLATE_URL; ?>cadastro-login/recuperar_senha.php">Esqueceu sua senha?</a>
                        <div class="gambiarra"></div>
                        <a class="link-auxiliar l2" href="<?php echo TEMPLATE_URL; ?>cadastro-login/cadastro_v.php" target="_blank">Ainda não tem uma conta?</a>
                    </div>
                    <button type="submit" class="botao-form">Entrar</button>
                </div>
            </form>
        </div>
    </div>

    <?php include(TEMPLATE_PATH . 'partials/rodape.php'); ?>

</body>
</html>
