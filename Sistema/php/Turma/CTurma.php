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
    $data_inicio = $_POST['data_inicio'];
    $data_fim = $_POST['data_fim'];

    if (empty($nome) || empty($professor_id) || empty($disciplina_id) || empty($data_inicio) || empty($data_fim)) {
        echo json_encode(["success" => false, "message" => "Todos os campos são obrigatórios."]);
        $conn->close();
        exit();
    }

    $sql = "INSERT INTO turmas (Nome, Professor_ID, Disciplina_ID, DataInicio, DataFim) VALUES (?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die(json_encode(["success" => false, "message" => "Erro ao preparar a query: " . $conn->error]));
    }

    $stmt->bind_param("siiss", $nome, $professor_id, $disciplina_id, $data_inicio, $data_fim);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Turma cadastrada com sucesso!"]);
    } else {
        echo json_encode(["success" => false, "message" => "Erro ao cadastrar a turma: " . $stmt->error]);
    }

    $stmt->close();
} else {
    echo json_encode(["success" => false, "message" => "Método de requisição inválido."]);
}

$conn->close();
