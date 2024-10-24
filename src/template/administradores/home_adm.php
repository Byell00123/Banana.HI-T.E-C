<?php 
include_once(dirname(__FILE__) . '/../../models/administradores/AdministradorModel.php');
//include_once(dirname(__FILE__) . '/../../models/ProductModel.php');
// Obtenha a marca selecionada (se houver)
$marca = isset($_GET['marca']) && $_GET['marca'] !== '' ? $_GET['marca'] : null;

// Obtenha os produtos filtrados pela marca, se especificada
//$produtos_por_marca = getProdutosPorMarca($marca);

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

    <?php include(dirname(__FILE__) . '/../partials/administradores/navbar_adm.php'); ?>

    
    <!-- Conteúdo do site -->
    <div class="conteudo">
        
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
        <div class="div-link-inserir" >
            <a class="link-inserir" href="<?php echo TEMPLATE_URL; ?>produto/produto_v_inserir.php" target="_blank">
                <div class="div-link-img"><img class="link-img" src="<?php echo STATIC_URL; ?>icon/links/plus.svg" alt="Botão para inserir produtos"></div>
            </a>
        </div>

    </div>

    <?php include(dirname(__FILE__) . '/../partials//rodape.php'); ?>

</body>
</html>
