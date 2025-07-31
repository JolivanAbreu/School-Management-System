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
    die("ID da turma não fornecido.");
}

$idTurma = $_GET['id'];
$sql_turma = "SELECT * FROM turmas WHERE IdTurma = ?";
$stmt_turma = $conn->prepare($sql_turma);
$stmt_turma->bind_param("i", $idTurma);
$stmt_turma->execute();
$result_turma = $stmt_turma->get_result();

if ($result_turma->num_rows === 0) {
    die("Turma não encontrada.");
}

$turma = $result_turma->fetch_assoc();
$result_professores = $conn->query("SELECT IdProfessor, Nome FROM professores ORDER BY Nome ASC");
$professores = $result_professores->fetch_all(MYSQLI_ASSOC);
$result_disciplinas = $conn->query("SELECT IdDisciplina, Nome FROM disciplinas ORDER BY Nome ASC");
$disciplinas = $result_disciplinas->fetch_all(MYSQLI_ASSOC);
$conn->close();

?>
<!DOCTYPE html>
<html lang="pt">

<head>
    <link rel="stylesheet" href="../../css/Turma/CTurmas.css">
    <title>Editar Turma</title>
</head>

<body>
    <div class="Cadastro">
        <section id="Turmas">
            <h2 class="HTurmas"><i class="fas fa-pen"></i> Editar Turma</h2>
            <form method="post" id="editTurmaForm" class="FormTurmas" action="../../php/Turma/ATurma.php">

                <input type="hidden" name="id_turma" value="<?php echo htmlspecialchars($turma['IdTurma']); ?>">

                <label for="turmaNome" class="LabelTurmas">Nome:</label>
                <input type="text" id="turmaNome" name="nome" class="InputTurmas" value="<?php echo htmlspecialchars($turma['Nome']); ?>" required>

                <label for="turmaProfessor" class="LabelTurmas">Professor:</label>
                <select name="professor_id" id="turmaProfessor" class="InputTurmas" required>
                    <option value="">Selecione um Professor</option>
                    <?php foreach ($professores as $professor): ?>
                        <option value="<?php echo $professor['IdProfessor']; ?>" <?php echo ($professor['IdProfessor'] == $turma['IdProfessor']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($professor['Nome']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <label for="turmaDisciplina" class="LabelTurmas">Disciplina:</label>
                <select name="disciplina_id" id="turmaDisciplina" class="InputTurmas" required>
                    <option value="">Selecione uma Disciplina</option>
                    <?php foreach ($disciplinas as $disciplina): ?>
                        <option value="<?php echo $disciplina['IdDisciplina']; ?>" <?php echo ($disciplina['IdDisciplina'] == $turma['IdDisciplina']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($disciplina['Nome']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <button type="submit" class="ButtonTurmas"><i class="fas fa-save"></i> Salvar Alterações</button>
            </form>
        </section>
    </div>

</body>

</html>