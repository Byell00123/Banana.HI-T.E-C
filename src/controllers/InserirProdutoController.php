<?php
// src/controllers/InserirProductController.php
include_once(dirname(__FILE__) . '/../config.php');
include_once(dirname(__FILE__) . '/../models/ProdutoModel.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    header("Location: " . TEMPLATE_URL . "produto/produto_v_inserir.php");
    exit();
}
// TODO: Outro dia Adicionar a mesma verificação de cnpj e user_cnpj
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifique se todos os campos obrigatórios foram preenchidos
    if (isset($_POST['nome'], $_POST['tipo_produto'], $_POST['preco'], $_POST['peso'], $_POST['qtd'], $_POST['descricao'], $_FILES['foto'])) {
        
        // Verificar o upload da imagem
        if ($_FILES['foto']['error'] === UPLOAD_ERR_OK) {
            // Obter dados do formulário
            $nome = $_POST['nome'];
            $tipo_produto = $_POST['tipo_produto'];
            $marca = $_SESSION['user_nome_fantasia'];
            // Convertendo o valor do preço para o formato aceito pelo MySQL
            $preco_formatado = str_replace(['.', ','], ['', '.'], $_POST['preco']); 
            $preco = (float)$preco_formatado;

            $peso = (float)$_POST['peso'];
            $qtd = $_POST['qtd'];
            $descricao = $_POST['descricao'];
            // Busca o cnpj do vendedor, cnpj esse que deve ter sido passado durante o processo de login.
            $fk_vendedor = $_SESSION["user_cnpj"];

            // Manipulação da imagem contando que todas sejam .jpg
            $nome_imagem_unico = uniqid('produto_', true) . '.jpg'; // Gerar nome de arquivo único com extensão .jpg
            // Caminho até a pasta de uploads, onde as imagens ficarão salvas
            $caminho_imagem = '../uploads/produtos/' . $nome_imagem_unico;

            // Movendo o arquivo para o diretório de uploads
            if (move_uploaded_file($_FILES['foto']['tmp_name'], $caminho_imagem)) {
                // Caminho da imagem que será salvo no banco de dados
                $url_foto = '../../uploads/produtos/' . $nome_imagem_unico; // Todas as imagens vão ser renderizadas a partir do template logo é nescessario voltar, somente, duas pasta para conseguir chegar na uploads/produtos,

                // Tente salvar o produto no banco de dados
                $resultado = salvarProduto($nome, $tipo_produto, $marca, $preco, $peso, $qtd, $descricao, $url_foto, $fk_vendedor);

                // Verificar se a inserção foi bem-sucedida
                if ($resultado) {
                    if (isset($_POST['inserir'])) {
                        header("Location: " . TEMPLATE_URL . "home/home_v.php");
                        exit();
                    } 
                    elseif (isset($_POST['inserirmais'])) {
                        FlashMessages::addMessage('success', "Produto inserido com sucesso.");
                        header("Location: " . TEMPLATE_URL . "produto/produto_v_inserir.php");
                        exit();
                    }
                } 
                else {
                    FlashMessages::addMessage('error', "Erro ao inserir produto.");
                    header("Location: " . TEMPLATE_URL . "produto/produto_v_inserir.php");
                    exit(); 
                }
            } 
            else {
                FlashMessages::addMessage('error', "Erro ao fazer upload da imagem.");
                header("Location: " . TEMPLATE_URL . "produto/produto_v_inserir.php");
                exit();
            }
        }
        else {
            FlashMessages::addMessage('error', "Erro ao enviar o arquivo.");
            header("Location: " . TEMPLATE_URL . "produto/produto_v_inserir.php");
            exit();
        }
    } 
    else {
        FlashMessages::addMessage('error', "Por favor, preencha todos os campos obrigatórios.");
        header("Location: " . TEMPLATE_URL . "produto/produto_v_inserir.php");
        exit();
    }
}

?>
