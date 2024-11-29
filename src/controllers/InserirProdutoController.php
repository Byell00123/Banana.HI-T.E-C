<?php
// src/controllers/InserirProdutoController.php
include_once(dirname(__FILE__) . '/../models/ProdutoModel.php');
include_once(dirname(__FILE__) . '/../utils/FlashMessages.php');

class InserirProdutoController {
    private $model;

    public function __construct() {
        $this->model = new ProdutoModel();
    }

    public function handleRequest() {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            return $this->MetodoGET();
        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->MetodoPost();
        }
    }

    private function MetodoGET() {
        // Verifica se o vendedor está logado
        if (!$this->model->isVendedorLogado()) {
            FlashMessages::addMessage('error', "Faça login como vendedor para acessar essa área.");
            header("Location: " . TEMPLATE_URL . "cadastro-login/login_v.php");
            exit();
        } else {
            // Obter tipos de produtos disponíveis e retornar
            return $this->model->getTiposDisponiveis();
        }
    }

    private function MetodoPost() {
        // Verifique se todos os campos obrigatórios foram preenchidos
        if (isset($_POST['nome'], $_POST['tipo_produto'], $_POST['preco'], $_POST['peso'], $_POST['qtd'], $_POST['descricao'], $_FILES['foto'])) {
            
            // Verificar o upload da imagem
            if ($_FILES['foto']['error'] === UPLOAD_ERR_OK) {
                // Obter dados do formulário
                $nome = $_POST['nome'];
                $tipo_produto = $_POST['tipo_produto'];
                $marca = $_SESSION['user_nome_fantasia'];
                // Convertendo o valor do preço para o formato aceito pelo MySQL
                $preco_formatado = str_replace(['.', ','], ['', '.'], $_POST['preco']);
                $preco = (float)$preco_formatado;

                $peso = (float)$_POST['peso'];
                $qtd = $_POST['qtd'];
                $descricao = $_POST['descricao'];
                // Busca o cnpj do vendedor, cnpj esse que deve ter sido passado durante o processo de login.
                $fk_vendedor = $_SESSION["user_cnpj"];

                // Manipulação da imagem contando que todas sejam .jpg
                $nome_imagem_unico = uniqid('produto_', true) . '.jpg'; // Gerar nome de arquivo único com extensão .jpg
                // Caminho até a pasta de uploads, onde as imagens ficarão salvas
                $caminho_imagem = '../uploads/produtos/' . $nome_imagem_unico;
                

                // Movendo o arquivo para o diretório de uploads
                if (move_uploaded_file($_FILES['foto']['tmp_name'], $caminho_imagem)) {
                    // Caminho da imagem que será salvo no banco de dados
                    $url_foto = '../../uploads/produtos/' . $nome_imagem_unico;

                    // Tente salvar o produto no banco de dados
                    $resultado = $this->model->salvarProduto($nome, $tipo_produto, $marca, $preco, $peso, $qtd, $descricao, $url_foto, $fk_vendedor);

                    // Verificar se a inserção foi bem-sucedida
                    if ($resultado) {
                        if (isset($_POST['inserir'])) {
                            FlashMessages::addMessage('success', "Produto inserido com sucesso.");
                            header("Location: " . TEMPLATE_URL . "home/home_v.php");
                            exit();
                        } elseif (isset($_POST['inserirmais'])) {
                            FlashMessages::addMessage('success', "Produto inserido com sucesso.");
                            header("Location: " . TEMPLATE_URL . "produto/produto_v_inserir.php");
                            exit();
                        }
                    } else {
                        FlashMessages::addMessage('error', "Erro ao inserir produto.");
                        $this->redirectBack();
                    }
                } else {
                    FlashMessages::addMessage('error', "Erro ao fazer upload da imagem.");
                    $this->redirectBack();
                }
            } else {
                FlashMessages::addMessage('error', "Erro ao enviar o arquivo.");
                $this->redirectBack();
            }
        } else {
            FlashMessages::addMessage('error', "Por favor, preencha todos os campos obrigatórios.");
            $this->redirectBack();
        }
    }

    private function redirectBack() {
        header("Location: " . TEMPLATE_URL . "produto/produto_v_inserir.php");
        exit();
    }
}

$controller = new InserirProdutoController();
$tipos_disponiveis = $controller->handleRequest();
?>
