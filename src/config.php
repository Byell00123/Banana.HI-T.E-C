<?php
define('BASE_URL', 'http://localhost/Banana.Hi-T.E-C/');
define('STATIC_URL', BASE_URL . 'src/template/static/');
define('TEMPLATE_URL', BASE_URL . 'src/template/');
define('TEMPLATE_PATH', $_SERVER['DOCUMENT_ROOT'] . '/Banana.Hi-T.E-C/src/template/');

// Conexão com o banco de dados MySQL
$servername = "localhost";
$username = "root";
$password = "12345";
$dbname = "banana_hitec";

// Criando a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificando a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
?>
