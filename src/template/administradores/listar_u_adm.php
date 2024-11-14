<?php 
include_once(dirname(__FILE__) . '/../../models/administradores/AdministradorModel.php');
$model = new AdministradorModel();
$usuarios = $model->getUsuarios();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banana.HI-T.E-C</title>
</head>
<body>

    <h2>Lista de Usuários</h2>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Apelido</th>
            <th>Senha</th>
            <th>Primeiro Nome</th>
            <th>Sobrenome</th>
            <th>Data de Nascimento</th>
            <th>Email</th>
            <th>Telefone</th>
            <th>Sexo</th>
            <th>CPF</th>
            <th>Data de Ingresso</th>
            <th>Último Login</th>
            <th>Status</th>
            <th>Grupo</th>
        </tr>
        <?php foreach ($usuarios as $usuario): ?>
            <tr>
                <td><a href="<?php echo TEMPLATE_URL; ?>administradores/editar_u_adm.php?id_usuario=<?php echo htmlspecialchars($usuario['id_usuario']); ?>"><?php echo htmlspecialchars($usuario['id_usuario']); ?></a></td>
                <td><a href="<?php echo TEMPLATE_URL; ?>administradores/editar_u_adm.php?id_usuario=<?php echo htmlspecialchars($usuario['id_usuario']); ?>"><?php echo htmlspecialchars($usuario['nome_usuario']); ?></a></td>
                <td><?php echo str_repeat('*', 1); ?></td>
                <td><?php echo htmlspecialchars($usuario['primeiro_nome']); ?></td>
                <td><?php echo htmlspecialchars($usuario['sobrenome']); ?></td>
                <td><?php echo htmlspecialchars($usuario['data_nascimento']); ?></td>
                <td><?php echo htmlspecialchars($usuario['email']); ?></td>
                <td><?php echo htmlspecialchars($usuario['telefone']); ?></td>
                <td><?php echo htmlspecialchars($usuario['sexo']); ?></td>
                <td><?php echo htmlspecialchars($usuario['cpf']); ?></td>
                <td><?php echo htmlspecialchars($usuario['data_engressou']); ?></td>
                <td><?php echo htmlspecialchars($usuario['ultimo_login']); ?></td>
                <td><?php echo htmlspecialchars($usuario['status']); ?></td>
                <td><?php echo htmlspecialchars($usuario['fk_grupo']); ?></td>
                <td><a href="<?php echo TEMPLATE_URL; ?>administradores/editar_u_adm.php?id=<?php echo htmlspecialchars($usuario['id_usuario']); ?>">Editar</a></td>
                <td><button>Excluir</button></td>
            </tr>
        <?php endforeach; ?>
    </table>

</body>
</html>
