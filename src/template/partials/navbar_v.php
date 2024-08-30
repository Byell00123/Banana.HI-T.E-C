<!-- Menu que fica na parte superior do site-->
<nav class="navbar">
    <ul class="navbar-list">
        <li id="menu"><a href="#">Menu</a></li>
        <li><a href="<?php echo TEMPLATE_URL; ?>home/home_u.php" target="_blank">Página Inicial - Cliente</a></li>
        <li><a href="<?php echo TEMPLATE_URL; ?>home/home_v.php" target="_blank">Página Inicial - Vendedor</a></li>
        <li class="pesquisa">
            <form id="formPesquisa">
                <button type="submit">Pesquisar</button>
                <input id="inputPesquisa" type="text" placeholder="Pesquise um produto">
            </form>
        </li>
        <li><a href="#">Suporte</a></li>
        <li>
            <!-- Campo de seleção para filtrar por marca -->
            <div class="pesquisa">
                <form method="GET" action="" class="formPesquisa">
                    <label for="marca">Escolha a marca:</label>
                    <select name="marca" class="marca" onchange="this.form.submit()">
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
            </div>
        </li>
        <li class="gambiarra"></li>
        <li class="carrinho"><a href="#">Carrinho</a></li>
        <!-- Trocar para login/cadastro caso o usuario não esteja logado -->
        <!-- <li class="usuario"><a href="#">Usuario</a></li> -->
        <li class="usuario"><a href="<?php echo TEMPLATE_URL; ?>cadastro-login/decisao.php" target="_blank">Login/Cadastro</a></li>
        <!--  -->
    </ul>
</nav>