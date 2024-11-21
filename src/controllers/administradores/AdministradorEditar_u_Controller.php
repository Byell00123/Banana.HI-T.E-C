<?php
// src/controller/administradores/AdministradorEditar_u_Controller.php
include_once(dirname(__FILE__) . '/../../config.php');
include_once(dirname(__FILE__) . '/../../models/administradores/AdministradorModel.php');
include_once(dirname(__FILE__) . '/../../utils/FlashMessages.php');
$flash_messages = FlashMessages::getMessages();
$modelA = new AdministradorModel();


// Verifica se a requisição é do tipo POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {


    // Verifica se o botão de exclusão individual foi pressionado
    if (isset($_POST['excluiresse'])) {
        // Código para excluir um único usuário
        if (isset($_POST['id_usuario'])) {
            $id_usuario = intval($_POST['id_usuario']);
            $resultado = $modelA->excluirUsuario($id_usuario);

            if ($resultado) {
                FlashMessages::addMessage('success', "Usuário excluído com sucesso.");
                header("Location: " . TEMPLATE_URL . "administradores/listar_u_adm.php"); // Redireciona após a exclusão
                exit();
            } else {
                FlashMessages::addMessage('error', "Erro ao excluir o usuário.");
                header("Location: " . TEMPLATE_URL . "administradores/listar_u_adm.php");
            }
        }
    }
       // Exclusão em massa
    if (isset($_POST['excluirselecionados'])) {
        if (isset($_POST['id_usuario']) && is_array($_POST['id_usuario'])) {
            $ids_para_excluir = $_POST['id_usuario'];
            $quantidade_excluida = 0;

            // Itera sobre os IDs e tenta excluir
            foreach ($ids_para_excluir as $id_usuario) {
                $id_usuario = intval($id_usuario);
                $resultado = $modelA->excluirUsuario($id_usuario);

                if ($resultado) {
                    $quantidade_excluida++;
                }
            }

            if ($quantidade_excluida > 0) {
                FlashMessages::addMessage('success', "$quantidade_excluida usuário(s) excluído(s) com sucesso.");
            } else {
                FlashMessages::addMessage('error', "Erro ao excluir os usuários selecionados.");
            }

            header("Location: " . TEMPLATE_URL . "administradores/listar_u_adm.php");
            exit();
        } else {
            FlashMessages::addMessage('error', "Nenhum usuário selecionado para exclusão.");
            header("Location: " . TEMPLATE_URL . "administradores/listar_u_adm.php");
            exit();
        }
    }

    $dados_usuario = [
        'id_usuario' => $_POST['id_usuario'],
        'apelido' => $_POST['apelido'],
        'primeiro_nome' => $_POST['primeiro_nome'],
        'sobrenome' => $_POST['sobrenome'],
        'nascimento' => $_POST['nascimento'],
        'telefone' => $_POST['telefone'],
        'email' => $_POST['email'],
        'sexo' => $_POST['sexo'],
        'cpf' => $_POST['cpf'],
    ];

    // Atualiza o usuário no banco de dados
    if ($modelA->atualizarUsuario($dados_usuario)) {
        FlashMessages::addMessage('success', "Usuário atualizado com sucesso!");
        header("Location: " . TEMPLATE_URL . "administradores/editar_u_adm.php?id_usuario=" . $_POST['id_usuario']);
        exit();
    } else {
        FlashMessages::addMessage('error', "Erro ao atualizar o usuário.");
        header("Location: " . TEMPLATE_URL . "administradores/editar_u_adm.php?id_usuario=" . $_POST['id_usuario']);
        exit();
    }
}