<?php 
// src/template/adiministradores/home_adm.php
require_once(dirname(__FILE__) . '/../../models/database.php');

// Determina qual include carregar com base no parâmetro "view"
$view = isset($_GET['view']) && $_GET['view'] === 'simples' ? 'simples' : 'estilizada';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banana.HI-T.E-C</title>
    <link rel="shortcut icon" href="<?php echo STATIC_URL; ?>icon/favicon/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo STATIC_URL; ?>css/home/home_v.css">
    <link rel="stylesheet" href="<?php echo STATIC_URL; ?>administradores/css/navbar_adm.css">
    <link rel="stylesheet" href="<?php echo STATIC_URL; ?>css/cadastro-login/cadastro-login.css">
    <style>
        /* Seu CSS reaproveitado */
        @import url(../cadastro-login/cadastro-login.css);

        .div-toggle {
            display: flex;
            align-items: center;
            width: 100%;
            height: 60px;
            padding: 10px 0px;
        }
        .label-select {
            padding-right: 5px;
        }
        .label-input {
            padding-left: 5px;
        }
        .toggle {
            display: inline-block;
            height: 2rem;
            width: 4rem;
            position: relative;
        }
        .toggle input {
            cursor: pointer;
            height: 0;
            width: 0;
        }
        .toggle input::before {
            background-color: #ff007f;
            border-radius: 1rem;
            content: '';
            height: 100%;
            left: 0;
            position: absolute;
            top: 0;
            transition: background-color 0.25s ease-in-out;
            width: 100%;
        }
        .toggle input:checked::before {
            background-color: #00bfff;
        }
        .toggle input::after {
            background-color: #ffffff;
            border-radius: 50%;
            content: '';
            height: 1.6rem;
            left: 0.2rem;
            position: absolute;
            top: 0.2rem;
            transition: transform 0.25s ease-in-out;
            width: 1.6rem;
        }
        .toggle input:checked::after {
            transform: translateX(2rem);
        }
        .label-input, .label-select {
            font-size: 1rem;
            font-weight: bold;
            transition: color 0.25s ease-in-out;
        }
    </style>
</head>
<body>

    <?php include(dirname(__FILE__) . '/../partials/administradores/navbar_adm.php'); ?>

    <!-- Conteúdo do site -->
    <div class="conteudo">
        <?php include(dirname(__FILE__) . '/../partials/mensagens.php'); ?>

        <!-- Botão estilizado para alternar entre as visualizações -->
        <?php
        // Inclui a página correspondente
        if ($view === 'simples') {
            include(dirname(__FILE__) . '/home_adm_simples.php');
        } else {
            include(dirname(__FILE__) . '/home_adm_estilizada.php');
        }
        ?>
    </div>
    
    <!-- JavaScript -->
    <script>
        function toggleViewType() {
            const checkbox = document.getElementById('toggleView');
            const currentURL = new URL(window.location.href);

            if (checkbox.checked) {
                // Vai para a visão estilizada
                currentURL.searchParams.set('view', 'estilizada');
            } else {
                // Vai para a visão simples
                currentURL.searchParams.set('view', 'simples');
            }

            // Atualiza a URL e recarrega a página
            window.location.href = currentURL.toString();
        }

        // Define o estado inicial dos labels com base no estado do checkbox
        window.onload = function () {
            const checkbox = document.getElementById('toggleView');
            const labelInput = document.querySelector('.label-input');
            const labelSelect = document.querySelector('.label-select');

            if (checkbox.checked) {
                labelInput.style.color = "#00bfff";
                labelSelect.style.color = "gray";
            } else {
                labelSelect.style.color = "#ff007f";
                labelInput.style.color = "gray";
            }

            // Atualiza as cores dos labels ao alternar o estado do checkbox
            checkbox.addEventListener('change', function () {
                if (checkbox.checked) {
                    labelInput.style.color = "#00bfff";
                    labelSelect.style.color = "gray";
                } else {
                    labelSelect.style.color = "#ff007f";
                    labelInput.style.color = "gray";
                }
            });
        };
    </script>

    <?php include(dirname(__FILE__) . '/../partials/rodape.php'); ?>
</body>
</html>
