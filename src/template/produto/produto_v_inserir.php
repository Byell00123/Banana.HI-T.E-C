<?php 
include_once(dirname(__FILE__) . '/../../models/ProdutoModel.php');
$ProdutoModel = new ProdutoModel;
$tipos_disponiveis = $ProdutoModel-> getTiposDisponiveis(); 
// TODO: Falta bloquear para que somente os vendedores posssam acessar

// Verifica se o vendedor está logado
if (!$ProdutoModel-> isVendedorLogado()) {
    // Se o vendedor não estiver logado, redireciona para a página de login
    FlashMessages::addMessage('error', "Faça login como vendedor para acessar essa área.");
    header("Location: " . TEMPLATE_URL . "cadastro-login/login_v.php");
    exit();
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
            <form class="form inserir-produto" method="POST" action="../../controllers/InserirProdutoController.php" enctype="multipart/form-data">

                <h1>Inserir Produto</h1>

                <?php include(dirname(__FILE__) . '/../partials/mensagens.php'); ?>

                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input type="text" class="input nome" name="nome" required>
                </div>
                <div class="form-group">
                    <label for="tipo_produto">Tipo de Produto:</label>
                    <div class="div-toggle">
                        <label class="label-select" for="toggleInput">Tipo Já Existente</label>
                        <div class="toggle">
                            <input type="checkbox" id="toggleInput" onclick="toggleInputType()">
                        </div>
                        <label class="label-input" for="toggleInput">Adicionar Novo Tipo</label>
                    </div>
                    <div id="inputContainer">
                        <select class="input tipo_produto" name="tipo_produto" required>
                            <option hidden></option>
                            <?php if (!empty($tipos_disponiveis)): ?>
                                <?php foreach ($tipos_disponiveis as $tipo): ?>
                                    <option value="<?php echo htmlspecialchars($tipo); ?>"><?php echo htmlspecialchars($tipo); ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="preco">Preço:</label>
                    <input type="text" class="input preco" name="preco" maxlength="10" placeholder="000.000,00" required>
                </div>
                <div class="form-group">
                    <label for="peso">Peso(Kg):</label>
                    <input type="text" class="input peso" name="peso" placeholder="000,00" required>
                </div>
                <div class="form-group">
                    <label for="peso">Quantidade:</label>
                    <input type="text" class="input qtd" name="qtd" maxlength="7"  placeholder="000.000" required>
                </div>
                <div class="form-group">
                    <label for="descricao">Descricão:</label>
                    <textarea type="text" class="input descricao" name="descricao" required></textarea>
                </div>
                <div class="form-group">
                    <label for="foto">Foto:</label>
                    <input type="file" class="input foto" name="foto" accept=".jpg" required>
                    <pre class="td-pre">
Recomendações:
    Somente imagens em formato JPG.
    Opte por imagens nativamente 200x200 pixels, pois imagens maiores que isso serão redimensionadas para 200x200 pixels podendo ocasionar em distorções na imagem.
                    </pre>
                </div>

                <div class="form-group link-botao">
                    <div class="links-auxiliares">
                        <button class="botao-form c1" type="submit" name="inserir">Inserir</button>
                        <div class="gambiarra"></div>
                        <button class="botao-form c2" type="submit" name="inserirmais">Inserir e ir para o próximo produto</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php include(dirname(__FILE__) . '/../partials/rodape.php'); ?>
</body>
</html>
