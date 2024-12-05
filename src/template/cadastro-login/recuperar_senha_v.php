<?php include(dirname(__FILE__) . '/../../models/UsuarioModel.php'); ?>

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

    <?php include(dirname(__FILE__) . '/../partials/navbar_v.php'); ?>

    <div class="conteudo">
        <div class="formulario">
            <form action="../../controllers/RecuperarSenhaController_v.php" method="POST" class="form recuperar_senha">

                <h2>Recuperar Senha do Vendedor</h2>
                
                <?php include(dirname(__FILE__) . '/../partials/mensagens.php'); ?>

                <div class="form-group">
                    <label for="email"class="label-informacao">E-mail:</label>
                    <input type="email" class="input email" name="email" placeholder="exemplo: joãozinho123@gmail.com">
                </div>
                <div class="form-group">
                    <label for="telefone"class="label-informacao">Telefone:</label>
                    <input type="tel" class="input telefone" name="telefone" placeholder="exemplo: (00) 90000-0000">
                </div>
                <div class="form-group link-botao">
                    <div class="links-auxiliares">
                        <a class="link-auxiliar c1" href="#">Tentar outro metodo</a>
                        <div class="gambiarra"></div>
                    </div>
                    <button type="submit" class="botao-form">Entrar</button>
                </div>
            </form>
        </div>
    </div>

    <?php include(dirname(__FILE__) . '/../partials/rodape.php'); ?>
</body>
</html>
