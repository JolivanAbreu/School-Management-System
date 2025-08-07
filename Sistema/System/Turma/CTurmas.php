<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shoolmanagerdb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

$sql = "SELECT 
            turmas.IdTurma, 
            turmas.Nome AS NomeTurma, 
            turmas.Dia, 
            turmas.Horario,
            professores.Nome AS NomeProfessor,
            disciplinas.Nome AS NomeDisciplina
        FROM 
            turmas
        LEFT JOIN 
            professores ON turmas.IdProfessor = professores.IdProfessor
        LEFT JOIN 
            disciplinas ON turmas.IdDisciplina = disciplinas.IdDisciplina
        ORDER BY 
            turmas.Nome ASC";

$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

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
                <li class="Nav-item"><a href="#">Institucional <i class="uil uil-angle-down"></i> </a>
                    <ul>
                        <li><a href="#">Calendario Educacional</a></li>
                        <li><a href="#">Grandes Conquistas</a></li>
                        <li><a href="#">Sedes</a></li>
                        <li><a href="#">Política de Privacidade</a></li>
                    </ul>
                </li>
                <li class="Nav-item"><a href="#">Educação <i class="uil uil-angle-down"></i></a>
                    <ul>
                        <li><a href="#">Educação Infantil</a></li>
                        <li><a href="#">Educação Fundamental I</a></li>
                        <li><a href="#">Educação Fundamental II</a></li>
                        <li><a href="#">Ensino Médio</a></li>
                    </ul>
                </li>
                <li class="Nav-item"><a href="#">Contatos <i class="uil uil-angle-down"></i></a>
                    <ul>
                        <li><a href="#">Ramais</a></li>
                        <li><a href="#">Ouvidoria</a></li>
                        <li><a href="#">Fale Conosco</a></li>
                    </ul>
                </li>
                <li class="Nav-item"><a href="../Admin.php" class="Nav-item">Tela Inicial</a></li>
            </ul>
        </div>
    </header>
    <!-- NAVBAR -->

    <!-- INFORMAÇÕES -->
    </header>
    <div class="Cadastro">
        <section id="Turmas">
            <h2 class="HTurmas"><i class="fas fa-chalkboard"></i> Cadastro de Turmas</h2>
            <form method="post" id="turmaForm" class="FormTurmas" action="../../php/Turma/CTurma.php">
                <label for="turmaNome" class="LabelTurmas">Nome:</label>
                <input type="text" id="turmaNome" name="nome" class="InputTurmas" required>

                <label for="turmaProfessor" class="LabelTurmas">Professor ID:</label>
                <select name="professor_id" id="turmaProfessor" class="InputTurmas"></select>

                <label for="turmaDisciplina" class="LabelTurmas">Disciplina ID:</label>
                <select name="disciplina_id" id="turmaDisciplina" class="InputTurmas"></select>

                <label for="turmaDataInicio" class="LabelTurmas">Data de Início:</label>
                <input type="date" id="turmaDataInicio" name="data_inicio" class="InputTurmas">

                <label for="turmaDataFim" class="LabelTurmas">Data de Fim:</label>
                <input type="date" id="turmaDataFim" name="data_fim" class="InputTurmas">

                <button type="submit" class="ButtonTurmas"><i class="fas fa-plus-circle"></i> Adicionar Turma</button>
            </form>
            <ul id="turmaList"></ul>
        </section>
    </div>
    <!-- INFORMAÇÕES -->

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
                            <input type="checkbox" id="selectAll">
                        </th>
                        <th>Nome da Turma</th>
                        <th>Disciplina</th>
                        <th>Professor</th>
                        <th>Dia</th>
                        <th>Horário</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result && $result->num_rows > 0) {
                        while ($turma = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td><input type='checkbox' id='checkbox" . htmlspecialchars($turma['IdTurma']) . "' name='options[]' value='" . htmlspecialchars($turma['IdTurma']) . "'></td>";
                            echo "<td>" . htmlspecialchars($turma['NomeTurma']) . "</td>";
                            echo "<td>" . htmlspecialchars($turma['NomeDisciplina']) . "</td>";
                            echo "<td>" . htmlspecialchars($turma['NomeProfessor']) . "</td>";
                            echo "<td>" . htmlspecialchars($turma['Dia']) . "</td>";
                            echo "<td>" . htmlspecialchars($turma['Horario']) . "</td>";
                            echo "<td>";
                            echo "<a href='ETurmas.php?id=" . htmlspecialchars($turma['IdTurma']) . "' class='edit'><i class='fa-solid fa-pen'></i></a>";
                            echo "<a href='#' class='delete' data-id='" . htmlspecialchars($turma['IdTurma']) . "'><i class='fa-solid fa-trash'></i></a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7' style='text-align:center;'>Nenhuma turma encontrada.</td></tr>";
                    }
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <button id="voltar">
        <i class="fa-solid fa-caret-up"></i>
    </button>

    <script src="../../js/Turma.js"></script>
</body>

</html>