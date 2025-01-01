<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shoolmanagerdb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(["success" => false, "message" => "Falha na conexão com o banco de dados."]));
}

// Obter dados do POST
$professor = $_POST['professor'];
$disciplina = $_POST['disciplina'];
$dia = $_POST['dia'];
$horario = $_POST['horario'];

// Inserir turma
$sql = "INSERT INTO Turmas (Nome, IdProfessor, IdDisciplina, Dia, Horario)
        VALUES ('Turma de $disciplina', $professor, $disciplina, '$dia', '$horario')";

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Turma cadastrada com sucesso.');</script>";
    echo "<script>window.location.href = '../../Admin.php';</script>";
    exit();
} else {
    echo "<script>alert('Erro ao cadastrar turma: " . $conn->error . "');</script>";
    echo "<script>window.location.href = '../php/Turma/CTurmas.php';</script>";
    exit();
}

$conn->close();
