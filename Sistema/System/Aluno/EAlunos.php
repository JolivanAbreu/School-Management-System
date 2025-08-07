<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shoolmanagerdb";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("ID do aluno não fornecido.");
}

$idAluno = $_GET['id'];
$sql_aluno = "SELECT * FROM alunos WHERE IdAluno = ?";
$stmt_aluno = $conn->prepare($sql_aluno);
$stmt_aluno->bind_param("i", $idAluno);
$stmt_aluno->execute();
$result_aluno = $stmt_aluno->get_result();

if ($result_aluno->num_rows === 0) {
    die("Aluno não encontrado.");
}

$aluno = $result_aluno->fetch_assoc();
$conn->close();
?>
<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <link rel="stylesheet" href="../../css/Aluno/Alunos.css">
    <title>Editar Aluno</title>
</head>

<body>
    <div class="Cadastro">
        <section class="Alunos">
            <h2 class="H2Aluno"><i class="fas fa-user-edit"></i> Editar Aluno</h2>
            <form method="post" action="../../php/Aluno/AAluno.php" class="AlunosForm">

                <input type="hidden" name="id_aluno" value="<?php echo htmlspecialchars($aluno['IdAluno']); ?>">

                <label for="alunoNome" class="LabelAluno">Nome:</label>
                <input type="text" id="alunoNome" name="nome" class="InputAlunos" value="<?php echo htmlspecialchars($aluno['Nome']); ?>" required>

                <label for="alunoEmail" class="LabelAluno">Email:</label>
                <input type="email" id="alunoEmail" name="email" class="InputAlunos" value="<?php echo htmlspecialchars($aluno['Email']); ?>" required>

                <label for="alunoCpf" class="LabelAluno">CPF:</label>
                <input type="text" id="alunoCpf" name="cpf" class="InputAlunos" value="<?php echo htmlspecialchars($aluno['CPF']); ?>">

                <label for="alunoDataNascimento" class="LabelAluno">Data de Nascimento:</label>
                <input type="date" id="alunoDataNascimento" name="data_nascimento" class="InputAlunos" value="<?php echo htmlspecialchars($aluno['DataNascimento']); ?>">

                <label for="alunoTelefone" class="LabelAluno">Telefone:</label>
                <input type="text" id="alunoTelefone" name="telefone" class="InputAlunos" value="<?php echo htmlspecialchars($aluno['Telefone']); ?>">

                <label for="alunoEndereco" class="LabelAluno">Endereço:</label>
                <textarea id="alunoEndereco" name="endereco" class="InputAlunos"><?php echo htmlspecialchars($aluno['Endereco']); ?></textarea>

                <label for="alunoSenha" class="LabelAluno">Nova Senha (deixe em branco para não alterar):</label>
                <input type="password" id="alunoSenha" name="senha" class="InputAlunos">

                <div class="form-buttons">
                    <button type="submit" class="ButtonAlunos"><i class="fas fa-save"></i> Salvar Alterações</button>

                    <a href="CAlunos.php" class="ButtonVoltar"><i class="fas fa-arrow-left"></i> Voltar</a>
                </div>

            </form>
        </section>
    </div>
</body>

</html>