<?php include($_SERVER['DOCUMENT_ROOT'] . '/Banana.Hi-T.E-C/src/config.php');?>
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

    <?php include(TEMPLATE_PATH . 'partials/navbar_u.php'); ?>

    <div class="conteudo">
        <div class="formulario">
            <form action="#" class="form login">
                <h2>Login</h2>
                <div class="form-group">
                    <label for="username">Usuário:</label>
                    <input type="text" class="input username" name="username" placeholder="Nome de Usuario ou email">
                </div>
                <div class="form-group">
                    <label for="password">Senha:</label>
                    <input type="password" class="input password" name="password" placeholder="Digite a senha">
                </div>
                <div class="form-group">
                    <div class="links-auxiliares">
                        <a class="link-auxiliar" href="#">Esqueceu sua senha?</a>
                        <a class="link-auxiliar" href="<?php echo TEMPLATE_URL; ?>cadastro-login/cadastro_u.php" target="_blank">Ainda não tem uma conta?</a>
                    </div>
                </div>
                <button type="submit" class="botao-form">Entrar</button>
            </form>
        </div>
    </div>

    <?php include(TEMPLATE_PATH . 'partials/rodape.php'); ?>

</body>
</html>