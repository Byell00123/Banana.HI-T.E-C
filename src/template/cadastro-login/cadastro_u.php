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
            <form action="#" class="form cadastro">
                <h2>Cadastro</h2>
                <div class="form-group">
                    <label for="username"class="texto-informacao">Nome de Usuário:</label>
                    <input type="txt" class="input username" name="username" placeholder="exemplo: Joãozinho123">
                </div>
                <div class="form-group">
                    <label for="password"class="texto-informacao">Senha:</label>
                    <input type="password" class="input password1" name="password1" placeholder="Digite a senha">
                </div>
                <div class="form-group">
                    <label for="password"class="texto-informacao">Senha(novamente):</label>
                    <input type="password" class="input password2" name="password2" placeholder="Digite a senha(novamente)">
                </div>
                <div class="form-group">
                    <label for="nome"class="texto-informacao">Primeiro Nome:</label>
                    <input type="name" class="input primeiro_nome" name="primeiro_nome" placeholder="exemplo: João Eduardo">
                </div>
                <div class="form-group">
                    <label for="nome"class="texto-informacao">Sobrenome:</label>
                    <input type="text" class="input sobrenome" name="sobrenome" placeholder="exemplo:Jacoby de Oliveira">
                </div>
                <div class="form-group">
                    <label for="nascimento"class="texto-informacao">Data de Nascimento:</label>
                    <input type="date" class="input nascimento" name="nascimento" placeholder="exemplo: 01/01/2001" type="tel" maxlength="10">
                </div>
                <div class="form-group">
                    <label for="email"class="texto-informacao">E-mail:</label>
                    <input type="email" class="input email" name="email" placeholder="exemplo: joãozinho123@gmail.com">
                </div>
                <div class="form-group">
                    <label for="telefone"class="texto-informacao">Telefone:</label>
                    <input type="number" class="input telefone" name="telefone" placeholder="exemplo: (00) 90000-0000">
                </div>
                <div class="form-group">
                    <label for="genero"class="texto-informacao">Gênero:</label>
                    <input type="radio" class="genero" name="genero" value="F">
                    <span>Feminino</span>
                    <input type="radio" class="genero" name="genero" value="M">
                    <span>Masculino</span>
                    <input type="radio" class="genero" name="genero" value="H">
                    <span>Outro</span>
                </div>
                <div class="form-group">
                    <label for="cpf"class="texto-informacao">CPF:</label>
                    <input type="number" class="input cpf" name="cpf" placeholder="exemplo: 000.000.000-00">
                </div>
                <div class="form-group">
                    <div class="links-auxiliares">
                        <a class="link-auxiliar" href="<?php echo TEMPLATE_URL; ?>cadastro-login/login_u.php" target="_blank">Ja tenho uma conta</a>
                    </div>
                </div>
                <button type="submit" class="botao-form">Cadastrar</button>
            </form>
        </div>
    </div>

    <?php include(TEMPLATE_PATH . 'partials/rodape.php'); ?>

</body>
</html>