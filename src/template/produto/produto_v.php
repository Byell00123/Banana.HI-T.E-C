<?php
include($_SERVER['DOCUMENT_ROOT'] . '/Banana.Hi-T.E-C/src/config.php');

$produto = null;

if (isset($_GET['id'])) {
    $id_produto = intval($_GET['id']);  // Captura o ID do produto a partir da URL
    $sql = "SELECT * FROM produtos WHERE id_produto = $id_produto";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $produto = $result->fetch_assoc();  // Obtém os dados do produto
    } else {
        echo "Produto não encontrado.";
        exit;
    }
} else {
    echo "ID do produto não especificado.";
    exit;
}

// Função para redimensionar a imagem
function redimensionarImagem($arquivo, $largura, $altura) {
    list($largura_original, $altura_original) = getimagesize($arquivo);
    $imagem_redimensionada = imagecreatetruecolor($largura, $altura);
    $imagem_origem = imagecreatefromjpeg($arquivo);
    imagecopyresampled($imagem_redimensionada, $imagem_origem, 0, 0, 0, 0, $largura, $altura, $largura_original, $altura_original);
    return $imagem_redimensionada;
}

// Verifica se o formulário de atualização foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $conn->real_escape_string($_POST['nome']);
    $tipo_produto = $conn->real_escape_string($_POST['tipo_produto']);
    $marca = $conn->real_escape_string($_POST['marca']);
    $preco = floatval($_POST['preco']);
    
    // Verifica se uma nova foto foi enviada
    if (isset($_FILES['nova_foto']) && $_FILES['nova_foto']['error'] == 0) {
        $foto_info = pathinfo($_FILES['nova_foto']['name']);
        $extensao = strtolower($foto_info['extension']);

        if ($extensao == 'jpg') {
            $novo_caminho = $_SERVER['DOCUMENT_ROOT'] . STATIC_URL . 'img/produtos/' . $id_produto . '.jpg';
            $imagem_redimensionada = redimensionarImagem($_FILES['nova_foto']['tmp_name'], 200, 200);
            imagejpeg($imagem_redimensionada, $novo_caminho);
            imagedestroy($imagem_redimensionada);
            imagedestroy($imagem_origem);
            $url_foto = STATIC_URL . 'img/produtos/' . $id_produto . '.jpg';
        } else {
            echo "Por favor, envie uma imagem no formato JPG.";
            exit;
        }
    } else {
        $url_foto = $produto['url_foto'];
    }

    $sql_update = "UPDATE produtos SET nome = '$nome', tipo_produto = '$tipo_produto', marca = '$marca', preco = $preco, url_foto = '$url_foto' WHERE id_produto = $id_produto";

    if ($conn->query($sql_update) === TRUE) {
        // Atualiza os dados do produto para refletir as mudanças
        $produto = [
            'nome' => $nome,
            'tipo_produto' => $tipo_produto,
            'marca' => $marca,
            'preco' => $preco,
            'url_foto' => $url_foto,
        ];
        // echo "Produto atualizado com sucesso.";
    } else {
        echo "Erro ao atualizar o produto: " . $conn->error;
    }
}

// Verifica se o botão de exclusão foi acionado
if (isset($_POST['delete'])) {
    $sql_delete = "DELETE FROM produtos WHERE id_produto = $id_produto";
    
    if ($conn->query($sql_delete) === TRUE) {
        echo "Produto excluído com sucesso.";
        header("Location: " . TEMPLATE_URL . "home/home_v.php");  // Redireciona para a página inicial após exclusão
        exit;
    } else {
        echo "Erro ao excluir o produto: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banana.Hi-T.E-C</title>
    <link rel="shortcut icon" href="<?php echo STATIC_URL; ?>icon/favicon/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo STATIC_URL; ?>css/base/base.css">
    <link rel="stylesheet" href="<?php echo STATIC_URL; ?>css/produto/produto_v.css">
</head>
<body>

    <?php include(TEMPLATE_PATH . 'partials/navbar_v.php'); ?>

    <div class="conteudo">

        <div class="formualario">
            <form method="post" action="" enctype="multipart/form-data">
                <h1>Editar Produto</h1>
                <table border="1" cellpadding="10">
                    <tr>
                        <td><label for="nome">Nome:</label></td>
                        <td><input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($produto['nome']); ?>"></td>
                    </tr>
                    <tr>
                        <td><label for="tipo_produto">Tipo de Produto:</label></td>
                        <td><input type="text" id="tipo_produto" name="tipo_produto" value="<?php echo htmlspecialchars($produto['tipo_produto']); ?>"></td>
                    </tr>
                    <tr>
                        <td><label for="marca">Marca:</label></td>
                        <td><input type="text" id="marca" name="marca" value="<?php echo htmlspecialchars($produto['marca']); ?>"></td>
                    </tr>
                    <tr>
                        <td><label for="preco">Preço:</label></td>
                        <td><input type="text" id="preco" name="preco" value="<?php echo htmlspecialchars($produto['preco']); ?>"></td>
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
                            <input type="file" id="nova_foto" name="nova_foto" accept=".jpg">
                            <pre class="td-pre">
                                Recomendações:
                                    Somente imagens em formato JPG.
                                    Opte por imagens nativamente 200x200 pixels, pois imagens maiores que isso serão redimensionadas para 200x200 pixels podendo ocasionar em distorções na imagem.
                            </pre>
                        </td>
                    </tr>
                </table>
                <br>
                <input type="submit" value="Atualizar Produto">
                <button type="submit" name="delete" onclick="return confirm('Tem certeza que deseja excluir este produto?')">Excluir Produto</button>
            </form>
        </div>

    </div>

    <?php include(TEMPLATE_PATH . 'partials/rodape.php'); ?>

</body>
</html>