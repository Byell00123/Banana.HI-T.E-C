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

// Verifica se o formulário de atualização foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $conn->real_escape_string($_POST['nome']);
    $tipo_produto = $conn->real_escape_string($_POST['tipo_produto']);
    $marca = $conn->real_escape_string($_POST['marca']);
    $preco = floatval($_POST['preco']);
    $url_foto = $conn->real_escape_string($_POST['url_foto']);

    $sql_update = "UPDATE produtos SET nome = '$nome', tipo_produto = '$tipo_produto', marca = '$marca', preco = $preco, url_foto = '$url_foto' WHERE id_produto = $id_produto";

    if ($conn->query($sql_update) === TRUE) {
        echo "Produto atualizado com sucesso.";
        // Atualiza os dados do produto para refletir as mudanças
        $produto = [
            'nome' => $nome,
            'tipo_produto' => $tipo_produto,
            'marca' => $marca,
            'preco' => $preco,
            'url_foto' => $url_foto,
        ];
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
        <h1>Editar Produto</h1>

        <form method="post" action="">
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
                    <td><label for="url_foto">Foto:</label></td>
                    <!-- <td><input type="text" id="url_foto" name="url_foto" value="<?php echo htmlspecialchars($produto['url_foto']); ?>"></td> -->
                    <td><img src="<?php echo htmlspecialchars($produto['url_foto']); ?>" alt=""><input type="file" id="foto" name="url_foto"></td>
                </tr>
            </table>
            <br>
            <input type="submit" value="Atualizar Produto">
            <button type="submit" name="delete" onclick="return confirm('Tem certeza que deseja excluir este produto?')">Excluir Produto</button>
        </form>

    </div>

    <?php include(TEMPLATE_PATH . 'partials/rodape.php'); ?>

</body>
</html>