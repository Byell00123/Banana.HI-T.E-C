<?php
// src/controllers/EditarProdutoController.php
include_once $_SERVER['DOCUMENT_ROOT'] . '/Banana.HI-T.E-C/src/config.php';
include_once MODEL_PATH . 'ProductModel.php';

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



?>
