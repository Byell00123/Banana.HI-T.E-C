<?php 
include_once(dirname(__FILE__) . '/../../models/ProdutoModel.php');
$ProdutoModel = new ProdutoModel;
$tipos_disponiveis = $ProdutoModel-> getTiposDisponiveis();
// Verifica se o vendedor está logado
if (!$ProdutoModel-> isVendedorLogado()) {
    // Se o vendedor não estiver logado, redireciona para a página de login
    FlashMessages::addMessage('error', "Faça login como vendedor caso queira acessar a área de vendedores.");
    header("Location: " . TEMPLATE_URL . "cadastro-login/login_v.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "GET"){
// Verifica se o ID do produto foi passado pela URL
    if (isset($_GET['id'])) {
        $id_produto = intval($_GET['id']);  // Captura o ID do produto a partir da URL
        $produto = $ProdutoModel-> getProdutoPorId($id_produto); // Obter o produto a partir do banco de dados

        // Obter o CNPJ do vendedor logado
        $cnpj_vendedor_logado = $_SESSION['user_cnpj'];

        // Verifica se o produto pertence ao vendedor logado
        if ($produto && $produto['fk_vendedor'] === $cnpj_vendedor_logado) {
            // O vendedor é dono do produto, permitir o acesso à página de edição
        } else {
            // Se não for o dono, redireciona para a home
            FlashMessages::addMessage('error', "Você não tem permissão para editar este produto.");
            header("Location: " . TEMPLATE_URL . "home/home_v.php");
            exit();
        }
    } else {
        // Se o ID do produto não for informado, redireciona para a página de erro ou home
        FlashMessages::addMessage('error', "ID do produto não especificado.");
        header("Location: " . TEMPLATE_URL . "home/home_v.php");
        exit();
    }
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
    <script src="https://cdn.jsdelivr.net/npm/cleave.js"></script>
    <script src="<?php echo STATIC_URL; ?>js/produto/produto.js" defer></script>  <!-- Adiciona o script externo -->
</head>
<body>

    <?php include(dirname(__FILE__) . '/../partials/navbar_v.php'); ?>

    <div class="conteudo">

        <div class="formulario">
            <form class="form" method="POST" action="../../controllers/EditarProdutoController.php" enctype="multipart/form-data">

                <h1>Editar Produto</h1>

                <?php include(dirname(__FILE__) . '/../partials/mensagens.php'); ?>
                
                <table border="1" cellpadding="10">
                    
                    <tr>
                        <input type="hidden" name="id_produto" value="<?php echo $produto['id_produto']; ?>">
                        <input type="hidden" name="fk_vendedor" value="<?php echo $produto['fk_vendedor']; ?>">
                        <td><label for="nome">Nome:</label></td>
                        <td><input type="text" class="input nome" name="nome" value="<?php echo htmlspecialchars($produto['nome']); ?>" required></td>
                    </tr>
                    <tr>
                        <td><label for="tipo_produto">Tipo de Produto:</label></td>
                        <td>
                            <div class="div-toggle">
                                <label class="label-select" for="toggleInput">Tipo Já Existente</label>
                                <div class="toggle">
                                    <input type="checkbox" id="toggleInput" onclick="toggleInputType()">
                                </div>
                                <label class="label-input" for="toggleInput">Adicionar Novo Tipo</label>
                            </div>
                            <div id="inputContainer">
                                <select class="input tipo_produto" name="tipo_produto" required>
                                    <option value="<?php echo htmlspecialchars($produto['tipo_produto']); ?>"><?php echo htmlspecialchars($produto['tipo_produto']); ?></option>
                                    <hr>
                                    <?php if (!empty($tipos_disponiveis)): ?>
                                        <?php foreach ($tipos_disponiveis as $tipo): ?>
                                            <?php if ($tipo != $produto['tipo_produto']): ?>
                                                <option value="<?php echo htmlspecialchars($tipo); ?>"><?php echo htmlspecialchars($tipo); ?></option>
                                                <hr>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                        </td> 
                    </tr>
                    <tr>
                        <td><label for="preco">Preço:</label></td>
                        <td><input type="text" class="input preco" name="preco" value="<?php echo htmlspecialchars($produto['preco']); ?>" required></td>
                    </tr>
                    <tr>
                        <td><label for="peso">Peso:</label></td>
                        <td><input type="text" class="input peso" name="peso" value="<?php echo htmlspecialchars($produto['peso']); ?>" required></td>
                    </tr>
                    <tr>
                        <td><label for="qtd">Quantidade:</label></td>
                        <td><input type="text" class="input qtd" name="qtd" value="<?php echo htmlspecialchars($produto['qtd']); ?>" required></td>
                    </tr>
                    <tr>
                        <td><label for="descricao">Descrição:</label></td>
                        <td><textarea type="text" class="input descricao" name="descricao" required><?php echo htmlspecialchars($produto['descricao']); ?></textarea></td>
                    </tr>
                    <tr>
                        <td><label for="url_foto">Foto Atual:</label></td> 
                        <td>
                            <img src="<?php echo htmlspecialchars($produto['url_foto']); ?>" alt="Foto do Produto" style="width: 200px; height: 200px;">
                        </td>
                    </tr>
                    <tr>
                        <td><label for="nova_foto">Nova Foto:</label></td><!-- TODO: FAzer o nome proprio para quando trocar de imagem -->
                        <td>
                            <input type="file" class="input nova_foto" name="nova_foto" accept=".jpg">
                            <pre class="td-pre">
Recomendações:
    Somente imagens em formato JPG.
    Opte por imagens nativamente 200x200 pixels, pois imagens maiores que isso serão redimensionadas para 200x200 pixels podendo ocasionar em distorções na imagem.
                            </pre>
                        </td>
                    </tr>
                </table>
                <div class="form-group link-botao">
                    <div class="links-auxiliares">
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
