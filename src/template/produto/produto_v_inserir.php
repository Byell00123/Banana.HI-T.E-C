<?php 
include_once (dirname(__FILE__) . '/../../models/ProdutoModel.php');
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
</head>
<body>

    <?php include(dirname(__FILE__) . '/../partials/navbar_v.php'); ?>

    <div class="conteudo">

        <div class="formulario">
            <form class="form inserir-produto" method="POST" action="../../controllers/InserirProdutoController.php" enctype="multipart/form-data">

                <h1>Inserir Produto</h1>

                <?php if ($flash_messages): ?>
                    <?php foreach ($flash_messages as $flash_message): ?>
                        <div class="<?php echo $flash_message['type']; ?>" style="color: <?php echo $flash_message['type'] == 'error' ? 'red' : 'green'; ?>;">
                            <?php echo $flash_message['message']; ?>
                        </div>
                    <?php endforeach;?>
                <?php endif; ?>

                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input type="text" class="input nome" name="nome" required>
                </div>
                <div class="form-group">
                    <label for="tipo_produto">Tipo de Produto:</label>
                    <input type="text" class="input tipo_produto" name="tipo_produto" required>
                </div>
                <div class="form-group">
                    <label for="marca">Marca:</label>
                    <input type="text" class="input marca" name="marca" required>
                </div>
                <div class="form-group">
                    <label for="preco">Preço:</label>
                    <input type="text" class="input preco" name="preco" maxlength="10" placeholder="000.000,00" required>
                </div>
                <div class="form-group">
                    <label for="peso">Peso:</label>
                    <input type="text" class="input peso" name="peso" placeholder="000,00" required>
                </div>
                <div class="form-group">
                    <label for="peso">Quantidade:</label>
                    <input type="text" class="input qtd" name="qtd"  placeholder="000.000" required>
                </div>
                <div class="form-group">
                    <label for="descricao">Descricão:</label>
                    <input type="text" class="input descricao" name="descricao" required>
                </div>
                <div class="form-group">
                    <label for="descricao">fk_vendedores:</label>
                    <input type="text" class="input fk_vendedores" name="fk_vendedores" required>
                </div>
                <div class="form-group">
                    <label for="foto">Foto:</label>
                    <input type="file" class="input foto" name="url_foto" accept=".jpg" required>
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

    <script>
        // Cria uma nova instância do Cleave.js para formatar o input de preço
        var cleave = new Cleave('input.preco', {
            numeral: true, // Ativa o modo numeral para que o campo funcione como um campo numérico formatado
            numeralThousandsGroupStyle: 'thousand', // Define o estilo de agrupamento de milhares (ex: 1.000,00)
            numeralDecimalMark: ',', // Define a vírgula como separador decimal (ex: 100,00)
            delimiter: '.', // Define o ponto como delimitador de milhares (ex: 1.000)
            numeralDecimalScale: 2, // Número de casas decimais (ex: 100,00)
            numeralIntegerScale: 6, // Número máximo de dígitos inteiros permitidos antes da vírgula (ex: 999.999)
            prefix: '', // Define o prefixo (pode ser um símbolo como 'R$' se necessário)
            rawValueTrimPrefix: true, // Remove o prefixo ao obter o valor bruto (sem o prefixo)
            numericOnly: true, // Permite apenas a entrada de números (sem letras ou caracteres especiais)
            padFractionalZeros: true // Adiciona zeros após a vírgula para completar as casas decimais (ex: 100 se torna 100,00)
        });

        var cleave = new Cleave('input.peso', {
            numeral: true, // Ativa o modo numeral para que o campo funcione como um campo numérico formatado
            numeralThousandsGroupStyle: 'thousand', // Define o estilo de agrupamento de milhares (ex: 999.999,99)
            numeralDecimalMark: ',', // Define a vírgula como separador decimal (ex: 100,00)
            delimiter: '.', // Define o ponto como delimitador de milhares (ex: 1.000)
            numeralDecimalScale: 2, // Número de casas decimais (ex: 100,00)
            numeralIntegerScale: 3, // Número máximo de dígitos inteiros permitidos antes da vírgula (ex: 999.999)
            prefix: '', // Define o prefixo (pode ser um símbolo como 'R$' se necessário)
            rawValueTrimPrefix: true, // Remove o prefixo ao obter o valor bruto (sem o prefixo)
            numericOnly: true, // Permite apenas a entrada de números (sem letras ou caracteres especiais)
            padFractionalZeros: true // Adiciona zeros após a vírgula para completar as casas decimais (ex: 100 se torna 100,00)
        });
        const inputQtd = document.querySelector('.input.qtd');

        inputQtd.addEventListener('input', function () {
            if (this.value.length > 6) {
                this.value = this.value.slice(0, 6);  // Limita o valor para os primeiros 7 dígitos
            }
        });
        
    </script>
    <?php include(dirname(__FILE__) . '/../partials/rodape.php'); ?>
</body>
</html>
