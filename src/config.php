<?php
// Define a URL base do site. Esta constante é usada para criar URLs absolutas em todo o site.
// Recomendações: Melhor para usar em links (`href`) e redirecionamentos completos.
define('BASE_URL', 'http://localhost/Banana.Hi-T.E-C/');

// Define o caminho completo para o diretório de recursos estáticos, como CSS, JS e imagens.
// Recomendações: Ideal para usar em referências de arquivos estáticos em `src` e `href`, como links para estilos e scripts.
define('STATIC_URL', BASE_URL . 'src/template/static/');

// Define o caminho completo para o diretório de templates. Esta constante é usada para incluir arquivos PHP que compõem a estrutura das páginas.
// Recomendações: Melhor para usar em `href` e `include` quando se referir a arquivos de template ou de layout.
define('TEMPLATE_URL', BASE_URL . 'src/template/');

// Define o caminho absoluto no sistema de arquivos para o diretório de templates. 
// Recomendações: Ideal para usar em `include` ou `require` onde o caminho do sistema de arquivos deve ser absoluto.
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
