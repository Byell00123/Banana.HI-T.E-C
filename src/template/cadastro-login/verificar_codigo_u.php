<?php ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificar Códigos - Banana.HI-T.E-C</title>
   
</head>
<body>
    <div class="conteudo">
        <form action="../../controllers/VerificarCodigoController_u.php" method="POST" class="form verificar_codigos">
            <h2>Verificação de Códigos</h2>
            <div class="form-group">
                <label for="codigo_email">Código do E-mail:</label>
                <input type="text" name="codigo_email" required>
            </div>
            <div class="form-group">
                <label for="codigo_telefone">Código do Telefone:</label>
                <input type="text" name="codigo_telefone" required>
            </div>
            <button type="submit">Verificar</button>
        </form>
    </div>
</body>
</html>