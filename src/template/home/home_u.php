<?php include($_SERVER['DOCUMENT_ROOT'] . '/Banana.Hi-T.E-C/src/config.php');?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banana.Hi-T.E-C</title>
    <link rel="shortcut icon" href="<?php echo STATIC_URL; ?>icon/favicon/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo STATIC_URL; ?>css/base/base.css">
    <link rel="stylesheet" href="<?php echo STATIC_URL; ?>css/home/home_u.css">
</head>
<body>

    <?php include(TEMPLATE_PATH . 'partials/navbar_u.php'); ?>

    <!--conteudo do site-->
    <div class="conteudo">
        
        <!-- <div class="banner cupon">< href="#" target="_blank"><img src="../static/img/banners/banner-promocionais/banner3.png" alt="banner de ofertas"></div>

        <div>
            <h1 class="titulos">Marcas sugeridas</h1>
            <div class="list">
                <a class="list-itens" href="#">
                    <div class="itens"><img src="../static/img/xaropinho.jpg" alt=""><p>acer</p></div>
                </a>
                <a class="list-itens" href="#">
                    <div class="itens"><img src="../static/img/xaropinho.jpg" alt=""><p>lenovo</p></div>
                </a>
                <a class="list-itens" href="#">
                    <div class="itens"><img src="../static/img/xaropinho.jpg" alt=""><p>asus</p></div>
                </a>
                <a class="list-itens" href="#">
                    <div class="itens"><img src="../static/img/xaropinho.jpg" alt=""><p>samsung</p></div>
                </a>
                <a class="list-itens" href="#">
                    <div class="itens"><img src="../static/img/xaropinho.jpg" alt=""><p>dell</p></div>
                </a>
                <a class="list-itens" href="#">
                    <div class="itens"><img src="../static/img/xaropinho.jpg" alt=""><p>dell</p></div>
                </a>
                <a class="list-itens" href="#">
                    <div class="itens"><img src="../static/img/xaropinho.jpg" alt=""><p>dell</p></div>
                </a>
                <a class="list-itens" href="#">
                    <div class="itens"><img src="../static/img/xaropinho.jpg" alt=""><p>dell</p></div>
                </a>
                <a class="list-itens" href="#">
                    <div class="itens"><img src="../static/img/xaropinho.jpg" alt=""><p>dell</p></div>
                </a>
                <a class="list-itens" href="#">
                    <div class="itens"><img src="../static/img/xaropinho.jpg" alt=""><p>dell</p></div>
                </a>
            </div>
        </div>
        <div class="banner promocional"><a href="#" target="_blank"><img src="../static/img/banners/banner-promocionais/banner3.png" alt="banner de ofertas"></a></div>
        <div>
            <h1 class="titulos">Produtos sugeridos</h1>
            <div class="list">
                <a class="list-itens" href="#">
                    <div class="itens"><img class="iten-img" src="../static/img/produtos/" alt=""><p class="iten-txt">notebook-apple-macbook</p></div>
                </a>
                <a class="list-itens" href="#">
                    <div class="itens"><img class="iten-img" src="../static/img/produtos/" alt=""><p class="iten-txt">Monitores</p></div>
                </a>
                <a class="list-itens" href="#">
                    <div class="itens"><img class="iten-img" src="../static/img/produtos/" alt=""><p class="iten-txt">notebok2</p></div>
                </a>
                <a class="list-itens" href="#">
                    <div class="itens"><img class="iten-img" src="../static/img/produtos/" alt=""><p class="iten-txt">Teclados</p></div>
                </a>
                <a class="list-itens" href="#">
                    <div class="itens"><img class="iten-img" src="../static/img/produtos/" alt=""><p class="iten-txt">Fones</p></div>
                </a>
                <a class="list-itens" href="#">
                    <div class="itens"><img class="iten-img" src="../static/img/produtos/" alt=""><p class="iten-txt">notebook-apple-macbook</p></div>
                </a>
                <a class="list-itens" href="#">
                    <div class="itens"><img class="iten-img" src="../static/img/produtos/" alt=""><p class="iten-txt">Monitores</p></div>
                </a>
                <a class="list-itens" href="#">
                    <div class="itens"><img class="iten-img" src="../static/img/produtos/" alt=""><p class="iten-txt">notebok2</p></div>
                </a>
                <a class="list-itens" href="#">
                    <div class="itens"><img class="iten-img" src="../static/img/produtos/" alt=""><p class="iten-txt">Teclados</p></div>
                </a>
                <a class="list-itens" href="#">
                    <div class="itens"><img class="iten-img" src="../static/img/produtos/" alt=""><p class="iten-txt">Fones</p></div>
                </a>
            </div>
        </div>
        -->
        <?php
            // Conexão com o banco de dados MySQL
            $servername = "localhost";
            $username = "root";
            $password = "12345";
            $dbname = "banana_hitec";
            // Criando a conexão
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Verificando a conexão
            if ($conn->connect_error) {
                die("Falha na conexão: " . $conn->connect_error);
            }
            // Consultando os produtos
            $sql = "SELECT tipo_produto, nome, url_foto FROM produtos";
            $result = $conn->query($sql);
            // Verificando se há resultados
            if ($result->num_rows > 0) {
                // Agrupando os produtos por tipo_produto
                $produtos_por_tipo = [];
                while ($row = $result->fetch_assoc()) {
                    $produtos_por_tipo[$row['tipo_produto']][] = $row;
                }
                // Gerando o HTML
                foreach ($produtos_por_tipo as $tipo_produto => $produtos) {
                    echo "<div class=\"banner promocional\"><a href=\"#\" target=\"_blank\"><img src=\"../static/img/banners/banner-promocionais/banner3.png\" alt=\"banner de ofertas\"></a></div>";
                    //TODO: Depois tem que fazer esses banners serem colocados igual aos produtos usando o php pra buscar diferentes banners no MySQL
                    echo "<div>\n";
                    echo "<h1 class=\"titulos\">$tipo_produto</h1>\n";
                    echo "<div class=\"list\">\n";
                    foreach ($produtos as $produto) {
                        $nome = htmlspecialchars($produto['nome']);
                        $url_foto = htmlspecialchars($produto['url_foto']);
                        echo "<a class=\"list-itens\" href=\"#\">\n";
                        echo "<div class=\"itens\"><img class=\"iten-img\" src=\"$url_foto\" alt=\"\"><p class=\"iten-txt\">$nome</p></div>\n";
                        echo "</a>\n";
                    }
                    echo "</div>\n";
                    echo "</div>\n";
                }
            } else {
                echo "Nenhum produto encontrado.";
            }
            // Fechando a conexão
            $conn->close();
        ?>
    </div>

    <?php include(TEMPLATE_PATH . 'partials/rodape.php'); ?>

</body>
</html>