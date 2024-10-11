<?php
// models/UserModel.php
require_once(dirname(__FILE__) . '/database.php');
include_once(dirname(__FILE__) . '/../utils/FlashMessages.php');
$flash_messages = FlashMessages::getMessages();

class UserModel {

    // Função para cadastrar um usuário
    public function cadastraUsuario($dados) {
        // Conectar ao banco de dados
        $conn = getConnection();
        
        // Verificar se houve erro na conexão
        if ($conn->connect_error) {
            die("Conexão falhou: " . $conn->connect_error);
        }
    
        // Preparar a consulta SQL para inserção de dados
        $sql = "INSERT INTO usuarios (nome_usuario, senha, primeiro_nome, sobrenome, data_nascimento, email, telefone, sexo, cpf, data_engressou) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        // Preparar a instrução
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            die("Erro ao preparar a consulta: " . $conn->error);
        }
    
        // Criar uma senha criptografada
        $senhaCriptografada = password_hash($dados['password1'], PASSWORD_DEFAULT);
        
        // Associar os parâmetros
        $stmt->bind_param("ssssssssss", 
            $dados['apelido'], 
            $senhaCriptografada, 
            $dados['primeiro_nome'], 
            $dados['sobrenome'], 
            $dados['nascimento'], 
            $dados['email'], 
            $dados['telefone'], 
            $dados['sexo'], 
            $dados['cpf'], 
            $dados['data_engressou']
        );

        // Executar a consulta
        if ($stmt->execute()) {
            // Cadastro bem-sucedido
            header("Location: " . TEMPLATE_URL . "cadastro-login/login_u.php");
            exit();
        } else {
            // Exibir erro em caso de falha
            echo "Erro ao cadastrar o usuário: " . $stmt->error;
        }
        
        // Fechar a instrução e a conexão
        $stmt->close();
        $conn->close();
    }

    public function loginUsuario($username, $password) {
        $conn = getConnection();
        $sql = "SELECT * FROM usuarios WHERE nome_usuario = ? OR email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $username, $username);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            // Verificar a senha
            if (password_verify($password, $user['senha'])) {
                // Iniciar a sessão e armazenar informações do usuário
                session_start();
                $_SESSION['user_id'] = $user['id_usuario'];
                $_SESSION['user_name'] = $user['nome_usuario'];
                return true;
            }
        }
        return false; // Login falhou
    }
    
}
