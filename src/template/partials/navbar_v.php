<!-- Menu que fica na parte superior do site-->
<nav class="navbar">
    <ul class="navbar-list">
        <!-- <li class="li menu"><a class="a" href="#">Menu</a></li> -->
        <li class="li"><a class="a" href="<?php echo TEMPLATE_URL; ?>home/home_u.php" target="_blank">Página Inicial - Cliente</a></li>
        <li class="li"><a class="a" href="<?php echo TEMPLATE_URL; ?>home/home_v.php" target="_blank">Página Inicial - Vendedor</a></li>
        <li class="li pesquisa">
            <form id="form-pesquisa">
                <button class="button" type="submit">Pesquisar</button>
                <input class="input-pesquisa" type="text" placeholder="Pesquise um produto">
            </form>
        </li>
        <!-- <li class="li"><a class="a" href="#">Suporte</a></li> -->

        <!-- Campo de seleção para filtrar por marca -->
        <li class="li pesquisa">
            <form method="GET" action="" class="form-pesquisa">
                <label class="label" for="marca">Escolha a marca:</label>
                <select class="select-pesquisa" name="marca" class="marca" onchange="this.form.submit()">
                    <option value="">Todas</option>
                    <?php
                        // Consulta para obter todas as marcas distintas
                        $sql = "SELECT DISTINCT marca FROM produtos";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $selected = isset($_GET['marca']) && $_GET['marca'] == $row['marca'] ? 'selected' : '';
                                echo "<option value=\"{$row['marca']}\" $selected>{$row['marca']}</option>";
                            }
                        }

                        $conn->close();
                    ?>
                </select>
            </form>

        </li>
        <li class="li gambiarra"></li>
        <!-- <li class="li carrinho"><a class="a" href="#">Carrinho</a></li> -->
        <!-- Trocar para login/cadastro caso o usuario não esteja logado -->
        <!-- <li class="usuario"><a href="#">Usuario</a></li> -->
        <li class="li usuario"><a class="a" href="<?php echo TEMPLATE_URL; ?>cadastro-login/decisao.php" target="_blank">Login/Cadastro</a></li>
        <!--  -->
    </ul>
</nav>