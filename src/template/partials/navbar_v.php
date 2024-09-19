<!-- Menu que fica na parte superior do site-->
<nav class="navbar">
    <ul class="navbar-list">
        <li class="li"><a class="a" href="<?php echo TEMPLATE_URL; ?>home/home_u.php" target="_blank">Página Inicial - Cliente</a></li>
        <li class="li"><a class="a" href="<?php echo TEMPLATE_URL; ?>home/home_v.php" target="_blank">Página Inicial - Vendedor</a></li>
        <li class="li pesquisa">
            <form id="form-pesquisa">
                <button class="button" type="submit">Pesquisar</button>
                <input class="input-pesquisa" type="text" placeholder="Pesquise um produto">
            </form>
        </li>
        <li class="li pesquisa">
            <form method="GET" action="" class="form-pesquisa">
                <label class="label" for="marca">Escolha a marca:</label>
                <select class="select-pesquisa" name="marca" class="marca" onchange="this.form.submit()">
                    <option value="">Todas</option>
                    <?php
                        // Usando a função do modelo para obter marcas
                        include_once($_SERVER['DOCUMENT_ROOT'] . '/Banana.HI-T.E-C/src/models/ProductModel.php');
                        $marcas = getMarcasDisponiveis(); // Função que obtem as marcas disponíveis

                        foreach ($marcas as $marcaOption) {
                            $selected = isset($_GET['marca']) && $_GET['marca'] == $marcaOption ? 'selected' : '';
                            echo "<option value=\"$marcaOption\" $selected>$marcaOption</option>";
                        }
                    ?>
                </select>
            </form>
        </li>
        <li class="li gambiarra"></li>
        <li class="li usuario"><a class="a" href="<?php echo TEMPLATE_URL; ?>cadastro-login/cadastro_v.php" target="_blank">Cadastro</a></li>
        <li class="li usuario"><a class="a" href="<?php echo TEMPLATE_URL; ?>cadastro-login/login_v.php" target="_blank">Login</a></li>
    </ul>
</nav>