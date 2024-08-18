<?php
// Configurações do banco de dados
$servername = "localhost"; // Nome do servidor ou endereço IP
$username = "root"; // Nome de usuário do banco de dados
$password = "12345"; // Senha do banco de dados
$dbname = "banana_hitec"; // Nome do banco de dados

// Conectando ao banco de dados MySQL
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Nome do arquivo a ser lido
$filename = "fontes_de_energia.txt"; // Substitua pelo nome do arquivo

// Verifica se o arquivo existe
if (!file_exists($filename)) {
    die("Arquivo não encontrado.");
}

// Abre o arquivo para leitura
$file = fopen($filename, "r");

if ($file) {
    // Lê o arquivo linha por linha
    while (($line = fgets($file)) !== false) {
        // Limpa a linha de caracteres indesejados
        $line = trim($line);

        // Remove as aspas simples e divide a linha em partes usando ponto e vírgula
        $line = str_replace("'; '", "|", $line); // Substitui o delimitador de campo por um caractere temporário
        $line = str_replace(["'", ";'"], ["", ""], $line); // Remove as aspas simples e os pontos e vírgulas finais
        $data = explode('|', $line); // Divide os campos

        // Verifica se temos exatamente 7 partes na linha (nome, tipo_produto, marca, preço, peso, descrição, url_foto)
        if (count($data) == 7) {
            $nome = $data[0];
            $tipo_produto = $data[1];
            $marca = $data[2];
            $preco = $data[3];
            $peso = $data[4];
            $descricao = $data[5];
            $url_foto = $data[6];
            
// TODO: Opcional da linha 51 á 61
            // Diagnóstico: Mostra os valores extraídos para verificar possíveis problemas
            // echo "Nome: $nome<br>";
            // echo "Tipo de Produto: $tipo_produto<br>";
            // echo "Marca: $marca<br>";
            // echo "Preço: $preco<br>";
            // echo "Peso: $peso<br>";
            // echo "Descrição: $descricao<br>";
            // echo "URL Foto: $url_foto<br>";
            // echo "<hr>";
//

            // Valida o preço
            if (!is_numeric(str_replace(',', '.', $preco))) {
// TODO: Opcional da linha 65 á 67
                // echo "Preço inválido para o item: $nome<br>";
//
                continue;
            }

            // Escapando caracteres especiais para evitar SQL Injection
            $nome = $conn->real_escape_string($nome);
            $preco = $conn->real_escape_string($preco);
            $marca = $conn->real_escape_string($marca);
            $peso = $conn->real_escape_string($peso);
            $descricao = $conn->real_escape_string($descricao);
            $url_foto = $conn->real_escape_string($url_foto);

            // SQL para inserir dados na tabela
            $sql = "INSERT INTO produto (nome, tipo_produto, marca, preco, peso, descricao, url_foto)
                    VALUES ('$nome', '$tipo_produto', '$marca', '$preco', '$peso', '$descricao', '$url_foto')";

            if ($conn->query($sql) === TRUE) {
                echo "Novo registro inserido com sucesso<br>";
            }
            else {
                echo "Erro ao inserir registro: " . $conn->error . "<br>";
            }
        }
        else {
            echo "Dados insuficientes na linha: $line<br>";
        }
    }

    // Fecha o arquivo
    fclose($file);
}
else {
    echo "Erro ao abrir o arquivo.";
}

// Fecha a conexão com o banco de dados
$conn->close();
?>
