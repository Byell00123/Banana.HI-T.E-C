<?php include(dirname(__FILE__) . '/../../controllers/VendedorHomeController.php'); 

$controller = new VendedorHomeController(); 
$produtos_por_marca = $controller->handleRequest(); 
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
    
    <?php include(dirname(__FILE__) . '/../partials/navbar_v.php'); ?>

    <div class="conteudo">
        <?php include(dirname(__FILE__) . '/../partials/mensagens.php'); ?>
        <div class="perfil">
            <div class="perfil-foto">
                <img class="perfil-foto-img" src="<?php echo STATIC_URL; ?>img/perfil/FOTOs/FOTO1.png" alt="imagem de perfil">
            </div>
            <div class="perfil-nome-cnpj">
                <div class="perfil-nome">Nome Fantasia: <p class="informacoes"><?php echo htmlspecialchars($_SESSION['user_nome_fantasia']);?></p></div>
                <div class="perfil-cnpj">CNPJ: <p class="informacoes"><?php echo htmlspecialchars($_SESSION['user_cnpj']); ?></p></div>
                <div class="perfil-nome">Email: <p class="informacoes"><?php echo htmlspecialchars($_SESSION['user_email']);?></p></div>
                <div class="perfil-cnpj">Telefone: <p class="informacoes"><?php echo htmlspecialchars($_SESSION['user_telefone']); ?></p></div>
            </div>
        </div>
        

        <?php if (!empty($produtos_por_marca)): ?>
            <?php foreach ($produtos_por_marca as $marca_produto => $produtos): ?>
                <div class="carrosel">
                    <h1 class="titulos"><?php echo htmlspecialchars($marca_produto); ?></h1>
                    <div class="list">
                        <?php foreach ($produtos as $produto): ?>
                            <a class="list-itens" href="<?php echo TEMPLATE_URL . 'produto/produto_v_editar.php?id=' . htmlspecialchars($produto['id_produto']); ?>">
                                <div class="itens">
                                    <img class="iten-img" src="<?php echo htmlspecialchars($produto['url_foto']); ?>" alt="Imagem do produto">
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
