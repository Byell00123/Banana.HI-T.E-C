<?php 
// src/template/adiministradores/listar_u_adm.php
include_once(dirname(__FILE__) . '/../../models/administradores/AdministradorModel.php');
$modelA = new AdministradorModel();
$usuarios = $modelA->getUsuarios();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banana.HI-T.E-C</title>
    <link rel="shortcut icon" href="<?php echo STATIC_URL; ?>icon/favicon/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo STATIC_URL; ?>css/cadastro-login/cadastro-login.css">
    <link rel="stylesheet" href="<?php echo STATIC_URL; ?>administradores/css/navbar_adm.css">
    <script src="<?php echo STATIC_URL; ?>administradores/js/lista_u_adm.js" defer></script>  <!-- Adiciona o script externo -->
    <style>
        .th{
            font-size: 16px;
            background-color: blueviolet;
            text-align: center ;
        }
        .th.senha{
            font-size: small;
        }
        .td.senha{
            font-size: small;
        }
        .th.data-nascimento{
            font-size: small;
        }
        .td.data-nascimento{
            font-size: small;
        }
        .th.sexo{
            font-size: small;
        }
        .td.sexo{
            font-size: small;
        }
        
        .td.data{
            font-size: xx-small;
        }
        .th.data, .status{
            font-size: x-small;
        }
        .conteudo {
            padding-left: 2vw;
            padding-right: 2vw;
        }
        .formulario {
            width: 100% !important;
        }
        .form{
            width: 100% !important;
        }
        .table{
            width: 100%;
        }
        .td{
            font-size: 15px;
            text-align: center;
        }
        .td-a{
            border: solid 1px white;
        }
    </style>
</head>
<body>
    <?php include(dirname(__FILE__) . '/../partials/administradores/navbar_adm.php'); ?>
    <div class="conteudo">
        <div class="formulario">
            <form class="form" action="../../controllers/administradores/AdministradorEditar_u_Controller.php" method="POST"> <!-- TODO: resolver o erro de não excluir o primeiro usuario da tabela-->
                <?php include(dirname(__FILE__) . '/../partials/mensagens.php'); ?>
                <table class="table" border="1">
                    <caption><h2>Lista de Usuários</h2></caption>
                    <thead>
                        <tr>
                            <th class="th"><input type="checkbox" id="selectAll"></th>
                            <th class="th" scope="col">ID</th>
                            <th class="th" scope="col">Apelido</th>
                            <th class="th senha" scope="col">Senha</th>
                            <th class="th" scope="col">Primeiro Nome</th>
                            <th class="th" scope="col">Sobrenome</th>
                            <th class="th data-nascimento" scope="col">Data de Nascimento</th>
                            <th class="th" scope="col">Email</th>
                            <th class="th" scope="col">Telefone</th>
                            <th class="th sexo" scope="col">Sexo</th>
                            <th class="th" scope="col">CPF</th>
                            <th class="th data" scope="col">Data de Ingresso</th>
                            <th class="th data" scope="col">Último Login</th>
                            <th class="th status" scope="col">Status</th>
                            <th class="th" scope="col">Grupo</th>
                            <th class="th acao" scope="col" colspan="2">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!$usuarios):?>
                            <tr>
                                <?php for($x=0; $x<=16; $x++):?><td class="class">&nbsp;</td><?php endfor;?>
                            </tr>
                        <?php else:?>
                            <?php foreach ($usuarios as $usuario): ?>
                                <tr>
                                    <td class="td" scope="row"><input type="checkbox" name="id_usuario[]" value="<?php echo htmlspecialchars($usuario['id_usuario']); ?>" class="userCheckbox"></td>
                                    <td class="td" scope="row"><a href="<?php echo TEMPLATE_URL; ?>administradores/editar_u_adm.php?id_usuario=<?php echo htmlspecialchars($usuario['id_usuario']); ?>"><?php echo htmlspecialchars($usuario['id_usuario']); ?></a></td>
                                    <td class="td" scope="row"><a href="<?php echo TEMPLATE_URL; ?>administradores/editar_u_adm.php?id_usuario=<?php echo htmlspecialchars($usuario['id_usuario']); ?>"><?php echo htmlspecialchars($usuario['apelido']); ?></a></td>
                                    <td class="td senha" scope="row"><?php echo str_repeat('*', 1); ?></td>
                                    <td class="td" scope="row"><?php echo htmlspecialchars($usuario['primeiro_nome']); ?></td>
                                    <td class="td" scope="row"><?php echo htmlspecialchars($usuario['sobrenome']); ?></td>
                                    <td class="td data-nascimento" scope="row"><?php echo htmlspecialchars($usuario['data_nascimento']); ?></td>
                                    <td class="td" scope="row"><?php echo htmlspecialchars($usuario['email']); ?></td>
                                    <td class="td" scope="row"><?php echo htmlspecialchars($usuario['telefone']); ?></td>
                                    <td class="td sexo" scope="row"><?php echo htmlspecialchars($usuario['sexo']); ?></td>
                                    <td class="td" scope="row"><?php echo htmlspecialchars($usuario['cpf']); ?></td>
                                    <td class="td data" scope="row"><?php echo htmlspecialchars($usuario['data_engressou']); ?></td>
                                    <td class="td data" scope="row"><?php echo htmlspecialchars($usuario['ultimo_login']); ?></td>
                                    <td class="td" scope="row"><?php echo htmlspecialchars($usuario['status']); ?></td>
                                    <td class="td" scope="row"><?php echo htmlspecialchars($usuario['fk_grupo']); ?></td>
                                    <td class="td" scope="row">
                                        <a class="td-a" href="<?php echo TEMPLATE_URL; ?>administradores/editar_u_adm.php?id_usuario=<?php echo htmlspecialchars($usuario['id_usuario']); ?>" target="_blank">Editar</a>
                                    </td>
                                    <td class="td" scope="row">
                                        <form action="../../controllers/administradores/AdministradorEditar_u_Controller.php" method="POST">
                                            <input type="hidden" name="id_usuario" value="<?= $usuario['id_usuario']; ?>">
                                            <input type="hidden" name="deleta" value="1">
                                            <button name="excluiresse" type="submit" onclick="return confirm('Tem certeza que deseja excluir este usuário?')">Excluir</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif;?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="17">
                                <div class="form-group link-botao">
                                    <button class="botao-form" name="excluirselecionados" type="submit" onclick="return confirm('Tem certeza que deseja excluir os usuários selecionados?')">Excluir</button>
                                </div>
                            </td>
                        </tr>
                    </tfoot>
                </table>
                <br><br>
            </form>
        </div>

    </div>
    <?php include(dirname(__FILE__) . '/../partials/rodape.php'); ?>
</body>
</html>
