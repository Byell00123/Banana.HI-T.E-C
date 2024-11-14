<?php 
include_once(dirname(__FILE__) . '/../../models/ProdutoModel.php');
$ProdutoModel = new ProdutoModel;
// Obtenha os produtos usando a função do modelo
$produtos_por_tipo = $ProdutoModel->getProdutosPorTipo();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banana.HI-T.E-C</title>
    <link rel="shortcut icon" href="<?php echo STATIC_URL; ?>/icon/favicon/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo STATIC_URL; ?>css/home/home_u.css">
</head>
<body>

    <?php include(dirname(__FILE__) . '/../partials/navbar_u.php'); ?>

    <!-- Conteúdo do site -->
    <div class="conteudo">
        <?php if (true): ?>
            
        <?php endif; ?>
        <?php include(dirname(__FILE__) . '/../partials/mensagens.php'); ?>

        <?php if (!empty($produtos_por_tipo)): ?>
            <?php foreach ($produtos_por_tipo as $tipo_produto => $produtos): ?>
                <div class="banner promocional">
                    <a class="banner-a" href="#" target="_blank">
                        <img class="banner-img" src="<?php echo STATIC_URL; ?>img/banners/banner-promocionais/banner3.png" alt="banner de ofertas">
                    </a>
                </div>

                <div class="div">
                    <h1 class="titulos"><?php echo htmlspecialchars($tipo_produto); ?></h1>
                    <div class="list">
                        <?php foreach ($produtos as $produto): ?>
                            <a class="list-itens" href="#">
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
    </div>

    <?php include(dirname(__FILE__) . '/../partials/rodape.php'); ?>

</body>
</html>
