<?php ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinir Senha - Banana.HI-T.E-C</title>
    
</head>
<body>
    <div class="conteudo">
        <form action="../../controllers/RedefinirSenhaController_u.php" method="POST" class="form redefinir_senha">
            <h2>Redefinir Senha</h2>
            <div class="form-group">
                <label for="nova_senha">Nova Senha:</label>
                <input type="password" name="nova_senha" required>
            </div>
            <div class="form-group">
                <label for="confirmar_senha">Confirmar Senha:</label>
                <input type="password" name="confirmar_senha" required>
            </div>
            <button type="submit">Redefinir Senha</button>
        </form>
    </div>
</body>
</html>