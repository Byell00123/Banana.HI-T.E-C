<?php include(dirname(__FILE__) . '/../../models/VendedorModel.php'); ?>

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


    <div class="conteudo">
        <div class="formulario">
            <form action="../../controllers/RedefinirSenhaController_v.php" method="POST" class="form redefinir_senha">

                <h2>Redefinir Senha do Vendedor</h2>

                <?php include(dirname(__FILE__) . '/../partials/mensagens.php'); ?>

                <div class="form-group">
                    <label for="nova_senha"class="label-informacao">Nova Senha:</label>
                    <input type="password" class="input password" name="nova_senha" required>
                </div>
                <div class="form-group">
                    <label for="confirmar_senha"class="label-informacao">confirmar_senha:</label>
                    <input type="password" class="input telefone" name="confirmar_senha" required>
                </div>

                <button type="submit" class="botao-form">Redefinir Senha</button>
                
            </form>
        </div>
    </div>

    <?php include(dirname(__FILE__) . '/../partials/rodape.php'); ?>
</body>
</html>
