<?php
// Configurações do banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shoolmanagerdb";

// Cria a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

// Consulta SQL para buscar todas as disciplinas, ordenadas por nome
$sql = "SELECT IdDisciplina, Nome, Descricao FROM disciplinas ORDER BY Nome ASC";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <link rel="stylesheet" href="../../css/Disciplina/CDisciplina.css">

    <title>Gerenciamento de Disciplinas</title>
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
    <div class="Cadastro">
        <section class="Disciplinas">
            <h2 class="H2Disciplina"><i class="fas fa-book"></i> Cadastro de Disciplinas</h2>

            <form action="../../php/Disciplina/CDisciplina.php" method="POST" class="DisciplinasForm">

                <label for="disciplinaNome" class="LabelDisciplina">Nome:</label>
                <input type="text" id="disciplinaNome" class="InputDisciplina" name="nome" placeholder="Ex: Matemática Avançada" required>

                <label for="disciplinaDescricao" class="LabelDisciplina">Descrição:</label>
                <textarea id="disciplinaDescricao" class="InputDisciplina TextareaDisciplina" name="descricao" placeholder="Digite a descrição da disciplina (opcional)"></textarea>

                <button type="submit" class="ButtonDisciplina"><i class="fas fa-plus-circle"></i> Adicionar Disciplina</button>
            </form>
        </section>
    </div>
    <!-- INFORMAÇÕES -->

    <!-- VISUALIZAÇÃO DE ALUNOS -->
    <div class="Visualização">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h2>Listagem de <b>Disciplinas</b></h2>
                    </div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>
                            <input type="checkbox" id="selectAll">
                        </th>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        // Loop para exibir cada disciplina
                        while ($disciplina = $result->fetch_assoc()) {
                            echo "<tr>";
                            // Utiliza 'IdDisciplina'
                            echo "<td><input type='checkbox' id='checkbox" . htmlspecialchars($disciplina['IdDisciplina']) . "' name='options[]' value='" . htmlspecialchars($disciplina['IdDisciplina']) . "'></td>";
                            // Exibe 'Nome' e 'Descricao' da disciplina
                            echo "<td>" . htmlspecialchars($disciplina['Nome']) . "</td>";
                            echo "<td>" . htmlspecialchars($disciplina['Descricao']) . "</td>";
                            echo "<td>";
                            echo "<a href='#editEmployeeModal' class='edit' data-toggle='modal'><i class='fa-solid fa-pen'></i></a>";
                            echo "<a href='#deleteEmployeeModal' class='delete' data-toggle='modal'><i class='fa-solid fa-trash'></i></a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        // Mensagem e colspan alterados
                        echo "<tr><td colspan='4' style='text-align:center;'>Nenhuma disciplina encontrada.</td></tr>";
                    }
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- VISUALIZAÇÃO DE ALUNOS -->

    <!-- BOTÃO DE ROLAGEM -->
    <button id="voltar">
        <i class="fa-solid fa-caret-up"></i>
    </button>
    <!-- BOTÃO DE ROLAGEM -->

    <script src="../../js/index.js"></script>

</body>

</html>