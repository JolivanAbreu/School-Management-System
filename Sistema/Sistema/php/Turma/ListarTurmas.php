<?php
header('Content-Type: application/json; charset=utf-8');

// Configurações do banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shoolmanagerdb";

// Conexão com o banco
$conn = new mysqli($servername, $username, $password, $dbname);

// Exibição de erros (para desenvolvimento)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Verificar conexão
if ($conn->connect_error) {
    echo json_encode(["success" => false, "message" => "Falha na conexão com o banco de dados.", "error" => $conn->connect_error]);
    exit;
}

// Verificar se foi solicitado um ID específico para exibir os detalhes
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $idTurma = intval($_GET['id']);

    // Consulta para buscar os detalhes de uma turma específica
    $stmt = $conn->prepare("
        SELECT 
            t.Nome AS nome_turma,
            p.Nome AS nome_professor,
            d.Nome AS nome_disciplina,
            t.Dia,
            t.Horario
        FROM turmas t
        JOIN professores p ON t.IdProfessor = p.IdProfessor
        JOIN disciplinas d ON t.IdDisciplina = d.IdDisciplina
        WHERE t.IdTurma = ?
    ");
    $stmt->bind_param("i", $idTurma);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $turma = $result->fetch_assoc();
        echo json_encode(["success" => true, "turma" => $turma]);
    } else {
        echo json_encode(["success" => false, "message" => "Turma não encontrada."]);
    }
    $stmt->close();
} else {
    // Consulta para listar todas as turmas
    $sql = "SELECT IdTurma, Nome AS nome_turma FROM turmas";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $turmas = [];
        while ($row = $result->fetch_assoc()) {
            $turmas[] = $row;
        }
        echo json_encode(["success" => true, "turmas" => $turmas]);
    } else {
        echo json_encode(["success" => false, "message" => "Nenhuma turma encontrada."]);
    }
}

$conn->close();
