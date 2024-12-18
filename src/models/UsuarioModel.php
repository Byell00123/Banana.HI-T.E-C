<?php
// models/UserModel.php
require_once(dirname(__FILE__) . '/database.php');
include_once(dirname(__FILE__) . '/../utils/UsuarioLogado.php');



class UsuarioModel {
    function isUsuarioLogado() {
        return UsuarioLogado();
    }
    // Função para cadastrar um usuário
    public function cadastraUsuario($dados) {
        // Conectar ao banco de dados
        $conn = getConnection();
        
        // Verificar se houve erro na conexão
        if ($conn->connect_error) {
            die("Conexão falhou: " . $conn->connect_error);
        }
    
        // Preparar a consulta SQL para inserção de dados
        $sql = "INSERT INTO usuarios (apelido, senha, primeiro_nome, sobrenome, data_nascimento, email, telefone, sexo, cpf, data_engressou) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
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

    public function loginUsuario($apelido, $senha) {
        $conn = getConnection();
        $sql = "SELECT * FROM usuarios WHERE apelido = ? OR email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $apelido, $apelido);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            // Verificar a senha
            if (password_verify($senha, $user['senha'])) {
                // Iniciar a sessão e armazenar informações do usuário
                session_start();
                $_SESSION['user_id'] = $user['id_usuario'];
                $_SESSION['user_apelido'] = $user['apelido'];
                $_SESSION['user_email'] = $user['email'];
                return true;
            }
        }
        return false; // Login falhou
    }
      // Função para atualizar a data e hora do último login
    public function atualizarUltimoLogin($apelido, $email) {
        $conn = getConnection();
        
        // Atualiza a data de último login
        $sql = "UPDATE usuarios SET ultimo_login = ? WHERE apelido = ? OR email = ?";
        $stmt = $conn->prepare($sql);
        
        // Obter a data e hora atuais
        $dataUltimoLogin = date('Y-m-d H:i:s');
        
        // Associar os parâmetros
        $stmt->bind_param("sss", $dataUltimoLogin, $apelido, $email);
        
        // Executar a consulta
        if ($stmt->execute()) {
            return true;
        } else {
            return false; // Erro ao atualizar o último login
        }
    }
    public function atualizarSenha($usuarioId, $novaSenha) {
        $conn = getConnection();
        $senhaCriptografada = password_hash($novaSenha, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE usuarios SET senha = ? WHERE id_usuario = ?");
        $stmt->bind_param("si", $senhaCriptografada, $usuarioId);
        $stmt->execute();
        $stmt->close();

    }   
    public function buscarPorEmailETelefone($email, $telefone) {
        $conn = getConnection();
        $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = ? AND telefone = ?");
        $stmt->bind_param("ss", $email, $telefone);
        $stmt->execute();
        $resultado = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return $resultado;
    }
    
}
