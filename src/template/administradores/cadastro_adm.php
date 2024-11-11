<?php 
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
            <form action="../../controllers/administradores/AdministradorCadastroController.php" method="POST" class="form cadastro">

                <h2>Cadastro</h2>

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
                    <label for="password" class="label-informacao">Senha:</label>
                    <input type="password" class="input password1" name="password1" placeholder="Digite a senha" required>
                    <p class="texto-informacao">
                        A senha precisa ter pelo menos 8 caracteres e incluir pelo menos um dos seguintes caracteres especiais: *, @, -, _. 
                        Além disso, a senha deve conter pelo menos um número, uma letra maiúscula e uma letra minúscula.
                        </p>
                </div>
                <div class="form-group">
                    <label for="password" class="label-informacao">Senha (novamente):</label>
                    <input type="password" class="input password2" name="password2" placeholder="Digite a senha (novamente)" required>
                </div>
               
                <div class="form-group link-botao">
                    <div class="links-auxiliares">
                        <a class="link-auxiliar c1" href="<?php echo TEMPLATE_URL; ?>administradores/login_adm.php" target="_blank">Já tenho uma conta</a>
                        <div class="gambiarra"></div>
                    </div>
                    <button type="submit" class="botao-form">Cadastrar</button>
                </div>
            </form>
        </div>
    </div>

    <?php include(dirname(__FILE__) . '/../partials/rodape.php'); ?>

</body>
</html>
