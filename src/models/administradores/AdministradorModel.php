<?php
// models/AdministradorModel.php
require_once(dirname(__FILE__) . '/../database.php');
include_once(dirname(__FILE__) . '/../../utils/FlashMessages.php');
$flash_messages = FlashMessages::getMessages();

class AdministradorModel {

    // Função para cadastrar um adm
    public function cadastraAdministrador($dados) {
        // Conectar ao banco de dados
        $conn = getConnection();
        
        // Verificar se houve erro na conexão
        if ($conn->connect_error) {
            die("Conexão falhou: " . $conn->connect_error);
        }
         // Verificar se há tokens disponíveis para cadastro
         $sqlToken = "SELECT t.token FROM tokens t LEFT JOIN administradores a ON t.token = a.fk_token WHERE a.fk_token IS NULL";
         $stmtToken = $conn->prepare($sqlToken);
         if (!$stmtToken) {
             die("Erro ao preparar a consulta: " . $conn->error);
         }
         // Executar a consulta de token
        $stmtToken->execute();
        $resultToken = $stmtToken->get_result();

        if ($resultToken->num_rows > 0) {
            // Token disponível
            $tokenData = $resultToken->fetch_assoc();
            $tokenDisponivel = $tokenData['token'];
        }
        // Preparar a consulta SQL para inserção de dados
        $sql = "INSERT INTO usuarios (id_adm,codenome,senha,data_engressou) VALUES (?, ?, ?, ?)";
        
        // Preparar a instrução
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            die("Erro ao preparar a consulta: " . $conn->error);
        }
    
        // Criar uma senha criptografada
        $senhaCriptografada = password_hash($dados['password1'], PASSWORD_DEFAULT);
        
        // Associar os parâmetros
        $stmt->bind_param("ssss", 
            $dados['id_adm'], 
            $senhaCriptografada, 
            $dados['condenome'], 
            $dados['data_engressou'],
            $tokenDisponivel,
        );

        // Executar a consulta
        if ($stmt->execute()) {
            // Cadastro bem-sucedido
            header("Location: " . TEMPLATE_URL . "administradores/login_adm.php");
            exit();
        } else {
            // Exibir erro em caso de falha
            echo "Erro ao cadastrar o administrador: " . $stmt->error;
        }
        
        // Fechar a instrução e a conexão
        $stmt->close();
        $conn->close();
    }

    public function loginAdministrador($username, $password) {
        $conn = getConnection();
        $sql = "SELECT * FROM administradores WHERE id_adm = ? OR codenome = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $username, $username);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            // Verificar a senha
            if (password_verify($password, $user['senha'])) {
                // Iniciar a sessão e armazenar informações do administrador
                session_start();
                $_SESSION['user_id_adm'] = $user['id_adm'];
                $_SESSION['user_codenome'] = $user['codenome'];
                return true;
            }
        }
        return false; // Login falhou
    }
    
}
