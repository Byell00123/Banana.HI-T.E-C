<?php
include_once(dirname(__FILE__) . '/../../models/administradores/AdministradorModel.php');

// Instancia o model de usuários
$model = new AdministradorModel();

// Verifica se a requisição é do tipo POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dados_usuario = [
        'id_usuario' => $_POST['id_usuario'],
        'username' => $_POST['username'],
        'primeiro_nome' => $_POST['primeiro_nome'],
        'sobrenome' => $_POST['sobrenome'],
        'nascimento' => $_POST['nascimento'],
        'email' => $_POST['email'],
        'telefone' => $_POST['telefone'],
        'sexo' => $_POST['sexo'],
        'cpf' => $_POST['cpf']
    ];

    // Atualiza o usuário no banco de dados
    if ($model->atualizarUsuario($dados_usuario)) {
        FlashMessages::addMessage('success', "Usuário atualizado com sucesso!");
        header("Location: " . TEMPLATE_URL . "home/home_adm.php");
        exit();
    } else {
        FlashMessages::addMessage('error', "Erro ao atualizar o usuário.");
        header("Location: " . TEMPLATE_URL . "administradores/editar_u_adm.php?id=" . $_POST['id_usuario']);
        exit();
    }
}
