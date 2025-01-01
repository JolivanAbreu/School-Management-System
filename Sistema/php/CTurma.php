<?php
// Configuração do banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shoolmanagerdb";

// Conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die(json_encode(["success" => false, "message" => "Falha na conexão com o banco de dados."]));
}

// Função para carregar professores e disciplinas
function carregarProfessoresEDisciplinas($conn)
{
    $professoresSql = "SELECT IdProfessor, Nome FROM professores";
    $disciplinasSql = "SELECT IdDisciplina, Nome FROM disciplinas";

    $professoresResult = $conn->query($professoresSql);
    $disciplinasResult = $conn->query($disciplinasSql);

    if ($professoresResult->num_rows > 0) {
        $professores = [];
        while ($row = $professoresResult->fetch_assoc()) {
            $professores[] = $row;
        }
    } else {
        $professores = [];
    }

    if ($disciplinasResult->num_rows > 0) {
        $disciplinas = [];
        while ($row = $disciplinasResult->fetch_assoc()) {
            $disciplinas[] = $row;
        }
    } else {
        $disciplinas = [];
    }

    return ['professores' => $professores, 'disciplinas' => $disciplinas];
}

// Verificar se foi enviado um POST para cadastro de turma
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    // Verificar se os dados necessários foram fornecidos
    if (!isset($data['professor'], $data['disciplina'], $data['dia'], $data['horario'])) {
        echo json_encode(["success" => false, "message" => "Dados incompletos fornecidos."]);
        $conn->close();
        exit;
    }

    $professor = $data['professor'];
    $disciplina = $data['disciplina'];
    $dia = $data['dia'];
    $horario = $data['horario'];

    // Inserir no banco de dados usando prepared statements
    $sql = "INSERT INTO turmas (Professor, Disciplina, Dia, Horario) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        echo json_encode(["success" => false, "message" => "Erro ao preparar consulta."]);
        $conn->close();
        exit;
    }

    // Associar os parâmetros
    $stmt->bind_param("ssss", $professor, $disciplina, $dia, $horario);

    // Executar a consulta
    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Turma cadastrada com sucesso!"]);
    } else {
        echo json_encode(["success" => false, "message" => "Erro ao cadastrar turma.", "error" => $stmt->error]);
    }

    // Fechar a conexão
    $stmt->close();
    $conn->close();
} else {
    // Carregar professores e disciplinas
    $dados = carregarProfessoresEDisciplinas($conn);
    echo json_encode($dados);
    $conn->close();
}
