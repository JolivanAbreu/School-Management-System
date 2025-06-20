<?php
header("Content-Type: application/json");

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shoolmanagerdb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(["success" => false, "message" => "Falha na conexão com o banco de dados."]));
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $professor_id = $_POST['professor_id'];
    $disciplina_id = $_POST['disciplina_id'];

    if (empty($nome) || empty($professor_id) || empty($disciplina_id)) {
        echo json_encode(["success" => false, "message" => "Nome, professor e disciplina são obrigatórios."]);
        $conn->close();
        exit();
    }

    $checkSql = "SELECT IdTurma FROM turmas WHERE Nome = ? AND IdProfessor = ? AND IdDisciplina = ?";
    $checkStmt = $conn->prepare($checkSql);
    $checkStmt->bind_param("sii", $nome, $professor_id, $disciplina_id);
    $checkStmt->execute();
    $result = $checkStmt->get_result();

    if ($result->num_rows > 0) {
        echo json_encode(["success" => false, "message" => "Esta turma já foi cadastrada."]);
    } else {
        $insertSql = "INSERT INTO turmas (Nome, IdProfessor, IdDisciplina) VALUES (?, ?, ?)";
        $insertStmt = $conn->prepare($insertSql);
        $insertStmt->bind_param("sii", $nome, $professor_id, $disciplina_id);

        if ($insertStmt->execute()) {
            echo json_encode(["success" => true, "message" => "Turma cadastrada com sucesso!"]);
        } else {
            echo json_encode(["success" => false, "message" => "Erro ao cadastrar a turma: " . $insertStmt->error]);
        }
        $insertStmt->close();
    }
    $checkStmt->close();
} else {
    echo json_encode(["success" => false, "message" => "Método de requisição inválido."]);
}

$conn->close();
