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

    <link rel="stylesheet" href="../../css/Turma/CTurmas.css">

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
    <div class="Cadastro">
        <section id="Turmas">
            <h2 class="HTurmas"><i class="fas fa-chalkboard"></i> Cadastro de Turmas</h2>
            <form method="post" id="turmaForm" class="FormTurmas" action="../../php/Turma/">

                <label for="turmaNome" class="LabelTurmas">Nome:</label>
                <input type="text" id="turmaNome" class="InputTurmas" required>

                <label for="turmaProfessor" class="LabelTurmas">Professor ID:</label>
                <select name="professor" id="turmaProfessor" class="InputTurmas"></select>

                <label for="turmaDisciplina" class="LabelTurmas">Disciplina ID:</label>
                <select name="disciplina" id="turmaDisciplina" class="InputTurmas"></select>

                <label for="turmaDataInicio" class="LabelTurmas">Data de Início:</label>
                <input type="date" id="turmaDataInicio" class="InputTurmas" required>

                <label for="turmaDataFim" class="LabelTurmas">Data de Fim:</label>
                <input type="date" id="turmaDataFim" class="InputTurmas" required>

                <button type="submit" class="ButtonTurmas"><i class="fas fa-plus-circle"></i> Adicionar Turma</button>
            </form>
            <ul id="turmaList"></ul>
        </section>
    </div>
    <!-- CADASTRO -->

    <!-- VISUALIZAÇÃO DAS TURMAS -->

    <div class="Visualização">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h2>Listagem de <b>Turmas</b></h2>
                    </div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>
                            
                        </th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <input type="checkbox" id="checkbox1" name="options[]" value="1">
                        </td>
                        <td>Dominique Perrier</td>
                        <td>dominiqueperrier@mail.com</td>
                        <td></td>
                        <td></td>
                        <td>
                            <a href="#editEmployeeModal" class="edit" data-toggle="modal">
                            <i class="fa-solid fa-pen"></i>
                            </a>
                            <a href="#deleteEmployeeModal" class="delete" data-toggle="modal">
                            <i class="fa-solid fa-trash" id="delete"></i>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="checkbox" id="checkbox2" name="options[]" value="1">
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            <a href="#editEmployeeModal" class="edit" data-toggle="modal">
                            <i class="fa-solid fa-pen"></i>
                            </a>
                            <a href="#deleteEmployeeModal" class="delete" data-toggle="modal">
                            <i class="fa-solid fa-trash" id="delete"></i>
                            </a>
                        </td>
                    </tr>
                    <!-- Adicionar mais linhas conforme necessário -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- VISUALIZAÇÃO DAS TURMAS -->


    <!-- BOTÃO DE ROLAGEM -->
    <button id="voltar">
        <i class="fa-solid fa-caret-up"></i>
    </button>

    <script src="../js/Turma.js"></script>
    <script src="../js/index.js"></script>
</body>

</html>