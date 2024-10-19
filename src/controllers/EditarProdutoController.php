<?php
// src/controllers/EditarProdutoController.php
include_once(dirname(__FILE__) . '/../config.php');
include_once(dirname(__FILE__) . '/../models/ProdutoModel.php');

// Verifica se o vendedor está logado
if (!isVendedorLogado()) {
    // Se o vendedor não estiver logado, redireciona para a página de login
    FlashMessages::addMessage('error', "Faça login como vendedor caso queira acessar a área de vendedores.");
    header("Location: " . TEMPLATE_URL . "cadastro-login/login_v.php");
    exit();
}

// Obter o CNPJ do vendedor logado
$cnpj_vendedor_logado = $_SESSION['user_cnpj'];

if ($_SERVER["REQUEST_METHOD"] == "GET"){
    // Verificar se o ID do produto foi passado
    if (isset($_GET['id'])) {
        $id_produto = intval($_GET['id']);  // Captura o ID do produto a partir da URL
        $produto = getProdutoPorId($id_produto); // Obter o produto a partir do banco de dados

        // Verificar se o produto pertence ao vendedor logado
        if ($produto && $produto['fk_vendedor'] === $cnpj_vendedor_logado) {
            // O vendedor é dono do produto, permitir o acesso à página de edição
        } else {
            // Se não for o dono, redireciona para uma página de erro ou home
            FlashMessages::addMessage('error', "Você não tem permissão para editar este produto.");
            header("Location: " . TEMPLATE_URL . "home/home_v.php");
            exit();
        }
    }
    else { // Se o ID do produto não for infordo, redireciona para a home ou página de erro
        FlashMessages::addMessage('error', "ID do produto não especificado.");
        header("Location: " . TEMPLATE_URL . "home/home_v.php");
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cnpj = $_SESSION['user_cnpj'];
    $fk_vendedor = $_POST['fk_vendedor'];
    if ($cnpj != $fk_vendedor) {
        FlashMessages::addMessage('error', "Você não tem permissão para alterar esse produto.");
        header("Location: " . TEMPLATE_URL . "home/home_v.php"); // Redireciona de volta para a propria home_v
        exit();
    }
    if (isset($_POST['deleta'])) {
        // Código para excluir o produto
        if (isset($_POST['id_produto'])) {
            $id_produto = intval($_POST['id_produto']);
            $resultado = excluirProduto($id_produto);

            if ($resultado) {
                FlashMessages::addMessage('success', "Produto excluído com sucesso.");
                header("Location: " . TEMPLATE_URL . "home/home_v.php"); // Redireciona após a exclusão
                exit();
            } else {
                FlashMessages::addMessage('error', "Erro ao excluir o produto.");
            }
        }
    } 
    elseif (isset($_POST['atualiza'])) {
        // Verifica se todos os campos foram preechidos de novo
        if (isset($_POST['id_produto'], $_POST['nome'], $_POST['tipo_produto'], $_POST['preco'], $_POST['peso'], $_POST['qtd'], $_POST['descricao'])) {
        
            $id_produto = intval($_POST['id_produto']);
            $nome = $conn->real_escape_string($_POST['nome']);
            $tipo_produto = $conn->real_escape_string($_POST['tipo_produto']);
            $preco = $conn->real_escape_string($_POST['preco']);
            $peso = $conn->real_escape_string($_POST['peso']);
            $qtd = $conn->real_escape_string($_POST['qtd']);
            $descricao = $conn->real_escape_string($_POST['descricao']);

            // Recupera a foto atual do produto para manter se não houver nova foto
            $produto = getProdutoPorId($id_produto);
            $url_foto_atual = $produto['url_foto'];

            // Tratamento da nova foto
            if (isset($_FILES['nova_foto']) && $_FILES['nova_foto']['error'] == UPLOAD_ERR_OK) {
                $imagem = $_FILES['nova_foto'];
                $extensao = pathinfo($imagem['name'], PATHINFO_EXTENSION);
                $novo_nome_imagem = uniqid('produto_', true) . '.' . $extensao; // Nome único para a imagem
                $caminho_imagem = '../uploads/produtos/' . $novo_nome_imagem; //

                // Movendo o arquivo para o diretório de uploads
                if (move_uploaded_file($imagem['tmp_name'], $caminho_imagem)) {
                    // Caminho da nova imagem que será salvo no banco de dados
                    $url_foto = '../../uploads/produtos/' . $novo_nome_imagem; // caminho que vai para o banco de dados
                } else {
                    // Caso ocorra um erro no upload da nova imagem, mantém a foto antiga
                    $url_foto = $url_foto_atual;
                }
            } else {
                // Se o usuário não enviar uma nova foto, mantém a antiga
                $url_foto = $url_foto_atual;
            }

            // Chama a função do modelo para atualizar o produto
            $resultado = atualizarProduto($id_produto, $nome, $tipo_produto, $preco, $peso, $qtd, $descricao, $url_foto);

            if ($resultado) {
                FlashMessages::addMessage('success', "Produto atualizado com sucesso.");
                header("Location: " . TEMPLATE_URL . "produto/produto_v_editar.php?id=" . $id_produto);
                exit();
            } else {
                FlashMessages::addMessage('error', "Erro ao atualizar o produto.");
            }
        }
    }
}
?>
