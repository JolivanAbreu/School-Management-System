<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shoolmanagerdb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

$sql = "SELECT IdAluno, Nome, Email, Endereco, Telefone FROM alunos ORDER BY Nome ASC";
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

    <link rel="stylesheet" href="../../css/Aluno/CAluno.css">

    <title>Gerenciamento de Alunos</title>
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
        <section class="Alunos">
            <h2 class="H2Aluno"><i class="fas fa-user"></i> Cadastro de Alunos</h2>
            <form action="../../php/Aluno/CAluno.php" method="POST" class="AlunosForm">
                <label for="alunoNome" class="LabelAluno">Nome:</label>
                <input type="text" id="alunoNome" class="InputAlunos" name="nome" required>

                <label for="alunoCpf" class="LabelAluno">CPF:</label>
                <input type="text" id="alunoCpf" class="InputAlunos" name="cpf">

                <label for="alunoEmail" class="LabelAluno">Email:</label>
                <input type="email" id="alunoEmail" class="InputAlunos" name="email" required>

                <label for="alunoDataNascimento" class="LabelAluno">Data de Nascimento:</label>
                <input type="date" id="alunoDataNascimento" class="InputAlunos" name="data_nascimento">

                <button type="submit" class="ButtonAlunos"><i class="fas fa-plus-circle"></i> Adicionar Aluno</button>
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
                        <h2>Listagem de <b>Alunos</b></h2>
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
                        <th>Email</th>
                        <th>Endereço</th>
                        <th>Telefone</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($aluno = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td><input type='checkbox' id='checkbox" . htmlspecialchars($aluno['IdAluno']) . "' name='options[]' value='" . htmlspecialchars($aluno['IdAluno']) . "'></td>";
                            echo "<td>" . htmlspecialchars($aluno['Nome']) . "</td>";
                            echo "<td>" . htmlspecialchars($aluno['Email']) . "</td>";
                            echo "<td>" . htmlspecialchars($aluno['Endereco']) . "</td>";
                            echo "<td>" . htmlspecialchars($aluno['Telefone']) . "</td>";
                            echo "<td>";
                            echo "<a href='#editEmployeeModal' class='edit' data-toggle='modal'><i class='fa-solid fa-pen'></i></a>";
                            echo "<a href='#deleteEmployeeModal' class='delete' data-toggle='modal'><i class='fa-solid fa-trash'></i></a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6' style='text-align:center;'>Nenhum aluno encontrado.</td></tr>";
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