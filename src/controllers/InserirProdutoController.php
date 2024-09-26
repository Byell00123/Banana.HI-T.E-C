<?php
// src/controllers/ProductController.php
include_once(dirname(__FILE__) . '/../config.php');
include_once(dirname(__FILE__) . '/../models/ProductModel.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    header("Location: " . TEMPLATE_URL . "produto/produto_v_inserir.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifique se todos os campos obrigatórios foram preenchidos
    if (isset($_POST['nome'], $_POST['tipo_produto'], $_POST['marca'], $_POST['preco'], $_POST['peso'], $_POST['qtd'], $_POST['descricao'], $_FILES['url_foto'], $_POST['fk_vendedores'])) {
        //TODO: é preciso melhoarr sitema de comparacação pois dois  
        // Verificar o upload da imagem
        if ($_FILES['url_foto']['error'] === UPLOAD_ERR_OK) {
            // Obter dados do formulário
            $nome = $_POST['nome'];
            $tipo_produto = $_POST['tipo_produto'];
            $marca = $_POST['marca'];
            // Convertendo o valor do preço para o formato aceito pelo MySQL
            $preco_formatado = str_replace(['.', ','], ['', '.'], $_POST['preco']); 
            $preco = (float)$preco_formatado;
            
            $peso = (float)$_POST['peso'];
            $qtd = (int)$_POST['qtd'];
            $descricao = $_POST['descricao'];
            $fk_vendedores = (int)$_POST['fk_vendedores'];

            // Manipulação da imagem
            $imagem = $_FILES['url_foto'];
            $nome_imagem = strtolower(str_replace([' ', '-'], ['_'], $imagem['name'])); // Transformar o nome da imagem
            $caminho_imagem = '../uploads/produtos/' . $nome_imagem; // caminho ate o pasta de uploados, onde a imagens ficarão salvas
            
            
            // Movendo o arquivo para o diretório de uploads
            if (move_uploaded_file($imagem['tmp_name'], $caminho_imagem)) {
                // Caminho da imagem que será salvo no banco de dados
                    
                $url_foto = '../../uploads/produtos/' . $nome_imagem; // Todas as imagens renderizadas a partir do template logo é nescessario voltar duas pasta para conseguir chegar na uploads/produtos

                // Tente salvar o produto no banco de dados
                $resultado = salvarProduto($nome, $tipo_produto, $marca, $preco, $peso, $qtd, $descricao, $url_foto, $fk_vendedores);

                // Verificar se a inserção foi bem-sucedida
                if ($resultado) {
                    if (isset($_POST['inserir'])) {
                        header("Location: " . TEMPLATE_URL . "home/home_v.php");
                        exit();
                    } elseif (isset($_POST['inserirmais'])) {
                        FlashMessages::addMessage('success', "Produto inserido com sucesso.");
                        header("Location: " . TEMPLATE_URL . "produto/produto_v_inserir.php");
                        exit();
                    }
                } else {
                    FlashMessages::addMessage('error', "Erro ao inserir produto.");
                    header("Location: " . TEMPLATE_URL . "produto/produto_v_inserir.php");
                    exit(); 
                }
            } else {
                FlashMessages::addMessage('error', "Erro ao fazer upload da imagem.");
                header("Location: " . TEMPLATE_URL . "produto/produto_v_inserir.php");
                exit();
            }
        } else {
            FlashMessages::addMessage('error', "Erro ao enviar o arquivo.");
            header("Location: " . TEMPLATE_URL . "produto/produto_v_inserir.php");
            exit();
        }
    } else {
        FlashMessages::addMessage('error', "Por favor, preencha todos os campos obrigatórios.");
        header("Location: " . TEMPLATE_URL . "produto/produto_v_inserir.php");
        exit();
    }
}


?>