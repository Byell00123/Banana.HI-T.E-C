<?php
// Configurações do banco de dados MySQL
define('DB_HOST', getenv('DB_HOST') ?: 'localhost');
define('DB_USER', getenv('DB_USER') ?: 'root');
define('DB_PASS', getenv('DB_PASS') ?: '12345');
define('DB_NAME', getenv('DB_NAME') ?: 'banana_hitec');

// Definindo o ambiente
define('ENV', 'development'); // ou 'production'

// Configurações de URL
define('BASE_URL', 'http://localhost/Banana.HI-T.E-C/');
define('TEMPLATE_URL', BASE_URL . 'src/template/');
define('STATIC_URL', BASE_URL . 'src/template/static/');
define('VIEWS_URL', BASE_URL . 'src/views/');

// Caminho para a pasta dos controllers
define('CONTROLLER_URL', BASE_URL . 'src/controllers/');

// Caminho para a pasta dos modelos (models)
define('MODEL_PATH', __DIR__ . '/models/');

define('TEMPLATE_PATH', $_SERVER['DOCUMENT_ROOT'] . '/Banana.HI-T.E-C/src/template/');


?>

<!-- 
-Banana.HI-T.E-C
    -documentacao
    -src
        -views
            -cadastro-login
                -cadastro-login.php
            -home
                -home.php
        -template 
            -base
            -carrinho
                -carrinho_v.php
                -carrinho_u.php
            -cadastro-login
                -cadastro_v.php
                -login_v.php
                -cadastro_u.php
                -login_u.php
                -decisao.php
                -recuperar_senha.php
            -home
                -home_v.php
                -home_u.php
            -partials
                -navbar_v.php
                -navbar_u.php
                -rodape.php
            -produto
                -produto_v.php
                -produto_u.php
            -scripst
            -static
                -css
                    -base
                        -base.css
                    -cadastro-login
                        -cadastro-login.php
                    -home
                        -home_v.css
                        -home_u.css
                    -produto
                        -produto_v.php
                        -produto_u.php
                -icon
                    -botoes
                    -favicon
                -img
                    -banners
                    -produtos
        -.vscode



COMO DEVE FICAR: 

Banana.HI-T.E-C
    - documentacao
    - src
        - controllers
            - CadastroController.php
            - LoginController.php
            - LogoutController.php
        - models
            - database.php
            - UserModel.php
            - Product.php
        - template 
            - base
                -base.html
            - carrinho
                - carrinho_v.php
                - carrinho_u.php
            - cadastro-login
                - cadastro_v.php
                - login_v.php
                - cadastro_u.php
                - login_u.php
                - decisao.php
                - recuperar_senha.php
            - home
                - home_v.php
                - home_u.php
            - partials
                - navbar_v.php
                - navbar_u.php
                - rodape.php
            - produto
                - produto_v.php
                - produto_u.php
            - scripst
            - static
                - css
                    - base
                        - base.css
                    - cadastro-login
                        - cadastro-login.php
                    - home
                        - home_v.css
                        - home_u.css
                    - produto
                        - produto_v.php
                        - produto_u.php
                - icon
                    - botoes
                    - favicon
                - img
                    - banners
                    - produtos
        - util
            - FlashMessages..php
            - isLogado.php
            - session_start.php
        - scripts
    - .vscode



-->