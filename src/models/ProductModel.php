<?php
// src/models/ProductModel.php

function getProdutosPorTipo() {
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

    $produtos_por_tipo = [];
    // Verificando se há resultados
    if ($result->num_rows > 0) {
        // Agrupando os produtos por tipo_produto
        while ($row = $result->fetch_assoc()) {
            $produtos_por_tipo[$row['tipo_produto']][] = $row;
        }
    }

    // Fechando a conexão
    $conn->close();

    return $produtos_por_tipo;
}
