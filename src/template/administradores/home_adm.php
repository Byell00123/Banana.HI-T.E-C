<?php 
include_once(dirname(__FILE__) . '/../../models/administradores/AdministradorModel.php');
include_once(dirname(__FILE__) . '/../../models/ProdutoModel.php');
// Verifica o estado do checkbox, se foi marcado ou não
$checkboxState = isset($_POST['toggleInput']) && $_POST['toggleInput'] === 'simplificada';


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banana.HI-T.E-C</title>
    <link rel="shortcut icon" href="<?php echo STATIC_URL; ?>icon/favicon/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo STATIC_URL; ?>css/home/home_v.css">
    <link rel="stylesheet" href="<?php echo STATIC_URL; ?>administradores/css/navbar_adm.css">
</head>
<body>

    <?php include(dirname(__FILE__) . '/../partials/administradores/navbar_adm.php'); ?>

    <!-- Conteúdo do site -->
    <div class="conteudo">
        <?php include(dirname(__FILE__) . '/../partials/mensagens.php'); ?>

        <!-- Verificação do estado do checkbox -->
        <?php if ($checkboxState): ?>
            <!-- Incluir visualização simplificada -->
            <?php include (dirname(__FILE__) . '/home_adm_simplis.php'); ?>
        <?php else: ?>
            <!-- Incluir visualização estilizada (padrão) -->
            <?php include (dirname(__FILE__) . '/home_adm_estilizada.php'); ?>
        <?php endif; ?>



        <div class="div-toggle">
            <label for="toggleInput">Adicionar Novo Tipo</label>
            <div class="toggle">
                <input type="checkbox" id="toggleInput" onclick="toggleInputType()">
            </div>
        </div>


    </div>

    <?php include(dirname(__FILE__) . '/../partials/rodape.php'); ?>
</body>
</html>
