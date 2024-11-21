<?php
// src/controllers/VendedorHomeController.php
include_once(dirname(__FILE__) . '/../models/ProdutoModel.php');
include_once(dirname(__FILE__) . '/../utils/FlashMessages.php');

class VendedorHomeController {
    private $model;

    public function __construct() {
        $this->model = new ProdutoModel();
    }

    public function handleRequest() {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            return $this->MetodoGET();
        }
    }

    private function MetodoGET() {
        // Verifica se o vendedor está logado
        if (!$this->model->isVendedorLogado()) {
            // Adiciona a mensagem de erro antes do redirecionamento
            FlashMessages::addMessage('error', "Faça login como vendedor para acessar essa área.");
            header("Location: " . TEMPLATE_URL . "cadastro-login/login_v.php");
            exit();
        } else {
            // Obtenha o nome fantasia do vendedor logado
            $nome_fantasia_sessao = $_SESSION['user_nome_fantasia'];

            // Verifica se a marca foi passada na URL
            if (isset($_GET['marca'])) {
                $marca = $_GET['marca'];

                // Se a marca da URL for diferente do nome fantasia do vendedor logado, redireciona para a própria home
                if ($marca !== $nome_fantasia_sessao) {
                    FlashMessages::addMessage('error', "Você não pode acessar a página de outro vendedor.");
                    header("Location: " . TEMPLATE_URL . "home/home_v.php?marca=" . urlencode($nome_fantasia_sessao));
                    exit();
                }
            } else {
                // Se a marca não for informada, assume a marca do vendedor logado
                header("Location: " . TEMPLATE_URL . "home/home_v.php?marca=" . urlencode($nome_fantasia_sessao));
                exit();
            }
            
            return $produtos_por_marca = $this->model->getProdutosPorMarca($marca);
        }
    }
}

$controller = new VendedorHomeController();
$controller->handleRequest();
?>
