<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shoolmanagerdb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(["success" => false, "message" => "Falha na conexão com o banco de dados."]));
}

// Função para calcular o próximo nome da turma
function obterProximaTurma($conn) {

    $query = "SELECT Nome FROM Turmas ORDER BY IdTurma DESC LIMIT 1";
    $result = $conn->query($query);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $ultimoNome = $row['Nome'];
        $ultimaLetra = substr($ultimoNome, -1); // Extrair a última letra
        
        if (ctype_alpha($ultimaLetra)) {
            return "Turma " . chr(ord($ultimaLetra) + 1); // Incrementar para a próxima letra
        }
    }
    return "Turma A";
}

$professor = $_POST['professor'];
$disciplina = $_POST['disciplina'];
$dia = $_POST['dia'];
$horario = $_POST['horario'];

$proximaTurma = obterProximaTurma($conn);

// Inserir turma no banco de dados
$sql = "INSERT INTO Turmas (Nome, IdProfessor, IdDisciplina, Dia, Horario) 
        VALUES ('$proximaTurma', $professor, $disciplina, '$dia', '$horario')";

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Turma cadastrada com sucesso: $proximaTurma');</script>";
    echo "<script>window.location.href = '../../CTurmas.php';</script>";
    exit;
} else {
    echo "<script>alert('Erro ao cadastrar turma: " . $conn->error . "');</script>";
    echo "<script>window.location.href = '../../CTurmas.php';</script>";
    exit;
}

$conn->close();
?>
