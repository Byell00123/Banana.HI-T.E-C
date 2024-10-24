<?php
// models/VendedorModel.php
require_once(dirname(__FILE__) . '/database.php');
include_once(dirname(__FILE__) . '/ProdutoModel.php');

class VendedorModel {

    // Função para cadastrar um vendedor
    public function cadastraVendedor($dados) {
        // Conectar ao banco de dados
        $conn = getConnection();
        
        // Verificar se houve erro na conexão
        if ($conn->connect_error) {
            die("Conexão falhou: " . $conn->connect_error);
        }
    
        // Preparar a consulta SQL para inserção de dados
        $sql = "INSERT INTO vendedores (cnpj,nome_fantasia,senha,email,telefone,data_engressou) VALUES (?, ?, ?, ?, ?, ?)";
        //TODO: Depois criar coluna telefone na tabela de vendedor e direcionar o result para BD
        // Preparar a instrução
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            die("Erro ao preparar a consulta: " . $conn->error);
        }
    
        // Criar uma senha criptografada
        $senhaCriptografada = password_hash($dados['password1'], PASSWORD_DEFAULT);
        
        // Associar os parâmetros
        $stmt->bind_param("ssssss", 
            $dados['cnpj'], 
            $dados['nome_fantasia'],
            $senhaCriptografada, 
            $dados['email'], 
            $dados['telefone'],
            $dados['data_engressou'],
        );

        // Executar a consulta
        if ($stmt->execute()) {
            // Cadastro bem-sucedido
            header("Location: " . TEMPLATE_URL . "cadastro-login/login_v.php");
            exit();
        } else {
            // Exibir erro em caso de falha
            echo "Erro ao cadastrar o vendedor: " . $stmt->error;
        }
        
        // Fechar a instrução e a conexão
        $stmt->close();
        $conn->close();
    }
    public function loginVendedor($cnpj, $password) {
        $conn = getConnection();
        $sql = "SELECT * FROM vendedores WHERE cnpj = ? OR email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $cnpj, $cnpj);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            // Verificar a senha
            if (password_verify($password, $user['senha'])) {
                // Iniciar a sessão e armazenar informações do vendedor
                session_start();
                $_SESSION['user_cnpj'] = $user['cnpj'];
                $_SESSION['user_nome_fantasia'] = $user['nome_fantasia'];
                $_SESSION['user_email'] = $user['email'];
                $_SESSION['user_telefone'] = $user['telefone'];
                return true;
            }
        }
        return false; // Login falhou
    }
    public function atualizarUltimoLogin2($cnpj) {
        $conn = getConnection();
        
        // Atualiza a data de último login
        $sql = "UPDATE vendedores SET ultimo_login = ? WHERE cnpj = ? OR email = ?";
        $stmt = $conn->prepare($sql);
        
        // Obter a data e hora atuais
        $dataUltimoLogin = date('Y-m-d H:i:s');
        
        // Associar os parâmetros
        $stmt->bind_param("sss", $dataUltimoLogin, $cnpj, $cnpj);
        
        // Executar a consulta
        if ($stmt->execute()) {
            return true;
        } else {
            return false; // Erro ao atualizar o último login
        }
    }
}

?>