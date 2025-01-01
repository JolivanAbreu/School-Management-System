<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/Login/Login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>Cadastro</title>
</head>

<body>

    <input type="checkbox" id="click">
        <div class="main-container">
            <div class="form-container">
                <div class="sign-in">
                    <form method="post" id="formlogin" name="formlog" action="./php/Loginn.php">
                        <h1 class="LC">Login</h1>

                        <!-- Exibindo a mensagem de erro caso exista -->
                        <?php
                        session_start();
                        if (isset($_SESSION['erro_login'])) {
                            echo "<p style='color: red;'>" . $_SESSION['erro_login'] . "</p>";
                            unset($_SESSION['erro_login']); // Limpa a mensagem após exibi-la
                        }
                        ?>

                        <div class="social-container">
                            <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                            <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
                        </div>

                        <span>ou use sua conta</span>
                        <input type="email" name="email" placeholder="Email" required />
                        <input type="password" name="senha" placeholder="Password" required />
                        <a href="./Senha.php" class="fogot-pass">Esqueceu sua senha?</a>
                        <input type="submit" value="Entrar" />
                    </form>
                </div>

                <div class="sign-up">
                    <form method="post" id="formlogin" name="formlog" action="php/register.php">
                        <h1 class="LC">Criar uma conta</h1>
                        <div class="social-container">
                            <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                            <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                        <span>ou use o e-mail para registro</span>
                        <input type="text" name="nome" placeholder="Nome" required />
                        <input type="email" name="email" placeholder="Email" required />
                        <input type="password" name="senha" placeholder="Password" required />
                        <input class="btn btn-primary" type="submit" value="Cadastrar" />
                    </form>
                </div>
            </div>

            <div class="slide-container">
                <div class="slide-panel">
                    <div class="slide-left">
                        <h1>Olá, Amigo(a)!</h1>
                        <p>Insira seus dados pessoais e comece sua jornada conosco</p>
                        <label for="click" class="slide">Cadastro</label>
                    </div>
                    <div class="slide-right">
                        <h1>Bem vindo de volta!</h1>
                        <p>Para se manter conectado conosco, faça login com suas informações pessoais</p>
                        <label for="click" class="slide">Entrar</label>
                    </div>
                </div>
            </div>
        </div>


</body>

</html>