<?php include($_SERVER['DOCUMENT_ROOT'] . '/Banana.Hi-T.E-C/src/config.php');?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banana.Hi-T.E-C</title>
    <link rel="shortcut icon" href="<?php echo STATIC_URL; ?>icon/favicon/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo STATIC_URL; ?>css/base/base.css">
    <link rel="stylesheet" href="<?php echo STATIC_URL; ?>css/home/home_v.css">
</head>
<body>

    <?php include(TEMPLATE_PATH . 'partials/navbar_v.php'); ?>
    <!-- Conteúdo do site -->
    <div class="conteudo">
        <?php
            // Conexão com o banco de dados MySQL
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Verifica se uma marca foi selecionada e ajusta a query
            $marca = isset($_GET['marca']) && $_GET['marca'] != '' ? $_GET['marca'] : null;
            $sql = "SELECT id_produto, nome, tipo_produto, url_foto FROM produtos";
            if ($marca) {
                $sql .= " WHERE marca = '" . $conn->real_escape_string($marca) . "'";
            }
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $produtos_por_tipo = [];
                while ($row = $result->fetch_assoc()) {
                    $produtos_por_tipo[$row['tipo_produto']][] = $row;
                }
                foreach ($produtos_por_tipo as $tipo_produto => $produtos) {
                    echo "<div>\n";
                    echo "<h1 class=\"titulos\">$tipo_produto</h1>\n";
                    echo "<div class=\"list\">\n";
                    foreach ($produtos as $produto) {
                        $nome = htmlspecialchars($produto['nome']);
                        $url_foto = htmlspecialchars($produto['url_foto']);
                        $id_produto = htmlspecialchars($produto['id_produto']);
                        echo "<a class=\"list-itens\" href=\"" . TEMPLATE_URL . "produto/produto_v.php?id=$id_produto\">\n";
                        echo "<div class=\"itens\"><img class=\"iten-img\" src=\"$url_foto\" alt=\"\"><p class=\"iten-txt\">$nome</p></div>\n";
                        echo "</a>\n";
                    }
                    echo "</div>\n";
                    echo "</div>\n";
                }
            } else {
                echo "Nenhum produto encontrado.";
            }

            $conn->close();
        ?>
    </div>

    <?php include(TEMPLATE_PATH . 'partials/rodape.php'); ?>

</body>
</html>