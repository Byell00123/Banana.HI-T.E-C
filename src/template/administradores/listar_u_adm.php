<?php 
include_once(dirname(__FILE__) . '/../../models/administradores/AdministradorModel.php');
$usuarios = getUsuarios();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banana.HI-T.E-C</title>
    <link rel="shortcut icon" href="<?php echo STATIC_URL; ?>icon/favicon/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo STATIC_URL; ?>css/home/home_v.css">
    <link rel="stylesheet" href="<?php echo STATIC_URL; ?>administradores/css/navbar_adm.css">
</head>
<body>

    <?php include(dirname(__FILE__) . '/../partials/administradores/navbar_adm.php'); ?>

    <!-- Conteúdo do site -->
    <div class="conteudo">
        <?php include(dirname(__FILE__) . '/../partials/mensagens.php'); ?>

        <!-- Tabela de usuários -->
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome de Usuário</th>
                    <th>Email</th>
                    <th>Data de Criação</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $usuario): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($usuario['id_usuario']); ?></td>
                        <td><?php echo htmlspecialchars($usuario['username']); ?></td>
                        <td><?php echo htmlspecialchars($usuario['email']); ?></td>
                        <td><?php echo htmlspecialchars($usuario['data_criacao']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <?php include(dirname(__FILE__) . '/../partials/rodape.php'); ?>
</body>
</html>
