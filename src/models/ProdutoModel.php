<?php
// src/models/ProductModel.php
require_once(dirname(__FILE__) . '/database.php');
include_once(dirname(__FILE__) . '/../utils/VendedorLogado.php');

class ProdutoModel{

// Função para verificar se o vendedor está logado e retornar o status
    function isVendedorLogado() {
        return VendedorLogado();
    }

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
            $sql = "SELECT * FROM produtos WHERE marca = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $marca);
        } else {
            $sql = "SELECT * FROM produtos";
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
        $sql = "SELECT DISTINCT marca FROM produtos order by marca";
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

    function getTiposDisponiveis() {
        $conn = getConnection();

        // Consultando as marcas distintas
        $sql = "SELECT DISTINCT tipo_produto FROM produtos";
        $result = $conn->query($sql);

        $tipos = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $tipos[] = $row['tipo_produto'];
            }
        }

        $conn->close();
        return $tipos;
    }

    function salvarProduto($nome, $tipo_produto, $marca, $preco, $peso, $qtd, $descricao, $url_foto, $fk_vendedores) {
        $conn = getConnection(); // Obtendo a conexão do banco de dados
        $sql = "INSERT INTO produtos (nome, tipo_produto, marca, preco, peso, qtd, descricao, url_foto, fk_vendedor) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
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

    // Atualizar produto por ID
    function atualizarProduto($id_produto, $nome, $tipo_produto, $preco, $peso, $qtd, $descricao, $url_foto) {
        $conn = getConnection();
        $sql = "UPDATE produtos SET nome = ?, tipo_produto = ?, preco = ?, peso = ?, qtd = ?, descricao = ?, url_foto = ? WHERE id_produto = ?";
        
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            return false;
        }

        $stmt->bind_param("ssddissi", $nome, $tipo_produto, $preco, $peso, $qtd, $descricao, $url_foto, $id_produto);
        $resultado = $stmt->execute();

        $stmt->close();
        $conn->close();

        return $resultado;
    }

    // Função para excluir um produto pelo ID
    function excluirProduto($id_produto) {
        $conn = getConnection();

        // Primeiramente, obter a URL da imagem do produto
        $sql = "SELECT url_foto FROM produtos WHERE id_produto = ?";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            return false;
        }

        $stmt->bind_param("i", $id_produto);
        $stmt->execute();
        $result = $stmt->get_result();

        // Se o produto existir, pegamos a URL da imagem
        if ($result->num_rows > 0) {
            $produto = $result->fetch_assoc();
            
            // O campo url_foto pode ter dois formatos
            $url_foto = $produto['url_foto']; // Transformar o nome da imagem

            // Usar explode() para dividir a string com base nas barras '/'
            $partes_url = explode('/', $url_foto);

            // O último índice da lista é o nome do arquivo da imagem
            $nome_imagem = end($partes_url); // Pega o último elemento da lista

            $url_foto = dirname(__FILE__) . '/../uploads/produtos/' . $nome_imagem;  // Caminho completo da imagem

            // Agora, deletamos o produto do banco de dados
            $stmt->close();
            $sql = "DELETE FROM produtos WHERE id_produto = ?";
            $stmt = $conn->prepare($sql);
            if ($stmt === false) {
                return false;
            }

            $stmt->bind_param("i", $id_produto);
            $resultado = $stmt->execute();

            // Após deletar do banco, verificar se o arquivo de imagem existe e deletá-lo
            if ($resultado && file_exists($url_foto)) {
                unlink($url_foto);  // Excluir o arquivo de imagem
            }

            $stmt->close();
            $conn->close();

            return $resultado;
        }

        return false;  // Produto não encontrado
    }
}

?>