<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./css/Login/Senha.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <title>Alterar Senha</title>
</head>

<body>
    <?php session_start(); ?>

    <div id="box">
        <form action="./php/Password.php" id="myform-search" method="post" autocomplete="off">
            <h1>Alteração de Senha<span>Escolha uma boa!</span></h1>
            <p>
                <input type="email" placeholder="Email" name="email" id="email" class="password" required />

            <div class="password-container">
                <input type="password" placeholder="Nova Senha" name="nova_senha" id="nova_senha" class="password"
                    title="Deve conter no mínimo 6 caracteres, incluindo 1 letra maiúscula, 1 número e 1 caractere especial"
                    required />
                <button type="button" class="toggle-password" onclick="togglePassword('nova_senha')">
                    <i class="fas fa-eye"></i>
                </button>
            </div>

            <div class="password-container">
                <input type="password" placeholder="Confirme a Nova Senha" name="confirmar_senha" id="confirmar_senha"
                    class="password" required oninput="validatePassword()" />
                <button type="button" class="toggle-password" onclick="togglePassword('confirmar_senha')">
                    <i class="fas fa-eye"></i>
                </button>
            </div>

            <input type="submit" value="Alterar Senha" id="button" onclick="return validatePassword()" />

            <input type="button" value="Gerar Senha" id="button_GS" onclick="window.location.href='./GSenha.php';" />


            <small>Deve ter mais de 6 caracteres e conter pelo menos 1 letra maiúscula, 1 número e 1 caractere especial</small>
            </p>
        </form>
    </div>

    <script src="./js/Senha.js"></script>

</body>

</html>