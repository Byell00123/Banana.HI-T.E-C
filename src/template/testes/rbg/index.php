<?php include_once (dirname(__FILE__) . '/../../../controllers/VendedorCadastroController.php');?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banana.HI-T.E-C</title>
    <link rel="shortcut icon" href="<?php echo STATIC_URL; ?>icon/favicon/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo STATIC_URL; ?>css/cadastro-login/cadastro-login.css">
    <link rel="stylesheet"type="text/css" href="style.css">
</head>
<body>

    <?php include(dirname(__FILE__) . '/../../partials/navbar_v.php'); ?>

    <div class="conteudo">
        <div class="formulario">
            <div class="caixa">
                <form action="../../controllers/VendedorCadastroController.php" method="POST" class="form cadastro">
                    <h2>Cadastro de Vendedor</h2>
                    <?php include(dirname(__FILE__) . '/../../partials/mensagens.php'); ?>
                    <div class="form-group">
                        <label for="nome_fantasia" class="label-informacao" >Nome Fantasia:</label>
                        <input type="txt" class="input username" name="nome_fantasia" placeholder="exemplo: Acer" autocomplete="username" required
                        value="<?php echo isset($_POST['nome_fantasia']) ? htmlspecialchars($_POST['nome_fantasia']) : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="cnpj"class="label-informacao">Cnpj:</label>
                        <input type="number" class="input cpf" name="cnpj" placeholder="exemplo: 00.000.000/0001-00" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="password1"class="label-informacao">Senha:</label>
                        <input type="password" class="input password1" name="password1" placeholder="Digite a senha" autocomplete="of" required>
                        <p class="texto-informacao">A senha precisa ter pelo menos 8 caracteres e incluir pelo menos um dos seguintes caracteres especiais: *, @, -, _.
                            Além disso, a senha deve conter pelo menos um número, uma letra maiúscula e uma letra minúscula.
                        </p>
                    </div>
                    <div class="form-group">
                        <label for="password2"class="label-informacao">Senha(novamente):</label>
                        <input type="password" class="input password2" name="password2" placeholder="Digite a senha(novamente)" autocomplete="of" required>
                    </div>
                    <div class="form-group">
                        <label for="email"class="label-informacao">E-mail:</label>
                        <input type="email" class="input email" name="email" placeholder="exemplo: joão.atacadosevarejos@gmail.com" autocomplete="email" required>
                    </div>
                    <div class="form-group">
                        <label for="telefone"class="label-informacao">Telefone:</label>
                        <input type="tel" class="input telefone" name="telefone" placeholder="exemplo: (00)90000-0000" autocomplete="tel" required>
                    </div>
                    <div class="form-group link-botao">
                        <div class="links-auxiliares">
                            <a class="link-auxiliar c1" href="<?php echo TEMPLATE_URL; ?>cadastro-login/login_v.php" target="_blank">Ja tenho uma conta</a>
                            <div class="gambiarra"></div>
                        </div>
                        <button type="submit" class="botao-form">Cadastrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php include(dirname(__FILE__) . '/../../partials/rodape.php'); ?>

</body>
</html>