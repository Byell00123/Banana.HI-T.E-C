<?php
include_once (dirname(__FILE__) . '/../../utils/isLogado.php');
?>
<!-- Menu que fica na parte superior do site -->
<nav class="navbar">
    <ul class="navbar-list">
        <li class="li menu"><a class="a" href="#">Menu</a></li>
        <li class="li"><a class="a" href="<?php echo TEMPLATE_URL; ?>home/home_u.php" target="_blank">Página Inicial</a></li>
        <li class="li pesquisa">
            <form class="form-pesquisa">
                <button class="button" type="submit">Pesquisar</button>
                <input class="input-pesquisa" type="text" placeholder="Pesquise um produto">
            </form>
        </li>
        <li class="li"><a class="a" href="#">Acessibilidade</a></li>
        <li class="li"><a class="a" href="#">Suporte</a></li>
        <div class="gambiarra"></div>
        <li class="li carrinho"><a class="a" href="#">Carrinho</a></li>
        <?php if (isLogado()): ?>
            <form id="logoutForm" action="<?php echo CONTROLLER_URL; ?>LogoutController.php" method="POST" style="display: none;">
                <input type="hidden" name="action" value="logout">
            </form>
            <li class="li"><a class="a" href="#" onclick="document.getElementById('logoutForm').submit(); return false;">Sair</a></li>
                <li class="li usuario"><a class="a" href="#">Usuario</a></li>
        <?php else: ?>
            <li class="li"><a class="a" href="<?php echo TEMPLATE_URL; ?>cadastro-login/cadastro_v.php">Vendedor</a></li>
            <li class="li usuario"><a class="a" href="<?php echo TEMPLATE_URL; ?>cadastro-login/decisao.php" target="_blank">Login/Cadastro</a></li>
        <?php endif; ?>
    </ul>
</nav>
