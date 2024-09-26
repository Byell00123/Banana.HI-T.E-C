<?php
// src/controllers/EditarProdutoController.php
include_once(dirname(__FILE__) . '/../config.php');
include_once(dirname(__FILE__) . '/../models/ProductModel.php');

if ($_SERVER["REQUEST_METHOD"] == "GET") {

    if (isset($_GET['id'])) {
        $id_produto = intval($_GET['id']);  // Captura o ID do produto a partir da URL
        $produto = getProdutoPorId($id_produto);
    
        if ($produto) {
            // Passar os dados do produto para a View de edição
            include TEMPLATE_PATH . 'produto/produto_v_editar.php';
            
        } else {
            FlashMessages::addMessage('error', "Produto não encontrado.");
            header("Location: " . TEMPLATE_URL . "produto/produto_v_editar.php");
            exit();
        }
    } else {
        FlashMessages::addMessage('error', "ID do produto não especificado.");
        header("Location: " . TEMPLATE_URL . "produto/produto_v_editar.php");
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
    } elseif (isset($_POST['atualiza'])) {
        // Código para atualizar o produto
        if (isset($_POST['id_produto'], $_POST['nome'], $_POST['tipo_produto'], $_POST['marca'], $_POST['preco'], $_POST['peso'], $_POST['qtd'], $_POST['descricao'])) {
        
            $id_produto = intval($_POST['id_produto']);
            $nome = $conn->real_escape_string($_POST['nome']);
            $tipo_produto = $conn->real_escape_string($_POST['tipo_produto']);
            $marca = $conn->real_escape_string($_POST['marca']);
            $preco = $conn->real_escape_string($_POST['preco']);
            $peso = $conn->real_escape_string($_POST['peso']);
            $qtd = $conn->real_escape_string($_POST['qtd']);
            $descricao = $conn->real_escape_string($_POST['descricao']);
            // TODO fazer outro processo para definir quem vai ser o vendedor
            $fk_vendedores = $conn->real_escape_string($_POST['fk_vendedores']);
    
            // Recupera a foto atual do produto para manter se não houver nova foto
            $produto = getProdutoPorId($id_produto);
            $url_foto_atual = $produto['url_foto'];
    
            // Tratamento da nova foto
            if (isset($_FILES['nova_foto']) && $_FILES['nova_foto']['error'] == UPLOAD_ERR_OK) {
                $imagem = $_FILES['nova_foto'];
                $nome_imagem = strtolower(str_replace([' ', '_'], ['-', '_'], $imagem['name'])); // Transformar o nome da imagem
                $caminho_imagem = '../uploads/produtos/' . $nome_imagem; //
    
                // Movendo o arquivo para o diretório de uploads
                if (move_uploaded_file($imagem['tmp_name'], $caminho_imagem)) {
                    // Caminho da nova imagem que será salvo no banco de dados
                    $url_foto = '../../uploads/produtos/' . $nome_imagem; // caminho que vai para o banco de dados
                } else {
                    // Caso ocorra um erro no upload da nova imagem, mantém a foto antiga
                    $url_foto = $url_foto_atual;
                }
            } else {
                // Se o usuário não enviar uma nova foto, mantém a antiga
                $url_foto = $url_foto_atual;
            }
    
            // Chama a função do modelo para atualizar o produto
            $resultado = atualizarProduto($id_produto, $nome, $tipo_produto, $marca, $preco, $peso, $qtd, $descricao, $url_foto);
    
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
