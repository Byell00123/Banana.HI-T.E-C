<?php
// Configurações do banco de dados MySQL
define('DB_HOST', getenv('DB_HOST') ?: 'localhost');
define('DB_USER', getenv('DB_USER') ?: 'root');
define('DB_PASS', getenv('DB_PASS') ?: '');
define('DB_NAME', getenv('DB_NAME') ?: 'banana_hitec');

// Definindo o ambiente
define('ENV', 'development'); // ou 'production'

// Configurações de URL
define('BASE_URL', 'http://localhost/3_ano/Banana.HI-T.E-C/');
define('TEMPLATE_URL', BASE_URL . 'src/template/');
define('STATIC_URL', BASE_URL . 'src/template/static/');
define('VIEWS_URL', BASE_URL . 'src/views/');
define('UPLOADS_URL', BASE_URL . 'src/uploads/');

// Caminho para a pasta dos controllers
define('CONTROLLER_URL', BASE_URL . 'src/controllers/');

// Caminho para a pasta dos modelos (models)
define('MODEL_PATH', __DIR__ . '/models/');

define('TEMPLATE_PATH', $_SERVER['DOCUMENT_ROOT'] . '/Banana.HI-T.E-C/src/template/');
define('UTILS_PATH', $_SERVER['DOCUMENT_ROOT'] . '/Banana.HI-T.E-C/src/utils/');

// Criando a conexão com o banco de dados
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Verificando a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
?>