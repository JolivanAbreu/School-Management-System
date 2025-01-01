<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"
        href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script type="module"
        src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule
        src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <link rel="stylesheet" href="./css/Turma/CTurma.css">

    <title>Gerenciamento de Turmas</title>
</head>

<body>

    <!-- NAVBAR -->
    <header>

        <div class="Navbar">

            <a href="#" class="Logo">Logo</a>
            <div class="Hamburger" onclick="toggleMenu()">☰</div>
            <ul class="Nav-menu">
                <li class="Nav-item"><a href="#">Institucional <i
                            class="uil uil-angle-down"></i> </a>
                    <ul>
                        <li><a href="#">Calendario Educacional</a></li>
                        <li><a href="#">Grandes Conquistas</a></li>
                        <li><a href="#">Sedes</a></li>
                        <li><a href="#">Política de Privacidade</a></li>
                    </ul>
                </li>
                <li class="Nav-item"><a href="#">Educação <i
                            class="uil uil-angle-down"></i>
                    </a>
                    <ul>
                        <li><a href="#">Educação Infantil</a></li>
                        <li><a href="#">Educação Fundamental I</a></li>
                        <li><a href="#">Educação Fundamental II</a></li>
                        <li><a href="#">Ensino Médio</a></li>
                    </ul>
                </li>
                <li class="Nav-item"><a href="#">Contatos <i
                            class="uil uil-angle-down"></i>
                    </a>
                    <ul>
                        <li><a href="#">Ramais</a></li>
                        <li><a href="#">Ouvidoria</a></li>
                        <li><a href="#">Fale Conosco</a></li>
                    </ul>
                </li>
                <li class="Nav-item"><a href="./Admin.php"
                        class="Nav-item">Tela Inicial</a></li>
            </ul>

        </div>

    </header>
    <!-- NAVBAR -->

    <!-- CADASTRO -->

    <<div class="background-container">
        <div class="Container">
            <h1>Cadastro de Turma</h1>
            <form method="post" action="./php/Turma/CTurmaCadastro.php" id="form-turma">
                <label for="professor">Professor:</label>
                <select id="professor" name="professor"></select>

                <label for="disciplina">Disciplina:</label>
                <select id="disciplina" name="disciplina"></select>

                <label for="dia">Dia da Semana:</label>
                <select id="dia" name="dia">
                    <option value="segunda">Segunda-feira</option>
                    <option value="terca">Terça-feira</option>
                    <option value="quarta">Quarta-feira</option>
                    <option value="quinta">Quinta-feira</option>
                    <option value="sexta">Sexta-feira</option>
                </select>

                <label for="horario">Horário:</label>
                <input type="time" id="horario" name="horario" step="3600">

                <button type="submit" class="Button">Cadastrar Turma</button>
            </form>

            <div id="turmas-cadastradas"></div>
        </div>
        </div>

        <!-- CADASTRO -->

        <!-- VISUALIZAÇÃO DAS TURMAS -->

        <div class="VT">
            <h1 class="VT_h1">Visualização de Turmas</h1>
            <form method="post" action="./php/Aluno/CAluno.php" class="VT_Form">
                <label for="turma" class="VT_Label">Turma:</label>
                <select id="turma" name="turma">
                    <?php include('./php/Turma/ListarTurmas.php'); ?>
                </select>
            </form>
        </div>

        <!-- VISUALIZAÇÃO DAS TURMAS -->


        <!-- BOTÃO DE ROLAGEM -->
        <button id="voltar">
            <i class="fa-solid fa-caret-up"></i>
        </button>

        <script src="./js/Turma.js"></script>
        <script src="../js/index.js"></script>
</body>

</html>