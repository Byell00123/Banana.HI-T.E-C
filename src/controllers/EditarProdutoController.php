<?php
// src/controllers/EditarProdutoController.php
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
        if (!$this->model->isVendedorLogado()) {
            FlashMessages::addMessage('error', "Faça login como vendedor caso queira acessar a área de vendedores.");
            header("Location: " . TEMPLATE_URL . "cadastro-login/login_v.php");
            exit();
        } else {
            $cnpj_vendedor_logado = $_SESSION['user_cnpj'];
            if (isset($_GET['id'])) {
                $id_produto = intval($_GET['id']);
                $produto = $this->model->getProdutoPorId($id_produto);
    
                if ($produto && $produto['fk_vendedor'] === $cnpj_vendedor_logado) {
                    $tipos_disponiveis = $this->model->getTiposDisponiveis();
                    return [
                        'tipos_disponiveis' => $tipos_disponiveis,
                        'produto' => $produto
                    ];
                } else {
                    FlashMessages::addMessage('error', "Você não tem permissão para editar este produto.");
                    header("Location: " . TEMPLATE_URL . "home/home_v.php");
                    exit();
                }
            } else {
                FlashMessages::addMessage('error', "ID do produto não especificado.");
                header("Location: " . TEMPLATE_URL . "home/home_v.php");
                exit();
            }
        }
    }
    

    private function MetodoPost() {
        $cnpj = $_SESSION['user_cnpj'];
        $fk_vendedor = $_POST['fk_vendedor'];
        if ($cnpj != $fk_vendedor) {
            FlashMessages::addMessage('error', "Você não tem permissão para alterar esse produto.");
            header("Location: " . TEMPLATE_URL . "home/home_v.php");
            exit();
        }
    
        if (isset($_POST['deleta'])) {
            if (isset($_POST['id_produto'])) {
                $id_produto = intval($_POST['id_produto']);
                $resultado = $this->model->excluirProduto($id_produto);
    
                if ($resultado) {
                    FlashMessages::addMessage('success', "Produto excluído com sucesso.");
                    header("Location: " . TEMPLATE_URL . "home/home_v.php");
                    exit();
                } else {
                    FlashMessages::addMessage('error', "Erro ao excluir o produto.");
                    header("Location: " . TEMPLATE_URL . "produto/produto_v_editar.php?id=" . $id_produto);
                    exit();
                }
            }
        } elseif (isset($_POST['atualiza'])) {
            if (isset($_POST['id_produto'], $_POST['nome'], $_POST['tipo_produto'], $_POST['preco'], $_POST['peso'], $_POST['qtd'], $_POST['descricao'])) {
            
                $id_produto = intval($_POST['id_produto']);
                $nome = $_POST['nome'];
                $tipo_produto = $_POST['tipo_produto'];
                $preco = $_POST['preco'];
                $peso = $_POST['peso'];
                $qtd = $_POST['qtd'];
                $descricao = $_POST['descricao'];

                // Recupera a foto atual do produto para manter se não houver nova foto
                $produto = $this->model->getProdutoPorId($id_produto);
                $url_foto_atual = $produto['url_foto'];

                // Tratamento da nova foto
                if (isset($_FILES['nova_foto']) && $_FILES['nova_foto']['error'] == UPLOAD_ERR_OK) {
                    $imagem = $_FILES['nova_foto'];
                    $extensao = pathinfo($imagem['name'], PATHINFO_EXTENSION);
                    $novo_nome_imagem = uniqid('produto_', true) . '.' . $extensao; // Nome único para a imagem
                    $caminho_imagem = '../uploads/produtos/' . $novo_nome_imagem; //

                    // Movendo o arquivo para o diretório de uploads
                    if (move_uploaded_file($imagem['tmp_name'], $caminho_imagem)) {
                        // Caminho da nova imagem que será salvo no banco de dados
                        $url_foto = '../../uploads/produtos/' . $novo_nome_imagem; // caminho que vai para o banco de dados
                    } else {
                        // Caso ocorra um erro no upload da nova imagem, mantém a foto antiga
                        $url_foto = $url_foto_atual;
                    }
                } else {
                    // Se o usuário não enviar uma nova foto, mantém a antiga
                    $url_foto = $url_foto_atual;
                }

                // Chama a função do modelo para atualizar o produto
                $resultado = $this->model->atualizarProduto($id_produto, $nome, $tipo_produto, $preco, $peso, $qtd, $descricao, $url_foto);

                if ($resultado) {
                    FlashMessages::addMessage('success', "Produto atualizado com sucesso.");
                    header("Location: " . TEMPLATE_URL . "produto/produto_v_editar.php?id=" . $id_produto);
                    exit();
                } else {
                    FlashMessages::addMessage('error', "Erro ao atualizar o produto.");
                    header("Location: " . TEMPLATE_URL . "produto/produto_v_editar.php?id=" . $id_produto);
                    exit();
                }
            }
        }
    }
}
?>