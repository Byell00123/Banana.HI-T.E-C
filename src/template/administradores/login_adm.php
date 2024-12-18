<?php 
// src/template/adiministradores/login_adm.php
include_once(dirname(__FILE__) . '/../../models/administradores/AdministradorModel.php');
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
            <form action="../../controllers/administradores/AdministradorLoginController.php" method="POST" class="form login">

                <h2>Login de Administrador</h2>

                <?php include(dirname(__FILE__) . '/../partials/mensagens.php'); ?>
                        
                <div class="form-group">
                    <label for="token" class="label-informacao">Token:</label>
                    <input type="text" class="input token" name="token" placeholder="exemplo: abcdf@1*8-" required>
                </div>
                <div class="form-group">
                    <label for="codenome" class="label-informacao">Codenome:</label>
                    <input type="text" class="input codenome" name="codenome" placeholder="exemplo: Morpheus do Paraguai" required>
                </div>
                <div class="form-group">
                    <label for="password">Senha:</label>
                    <input type="password" class="input password" name="password" placeholder="Digite a senha" required>
                </div>
                <div class="form-group link-botao">
                    <div class="links-auxiliares">
                        <a class="link-auxiliar c1" href="<?php echo TEMPLATE_URL; ?>cadastro-login/recuperar_senha.php" target="_blank">Esqueceu sua senha?</a>
                        <div class="gambiarra"></div>
                        <a class="link-auxiliar c2" href="<?php echo TEMPLATE_URL; ?>administradores/cadastro_adm.php" target="_blank">Ainda não tem uma conta?</a>
                    </div>
                    <button type="submit" class="botao-form">Entrar</button>
                </div>
            </form>
        </div>
    </div>

    <?php include(dirname(__FILE__) . '/../partials/rodape.php'); ?>

</body>
</html>