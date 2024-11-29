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
            <form action="../../controllers/VerificarCodigoController_v.php" method="POST" class="form verificar_codigos">


                <h2>Verificação de Códigos do Vendedor</h2>
                <?php if (isset($_SESSION['codigo_email']) && isset($_SESSION['codigo_telefone'])): ?>
                    <p>Código enviado para o e-mail: <?php echo $_SESSION['codigo_email']; ?></p>
                    <p>Código enviado para o telefone: <?php echo $_SESSION['codigo_telefone']; ?></p>
                <?php endif; ?>

                <?php include(dirname(__FILE__) . '/../partials/mensagens.php'); ?>

                <div class="form-group">
                    <label for="codigo_email"class="label-informacao">Código do E-mail:</label>
                    <input type="text" class="input email" name="codigo_email" required>
                </div>
                <div class="form-group">
                    <label for="confir"class="label-informacao">Código do Telefone:</label>
                    <input type="text" class="input telefone" name="codigo_telefone" required>
                </div>

                <button type="submit" class="botao-form">Redefinir Senha</button>
                
            </form>
        </div>
    </div>

    <?php include(dirname(__FILE__) . '/../partials/rodape.php'); ?>
</body>
</html>
