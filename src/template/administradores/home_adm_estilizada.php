<!-- Caso o seja a vizualização estilizada -->
<?php 
include_once(dirname(__FILE__) . '/../../models/administradores/AdministradorModel.php');
include_once(dirname(__FILE__) . '/../../models/ProdutoModel.php');
?>
    
<!-- Dentro do Conteúdo do site -->
<h1>estilizada</h1>
<div class="formulario">
    <div class="form">
        <div class="form-group link-botao">
            <br>
            <div class="links-auxiliares">
                <a class="link-auxiliar c1" href="<?php echo TEMPLATE_URL; ?>administradores/cadastro_u_adm.php" target="_blank">Cadastar um Usuario</a>
                <div class="gambiarra"></div>
                <a class="link-auxiliar c2" href="<?php echo TEMPLATE_URL; ?>administradores/editar_u_adm.php?id=2  " target="_blank">Edita um Usuario</a>
            </div>
            <br>
            <div class="links-auxiliares">
                <a class="link-auxiliar c3" href="<?php echo TEMPLATE_URL; ?>administradores/cadastro_v_adm.php" target="_blank">Cadastar um Vendedor</a>
                <div class="gambiarra"></div>
                <a class="link-auxiliar c4" href="<?php echo TEMPLATE_URL; ?>administradores/editar_v_adm.php" target="_blank">Edita um Vendedor</a>
            </div>
            <br>
        </div>
    </div>
</div>
