<?php
// src/models/ProductModel.php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Banana.HI-T.E-C/src/models/database.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/Banana.HI-T.E-C/src/utils/FlashMessages.php';
$flash_messages = FlashMessages::getMessages();

function getProdutosPorTipo($marca = null) {
    $conn = getConnection();

    // Consultando os produtos
    $sql = "SELECT tipo_produto, nome, url_foto FROM produtos" . ($marca ? " WHERE marca = ?" : "");
    $stmt = $conn->prepare($sql);

    if ($marca) {
        $stmt->bind_param("s", $marca);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    $produtos_por_tipo = [];
    // Verificando se há resultados
    if ($result->num_rows > 0) {
        // Agrupando os produtos por tipo_produto
        while ($row = $result->fetch_assoc()) {
            $produtos_por_tipo[$row['tipo_produto']][] = $row;
        }
    }

    $stmt->close();
    $conn->close();

    return $produtos_por_tipo;
}

function getProdutosPorMarca($marca = null) {
    $conn = getConnection();

    // Se a marca não for especificada, retornamos todos os produtos
    if ($marca) {
        $sql = "SELECT id_produto, nome, tipo_produto, url_foto FROM produtos WHERE marca = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $marca);
    } else {
        $sql = "SELECT id_produto, nome, tipo_produto, url_foto FROM produtos";
        $stmt = $conn->prepare($sql);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    $produtos_por_tipo = [];
    // Verificando se há resultados
    if ($result->num_rows > 0) {
        // Agrupando os produtos por tipo_produto
        while ($row = $result->fetch_assoc()) {
            $produtos_por_tipo[$row['tipo_produto']][] = $row;
        }
    }

    $stmt->close();
    $conn->close();

    return $produtos_por_tipo;
}

function getProdutoPorId($id_produto) {
    $conn = getConnection();  // Obtendo a conexão do banco de dados
    $sql = "SELECT * FROM produtos WHERE id_produto = ?";
    $stmt = $conn->prepare($sql);
    
    if ($stmt) {
        $stmt->bind_param("i", $id_produto);  // Parâmetro `id_produto` para evitar SQL injection
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();  // Retorna os dados do produto
        }
    }
    
    return null;  // Produto não encontrado
}

function getMarcasDisponiveis() {
    $conn = getConnection();

    // Consultando as marcas distintas
    $sql = "SELECT DISTINCT marca FROM produtos";
    $result = $conn->query($sql);

    $marcas = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $marcas[] = $row['marca'];
        }
    }

    $conn->close();
    return $marcas;
}



// TODO: Ta salvando de qualquer jeito, depois tem que adicionar as validadações nos campos para so deixar passar os dados corretos 
function salvarProduto($nome, $tipo_produto, $marca, $preco, $peso, $qtd, $descricao, $url_foto, $fk_vendedores) {
    $conn = getConnection(); // Obtendo a conexão do banco de dados
    $sql = "INSERT INTO produtos (nome, tipo_produto, marca, preco, peso, qtd, descricao, url_foto, fk_vendedores) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    
    // Verificando se a preparação foi bem-sucedida
    if ($stmt === false) {
        return false;
    }

    // Ligando os parâmetros aos valores
    $stmt->bind_param("sssddissi", $nome, $tipo_produto, $marca, $preco, $peso, $qtd, $descricao, $url_foto, $fk_vendedores);

    // Executando a inserção e retornando o resultado
    $resultado = $stmt->execute();

    $stmt->close();
    $conn->close();

    return $resultado;
}



?>