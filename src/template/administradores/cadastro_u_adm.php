<?php
// src/template/adiministradores/cadastro_u_adm.php
include(dirname(__FILE__) . '/../../models/UsuarioModel.php'); 
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
            <form action="../../controllers/UsuarioCadastroController.php" method="POST" class="form cadastro">

                <h2>Cadastro de um Usuário feito por um Adiministrador</h2>

                <?php include(dirname(__FILE__) . '/../partials/mensagens.php'); ?>
                
                <div class="form-group">
                    <label for="username" class="label-informacao">Nome de Usuário:</label>
                    <input type="text" class="input username" name="username" placeholder="exemplo: Joãozinho123" required>
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
                <div class="form-group">
                    <label for="primeiro_nome" class="label-informacao">Primeiro Nome:</label>
                    <input type="text" class="input primeiro_nome" name="primeiro_nome" placeholder="exemplo: João Eduardo" required>
                </div>
                <div class="form-group">
                    <label for="sobrenome" class="label-informacao">Sobrenome:</label>
                    <input type="text" class="input sobrenome" name="sobrenome" placeholder="exemplo: Jacoby de Oliveira" required>
                </div>
                <div class="form-group">
                    <label for="nascimento" class="label-informacao">Data de Nascimento:</label>
                    <input type="date" class="input nascimento" name="nascimento" required>
                </div>
                <div class="form-group">
                    <label for="email" class="label-informacao">E-mail:</label>
                    <input type="email" class="input email" name="email" placeholder="exemplo: joaozinho123@gmail.com" required>
                </div>
                <div class="form-group">
                    <label for="telefone" class="label-informacao">Telefone:</label>
                    <input type="number" class="input telefone" name="telefone" placeholder="exemplo: (00)90000-0000" required>
                </div>
                <div class="form-group">
                    <label for="genero" class="label-informacao">Gênero:</label>
                    <input type="radio" class="genero" name="sexo" value="f" required><span>Feminino</span>
                    <input type="radio" class="genero" name="sexo" value="m" required><span>Masculino</span>
                </div>
                <div class="form-group">
                    <label for="cpf" class="label-informacao">CPF:</label>
                    <input type="number" class="input cpf" name="cpf" placeholder="exemplo: 00000000000" required>
                </div>
                <div class="form-group link-botao">
                    <div class="links-auxiliares">
                        <a class="link-auxiliar c1" href="<?php echo TEMPLATE_URL; ?>cadastro-login/login_u.php" target="_blank">Já tenho uma conta</a>
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
