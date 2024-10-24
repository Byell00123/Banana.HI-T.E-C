<?php include(dirname(__FILE__) . '/../../config.php');?>

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

    <?php include(dirname(__FILE__) . '/../partials/navbar_u.php'); ?>

    <div class="conteudo">
        <?php include(dirname(__FILE__) . '/../partials/mensagens.php'); ?>
        <div class="formulario">
            <div class="form decisao">
                <h2>Decisão</h2>
                <div class="form-group">
                    <div class="links-auxiliares">
                        <a class="link-auxiliar" href="<?php echo TEMPLATE_URL; ?>cadastro-login/login_u.php" target="_blank">Login</a>
                        <div class="gambiarra"></div>
                        <a class="link-auxiliar" href="<?php echo TEMPLATE_URL; ?>cadastro-login/cadastro_u.php" target="_blank">cadastro</a>
                        <div class="gambiarra"></div>
                        <a class="link-auxiliar" href="<?php echo TEMPLATE_URL; ?>home/home_u.php" target="_blank">Voltar para a home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include(dirname(__FILE__) . '/../partials/rodape.php'); ?>

</body>
</html>