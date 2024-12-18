<?php
// src/models/administradores/AdministradorModel.php
require_once(dirname(__FILE__) . '/../database.php');
include_once(dirname(__FILE__) . '/../../utils/administradores/AdministradorLogado.php');

class AdministradorModel {
    function isAdmLogado() {
        return AdministradorLogado();
    }
    public function verificaTokenDisponivel($token) {
        $conn = getConnection();
    
        // Query para verificar se o token está disponível
        $sql = "SELECT t.token FROM banana_hitec.tokens t  LEFT JOIN banana_hitec.administradores a ON t.token = a.fk_token WHERE t.token = ? AND a.fk_token IS NULL";
        
        $stmt = $conn->prepare($sql);
        
        if ($stmt) {
            // Associar o token ao parâmetro e executar a consulta
            $stmt->bind_param("s", $token);
            $stmt->execute();
            $result = $stmt->get_result();
    
            // Verificar se o token está disponível
            if ($result->num_rows > 0) {
                return true; // Token disponível
            } else {
                return false; // Token não disponível
            }
        }
    
        return false; // Caso algo dê errado na query
    }

    // Função para cadastrar um adm
    public function cadastraAdministrador($dados) {
        // Conectar ao banco de dados
        $conn = getConnection();
        
        // Verificar se houve erro na conexão
        if ($conn->connect_error) {
            die("Conexão falhou: " . $conn->connect_error);
        }
        
        // Preparar a consulta SQL para inserção de dados
        $sql = "INSERT INTO administradores (id_adm,codenome,senha,data_engressou,fk_token) VALUES (?, ?, ?, ?, ?)";
        
        // Preparar a instrução
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            die("Erro ao preparar a consulta: " . $conn->error);
        }
        // Criar uma senha criptografada
        $senhaCriptografada = password_hash($dados['password1'], PASSWORD_DEFAULT);
        
        // Associar os parâmetros
        $stmt->bind_param("sssss", 
            $dados['id_adm'], 
            $dados['codenome'], 
            $senhaCriptografada, 
            $dados['data_engressou'],
            $dados['token']
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

    public function loginAdministrador($username, $password, $tokens) {
        $conn = getConnection();
        $sql = "SELECT * FROM administradores WHERE codenome = ? OR id_adm = ? OR fk_token = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $username, $username, $tokens);
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
                $_SESSION['user_token'] = $user['token'];
                return true;
            }
        }
        return false; // Login falhou
    }


    // Função para atualizar o último login do administrador
    public function atualizarUltimoLogin($codenome) {
        $conn = getConnection();
        
        // Atualiza a data de último login
        $sql = "UPDATE administradores SET ultimo_login = ? WHERE codenome = ?";// OR id_adm = ?
        $stmt = $conn->prepare($sql);
        
        // Obter a data e hora atuais
        $dataUltimoLogin = date('Y-m-d H:i:s');
        
        // Associar os parâmetros
        $stmt->bind_param("ss", $dataUltimoLogin, $codenome);//s          , $id_adm
        
        // Executar a consulta
        if ($stmt->execute()) {
            return true;
        } else {
            return false; // Erro ao atualizar o último login
        }
    }

    function getUsuarios() {
        $conn = getConnection(); // Conexão com o banco de dados
        $sql = "SELECT * FROM usuarios";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->execute();
            $result = $stmt->get_result();
            
            // Verificar se há usuários no banco
            if ($result->num_rows > 0) {
                // Retornar todos os dados dos usuários como um array
                return $result->fetch_all(MYSQLI_ASSOC);
            }
        }
        return []; // Retorna um array vazio se não houver resultados
    }

    // Função para atualizar dados do usuário
    public function atualizarUsuario($dados) {
        // Conectar ao banco de dados
        $conn = getConnection();
        
        // Verificar se houve erro na conexão
        if ($conn->connect_error) {
            die("Conexão falhou: " . $conn->connect_error);
        }

        // Preparar a consulta SQL para atualização de dados
        $sql = "UPDATE usuarios SET apelido = ?, primeiro_nome= ?, sobrenome= ?, data_nascimento= ?, email= ?, telefone= ?, sexo= ?, cpf= ? WHERE id_usuario = ?";

        // Preparar a instrução
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            die("Erro ao preparar a consulta: " . $conn->error);
        }

        // Associar os parâmetros
        $stmt->bind_param("sssssssss", 
        $dados['apelido'], 
        $dados['primeiro_nome'], 
        $dados['sobrenome'], 
        $dados['nascimento'], 
        $dados['email'], 
        $dados['telefone'], 
        $dados['sexo'], 
        $dados['cpf'], 
        $dados['id_usuario'],
        );

        // Executar a consulta
        if ($stmt->execute()) {
            return true; // Atualização bem-sucedida
        } else {
            echo "Erro ao atualizar os dados do usuário: " . $stmt->error;
            return false; // Falha na atualização
        }
    }
    public function excluirUsuario($id_usuario) {
        $conn = getConnection(); // Conexão com o banco de dados
        $sql = "DELETE FROM usuarios WHERE id_usuario = ?"; // Query para exclusão
        $stmt = $conn->prepare($sql); // Prepara a consulta
        
        if (!$stmt) {
            return false; // Falha ao preparar a consulta
        }
    
        $stmt->bind_param("i", $id_usuario); // Liga o ID do usuário ao parâmetro
        $resultado = $stmt->execute(); // Executa a consulta
    
        if ($resultado) {
            return $stmt->affected_rows > 0; // Verifica se alguma linha foi afetada
        } else {
            echo "Erro ao excluir o usuário: " . $stmt->error; // Exibe erros (apenas para depuração)
            return false;
        }
    }
    

    // Função para atualizar dados do vendedor
    public function atualizarVendedor($dados) {
        $conn = getConnection();
        $sql = "UPDATE vendedores SET nome = ?, email = ?, telefone = ? WHERE cnpj = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $dados['nome'], $dados['email'], $dados['telefone'], $dados['cnpj']);

        // Executar a consulta
        if ($stmt->execute()) {
            return true; // Atualização bem-sucedida
        } else {
            echo "Erro ao atualizar os dados do vendedor: " . $stmt->error;
            return false; // Falha na atualização
        }

    }

    // Dentro do arquivo AdministradorModel.php

    // Função para buscar um usuário pelo ID
    public function getUsuarioPorId($id_usuario) {
        $conn = getConnection();
        $sql = "SELECT * FROM usuarios WHERE id_usuario = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("i", $id_usuario);
            $stmt->execute();
            $result = $stmt->get_result();
            // Verificar se o usuário foi encontrado
            if ($result->num_rows > 0) {
                // Retornar os dados do usuário como array associativo
                return $result->fetch_assoc();
            }
        }
        return null; // Usuário não encontrado
    }

    

}
?>
