<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/Login/G_Senha.css">
    <title>Gerador de Senha</title>
</head>

<body>

    <div class="container">
        <h1>Gerador de Senha</h1>
        <input type="text" id="senha" readonly placeholder="Sua senha gerada aparecerá aqui">
        <button onclick="gerarSenha()">Gerar Senha</button>
        <input type="button" value="Alterar Senha" id="button_GS" onclick="window.location.href='./Senha.php';" />
    </div>

    <script src="./js/Senha.js"></script>

</body>

</html>