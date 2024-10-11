<?php 
include_once (dirname(__FILE__) . '/../../models/ProdutoModel.php');
// TODO: Por favor não mexa aqui!! o codigo só funciona se estiver dessa exata forma e não me pergunte o porque.
if (isset($_GET['id'])) {
    $id_produto = intval($_GET['id']);  // Captura o ID do produto a partir da URL
    $produto = getProdutoPorId($id_produto);
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banana.HI-T.E-C</title>
    <link rel="shortcut icon" href="<?php echo STATIC_URL; ?>icon/favicon/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo STATIC_URL; ?>css/produto/produto_v.css">
</head>
<body>

    <?php include(dirname(__FILE__) . '/../partials/navbar_v.php'); ?>

    <div class="conteudo">

        <div class="formulario">
            <form class="form" method="POST" action="../../controllers/EditarProdutoController.php" enctype="multipart/form-data">

                <h1>Editar Produto</h1>

                <?php if ($flash_messages): ?>
                    <?php foreach ($flash_messages as $flash_message): ?>
                        <div class="<?php echo $flash_message['type']; ?>" style="color: <?php echo $flash_message['type'] == 'error' ? 'red' : 'green'; ?>;">
                            <?php echo $flash_message['message']; ?>
                        </div>
                    <?php endforeach;?>
                <?php endif; ?>
                
                <table border="1" cellpadding="10">
                    
                    <tr>
                        <input type="hidden" name="id_produto" value="<?php echo $produto['id_produto']; ?>">
                        <td><label for="nome">Nome:</label></td>
                        <td><input type="text" class="input nome" name="nome" value="<?php echo htmlspecialchars($produto['nome']); ?>"></td>

                    </tr>
                    <tr>
                        <td><label for="tipo_produto">Tipo de Produto:</label></td>
                        <td><input type="text" class="input tipo_produto" name="tipo_produto" value="<?php echo htmlspecialchars($produto['tipo_produto']); ?>"></td>
                    </tr>
                    <tr>
                        <td><label for="marca">Marca:</label></td>
                        <td><input type="text" class="input marca" name="marca" value="<?php echo htmlspecialchars($produto['marca']); ?>"></td>
                    </tr>
                    <tr>
                        <td><label for="preco">Preço:</label></td>
                        <td><input type="text" class="input preco" name="preco" value="<?php echo htmlspecialchars($produto['preco']); ?>"></td>
                    </tr>
                    <tr>
                        <td><label for="peso">Peso:</label></td>
                        <td><input type="text" class="input peso" name="peso" value="<?php echo htmlspecialchars($produto['peso']); ?>"></td>
                    </tr>
                    <tr>
                        <td><label for="qtd">Quantidade:</label></td>
                        <td><input type="text" class="input qtd" name="qtd" value="<?php echo htmlspecialchars($produto['qtd']); ?>"></td>
                    </tr>
                    </tr>
                    <tr>
                        <td><label for="qtd">Descrição:</label></td>
                        <td><input type="text" class="input descricao" name="descricao" value="<?php echo htmlspecialchars($produto['descricao']); ?>"></td>
                    </tr>
                    <tr>
                        <td><label for="url_foto">Foto Atual:</label></td>
                        <td>
                            <img src="<?php echo htmlspecialchars($produto['url_foto']); ?>" alt="Foto do Produto" style="width: 200px; height: 200px;">
                        </td>
                    </tr>
                    <tr>
                        <td><label for="nova_foto">Nova Foto:</label></td>
                        <td>
                            <input type="file" class="input nova_foto" name="nova_foto" accept=".jpg">
                            <pre class="td-pre">
Recomendações:
    Somente imagens em formato JPG.
    Opte por imagens nativamente 200x200 pixels, pois imagens maiores que isso serão redimensionadas para 200x200 pixels podendo ocasionar em distorções na imagem.
    <!-- TODO: tem que adicionar para quebra linha -->
                            </pre>
                        </td>
                    </tr>
                </table>
                <div class="form-group link-botao">
                    <div class="links-auxiliares">
                    <!-- TODO: Tem que fazer a distinção do botão epertado -->
                        <button class="botao-form c1" name="atualiza" type="submit">Atualizar Produto</button>
                        <div class="gambiarra"></div>
                        <button class="botao-form c2" type="submit" name="deleta" onclick="return confirm('Tem certeza que deseja excluir este produto?')">Excluir Produto</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php include(dirname(__FILE__) . '/../partials/rodape.php'); ?>

</body>
</html>