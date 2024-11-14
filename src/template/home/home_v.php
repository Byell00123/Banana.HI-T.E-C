<?php   
include_once(dirname(__FILE__) . '/../../models/VendedorModel.php');

// Verifica se o vendedor está logado
if (!$ProdutoModel->isVendedorLogado()) {
    // Se o vendedor não estiver logado, redireciona para a página de login
    FlashMessages::addMessage('error', "Faça login como vendedor para acessar essa área.");
    header("Location: " . TEMPLATE_URL . "cadastro-login/login_v.php");
    exit();
}

// Obtenha o nome fantasia do vendedor logado
$nome_fantasia_sessao = $_SESSION['user_nome_fantasia'];

// Verifica se a marca foi passada na URL
if (isset($_GET['marca'])) {
    $marca = $_GET['marca'];

    // Se a marca da URL for diferente do nome fantasia do vendedor logado, redireciona para a própria home
    if ($marca !== $nome_fantasia_sessao) {
        FlashMessages::addMessage('error', "Você não pode acessar a página de outro vendedor.");
        header("Location: " . TEMPLATE_URL . "home/home_v.php?marca=" . urlencode($nome_fantasia_sessao));
        exit();
    }
} else {
    // Se a marca não for informada, assume a marca do vendedor logado
    header("Location: " . TEMPLATE_URL . "home/home_v.php?marca=" . urlencode($nome_fantasia_sessao));
    exit();
}

// Obtenha os produtos filtrados pela marca
$produtos_por_marca = $ProdutoModel->getProdutosPorMarca($marca);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banana.HI-T.E-C</title>
    <link rel="shortcut icon" href="<?php echo STATIC_URL; ?>icon/favicon/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo STATIC_URL; ?>css/home/home_v.css">
</head>
<body>
    <!-- TODO: Deu pau na navbar, ficou gorda, suspeito do flexgrou = 1 no css de .navbar -->
    <?php include(dirname(__FILE__) . '/../partials/navbar_v.php'); ?>

    <div class="conteudo">
        <div>Olá vendedor <p style="color: red;display: inline;"><?php echo htmlspecialchars($_SESSION['user_nome_fantasia']); ?></p> de CNPJ: <p style="color: red;display: inline;"><?php echo htmlspecialchars($_SESSION['user_cnpj']); ?></p></div>

        <?php include(dirname(__FILE__) . '/../partials/mensagens.php'); ?>

        <?php if (!empty($produtos_por_marca)): ?>
            <?php foreach ($produtos_por_marca as $marca_produto => $produtos): ?>
                <div class="carrosel">
                    <h1 class="titulos"><?php echo htmlspecialchars($marca_produto); ?></h1>
                    <div class="list">
                        <?php foreach ($produtos as $produto): ?>
                            <a class="list-itens" href="<?php echo TEMPLATE_URL . 'produto/produto_v_editar.php?id=' . htmlspecialchars($produto['id_produto']); ?>">
                                <div class="itens">
                                    <img class="iten-img" src="<?php echo htmlspecialchars($produto['url_foto']); ?>" alt="">
                                    <p class="iten-txt"><?php echo htmlspecialchars($produto['nome']); ?></p>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Nenhum produto encontrado.</p>
        <?php endif; ?>

        <div class="div-link-inserir">
            <a class="link-inserir" href="<?php echo TEMPLATE_URL; ?>produto/produto_v_inserir.php" target="_blank">
                <div class="div-link-img"><img class="link-img" src="<?php echo STATIC_URL; ?>icon/links/plus.svg" alt="Botão para inserir produtos"></div>
            </a>
        </div>

    </div>

    <?php include(dirname(__FILE__) . '/../partials/rodape.php'); ?>

</body>
</html>
