<?php 
include_once(dirname(__FILE__) . '/../../models/administradores/AdministradorModel.php');
include_once(dirname(__FILE__) . '/../../models/ProdutoModel.php');


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banana.HI-T.E-C</title>
    <link rel="shortcut icon" href="<?php echo STATIC_URL; ?>icon/favicon/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo STATIC_URL; ?>css/home/home_v.css">
    <style>

        .formulario {
            width: 40vw; /* Define a largura do formulário */
            margin: 30px auto; /* Adiciona uma margem de 30px em cima e embaixo e centraliza horizontalmente */
            background-color: #0a0a23; /* Define a cor de fundo como um tom escuro */
            border: solid; /* Adiciona uma borda sólida */
            padding: 20px; /* Adiciona um preenchimento interno de 20px */
            border-radius: 10px; /* Adiciona bordas arredondadas */
        }

        .form {
            padding: 0 20px; /* Adiciona preenchimento interno apenas nas laterais */
            background-color: #0a0a23; /* Define a cor de fundo como um tom escuro */
            border-color: #fff; /* Define a cor da borda como branco */
            border: solid; /* Adiciona uma borda sólida */
            border-radius: 10px; /* Adiciona bordas arredondadas */
        }

        .links-auxiliares{
            display: flex;
        }
        .link-auxiliar {
            padding: 4px; /* Adiciona um preenchimento interno de 4px */
            text-decoration: none; /* Remove a decoração de sublinhado */
            background-color: #e22bcdec; /* Define a cor de fundo como roxo */
            border: 2px solid #ff00ff; /* Adiciona uma borda rosa neon */
            box-shadow: 0 0 10px #ff007f; /* Adiciona uma sombra magenta neon */
            border-radius: 10px; /* Adiciona bordas arredondadas */
            text-align: center; /* Centraliza o texto */
            color: #ffffff; /* Define a cor do texto como branco */
        }

        .link-auxiliar:hover {
            background-color: #ff00ff; /* Altera a cor de fundo para rosa neon quando o mouse passa por cima */
            box-shadow: 0 0 15px #ff007f; /* Adiciona uma sombra magenta neon mais intensa */
        }

        .link-botao{
            margin-bottom: 0px !important;
            display: flex;
            flex-direction: column; /* Organiza os itens em coluna */
        }

        .c1, .c2,.c3,.c4{
            width: 45%;
        }

        .c3,.c4{
            background-color: #0016b3; /* Define a cor de fundo como azul escuro */
            border: 1px solid #007bff; /* Define a cor da borda como meio azul */
            box-shadow: 0 0 10px #00bfff; /* Adiciona uma sombra azul neon */
        }
        .c3:hover,.c4:hover{
            background-color: #007bff; /* Altera a cor de fundo para azul quando o mouse passa por cima */
        }

    </style>
</head>
<body>

    <?php include(dirname(__FILE__) . '/../partials/administradores/navbar_adm.php'); ?>

    
    <!-- Conteúdo do site -->
    <div class="conteudo">
        
    <?php include(dirname(__FILE__) . '/../partials/mensagens.php'); ?>
        <div class="formulario">
            <div class="form">
                <div class="form-group link-botao">
                    <br>
                    <div class="links-auxiliares">
                        <a class="link-auxiliar c1" href="<?php echo TEMPLATE_URL; ?>administradores/cadastro_u_adm.php" target="_blank">Cadastar um Usuario</a>
                        <div class="gambiarra"></div>
                        <a class="link-auxiliar c2" href="<?php echo TEMPLATE_URL; ?>administradores/editar_u_adm.php" target="_blank">Edita um Usuario</a>
                    </div>
                    <br>
                    <div class="links-auxiliares">
                        <a class="link-auxiliar c3" href="<?php echo TEMPLATE_URL; ?>administradores/cadastro_v_adm.php" target="_blank">Cadastar um Vendedor</a>
                        <div class="gambiarra"></div>
                        <a class="link-auxiliar c3" href="<?php echo TEMPLATE_URL; ?>administradores/editar_v_adm.php" target="_blank">Edita um Vendedor</a>
                    </div>
                    <br>
                </div>
            </div>
        </div>

    </div>

    <?php include(dirname(__FILE__) . '/../partials/rodape.php'); ?>

</body>
</html>
