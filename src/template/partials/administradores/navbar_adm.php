<?php
// src/template/partials/navbar_v.php
include_once(dirname(__FILE__) . '/../../../models/ProdutoModel.php');// ProdutoModel.php
include_once(dirname(__FILE__) . '/../../../utils/administradores/AdministradorLogado.php');

?>
<!-- Menu que fica na parte superior do site-->
<nav class="navbar">
    <ul class="navbar-list">
        <li class="li"><a class="a" href="<?php echo TEMPLATE_URL; ?>home/home_u.php" target="_blank">Página Inicial - Cliente</a></li> <!-- TODO: Fazer o adm acessar tudo, usando as permissoes -->
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
        <li class="li">
            <div class="div-toggle">
                <form method="post">
                    <label class="label-vizualizacao" for="toggle-visializa">Visualização Personalizada</label>
                    <div class="toggle">
                        <input type="checkbox" id="toggle-visializa" name="toggle-visializa" value="simplificada" 
                        onchange="this.form.submit();">
                    </div>
                </form>
            </div>
        </li>


        <?php if (isAdmLogado()): ?>
            <form id="logoutForm" action="../../controllers/LogoutController.php" method="POST" style="display: none;">
                <input type="hidden" name="action" value="logout">
            </form>
            <li class="li"><a class="a" onclick="document.getElementById('logoutForm').submit(); return false;" style="cursor: pointer;">Sair</a></li>
                <li class="li usuario"><a class="a" href="#">Administrador</a></li>
        <?php else: ?>
            <li class="li"><a class="a" href="<?php echo TEMPLATE_URL; ?>administradores/cadastro_adm.php" target="_blank">Cadastro</a></li>
            <li class="li usuario"><a class="a" href="<?php echo TEMPLATE_URL; ?>administradores/login_adm.php" target="_blank">Login</a></li>
        <?php endif; ?>
        

    </ul>
</nav>